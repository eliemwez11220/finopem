<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StudentsAffinity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'affinity_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'affinity_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'affinity_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'affinity_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'affinity_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'affinity_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'affinity_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],'affinity_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'affinity_parent_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            'affinity_student_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'affinity_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('affinity_id', true);
        $this->forge->addForeignKey('affinity_parent_id', 'students_parents', 'parent_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('affinity_student_id', 'students', 'student_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('affinity_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('students_affinity');
    }

    public function down()
    {
        $this->forge->dropTable('students_affinity');
    }
}
