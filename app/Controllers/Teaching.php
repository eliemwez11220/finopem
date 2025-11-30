<?php

namespace App\Controllers;

class Teaching extends BaseController
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
    function index()
    {
        $data['title'] = "Publications";
        $data['_view'] = "teaching/pubs";
        echo view('layouts/main', $data);
    }
    public function page($name = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        //$data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        $data['results'] = $this->join->fetch_results(array('annualperiod_school_id' => $schoolid), '*', FALSE, 'period_shortname', 'ASC');
        $data['yearlyperiods'] = $this->join->fetch_year_periods(array('annualperiod_school_id' => $schoolid), '*', FALSE, 'period_shortname', 'ASC');
        $data['periods'] = $this->model->fetch_all_data('results_period', array('period_school_id' => $schoolid), 'period_shortname');
        $data['years'] = $this->model->fetch_all_data('years', array('year_school_id' => $schoolid, 'year_status' => 'actif'), 'year_created_at');
        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');

        $data['stdresults'] = $this->model->fetch_all_data('results', array('result_school_id' => $schoolid), 'result_created_at');
        
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        $data['results_criteria'] = $this->join->fetch_join_criteria(array('criteria_school_id' => $schoolid), '*', false, 'criteria_created_at');
           
        $section = (session()->has('choosedsectionid')) ? session()->choosedsectionid : '';

        $data['feesclasses'] = $this->join->fetch_fees_classes(array('section_id' => $section, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'ASC', 'feedetail_id');


        if (session()->has('studentchoosedclasse')) {
            $classechoosed = session()->get('studentchoosedclasse');
            $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classechoosed, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');

        } else {
            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');

        }

       //dd($data['results_criteria']);

        if (!empty($name)) {
            $data['title'] = "Publications - " . $name;
            $data['_view'] = "teaching/" . $name;
            echo view('layouts/main', $data);
        }
    }

    public function status($table = null, $status_value = null, $uid = null)
    {
        $schoolid = $this->session->schoolid;
        switch ($table) {
            case 'period':
                $realnametable = 'results_period';
                $real_uid = 'period_id';
                $status = 'period_status';
                $updated_time = 'period_updated_at';
                break;

            case 'annualperiod':
                $realnametable = 'results_annual_period';
                $real_uid = 'annualperiod_id';
                $status = 'annualperiod_status';
                $updated_time = 'annualperiod_updated_at';
                break;case 'criteria':
                $realnametable = 'results_criteria';
                $real_uid = 'criteria_id';
                $status = 'criteria_status';
                $updated_time = 'criteria_updated_at';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_id';
                $status = $table . '_status';
                $updated_time = $table . '_updated_at';
        }

        $statusData = array(
            $status => ($status_value == 'actif') ? 'inactif' : 'actif',
            $updated_time => date('Y-m-d H:i:s'),
        );

        if ($this->model->update_data($realnametable, $statusData, array($real_uid => $uid))) {
            if ($table == 'period') {
                $this->model->update_data('results_period', ['period_status' => 'inactif'], array('period_id !=' => $uid, 'period_school_id' => $schoolid));
            }
            /*if ($table == 'annualperiod'){
                $this->model->update_data('results_annual_period', ['annualperiod_status' => 'actif'], array('annualperiod_id !=' => $uid, 'annualperiod_school_id' => $schoolid));
            }*/
            return redirect()->back()->with('success', "Modification Statut effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
        }
    }
    
    public function resultAvailibility($uid = null)
    {
        $schoolid = $this->session->schoolid;

        $resultdata = $this->join->fetch_results(array('result_school_id' => $schoolid, 'result_id' => $uid), '*', OneRow: TRUE);
        if(! empty($resultdata)){
            $availible = $resultdata['result_available'];

            $statusData = array(
                'result_available' => ($availible == 0) ? 1 : 0,
                'result_updated_at' => date('Y-m-d H:i:s'),
            );
    
            if ($this->model->update_data('results', $statusData, array('result_id' => $uid))) {
                
                return redirect()->back()->with('success', "Modification Statut effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
            }
        }
        
    }
    public function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'period':
                $realnametable = 'results_period';
                $real_uid = 'period_id';
                break;
            case 'annualperiod':
                $realnametable = 'results_annual_period';
                $real_uid = 'annualperiod_id';
                break;
            case 'criteria':
                $realnametable = 'results_criteria';
                $real_uid = 'criteria_id';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_id';
        }
        if ($this->model->delete_data($realnametable, array($real_uid => $uid))) {
            
            /*============= CREATE USER ACTIVITY ==============*/
        $this->createUserActivity('delete'.$table);
        /*============= END USER ACTIVITY ==============*/
            
            return redirect()->back()->with('success', "Suppression $table effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "Suppression non effectuée. Réessayer plus tard");
        }
    }
    public function timing()
    {
        $rulers = [
            'short_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Degrès obligatoire",
                ],
            ],
            'long_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $period_token = trim($this->request->getPost('period_token'));

            //$period_level = trim($this->request->getPost('degre_level'));
            $period_name = trim($this->request->getPost('long_name'));
            $period_shortname = trim($this->request->getPost('short_name'));
            $schoolid = $this->session->schoolid;

            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($period_token)) {
                $updateTypeData = [
                    'period_name' => $period_name,
                    'period_shortname' => $period_shortname,
                    'period_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('results_period', $updateTypeData, array('period_token' => $period_token))) {
                    return redirect()->back()->with('success', "Modification période effectuée avec succés");
                }
            } else {
                if ($this->model->fetch_row_data('results_period', array('period_school_id' => $schoolid, 'period_shortname' => $period_shortname))) {
                    return redirect()->back()->with('failed', "La période $period_shortname existe dans le système, veuillez créer une autre");
                }
                $createNewTypeData = [
                    'period_token' => setPrimaryKey(),
                    'period_code' => setReferenceCode(),
                    'period_name' => $period_name,
                    'period_shortname' => $period_shortname,
                    'period_status' => 'actif',
                    'period_created_at' => $current_datetime,
                    'period_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('results_period', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création période effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    public function yearlyPeriod()
    {
        $rulers = [
            'section' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Section obligatoire",
                ],
            ],
            'period' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Period obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {


            $period = trim($this->request->getPost('period'));
            $section = trim($this->request->getPost('section'));
            $schoolid = $this->session->schoolid;
            $year = $this->session->yearid;

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->model->fetch_row_data('results_annual_period', array('annualperiod_school_id' => $schoolid, 'annualperiod_period_id' => $period, 'annualperiod_section_id' => $section, 'annualperiod_year_id' => $year))) {
                return redirect()->back()->with('failed', "La période $period est deja configuré dans le système, veuillez créer une autre");
            }
            $createNewTypeData = [
                'annualperiod_token' => setPrimaryKey(),
                'annualperiod_code' => setReferenceCode(),
                'annualperiod_year_id' => $year,
                'annualperiod_section_id' => $section,
                'annualperiod_period_id' => $period,
                'annualperiod_status' => 'actif',
                'annualperiod_created_at' => $current_datetime,
                'annualperiod_school_id' => $schoolid,
            ];
            //save new data in table
            if ($this->model->insert_data('results_annual_period', $createNewTypeData)) {
                return redirect()->back()->with('success', "Configuration période annuelle effectuée avec succés");
            }

        } else {
            return redirect()->back()->with('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }
    public function encoding()
    {
        $result_token = $this->request->getPost('result_token');
        //dd($result_token);
        if (!empty($result_token)) {

            $place = trim($this->request->getPost('place'));
            $notes = trim($this->request->getPost('notes'));
            $points = floatval($this->request->getPost('points'));
            $maxima = floatval($this->request->getPost('maxima'));
            $pource = floatval($this->request->getPost('pource'));

            $percentage = ($points!=0 && $maxima!=0) ? $points * 100 / $maxima: 0;
            $valid_perc = ($percentage >= $pource) ? $percentage: $pource;

            $update_result = [
                'result_place' => $place,
                'result_points_obtained' => $points,
                'result_points_maximum' => $maxima,
                'result_percentage' => $valid_perc,
                'result_application' => $notes,
            ];
            //save new data in table
            if ($this->model->update_data('results', $update_result, ['result_token' => $result_token])) {
                return redirect()->back()->with('success', "Modification résultat de la période effectuée avec succés");
            }
        } else {
            $rulers = [
                'student' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Eleve obligatoire",
                    ],
                ],
                'period' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Periode obligatoire",
                    ],
                ],
                'place' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Place obligatoire",
                    ],
                ],
                'notes' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Conduite obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {



                $period = trim($this->request->getPost('period'));
                $student = trim($this->request->getPost('student'));
                $place = trim($this->request->getPost('place'));
                $notes = trim($this->request->getPost('notes'));
                $points = floatval($this->request->getPost('points'));
                $maxima = floatval($this->request->getPost('maxima'));
                $pource = floatval($this->request->getPost('pource'));

                $percentage = ($points!=0 && $maxima!=0) ? $points * 100 / $maxima: 0;
    
                $valid_perc = ($percentage >= $pource) ? $percentage: $pource;

                //dd($valid_perc);


                $schoolid = $this->session->schoolid;
                $year = $this->session->yearid;
                $current_datetime = date('Y-m-d H:i:s');

                if ($this->model->fetch_row_data('results', array('result_school_id' => $schoolid, 'result_annualperiod_id' => $period, 'result_student_id' => $student))) {
                    return redirect()->back()->with('failed', "Le résultat de l'élève choisi pour la période $period est déja configuré dans le système, veuillez créer un autre");
                }
                $createNewTypeData = [
                    'result_token' => setPrimaryKey(),
                    'result_code' => setReferenceCode(),
                    'result_place' => $place,
                    'result_points_obtained' => $points,
                    'result_points_maximum' => $maxima,
                    'result_percentage' => $valid_perc,
                    'result_application' => $notes,
                    //'result_year_id' => $year,
                    'result_student_id' => $student,
                    'result_annualperiod_id' => $period,
                    'result_type' => 'period',
                    'result_status' => 'inactif',
                    'result_created_at' => $current_datetime,
                    'result_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('results', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Configuration résultat de la période effectuée avec succés");
                }

            } else {
                return redirect()->back()->with('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            }
        }
    }
    function criteria()
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $current_datetime = date('Y-m-d H:i:s');
        $classe_id = trim($this->request->getPost('classe'));
        $feeid = trim($this->request->getPost('fee'));
        $annualperiod = trim($this->request->getPost('period'));

        $section = (session()->has('choosedsectionid')) ? session()->choosedsectionid : '';

        $feedata = $this->join->fetch_fees_classes(array('feedetail_id' => $feeid, 'feeclasse_school_id' => $schoolid), '*', TRUE, 'feeclasse_created_at');
        $stdresults = $this->join->fetch_results(array('result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid, 'inscription_classe_id' => $classe_id), '*', FALSE, 'period_shortname', 'ASC');
        if($this->model->fetch_row_data('results_annual_period', array('annualperiod_school_id' => $schoolid, 'annualperiod_status' => 'actif', 'annualperiod_section_id' => $section, 'annualperiod_year_id' => $yearid))) {
            
            if($this->model->fetch_row_data('results_criteria', array('criteria_school_id' => $schoolid, 'criteria_classe_id' => $classe_id,'criteria_fee_id' => $feeid,'criteria_period_id' => $annualperiod))) {
    
                return redirect()->back()->with('failed', "Un critère avec la meme condition basé sur le frais et la classe existe. Veuillez changer un autre frais!");

            }else {
            $insert_criteria = [
                'criteria_token' => setPrimaryKey(),
                'criteria_code' => setReferenceCode(),
                'criteria_status' => 'actif',
                'criteria_period_id' => $annualperiod,
                'criteria_fee_id' => $feeid,
                'criteria_classe_id' => $classe_id,
                'criteria_created_at' => $current_datetime,
                'criteria_school_id' => $schoolid,
            ];
            //save new data in table
            if($this->model->insert_data('results_criteria', $insert_criteria)){

                if (!empty($stdresults) && (!empty($feedata))) {
                $feepayable = $feedata['feedetail_cost_payable'];
                $insert_status = 0;
                $payments = 0;
                $exemptions = 0;

                foreach ($stdresults as $key => $value) {

                    $result_token = $value['result_token'];
                    $student_id = $value['result_student_id'];

                    $payments = $this->checkStudentPayment($feeid, $student_id);
                    $exemptions = $this->checkStudentExemptions($feeid, $classe_id, $student_id);

                    $fee_status = ($feepayable - $exemptions) - $payments;

                    $update_result = [
                        'result_notes' => ($fee_status == 0) ? 'Vérification effectuée': 'Veuillez vous référer a la comptabilité',
                        'result_status' => 'actif',
                        'result_available' => ($fee_status == 0) ? 1 : 0,
                        'result_updated_at' => $current_datetime,
                    ];
                    //save new data in table
                    $this->model->update_data('results', $update_result, ['result_token' => $result_token]);

                    $insert_status = 1;

                }
                if ($insert_status == 1) {

                    return redirect()->back()->with('success', "Validation résultat de la période effectuée avec succés");

                } else {

                    return redirect()->back()->with('failed', "Validation non effectuée. Vérifier vos données");

                }
                } else {

                    return redirect()->back()->with('failed', "Validation non effectuée. Vérifier vos données saisies !");

                }
            }else {

                return redirect()->back()->with('failed', "Critère de publication invalide. Vérifier vos données saisies !");

            }
            }
        
        } 
    }
    public function checkStudentPayment($feedetail_id, $studentid)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
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
    function checkStudentExemptions($feedetail_id, $classe_id, $studentid)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        //$studentid = (session()->studentchoosed) ? session()->studentchoosed : '';
        //$classe_id = (session()->studentclasseid) ? session()->studentclasseid : '';
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

    function pubs()
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $current_datetime = date('Y-m-d H:i:s');
        $classe_id = trim($this->request->getPost('classe'));
        $type = trim($this->request->getPost('pubs'));

        $stdresults = [];

        if (!empty($classe_id) && ($classe_id != 'all')) {

            $stdresults = $this->join->fetch_results(array('result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid, 'inscription_classe_id' => $classe_id), '*', FALSE, 'period_shortname', 'ASC');
        
        }else{

            $section = (session()->has('choosedsectionid')) ? session()->choosedsectionid : '';
            $stdresults = $this->join->fetch_results(array('section_id' => $section, 'result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid), '*', FALSE, 'period_shortname', 'ASC');
        
        }
        if (!empty($stdresults)) {

            $insert_status = 0;

            foreach ($stdresults as $key => $value) {
                
                    $result_token = $value['result_token'];
                    $student_id = $value['result_student_id'];
                    $periode_id = $value['result_annualperiod_id'];

                    $criteriadata = $this->join->fetch_join_criteria(array('criteria_status' => 'actif','criteria_school_id' => $schoolid, 'criteria_classe_id' => $classe_id, 'criteria_period_id' => $periode_id), '*');
           
                    
                    if(!empty($criteriadata)){
                        foreach($criteriadata as $criteria){
                            
                            if($value['classe_id'] == $criteria['criteria_classe_id']){
                                $fee_criteria = $criteria['criteria_fee_id'];
                                $fee_payable = $criteria['feedetail_cost_payable'];
                                $payments = $this->checkStudentPayment($fee_criteria, $student_id);
                                $exemptions = $this->checkStudentExemptions($fee_criteria, $classe_id, $student_id);
                                $fee_status = ($fee_payable - $exemptions) - $payments;
                           
                                $update_result = [
                                    'result_notes' => ($fee_status == 0) ? 'Vérification effectuée': 'Veuillez vous référer a la comptabilité',
                                    'result_status' => ($type == 0) ? 'pending' : 'published',
                                    'result_available' => ($fee_status == 0) ? 1 : 0,
                                    'result_updated_at' => $current_datetime,
                                ];
                                //save new data in table
                                $this->model->update_data('results', $update_result, ['result_token' => $result_token]);
                            }
                        }
                    }
                    
                    $insert_status = 1;
            }
            $message = ($type == 1) ? "Publication résultat": "Suspension publication";

            if ($insert_status == 1) {

                return redirect()->back()->with('success', "$message effectuée avec succés'");

            } else {

                return redirect()->back()->with('failed', "$message non effectuée. Vérifier vos données");

            }
        } else {

            return redirect()->back()->with('failed', "Vérifier vos données saisies !");

        }
    }
    function resultsearch(){
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        
        $student_code = trim($this->request->getGet('query'));


        $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_code' => $student_code), '*', TRUE);
        
        if(!empty($data['student'])){
            
            $student_id = $data['student']['student_id'];
            $classe_id = $data['student']['classe_id'];
            $section = $data['student']['section_id'];
            
            $student_result = $this->join->fetch_results(array('result_student_id' => $student_id, 'annualperiod_year_id' => $yearid, 'inscription_classe_id' => $classe_id), '*', TRUE, 'period_shortname', 'ASC');
        
            $annualperiod= $this->join->fetch_year_periods(array('annualperiod_status' => 'actif', 'period_status' => 'actif','annualperiod_school_id' => $schoolid,'annualperiod_section_id' => $section, 'annualperiod_year_id' => $yearid), '*', TRUE);
        
            $periode_id = (!empty($annualperiod)) ? $annualperiod['annualperiod_id']:'';
            
            
            $criteriadata = $this->join->fetch_join_criteria(array('criteria_status' => 'actif','criteria_school_id' => $schoolid, 'criteria_classe_id' => $classe_id, 'criteria_period_id' => $periode_id), '*');
           
            $student_id = (!empty($student_result)) ? $student_result['result_student_id']:'';
            $result_token = (!empty($student_result)) ? $student_result['result_token']:'';

            if(!empty($criteriadata)){
                foreach($criteriadata as $criteria){
                                                               
                    $fee_criteria = $criteria['criteria_fee_id'];
                    $fee_payable = $criteria['feedetail_cost_payable'];
                    $payments = $this->checkStudentPayment($fee_criteria, $student_id);
                    $exemptions = $this->checkStudentExemptions($fee_criteria, $classe_id, $student_id);
                    $fee_status = ($fee_payable - $exemptions) - $payments;

                    //if($fee_status == 0){
                        $update_result = [
                            'result_notes' => ($fee_status == 0) ? 'Vérification effectuée': 'Veuillez vous référer a la comptabilité',
                            'result_status' => 'published',
                            'result_available' => ($fee_status == 0) ? 1 : 0,
                            'result_updated_at' => date('Y-m-d H:i:s'),
                        ];
                        //save new data in table
                        $this->model->update_data('results', $update_result, ['result_token' => $result_token]);
                    
                }
            }
            $data['result'] = $this->join->fetch_results(array('result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid, 'annualperiod_status' => 'actif', 'result_student_id' => $student_id, 'result_annualperiod_id' => $periode_id), '*', TRUE);
            
        }
        
        //dd($annualperiod);

        $data['title'] = "Consultation Resultats ";
        $data['_view'] = "teaching/results";
        echo view('layouts/main', $data);
    
    }
}