<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Feesdiscounts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'feediscount_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            
            'feediscount_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],

            'feediscount_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'feediscount_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feediscount_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'feediscount_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
           'feediscount_feedetail_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feediscount_exemption_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
            'feediscount_school_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('feediscount_id', true);
        $this->forge->addForeignKey('feediscount_feedetail_id', 'fees_details', 'feedetail_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feediscount_exemption_id', 'exemptions', 'exemption_id', 'CASCADE', 'RESTRICT' );
        $this->forge->addForeignKey('feediscount_school_id', 'schools', 'school_id', 'CASCADE', 'RESTRICT' );
        $this->forge->createTable('exemptions_discounts');
    }

    public function down()
    {
        $this->forge->dropTable('exemptions_discounts');
    }
}
