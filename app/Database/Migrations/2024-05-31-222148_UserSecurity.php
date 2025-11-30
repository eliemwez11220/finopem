<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSecurity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'security_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'security_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'security_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'security_question_1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_question_2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_question_3'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'security_response_1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_response_2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_response_3'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'security_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'security_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'security_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'security_created_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'security_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'security_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'security_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'security_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('security_id', true);
        $this->forge->addForeignKey('security_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('security_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_security');
    }

    public function down()
    {
        $this->forge->dropTable('users_security');
    }
}
