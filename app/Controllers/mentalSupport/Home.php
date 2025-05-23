<?php

namespace App\Controllers\MentalSupport;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index()
    {
         $data = [
            'title' => 'Home'
        ];

        return view('mentalSupport/Home', $data);
    }
}
