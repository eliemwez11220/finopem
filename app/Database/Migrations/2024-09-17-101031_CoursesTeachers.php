<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesTeachers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'teacher_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'teacher_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'teacher_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'teacher_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'teacher_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'teacher_othername'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],

      
            'teacher_speciality'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'teacher_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'teacher_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
           
            'teacher_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'teacher_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'teacher_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'teacher_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'teacher_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'teacher_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'teacher_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('teacher_id', true);
        $this->forge->addForeignKey('teacher_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_teachers');
    }

    public function down()
    {
        $this->forge->dropTable('courses_teachers');
    }
}
