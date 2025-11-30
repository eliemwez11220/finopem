<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function login_user_data($username)
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->where('user_name', $username);
        $builder->orWhere('user_email', $username);
        $builder->orWhere('user_phone', $username);
        $builder->orWhere('user_code', $username);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
    public function login_customer_data($username)
    {
        $builder = $this->db->table('customers');
        $builder->select('*');
        $builder->where('customer_code', $username);
        $builder->orWhere('customer_email', $username);
        $builder->orWhere('customer_phone', $username);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
}
