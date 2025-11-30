<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sections extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'section_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'section_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'section_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'section_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'section_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'section_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'section_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'section_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'section_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'section_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'section_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'section_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('section_id', true);
        $this->forge->addForeignKey('section_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('sections');
    }

    public function down()
    {
        $this->forge->dropTable('sections');
    }
}
