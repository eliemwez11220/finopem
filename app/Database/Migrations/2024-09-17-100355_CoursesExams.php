<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesExams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exam_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exam_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'exam_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'exam_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'exam_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'exam_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'exam_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'exam_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'exam_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exam_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exam_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'exam_course_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 'exam_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('exam_id', true);
        $this->forge->addForeignKey('exam_course_id', 'courses_exam', 'exam_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('exam_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_exam');
    }

    public function down()
    {
        $this->forge->dropTable('courses_exam');
    }
}