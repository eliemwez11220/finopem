<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesBranchs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'branch_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'branch_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'branch_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'branch_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'branch_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'branch_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'branch_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'branch_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'branch_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'branch_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'branch_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'branch_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('branch_id', true);
        $this->forge->addForeignKey('branch_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_branch');
    }

    public function down()
    {
        $this->forge->dropTable('courses_branch');
    }
}