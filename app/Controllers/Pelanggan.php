<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TransaksiServisModel;
use App\Models\DetailTransaksiServisModel;
use App\Models\BookingModel;
use App\Models\ServisModel;

class Pelanggan extends BaseController
{
    protected $userModel;
    protected $transaksiServisModel;
    protected $detailTransaksiServisModel;
    protected $bookingModel;
    protected $servisModel;
    protected $db;

    public function __construct()
    {
        $this->userModel                 = new UserModel();
        $this->transaksiServisModel       = new TransaksiServisModel();
        $this->detailTransaksiServisModel = new DetailTransaksiServisModel();
        $this->bookingModel              = new BookingModel();
        $this->servisModel               = new ServisModel();
        $this->db                        = \Config\Database::connect();
    }

    /**
     * Halaman Profil Pelanggan
     */
    public function profil()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            session()->setFlashdata('msg', 'Sesi pengguna tidak valid. Silakan login kembali.');
            return redirect()->to('/login');
        }

        // Hitung statistik servis pengguna
        $totalServis = $this->transaksiServisModel
                            ->groupStart()
                                ->where('idpel', $userId)
                                ->orWhere('nama_pelanggan', $user['nama'])
                            ->groupEnd()
                            ->countAllResults();

        $data = [
            'title'       => 'Profil Saya - Bengkel Salsa Motor',
            'user'        => $user,
            'totalServis' => $totalServis,
            'errors'      => session()->getFlashdata('errors') ?? [],
        ];

        return view('page/pelanggan/profil', $data);
    }

    /**
     * Update Data Diri Pelanggan
     */
    public function updateProfil()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        $rules = [
            'nama'   => 'required|min_length[3]|max_length[100]',
            'email'  => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'no_hp'  => 'permit_empty|min_length[8]|max_length[20]',
            'alamat' => 'permit_empty|max_length[255]',
        ];

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $rules['foto'] = 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/webp]|max_size[foto,2048]';
        }

        $messages = [
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah digunakan oleh akun lain.',
            ],
            'foto' => [
                'is_image' => 'File yang diunggah harus berupa gambar (JPG, PNG, WEBP).',
                'mime_in'  => 'Format gambar tidak didukung (harus JPG, JPEG, PNG, atau WEBP).',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/profil')->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataUpdate = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $uploadPath = ROOTPATH . 'public/uploads/users';
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }

        // Cek jika pengguna menghapus foto
        $removeFoto = $this->request->getPost('remove_foto');
        if ($removeFoto == '1') {
            if (!empty($user['foto']) && file_exists($uploadPath . '/' . $user['foto'])) {
                @unlink($uploadPath . '/' . $user['foto']);
            }
            $dataUpdate['foto'] = null;
        }

        // Upload foto profil baru jika ada
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $newName = $fileFoto->getRandomName();
            $fileFoto->move($uploadPath, $newName);

            // Hapus foto lama jika ada
            if (!empty($user['foto']) && file_exists($uploadPath . '/' . $user['foto'])) {
                @unlink($uploadPath . '/' . $user['foto']);
            }

            $dataUpdate['foto'] = $newName;
        }

        // Simpan pembaruan (skipValidation karena sudah divalidasi lengkap di controller)
        $this->userModel->skipValidation(true)->update($userId, $dataUpdate);

        // Update sesi nama & email
        session()->set([
            'userNama'  => $dataUpdate['nama'],
            'userEmail' => $dataUpdate['email'],
        ]);

        session()->setFlashdata('success', 'Profil Anda berhasil diperbarui!');
        return redirect()->to('/profil');
    }

    /**
     * Update Kata Sandi Pelanggan
     */
    public function updatePassword()
    {
        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        $rules = [
            'password_lama'    => 'required',
            'password_baru'    => 'required|min_length[6]',
            'konfirmasi_pass'  => 'required|matches[password_baru]',
        ];

        $messages = [
            'password_lama' => [
                'required' => 'Kata sandi saat ini wajib diisi.',
            ],
            'password_baru' => [
                'required'   => 'Kata sandi baru wajib diisi.',
                'min_length' => 'Kata sandi baru minimal 6 karakter.',
            ],
            'konfirmasi_pass' => [
                'required' => 'Konfirmasi kata sandi baru wajib diisi.',
                'matches'  => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/profil#keamanan')->withInput()->with('errors_password', $this->validator->getErrors());
        }

        $passLama = $this->request->getPost('password_lama');
        $passBaru = $this->request->getPost('password_baru');

        if (!password_verify($passLama, $user['password'])) {
            session()->setFlashdata('error_password', 'Kata sandi lama yang Anda masukkan tidak sesuai.');
            return redirect()->to('/profil#keamanan');
        }

        // Update password (skipValidation)
        $this->userModel->skipValidation(true)->update($userId, [
            'password' => password_hash($passBaru, PASSWORD_BCRYPT),
        ]);

        session()->setFlashdata('success_password', 'Kata sandi Anda berhasil diubah!');
        return redirect()->to('/profil#keamanan');
    }

    /**
     * Halaman Riwayat Servis Pelanggan (Transaksi Kasir / Invoice)
     */
    public function riwayat()
    {
        $userId   = session()->get('user_id');
        $userNama = session()->get('userNama');

        // Ambil semua transaksi servis milik pelanggan ini
        $riwayatServis = $this->transaksiServisModel
                              ->groupStart()
                                  ->where('idpel', $userId)
                                  ->orWhere('nama_pelanggan', $userNama)
                              ->groupEnd()
                              ->orderBy('created_at', 'DESC')
                              ->findAll();

        // Hitung ringkasan statistik pelanggan
        $totalServis   = count($riwayatServis);
        $servisSelesai = 0;
        $totalBiaya    = 0;

        foreach ($riwayatServis as $row) {
            if (strtolower($row['status'] ?? '') === 'selesai') {
                $servisSelesai++;
            }
            $totalBiaya += (float)($row['totalharga'] ?? 0);
        }

        $data = [
            'title'          => 'Riwayat Servis Motor Saya - Bengkel Salsa Motor',
            'riwayatServis'  => $riwayatServis,
            'totalServis'    => $totalServis,
            'servisSelesai'  => $servisSelesai,
            'totalBiaya'     => $totalBiaya,
            'userNama'       => $userNama,
        ];

        return view('page/pelanggan/riwayat', $data);
    }

    /**
     * Detail Transaksi Servis (JSON untuk modal interaktif)
     */
    public function detailServis($faktur = null)
    {
        $header  = $this->transaksiServisModel->find($faktur);
        $details = $this->detailTransaksiServisModel->getDetailWithInfo($faktur);

        if (!$header) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data servis tidak ditemukan.']);
        }

        // Validasi kepemilikan (kecuali admin/pimpinan)
        $userId   = session()->get('user_id');
        $userNama = session()->get('userNama');
        $userRole = strtolower(session()->get('userRole') ?? '');

        if ($userRole === 'pelanggan' && $header['idpel'] != $userId && strtolower($header['nama_pelanggan']) !== strtolower($userNama)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Anda tidak memiliki akses ke data transaksi ini.']);
        }

        return $this->response->setJSON([
            'status'  => true,
            'header'  => $header,
            'details' => $details,
        ]);
    }

    /**
     * Cetak Nota Digital Pelanggan
     */
    public function cetakNota($faktur = null)
    {
        $header  = $this->transaksiServisModel->find($faktur);
        $details = $this->detailTransaksiServisModel->getDetailWithInfo($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi servis tidak ditemukan.');
            return redirect()->to('/riwayat-servis');
        }

        $data = [
            'title'   => 'Nota Servis Motor #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/transaksiservis/cetak', $data);
    }

    // =========================================================================
    // FITUR BOOKING SERVIS & PEMBAYARAN PELANGGAN
    // =========================================================================

    /**
     * Halaman Formulir Booking Servis
     */
    public function booking()
    {
        $userId = session()->get('user_id');
        $user   = $userId ? $this->userModel->find($userId) : null;
        
        $daftarServis = $this->servisModel->orderBy('biaya', 'ASC')->findAll();

        $data = [
            'title'        => 'Booking Servis Motor Online - Bengkel Salsa Motor',
            'user'         => $user,
            'daftarServis' => $daftarServis,
            'errors'       => session()->getFlashdata('errors') ?? [],
        ];

        return view('page/pelanggan/booking', $data);
    }

    /**
     * Simpan Pengajuan Booking Servis & Upload Bukti Pembayaran
     */
    public function simpanBooking()
    {
        $rules = [
            'nama_pelanggan'    => 'required|min_length[3]|max_length[100]',
            'no_hp'             => 'required|min_length[8]|max_length[20]',
            'merkkendaraan'     => 'required|min_length[3]|max_length[100]',
            'nopol'             => 'required|min_length[3]|max_length[20]',
            'kodeservis'        => 'required',
            'tgl_booking'       => 'required|valid_date',
            'jam_booking'       => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran'  => 'permit_empty|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]|max_size[bukti_pembayaran,3072]',
        ];

        $messages = [
            'nama_pelanggan' => ['required' => 'Nama lengkap wajib diisi.'],
            'no_hp'          => ['required' => 'Nomor WhatsApp wajib diisi.'],
            'merkkendaraan'  => ['required' => 'Merk dan tipe motor wajib diisi.'],
            'nopol'          => ['required' => 'Nomor polisi kendaraan wajib diisi.'],
            'kodeservis'     => ['required' => 'Pilih paket servis yang diinginkan.'],
            'tgl_booking'    => ['required' => 'Pilih tanggal jadwal servis.'],
            'jam_booking'    => ['required' => 'Pilih jam jadwal servis.'],
            'bukti_pembayaran' => [
                'is_image' => 'File bukti pembayaran harus berupa gambar.',
                'mime_in'  => 'Format gambar bukti pembayaran harus JPG, JPEG, PNG, atau WEBP.',
                'max_size' => 'Ukuran file bukti pembayaran maksimal 3MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data paket servis (mendukung multi-select array atau string)
        $kodeServisPost = $this->request->getPost('kodeservis');
        if (is_array($kodeServisPost)) {
            $kodeServisList = $kodeServisPost;
        } else if (!empty($kodeServisPost)) {
            $kodeServisList = explode(',', $kodeServisPost);
        } else {
            $kodeServisList = [];
        }

        $jenisServisArray = [];
        $totalBiaya = 0;
        $kodeServisClean = [];

        foreach ($kodeServisList as $k) {
            $k = trim($k);
            if (empty($k)) continue;
            $s = $this->servisModel->find($k);
            if ($s) {
                $kodeServisClean[] = $k;
                $namaServis = $s['jenis_servis'] ?? $s['Jenis_servis'] ?? $k;
                $biayaServis = (float)($s['biaya'] ?? $s['Biaya'] ?? 0);
                $jenisServisArray[] = $namaServis;
                $totalBiaya += $biayaServis;
            }
        }

        if (empty($kodeServisClean)) {
            return redirect()->back()->withInput()->with('errors', ['kodeservis' => 'Silakan pilih minimal 1 paket layanan servis.']);
        }

        $kodeServisFinal  = implode(', ', $kodeServisClean);
        $jenisServisFinal = implode(' + ', $jenisServisArray);

        // Upload bukti pembayaran
        $namaBukti = null;
        $fileBukti = $this->request->getFile('bukti_pembayaran');
        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $uploadPath = ROOTPATH . 'public/uploads/bukti_pembayaran';
            if (!is_dir($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }
            $namaBukti = $fileBukti->getRandomName();
            $fileBukti->move($uploadPath, $namaBukti);
        }

        $userId = session()->get('user_id');
        $kodeBooking = $this->bookingModel->generateKodeBooking();

        $statusPembayaran = !empty($namaBukti) ? 'menunggu_konfirmasi' : 'menunggu_pembayaran';

        $dataInsert = [
            'kode_booking'      => $kodeBooking,
            'id_pelanggan'      => $userId ?? null,
            'nama_pelanggan'    => $this->request->getPost('nama_pelanggan'),
            'no_hp'             => $this->request->getPost('no_hp'),
            'merkkendaraan'     => $this->request->getPost('merkkendaraan'),
            'nopol'             => strtoupper(trim($this->request->getPost('nopol'))),
            'kodeservis'        => $kodeServisFinal,
            'jenis_servis'      => $jenisServisFinal,
            'biaya'             => $totalBiaya,
            'tgl_booking'       => $this->request->getPost('tgl_booking'),
            'jam_booking'       => $this->request->getPost('jam_booking'),
            'keluhan'           => $this->request->getPost('keluhan'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'bukti_pembayaran'  => $namaBukti,
            'status_pembayaran' => $statusPembayaran,
            'status_booking'    => 'menunggu_konfirmasi',
        ];

        $this->bookingModel->insert($dataInsert);

        session()->setFlashdata('success', "Booking servis berhasil diajukan dengan Kode: <b>{$kodeBooking}</b>. Pembayaran Anda akan segera diverifikasi oleh admin bengkel.");
        return redirect()->to('/riwayat-booking');
    }

    /**
     * Halaman Riwayat Booking Servis Pelanggan
     */
    public function riwayatBooking()
    {
        $userId   = session()->get('user_id');
        $userNama = session()->get('userNama');

        $daftarBooking = $this->bookingModel->getByPelanggan($userId, $userNama);

        $data = [
            'title'         => 'Riwayat Booking Servis Saya - Bengkel Salsa Motor',
            'daftarBooking' => $daftarBooking,
            'userNama'      => $userNama,
        ];

        return view('page/pelanggan/riwayat_booking', $data);
    }

    /**
     * Upload Ulang Bukti Pembayaran (Jika sebelumnya ditolak atau belum diupload)
     */
    public function uploadUlangBukti()
    {
        $idBooking = $this->request->getPost('id_booking');
        $booking   = $this->bookingModel->find($idBooking);

        if (!$booking) {
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/riwayat-booking');
        }

        $rules = [
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]|max_size[bukti_pembayaran,3072]',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'File bukti transfer harus berupa gambar valid (maksimal 3MB).');
            return redirect()->to('/riwayat-booking');
        }

        $fileBukti = $this->request->getFile('bukti_pembayaran');
        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $uploadPath = ROOTPATH . 'public/uploads/bukti_pembayaran';
            if (!is_dir($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }

            // Hapus file lama jika ada
            if (!empty($booking['bukti_pembayaran']) && file_exists($uploadPath . '/' . $booking['bukti_pembayaran'])) {
                @unlink($uploadPath . '/' . $booking['bukti_pembayaran']);
            }

            $namaBukti = $fileBukti->getRandomName();
            $fileBukti->move($uploadPath, $namaBukti);

            $this->bookingModel->update($idBooking, [
                'bukti_pembayaran'  => $namaBukti,
                'status_pembayaran' => 'menunggu_konfirmasi',
                'catatan_admin'     => null, // Reset catatan penolakan lama
            ]);

            session()->setFlashdata('success', 'Bukti pembayaran berhasil diunggah ulang! Admin akan segera memverifikasi.');
        }

        return redirect()->to('/riwayat-booking');
    }

    /**
     * Batalkan Pengajuan Booking
     */
    public function batalBooking($idBooking = null)
    {
        $userId   = session()->get('user_id');
        $booking  = $this->bookingModel->find($idBooking);

        if (!$booking) {
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/riwayat-booking');
        }

        // Pastikan hanya bisa membatalkan booking jika belum diproses / selesai
        if (in_array($booking['status_booking'], ['diproses', 'selesai'])) {
            session()->setFlashdata('error', 'Booking yang sedang diproses atau sudah selesai tidak dapat dibatalkan.');
            return redirect()->to('/riwayat-booking');
        }

        $this->bookingModel->update($idBooking, [
            'status_booking' => 'dibatalkan',
        ]);

        session()->setFlashdata('success', 'Pengajuan booking servis berhasil dibatalkan.');
        return redirect()->to('/riwayat-booking');
    }
}
