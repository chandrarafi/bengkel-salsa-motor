<?php

namespace App\Controllers;

use App\Models\TransaksiServisModel;
use App\Models\DetailTransaksiServisModel;
use App\Models\TempTransaksiServisModel;
use App\Models\ServisModel;
use App\Models\BarangModel;
use App\Models\UserModel;

class TransaksiServis extends BaseController
{
    protected $transaksiServisModel;
    protected $detailTransaksiServisModel;
    protected $tempTransaksiServisModel;
    protected $servisModel;
    protected $barangModel;
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->transaksiServisModel       = new TransaksiServisModel();
        $this->detailTransaksiServisModel = new DetailTransaksiServisModel();
        $this->tempTransaksiServisModel   = new TempTransaksiServisModel();
        $this->servisModel               = new ServisModel();
        $this->barangModel               = new BarangModel();
        $this->userModel                 = new UserModel();
        $this->db                        = \Config\Database::connect();
    }

    private function getSessionId()
    {
        $session = session();
        if (!$session->has('cart_session_id')) {
            $session->set('cart_session_id', md5(uniqid(rand(), true)));
        }
        return $session->get('cart_session_id');
    }

    private function generateFaktur()
    {
        $today = date('Ymd');
        $prefix = 'SV-' . $today . '-';
        
        $last = $this->transaksiServisModel->like('faktur', $prefix, 'after')
                                            ->orderBy('faktur', 'DESC')
                                            ->first();

        if ($last) {
            $lastNo = (int)substr($last['faktur'], -3);
            $nextNo = sprintf('%03d', $lastNo + 1);
        } else {
            $nextNo = '001';
        }

        return $prefix . $nextNo;
    }

    public function index()
    {
        $data = [
            'title'           => 'Riwayat Transaksi Servis',
            'transaksiServis' => $this->transaksiServisModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('page/content/form/transaksiservis/index', $data);
    }

    public function create()
    {
        $sessionId = $this->getSessionId();

        // Clear temp cart for fresh entry
        $this->tempTransaksiServisModel->where('session_id', $sessionId)->delete();

        // Fetch users with level 'pelanggan'
        $pelangganList = $this->userModel->whereIn('level', ['pelanggan', 'Pelanggan'])
                                         ->orderBy('nama', 'ASC')
                                         ->findAll();

        $data = [
            'title'         => 'Transaksi Servis Baru (Work Order)',
            'autoFaktur'    => $this->generateFaktur(),
            'servisList'    => $this->servisModel->orderBy('jenis_servis', 'ASC')->findAll(),
            'barangList'    => $this->barangModel->getBarangWithRelations(),
            'pelangganList' => $pelangganList,
        ];

        return view('page/content/form/transaksiservis/create', $data);
    }

    public function getTemp()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempTransaksiServisModel->getTempWithInfo($sessionId);

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['dettotaljual'];
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
        $type      = $this->request->getPost('type'); // 'servis' or 'barang'

        if ($type === 'servis') {
            $kodeServis = $this->request->getPost('detserviskode');
            $biaya      = (float)$this->request->getPost('detbiaya');

            if (!$kodeServis) {
                return $this->response->setJSON(['status' => false, 'message' => 'Pilih jenis jasa servis terlebih dahulu.']);
            }

            $servis = $this->servisModel->find($kodeServis);
            if (!$servis) {
                return $this->response->setJSON(['status' => false, 'message' => 'Data jasa servis tidak ditemukan.']);
            }

            // Check if already in temp
            $existing = $this->tempTransaksiServisModel->where('session_id', $sessionId)
                                                        ->where('detserviskode', $kodeServis)
                                                        ->first();
            if ($existing) {
                $this->tempTransaksiServisModel->update($existing['id'], [
                    'detbiaya'     => $biaya,
                    'dettotaljual' => $biaya,
                ]);
            } else {
                $this->tempTransaksiServisModel->insert([
                    'session_id'      => $sessionId,
                    'detserviskode'   => $kodeServis,
                    'detbiaya'        => $biaya,
                    'detailbrgkode'   => null,
                    'detailhargajual' => 0,
                    'detjml'          => 1,
                    'dettotaljual'    => $biaya,
                ]);
            }
        } else {
            // Sparepart / Barang item
            $kodeBarang = $this->request->getPost('detailbrgkode');
            $hargaJual  = (float)$this->request->getPost('detailhargajual');
            $jumlah     = (int)$this->request->getPost('detjml');

            if (!$kodeBarang || $jumlah <= 0) {
                return $this->response->setJSON(['status' => false, 'message' => 'Pilih sparepart dan jumlah yang valid.']);
            }

            $barang = $this->barangModel->find($kodeBarang);
            if (!$barang) {
                return $this->response->setJSON(['status' => false, 'message' => 'Data sparepart tidak ditemukan.']);
            }

            $stokTersedia = (int)$barang['stok'];
            $existing = $this->tempTransaksiServisModel->where('session_id', $sessionId)
                                                        ->where('detailbrgkode', $kodeBarang)
                                                        ->first();
            $requestedQty = $jumlah + ($existing ? (int)$existing['detjml'] : 0);

            if ($requestedQty > $stokTersedia) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Stok sparepart "' . $barang['nama_barng'] . '" tidak mencukupi. Stok sisa: ' . $stokTersedia . '.',
                ]);
            }

            $subtotal = $hargaJual * $requestedQty;

            if ($existing) {
                $this->tempTransaksiServisModel->update($existing['id'], [
                    'detailhargajual' => $hargaJual,
                    'detjml'          => $requestedQty,
                    'dettotaljual'    => $subtotal,
                ]);
            } else {
                $this->tempTransaksiServisModel->insert([
                    'session_id'      => $sessionId,
                    'detserviskode'   => null,
                    'detbiaya'        => 0,
                    'detailbrgkode'   => $kodeBarang,
                    'detailhargajual' => $hargaJual,
                    'detjml'          => $jumlah,
                    'dettotaljual'    => $hargaJual * $jumlah,
                ]);
            }
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item servis/sparepart berhasil ditambahkan.',
        ]);
    }

    public function deleteTemp()
    {
        $id = $this->request->getPost('id');
        $this->tempTransaksiServisModel->delete($id);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Item berhasil dihapus dari daftar.',
        ]);
    }

    public function store()
    {
        $sessionId = $this->getSessionId();
        $tempData  = $this->tempTransaksiServisModel->getTempWithInfo($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Daftar jasa servis & sparepart masih kosong. Tambahkan minimal 1 item.',
            ]);
        }

        $rules = [
            'faktur'        => 'required|is_unique[transaksi_servis.faktur]',
            'tglfaktur'     => 'required|valid_date',
            'merkkendaraan' => 'required',
            'nopol'         => 'required',
        ];

        $messages = [
            'faktur' => [
                'required'  => 'No. Faktur wajib diisi.',
                'is_unique' => 'No. Faktur sudah terdaftar.',
            ],
            'tglfaktur' => [
                'required'   => 'Tanggal transaksi wajib diisi.',
                'valid_date' => 'Format tanggal tidak valid.',
            ],
            'merkkendaraan' => [
                'required' => 'Merk / tipe kendaraan wajib diisi.',
            ],
            'nopol' => [
                'required' => 'Nomor polisi (plat motor) wajib diisi.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi transaksi servis gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $faktur        = strtoupper(trim($this->request->getPost('faktur')));
        $tglfaktur     = $this->request->getPost('tglfaktur');
        $namaPelanggan = trim($this->request->getPost('nama_pelanggan')) ?: 'Pelanggan Umum';
        $merkkendaraan = trim($this->request->getPost('merkkendaraan'));
        $nopol         = strtoupper(trim($this->request->getPost('nopol')));
        $alasan        = trim($this->request->getPost('alasan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['dettotaljual'];
        }

        // Final stock check for spareparts
        foreach ($tempData as $row) {
            if (!empty($row['detailbrgkode'])) {
                $barang = $this->barangModel->find($row['detailbrgkode']);
                if (!$barang || (int)$barang['stok'] < (int)$row['detjml']) {
                    return $this->response->setJSON([
                        'status'  => false,
                        'message' => 'Stok sparepart "' . ($barang['nama_barng'] ?? $row['detailbrgkode']) . '" tidak mencukupi.',
                    ]);
                }
            }
        }

        $this->db->transStart();

        // 1. Insert header transaksi_servis
        $this->transaksiServisModel->insert([
            'faktur'         => $faktur,
            'tglfaktur'      => $tglfaktur,
            'nama_pelanggan' => $namaPelanggan,
            'merkkendaraan' => $merkkendaraan,
            'nopol'          => $nopol,
            'alasan'         => $alasan,
            'totalharga'     => $totalHarga,
            'bayar'          => 0,
            'kembali'        => 0,
            'status'         => 'antri',
        ]);

        // 2. Insert detail rows and DEDUCT sparepart stock if applicable
        foreach ($tempData as $row) {
            $this->detailTransaksiServisModel->insert([
                'detfaktur'       => $faktur,
                'detserviskode'   => $row['detserviskode'],
                'detbiaya'        => $row['detbiaya'],
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'detjml'          => $row['detjml'],
                'dettotaljual'    => $row['dettotaljual'],
            ]);

            if (!empty($row['detailbrgkode'])) {
                $barang = $this->barangModel->find($row['detailbrgkode']);
                if ($barang) {
                    $newStok = max(0, (int)$barang['stok'] - (int)$row['detjml']);
                    $this->barangModel->update($row['detailbrgkode'], ['stok' => $newStok]);
                }
            }
        }

        // 3. Clear temporary cart
        $this->tempTransaksiServisModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Gagal menyimpan transaksi servis ke database.',
            ]);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Servis No. ' . $faktur . ' berhasil disimpan.',
            'show_url'     => site_url('admin/transaksiservis/show/' . $faktur),
            'redirect_url' => site_url('admin/transaksiservis'),
        ]);
    }

    public function show($faktur = null)
    {
        $header  = $this->transaksiServisModel->find($faktur);
        $details = $this->detailTransaksiServisModel->getDetailWithInfo($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi servis tidak ditemukan.');
            return redirect()->to('/admin/transaksiservis');
        }

        $data = [
            'title'   => 'Detail Transaksi Servis #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/transaksiservis/show', $data);
    }

    public function pay()
    {
        $faktur = strtoupper(trim($this->request->getPost('faktur')));
        $header = $this->transaksiServisModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi servis tidak ditemukan.',
            ]);
        }

        if ((float)($header['bayar'] ?? 0) > 0) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Transaksi Servis No. ' . $faktur . ' sudah pernah dilunasi sebelumnya.',
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

        if (strtolower($header['status']) !== 'selesai') {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Pembayaran hanya dapat dilakukan jika status pengerjaan servis telah "Selesai". Silakan ubah status servis terlebih dahulu.',
            ]);
        }

        if ($bayar < $totalHarga) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Uang pembayaran (Rp ' . number_format($bayar, 0, ',', '.') . ') kurang dari Total Biaya Servis (Rp ' . number_format($totalHarga, 0, ',', '.') . ').',
            ]);
        }

        $kembali = $bayar - $totalHarga;

        $this->transaksiServisModel->update($faktur, [
            'status'  => 'selesai',
            'bayar'   => $bayar,
            'kembali' => $kembali,
        ]);

        return $this->response->setJSON([
            'status'    => true,
            'message'   => 'Pembayaran Transaksi Servis No. ' . $faktur . ' berhasil diproses.',
            'cetak_url' => site_url('admin/transaksiservis/cetak/' . $faktur),
        ]);
    }

    public function updateStatus()
    {
        $faktur = $this->request->getPost('faktur');
        $status = strtolower(trim($this->request->getPost('status')));

        $validStatuses = ['antri', 'pending', 'proses', 'selesai', 'batal'];
        if (!in_array($status, $validStatuses)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Status servis tidak valid.',
            ]);
        }

        $header = $this->transaksiServisModel->find($faktur);
        if (!$header) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Data transaksi servis tidak ditemukan.',
            ]);
        }

        $this->transaksiServisModel->update($faktur, [
            'status' => $status,
        ]);

        $statusLabels = [
            'antri'   => 'Antri / Menunggu',
            'pending' => 'Antri / Menunggu',
            'proses'  => 'Sedang Dikerjakan',
            'selesai' => 'Selesai',
            'batal'   => 'Dibatalkan',
        ];

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Status servis untuk No. Faktur ' . $faktur . ' berhasil diubah menjadi "' . ($statusLabels[$status] ?? $status) . '".',
        ]);
    }

    public function edit($faktur = null)
    {
        $header = $this->transaksiServisModel->find($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi servis tidak ditemukan.');
            return redirect()->to('/admin/transaksiservis');
        }

        if ($header['status'] === 'selesai') {
            session()->setFlashdata('error', 'Transaksi servis yang sudah diselesaikan (Lunas) tidak dapat diedit kembali.');
            return redirect()->to('/admin/transaksiservis');
        }

        $sessionId = $this->getSessionId();

        // Clear temp table for current session
        $this->tempTransaksiServisModel->where('session_id', $sessionId)->delete();

        // Copy existing detail items into temp table
        $details = $this->detailTransaksiServisModel->where('detfaktur', $faktur)->findAll();
        foreach ($details as $item) {
            $this->tempTransaksiServisModel->insert([
                'session_id'      => $sessionId,
                'detfaktur'       => $faktur,
                'detserviskode'   => $item['detserviskode'],
                'detbiaya'        => $item['detbiaya'],
                'detailbrgkode'   => $item['detailbrgkode'],
                'detailhargajual' => $item['detailhargajual'],
                'detjml'          => $item['detjml'],
                'dettotaljual'    => $item['dettotaljual'],
            ]);
        }

        $pelangganList = $this->userModel->whereIn('level', ['pelanggan', 'Pelanggan'])
                                         ->orderBy('nama', 'ASC')
                                         ->findAll();

        $data = [
            'title'         => 'Edit Transaksi Servis #' . $faktur,
            'header'        => $header,
            'servisList'    => $this->servisModel->orderBy('jenis_servis', 'ASC')->findAll(),
            'barangList'    => $this->barangModel->getBarangWithRelations(),
            'pelangganList' => $pelangganList,
        ];

        return view('page/content/form/transaksiservis/edit', $data);
    }

    public function update($faktur = null)
    {
        $header = $this->transaksiServisModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data transaksi servis tidak ditemukan.']);
        }

        if (($header['status'] ?? '') === 'selesai') {
            return $this->response->setJSON(['status' => false, 'message' => 'Transaksi servis yang sudah diselesaikan tidak dapat diubah.']);
        }

        $sessionId = $this->getSessionId();
        $tempData  = $this->tempTransaksiServisModel->getTempWithInfo($sessionId);

        if (empty($tempData)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Daftar servis/sparepart tidak boleh kosong.']);
        }

        $rules = [
            'tglfaktur'     => 'required|valid_date',
            'merkkendaraan' => 'required',
            'nopol'         => 'required',
        ];

        $messages = [
            'tglfaktur'     => ['required' => 'Tanggal transaksi wajib diisi.', 'valid_date' => 'Format tanggal tidak valid.'],
            'merkkendaraan' => ['required' => 'Merk kendaraan wajib diisi.'],
            'nopol'         => ['required' => 'Nomor polisi kendaraan wajib diisi.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validasi transaksi servis gagal.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $tglfaktur     = $this->request->getPost('tglfaktur');
        $namaPelanggan = trim($this->request->getPost('nama_pelanggan')) ?: 'Pelanggan Umum';
        $merkkendaraan = trim($this->request->getPost('merkkendaraan'));
        $nopol         = strtoupper(trim($this->request->getPost('nopol')));
        $alasan        = trim($this->request->getPost('alasan'));

        $totalHarga = 0;
        foreach ($tempData as $row) {
            $totalHarga += (float)$row['dettotaljual'];
        }

        $this->db->transStart();

        // 1. Revert old sparepart stock
        $oldDetails = $this->detailTransaksiServisModel->where('detfaktur', $faktur)->findAll();
        foreach ($oldDetails as $oldItem) {
            if (!empty($oldItem['detailbrgkode'])) {
                $barang = $this->barangModel->find($oldItem['detailbrgkode']);
                if ($barang) {
                    $restoredStok = (int)$barang['stok'] + (int)$oldItem['detjml'];
                    $this->barangModel->update($oldItem['detailbrgkode'], ['stok' => $restoredStok]);
                }
            }
        }

        // 2. Delete old details
        $this->detailTransaksiServisModel->where('detfaktur', $faktur)->delete();

        // 3. Update header
        $this->transaksiServisModel->update($faktur, [
            'tglfaktur'      => $tglfaktur,
            'nama_pelanggan' => $namaPelanggan,
            'merkkendaraan' => $merkkendaraan,
            'nopol'          => $nopol,
            'alasan'         => $alasan,
            'totalharga'     => $totalHarga,
        ]);

        // 4. Insert new details & deduct stock
        foreach ($tempData as $row) {
            $this->detailTransaksiServisModel->insert([
                'detfaktur'       => $faktur,
                'detserviskode'   => $row['detserviskode'],
                'detbiaya'        => $row['detbiaya'],
                'detailbrgkode'   => $row['detailbrgkode'],
                'detailhargajual' => $row['detailhargajual'],
                'detjml'          => $row['detjml'],
                'dettotaljual'    => $row['dettotaljual'],
            ]);

            if (!empty($row['detailbrgkode'])) {
                $barang = $this->barangModel->find($row['detailbrgkode']);
                if ($barang) {
                    $newStok = max(0, (int)$barang['stok'] - (int)$row['detjml']);
                    $this->barangModel->update($row['detailbrgkode'], ['stok' => $newStok]);
                }
            }
        }

        // 5. Clear temp
        $this->tempTransaksiServisModel->where('session_id', $sessionId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal memperbarui transaksi servis.']);
        }

        return $this->response->setJSON([
            'status'       => true,
            'message'      => 'Transaksi Servis No. ' . $faktur . ' berhasil diperbarui.',
            'show_url'     => site_url('admin/transaksiservis/show/' . $faktur),
            'redirect_url' => site_url('admin/transaksiservis'),
        ]);
    }

    public function delete($faktur = null)
    {
        $header = $this->transaksiServisModel->find($faktur);

        if (!$header) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data transaksi servis tidak ditemukan.']);
        }

        if ((float)($header['bayar'] ?? 0) > 0) {
            return $this->response->setJSON(['status' => false, 'message' => 'Transaksi servis yang sudah dilunasi tidak dapat dibatalkan.']);
        }

        if (strtolower($header['status'] ?? '') === 'selesai') {
            return $this->response->setJSON(['status' => false, 'message' => 'Transaksi servis yang sudah selesai dikerjakan tidak dapat dibatalkan. Jika ingin membatalkan, kembalikan status terlebih dahulu.']);
        }

        $details = $this->detailTransaksiServisModel->where('detfaktur', $faktur)->findAll();

        $this->db->transStart();

        // 1. Restore sparepart stock
        foreach ($details as $row) {
            if (!empty($row['detailbrgkode'])) {
                $barang = $this->barangModel->find($row['detailbrgkode']);
                if ($barang) {
                    $restoredStok = (int)$barang['stok'] + (int)$row['detjml'];
                    $this->barangModel->update($row['detailbrgkode'], ['stok' => $restoredStok]);
                }
            }
        }

        // 2. Delete header (details cascade)
        $this->transaksiServisModel->delete($faktur);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal membatalkan transaksi servis.']);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Transaksi Servis No. ' . $faktur . ' berhasil dibatalkan dan stok sparepart dikembalikan.',
        ]);
    }

    public function cetak($faktur = null)
    {
        $header  = $this->transaksiServisModel->find($faktur);
        $details = $this->detailTransaksiServisModel->getDetailWithInfo($faktur);

        if (!$header) {
            session()->setFlashdata('error', 'Data transaksi servis tidak ditemukan.');
            return redirect()->to('/admin/transaksiservis');
        }

        $data = [
            'title'   => 'Nota Servis Motor #' . $faktur,
            'header'  => $header,
            'details' => $details,
        ];

        return view('page/content/form/transaksiservis/cetak', $data);
    }
}
