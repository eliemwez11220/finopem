<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesWorkdays extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'workday_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'workday_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'workday_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'workday_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'workday_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
         
            'workday_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'workday_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'workday_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'workday_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workday_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workday_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'workday_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('workday_id', true);
        $this->forge->addForeignKey('workday_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_workdays');
    }

    public function down()
    {
        $this->forge->dropTable('courses_workdays');
    }
}