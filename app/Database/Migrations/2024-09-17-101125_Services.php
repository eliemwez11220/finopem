<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'service_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'service_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'service_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'service_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'service_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'service_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'service_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'service_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'service_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'service_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'service_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'service_department_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'service_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('service_id', true);
        $this->forge->addForeignKey('service_department_id', 'departments', 'department_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('service_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}

