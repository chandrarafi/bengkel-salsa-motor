<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'booking_servis';
    protected $primaryKey       = 'id_booking';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_booking',
        'id_pelanggan',
        'nama_pelanggan',
        'no_hp',
        'merkkendaraan',
        'nopol',
        'kodeservis',
        'jenis_servis',
        'biaya',
        'tgl_booking',
        'jam_booking',
        'keluhan',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
        'status_booking',
        'catatan_admin',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate Kode Booking Unik (Contoh: BKG-20260814-0001)
     */
    public function generateKodeBooking(): string
    {
        $prefix = 'BKG-' . date('Ymd') . '-';
        $lastBooking = $this->like('kode_booking', $prefix, 'after')
                            ->orderBy('id_booking', 'DESC')
                            ->first();

        if ($lastBooking && !empty($lastBooking['kode_booking'])) {
            $lastNumber = (int) substr($lastBooking['kode_booking'], -4);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix . $nextNumber;
    }

    /**
     * Hitung total booking yang menunggu konfirmasi/approval pembayaran
     */
    public function countPendingApproval(): int
    {
        return $this->where('status_pembayaran', 'menunggu_konfirmasi')->countAllResults();
    }

    /**
     * Otomatis membatalkan semua booking yang status_pembayaran masih 'menunggu_pembayaran'
     * dan sudah lewat lebih dari 5 menit (300 detik) sejak dibuat.
     */
    public function autoCancelExpiredBookings(): int
    {
        $thresholdTime = date('Y-m-d H:i:s', time() - (5 * 60));

        $builder = $this->builder();
        $builder->where('status_pembayaran', 'menunggu_pembayaran')
                ->where('status_booking !=', 'dibatalkan')
                ->where('created_at <=', $thresholdTime);

        $builder->update([
            'status_booking' => 'dibatalkan',
            'catatan_admin'  => 'Batas waktu pembayaran 5 menit telah habis (Kadaluarsa otomatis).'
        ]);

        return $this->db->affectedRows();
    }

    /**
     * Ambil riwayat booking milik pelanggan tertentu
     */
    public function getByPelanggan($userId = null, $userNama = null)
    {
        // Cancel expired ones first
        $this->autoCancelExpiredBookings();

        $builder = $this->builder();
        if ($userId) {
            $builder->groupStart()
                    ->where('id_pelanggan', $userId);
            if ($userNama) {
                $builder->orWhere('nama_pelanggan', $userNama);
            }
            $builder->groupEnd();
        } elseif ($userNama) {
            $builder->where('nama_pelanggan', $userNama);
        }

        return $builder->orderBy('created_at', 'DESC')
                       ->get()
                       ->getResultArray();
    }
}
