<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function login_action()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('login', $data);
        } else {
            $session = session();
            $loginModel = new LoginModel;

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $cekusername = $loginModel->where('username', $username)->first();

            if ($cekusername) {
                $password_db = $cekusername['password']; // BENAR
                $cek_password = password_verify($password, $password_db);

                if ($cek_password) {

                    $session_data =[
                        'logged_in' => TRUE,
                        'role_id' => $cekusername['role']
                    ];
                    $session -> set($session_data);

                    switch($cekusername['role']){
                        case 'Admin':
                            return redirect()->to('Admin/Home');
                        case 'Mental Support':
                            return redirect()->to('mentalSupport/Home');
                        default:
                            $session->setFlashdata('pesan', 'Akun anda belum terdaftar');
                            $data = [
                            'validation' => \Config\Services::validation()
                            ];
                             return view('login', $data);
                    }
                } else {
                    $session->setFlashdata('pesan', 'password salah');
                    $data = [
                        'validation' => \Config\Services::validation()
                    ];
                    return view('login', $data);
                }
            } else {
                
                $session->setFlashdata('pesan', 'username salah');
                $data = [
                    'validation' => \Config\Services::validation()
                ];
                return view('login', data: $data);
            }
        }
    }

    public function logout(){
        $session =session();
        $session->destroy(); //destroy history login jd gabisa masuk lagi tnp login
        return view('login');
    }
}
