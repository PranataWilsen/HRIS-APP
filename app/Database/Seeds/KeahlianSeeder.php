<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeahlianSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Excel', 'active' => 1],
            ['id' => 2, 'name' => 'PHP', 'active' => 1],
            ['id' => 3, 'name' => 'Mysql', 'active' => 1],
            ['id' => 4, 'name' => 'Oracle', 'active' => 1],
            ['id' => 5, 'name' => 'Node js', 'active' => 1],
        ];

        $this->db->table('keahlian')->insertBatch($data);
    }
}
