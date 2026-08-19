<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\ServisModel;

class Booking extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $servisModel;
    protected $db;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel    = new UserModel();
        $this->servisModel   = new ServisModel();
        $this->db           = \Config\Database::connect();
    }

    /**
     * Halaman Utama Pengelolaan Booking Servis (Admin Panel)
     */
    public function index()
    {
        // Auto cancel any overdue bookings older than 5 minutes
        $this->bookingModel->autoCancelExpiredBookings();

        $filterBayar   = $this->request->getGet('bayar');
        $filterBooking = $this->request->getGet('status');
        $search        = $this->request->getGet('q');

        $builder = $this->bookingModel->orderBy('created_at', 'DESC');

        if (!empty($filterBayar) && $filterBayar !== 'semua') {
            $builder->where('status_pembayaran', $filterBayar);
        }

        if (!empty($filterBooking) && $filterBooking !== 'semua') {
            $builder->where('status_booking', $filterBooking);
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('kode_booking', $search)
                    ->orLike('nama_pelanggan', $search)
                    ->orLike('no_hp', $search)
                    ->orLike('nopol', $search)
                    ->orLike('merkkendaraan', $search)
                    ->groupEnd();
        }

        $daftarBooking = $builder->findAll();

        // Ringkasan KPI Admin
        $totalSemua       = $this->bookingModel->countAllResults();
        $pendingApproval  = $this->bookingModel->where('status_pembayaran', 'menunggu_konfirmasi')->countAllResults();
        $totalLunas       = $this->bookingModel->where('status_pembayaran', 'lunas')->countAllResults();
        $totalSelesai     = $this->bookingModel->where('status_booking', 'selesai')->countAllResults();

        $data = [
            'title'            => 'Kelola Booking Servis & Pembayaran',
            'daftarBooking'    => $daftarBooking,
            'totalSemua'       => $totalSemua,
            'pendingApproval'  => $pendingApproval,
            'totalLunas'       => $totalLunas,
            'totalSelesai'     => $totalSelesai,
            'filterBayar'      => $filterBayar ?? 'semua',
            'filterBooking'    => $filterBooking ?? 'semua',
            'search'           => $search ?? '',
        ];

        return view('page/content/booking/index', $data);
    }

    /**
     * Detail Booking via JSON untuk Modal Admin
     */
    public function detail($id = null)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data booking tidak ditemukan.']);
        }

        $hasBukti = !empty($booking['bukti_pembayaran']) && file_exists(ROOTPATH . 'public/uploads/bukti_pembayaran/' . $booking['bukti_pembayaran']);
        $booking['bukti_url'] = $hasBukti ? base_url('uploads/bukti_pembayaran/' . $booking['bukti_pembayaran']) : null;

        return $this->response->setJSON([
            'status'  => true,
            'booking' => $booking,
        ]);
    }

    /**
     * Approve Bukti Pembayaran Booking (Ubah status_pembayaran = 'lunas' & status_booking = 'diterima')
     */
    public function approvePembayaran($id = null)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => false, 'message' => 'Data booking tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/admin/booking');
        }

        $this->bookingModel->update($id, [
            'status_pembayaran' => 'lunas',
            'status_booking'    => 'diterima',
            'catatan_admin'     => 'Pembayaran telah diverifikasi dan disetujui oleh admin.',
        ]);

        $msg = "Pembayaran Booking #{$booking['kode_booking']} berhasil disetujui (LUNAS). Jadwal servis berstatus DITERIMA.";

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => true, 'message' => $msg]);
        }

        session()->setFlashdata('success', $msg);
        return redirect()->to('/admin/booking');
    }

    /**
     * Tolak Bukti Pembayaran Booking (Ubah status_pembayaran = 'ditolak' & simpan catatan)
     */
    public function tolakPembayaran($id = null)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => false, 'message' => 'Data booking tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/admin/booking');
        }

        $catatan = $this->request->getPost('catatan_admin') ?? 'Bukti transfer tidak valid atau nominal tidak sesuai.';

        $this->bookingModel->update($id, [
            'status_pembayaran' => 'ditolak',
            'status_booking'    => 'dibatalkan',
            'catatan_admin'     => $catatan,
        ]);

        $msg = "Bukti pembayaran Booking #{$booking['kode_booking']} telah ditolak dan jadwal booking dibatalkan (slot jam dibuka kembali).";

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => true, 'message' => $msg]);
        }

        session()->setFlashdata('warning', $msg);
        return redirect()->to('/admin/booking');
    }

    /**
     * Update Status Progres Booking (Diterima, Diproses, Selesai, Dibatalkan)
     */
    public function updateStatus($id = null)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => false, 'message' => 'Data booking tidak ditemukan.']);
            }
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/admin/booking');
        }

        $statusBooking = $this->request->getPost('status_booking');
        $validStatus   = ['menunggu_konfirmasi', 'diterima', 'diproses', 'selesai', 'dibatalkan'];

        if (!in_array($statusBooking, $validStatus)) {
            session()->setFlashdata('error', 'Pilihan status booking tidak valid.');
            return redirect()->to('/admin/booking');
        }

        $this->bookingModel->update($id, [
            'status_booking' => $statusBooking,
        ]);

        $msg = "Status pengerjaan Booking #{$booking['kode_booking']} diperbarui menjadi: " . strtoupper($statusBooking);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => true, 'message' => $msg]);
        }

        session()->setFlashdata('success', $msg);
        return redirect()->to('/admin/booking');
    }

    /**
     * Hapus Data Booking Servis
     */
    public function hapus($id = null)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            session()->setFlashdata('error', 'Data booking tidak ditemukan.');
            return redirect()->to('/admin/booking');
        }

        // Hapus file bukti pembayaran jika ada
        if (!empty($booking['bukti_pembayaran'])) {
            $path = ROOTPATH . 'public/uploads/bukti_pembayaran/' . $booking['bukti_pembayaran'];
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $this->bookingModel->delete($id);

        session()->setFlashdata('success', "Data Booking #{$booking['kode_booking']} berhasil dihapus.");
        return redirect()->to('/admin/booking');
    }

    /**
     * Halaman Pengaturan / Setting Booking Servis
     */
    public function setting()
    {
        $settingModel = new \App\Models\SettingBookingModel();
        $setting = $settingModel->getSettings();

        $data = [
            'title'   => 'Pengaturan Booking Servis',
            'setting' => $setting,
            'errors'  => session()->getFlashdata('errors') ?? [],
        ];

        return view('page/content/booking/setting', $data);
    }

    /**
     * Simpan Perubahan Pengaturan Booking
     */
    public function updateSetting()
    {
        $rules = [
            'durasi_pembayaran_menit' => 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[180]',
            'biaya_booking'           => 'required|numeric|greater_than_equal_to[0]',
        ];

        $messages = [
            'durasi_pembayaran_menit' => [
                'required'               => 'Durasi waktu pembayaran wajib diisi.',
                'is_natural_no_zero'     => 'Durasi waktu pembayaran harus berupa angka lebih dari 0.',
                'greater_than_equal_to'  => 'Durasi waktu pembayaran minimal 1 menit.',
                'less_than_equal_to'     => 'Durasi waktu pembayaran maksimal 180 menit.',
            ],
            'biaya_booking' => [
                'required'              => 'Nominal biaya booking / DP wajib diisi.',
                'numeric'               => 'Biaya booking harus berupa angka.',
                'greater_than_equal_to' => 'Biaya booking tidak boleh bernilai negatif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $settingModel = new \App\Models\SettingBookingModel();
        $currentSetting = $settingModel->getSettings();

        $slotsPost = $this->request->getPost('slot_kuota');
        $cleanSlots = [];

        foreach (\App\Models\SettingBookingModel::$defaultSlots as $jam => $defVal) {
            $val = isset($slotsPost[$jam]) ? (int)$slotsPost[$jam] : $defVal;
            $cleanSlots[$jam] = max(1, min(50, $val)); // Min 1, Max 50 slot
        }

        $durasi = (int)$this->request->getPost('durasi_pembayaran_menit');
        $biaya  = (float)$this->request->getPost('biaya_booking');

        $settingModel->update($currentSetting['id'], [
            'durasi_pembayaran_menit' => $durasi,
            'biaya_booking'           => $biaya,
            'kuota_slot_json'         => json_encode($cleanSlots),
        ]);

        session()->setFlashdata('success', 'Pengaturan durasi pembayaran & kuota booking jam kedatangan berhasil disimpan!');
        return redirect()->to('/admin/booking/setting');
    }
}
