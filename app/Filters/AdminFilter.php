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
            $currentUrl = current_url();
            if (!str_contains($currentUrl, 'login') && !str_contains($currentUrl, 'register') && !str_contains($currentUrl, 'logout')) {
                session()->set('redirect_url', $currentUrl);
            }

            session()->setFlashdata('msg', 'Silahkan login terlebih dahulu untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        $role = strtolower(session()->get('userRole') ?? '');
        if (!in_array($role, ['admin', 'pimpinan'])) {
            session()->setFlashdata('error', 'Akses ditolak. Halaman ini hanya dapat diakses oleh Admin atau Pimpinan.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
