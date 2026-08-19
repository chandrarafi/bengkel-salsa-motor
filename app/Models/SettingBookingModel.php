<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingBookingModel extends Model
{
    protected $table            = 'setting_booking';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'durasi_pembayaran_menit',
        'biaya_booking',
        'kuota_per_jam_default',
        'kuota_slot_json',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public static $defaultSlots = [
        '08:00' => 2,
        '09:00' => 2,
        '10:00' => 2,
        '11:00' => 2,
        '13:00' => 2,
        '14:00' => 2,
        '15:00' => 2,
        '16:00' => 2,
    ];

    /**
     * Ambil pengaturan booking (selalu 1 row)
     */
    public function getSettings()
    {
        $setting = $this->first();
        if (!$setting) {
            $defaultData = [
                'durasi_pembayaran_menit' => 5,
                'biaya_booking'           => 50000.00,
                'kuota_per_jam_default'   => 2,
                'kuota_slot_json'         => json_encode(self::$defaultSlots),
            ];
            $this->insert($defaultData);
            $setting = $this->first();
        }

        // Decode JSON slot
        $slots = [];
        if (!empty($setting['kuota_slot_json'])) {
            $decoded = json_decode($setting['kuota_slot_json'], true);
            if (is_array($decoded)) {
                $slots = $decoded;
            }
        }

        // Merge with defaults
        $setting['slots'] = array_merge(self::$defaultSlots, $slots);

        return $setting;
    }

    /**
     * Ambil kuota slot untuk jam tertentu
     */
    public function getQuotaForSlot(string $jam): int
    {
        $settings = $this->getSettings();
        $jamClean = substr(trim($jam), 0, 5); // Format 'HH:MM'
        return (int)($settings['slots'][$jamClean] ?? $settings['kuota_per_jam_default'] ?? 2);
    }

    /**
     * Dapatkan status ketersediaan kuota slot pada tanggal tertentu
     */
    public function getSlotAvailability(string $tanggal): array
    {
        $settings = $this->getSettings();
        $slotsConfig = $settings['slots'];

        $bookingModel = new \App\Models\BookingModel();
        // Auto cancel any expired bookings first
        $bookingModel->autoCancelExpiredBookings();

        // Ambil booking aktif di tanggal tersebut (tidak menghitung booking yang dibatalkan/ditolak)
        $db = \Config\Database::connect();
        $builder = $db->table('booking_servis');
        $activeBookings = $builder->select('jam_booking, COUNT(*) as total')
                                  ->where('tgl_booking', $tanggal)
                                  ->whereNotIn('status_booking', ['dibatalkan', 'ditolak'])
                                  ->whereNotIn('status_pembayaran', ['ditolak'])
                                  ->groupBy('jam_booking')
                                  ->get()
                                  ->getResultArray();

        $bookedMap = [];
        foreach ($activeBookings as $b) {
            $jamKey = substr(trim($b['jam_booking']), 0, 5);
            $bookedMap[$jamKey] = (int)$b['total'];
        }

        $todayStr = date('Y-m-d');
        $currentTimeStr = date('H:i');
        $isToday = ($tanggal === $todayStr);

        $result = [];
        foreach ($slotsConfig as $jam => $maxQuota) {
            $maxQuota = (int)$maxQuota;
            $bookedCount = $bookedMap[$jam] ?? 0;
            $sisa = max(0, $maxQuota - $bookedCount);
            $isPast = ($isToday && $jam <= $currentTimeStr);
            $isFull = ($bookedCount >= $maxQuota);

            $result[$jam] = [
                'jam'          => $jam,
                'max_kuota'    => $maxQuota,
                'booked_count' => $bookedCount,
                'sisa_kuota'   => $sisa,
                'is_full'      => $isFull,
                'is_past'      => $isPast,
                'is_available' => (!$isFull && !$isPast),
            ];
        }

        return $result;
    }
}
