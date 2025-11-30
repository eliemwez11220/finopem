<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Userlogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'log_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'log_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'log_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'log_ipaddress'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'log_device'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'log_platform'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'log_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'log_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'log_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'log_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'log_created_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'log_login_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'log_logout_at'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'log_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'log_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'log_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('log_id', true);
        $this->forge->addForeignKey('log_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('log_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_logs');
    }

    public function down()
    {
        $this->forge->dropTable('users_logs');
    }
}
