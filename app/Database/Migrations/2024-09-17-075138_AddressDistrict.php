<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddressDistrict extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'district_id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'district_token'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
        ],
        'district_code'       => [
            'type'       => 'VARCHAR',
            'constraint' => '10',
        ],
        'district_name'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'district_shortname'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
     
        'district_status'       => [
            'type'       => 'VARCHAR',
            'constraint' => '25',
            'null' => true,
        ],
        'district_type'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'district_notes'       => [
            'type'       => 'TEXT',
            'null' => true,
        ],
        'district_created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'district_updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'district_deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
       
        'district_municipality_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],'district_school_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],
    ]);
    $this->forge->addKey('district_id', true);
    $this->forge->addForeignKey('district_municipality_id', 'address_municipality', 'municipality_id', 'CASCADE', 'RESTRICT' );
    $this->forge->addForeignKey('district_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
    $this->forge->createTable('address_district');
}

public function down()
{
    $this->forge->dropTable('address_district');
}
}