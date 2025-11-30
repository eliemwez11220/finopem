<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->has('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        } else {

            if ($this->checkDatabase() == TRUE) {

                //Check if school infosheet exist in the system
                if ($this->model->fetch_row_data('schools', array('school_status' => 'actif'))) {
                    $school_data = $this->model->fetch_row_data('schools', array('school_status' => 'actif'));
                    //if trim(!empty($school_data)) && count($school_data) >= 0) {
                    session()->set('schooldata', $school_data);
                    if (!session()->has('isLoggedIn')) {
                        $data['school'] = $school_data;
                        $data['title'] = "Authentification";
                        $data['_view'] = "auth/login";
                        return view('layouts/auth', $data);
                    } else {
                        $this->session->destroy();
                        return redirect()->to(base_url());
                    }
                } else {
                    $data['title'] = "Configuration fiche école";
                    $data['_view'] = "main/school/register";
                    return view('layouts/main', $data);
                }
                //}
            } else {
                $data['title'] = "Database Migration";
                $data['_view'] = "database/dbmigration";
                return view('layouts/auth', $data);
            }
        }
    }
    public function schoolWelcome()
    {
        $schooluser = session()->schooluser;
        if ($this->checkUserActivated($schooluser)) {
            session()->setFlashdata('success', "Création fiche école effectuée avec succés!");
            $school_info = $this->model->fetch_row_data('schools', ['school_token' => session()->schooltoken]);
            //Config also Admin Account
            if (!empty($school_info)) {

                $school_id = $school_info['school_id']; // get school id

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
                        session()->set('schoolyear', $year['year_started'] . '-' . $year['year_ended']);
                    }
                    return redirect()->to(base_url('dashboard'));
                } else {
                    return redirect()->to(base_url('config/years'));
                }
            }
        } else {
            return redirect()->to(base_url());
        }
    }
    public function login()
    {
        $data = [];
        if ($this->request->getPost() && ($this->request->getPost('honeypot') == "")) {

            $rulers = [
                'username' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Veuillez saisir votre Identifiant"
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir votre Mot de passe'
                    ]
                ]
            ];
            if ($this->validate($rulers)) {
                $username = trim($this->request->getPost('username'));
                $password = trim($this->request->getPost('password'));

                if ($this->checkCustomerPassword($username, $password)) {
                    //check Account status
                    if ($this->checkCustomerActivated($username)) {
                        //check if is login with default password
                        if ($this->session->defaultpass == 'sessionexpire') {
                            $this->session->setFlashdata('info', "Veuillez changer votre mot de passe actuel.");
                            return redirect()->to(base_url('changePassword'));
                        } else {

                            $fullname_customer_connected = $this->session->customername;
                            $this->session->setFlashdata('success', "Cher client $fullname_customer_connected, Welcome !");

                            //redirect customer to dashboard after login
                            return redirect()->to(base_url('admincustomer/dashboard'));
                        }

                        //end else //check default password
                    } else {
                        //return to login auth with errors messages and keep old values
                        return redirect()->back()->with('failed', 'Votre compte est bloqué. Veuillez contacter votre administrateur pour régler le problème.');
                    }
                    //end check account status
                } elseif ($this->checkUserPassword($username, $password)) {

                    //check Account status
                    if ($this->checkUserActivated($username)) {
                        //check if is login with default password
                        if ($this->session->get('defaultpass') == 'sessionexpire') {
                            $this->session->setFlashdata('info', "Veuillez changer votre mot de passe actuel.");
                            return redirect()->to(base_url('changeDefaultPassword'));
                        } else {

                            $fullname_user_connected = $this->session->firstname;
                            $this->session->setFlashdata('success', "Cher utilisateur $fullname_user_connected, Welcome !");
                            //redirect user to dashboard after login
                            return redirect()->to(base_url('dashboard'));
                        }

                        //end else //check default password
                    } else {
                        //return to login auth with errors messages and keep old values
                        return redirect()->back()->with('failed', 'Votre compte est bloqué. Veuillez contacter votre administrateur pour régler le problème.');
                    }
                    //end check account status
                } else {
                    if ($this->auth->login_user_data($username)) {
                        $user_trying_login = $this->checkAttempTryLogin($username);
                        //$attempts_login = $user_trying_login;
                        if ($user_trying_login != 0) {
                            $msg_notifie = ($user_trying_login <= 2) ? "Attention ! Il ne vous reste plus qu'un essai pour bloquer votre compte. Introduisez un bon mot de passe" : "Identifiant ou Mot de passe incorrect";
                            //return to login auth with errors messages and keep old values
                            return redirect()->back()->with('failed', $msg_notifie);
                        } else {
                            //redirect to account blocked auth
                            return redirect()->to(base_url('lockAccount'));
                        }
                    } elseif ($this->auth->login_customer_data($username)) {
                        $customer_trying_login = $this->checkAttempTryLoginCustomer($username);
                        //$attempts_login = $user_trying_login;
                        if ($customer_trying_login != 0) {
                            $msg_notifie = ($customer_trying_login <= 2) ? "Attention ! Il ne vous reste plus qu'un essai pour bloquer votre compte. Introduisez un bon mot de passe" : "Identifiant ou Mot de passe incorrect";
                            //return to login auth with errors messages and keep old values
                            return redirect()->back()->with('failed', $msg_notifie);
                        } else {
                            //redirect to account blocked auth
                            return redirect()->to(base_url('lockAccount'));
                        }
                    } else {
                        return redirect()->back()->with('failed', 'Utilisateur ou Mot de passe incorrect !');
                    }
                }
            } else {
                $data['failed'] = "Vos identifiants de connexion sont incorrects !";
                $data['validation'] = $this->validator;
                $data['_view'] = 'auth/login';
                echo view('layouts/auth', $data);
            }
        } else {
            $data['title'] = "Vos identifiants de connexion sont incorrects !";
            $data['page'] = 'auth';
            $data['_view'] = 'auth/login';
            echo view('layouts/auth', $data);
        }
    }
    public function checkAttempTryLogin($username)
    {
        $infosCompte = $this->auth->login_user_data($username);
        if ((!empty($infosCompte))) {
            $user_trying_login = $infosCompte['user_trying_login'];
            $attempts_login = $user_trying_login;
            if ($attempts_login != 0) {
                return $attempts_login;
            } else {
                $userAgentData = $this->getUserAgentDevice();
                $ip = $this->getClientIpAddress();
                $user_name = $infosCompte['user_firstname'];
                $usermail = $infosCompte['user_email'];
                $content = "Cher utilisateur [$user_name], nous avons detectées 
                plusieurs tentatives d'accès au compte de votre espace scolaire Magschool avec cette adresse mail [$usermail] via 
                [$userAgentData] dont l'adresse IP utilisée est [$ip].
                Votre compte a été bloqué par sécurité. Si vous êtes propriétaire du compte, 
                veuillez contacter votre administrateur système ou directement le fournisseur du logiciel.
                ";
                if (!empty($usermail)) {
                    //&& ($infosCompte['user_status'] == 'actif')
                    //send email to register user email
                    $this->sendEmail($usermail, "Compte vérouillé - Ouverture session", $content);
                }
                return false;
            }
        } else {
            return false;
        }
    }
    public function checkUserPassword($username, $password)
    {
        $infosCompte = $this->auth->login_user_data($username);
        //check password password_verify
        if (!empty($infosCompte)) {
            if (password_verify($password, $infosCompte['user_password'])) {
                return true;
            } else {
                $attempts_login = $infosCompte['user_trying_login'];
                //$attempts_login = $user_trying_login;
                if ($attempts_login > 0) {
                    $user_trying_login = $attempts_login - 1;
                    $user_status = ($user_trying_login == 0) ? 'blocked' : 'actif';
                    $data_login_failled = compact('user_trying_login', 'user_status');
                    $this->model->update_data('users', $data_login_failled, array('user_id' => $infosCompte['user_id']));
                }
                return false;
            }
        }
    }
    public function checkUserActivated($username)
    {

        $infosCompte = $this->auth->login_user_data($username);
        if ((!empty($infosCompte))) {
            $infosRole = $this->model->fetch_row_data('users_roles', array('role_id' => $infosCompte['user_role_id']));

            if ($infosCompte['user_status'] == 'actif') {
                if ($infosCompte['user_password_expire'] == 1) {
                    //set user uid in session
                    $this->session->set('tokenuser', $infosCompte['user_id']);
                    $this->session->set('avataruser', $infosCompte['user_avatar']);
                    $this->session->set('nameuser', $infosCompte['user_firstname']);
                    $this->session->set('defaultpass', 'sessionexpire');
                } else {
                    //$lieu = $this->getClientLocation();
                    //$address = (!empty($lieu)) ? $lieu['city'] . $lieu['region'] . $lieu['country'] : "";
                    $newSessionData = [
                        'schoolid' => (!empty($infosCompte) ? $infosCompte['user_school_id'] : ''),
                        'userid' => (!empty($infosCompte) ? $infosCompte['user_id'] : ''),
                        'usertoken' => (!empty($infosCompte) ? $infosCompte['user_token'] : ''),
                        'usercode' => (!empty($infosCompte) ? $infosCompte['user_code'] : ''),
                        'username' => (!empty($infosCompte) ? $infosCompte['user_name'] : ''),
                        'name' => (!empty($infosCompte) ? $infosCompte['user_firstname'] : ''),
                        'lastname' => (!empty($infosCompte) ? $infosCompte['user_lastname'] : ''),
                        'email' => (!empty($infosCompte) ? $infosCompte['user_email'] : ''),
                        'avatar' => (!empty($infosCompte) ? $infosCompte['user_avatar'] : ''),
                        'picture' => (!empty($infosCompte) ? $infosCompte['user_picture'] : ''),
                        'profile' => (!empty($infosCompte) ? $infosCompte['user_type'] : ''),
                        'type' => (!empty($infosCompte) ? $infosCompte['user_type'] : ''),
                        'phone' => (!empty($infosCompte) ? $infosCompte['user_phone'] : ''),
                        'about' => (!empty($infosCompte) ? $infosCompte['user_notes'] : ''),
                        'address' => (!empty($infosCompte) ? $infosCompte['user_address'] : ''),
                        'isLoggedIn' => true,
                    ];
                    $this->session->set($newSessionData); //Set Session Data

                    $users_sections = $this->join->fetch_users_sections(array('branch_status' => 'actif', 'branch_user_id' => $infosCompte['user_id'], 'branch_school_id' => $infosCompte['user_school_id']), '*');
                    if ((!empty($users_sections)) && count($users_sections) >= 0) {

                        session()->set('usersbranchs', $users_sections);
                    }
                    //Check if school infosheet exist in the system
                    $school_data = $this->model->fetch_row_data('schools', array('school_id' => $infosCompte['user_school_id']));
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
                    }
                    if (!empty($infosRole['role_id'])) {
                        //get all privileges profile
                        $infosAccessObjects = $this->join->fetch_join_data(
                            'users_access',
                            'users_roles',
                            'role_id = access_role_id',
                            array('access_role_id' => $infosRole['role_id'], 'access_school_id' => $infosRole['role_school_id'], 'access_status' => 'actif'),
                            'access_status',
                            'DESC'
                        );
                        //SET ROLE DATA
                        $this->session->set('roletoken', $infosRole['role_id']);
                        $this->session->set('role', $infosRole['role_name']);
                        if ($this->session->profile == "sysadmin" or $this->session->type == "admin" or $this->session->type == "root") {
                            $this->session->set("admin", true);
                            $this->session->set("all", true);
                        } else {
                            if (!empty($infosAccessObjects)) {
                                foreach ($infosAccessObjects as $access) {

                                    $module = $access['access_name'];
                                    $access_type = $access['access_type'];

                                    if ($module != 'all' && $access_type != 'all') {
                                        $this->session->set($module, true);
                                        $this->session->set($access_type, true);
                                        $this->session->set($module . '_reading', $access['access_reading']);
                                        $this->session->set($module . '_updated', $access['access_updated']);
                                        $this->session->set($module . '_created', $access['access_created']);
                                        $this->session->set($module . '_deleted', $access['access_deleted']);
                                    }
                                }
                            } else {
                                if ($this->session->profile == "admin" or $this->session->type == "admin") {

                                    $this->session->set("overview", true);
                                    $this->session->set("dashboard", true);
                                    $this->session->set("infosheet", true);
                                    $this->session->set("tools", true);
                                    $this->session->set("expstudents", true);
                                    $this->session->set("expparents", true);
                                    $this->session->set("repfees", true);
                                    $this->session->set("repyearly", true);
                                    $this->session->set("repannuary", true);
                                    $this->session->set("reporting", true);
                                    $this->session->set("replisting", true);
                                    $this->session->set("repstudents", true);
                                    $this->session->set("repcashbox", true);
                                    $this->session->set("reppayments", true);
                                    $this->session->set("reprecovery", true);
                                    $this->session->set("repbanking", true);
                                }
                            }
                        }
                    } else {
                        $this->session->set("all", false);
                    }
                    //============= update account session infos =====================
                    $chechExistsSession = $this->model->fetch_field_value('users', array('user_id' => $infosCompte['user_id'], 'user_session_status' => 'online'));
                    $arrayDataSessionUpdated = [
                        'user_trying_login' => 5,
                        'user_session_status' => 'online',
                        'user_session_count' => (!empty($chechExistsSession->user_session_nbr)) ? $chechExistsSession->user_session_nbr + 1 : 1,
                    ];
                    $this->model->update_data('users', $arrayDataSessionUpdated, array('user_id' => $infosCompte['user_id']));
                    //keep session data
                    $this->session->set($arrayDataSessionUpdated);

                    /*============= CREATE USER LOGS ACTIVITY ==============*/
                    $this->createUserLog('auth');
                    $this->createUserActivity('login');
                    /*============= END CREATE USER LOGS ACTIVITY ==============*/

                    if (session()->admin == TRUE or session()->all == TRUE) {
                        $all_sections = $this->model->fetch_all_data('sections', array('section_status' => 'actif', 'section_school_id' => $infosCompte['user_school_id']), 'section_created_at');
                        if ((!empty($all_sections)) && count($all_sections) >= 0) {

                            session()->set('usersbranchs', $all_sections);
                        }
                    }
                }
                return true;
            } else {
                return false;
            }
        }
    }
    public function lockAccount()
    {
        $this->session->destroy();
        $data['title'] = "Compte bloqué";
        $data['failed'] = "Votre compte est bloqué. Vous avez essayer plusieurs fois sans succès.
         Veuillez contacter votre administrateur pour le débloquer.";
        $data['_view'] = "auth/lockaccount";
        echo view('layouts/auth', $data);
    }
    public function logout()
    {
        $uid_sess = $this->session->usertoken;
        if (session()->has('isCustomerLoggedIn')) {
            $arrayDataSessionUpdated = [
                'customer_session_status' => ($this->session->customer_session_nbr > 1) ? 'offline' : 'online',
                'customer_session_count' => 0,
            ];
            if ($this->model->update_data('customers', $arrayDataSessionUpdated, array('customer_token' => $uid_sess))) {
                $this->session->destroy();
                return redirect()->to(base_url());
            }
        } else {
            $arrayDataSessionUpdated = [
                'user_session_status' => ($this->session->user_session_nbr > 1) ? 'offline' : 'online',
                'user_session_count' => 0,
            ];
            if ($this->model->update_data('users', $arrayDataSessionUpdated, array('user_token' => $uid_sess))) {
                /*============= CREATE USER LOGS ACTIVITY ==============*/
                $this->createUserLog('auth');
                $this->createUserActivity('logout');
                /*============= END CREATE USER LOGS ACTIVITY ==============*/
                $this->session->destroy();
                return redirect()->to(base_url());
            }
        }
    }
    public function password($auth = null)
    {

        if (!empty($auth)) {
            $data['title'] = "Gestion du mot de passe";
            $data['_view'] = "auth/" . $auth . "-password";
            echo view('layouts/auth', $data);
        }
    }
    public function resetPassword()
    {
        if (($this->request->getPost()) && ($this->request->getPost('honeypot') == '')) {
            $data = [];
            $rulers = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Saisissez votre E-mail',
                        'valid_email' => 'Indiquer une adresse mail valide',
                    ],
                ],
            ];
            if ($this->validate($rulers)) {

                $email_user = $this->request->getPost('email');

                if ($this->model->fetch_row_data('customers', array('customer_email' => $email_user))) {
                    $customerAccount = $this->model->fetch_row_data('customers', array('customer_email' => $email_user));
                    if ($customerAccount['customer_status'] == 'active' or $customerAccount['customer_status'] == 'actif') {
                        $aleatoire = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
                        $tokenPassword = substr(str_shuffle(str_repeat($aleatoire, mt_rand(250, 255))), 0, 250);
                        $emailResetLink = base_url('verifyResetTokenLink/' . $tokenPassword);
                        $codeReset = substr(str_shuffle(str_repeat("0123456789", mt_rand(5, 10))), 0, 5);
                        $resetPasswordData = [
                            'password_customer_id' => $customerAccount['customer_id'],
                            'password_status' => 'actif',
                            'password_type' => 'reset',
                            'password_code' => $codeReset,
                            'password_token' => $tokenPassword,
                            'password_ipaddress' => $this->getClientIpAddress(),
                            'password_device' => $this->getUserAgentDevice(),
                            'password_platform' => $this->getUserAgentPlatform(),
                            'password_created_at' => date('Y-m-d H:i:s'),
                        ];
                        if ($this->model->insert_data('customers_passwords', $resetPasswordData)) {

                            $body = "<h5>Bonjour cher $email_user suite à votre demande de réinitialisation
                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> $codeReset </h3>
                            Vous pouvez également cliquer sur le lien ci-dessous pour confirmer la réinitialisation.
                            ";
                            //send email link to reset password
                            if ($this->sendEmail($email_user, "$codeReset - Votre code de réinitialisation du mot de passe oublié", $body, $emailResetLink, "Réinitialiser")) {
                                return redirect()->to(base_url('confirmResetRequest'));
                            } else {
                                return redirect()->back()->with('failed', "Réinitialisation non effectuée, problème de connexion. Réessayer plus tard !");
                            }
                        }
                    } else {
                        return redirect()->back()->with('failed', "Votre compte est vérouillé, vous ne pouvez pas réinitialiser le mot de passe !");
                    }
                } else {
                    $userAccount = $this->model->fetch_row_data('users', array('user_email' => $email_user));
                    if (!empty($userAccount)) {
                        if ($userAccount['user_status'] == 'active' or $userAccount['user_status'] == 'actif') {
                            $aleatoire = "0123456789ABCDEFGHIJKLMNOPQRSTUVWYZabcdefghijklmnopqrstuvwyz";
                            $tokenPassword = substr(str_shuffle(str_repeat($aleatoire, mt_rand(250, 255))), 0, 250);
                            $emailResetLink = base_url('verifyResetTokenLink/' . $tokenPassword);
                            $codeReset = substr(str_shuffle(str_repeat("0123456789", mt_rand(5, 10))), 0, 5);
                            $resetPasswordData = [
                                'password_user_id' => $userAccount['user_id'],
                                'password_school_id' => $userAccount['user_school_id'],
                                'password_status' => 'actif',
                                'password_type' => 'reset',
                                'password_code' => $codeReset,
                                'password_token' => $tokenPassword,
                                'password_ipaddress' => $this->getClientIpAddress(),
                                'password_device' => $this->getUserAgentDevice(),
                                'password_platform' => $this->getUserAgentPlatform(),
                                'password_created_at' => date('Y-m-d H:i:s'),
                            ];
                            if ($this->model->insert_data('users_passwords', $resetPasswordData)) {

                                $body = "<h5>Bonjour cher $email_user suite à votre demande de réinitialisation
                            du mot de passe,  voici le code pour confirmer votre demande:</h5> <h3> $codeReset </h3>
                            Vous pouvez également cliquer sur le lien ci-dessous pour confirmer la réinitialisation.
                            ";
                                //send email link to reset password
                                if ($this->sendEmail($email_user, "$codeReset - Votre code de réinitialisation du mot de passe oublié", $body, $emailResetLink, "Réinitialiser")) {
                                    return redirect()->to(base_url('confirmResetRequest'));
                                } else {
                                    return redirect()->back()->with('failed', "Réinitialisation non effectuée, problème de connexion. Réessayer plus tard !");
                                }
                            }
                        } else {
                            return redirect()->back()->with('failed', "Votre compte est vérouillé, vous ne pouvez pas réinitialiser le mot de passe !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Adresse Mail Introuvable. Veuillez réessayer avec une autre !");
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                $data['title'] = "Réinitialisation du mot de passe oublié";
                $data['_view'] = "auth/forget-password";
                echo view('layouts/auth', $data);
            }
        }
        return redirect()->back()->withInput();
    }
    public function confirmResetRequest($token_link = null)
    {
        $token_code = $this->request->getPost('token');
        $token = (!empty($token_code)) ? $token_code : $token_link;
        //check if empty token
        if (!empty($token)) {
            if ($this->model->fetch_orWhere_data('customers_passwords', array('password_token' => $token), array('password_code' => $token))) {
                //get all from password table by token or pin
                $infosPassword = $this->model->fetch_orWhere_data('customers_passwords', array('password_token' => $token), array('password_code' => $token));
                if ((!empty($infosPassword)) && (!empty($infosPassword['password_customer_id']))) {
                    //get customer account data
                    $infosCompte = $this->model->fetch_row_data('customers', array('customer_id' => $infosPassword['password_customer_id']));
                    //check time require before process to reset password
                    if (($infosPassword['password_status'] = 'actif') && checkExpiryTime($infosPassword['password_created_at']) <= 60) {
                        if (!empty($infosCompte)) {
                            //Update Account Reset password info
                            $resetAccountData = ['customer_old_password' => $infosCompte['customer_password']];
                            //update account data
                            $this->model->update_data('customers', $resetAccountData, array('customer_id' => $infosCompte['customer_id']));
                            //update password status verify
                            $resetPasswordData = [
                                'password_status' => 'inactif',
                                'password_reseted_at' => date('Y-m-d H:i:s'),
                                'password_reseted_by' => $infosCompte['customer_firstname'],
                                'password_notes' => "Successfully reseted",
                            ];
                            $this->model->update_data('customers_passwords', $resetPasswordData, array('password_id' => $infosPassword['password_id']));
                            //set customer uid in session for allow to change the new pass
                            $this->session->set('tokenuser', $infosCompte['customer_id']);
                            $this->session->set('avataruser', $infosCompte['customer_avatar']);
                            $this->session->set('nameuser', $infosCompte['customer_firstname']);
                            return redirect()->to(base_url('changeDefaultPassword'));
                        } else {
                            return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien de réinitialisation");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Le lien que vous avez cliqué est déja expiré.
                        Réessayer en saisissant votre email.");
                    }
                } else {
                    return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien de reinitialisation");
                }
            } else {
                //get all from password table by token or pin
                $infosPassword = $this->model->fetch_orWhere_data('users_passwords', array('password_token' => $token), array('password_code' => $token));
                if ((!empty($infosPassword)) && (!empty($infosPassword['password_user_id']))) {
                    //get user account data
                    $infosCompte = $this->model->fetch_row_data('users', array('user_id' => $infosPassword['password_user_id']));
                    //check time require before process to reset password
                    if (checkExpiryTime($infosPassword['password_created_at']) <= 60) {
                        if (!empty($infosCompte)) {
                            //Update Account Reset password info
                            $resetAccountData = ['user_old_password' => $infosCompte['user_password']];
                            //update account data
                            $this->model->update_data('users', $resetAccountData, array('user_id' => $infosCompte['user_id']));
                            //update password status verify
                            $resetPasswordData = [
                                'password_status' => 'inactif',
                                'password_reseted_at' => date('Y-m-d H:i:s'),
                                'password_reseted_by' => $infosCompte['user_firstname'],
                                'password_notes' => "Successfully reseted",
                            ];
                            $this->model->update_data('users_passwords', $resetPasswordData, array('password_id' => $infosPassword['password_id']));
                            //set user uid in session for allow to change the new pass
                            $this->session->set('tokenuser', $infosCompte['user_id']);
                            $this->session->set('avataruser', $infosCompte['user_avatar']);
                            $this->session->set('nameuser', $infosCompte['user_firstname']);
                            return redirect()->to(base_url('changeDefaultPassword'));
                        } else {
                            return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien de réinitialisation");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Le lien que vous avez cliqué est déja expiré.
                    Réessayer en saisissant votre email.");
                    }
                } else {
                    return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien de reinitialisation");
                }
            }
        } else {
            $data['title'] = "Confirmation Réinitialisation Mot de passe";
            $data['_view'] = "auth/token-password";
            echo view('layouts/auth', $data);
        }
    }
    public function verifyResetTokenLink($token)
    {
        //check if empty token
        if (!empty($token)) {
            $this->confirmResetRequest($token);
        } else {
            $data['title'] = "Lien de Réinitialisation du Mot de passe expiré";
            $data['_view'] = "auth/token-password";
            echo view('layouts/auth', $data);
        }
    }
    public function changeDefaultPassword()
    {
        if (($this->request->getPost()) && ($this->request->getPost('honeypot') == '')) {
            $data = [];
            $rulers = ['pass' => ['rules' => 'required', 'errors' => ['required' => 'Mot de passe obligatoire']], 'cpass' => ['rules' => 'matches[pass]', 'errors' => ['matches' => 'Le mot de passe de confirmation est différente du mot de passe saisi']]];
            if ($this->validate($rulers)) {
                $password = strval($this->request->getPost('pass'));
                $current_datetime = date('Y-m-d H:i:s');
                $new_password = password_hash($password, PASSWORD_DEFAULT);
                //if ($stringPasswordAdminChecked >= 10) {
                $useruidSession = $this->session->get('tokenuser');
                if ($this->model->fetch_row_data('customers', array('customer_id' => $useruidSession))) {

                    //verifier existance du compte
                    $customer_data = $this->model->fetch_row_data('customers', array('customer_id' => $useruidSession));
                    if ($new_password == $customer_data['customer_old_password']) {
                        return redirect()->back()->with('failed', "Il semble que le nouveau mot de passe correspond à votre ancien mot de passe, veuillez créer un mot de passe que vous n'ayez jamais utiliser sur cette application");
                    }
                    //table data
                    $savecustomerAccountData = [
                        'customer_password' => $new_password,
                        'customer_old_password' => $customer_data['customer_password'],
                        'customer_password_expire' => 0,
                    ];
                    if ($this->model->update_data('customers', $savecustomerAccountData, array('customer_id' => $customer_data['customer_id']))) {

                        $resetPasswordData = [
                            'password_status' => 'actif',
                            'password_type' => 'change',
                            'password_code' => setReferenceCode(),
                            'password_token' => setPrimaryKey(),
                            'password_ipaddress' => $this->getClientIpAddress(),
                            'password_device' => $this->getUserAgentDevice(),
                            'password_platform' => $this->getUserAgentPlatform(),
                            'password_created_at' => $current_datetime,
                            'password_reseted_at' => $current_datetime,
                            'password_customer_id' => $customer_data['customer_id'],
                            'password_reseted_by' => $customer_data['customer_firstname'],
                            'password_notes' => "Successfully password changed",
                        ];
                        $this->model->insert_data('customers_passwords', $resetPasswordData);

                        if ($this->checkcustomerActivated($customer_data['customer_email'])) {
                            $email_customer = $customer_data['customer_email'];
                            $body = "Changement du mot de passe effectué avec succès. Heureux de vous revoir cher utilisateur!";
                            session()->setFlashdata('success', $body);
                            //Notification to customer
                            $this->sendEmail($email_customer, "Notification de changement du mot de passe appliqué", $body);

                            //redirect to dashboard
                            return redirect()->to(base_url('admincustomer/dashboard'));
                        } else {
                            return redirect()->back()->with('failed', "Désolé, une erreur système s'est produite. Veuillez réessayer plus tard.");
                        }
                    } else {
                        return redirect()->back()->with('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                    }
                } else {
                    //verifier existance du compte
                    $infosCompte = $this->model->fetch_row_data('users', array('user_id' => $useruidSession));
                    if ($new_password == $infosCompte['user_old_password']) {
                        return redirect()->back()->with('failed', "Il semble que le nouveau mot de passe correspond à votre ancien mot de passe, veuillez créer un mot de passe que vous n'ayez jamais utiliser sur cette application");
                    }
                    //table data
                    $saveUserAccountData = [
                        'user_password' => $new_password,
                        'user_old_password' => $infosCompte['user_password'],
                        'user_password_expire' => 0,
                    ];
                    if ($this->model->update_data('users', $saveUserAccountData, array('user_id' => $infosCompte['user_id']))) {

                        $resetPasswordData = [
                            'password_status' => 'actif',
                            'password_type' => 'change',
                            'password_code' => setReferenceCode(),
                            'password_token' => setPrimaryKey(),
                            'password_ipaddress' => $this->getClientIpAddress(),
                            'password_device' => $this->getUserAgentDevice(),
                            'password_platform' => $this->getUserAgentPlatform(),
                            'password_created_at' => $current_datetime,
                            'password_user_id' => $infosCompte['user_id'],
                            'password_school_id' => $infosCompte['user_school_id'],
                            'password_reseted_at' => $current_datetime,
                            'password_reseted_by' => $infosCompte['user_firstname'],
                            'password_notes' => "Successfully password changed",
                        ];
                        $this->model->insert_data('users_passwords', $resetPasswordData);
                        if ($this->checkUserActivated($infosCompte['user_phone'])) {
                            $email_user = $infosCompte['user_email'];
                            $body = "Changement du mot de passe effectué avec succès. Heureux de vous revoir cher utilisateur!";
                            session()->setFlashdata('success', $body);
                            //Notification to user
                            if (!empty($email_user)) {

                                $this->sendEmail($email_user, "Notification de changement du mot de passe appliqué", $body);
                            }
                            /*============= CREATE USER LOGS ACTIVITY ==============*/
                            $this->createUserLog('password');
                            $this->createUserActivity('reset');
                            /*============= END CREATE USER LOGS ACTIVITY ==============*/
                            //redirect to dashboard
                            return redirect()->to(base_url('dashboard'));
                        } else {
                            return redirect()->back()->with('failed', "Désolé, une erreur système s'est produite. Veuillez réessayer plus tard.");
                        }
                    } else {
                        return redirect()->back()->with('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Default - Password';
                $data['_view'] = ('auth/change-password');
                echo view('layouts/auth', $data);
            }
        } else {
            $data['title'] = 'Change Default - Password';
            $data['_view'] = ('auth/change-password');
            echo view('layouts/auth', $data);
        }
    }
    public function activeAccount($token = null)
    {
        if (!empty($token)) {
            if ($this->model->fetch_row_data('customers', array('customer_id' => $token))) {

                $customerdata = $this->model->fetch_row_data('customers', array('customer_id' => $token));

                $timevalide = checkExpiryTime($customerdata['customer_created_at']);
                if ($timevalide <= 60) {
                    //Update Account Reset password info
                    $resetAccountData = [
                        'customer_status' => 'actif',
                        'customer_activated_at' => date('Y-m-d H:i:s'),
                    ];
                    $matricule = $customerdata['customer_matricule'];
                    $identifiant = $customerdata['customer_name'];
                    $link_login = base_url('login');

                    if ($this->model->update_data('customers', $resetAccountData, array('customer_id' => $token))) {
                        //send email thanks for compte activated
                        $content = "Féliciatations, vous êtes à présent abonné de la société.
                        Votre identifiant de connexion comme alternative de l'email est: $identifiant et votre matricule est: $matricule";
                        $this->sendEmail($customerdata['customer_email'], 'Compte Activé avec succès', $content, $link_login, "Se connecter");
                        //redirect to profile getstarted
                        return redirect()->to(base_url('profile'));
                    } else {
                        return redirect()->back()->with('failed', "Aucune correspondance de compte");
                    }
                } else {
                    return redirect()->back()->with('failed', "Le lien que vous avez cliqué est déja expiré. Réessayer de créer un autre compte.");
                }
            } else {

                $userdata = $this->model->fetch_row_data('users', array('user_id' => $token));
                if (!empty($userdata)) {
                    $timevalide = checkExpiryTime($userdata['user_created_at']);
                    if ($timevalide <= 60) {
                        //Update Account Reset password info
                        $resetAccountData = [
                            'user_status' => 'actif',
                            'user_activated_at' => date('Y-m-d H:i:s'),
                        ];
                        $matricule = $userdata['user_matricule'];
                        $identifiant = $userdata['user_name'];
                        $link_login = base_url('secure/login');

                        if ($this->model->update_data('users', $resetAccountData, array('user_id' => $token))) {
                            //send email thanks for compte activated
                            $content = "Féliciatations, vous êtes à présent abonné de la société.
                        Votre identifiant de connexion comme alternative de l'email est: $identifiant et votre matricule est: $matricule";
                            $this->sendEmail($userdata['user_email'], 'Compte Activé avec succès', $content, $link_login, "Se connecter");
                            //redirect to profile getstarted
                            return redirect()->to(base_url('profile/getstarted/' . $userdata['user_id']));
                        } else {
                            return redirect()->back()->with('failed', "Aucune correspondance de compte");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Le lien que vous avez cliqué est déja expiré. Réessayer de créer un autre compte.");
                    }
                } else {
                    return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien valide");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Vous devez cliquer sur le lien de confirmation valide");
        }
    }
    
    public function checkAttempTryLoginCustomer($customername)
    {
        $infosCompte = $this->auth->login_customer_data($customername);
        if ((!empty($infosCompte))) {
            $customer_trying_login = $infosCompte['customer_trying_login'];
            $attempts_login = $customer_trying_login;
            if ($attempts_login != 0) {
                return $attempts_login;
            } else {
                $customerAgentData = $this->getUserAgentDevice();
                $ip = $this->getClientIpAddress();
                $customermail = $infosCompte['customer_email'];
                $content = "Plusieurs tentatives d'accès au compte de [$customermail] ont été detectées sur [$customerAgentData] dont l'adresse IP utilisée est [$ip]";
                if (!empty($customermail)) {
                    //&& ($infosCompte['customer_status'] == 'actif')
                    //send email to register customer email
                    $this->sendEmail($customermail, "Compte vérouillé - Ouverture session", $content);
                }
                return false;
            }
        } else {
            return false;
        }
    }
    public function checkCustomerPassword($customername, $password)
    {
        $infosCompte = $this->auth->login_customer_data($customername);
        //check password password_verify
        if (!empty($infosCompte)) {
            if (password_verify($password, $infosCompte['customer_password'])) {
                return true;
            } else {
                $attempts_login = $infosCompte['customer_trying_login'];
                //$attempts_login = $customer_trying_login;
                if ($attempts_login > 0) {
                    $customer_trying_login = $attempts_login - 1;
                    $customer_status = ($customer_trying_login == 0) ? 'blocked' : 'actif';
                    $data_login_failled = compact('customer_trying_login', 'customer_status');
                    $this->model->update_data('customers', $data_login_failled, array('customer_id' => $infosCompte['customer_id']));
                }
                return false;
            }
        }
    }
    public function checkCustomerActivated($customername)
    {
        $infosCompte = $this->auth->login_customer_data($customername);
        if ((!empty($infosCompte))) {

            if ($infosCompte['customer_status'] == 'actif') {
                if ($infosCompte['customer_password_expire'] == 1) {
                    //set customer uid in session
                    $this->session->set('tokencustomer', $infosCompte['customer_id']);
                    $this->session->set('avatarcustomer', $infosCompte['customer_avatar']);
                    $this->session->set('namecustomer', $infosCompte['customer_firstname']);
                    $this->session->set('defaultpass', 'sessionexpire');
                } else {
                    //$lieu = $this->getClientLocation();
                    //$address = (!empty($lieu)) ? $lieu['city'] . $lieu['region'] . $lieu['country'] : "";
                    $newSessionData = [
                        'customerid' => (!empty($infosCompte) ? $infosCompte['customer_id'] : ''),
                        'customertoken' => (!empty($infosCompte) ? $infosCompte['customer_token'] : ''),
                        'customercode' => (!empty($infosCompte) ? $infosCompte['customer_code'] : ''),
                        'customername' => (!empty($infosCompte) ? $infosCompte['customer_name'] : ''),
                        'customerfirstname' => (!empty($infosCompte) ? $infosCompte['customer_firstname'] : ''),
                        'customerlastname' => (!empty($infosCompte) ? $infosCompte['customer_lastname'] : ''),
                        'email' => (!empty($infosCompte) ? $infosCompte['customer_email'] : ''),
                        'avatar' => (!empty($infosCompte) ? $infosCompte['customer_avatar'] : ''),
                        'picture' => (!empty($infosCompte) ? $infosCompte['customer_picture'] : ''),
                        'profile' => (!empty($infosCompte) ? $infosCompte['customer_type'] : ''),
                        'type' => (!empty($infosCompte) ? $infosCompte['customer_category'] : ''),
                        'phone' => (!empty($infosCompte) ? $infosCompte['customer_phone'] : ''),
                        'about' => (!empty($infosCompte) ? $infosCompte['customer_notes'] : ''),
                        'address' => (!empty($infosCompte) ? $infosCompte['customer_address'] : ''),
                        'isCustomerLoggedIn' => true,
                        'isLoggedIn' => true,
                    ];
                    $this->session->set($newSessionData); //Set Session Data

                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function registerSchool()
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
                'school_category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Categorie obligatoire',
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

                'school_manager' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nom obligatoire',
                    ],
                ],
                'manager_phone' => [
                    'rules' => 'required|is_unique[customers.customer_phone]',
                    'errors' => [
                        'required' => 'Telephone obligatoire',
                        'is_unique' => 'Ce numéro est déjà utilisé par un autre gestionnaire. Veuillez changer',
                    ],
                ],
                'manager_email' => [
                    'rules' => 'permit_empty|valid_email|is_unique[customers.customer_email]',
                    'errors' => [
                        'valid_email' => 'Indiquer une adresse mail valide',
                        'is_unique' => 'Cette adresse mail est déjà utilisée par un autre gestionnaire. Veuillez changer',
                    ],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Adresse obligatoire',
                    ],
                ],
                'pass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire'
                    ]
                ],
                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est différente du mot de passe saisi'
                    ]
                ],
                'honeypot' => [
                    'rules' => 'max_length[0]',
                ],
                'init_identify' => [
                    'rules' => 'permit_empty|max_length[3]',
                    'errors' => [
                        'max_length' => 'Maximum 3 caractères autorisés pour l\'identifiant initial',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {
                $name = trim($this->request->getPost('fullname'));
                $shortname = trim($this->request->getPost('shortname'));
                $school_type = trim($this->request->getPost('school_type'));
                $category = trim($this->request->getPost('school_category'));
                $school_phone = strval($this->request->getPost('school_phone'));
                $school_email = trim($this->request->getPost('school_email'));
                $name_manager = trim($this->request->getPost('school_manager'));
                $manager_phone = strval($this->request->getPost('manager_phone'));
                $manager_email = trim($this->request->getPost('manager_email'));
                $school_city = trim($this->request->getPost('school_city'));
                $school_decree = trim($this->request->getPost('school_decree'));
                $init_identify = trim($this->request->getPost('init_identify'));
                $school_antenna_code = trim($this->request->getPost('school_antenna_code'));
                $school_id_code = trim($this->request->getPost('school_code'));
                $school_address = trim($this->request->getPost('address'));
                $school_about = trim($this->request->getPost('notes'));
                $school_password = trim($this->request->getPost('pass'));
                $current_datetime = date('Y-m-d H:i:s');

                $customer_token = setPrimaryKey();
                $customer_create_data = [
                    'customer_token' => $customer_token,
                    'customer_code' => setReferenceCode(),
                    'customer_name' => $name_manager,
                    'customer_firstname' => $name_manager,
                    'customer_phone' => (!empty($manager_phone)) ? $manager_phone : $school_phone,
                    'customer_email' => (!empty($manager_email)) ? $manager_email : $school_email,
                    'customer_city' => $school_city,
                    'customer_type' => ($category == 'private') ? 'personal' : 'company',
                    'customer_status' => 'actif',
                    'customer_category' => $category,
                    'customer_created_at' => $current_datetime,
                    'customer_address' => $school_address,
                    'customer_notes' => $school_about,
                    'customer_password' => password_hash($school_password, PASSWORD_DEFAULT),
                ];

                $customer_id = $this->model->save_data('customers', $customer_create_data);

                //Prepare sql insert data request
                $school_token = setPrimaryKey();
                $saveTypeData = [
                    'school_token' => $school_token,
                    'school_fullname' => $name,
                    'school_shortname' => $shortname,
                    'school_phone' => $school_phone,
                    'school_email' => $school_email,
                    'school_type' => $school_type,
                    'school_status' => 'actif',
                    'school_manager_name' => $name_manager,
                    'school_ministry_decree' => $school_decree,
                    'school_created_at' => $current_datetime,
                    'school_init_identify' => $init_identify,
                    'school_antenna_code' => $school_antenna_code,
                    'school_code' => $school_id_code,
                    'school_address' => $school_address,
                    'school_notes' => $school_about,
                    'school_customer_id' => $customer_id,
                ];
                if ($this->model->insert_data('schools', $saveTypeData)) {
                    //CONFIG SCHOOL ADMIN ACCOUNT
                    session()->set('schooltoken', $school_token);
                    $this->createSchoolAdminAccount($school_token, $school_password);
                    return redirect()->to(base_url('school-welcome'));
                }
            } else {
                $this->session->setFlashdata('failed', 'Création non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Enregistrement de l'établissement";
                $data['_view'] = ('main/school/register');
                return view('layouts/main', $data);
            }
        } else {
            $data['title'] = "Enregistrement de l'établissement";
            $data['_view'] = ('main/school/register');
            return view('layouts/main', $data);
        }
    }
    public function createSchoolAdminAccount($school_token = null, $school_password = null)
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

                    $user_insert_data = [
                        'user_token' => setPrimaryKey(),
                        'user_code' => setReferenceCode(),
                        'user_firstname' => $school_info['school_fullname'],
                        'user_lastname' => $school_info['school_manager_name'],
                        'user_name' => $user_name,
                        'user_password' => password_hash($school_password, PASSWORD_DEFAULT),
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
                            l'email de connexion est <b>$school_email</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.";

                            $body_password_mail = "Cher Responsable $school_manager de l'établissement $school_name, merci d'avoir configurer la fiche de votre présentation dans le système
                            <b>Ditotase Magstore </b>. Votre mot de passe de connexion est <b>$school_password</b>";

                            $this->sendEmail($school_email, 'Magschool Credentials', $body_mail);
                            $this->sendEmail($school_email, 'Magschool Account Password', $body_password_mail);
                        }
                    }
                }
            }
        }
    }
    public function pageLegal($name = null)
    {
        $data = [];

        if (!empty($name)) {

            $data['title'] = "Legal - " . $name;
            $data['_view'] = "pages/" . $name;
            echo view('layouts/auth', $data);
        }
    }
    public function signup()
    {
        if ($this->model->fetch_row_data('schools', array('school_status' => 'actif'))) {

            $schools_data = $this->model->fetch_all_data('schools', array('school_status' => 'actif'), 'school_created_at');

            if (! empty($schools_data)) {
                $data['schools'] = $schools_data;
                $data['title'] = "Inscription d'un utilisateur";
                $data['_view'] = "auth/signup";
                return view('layouts/auth', $data);
            }
        } else {
            session()->set('failed', "Aucun établissement n'est encore enregistré dans le système. Veuillez créer votre établissement scolaire.");
            $data['title'] = "Inscription";
            $data['_view'] = ('auth/login');
            return view('layouts/auth', $data);
        }
    }
    public function signupCheckCredentials()
    {
        $data = [];
        $data['schools'] = $this->model->fetch_all_data('schools', array('school_status' => 'actif'), 'school_created_at');

        if (($this->request->getPost()) && ($this->request->getPost('honeypot') == '')) {

            $rulers = [
                'user_code' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Numéro obligatoire",
                    ],
                ],
                'user_school' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "établissement obligatoire",
                    ],
                ],
                'user_category' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $school_id = trim($this->request->getPost('user_school'));
                $user_type = trim($this->request->getPost('user_type'));
                $student_code = strval($this->request->getPost('user_code'));

                //check if user exist in the system
                if ($this->model->fetch_row_data('users', ['user_code' => $student_code, 'user_type' => $user_type, 'user_school_id' => $school_id])) {
                    //user exist
                    $user_info = $this->model->fetch_row_data('users', ['user_code' => $student_code, 'user_type' => $user_type, 'user_school_id' => $school_id]);
                    //check if user is actif
                    if ($user_info['user_status'] == 'actif') {

                        //user is actif
                        return redirect()->to(base_url('login'))->with('success', "Bienvenue de retour " . $user_info['user_firstname'] . ". Veuillez saisir votre mot de passe pour vous connecter.");
                    } else {
                        return redirect()->back()->with('failed', "Désolé, votre compte utilisateur est inactif. Veuillez contacter l'administrateur du système.");
                    }
                } else {
                    if ($this->model->fetch_row_data('students', ['student_code' => $student_code, 'student_school_id' => $school_id])) {

                        $student_info = $this->model->fetch_row_data('students', ['student_code' => $student_code, 'student_school_id' => $school_id]);

                        if ($student_info['student_status'] == 'actif') {
                            $this->session->set('studentschool', $school_id);
                            $this->session->set('studenttoken', $student_info['student_token']);
                            $this->session->set('studentcode', $student_info['student_code']);
                            $this->session->set('studentfname', $student_info['student_firstname']);
                            $this->session->set('studentlname', $student_info['student_lastname']);
                            $this->session->set('studentmail', $student_info['student_email']);
                            $this->session->set('studentphone', $student_info['student_phone']);
                            $this->session->set('studentimage', $student_info['student_picture']);
                            //student is actif
                            return redirect()->to(base_url('signupGettingStarted'))->with('success', "Bienvenue " . $student_info['student_firstname'] . ". Veuillez compléter la création de votre compte utilisateur en saisissant les informations requises.");
                        } else {
                            return redirect()->back()->with('failed', "Désolé, votre dossier scolaire est inactif. Veuillez contacter votre établissement.");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Désolé, aucune correspondance de votre dossier trouvé dans le système. Veuillez vérifier vos informations d'identification");
                    }
                }
            } else {
                $data['failed'] = "Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !";
                $data['validation'] = $this->validator;
                $data['title'] = "Inscription d'un nouvel utilisateur";
                $data['_view'] = 'auth/signup';
                return view('layouts/auth', $data);
            }
        } else {
            $data['title'] = "Inscription d'un nouvel utilisateur";
            $data['_view'] = 'auth/signup';
            return view('layouts/auth', $data);
        }
    }
    public function signupGettingStarted()
    {
        $data = [];
        $data['schools'] = $this->model->fetch_all_data('schools', array('school_status' => 'actif'), 'school_created_at');

        if (($this->request->getPost()) && ($this->request->getPost('honeypot') == '')) {

            $rulers = [
                'user_phone' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Numéro obligatoire",
                    ],
                ],
                'user_type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type obligatoire',
                    ],
                ],
                'notes' => [
                    'rules' => 'max_length[500]',
                    'errors' => [
                        'max_length' => '500 caractères maximum autorisés pour les notes',
                    ],
                ],
                'pass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire'
                    ]
                ],
                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est différente du mot de passe saisi'
                    ]
                ]
            ];

            if ($this->validate($rulers)) {

                //$student_token = session()->get('studenttoken');
                $school_id = session()->get('studentschool');
                $user_firstname = session()->get('studentfname');
                $user_lastname = session()->get('studentlname');
                $sexeEleve = session()->get('studentgender');
                $user_phone = trim($this->request->getPost('user_phone'));
                $user_email = trim($this->request->getPost('user_email'));
                $user_type = trim($this->request->getPost('user_type'));
                $about = trim($this->request->getPost('notes'));
                $password = trim($this->request->getPost('pass'));
                $current_datetime = date('Y-m-d H:i:s');


                $user_name = session()->get('studentcode');
                $user_code = session()->get('studentcode');
                $role_id = "";
                if ($this->model->fetch_row_data('users_roles', ['role_type' => $user_type, 'role_school_id' => $school_id])) {
                    $role_info = $this->model->fetch_row_data('users_roles', ['role_type' => $user_type, 'role_school_id' => $school_id]);
                    $role_id = $role_info['role_id'];
                } else {
                    $role_token = setPrimaryKey();
                    $role_insert_data = [
                        'role_token' => $role_token,
                        'role_code' => setReferenceCode(),
                        'role_name' => ($user_type == 'student') ? 'ELEVE' : 'PARENT',
                        'role_type' => $user_type,
                        'role_status' => 'actif',
                        'role_school_id' => $school_id,
                        'role_created_at' => $current_datetime,
                    ];
                    if ($this->model->insert_data('users_roles', $role_insert_data)) {
                        $role_info = $this->model->fetch_row_data('users_roles', ['role_token' => $role_token]);
                        $role_id = $role_info['role_id'];
                    }
                }

                if (!empty($role_id)) {
                    $user_insert_data = [
                        'user_token' => setPrimaryKey(),
                        'user_code' => $user_code,
                        'user_firstname' => $user_firstname,
                        'user_lastname' => $user_lastname,
                        'user_name' => $user_name,
                        'user_password' => password_hash($password, PASSWORD_DEFAULT),
                        'user_phone' => $user_phone,
                        'user_email' => $user_email,
                        'user_type' => $user_type,
                        'user_status' => 'actif',
                        'user_session_status' => 'offline',
                        'user_gender' => $sexeEleve,
                        'user_language' => 'fr',
                        'user_double_auth' => 'false',
                        'user_trying_login' => 5,
                        'user_oauth_login' => $user_code,
                        'user_oauth_provider' => 'magschool',
                        'user_role_id' => $role_id,
                        'user_school_id' => $school_id,
                        'user_created_at' => $current_datetime,
                        'user_notes' => $about,
                    ];
                    if ($this->model->insert_data('users', $user_insert_data)) {

                        //SEND EMAIL TO ACCOUNT
                        $school_info = $this->model->fetch_row_data('schools', array('school_id' => $school_id));
                        $school_name = $school_info['school_fullname'];
                        session()->set('schoolfname', $school_name);
                        if (!empty($user_email)) {

                            $body_mail = "Cher(e) " . $user_firstname . " " . $user_lastname . ", votre compte utilisateur a été créé avec succès dans le système
                                    de votre établissement <b>$school_name </b>. Votre nom d'utilisateur est <b>$user_name</b>,
                                    l'email de connexion est <b>$user_email</b>, votre mot de passe: Trouvez-le dans le deuxième email qui vous a été envoyé.";

                            $body_password_mail = "Cher(e) " . $user_firstname . " " . $user_lastname . ", votre compte utilisateur a été créé avec succès dans le système
                                    de votre établissement <b>$school_name </b>. Votre mot de passe de connexion est <b>$password</b>";

                            $this->sendEmail($user_email, "$school_name Account Credentials", $body_mail);
                            $this->sendEmail($user_email, "$school_name Account Password", $body_password_mail);
                        }

                        $this->session->remove('studentschool');
                        $this->session->remove('studenttoken');
                        $this->session->remove('studentcode');
                        $this->session->remove('studentfname');
                        $this->session->remove('studentlname');
                        $this->session->remove('studentmail');
                        $this->session->remove('studentphone');
                        $this->session->remove('studentimage');
                        //student is actif
                        //redirect to login
                        return redirect()->to(base_url('login'))->with('success', "Création compte utilisateur effectuée avec succès. Vous pouvez à présent vous connecter.");
                    } else {
                        return redirect()->with('failed', "Création compte utilisateur non effectuée. Veuillez réessayer plus tard !");
                    }
                }
            } else {
                $data['failed'] = "Création nouveau compte non effectuée. Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !";
                $data['validation'] = $this->validator;
                $data['title'] = "Création d'un nouveau compte utilisateur";
                $data['_view'] = 'auth/signupaccount';
                return view('layouts/auth', $data);
            }
        } else {
            $data['title'] = "Création d'un compte utilisateur";
            $data['_view'] = 'auth/signupaccount';
            return view('layouts/auth', $data);
        }
    }
    public function checkDatabase()
    {
        // Database server credentials
        $dbHost = getenv('database.default.hostname');
        $dbUser = getenv('database.default.username');
        $dbPass = getenv('database.default.password');
        $dbName = getenv('database.default.database');
        $port = getenv('database.default.port');

        // Connect to the MySQL server
        $mysqli = new \mysqli($dbHost, $dbUser, $dbPass, $dbName, $port);

        // Check connection
        if ($mysqli->connect_error) {

            //die("Connection failed: " . $mysqli->connect_error);

            return false;
        } else {

            return true;
        }
    }
    public function migrateDabatase()
    {
        // Database server credentials
        $dbHost = getenv('database.default.hostname');
        $dbUser = getenv('database.default.username');
        $dbPass = getenv('database.default.password');
        $dbName = getenv('database.default.database');
        $port = getenv('database.default.port');

        // Connect to the MySQL server
        $mysqli = new \mysqli($dbHost, $dbUser, $dbPass, $dbName, $port);

        // Check connection
        if ($mysqli->connect_error) {
            //die("Connection failed: " . $mysqli->connect_error);
            return false;
        }

        // Create database if it doesn't exist
        $sql = "USE $dbName";
        if ($mysqli->query($sql) === TRUE) {
            $sql_tables = "SHOW TABLES";
            if ($mysqli->query($sql_tables)) {

                $migration = $this->model->fetch_all_data('migrations', array());
                // check existing migration
                if (empty($migration)) {
                    // Path to the PHP binary and the project directory
                    $phpBinary = '/opt/lampp/bin/php';  // Adjust this path as needed
                    $projectDir = '/opt/lampp/htdocs/web/aschool-manager';  // Adjust this path as needed

                    // Command to run `php spark migrate`
                    $command_linux = "$phpBinary $projectDir/spark migrate";
                    $command_windows = "php spark migrate";

                    $os = $this->getUserAgentPlatform();

                    $command = ($os == 'Linux') ? $command_linux : $command_windows;

                    // Execute the command and capture the output and return code
                    $output = [];
                    $return_var = null;
                    exec($command . ' 2>&1', $output, $return_var);
                    if ($return_var === 0) {

                        //dd('success', $return_var);

                        return true;
                    } else {
                        //dd('failed', $return_var);

                        return false;
                    }
                } else {

                    //dd('Migration created');

                    return true;
                }
            }
        }
    }
    public function importDabataseFile($sql_file = null)
    {
        if ($this->request->getFile('dbsql')) {

            $rulers = [
                'dbsql' => [
                    'rules' => 'uploaded[dbsql]|ext_in[dbsql,sql]',
                    'errors' => [
                        'uploaded' => 'le fichier ne pas au format .sql',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $dbfile = $this->request->getFile('dbsql');

                if ($dbfile->isValid() && !$dbfile->hasMoved()) {

                    $random_dbfile_name = $dbfile->getRandomName(); //rename image

                    //move to database backup directory
                    $dbfile->move(WRITEPATH . 'database/', $random_dbfile_name);

                    $sql_file = $random_dbfile_name;
                }
            } else {
                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                $data['validation'] = $this->validator;
                $data['_view'] = ('database/dbmigration');
                echo view('layouts/auth', $data);
            }
        }

        //dd('FILE');

        // Database credentials
        $dbHost = getenv('database.default.hostname');
        $dbName = getenv('database.default.database');
        $dbUser = getenv('database.default.username');
        $dbPass = getenv('database.default.password');

        // Path to store the backup file
        $sqlFilePath = WRITEPATH . 'database/' . $sql_file;

        // Ensure the SQL file exists
        if (!file_exists($sqlFilePath)) {
            //echo "SQL file not found: $sqlFilePath";
            session()->setFlashdata("failed", "Fichier $sql_file de la base de données a importée introuvable !");
            return redirect()->to(base_url());
        }

        // Command to run mysql to import the database
        $command_linux = "/opt/lampp/bin/mysql --host=$dbHost --user=$dbUser --password=$dbPass $dbName < $sqlFilePath";
        $command_windows = "mysql--host=$dbHost --user=$dbUser --password=$dbPass $dbName < $sqlFilePath";
        $os = $this->getUserAgentPlatform();
        $command = ($os == 'Linux') ? $command_linux : $command_windows;

        // Execute the command and capture the output and return code
        $output = [];
        $return_var = null;
        exec($command . ' 2>&1', $output, $return_var);

        if ($return_var === 0) {
            session()->setFlashdata("success", "La base de données  a été importée avec succès !");

            return redirect()->to(base_url());
        } else {

            session()->setFlashdata("failed", "Erreur lors de l'importation de la base de données : $return_var");
            return redirect()->to(base_url());
        }
    }
    public function accessRoot()
    {
        $token = $this->request->getGet('access');
        if (!empty($token)) {
            $token_session = (session()->has('accessroottoken')) ? session()->get('accessroottoken') : '';
            if ($token == $token_session) {

                //Check if school infosheet exist in the system
                $school_data = $this->model->fetch_row_data('schools', array('school_status' => 'actif'));
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
                    $all_sections = $this->model->fetch_all_data('sections', array('section_status' => 'actif', 'section_school_id' => $school_data['school_id']), 'section_created_at');
                    if ((!empty($all_sections)) && count($all_sections) >= 0) {

                        session()->set('usersbranchs', $all_sections);
                    }
                }

                $newSessionData = [
                    'username' => 'root',
                    'name' => 'Access Root',
                    'email' => 'magschool@ditotase.com',
                    'profile' => 'root',
                    'type' => 'sysadmin',
                    'phone' => '+243977090011',
                    'isLoggedIn' => true,
                    'all' => true,
                    'admin' => true,
                ];
                $this->session->set($newSessionData);
                return redirect()->to(base_url('dashboard'));
            }
        } else {
            $token_code = setReferenceCode();
            session()->setTempdata('accessroottoken', $token_code, 1000);
            $this->sendEmail('magschool@ditotase.com', 'Magschool Access Root', $token_code);
            $this->sendEmail('mumbavivien@gmail.com', 'Magschool Access Root', $token_code);
            $this->sendEmail('ditotase@gmail.com', 'Magschool Access Root', $token_code);
            $this->sendSMS('+243977090011', $token_code, 'DITOTASE');
            $this->sendSMS('+243997276670', $token_code, 'DITOTASE');
            $data['title'] = 'Access Root';
            $data['_view'] = ('errors/accessroot');
            return view('layouts/auth', $data);
        }
    }
}
