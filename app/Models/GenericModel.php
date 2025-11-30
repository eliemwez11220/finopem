<?php

namespace App\Models;

use CodeIgniter\Model;

class GenericModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function insert_transaction(array $table, array $data)
    {
        $this->db->transStart();
        for ($i = 1; $i <= count($table); $i++) {
            for ($j = 1; $j <= count($data); $j++) {
                $this->db->table($table[$i])->insert($data[$j]);
            }
        }
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return false;
        }
        return true;
    }

    public function save_data($table, $data)
    {
        if ($this->db->table($table)->insert($data)) {
            return $this->db->insertID();
        }else{
            return null;
        }
    }

    public function insert_data($table, $data)
    {
        $this->db->escape($data);
        if ($this->db->table($table)->insert($data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insert_batch($table, $data)
    {
        if ($this->db->table($table)->insertBatch($data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_data($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    public function update_batch($table, $data, $where)
    {
        return $this->db->table($table)->updateBatch($data, $where);
    }

    public function delete_data($table, $where = [])
    {
        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        // Perform delete operation
    
        if($this->db->table($table)->delete($where)){
            // Re-enable foreign key checks
            $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
            return true;
        }else{
            return false;
        }
         
    }
   
    public function delete_batch($table, $where = [])
    {
        return $this->db->table($table)->delete($where);
    }
    public function fetch_orWhere_data($table, $where = array(), $orwhere = array())
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where($where);
        $builder->orWhere($orwhere);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function fetch_count($table, $where = array(), $groupBy = null)
    {
        $builder = $this->db->table($table);
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        $builder->where($where);
        $result = $builder->countAllResults();
        return $result;
    }

    public function fetch_field_value($table, $where = array())
    {
        return $this->db->table($table)->getWhere($where)->getRow();
    }

    public function fetch_row_data($table, $where = array())
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where($where);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function fetch_all_data($table, $where = array(), 
    $order_by_field = '', $limit = null, $offset = null, $order_type = null, $groupbyField = null)
    {
        $mode_order_data = (!empty($order_type)) ? $order_type : 'DESC';
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->orderBy($order_by_field, $mode_order_data);
        $builder->where($where);
        if (!empty($groupbyField)) {
            $builder->groupBy($groupbyField);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if (count($result->getResult()) > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }

    public function fetch_distinct_data($table, $where = array(), $order_by_field = null, $limit = null, $offset = null)
    {
        $builder = $this->db->table($table);
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
        }
        $builder->distinct();
        $builder->select('*');
        $builder->orderBy($order_by_field, 'DESC');
        $builder->where($where);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }

    public function fetch_analytics_data($table, $where = array(), $dateFiled = null, $year = null)
    {
        $builder = $this->db->table($table);
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $builder->select('*');
            $builder->where($where);
            $builder->where('MONTH(' . $dateFiled . ')', $i);
            $builder->where('YEAR(' . $dateFiled . ')', $year);
            $query[$i] = $builder->get();
        }
        return $query;
    }


    public function fetch_sum_data($table, $where = array(), $field_sum_data = null, $monnaie = null)
    {
        $builder = $this->db->table($table);
        $builder->select($field_sum_data, $monnaie);
        $builder->where($where);
        $builder->selectSum($field_sum_data);
        $result = $builder->get();

        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
}
