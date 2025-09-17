<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Agus', 'gender' => 'P', 'departemenid' => 1, 'address' => 'Jl mana saja 1', 'keahlian' => '1,3,5', 'active' => 1],
            ['id' => 2, 'name' => 'Bambang', 'gender' => 'P', 'departemenid' => 2, 'address' => 'Jl mana saja 2', 'keahlian' => '2,1,5', 'active' => 1],
            ['id' => 3, 'name' => 'Bayu', 'gender' => 'P', 'departemenid' => 3, 'address' => 'Jl mana saja 3', 'keahlian' => '1,4,5', 'active' => 1],
            // ... lanjutkan sampai pegawai ke-96
        ];

        $this->db->table('pegawai')->insertBatch($data);
    }
}
