<?php

namespace App\Controllers;

use App\Models\BarangMasukModel;
use App\Models\DetailBarangMasukModel;
use App\Models\TempBarangMasukModel;
use App\Models\BarangModel;

class BarangMasuk extends BaseController
{
    protected $barangMasukModel;
    protected $detailBarangMasukModel;
    protected $tempBarangMasukModel;
    protected $barangModel;
    protected $db;

    public function __construct()
    {
        $this->barangMasukModel       = new BarangMasukModel();
        $this->detailBarangMasukModel = new DetailBarangMasukModel();
        $this->tempBarangMasukModel   = new TempBarangMasukModel();
        $this->barangModel            = new BarangModel();
        $this->db                     = \Config\Database::connect();
    }

    private function getSessionId()
    {
        return session_id() ?: 'sess_' . session()->get('user_id');
    }

    public function index()
    {
        $data = [
            'title'       => 'Transaksi Barang Masuk',
            'barangMasuk' => $this->barangMasukModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('page/content/form/barangmasuk/index', $data);
    }

    public function create()
    {
        $sessionId = $this->getSessionId();
        // Clear temp cart when opening create fresh
        $this->tempBarangMasukModel->where('session_id', $sessionId)->delete();

        // Auto-generate invoice number: BM-YYYYMMDD-001
        $todayPrefix = 'BM-' . date('Ymd') . '-';
        $lastRow = $this->barangMasukModel->like('faktur', $todayPrefix, 'after')
                                          ->orderBy('faktur', 'DESC')
                                          ->first();
        if ($lastRow) {
            $lastNum = (int)substr($lastRow['faktur'], -3);
            $nextNum = sprintf('%03d', $lastNum + 1);
        } else {
            $nextNum = '001';
        }
        $autoFaktur = $todayPrefix . $nextNum;

        $data = [
            'title'      => 'Tambah Transaksi Barang Masuk',
            'autoFaktur' => $autoFaktur,
            'barang'     => $this->barangModel->getBarangWithRelations(),
        ];

        return view('page/content/form/barangmasuk/create', $data);
    }

    public function edit($faktur = null)
    {
        $header = $this->barangMasukModel->find($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi barang masuk tidak ditemukan.');
            return redirect()->to('/admin/barangmasuk');
        }

        $sessionId = $this->getSessionId();

        // Clear temp table for current session
        $this->tempBarangMasukModel->where('session_id', $sessionId)->delete();

        // Copy existing invoice detail items into temp table
        $details = $this->detailBarangMasukModel->where('detfaktur', $faktur)->findAll();
        foreach ($details as $item) {
            $this->tempBarangMasukModel->insert([
                'session_id'      => $sessionId,
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $item['detailbrgkode'],
                'detailhargajual' => $item['detailhargajual'],
                'detailhargabeli' => $item['detailhargabeli'],
                'jumlah'          => $item['jumlah'],
                'subtotal'        => $item['subtotal'],
            ]);
        }

        $data = [
            'title'  => 'Edit Transaksi Barang Masuk',
            'header' => $header,
            'barang' => $this->barangModel->getBarangWithRelations(),
        ];

        return view('page/content/form/barangmasuk/edit', $data);
    }

    public function getTemp()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempBarangMasukModel->getTempWithBarang($sessionId);

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        return $this->response->setJSON([
            'status'     => true,
            'data'       => $tempData,
            'totalharga' => $totalHarga,
            'totalharga_formatted' => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
        ]);
    }

