<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slipnotes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'slipnote_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slipnote_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'slipnote_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'slipnote_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'slipnote_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'slipnote_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'slipnote_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'slipnote_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'slipnote_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'slipnote_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'slipnote_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'slipnote_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('slipnote_id', true);
        $this->forge->addForeignKey('slipnote_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('slipnotes');
    }

    public function down()
    {
        $this->forge->dropTable('slipnotes');
    }
}

