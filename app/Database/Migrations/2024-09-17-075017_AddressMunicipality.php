<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddressMunicipality extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'municipality_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'municipality_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'municipality_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'municipality_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'municipality_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'municipality_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'municipality_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'municipality_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'municipality_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'municipality_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'municipality_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'municipality_city_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'municipality_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('municipality_id', true);
        $this->forge->addForeignKey('municipality_city_id', 'address_city', 'city_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('municipality_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('address_municipality');
    }

    public function down()
    {
        $this->forge->dropTable('address_municipality');
    }
}