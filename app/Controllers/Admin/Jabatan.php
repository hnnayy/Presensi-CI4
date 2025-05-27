<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JabatanModel;

class Jabatan extends BaseController
{
    public function index()
    {
        $jabatanModel = new JabatanModel();
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => $jabatanModel->findAll()
        ];

        return view('Admin/Jabatan/Jabatan', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jabatan',
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/Jabatan/Create', $data);
    }

    public function store()
    {
        $jabatanModel = new JabatanModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $rules = [
            'jabatan' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Simpan ke database
        $jabatanModel->insert([
            'jabatan' => $this->request->getPost('jabatan')
        ]);

        session()->setFlashdata('success', 'Data jabatan berhasil ditambahkan.');
        return redirect()->to(base_url('Admin/Jabatan'));
    }

    public function edit($id)
    {
        $jabatanModel = new JabatanModel(); 
        $data = [
            'title' => 'Edit Jabatan',
            'jabatan' => $jabatanModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/Jabatan/Edit', $data);
    }

    public function update($id)
    {
        $jabatanModel = new JabatanModel();

        $rules = [
            'jabatan' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        $jabatanModel->update($id, [
            'jabatan' => $this->request->getPost('jabatan')
        ]);

        session()->setFlashdata('success', 'Data jabatan berhasil diperbarui.');
        return redirect()->to(base_url('Admin/Jabatan'));
    }

    public function delete($id)
    {
        $jabatanModel = new JabatanModel();
        $jabatanModel->delete($id);

        session()->setFlashdata('success', 'Data jabatan berhasil dihapus.');
        return redirect()->to(base_url('Admin/Jabatan'));
    }
}
