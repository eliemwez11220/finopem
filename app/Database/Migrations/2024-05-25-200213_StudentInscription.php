<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StudentInscription extends Migration
{ 
    public function up()
    {
        $this->forge->addField([
        'inscription_id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'inscription_token'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
        ],
        'inscription_code'       => [
            'type'       => 'VARCHAR',
            'constraint' => '10',
        ],
        'inscription_date'       => [
            'type'       => 'DATE',
            'null' => true,
        ],
        'inscription_validation'       => [
            'type'       => 'DATE',
            'null' => true,
        ],
        'inscription_status'       => [
            'type'       => 'VARCHAR',
            'constraint' => '25',
            'null' => true,
        ],
        'inscription_type'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'inscription_origin_school'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'inscription_document_name'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'inscription_document_file'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'inscription_notes'       => [
            'type'       => 'TEXT',
            'null' => true,
        ],
        'inscription_created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'inscription_updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'inscription_deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
       
        'inscription_school_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],
        'inscription_classe_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],

        'inscription_student_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],
        'inscription_year_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],
    ]);
    $this->forge->addKey('inscription_id', true);
    $this->forge->addForeignKey('inscription_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT');
    $this->forge->addForeignKey('inscription_student_id', 'students', 'student_id', 'CASCADE', 'RESTRICT');
    $this->forge->addForeignKey('inscription_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT');
    $this->forge->addForeignKey('inscription_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT');
    $this->forge->createTable('students_inscriptions');
}

public function down()
{
    $this->forge->dropTable('students_inscriptions');
}
}
