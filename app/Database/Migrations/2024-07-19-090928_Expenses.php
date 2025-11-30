<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Expenses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'expense_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'expense_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'expense_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'expense_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'expense_requested_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null'=>true,
            ],'expense_approved_by'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null'=>true,
            ],
            'expense_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],'expense_category'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'expense_usd_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'expense_cdf_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'expense_exchange'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'expense_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            
            'expense_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'expense_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'expense_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'expense_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'expense_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'expense_cashbox_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'expense_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'expense_section_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'expense_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('expense_id', true);
        $this->forge->addForeignKey('expense_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('expense_cashbox_id', 'fees', 'fee_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('expense_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('expense_section_id', 'sections', 'section_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('expense_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('finances_expenses');
    }

    public function down()
    {
        $this->forge->dropTable('finances_expenses');
    }
}
