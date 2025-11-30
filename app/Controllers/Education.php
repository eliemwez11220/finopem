<?php

namespace App\Controllers;

class Education extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(base_url('logout')); // redirect to login page if not connected
        } else {
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }

    public function index()
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        $data['title'] = "Schools infosheet";
        $data['_view'] = "main/school/infosheet";
        return view('layouts/main', $data);
    }
    public function page($page = null)
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        switch ($page) {
            case 'teachers':
                $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_school_id' => $schoolid), 'teacher_created_at');
                $data['classes'] = $this->join->fetch_join_classes(array('classe_status' => 'actif', 'classe_school_id' => $schoolid), 'degree_code');
                $data['holders'] = $this->join->fetch_holders_classes(array('classeteacher_year_id' => $yearid, 'classeteacher_school_id' => $schoolid), '*');
                break;
            case 'branchs':
                $data['branchs'] = $this->model->fetch_all_data('courses_branchs', array('branch_school_id' => $schoolid), 'branch_created_at');
                break;
            case 'courses':
                $data['branchs'] = $this->model->fetch_all_data('courses_branchs', array('branch_school_id' => $schoolid), 'branch_created_at');
                $data['courses'] = $this->join->fetch_join_data('courses', 'courses_branchs', 'branch_id = course_branch_id', array('course_school_id' => $schoolid), 'course_created_at');
                //$data['options'] = $this->join->fetch_join_data('classes_options', 'sections', 'section_id = option_section_id', array('option_school_id' => $schoolid), 'option_created_at');
                //$data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
                break;
            case 'workhours':
                //FOR TEACHERS SCHEDULES TIME
                $data['weekly_schedule'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');
                $data['courses_schedules'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');
                $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
                //FOR TEACHERS AVAILABILITY
                $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
                $data['teachers_availability'] = $this->join->fetch_join_data('courses_teachers_availability', 'courses_teachers', 'teacher_id = availability_teacher_id', array('availability_year_id' => $yearid, 'availability_school_id' => $schoolid), 'availability_created_at', 'ASC');
                //FOR TEACHERS COURSES ATTRIBUTION
                $data['courses'] = $this->join->fetch_join_data('courses', 'courses_branchs', 'branch_id = course_branch_id', array('course_school_id' => $schoolid), 'course_created_at');
                $data['courses_attributions'] = $this->join->fetch_courses_attribution(array('attribution_year_id' => $yearid, 'attribution_school_id' => $schoolid), '*');

                break;
            case 'courseclasses':
                $data['classes'] = $this->join->fetch_join_classes(array('classe_status' => 'actif', 'classe_school_id' => $schoolid), 'degree_code');
                $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
                $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
                $data['maximas'] = $this->join->fetch_join_data('courses_maximas', 'sections', 'section_id = maxima_section_id', array('maxima_school_id' => $schoolid), 'maxima_created_at', 'ASC');
            break;
            case 'studentquotes':
                $data['yearlyperiods'] = $this->join->fetch_year_periods(array('annualperiod_year_id' => $yearid, 'annualperiod_school_id' => $schoolid), '*', FALSE, 'period_shortname', 'ASC');
        
                $data['quotes_students'] = $this->join->fetch_courses_students(array('grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*');
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                if (session()->has('studentchoosedclasse')) {
                    $classechoosed = session()->get('studentchoosedclasse');
                    $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classechoosed, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                    $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_classe_id' => $classechoosed, 'courseclasse_school_id' => $schoolid), '*');
                } else {
                    $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                    $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
                }
                break;
                case 'slipnotes':
                    if (session()->has('student_sess_token')) {
                        $student_token = session()->get('student_sess_token');
                        $data['info_student'] = $this->join->fetch_students_data(array('student_token' => $student_token, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', TRUE, 'student_firstname', 'ASC', 'student_id');
                        
                        $grade_student_id =  $data['info_student']['inscription_id'];
                        
                        $data['quotes_students'] = $this->join->fetch_courses_students(array('grade_student_id' => $grade_student_id,'grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*', FALSE, 'grade_created_at', 'DESC', 'course_id', 'grade_total');
                    } 
                    $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                        
                        if (session()->has('studentchoosedclasse')) {
                            $classechoosed = session()->get('studentchoosedclasse');
                            $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classechoosed, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                            $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_classe_id' => $classechoosed, 'courseclasse_school_id' => $schoolid), '*');
                        } else {
                            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                            $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
                        }
                    
                break;
                case 'disciplinary':
                    if (session()->has('studentchoosedclasse')) {
                        $classechoosed = session()->get('studentchoosedclasse');
                        $data['teachers'] = $this->join->fetch_holders_classes(array('classeteacher_classe_id' => $classechoosed,'classeteacher_year_id' => $yearid, 'classeteacher_school_id' => $schoolid), '*');
                      
                        $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classechoosed, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                        $data['incidents'] = $this->join->fetch_incidents_data(array('inscription_classe_id' => $classechoosed,'incident_year_id' => $yearid, 'incident_school_id' => $schoolid), '*', FALSE, 'incident_created_at', 'DESC');
                        $data['sanctions'] = $this->join->fetch_sanctions_data(array('inscription_classe_id' => $classechoosed,'sanction_year_id' => $yearid, 'sanction_school_id' => $schoolid), '*', FALSE, 'sanction_created_at', 'DESC');
                        $data['evaluations'] = $this->join->fetch_evaluations_data(array('inscription_classe_id' => $classechoosed,'evaluation_year_id' => $yearid, 'evaluation_school_id' => $schoolid), '*', FALSE, 'evaluation_created_at', 'DESC');
                        $data['sanctionsincidents'] = $data['incidents'];
                    } 
                    if (session()->has('choosedsectionid')) {
                        $sectionchoosed = session()->get('choosedsectionid');
                        $data['yearlyperiods'] = $this->join->fetch_year_periods(array('annualperiod_section_id' => $sectionchoosed,'annualperiod_year_id' => $yearid, 'annualperiod_school_id' => $schoolid, 'annualperiod_status' => 'actif'), '*', FALSE, 'period_shortname', 'ASC');
                        $data['classes'] = $this->join->fetch_join_classes(array('option_section_id' => $sectionchoosed,'classe_status' => 'actif', 'classe_school_id' => $schoolid), 'degree_code');
                        
                    }
                    //$data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
                    
                    break;
            default:
                break;
        }
      // dd($data['incidents']);

        $data['title'] = "Enseignement - " . $page;
        $data['_view'] = "education/" . $page;
        return view('layouts/main', $data);
    }
    private function details($page = null, $token = null)
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        switch ($page) {
            case 'teacher':
                $data['teacher'] = $this->model->fetch_row_data('courses_teachers', array('teacher_token' => $token, 'teacher_school_id' => $schoolid));
                $data['holders'] = $this->join->fetch_holders_classes(array('teacher_token' => $token, 'classeteacher_school_id' => $schoolid), '*');
                break;
            case 'slipnote':
            case 'primary':
            case 'secondary':
            case 'kindergarten':
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                $data['info_student'] = $this->join->fetch_students_data(array('student_token' => $token, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', TRUE, 'student_firstname', 'ASC', 'student_id');
                $grade_student_id =  $data['info_student']['inscription_id'];
                $section_id =  $data['info_student']['section_id'];
                $data['slipnote'] = $this->join->fetch_courses_students(array('grade_student_id' => $grade_student_id,'grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*', FALSE, 'courseclasse_slip_place', 'ASC', 'grade_id');
                $data['courses'] = $this->join->fetch_courses_students(array('grade_student_id' => $grade_student_id,'grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*', FALSE, 'courseclasse_slip_place', 'ASC', 'course_id');
                //$data['courses'] = $this->join->fetch_join_data('courses', 'courses_branchs', 'branch_id = course_branch_id', array('course_school_id' => $schoolid), 'course_created_at');
                $data['maximas'] = $this->model->fetch_all_data('courses_maximas', array('maxima_section_id' => $section_id, 'maxima_school_id' => $schoolid), 'maxima_total_period', null, null, 'ASC');
                    
            break;
            default:
                break;
        }
        //dd($data['slipnote']);
        $data['title'] = "Enseignement - " . $page;
        $data['_view'] = "education/details/" . $page;
        return view('layouts/main', $data);
    }

    private function changeStatus($table = null, $status_value = null, $uid = null)
    {
        $schoolid = session()->get('schoolid');
        switch ($table) {
            case 'option':
                $realnametable = 'classes_options';
                $real_uid = 'option_id';
                $status = 'option_status';
                $updated_time = 'option_updated_at';
                break;
            case 'degrees':
                $realnametable = 'classes_degrees';
                $real_uid = 'degree_id';
                $status = 'degree_status';
                $updated_time = 'degree_updated_at';
                break;case 'evaluation':
                $realnametable = 'disciplinary_students_evaluations';
                $real_uid = 'evaluation_id';
                $status = 'evaluation_status';
                $updated_time = 'evaluation_updated_at';
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

            if ($table == 'year') {
                $this->model->update_data('years', ['year_status' => 'inactif'], array('year_id !=' => $uid));

                if (!empty($uid)) {
                    $year = $this->model->fetch_row_data('years', array('year_id' => $uid, 'year_school_id' => $schoolid));
                    if ((!empty($year))) {
                        session()->set('yearid', $year['year_id']);
                        session()->set('yeartoken', $year['year_token']);
                        session()->set('yearstarted', $year['year_started']);
                        session()->set('yearclosing', $year['year_ended']);
                        session()->set('yearstartdate', $year['year_start_date']);
                        session()->set('yearclosingdate', $year['year_close_date']);
                        session()->set('yearstatus', $year['year_status']);
                        session()->set('schoolyear', $year['year_started'] . '-' . $year['year_ended']);
                    }
                }
            }
            return redirect()->back()->with('success', "Modification Statut effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
        }
    }
    private function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'teacher':
                $realnametable = 'courses_teachers';
                $real_uid = 'teacher_id';
                break;
            case 'branch':
                $realnametable = 'courses_branchs';
                $real_uid = 'branch_id';
                break;
            case 'courseclasses':
                $realnametable = 'courses_classes';
                $real_uid = 'courseclasse_id';
                break;
            case 'availability':
                $realnametable = 'courses_teachers_availability';
                $real_uid = 'availability_id';
                break;
            case 'attribution':
                $realnametable = 'courses_teachers_attribution';
                $real_uid = 'attribution_id';
                break;case 'studentquote':
                $realnametable = 'courses_students_grades';
                $real_uid = 'grade_id';
                break;
                case 'evaluation':
                    $realnametable = 'disciplinary_students_evaluations';
                    $real_uid = 'evaluation_id';
                    break;
            case 'schedule':
                $realnametable = 'courses_schedules';
                $real_uid = 'schedule_id';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_id';
        }
        if ($this->model->delete_data($realnametable, array($real_uid => $uid))) {
            /*============= CREATE USER ACTIVITY ==============*/
            $this->createUserActivity('delete' . $table);
            /*============= END USER ACTIVITY ==============*/

            return redirect()->back()->with('success', "Suppression $table effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "Suppression non effectuée. Réessayer plus tard");
        }
    }

    private function storeTeacher()
    {
        $school_id = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $data = [];
        $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_school_id' => $school_id), 'teacher_created_at');
        $data['holders'] = $this->join->fetch_holders_classes(array('classeteacher_year_id' => $yearid, 'classeteacher_school_id' => $school_id), '*');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_status' => 'actif', 'classe_school_id' => $school_id), 'degree_code');

        if ($this->request->getPost('classe')) {
            $classe = trim($this->request->getPost('classe'));
            $teacher = trim($this->request->getPost('teacher'));
            $status = trim($this->request->getPost('status'));
            $notes = trim($this->request->getPost('notes'));
            $current_datetime = date('Y-m-d H:i:s');

            $createTeacherData = [
                'classeteacher_token' => setPrimaryKey(),
                'classeteacher_code' => setReferenceCode(),
                'classeteacher_classe_id' => $classe,
                'classeteacher_teacher_id' => $teacher,
                'classeteacher_status' => $status,
                'classeteacher_notes' => $notes,
                'classeteacher_created_at' => $current_datetime,
                'classeteacher_year_id' => $yearid,
                'classeteacher_school_id' => $school_id,
            ];
            //CHECK INSERT STUDENT DATA
            if ($this->model->insert_data('classes_teachers', $createTeacherData)) {

                return redirect()->back()->with('success', "Ajout enseignant à la classe effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
            }
        } else {

            $rulers = [
                'teacher_firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nom obligatoire',
                    ],
                ],
                'teacher_phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuteur obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $teacher_picture_name = "";
                $action = trim($this->request->getPost('action'));
                if ($this->request->getFile('teacher_picture')) {

                    $fullPathFile = 'public/uploads/images';

                    if (!empty($this->request->getFile('teacher_picture')->getName())) {

                        $rulers = [
                            'teacher_picture' => [
                                'rules' => 'uploaded[teacher_picture]|max_size[teacher_picture,4096]|ext_in[teacher_picture,png,jpg,jpeg,webp]',
                                'errors' => [
                                    'uploaded' => 'le fichier doit etre au format image et doit avoir tout au plus 4Mo',
                                ],
                            ],
                        ];
                        if ($this->validate($rulers)) {
                            $pictureFile = $this->request->getFile('teacher_picture');
                            //foreach($imagefile['images'] as $img){
                            if ($pictureFile->isValid() && !$pictureFile->hasMoved()) {
                                //rename image
                                $image_random_name = $pictureFile->getRandomName();
                                $db_teacher_image = trim($this->request->getPost('db_teacher_picture'));
                                $file_teacher_image = $fullPathFile . '/' . $db_teacher_image;

                                if (($action == 'picture') && file_exists($file_teacher_image)) {

                                    if (chdir($fullPathFile) && (!empty($db_teacher_image))) {
                                        //REMOVE EXISTING FILE
                                        unlink($db_teacher_image);
                                    }
                                }
                                //move to upload directory
                                $pictureFile->move(ROOTPATH . $fullPathFile, $image_random_name);

                                $teacher_picture_name = $image_random_name;
                            }
                        }
                    }
                }


                $code = trim($this->request->getPost('code'));
                $nom = trim($this->request->getPost('teacher_firstname'));
                $prenom = trim($this->request->getPost('teacher_surname'));
                $postnom = trim($this->request->getPost('teacher_lastname'));
                $title = trim($this->request->getPost('teacher_speciality'));
                $phone = trim($this->request->getPost('teacher_phone'));
                $email = trim($this->request->getPost('teacher_email'));
                $sexe = trim($this->request->getPost('teacher_gender'));

                $date_naissance = trim($this->request->getPost('teacher_born_date'));
                $lieu_naissance = trim($this->request->getPost('teacher_born_place'));
                $teacher_address = trim($this->request->getPost('teacher_address'));
                $teacher_status = trim($this->request->getPost('teacher_status'));
                $teacher_type = trim($this->request->getPost('teacher_type'));
                $notes = trim($this->request->getPost('teacher_notes'));
                //get student token
                $student_token = trim($this->request->getPost('token'));
                $current_datetime = date('Y-m-d H:i:s');

                if ($action == 'picture') {
                    $change_teacher_picture = [
                        'teacher_picture' => $teacher_picture_name,
                        'teacher_updated_at' => $current_datetime,
                        'teacher_school_id' => $school_id,
                    ];

                    if ($this->model->update_data('courses_teachers', $change_teacher_picture, array('teacher_token' => $student_token))) {

                        return redirect()->back()->with('success', "Modification photo enseignant $nom $postnom effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Modification photo non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                } elseif ($action == 'update') {
                    //table data
                    $update_teacher_data = [

                        'teacher_code' => $code,
                        'teacher_firstname' => $nom,
                        'teacher_lastname' => $postnom,
                        'teacher_surname' => $prenom,
                        'teacher_gender' => $sexe,
                        'teacher_speciality' => $title,
                        'teacher_born_date' => $date_naissance,
                        'teacher_born_place' => $lieu_naissance,
                        'teacher_address' => $teacher_address,
                        'teacher_status' => $teacher_status,
                        'teacher_type' => $teacher_type,
                        'teacher_phone' => $phone,
                        'teacher_email' => $email,
                        'teacher_notes' => $notes,
                        'teacher_updated_at' => $current_datetime,
                        'teacher_school_id' => $school_id,
                    ];
                    //CHECK INSERT STUDENT DATA
                    if ($this->model->update_data('courses_teachers', $update_teacher_data, array('teacher_token' => $student_token))) {

                        return redirect()->back()->with('success', "Modification enseignant $nom $postnom effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                } else {
                    //generate uid random
                    $student_token = setPrimaryKey();

                    //table data
                    $create_teacher_data = [
                        'teacher_token' => $student_token,
                        'teacher_code' => $code,
                        'teacher_firstname' => $nom,
                        'teacher_lastname' => $postnom,
                        'teacher_surname' => $prenom,
                        'teacher_gender' => $sexe,
                        'teacher_speciality' => $title,
                        'teacher_born_date' => $date_naissance,
                        'teacher_born_place' => $lieu_naissance,
                        'teacher_address' => $teacher_address,
                        'teacher_status' => 'actif',
                        'teacher_type' => 'ordinaire',
                        'teacher_phone' => $phone,
                        'teacher_email' => $email,
                        'teacher_notes' => $notes,
                        'teacher_picture' => $teacher_picture_name,
                        'teacher_created_at' => $current_datetime,
                        'teacher_school_id' => $school_id,
                    ];
                    //CHECK INSERT STUDENT DATA
                    if ($this->model->insert_data('courses_teachers', $create_teacher_data)) {

                        return redirect()->back()->with('success', "Ajout enseignant $nom $postnom effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                }
            } else {

                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['_view'] = ('education/teachers');
                return view('layouts/main', $data);
            }
        }
    }
    private function storeBranch()
    {

        $rulers = [
            'name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom obligatoire",
                ],
            ],
            'short_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Abbreviation obligatoire",
                ],
            ],
            'status' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Statut obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $action = trim($this->request->getPost('action'));
            $name = trim($this->request->getPost('name'));
            $shortname = trim($this->request->getPost('short_name'));
            $status = trim($this->request->getPost('status'));
            $type = trim($this->request->getPost('type'));
            $notes = trim($this->request->getPost('notes'));

            $schoolid = session()->get('schoolid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $updateTypeData = [
                    'branch_type' => $type,
                    'branch_name' => $name,
                    'branch_status' => $status,
                    'branch_notes' => $notes,
                    'branch_shortname' => $shortname,
                    'branch_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('courses_branchs', $updateTypeData, array('branch_token' => $token))) {
                    return redirect()->back()->with('success', "Modification effectuée avec succés");
                }
            } else {
                $createNewTypeData = [
                    'branch_token' => setPrimaryKey(),
                    'branch_code' => setReferenceCode(),
                    'branch_name' => $name,
                    'branch_status' => $status,
                    'branch_type' => $type,
                    'branch_notes' => $notes,
                    'branch_shortname' => $shortname,
                    'branch_created_at' => $current_datetime,
                    'branch_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('courses_branchs', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création branche effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Opération sur branche non effectuée. Veuillez réessayer plus tard !");
        }
    }
    private function storeCourse()
    {

        $rulers = [
            'name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom obligatoire",
                ],
            ],
            'short_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Abbreviation obligatoire",
                ],
            ],
            'status' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Statut obligatoire",
                ],
            ],
            'branch' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Branche obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $action = trim($this->request->getPost('action'));
            $name = trim($this->request->getPost('name'));
            $shortname = trim($this->request->getPost('short_name'));
            $status = trim($this->request->getPost('status'));
            $type = trim($this->request->getPost('type'));
            $notes = trim($this->request->getPost('notes'));
            $branch_id = trim($this->request->getPost('branch'));

            $schoolid = session()->get('schoolid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $updateTypeData = [
                    'course_type' => $type,
                    'course_name' => $name,
                    'course_status' => $status,
                    'course_notes' => $notes,
                    'course_shortname' => $shortname,
                    'course_branch_id' => $branch_id,
                    'course_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('courses', $updateTypeData, array('course_token' => $token))) {
                    return redirect()->back()->with('success', "Modification cours effectuée avec succés");
                }
            } else {
                $createNewTypeData = [
                    'course_token' => setPrimaryKey(),
                    'course_code' => setReferenceCode(),
                    'course_name' => $name,
                    'course_status' => $status,
                    'course_type' => $type,
                    'course_notes' => $notes,
                    'course_shortname' => $shortname,
                    'course_created_at' => $current_datetime,
                    'course_branch_id' => $branch_id,
                    'course_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('courses', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création cours effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
        }
    }
    private function configCourseClasses($course_token = null)
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        //$yearid = session()->get('yearid');

        if ($this->request->getPost()) {

            $rulers = [
                'classe' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Classe obligatoire",
                    ],
                ],
                'week_hours' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Heures par semaine obligatoire",
                    ],
                ],
                'period_point' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Ponderation obligatoire",
                    ],
                ],
                'maxima' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Maxima obligatoire",
                    ],
                ],
                'slipnote_place' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Point de ponderation obligatoire",
                    ],
                ],
                'is_mandatory' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Choix obligatoire",
                    ],
                ],
                'status' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Statut obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $action = trim($this->request->getPost('action'));
                $is_mandatory = trim($this->request->getPost('is_mandatory'));
                $period_point = trim($this->request->getPost('period_point'));
                $week_hours = trim($this->request->getPost('week_hours'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                $course = trim($this->request->getPost('course'));
                $classe = trim($this->request->getPost('classe'));
                $max_place = trim($this->request->getPost('slipnote_place'));
                $maxima_choosed = trim($this->request->getPost('maxima'));
                $current_datetime = date('Y-m-d H:i:s');
                
                $maxima_course_id = $maxima_choosed;
                if ($maxima_choosed == 'new') {
                    $maxima_new_token = setPrimaryKey(); //generate new unique id for database references
                    
                    $max_period_point = trim($this->request->getPost('max_period_point'));
                    $max_exam_point = trim($this->request->getPost('max_exam_point'));
                    $max_name = trim($this->request->getPost('maxima_name'));
                    $max_section_id = trim($this->request->getPost('section'));

                    $courses_maximas = [
                        'maxima_token' => $maxima_new_token,
                        'maxima_code' => setReferenceCode(),
                        'maxima_total_period' => $max_period_point,
                        'maxima_total_exam' => $max_exam_point,
                        'maxima_name' => (!empty($max_name)) ? $max_name: 'MAXIMA',
                        'maxima_status' => 'actif',
                        'maxima_created_at' => $current_datetime,
                        'maxima_section_id' => $max_section_id,
                        'maxima_school_id' => $schoolid,
                    ];
                    //insert new maxima data
                    if ($this->model->insert_data('courses_maximas', $courses_maximas)) {
                        
                        $maxima_data = $this->model->fetch_row_data('courses_maximas', array('maxima_school_id' => $schoolid, 'maxima_token' => $maxima_new_token));
                        $maxima_course_id = (!empty($maxima_data)) ? $maxima_data['maxima_id'] : $maxima_choosed;
                        
                    }
                }

                if ($action == 'update') {
                    $token = trim($this->request->getPost('token'));
                    $updateTypeData = [
                        'courseclasse_weekhours' => $week_hours,
                        'courseclasse_status' => $status,
                        'courseclasse_is_mandatory' => $is_mandatory,
                        'courseclasse_period_point' => $period_point,
                        'courseclasse_notes' => $notes,
                        'courseclasse_classe_id' => $classe,
                        'courseclasse_maxima_id' => $maxima_course_id,
                        'courseclasse_slip_place' => $max_place,
                        'courseclasse_course_id' => $course,
                        'courseclasse_updated_at' => $current_datetime,
                    ];
                    //update data in table
                    if ($this->model->update_data('courses_classes', $updateTypeData, array('courseclasse_token' => $token))) {
                        return redirect()->back()->with('success', "Modification configuration effectuée avec succés");
                    }
                } else {
                    $createNewTypeData = [
                        'courseclasse_token' => setPrimaryKey(),
                        'courseclasse_code' => setReferenceCode(),
                        'courseclasse_weekhours' => $week_hours,
                        'courseclasse_status' => $status,
                        'courseclasse_is_mandatory' => $is_mandatory,
                        'courseclasse_period_point' => $period_point,
                        'courseclasse_maxima_id' => $maxima_course_id,
                        'courseclasse_slip_place' => $max_place,
                        'courseclasse_notes' => $notes,
                        'courseclasse_created_at' => $current_datetime,
                        'courseclasse_classe_id' => $classe,
                        'courseclasse_course_id' => $course,
                        'courseclasse_school_id' => $schoolid,
                    ];
                    //save new data in table
                    if ($this->model->insert_data('courses_classes', $createNewTypeData)) {
                        return redirect()->back()->with('success', "Configuration cours par classe effectuée avec succés");
                    }
                }
            } else {
                return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
            }
        }
        $data['classes'] = $this->join->fetch_join_classes(array('classe_status' => 'actif', 'classe_school_id' => $schoolid), 'degree_code');
        //$data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
        $data['course'] = $this->join->fetch_join_data('courses', 'courses_branchs', 'branch_id = course_branch_id', array('course_token' => $course_token, 'course_school_id' => $schoolid), 'course_created_at', 'ASC', TRUE);
        $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
        $data['maximas'] = $this->join->fetch_join_data('courses_maximas', 'sections', 'section_id = maxima_section_id', array('maxima_school_id' => $schoolid), 'maxima_created_at', 'ASC');
               
        // dd($data['courses_classes']);
        $data['title'] = "Enseignement - ";
        $data['_view'] = "education/courseclasses";
        return view('layouts/main', $data);
    }
    private function configCourseClasseSchedule()
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        session()->set('sess_tab', 'schedule');

        if ($this->request->getPost()) {

            $rulers = [
                'course_classe' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Cours obligatoire",
                    ],
                ],
                'day_of_week' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Jour de la semaine obligatoire",
                    ],
                ],
                'start_time' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Heures debut obligatoire",
                    ],
                ],
                'end_time' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Heure de fin obligatoire",
                    ],
                ],
                'status' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Statut obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $action = trim($this->request->getPost('action'));

                $start_time = trim($this->request->getPost('start_time'));
                $end_time = trim($this->request->getPost('end_time'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                $day_of_week = trim($this->request->getPost('day_of_week'));
                $course_classe = trim($this->request->getPost('course_classe'));
                $current_datetime = date('Y-m-d H:i:s');

                if ($this->model->fetch_row_data('courses_classes', array('courseclasse_id' => $course_classe))) {
                    $course_classe_data = $this->model->fetch_row_data('courses_classes', array('courseclasse_id' => $course_classe));
                    
                    $classe = $course_classe_data['courseclasse_classe_id'];
                    $course = $course_classe_data['courseclasse_course_id'];

                    $courses_attributions = $this->join->fetch_courses_attribution(array('attribution_course_id' => $course_classe,'attribution_year_id' => $yearid, 'attribution_school_id' => $schoolid), '*', TRUE);

                    //dd($course);
                    if(!empty($courses_attributions)){
                        $teacher = $courses_attributions['attribution_teacher_id'];

                    if ($action == 'update') {
                        $token = trim($this->request->getPost('token'));
                        $updateTypeData = [
                            'schedule_start_time' => $start_time,
                            'schedule_end_time' => $end_time,
                            'schedule_day_week' => $day_of_week,
                            'schedule_status' => $status,
                            'schedule_notes' => $notes,
                            'schedule_updated_at' => $current_datetime,
                            'schedule_course_classe_id' => $course_classe,
                            'schedule_classe_id' => $classe,
                            'schedule_teacher_id' => $teacher,
                            'schedule_course_id' => $course,
                            'schedule_year_id' => $yearid,
                            'schedule_school_id' => $schoolid,
                        ];
                        //update data in table
                        if ($this->model->update_data('courses_schedules', $updateTypeData, array('schedule_token' => $token))) {
                            return redirect()->back()->with('success', "Modification configuration emploi du temps du cours effectuée avec succés");
                        }
                    } else {
                        $createNewTypeData = [
                            'schedule_token' => setPrimaryKey(),
                            'schedule_code' => setReferenceCode(),
                            'schedule_start_time' => $start_time,
                            'schedule_end_time' => $end_time,
                            'schedule_status' => $status,
                            'schedule_day_week' => $day_of_week,
                            'schedule_notes' => $notes,
                            'schedule_created_at' => $current_datetime,
                            'schedule_course_classe_id' => $course_classe,
                            'schedule_classe_id' => $classe,
                            'schedule_teacher_id' => $teacher,
                            'schedule_course_id' => $course,
                            'schedule_year_id' => $yearid,
                            'schedule_school_id' => $schoolid,
                        ];
                        //save new data in table
                        if ($this->model->insert_data('courses_schedules', $createNewTypeData)) {
                            return redirect()->back()->with('success', "Configuration emploi du temps du cours par classe effectuée avec succés");
                        }
                    }
                } else {
                        return redirect()->back()->with('failed', "Aucune attribution trouvée pour ce cours. Veuillez vérifier et réessayer !");
                    }
                } else {
                    return redirect()->back()->with('failed', "Aucun cours trouvé pour cette classe. Veuillez vérifier et réessayer !");
                }
            } else {
                return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
            }
        }
        $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
        $data['courses_schedules'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');

        // dd($data['courses_classes']);
        $data['title'] = "Gestion des horaires - ";
        $data['_view'] = "education/workhours";
        return view('layouts/main', $data);
    }
    private function configTeacherAttribution()
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        session()->set('sess_tab', 'attribution');

        if ($this->request->getPost()) {

            $rulers = [
                'teacher' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Enseignant obligatoire",
                    ],
                ],
                'course' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Coursobligatoire",
                    ],
                ],
                'type' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Type obligatoire",
                    ],
                ],
                'status' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Statut obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $action = trim($this->request->getPost('action'));

                $type = trim($this->request->getPost('type'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                $course = trim($this->request->getPost('course'));
                $teacher = trim($this->request->getPost('teacher'));
                $current_datetime = date('Y-m-d H:i:s');


                if ($action == 'update') {
                    $token = trim($this->request->getPost('token'));
                    $updateTypeData = [
                        'attribution_type' => $type,
                        'attribution_status' => $status,
                        'attribution_notes' => $notes,
                        'attribution_updated_at' => $current_datetime,
                        'attribution_teacher_id' => $teacher,
                        'attribution_course_id' => $course,
                    ];
                    //update data in table
                    if ($this->model->update_data('courses_teachers_attribution', $updateTypeData, array('attribution_token' => $token))) {
                        return redirect()->back()->with('success', "Modification attribution cours effectuée avec succés");
                    }
                } else {
                    $create_availability_data = [
                        'attribution_token' => setPrimaryKey(),
                        'attribution_code' => setReferenceCode(),
                        'attribution_type' => $type,
                        'attribution_status' => $status,
                        'attribution_notes' => $notes,
                        'attribution_created_at' => $current_datetime,
                        'attribution_teacher_id' => $teacher,
                        'attribution_course_id' => $course,
                        'attribution_year_id' => $yearid,
                        'attribution_school_id' => $schoolid,
                    ];
                    //save new data in table
                    if ($this->model->insert_data('courses_teachers_attribution', $create_availability_data)) {
                        return redirect()->back()->with('success', "Configuration attribution cours effectuée avec succés");
                    }
                }
            } else {
                return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
            }
        }
        $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
        $data['courses_schedules'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');
        $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
        $data['teachers_availability'] = $this->join->fetch_join_data('courses_teachers_availability', 'courses_teachers', 'teacher_id = availability_teacher_id', array('availability_year_id' => $yearid, 'availability_school_id' => $schoolid), 'availability_created_at', 'ASC');
        $data['courses_attributions'] = $this->join->fetch_courses_attribution(array('attribution_year_id' => $yearid, 'attribution_school_id' => $schoolid), '*');

        // dd($data['courses_classes']);
        $data['title'] = "Gestion attribution des cours - ";
        $data['_view'] = "education/workhours";
        return view('layouts/main', $data);
    }
    private function configTeacherAvailability()
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        session()->set('sess_tab', 'availability');

        if ($this->request->getPost()) {

            $rulers = [
                'teacher' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Enseignant obligatoire",
                    ],
                ],
                'day_of_week' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Jour de la semaine obligatoire",
                    ],
                ],
                'start_time' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Heures debut obligatoire",
                    ],
                ],
                'end_time' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Heure de fin obligatoire",
                    ],
                ],
                'status' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Statut obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $action = trim($this->request->getPost('action'));

                $start_time = trim($this->request->getPost('start_time'));
                $end_time = trim($this->request->getPost('end_time'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                $day_of_week = trim($this->request->getPost('day_of_week'));
                $teacher = trim($this->request->getPost('teacher'));
                $current_datetime = date('Y-m-d H:i:s');


                if ($action == 'update') {
                    $token = trim($this->request->getPost('token'));
                    $updateTypeData = [
                        'availability_start_time' => $start_time,
                        'availability_end_time' => $end_time,
                        'availability_day_week' => $day_of_week,
                        'availability_status' => $status,
                        'availability_notes' => $notes,
                        'availability_updated_at' => $current_datetime,
                        'availability_teacher_id' => $teacher,
                    ];
                    //update data in table
                    if ($this->model->update_data('courses_teachers_availability', $updateTypeData, array('availability_token' => $token))) {
                        return redirect()->back()->with('success', "Modification configuration disponibilité effectuée avec succés");
                    }
                } else {
                    $create_availability_data = [
                        'availability_token' => setPrimaryKey(),
                        'availability_code' => setReferenceCode(),
                        'availability_start_time' => $start_time,
                        'availability_end_time' => $end_time,
                        'availability_status' => $status,
                        'availability_day_week' => $day_of_week,
                        'availability_notes' => $notes,
                        'availability_created_at' => $current_datetime,
                        'availability_teacher_id' => $teacher,
                        'availability_year_id' => $yearid,
                        'availability_school_id' => $schoolid,
                    ];
                    //save new data in table
                    if ($this->model->insert_data('courses_teachers_availability', $create_availability_data)) {
                        return redirect()->back()->with('success', "Configuration disponibilité enseignant effectuée avec succés");
                    }
                }
            } else {
                return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
            }
        }
        $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
        $data['courses_schedules'] = $this->join->fetch_courses_schedules(array('schedule_year_id' => $yearid, 'schedule_school_id' => $schoolid), '*');
        $data['teachers'] = $this->model->fetch_all_data('courses_teachers', array('teacher_status' => 'actif', 'teacher_school_id' => $schoolid), 'teacher_created_at');
        $data['teachers_availability'] = $this->join->fetch_join_data('courses_teachers_availability', 'courses_teachers', 'teacher_id = availability_teacher_id', array('availability_year_id' => $yearid, 'availability_school_id' => $schoolid), 'availability_created_at', 'ASC');

        // dd($data['courses_classes']);
        $data['title'] = "Gestion disponibilité des enseignants - ";
        $data['_view'] = "education/workhours";
        return view('layouts/main', $data);
    }
    private function configCourseMaxima()
    {
        $rulers = [
            'max_period_point' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Periode obligatoire",
                ],
            ],
            'max_exam_point' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Examen obligatoire",
                ],
            ],
            'section' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Section obligatoire",
                ],
            ],
            'status' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Statut obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $action = trim($this->request->getPost('action'));
            $max_period_point = trim($this->request->getPost('max_period_point'));
            $max_exam_point = trim($this->request->getPost('max_exam_point'));
            $max_name = trim($this->request->getPost('maxima_name'));
            $max_section_id = trim($this->request->getPost('section'));
            $max_status = trim($this->request->getPost('status'));
            $notes = trim($this->request->getPost('notes'));

            $schoolid = session()->get('schoolid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $updateTypeData = [
                    'maxima_total_period' => $max_period_point,
                    'maxima_total_exam' => $max_exam_point,
                    'maxima_name' => (!empty($max_name)) ? $max_name: 'MAXIMA',
                    'maxima_status' => $max_status,
                    'maxima_notes' => $notes,
                    'maxima_section_id' => $max_section_id,
                    'maxima_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('courses_maximas', $updateTypeData, array('maxima_token' => $token))) {
                    return redirect()->back()->with('success', "Modification configuration effectuée avec succés");
                }
            } else {

                $courses_maximas = [
                    'maxima_token' => setPrimaryKey(),
                    'maxima_code' => setReferenceCode(),
                    'maxima_total_period' => $max_period_point,
                    'maxima_total_exam' => $max_exam_point,
                    'maxima_name' => (!empty($max_name)) ? $max_name: 'MAXIMA',
                    'maxima_status' => $max_status,
                    'maxima_notes' => $notes,
                    'maxima_created_at' => $current_datetime,
                    'maxima_section_id' => $max_section_id,
                    'maxima_school_id' => $schoolid,
                ];
                //insert new maxima data
                if ($this->model->insert_data('courses_maximas', $courses_maximas)) {
                    
                    return redirect()->back()->with('success', "Création maxima effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Configuration maxima non effectuée. Veuillez réessayer plus tard !");
        }
    }
    private function addStudentQuotes()
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        if ($this->request->getPost()) {
            $rulers = [
                'student' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Eleve obligatoire",
                    ],
                ],
                'course' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Cours obligatoire",
                    ],
                ],
                'annualperiod' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Periode obligatoire",
                    ],
                ],
                'points' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Point obtenu obligatoire",
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $action = trim($this->request->getPost('action'));
                $points = trim($this->request->getPost('points'));
                $notes = trim($this->request->getPost('notes'));
                $course = trim($this->request->getPost('course'));
                $student = trim($this->request->getPost('student'));
                $annualperiod = trim($this->request->getPost('annualperiod'));
                $current_datetime = date('Y-m-d H:i:s');
                
                if ($action == 'update') {
                    $token = trim($this->request->getPost('token'));
                    $updateTypeData = [
                        'grade_total' => $points,
                        'grade_notes' => $notes,
                        'grade_created_at' => $current_datetime,
                        'grade_student_id' => $student,
                        'grade_course_id' => $course,
                        'grade_annualperiod_id' => $annualperiod,
                        'grade_updated_at' => $current_datetime,
                    ];
                    //update data in table
                    if ($this->model->update_data('courses_students_grades', $updateTypeData, array('grade_token' => $token))) {
                        return redirect()->back()->with('success', "Modification cotation du cours effectuée avec succés");
                    }
                } else {
                    if ($this->model->fetch_row_data('courses_students_grades', array('grade_annualperiod_id' => $annualperiod,'grade_course_id' => $course, 'grade_student_id' => $student,'grade_year_id' => $yearid, 'grade_school_id' => $schoolid))) {
                        return redirect()->back()->with('failed', "Vous avez déja transcrit la cotation de ce cours pour cet élève. Veuillez modifier la cotation si vous souhaitez apporter des modifications.");
                    }
                    $create_availability_data = [
                        'grade_token' => setPrimaryKey(),
                        'grade_code' => setReferenceCode(),
                        'grade_status' => 'actif',
                        'grade_total' => $points,
                        'grade_notes' => $notes,
                        'grade_created_at' => $current_datetime,
                        'grade_annualperiod_id' => $annualperiod,
                        'grade_student_id' => $student,
                        'grade_course_id' => $course,
                        'grade_year_id' => $yearid,
                        'grade_school_id' => $schoolid,
                    ];
                    //save new data in table
                    if ($this->model->insert_data('courses_students_grades', $create_availability_data)) {
                        return redirect()->back()->with('success', "Transcription cotation du cours effectuée avec succés");
                    }
                }
            } else {
                return redirect()->back()->with('failed', "Opération sur cours non effectuée. Veuillez réessayer plus tard !");
            }
        }
        $data['quotes_students'] = $this->join->fetch_courses_students(array('grade_year_id' => $yearid, 'grade_school_id' => $schoolid), '*');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        if (session()->has('studentchoosedclasse')) {
            $classechoosed = session()->get('studentchoosedclasse');
            $data['students'] = $this->join->fetch_students_data(array('inscription_classe_id' => $classechoosed, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
            $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_classe_id' => $classechoosed, 'courseclasse_school_id' => $schoolid), '*');
        } else {
            $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
            $data['courses_classes'] = $this->join->fetch_courses_classes(array('courseclasse_school_id' => $schoolid), '*');
        }
        $data['yearlyperiods'] = $this->join->fetch_year_periods(array('annualperiod_year_id' => $yearid, 'annualperiod_school_id' => $schoolid), '*', FALSE, 'period_shortname', 'ASC');
        
        // dd($data['courses_classes']);
        $data['title'] = "Transcription cotations - ";
        $data['_view'] = "education/studentquotes";
        return view('layouts/main', $data);
    }
    private function studentSlipnote($student_token = null)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        
        session()->remove('studentchoosed');
        session()->remove('student_sess_token');

        if (!empty($student_token)) {
            
            $info_student = $this->join->fetch_students_data(array('student_token' => $student_token, 'student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', TRUE, 'student_firstname', 'ASC', 'student_id');
            
            $grade_student_id =  $info_student['inscription_id'];
            session()->set('studentchoosed',  $grade_student_id);
            session()->set('student_sess_token',  $student_token);
            return redirect()->to(base_url('education/slipnotes'));
        } else {
            return redirect()->back()->with('failed', "Aucun élève n'a été sélectionné. Veuillez réessayer !");
        }
    }

    private function studentIncident()
    {
        session()->set('sess_tab', 'incident');
        $rulers = [
            'student' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Etudiant obligatoire",
                ],
            ],
            'type_incident' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Type obligatoire",
                ],
            ],
            'gravity' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Gravite obligatoire",
                ],
            ],
            'description' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Description obligatoire",
                ],
            ],'date_incident' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Date obligatoire",
                ],
            ],'action_prise' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Action immediate prise obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $action = trim($this->request->getPost('action'));
            $student = trim($this->request->getPost('student'));
            $teacher = trim($this->request->getPost('teacher'));
            $gravity = trim($this->request->getPost('gravity'));
            $description = trim($this->request->getPost('description'));
            $action_prise = trim($this->request->getPost('action_prise'));
            $type_incident = trim($this->request->getPost('type_incident'));
            $date_incident = trim($this->request->getPost('date_incident'));
            $notes = trim($this->request->getPost('commentaires'));

            if($type_incident == 'new'){
                $type_incident = trim($this->request->getPost('new_type_incident'));
            }

            $schoolid = session()->get('schoolid');
            $yearid = session()->get('yearid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $status = trim($this->request->getPost('status'));
                $update_disciplinary_incidents = [
                    'incident_type' => $type_incident,
                    'incident_date' => $date_incident,
                    'incident_gravity' => $gravity,
                    'incident_actions' => $action_prise,
                    'incident_status' => $status,
                    'incident_notes' => $notes,
                    'incident_description' => $description,
                    'incident_updated_at' => $current_datetime,
                    'incident_student_id' => $student,
                    'incident_teacher_id' => $teacher,
                ];
                //update data in table
                if ($this->model->update_data('disciplinary_incidents', $update_disciplinary_incidents, array('incident_token' => $token))) {
                    return redirect()->back()->with('success', "Modification déclaration incident effectuée avec succés");
                }
            } else {

                $disciplinary_incidents = [
                    'incident_token' => setPrimaryKey(),
                    'incident_type' => $type_incident,
                    'incident_date' => $date_incident,
                    'incident_gravity' => $gravity,
                    'incident_actions' => $action_prise,
                    'incident_notes' => $notes,
                    'incident_description' => $description,
                    'incident_created_at' => $current_datetime,
                    'incident_student_id' => $student,
                    'incident_teacher_id' => $teacher,
                    'incident_year_id' => $yearid,
                    'incident_school_id' => $schoolid,
                ];
                //insert new maxima data
                if ($this->model->insert_data('disciplinary_incidents', $disciplinary_incidents)) {
                    
                    return redirect()->back()->with('success', "Création déclaration incident effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Déclaration incident non effectuée. Veuillez réessayer plus tard !");
        }
    }
    private function studentSanction()
    {
        session()->set('sess_tab', 'sanctions');
        $rulers = [
            'incident' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Incident obligatoire",
                ],
            ],
            'sanction' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Sanction obligatoire",
                ],
            ],
            'status' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Etat obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $incident = trim($this->request->getPost('incident'));
            $type_sanction = trim($this->request->getPost('sanction'));
            $timing = trim($this->request->getPost('timing'));
            $status = trim($this->request->getPost('status'));
            $notes = trim($this->request->getPost('notes'));
            $action = trim($this->request->getPost('action'));
            $type_points = trim($this->request->getPost('points'));

            if($type_sanction == 'new_zone'){
                $type_sanction = trim($this->request->getPost('new_sanction'));
            }

            $schoolid = session()->get('schoolid');
            $yearid = session()->get('yearid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $update_disciplinary_sanctions = [
                   'sanction_type' => $type_sanction,
                    'sanction_points' => $type_points,
                    'sanction_timing' => $timing,
                    'sanction_status' => $status,
                    'sanction_notes' => $notes,
                    'sanction_updated_at' => $current_datetime,
                    'sanction_incident_id' => $incident,
                    'sanction_year_id' => $yearid,
                    'sanction_school_id' => $schoolid,
                ];
                //update data in table
                if ($this->model->update_data('disciplinary_sanctions', $update_disciplinary_sanctions, array('sanction_token' => $token))) {
                    return redirect()->back()->with('success', "Modification sanction effectuée avec succés");
                }
            } else {

                $disciplinary_sanctions = [
                    'sanction_token' => setPrimaryKey(),
                    'sanction_date' => date('Y-m-d'),
                    'sanction_type' => $type_sanction,
                    'sanction_points' => $type_points,
                    'sanction_timing' => $timing,
                    'sanction_status' => $status,
                    'sanction_notes' => $notes,
                    'sanction_created_at' => $current_datetime,
                    'sanction_incident_id' => $incident,
                    'sanction_year_id' => $yearid,
                    'sanction_school_id' => $schoolid,
                ];
                //insert new maxima data
                if ($this->model->insert_data('disciplinary_sanctions', $disciplinary_sanctions)) {
                    
                    return redirect()->back()->with('success', "Création sanction incident effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Enregistrement sanction non effectuée. Veuillez réessayer plus tard !");
        }
    }
    private function studentsEvaluations()
    {
        session()->set('sess_tab', 'evaluations');
        $rulers = [
            'student' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Eleve obligatoire",
                ],
            ],
            'annualperiod' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Periode obligatoire",
                ],
            ],
            'conduite' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Conduite obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $student = trim($this->request->getPost('student'));
            $conduite = trim($this->request->getPost('conduite'));
            $annualperiod = trim($this->request->getPost('annualperiod'));
            $notes = trim($this->request->getPost('notes'));
            $action = trim($this->request->getPost('action'));
            $type_points = trim($this->request->getPost('points'));
            $date_eval = trim($this->request->getPost('date_eval'));

            $schoolid = session()->get('schoolid');
            $yearid = session()->get('yearid');
            $current_datetime = date('Y-m-d H:i:s');
            if ($action == 'update') {
                $token = trim($this->request->getPost('token'));
                $status = trim($this->request->getPost('status'));
                $update_disciplinary_evaluations = [
                  'evaluation_date' => $date_eval,
                    'evaluation_mention' => $conduite,
                    'evaluation_total_points' => $type_points,
                    'evaluation_status' => $status,
                    'evaluation_notes' => $notes,
                    'evaluation_updated_at' => $current_datetime,
                    'evaluation_period_id' => $annualperiod,
                    'evaluation_student_id' => $student,
                ];
                //update data in table
                if ($this->model->update_data('disciplinary_students_evaluations', $update_disciplinary_evaluations, array('sanction_token' => $token))) {
                    return redirect()->back()->with('success', "Modification evaluation effectuée avec succés");
                }
            } else {

                $disciplinary_students_evaluations = [
                    'evaluation_token' => setPrimaryKey(),
                    'evaluation_date' => $date_eval,
                    'evaluation_mention' => $conduite,
                    'evaluation_total_points' => $type_points,
                    'evaluation_status' => 'actif',
                    'evaluation_notes' => $notes,
                    'evaluation_created_at' => $current_datetime,
                    'evaluation_period_id' => $annualperiod,
                    'evaluation_student_id' => $student,
                    'evaluation_year_id' => $yearid,
                    'evaluation_school_id' => $schoolid,
                ];
                //insert new maxima data
                if ($this->model->insert_data('disciplinary_students_evaluations', $disciplinary_students_evaluations)) {
                    
                    return redirect()->back()->with('success', "Création evaluation effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Enregistrement evaluation non effectuée. Veuillez réessayer plus tard !");
        }
    }
}
