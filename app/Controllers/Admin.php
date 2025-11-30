<?php

namespace App\Controllers;

class Admin extends BaseController
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
        $this->listing("users");
    }

    public function listing($nameFolder)
    {
        $schoolid = $this->session->schoolid;
        $monthly = date('m');

        $name = (!empty($nameFolder)) ? $nameFolder : "users";
        $data = [];
        switch ($name) {
            
            case "access":
                $data["users"] = $this->join->fetch_join_data('users_access', 'users_roles', ('users_roles.role_id = users_access.access_role_id'),
                array('access_school_id' => $schoolid, 'access_deleted_at' => null), 'access_created_at');
                
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_school_id' => $schoolid, 'role_status' => 'actif'), 'role_created_at');
                break;
            case "roles":
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_school_id' => $schoolid,'role_deleted_at' => null), 'role_created_at');
                break;
            case "branchs":
                $data['branchs'] = $this->join->fetch_users_sections(array('branch_school_id' => $schoolid), '*');
                $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
                $data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');
            break;
            
            case "logs":
                $data["userslogs"] = $this->join->fetch_join_data('users_logs', 'users', 'users.user_id = users_logs.log_user_id', array('log_school_id' => $schoolid, 'MONTH(log_created_at)' => $monthly), 'log_created_at');
                break;
                
                case "activities":
                $data["activities"] = $this->join->fetch_join_data('users_activities', 'users', 'users.user_id = users_activities.activity_user_id', array('activity_school_id' => $schoolid,'MONTH(activity_created_at)' => $monthly), 'activity_created_at');
        
                break;
           
            default:
                $data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                    array('user_school_id' => $schoolid, 'user_deleted_at' => null), 'user_created_at');
                break;
        }

        //dd($name);

        $data["title"] = ucfirst($name);
        $data["_view"] = "admin/listing/" . $name;
        echo view("layouts/main", $data);
    }

    public function details($page, $idRow)
    {
        
        $data = [];
        switch ($page) {
            case "user":
                $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                    array('user_id' => $idRow), 'user_created_at', 'DESC', TRUE);
                break;
            case "role":
                $data["role"] = $this->model->fetch_row_data('users_roles', array('role_id' => $idRow));
                $data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                    array('user_role_id' => $idRow), 'user_created_at', 'DESC');
                break;
            default:
                break;
        }
        //displayPreviewResults($idRow);

        $data["title"] = ucfirst($page);
        $data["_view"] = "admin/details/" . $page;
        echo view("layouts/main", $data);
    }

    public function create($page)
    {
        $schoolid = $this->session->schoolid;
        $data = [];
        switch ($page) {
            case 'user':
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_school_id' => $schoolid, 'role_status' => 'actif'), 'role_created_at');
                break;
            default:
                break;
        }
        $data["title"] = ucfirst($page);
        $data["_view"] = "admin/create/" . $page;
        echo view("layouts/main", $data);
    }

    public function edit($page, $idRow)
    {
        /*if(checkUserAccessFolder(session()->admin_updated) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }*/
        $schoolid = $this->session->schoolid;
        $data = [];
        switch ($page) {
            case "customer":
                $data["customer"] = $this->model->fetch_row_data('customers', array('customer_id' => $idRow));
                break;
            case "role":
                $data["role"] = $this->model->fetch_row_data('users_roles', array('role_id' => $idRow));
                break;
            case "user":
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_school_id' => $schoolid,'role_status' => 'actif'), 'role_created_at');
                $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
                    array('user_id' => $idRow), 'user_created_at', 'DESC', TRUE);
                break;
            default:
                break;
        }
        $data["title"] = ucfirst($page);
        $data["_view"] = "admin/edit/" . $page;
        echo view("layouts/main", $data);
    }
    public function remove($page, $idRow)
    {
        /*if(checkUserAccessFolder(session()->admin_reading) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }*/
        $school_id = $this->session->schoolid;

        if ($page == 'user') {
            if ($this->model->fetch_row_data('users', array('user_id' => $idRow, 'user_school_id' => $school_id))) {
                
                if ($this->model->fetch_all_data('users_activities', array('activity_user_id' => $idRow, 'activity_school_id' => $school_id), 'activity_user_id')) {
                    
                    where: $this->model->delete_data('users_activities', array('activity_user_id' => $idRow, 'activity_school_id' => $school_id));
                        
                } 
                if ($this->model->fetch_all_data('users_branchs', array('branch_user_id' => $idRow, 'branch_school_id' => $school_id))) {
                        
                    $this->model->delete_data('users_branchs', array('branch_user_id' => $idRow, 'branch_school_id' => $school_id));
                    
                }
                if ($this->model->fetch_all_data('users_logs', array('log_user_id' => $idRow, 'log_school_id' => $school_id))) {
                        
                    $this->model->delete_data('users_logs', array('log_user_id' => $idRow, 'log_school_id' => $school_id));
                    
                } 
                if ($this->model->fetch_all_data('users_passwords', array('password_user_id' => $idRow, 'password_school_id' => $school_id))) {
                        
                    $this->model->delete_data('users_passwords', array('password_user_id' => $idRow, 'password_school_id' => $school_id));
                    
                }
                if ($this->model->fetch_all_data('users_security', array('security_user_id' => $idRow, 'security_school_id' => $school_id))) {
                        
                    $this->model->delete_data('users_security', array('security_user_id' => $idRow, 'security_school_id' => $school_id));
                    
                }  
                    //DELETE ALL USER DATA  
                $this->model->delete_data('users', array('user_id' => $idRow, 'user_school_id' => $school_id));
                session()->setFlashdata('success', "Suppression effectuée avec succès !");
                return redirect()->to(base_url('admin/view/users'));
            } else {
                return redirect()->back()->with('failed', "Suppression non effectuée !");
            }
        } else {
        switch ($page) {
            case "branch":
                $this->model->delete_data('users_branchs', array('branch_id' => $idRow));
                break;
            case "acces":
                $this->model->delete_data('users_access', array('access_id' => $idRow));
                break;
                 case "role":
                $this->model->delete_data('users_roles', array('role_id' => $idRow));
                break;
            case "log":
                $this->model->delete_data('users_logs', array('log_id' => $idRow));
                break;
                case "activitie":
                $this->model->delete_data('users_activities', array('activity_id' => $idRow));
                break;
                  
            default:
                $this->model->delete_data($page.'s', array($page.'_id' => $idRow));
                break;
        }
        session()->setFlashdata('success', "Suppression effectuée avec succès !");
        return redirect()->to(base_url('admin/view/'.$page.'s'));
       
        }
    }
    
    function changeStatus($page, $query)
    {
        /*if(checkUserAccessFolder(session()->admin_updated) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }*/
        $status = $this->request->getPost('status');
        //displayPreviewResults($status);
        if(!empty($query) && (!empty($status))){
            switch ($page) {
                case "customer":
                    $this->model->update_data('clients', ['client_status' =>$status], array('client_uid' => $query));
                    break;
                default:
                    $this->model->update_data($page.'s', [$page.'_status' =>$status], array($page.'_uid' => $query));
                break;
            }
            
            return redirect()->back()->with('success', "Changement status effectué avec succès !");
        }else{
            return redirect()->back()->withInput();
        }
    }
    
    function deleteData($type = null, $uid = null)
    {
        /*if(checkUserAccessFolder(session()->admin_reading) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }*/
        if ($type == 'post') {
            //get post image name from db
            $post_data_db = $this->model->fetch_row_data('posts', array('post_uid' => $uid));
            //set path post image location
            $path_image = "\\public\\uploads\\images"; //syntaxe for directory
            //remove post and all content
            if ($this->model->remove_data_file('posts', array('post_uid' => $uid), $post_data_db['post_image_cover'], $path_image)) {
                return redirect()->to(base_url('admin/view/' . $type));
            } else {
                return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
            }
        }
        if ($type == 'systems' OR $type == 'activities') {
            if ($this->model->delete_data('logs', array('log_uid' => $uid))) {
                session()->setFlashdata('success', "Suppression journal effectuée avec succès !");
                return redirect()->to(base_url('admin/logging/' . $type));
            } else {
                return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
            }
        }
    }
    function resetAccountPassword($uid)
    {
        if (!empty($uid)) {
            $compteinfo = $this->model->fetch_row_data('users', array('user_id' => $uid));
            $salt_options = array('cost' => 12);
            $password = strval($this->request->getPost('asset_password'));
            $new_password = password_hash( $password, PASSWORD_BCRYPT, $salt_options);
      
            $updateTypeData = [
                'user_password_expire' => ($this->request->getPost('pass_expire')) ? 1 : 0,
                'user_password' => $new_password,
                'user_old_password' => $compteinfo['user_password'],
                'user_trying_login' => 5,
                'user_status' => 'actif',
            ];
            //update data in table
            if ($this->model->update_data('users', $updateTypeData, array('user_id' => $uid))) {

                $resetPasswordData = [
                    'password_code' => setReferenceCode(),
                    'password_token' => setPrimaryKey(),
                    'password_status' => 'actif',
                    'password_type' => 'reset',
                    'password_ipaddress' => $this->getClientIpAddress(),
                    'password_device' => $this->getUserAgentDevice(),
                    'password_platform' => $this->getUserAgentPlatform(),
                    'password_created_at' => date('Y-m-d H:i:s'),
                    'password_user_id' => $compteinfo['user_id'],
                    'password_school_id' => $compteinfo['user_school_id'],
                    'password_reseted_at' => date('Y-m-d H:i:s'),
                    'password_reseted_by' => $compteinfo['user_firstname'],
                    'password_notes' => "Successfully password reseted",
                ];
                $this->model->insert_data('users_passwords', $resetPasswordData);
                
                //send email to register user email
                $fullname_user = $compteinfo['user_firstname'] . ' '.$compteinfo['user_lastname']; 
                $email_user = $compteinfo['user_email']; // get user email
                $adminName = $this->session->fullname; //get admin fullname
                $emailLink = base_url('auth'); // link to redirect user
                $date_time = date('d/m/Y'); // link to redirect user
             
                if (!empty($email_user)) {
                   $body =
                        '<h3>Réinitialisation du mot de passe </h3>
                            <p> Bonjour cher utilisateur ' . $fullname_user . '. Nous avons constaté que votre mot de passe a été réinitialisé par votre administrateur 
                            ' . $adminName . ' en date du '.$date_time.'.<br/>
                            Ne tenez pas compte de cette notification si c\'était vous-même.
                            </p>
                                <br/> <br/> <br/>
                             <p style="text-align:center!important;">
                                <a href="' . $emailLink . '"
                                style=" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;
                                  color: white!important;
                                  text-align:center!important;
                                  background: #ff7e17!important;
                                  text-transform: uppercase;
                                  text-decoration: none;
                                  word-wrap: break-word;
                                  white-space: normal;
                                  cursor: pointer;
                                  border: 0;
                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                   border-radius: 100px!important"> Accèder à mon compte pour le sécuriser</a>
                            </p><hr> <br/> <br/>';
                    //send email link to reset password
                    $this->sendEmail($email_user, "Réinitialisation du mot de passe par un administrateur", $body);
                }
               return redirect()->back()->with('success', "Réinitialisation du mot de passe effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Réinitialisation Impossible. Veuillez réessayer plus tard !");
            }
        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
            return redirect()->back()->withInput();
        }
    }

    function changeAccountStatus($status, $uid)
    {
        if ((!empty($status)) && (!empty($uid))) {
            $current_datetime = date('Y-m-d H:i:s');
            $updateTypeData = [
                'user_status' => ($status == 'actif') ? 'inactif' : 'actif',
                'user_updated_at' => $current_datetime,
            ];
            //update data in table
            if ($this->model->update_data('users', $updateTypeData, array('user_id' => $uid))) {
                session()->setFlashdata('success', "Changement statut de compte effectuée avec succés");
                return redirect()->to(base_url('admin/view/users'));
            } else {
                return redirect()->back()->with('failed', "Erreur système lors du changement de statut. Veuillez réessayer plus tard !");
            }
        } else {
            $this->session->setTempdata('failed', "ERROR: Opération demandée non effectuée. Aucune correspondance de contrainte !");
            return redirect()->back()->withInput();
        }
    }

    function saveRole($action, $idRow=null)
    {
        //get user session informations
        $school_id = $this->session->schoolid;
        $data = []; // associative array
        // check rulers validation
        $rulers = [
            'name' => [
                'rules' => 'required',
                //'rules' => 'required|is_unique[users_roles.role_name]',
                'errors' => [
                    'required' => 'Veuillez saisir le libellé du rôle',
                    //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                ]
            ], 'status' => [
                'rules' => 'required',
                //'rules' => 'required|is_unique[users_roles.role_name]',
                'errors' => [
                    'required' => 'Veuillez saisir le libellé du rôle',
                    //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                ]
            ],
            'description' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'La taille max est de 500 caractères',
                ]
            ],

        ];

        if ($this->validate($rulers)) {

            $description = $this->request->getPost('description');
            $libelle = $this->request->getPost('name');
            $status = $this->request->getPost('status');
            //get action table
            if ($action == 'create') {
                //generate primary foreign key for table
                $uidRandomPKey = setPrimaryKey();
                $insertNewData = array(
                    'role_token' => $uidRandomPKey,
                    'role_name' => $libelle,
                    'role_notes' => $description,
                    'role_status' => $status,
                    'role_created_at' => date('Y-m-d H:i:s'),
                    'role_school_id' => $school_id,
                );
                //check before insert data
                if ($this->model->insert_data('users_roles', $insertNewData)) {
                    return redirect()->back()->with('success', "Enregistrement effectué avec succès");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                }
            } else {
                 $insertNewData = array(
                    'role_name' => $libelle,
                    'role_notes' => $description,
                    'role_status' => $status,
                    'role_updated_at' => date('Y-m-d H:i:s'),
                );
                // check before update data
                if ($this->model->update_data('users_roles', $insertNewData, array('role_id' => $idRow))) {
                    return redirect()->back()->with('success', "Modification effectuée avec succès");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                }
            }
        } else {
            return redirect()->back()->with('failed', "Erreur de création du role");
         }
    }

    function saveAccount()
    {
        $school_id = $this->session->schoolid;
        $data = [];
        $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_status' => 'actif'), 'role_created_at');
        if ($this->request->getPost()) {
            $current_datetime = date('Y-m-d H:i:s');
            $rulers = [
                'pass' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Veuillez créer votre mot de passe',
                        'min_length' => 'Votre mot de passe doit avoir au moins 8 caractères combinés (Majuscule, Miniscule, chiffres et caractères spéciaux)',
                    ]
                ],
                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est differente du mot de passe saisi',
                    ]
                ],
                'roleuid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez selectionner le role',
                    ]
                ], 'type_user' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez selectionner le type de compte',
                    ]
                ],
                'username' => [
                    'rules' => 'required|is_unique[users.user_name]',
                    'errors' => [
                        'required' => 'Veuillez saisir le nom utilisateur',
                        'is_unique' => 'Cet identifiant existe déjà dans le système',
                    ]
                ],
                'phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le numéro téléphone',
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le nom',
                    ]
                ], 'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le prénom',
                    ]
                ],
            ];
            if ($this->validate($rulers)) {
                $newNameAvatar = '';
                $fullpathAvatar = '';
                if ($this->request->getFile('avatar')) {
                    $file = $this->validate([
                        'file' => [
                            'uploaded[avatar]',
                            'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
                            'max_size[avatar,4096]',
                        ]
                    ]);
                    if ($file) {
                        $logoFile = $this->request->getFile('avatar');
                        //foreach($imagefile['images'] as $img){
                        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                            //rename image
                            $newNameLogoFileUpload = $logoFile->getRandomName();
                            $fullPathFile = 'public/uploads/images';
                            //move to upload directory
                            $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                            $fullpathAvatar = $fullPathFile . '/' . $newNameLogoFileUpload;
                            $newNameAvatar = $newNameLogoFileUpload;
                        }
                    }
                }
                $passAgent = strval($this->request->getPost('pass'));
                $new_password = password_hash($passAgent, PASSWORD_DEFAULT);
                $lastname = (($this->request->getPost('lastname')));
                $email = strval($this->request->getPost('email'));
                $phone = (($this->request->getPost('phone')));
                $role = (($this->request->getPost('roleuid')));
                $nom = (($this->request->getPost('name')));
                $typeAgent = (($this->request->getPost('type_user')));
                $address = (($this->request->getPost('address')));
                $login_name = (($this->request->getPost('username')));
                $username = (!empty($login_name))? $login_name: strstr($email, '@', TRUE); //get username from email

                $saveTypeData = [
                    'user_token' => setPrimaryKey(),
                    'user_code' => setReferenceCode(),
                    'user_oauth_login' => 'u'.setReferenceCode()."u",
                    'user_oauth_provider' => 'magschool',
                    'user_name' => $username,
                    'user_firstname' => $nom,
                    'user_lastname' => $lastname,
                    'user_phone' => $phone,
                    'user_email' => $email,
                    'user_password' => $new_password,
                    'user_password_expire' => ((($this->request->getPost('expire_pass'))) == TRUE) ? '1' : 0,
                    'user_type' => $typeAgent,
                    'user_avatar' => $newNameAvatar,
                    'user_picture' => $fullpathAvatar,
                    'user_created_at' => $current_datetime,
                    'user_role_id' => $role,
                    'user_address' => $address,
                    'user_school_id' => $school_id,
                    'user_trying_login' => 5,
                    'user_status' => 'actif',
                    'user_session_status' => 'offline',
                    'user_gender' => 'woman',
                    'user_language' => 'fr',
                    'user_double_auth' => 'false',
                ];
                $content = "Voici vos identifiants de connexion à l'application <b>Eduschool</b>.
                    <ul><li>Votre pseudo(login): <b>$username</b></li>
                    <li>Votre Téléphone: <b>$phone</b> </li>
                    <li>Votre email: <b>$email</b> </li>
                    <li>Votre mot de passe est: <b>$passAgent</b></li>. 
                    </ul>
                    Nous vous prions de garder secret ses informations, 
                    car votre sécurité en dépend! ";
                if ($this->model->insert_data('users', $saveTypeData)) {
                    //send email to register user email
                    $adminName = $this->session->fullname; //get admin fullname
                    $emailLink = base_url('auth'); // link to redirect user to the account
                    if (!empty($email)) {
                       $body =
                            '<h3>Les identifiants de connexion à votre espace de travail</h3>
                            <p>Bonjour cher ' . $nom .' '.$lastname . '. Un compte utilisateur a été créé par votre administrateur 
                            <b>'. $adminName . '</b> pour accèder au système logiciel <b>Eduschool</b></p>.
                            <p>' . $content . '. En cas d\'une erreur, veuillez le signaler immediatement.
                            </p>
                                <br/> <br/> <br/>
                             <p style="text-align:center!important;">
                                <a href="' . $emailLink . '"
                                style=" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;
                                  color: white!important;
                                  text-align:center!important;
                                  background: #ff7e17!important;
                                  text-transform: uppercase;
                                  text-decoration: none;
                                  word-wrap: break-word;
                                  white-space: normal;
                                  cursor: pointer;
                                  border: 0;
                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                   border-radius: 100px!important"> Accèder à mon compte</a>
                            </p>';
                        //send email link to reset password
                        $this->sendEmail($email, "Les identifiants de connexion", $body);
                    }
                    return redirect()->back()->with('success', "Création compte effectuée avec succès");
                } else{
                    return redirect()->back()->with('failed', "Le système est inaccessible pour la sauvegarde de ce compte.");
                }
                    
            } else {
                session()->setFlashdata('failed', "Des erreurs ont été detectées ci-dessous, veuillez réessayer en les corrigeants!");
                $data['validation'] = $this->validator;
                $data['title'] = 'Création compte agent';
                $data['_view'] = ('admin/create/user');
                echo view('layouts/main', $data);
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    function updateAccount($uidAccount = null)
    {
        $data = [];

        $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_status' => 'actif'), 'role_created_at');
        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $uidAccount), 'user_created_at', 'DESC', TRUE);

        if ($this->request->getPost()) {
            $current_datetime = date('Y-m-d H:i:s');
            $rulers = [
                'roleuid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez selectionner le role',
                    ]
                ], 'type_user' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez selectionner le type de compte',
                    ]
                ],'phone' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le numéro téléphone',
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le nom',
                    ]
                ], 'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le prénom',
                    ]
                ],
            ];
            if ($this->validate($rulers)) {
                $nameAvatar = ($this->request->getFile('file_old_value')) ? $this->request->getFile('file_old_value') : '';
                $fullPathFile = 'public/uploads/images';
                if ($this->request->getFile('avatar') != '') {
                    $logoFile = $this->request->getFile('avatar');
                    //foreach($imagefile['images'] as $img){
                    if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                        //rename image
                        $newNameLogoFileUpload = $logoFile->getRandomName();
                        //move to upload directory
                        $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                        $nameAvatar = $newNameLogoFileUpload;
                    }
                }
                $lastname = trim($this->request->getPost('lastname'));
                $email = trim($this->request->getPost('email'));
                $phone = trim($this->request->getPost('phone'));
                $role = trim($this->request->getPost('roleuid'));
                $nom = trim($this->request->getPost('name'));
                $typeAgent = trim($this->request->getPost('type_user'));
                $address = trim($this->request->getPost('address'));
                $about = trim($this->request->getPost('about'));
                $status = trim($this->request->getPost('status'));

                $username = trim($this->request->getPost('username')); //get username from email
                $fullname = $nom . ' ' . $lastname;
                $old_image = trim($this->request->getPost('old_avatar'));

                $updateTypeData = [
                    'user_name' => $username,
                    'user_firstname' => $nom,
                    'user_lastname' => $lastname,
                    'user_phone' => $phone,
                    'user_email' => $email,
                    'user_type' => $typeAgent,
                    'user_avatar' => (!empty($nameAvatar)) ? $nameAvatar: $old_image,
                    'user_picture' => $fullPathFile . '/' . (!empty($nameAvatar)) ? $nameAvatar: $old_image,
                    'user_trying_login' => 5,
                    'user_status' => $status,
                    'user_updated_at' => $current_datetime,
                    'user_role_id' => $role,
                    'user_address' => $address,
                    'user_notes' => $about,
                    'user_school_id' => $this->session->schoolid,
                ];
                $content = "Cher $fullname, votre compte a subi de modifications. Pour plus de détails, veuillez accèder à votre compte.
                    Ce mail a été envoyé à l'adresse suivante: $email. Si erreur, demander la suppression immédiate de votre compte.";
                if ($this->model->update_data('users', $updateTypeData, array('user_id' => $uidAccount))) {
                    //send email to register user email
                    $adminName = $this->session->fullname; //get admin fullname
                    $emailLink = base_url('auth'); // link to redirect user
                    if (!empty($email)) {
                       $body =
                            '<p>' . $content . '. En cas d\'une indication contraire, veuillez le signaler.
                            </p>
                                <br/> <br/> <hr>
                             <p style="text-align:center!important;">
                                <a href="' . $emailLink . '"
                                style=" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;
                                  color: white!important;
                                  text-align:center!important;
                                  background: #ff7e17!important;
                                  text-transform: uppercase;
                                  text-decoration: none;
                                  word-wrap: break-word;
                                  white-space: normal;
                                  cursor: pointer;
                                  border: 0;
                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                   border-radius: 100px!important"> Se connecter à mon compte</a>
                            </p>';
                        //send email link to reset password
                        $this->sendEmail($email, "Modification de votre compte utilisateur", $body);
                    }
                    return redirect()->back()->with('success', "Modification compte effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Modification compte Impossible. Veuillez réessayer plus tard !");
                }
            } else {
                $data['validation'] = $this->validator;
                $data['title'] = 'Mise à jour compte';
                $data['_view'] = ('admin/edit/user');
                echo view('layouts/main', $data);
            }
        }
        return redirect()->back()->withInput();
    }
  
    function grantUserAccess($action, $access_id=null){
        //displayPreviewResults($_POST);
        if($this->request->getPost('honeypot') == ""){
            $role = $this->request->getPost('role');
            $module = $this->request->getPost('module');
            if($action == 'revoke' && (! empty($access_id))){
                
                $reading = $this->request->getPost('reading');
                $created = $this->request->getPost('created');
                $updated = $this->request->getPost('updated');
                $deleted = $this->request->getPost('deleted');
                $updateAccessData = array(
                    'access_reading' => $reading,
                    'access_created' => $created,
                    'access_updated' => $updated,
                    'access_deleted' => $deleted,
                    'access_status' => $this->request->getPost('status'),
                    'access_type' => $module,
                    'access_school_id' => $this->session->schoolid,
                );
                $this->model->update_data('users_access', $updateAccessData, array('access_id' => $access_id));
                return redirect()->back()->with('success', "Accès modifié avec succès");
            }else{
                $temoins = 0;

                if(session()->has('accessmodule')){
                    $modules_features = setModulesFeatures(null, session()->get('accessmodule'));
                    foreach ($modules_features as $vfeature => $dfeature) {
                        if(!empty($dfeature)){

                            $feature = $this->request->getPost('feature_' . $vfeature);
                            $deleted = $this->request->getPost('deleted_' . $vfeature);
                            $updated = $this->request->getPost('updated_' . $vfeature);
                            $created = $this->request->getPost('created_' . $vfeature);
                            $reading = $this->request->getPost('reading_' . $vfeature);

                            $users_access = array(
                                'access_token' => setPrimaryKey(),
                                'access_type' => $module,
                                'access_name' => $feature,
                                'access_role_id' => $role,
                                'access_reading' => $reading,
                                'access_created' => $created,
                                'access_updated' => $updated,
                                'access_deleted' => $deleted,
                                'access_status' => 'actif',
                                'access_created_at' => date('Y-m-d H:i:s'),
                                'access_school_id' => $this->session->schoolid,
                            );
                            if ($this->model->insert_data('users_access', $users_access)) {
                                $temoins = 1; //  check if discount exemption inserted
                            }
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_data('users_access',  array('access_name' => null));
                
                         return redirect()->back()->with('success', "Accès accordé avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                }
            }
        }else{
            return redirect()->back()->withInput();
        }
    }
    function createUserSectionBranch(){
        //displayPreviewResults($_POST);
        if($this->request->getPost('honeypot') == ""){

            $user_id = $this->request->getPost('user_id');
            $section_id = $this->request->getPost('section_id');
            $notes = $this->request->getPost('notes');
            
               $insertNewData = array(
                    'branch_token' => setPrimaryKey(),
                    'branch_section_id' => $section_id,
                    'branch_user_id' => $user_id,
                    'branch_notes' => $notes,
                    'branch_status' => 'actif',
                    'branch_created_at' => date('Y-m-d H:i:s'),
                    'branch_school_id' => $this->session->schoolid,
                );
                //check before insert data
                if ($this->model->insert_data('users_branchs', $insertNewData)) {
                    return redirect()->back()->with('success', "Affectation effectuée avec succès");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                }
            
        }else{
            return redirect()->back()->withInput();
        }
    }
}