<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResultsAnnualPeriods extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'annualperiod_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'annualperiod_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'annualperiod_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
         
            'annualperiod_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'annualperiod_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'annualperiod_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'annualperiod_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'annualperiod_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'annualperiod_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'annualperiod_period_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'annualperiod_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'annualperiod_section_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'annualperiod_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('annualperiod_id', true);
        $this->forge->addForeignKey('annualperiod_section_id', 'sections', 'section_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('annualperiod_period_id', 'results_period', 'period_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('annualperiod_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('annualperiod_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('results_annual_period');
    }

    public function down()
    {
        $this->forge->dropTable('results_annual_period');
    }
}