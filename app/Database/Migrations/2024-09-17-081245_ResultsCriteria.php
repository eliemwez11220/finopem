<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResultsCriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'criteria_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'criteria_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'criteria_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'criteria_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'criteria_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'criteria_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'criteria_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'criteria_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'criteria_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            
            'criteria_period_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            
            'criteria_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'criteria_fee_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            
            'criteria_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('criteria_id', true);
        $this->forge->addForeignKey('criteria_period_id', 'results_annual_period', 'annualperiod_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('criteria_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('criteria_fee_id', 'fees_details', 'feedetail_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('criteria_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('results_criteria');
    }

    public function down()
    {
        $this->forge->dropTable('results_criteria');
    }
}