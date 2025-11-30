<?php
namespace App\Controllers;

class Main extends BaseController
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
        $schoolid = $this->session->schoolid;
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id'=>$schoolid));
        $data['title'] = "Schools infosheet";
        $data['_view'] = "main/school/infosheet";
        return view('layouts/main', $data);
    }
    public function config($page = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;

        switch ($page) {
            case 'years':
                $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
                break;
            case 'sections':
                $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
                break;
            case 'options':
                $data['options'] = $this->join->fetch_join_data('classes_options', 'sections', 'section_id = option_section_id', array('option_school_id' => $schoolid), 'option_created_at');
                $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
                break;
            case 'degrees':
                $data['degrees'] = $this->model->fetch_all_data('classes_degrees', array('degree_school_id' => $schoolid), 'degree_created_at');
                break;
            default:
            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
            $data['degrees'] = $this->model->fetch_all_data('classes_degrees', array('degree_school_id' => $schoolid), 'degree_created_at');
            $data['options'] = $this->join->fetch_join_data('classes_options', 'sections', 'section_id = option_section_id', array('option_school_id' => $schoolid), 'option_created_at');
            $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');  
        }
        //dd($data['sections']);
        $data['title'] = "Configuration of " . $page;
        $data['_view'] = "main/config/" . $page;
        return view('layouts/main', $data);
    }
    
    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        $schoolid = $this->session->schoolid;
        
        if($table == 'sectionActivation'){
            $section_type = ($status_value == 'actif') ? 'inactif' : 'actif';

            session()->set('sectionsendsms', $section_type);
            //update data in table
            $this->model->update_data('sections', ['section_type' => $section_type ], array('section_id' => $uid));
            return redirect()->back()->with('success', "Modification activation section effectuée avec succés");
        }else{
        
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

            if($table == 'year'){
                $this->model->update_data('years', ['year_status' => 'inactif'], array('year_id !=' => $uid));
                
                if (!empty($uid)){
                    $year = $this->model->fetch_row_data('years', array('year_id' => $uid, 'year_school_id' => $schoolid));
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
                }
            }
            return redirect()->back()->with('success', "Modification Statut effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
        }
        }
    }
    public function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'option':
                $realnametable = 'classes_options';
                $real_uid = 'option_id';
                break;
            case 'degree':
                    $realnametable = 'classes_degrees';
                    $real_uid = 'degree_id';
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
    public function saveSchool($school_id = null)
    {
        $data = [];
        $school_data =[];
        if (!empty($school_id)) {
            
            $school_data = $this->model->fetch_row_data('schools', array('school_id'=>$school_id));
            $data['school'] = $school_data;

            if ($this->request->getFile('logo') OR $this->request->getFile('picture')) {
                $fullPathFile = 'public/uploads/images';
                $logo_random_name ='';
                $cover_picture_name ='';

                $update_uplaod_file = FALSE;

                $db_school_logo = $school_data['school_logo']; 
                $db_school_cover = $school_data['school_picture_cover']; 

                if (!empty($this->request->getFile('logo')->getName())) {
                
                    $rulers = [
                        'logo' => [
                            'rules' => 'uploaded[logo]|max_size[logo,4096]|ext_in[logo,png,jpg,jpeg,webp]',
                            'errors' => [
                                'uploaded' => 'le fichier doit etre au format image et doit avoir tout au plus 4Mo',
                            ],
                        ],
                    ];
                    if ($this->validate($rulers)) {
                        $logoFile = $this->request->getFile('logo');
                        //foreach($imagefile['images'] as $img){
                        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                            //rename image
                            $logo_random_name = $logoFile->getRandomName();
                            //move to upload directory
                            $logoFile->move(ROOTPATH . $fullPathFile, $logo_random_name);
                            $update_uplaod_file = TRUE;
                            
                            $file_path_logo = $fullPathFile.'/'.$db_school_logo;

                            if (file_exists($file_path_logo)) {

                                if (chdir($fullPathFile) && (!empty($db_school_logo))) {
                                    //REMOVE EXISTING FILE
                                    unlink($db_school_logo);
                                }
                            }
                        }
                    }
                }
                if (!empty($this->request->getFile('picture')->getName())) {
                            $rulers = [ 
                                'picture' => [
                                    'rules' => 'uploaded[picture]|max_size[picture,4096]|ext_in[picture,png,jpg,jpeg,webp]',
                                    'errors' => [
                                        'uploaded' => 'le fichier doit etre au format image et doit avoir tout au plus 4Mo',
                                    ],
                                ],
                            ];
                            if ($this->validate($rulers)) {
                                $picture_file = $this->request->getFile('picture');
                                if ($picture_file->isValid() && !$picture_file->hasMoved()) {
                                    //rename image
                                    $cover_picture_name = $picture_file->getRandomName();
                                    //move to upload directory
                                    $picture_file->move(ROOTPATH . $fullPathFile, $cover_picture_name);
                                    $update_uplaod_file = TRUE;
                                   
                                    $file_path_cover = $fullPathFile.'/'.$db_school_cover;

                                    if(file_exists($file_path_cover)){
                                        
                                        if (chdir($fullPathFile) && (!empty($db_school_cover))) {
                                            //REMOVE EXISTING FILE
                                            unlink($db_school_cover);
                                        }
                                    }
                                    
                                }
                            }
                }
                   
                if($update_uplaod_file == TRUE){
                    $db_updated_logo = (!empty($logo_random_name)) ? $logo_random_name: $db_school_logo; 
                    $db_updated_cover = (!empty($cover_picture_name)) ? $cover_picture_name: $db_school_cover; 
                        $update_school_data = [
                            'school_logo' => $db_updated_logo,
                            'school_picture_cover' => $db_updated_cover,
                        ];
                        //update data in table
                        if ($this->model->update_data('schools', $update_school_data, array('school_id' => $school_id))) {
                            session()->set('schoollogo', $logo_random_name);
                            session()->set('schoolpicture', $cover_picture_name);
                            return redirect()->back()->with('success', "Modification logo école effectuée avec succés");
                        }
                }else {
                        $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                        $data['validation'] = $this->validator;
                        $data['_view'] = ('main/school/infosheet');
                        echo view('layouts/main', $data);
                    }
            }
            if (!empty($school_id) && $this->request->getPost()) {
                $rulers = [
                    'fullname' => [
                        'rulers' => 'required',
                        'errors' => [
                            'required' => "Nom obligatoire",
                        ],
                    ],
                    'shortname' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Acronyme obligatoire',
                        ],
                    ],
                    'school_type' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Type obligatoire',
                        ],
                    ],
                    'school_status' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Statut obligatoire',
                        ],
                    ],
                    'school_phone' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Numéro de contact obligatoire',
                        ],
                    ],
                    'address' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Adresse obligatoire',
                        ],
                    ],
                ];

                if ($this->validate($rulers)) {
                    $name = (($this->request->getPost('fullname')));
                    $shortname = (($this->request->getPost('shortname')));
                    $school_type = (($this->request->getPost('school_type')));
                    $school_status = (($this->request->getPost('school_status')));
                    $school_phone = (($this->request->getPost('school_phone')));
                    $school_email = (($this->request->getPost('school_email')));
                    $school_manager = (($this->request->getPost('school_manager')));
                    $school_address = (($this->request->getPost('address')));
                    $school_about = (($this->request->getPost('notes')));

                    $city = (($this->request->getPost('city')));
                    $province = (($this->request->getPost('province')));
                    $country = (($this->request->getPost('country')));
                    $register_number = $this->request->getPost('register_number');
                    $init_identify = $this->request->getPost('init_identify');
                    $school_id_code = $this->request->getPost('school_code');
                    $school_antenna_code = $this->request->getPost('school_antenna_code');

                    $slogan = trim(htmlspecialchars($this->request->getPost('school_slogan')));
                    $website = trim(htmlspecialchars($this->request->getPost('school_website')));
                   
                
                    $current_datetime = date('Y-m-d H:i:s');
                    $update_school_data = [
                        'school_fullname' => $name,
                        'school_shortname' => $shortname,
                        'school_phone' => $school_phone,
                        'school_email' => $school_email,
                        'school_type' => $school_type,
                        'school_status' => $school_status,
                        'school_manager_name' => $school_manager,
                        'school_updated_at' => $current_datetime,
                        'school_address' => $school_address,
                        'school_notes' => $school_about,
                        'school_website' => $website,
                        'school_slogan' => $slogan,
                        'school_city' => $city,
                        'school_province' => $province,
                        'school_country' => $country,
                        'school_ministry_decree' => $register_number,
                        'school_init_identify' => $init_identify,
                        'school_antenna_code' => $school_antenna_code,
                        'school_code' => $school_id_code,
                    ];
                    //update data in table
                    if ($this->model->update_data('schools', $update_school_data, array('school_id' => $school_id))) {
                        
                        $school_data = $this->model->fetch_row_data('schools', array('school_id' => $school_id));
                        if ((!empty($school_data)) && count($school_data) >= 0) {
                            session()->set('schoolid', $school_data['school_id']);
                            session()->set('schooltoken', $school_data['school_token']);
                            session()->set('schoolfname', $school_data['school_fullname']);
                            session()->set('schoolname', $school_data['school_shortname']);
                            session()->set('schoolslogan', $school_data['school_slogan']);
                            session()->set('schoolwebsite', $school_data['school_website']);
                            session()->set('schoolmanager', $school_data['school_manager_name']);
                            session()->set('schoolphone', $school_data['school_phone']);
                            session()->set('schoolemail', $school_data['school_email']);
                            session()->set('schoollogo', $school_data['school_logo']);
                            session()->set('schoolpicture', $school_data['school_picture_cover']);
                            session()->set('schooladdress', $school_data['school_address']);
                            session()->set('schoolcode', $school_data['school_code']);
                            session()->set('schooltype', $school_data['school_type']);
                            session()->set('schoolstatus', $school_data['school_status']);
                            session()->set('schoolcity', $school_data['school_city']);
                            session()->set('schoolsmscount', $school_data['school_sms_number']);
                            session()->set('schoolsmsstatus', $school_data['school_sms_sending']);
                            session()->set('schoolsmssender', $school_data['school_sms_sender']);
                            session()->set('schoolinit', $school_data['school_init_identify']);
                            session()->set('schoolantenna', $school_data['school_antenna_code']);
                            session()->set('schoolidcode', $school_data['school_code']);

                        }
                        
                        return redirect()->back()->with('success', "Modification fiche école effectuée avec succés");
                    }
                }else {
                    $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                    $data['validation'] = $this->validator;
                    $data['_view'] = ('main/school/edit');
                    echo view('layouts/main', $data);
                }
            } else {
                $data['school'] = $school_data;
                $data['_view'] = ('main/school/edit');
                echo view('layouts/main', $data);
            } 
        }else{
            return redirect()->back()->with('failed', "Fiche introuvable");
                    
        } 
    }
    public function saveSchoolYear($token_year = null)
    {
        $school_id = session()->schoolid;
        $data = [];
        $rulers = [
            'start_year' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Année début obligatoire",
                ],
            ],
            'end_year' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Année fermeture obligatoire',
                ],
            ],
            'started_year_at' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "date début obligatoire",
                ],
            ],
            'closing_year_at' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'date fermeture obligatoire',
                ],
            ],
        ];

        if ($this->validate($rulers)) {
            $start_year = (trim($this->request->getPost('start_year')));
            $end_year = (trim($this->request->getPost('end_year')));
            $started_year_at = strval($this->request->getPost('started_year_at'));
            $ended_year_at = strval($this->request->getPost('closing_year_at'));
            $notes = (trim($this->request->getPost('notes')));
            $current_datetime = date('Y-m-d H:i:s');
            $year_random_token = setPrimaryKey();

            $started_at = date('Y', strtotime($started_year_at));
            $closing_at = date('Y', strtotime($ended_year_at));
            if ($start_year != $started_at) {
                return redirect()->back()->with('failed', "Année de début est incomptablie avec la date ouverture");
            } elseif ($end_year != $closing_at) {
                return redirect()->back()->with('failed', "Année de fin est incomptablie avec la date de cloture");
            } else {
                $start_year = $started_at;
                $end_year = $closing_at;

                //dd($token_year);

                //UPDATE YEAR IF TOKEN EXIST
                if (!empty($token_year)) {
                    //table data
                    $update_year_data = [
                        'year_started' => $start_year,
                        'year_ended' => $end_year,
                        'year_start_date' => $started_year_at,
                        'year_close_date' => $ended_year_at,
                        'year_notes' => $notes,
                        'year_updated_at' => $current_datetime,
                        'year_school_id' => $school_id,
                    ];
                    //save new data in table  '', ''
                    if ($this->model->update_data('years', $update_year_data, array('year_token' => $token_year))) {
                        return redirect()->back()->with('success', "Mise à jour de l'année avec succés!");
                    }
                } else {

                    //verifier si l'annee lancee existe deja pour cette ecole
                    $chechExistsYear = $this->model->fetch_row_data('years', array('year_started' => $start_year, 'year_ended' => $end_year, 'year_school_id' => $school_id));
                    if (!empty($chechExistsYear)) {
                        //if ($chechExistsYear[''] == $start_year && $chechExistsYear['year_ended'] == $end_year) {
                        return redirect()->back()->with('failed', "Désolé, cette année est déjà lancée, réessayer une autre!");
                        //}
                    }
                    //table data
                    $save_year_data = [
                        'year_token' => $year_random_token,
                        'year_started' => $start_year,
                        'year_ended' => $end_year,
                        'year_start_date' => $started_year_at,
                        'year_close_date' => $ended_year_at,
                        'year_notes' => $notes,
                        'year_created_at' => $current_datetime,
                        'year_status' => 'actif',
                        'year_school_id' => $school_id,
                    ];
                    //save new data in table  '', ''
                    $update_year_status = ['year_status' => 'inactif', 'year_close_date' => date('Y-m-d')];
                    if ($this->model->update_data('years', $update_year_status, array('year_school_id' => $school_id,'year_status' => 'actif'))) {
                        $this->model->insert_data('years', $save_year_data);

                       //GET ALL SCHOOL YEAR INFORMATION
                        $year = $this->model->fetch_row_data('years', array('year_token' => $year_random_token, 'year_school_id' => $school_id));
                            if (!empty($year)) {
                                session()->set('yearid', $year['year_id']);
                                session()->set('yeartoken', $year['year_token']);
                                session()->set('yearstarted', $year['year_started']);
                                session()->set('yearclosing', $year['year_ended']);
                                session()->set('yearstartdate', $year['year_start_date']);
                                session()->set('yearclosingdate', $year['year_close_date']);
                                session()->set('yearstatus', $year['year_status']);
                                session()->set('schoolyear', $year['year_started'].'-'.$year['year_ended']);
                            }

                        return redirect()->back()->with('success', "Nouvelle année lancée avec succés. l'affichage de données liees aux années sera initialisé.");
                    } else {
                        return redirect()->back()->with('failed', "ERREUR: Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
                    }
                }
            }
        } else {
            $data['years'] = $this->model->fetch_all_data('years', array(), 'year_created_at');
            $this->session->setFlashdata('failed', 'Veuillez vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('main/config/years');
            return view('layouts/main', $data);
        }
    }
    public function saveClasseSection($section_uid = null)
    {
        $data = [];
        $rulers = [
            'section_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "nom obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $section_name = esc(trim($this->request->getPost('section_name')));
            $section_code = esc(trim($this->request->getPost('section_code')));

            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($section_uid)) {
                $updateTypeData = [
                    'section_code' => (!empty($section_code)) ? $section_code : setReferenceCode(),
                    'section_name' => $section_name,
                    'section_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('sections', $updateTypeData, array('section_id' => $section_uid))) {
                    return redirect()->back()->with('success', "Modification de la faculté effectuée avec succés");
                }
            } else {

                //create new type
                $createNewTypeData = [
                    'section_token' => setPrimaryKey(),
                    'section_code' => (!empty($section_code)) ? $section_code : setReferenceCode(),
                    'section_name' => $section_name,
                    'section_type' => 'inactif',
                    'section_status' => 'actif',
                    'section_created_at' => $current_datetime,
                    'section_school_id' => $this->session->schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('sections', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création de la faculté effectuée avec succés");
                }
            }

        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    public function saveClasseOption($option_uid = null)
    {
        $schoolid = $this->session->schoolid;
        $rulers = [
            'option_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "nom obligatoire",
                ],
            ],
            'section_id' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "section obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $option_code = (trim($this->request->getPost('option_code')));
            $option_name = (trim($this->request->getPost('option_name')));
            $section_id = (trim($this->request->getPost('section_id')));
            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($option_uid)) {
                $updateTypeData = [
                    'option_code' => (!empty($option_code)) ? $option_code: setReferenceCode(),
                    'option_name' => $option_name,
                    'option_updated_at' => $current_datetime,
                    'option_section_id' => $section_id,
                ];
                //update data in table
                if ($this->model->update_data('classes_options', $updateTypeData, array('option_id' => $option_uid))) {
                    return redirect()->back()->with('success', "Modification de la filiere effectuée avec succés");
                }
            } else {

                //create new type
                $createNewTypeData = [
                    'option_token' => setPrimaryKey(),
                    'option_code' => (!empty($option_code)) ? $option_code: setReferenceCode(),
                    'option_name' => $option_name,
                    'option_status' => 'actif',
                    'option_created_at' => $current_datetime,
                    'option_section_id' => $section_id,
                    'option_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('classes_options', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création de la filiere effectuée avec succés");
                }
            }
        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    public function saveClasseDegrees($degree_id = null)
    {
        $rulers = [
            'degre_level' => [
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
            
            $degree_level = (trim($this->request->getPost('degre_level')));
            $degree_name = (trim($this->request->getPost('long_name')));
            $degree_shortname = (trim($this->request->getPost('short_name')));
            
            
            $schoolid = $this->session->schoolid;
            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($degree_id)) {
                $updateTypeData = [
                    'degree_code' => $degree_level,
                    'degree_name' => $degree_name,
                    'degree_shortname' => $degree_shortname,
                    'degree_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('classes_degrees', $updateTypeData, array('degree_id' => $degree_id))) {
                    return redirect()->back()->with('success', "Modification Niveaux d'études effectuée avec succés");
                }
            } else {
                if ($this->model->fetch_row_data('classes_degrees', array('degree_school_id' => $schoolid,'degree_code' => $degree_level))) {
                    return redirect()->back()->with('failed', "Le Niveau d'étude $degree_level existe dans le système, veuillez créer un autre");
                }
                $createNewTypeData = [
                    'degree_token' => setPrimaryKey(),
                    'degree_code' => $degree_level,
                    'degree_name' => $degree_name,
                    'degree_shortname' => $degree_shortname,
                    'degree_status' => 'actif',
                    'degree_created_at' => $current_datetime,
                    'degree_school_id' => $schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('classes_degrees', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création Niveaux d'études effectuée avec succés");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }
    public function saveClasse($id_classe=null)
    {
        $schoolid = $this->session->schoolid;
        $data = [];
        $rulers = [
            'degres_classe' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez choisir un élèment",
                ],
            ],
            'option_classe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Option obligatoire',
                ],
            ],
            'places_classe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nombre places obligatoire',
                ],
            ],
        ];

        if ($this->validate($rulers)) {
            $places_classe = (trim($this->request->getPost('places_classe')));
           
            $degres_classe = (trim($this->request->getPost('degres_classe')));
            $short_name_classe = (trim($this->request->getPost('classe_shortname')));
            $option_classe = (trim($this->request->getPost('option_classe')));
            $classe_subname = (trim($this->request->getPost('sub_classe')));
            $comments= (trim($this->request->getPost('notes')));
            $current_datetime = date('Y-m-d H:i:s');

            $name_classe = $degres_classe.'-'.$option_classe.'-'.$classe_subname; 

            if (! empty($id_classe)) {
                //table data
                $update_classe_data = [
                    'classe_subname' => $classe_subname,
                    'classe_name' => $name_classe,
                    'classe_shortname' => $short_name_classe,
                    'classe_total_places' => $places_classe,
                    'classe_degree_id' => $degres_classe,
                    'classe_option_id' => $option_classe,
                    'classe_updated_at' => $current_datetime,
                ];
                if ($this->model->update_data('classes', $update_classe_data, array('classe_id' => $id_classe))) {
                    return redirect()->back()->with('success', "Modification de la promotion effectuée avec succés");
                }
               
            } else {
                if ($this->model->fetch_row_data('classes', array('classe_degree_id' => $degres_classe,'classe_option_id' => $option_classe, 'classe_subname' => $classe_subname))) {
                    return redirect()->back()->with('failed', "La promotion choisie existe dans le système, veuillez créer un autre");
                }
                $create_new_classe = [
                    'classe_token' => setPrimaryKey(),
                    'classe_code' => setReferenceCode(),
                    'classe_name' => $name_classe,
                    'classe_subname' => $classe_subname,
                    'classe_shortname' => $short_name_classe,
                    'classe_total_places' => $places_classe,
                    'classe_degree_id' => $degres_classe,
                    'classe_option_id' => $option_classe,
                    'classe_school_id' => $schoolid,
                    'classe_created_at' => $current_datetime,
                    'classe_status' => 'actif',
                    'classe_type' => 'general',
                    'classe_notes' => $comments,
                ];
                //update data in table
                //save new data in table  '', ''
                if ($this->model->insert_data('classes', $create_new_classe)) {
                    return redirect()->back()->with('success', "Création de la promotion effectuée avec succés");
                }
            } 
        } else {

            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
            $data['degrees'] = $this->model->fetch_all_data('classes_degrees', array('degree_school_id' => $schoolid), 'degree_created_at');
            $data['options'] = $this->join->fetch_join_data('classes_options', 'sections', 'section_id = option_section_id', array('option_school_id' => $schoolid), 'option_created_at');
            $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');  
        

            $this->session->setFlashdata('failed', 'Opération non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('main/config/classes');
            return view('layouts/main', $data);
        }
    }
}