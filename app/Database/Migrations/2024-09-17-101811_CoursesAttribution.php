<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesAttribution extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'attribution_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'attribution_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'attribution_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
         
            'attribution_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'attribution_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'attribution_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'attribution_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'attribution_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'attribution_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'attribution_course_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            'attribution_teacher_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            
            'attribution_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('attribution_id', true);
        $this->forge->addForeignKey('attribution_course_id', 'courses', 'course_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('attribution_teacher_id', 'courses_teachers', 'teacher_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('attribution_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_attribution');
    }

    public function down()
    {
        $this->forge->dropTable('courses_attribution');
    }
}
