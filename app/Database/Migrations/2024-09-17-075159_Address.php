<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Address extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'address_id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'address_token'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
        ],
        'address_home_code'       => [
            'type'       => 'VARCHAR',
            'constraint' => '10',
        ],
        'address_area_name'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'address_street_name'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
     
        'address_status'       => [
            'type'       => 'VARCHAR',
            'constraint' => '25',
            'null' => true,
        ],
        'address_type'       => [
            'type'       => 'VARCHAR',
            'constraint' => '75',
            'null' => true,
        ],
        'address_notes'       => [
            'type'       => 'TEXT',
            'null' => true,
        ],
        'address_created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'address_updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'address_deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
       
        'address_parent_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],'address_disctric_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],'address_municipality_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],'address_school_id' => [
            'type' => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'null' => true,
        ],
    ]);
    $this->forge->addKey('address_id', true);
    $this->forge->addForeignKey('address_parent_id', 'students_parents', 'parent_id', 'CASCADE', 'RESTRICT' );
    $this->forge->addForeignKey('address_municipality_id', 'address_municipality', 'municipality_id', 'CASCADE', 'RESTRICT' );
    $this->forge->addForeignKey('address_disctrict_id', 'address_disctrict', 'disctrict_id', 'CASCADE', 'RESTRICT' );
    $this->forge->addForeignKey('address_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
    $this->forge->createTable('address');
}

public function down()
{
    $this->forge->dropTable('address');
}
}
