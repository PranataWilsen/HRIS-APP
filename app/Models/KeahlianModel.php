<?php

namespace App\Models;

use CodeIgniter\Model;

class KeahlianModel extends Model
{
    protected $table = 'keahlian';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'active',
    ];
}
