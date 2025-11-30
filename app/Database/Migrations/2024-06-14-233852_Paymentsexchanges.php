<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paymentsexchanges extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exchange_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exchange_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'exchange_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'exchange_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'exchange_value'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'exchange_start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'exchange_end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'exchange_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'exchange_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'exchange_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'exchange_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exchange_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exchange_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'exchange_currency_id' => [
                'type' => 'VARCHAR',
                'constraint'     => '75',
                'null' => true,
            ],
            'exchange_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('exchange_id', true);
        $this->forge->addForeignKey('exchange_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('payments_exchanges');
    }

    public function down()
    {
        $this->forge->dropTable('payments_exchanges');
    }
}
