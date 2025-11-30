<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cashbox extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cashbox_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cashbox_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'cashbox_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'cashbox_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null'=>true,
            ],
            'cashbox_currency'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'cashbox_credit_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            
            'cashbox_debit_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'cashbox_balance_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'cashbox_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            
            'cashbox_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'cashbox_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'cashbox_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'cashbox_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

            'cashbox_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('cashbox_id', true);
        $this->forge->addForeignKey('cashbox_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('finances_cashbox');
    }

    public function down()
    {
        $this->forge->dropTable('finances_cashbox');
    }
}
