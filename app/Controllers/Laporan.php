<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\BookingModel;
use App\Models\DetailBarangMasukModel;
use App\Models\DetailPenjualanModel;
use App\Models\DetailTransaksiServisModel;
use App\Models\KategoriModel;
use App\Models\PenjualanModel;
use App\Models\ServisModel;
use App\Models\TransaksiServisModel;

class Laporan extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $servisModel;
    protected $barangMasukModel;
    protected $detailBarangMasukModel;
    protected $penjualanModel;
    protected $detailPenjualanModel;
    protected $bookingModel;
    protected $transaksiServisModel;
    protected $detailTransaksiServisModel;

    public function __construct()
    {
        $this->barangModel                = new BarangModel();
        $this->kategoriModel              = new KategoriModel();
        $this->servisModel                = new ServisModel();
        $this->barangMasukModel           = new BarangMasukModel();
        $this->detailBarangMasukModel     = new DetailBarangMasukModel();
        $this->penjualanModel             = new PenjualanModel();
        $this->detailPenjualanModel       = new DetailPenjualanModel();
        $this->bookingModel               = new BookingModel();
        $this->transaksiServisModel       = new TransaksiServisModel();
        $this->detailTransaksiServisModel = new DetailTransaksiServisModel();
    }

    public function barang()
    {
        $idKategori = $this->request->getGet('idkategori');

        $query = $this->barangModel->select('barang.*, kategori.namakategori, satuan.nama_satuan')
                                   ->join('kategori', 'kategori.idkategori = barang.idkategori', 'left')
                                   ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left');

        if (!empty($idKategori)) {
            $query->where('barang.idkategori', $idKategori);
        }

        $barang       = $query->orderBy('barang.created_at', 'DESC')->findAll();
        $kategoriList = $this->kategoriModel->orderBy('namakategori', 'ASC')->findAll();

        $selectedKategori = null;
        if (!empty($idKategori)) {
            $selectedKategori = $this->kategoriModel->find($idKategori);
        }

        // Calculate summary metrics
        $totalItems     = count($barang);
        $totalStok      = 0;
        $totalNilaiBeli = 0;
        $totalNilaiJual = 0;

        foreach ($barang as $item) {
            $stok           = (int)($item['stok'] ?? 0);
            $hargaBeli      = (float)($item['harga_beli'] ?? 0);
            $hargaJual      = (float)($item['harga_jual'] ?? 0);

            $totalStok      += $stok;
            $totalNilaiBeli += ($stok * $hargaBeli);
            $totalNilaiJual += ($stok * $hargaJual);
        }

        $data = [
            'title'            => 'Laporan Data Barang & Sparepart',
            'barang'           => $barang,
            'kategoriList'     => $kategoriList,
            'idkategori'       => $idKategori,
            'selectedKategori' => $selectedKategori,
            'totalItems'       => $totalItems,
            'totalStok'        => $totalStok,
            'totalNilaiBeli'   => $totalNilaiBeli,
            'totalNilaiJual'   => $totalNilaiJual,
        ];

        return view('page/content/laporan/barang', $data);
    }

    public function cetakBarang()
    {
        $idKategori = $this->request->getGet('idkategori');

        $query = $this->barangModel->select('barang.*, kategori.namakategori, satuan.nama_satuan')
                                   ->join('kategori', 'kategori.idkategori = barang.idkategori', 'left')
                                   ->join('satuan', 'satuan.idsatuan = barang.idsatuan', 'left');

        if (!empty($idKategori)) {
            $query->where('barang.idkategori', $idKategori);
        }

        $barang = $query->orderBy('barang.created_at', 'DESC')->findAll();

        $selectedKategori = null;
        if (!empty($idKategori)) {
            $selectedKategori = $this->kategoriModel->find($idKategori);
        }

        $totalItems     = count($barang);
        $totalStok      = 0;
        $totalNilaiBeli = 0;
        $totalNilaiJual = 0;

        foreach ($barang as $item) {
            $stok           = (int)($item['stok'] ?? 0);
            $hargaBeli      = (float)($item['harga_beli'] ?? 0);
            $hargaJual      = (float)($item['harga_jual'] ?? 0);

            $totalStok      += $stok;
            $totalNilaiBeli += ($stok * $hargaBeli);
            $totalNilaiJual += ($stok * $hargaJual);
        }

        $data = [
            'title'            => 'Laporan Data Barang & Sparepart',
            'barang'           => $barang,
            'idkategori'       => $idKategori,
            'selectedKategori' => $selectedKategori,
            'totalItems'       => $totalItems,
            'totalStok'        => $totalStok,
            'totalNilaiBeli'   => $totalNilaiBeli,
            'totalNilaiJual'   => $totalNilaiJual,
        ];

        return view('page/content/laporan/cetak_barang', $data);
    }

    public function servis()
    {
        $q = trim($this->request->getGet('q') ?? '');

        $query = $this->servisModel;

        if (!empty($q)) {
            $query->groupStart()
                  ->like('kodeservis', $q)
                  ->orLike('jenis_servis', $q)
                  ->orLike('keterangan', $q)
                  ->groupEnd();
        }

        $servisList = $query->orderBy('kodeservis', 'ASC')->findAll();

        $data = [
            'title'      => 'Laporan Data Jenis Servis & Jasa Bengkel',
            'servisList' => $servisList,
            'q'          => $q,
        ];

        return view('page/content/laporan/servis', $data);
    }

    public function cetakServis()
    {
        $q = trim($this->request->getGet('q') ?? '');

        $query = $this->servisModel;

        if (!empty($q)) {
            $query->groupStart()
                  ->like('kodeservis', $q)
                  ->orLike('jenis_servis', $q)
                  ->orLike('keterangan', $q)
                  ->groupEnd();
        }

        $servisList = $query->orderBy('kodeservis', 'ASC')->findAll();

        $data = [
            'title'      => 'Laporan Data Jenis Servis & Jasa Bengkel',
            'servisList' => $servisList,
            'q'          => $q,
        ];

        return view('page/content/laporan/cetak_servis', $data);
    }

    public function barangMasuk()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $query = $this->barangMasukModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tanggalfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tanggalfaktur) <=', $tglAkhir);
        }

        $barangMasukHeaders = $query->orderBy('tanggalfaktur', 'DESC')
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll();

        $dataLaporan  = [];
        $totalQtyAll  = 0;
        $totalNominal = 0;

        foreach ($barangMasukHeaders as $header) {
            $details = $this->detailBarangMasukModel->getDetailWithBarang($header['faktur']);
            
            $headerQty = 0;
            foreach ($details as $det) {
                $headerQty += (int)($det['jumlah'] ?? 0);
            }

            $totalQtyAll  += $headerQty;
            $totalNominal += (float)($header['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'    => $header,
                'details'   => $details,
                'headerQty' => $headerQty,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Barang Masuk',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'totalFaktur'  => count($dataLaporan),
            'totalQtyAll'  => $totalQtyAll,
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/barangmasuk', $data);
    }

    public function cetakBarangMasuk()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $query = $this->barangMasukModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tanggalfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tanggalfaktur) <=', $tglAkhir);
        }

        $barangMasukHeaders = $query->orderBy('tanggalfaktur', 'DESC')
                                    ->orderBy('created_at', 'DESC')
                                    ->findAll();

        $dataLaporan  = [];
        $totalQtyAll  = 0;
        $totalNominal = 0;

        foreach ($barangMasukHeaders as $header) {
            $details = $this->detailBarangMasukModel->getDetailWithBarang($header['faktur']);
            
            $headerQty = 0;
            foreach ($details as $det) {
                $headerQty += (int)($det['jumlah'] ?? 0);
            }

            $totalQtyAll  += $headerQty;
            $totalNominal += (float)($header['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'    => $header,
                'details'   => $details,
                'headerQty' => $headerQty,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Barang Masuk',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'totalFaktur'  => count($dataLaporan),
            'totalQtyAll'  => $totalQtyAll,
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/cetak_barangmasuk', $data);
    }

    public function penjualan()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $query = $this->penjualanModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tglfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tglfaktur) <=', $tglAkhir);
        }

        $penjualanHeaders = $query->orderBy('tglfaktur', 'DESC')
                                  ->orderBy('created_at', 'DESC')
                                  ->findAll();

        $dataLaporan  = [];
        $totalQtyAll  = 0;
        $totalNominal = 0;

        foreach ($penjualanHeaders as $header) {
            $details = $this->detailPenjualanModel->getDetailWithBarang($header['faktur']);
            
            $headerQty = 0;
            foreach ($details as $det) {
                $headerQty += (int)($det['jumlah'] ?? 0);
            }

            $totalQtyAll  += $headerQty;
            $totalNominal += (float)($header['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'    => $header,
                'details'   => $details,
                'headerQty' => $headerQty,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Penjualan Barang (POS)',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'totalFaktur'  => count($dataLaporan),
            'totalQtyAll'  => $totalQtyAll,
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/penjualan', $data);
    }

    public function cetakPenjualan()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');

        $query = $this->penjualanModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tglfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tglfaktur) <=', $tglAkhir);
        }

        $penjualanHeaders = $query->orderBy('tglfaktur', 'DESC')
                                  ->orderBy('created_at', 'DESC')
                                  ->findAll();

        $dataLaporan  = [];
        $totalQtyAll  = 0;
        $totalNominal = 0;

        foreach ($penjualanHeaders as $header) {
            $details = $this->detailPenjualanModel->getDetailWithBarang($header['faktur']);
            
            $headerQty = 0;
            foreach ($details as $det) {
                $headerQty += (int)($det['jumlah'] ?? 0);
            }

            $totalQtyAll  += $headerQty;
            $totalNominal += (float)($header['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'    => $header,
                'details'   => $details,
                'headerQty' => $headerQty,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Penjualan Barang (POS)',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'totalFaktur'  => count($dataLaporan),
            'totalQtyAll'  => $totalQtyAll,
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/cetak_penjualan', $data);
    }

    public function booking()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');
        $status   = $this->request->getGet('status_booking');

        $query = $this->bookingModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tgl_booking) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tgl_booking) <=', $tglAkhir);
        }

        if (!empty($status)) {
            $query->where('status_booking', $status);
        }

        $bookingList = $query->orderBy('tgl_booking', 'DESC')
                            ->orderBy('jam_booking', 'DESC')
                            ->findAll();

        $totalDP = 0;
        foreach ($bookingList as $b) {
            $totalDP += (float)($b['biaya'] ?? 0);
        }

        $data = [
            'title'          => 'Laporan Booking Servis Online',
            'bookingList'    => $bookingList,
            'tgl_awal'       => $tglAwal,
            'tgl_akhir'      => $tglAkhir,
            'status_booking' => $status,
            'totalBooking'   => count($bookingList),
            'totalDP'        => $totalDP,
        ];

        return view('page/content/laporan/booking', $data);
    }

    public function cetakBooking()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');
        $status   = $this->request->getGet('status_booking');

        $query = $this->bookingModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tgl_booking) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tgl_booking) <=', $tglAkhir);
        }

        if (!empty($status)) {
            $query->where('status_booking', $status);
        }

        $bookingList = $query->orderBy('tgl_booking', 'DESC')
                            ->orderBy('jam_booking', 'DESC')
                            ->findAll();

        $totalDP = 0;
        foreach ($bookingList as $b) {
            $totalDP += (float)($b['biaya'] ?? 0);
        }

        $data = [
            'title'          => 'Laporan Booking Servis Online',
            'bookingList'    => $bookingList,
            'tgl_awal'       => $tglAwal,
            'tgl_akhir'      => $tglAkhir,
            'status_booking' => $status,
            'totalBooking'   => count($bookingList),
            'totalDP'        => $totalDP,
        ];

        return view('page/content/laporan/cetak_booking', $data);
    }

    public function transaksiServis()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');
        $status   = $this->request->getGet('status');

        $query = $this->transaksiServisModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tglfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tglfaktur) <=', $tglAkhir);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $headers = $query->orderBy('tglfaktur', 'DESC')
                         ->orderBy('created_at', 'DESC')
                         ->findAll();

        $dataLaporan  = [];
        $totalNominal = 0;

        foreach ($headers as $h) {
            $details = $this->detailTransaksiServisModel->getDetailWithInfo($h['faktur']);
            $totalNominal += (float)($h['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'  => $h,
                'details' => $details,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Servis Bengkel',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'status'       => $status,
            'totalFaktur'  => count($dataLaporan),
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/transaksiservis', $data);
    }

    public function cetakTransaksiServis()
    {
        $tglAwal  = $this->request->getGet('tgl_awal');
        $tglAkhir = $this->request->getGet('tgl_akhir');
        $status   = $this->request->getGet('status');

        $query = $this->transaksiServisModel;

        if (!empty($tglAwal)) {
            $query->where('DATE(tglfaktur) >=', $tglAwal);
        }

        if (!empty($tglAkhir)) {
            $query->where('DATE(tglfaktur) <=', $tglAkhir);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $headers = $query->orderBy('tglfaktur', 'DESC')
                         ->orderBy('created_at', 'DESC')
                         ->findAll();

        $dataLaporan  = [];
        $totalNominal = 0;

        foreach ($headers as $h) {
            $details = $this->detailTransaksiServisModel->getDetailWithInfo($h['faktur']);
            $totalNominal += (float)($h['totalharga'] ?? 0);

            $dataLaporan[] = [
                'header'  => $h,
                'details' => $details,
            ];
        }

        $data = [
            'title'        => 'Laporan Transaksi Servis Bengkel',
            'dataLaporan'  => $dataLaporan,
            'tgl_awal'     => $tglAwal,
            'tgl_akhir'    => $tglAkhir,
            'status'       => $status,
            'totalFaktur'  => count($dataLaporan),
            'totalNominal' => $totalNominal,
        ];

        return view('page/content/laporan/cetak_transaksiservis', $data);
    }
}
