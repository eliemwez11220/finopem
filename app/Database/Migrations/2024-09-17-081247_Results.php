<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Results extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'result_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'result_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'result_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'result_place'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'result_points_obtained'       => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'result_points_maximum'       => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'result_percentage'       => [
                'type'       => 'DECIMAL',
                'constraint' => '3,2',
            ],
            'result_application'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'result_decision'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'result_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'result_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'result_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'result_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'result_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'result_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'result_available' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            
            'result_annualperiod_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            
            'result_student_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'result_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('result_id', true);
        $this->forge->addForeignKey('result_annualperiod_id', 'results_annual_period', 'annualperiod_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('result_student_id', 'students_inscriptions', 'inscription_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('result_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('results');
    }

    public function down()
    {
        $this->forge->dropTable('results');
    }
}