<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Messages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'message_id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'message_token' => [
                'type'           => 'VARCHAR',
                'constraint'     => 75,
                'null'       => true,
            ],'message_code' => [
                'type'           => 'VARCHAR',
                'constraint'     => 10,
                'null'       => true,
            ],
            'message_sender' => [
                'type'           => 'VARCHAR',
                'constraint'     => 75,
                'null'       => true,
            ],
            'message_recipient' => [
                'type'           => 'VARCHAR',
                'constraint'     => 75,
                'null'       => true,
            ],
            'message_status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 25,
                'null'       => true,
            ],
            'message_type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 25,
                'null'       => true,
            ],
            'message_category' => [
                'type'           => 'VARCHAR',
                'constraint'     => 25,
                'null'       => true,
            ],
            'message_subject' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'       => true,
            ],
            'message_emergency' => [
                'type'           => 'BOOLEAN',
                'default'       => True,
            ],'message_body' => [
                'type'           => 'TEXT',
                'null'       => true,
            ],'message_attachment' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'default'       => True,
            ],
            'message_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'message_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'message_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'message_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('message_id', true);
        $this->forge->addForeignKey('message_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('messages');
    }

    public function down()
    {
        $this->forge->dropTable('messages');
    }
}
