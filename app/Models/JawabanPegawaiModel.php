<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanPegawaiModel extends Model
{
    protected $table = 'jawaban_pegawai'; // FIX
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pegawaiid',
        'active',
    ];
}
