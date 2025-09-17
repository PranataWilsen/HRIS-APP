<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'questionid' => 1, 'text' => '2', 'isanswer' => 0, 'active' => 1],
            ['id' => 2, 'questionid' => 1, 'text' => '3', 'isanswer' => 0, 'active' => 1],
            ['id' => 3, 'questionid' => 1, 'text' => '1', 'isanswer' => 1, 'active' => 1],
            ['id' => 4, 'questionid' => 1, 'text' => '4', 'isanswer' => 0, 'active' => 1],
            ['id' => 5, 'questionid' => 2, 'text' => 'Sendok', 'isanswer' => 1, 'active' => 1],
            ['id' => 6, 'questionid' => 2, 'text' => 'Garpu', 'isanswer' => 1, 'active' => 1],
            ['id' => 7, 'questionid' => 2, 'text' => 'Keyboard', 'isanswer' => 0, 'active' => 1],
            ['id' => 8, 'questionid' => 2, 'text' => 'Piring', 'isanswer' => 1, 'active' => 1],
            ['id' => 9, 'questionid' => 2, 'text' => 'Dompet', 'isanswer' => 0, 'active' => 1],
            ['id' => 10, 'questionid' => 2, 'text' => 'Mouse', 'isanswer' => 0, 'active' => 1],
            ['id' => 11, 'questionid' => 4, 'text' => 'Sendok', 'isanswer' => 0, 'active' => 1],
            ['id' => 12, 'questionid' => 4, 'text' => 'Garpu', 'isanswer' => 0, 'active' => 1],
            ['id' => 13, 'questionid' => 4, 'text' => 'Keyboard', 'isanswer' => 1, 'active' => 1],
            ['id' => 14, 'questionid' => 4, 'text' => 'Piring', 'isanswer' => 0, 'active' => 1],
            ['id' => 15, 'questionid' => 4, 'text' => 'Dompet', 'isanswer' => 0, 'active' => 1],
            ['id' => 16, 'questionid' => 4, 'text' => 'Mouse', 'isanswer' => 1, 'active' => 1],
            ['id' => 17, 'questionid' => 3, 'text' => 'Kulkas', 'isanswer' => 0, 'active' => 1],
            ['id' => 18, 'questionid' => 3, 'text' => 'Pensil', 'isanswer' => 1, 'active' => 1],
            ['id' => 19, 'questionid' => 3, 'text' => 'Piring', 'isanswer' => 0, 'active' => 1],
            ['id' => 20, 'questionid' => 3, 'text' => 'Penghapus', 'isanswer' => 1, 'active' => 1],
            ['id' => 21, 'questionid' => 3, 'text' => 'Bolpoin', 'isanswer' => 1, 'active' => 1],
            ['id' => 22, 'questionid' => 5, 'text' => 'Motor', 'isanswer' => 1, 'active' => 1],
            ['id' => 23, 'questionid' => 5, 'text' => 'Kapal', 'isanswer' => 0, 'active' => 1],
            ['id' => 24, 'questionid' => 5, 'text' => 'Pesawat', 'isanswer' => 0, 'active' => 1],
            ['id' => 25, 'questionid' => 5, 'text' => 'Mobil', 'isanswer' => 1, 'active' => 1],
            ['id' => 26, 'questionid' => 5, 'text' => 'Jetski', 'isanswer' => 0, 'active' => 1],
        ];

        $this->db->table('answers')->insertBatch($data);
    }
}
