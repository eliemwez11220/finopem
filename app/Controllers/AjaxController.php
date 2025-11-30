<?php
namespace App\Controllers;
class AjaxController extends BaseController
{
    function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        if (!session()->has('isLoggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url('logout'));  // redirect to login page if not connected
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
        return false;
    }
	function studentListingClasse($page, $classe_id)
	{
        $schoolid = $this->session->schoolid;   # GET SCHOOL ID
        $yearid = $this->session->yearid;   # GET YEAR ID 
        $this->session->setTempdata('studentchoosedclasse', $classe_id, 3000);
        $classe_data = $this->join->fetch_join_classes(array('classe_id'=>$classe_id,'classe_school_id'=>$schoolid), 'classe_created_at', 'ASC', TRUE);
        if(!empty($classe_data)){
            $classe_name = setDegresLevels(($classe_data['degree_code'])) .' '. ucfirst(($classe_data['classe_subname'])).' '. ucfirst(($classe_data['option_name']));
            $this->session->setTempdata('choosedclassename', $classe_name, 3000);
        }
        
        if ($page == 'reporting' && (session()->has('reportingtype'))) {
            
            session()->remove('success');

            if($classe_id != 'all'){

                $students_listing = $this->join->fetch_students_data(array('classe_id'=>$classe_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                if(!empty($students_listing)){
                    $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                    echo json_encode($students_listing);

                }else{
                    $this->session->setTempdata('studentsclasses', 'none', 3000);
                    echo json_encode($students_listing);
                }
            }else{
                $section_id = session()->get('choosedsectionid');
                $students_listing = $this->join->fetch_students_data(array('section_id'=>$section_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                if(!empty($students_listing)){
                    $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                    echo json_encode($students_listing);
                }
            }
        }else{
            if($page == 'parent' OR $page == 'schoolary' OR $page == 'pubs' OR $page == 'encoding' OR $page == 'reporting' OR $page == 'parcours' OR $page == 'listing' OR $page == 'students' OR $page == 'parents' OR $page == 'recovery' OR $page == 'sms' OR $page == 'emails'){
                if($classe_id != 'all'){

                    if ((session()->has('reportingtype') && (session()->get('reportingtype') == 'fees_students'))) {
                        
                        session()->set('success', $classe_name);

                        $students_listing = $this->join->fetch_students_data(array('inscription_classe_id'=>$classe_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                        if(!empty($students_listing)){
                            $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                            echo json_encode($students_listing);
                        }else{
                            $this->session->setTempdata('studentsclasses', 'none', 3000);
                            echo json_encode($students_listing);
                        }
                    }
                    if (($page != 'parent') OR (session()->has('reportingtype') && (session()->get('reportingtype') == 'phone_annuary'))) {
                    
                    
                        $parentsclasses = $this->join->fetch_students_data(array('inscription_classe_id'=>$classe_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'parent_father_name', 'ASC');
                    
                    }else{

                        $parentsclasses = $this->join->fetch_students_data(array('inscription_classe_id'=>$classe_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
                    
                    }

                    //session()->setFlashdata('failed', $page);

                    if(!empty($parentsclasses)){
                        $this->session->setTempdata('parentsclasses', $parentsclasses, 3000);
                    }else{
                        $this->session->setTempdata('parentsclasses', 'none', 3000);
                    }

                    
                    $students_listing = $this->join->fetch_students_data(array('inscription_classe_id'=>$classe_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                    if(!empty($students_listing)){
                        $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                        echo json_encode($students_listing);
                    }else{
                        $this->session->setTempdata('studentsclasses', 'none', 3000);
                        echo json_encode($students_listing);
                    }
                }else{
                    $parentsclasses = $this->join->fetch_students_data(array('inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
                    $this->session->setTempdata('parentsclasses', $parentsclasses, 3000);
                    $students_listing = $this->join->fetch_students_data(array('inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                    $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                    $this->session->remove('choosedclassename');
                    $this->session->remove('studentchoosedclasse');
                    $this->session->remove('parentsclasses');
                    echo json_encode($students_listing);
                }
            }else{
                $last_year = ($this->session->yearstarted - 1); //GET LAST STARTED BY NEW STARTED - 1 YEAR
                $last_year_data = $this->model->fetch_row_data('years', array('year_started'=>$last_year, 'year_school_id'=>$schoolid));
                if(!empty($last_year_data)){
                    $last_year_id = $last_year_data['year_id']; // GET LAST YEAR ID
                    $this->session->set('last_year_id', $last_year_id);
                    $students_listing = $this->join->fetch_students_data(array('inscription_classe_id'=>$classe_id,'inscription_year_id'=>$last_year_id, 'student_school_id'=>$schoolid), '*', FALSE, 'student_firstname', 'ASC');
                    
                    if(!empty($students_listing)){
                        $this->session->setTempdata('studentsclasses', $students_listing, 3000);
                        echo json_encode($students_listing);
                    }else{
                        $this->session->setTempdata('studentsclasses', 'none', 3000);
                        echo json_encode($students_listing);
                    }
                }
            }
        }
	}
	function studentRequest($student_id)
	{
		$schoolid = $this->session->schoolid;   # GET SCHOOL ID
        $yearid  = $this->session->yearid;
        if (!empty($student_id)) {

            $data = $this->join->fetch_students_data(array('inscription_id'=>$student_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', TRUE);
            
            if($this->session->has('paymenttoken')){

                $this->session->remove('paymenttoken');
                
            }
            $classe = setDegresLevels(($data['degree_code'])).' '. (($data['classe_subname'])).' '. (($data['option_name']));
            
            /*$this->session->set('elevematricule',$data['student_code']);
            $this->session->set('student',$data['classe_option_id']);*/

            $this->session->setTempdata('studentchoosed',$student_id, 3000);
            $this->session->setTempdata('studentclasse',$classe, 3000);
            $this->session->setTempdata('studentclasseid',$data['classe_id'], 3000);
           
            echo json_encode($data);
        }
	   //return json_encode(['success'=>'success', 'csrf'=>csrf_hash(), 'query'=>$queryEleveUID]);
	}

	function feesClasseDetails($fee_id=null)
	{
		$schoolid = $this->session->schoolid;   # GET SCHOOL ID
        if (!empty($fee_id)) {
            $data_fees_details = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_id' => $fee_id, 'feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', TRUE);
            if(!empty($data_fees_details)){
                $this->session->setTempdata('feechoosedclasse', $data_fees_details, 3000);
                //$this->session->setTempdata('choosedfee', $data_fees_details['fee_id'], 3000);
                $this->session->setTempdata('feechoosed',$fee_id, 3000);
                $this->session->setTempdata('feedetailchoosed',$fee_id, 3000);
                echo json_encode($data_fees_details);
            }
        }
	}
    function feesPaid($fee_id=null)
	{
		$schoolid = $this->session->schoolid;   # GET SCHOOL ID
        if (!empty($fee_id) && ($fee_id !='all')) {
            $data_fees_paid = $this->model->fetch_row_data('fees', array('fee_id' => $fee_id, 'fee_school_id' => $schoolid));
            if(!empty($data_fees_paid)){
                $this->session->setTempdata('feepaidchoosed', $data_fees_paid, 3000);
                $this->session->setTempdata('feepaidid',$fee_id, 3000);
                $this->session->setTempdata('feechoosed',$fee_id, 3000);
                echo json_encode($data_fees_paid);
            }
        }else{
            $this->session->remove('feepaidchoosed');
            $this->session->remove('feepaidid');
            $this->session->remove('feechoosed');
            echo json_encode($fee_id);
        }
	}
    function searchStudent()
    {
        $schoolid = $this->session->get('schoolid');
        $yearid = $this->session->get('yearid');
        $query = $this->request->getVar('query');

        $students = $this->join->fetch_search_data(array('student_school_id'=>$schoolid, 'inscription_year_id'=>$yearid), $query);
       
        return $this->response->setJSON($students);
    }
    function financesCashbox($cashbox_currency)
	{
        $schoolid = $this->session->schoolid;
		$yearid = $this->session->yearid;

        if (!empty($cashbox_currency)) {

            $data_cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency' => $cashbox_currency, 'cashbox_school_id' => $schoolid));
            
            if(!empty($data_cashbox)){

            //$cashboxid = session()->get('cashboxchoosed');
            //$cashbox_currency = $data_cashbox['cashbox_currency'];
            
            $payments = $this->join->fetch_paydetails_data(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC');
            $expenses = $this->join->fetch_expenses_data(array('expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', FALSE, 'expense_created_at', 'DESC');
       
            $expense_usd = 0;
            $expense_cdf = 0;
            
            $expense_global_usd = 0;
            $expense_global_cdf = 0;

            $payment_usd = 0;
            $payment_cdf = 0;

            $exchange_usd_debit = 0;
            $exchange_cdf_debit = 0;
            $exchange_usd_credit = 0;
            $exchange_cdf_credit = 0;

            if(!empty($expenses)){
                foreach($expenses as $expense){
                    if(($expense['expense_user_id'] == session()->userid) OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                        
                        if(($expense['expense_type'] == 'exchange')){

                            $exchange_usd = $expense['expense_usd_amount'];
                            $exchange_cdf = $expense['expense_cdf_amount'];
                            
                            $exchange_usd_credit += ($expense['expense_category'] == 'usdin') ? $exchange_usd : 0;
                            $exchange_cdf_credit += ($expense['expense_category'] == 'usdout') ? $exchange_cdf : 0;

                            $exchange_usd_debit += ($expense['expense_category'] == 'usdout') ? $exchange_usd : 0;
                            $exchange_cdf_debit += ($expense['expense_category'] == 'usdin') ? $exchange_cdf : 0;

                        }
                        //ALL OPERATIONS BASED ON EXPENSE AND RETURNING 
                        if (($expense['expense_type'] != 'exchange')) {

                            $expense_locusd = $expense['expense_usd_amount'];
                            $expense_loccdf = $expense['expense_cdf_amount'];

                            $expense_usd += $expense_locusd;
                            $expense_cdf += $expense_loccdf;
                        }

                        $expense_global_usd = $expense_usd + $exchange_usd_debit;
                        $expense_global_cdf = $expense_cdf + $exchange_cdf_debit;
                    }
                }
            }
            
            //session()->setFlashdata('success', value: $exchange_usd_credit.' = '. $exchange_cdf_credit);
           
            if(!empty($payments)){
                foreach($payments as $payment){
                    if(($payment['payment_user_id'] == session()->userid) OR (session()->admin == TRUE) OR (session()->all == TRUE)){
                       
                        $payment_amount = $payment['paydetails_paid_amount'];
                        $pay_currency = $payment['fee_currency_payable'];
                        $payment_usd += ($pay_currency == 'usd') ? $payment_amount:0;
                        $payment_cdf += ($pay_currency == 'cdf') ? $payment_amount:0;

                    }
                }
            }
            $credit_amount = 0;
            $debit_amount = 0;
            //$balance_amount = 0;

            if($cashbox_currency == 'usd'){

                $credit_amount =  floatval($payment_usd + $exchange_usd_credit) - $exchange_usd_debit;
                $debit_amount = floatval($expense_global_usd);
                //$balance_amount = $credit_amount -  $debit_amount;

            }else{
                
                $credit_amount =  floatval($payment_cdf + $exchange_cdf_credit)- $exchange_cdf_debit;
                $debit_amount = floatval($expense_global_cdf);
                
            }
            
            $balance_amount = $credit_amount -  $debit_amount;

            //session()->setFlashdata('success', $credit_amount - $debit_amount);

            $update_cashbox_amount=array(
                'cashbox_credit_amount' => $credit_amount,
                'cashbox_debit_amount' => $debit_amount,
                'cashbox_balance_amount' => $balance_amount,
            );

                $this->model->update_data('finances_cashbox', $update_cashbox_amount, array('cashbox_currency' => $cashbox_currency, 'cashbox_school_id' => $schoolid));
                $this->session->setTempdata('cashboxdata', $data_cashbox, 3000);
                $this->session->setTempdata('cashboxchoosed',$cashbox_currency, 3000);
                $this->session->setTempdata('cashboxavailable', $balance_amount, 3000);
                echo json_encode($data_cashbox);
            } 
        }
	}
    function banksTransaction($bank_id)
	{
		$schoolid = $this->session->schoolid;   # GET SCHOOL ID
        if (!empty($bank_id)) {
            $data_bank = $this->model->fetch_row_data('finances_banks', array('bank_id' => $bank_id, 'bank_school_id' => $schoolid));
            if(!empty($data_bank)){
                $bank_balance = $data_bank['bank_credit_amount'] - $data_bank['bank_debit_amount'];
                $this->session->setTempdata('bankdata', $data_bank, 3000);
                $this->session->setTempdata('bankchoosed',$bank_id, 3000);
                $this->session->setTempdata('bankbalance', $bank_balance, 3000);
                echo json_encode($data_bank);
            }
        }
	}
    
    function reportingHideContent()
    {
        $status_reporting= ($this->session->has('status_reporting')) ? $this->session->get('status_reporting') : 'hide';
        $status_reporting_value = ($status_reporting == 'hide') ? 'show': 'hide';
        $this->session->setTempdata('status_reporting', $status_reporting_value, 3000);

        //$this->session->setTempdata('success', $status_reporting_value);

        echo json_encode($status_reporting);
    }
    
    function cashboxHiddenAgent($codeagent = null)
    {
        if(!empty($codeagent)){

            $status_reporting = ($this->session->has('status_reporting')) ? $this->session->get('status_reporting') : 'hide';
            $status_reporting_value = ($status_reporting == 'hide') ? 'show': 'hide';
            $this->session->setTempdata('status_reporting', $status_reporting_value, 3000);
            $this->session->setTempdata('agent_code', $codeagent, 3000);
            echo json_encode($status_reporting);

        }
    }

    function cashboxOperation($type = null){ 

        if (!empty($type)) {

            $this->session->setTempdata('cashboxoperation', $type, 3000);
            
            echo json_encode($type);

        }
    }
    function accessModule($type = null){ 

        if (!empty($type)) {

            $this->session->setTempdata('accessmodule', $type, 3000);
            
            echo json_encode($type);

        }
    } 
    
    function reportingPage($page_name = null){ 

        $this->session->remove('reportingdata');
        $this->session->remove('reportingtype');
            
        if (!empty($page_name)) {

            $this->session->setTempdata('reportingtype', $page_name, 3000);
            echo json_encode($page_name);

        }
    }
    function studentReporting($student_id = null){
        $schoolid = $this->session->schoolid;   # GET SCHOOL ID
        $yearid  = $this->session->yearid;
        $reporting_data = [];
        if (!empty($student_id) && ($student_id !='all')) {

            $this->session->remove('reportingdata');
            
            $data = $this->join->fetch_students_data(array('inscription_id'=>$student_id,'inscription_year_id'=>$yearid, 'student_school_id'=>$schoolid), '*', TRUE);
            
            $classe = setDegresLevels(($data['degree_code'])).' '. (($data['classe_subname'])).' '. (($data['option_name']));
            $classe_id = $data['classe_id'];

            if(session()->has('feechoosed')){
                
                $fee_id = session()->get('feechoosed');
                $reporting_data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id,'fee_id' =>$fee_id, 'feeclasse_school_id' => $schoolid),'*', FALSE, 'feeclasse_created_at');
            }else{

                $reporting_data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id,'feeclasse_school_id' => $schoolid),'*', FALSE, 'feeclasse_created_at');
             
            }
            
            $reporting_data['payments'] = $this->join->fetch_paydetails_data(array('payment_student_id'=> $student_id,'payment_year_id' => $yearid,'payment_school_id' => $schoolid),'*', FALSE, 'paydetails_created_at', 'DESC', 'feedetail_id, inscription_id', 'paydetails_paid_amount');
            $reporting_data['student'] = $data;
            $reporting_data['studentexemptions'] = $this->join->fetch_exemptions_students(array('feestudent_inscription_id'=>$student_id,'exemption_year_id' => $yearid,'inscription_classe_id' => $classe_id,'feestudent_school_id' => $schoolid));
			$reporting_data['feesexemptions'] = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid,'feediscount_school_id' => $schoolid), 'feediscount_created_at');
			$reporting_data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemption_year_id' => $yearid,'exemptionclasse_classe_id' => $classe_id,'exemptionclasse_school_id' => $schoolid));
            
            $this->session->setTempdata('reportingdata', $reporting_data, 3000);
                

            $this->session->setTempdata('studentchoosed',$student_id, 3000);
            $this->session->setTempdata('studentclasse',$classe, 3000);
            $this->session->setTempdata('studentclasseid',$classe_id, 3000);
            $this->session->setTempdata('student_sess_token',$data['student_token'], 3000);
            $this->session->setTempdata('studentinscriptiontoken',$data['inscription_token'], 3000);
            echo json_encode($reporting_data);
        }else{
            $this->session->remove('reportingdata');
            $this->session->remove('studentchoosed');
            $this->session->remove('studentclasse');
            $this->session->remove('studentclasseid');
            $this->session->remove('feechoosed');
            echo json_encode($reporting_data); 
        }
        
        //echo json_encode($reporting_data);
    }
    function sectionRequest($section_id=null)
	{
		$schoolid = ($this->session->has('schoolchoosed')) ? $this->session->get('schoolchoosed'): $this->session->schoolid;   # GET SCHOOL ID
        if (!empty($section_id) && ($section_id !='all')) {
            $section_data = $this->model->fetch_row_data('sections', array('section_id' => $section_id, 'section_school_id' => $schoolid));
            if(!empty($section_data)){
                $choosedsectionname = $section_data['section_name'];
                $section_type = $section_data['section_type'];
                session()->set('sectionsendsms', $section_type);
                $this->session->setTempdata('choosedsection', $section_data, 3000);
                $this->session->setTempdata('choosedsectionid',$section_id, 3000);
                $this->session->setTempdata('choosedsectionname',$choosedsectionname, 3000);
                echo json_encode($section_data);
            }
            $this->session->remove('allsections');
        }else{
            $section_data = $this->model->fetch_all_data('sections', array('section_status' => 'actif', 'section_school_id' => $schoolid), 'section_name');
            if(!empty($section_data)){

                $this->session->setTempdata('allsections', $section_data, 3000);
                $this->session->remove('choosedsectionid');
                $this->session->remove('choosedsectionname');
                $this->session->remove('choosedsection');
                echo json_encode($section_data);
            }
        }
        /*//Return Ajax Request With CSRF_TOKEN
        $response = [
            'data' => $section_id,
            'csrfHash' => csrf_hash() // Nouveau token CSRF
        ];

        echo json_encode($response);

        //echo $this->response->setJSON($response);*/
	}
    function ajaxHashedRequest($data){
        $response = [
            'data' => $data,
            'csrfHash' => csrf_hash() // Nouveau token CSRF
        ];
    
        return $this->response->setJSON($response);
    }
    function customerSchoolFinances($school_id = null){
        
        if (!empty($school_id)) {
            
            $customerid = $this->session->get('customerid');   # GET SCHOOL ID

            $school_data = $this->model->fetch_row_data('schools', array('school_id'=>$school_id, 'school_customer_id'=>$customerid));
                 
            $this->session->setTempdata('schooldata', $school_data, 3000);
            $this->session->setTempdata('schoolchoosed',$school_id, 3000);
           
            echo json_encode($school_data);
        }
    }
    function customerSchoolStudents($year_id = null){
        
        if (!empty($year_id)) {
            
            $schoolid = $this->session->schoolid;   # GET SCHOOL ID
            
            $year_data = $this->model->fetch_row_data('years', array('year_id'=>$year_id, 'year_school_id'=>$schoolid));
           
            $this->session->setTempdata('yeardata', $year_data, 3000);
            $this->session->setTempdata('yearchoosed',$year_id, 3000);
           
            echo json_encode($year_data);
        }
    }
}
