<?php

namespace App\Controllers;

class Payroll extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('isLoggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url());               // redirect to login page if not connected
        } else {
            //verify method call if exist in this controller
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }
    private function index()
    {
        return $this->list('employees');
    }
    private function list($page = null)
    {
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data=[];
        if ($page == 'employees') {
            $data['agents'] = $this->join->fetch_workers(array('agent_company_uid' => $schoolid), '*', 'agent_created_at');
        } elseif ($page == 'contracts' or ($page == 'badges')) {

            $data['orientation'] = ($page == 'contracts') ? "portrait" : "landscape";
            $data['agents'] = $this->join->fetch_workers(array('agent_company_uid' => $schoolid), '*', 'agent_created_at');
            $data['contracts'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
        }  elseif ($page == 'categories') {
            
            $data['categories'] = $this->model->fetch_all_data('agents_types', array('category_company_uid' => $schoolid, 'category_deleted_at' => null), 'category_created_at');

        }  elseif (($page == 'payments') OR ($page == 'requests')) {
            $period = ($this->request->getGet('month')) ? $this->request->getGet('month') :substr(date('m'), 1, 1);
            $data['period'] = $period; 
            $data['workers'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
            $data['payments'] = $this->join->fetch_salary_payment(array('payment_company_uid' => $schoolid, 'payment_period' => $period), '*', 'agent_firstname', 'ASC');
            $data['requests'] = $this->join->fetch_salary_requests(array('request_company_uid' => $schoolid, 'request_period' => $period), '*', 'request_created_at');
        
            //$data['payments'] = $this->join->fetch_salary_payment(array('payment_company_uid' => $schoolid), '*', 'payment_created_at');
            //$data['requests'] = $this->join->fetch_salary_requests(array('request_company_uid' => $schoolid), '*', 'request_created_at');
        }  elseif (($page == 'slipnotes') OR ($page == 'payslip') OR ($page == 'deductions')) {
            $period = ($this->request->getGet('month')) ? $this->request->getGet('month') :substr(date('m'), 1, 1);
            
            $data['orientation'] = ($page == 'slipnotes') ? "portrait":"landscape"; // Set orientation based on page type
            $data['period'] = $period; 
            $data['payments'] = $this->join->fetch_salary_payment(array('contract_status !=' => 'cancel','payment_status !=' => 'cancel','payment_company_uid' => $schoolid, 'payment_period' => $period), '*', 'agent_firstname', 'ASC');
            $data['requests'] = $this->join->fetch_salary_requests(array('request_status !=' => 'cancel','request_company_uid' => $schoolid, 'request_period' => $period), '*', 'request_created_at');
        
        } elseif ($page == 'attendances') {
            $data['agents'] = $this->join->fetch_workers(array('agent_company_uid' => $schoolid), '*', 'agent_created_at');
            $data['contracts'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
            $date_off_day = date('Y-m-d');
            $data['attendances'] = $this->join->fetch_attendances(array('attendance_company_uid' => $schoolid, 'attendance_date' => $date_off_day), '*', 'attendance_created_at');

        } elseif ($page == 'supphours') {
            $data['agents'] = $this->join->fetch_workers(array('agent_company_uid' => $schoolid), '*', 'agent_created_at');
            $data['contracts'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
            $date_off_day = date('Y-m-d');
            $data['attendances'] = $this->join->fetch_attendances(array('attendance_type' => 'overtime', 'attendance_company_uid' => $schoolid, 'attendance_date' => $date_off_day), '*', 'attendance_created_at');

        } else {
            return redirect()->to(base_url('payroll/employees'));
        }

        $data['title'] = ucwords($page); // Capitalize the first letter
        $data['_view'] = 'payroll/' . $page;
        echo view('layouts/main', $data);
    }
    private function getWorkerDetails($token_worker = null)
    {
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');

        if (!empty($token_worker)) {

            $data['worker'] = $this->join->fetch_workers(array('agent_uid' => $token_worker, 'agent_company_uid' => $schoolid), '*', 'agent_created_at', 'ASC', TRUE);
        }

        $data['title'] = "Details Travailleur"; // Capitalize the first letter
        $data['_view'] = ('payroll/detail/agent');
        echo view('layouts/main', $data);
    }
    private function attendancesWorkerDetails($token_worker = null)
    {
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');

        if (!empty($token_worker)) {

            $data['worker'] = $this->join->fetch_contracts(array('contract_uid' => $token_worker, 'contract_company_uid' => $schoolid), '*', 'contract_created_at', 'ASC', TRUE);
            $data['attendances'] = $this->join->fetch_attendances(array('attendance_employe_id' => $token_worker, 'attendance_company_uid' => $schoolid), '*', 'attendance_date', 'ASC');

        }

        $data['title'] = "Details Pointage Travailleur"; // Capitalize the first letter
        $data['_view'] = ('payroll/detail/attendance');
        echo view('layouts/main', $data);
    }

    private function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'agent':
                $realnametable = 'agents';
                $real_uid = 'agent_uid';
                break;
            case 'agenttype':
                $realnametable = 'agents_types';
                $real_uid = 'category_uid';
                break;
            case 'contract':
                $realnametable = 'agents_contracts';
                $real_uid = 'contract_uid';
                break;

            case 'request':
                $realnametable = 'agents_payroll_requests';
                $real_uid = 'request_uid';
                break;
            case 'payment':
                $realnametable = 'agents_payroll_payments';
                $real_uid = 'payment_uid';
                break;
            case 'attendances':
                $realnametable = 'agents_attendances';
                $real_uid = 'attendance_token';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_uid';
        }
        if ($this->model->delete_data($realnametable, array($real_uid => $uid))) {

            return redirect()->back()->with('success', "Suppression effectuée avec succés");
        
        } else {
            return redirect()->back()->with('failed', "Suppression non effectuée. Réessayer plus tard");
        }
    }
    private function createAgent($type = null)
    {
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');

        if ($this->request->getPost() && (! $this->request->getPost('honeypot'))) {
            $data = [];
            $rulers = [
                'firstname' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Nom obligatoire",
                    ],
                ],
                'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Postnom obligatoire',
                    ],
                ],
                'agent_type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'TYpe obligatoire',
                    ],
                ],
                'agent_phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Numéro de contact obligatoire',
                    ],
                ],
                'gender' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Sexe obligatoire',
                    ],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Adresse obligatoire',
                    ],
                ],
                'city' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ville obligatoire',
                    ],
                ],
                'title' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire',
                    ]
                ],
            ];

            $agent_type = trim($this->request->getPost('agent_type'));

            if ($this->validate($rulers)) {
                $agent_random_pk = setPrimaryKey();
                $firstname = trim($this->request->getPost('firstname'));
                $lastname = trim($this->request->getPost('lastname'));
                $surname = trim($this->request->getPost('surname'));
                $phone = trim($this->request->getPost('agent_phone'));
                $email = trim($this->request->getPost('agent_email'));
                $gender = trim($this->request->getPost('gender'));
                $title = trim($this->request->getPost('title'));
                $address = trim($this->request->getPost('address'));
                $city = trim($this->request->getPost('city'));
                $region = trim($this->request->getPost('region'));
                $social_number = trim($this->request->getPost('social_number'));
                $children_number = trim($this->request->getPost('children_number'));
                $partner_name = trim($this->request->getPost('partner_name'));
                $place_birthday = strval($this->request->getPost('place_birthday'));
                $date_birthday = trim($this->request->getPost('date_birthday'));
                $language = trim($this->request->getPost('language'));
                $country = trim($this->request->getPost('country'));
                $marital_status = trim($this->request->getPost('marital_status'));

                $notes = trim($this->request->getPost('notes'));
                $person_support_number = trim($this->request->getPost('person_support_number'));

                $worker_create_data = array(
                    'agent_uid' => $agent_random_pk,
                    'agent_code' => setReferenceCode(),
                    'agent_firstname' => $firstname,
                    'agent_lastname' => $lastname,
                    'agent_surname' => $surname,
                    'agent_phone' => $phone,
                    'agent_email' => $email,
                    'agent_gender' => $gender,
                    'agent_title' => $title,
                    'agent_address' => $address,
                    'agent_city' => $city,
                    'agent_region' => $region,
                    'agent_status' => 'actif',
                    'agent_created_at' => date('Y-m-d H:i:s'),
                    'agent_social_number' => $social_number,
                    'agent_childrens' => $children_number,
                    'agent_partner_name' => $partner_name,
                    'agent_family_number' => $person_support_number,
                    'agent_place_birthday' => $place_birthday,
                    'agent_date_birthday' => $date_birthday,
                    'agent_languages' => $language,
                    'agent_country' => $country,
                    'agent_civility_status' => $marital_status,
                    'agent_about' => $notes,
                    'agent_type' => $agent_type,
                    'agent_company_uid' => $schoolid,
                );
                $this->model->insert_data('agents', $worker_create_data);
                session()->setFlashdata('success', "Création nouveau travailleur effectuée avec succés.");

                return redirect()->to(base_url('worker/agent/' . $agent_random_pk));
            } else {
                $this->session->setFlashdata('failed', 'Création travailleur non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['validation'] = $this->validator;
                $data['_view'] = 'payroll/create/agent';
                echo view('layouts/main', $data);
            }
        } else {
            $data['title'] = ucwords('Create new worker'); // Capitalize the first letter
            $data['_view'] = 'payroll/create/agent';
            echo view('layouts/main', $data);
        }
    }
    private function modifyAgent($action = null, $token = null)
    {
        if ($action == 'picture') {
            $picture_name = '';
            if ($this->request->getFile('picture') != '') {
                $fileRulers = [
                    'picture' => [
                        'rules' => 'uploaded[picture]|mime_in[picture,image/jpg,image/jpeg,image/gif,image/png]|max_size[picture,4096]',
                        'errors' => [
                            'max_size' => 'Veuillez selectionner une image de moins de 4Mo',
                            'mime_in' => 'Veuillez selectionner une image jpg/jpeg/gif/png',
                            'uploaded' => 'Veuillez selectionner une image',
                        ]
                    ],
                ];
                if ($this->validate($fileRulers)) {
                    $docFile = $this->request->getFile('picture');
                    if ($docFile->isValid() && !$docFile->hasMoved()) {
                        //rename image
                        $newNameFileUpload = $docFile->getRandomName();
                        //$fullPathFile = WRITEPATH . 'uploads/';
                    //move to upload directory
                        $docFile->move(WRITEPATH . 'uploads/', $newNameFileUpload);
                        $picture_name = $newNameFileUpload;
                    }
                    $data_agent_picture = array('agent_picture' => $picture_name);
                    $this->model->update_data('agents', $data_agent_picture, array('agent_uid' => $token));

                    session()->setFlashdata('success', "Changement photo effectué avec succés.");

                    return redirect()->to(base_url('worker/agent/' . $token));
                }
            }
        } elseif ($action == 'update') {

            if ($this->request->getPost()) {
                $firstname = trim($this->request->getPost('firstname'));
                $lastname = trim($this->request->getPost('lastname'));
                $surname = trim($this->request->getPost('surname'));
                $phone = trim($this->request->getPost('agent_phone'));
                $email = trim($this->request->getPost('agent_email'));
                $gender = trim($this->request->getPost('gender'));
                $title = trim($this->request->getPost('title'));
                $address = trim($this->request->getPost('address'));
                $city = trim($this->request->getPost('city'));
                $region = trim($this->request->getPost('region'));
                
                $update_worker_data = array(
                    'agent_firstname' => $firstname,
                    'agent_lastname' => $lastname,
                    'agent_surname' => $surname,
                    'agent_phone' => $phone,
                    'agent_email' => $email,
                    'agent_gender' => $gender,
                    'agent_title' => $title,
                    'agent_address' => $address,
                    'agent_city' => $city,
                    'agent_region' => $region,
                    'agent_status' => 'actif',
                    'agent_updated_at' => date('Y-m-d H:i:s'),
                );
                $this->model->update_data('agents', $update_worker_data, array('agent_uid' => $token));

                session()->setFlashdata('success', "Modification rapide de la fiche effectuée avec succés.");

                return redirect()->to(base_url('worker/agent/' . $token));
            } else {
                session()->setFlashdata('failed', "Modification dossier travailleur non effectuée. Veuillez réessayer plus tard");

                return redirect()->to(base_url('worker/agent/' . $token));
            }
        } else {

            if ($this->request->getPost()) {
                $social_number = trim($this->request->getPost('social_number'));
                $children_number = trim($this->request->getPost('children_number'));
                $partner_name = trim($this->request->getPost('partner_name'));
                $place_birthday = strval($this->request->getPost('place_birthday'));
                $date_birthday = trim($this->request->getPost('date_birthday'));
                $language = trim($this->request->getPost('language'));
                $country = trim($this->request->getPost('country'));
                $marital_status = trim($this->request->getPost('marital_status'));
                $agent_type = trim($this->request->getPost('agent_type'));
                $person_support_number = trim($this->request->getPost('person_support_number'));
                $notes = trim($this->request->getPost('notes'));

                $update_worker_data = array(
                    'agent_social_number' => $social_number,
                    'agent_childrens' => $children_number,
                    'agent_partner_name' => $partner_name,
                    'agent_place_birthday' => $place_birthday,
                    'agent_date_birthday' => $date_birthday,
                    'agent_languages' => $language,
                    'agent_country' => $country,
                    'agent_civility_status' => $marital_status,
                    'agent_about' => $notes,
                    'agent_type' => $agent_type,
                    'agent_family_number' => $person_support_number,
                    'agent_updated_at' => date('Y-m-d H:i:s'),
                );
                $this->model->update_data('agents', $update_worker_data, array('agent_uid' => $token));

                session()->setFlashdata('success', "Modification rapide de la fiche effectuée avec succés.");

                return redirect()->to(base_url('worker/agent/' . $token));
            } else {
                session()->setFlashdata('failed', "Modification dossier travailleur non effectuée. Veuillez réessayer plus tard");

                return redirect()->to(base_url('worker/agent/' . $token));
            }
        }
    }
    private function saveCategorySalary($action, $query = null)
    {
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data = [];
        $data['categories'] = $this->model->fetch_all_data('agents_types', array('category_company_uid' => $schoolid, 'category_deleted_at' => null), 'category_created_at');

        $rulers = [
            'category_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir ce champ',
                ],
            ],

            'category_classe' => [
                'rules' => 'required',
                'errors' => [
                    'numeric' => 'Choisissez une classe',
                ],
            ],
            'category_type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez selectionner un element',
                ],
            ],
        ];

        if ($this->validate($rulers)) {
            $name = $this->request->getPost('category_name');
            $type = $this->request->getPost('category_type');
            $notes = $this->request->getPost('category_description');
            $category_cost_day = $this->request->getPost('category_cost_day');
            $category_cost_location = $this->request->getPost('category_cost_location');
            $category_cost_transport = $this->request->getPost('category_cost_transport');
            $category_classe = $this->request->getPost('category_classe');
            $category_level = $this->request->getPost('category_level');
            $category_tension = $this->request->getPost('category_tension');
            $category_hours_working = $this->request->getPost('category_hours_working');
            $category_number_holidays = $this->request->getPost('category_number_holidays');
            $category_number_working = $this->request->getPost('category_number_working');

            $category_code = $this->request->getPost('category_code');
            $category_exchange = $this->request->getPost('category_exchange');
            $category_currency = $this->request->getPost('category_currency');
            // $category_slug_name = setSlugTitle($name);
            $category_cost_salary = intval($category_number_working) * floatval($category_cost_day);

            if ($action == "create") {
                $nouvelleCatData = [
                    'category_uid' => setPrimaryKey(),
                    'category_code' => (!empty($category_code)) ? $category_code : setReferenceCode(),
                    'category_name' => $name,
                    'category_type' => $type,
                    'category_currency' => $category_currency,
                    'category_cost_exchange' => $category_exchange,
                    'category_cost_day' => floatval($category_cost_day),
                    'category_cost_salary' => floatval($category_cost_salary),
                    'category_cost_location' => floatval($category_cost_location),
                    'category_cost_transport' => floatval($category_cost_transport),
                    'category_level' => $category_level,
                    'category_classe' => $category_classe,
                    'category_tension' => $category_tension,
                    'category_hours_working' => intval($category_hours_working),
                    'category_number_holidays' => intval($category_number_holidays),
                    'category_number_working' => intval($category_number_working),
                    'category_description' => $notes,
                    'category_status' => 'actif',
                    'category_created_at' => date('Y-m-d h:i:s'),
                    'category_created_by' => session()->sess_name . ' - ' . session()->sess_profile,
                    'category_company_uid' => $schoolid,
                ];
                if ($this->model->insert_data('agents_types', $nouvelleCatData)) {
                    return redirect()->back()->with('success', "Création nouvelle categorie effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création categorie");
                }
            } else {
                if ($action == "update" && (!empty($query))) {
                    $category_status = $this->request->getPost('category_status');
                    $updateCatData = [
                        'category_code' => (!empty($category_code)) ? $category_code : setReferenceCode(),
                        'category_name' => $name,
                        'category_type' => $type,
                        'category_currency' => $category_currency,
                        'category_cost_exchange' => $category_exchange,
                        'category_cost_day' => $category_cost_day,
                        'category_cost_salary' => $category_cost_salary,
                        'category_cost_location' => $category_cost_location,
                        'category_cost_transport' => $category_cost_transport,
                        'category_level' => $category_level,
                        'category_classe' => $category_classe,
                        'category_tension' => $category_tension,
                        'category_hours_working' => $category_hours_working,
                        'category_number_holidays' => $category_number_holidays,
                        'category_number_working' => $category_number_working,
                        'category_description' => $notes,
                        'category_status' => $category_status,
                        'category_updated_at' => date('Y-m-d h:i:s'),
                        'category_updated_by' => session()->sess_name . ' - ' . session()->sess_profile,
                    ];
                    if ($this->model->update_data('agents_types', $updateCatData, array('category_uid' => $query))) {
                        return redirect()->back()->with('success', "Modification effectuée  avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Erreur Modification");
                    }
                }
            }
        } else {
            
            session()->setFlashdata('failed', "Veuillez saisir les données valides");
            $data['validation'] = $this->validator;
            $data['_view'] = ('payroll/categories');
            echo view('layouts/main', $data);
        }
    }
    private function storeContract()
    {
        $data = [];
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data['workers'] = $this->join->fetch_workers(array('agent_status' => 'actif', 'agent_company_uid' => $schoolid), '*', 'agent_created_at');
        $data['categories'] = $this->model->fetch_all_data('agents_types', array('category_status' =>'actif','category_company_uid' => $schoolid), 'category_created_at');
        /*
        $data['fonctions'] = $this->model->fetch_all_data('fonctions', array('fonction_status' =>'actif', 'fonction_company_uid' => $schoolid), 'fonction_created_at');
        $data['services'] = $this->model->fetch_all_data('services', array('service_status' =>'actif','service_company_uid' => $schoolid), 'service_created_at');
          */      
        if ($this->request->getPost() && (! $this->request->getPost('honeypot'))) {
            
            $rulers = [
                'worker' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Indiquer le travailleur",
                    ],
                ],
                /*'service' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Indiquer le service',
                    ],
                ],
                'fonction' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'fonction obligatoire',
                    ],
                ],*/
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Categorie obligatoire',
                    ],
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Indiquer le type de contrat',
                    ],
                ],
                'start_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date debut obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $agent_random_pk = setPrimaryKey();
                $worker = trim($this->request->getPost('worker'));
                $category = trim($this->request->getPost('category'));
                //$service = trim($this->request->getPost('service'));
                //$fonction = trim($this->request->getPost('fonction'));
                $type = trim($this->request->getPost('type'));
                $start_date = trim($this->request->getPost('start_date'));
                $end_date = trim($this->request->getPost('end_date'));
                $agent_phone = trim($this->request->getPost('agent_phone'));
                $agent_email = trim($this->request->getPost('agent_email'));
                $date_affec = trim($this->request->getPost('date_affec'));
                $place_affec = trim($this->request->getPost('place_affec'));
                $salary = trim($this->request->getPost('salary'));
                //$working_days = trim($this->request->getPost('working_days'));
                //$status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));

                $contract_create_data = array(
                    'contract_uid' => $agent_random_pk,
                    'contract_code' => setReferenceCode(),
                    'contract_agent_uid' => $worker,
                    'contract_category_uid' => $category,
                    //'contract_service_uid' => $service,
                    //'contract_position_uid' => $fonction,
                    'contract_phone_service' => $agent_phone,
                    'contract_email_service' => $agent_email,
                    'contract_start_date' => $start_date,
                    'contract_end_date' => $end_date,
                    'contract_type' => $type,
                    'contract_date' => $date_affec,
                    'contract_place' => $place_affec,
                    'contract_salary' => $salary,
                    'contract_notes' => $notes,
                    'contract_company_uid' => $schoolid,
                    'contract_status' => 'actif',
                    'contract_created_at' => date('Y-m-d H:i:s'),
                );
                if($this->model->insert_data('agents_contracts', $contract_create_data)){
                    
                    return redirect()->back()->with('success', "Création nouveau contrat effectuée avec succés.");

                }else{

                    return redirect()->back()->with('failed', "Une erreur s'est produite lors de la création du contrat. Veuillez réessayer plus tard.");

                }
            } else {
                $this->session->setFlashdata('failed', 'Création contrat non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['title'] = ucwords('Create new worker contract'); // Capitalize the first letter
            
                $data['validation'] = $this->validator;
                $data['_view'] = 'payroll/create/contract';
                echo view('layouts/main', $data);
            }
        } else {
            $data['title'] = ucwords('Create new worker contract'); // Capitalize the first letter
            $data['_view'] = 'payroll/create/contract';
            echo view('layouts/main', $data);
        }
    }
    private function updateContract($action, $contract_token)
    {
        if($action == 'cancel' && (!empty($contract_token) || $contract_token != '')) {
            $contract_update_data = array(
                'contract_status' => 'cancel',
                'contract_updated_at' => date('Y-m-d H:i:s'),
            );
            if($this->model->update_data('agents_contracts', $contract_update_data, array('contract_uid' => $contract_token))){
                    
                return redirect()->back()->with('success', "Annulation contrat effectuée avec succés.");

            }
        }
        $data = [];
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data['workers'] = $this->join->fetch_workers(array('agent_status' => 'actif', 'agent_company_uid' => $schoolid), '*', 'agent_created_at');
        $data['categories'] = $this->model->fetch_all_data('agents_types', array('category_status' =>'actif','category_company_uid' => $schoolid), 'category_created_at');
        /*
        $data['fonctions'] = $this->model->fetch_all_data('fonctions', array('fonction_status' =>'actif', 'fonction_company_uid' => $schoolid), 'fonction_created_at');
        $data['services'] = $this->model->fetch_all_data('services', array('service_status' =>'actif','service_company_uid' => $schoolid), 'service_created_at');
          */
          $data['contract'] = $this->model->fetch_row_data('agents_contracts', array('contract_uid' => $contract_token));
              
        if ($this->request->getPost() && (! $this->request->getPost('honeypot'))) {
            
            $rulers = [
                'worker' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Indiquer le travailleur",
                    ],
                ],
                /*'service' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Indiquer le service',
                    ],
                ],
                'fonction' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'fonction obligatoire',
                    ],
                ],*/
                'category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Categorie obligatoire',
                    ],
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Indiquer le type de contrat',
                    ],
                ],
                'start_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date debut obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $worker = trim($this->request->getPost('worker'));
                $category = trim($this->request->getPost('category'));
                //$service = trim($this->request->getPost('service'));
                //$fonction = trim($this->request->getPost('fonction'));
                $type = trim($this->request->getPost('type'));
                $start_date = trim($this->request->getPost('start_date'));
                $end_date = trim($this->request->getPost('end_date'));
                $agent_phone = trim($this->request->getPost('agent_phone'));
                $agent_email = trim($this->request->getPost('agent_email'));
                $date_affec = trim($this->request->getPost('date_affec'));
                $place_affec = trim($this->request->getPost('place_affec'));
                $salary = trim($this->request->getPost('salary'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                //$working_days = trim($this->request->getPost('working_days'));

                $contract_update_data = array(
                    'contract_agent_uid' => $worker,
                    'contract_category_uid' => $category,
                    //'contract_service_uid' => $service,
                    //'contract_position_uid' => $fonction,
                    'contract_phone_service' => $agent_phone,
                    'contract_email_service' => $agent_email,
                    'contract_start_date' => $start_date,
                    'contract_end_date' => $end_date,
                    'contract_type' => $type,
                    'contract_date' => $date_affec,
                    'contract_place' => $place_affec,
                    'contract_salary' => $salary,
                    'contract_notes' => $notes,
                    'contract_company_uid' => $schoolid,
                    'contract_status' => $status,
                    'contract_updated_at' => date('Y-m-d H:i:s'),
                );
                if($this->model->update_data('agents_contracts', $contract_update_data, array('contract_uid' => $contract_token))){
                    
                    return redirect()->back()->with('success', "Modification nouveau contrat effectuée avec succés.");

                }else{

                    return redirect()->back()->with('failed', "Une erreur s'est produite lors de la modification du contrat. Veuillez réessayer plus tard.");

                }
            } else {
                $this->session->setFlashdata('failed', 'Modification contrat non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['title'] = ucwords('Update worker contract'); // Capitalize the first letter
            
                $data['validation'] = $this->validator;
                $data['_view'] = 'payroll/edit/contract';
                echo view('layouts/main', $data);
            }
        } else {
            $data['title'] = ucwords('Update contract'); // Capitalize the first letter
            $data['_view'] = 'payroll/edit/contract';
            echo view('layouts/main', $data);
        }
    }
    private function salaryRequest($action, $request_token)
    {
        if($action == 'cancel' && (!empty($request_token) || $request_token != '')) {
            $request_update_data = array(
                'request_status' => 'cancel',
                'request_updated_at' => date('Y-m-d H:i:s'),
            );
            if($this->model->update_data('agents_payroll_requests', $request_update_data, array('request_uid' => $request_token))){
                    
                return redirect()->back()->with('success', "Annulation demande avance sur salaire effectuée avec succés.");

            }
        }elseif($action == 'validate' && (!empty($request_token) || $request_token != '')) {
            $request_update_data = array(
                'request_status' => 'validated',
                'request_updated_at' => date('Y-m-d H:i:s'),
            );
            if($this->model->update_data('agents_payroll_requests', $request_update_data, array('request_uid' => $request_token))){
                    
                return redirect()->back()->with('success', "Validation demande avance sur salaire effectuée avec succés.");

            }
        }elseif($action == 'reject' && (!empty($request_token) || $request_token != '')) {
            $request_update_data = array(
                'request_status' => 'rejected',
                'request_updated_at' => date('Y-m-d H:i:s'),
            );
            if($this->model->update_data('agents_payroll_requests', $request_update_data, array('request_uid' => $request_token))){
                    
                return redirect()->back()->with('success', "Rejet demande avance sur salaire effectuée avec succés.");

            }
        }else{
            $data = [];
            $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
            $data['workers'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
            $data['requests'] = $this->join->fetch_salary_requests(array('request_company_uid' => $schoolid), '*', 'request_created_at');
           
            if ($this->request->getPost() && (! $this->request->getPost('honeypot'))) {
                
                $rulers = [
                    'worker' => [
                        'rulers' => 'required',
                        'errors' => [
                            'required' => "Indiquer le travailleur",
                        ],
                    ],
                    'amount' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Montant obligatoire',
                        ],
                    ],
                    'notes' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Indiquer le motif',
                        ],
                    ],
                    'status' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Statut obligatoire',
                        ],
                    ],
                    'month' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Mois obligatoire',
                        ],
                    ],
                ];

                if ($this->validate($rulers)) {
                    $worker = trim($this->request->getPost('worker'));
                    $amount = trim($this->request->getPost('amount'));
                    $status = trim($this->request->getPost('status'));
                    $notes = trim($this->request->getPost('notes'));
                    $month = trim($this->request->getPost('month'));

                    if($action == 'update' && (!empty($request_token) || $request_token != '')) {
                        $request_update_data = array(
                            'request_agent_uid' => $worker,
                            'request_amount' => $amount,
                            'request_notes' => $notes,
                            'request_status' => $status,
                            'request_period' => $month,
                            'request_updated_at' => date('Y-m-d H:i:s'),
                        );
                        if($this->model->update_data('agents_payroll_requests', $request_update_data, array('request_uid' => $request_token))){
                            
                            return redirect()->back()->with('success', "Modification demande effectuée avec succés.");

                        }else{

                            return redirect()->back()->with('failed', "Une erreur s'est produite lors de modification de la demande sur salaire. Veuillez réessayer plus tard.");

                        }
                    }else{
                        $request_update_data = array(
                            'request_uid' => setPrimaryKey(),
                            'request_code' => setReferenceCode(),
                            'request_agent_uid' => $worker,
                            'request_amount' => $amount,
                            'request_notes' => $notes,
                            'request_status' => $status,
                            'request_period' => $month,
                            'request_date' => date('Y-m-d'),
                            'request_created_at' => date('Y-m-d H:i:s'),
                            'request_company_uid' => $schoolid,
                        );
                        if($this->model->insert_data('agents_payroll_requests', $request_update_data)){
                            
                            return redirect()->back()->with('success', "Création demande sur salaire effectuée avec succés.");

                        }else{

                            return redirect()->back()->with('failed', "Une erreur s'est produite lors de la création demande sur salaire. Veuillez réessayer plus tard.");

                        }
                    }
                } else {
                    $this->session->setFlashdata('failed', 'Création demande sur salaire non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                    $data['title'] = ucwords('Update salary request'); // Capitalize the first letter
                
                    $data['validation'] = $this->validator;
                    $data['_view'] = 'payroll/adavances';
                    echo view('layouts/main', $data);
                }
            } else {
                $data['title'] = ucwords('Update salary request'); // Capitalize the first letter
                $data['_view'] = 'payroll/adavances';
                echo view('layouts/main', $data);
            }
        }
    }
    private function salaryPayment($action, $payment_token)
    {
        if ($action == 'cancel' && (!empty($payment_token) || $payment_token != '')) {
            $payment_update_data = array(
                'payment_status' => 'cancel',
                'payment_updated_at' => date('Y-m-d H:i:s'),
            );
            if ($this->model->update_data('agents_payroll_payments', $payment_update_data, array('payment_uid' => $payment_token))) {

                return redirect()->back()->with('success', "Annulation paiement salaire effectuée avec succés.");

            }
        } elseif ($action == 'validate' && (!empty($payment_token) || $payment_token != '')) {
            $payment_update_data = array(
                'payment_status' => 'validated',
                'payment_updated_at' => date('Y-m-d H:i:s'),
            );
            if ($this->model->update_data('agents_payroll_payments', $payment_update_data, array('payment_uid' => $payment_token))) {

                return redirect()->back()->with('success', "Validation paiement salaire effectuée avec succés.");

            }
        } elseif ($action == 'reject' && (!empty($payment_token) || $payment_token != '')) {
            $payment_update_data = array(
                'payment_status' => 'rejected',
                'payment_updated_at' => date('Y-m-d H:i:s'),
            );
            if ($this->model->update_data('agents_payroll_payments', $payment_update_data, array('payment_uid' => $payment_token))) {

                return redirect()->back()->with('success', "Rejet paiement salaire effectuée avec succés.");

            }
        } else {
            $data = [];
            $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
            $data['workers'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
            $data['payments'] = $this->join->fetch_salary_payment(array('payment_company_uid' => $schoolid), '*', 'payment_created_at');

            if ($this->request->getPost() && (!$this->request->getPost('honeypot'))) {

                $rulers = [
                    'worker' => [
                        'rulers' => 'required',
                        'errors' => [
                            'required' => "Indiquer le travailleur",
                        ],
                    ],
                    'month' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Indiquer le mois',
                        ],
                    ],
                ];

                if ($this->validate($rulers)) {
                    $worker = trim($this->request->getPost('worker'));
                    $amount = trim($this->request->getPost('amount'));
                    $notes = trim($this->request->getPost('notes'));
                    $bonus = trim($this->request->getPost('bonus'));
                    $days = trim($this->request->getPost('days'));
                    $period = trim($this->request->getPost('month'));
                    $pay_off_days = trim($this->request->getPost('off_days'));
                    $pay_hospital_days = trim($this->request->getPost('hospital_days'));
                    $pay_leave_days = trim($this->request->getPost('leave_days'));

                    $attendances = $this->join->fetch_attendances(array('MONTH(attendance_date)' => $period, 'attendance_employe_id' => $worker, 'attendance_company_uid' => $schoolid), '*', 'attendance_date', 'ASC');

                    $work_days = (!empty($attendances)) ? countAttendanceStatus($attendances, 'P') : 0;
                    $off_days = (!empty($attendances)) ? countAttendanceStatus($attendances, 'A') : 0;
                    $hospital_days = (!empty($attendances)) ? countAttendanceStatus($attendances, 'M') : 0;
                    $leave_days = (!empty($attendances)) ? countAttendanceStatus($attendances, 'L') : 0;

                    $overtime_hours_130 = countAttendanceStatus($attendances, '130',1);
                    $overtime_hours_160 = countAttendanceStatus($attendances, '160',1);
                    $overtime_hours_200 = countAttendanceStatus($attendances, '200',1);
                    $overtime_night = countAttendanceStatus($attendances, 'nuit');

                    if ($action == 'update' && (!empty($payment_token) || $payment_token != '')) {
                        $payment_update_data = array(
                            'payment_agent_uid' => $worker,
                            'payment_amount' => $amount,
                            'payment_notes' => $notes,
                            'payment_work_days' => (!empty($work_days)) ? $work_days : $days,
                            'payment_off_days' => (!empty($off_days)) ? $off_days : $pay_off_days,
                            'payment_leave_hospital' => (!empty($hospital_days)) ? $hospital_days : $pay_hospital_days,
                            'payment_leave_days' => (!empty($leave_days)) ? $leave_days : $pay_leave_days,
                            'payment_overtime_130' => (!empty($overtime_hours_130)) ? $overtime_hours_130 : 0,
                            'payment_overtime_160' => (!empty($overtime_hours_160)) ? $overtime_hours_160 : 0,
                            'payment_overtime_200' => (!empty($overtime_hours_200)) ? $overtime_hours_200 : 0,
                            'payment_night_days' => (!empty($overtime_night)) ? $overtime_night : 0,
                            'payment_amount_bonus' => $bonus,
                            'payment_period' => $period,
                            'payment_updated_at' => date('Y-m-d H:i:s'),
                        );
                        if ($this->model->update_data('agents_payroll_payments', $payment_update_data, array('payment_uid' => $payment_token))) {

                            return redirect()->back()->with('success', "Modification paiement salaire effectuée avec succés.");

                        } else {

                            return redirect()->back()->with('failed', "Une erreur s'est produite lors de modification de paiement salaire. Veuillez réessayer plus tard.");

                        }
                    } else {
                        $request_update_data = array(
                            'payment_uid' => setPrimaryKey(),
                            'payment_code' => setReferenceCode(),
                            'payment_agent_uid' => $worker,
                            'payment_work_days' => (!empty($work_days)) ? $work_days : $days,
                            'payment_off_days' => (!empty($off_days)) ? $off_days : $pay_off_days,
                            'payment_leave_hospital' => (!empty($hospital_days)) ? $hospital_days : $pay_hospital_days,
                            'payment_leave_days' => (!empty($leave_days)) ? $leave_days : $pay_leave_days,
                            'payment_overtime_130' => (!empty($overtime_hours_130)) ? $overtime_hours_130 : 0,
                            'payment_overtime_160' => (!empty($overtime_hours_160)) ? $overtime_hours_160 : 0,
                            'payment_overtime_200' => (!empty($overtime_hours_200)) ? $overtime_hours_200 : 0,
                            'payment_night_days' => (!empty($overtime_night)) ? $overtime_night : 0,
                            'payment_amount_bonus' => $bonus,
                            'payment_amount' => $amount,
                            'payment_notes' => $notes,
                            'payment_status' => 'pending',
                            'payment_period' => $period,
                            'payment_date' => date('Y-m-d'),
                            'payment_created_at' => date('Y-m-d H:i:s'),
                            'payment_company_uid' => $schoolid,
                        );
                        if ($this->model->insert_data('agents_payroll_payments', $request_update_data)) {

                            return redirect()->back()->with('success', "Création paiement salaire effectuée avec succés.");

                        } else {

                            return redirect()->back()->with('failed', "Une erreur s'est produite lors de la création paiement salaire. Veuillez réessayer plus tard.");

                        }
                    }
                } else {
                    $this->session->setFlashdata('failed', 'Création paiement salaire non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                    $data['title'] = ucwords('Salary Payment'); // Capitalize the first letter

                    $data['validation'] = $this->validator;
                    $data['_view'] = 'payroll/payments';
                    echo view('layouts/main', $data);
                }
            } else {
                $data['title'] = ucwords('Salary payment'); // Capitalize the first letter
                $data['_view'] = 'payroll/payments';
                echo view('layouts/main', $data);
            }
        }
    }
    private function storeAttendance()
    {
        $data = [];
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data['contracts'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
        $date_off_day = date('Y-m-d');
        $data['attendances'] = $this->join->fetch_attendances(array('attendance_company_uid' => $schoolid, 'attendance_date' => $date_off_day), '*', 'attendance_created_at');

        if ($this->request->getPost() && (!$this->request->getPost('honeypot'))) {

            $rulers = [
                'worker' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Indiquer le travailleur",
                    ],
                ],
                'date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date obligatoire',
                    ],
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Statut obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $agent_random_pk = setPrimaryKey();
                $worker = trim($this->request->getPost('worker'));
                $date = trim($this->request->getPost('date'));
                $type = trim($this->request->getPost('type'));
                $status = trim($this->request->getPost('status'));
                $notes = trim($this->request->getPost('notes'));
                $in_time = trim($this->request->getPost('clock_in'));
                $out_time = trim($this->request->getPost('clock_out'));


                //dd($type);
                if ($this->model->fetch_row_data('agents_attendances', array('attendance_company_uid' => $schoolid, 'attendance_employe_id' => $worker, 'attendance_date' => $date))) {
                    if (($type == 'entry')) {
                        return redirect()->back()->with('failed', "Le pointage du travailleur est déjà effectué pour cette date.");
                    } elseif (($type == 'exit') && (empty($out_time))) {

                        return redirect()->back()->with('failed', "Veuillez saisir l'heure de sortie du travailleur.");

                    } else {

                        $attendance_update_data = array(
                            'attendance_out_time' => $out_time,
                            'attendance_type' => $type,
                            'attendance_notes' => $notes,
                            'attendance_updated_at' => date('Y-m-d H:i:s'),
                        );
                        if ($this->model->update_data('agents_attendances', $attendance_update_data, array('attendance_company_uid' => $schoolid, 'attendance_employe_id' => $worker, 'attendance_date' => $date))) {

                            return redirect()->back()->with('success', "Sortie du travailleur validée avec succés !");

                        }
                    }
                } else {
                    $attendance_create_data = array(
                        'attendance_token' => $agent_random_pk,
                        'attendance_employe_id' => $worker,
                        'attendance_date' => $date,
                        'attendance_type' => $type,
                        'attendance_in_time' => $in_time,
                        'attendance_out_time' => null,
                        'attendance_status' => $status,
                        'attendance_notes' => $notes,
                        'attendance_company_uid' => $schoolid,
                        'attendance_created_at' => date('Y-m-d H:i:s'),
                    );
                    if ($this->model->insert_data('agents_attendances', $attendance_create_data)) {

                        return redirect()->back()->with('success', "Enregistrement présence effectuée avec succés.");

                    } else {

                        return redirect()->back()->with('failed', "Une erreur s'est produite lors de l'enregistrement de la présence. Veuillez réessayer plus tard.");

                    }
                }

            } else {
                $this->session->setFlashdata('failed', 'Enregistrement présence non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['title'] = ucwords('Worker Attendance'); // Capitalize the first letter
                $data['validation'] = $this->validator;
                $data['_view'] = 'payroll/attendances';
                echo view('layouts/main', $data);
            }
        } else {
            $data['title'] = ucwords('Worker Attendance'); // Capitalize the first letter
            $data['_view'] = 'payroll/attendances';
            echo view('layouts/main', $data);
        }
    }
    private function overtimeHours()
    {
        $data = [];
        $schoolid = (session()->has('schoolid')) ? session()->get('schoolid') : $this->request->getGet('company_uid');
        $data['contracts'] = $this->join->fetch_contracts(array('contract_company_uid' => $schoolid), '*', 'contract_created_at');
        $date_off_day = date('Y-m-d');
        $data['attendances'] = $this->join->fetch_attendances(array('attendance_type' => 'overtime', 'attendance_company_uid' => $schoolid, 'attendance_date' => $date_off_day), '*', 'attendance_created_at');

        if ($this->request->getPost() && (!$this->request->getPost('honeypot'))) {

            $rulers = [
                'worker' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Indiquer le travailleur",
                    ],
                ],
                'date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date obligatoire',
                    ],
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type obligatoire',
                    ],
                ],
                'hours' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nombre heures obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $agent_random_pk = setPrimaryKey();
                $worker = trim($this->request->getPost('worker'));
                $date = trim($this->request->getPost('date'));
                $type = 'overtime';
                $status = trim($this->request->getPost('type'));
                $notes = trim($this->request->getPost('notes'));
                $hours = trim($this->request->getPost('hours'));


                //dd($type);
                if ($this->model->fetch_row_data('agents_attendances', array('attendance_company_uid' => $schoolid, 'attendance_employe_id' => $worker, 'attendance_type' => $type, 'attendance_date' => $date))) {

                    return redirect()->back()->with('failed', "Le pointage des heures supp du travailleur est déjà effectué pour cette date.");

                } else {
                    $attendance_create_data = array(
                        'attendance_token' => $agent_random_pk,
                        'attendance_employe_id' => $worker,
                        'attendance_date' => $date,
                        'attendance_type' => $type,
                        'attendance_hours' => $hours,
                        'attendance_status' => $status,
                        'attendance_notes' => $notes,
                        'attendance_company_uid' => $schoolid,
                        'attendance_created_at' => date('Y-m-d H:i:s'),
                    );
                    if ($this->model->insert_data('agents_attendances', $attendance_create_data)) {

                        return redirect()->back()->with('success', "Enregistrement heures supp effectuée avec succés.");

                    } else {

                        return redirect()->back()->with('failed', "Une erreur s'est produite lors de l'enregistrement de la présence. Veuillez réessayer plus tard.");

                    }
                }

            } else {
                $this->session->setFlashdata('failed', 'Enregistrement heures supp non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['title'] = ucwords('Worker Overtime Hours Attendance'); // Capitalize the first letter
                $data['validation'] = $this->validator;
                $data['_view'] = 'payroll/supphours';
                echo view('layouts/main', $data);
            }
        } else {
            $data['title'] = ucwords('Worker Overtime Hours Attendance'); // Capitalize the first letter
            $data['_view'] = 'payroll/supphours';
            echo view('layouts/main', $data);
        }
    }
}
