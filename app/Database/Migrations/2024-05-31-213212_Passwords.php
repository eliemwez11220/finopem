<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Passwords extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'password_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'password_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'password_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'password_device'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'password_platform'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'password_time'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'password_ipaddress'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'password_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'password_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'password_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'password_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'password_created_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'password_reseted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'password_reseted_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'password_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'password_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'password_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('password_id', true);
        $this->forge->addForeignKey('password_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('password_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_passwords');
    }

    public function down()
    {
        $this->forge->dropTable('users_passwords');
    }
}
