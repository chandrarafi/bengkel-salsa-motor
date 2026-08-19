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
    /**
     * Halaman Formulir Booking Servis
     */
    /**
     * Halaman Formulir Booking Servis
     */
    public function booking()
    {
        $userId = session()->get('user_id');
        $user   = $userId ? $this->userModel->find($userId) : null;

        $settingModel = new \App\Models\SettingBookingModel();
        $setting      = $settingModel->getSettings();
        $todaySlots   = $settingModel->getSlotAvailability(date('Y-m-d'));

        $data = [
            'title'        => 'Booking Servis Motor Online - Bengkel Salsa Motor',
            'user'         => $user,
            'setting'      => $setting,
            'biayaBooking' => (float)$setting['biaya_booking'],
            'durasiMenit'  => (int)$setting['durasi_pembayaran_menit'],
            'todaySlots'   => $todaySlots,
            'errors'       => session()->getFlashdata('errors') ?? [],
        ];

        return view('page/pelanggan/booking', $data);
    }

    /**
     * Endpoint AJAX untuk cek ketersediaan slot kuota pada tanggal tertentu
     */
    public function checkSlots()
    {
        $tanggal = $this->request->getGet('tanggal') ?: date('Y-m-d');
        $settingModel = new \App\Models\SettingBookingModel();
        $slots = $settingModel->getSlotAvailability($tanggal);

        return $this->response->setJSON([
            'status'  => true,
            'tanggal' => $tanggal,
            'slots'   => $slots,
        ]);
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
            'tgl_booking'       => 'required|valid_date',
            'jam_booking'       => 'required',
            'keluhan'           => 'required|min_length[3]|max_length[500]',
            'metode_pembayaran' => 'required',
        ];

        $messages = [
            'nama_pelanggan' => ['required' => 'Nama lengkap wajib diisi.'],
            'no_hp'          => ['required' => 'Nomor WhatsApp wajib diisi.'],
            'merkkendaraan'  => ['required' => 'Merk dan tipe motor wajib diisi.'],
            'nopol'          => ['required' => 'Nomor polisi kendaraan wajib diisi.'],
            'tgl_booking'    => ['required' => 'Pilih tanggal jadwal servis.'],
            'jam_booking'    => ['required' => 'Pilih jam jadwal servis.'],
            'keluhan'        => [
                'required'   => 'Catatan keluhan / kebutuhan servis motor wajib diisi.',
                'min_length' => 'Catatan keluhan minimal 3 karakter.',
            ],
            'metode_pembayaran' => ['required' => 'Pilih rekening tujuan transfer.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $tglBooking = $this->request->getPost('tgl_booking');
        $jamBooking = $this->request->getPost('jam_booking');
        $jamClean   = substr(trim($jamBooking), 0, 5);

        $settingModel = new \App\Models\SettingBookingModel();
        $setting      = $settingModel->getSettings();
        $slotInfo     = $settingModel->getSlotAvailability($tglBooking);

        // Validasi kuota jam kedatangan
        if (isset($slotInfo[$jamClean]) && !$slotInfo[$jamClean]['is_available']) {
            if ($slotInfo[$jamClean]['is_past']) {
                return redirect()->back()->withInput()->with('errors', [
                    'jam_booking' => "Jam kedatangan ({$jamClean} WIB) sudah lewat untuk hari ini. Silakan pilih jam lain atau pilih tanggal besok."
                ]);
            }
            return redirect()->back()->withInput()->with('errors', [
                'jam_booking' => "Mohon maaf, kuota booking pada jam {$jamClean} WIB sudah penuh (Maksimal {$slotInfo[$jamClean]['max_kuota']} kendaraan). Silakan pilih jam kedatangan lainnya."
            ]);
        }

        $userId = session()->get('user_id');
        $kodeBooking = $this->bookingModel->generateKodeBooking();
        $keluhan = trim($this->request->getPost('keluhan'));
        $biayaBooking = (float)$setting['biaya_booking'];
        $durasiMenit  = (int)$setting['durasi_pembayaran_menit'];

        $dataInsert = [
            'kode_booking'      => $kodeBooking,
            'id_pelanggan'      => $userId ?? null,
            'nama_pelanggan'    => trim($this->request->getPost('nama_pelanggan')),
            'no_hp'             => trim($this->request->getPost('no_hp')),
            'merkkendaraan'     => trim($this->request->getPost('merkkendaraan')),
            'nopol'             => strtoupper(trim($this->request->getPost('nopol'))),
            'kodeservis'        => 'BKG-' . ($biayaBooking / 1000) . 'K',
            'jenis_servis'      => 'Booking Servis & Pengecekan',
            'biaya'             => $biayaBooking,
            'tgl_booking'       => $tglBooking,
            'jam_booking'       => $jamBooking,
            'keluhan'           => $keluhan,
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'bukti_pembayaran'  => null,
            'status_pembayaran' => 'menunggu_pembayaran',
            'status_booking'    => 'menunggu_konfirmasi',
        ];

        $this->bookingModel->insert($dataInsert);
        $idBooking = $this->bookingModel->getInsertID();

        session()->setFlashdata('success', "Pengajuan booking disimpan! Silakan lakukan transfer DP Rp " . number_format($biayaBooking, 0, ',', '.') . " & unggah bukti pembayaran dalam <b>{$durasiMenit} menit</b>.");
        return redirect()->to('/pelanggan/booking/pembayaran/' . $idBooking);
    }

    /**
     * Halaman Pembayaran Booking (Hitung Mundur Sesuai Pengaturan Admin)
     */
    public function pembayaranBooking($idBooking = null)
    {
        $booking = $this->bookingModel->find($idBooking);

        if (!$booking) {
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/riwayat-booking');
        }

        $userId = session()->get('user_id');
        if ($userId && !empty($booking['id_pelanggan']) && (int)$booking['id_pelanggan'] !== (int)$userId) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke data booking ini.');
            return redirect()->to('/riwayat-booking');
        }

        $settingModel = new \App\Models\SettingBookingModel();
        $setting      = $settingModel->getSettings();
        $durasiMenit  = (int)($setting['durasi_pembayaran_menit'] ?? 5);

        // Hitung sisa waktu dinamis berdasarkan pengaturan
        $createdAt = strtotime($booking['created_at'] ?? 'now');
        $now       = time();
        $elapsed   = $now - $createdAt;
        $maxTime   = $durasiMenit * 60; // detik
        $remaining = $maxTime - $elapsed;

        if ($booking['status_pembayaran'] === 'menunggu_pembayaran' && $remaining <= 0 && $booking['status_booking'] !== 'dibatalkan') {
            $this->bookingModel->update($idBooking, [
                'status_booking' => 'dibatalkan',
                'catatan_admin'  => "Batas waktu pembayaran {$durasiMenit} menit telah habis (Kadaluarsa)."
            ]);
            $booking['status_booking'] = 'dibatalkan';
            $remaining = 0;
        }

        $data = [
            'title'            => 'Pembayaran Booking Servis #' . $booking['kode_booking'],
            'booking'          => $booking,
            'durasiMenit'      => $durasiMenit,
            'maxSeconds'       => $maxTime,
            'remainingSeconds' => max(0, $remaining),
            'errors'           => session()->getFlashdata('errors') ?? [],
        ];

        return view('page/pelanggan/pembayaran_booking', $data);
    }

    /**
     * Proses Upload Bukti Pembayaran dari Halaman Pembayaran
     */
    public function prosesPembayaranBooking()
    {
        $idBooking = $this->request->getPost('id_booking');
        $booking   = $this->bookingModel->find($idBooking);

        if (!$booking) {
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/riwayat-booking');
        }

        // Cek apakah sisa waktu masih ada
        $createdAt = strtotime($booking['created_at'] ?? 'now');
        $now       = time();
        $elapsed   = $now - $createdAt;
        if ($elapsed > (5 * 60) && $booking['status_pembayaran'] === 'menunggu_pembayaran') {
            $this->bookingModel->update($idBooking, [
                'status_booking' => 'dibatalkan',
                'catatan_admin'  => 'Batas waktu pembayaran 5 menit telah habis (Kadaluarsa).'
            ]);
            session()->setFlashdata('error', 'Waktu pembayaran 5 menit telah habis. Booking Anda otomatis dibatalkan.');
            return redirect()->to('/riwayat-booking');
        }

        $rules = [
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]|max_size[bukti_pembayaran,3072]',
        ];

        $messages = [
            'bukti_pembayaran' => [
                'uploaded' => 'File struk / bukti transfer wajib diunggah.',
                'is_image' => 'File bukti pembayaran harus berupa gambar.',
                'mime_in'  => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
                'max_size' => 'Ukuran file maksimal 3MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileBukti = $this->request->getFile('bukti_pembayaran');
        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $uploadPath = ROOTPATH . 'public/uploads/bukti_pembayaran';
            if (!is_dir($uploadPath)) {
                @mkdir($uploadPath, 0777, true);
            }
            $namaBukti = $fileBukti->getRandomName();
            $fileBukti->move($uploadPath, $namaBukti);

            $this->bookingModel->update($idBooking, [
                'bukti_pembayaran'  => $namaBukti,
                'status_pembayaran' => 'menunggu_konfirmasi',
            ]);

            session()->setFlashdata('success', 'Bukti pembayaran berhasil diunggah! Admin akan memverifikasi pembayaran Anda.');
            return redirect()->to('/riwayat-booking');
        }

        session()->setFlashdata('error', 'Gagal mengunggah bukti pembayaran.');
        return redirect()->back();
    }

    /**
     * Endpoint AJAX untuk membatalkan booking jika timer 5 menit habis
     */
    public function expirateBooking()
    {
        $idBooking = $this->request->getPost('id_booking');
        $booking   = $this->bookingModel->find($idBooking);

        if ($booking && $booking['status_pembayaran'] === 'menunggu_pembayaran') {
            $this->bookingModel->update($idBooking, [
                'status_booking' => 'dibatalkan',
                'catatan_admin'  => 'Batas waktu pembayaran 5 menit telah habis (Kadaluarsa).'
            ]);
            return $this->response->setJSON(['status' => true, 'message' => 'Booking kadaluarsa.']);
        }

        return $this->response->setJSON(['status' => false]);
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
