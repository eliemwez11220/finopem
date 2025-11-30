<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResultsPeriods extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'period_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'period_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'period_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'period_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'period_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'period_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'period_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'period_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'period_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'period_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'period_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'period_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('period_id', true);
        $this->forge->addForeignKey('period_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('results_period');
    }

    public function down()
    {
        $this->forge->dropTable('results_period');
    }
}