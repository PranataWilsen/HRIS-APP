<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'pegawai';   // nama tabel di DB
    protected $primaryKey       = 'id';        // primary key

    protected $useAutoIncrement = true;        // id otomatis increment
    protected $returnType       = 'array';     // hasil query -> array
    protected $useSoftDeletes   = false;       // tidak pakai soft delete

    // field yang boleh diisi lewat insert/update
    protected $allowedFields    = [
        'name',
        'gender',
        'departemenid',
        'address',
        'keahlian',
        'active',
    ];

    // validation rules (opsional, bisa dipakai langsung di model)
    protected $validationRules = [
        'name'         => 'required|min_length[3]|max_length[100]',
        'gender'       => 'required|in_list[P,W]',
        'departemenid' => 'required|integer',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama wajib diisi.',
            'min_length' => 'Nama minimal 3 huruf.',
        ],
        'gender' => [
            'required' => 'Pilih gender.',
            'in_list'  => 'Gender hanya boleh P (Pria) atau W (Wanita).',
        ],
        'departemenid' => [
            'required' => 'Departemen wajib dipilih.',
            'integer'  => 'Departemen harus angka.',
        ],
    ];

    protected $skipValidation = false; // jalankan validasi default
}
