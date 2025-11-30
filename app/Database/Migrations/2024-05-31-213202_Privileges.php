<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Privileges extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'access_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'access_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'access_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'access_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'access_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'access_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'access_reading'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'access_created'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'access_updated'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'access_deleted'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'access_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'access_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'access_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'access_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'access_role_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'access_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('access_id', true);
        $this->forge->addForeignKey('access_role_id', 'users_roles', 'role_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('access_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_access');
    }

    public function down()
    {
        $this->forge->dropTable('users_access');
    }
}
