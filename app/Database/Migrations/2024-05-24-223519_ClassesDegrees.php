<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClassesDegrees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'degree_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'degree_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'degree_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'degree_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'degree_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'degree_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'degree_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'degree_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'degree_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'degree_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'degree_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'degree_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('degree_id', true);
        $this->forge->addUniqueKey(['degree_code'], 'key_name');
        $this->forge->addForeignKey('degree_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('classes_degrees');
    }

    public function down()
    {
        $this->forge->dropTable('classes_degrees');
    }
}