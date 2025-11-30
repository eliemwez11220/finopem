<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Years extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'year_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'year_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'year_started'       => [
                'type'       => 'YEAR',
                'constraint' => '4',
            ],
            'year_ended'       => [
                'type'       => 'YEAR',
                'constraint' => '4',
            ],
            'year_start_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'year_close_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'year_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'year_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'year_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'year_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'year_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'year_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('year_id', true);
        $this->forge->addForeignKey('year_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('years');
    }

    public function down()
    {
        $this->forge->dropTable('years');
    }
}
