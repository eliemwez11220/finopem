<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Students extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'student_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'student_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'student_permanent_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'student_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_surname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'student_gender'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'student_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'student_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_sernie_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
           
            'student_birthday'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'student_born_place'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_confession'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'student_documents'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'student_nationality'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_province'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_territoy'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_sector'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_grouping'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_village'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'student_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'student_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'student_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'student_picture'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'student_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],

            'student_parent_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('student_id', true);
        //$this->forge->addUniqueKey(['student_email'], 'student_email');
        //$this->forge->addUniqueKey(['student_phone'], 'student_phone');
        $this->forge->addForeignKey('student_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('student_parent_id', 'students_parents', 'parent_id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}