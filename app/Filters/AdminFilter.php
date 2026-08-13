<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('msg', 'Silahkan login terlebih dahulu untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        if (session()->get('userRole') !== 'admin') {
            session()->setFlashdata('error', 'Akses ditolak. Halaman ini hanya dapat diakses oleh Admin.');
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
