<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccountsBanks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'bank_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bank_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'bank_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'bank_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'bank_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'bank_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'bank_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'bank_account_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'bank_account_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'bank_account_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'bank_account_currency'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'bank_init_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'bank_credit_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            
            'bank_debit_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'bank_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'bank_account_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'bank_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'bank_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'bank_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'bank_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'bank_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('bank_id', true);
        $this->forge->addUniqueKey(['bank_account_number'], 'bank_account_number');
        $this->forge->addForeignKey('bank_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('finances_banks');
    }

    public function down()
    {
        $this->forge->dropTable('finances_banks');
    }
}
