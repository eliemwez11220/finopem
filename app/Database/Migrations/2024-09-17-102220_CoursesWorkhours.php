<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesWorkhours extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'workhour_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'workhour_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'workhour_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'workhour_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'workhour_beach'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'workhour_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'workhour_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'workhour_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'workhour_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workhour_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workhour_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'workhour_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('workhour_id', true);
        $this->forge->addForeignKey('workhour_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_workhours');
    }

    public function down()
    {
        $this->forge->dropTable('courses_workhours');
    }
}