<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transaction_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'transaction_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'transaction_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'transaction_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null'=>true,
            ],
            'transaction_currency'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'transaction_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            
            'transaction_exchange'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'transaction_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'transaction_attachment'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            
            'transaction_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'transaction_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'transaction_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'transaction_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'transaction_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'transaction_cashbox_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'transaction_bank_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'transaction_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'transaction_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('transaction_id', true);
        $this->forge->addForeignKey('transaction_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('transaction_cashbox_id', 'finances_cashbox', 'cashbox_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('transaction_bank_id', 'finances_banks', 'bank_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('transaction_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('transaction_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('finances_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('finances_transactions');
    }
}
