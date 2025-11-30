<?php

namespace App\Controllers;

class Home extends BaseController
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
        $ecole = $this->session->get('schoolid');
        $annee = $this->session->get('yearid');
 
         $data['nb_agents'] = $this->model->fetch_count('users', array('user_status'=>'actif', 'user_school_id'=>$ecole));
         $data['nb_classes'] = $this->model->fetch_count('classes', array('classe_status'=>'actif', 'classe_school_id'=>$ecole));
         $data['nb_sections'] = $this->model->fetch_count('sections', array('section_status'=>'actif', 'section_school_id'=>$ecole));
         $data['nb_options'] = $this->model->fetch_count('classes_options', array('option_status'=>'actif', 'option_school_id'=>$ecole));
         $data['nb_parents'] = $this->model->fetch_count('agents', array('agent_status'=>'actif', 'agent_company_uid'=>$ecole));
         $data['nb_teachers'] = $this->model->fetch_count('courses_teachers', array('teacher_status'=>'actif', 'teacher_school_id'=>$ecole));
         
         $data['filles'] = $this->join->fetch_count_students(
            array('inscription_year_id'=>$annee, 'inscription_school_id'=>$ecole,'inscription_status'=>'actif','student_gender'=>'feminin'));

        $data['garcons'] = $this->join->fetch_count_students(
            array('inscription_year_id'=>$annee,'inscription_school_id'=>$ecole,'inscription_status'=>'actif','student_gender'=>'masculin'));
       
       $data['nb_eleves'] = $this->join->fetch_count_students(array('inscription_year_id'=>$annee,'inscription_school_id'=>$ecole, 
             'inscription_status'=>'actif'));


              $year_data = $this->session->get('yearstart');
              $year = (!empty($year_data))? $year_data: date('Y');

              $payments = $this->join->fetch_dashboard_data('payments', 
                  array('payment_school_id' => $ecole, 'payment_year_id' => $annee), 'payment_created_at', $year, 'yearly', 
              'fees', ("fees.fee_id = payments.payment_fee_id")); 
              
              //GET ALL EXPENSES =>decaissement
              $expenses_data = $this->join->fetch_dashboard_data('finances_expenses', 
                  array('expense_type' => 'expense', 'expense_school_id' => $ecole, 'expense_year_id' => $annee), 'expense_created_at', $year, 'yearly', 
              'finances_cashbox', ("finances_cashbox.cashbox_id = finances_expenses.expense_cashbox_id")); 
      
               //GET ALL CASHBOX OPERATIONS =>Operations bancaires
               $operations = $this->join->fetch_dashboard_data('finances_expenses', 
               array('expense_type !=' => 'expense', 'expense_school_id' => $ecole, 'expense_year_id' => $annee), 'expense_created_at', $year, 'yearly', 
           'finances_cashbox', ("finances_cashbox.cashbox_id = finances_expenses.expense_cashbox_id")); 
      
              //Statistiques paiements commandes
              $fees = array();
              foreach ($payments as $payment) {
                  if ($payment->getResult() > 0) {
                      $fees[] = count($payment->getResult());
                  } else {
                      $fees[] = 0;
                  }
              }
              //Statistiques commandes
              $revenues = array();
              foreach ($operations as $operation) {
                  if ($operation->getResult() > 0) {
                      $revenues[] = count($operation->getResult());
                  } else {
                      $revenues[] = 0;
                  }
              }
              
              //Statistiques factures
              $expenses = array();
              foreach ($expenses_data as $expensedata) {
                  if ($expensedata->getResult() > 0) {
                      $expenses[] = count($expensedata->getResult());
                  } else {
                      $expenses[] = 0;
                  }
              }
              
              //count data
              $data['fees'] = $fees;
              $data['recettes'] = $revenues;
              $data['depenses'] = $expenses;
              $data['students'] = $this->join->fetch_students_data(array('student_school_id'=>$ecole,'student_status'=>'actif', 'inscription_year_id' => $annee));
              // $data['classessections'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code', 'ASC', FALSE, 'section_name');
               $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $ecole), 'section_name', null, null, 'ASC');
           

               // Exemple de données
       
        $data['pie_chart'] = [
            'labels' => ['Hommes', 'Femmes'], //'Général', 
            'values' => [$data['garcons'], $data['filles']], // En pourcentage //$data['nb_eleves'], 
        ];
        $data_fin_in = array_sum(array_slice($fees, 0, 11)); // Sum fees from index 1 to 11
        $data_fin_out = array_sum(array_slice($expenses, 0, 11)); // Sum expenses from index 9 to 11

        $data['finances_pie_chart'] = [
            'labels' => ['Recettes', 'Dépenses'],
            'values' => [$data_fin_in, $data_fin_out], // En pourcentage
        ];

        $data['weekly_schedule'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $annee, 'schedule_school_id' => $ecole), '*');
        /* horizontalBar Chart - frequentation hebdomadaire des eleves
            1. Définir les labels pour chaque jour de la semaine 
            2. Compter le nombre d'élèves présents chaque jour (exemple de valeurs)
            STATUT DE PRESENCE A DEFINIR
            - Presences
            - Absences
            - Autres
        */
        if(empty($data['weekly_schedule'])) {
            // Si aucun emploi du temps n'est trouvé, initialiser avec des valeurs par défaut
            $data['weekly_schedule'] = [
                ['day' => 'Lundi', 'student_count' => 0],
                ['day' => 'Mardi', 'student_count' => 0],
                ['day' => 'Mercredi', 'student_count' => 0],
                ['day' => 'Jeudi', 'student_count' => 0],
                ['day' => 'Vendredi', 'student_count' => 0],
                ['day' => 'Samedi', 'student_count' => 0],
            ];
        }
        $data['horizontal_bar_chart'] = [
            'labels' => ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            'values' => array_map(function($schedule) {
                return $schedule['student_count'] ?? 0; // Assuming 'student_count' holds the number of students for each day
            }, $data['weekly_schedule']),
        ];
        
        //dd($data['horizontal_bar_chart']);

        $data['title']= "Tableau de bord";
        $data['_view']= "main/overview/dashboard";
        return view('layouts/main', $data);
    }
    function changeCurrentYear($status=null, $year_id=null){
        $schoolid = $this->session->schoolid;
        $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
        if (!empty($year_id)){
            $year = $this->model->fetch_row_data('years', array('year_token' => $year_id, 'year_school_id' => $schoolid));
            if ((!empty($year))) {
                session()->set('yearid', $year['year_id']);
                session()->set('yeartoken', $year['year_token']);
                session()->set('yearstarted', $year['year_started']);
                session()->set('yearclosing', $year['year_ended']);
                session()->set('yearstartdate', $year['year_start_date']);
                session()->set('yearclosingdate', $year['year_close_date']);
                session()->set('yearstatus', $year['year_status']);
                session()->set('schoolyear', $year['year_started'].'-'.$year['year_ended']);
            }
            return redirect()->back()->with('success', "Basculement de l'année effectué avec succés!");
        }
        $data['title']= "Tableau de bord";
        $data['_view']= "main/overview/yearly";
        return view('layouts/main', $data);
    }

    function search()
    {
        $schoolid = $this->session->get('schoolid');
        $yearid = $this->session->get('yearid');
        $query = $this->request->getVar('query');
        if(!empty($query)){
            $data['students']= $this->join->fetch_search_data(array('student_school_id'=>$schoolid), $query);
            $data['payments'] = $this->join->fetch_search_payments(array('payment_year_id' => $yearid,'payment_school_id' => $schoolid), $query);
                
            $data['title']= "Resultat de la recherche de ". $query;
            $data['_view']= "main/overview/search";
            return view('layouts/main', $data);
        }else{
            return redirect()->back()->with('failed', "Veuillez saisir un critere de recherche");
        
        }
    }function listingOfNotifications()
    {
        $schoolid = $this->session->get('schoolid');
        $yearid = $this->session->get('yearid');

        $data['title']= "Centre de notifications ";
        $data['_view']= "main/overview/notifications";
        echo view('layouts/main', $data);
       
    }
}