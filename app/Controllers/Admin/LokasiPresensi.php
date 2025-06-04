<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LokasiPresensiModel;

class LokasiPresensi extends BaseController
{
    protected $lokasiPresensiModel;
    
    public function __construct()
    {
        $this->lokasiPresensiModel = new LokasiPresensiModel();
    }

    /**
     * Get coordinates from address using geocoding API
     */
    private function getCoordinates($address)
    {
        try {
            $apiKey = '683aeaf1a74df113328415oyp1a89e3';
            $url = 'https://geocode.maps.co/search?q=' . urlencode($address) . '&api_key=' . $apiKey;
            
            $context = stream_context_create([
                'http' => [
                    'timeout' => 15,
                    'method' => 'GET',
                    'header' => "User-Agent: LokasiPresensi App\r\n"
                ]
            ]);
            
            $response = file_get_contents($url, false, $context);
            
            if ($response === false) {
                log_message('error', 'Failed to fetch geocoding data for address: ' . $address);
                return null;
            }
            
            $data = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                return null;
            }
            
            if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
                return [
                    'latitude' => (float) $data[0]['lat'],
                    'longitude' => (float) $data[0]['lon']
                ];
            }
            
            log_message('error', 'Invalid geocoding response for address: ' . $address . ' | Response: ' . substr($response, 0, 200));
            return null;
            
        } catch (\Exception $e) {
            log_message('error', 'Geocoding exception: ' . $e->getMessage() . ' for address: ' . $address);
            return null;
        }
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return round($distance, 2); // Round to 2 decimal places
    }

    /**
     * Display list of locations
     */
    public function index()
    {
        try {
            $data = [
                'title' => 'Data Lokasi Presensi',
                'lokasi_presensi' => $this->lokasiPresensiModel->findAll()
            ];

            return view('Admin/LokasiPresensi/lokasi_presensi', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in LokasiPresensi index: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat memuat data.');
            return redirect()->to(base_url('Admin/Home'));
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Lokasi Presensi',
            'validation' => \Config\Services::validation()
        ];
        
        return view('Admin/LokasiPresensi/create', $data);
    }

    /**
     * Store new location
     */
    public function store()
    {
        try {
            // Get form data
            $formData = [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang')
            ];

            // Validation rules
            $rules = [
                'nama_lokasi' => 'required|min_length[3]|max_length[255]',
                'alamat_lokasi' => 'required|min_length[5]|max_length[500]',
                'tipe_lokasi' => 'required|in_list[pusat,cabang]',
                'zona_waktu' => 'required|in_list[WIB,WITA,WIT]',
                'jam_masuk' => 'required',
                'jam_pulang' => 'required'
            ];

            $messages = [
                'nama_lokasi' => [
                    'required' => 'Nama lokasi harus diisi',
                    'min_length' => 'Nama lokasi minimal 3 karakter',
                    'max_length' => 'Nama lokasi maksimal 255 karakter'
                ],
                'alamat_lokasi' => [
                    'required' => 'Alamat lokasi harus diisi',
                    'min_length' => 'Alamat lokasi minimal 5 karakter',
                    'max_length' => 'Alamat lokasi maksimal 500 karakter'
                ],
                'tipe_lokasi' => [
                    'required' => 'Tipe lokasi harus dipilih',
                    'in_list' => 'Tipe lokasi harus pusat atau cabang'
                ],
                'zona_waktu' => [
                    'required' => 'Zona waktu harus dipilih',
                    'in_list' => 'Zona waktu harus WIB, WITA, atau WIT'
                ],
                'jam_masuk' => [
                    'required' => 'Jam masuk harus diisi'
                ],
                'jam_pulang' => [
                    'required' => 'Jam pulang harus diisi'
                ]
            ];

            // Validate input
            if (!$this->validate($rules, $messages)) {
                $errors = \Config\Services::validation()->getErrors();
                log_message('error', 'Validation failed: ' . json_encode($errors));
                
                session()->setFlashdata('error', 'Data tidak valid: ' . implode('<br>', $errors));
                return redirect()->back()->withInput();
            }

            // Get coordinates from address
            log_message('info', 'Getting coordinates for address: ' . $formData['alamat_lokasi']);
            $coordinates = $this->getCoordinates($formData['alamat_lokasi']);

            if (!$coordinates) {
                session()->setFlashdata('error', 'Gagal mendapatkan koordinat dari alamat yang diberikan. Pastikan alamat sudah benar dan coba lagi.');
                return redirect()->back()->withInput();
            }

            // Calculate distance from reference point (Telkom University coordinates)
            $telkomLat = -6.9733;
            $telkomLon = 107.6308;
            $radius = $this->calculateDistance(
                $coordinates['latitude'], 
                $coordinates['longitude'], 
                $telkomLat, 
                $telkomLon
            );

            // Prepare data for insert
            $insertData = [
                'nama_lokasi' => trim($formData['nama_lokasi']),
                'alamat_lokasi' => trim($formData['alamat_lokasi']),
                'tipe_lokasi' => $formData['tipe_lokasi'],
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
                'radius' => $radius,
                'zona_waktu' => $formData['zona_waktu'],
                'jam_masuk' => $formData['jam_masuk'],
                'jam_pulang' => $formData['jam_pulang']
            ];

            log_message('info', 'Attempting to insert data: ' . json_encode($insertData));

            // Insert data
            $result = $this->lokasiPresensiModel->insert($insertData);

            if ($result) {
                log_message('info', 'Location successfully inserted with ID: ' . $result);
                session()->setFlashdata('success', 'Data lokasi presensi berhasil ditambahkan.');
                return redirect()->to(base_url('Admin/LokasiPresensi'));
            } else {
                $errors = $this->lokasiPresensiModel->errors();
                log_message('error', 'Database insert failed: ' . json_encode($errors));
                
                session()->setFlashdata('error', 'Gagal menyimpan data ke database: ' . implode('<br>', $errors));
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Exception in LokasiPresensi store: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        try {
            $lokasi = $this->lokasiPresensiModel->find($id);
            
            if (!$lokasi) {
                session()->setFlashdata('error', 'Data lokasi tidak ditemukan.');
                return redirect()->to(base_url('Admin/LokasiPresensi'));
            }

            $data = [
                'title' => 'Edit Lokasi Presensi',
                'lokasi' => $lokasi,
                'validation' => \Config\Services::validation()
            ];

            return view('Admin/LokasiPresensi/edit', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in LokasiPresensi edit: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat memuat data.');
            return redirect()->to(base_url('Admin/LokasiPresensi'));
        }
    }

    /**
     * Update location
     */
    public function update($id)
    {
        try {
            // Check if location exists
            $lokasi = $this->lokasiPresensiModel->find($id);
            if (!$lokasi) {
                session()->setFlashdata('error', 'Data lokasi tidak ditemukan.');
                return redirect()->to(base_url('Admin/LokasiPresensi'));
            }

            // Get form data
            $formData = [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang')
            ];

            // Validation rules
            $rules = [
                'nama_lokasi' => 'required|min_length[3]|max_length[255]',
                'alamat_lokasi' => 'required|min_length[5]|max_length[500]',
                'tipe_lokasi' => 'required|in_list[pusat,cabang]',
                'zona_waktu' => 'required|in_list[WIB,WITA,WIT]',
                'jam_masuk' => 'required',
                'jam_pulang' => 'required'
            ];

            if (!$this->validate($rules)) {
                $errors = \Config\Services::validation()->getErrors();
                session()->setFlashdata('error', 'Data tidak valid: ' . implode('<br>', $errors));
                return redirect()->back()->withInput();
            }

            // Check if address changed - if yes, get new coordinates
            $updateData = [
                'nama_lokasi' => trim($formData['nama_lokasi']),
                'alamat_lokasi' => trim($formData['alamat_lokasi']),
                'tipe_lokasi' => $formData['tipe_lokasi'],
                'zona_waktu' => $formData['zona_waktu'],
                'jam_masuk' => $formData['jam_masuk'],
                'jam_pulang' => $formData['jam_pulang']
            ];

            if ($lokasi['alamat_lokasi'] !== trim($formData['alamat_lokasi'])) {
                // Address changed, get new coordinates
                $coordinates = $this->getCoordinates($formData['alamat_lokasi']);
                
                if (!$coordinates) {
                    session()->setFlashdata('error', 'Gagal mendapatkan koordinat dari alamat yang diberikan.');
                    return redirect()->back()->withInput();
                }

                $telkomLat = -6.9733;
                $telkomLon = 107.6308;
                $radius = $this->calculateDistance(
                    $coordinates['latitude'], 
                    $coordinates['longitude'], 
                    $telkomLat, 
                    $telkomLon
                );

                $updateData['latitude'] = $coordinates['latitude'];
                $updateData['longitude'] = $coordinates['longitude'];
                $updateData['radius'] = $radius;
            }

            // Update data
            $result = $this->lokasiPresensiModel->update($id, $updateData);

            if ($result) {
                session()->setFlashdata('success', 'Data lokasi presensi berhasil diperbarui.');
                return redirect()->to(base_url('Admin/LokasiPresensi'));
            } else {
                $errors = $this->lokasiPresensiModel->errors();
                session()->setFlashdata('error', 'Gagal memperbarui data: ' . implode('<br>', $errors));
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Exception in LokasiPresensi update: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete location
     */
    public function delete($id)
    {
        try {
            $lokasi = $this->lokasiPresensiModel->find($id);
            
            if (!$lokasi) {
                session()->setFlashdata('error', 'Data lokasi tidak ditemukan.');
                return redirect()->to(base_url('Admin/LokasiPresensi'));
            }

            $result = $this->lokasiPresensiModel->delete($id);

            if ($result) {
                session()->setFlashdata('success', 'Data lokasi presensi berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus data lokasi presensi.');
            }

            return redirect()->to(base_url('Admin/LokasiPresensi'));

        } catch (\Exception $e) {
            log_message('error', 'Exception in LokasiPresensi delete: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus data.');
            return redirect()->to(base_url('Admin/LokasiPresensi'));
        }
    }
}