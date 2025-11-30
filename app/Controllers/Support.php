<?php

namespace App\Controllers;

class Support extends BaseController
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
        $data['title'] = "Centre d'aide utilisateur";
        $data['_view'] = "support/center";
        echo view('layouts/main', $data);
    }
    public function page($name = null)
    {
        $schoolid = $this->session->schoolid;
        $data['school'] = $this->model->fetch_row_data('schools', array('school_id' => $schoolid));

        if (!empty($name)) {
            $data['title'] = "Support - " . $name;
            $data['_view'] = "support/" . $name;
            echo view('layouts/main', $data);
        }
    }
    function schoolFeedbackUser()
    {
        if ($this->request->getPost()) {
            
            $data = [];
            $fullpathAvatar='';
            if ($this->request->getFile('attachfile')) {
                //if ($this->validate($rulers)) {
                $logoFile = $this->request->getFile('attachfile');
                //foreach($imagefile['images'] as $img){
                if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                    //rename image
                    $newNameLogoFileUpload = $logoFile->getRandomName();
                    $fullPathFile = 'public/uploads/files';
                    //move to upload directory
                    $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                    $fullpathAvatar = $fullPathFile . '/' . $newNameLogoFileUpload;

                }
            } else {
                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = "Feedback";
                $data['_view'] = "support/feedback";
                echo view('layouts/main', $data);
            }

            $school_phone = $this->session->schoolphone;
            $school_email = $this->session->schoolemail;
            $school_name = $this->session->schoolfname;
            $user_name = $this->session->name;
            $user_email = $this->session->email;
            $message_file = $fullpathAvatar;
            $notes_content = $this->request->getFile('notes');

            if (!empty($user_email)) {
                //send credentials
                $email_content = "<h3>Feedback de l'agent $user_name de l'établissement $school_name</h3> 
                <p>$notes_content</p> <p>Contacts école - <b>Téléphone: $school_phone | E-mail: $school_email</b></p>";

                if($this->sendEmail('magschool@ditotase.com', "Feedback de l'école $school_name", $email_content, null, null, $message_file, $school_email)){
                    return redirect()->back()->with('success', "Votre suggestion a été envoyé avec succés. Merci !");
                }  
                
            }

        } else {
            return redirect()->back()->with('failed', "Veuillez remplir le formulaire");
        }

    }
}