<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    protected $satuanModel;

    public function __construct()
    {
        $this->satuanModel = new SatuanModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Satuan',
            'satuan' => $this->satuanModel->orderBy('idsatuan', 'DESC')->findAll(),
        ];

        return view('page/content/form/satuan/index', $data);
    }

    public function create()
    {
        return redirect()->to('/admin/satuan');
    }

    public function store()
    {
        $rules = [
            'nama_satuan' => 'required|min_length[1]|max_length[100]',
        ];

        $messages = [
            'nama_satuan' => [
                'required'   => 'Nama satuan wajib diisi.',
                'min_length' => 'Nama satuan minimal 1 karakter.',
                'max_length' => 'Nama satuan maksimal 100 karakter.',
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
            return redirect()->to('/admin/satuan')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'add');
        }

        $data = [
            'nama_satuan' => $this->request->getPost('nama_satuan'),
            'keterangan'  => $this->request->getPost('keterangan'),
        ];

        $this->satuanModel->save($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Satuan baru berhasil ditambahkan.',
            ]);
        }

        session()->setFlashdata('success', 'Satuan baru berhasil ditambahkan.');
        return redirect()->to('/admin/satuan');
    }

    public function edit($id = null)
    {
        return redirect()->to('/admin/satuan');
    }

    public function update($id = null)
    {
        $satuan = $this->satuanModel->find($id);

        if (!$satuan) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data satuan tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data satuan tidak ditemukan.');
            return redirect()->to('/admin/satuan');
        }

        $rules = [
            'nama_satuan' => 'required|min_length[1]|max_length[100]',
        ];

        $messages = [
            'nama_satuan' => [
                'required'   => 'Nama satuan wajib diisi.',
                'min_length' => 'Nama satuan minimal 1 karakter.',
                'max_length' => 'Nama satuan maksimal 100 karakter.',
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
            return redirect()->to('/admin/satuan')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'edit')->with('edit_id', $id);
        }

        $updateData = [
            'idsatuan'    => $id,
            'nama_satuan' => $this->request->getPost('nama_satuan'),
            'keterangan'  => $this->request->getPost('keterangan'),
        ];

        $this->satuanModel->save($updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data satuan berhasil diperbarui.',
            ]);
        }

        session()->setFlashdata('success', 'Data satuan berhasil diperbarui.');
        return redirect()->to('/admin/satuan');
    }

    public function delete($id = null)
    {
        $satuan = $this->satuanModel->find($id);

        if (!$satuan) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data satuan tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data satuan tidak ditemukan.');
            return redirect()->to('/admin/satuan');
        }

        $this->satuanModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data satuan berhasil dihapus.',
            ]);
        }

        session()->setFlashdata('success', 'Data satuan berhasil dihapus.');
        return redirect()->to('/admin/satuan');
    }
}
