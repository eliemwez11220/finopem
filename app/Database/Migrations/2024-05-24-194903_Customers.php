<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'customer_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'customer_token'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'customer_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            
            'customer_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'customer_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            
            'customer_phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
            ],
            'customer_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_city'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'customer_province'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'customer_country'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'customer_category'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
            ],
            'customer_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'customer_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_notes'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'customer_created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'customer_updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'customer_deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'customer_password' => [
                'type' => 'VARCHAR',
                'constraint'     => 75,
                'null' => true,
            ],
            'customer_double_auth'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_oauth_login'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_oauth_provider'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_session_status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_session_count'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'customer_gender'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],'customer_language'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_trying_login'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'customer_password_expire'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'customer_old_password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_picture'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_avatar'       => [
                'type'       => 'VARCHAR',
                'constraint' => '75',
                'null' => true,
            ],
            'customer_lastlogin_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 'customer_lastlogout_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 'customer_changepass_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
            'customer_resetpass_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ], 
        ]);
        $this->forge->addKey('customer_id', true);
        //$this->forge->addUniqueKey(['customer_email'], 'customer_email');
        //$this->forge->addUniqueKey(['customer_phone'], 'customer_phone');
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
