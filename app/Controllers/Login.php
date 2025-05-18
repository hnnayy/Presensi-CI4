<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data = [
        'validation' => \Config\Services::validation()
        ];
        return view('login');
    }

    public function login_action()
    {
        $rules=[
            'username'=>'required',
            'password'=>'required',

        ];
        if(!$this->validate($rules)){
            $data['validation']=$this->validator;
            return view('login', $data);
        }else{

        }
    }


}
