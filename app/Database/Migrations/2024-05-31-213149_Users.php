<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'user_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'user_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_double_auth'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_oauth_login'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_oauth_provider'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'user_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_session_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_session_count'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'user_gender'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_language'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_trying_login'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'user_password_expire'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'user_password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_old_password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_picture'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_avatar'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'user_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'user_lastlogin_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 'user_lastlogout_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 'user_changepass_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
            'user_resetpass_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
            'user_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_role_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'user_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('user_id', true);
        //$this->forge->addUniqueKey(['user_email'], 'user_email');
        //$this->forge->addUniqueKey(['user_phone'], 'user_phone');
        $this->forge->addForeignKey('user_role_id', 'users_roles', 'role_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('user_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
