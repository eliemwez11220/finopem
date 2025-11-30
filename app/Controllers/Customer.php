<?php

namespace App\Controllers;

class Customer extends BaseController
{
    public function index()
    {
        if (session()->has('isLoggedIn')) {
            return redirect()->to(base_url('profile'));
        } else {
            $data = [];
                //Check if school infosheet exist in the system
                if ($this->model->fetch_row_data('customers', array('customer_status' => 'actif'))) {

                    if (!session()->has('isLoggedIn')) {

                        $data['title'] = "Authentification";
                        $data['_view'] = "customer/login";
                        return view('layouts/main', $data);
                    } else {
                        $this->session->destroy();
                        return redirect()->to(base_url());
                    }
                } else {
                    $data['title'] = "Création compte client";
                    $data['_view'] = "customer/createschool";
                    return view('layouts/main', $data);
                }
        }
    }

    public function dashboard()
    {
        if ((session()->has('isLoggedIn')) && session()->has('isCustomerLoggedIn')) {
            $data = [];
            $customerid = $this->session->get("customerid");
            $data['customer'] = $this->model->fetch_row_data('customers', array('customer_id' => $customerid));

            $customers_schools = $this->model->fetch_all_data('schools', array('school_customer_id' => $customerid), 'school_created_at');
            if ((!empty($customers_schools)) && count($customers_schools) >= 0) {

                $data['schools'] = $customers_schools;
                
                $schoolid = $this->session->get('schoolchoosed');

                if (!empty($schoolid)) {

                    $data['years'] = $this->model->fetch_all_data('years', array('year_school_id' => $schoolid), 'year_created_at');
                    $yearid = $this->session->get('yearchoosed');
                    if (!empty($yearid)) {

                        $ecole = $schoolid;
                        $annee = $yearid;

                        $data['nb_agents'] = $this->model->fetch_count('users', array('user_status' => 'actif', 'user_school_id' => $ecole));
                        $data['nb_classes'] = $this->model->fetch_count('classes', array('classe_status' => 'actif', 'classe_school_id' => $ecole));
                        $data['nb_parents'] = $this->model->fetch_count('students_parents', array('parent_status' => 'actif', 'parent_school_id' => $ecole));

                        $data['filles'] = $this->join->fetch_count_students(
                            array('inscription_year_id' => $annee, 'inscription_school_id' => $ecole, 'student_status' => 'actif', 'student_gender' => 'feminin'));

                        $data['garcons'] = $this->join->fetch_count_students(
                            array('inscription_year_id' => $annee, 'inscription_school_id' => $ecole, 'student_status' => 'actif', 'student_gender' => 'masculin'));

                        $data['nb_eleves'] = $this->join->fetch_count_students(array('inscription_year_id' => $annee, 'inscription_school_id' => $ecole,
                            'student_status' => 'actif'));

                        $year_data = $this->model->fetch_row_data('years', array('year_school_id' => $schoolid, 'year_id' => $annee));

                        $year = (!empty($year_data)) ? $year_data['year_started'] : date('Y');

                        $schoolyear = (!empty($year_data)) ? $year_data['year_started'] . '-' . $year_data['year_ended'] : date('Y');

                        session()->set('schoolyear', $schoolyear);

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
                        $data['year'] = $year;

                        $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $annee));
                        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_name', null, null, 'ASC');
                    }
                }

                $data['title'] = "Tableau de bord administrateur";
                $data['_view'] = "customer/dashboard";
                echo view('layouts/main', $data);
            }else {
                $data['title'] = "Tableau de bord administrateur";
                $data['_view'] = "customer/dashboard";
                echo view('layouts/main', $data);
            }
        } else {
            return redirect()->to(base_url('logout'));
        }
    }

    public function page($namepage = null)
    {
        //session()->remove('schoolchoosed');
        //session()->remove('schooldata');
        if ((session()->has('isLoggedIn')) && session()->has('customerid')) {

            $customerid = $this->session->get("customerid");
            $data['schools'] = $this->model->fetch_all_data('schools', array('school_customer_id' => $customerid), 'school_created_at');

            if ($namepage == 'schools') {

                $data['title'] = "Gestion - " . $namepage;
                $data['_view'] = "customer/" . $namepage;
                return view('layouts/main', $data);

            } elseif ($namepage == 'students') {
                $schoolid = $this->session->get('schoolchoosed');

                if (!empty($schoolid)) {

                    $yearid = $this->session->get('yearchoosed');

                    $data['years'] = $this->model->fetch_all_data('years', array('year_school_id' => $schoolid), 'year_created_at');
                    $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');

                    $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'student_firstname', 'ASC', 'student_id');
                    $data['year'] = $this->model->fetch_row_data('years', array('year_school_id' => $schoolid, 'year_id' => $yearid));

                }
                $data['orientation'] = "landscape";
                $data['title'] = "Gestion - " . $namepage;
                $data['_view'] = "customer/" . $namepage;
                return view('layouts/main', $data);
            } elseif ($namepage == 'statistics') {

                $schoolid = $this->session->get('schoolchoosed');

                if (!empty($schoolid)) {

                    $yearid = $this->session->get('yearchoosed');
                    $data['filles'] = $this->join->fetch_count_students(
                        array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid, 'inscription_status' => 'actif', 'student_gender' => 'feminin'));

                    $data['garcons'] = $this->join->fetch_count_students(
                        array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid, 'inscription_status' => 'actif', 'student_gender' => 'masculin'));

                    $data['nb_eleves'] = $this->join->fetch_count_students(array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid,
                        'inscription_status' => 'actif'));

                    $data['students_inactive'] = $this->join->fetch_count_students(array('inscription_year_id' => $yearid, 'inscription_school_id' => $schoolid,
                        'inscription_status !=' => 'actif'));

                    $data['years'] = $this->model->fetch_all_data('years', array('year_school_id' => $schoolid), 'year_created_at');
                    $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                    $data['year'] = $this->model->fetch_row_data('years', array('year_school_id' => $schoolid, 'year_id' => $yearid));

                    $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid));
                    $data['classessections'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code', 'ASC', false, 'section_name');
                    $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
                }

                // dd($data['classessections']);

                $data['orientation'] = "landscape";
                $data['title'] = "Gestion - " . $namepage;
                $data['_view'] = "customer/" . $namepage;
                return view('layouts/main', $data);
            } else {

                $schoolid = $this->session->get('schoolchoosed');

                if (!empty($schoolid)) {

                    $yearid = $this->request->getGet('year');
                    $date_day = date('Y-m-d');
                    $startdate = $this->request->getGet('startdate');
                    $enddate = $this->request->getGet('enddate');
                    $started = (!empty($startdate)) ? $startdate : $date_day;
                    $closing = (!empty($enddate)) ? $enddate : $date_day;

                    $data['years'] = $this->model->fetch_all_data('years', array('year_school_id' => $schoolid), 'year_created_at');

                    $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                    $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at', 'ASC', false, null, null, 'feedetail_id');
                    $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                    $data['payments'] = $this->join->fetch_paydetails_data(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);

                    $data['start'] = $started;
                    $data['end'] = $closing;
                    $data['year'] = $this->model->fetch_row_data('years', array('year_school_id' => $schoolid, 'year_id' => $yearid));

                }

                $data['title'] = "Gestion - " . $namepage;
                $data['_view'] = "customer/" . $namepage;

                return view('layouts/main', $data);
            }
        } else {
            return redirect()->to(base_url('authOwner'));
        }
    }

    public function detailsSchool($school_token = null)
    {
        if (!session()->has('isLoggedIn')) {

            return redirect()->to(base_url('logout'));

        } else {
            $data = [];

            if (!empty($school_token)) {

                $school_data = $this->model->fetch_row_data('schools', array('school_token' => $school_token));
                
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

                        $this->session->set("admin", true);
                        $this->session->set("all", true);
                        $this->session->set("profile", 'sysadmin');
                        session()->remove('isCustomerLoggedIn');
                        
                        $year = $this->model->fetch_row_data('years', array('year_status' => 'actif', 'year_school_id' => $school_data['school_id']));
                        if ((!empty($year)) && count($year) >= 0) {
                            session()->set('yearid', $year['year_id']);
                            session()->set('yeartoken', $year['year_token']);
                            session()->set('yearstarted', $year['year_started']);
                            session()->set('yearclosing', $year['year_ended']);
                            session()->set('yearstartdate', $year['year_start_date']);
                            session()->set('yearclosingdate', $year['year_close_date']);
                            session()->set('yearstatus', $year['year_status']);
                            session()->set('schoolyear', $year['year_started'] . '-' . $year['year_ended']);
                        }
                        return redirect()->to(base_url('school-infosheet'));

            }
            //dd(session()->get('schoolfname'));
            $data['title'] = "School details";
            $data['_view'] = "customer/school";
            return view('layouts/main', $data);
        }
    }
    public function updateSchool($school_id = null)
    {
        if (!session()->has('isLoggedIn')) {

            return redirect()->to(base_url('logout'));

        } else {
            $data = [];
            $school_data = [];
            if (!empty($school_id)) {

                $school_data = $this->model->fetch_row_data('schools', array('school_id' => $school_id));
                $data['school'] = $school_data;

                if ($this->request->getFile('logo') or $this->request->getFile('picture')) {
                    $fullPathFile = 'public/uploads/images';
                    $logo_random_name = '';
                    $cover_picture_name = '';

                    $update_uplaod_file = false;

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
                                $update_uplaod_file = true;

                                $file_path_logo = $fullPathFile . '/' . $db_school_logo;

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
                                $update_uplaod_file = true;

                                $file_path_cover = $fullPathFile . '/' . $db_school_cover;

                                if (file_exists($file_path_cover)) {

                                    if (chdir($fullPathFile) && (!empty($db_school_cover))) {
                                        //REMOVE EXISTING FILE
                                        unlink($db_school_cover);
                                    }
                                }

                            }
                        }
                    }

                    if ($update_uplaod_file == true) {
                        $db_updated_logo = (!empty($logo_random_name)) ? $logo_random_name : $db_school_logo;
                        $db_updated_cover = (!empty($cover_picture_name)) ? $cover_picture_name : $db_school_cover;
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
                    } else {
                        $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                        $data['validation'] = $this->validator;
                        $data['_view'] = ('customer/school');
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

                        $slogan = trim(htmlspecialchars($this->request->getPost('school_slogan')));
                        $website = trim(htmlspecialchars($this->request->getPost('school_website')));
                        $init_identify = $this->request->getPost('init_identify');
                        $school_id_code = $this->request->getPost('school_code');
                        $school_antenna_code = $this->request->getPost('school_antenna_code');
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
                            'school_init_identify' => $init_identify,
                            'school_antenna_code' => $school_antenna_code,
                            'school_code' => $school_id_code,
                            'school_ministry_decree' => $register_number,
                        ];
                        //update data in table
                        if ($this->model->update_data('schools', $update_school_data, array('school_id' => $school_id))) {
                            return redirect()->back()->with('success', "Modification fiche école effectuée avec succés");
                        }
                    } else {
                        $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                        $data['validation'] = $this->validator;
                        $data['_view'] = ('customer/editschool');
                        echo view('layouts/main', $data);
                    }
                } else {
                    $data['school'] = $school_data;
                    $data['_view'] = ('customer/editschool');
                    echo view('layouts/main', $data);
                }
            } else {
                return redirect()->back()->with('failed', "Fiche introuvable");

            }
        }
    }
    public function passwordManage()
    {
        $customerid = $this->session->get("customerid");

        if (!empty($customerid) && ($this->request->getPost())) {

            $data = [];
            $customer = $this->model->fetch_row_data('customers', array('customer_id' => $customerid));

            $rulers = [
                'oldpass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez indiquer votre ancien mot de passe',
                    ],
                ],
                'pass' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Veuillez créer un nouveau mot de passe',
                        'min_length' => "Le mot de passe doit avoir au moins 1 lettre Majuscule,
                            1 lettre miniscule, 1 caractere special choisi parmi [*|#|@|$|.|?] et 1 chiffre de [0-9] et une longueure d'au moins 8 caracteres.",
                    ],
                ],

                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est différent du mot de passe saisi',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $oldpass = strval($this->request->getPost('oldpass'));
                $newpass = strval(($this->request->getPost('pass')));
                $current_datetime = date('Y-m-d H:i:s');
                $new_password = password_hash($newpass, PASSWORD_DEFAULT);
                //check old password
                if (password_verify($oldpass, $customer['customer_password'])) {
                    //table data
                    $saveUpdateUserData = [
                        'customer_password' => $new_password,
                        'customer_password_expire' => 0,
                    ];

                    if ($this->model->update_data('customers', $saveUpdateUserData, array('customer_id' => $customerid))) {

                        $resetPasswordData = [
                            'password_id' => setPrimaryKey(),
                            'password_status' => 'actif',
                            'password_type' => 'change',
                            'password_code' => setReferenceCode(),
                            'password_token' => setPrimaryKey(),
                            'password_ipaddress' => $this->getClientIpAddress(),
                            'password_device' => $this->getUserAgentDevice(),
                            'password_platform' => $this->getUserAgentPlatform(),
                            'password_created_at' => $current_datetime,
                            'password_customer_id' => $customerid,
                            'password_reseted_at' => $current_datetime,
                            'password_reseted_by' => 'System',
                            'password_notes' => "Successfully password changed",
                        ];
                        $this->model->insert_data('customers_passwords', $resetPasswordData);

                        return redirect()->back()->with('success', "Changement du mot de passe effectué avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Désolé, une erreur système s'est produite. Veuillez réessayer plus tard.");
                    }
                } else {

                    return redirect()->back()->with('failed', "Ancien mot de passe incorrect. Vous devez fournir un mot de passe valide avant de changer le nouveau");

                }
            } else {
                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['customer'] = $customer;
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Customer Password';
                $data['_view'] = ('customer/password');
                echo view('layouts/main', $data);
            }
        } else {

            $data['title'] = 'Change Customer Password';
            $data['_view'] = ('customer/password');
            echo view('layouts/main', $data);
        }
    }

    public function accountManage()
    {
        $customerid = $this->session->get("customerid");

        if (!empty($customerid)) {

            $data = [];
            $customer = $this->model->fetch_row_data('customers', array('customer_id' => $customerid));

            if (($this->request->getPost())) {
                $rulers = [

                    'email' => [
                        'rules' => 'max_length[75]',
                        'errors' => [
                            'min_length' => 'La taille max est de 75 caractères',
                        ],
                    ], 'phone' => [
                        'rules' => 'required|max_length[15]',
                        'errors' => [
                            'required' => 'Veuillez saisir le numéro',
                            'min_length' => 'La taille max est de 15 caractères',
                        ],
                    ],
                    'customername' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Veuillez saisir votre nom',
                        ],
                    ],
                    'gender' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Veuillez saisir votre sexe',
                        ],
                    ],
                ];

                //run the validation rulers
                if ($this->validate($rulers)) {
                    $current_datetime = date('Y-m-d H:i:s');
                    $lastname = (($this->request->getPost('lastname')));
                    $email = (($this->request->getPost('email')));
                    $phone = (($this->request->getPost('phone')));
                    $nom = (($this->request->getPost('name')));
                    $address = (($this->request->getPost('address')));
                    $about = (($this->request->getPost('about')));
                    $gender = (($this->request->getPost('gender')));
                    $customername = (($this->request->getPost('customername')));

                    $updateTypeData = [
                        'customer_firstname' => $nom,
                        'customer_lastname' => $lastname,
                        'customer_name' => $customername,
                        'customer_email' => $email,
                        'customer_phone' => $phone,
                        'customer_notes' => $about,
                        'customer_address' => $address,
                        'customer_gender' => $gender,
                        'customer_updated_at' => $current_datetime,
                        'customer_language' => (($this->request->getPost('language'))),
                    ];
                    //update data in table
                    if ($this->model->update_data('customers', $updateTypeData, array('customer_id' => $customerid))) {
                        return redirect()->back()->with('success', "Modification compte effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Erreur Modification Compte. Veuillez réessayer plus tard !");
                    }

                } else {
                    //$this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                    $data['validation'] = $this->validator;
                    $data['title'] = ucfirst('Mise à jour profile');
                    $data['customer'] = $customer;
                    $data['validation'] = $this->validator;
                    $data['_view'] = ('customer/profile');
                    echo view('layouts/main', $data);
                }
            } else {
                $data['title'] = ucfirst('Mise à jour profile');
                $data['customer'] = $customer;
                $data['validation'] = $this->validator;
                $data['_view'] = ('customer/profile');
                echo view('layouts/main', $data);
            }
        }
    }


    public function addNewSchool()
    {
        if (($this->request->getPost()) && ($this->request->getPost('honeypot') == '')) {
            $data = [];
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
                'school_phone' => [
                    'rules' => 'required|is_unique[schools.school_phone]',
                    'errors' => [
                        'required' => 'Numéro de contact obligatoire',
                        'is_unique' => 'Ce numéro est déjà utilisé par une autre école. Veuillez changer',
                    ],
                ],
                'school_email' => [
                    'rules' => 'permit_empty|valid_email|is_unique[schools.school_email]',
                    'errors' => [
                        'valid_email' => 'Indiquer une adresse mail valide',
                        'is_unique' => 'Cette adresse mail est déjà utilisée par une autre école. Veuillez changer',
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
                $name = trim($this->request->getPost('fullname'));
                $shortname = trim($this->request->getPost('shortname'));
                $school_type = trim($this->request->getPost('school_type'));
                $school_phone = trim($this->request->getPost('school_phone'));
                $school_email = trim($this->request->getPost('school_email'));

                $name_manager = trim($this->request->getPost('school_manager'));
                $school_city = trim($this->request->getPost('school_city'));

                $school_address = trim($this->request->getPost('address'));
                $school_about = trim($this->request->getPost('notes'));
                $school_antenna_code = trim($this->request->getPost('school_antenna_code'));
                $school_id_code = trim($this->request->getPost('school_code'));
                $init_identify = trim($this->request->getPost('init_identify'));
                $current_datetime = date('Y-m-d H:i:s');

                $customer_id = $this->session->get("customerid");

                //Prepare sql insert data request
                $school_token = setPrimaryKey();
                $saveTypeData = [
                    'school_token' => $school_token,
                    'school_fullname' => $name,
                    'school_shortname' => $shortname,
                    'school_phone' => $school_phone,
                    'school_email' => $school_email,
                    'school_type' => $school_type,
                    'school_city' => $school_city,
                    'school_status' => 'actif',
                    'school_manager_name' => $name_manager,
                    'school_created_at' => $current_datetime,
                    'school_address' => $school_address,
                    'school_notes' => $school_about,
                    'school_customer_id' => $customer_id,
                    
                    'school_init_identify' => $init_identify,
                    'school_antenna_code' => $school_antenna_code,
                    'school_code' => $school_id_code,
                ];
                $school_id = $this->model->save_data('schools', $saveTypeData);
                if (!empty($school_id)) {
                    $year_random_token = setPrimaryKey();
                    $save_year_data = [
                        'year_token' => $year_random_token,
                        'year_started' => date('Y'),
                        'year_ended' => date('Y') + 1,
                        'year_start_date' => date('Y-m-d'),
                        'year_close_date' => date('Y-m-d'),
                        'year_notes' => 'Premiere annee scolaire',
                        'year_created_at' => date('Y-m-d H:i:s'),
                        'year_status' => 'actif',
                        'year_school_id' => $school_id,
                    ];
                    if ($this->model->insert_data('years', $save_year_data)) {
                        $year = $this->model->fetch_row_data('years', array('year_token' => $year_random_token, 'year_school_id' => $school_id));
                        if (!empty($year)) {
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

                    //CREATE SCHOOL ADMIN ACCOUNT
                    $this->createSchoolAdminAccount($school_token);

                    $this->session->setFlashdata('success', 'Création fiche effectuée !');
                    return redirect()->to(base_url('admincustomer/dashboard'));
                } else {

                    return redirect()->with('failed', 'Création non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');

                }
            } else {
                $this->session->setFlashdata('failed', 'Création non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Ajouter une école";
                $data['_view'] = ('customer/createschool');
                return view('layouts/main', $data);
            }
        } else {
            $data['title'] = "Ajouter une école";
            $data['_view'] = ('customer/createschool');
            return view('layouts/main', $data);
        }
    }
    public function createSchoolAdminAccount($school_token = null)
    {

        $school_info = $this->model->fetch_row_data('schools', ['school_token' => $school_token]);
        //Config also Admin Account
        if (!empty($school_info)) {

            $school_id = $school_info['school_id']; // get school id
            $current_datetime = date('Y-m-d H:i:s');
            $role_token = setPrimaryKey(); // set role token key
            $role_insert_data = [
                'role_token' => $role_token,
                'role_code' => setReferenceCode(),
                'role_name' => 'Administrator',
                'role_type' => 'system',
                'role_status' => 'actif',
                'role_school_id' => $school_id,
                'role_created_at' => $current_datetime,
            ];
            if ($this->model->insert_data('users_roles', $role_insert_data)) {
                $role_info = $this->model->fetch_row_data('users_roles', ['role_token' => $role_token]);
                if (!empty($role_info)) {
                    $role_id = $role_info['role_id'];
                    $user_name = 's' . $school_info['school_code'] . 's';
                    $user_password = $school_info['school_phone'];

                    $user_insert_data = [
                        'user_token' => setPrimaryKey(),
                        'user_code' => setReferenceCode(),
                        'user_firstname' => $school_info['school_fullname'],
                        'user_lastname' => $school_info['school_manager_name'],
                        'user_name' => $user_name,
                        'user_password' => password_hash($user_password, PASSWORD_DEFAULT),
                        'user_phone' => $school_info['school_phone'],
                        'user_email' => $school_info['school_email'],
                        'user_type' => 'root',
                        'user_status' => 'actif',
                        'user_session_status' => 'offline',
                        'user_gender' => 'woman',
                        'user_language' => 'fr',
                        'user_double_auth' => 'false',
                        'user_trying_login' => 5,
                        'user_oauth_login' => setInvoiceNumber(),
                        'user_oauth_provider' => 'magschool',
                        'user_role_id' => $role_id,
                        'user_school_id' => $school_id,
                        'user_created_at' => $current_datetime,
                        'user_address' => $school_info['school_address'],
                        'user_notes' => $school_info['school_notes'],
                    ];
                    if ($this->model->insert_data('users', $user_insert_data)) {

                        session()->set('schooluser', $user_name);

                        //SEND EMAIL TO ACCOUNT
                        $school_name = $school_info['school_fullname'];
                        $school_manager = $school_info['school_manager_name'];
                        $school_email = $school_info['school_email'];
                        if (!empty($school_email)) {

                            $body_mail = "Cher Responsable $school_manager de l'établissement $school_name, merci d'avoir configurer la fiche de votre présentation dans le système
                            <b>Ditotase Magstore </b>. Votre nom d'utilisateur est <b>$user_name</b>,
                            l'email de connexion est <b>$school_email</b>, votre mot de passe est $user_password";

                            $this->sendEmail($school_email, 'Magschool Credentials', $body_mail);
                        }
                    }
                }
            }
        }
    }
}
