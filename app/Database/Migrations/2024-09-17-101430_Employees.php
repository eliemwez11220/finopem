<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'employee_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'employee_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'employee_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
            'employee_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'employee_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'employee_othername'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'employee_title' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'employee_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'employee_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'employee_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'employee_city'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'employee_province'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'employee_country'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            
            'employee_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'employee_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'employee_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'employee_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'employee_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'employee_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'employee_service_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ], 
            
            'employee_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('employee_id', true);
        $this->forge->addForeignKey('employee_service_id', 'services', 'service_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('employee_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}

