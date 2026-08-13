<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email    = $this->request->getVar('userEmail');
        $password = $this->request->getVar('userPassword');

        if (empty($email) || empty($password)) {
            $session->setFlashdata('msg', 'Email dan Kata Sandi wajib diisi.');
            return redirect()->to('/login')->withInput();
        }

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id'    => $user['id'],
                    'userNama'   => $user['nama'],
                    'userEmail'  => $user['email'],
                    'userRole'   => $user['level'],
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);
                $session->setFlashdata('success', 'Selamat datang kembali, ' . $user['nama'] . '!');

                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Kata sandi yang Anda masukkan salah.');
                return redirect()->to('/login')->withInput();
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak terdaftar.');
            return redirect()->to('/login')->withInput();
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'nama'             => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
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
            'confirm_password' => [
                'matches' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $data = [
            'nama'     => $this->request->getVar('nama'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'level'    => 'pelanggan',
            'no_hp'    => $this->request->getVar('no_hp'),
            'alamat'   => $this->request->getVar('alamat'),
        ];

        $userModel->save($data);

        session()->setFlashdata('success_register', 'Pendaftaran berhasil! Silahkan login dengan akun Anda.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
