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
            'catatan_admin'     => $catatan,
        ]);

        $msg = "Bukti pembayaran Booking #{$booking['kode_booking']} telah ditolak.";

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
}
