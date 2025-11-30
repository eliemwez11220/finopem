<?php

namespace App\Controllers;

class Reporting extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        if (!session()->has('isLoggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url('logout')); // redirect to login page if not connected
        } else {
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3, $param4, $param5);
            } else {
                return $this->index();
            }
        }
    }
    public function index()
    {
        //dd(session()->get('feepaidchoosed'));

        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');

        if (session()->has('reportingtype') && ((session()->get('reportingtype') == 'fees_classes') OR (session()->get('reportingtype') == 'fees_students') OR (session()->get('reportingtype') == 'fees_recovery') OR (session()->get('reportingtype') == 'student_payment')) OR (session()->get('reportingtype') == 'exemptions')) {

            $classe_id = (session()->has('studentchoosedclasse')) ? session()->get(key: 'studentchoosedclasse') : '';
            $choosed_fee_data = session()->has('feepaidchoosed') ? session()->get('feepaidchoosed') : '';
            $feecurrency = (!empty($choosed_fee_data)) ? $choosed_fee_data['fee_currency_payable']:'';

            if (session()->has('feechoosed')){
                $fee_id = session()->get('feechoosed');
                $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id, 'fee_id' => $fee_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
            
            }else{

                $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
              
            }
            
            if((session()->get('reportingtype') == 'fees_students') OR (session()->get('reportingtype') == 'fees_recovery')){
                
                $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemptionclasse_classe_id' => $classe_id, 'exemption_year_id' => $yearid, 'exemptionclasse_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC', 'exemptionclasse_exemption_id', 'exemption_cost_discount');
                
            }else{
                
                $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemption_currency' => $feecurrency, 'exemptionclasse_classe_id' => $classe_id, 'exemption_year_id' => $yearid, 'exemptionclasse_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC', 'exemptionclasse_exemption_id', 'exemption_cost_discount');
                //$data['studentexemptions'] = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'inscription_classe_id' => $classe_id, 'feestudent_school_id' => $schoolid), '*', FALSE, 'exemption_created_at', 'DESC', 'student_id', 'exemption_cost_discount');
            
            }
            $data['payments'] = $this->join->fetch_paydetails_data(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'paydetails_created_at', 'DESC', 'feedetail_id, inscription_id', 'paydetails_paid_amount');
            $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classe_id, 'student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
            $data['feesexemptions'] = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
            $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'inscription_classe_id' => $classe_id, 'feestudent_school_id' => $schoolid), '*', FALSE, 'exemption_created_at', 'DESC');
            
            //$data['fees'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'fee_id');
            $data['fees'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'ASC', 'fee_id');
              
            if((session()->get('reportingtype') == 'exemptions')){
                $feechoosed = session()->get('feechoosed');
                $data['exemp_fees'] = $this->join->fetch_exemptions_data(array('fee_id' => $feechoosed,'exemption_year_id' => $yearid, 'exemption_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC', 'exemption_id');
            }
            
            //dd($data['classesexemptions']);

            if((session()->get('reportingtype') == 'student_payment') OR (session()->get('reportingtype') == 'exemptions')){

                $data['orientation'] = "landscape";

            }else{
                
                $data['orientation'] = "portrait";
            }


        } elseif (session()->has('reportingtype') && (session()->get('reportingtype') == 'student_identity') OR (session()->get('reportingtype') == 'student_serni')) {

            $classe_id = (session()->has('studentchoosedclasse')) ? session()->get('studentchoosedclasse') : '';
            $data['documents'] = $this->join->fetch_join_data('students_documents', 'students', 'students.student_id = students_documents.document_student_id', array('document_school_id' => $schoolid), 'document_created_at');

            $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classe_id, 'student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
            $data['orientation'] = "portrait";
            
        } elseif (session()->has('reportingtype') && (session()->get('reportingtype') == 'phone_annuary') OR (session()->get('reportingtype') == 'school_annuary')) {

            if(session()->has('studentchoosedclasse') && (session()->get('studentchoosedclasse') !='all')){
                $classe_id = session()->get('studentchoosedclasse');
                $data['parents'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classe_id, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'parent_father_name', 'ASC');
                
            }else{
                $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'parent_father_name', 'ASC');
            
            }$data['orientation'] = "landscape";
       
        } elseif (session()->has('reportingtype') && (session()->get('reportingtype') == 'cashbox_finances') OR (session()->get('reportingtype') == 'finances_fees')) {
            
                
            if(session()->has('choosedsectionid')){

                $section_id = session()->get('choosedsectionid');

                $data['classes'] = $this->join->fetch_join_classes(array('section_id'=> $section_id, 'classe_school_id' => $schoolid), 'degree_code', 'ASC', false);
                
                $data['expenses'] = $this->join->fetch_expenses_data(array('expense_section_id'=> $section_id, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', FALSE, 'expense_created_at', 'DESC');

                if (session()->get('admin') == TRUE or session()->get('all') == TRUE) {

                    $data['feespays'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'fee_id', 'paydetails_paid_amount');
                    $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');

                } else {

                    $agent = session()->get('userid');
                    $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');
                    $data['feespays'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');

                }

                $feedet = session()->get('feedetailchoosed');
                $data['feespayments'] = $this->join->fetch_paydetails_data(array('feedetail_id' =>$feedet, 'section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'classe_id, feedetail_id', 'paydetails_paid_amount');
                $data['fees'] = $this->join->fetch_fees_classes(array('section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'ASC', 'fee_id');
                $data['detailsfees'] = $this->join->fetch_fees_classes(array('section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feedetail_created_at', 'ASC', 'feedetail_id');
                
                $data['classesfees'] = $this->join->fetch_fees_classes(array('feedetail_id' =>$feedet,'section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'DESC', 'classe_id, feedetail_id', 'feedetail_cost_payable');
                
                //$data['classesfees'] = $this->join->fetch_join_classes(array('section_id' => $section_id,'classe_school_id' => $schoolid));
            
                $data['feesstudents'] = $this->join->fetch_students_data(array('section_id' => $section_id,'student_school_id' => $schoolid, 'inscription_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
                $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'section_id' => $section_id, 'feestudent_school_id' => $schoolid));
                $data['feesexemptions'] = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('feediscount_feedetail_id'=>$feedet, 'exemption_year_id' => $yearid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
                $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemption_year_id' => $yearid, 'exemptionclasse_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC', 'exemptionclasse_exemption_id', 'exemption_cost_discount');

            }
            $data['orientation'] = "portrait";
           
        } elseif (session()->has('reportingtype') && (session()->get('reportingtype') == 'yearly_students')) {

            $data['filles'] = $this->join->fetch_count_students(
                array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid, 'inscription_status' => 'actif', 'student_gender' => 'feminin'));

            $data['garcons'] = $this->join->fetch_count_students(
                array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid, 'inscription_status' => 'actif', 'student_gender' => 'masculin'));

            $data['nb_eleves'] = $this->join->fetch_count_students(array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid,
                'inscription_status' => 'actif'));

            $data['students_inactive'] = $this->join->fetch_count_students(array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid,
                'inscription_status !=' => 'actif'));

            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
            $data['classessections'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code', 'ASC', false, 'section_name');
            $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            $data['orientation'] = "portrait";
        
        } else {

            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
            $data['classessections'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code', 'ASC', false, 'section_name');
            $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            $data['orientation'] = "landscape";

            // $this->session->remove('allsections');
        }
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code', 'ASC', false);
                
        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            
        //dd($data['feesstudents']);

        $data['title'] = "Rapports";
        $data['_view'] = "reporting/index";
        return view('layouts/main', $data);
    }
    public function listing($page = null)
    {
        //DELETE PREVIOUS REPORTING IN SESSION
        if(session()->has('reportingtype')) {session()->remove('reportingtype');}
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        //$yearstartat = $this->session->yearstartdate;
        $date_day = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime("yesterday"));
        $section_id = session()->get('choosedsectionid');

        switch ($page) {
            case 'recovery':
                
                //$classe_id = (session()->has('studentclasseid')) ? session()->studentclasseid : '';
                $feeid = (session()->has('feechoosed')) ? session()->get('feechoosed') : '';
                $classe_id = (session()->has('studentchoosedclasse')) ? session()->get('studentchoosedclasse') : '';
                $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                $data['payments'] = $this->join->fetch_paydetails_data(array('paydetails_fee_id' => $feeid, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'paydetails_created_at', 'DESC', 'feedetail_id, inscription_id', 'paydetails_paid_amount');
                $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classe_id, 'student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC');
                
                $choosed_fee_data = session()->has('feechoosedclasse') ? session()->get('feechoosedclasse') : '';
                $feecurrency = (!empty($choosed_fee_data)) ? $choosed_fee_data['fee_currency_payable']:'';
                
                $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemption_currency' => $feecurrency,'exemptionclasse_classe_id' => $classe_id, 'exemption_year_id' => $yearid, 'exemptionclasse_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC');
                $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'inscription_classe_id' => $classe_id, 'feestudent_school_id' => $schoolid), '*', FALSE, 'exemption_created_at', 'DESC');
                $data['feesexemptions'] = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid,'feediscount_feedetail_id' => $feeid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
        
                
                $data['orientation'] = "landscape";
                break;
            case 'payments':
            case 'cashbox':
            case 'cashflow':
                
                $data['cashbox'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'paydetails_fee_id', 'paydetails_paid_amount', null, null, 'payment_date', $date_day, $date_day);
                $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', null, null, null, null, 'payment_date', $date_day, $date_day);
                
                $data['feespaid'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'ASC', 'feedetail_id', null, null, null, 'payment_date', $date_day, $date_day);
                $data['expenses'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'ASC', null, null, null, null, 'expense_date', $date_day, $date_day);

                $data['payments_report'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'DESC', null, null, null, null, 'payment_date', null, $yesterday);
                $data['expenses_report'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'DESC', null, null, null, null, 'expense_date', null, $yesterday);
                
                if($page=='payments'){
                    
                    $monthly = date('m');
                    $data['daypayments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid, 'MONTH(payment_date)' =>$monthly), '*', false, 'payment_date', 'ASC');
                    $data['daypayfees'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid, 'MONTH(payment_date)' =>$monthly), '*', false, 'fee_name', 'ASC', 'feedetail_id');
               
                    $data['orientation'] = "portrait";

                }else{

                    $data['orientation'] = "landscape";

                }
                break;
            case 'parent':
            case 'students':
            case 'listing':
                // $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $schoolid), 'parent_tutor_name', null, null, 'ASC');
                $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'parent_father_name', 'ASC', 'student_parent_id');
                $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                $data['orientation'] = "portrait";

                break;

            case 'banking':
                //$bank_id = (session()->bankchoosed)?session()->bankchoosed:'';'transaction_bank_id' => $bank_id,

                $data['transactions'] = $this->join->fetch_transactions_data(array('transaction_school_id' => $schoolid, 'transaction_year_id' => $yearid), '*', false, 'transaction_created_at', 'DESC', null, null, null, null, 'transaction_date', $date_day, $date_day);

                //$data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id'=>$schoolid), 'bank_created_at');
                $data['orientation'] = "landscape";
                break;
            case 'paidfees':
                $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                $data['feesclasses'] = $this->join->fetch_fees_classes(array('section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $date_day, $date_day);
                
                $data['orientation'] = "portrait";
                break;
            case 'usersfees':
               
                
                $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                
                $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $date_day, $date_day);
                
                $data['agents'] = $this->join->fetch_users_payments(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'user_name', 'ASC', 'payment_user_id', null, null, null, 'payment_date', $date_day, $date_day);
                
                //$data["agents"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                   // array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');
                
                    $data['orientation'] = "portrait";
                break;
            default:

        }
        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
        $data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');

      //dd($data['studentexemptions']);

        $data['start'] = $date_day;
        $data['end'] = $date_day;

        $data['yesterday'] = date('d/m/Y', strtotime($yesterday));

        $data['title'] = "Reporting of " . ucfirst($page) . ' | ' . session()->get('choosedclassename');

        $data['_view'] = "reporting/" . $page;
        return view('layouts/main', $data);
    }
    public function filter($page = null)
    {
        //DELETE PREVIOUS REPORTING IN SESSION
        if(session()->has('reportingtype')) {session()->remove('reportingtype');}
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $date_day = date('Y-m-d');
        $startdate = $this->request->getGet('startdate');
        $enddate = $this->request->getGet('enddate');
        $agent = $this->request->getGet('agent');
        $started = (!empty($startdate)) ? $startdate : $date_day;
        $closing = (!empty($enddate)) ? $enddate : $date_day;
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($started)));

        $section_id = session()->get('choosedsectionid');

        if ((!empty($started) && (!empty($closing)))) {
            if (!empty($agent) && ($agent != 'all')) {
                if ($page == 'paidfees') {
                    $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                    $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                    $data['feesclasses'] = $this->join->fetch_fees_classes(array('section_id' => $section_id,'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                    $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'section_id, feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);
                }elseif ($page == 'usersfees') {
                        $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                        $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'payment_user_id, feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);

                        $data["agents"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                          array('user_id' => $agent, 'user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');
                        
                          //$data['agents'] = $this->join->fetch_users_payments(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'payment_user_id', null, null, null, 'payment_date', $date_day, $date_day);
                
                        $data['orientation'] = "portrait";
                    
                } else {
                    $data['cashbox'] = $this->join->fetch_paydetails_data(array('payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_created_at', 'ASC', 'paydetails_fee_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);
                    $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', null, null, null, null, 'payment_date', $started, $closing);
                    $data['expenses'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_user_id' => $agent, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'ASC', null, null, null, null, 'expense_date', $started, $closing);
                    $data['payments_report'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'DESC', null, null, null, null, 'payment_date', $yesterday, $yesterday);
                    $data['expenses_report'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_user_id' => $agent, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'DESC', null, null, null, null, 'expense_date', $yesterday, $yesterday);
                    $data['feespaid'] = $this->join->fetch_paydetails_data(array('payment_user_id' => $agent,'section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'ASC', 'feedetail_id', null, null, null, 'payment_date', $started, $closing);
                
                }
                
                $data['orientation'] = "portrait";
                $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'), array('user_school_id' => $schoolid, 'user_id' => $agent), 'user_created_at', 'DESC', true);

            } else {

                switch ($page) {
                    case 'paidfees':
                        $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                        $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                        $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                        $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'section_id, feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);
                        
                        $data['orientation'] = "portrait";

                        break;
                    case 'usersfees':
                        $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                        $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'payment_user_id, feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);

                        //$data["agents"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                         //   array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');
                        
                        $data['agents'] = $this->join->fetch_users_payments(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'user_name', 'ASC', 'payment_user_id', null, null, null, 'payment_date', $started, $closing);
                
                        $data['orientation'] = "portrait";
                        break;
                    case 'payments':
                    case 'cashbox':
                    case 'cashflow':
                        $data['cashbox'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'ASC', 'paydetails_fee_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);
                        $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'degree_name', 'DESC', null, null, null, null, 'payment_date', $started, $closing);
                        
                        $data['feespaid'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'feedetail_created_at', 'DESC', 'feedetail_id', null, null, null, 'payment_date', $started, $closing);
                        $data['expenses'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'ASC', null, null, null, null, 'expense_date', $started, $closing);
                        $data['payments_report'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id,'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'DESC', null, null, null, null, 'payment_date', $yesterday, $yesterday);
                        $data['expenses_report'] = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', false, 'expense_date', 'DESC', null, null, null, null, 'expense_date', $yesterday, $yesterday);
                        
                        if($page=='payments'){

                            $data['orientation'] = "portrait";

                        }else{

                            $data['orientation'] = "landscape";

                        }
                        break;
                    case 'banking':
                        //$bank_id = (session()->bankchoosed)?session()->bankchoosed:'';'transaction_bank_id' => $bank_id,

                        $data['transactions'] = $this->join->fetch_transactions_data(array('transaction_school_id' => $schoolid, 'transaction_year_id' => $yearid), '*', false, 'transaction_created_at', 'DESC', null, null, null, null, 'transaction_date', $started, $closing);

                        //$data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id'=>$schoolid), 'bank_created_at');
                        $data['orientation'] = "landscape";
                       
                        break;
                    default:
                }
            }
            $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            
            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
            $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
            $data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'), array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');


               //dd($data["feespaid"]);

            
            $data['title'] = "Reporting of " . ucfirst($page) . ' | ' . session()->get('choosedclassename');
            $data['start'] = $started;
            $data['end'] = $closing;
            $data['agent'] = $agent;
            $data['yesterday'] = date('d/m/Y', strtotime($yesterday));

            $data['_view'] = "reporting/" . $page;
            echo view('layouts/main', $data);
        } else {
            return redirect()->back()->with('failed', 'Vous devez selectionner la plage des dates');
        }
    }

    public function export($page = null)
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        switch ($page) {
            case 'parents':
            case 'students':
                $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'parent_father_name', 'ASC', 'student_parent_id');
                $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                break;
            default:
        }
        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
            
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        $data['orientation'] = "landscape";
        $data['title'] = "Exportation  " . ucfirst($page) . ' | ' . session()->get('choosedclassename');
        $data['_view'] = "export/" . $page;
        return view('layouts/main', $data);
    }

}