    public function addTemp()
    {
        $sessionId = $this->getSessionId();

        $rules = [
            'kode'            => 'required',
            'detailhargabeli' => 'required|numeric|greater_than_equal_to[0]',
            'detailhargajual' => 'required|numeric|greater_than_equal_to[0]',
            'jumlah'          => 'required|integer|greater_than[0]',
        ];

        $messages = [
            'kode' => [
                'required' => 'Pilih barang yang akan ditambahkan.',
            ],
            'detailhargabeli' => [
                'required'              => 'Harga beli wajib diisi.',
                'numeric'               => 'Harga beli harus berupa angka.',
                'greater_than_equal_to' => 'Harga beli tidak boleh negatif.',
            ],
            'detailhargajual' => [
                'required'              => 'Harga jual wajib diisi.',
                'numeric'               => 'Harga jual harus berupa angka.',
                'greater_than_equal_to' => 'Harga jual tidak boleh negatif.',
            ],
            'jumlah' => [
                'required'     => 'Jumlah barang wajib diisi.',
                'integer'      => 'Jumlah harus berupa angka bulat.',
                'greater_than' => 'Jumlah barang minimal 1.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi item gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $kode      = $this->request->getPost('kode');
        $hargaBeli = (float)$this->request->getPost('detailhargabeli');
        $hargaJual = (float)$this->request->getPost('detailhargajual');
        $jumlah    = (int)$this->request->getPost('jumlah');
        $subtotal  = $hargaBeli * $jumlah;

        $existing = $this->tempBarangMasukModel->where('session_id', $sessionId)
                                               ->where('detailbrgkode', $kode)
                                               ->first();
        if ($existing) {
            $newJumlah   = $existing['jumlah'] + $jumlah;
            $newSubtotal = $hargaBeli * $newJumlah;

            $this->tempBarangMasukModel->update($existing['id'], [
                'detailhargabeli' => $hargaBeli,
                'detailhargajual' => $hargaJual,
                'jumlah'          => $newJumlah,
                'subtotal'        => $newSubtotal,
            ]);
        } else {
            $this->tempBarangMasukModel->insert([
                'session_id'      => $sessionId,
                'detailbrgkode'   => $kode,
                'detailhargabeli' => $hargaBeli,
                'detailhargajual' => $hargaJual,
                'jumlah'          => $jumlah,
                'subtotal'        => $subtotal,
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item barang berhasil ditambahkan ke daftar sementara.',
        ]);
    }

    public function deleteTemp()
    {
        $id = $this->request->getPost('id');
        $this->tempBarangMasukModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item berhasil dihapus dari daftar sementara.',
        ]);
    }

    public function store()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempBarangMasukModel->getTempWithBarang($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Daftar barang masuk masih kosong. Silakan tambahkan minimal 1 item barang.',
            ]);
        }

        $rules = [
            'faktur'        => 'required|is_unique[barangmasuk.faktur]',
            'tanggalfaktur' => 'required|valid_date',
        ];

        $messages = [
            'faktur' => [
                'required'  => 'No. Faktur wajib diisi.',
                'is_unique' => 'No. Faktur sudah terdaftar.',
            ],
            'tanggalfaktur' => [
                'required'   => 'Tanggal faktur wajib diisi.',
                'valid_date' => 'Format tanggal tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi transaksi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $faktur        = strtoupper(trim($this->request->getPost('faktur')));
        $tanggalfaktur = $this->request->getPost('tanggalfaktur');
        $keterangan    = trim($this->request->getPost('keterangan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        $this->db->transStart();

        // 1. Insert header barangmasuk
        $this->barangMasukModel->insert([
            'faktur'        => $faktur,
            'tanggalfaktur' => $tanggalfaktur,
            'totalharga'    => $totalHarga,
            'keterangan'    => $keterangan,
        ]);

        // 2. Insert detail rows and update stock of each item in barang table
        foreach ($tempData as $row) {
            $this->detailBarangMasukModel->insert([
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'detailhargabeli' => $row['detailhargabeli'],
                'jumlah'          => $row['jumlah'],
                'subtotal'        => $row['subtotal'],
            ]);

            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $newStok = (int)$barang['stok'] + (int)$row['jumlah'];
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok'  => $newStok,
                    'harga' => $row['detailhargajual'],
                ]);
            }
        }

        // 3. Clear temporary cart for current session
        $this->tempBarangMasukModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal menyimpan transaksi barang masuk ke database.',
            ]);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Barang Masuk No. ' . $faktur . ' berhasil disimpan.',
            'redirect_url' => site_url('admin/barangmasuk'),
        ]);
    }

    public function update($faktur = null)
    {
        $header = $this->barangMasukModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi barang masuk tidak ditemukan.',
            ]);
        }

        $sessionId = $this->getSessionId();
        $tempData  = $this->tempBarangMasukModel->getTempWithBarang($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Daftar barang masuk tidak boleh kosong. Silakan tambahkan minimal 1 item barang.',
            ]);
        }

        $rules = [
            'tanggalfaktur' => 'required|valid_date',
        ];

        $messages = [
            'tanggalfaktur' => [
                'required'   => 'Tanggal faktur wajib diisi.',
                'valid_date' => 'Format tanggal tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi transaksi gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $tanggalfaktur = $this->request->getPost('tanggalfaktur');
        $keterangan    = trim($this->request->getPost('keterangan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        $this->db->transStart();

        // 1. Fetch old details and REVERT old stock
        $oldDetails = $this->detailBarangMasukModel->where('detfaktur', $faktur)->findAll();
        foreach ($oldDetails as $oldItem) {
            $barang = $this->barangModel->find($oldItem['detailbrgkode']);
            if ($barang) {
                $revertedStok = max(0, (int)$barang['stok'] - (int)$oldItem['jumlah']);
                $this->barangModel->update($oldItem['detailbrgkode'], ['stok' => $revertedStok]);
            }
        }

        // 2. Delete old details
        $this->detailBarangMasukModel->where('detfaktur', $faktur)->delete();

        // 3. Update header
        $this->barangMasukModel->update($faktur, [
            'tanggalfaktur' => $tanggalfaktur,
            'totalharga'    => $totalHarga,
            'keterangan'    => $keterangan,
        ]);

        // 4. Insert new details & apply new stock
        foreach ($tempData as $row) {
            $this->detailBarangMasukModel->insert([
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'detailhargabeli' => $row['detailhargabeli'],
                'jumlah'          => $row['jumlah'],
                'subtotal'        => $row['subtotal'],
            ]);

            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $newStok = (int)$barang['stok'] + (int)$row['jumlah'];
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok'  => $newStok,
                    'harga' => $row['detailhargajual'],
                ]);
            }
        }

        // 5. Clear temporary cart for current session
        $this->tempBarangMasukModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal memperbarui transaksi barang masuk.',
            ]);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Barang Masuk No. ' . $faktur . ' berhasil diperbarui.',
            'redirect_url' => site_url('admin/barangmasuk'),
        ]);
    }

    public function detail($faktur = null)
    {
        $header  = $this->barangMasukModel->find($faktur);
        $details = $this->detailBarangMasukModel->getDetailWithBarang($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi tidak ditemukan.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'header'  => $header,
            'details' => $details,
        ]);
    }

    public function cetak($faktur = null)
    {
        $header  = $this->barangMasukModel->find($faktur);
        $details = $this->detailBarangMasukModel->getDetailWithBarang($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi barang masuk tidak ditemukan.');
            return redirect()->to('/admin/barangmasuk');
        }

        $data = [
            'title'   => 'Faktur Pembelian Barang Masuk #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/barangmasuk/cetak', $data);
    }

    public function delete($faktur = null)
    {
        $header = $this->barangMasukModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi barang masuk tidak ditemukan.',
            ]);
        }

        $details = $this->detailBarangMasukModel->where('detfaktur', $faktur)->findAll();

        $this->db->transStart();

        // 1. Revert stock of each item in barang table
        foreach ($details as $row) {
            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $revertedStok = max(0, (int)$barang['stok'] - (int)$row['jumlah']);
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok' => $revertedStok,
                ]);
            }
        }

        // 2. Delete header (detail rows cascade on delete)
        $this->barangMasukModel->delete($faktur);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal menghapus transaksi barang masuk.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Transaksi Barang Masuk No. ' . $faktur . ' berhasil dihapus dan stok barang telah dikembalikan.',
        ]);
    }
}
