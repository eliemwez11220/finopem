<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Feesdetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feedetail_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'feedetail_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'feedetail_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'feedetail_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
			'feedetail_subname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'feedetail_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'feedetail_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'feedetail_cost_payable'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'feedetail_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'feedetail_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feedetail_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feedetail_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'feedetail_fee_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feedetail_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('feedetail_id', true);
        $this->forge->addForeignKey('feedetail_fee_id', 'fees', 'fee_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feedetail_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('fees_details');
    }

    public function down()
    {
        $this->forge->dropTable('fees_details');
    }
}
