<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JawabanPegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'pegawaiid' => 52, 'active' => 1],
            ['id' => 2, 'pegawaiid' => 32, 'active' => 1],
            ['id' => 3, 'pegawaiid' => 12, 'active' => 1],
            ['id' => 4, 'pegawaiid' => 47, 'active' => 1],
            // ... lanjutkan sampai id 96
        ];

        $this->db->table('jawaban_pegawai')->insertBatch($data);
    }
}
