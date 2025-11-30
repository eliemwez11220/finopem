<?php

namespace App\Controllers;

class Message extends BaseController
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
        $data['title'] = "Messages";
        $data['_view'] = "messages/listing";
        echo view('layouts/main', $data);
    }
    public function page($name = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');
        $data['contacts'] = $this->model->fetch_all_data('contacts', array('contact_deleted_at' => null, 'contact_school_id' => $schoolid), 'contact_created_at');
        $data['sections'] = $this->model->fetch_all_data('sections', array('section_school_id' => $schoolid), 'section_created_at');
      
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        if (($name == 'systems')) {

            $data["users"] = $this->join->fetch_users_sections(array('branch_status' => 'actif', 'branch_school_id' => $schoolid), '*');

            //$data["users"] = $this->join->fetch_join_data('users', 'users_roles', ('users_roles.role_id = users.user_role_id'),
            //array('user_school_id'=>$schoolid), 'user_created_at', 'DESC');
        }
        if (!empty($name)) {

            //dd($data["userssections"]);

            $data['title'] = "Message - " . $name;
            $data['_view'] = "messages/" . $name;
            echo view('layouts/main', $data);
        }
    }
    public function sendEmailComposition()
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');

        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));

        $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        //$data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');  

        $rulers = [
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Objet obligatoire',
                ]
            ],
            'message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Message obligatoire',
                ]
            ],
            'parent' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Parent obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            if ((!session()->has('attachment'))) {
                if ($this->request->getFile('attachment')) {
                    $slip_file = $this->request->getFile('attachment');
                    if ($slip_file->isValid() && !$slip_file->hasMoved()) {

                        $slip_file_name = $slip_file->getRandomName();//rename file
                        $fullPathFile = 'public/uploads/files';

                        $slip_file->move(ROOTPATH . $fullPathFile, $slip_file_name);//move to upload directory

                        if (file_exists(ROOTPATH . $fullPathFile . '/' . $slip_file_name)) {

                            session()->set('msgfile', $slip_file_name);

                        }

                    }
                }
            }
            $subject = (($this->request->getPost('subject')));
            $message = (($this->request->getPost('message')));
            $parent_id = (($this->request->getPost('parent')));
            $school_name = $this->session->schoolfname;
            $school_phone = $this->session->schoolphone;
            $school_email = $this->session->schoolemail;
            $year_name = $this->session->schoolyear;
            $message_file = session()->get('msgfile');

            if ($parent_id != 'all') {
                //GET PARENTS DATA
                $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $schoolid, 'parent_id' => $parent_id));

                if (!empty($parent_data)) {

                    $parent_father = $parent_data['parent_father_name'];
                    $parent_mather = $parent_data['parent_mother_name'];
                    $parent_tutor = $parent_data['parent_tutor_name'];
                    $emergency = $parent_data['parent_emergency'];
                    $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;
                    $parent_email = $parent_data['parent_primary_email'];
                    //$parent_phone = $parent_data['parent_primary_phone'];
                    //table data
                    $message_token = setPrimaryKey();
                    $messages_sending_data = [
                        'message_token' => $message_token,
                        'message_code' => setReferenceCode(),
                        'message_sender' => $school_email,
                        'message_recipient' => $parent_email,
                        'message_subject' => $subject,
                        'message_body' => $message,
                        'message_status' => 'actif',
                        'message_type' => 'email',
                        'message_category' => 'parent',
                        'message_created_at' => date('Y-m-d H:i:s'),
                        'message_attachment' => session()->get('msgfile'),
                        'message_school_id' => $schoolid,
                        'message_section_id' => $this->session->choosedsectionid,
                    ];
                    if ($this->model->insert_data('messages', $messages_sending_data)) {
                        if (!empty($parent_email)) {
                            //send credentials
                            $email_content = " $message
                            <hr/>
                            <p>Cher parent $parent_names vous recevez ce message car vous etes indiqué en tant que responsable direct des enfants inscrits à notre <b>école $school_name pour l'année $year_name</b></p> 
                            <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                            if ($this->sendEmail($parent_email, "$subject de l'école $school_name", $email_content, null, null, $message_file, $school_email)) {

                                //update message status
                                $message_update = array(
                                    'message_status' => 'send',
                                    'message_updated_at' => date('Y-m-d H:i:s'),
                                );
                                $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                            }
                        }
                        session()->remove('msgfile'); // DESTROY MESSAGE FILE IN SESSION
                        return redirect()->back()->with('success', "Message envoyé avec succés !");

                    } else {
                        return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                } else {
                    return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                }
            } else {
                //ALL PARENTS 

                $parents_all_data = $this->join->fetch_students_data(array('inscription_year_id' => $yearid, 'student_school_id' => $schoolid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');

                $all_parents = array();
                $send_status = 0;
                //CHECK IF PARENTS IS FILTERED BY CLASSE
                if (session()->has('parentsclasses')) {

                    $all_parents = session()->get('parentsclasses');

                } else {

                    $all_parents = $parents_all_data;

                }
                if (!empty($all_parents)) {
                    foreach ($all_parents as $allparent) {
                        $parent_father = $allparent['parent_father_name'];
                        $parent_mather = $allparent['parent_mother_name'];
                        $parent_tutor = $allparent['parent_tutor_name'];
                        $emergency = $allparent['parent_emergency'];
                        $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;
                        $parent_email = $allparent['parent_primary_email'];
                        //$parent_phone = $parent_data['parent_primary_phone'];
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_email,
                            'message_recipient' => $parent_email,
                            'message_subject' => $subject,
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'email',
                            'message_category' => 'parent',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_attachment' => session()->get('msgfile'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $this->session->choosedsectionid,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($parent_email)) {
                                //send credentials
                                $email_content = "
                                
                                $message
                                
                                <hr/>
                                <p>Cher parent $parent_names vous recevez ce message car vous etes indiqué en tant que responsable direct des enfants inscrits à notre <b>école $school_name pour l'année $year_name</b></p> 
                                
                                <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                                if ($this->sendEmail($parent_email, "$subject de l'école $school_name", $email_content, null, null, $message_file, $school_email)) {
                                    $send_status = 1;
                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                }
                            }
                        }
                    }
                    if ($send_status == 1) {

                        session()->remove('msgfile'); // DESTROY MESSAGE FILE IN SESSION
                        return redirect()->back()->with('success', "Message broadcast envoyé avec succés !");

                    } else {
                        return redirect()->back()->with('failed', "Message non broadcast envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                }
            }
        } else {
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = "Emailling Message";
            $data['_view'] = "messages/emails";
            echo view('layouts/main', $data);
        }
    }
    public function sendSMSComposition()
    {
        $sending_status = session()->has('schoolsmsstatus') ? session()->get('schoolsmsstatus') : 0;

        if ($sending_status == 1) {

            $data = [];
            $schoolid = $this->session->schoolid;
            $yearid = $this->session->yearid;
            $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');

            $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));

            $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');

            $rulers = [
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message obligatoire',
                    ]
                ],
                'parent' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Parent obligatoire',
                    ]
                ],
            ];

            if ($this->validate($rulers)) {

                $subject = 'SMS';
                $message = (($this->request->getPost('message')));
                $parent_id = (($this->request->getPost('parent')));
                $school_sender_name = $this->session->schoolsmssender;
                $school_name = $this->session->schoolfname;
                $school_phone = $this->session->schoolphone;
                $school_email = $this->session->schoolemail;
                $year_name = $this->session->schoolyear;

                //$sms_counter = strlen($message);

                if ($parent_id != 'all') {
                    //GET PARENTS DATA
                    $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $schoolid, 'parent_id' => $parent_id));

                    if (!empty($parent_data)) {

                        $parent_father = $parent_data['parent_father_name'];
                        $parent_mather = $parent_data['parent_mother_name'];
                        $parent_tutor = $parent_data['parent_tutor_name'];
                        $emergency = $parent_data['parent_emergency'];
                        $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;
                        $parent_phone = $parent_data['parent_primary_phone'];
                        //table data
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_email,
                            'message_recipient' => $parent_phone,
                            'message_subject' => $subject,
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'sms',
                            'message_category' => 'parent',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $this->session->choosedsectionid,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($parent_phone)) {

                                $message_content = "$message. Infoline: $school_phone";

                                $sms_counter_content = strlen($message_content);

                                if ($this->sendSMS($parent_phone, $message_content, $school_sender_name)) {

                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                    //UPDATE SMS PACK
                                    $this->updateSMSSchool($sms_counter_content);

                                }
                            }
                            return redirect()->back()->with('success', "Message envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                    }
                } else {
                    //ALL PARENTS 

                    $parents_all_data = $this->join->fetch_students_data(array('inscription_year_id' => $yearid, 'student_school_id' => $schoolid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');

                    $all_parents = array();
                    $send_status = 0;
                    //CHECK IF PARENTS IS FILTERED BY CLASSE
                    if (session()->has('parentsclasses')) {

                        $all_parents = session()->get('parentsclasses');

                    } else {

                        $all_parents = $parents_all_data;

                    }
                    if (!empty($all_parents)) {
                        foreach ($all_parents as $allparent) {
                            $parent_father = $allparent['parent_father_name'];
                            $parent_mather = $allparent['parent_mother_name'];
                            $parent_tutor = $allparent['parent_tutor_name'];
                            $emergency = $allparent['parent_emergency'];
                            $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;
                            //$parent_email = $allparent['parent_primary_email'];
                            $parent_phone = $allparent['parent_primary_phone'];
                            $message_token = setPrimaryKey();
                            $messages_sending_data = [
                                'message_token' => $message_token,
                                'message_code' => setReferenceCode(),
                                'message_sender' => $school_sender_name,
                                'message_recipient' => $parent_phone,
                                'message_subject' => $subject,
                                'message_body' => $message,
                                'message_status' => 'actif',
                                'message_type' => 'sms',
                                'message_category' => 'parent',
                                'message_created_at' => date('Y-m-d H:i:s'),
                                'message_school_id' => $schoolid,
                                'message_section_id' => $this->session->choosedsectionid,
                            ];
                            if ($this->model->insert_data('messages', $messages_sending_data)) {
                                if (!empty($parent_phone)) {
                                    $message_content = "$message . Cher parent $parent_names, vous recevez pour vos enfants inscrits à l'école $school_name en $year_name. Infoline: $school_phone";
                                    $sms_counter_content = strlen($message_content);
                                    if ($this->sendSMS($parent_phone, $message_content, $school_sender_name)) {
                                        //update message status
                                        $message_update = array(
                                            'message_status' => 'send',
                                            'message_updated_at' => date('Y-m-d H:i:s'),
                                        );
                                        $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                                        $send_status = 1;

                                        //UPDATE SMS PACK
                                        $this->updateSMSSchool($sms_counter_content);
                                    }
                                }
                            }
                        }
                        if ($send_status == 1) {

                            return redirect()->back()->with('success', "Message broadcast envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non broadcast envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    }
                }
            } else {
                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "SMS Messaging";
                $data['_view'] = "messages/sms";
                echo view('layouts/main', $data);
            }
        } else {
            return redirect()->back()->with('failed', "L'envoi des messages est temporairement suspendu !");
        }
    }
    public function sendingActivation()
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'parent_father_name', 'ASC', 'student_parent_id');
        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));

        $rulers = [
            'sms' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nombre de sms obligatoire',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Statut obligatoire',
                ]
            ],
            'sender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom expediteur obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {

            $status = (($this->request->getPost('status')));
            $sender = (($this->request->getPost('sender')));
            $sms = (($this->request->getPost('sms')));

            $messages_sending_data = [
                'school_sms_sender' => $sender,
                'school_sms_number' => $sms,
                'school_sms_sending' => $status,
            ];
            if ($this->model->update_data('schools', $messages_sending_data, array('school_id' => $schoolid))) {
                //UPDATE SESSION DATA
                session()->set('schoolsmscount', $sms);
                session()->set('schoolsmsstatus', $status);
                session()->set('schoolsmssender', $sender);

                return redirect()->back()->with('success', "Mise à jour effectuée avec succés !");

            } else {
                return redirect()->back()->with('failed', "Mise à jour non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
            }
        } else {
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = "Messaging Activation";
            $data['_view'] = "messages/packs";
            echo view('layouts/main', $data);
        }
    }
    public function sendDraftMessage($message_token = null)
    {
        $schoolid = $this->session->schoolid;
        if (!empty($message_token)) {
            $message_data = $this->model->fetch_row_data('messages', array('message_school_id' => $schoolid, 'message_token' => $message_token));
            if (!empty($message_data)) {
                $subject = $message_data['message_subject'];
                $message = $message_data['message_body'];
                $message_file = $message_data['message_attachment'];
                $message_type = $message_data['message_type'];

                $recipient = $message_data['message_recipient'];
                $sender = $message_data['message_sender'];
                $school_name = $this->session->schoolname;
                $school_phone = $this->session->schoolphone;
                $school_email = $this->session->schoolemail;
                $year_name = $this->session->schoolyear;
                if (!empty($recipient)) {
                    if ($message_type == 'sms') {

                        $sms_counter = strlen($message);

                        if ($this->sendSMS($recipient, $message, $school_name)) {
                            //update message status
                            $message_update = array(
                                'message_status' => 'send',
                                'message_updated_at' => date('Y-m-d H:i:s'),
                            );
                            $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                            //UPDATE SMS PACK

                            $this->updateSMSSchool($sms_counter);

                            return redirect()->back()->with('success', "Message envoyé avec succés !");
                        }
                    } else {
                        $email_content = " $message <hr/>
                        <p>Cher parent, vous recevez ce message de la part de $sender car vous etes indiqué en tant que responsable direct des enfants inscrits à notre <b>école $school_name pour l'année $year_name</b></p> 
                        <hr/>
                        <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                        if ($this->sendEmail($recipient, "$subject de l'école $school_name", $email_content, null, null, $message_file, $school_email)) {
                            //update message status
                            $message_update = array(
                                'message_status' => 'send',
                                'message_updated_at' => date('Y-m-d H:i:s'),
                            );
                            $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                            return redirect()->back()->with('success', "Email envoyé avec succés !");
                        }
                    }
                } else {
                    return redirect()->back()->with('failed', "Message non envoyé. Destinataire introuvable !");
                }
            } else {
                return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
            }
        } else {
            return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
        }
    }
    public function sendUsersMessaging()
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        $data["users"] = $this->join->fetch_users_sections(array('branch_status' => 'actif', 'branch_school_id' => $schoolid), '*');


        $user_id = trim($this->request->getPost('user'));
        //SMS SENDER
        $sms = trim($this->request->getPost('sms'));
        if (!empty($sms)) {

            $this->sendUsersSMS($sms, $user_id);

        }
        if ($this->request->getPost('message')) {
            $rulers = [
                'subject' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Objet obligatoire',
                    ]
                ],
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message obligatoire',
                    ]
                ],
                'user' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Utilisateur obligatoire',
                    ]
                ],
            ];

            if ($this->validate($rulers)) {
                if ((!session()->has('attachment'))) {
                    if ($this->request->getFile('attachment')) {
                        $slip_file = $this->request->getFile('attachment');
                        if ($slip_file->isValid() && !$slip_file->hasMoved()) {

                            $slip_file_name = $slip_file->getRandomName();//rename file
                            $fullPathFile = 'public/uploads/files';

                            $slip_file->move(ROOTPATH . $fullPathFile, $slip_file_name);//move to upload directory

                            if (file_exists(ROOTPATH . $fullPathFile . '/' . $slip_file_name)) {

                                session()->set('msgfile', $slip_file_name);

                            }
                        }
                    }
                }



                $subject = trim($this->request->getPost('subject'));
                $message = trim($this->request->getPost('message'));

                $school_name = $this->session->schoolfname;
                $school_phone = $this->session->schoolphone;
                $school_email = $this->session->schoolemail;
                $year_name = $this->session->schoolyear;
                $message_file = session()->get('msgfile');

                if ($user_id != 'all') {
                    //GET USERS DATA
                    $user_data = $this->model->fetch_row_data('users', array('user_school_id' => $schoolid, 'user_id' => $user_id));

                    if (!empty($user_data)) {
                        $user_name = $user_data['user_name'];
                        $user_email = $user_data['user_email'];
                        //$user_phone = $user_data['user_phone'];

                        //table data
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_email,
                            'message_recipient' => $user_email,
                            'message_subject' => $subject,
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'email',
                            'message_category' => 'system',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_attachment' => session()->get('msgfile'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $this->session->choosedsectionid,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($user_email)) {
                                //send credentials
                                $email_content = " $message
                                <hr/>
                                <p>Cher utilisateur $user_name vous recevez ce message car vous etes agent de notre <b>école $school_name pour l'année $year_name</b></p> 
                                <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                                if ($this->sendEmail($user_email, "$subject de l'école $school_name", $email_content, null, null, $message_file, $school_email)) {

                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                }
                            }
                            session()->remove('msgfile'); // DESTROY MESSAGE FILE IN SESSION
                            return redirect()->back()->with('success', "Message envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                    }
                } else {
                    //ALL users 

                    $users_all_data = $data["users"];

                    $send_status = 0;

                    if (!empty($users_all_data)) {
                        foreach ($users_all_data as $user_data) {
                            $user_name = $user_data['user_name'];
                            $user_email = $user_data['user_email'];
                            //$user_phone = $user_data['user_phone'];
                            $message_token = setPrimaryKey();
                            $messages_sending_data = [
                                'message_token' => $message_token,
                                'message_code' => setReferenceCode(),
                                'message_sender' => $school_email,
                                'message_recipient' => $user_email,
                                'message_subject' => $subject,
                                'message_body' => $message,
                                'message_status' => 'actif',
                                'message_type' => 'email',
                                'message_category' => 'system',
                                'message_created_at' => date('Y-m-d H:i:s'),
                                'message_attachment' => session()->get('msgfile'),
                                'message_school_id' => $schoolid,
                                'message_section_id' => $this->session->choosedsectionid,
                            ];
                            if ($this->model->insert_data('messages', $messages_sending_data)) {
                                if (!empty($user_email)) {
                                    //send credentials
                                    $email_content = "
                                    
                                    $message
                                    
                                    <hr/>
                                    <p>Cher utilisateur $user_name vous recevez ce message car vous etes agent de notre <b>école $school_name pour l'année $year_name</b></p> 
                                    
                                    <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                                    if ($this->sendEmail($user_email, "$subject de l'école $school_name", $email_content, null, null, $message_file, $school_email)) {
                                        $send_status = 1;
                                        //update message status
                                        $message_update = array(
                                            'message_status' => 'send',
                                            'message_updated_at' => date('Y-m-d H:i:s'),
                                        );
                                        $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                    }
                                }
                            }
                        }
                        if ($send_status == 1) {

                            session()->remove('msgfile'); // DESTROY MESSAGE FILE IN SESSION
                            return redirect()->back()->with('success', "Message broadcast envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non broadcast envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    }
                }
            } else {
                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Emailling Message";
                $data['_view'] = "messages/systems";
                echo view('layouts/main', $data);
            }
        } else {

            return redirect()->back()->withInput();

        }
    }

    public function sendUsersSMS($sms = null, $recipients = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $section_id = $this->session->choosedsectionid;
        $data['messages'] = $this->model->fetch_all_data('messages', array('message_deleted_at' => null, 'message_school_id' => $schoolid), 'message_created_at');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        $data["users"] = $this->join->fetch_users_sections(array('branch_status' => 'actif', 'branch_school_id' => $schoolid), '*');


        if (!empty($sms) && (!empty($recipients))) {

            $message = $sms;
            $user_id = $recipients;
            $subject = 'SMS';
            $school_sender_name = $this->session->schoolsmssender;

            if ($user_id != 'all') {
                //GET USERS DATA
                $user_data = $this->model->fetch_row_data('users', array('user_school_id' => $schoolid, 'user_id' => $user_id));

                if (!empty($user_data)) {
                    $user_name = $user_data['user_firstname'] . ' ' . $user_data['user_lastname'];
                    $user_phone = $user_data['user_phone'];

                    //table data
                    $message_token = setPrimaryKey();
                    $messages_sending_data = [
                        'message_token' => $message_token,
                        'message_code' => setReferenceCode(),
                        'message_sender' => $school_sender_name,
                        'message_recipient' => $user_phone,
                        'message_subject' => $subject . ' to ' . $user_name,
                        'message_body' => $message,
                        'message_status' => 'actif',
                        'message_type' => 'email',
                        'message_category' => 'system',
                        'message_created_at' => date('Y-m-d H:i:s'),
                        'message_attachment' => session()->get('msgfile'),
                        'message_school_id' => $schoolid,
                        'message_section_id' => $section_id,
                    ];
                    if ($this->model->insert_data('messages', $messages_sending_data)) {
                        if (!empty($user_phone)) {

                            $message_content = "$message";
                            $sms_counter_content = strlen($message_content);

                            if ($this->sendSMS($user_phone, $message_content, $school_sender_name)) {
                                //update message status
                                $message_update = array(
                                    'message_status' => 'send',
                                    'message_updated_at' => date('Y-m-d H:i:s'),
                                );
                                $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                                $send_status = 1;

                                //UPDATE SMS PACK
                                $this->updateSMSSchool($sms_counter_content);
                                return redirect()->back()->with('success', "Message envoyé avec succés !");

                            }
                        }
                        return redirect()->back()->with('success', "Message enregistré dans le bruillon!");


                    } else {
                        return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                } else {
                    return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                }
            } else {
                //ALL users 

                $users_all_data = $data["users"];

                $send_status = 0;

                if (!empty($users_all_data)) {
                    foreach ($users_all_data as $user_data) {
                        $user_name = $user_data['user_firstname'] . ' ' . $user_data['user_lastname'];
                        $user_phone = $user_data['user_phone'];
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_sender_name,
                            'message_recipient' => $user_phone,
                            'message_subject' => $subject . ' to ' . $user_name,
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'email',
                            'message_category' => 'system',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_attachment' => session()->get('msgfile'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $section_id,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($user_phone)) {

                                $message_content = "$message";
                                $sms_counter_content = strlen($message_content);

                                if ($this->sendSMS($user_phone, $message_content, $school_sender_name)) {
                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                                    $send_status = 1;

                                    //UPDATE SMS PACK
                                    $this->updateSMSSchool($sms_counter_content);

                                }
                            }

                        }
                    }
                    if ($send_status == 1) {

                        return redirect()->back()->with('success', "Message envoyé avec succés !");

                    } else {
                        return redirect()->back()->with('success', "Message enregistré dans le bruillon!");

                    }
                }
            }
        } else {
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = "Emailling Message";
            $data['_view'] = "messages/systems";
            echo view('layouts/main', $data);
        }
    }

    function createContact()
    {
        $school_id = $this->session->schoolid;
        $section_id = $this->session->choosedsectionid;

        $rulers = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom obligatoire',
                ],
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Telephone obligatoire',
                ],
            ],
        ];

        if ($this->validate($rulers)) {
            $phone = trim($this->request->getPost('phone'));
            $name = trim($this->request->getPost('name'));
            $email = trim($this->request->getPost('email'));
            $title = trim($this->request->getPost('title'));
            $address = trim($this->request->getPost('address'));
            $token = trim($this->request->getPost('token'));

            if(!empty($token)){
                $contact_update = [
                    'contact_name' => $name,
                    'contact_title' => $title,
                    'contact_address' => $address,
                    'contact_phone' => $phone,
                    'contact_email' => $email,
                    'contact_updated_at' => date('Y-m-d H:i:s'),
                ];
    
                //create new tuteur
                if ($this->model->update_data('contacts', $contact_update, ['contact_token' => $token] )) {
    
                    return redirect()->back()->with('success', "Contact $name modifié avec succés");
    
                } else{

                    return redirect()->back()->with('failed', "Modification non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                
                }
            }

            $contact_data = [
                'contact_token' => setPrimaryKey(),
                'contact_code' => setReferenceCode(),
                'contact_name' => $name,
                'contact_title' => $title,
                'contact_status' => 'actif',
                'contact_address' => $address,
                'contact_phone' => $phone,
                'contact_email' => $email,
                'contact_created_at' => date('Y-m-d H:i:s'),
                'contact_section_id' => $section_id,
                'contact_school_id' => $school_id,
            ];

            //create new tuteur
            if ($this->model->insert_data('contacts', $contact_data)) {

                return redirect()->back()->with('success', "Contact $name enregistré avec succés");

            } else {
                return redirect()->back()->with('failed', "Enregistrement non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
            }
        } else {
            return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
        }
    }
    //
    public function sendBroadcast()
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $section_id = $this->session->choosedsectionid;
        $data['contacts'] = $this->model->fetch_all_data('contacts', array('contact_status' => 'actif', 'contact_school_id' => $schoolid), 'contact_created_at');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        

        $contact_id = trim($this->request->getPost('contact'));
        //SMS SENDER
        $sms = trim($this->request->getPost('sms'));

        if (!empty($sms)) {

            $this->sendContactSMS($sms, $contact_id);

        }
        if ($this->request->getPost('message')) {
            $rulers = [
                'contact' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Objet obligatoire',
                    ]
                ],
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message obligatoire',
                    ]
                ],
            ];

            if ($this->validate($rulers)) {
                
                $message = trim($this->request->getPost('message'));

                $school_name = $this->session->schoolfname;
                $school_phone = $this->session->schoolphone;
                $school_email = $this->session->schoolemail;
                $year_name = $this->session->schoolyear;

                if ($contact_id != 'all') {
                    //GET USERS DATA
                    $user_data = $this->model->fetch_row_data('contacts', array('contact_school_id' => $schoolid, 'contact_id' => $contact_id));

                    if (!empty($user_data)) {
                        $user_name = $user_data['contact_name'];
                        $user_email = $user_data['contact_email'];
                        //$user_phone = $user_data['user_phone'];

                        //table data
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_email,
                            'message_recipient' => $user_email,
                            'message_subject' => $user_name,
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'email',
                            'message_category' => 'system',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $section_id,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($user_email)) {
                                //send credentials
                                $email_content = " $message
                                <hr/>
                                <p>$user_name vous recevez ce message car vous etes agent de notre <b>école $school_name pour l'année $year_name</b></p> 
                                <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                                if ($this->sendEmail($user_email, "Email de l'école $school_name", $email_content, null, null, null, $school_email)) {

                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                }
                            }
                            session()->remove('msgfile'); // DESTROY MESSAGE FILE IN SESSION
                            return redirect()->back()->with('success', "Message envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                    }
                } else {
                    //ALL users 

                    $users_all_data = $data["contacts"];

                    $send_status = 0;

                    if (!empty($users_all_data)) {
                        foreach ($users_all_data as $user_data) {
                            $user_name = $user_data['contact_name'];
                            $user_email = $user_data['contact_email'];
                            //$user_phone = $user_data['user_phone'];
                            $message_token = setPrimaryKey();
                            $messages_sending_data = [
                                'message_token' => $message_token,
                                'message_code' => setReferenceCode(),
                                'message_sender' => $school_email,
                                'message_recipient' => $user_email,
                                'message_subject' => $user_name,
                                'message_body' => $message,
                                'message_status' => 'actif',
                                'message_type' => 'email',
                                'message_category' => 'system',
                                'message_created_at' => date('Y-m-d H:i:s'),
                                'message_school_id' => $schoolid,
                                'message_section_id' => $section_id,
                            ];
                            if ($this->model->insert_data('messages', $messages_sending_data)) {
                                if (!empty($user_email)) {
                                    //send credentials
                                    $email_content = "
                                    
                                    $message
                                    
                                    <hr/>
                                    <p>$user_name vous recevez ce message car vous etes agent de notre <b>école $school_name pour l'année $year_name</b></p> 
                                    
                                    <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                                    if ($this->sendEmail($user_email, "Infos de l'école $school_name", $email_content, null, null, null, $school_email)) {
                                        $send_status = 1;
                                        //update message status
                                        $message_update = array(
                                            'message_status' => 'send',
                                            'message_updated_at' => date('Y-m-d H:i:s'),
                                        );
                                        $this->model->update_data('messages', $message_update, array('message_token' => $message_token));

                                    }
                                }
                            }
                        }
                        if ($send_status == 1) {

                            return redirect()->back()->with('success', "Message broadcast envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non broadcast envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    }
                }
            } else {
                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Emailling Message";
                $data['_view'] = "messages/broadcast";
                echo view('layouts/main', $data);
            }
        } else {

            return redirect()->back()->withInput();

        }
    }
    public function sendContactSMS($sms = null, $contact_id = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $section_id = $this->session->choosedsectionid;
        $data['contacts'] = $this->model->fetch_all_data('contacts', array('contact_status' => 'actif', 'contact_school_id' => $schoolid), 'contact_created_at');
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));
        
     

            if (!empty($sms) && (!empty($contact_id))) {
                
                $message = $sms;

                $school_name = $this->session->schoolfname;
                $school_phone = $this->session->schoolphone;
                $school_email = $this->session->schoolemail;
                $year_name = $this->session->schoolyear;

                $school_sender_name = $this->session->schoolsmssender;


                if ($contact_id != 'all') {
                    //GET USERS DATA
                    $user_data = $this->model->fetch_row_data('contacts', array('contact_school_id' => $schoolid, 'contact_id' => $contact_id));

                    if (!empty($user_data)) {
                        $user_name = $user_data['contact_name'];
                        $user_email = $user_data['contact_email'];
                        $user_phone = $user_data['contact_phone'];

                        //table data
                        $message_token = setPrimaryKey();
                        $messages_sending_data = [
                            'message_token' => $message_token,
                            'message_code' => setReferenceCode(),
                            'message_sender' => $school_sender_name,
                            'message_recipient' => $user_phone,
                            'message_subject' => "SMS TO $user_name",
                            'message_body' => $message,
                            'message_status' => 'actif',
                            'message_type' => 'sms',
                            'message_category' => 'system',
                            'message_created_at' => date('Y-m-d H:i:s'),
                            'message_school_id' => $schoolid,
                            'message_section_id' => $section_id,
                        ];
                        if ($this->model->insert_data('messages', $messages_sending_data)) {
                            if (!empty($user_phone)) {

                                $message_content = "$message";
                                $sms_counter_content = strlen($message_content);

                                if ($this->sendSMS($user_phone, $message_content, $school_sender_name)) {
                                    //update message status
                                    $message_update = array(
                                        'message_status' => 'send',
                                        'message_updated_at' => date('Y-m-d H:i:s'),
                                    );
                                    $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                                    $send_status = 1;

                                    //UPDATE SMS PACK
                                    $this->updateSMSSchool($sms_counter_content);

                                }
                            }
                            return redirect()->back()->with('success', "Message envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Vous devez choisir au moins un parent dans la liste des parents");
                    }
                } else {
                    //ALL users 

                    $users_all_data = $data["contacts"];

                    $send_status = 0;

                    if (!empty($users_all_data)) {
                        foreach ($users_all_data as $user_data) {
                            $user_name = $user_data['contact_name'];
                            $user_email = $user_data['contact_email'];
                            $user_phone = $user_data['contact_phone'];
                            $message_token = setPrimaryKey();
                            $messages_sending_data = [
                                'message_token' => $message_token,
                                'message_code' => setReferenceCode(),
                                'message_sender' => $school_sender_name,
                                'message_recipient' => $user_phone,
                                'message_subject' => "SMS TO $user_name",
                                'message_body' => $message,
                                'message_status' => 'actif',
                                'message_type' => 'sms',
                                'message_category' => 'system',
                                'message_created_at' => date('Y-m-d H:i:s'),
                                'message_section_id' => $section_id,
                                'message_school_id' => $schoolid,
                            ];
                            if ($this->model->insert_data('messages', $messages_sending_data)) {
                                if (!empty($user_phone)) {

                                    $message_content = "$message";
                                    $sms_counter_content = strlen($message_content);
    
                                    if ($this->sendSMS($user_phone, $message_content, $school_sender_name)) {
                                        //update message status
                                        $message_update = array(
                                            'message_status' => 'send',
                                            'message_updated_at' => date('Y-m-d H:i:s'),
                                        );
                                        $this->model->update_data('messages', $message_update, array('message_token' => $message_token));
                                        $send_status = 1;
    
                                        //UPDATE SMS PACK
                                        $this->updateSMSSchool($sms_counter_content);
    
                                    }
                                }
                            }
                        }
                        if ($send_status == 1) {

                            return redirect()->back()->with('success', "Message broadcast envoyé avec succés !");

                        } else {
                            return redirect()->back()->with('failed', "Message non broadcast envoyé suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    }
                }
            } else {
                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Emailling Message";
                $data['_view'] = "messages/broadcast";
                echo view('layouts/main', $data);
            }
       
    }
}