<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiPresensiModel extends Model
{
    protected $table = 'lokasi_presensi';
    
    protected $allowedFields = [
        'alamat_lokasi',
        'tipe_lokasi',
        'latitude',
        'longitude',
        'radius',
        'zona_waktu',
        'jam_masuk',
        'jam_pulang',
    ];
}
