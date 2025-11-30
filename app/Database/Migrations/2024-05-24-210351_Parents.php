<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'parent_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'parent_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'parent_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'parent_father_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_mother_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_tutor_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_father_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'parent_mother_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'parent_tutor_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'parent_father_phone2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'parent_mother_phone2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'parent_tutor_phone2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            
            'parent_father_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'parent_mother_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_tutor_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'parent_tutor_job'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_father_job'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'parent_mother_job'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'parent_primary_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'parent_primary_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'parent_primary_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'parent_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_emergency'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'parent_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'parent_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'parent_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'parent_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'parent_father_image' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'parent_mother_image' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'parent_tutor_image' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'parent_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('parent_id', true);
        //$this->forge->addUniqueKey(['parent_primary_email'], 'parent_primary_email');
        //$this->forge->addUniqueKey(['parent_primary_phone'], 'parent_primary_phone');
        $this->forge->addForeignKey('parent_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('students_parents');
    }

    public function down()
    {
        $this->forge->dropTable('students_parents');
    }
}

