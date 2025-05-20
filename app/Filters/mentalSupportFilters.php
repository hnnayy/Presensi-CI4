<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class mentalSupportFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('pesan', 'Silakan login terlebih dahulu');
            return redirect()->to('/');
        }

        if (session()->get('role_id') != 'Mental Support') {
            session()->setFlashdata('pesan', 'Silakan login terlebih dahulu');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan jika tidak ada proses after
    }
}
