<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddressCity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'city_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'city_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'city_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'city_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'city_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'city_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'city_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'city_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'city_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'city_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'city_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'city_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('city_id', true);
        $this->forge->addForeignKey('city_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('address_city');
    }

    public function down()
    {
        $this->forge->dropTable('address_city');
    }
}
