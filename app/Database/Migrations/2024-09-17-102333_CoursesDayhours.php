<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesDayhours extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'workdayhour_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'workdayhour_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'workdayhour_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
         
            'workdayhour_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'workdayhour_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'workdayhour_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'workdayhour_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workdayhour_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'workdayhour_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'workdayhour_wday_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'workdayhour_whour_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'workdayhour_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('workdayhour_id', true);
        $this->forge->addForeignKey('workdayhour_wday_id', 'courses_workdays', 'workday_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('workdayhour_whour_id', 'courses_workhours', 'workhour_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('workdayhour_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_workdayhours');
    }

    public function down()
    {
        $this->forge->dropTable('courses_workdayhours');
    }
}
