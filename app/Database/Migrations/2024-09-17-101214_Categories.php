<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'category_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'category_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'category_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'category_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'category_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'category_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'category_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'category_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'category_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'category_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('category_id', true);
        $this->forge->addForeignKey('category_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
