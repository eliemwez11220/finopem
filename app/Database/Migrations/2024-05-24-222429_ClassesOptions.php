<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClassesOptions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'option_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'option_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'option_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'option_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'option_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'option_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'option_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'option_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'option_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'option_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'option_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'option_section_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],

            'option_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('option_id', true);
        $this->forge->addForeignKey('option_section_id', 'sections', 'section_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('option_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('classes_options');
    }

    public function down()
    {
        $this->forge->dropTable('classes_options');
    }
}
