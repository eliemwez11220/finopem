<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 27-Feb-21
 * Time: 10:08 AM
 */

namespace App\Controllers;

class Profile extends BaseController
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

    function index()
    {
        $useruid = $this->session->usertoken;
        $schoolid = $this->session->schoolid;

        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_token' => $useruid, 'user_school_id'=>$schoolid), 'user_created_at', 'DESC', TRUE);

       //dd($data["user"]);
        $data['title'] = ucfirst("Manage Profile");
        $data['_view'] = ('profile/profile');
        echo view('layouts/main', $data);
    }

    function edit($type, $useruid)
    {
        $schoolid = $this->session->schoolid;
        $useruid = (!empty($useruid)) ? $useruid : $this->session->usertoken;

        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $useruid, 'user_school_id'=>$schoolid), 'user_created_at', 'DESC', TRUE);
            
        $data["account"] = $this->join->fetch_join_data('users_security', 'users', ('users.user_id = users_security.security_user_id'),
            array('security_user_id' => $useruid, 'user_school_id'=>$schoolid), 'user_created_at', 'DESC', TRUE);
            

        $data['title'] = ucfirst("Manage Profile");
        $data['_view'] = ('profile/' . $type);
        echo view('layouts/main', $data);
    }
   
    function changePassword($useruidtoken)
    {
        $schoolid = $this->session->schoolid;
        $useruid = (!empty($useruidtoken)) ? $useruidtoken : $this->session->usertoken;
        if (! empty($useruid)) {
            
        $data = [];
        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $useruid), 'user_created_at', 'DESC', TRUE);

        $infosCompte = $this->model->fetch_row_data('users', array('user_id' => $useruid));

        $rulers = [
                'oldpass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez indiquer votre ancien mot de passe',
                    ]
                ],
                'pass' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Veuillez créer un nouveau mot de passe',
                        'min_length' => "Le mot de passe doit avoir au moins 1 lettre Majuscule,
                            1 lettre miniscule, 1 caractere special choisi parmi [*|#|@|$|.|?] et 1 chiffre de [0-9] et une longueure d'au moins 8 caracteres.",
                    ]
                ],

                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est différent du mot de passe saisi',
                    ]
                ],
            ];

            if ($this->validate($rulers)) {

                $oldpass = strval($this->request->getPost('oldpass'));
                $newpass = strval(($this->request->getPost('pass')));
                $current_datetime = date('Y-m-d H:i:s');
                $new_password = password_hash($newpass, PASSWORD_DEFAULT);
                //check old password
                if (password_verify($oldpass, $infosCompte['user_password'])) {
                    //table data
                    $saveUpdateUserData = [
                        'user_password' => $new_password,
                        'user_old_password' => $infosCompte['user_password'],
                        'user_password_expire' => 0,
                    ];

                    if ($this->model->update_data('users', $saveUpdateUserData, array('user_id' => $useruid))) {
                        
                        $resetPasswordData = [
                            'password_status' => 'actif',
                            'password_type' => 'change',
                            'password_code' => setReferenceCode(),
                            'password_token' => setPrimaryKey(),
                            'password_ipaddress' => $this->getClientIpAddress(),
                            'password_device' => $this->getUserAgentDevice(),
                            'password_platform' => $this->getUserAgentPlatform(),
                            'password_created_at' => $current_datetime,
                            'password_user_id' => $useruid,
                            'password_school_id' => $schoolid,
                            'password_reseted_at' => $current_datetime,
                            'password_reseted_by' => 'System',
                            'password_notes' => "Successfully password changed",
                        ];
                        $this->model->insert_data('users_passwords', $resetPasswordData);
                         
                        /*============= CREATE USER LOGS ACTIVITY ==============*/
                        $this->createUserLog('account');
                        $this->createUserActivity('password');
                        /*============= END CREATE USER LOGS ACTIVITY ==============*/
                            
                        return redirect()->back()->with('success', "Changement du mot de passe effectué avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Désolé, une erreur système s'est produite. Veuillez réessayer plus tard.");
                    }
                } else {
                    
                    return redirect()->back()->with('failed', "Ancien mot de passe incorrect. Vous devez fournir un mot de passe valide avant de changer le nouveau");
                    
                }
            } else {
                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Password  - Profile';
                $data['_view'] = ('profile/password');
                echo view('layouts/main', $data);
            }
        }
    }

    function changePicture($useruidtoken)
    {
        $useruid = (!empty($useruidtoken)) ? $useruidtoken : $this->session->usertoken;
        $data = [];
        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $useruid), 'user_created_at', 'DESC', TRUE);
        if ($this->request->getFile('avatar')) {
            $file = $this->validate([
                'file' => [
                    'uploaded[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png],image/webp]',
                    'max_size[avatar,4096]',
                ]
            ]);
            if ($file) {
                //if ($this->validate($rulers)) {
                $logoFile = $this->request->getFile('avatar');
                //foreach($imagefile['images'] as $img){
                if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                    //rename image
                    $newNameLogoFileUpload = $logoFile->getRandomName();
                    $fullPathFile = 'public/uploads/images';
                    //move to upload directory
                    $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                    $fullpathAvatar = $fullPathFile . '/' . $newNameLogoFileUpload;
                    $saveTypeData = array(
                        'user_avatar' => $newNameLogoFileUpload,
                        'user_picture' => $fullpathAvatar,
                        'user_updated_at' => date('Y-m-d H:i:s'),
                     );

                    if ($this->model->update_data('users', $saveTypeData, array('user_id' => $useruidtoken))) {
                        $this->session->set('avatar', $newNameLogoFileUpload);
                        
                        /*============= CREATE USER LOGS ACTIVITY ==============*/
                        $this->createUserLog('account');
                        $this->createUserActivity('picture');
                        /*============= END CREATE USER LOGS ACTIVITY ==============*/
                        
                        return redirect()->back()->with('success', "Mise à jour de la photo effectuée avec succès !");
                    }
                    return redirect()->back()->with('failed', "Veuillez selectionner une photo sur votre ordinateur");
                }
            } else {
                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = ucfirst('Profile - Picture');
                $data['_view'] = ('profile/avatar');
                echo view('layouts/main', $data);
            }
        } else {
            return redirect()->back()->with('failed', "Veuillez selectionner une photo sur votre ordinateur");
        }
    }

    function updateAccount($useruidtoken)
    {
        $useruid = (!empty($useruidtoken)) ? $useruidtoken : $this->session->usertoken;
        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $useruid), 'user_created_at', 'DESC', TRUE);

        $rulers = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir votre nom',
                ]
            ], 'lastname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir votre nom',
                ]
            ],
            'email' => [
                'rules' => 'max_length[75]',
                'errors' => [
                    'min_length' => 'La taille max est de 75 caractères',
                ]
            ], 'phone' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Veuillez saisir le numéro',
                    'min_length' => 'La taille max est de 15 caractères',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir votre pseudo',
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir votre sexe',
                ]
            ],
        ];

        //run the validation rulers
        if ($this->validate($rulers)) {
            $current_datetime = date('Y-m-d H:i:s');
            $lastname = trim($this->request->getPost('lastname'));
            $email = trim($this->request->getPost('email'));
            $phone = trim($this->request->getPost('phone'));
            $nom = trim($this->request->getPost('name'));
            $address = trim($this->request->getPost('address'));
            $about = trim($this->request->getPost('about'));
            $gender = trim($this->request->getPost('gender'));
            $username = trim($this->request->getPost('username'));
            $updateTypeData = [
                'user_firstname' => $nom,
                'user_lastname' => $lastname,
                'user_name' => $username,
                'user_email' => $email,
                'user_phone' => $phone,
                'user_notes' => $about,
                'user_address' => $address,
                'user_gender' => $gender,
                'user_updated_at' => $current_datetime,
                'user_language' => trim($this->request->getPost('language')),
            ];
            //update data in table
            if ($this->model->update_data('users', $updateTypeData, array('user_id' => $useruid))) {
                
                /*============= CREATE USER LOGS ACTIVITY ==============*/
                $this->createUserLog('account');
                $this->createUserActivity('update');
                /*============= END CREATE USER LOGS ACTIVITY ==============*/
                
                return redirect()->back()->with('success', "Modification compte effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Erreur Modification Compte. Veuillez réessayer plus tard !");
            }

        } else {
            //$this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = ucfirst('Mise à jour profile');
            $data['_view'] = ('profile/account');
            echo view('layouts/main', $data);
        }
    }

    function updateSecurity($useruidtoken)
    {

        $useruid = (!empty($useruidtoken)) ? $useruidtoken : $this->session->usertoken;
        $data["user"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            array('user_id' => $useruid), 'user_created_at', 'DESC', TRUE);

        $rulers = [
            'question1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez selectionnez une question',
                ]
            ], 'question2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez selectionnez une question',
                ]
            ], 'question3' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez selectionnez une question',
                ]
            ], 'reponse1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir la réponse ',
                ]
            ], 'reponse2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir la réponse ',
                ]
            ], 'reponse3' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir la réponse ',
                ]
            ], 
        ];

        //run the validation rulers
        if ($this->validate($rulers)) {
            $current_datetime = date('Y-m-d H:i:s');
            if($this->request->getPost('page') == 'create'){
                $security_data = [
                    'security_question_1' => (($this->request->getPost('question1'))),
                    'security_question_2' => (($this->request->getPost('question2'))),
                    'security_question_3' => (($this->request->getPost('question3'))),
                    'security_response_1' => (($this->request->getPost('reponse1'))),
                    'security_response_2' => (($this->request->getPost('reponse2'))),
                    'security_response_3' => (($this->request->getPost('reponse3'))),
                    'security_created_at' => $current_datetime,
                    'security_user_id' => $useruid,
                    'security_status' => 'actif',
                    'security_token' => setPrimaryKey(),
                    'security_code' => setReferenceCode(),
                ];
                //update data in table
                if ($this->model->insert_data('users_security', $security_data)) {
                    
                    /*============= CREATE USER LOGS ACTIVITY ==============*/
                    $this->createUserLog('account');
                    $this->createUserActivity('security');
                    /*============= END CREATE USER LOGS ACTIVITY ==============*/
                    
                    return redirect()->back()->with('success', "Création paramètre de sécurité effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard !");
                } 
            }else{
                $updateTypeData = [
                    'security_question_1' => (($this->request->getPost('question1'))),
                    'security_question_2' => (($this->request->getPost('question2'))),
                    'security_question_3' => (($this->request->getPost('question3'))),
                    'security_response_1' => (($this->request->getPost('reponse1'))),
                    'security_response_2' => (($this->request->getPost('reponse2'))),
                    'security_response_3' => (($this->request->getPost('reponse3'))),
                    'security_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('users_security', $updateTypeData, array('security_user_id' => $useruid))) {
                    
                    /*============= CREATE USER LOGS ACTIVITY ==============*/
                    $this->createUserLog('account');
                    $this->createUserActivity('security');
                    /*============= END CREATE USER LOGS ACTIVITY ==============*/
                    
                    return redirect()->back()->with('success', "Modification paramètre de sécurité effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification Compte. Veuillez réessayer plus tard !");
                }
            }
        } else {
            //$this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = ucfirst('Mise à jour profile');
            $data['_view'] = ('profile/security');
            echo view('layouts/main', $data);
        }
    }
}
