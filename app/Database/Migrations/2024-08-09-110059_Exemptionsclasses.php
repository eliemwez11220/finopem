<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exemptionsclasses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exemptionclasse_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            
            'exemptionclasse_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],

            'exemptionclasse_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'exemptionclasse_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exemptionclasse_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'exemptionclasse_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'exemptionclasse_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'exemptionclasse_exemption_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'exemptionclasse_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('exemptionclasse_id', true);
        $this->forge->addForeignKey('exemptionclasse_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('exemptionclasse_exemption_id', 'exemptions', 'exemption_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('exemptionclasse_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('exemptions_classes');
    }

    public function down()
    {
        $this->forge->dropTable('exemptions_classes');
    }
}
