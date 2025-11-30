<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paymentsdetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'paydetails_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'paydetails_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'paydetails_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'paydetails_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null'       => true,
            ],
			'paydetails_fee_amount'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
			
            'paydetails_paid_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'paydetails_usd_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'paydetails_cdf_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'paydetails_return_amount'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            
            'paydetails_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'paydetails_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'paydetails_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'paydetails_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'paydetails_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'paydetails_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            
           'paydetails_fee_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            
            'paydetails_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'paydetails_payment_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('paydetails_id', true);
        $this->forge->addForeignKey('paydetails_fee_id', 'fees_details', 'feedetail_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('paydetails_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('paydetails_payment_id', 'payments', 'payment_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('payments_details');
    }

    public function down()
    {
        $this->forge->dropTable('payments_details');
    }
}
