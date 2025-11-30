<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClassesTeachers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'classeteacher_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'classeteacher_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'classeteacher_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
         
            'classeteacher_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'classeteacher_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'classeteacher_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'classeteacher_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'classeteacher_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'classeteacher_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
          
            'classeteacher_teacher_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 'classeteacher_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            
            'classeteacher_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('classeteacher_id', true);
        $this->forge->addForeignKey('classeteacher_teacher_id', 'courses_teachers', 'teacher_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('classeteacher_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('classeteacher_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('classes_teachers');
    }

    public function down()
    {
        $this->forge->dropTable('classes_teachers');
    }
}
