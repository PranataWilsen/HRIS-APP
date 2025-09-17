<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'HR', 'active' => 1],
            ['id' => 2, 'name' => 'IT', 'active' => 1],
            ['id' => 3, 'name' => 'FACTORY', 'active' => 1],
            ['id' => 4, 'name' => 'AUDIT', 'active' => 1],
            ['id' => 5, 'name' => 'SALES', 'active' => 1],
        ];

        $this->db->table('departemen')->insertBatch($data);
    }
}
