<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\DetailPenjualanModel;
use App\Models\TempPenjualanModel;
use App\Models\BarangModel;

class Penjualan extends BaseController
{
    protected $penjualanModel;
    protected $detailPenjualanModel;
    protected $tempPenjualanModel;
    protected $barangModel;
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->penjualanModel       = new PenjualanModel();
        $this->detailPenjualanModel = new DetailPenjualanModel();
        $this->tempPenjualanModel   = new TempPenjualanModel();
        $this->barangModel          = new BarangModel();
        $this->userModel            = new \App\Models\UserModel();
        $this->db                   = \Config\Database::connect();
    }

    private function getSessionId()
    {
        return session_id() ?: 'sess_' . session()->get('user_id');
    }

    public function index()
    {
        $data = [
            'title'     => 'Transaksi Penjualan Barang',
            'penjualan' => $this->penjualanModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('page/content/form/penjualan/index', $data);
    }

    public function create()
    {
        $sessionId = $this->getSessionId();
        // Clear temp cart when opening create fresh
        $this->tempPenjualanModel->where('session_id', $sessionId)->delete();

        // Auto-generate invoice number: PJ-YYYYMMDD-001
        $todayPrefix = 'PJ-' . date('Ymd') . '-';
        $lastRow = $this->penjualanModel->like('faktur', $todayPrefix, 'after')
                                        ->orderBy('faktur', 'DESC')
                                        ->first();
        if ($lastRow) {
            $lastNum = (int)substr($lastRow['faktur'], -3);
            $nextNum = sprintf('%03d', $lastNum + 1);
        } else {
            $nextNum = '001';
        }
        $autoFaktur = $todayPrefix . $nextNum;

        // Fetch users with level 'pelanggan'
        $pelangganList = $this->userModel->whereIn('level', ['pelanggan', 'Pelanggan'])
                                         ->orderBy('nama', 'ASC')
                                         ->findAll();

        $data = [
            'title'         => 'Tambah Transaksi Penjualan',
            'autoFaktur'    => $autoFaktur,
            'barang'        => $this->barangModel->getBarangWithRelations(),
            'pelangganList' => $pelangganList,
        ];

        return view('page/content/form/penjualan/create', $data);
    }

    public function edit($faktur = null)
    {
        $header = $this->penjualanModel->find($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi penjualan tidak ditemukan.');
            return redirect()->to('/admin/penjualan');
        }

        if ($header['status'] === 'selesai') {
            session()->setFlashdata('error', 'Transaksi yang sudah diselesaikan (Lunas) tidak dapat diedit kembali.');
            return redirect()->to('/admin/penjualan');
        }

        $sessionId = $this->getSessionId();

        // Clear temp table for current session
        $this->tempPenjualanModel->where('session_id', $sessionId)->delete();

        // Copy existing invoice detail items into temp table
        $details = $this->detailPenjualanModel->where('detfaktur', $faktur)->findAll();
        foreach ($details as $item) {
            $this->tempPenjualanModel->insert([
                'session_id'      => $sessionId,
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $item['detailbrgkode'],
                'detailhargajual' => $item['detailhargajual'],
                'jumlah'          => $item['jumlah'],
                'subtotal'        => $item['subtotal'],
            ]);
        }

        // Fetch users with level 'pelanggan'
        $pelangganList = $this->userModel->whereIn('level', ['pelanggan', 'Pelanggan'])
                                         ->orderBy('nama', 'ASC')
                                         ->findAll();

        $data = [
            'title'         => 'Edit Transaksi Penjualan',
            'header'        => $header,
            'barang'        => $this->barangModel->getBarangWithRelations(),
            'pelangganList' => $pelangganList,
        ];

        return view('page/content/form/penjualan/edit', $data);
    }

    public function getTemp()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempPenjualanModel->getTempWithBarang($sessionId);

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        return $this->response->setJSON([
            'status'               => true,
            'data'                 => $tempData,
            'totalharga'           => $totalHarga,
            'totalharga_formatted' => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
        ]);
    }

    public function addTemp()
    {
        $sessionId = $this->getSessionId();

        $rules = [
            'kode'            => 'required',
            'detailhargajual' => 'required|numeric|greater_than_equal_to[0]',
            'jumlah'          => 'required|integer|greater_than[0]',
        ];

        $messages = [
            'kode' => [
                'required' => 'Pilih barang yang akan dijual.',
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
        $hargaJual = (float)$this->request->getPost('detailhargajual');
        $jumlah    = (int)$this->request->getPost('jumlah');

        // Check available stock in barang table
        $barang = $this->barangModel->find($kode);
        if (!$barang) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data barang tidak ditemukan.',
            ]);
        }

        $stokTersedia = (int)$barang['stok'];

        // Check if item already exists in temp cart for current session
        $existing = $this->tempPenjualanModel->where('session_id', $sessionId)
                                             ->where('detailbrgkode', $kode)
                                             ->first();
        $totalRequestedQty = $jumlah + ($existing ? (int)$existing['jumlah'] : 0);

        if ($totalRequestedQty > $stokTersedia) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Stok barang "' . $barang['nama_barng'] . '" tidak mencukupi. Stok sisa: ' . $stokTersedia . '.',
            ]);
        }

        $subtotal = $hargaJual * $totalRequestedQty;

        if ($existing) {
            $this->tempPenjualanModel->update($existing['id'], [
                'detailhargajual' => $hargaJual,
                'jumlah'          => $totalRequestedQty,
                'subtotal'        => $subtotal,
            ]);
        } else {
            $this->tempPenjualanModel->insert([
                'session_id'      => $sessionId,
                'detailbrgkode'   => $kode,
                'detailhargajual' => $hargaJual,
                'jumlah'          => $jumlah,
                'subtotal'        => $hargaJual * $jumlah,
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item barang berhasil ditambahkan ke keranjang.',
        ]);
    }

    public function deleteTemp()
    {
        $id = $this->request->getPost('id');
        $this->tempPenjualanModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item berhasil dihapus dari keranjang.',
        ]);
    }

    public function store()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempPenjualanModel->getTempWithBarang($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Keranjang penjualan masih kosong. Silakan tambahkan minimal 1 item barang.',
            ]);
        }

        $rules = [
            'faktur'    => 'required|is_unique[penjualan.faktur]',
            'tglfaktur' => 'required|valid_date',
        ];

        $messages = [
            'faktur' => [
                'required'  => 'No. Faktur wajib diisi.',
                'is_unique' => 'No. Faktur sudah terdaftar.',
            ],
            'tglfaktur' => [
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
        $tglfaktur     = $this->request->getPost('tglfaktur');
        $namaPelanggan = trim($this->request->getPost('nama_pelanggan')) ?: 'Pelanggan Umum';
        $keterangan    = trim($this->request->getPost('keterangan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        // Final stock check before saving
        foreach ($tempData as $row) {
            $barang = $this->barangModel->find($row['detailbrgkode']);
            if (!$barang || (int)$barang['stok'] < (int)$row['jumlah']) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Stok barang "' . ($barang['nama_barng'] ?? $row['detailbrgkode']) . '" tidak mencukupi untuk diproses.',
                ]);
            }
        }

        $this->db->transStart();

        // 1. Insert header penjualan with status 'pending'
        $this->penjualanModel->insert([
            'faktur'         => $faktur,
            'tglfaktur'      => $tglfaktur,
            'nama_pelanggan' => $namaPelanggan,
            'totalharga'     => $totalHarga,
            'bayar'          => 0,
            'kembali'        => 0,
            'keterangan'     => $keterangan,
            'status'         => 'pending',
        ]);

        // 2. Insert detail rows and DEDUCT stock of each item in barang table
        foreach ($tempData as $row) {
            $this->detailPenjualanModel->insert([
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'jumlah'          => $row['jumlah'],
                'subtotal'        => $row['subtotal'],
            ]);

            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $newStok = max(0, (int)$barang['stok'] - (int)$row['jumlah']);
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok' => $newStok,
                ]);
            }
        }

        // 3. Clear temporary cart for current session
        $this->tempPenjualanModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal menyimpan transaksi penjualan ke database.',
            ]);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Penjualan No. ' . $faktur . ' berhasil disimpan.',
            'show_url'     => site_url('admin/penjualan/show/' . $faktur),
            'redirect_url' => site_url('admin/penjualan'),
        ]);
    }

    public function show($faktur = null)
    {
        $header  = $this->penjualanModel->find($faktur);
        $details = $this->detailPenjualanModel->getDetailWithBarang($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi penjualan tidak ditemukan.');
            return redirect()->to('/admin/penjualan');
        }

        $data = [
            'title'   => 'Detail Penjualan #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/penjualan/show', $data);
    }

    public function pay()
    {
        $faktur = strtoupper(trim($this->request->getPost('faktur')));
        $header = $this->penjualanModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi penjualan tidak ditemukan.',
            ]);
        }

        if (($header['status'] ?? '') === 'selesai') {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Transaksi No. ' . $faktur . ' sudah diselesaikan sebelumnya.',
            ]);
        }

        $rules = [
            'bayar' => 'required|numeric|greater_than_equal_to[0]',
        ];

        $messages = [
            'bayar' => [
                'required'              => 'Uang pembayaran wajib diisi.',
                'numeric'               => 'Uang bayar harus berupa angka.',
                'greater_than_equal_to' => 'Uang bayar tidak boleh bernilai negatif.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi pembayaran gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $bayar      = (float)$this->request->getPost('bayar');
        $totalHarga = (float)$header['totalharga'];

        if ($bayar < $totalHarga) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Uang pembayaran (Rp ' . number_format($bayar, 0, ',', '.') . ') kurang dari Total Penjualan (Rp ' . number_format($totalHarga, 0, ',', '.') . ').',
            ]);
        }

        $kembali = $bayar - $totalHarga;

        $this->penjualanModel->update($faktur, [
            'status'  => 'selesai',
            'bayar'   => $bayar,
            'kembali' => $kembali,
        ]);

        return $this->response->setJSON([
            'status'    => true,
            'message'   => 'Transaksi Penjualan No. ' . $faktur . ' berhasil diselesaikan (Lunas).',
            'cetak_url' => site_url('admin/penjualan/cetak/' . $faktur),
        ]);
    }

    public function update($faktur = null)
    {
        $header = $this->penjualanModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi penjualan tidak ditemukan.',
            ]);
        }

        if (($header['status'] ?? '') === 'selesai') {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Transaksi yang sudah diselesaikan (Lunas) tidak dapat diubah.',
            ]);
        }

        $sessionId = $this->getSessionId();
        $tempData  = $this->tempPenjualanModel->getTempWithBarang($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Keranjang penjualan tidak boleh kosong.',
            ]);
        }

        $rules = [
            'tglfaktur' => 'required|valid_date',
        ];

        $messages = [
            'tglfaktur' => [
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

        $tglfaktur     = $this->request->getPost('tglfaktur');
        $namaPelanggan = trim($this->request->getPost('nama_pelanggan')) ?: 'Pelanggan Umum';
        $keterangan    = trim($this->request->getPost('keterangan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['subtotal'];
        }

        $this->db->transStart();

        // 1. Fetch old details and REVERT/RESTORE old stock
        $oldDetails = $this->detailPenjualanModel->where('detfaktur', $faktur)->findAll();
        foreach ($oldDetails as $oldItem) {
            $barang = $this->barangModel->find($oldItem['detailbrgkode']);
            if ($barang) {
                $restoredStok = (int)$barang['stok'] + (int)$oldItem['jumlah'];
                $this->barangModel->update($oldItem['detailbrgkode'], ['stok' => $restoredStok]);
            }
        }

        // 2. Delete old details
        $this->detailPenjualanModel->where('detfaktur', $faktur)->delete();

        // 3. Update header
        $this->penjualanModel->update($faktur, [
            'tglfaktur'      => $tglfaktur,
            'nama_pelanggan' => $namaPelanggan,
            'totalharga'     => $totalHarga,
            'keterangan'     => $keterangan,
        ]);

        // 4. Insert new details & DEDUCT new stock
        foreach ($tempData as $row) {
            $this->detailPenjualanModel->insert([
                'detfaktur'       => $faktur,
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'jumlah'          => $row['jumlah'],
                'subtotal'        => $row['subtotal'],
            ]);

            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $newStok = max(0, (int)$barang['stok'] - (int)$row['jumlah']);
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok' => $newStok,
                ]);
            }
        }

        // 5. Clear temporary cart for current session
        $this->tempPenjualanModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal memperbarui transaksi penjualan.',
            ]);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Penjualan No. ' . $faktur . ' berhasil diperbarui.',
            'redirect_url' => site_url('admin/penjualan'),
        ]);
    }

    public function detail($faktur = null)
    {
        $header  = $this->penjualanModel->find($faktur);
        $details = $this->detailPenjualanModel->getDetailWithBarang($faktur);

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
        $header  = $this->penjualanModel->find($faktur);
        $details = $this->detailPenjualanModel->getDetailWithBarang($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi penjualan tidak ditemukan.');
            return redirect()->to('/admin/penjualan');
        }

        $data = [
            'title'   => 'Nota Struk Penjualan #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/penjualan/cetak', $data);
    }

    public function delete($faktur = null)
    {
        $header = $this->penjualanModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi penjualan tidak ditemukan.',
            ]);
        }

        if (($header['status'] ?? '') === 'selesai') {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Transaksi yang sudah diselesaikan (Lunas) tidak dapat dihapus.',
            ]);
        }

        $details = $this->detailPenjualanModel->where('detfaktur', $faktur)->findAll();

        $this->db->transStart();

        // 1. Restore stock of each item in barang table
        foreach ($details as $row) {
            $barang = $this->barangModel->find($row['detailbrgkode']);
            if ($barang) {
                $restoredStok = (int)$barang['stok'] + (int)$row['jumlah'];
                $this->barangModel->update($row['detailbrgkode'], [
                    'stok' => $restoredStok,
                ]);
            }
        }

        // 2. Delete header (detail rows cascade on delete)
        $this->penjualanModel->delete($faktur);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal menghapus transaksi penjualan.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Transaksi Penjualan No. ' . $faktur . ' berhasil dihapus dan stok barang telah dikembalikan.',
        ]);
    }
}
