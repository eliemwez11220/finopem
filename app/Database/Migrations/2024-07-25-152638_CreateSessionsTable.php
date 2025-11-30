<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => 40,
            ],
            'ip_address' => [
                'type'           => 'VARCHAR',
                'constraint'     => 45,
            ],
            'timestamp' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'default'        => 0,
            ],
            'data' => [
                'type'           => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('ip_address', true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable('ci_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions');
    }
}
