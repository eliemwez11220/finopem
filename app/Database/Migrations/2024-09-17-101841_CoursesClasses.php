<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesClasses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'courseclasse_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'courseclasse_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'courseclasse_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'courseclasse_weekhours'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'courseclasse_periodpoint'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'courseclasse_examcondition'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'courseclasse_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'courseclasse_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'courseclasse_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'courseclasse_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'courseclasse_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'courseclasse_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'courseclasse_course_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            'courseclasse_teacher_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 'courseclasse_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            
            'courseclasse_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('courseclasse_id', true);
        $this->forge->addForeignKey('courseclasse_course_id', 'courses', 'course_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('courseclasse_teacher_id', 'courses_teachers', 'teacher_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('courseclasse_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('courseclasse_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_classes');
    }

    public function down()
    {
        $this->forge->dropTable('courses_classes');
    }
}
