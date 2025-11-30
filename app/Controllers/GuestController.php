<?php

namespace App\Controllers;

class GuestController extends BaseController
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
        $student_code = session()->get('usercode');
        $yearid = $this->session->yearid;
        $schoolid = session()->get('schoolid');

        if (! empty($student_code)) {
            $student_user = $this->model->fetch_row_data('students', array('student_school_id' => $schoolid, 'student_code' => $student_code));
            if (! empty($student_user)) {
                $student_id = $student_user['student_id'];
                $student_data = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_student_id' => $student_id, 'inscription_year_id' => $yearid), '*', true);
                $classe_id = (!empty($student_data)) ? $student_data['classe_id'] : '';
                $section_id = (!empty($student_data)) ? $student_data['section_id'] : '';
                if (! empty($classe_id)) {
                    $this->session->setTempdata('studentchoosedclasse', $classe_id, 1000);
                    $this->session->setTempdata('choosedsectionid', $section_id, 1000);
                    $classe_data = $this->join->fetch_join_classes(array('classe_id' => $classe_id, 'classe_school_id' => $schoolid), 'classe_created_at', 'ASC', TRUE);
                    if (!empty($classe_data)) {
                        $classe_name = setDegresLevels(($classe_data['degree_code'])) . ' ' . ucfirst(($classe_data['classe_subname'])) . ' ' . ucfirst(($classe_data['option_name']));
                        $this->session->setTempdata('choosedclassename', $classe_name, 1000);
                    }
                }

                $data['student'] = $student_data;
                
               $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid), '*', false, 'student_firstname', 'ASC', 'student_id');
            }
        }
        $data['title'] = ucwords('Student Portal');
        $data['_view'] = "guest/student/account";
        echo view('layouts/main', $data);
    }

    function studentPage($page)
    {
        //ADD TEMPORARY MEMORY 
        echo memory_get_usage();
        //ini_set('memory_limit', '1024');
        if (session()->get('profile') == 'student') {

            $student_code = session()->get('usercode');
            $yearid = $this->session->yearid;
            $schoolid = session()->get('schoolid');

            if (! empty($student_code)) {
                $student_user = $this->model->fetch_row_data('students', array('student_school_id' => $schoolid, 'student_code' => $student_code));
                if (! empty($student_user)) {
                    $student_id = $student_user['student_id'];
                    $student_data = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_student_id' => $student_id), '*', true);
                    $classe_id = (!empty($student_data)) ? $student_data['classe_id'] : '';
                    $section_id = (!empty($student_data)) ? $student_data['section_id'] : '';
                    if (! empty($classe_id)) {
                        $this->session->setTempdata('studentchoosedclasse', $classe_id, 1000);
                        $this->session->setTempdata('choosedsectionid', $section_id, 1000);
                        $classe_data = $this->join->fetch_join_classes(array('classe_id' => $classe_id, 'classe_school_id' => $schoolid), 'classe_created_at', 'ASC', TRUE);
                        if (!empty($classe_data)) {
                            $classe_name = setDegresLevels(($classe_data['degree_code'])) . ' ' . ucfirst(($classe_data['classe_subname'])) . ' ' . ucfirst(($classe_data['option_name']));
                            $this->session->setTempdata('choosedclassename', $classe_name, 1000);
                        }
                    }

                    //dd($sess_user_data);
                    $data = [];
                    switch ($page) {
                        case 'account':
                            $data['student'] = $student_data;
                            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid), '*', false, 'student_firstname', 'ASC', 'student_id');

                            break;
                        case 'results':
                            $data['student'] = $student_data;
                            $data['result'] = $this->resultsearch($student_code);
                            $data['annualperiod'] = $this->join->fetch_year_periods(array('annualperiod_status' => 'actif', 'period_status' => 'actif', 'annualperiod_school_id' => $schoolid), '*', TRUE);
                            $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));

                            //dd($data['annualperiod']);

                            break;
                        case 'parcours':
                            $data['student'] = $student_data;
                            $data['parcours'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_student_id' => $student_id), '*', false, 'year_started');
                            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
                            $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
                            break;
                        case 'courses':
                            //FOR TEACHERS SCHEDULES TIME
                            $data['weekly_schedule'] = $this->join->fetch_courses_schedules(array('classe_id' => $classe_id, 'schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');

                            break;
                        case 'slipnotes':
                            $data['info_student'] = $this->join->fetch_students_data(array('student_code' => $student_code, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', TRUE, 'student_firstname', 'ASC', 'student_id');
                            $grade_student_id =  $data['info_student']['inscription_id'];
                            $data['quotes_students'] = $this->join->fetch_courses_students(array('grade_student_id' => $grade_student_id, 'grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*', FALSE, 'grade_created_at', 'DESC', 'course_id', 'grade_total');
                        
                        case 'messages':

                            $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
                            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                            $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');
                            $data['contacts'] = $this->model->fetch_all_data('contacts', array('contact_deleted_at' => null, 'contact_school_id' => $schoolid), 'contact_created_at');
                        default:
                            break;
                    }
                }
            }
        }
        $data['title'] = ucwords('Student Portal');
        $data['_view'] = "guest/student/" . $page;
        echo view('layouts/main', $data);
    }
    function resultsearch($student_code = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_code' => $student_code), '*', TRUE);

        if (!empty($data['student'])) {

            $student_id = $data['student']['student_id'];
            $classe_id = $data['student']['classe_id'];
            $section = $data['student']['section_id'];

            $student_result = $this->join->fetch_results(array('result_student_id' => $student_id, 'annualperiod_year_id' => $yearid, 'inscription_classe_id' => $classe_id), '*', TRUE, 'period_shortname', 'ASC');

            $annualperiod = $this->join->fetch_year_periods(array('annualperiod_status' => 'actif', 'period_status' => 'actif', 'annualperiod_school_id' => $schoolid, 'annualperiod_section_id' => $section, 'annualperiod_year_id' => $yearid), '*', TRUE);

            $periode_id = (!empty($annualperiod)) ? $annualperiod['annualperiod_id'] : '';

            $student_id = (!empty($student_result)) ? $student_result['result_student_id'] : '';
            $result_token = (!empty($student_result)) ? $student_result['result_token'] : '';

            
                    //if($fee_status == 0){
                    $update_result = [
                        'result_notes' => 'Vérification effectuée',
                        'result_status' => 'published',
                        'result_available' => 1,
                        'result_updated_at' => date('Y-m-d H:i:s'),
                    ];
                    //save new data in table
                    $this->model->update_data('results', $update_result, ['result_token' => $result_token]);
              
            return $this->join->fetch_results(array('result_school_id' => $schoolid, 'annualperiod_year_id' => $yearid, 'annualperiod_status' => 'actif', 'result_student_id' => $student_id, 'result_annualperiod_id' => $periode_id), '*', TRUE);
        }
        return false;
    }
}
