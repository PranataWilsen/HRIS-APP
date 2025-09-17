<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // urutan penting! karena ada foreign key
        $this->call('DepartemenSeeder');
        $this->call('KeahlianSeeder');
        $this->call('QuestionSeeder');
        $this->call('AnswerSeeder');
        $this->call('PegawaiSeeder');
        $this->call('JawabanPegawaiSeeder');
        
        // ⚠️ untuk detail_jawaban_pegawai sebaiknya tetap import via SQL
        // tapi kalau ingin sample, panggil juga:
        // $this->call('DetailJawabanPegawaiSeeder');
    }
}
