<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'document_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'document_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'document_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],'document_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'document_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'document_delivery_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ], 'document_validity_date'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'document_quantity'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '10,2',
                'null'       => true,
            ],
            'document_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'document_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'document_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'document_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'document_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'document_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'document_student_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'document_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            
        ]);
        $this->forge->addKey('document_id', true);
        $this->forge->addForeignKey('document_student_id', 'students', 'student_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('document_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('students_documents');
    }

    public function down()
    {
        $this->forge->dropTable('students_documents');
    }
}
