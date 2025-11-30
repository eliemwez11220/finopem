<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Schools extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'school_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'school_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'school_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
            'school_init_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 10,
                'null' => true,
            ],
            'school_fullname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'school_shortname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'school_slogan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'school_website'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'school_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'school_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'school_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'school_city'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'school_province'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'school_country'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'school_register_number'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'school_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'school_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'school_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'school_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'school_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'school_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'school_logo' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'school_picture_cover' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],

            'school_manager_name' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],

            'school_licence' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'school_sernie_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'school_sernie_number' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            
            'school_sms_sender' => [
                'type' => 'VARCHAR',
                'constraint'     => 25,
                'null' => true,
            ],
            'school_sms_number' => [
                'type' => 'INT',
                'constraint'     => 10,
                'null' => true,
            ],
            'school_sms_sending' => [
                'type' => 'BOOLEAN',
                'null' => true,
            ],
            'school_customer_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('school_id', true);
        $this->forge->addForeignKey('school_customer_id', 'customers', 'customer_id', 'CASCADE', 'RESTRICT' );
       
        $this->forge->createTable('schools');
    }

    public function down()
    {
        $this->forge->dropTable('schools');
    }
}
