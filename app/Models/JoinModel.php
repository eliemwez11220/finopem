<?php

namespace App\Models;

use CodeIgniter\Model;

class JoinModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function fetch_join_data(
        $table,
        $joinTable,
        $joinConstraint,
        $where = array(),
        $order_by_field = '',
        $order_type = null,
        $oneRow = FALSE,
        $limit = null,
        $offset = null,
        $groupbyField = null,
        $sum_field = null,
        $filterField = null,
        $startdate = null,
        $enddate = null
    ) {
        $mode_order_data = (!empty($order_type)) ? $order_type : 'DESC';
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->orderBy($order_by_field, $mode_order_data);
        $builder->where($where);

        $builder->join($joinTable, $joinConstraint);

        if (!empty($groupbyField)) {
            $builder->groupBy($groupbyField);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }

        if ($oneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_filter_data(
        $table = null,
        $joinTable = null,
        $joinConstraint = null,
        $where = array(),
        $filterField = null,
        $startdate = null,
        $enddate = null,
        $createdDate = null,
        $year = null
    ) {
        //$mode_order_data = (!empty($order_type)) ? $order_type : 'DESC';
        if (!empty($filterField)) {
            $builder = $this->db->table($table);
            $builder->select('*');
            $builder->orderBy($startdate, 'DESC');
            $builder->where($where);
            $builder->where('YEAR(' . $createdDate . ')', $year);
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
            $builder->join($joinTable, $joinConstraint);

            $result = $builder->get();

            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_dashboard_data(
        $table,
        $where = array(),
        $dateFiled = null,
        $year = null,
        $type = null,
        $joinTable = null,
        $joinConstraint = null
    ) {
        $builder = $this->db->table($table);
        $query = array();
        if ($type == 'yearly') {
            for ($i = 1; $i <= 12; $i++) {
                if (! empty($joinTable) && (!empty($joinConstraint))) {
                    $builder->join($joinTable, $joinConstraint);
                }
                $builder->select('*');
                $builder->where($where);
                $builder->where('MONTH(' . $dateFiled . ')', $i);
                $builder->where('YEAR(' . $dateFiled . ')', $year);
                $query[$i] = $builder->get();
            }
        } elseif ($type == 'weekly') {
            for ($i = 1; $i <= 7; $i++) {
                if (! empty($joinTable) && (!empty($joinConstraint))) {
                    $builder->join($joinTable, $joinConstraint);
                }
                $builder->select('*');
                $builder->where($where);
                $builder->where('WEEK(' . $dateFiled . ')', $i);
                $builder->where('YEAR(' . $dateFiled . ')', $year);
                $query[$i] = $builder->get();
            }
        } else {
            for ($i = 1; $i <= 24; $i++) {
                if (! empty($joinTable) && (!empty($joinConstraint))) {
                    $builder->join($joinTable, $joinConstraint);
                }
                $builder->select('*');
                $builder->where($where);
                $builder->where('HOUR(' . $dateFiled . ')', $i);
                $builder->where('YEAR(' . $dateFiled . ')', $year);
                $query[$i] = $builder->get();
            }
        }

        return $query;
    }
    public function fetch_join_classes(
        $where = array(),
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = FALSE,
        $groupbyField = null,
        $limit = null,
        $offset = null,
        $filterField = '',
        $startdate = '',
        $enddate = ''
    ) {
        $builder = $this->db->table('classes');
        $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($groupbyField)) {
            $builder->groupBy($groupbyField);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        //$builder->join('years', 'years.year_id = classes.classe_year_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_students_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('students_inscriptions');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('students_parents', 'students_parents.parent_id = students.student_parent_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_count_students($where = array(), $groupby = null)
    {
        $builder = $this->db->table('students_inscriptions');
        $builder->select('*');
        $builder->where($where);

        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('students_parents', 'students_parents.parent_id = students.student_parent_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        $builder->where($where);
        $result = $builder->countAllResults();
        return $result;
    }
    public function fetch_search_data($where = array(), $query = null, $limit = null, $offset = null)
    {
        $builder = $this->db->table('students_inscriptions');
        $builder->select('*');
        $builder->where($where);
        $builder->like('student_firstname', $query);
        $builder->orLike('student_lastname', $query);
        $builder->orLike('student_code', $query);
        $builder->orLike('inscription_date', $query);
        $builder->orLike('classe_name', $query);
        $builder->orderBy('option_name', 'DESC');

        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('students_parents', 'students_parents.parent_id = students.student_parent_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

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
    public function fetch_search_payments($where = array(), $query = null, $limit = null, $offset = null)
    {
        $builder = $this->db->table('payments');
        $builder->select('*');
        $builder->where($where);
        $builder->like('payment_code', $query);
        $builder->orLike('student_firstname', $query);
        $builder->orLike('student_lastname', $query);
        $builder->orLike('student_code', $query);
        $builder->orLike('inscription_date', $query);
        $builder->orLike('classe_name', $query);
        $builder->orderBy('option_name', 'DESC');


        //$builder->join('fees_details', 'fees_details.feedetail_id = payments_details.paydetails_fee_id');
        //$builder->join('payments', 'payments.payment_id = payments_details.paydetails_payment_id');

        $builder->join('fees', 'fees.fee_id = payments.payment_fee_id');
        $builder->join('years', 'years.year_id = payments.payment_year_id');

        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = payments.payment_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
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

    public function fetch_fees_classes($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $group_by = '', $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('fees_classes');
        $builder->select($selectFields);
        $builder->distinct();
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($group_by)) {
            $builder->groupBy($group_by);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('fees_details', 'fees_details.feedetail_id = fees_classes.feeclasse_feedetail_id');
        $builder->join('fees', 'fees.fee_id = fees_details.feedetail_fee_id');

        $builder->join('classes', 'classes.classe_id = fees_classes.feeclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_exemptions_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('exemptions_discounts');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('fees_details', 'fees_details.feedetail_id = exemptions_discounts.feediscount_feedetail_id');
        $builder->join('exemptions', 'exemptions.exemption_id = exemptions_discounts.feediscount_exemption_id');
        $builder->join('fees', 'fees.fee_id = fees_details.feedetail_fee_id');


        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_exemptions_students($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('exemptions_students');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('exemptions', 'exemptions.exemption_id = exemptions_students.feestudent_exemption_id');
        //$builder->join('exemptions', 'exemptions.exemption_id = exemptions_students.feestudent_exemption_id');
        //$builder->join('exemptions_discounts', 'exemptions_discounts.feediscount_id = exemptions_students.feestudent_exemption_id');
        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = exemptions_students.feestudent_inscription_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_exemptions_classes($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('exemptions_classes');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('exemptions', 'exemptions.exemption_id = exemptions_classes.exemptionclasse_exemption_id');
        $builder->join('classes', 'classes.classe_id = exemptions_classes.exemptionclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        $builder->join('years', 'years.year_id = exemptions.exemption_year_id');
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_payments_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('payments_details');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('fees_details', 'fees_details.feedetail_id = payments_details.paydetails_fee_id');
        $builder->join('payments', 'payments.payment_id = payments_details.paydetails_payment_id');

        $builder->join('fees', 'fees.fee_id = payments.payment_fee_id');
        $builder->join('years', 'years.year_id = payments.payment_year_id');

        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = payments.payment_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_paydetails_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('payments_details');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('payments', 'payments.payment_id = payments_details.paydetails_payment_id');
        //$builder->join('years', 'years.year_id = payments.payment_year_id');
        $builder->join('fees_details', 'fees_details.feedetail_id = payments_details.paydetails_fee_id');
        $builder->join('fees', 'fees.fee_id = fees_details.feedetail_fee_id');
        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = payments.payment_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_users_payments($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('payments_details');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('payments', 'payments.payment_id = payments_details.paydetails_payment_id');

        $builder->join('fees_details', 'fees_details.feedetail_id = payments_details.paydetails_fee_id');
        $builder->join('fees', 'fees.fee_id = fees_details.feedetail_fee_id');
        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = payments.payment_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        /**/
        $builder->join('users', 'users.user_id = payments.payment_user_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_expenses_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('finances_expenses');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        $builder->join('fees', 'fees.fee_id = finances_expenses.expense_cashbox_id');
        $builder->join('years', 'years.year_id = finances_expenses.expense_year_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_transactions_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('finances_transactions');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('finances_cashbox', 'finances_cashbox.cashbox_id = finances_transactions.transaction_cashbox_id');
        $builder->join('finances_banks', 'finances_banks.bank_id = finances_transactions.transaction_bank_id');
        $builder->join('years', 'years.year_id = finances_transactions.transaction_year_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_users_sections($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $sum_field = null, $limit = null, $offset = null, $filterField = '', $startdate = '', $enddate = '')
    {
        $builder = $this->db->table('users_branchs');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('sections', 'sections.section_id = users_branchs.branch_section_id');

        $builder->join('users', 'users.user_id = users_branchs.branch_user_id');
        $builder->join('users_roles', 'users_roles.role_id = users.user_role_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_year_periods($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('results_annual_period');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('results_period', 'results_period.period_id = results_annual_period.annualperiod_period_id');
        $builder->join('years', 'years.year_id = results_annual_period.annualperiod_year_id');
        $builder->join('sections', 'sections.section_id = results_annual_period.annualperiod_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_join_criteria($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('results_criteria');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('fees_details', 'fees_details.feedetail_id = results_criteria.criteria_fee_id');
        $builder->join('fees', 'fees.fee_id = fees_details.feedetail_fee_id');
        $builder->join('classes', 'classes.classe_id = results_criteria.criteria_classe_id');

        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        $builder->join('results_annual_period', 'results_annual_period.annualperiod_id = results_criteria.criteria_period_id');
        $builder->join('results_period', 'results_period.period_id = results_annual_period.annualperiod_period_id');


        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_results($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('results');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('results_annual_period', 'results_annual_period.annualperiod_id = results.result_annualperiod_id');
        $builder->join('results_period', 'results_period.period_id = results_annual_period.annualperiod_period_id');
        $builder->join('years', 'years.year_id = results_annual_period.annualperiod_year_id');

        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = results.result_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');
        /**/
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_address($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('address');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('address_district', 'address_district.district_id = address.address_district_id');
        $builder->join('address_municipality', 'address_municipality.municipality_id = address_district.district_municipality_id');
        $builder->join('students_parents', 'students_parents.parent_id = address.address_parent_id');
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_courses_classes($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('courses_classes');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        //$builder->join('courses_teachers', 'courses_teachers.teacher_id = courses_classes.courseclasse_teacher_id');
        $builder->join('courses', 'courses.course_id = courses_classes.courseclasse_course_id');
        $builder->join('courses_branchs', 'courses_branchs.branch_id = courses.course_branch_id');
        $builder->join('classes', 'classes.classe_id = courses_classes.courseclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_holders_classes($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('classes_teachers');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('courses_teachers', 'courses_teachers.teacher_id = classes_teachers.classeteacher_teacher_id');
        $builder->join('years', 'years.year_id = classes_teachers.classeteacher_year_id');

        $builder->join('classes', 'classes.classe_id = classes_teachers.classeteacher_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');


        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_courses_schedules($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('courses_schedules');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('courses_classes', 'courses_classes.courseclasse_id = courses_schedules.schedule_course_classe_id');
        $builder->join('courses_teachers', 'courses_teachers.teacher_id = courses_schedules.schedule_teacher_id');
        $builder->join('courses', 'courses.course_id = courses_classes.courseclasse_course_id');
        $builder->join('courses_branchs', 'courses_branchs.branch_id = courses.course_branch_id');
        $builder->join('classes', 'classes.classe_id = courses_classes.courseclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_courses_attribution($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('courses_teachers_attribution');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('courses_teachers', 'courses_teachers.teacher_id = courses_teachers_attribution.attribution_teacher_id');
        $builder->join('courses_classes', 'courses_classes.courseclasse_id = courses_teachers_attribution.attribution_course_id');
        $builder->join('courses', 'courses.course_id = courses_classes.courseclasse_course_id');
        $builder->join('courses_branchs', 'courses_branchs.branch_id = courses.course_branch_id');
        $builder->join('classes', 'classes.classe_id = courses_classes.courseclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_courses_students($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null, $sum_field = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('courses_students_grades');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = courses_students_grades.grade_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');

        $builder->join('courses_classes', 'courses_classes.courseclasse_id = courses_students_grades.grade_course_id');

        $builder->join('courses', 'courses.course_id = courses_classes.courseclasse_course_id');
        $builder->join('courses_branchs', 'courses_branchs.branch_id = courses.course_branch_id');

        $builder->join('courses_maximas', 'courses_maximas.maxima_id = courses_classes.courseclasse_maxima_id');

        $builder->join('classes', 'classes.classe_id = courses_classes.courseclasse_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');


        $builder->join('results_annual_period', 'results_annual_period.annualperiod_id = courses_students_grades.grade_annualperiod_id');
        $builder->join('results_period', 'results_period.period_id = results_annual_period.annualperiod_period_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_incidents_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null, $sum_field = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('disciplinary_incidents');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('courses_teachers', 'courses_teachers.teacher_id = disciplinary_incidents.incident_teacher_id');

        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = disciplinary_incidents.incident_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    
    public function fetch_sanctions_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null, $sum_field = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('disciplinary_sanctions');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        $builder->join('disciplinary_incidents', 'disciplinary_incidents.incident_id = disciplinary_sanctions.sanction_incident_id');
        $builder->join('courses_teachers', 'courses_teachers.teacher_id = disciplinary_incidents.incident_teacher_id');
        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = disciplinary_incidents.incident_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_evaluations_data($where = array(), $selectFields = '*', $OneRow = FALSE, $order_by_field = '', $modeOrder = 'ASC', $groupBy = null, $sum_field = null,  $limit = null, $offset = null)
    {
        $builder = $this->db->table('disciplinary_students_evaluations');
        $builder->select($selectFields);
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }

        $builder->join('results_annual_period', 'results_annual_period.annualperiod_id = disciplinary_students_evaluations.evaluation_period_id');
        $builder->join('results_period', 'results_period.period_id = results_annual_period.annualperiod_period_id');
        //$builder->join('years', 'years.year_id = results_annual_period.annualperiod_year_id');

        $builder->join('students_inscriptions', 'students_inscriptions.inscription_id = disciplinary_students_evaluations.evaluation_student_id');
        $builder->join('students', 'students.student_id = students_inscriptions.inscription_student_id');
        $builder->join('years', 'years.year_id = students_inscriptions.inscription_year_id');
        $builder->join('classes', 'classes.classe_id = students_inscriptions.inscription_classe_id');
        $builder->join('classes_degrees', 'classes_degrees.degree_id = classes.classe_degree_id');
        $builder->join('classes_options', 'classes_options.option_id = classes.classe_option_id');
        $builder->join('sections', 'sections.section_id = classes_options.option_section_id');

        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        if (!empty($sum_field)) {
            $builder->selectSum($sum_field);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_workers(
        $where = array(),
        $selectFields = '',
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = FALSE,
        $filterField = '',
        $startdate = '',
        $enddate = '',
        $limit = null,
        $offset = null
    ) {
        $builder = $this->db->table('agents');
        (!empty($selectFields)) ? $builder->select($selectFields) : $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('schools', 'schools.school_id = agents.agent_company_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_contracts(
        $where = array(),
        $selectFields = '',
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = FALSE,
        $filterField = '',
        $startdate = '',
        $enddate = '',
        $limit = null,
        $offset = null
    ) {
        $builder = $this->db->table('agents_contracts');
        (!empty($selectFields)) ? $builder->select($selectFields) : $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('agents', 'agents.agent_uid = agents_contracts.contract_agent_uid');
        $builder->join('agents_types', 'agents_types.category_uid = agents_contracts.contract_category_uid');
        //$builder->join('services', 'services.service_uid = contracts.contract_service_uid');
        //$builder->join('fonctions', 'fonctions.fonction_uid = contracts.contract_position_uid');
        //$builder->join('compagnies', 'compagnies.company_uid = contracts.contract_company_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_salary_requests(
        $where = array(),
        $selectFields = '',
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = FALSE,
        $filterField = '',
        $startdate = '',
        $enddate = '',
        $limit = null,
        $offset = null
    ) {
        $builder = $this->db->table('agents_payroll_requests');
        (!empty($selectFields)) ? $builder->select($selectFields) : $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('agents_contracts', 'agents_contracts.contract_uid = agents_payroll_requests.request_agent_uid');
        $builder->join('agents', 'agents.agent_uid = agents_contracts.contract_agent_uid');
        $builder->join('agents_types', 'agents_types.category_uid = agents_contracts.contract_category_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_salary_payment(
        $where = array(),
        $selectFields = '',
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = FALSE,
        $filterField = '',
        $startdate = '',
        $enddate = '',
        $limit = null,
        $offset = null
    ) {
        $builder = $this->db->table('agents_payroll_payments');
        (!empty($selectFields)) ? $builder->select($selectFields) : $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('agents_contracts', 'agents_contracts.contract_uid = agents_payroll_payments.payment_agent_uid');
        $builder->join('agents', 'agents.agent_uid = agents_contracts.contract_agent_uid');
        $builder->join('agents_types', 'agents_types.category_uid = agents_contracts.contract_category_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_attendances(
        $where = array(),
        $selectFields = '',
        $order_by_field = '',
        $modeOrder = 'ASC',
        $OneRow = false,
        $filterField = '',
        $startdate = '',
        $enddate = '',
        $limit = null,
        $offset = null
    ) {
        $builder = $this->db->table('agents_attendances');
        (!empty($selectFields)) ? $builder->select($selectFields) : $builder->select('*');
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($order_by_field)) {
            $builder->orderBy($order_by_field, $modeOrder);
        }
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        $builder->join('agents_contracts', 'agents_contracts.contract_uid = agents_attendances.attendance_employe_id');
        $builder->join('agents', 'agents.agent_uid = agents_contracts.contract_agent_uid');
        $builder->join('agents_types', 'agents_types.category_uid = agents_contracts.contract_category_uid');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($OneRow == true) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
}
