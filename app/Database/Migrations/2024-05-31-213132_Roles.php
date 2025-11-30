<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Roles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'role_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'role_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'role_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'role_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'role_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'role_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'role_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'role_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'role_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('role_id', true);
        $this->forge->addForeignKey('role_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_roles');
    }

    public function down()
    {
        $this->forge->dropTable('users_roles');
    }
}
