<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Kategori',
            'kategori' => $this->kategoriModel->orderBy('idkategori', 'DESC')->findAll(),
        ];

        return view('page/content/form/kategori/index', $data);
    }

    public function create()
    {
        return redirect()->to('/admin/kategori');
    }

    public function store()
    {
        $rules = [
            'namakategori' => 'required|min_length[3]|max_length[100]',
        ];

        $messages = [
            'namakategori' => [
                'required'   => 'Nama kategori wajib diisi.',
                'min_length' => 'Nama kategori minimal 3 karakter.',
                'max_length' => 'Nama kategori maksimal 100 karakter.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->to('/admin/kategori')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'add');
        }

        $data = [
            'namakategori' => $this->request->getPost('namakategori'),
        ];

        $this->kategoriModel->save($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Kategori baru berhasil ditambahkan.',
            ]);
        }

        session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan.');
        return redirect()->to('/admin/kategori');
    }

    public function edit($id = null)
    {
        return redirect()->to('/admin/kategori');
    }

    public function update($id = null)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data kategori tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data kategori tidak ditemukan.');
            return redirect()->to('/admin/kategori');
        }

        $rules = [
            'namakategori' => 'required|min_length[3]|max_length[100]',
        ];

        $messages = [
            'namakategori' => [
                'required'   => 'Nama kategori wajib diisi.',
                'min_length' => 'Nama kategori minimal 3 karakter.',
                'max_length' => 'Nama kategori maksimal 100 karakter.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->to('/admin/kategori')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'edit')->with('edit_id', $id);
        }

        $updateData = [
            'idkategori'   => $id,
            'namakategori' => $this->request->getPost('namakategori'),
        ];

        $this->kategoriModel->save($updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data kategori berhasil diperbarui.',
            ]);
        }

        session()->setFlashdata('success', 'Data kategori berhasil diperbarui.');
        return redirect()->to('/admin/kategori');
    }

    public function delete($id = null)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data kategori tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data kategori tidak ditemukan.');
            return redirect()->to('/admin/kategori');
        }

        $this->kategoriModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data kategori berhasil dihapus.',
            ]);
        }

        session()->setFlashdata('success', 'Data kategori berhasil dihapus.');
        return redirect()->to('/admin/kategori');
    }
}
