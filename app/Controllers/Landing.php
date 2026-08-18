<?php

namespace App\Controllers;

use App\Models\ServisModel;

class Landing extends BaseController
{
    public function index()
    {
        $servisModel = new ServisModel();

        // Mengambil daftar layanan servis
        $daftarServis = $servisModel->orderBy('biaya', 'ASC')->findAll();

        // Cek sesi login
        $isLoggedIn = session()->get('isLoggedIn') ?? false;
        $userData   = [
            'id'    => session()->get('user_id'),
            'nama'  => session()->get('userNama'),
            'email' => session()->get('userEmail'),
            'role'  => session()->get('userRole'),
        ];

        $data = [
            'title'        => 'Bengkel Salsa Motor - Booking Servis Motor Cepat & Terpercaya',
            'daftarServis' => $daftarServis,
            'isLoggedIn'   => $isLoggedIn,
            'userData'     => $userData,
        ];

        return view('landing/index', $data);
    }
}
