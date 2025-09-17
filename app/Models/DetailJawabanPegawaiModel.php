<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailJawabanPegawaiModel extends Model
{
    protected $table = 'detail_jawaban_pegawai'; // FIX
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'jawabanpegawaiid',
        'questionid',
        'answer',
    ];
}
