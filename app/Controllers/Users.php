<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('page/content/form/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User Baru',
        ];

        return view('page/content/form/users/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'level'    => 'required|in_list[pimpinan,admin,pelanggan]',
        ];

        $messages = [
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar, silakan gunakan email lain.',
            ],
            'password' => [
                'required'   => 'Kata sandi wajib diisi.',
                'min_length' => 'Kata sandi minimal 6 karakter.',
            ],
            'level' => [
                'required' => 'Pilih level hak akses.',
                'in_list'  => 'Level hak akses tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/admin/users/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'level'    => $this->request->getPost('level'),
            'no_hp'    => $this->request->getPost('no_hp'),
            'alamat'   => $this->request->getPost('alamat'),
        ];

        $this->userModel->save($data);

        session()->setFlashdata('success', 'User baru berhasil ditambahkan.');
        return redirect()->to('/admin/users');
    }

    public function edit($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'Data user tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        $data = [
            'title' => 'Edit Data User',
            'user'  => $user,
        ];

        return view('page/content/form/users/edit', $data);
    }

    public function update($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'Data user tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        $rules = [
            'nama'  => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'level' => 'required|in_list[pimpinan,admin,pelanggan]',
        ];

        $messages = [
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar oleh pengguna lain.',
            ],
            'level' => [
                'required' => 'Pilih level hak akses.',
                'in_list'  => 'Level hak akses tidak valid.',
            ],
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = 'min_length[6]';
            $messages['password']['min_length'] = 'Kata sandi minimal 6 karakter.';
        }

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/admin/users/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'id'     => $id,
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'level'  => $this->request->getPost('level'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $this->userModel->save($updateData);

        session()->setFlashdata('success', 'Data user berhasil diperbarui.');
        return redirect()->to('/admin/users');
    }

    public function delete($id = null)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'Data user tidak ditemukan.');
            return redirect()->to('/admin/users');
        }

        if ((int)$id === (int)session()->get('user_id')) {
            session()->setFlashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan.');
            return redirect()->to('/admin/users');
        }

        $this->userModel->delete($id);

        session()->setFlashdata('success', 'Data user berhasil dihapus.');
        return redirect()->to('/admin/users');
    }
}
