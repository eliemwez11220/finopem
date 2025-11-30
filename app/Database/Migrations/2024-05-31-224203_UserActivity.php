<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserActivity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'activity_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'activity_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'activity_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'activity_ipaddress'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'activity_device'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'activity_platform'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'activity_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'activity_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'activity_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'activity_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'activity_created_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'activity_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'activity_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'activity_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('activity_id', true);
        $this->forge->addForeignKey('activity_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('activity_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('users_activities');
    }

    public function down()
    {
        $this->forge->dropTable('users_activities');
    }
}
