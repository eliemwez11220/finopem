<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Feesexemptions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exemption_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exemption_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'exemption_code'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'null'       => true,
            ],
            'exemption_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'exemption_cost_discount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'exemption_currency'          => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => true,
            ],
            'exemption_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'exemption_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'exemption_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'exemption_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exemption_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exemption_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
          
            'exemption_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'exemption_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('exemption_id', true);
        $this->forge->addForeignKey('exemption_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('exemption_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('exemptions');
    }

    public function down()
    {
        $this->forge->dropTable('exemptions');
    }
}
