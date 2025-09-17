<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'question' => 'Berapa jumlah satelit bumi', 'active' => 1],
            ['id' => 2, 'question' => 'Pilih benda yang merupakan alat makan', 'active' => 1],
            ['id' => 3, 'question' => 'Pilih benda yang merupakan alat tulis', 'active' => 1],
            ['id' => 4, 'question' => 'Pilih benda yang merupaka bagian komputer', 'active' => 1],
            ['id' => 5, 'question' => 'Pilih kendaraan transportasi darat', 'active' => 1],
        ];

        $this->db->table('questions')->insertBatch($data);
    }
}
