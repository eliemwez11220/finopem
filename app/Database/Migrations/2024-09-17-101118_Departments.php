<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Departments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'department_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'department_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'department_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'department_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'department_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'department_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'department_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'department_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'department_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'department_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'department_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'department_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('department_id', true);
        $this->forge->addForeignKey('department_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('departments');
    }

    public function down()
    {
        $this->forge->dropTable('departments');
    }
}
