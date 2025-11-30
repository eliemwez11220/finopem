<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Feesexemptionsstudents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feestudent_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            
            'feestudent_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],

            'feestudent_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'feestudent_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feestudent_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feestudent_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'feestudent_inscription_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feestudent_exemption_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feestudent_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('feestudent_id', true);
        $this->forge->addForeignKey('feestudent_inscription_id', 'students_inscriptions', 'inscription_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feestudent_exemption_id', 'exemptions', 'exemption_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feestudent_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('exemptions_students');
    }

    public function down()
    {
        $this->forge->dropTable('exemptions_students');
    }
}
