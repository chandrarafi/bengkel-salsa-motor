<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            $role = strtolower(session()->get('userRole') ?? '');
            if (in_array($role, ['admin', 'pimpinan'])) {
                return redirect()->to('/dashboard');
            }
        }
        return redirect()->to('/');
    }
}
