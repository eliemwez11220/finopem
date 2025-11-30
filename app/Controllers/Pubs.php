<?php

namespace App\Controllers;

class Pubs extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set('UTC'); // Set your desired timezone
    }

    function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3, $param4, $param5);
            } else {
                return $this->index();
            }
        
    }
    function index()
    {

        return redirect()->to(base_url());  // redirect 
        
    }

    public function studentResults()
    {

        $resultlinked = '';

        $rulers = [
            'student' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Matricule obligatoire',
                ]
            ],
            'school' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ecole obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $student = $this->request->getGet('student');
            $school = $this->request->getGet('school');

            switch ($school) {
                case 'kalubwe':
                    $resultlinked = 'https://webschool.malkiawaamani.org/';
                    break;
                case 'ville':
                    $resultlinked = 'https://magschool.malkiawaamani.org/';
                    break;
                case 'usoke':
                    $resultlinked = 'https://magschool.malkiawaamani.org/';
                    break;
                default:
                    $resultlinked = base_url();
                    break;
            }
            /*$client = \Config\Services::curlrequest();

            $response = $client->get($resultlinked . '/studentresults', [
                'query' => ['query' => $student]
            ]);*/

            try {
                $client = \Config\Services::curlrequest();
            
                $response = $client->get($resultlinked . 'studentresults', [
                    'query' => ['query' => $student]
                ]);
            
                // Check if response is successful
                if ($response->getStatusCode() == 200) {
                    // Log response for debugging
                    //log_message('debug', 'Curl Response: ' . print_r($response->getBody(), true));
            // Récupère les données de la réponse
            // Convertir JSON en tableau associatif
                    $data = json_decode($response->getBody(), true);
                    
                    // Handle $data as needed
                } else {
                    // Handle non-200 status code
                    log_message('error', 'API Error: ' . $response->getStatusCode());
                }
            } catch (\Exception $e) {
                // Handle exception
                log_message('error', 'Curl Request Failed: ' . $e->getMessage());
            }
            
            //dd($data);
            $data['title'] = ucwords('Vos Resultats scolaires');
            $data['page'] = strtolower('results');
            $data['meta'] = strtolower('Vos resultats scolaires');

            $data['schoolquery'] = $school;
            $data['reslink'] = $resultlinked;
            $data['title'] = "Consultation Resultats ";
            $data['_view'] = "teaching/online_pub";
            echo view('layouts/main', $data);
        } else {
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = ucwords('Resultats scolaires');
            $data['page'] = strtolower('schoolaryresults');
            $data['meta'] = strtolower('Consultation resultats scolaires');
            $data['title'] = "Consultation Resultats ";
            $data['_view'] = "teaching/online_pub";
            echo view('layouts/main', $data);
        }
    }
    function resultsearch(){
        //STUDENT ID CODE
        $student_code = trim($this->request->getGet('query'));

        if(!empty($student_code) && $this->model->fetch_row_data('results_period', array('period_status' => 'actif'))) {
           
            $annualperiod_data= $this->join->fetch_year_periods(array('annualperiod_status' => 'actif', 'period_status' => 'actif'), '*', TRUE);
        
            $schoolid = (!empty($annualperiod_data)) ? $annualperiod_data['annualperiod_school_id']:'';
            $yearid = (!empty($annualperiod_data)) ? $annualperiod_data['annualperiod_year_id']:'';
            $periode_id = (!empty($annualperiod_data)) ? $annualperiod_data['annualperiod_id']:'';

            $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_code' => $student_code), '*', TRUE);
            
            if(!empty($data['student'])){
                
                $student_id = $data['student']['student_id'];
                $classe_id = $data['student']['classe_id'];
                //$section = $data['student']['section_id'];

                $criteriadata = $this->join->fetch_join_criteria(array('criteria_status' => 'actif','criteria_school_id' => $schoolid, 'criteria_classe_id' => $classe_id, 'criteria_period_id' => $periode_id), '*');
                
                $student_fee_status = 0;
                //$result_token = (!empty($student_result)) ? $student_result['result_token']:'';

                if(!empty($criteriadata)){
                    foreach($criteriadata as $criteria){
                        $fee_criteria = $criteria['criteria_fee_id'];
                        $fee_payable = $criteria['feedetail_cost_payable'];
                        $payments = $this->checkStudentPayment($fee_criteria, $student_id, $schoolid, $yearid);
                        $exemptions = $this->checkStudentExemptions($fee_criteria, $classe_id, $student_id, $schoolid, $yearid);
                        
                        $fee_status = ($fee_payable - $exemptions) - $payments;
                        $student_fee_status =$fee_status;
                            
                    }
                    
                    $update_result = [
                            'result_notes' => ($student_fee_status == 0) ? 'Vérification effectuée': 'Veuillez vous référer a la comptabilité',
                            'result_status' => ($student_fee_status == 0) ? 'published':'pending',
                            'result_available' => ($student_fee_status == 0) ? 1 : 0,
                            'result_updated_at' => date('Y-m-d H:i:s'),
                        ];
                        //save new data in table
                        $this->model->update_data('results', $update_result, ['result_school_id' => $schoolid,'result_student_id' => $student_id, 'result_annualperiod_id' => $periode_id]);
                   
                }
                $datastudent = $data['student'];
                $dataschool = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
                $dataresult = $this->join->fetch_results(array('result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid, 'period_status' => 'actif', 'result_student_id' => $student_id, 'result_annualperiod_id' => $periode_id), '*', TRUE);
                
                return $this->response->setJSON(['result' => $dataresult, 'student' => $datastudent, 'school' => $dataschool]);
               
            }else{

                return $this->response->setJSON(['puberrors' => 'Student not found']);

            }
        }
    }
    function checkStudentPayment($feedetail_id, $studentid, $schoolid, $yearid)
    {
        //$studentid = (session()->studentchoosed) ? session()->studentchoosed : '';
        $total_paid_amount = 0;
        if (!empty($feedetail_id)) {

            $paydetails = $this->join->fetch_payments_data(array('payment_student_id' => $studentid, 'payment_year_id' => $yearid, 'paydetails_fee_id' => $feedetail_id, 'payment_school_id' => $schoolid), '*', false);
            //$paydetails = $this->join->fetch_payments_data(array('payment_student_id' => $studentid,'payment_year_id' => $yearid,'paydetails_fee_id' => $feedetail_id,'payment_school_id' => $schoolid),'*', TRUE);

            if (!empty($paydetails)) {
                foreach ($paydetails as $paydetail) {
                    $total_paid_amount += $paydetail['paydetails_paid_amount'];
                }
            }
        }
        return $total_paid_amount;
    }
    function checkStudentExemptions($feedetail_id, $classe_id, $studentid, $schoolid, $yearid)
    {
        $total_discount = 0;
        $classe_exemption = 0;
        $student_exemption = 0;
        if (!empty($feedetail_id)) {
            $classesexemptions = $this->join->fetch_exemptions_classes(array('exemption_year_id' => $yearid, 'exemptionclasse_classe_id' => $classe_id, 'exemptionclasse_school_id' => $schoolid));
            $studentexemptions = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'feestudent_inscription_id' => $studentid, 'feestudent_school_id' => $schoolid));
            $feesexemptions = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
            if (!empty($feesexemptions)) {
                foreach ($feesexemptions as $discount) {
                    if ($discount['feediscount_feedetail_id'] == $feedetail_id) {
                        //GET STUDENT DISCOUNT
                        if ((!empty($studentexemptions))) {
                            foreach ($studentexemptions as $studentexemption) {
                                if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {

                                    $student_exemption = $studentexemption['exemption_cost_discount'];

                                }
                            }
                        }
                        //GET CLASSE DISCOUNT
                        if ((!empty($classesexemptions))) {
                            foreach ($classesexemptions as $classeexemption) {
                                if ($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id']) {
                                    $classe_exemption = $classeexemption['exemption_cost_discount'];
                                }
                            }
                        }
                    }
                }
            }
        }
        $total_discount += $classe_exemption + $student_exemption;
        return $total_discount;
    }
    function checkStudentRegistration(){
        //STUDENT ID CODE
        $student_code = trim($this->request->getGet('query'));

        if(!empty($student_code) && $this->model->fetch_row_data('students', array('student_code' => $student_code))) {
            
            $year_data= $this->model->fetch_row_data('years', array('year_status' => 'actif'));
            $schoolid = (!empty($year_data)) ? $year_data['year_school_id']:'';

            $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_code' => $student_code), '*', TRUE);
            
            if(!empty($data['student'])){

                $datastudent = $data['student'];
                $dataschool = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
                
                return $this->response->setJSON(['student' => $datastudent, 'school' => $dataschool]);
               
            }else{

                return $this->response->setJSON(['puberrors' => 'Student not found']);

            }
        }else{
            return $this->response->setJSON(['puberrors' => 'Student not found']);
        }
    }
}