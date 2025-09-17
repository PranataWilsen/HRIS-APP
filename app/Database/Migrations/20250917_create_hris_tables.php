<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHrisTables extends Migration
{
    public function up()
    {
        // departments
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>100],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('departments', true);

        // positions
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>100],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('positions', true);

        // employees
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'nik' => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>200],
            'email' => ['type'=>'VARCHAR','constraint'=>150,'null'=>true],
            'phone' => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],
            'gender' => ['type'=>'CHAR','constraint'=>1,'null'=>true],
            'department_id' => ['type'=>'INT','constraint'=>11,'null'=>true],
            'position_id' => ['type'=>'INT','constraint'=>11,'null'=>true],
            'address' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'skills' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'join_date' => ['type'=>'DATE','null'=>true],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('department_id','departments','id','SET NULL','CASCADE');
        $this->forge->addForeignKey('position_id','positions','id','SET NULL','CASCADE');
        $this->forge->createTable('employees', true);

        // questions
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'question' => ['type'=>'VARCHAR','constraint'=>300],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('questions', true);

        // answers
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'questionid' => ['type'=>'INT','constraint'=>11],
            'text' => ['type'=>'VARCHAR','constraint'=>300],
            'isanswer' => ['type'=>'TINYINT','constraint'=>1,'default'=>0],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('questionid','questions','id','CASCADE','CASCADE');
        $this->forge->createTable('answers', true);

        // jawaban_pegawai (header)
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'pegawaiid' => ['type'=>'INT','constraint'=>11],
            'active' => ['type'=>'TINYINT','constraint'=>1,'default'=>1],
            'created_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pegawaiid','employees','id','CASCADE','CASCADE');
        $this->forge->createTable('jawaban_pegawai', true);

        // detail_jawaban_pegawai
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'jawabanpegawaiid' => ['type'=>'INT','constraint'=>11],
            'questionid' => ['type'=>'INT','constraint'=>11],
            'answer' => ['type'=>'VARCHAR','constraint'=>300], // menyimpan answer.id atau teks
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jawabanpegawaiid','jawaban_pegawai','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('questionid','questions','id','CASCADE','CASCADE');
        $this->forge->createTable('detail_jawaban_pegawai', true);
    }

    public function down()
    {
        $this->forge->dropTable('detail_jawaban_pegawai', true);
        $this->forge->dropTable('jawaban_pegawai', true);
        $this->forge->dropTable('answers', true);
        $this->forge->dropTable('questions', true);
        $this->forge->dropTable('employees', true);
        $this->forge->dropTable('positions', true);
        $this->forge->dropTable('departments', true);
    }
}
