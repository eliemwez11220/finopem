<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Feesclasses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feeclasse_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'feeclasse_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'feeclasse_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'feeclasse_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],

            'feeclasse_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'feeclasse_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feeclasse_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feeclasse_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'feeclasse_feedetail_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feeclasse_classe_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feeclasse_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('feeclasse_id', true);
        $this->forge->addForeignKey('feeclasse_feedetail_id', 'fees_details', 'feedetail_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feeclasse_classe_id', 'classes', 'classe_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feeclasse_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('fees_classes');
    }

    public function down()
    {
        $this->forge->dropTable('fees_classes');
    }
}
