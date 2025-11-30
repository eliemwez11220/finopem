<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paymentsreports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'report_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'report_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'report_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'report_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'report_total_paid'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            
            'report_total_fees'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'report_balance'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'report_currency'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],'report_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'report_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'report_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'report_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'report_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'report_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'report_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],

            'report_student_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'report_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'report_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('report_id', true);
        $this->forge->addForeignKey('report_student_id', 'students_inscriptions', 'inscription_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('report_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('report_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('report_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('payments_reports');
    }

    public function down()
    {
        $this->forge->dropTable('payments_reports');
    }
}
