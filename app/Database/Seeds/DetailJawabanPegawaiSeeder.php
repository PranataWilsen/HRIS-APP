<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DetailJawabanPegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'jawabanpegawaiid' => 1,
                'questionid'       => 1,
                'answer'           => '3'
            ],
            [
                'id' => 2,
                'jawabanpegawaiid' => 1,
                'questionid'       => 2,
                'answer'           => '5,6,7'
            ],
            [
                'id' => 3,
                'jawabanpegawaiid' => 1,
                'questionid'       => 3,
                'answer'           => '18,20,21'
            ],
            [
                'id' => 4,
                'jawabanpegawaiid' => 1,
                'questionid'       => 4,
                'answer'           => '13,16'
            ],
            [
                'id' => 5,
                'jawabanpegawaiid' => 1,
                'questionid'       => 5,
                'answer'           => '22'
            ],
            [
                'id' => 6,
                'jawabanpegawaiid' => 2,
                'questionid'       => 1,
                'answer'           => '3'
            ],
            [
                'id' => 7,
                'jawabanpegawaiid' => 2,
                'questionid'       => 2,
                'answer'           => '5,6,8'
            ],
            [
                'id' => 8,
                'jawabanpegawaiid' => 2,
                'questionid'       => 3,
                'answer'           => '18,20,21'
            ],
            [
                'id' => 9,
                'jawabanpegawaiid' => 2,
                'questionid'       => 4,
                'answer'           => '13,16'
            ],
            [
                'id' => 10,
                'jawabanpegawaiid' => 2,
                'questionid'       => 5,
                'answer'           => '22,25'
            ],
        ];

        $this->db->table('detail_jawaban_pegawai')->insertBatch($data);
    }
}
