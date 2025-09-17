<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HrisSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // departments
        $db->table('departments')->insertBatch([
            ['name'=>'IT','active'=>1],
            ['name'=>'HR','active'=>1],
            ['name'=>'Finance','active'=>1],
            ['name'=>'Operations','active'=>1]
        ]);

        // positions
        $db->table('positions')->insertBatch([
            ['name'=>'Developer','active'=>1],
            ['name'=>'QA','active'=>1],
            ['name'=>'HR Officer','active'=>1],
            ['name'=>'Accountant','active'=>1]
        ]);

        // sample employees
        $db->table('employees')->insertBatch([
            ['nik'=>'EMP001','name'=>'Andi Saputra','email'=>'andi@example.com','phone'=>'081234567890','gender'=>'P','department_id'=>1,'position_id'=>1,'skills'=>'PHP,MySQL,CI4','join_date'=>'2023-01-10','active'=>1],
            ['nik'=>'EMP002','name'=>'Budi Santoso','email'=>'budi@example.com','phone'=>'081234567891','gender'=>'P','department_id'=>2,'position_id'=>3,'skills'=>'Recruitment,Interviewing','join_date'=>'2022-05-21','active'=>1],
            ['nik'=>'EMP003','name'=>'Citra Dewi','email'=>'citra@example.com','phone'=>'081234567892','gender'=>'W','department_id'=>1,'position_id'=>2,'skills'=>'Testing,Automation','join_date'=>'2021-11-01','active'=>1]
        ]);

        // questions & answers (simple sample)
        $db->table('questions')->insertBatch([
            ['question'=>'PHP adalah bahasa pemrograman server-side?','active'=>1],
            ['question'=>'CodeIgniter4 menggunakan namespace?','active'=>1],
            ['question'=>'MySQL adalah DBMS?','active'=>1]
        ]);

        // ambil inserted question ids (asumsi autoincrement mulai dari 1)
        $answers = [
            // question 1
            ['questionid'=>1,'text'=>'Benar','isanswer'=>1],
            ['questionid'=>1,'text'=>'Salah','isanswer'=>0],
            // question 2
            ['questionid'=>2,'text'=>'Benar','isanswer'=>1],
            ['questionid'=>2,'text'=>'Salah','isanswer'=>0],
            // question 3
            ['questionid'=>3,'text'=>'Benar','isanswer'=>1],
            ['questionid'=>3,'text'=>'Salah','isanswer'=>0],
        ];
        $db->table('answers')->insertBatch($answers);

        // jawaban_pegawai + detail_jawaban_pegawai (sample)
        // Pegawai 1: menjawab semua benar
        $db->table('jawaban_pegawai')->insert(['pegawaiid'=>1,'active'=>1]);
        $jawaban1id = $db->insertID();
        $db->table('detail_jawaban_pegawai')->insertBatch([
            ['jawabanpegawaiid'=>$jawaban1id,'questionid'=>1,'answer'=>'1'],
            ['jawabanpegawaiid'=>$jawaban1id,'questionid'=>2,'answer'=>'3'],
            ['jawabanpegawaiid'=>$jawaban1id,'questionid'=>3,'answer'=>'5']
        ]);

        // Pegawai 2: 1 jawaban salah
        $db->table('jawaban_pegawai')->insert(['pegawaiid'=>2,'active'=>1]);
        $jawaban2id = $db->insertID();
        $db->table('detail_jawaban_pegawai')->insertBatch([
            ['jawabanpegawaiid'=>$jawaban2id,'questionid'=>1,'answer'=>'2'],
            ['jawabanpegawaiid'=>$jawaban2id,'questionid'=>2,'answer'=>'3'],
            ['jawabanpegawaiid'=>$jawaban2id,'questionid'=>3,'answer'=>'5']
        ]);

        // Pegawai 3: menjawab sebagian
        $db->table('jawaban_pegawai')->insert(['pegawaiid'=>3,'active'=>1]);
        $jawaban3id = $db->insertID();
        $db->table('detail_jawaban_pegawai')->insertBatch([
            ['jawabanpegawaiid'=>$jawaban3id,'questionid'=>1,'answer'=>'1'],
            ['jawabanpegawaiid'=>$jawaban3id,'questionid'=>2,'answer'=>'4'] // salah
        ]);
    }
}
