<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LokasiPresensiModel;

class LokasiPresensi extends BaseController
{
    public function index()
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Data Lokasi Presensi',
            'lokasi_presensi' => $lokasiPresensiModel->findAll()
        ];

        return view('Admin/LokasiPresensi/lokasi_presensi', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Lokasi Presensi',
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/LokasiPresensi/create', $data);
    }

    public function store()
    {
        $lokasiPresensiModel = new LokasiPresensiModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $rules = [
            'alamat_lokasi' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Simpan ke database
        $lokasiPresensiModel->insert([
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
            'tipe_lokasi'   => $this->request->getPost('tipe_lokasi'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'radius'        => $this->request->getPost('radius'),
            'zona_waktu'    => $this->request->getPost('zona_waktu'),
            'jam_masuk'     => $this->request->getPost('jam_masuk'),
            'jam_pulang'    => $this->request->getPost('jam_pulang'),
        ]);

        session()->setFlashdata('success', 'Data lokasi presensi berhasil ditambahkan.');
        return redirect()->to(base_url('Admin/LokasiPresensi'));
    }

    public function edit($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel(); 
        $data = [
            'title' => 'Edit Lokasi Presensi',
            'lokasi_presensi' => $lokasiPresensiModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/LokasiPresensi/edit', $data);
    }

    public function update($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel();

        $rules = [
            'alamat_lokasi' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        $lokasiPresensiModel->update($id, [
            'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
            'tipe_lokasi'   => $this->request->getPost('tipe_lokasi'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude'),
            'radius'        => $this->request->getPost('radius'),
            'zona_waktu'    => $this->request->getPost('zona_waktu'),
            'jam_masuk'     => $this->request->getPost('jam_masuk'),
            'jam_pulang'    => $this->request->getPost('jam_pulang'),
        ]);

        session()->setFlashdata('success', 'Data lokasi presensi berhasil diperbarui.');
        return redirect()->to(base_url('Admin/LokasiPresensi'));
    }

    public function delete($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $lokasiPresensiModel->delete($id);

        session()->setFlashdata('success', 'Data lokasi presensi berhasil dihapus.');
        return redirect()->to(base_url('Admin/LokasiPresensi'));
    }
}
