<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoursesDayhoursClasses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dayhourclasse_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dayhourclasse_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'dayhourclasse_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
         
            'dayhourclasse_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'dayhourclasse_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'dayhourclasse_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'dayhourclasse_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'dayhourclasse_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'dayhourclasse_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           
            'dayhourclasse_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'dayhourclasse_workdayhour_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'dayhourclasse_course_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],'dayhourclasse_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('dayhourclasse_id', true);
        $this->forge->addForeignKey('dayhourclasse_course_id', 'courses', 'course_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('dayhourclasse_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('dayhourclasse_workdayhour_id', 'courses_workdayhours', 'workdayhour_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('dayhourclasse_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('courses_dayhours_classes');
    }

    public function down()
    {
        $this->forge->dropTable('courses_dayhours_classes');
    }
}
