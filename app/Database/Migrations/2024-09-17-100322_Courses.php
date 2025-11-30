<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Courses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'course_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'course_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'course_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'course_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'course_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'course_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'course_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'course_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'course_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'course_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'course_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'course_branch_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 'course_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('course_id', true);
        $this->forge->addForeignKey('course_branch_id', 'courses_branch', 'branch_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('course_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses');
    }

    public function down()
    {
        $this->forge->dropTable('courses');
    }
}
