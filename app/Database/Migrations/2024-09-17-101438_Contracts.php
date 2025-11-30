<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contracts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'contract_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'contract_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'contract_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
            'contract_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'contract_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'contract_started_at'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'contract_closed_at'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            //SALAIRE DE BASE
            'contract_salary_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //INDEMNITE DE TRANSPORT JOURNALIER
            'contract_transport_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //INDEMNITE DE LOGEMENT
            'contract_housing_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //ALLOCATIONS FAMILIALES
            'contract_family_allow_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //CNSS QPO
            'contract_fees_worker_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //CNSS QPP
            'contract_fees_employer_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //IPR GLOBALE
            'contract_taxes_worker_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //INPP QPO
            'contract_training_worker_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //INPP QPP
            'contract_training_employer_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            //ONEM
            'contract_taxes_jobs_amount'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'contract_salary_type'       => [
                'type'       => 'ENUM',
                'constraint' => ['hourly', 'daily', 'weekly', 'monthly', 'yearly'],
                'default'    => 'daily',
            ],
            'contract_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'contract_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'contract_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'contract_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'contract_doc_resume'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'contract_doc_letter'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'contract_doc_identity'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'contract_doc_education'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'contract_employee_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            'contract_category_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            
            'contract_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('contract_id', true);
        $this->forge->addForeignKey('contract_category_id', 'categories', 'category_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('contract_employee_id', 'employees', 'employee_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('contract_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('contracts');
    }

    public function down()
    {
        $this->forge->dropTable('contracts');
    }
}
