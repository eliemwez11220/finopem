<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'fee_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'fee_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'fee_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'fee_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'fee_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'fee_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'fee_total_payable'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'       => true,
            ],
            'fee_currency_payable'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '75',
                'null'       => true,
            ],
            'fee_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'fee_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'fee_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'fee_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'fee_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('fee_id', true);
        $this->forge->addForeignKey('fee_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('fees');
    }

    public function down()
    {
        $this->forge->dropTable('fees');
    }
}