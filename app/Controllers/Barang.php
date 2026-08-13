<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;

class Barang extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->barangModel   = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel   = new SatuanModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Barang & Sparepart',
            'barang' => $this->barangModel->getBarangWithRelations(),
        ];

        return view('page/content/form/barang/index', $data);
    }

    public function create()
    {
        // Auto-generate unique item code: BRG + 7 random digits
        $autoKode = 'BRG' . sprintf('%07d', mt_rand(1, 9999999));

        $data = [
            'title'    => 'Tambah Barang Baru',
            'autoKode' => $autoKode,
            'kategori' => $this->kategoriModel->orderBy('namakategori', 'ASC')->findAll(),
            'satuan'   => $this->satuanModel->orderBy('nama_satuan', 'ASC')->findAll(),
        ];

        return view('page/content/form/barang/create', $data);
    }

    public function store()
    {
        $rules = [
            'kode'       => 'required|min_length[3]|max_length[10]|is_unique[barang.kode]',
            'nama_barng' => 'required|min_length[3]|max_length[50]',
            'idkategori' => 'required|numeric',
            'idsatuan'   => 'required|numeric',
            'harga'      => 'required|numeric|greater_than_equal_to[0]',
            'stok'       => 'required|integer|greater_than_equal_to[0]',
            'gambar'     => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar,2048]',
        ];

        $messages = [
            'kode' => [
                'required'   => 'Kode barang wajib diisi.',
                'min_length' => 'Kode barang minimal 3 karakter.',
                'max_length' => 'Kode barang maksimal 10 karakter.',
                'is_unique'  => 'Kode barang sudah terdaftar. Silakan gunakan kode lain.',
            ],
            'nama_barng' => [
                'required'   => 'Nama barang wajib diisi.',
                'min_length' => 'Nama barang minimal 3 karakter.',
                'max_length' => 'Nama barang maksimal 50 karakter.',
            ],
            'idkategori' => [
                'required' => 'Pilih kategori barang.',
            ],
            'idsatuan' => [
                'required' => 'Pilih satuan barang.',
            ],
            'harga' => [
                'required'              => 'Harga barang wajib diisi.',
                'numeric'               => 'Harga barang harus berupa angka.',
                'greater_than_equal_to' => 'Harga barang tidak boleh bernilai negatif.',
            ],
            'stok' => [
                'required'              => 'Stok barang wajib diisi.',
                'integer'               => 'Stok barang harus berupa bilangan bulat.',
                'greater_than_equal_to' => 'Stok barang tidak boleh bernilai negatif.',
            ],
            'gambar' => [
                'is_image' => 'File yang diunggah harus berupa gambar (JPG, PNG, WEBP).',
                'mime_in'  => 'Format gambar tidak didukung.',
                'max_size' => 'Ukuran gambar maksimal 2 MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal. Silakan periksa kembali inputan Anda.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambarFile = $this->request->getFile('gambar');
        $namaGambar = null;

        if ($gambarFile && $gambarFile->isValid() && !$gambarFile->hasMoved()) {
            $namaGambar = $gambarFile->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/barang';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $gambarFile->move($uploadPath, $namaGambar);
        }

        $data = [
            'kode'       => strtoupper(trim($this->request->getPost('kode'))),
            'nama_barng' => trim($this->request->getPost('nama_barng')),
            'idkategori' => (int)$this->request->getPost('idkategori'),
            'idsatuan'   => (int)$this->request->getPost('idsatuan'),
            'harga'      => (float)$this->request->getPost('harga'),
            'stok'       => (int)$this->request->getPost('stok'),
            'gambar'     => $namaGambar,
        ];

        $this->barangModel->insert($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'       => true,
                'message'      => 'Barang baru berhasil ditambahkan.',
                'redirect_url' => site_url('admin/barang'),
            ]);
        }

        session()->setFlashdata('success', 'Barang baru berhasil ditambahkan.');
        return redirect()->to('/admin/barang');
    }

    public function edit($kode = null)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            session()->setFlashdata('error', 'Data barang tidak ditemukan.');
            return redirect()->to('/admin/barang');
        }

        $data = [
            'title'    => 'Edit Data Barang',
            'barang'   => $barang,
            'kategori' => $this->kategoriModel->orderBy('namakategori', 'ASC')->findAll(),
            'satuan'   => $this->satuanModel->orderBy('nama_satuan', 'ASC')->findAll(),
        ];

        return view('page/content/form/barang/edit', $data);
    }

    public function update($kode = null)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data barang tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data barang tidak ditemukan.');
            return redirect()->to('/admin/barang');
        }

        $rules = [
            'nama_barng' => 'required|min_length[3]|max_length[50]',
            'idkategori' => 'required|numeric',
            'idsatuan'   => 'required|numeric',
            'harga'      => 'required|numeric|greater_than_equal_to[0]',
            'stok'       => 'required|integer|greater_than_equal_to[0]',
            'gambar'     => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar,2048]',
        ];

        $messages = [
            'nama_barng' => [
                'required'   => 'Nama barang wajib diisi.',
                'min_length' => 'Nama barang minimal 3 karakter.',
                'max_length' => 'Nama barang maksimal 50 karakter.',
            ],
            'idkategori' => [
                'required' => 'Pilih kategori barang.',
            ],
            'idsatuan' => [
                'required' => 'Pilih satuan barang.',
            ],
            'harga' => [
                'required'              => 'Harga barang wajib diisi.',
                'numeric'               => 'Harga barang harus berupa angka.',
                'greater_than_equal_to' => 'Harga barang tidak boleh bernilai negatif.',
            ],
            'stok' => [
                'required'              => 'Stok barang wajib diisi.',
                'integer'               => 'Stok barang harus berupa bilangan bulat.',
                'greater_than_equal_to' => 'Stok barang tidak boleh bernilai negatif.',
            ],
            'gambar' => [
                'is_image' => 'File yang diunggah harus berupa gambar (JPG, PNG, WEBP).',
                'mime_in'  => 'Format gambar tidak didukung.',
                'max_size' => 'Ukuran gambar maksimal 2 MB.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal. Silakan periksa kembali inputan Anda.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambarFile    = $this->request->getFile('gambar');
        $removeGambar  = $this->request->getPost('remove_gambar');
        $namaGambar    = $barang['gambar'];
        $uploadPath    = ROOTPATH . 'public/uploads/barang';

        // Check if user requested to remove existing image
        if ($removeGambar == '1' && !empty($barang['gambar'])) {
            if (file_exists($uploadPath . '/' . $barang['gambar'])) {
                @unlink($uploadPath . '/' . $barang['gambar']);
            }
            $namaGambar = null;
        }

        // Check if a new file is uploaded
        if ($gambarFile && $gambarFile->isValid() && !$gambarFile->hasMoved()) {
            $namaGambarNew = $gambarFile->getRandomName();

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $gambarFile->move($uploadPath, $namaGambarNew);

            // Delete old file if exists
            if (!empty($barang['gambar']) && file_exists($uploadPath . '/' . $barang['gambar'])) {
                @unlink($uploadPath . '/' . $barang['gambar']);
            }

            $namaGambar = $namaGambarNew;
        }

        $updateData = [
            'nama_barng' => trim($this->request->getPost('nama_barng')),
            'idkategori' => (int)$this->request->getPost('idkategori'),
            'idsatuan'   => (int)$this->request->getPost('idsatuan'),
            'harga'      => (float)$this->request->getPost('harga'),
            'stok'       => (int)$this->request->getPost('stok'),
            'gambar'     => $namaGambar,
        ];

        $this->barangModel->update($kode, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'       => true,
                'message'      => 'Data barang berhasil diperbarui.',
                'redirect_url' => site_url('admin/barang'),
            ]);
        }

        session()->setFlashdata('success', 'Data barang berhasil diperbarui.');
        return redirect()->to('/admin/barang');
    }

    public function delete($kode = null)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data barang tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data barang tidak ditemukan.');
            return redirect()->to('/admin/barang');
        }

        if (!empty($barang['gambar'])) {
            $filePath = ROOTPATH . 'public/uploads/barang/' . $barang['gambar'];
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $this->barangModel->delete($kode);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data barang berhasil dihapus.',
            ]);
        }

        session()->setFlashdata('success', 'Data barang berhasil dihapus.');
        return redirect()->to('/admin/barang');
    }
}
