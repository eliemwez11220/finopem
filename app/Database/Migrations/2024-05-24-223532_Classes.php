<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Classes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'classe_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'classe_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'classe_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'classe_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'classe_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'classe_subname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'classe_total_places'       => [
                'type'       => 'INT',
                'constraint' => 10,
                'null' => true,
            ],
            'classe_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'classe_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'classe_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'classe_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'classe_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'classe_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'classe_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'classe_option_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'classe_degree_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('classe_id', true);
        $this->forge->addForeignKey('classe_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT');
         $this->forge->addForeignKey('classe_option_id', 'classes_options', 'option_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('classe_degree_id', 'classes_degrees', 'degree_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('classes');
    }

    public function down()
    {
        $this->forge->dropTable('classes');
    }
}
