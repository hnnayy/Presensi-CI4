<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiPresensiModel extends Model
{
    protected $table = 'lokasi_presensi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    protected $allowedFields = [
        'nama_lokasi',
        'alamat_lokasi', 
        'tipe_lokasi',
        'latitude',
        'longitude',
        'radius',
        'zona_waktu',
        'jam_masuk',
        'jam_pulang'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_lokasi' => 'required|min_length[3]|max_length[255]',
        'alamat_lokasi' => 'required|min_length[5]|max_length[500]',
        'tipe_lokasi' => 'required|in_list[pusat,cabang]',
        'latitude' => 'required|decimal',
        'longitude' => 'required|decimal',
        'radius' => 'required|decimal',
        'zona_waktu' => 'required|in_list[WIB,WITA,WIT]',
        'jam_masuk' => 'required',
        'jam_pulang' => 'required'
    ];
    
    protected $validationMessages = [
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

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}