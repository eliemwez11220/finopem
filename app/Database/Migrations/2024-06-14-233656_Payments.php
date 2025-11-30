<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'payment_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'payment_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'payment_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'payment_total_usd'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_total_cdf'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_fees_usd'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_fees_cdf'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_exemption_usd'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_exemption_cdf'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_exchange'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'payment_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'payment_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'payment_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'payment_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'payment_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'payment_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'payment_year_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
           'payment_fee_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'payment_student_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'payment_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'payment_user_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            /*'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'pending', 'draft'],
                'default'    => 'pending',
            ],*/
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('payment_student_id', 'students_inscriptions', 'inscription_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('payment_year_id', 'years', 'year_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('payment_fee_id', 'fees', 'fee_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('payment_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('payment_user_id', 'users', 'user_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
