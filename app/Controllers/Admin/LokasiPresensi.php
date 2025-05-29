<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LokasiPresensiModel;

class LokasiPresensi extends BaseController
{
    private function getCoordinates($address)
    {
        $apiKey = 'YOUR_API_KEY'; // Ganti dengan API key Anda
        $url = 'https://geocode.maps.co/search?q=' . urlencode($address) . '&api_key=' . $apiKey;

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data)) {
            return [
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ];
        }

        return null;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }

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

        $validation = \Config\Services::validation();
        $rules = [
            'nama_lokasi' => 'required',
            'alamat_lokasi' => 'required|min_length[3]',
            'tipe_lokasi' => 'required',
            'zona_waktu' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $alamat = $this->request->getPost('alamat_lokasi');
        $coordinates = $this->getCoordinates($alamat);

        if ($coordinates) {
            $latitude = $coordinates['latitude'];
            $longitude = $coordinates['longitude'];

            $telkomLat = -6.9733;
            $telkomLon = 107.6308;
            $radius = $this->calculateDistance($latitude, $longitude, $telkomLat, $telkomLon);

            $lokasiPresensiModel->insert([
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $alamat,
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'radius' => $radius,
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang'),
            ]);

            session()->setFlashdata('success', 'Data lokasi presensi berhasil ditambahkan.');
            return redirect()->to(base_url('Admin/LokasiPresensi'));
        } else {
            session()->setFlashdata('error', 'Gagal mendapatkan koordinat dari alamat yang diberikan.');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $lokasiPresensiModel->delete($id);

        session()->setFlashdata('success', 'Data lokasi presensi berhasil dihapus.');
        return redirect()->to(base_url('Admin/LokasiPresensi'));
    }
}
