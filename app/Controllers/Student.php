<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(base_url('logout')); // redirect to login page if not connected
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
        $data = [];
        $schoolid = $this->session->schoolid;
        $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid));
        $data['title'] = "Dossiers scolaires";
        $data['_view'] = "student/listing";
        echo view('layouts/main', $data);
    }

    public function page($name_page = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        switch ($name_page) {
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
            case 'registration':
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
                $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $schoolid), 'parent_tutor_name', null, null, 'ASC');

                //$data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'student_created_at', 'DESC');
                $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), 'student_code', TRUE, 'student_created_at', 'DESC');

                $data['quartiers'] = $this->model->fetch_all_data('address_district', array('district_school_id' => $schoolid), 'district_name', null, null, 'ASC');
                $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $schoolid), 'municipality_name', null, null, 'ASC');
                $data['zones'] = $this->model->fetch_all_data('address', array('address_school_id' => $schoolid), 'address_area_name', null, null, 'ASC');

                break;
            case 'listing':
            case 'parcours':
            case 'basculement':
                $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid));
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');
                $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
                break;
            case 'address':
                $data['quartiers'] = $this->join->fetch_join_data('address_district', 'address_municipality', 'municipality_id = district_municipality_id', array('district_school_id' => $schoolid), 'district_created_at');
                $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $schoolid), 'municipality_created_at');
                //$data['zones'] = $this->join->fetch_address(array('address_school_id' => $schoolid), '*', FALSE, 'address_created_at');
                break;
            default:
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
                $data['degrees'] = $this->model->fetch_all_data('classes_degrees', array('degree_school_id' => $schoolid), 'degree_created_at');
                $data['options'] = $this->join->fetch_join_data('classes_options', 'sections', 'section_id = option_section_id', array('option_school_id' => $schoolid), 'option_created_at');
                $data['parents'] = $this->join->fetch_students_data(array('parent_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', false, 'parent_father_name', 'ASC');
        }
        
        //var_dump($data['communes']); die();
        
        $data['title'] = "Dossiers Scolaires - " . $name_page;
        $data['_view'] = "student/" . $name_page;
        return view('layouts/main', $data);
    }

    public function editForm($type = null, $id = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La modification n'est pas autorisée sur une année fermée");
        } else {

            $schoolid = $this->session->schoolid;

            $data = [];
            switch ($type) {
                case 'parent':
                    $data['parent'] = $this->model->fetch_row_data('students_parents', array('parent_id' => $id));
                    $data['quartiers'] = $this->model->fetch_all_data('address_district', array('district_school_id' => $schoolid), 'district_created_at');
                    $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $schoolid), 'municipality_created_at');
                    $data['zone'] = $this->join->fetch_address(array('address_parent_id' => $id, 'address_school_id' => $schoolid), '*', TRUE, 'address_created_at');

                    break;
                case 'inscription':
                    $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_id' => $id), '*', true);
                    $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
                    $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $schoolid), 'parent_tutor_name', null, null, 'ASC');
                    break;
                default:
                    null;
            }

            //dd( $data['zone']);
            $data['title'] = "Updating " . ucfirst("$type"); // Capitalize the first letter
            $data['_view'] = 'student/edit/' . $type;
            echo view('layouts/main', $data);
        }
    }
    public function details($type = null, $id = null)
    {

        $schoolid = $this->session->schoolid;

        $data = [];
        switch ($type) {
            case 'parent':
                $data['parent'] = $this->model->fetch_row_data('students_parents', array('parent_id' => $id));
                $data['students'] = $this->join->fetch_students_data(array('student_parent_id' => $id, 'student_school_id' => $schoolid), '*', false, 'student_firstname', 'ASC', 'student_id');
                $data['address'] = $this->join->fetch_address(array('address_parent_id' => $id, 'address_school_id' => $schoolid), '*', TRUE, 'address_created_at');

                break;
            case 'inscription':
                $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_id' => $id), '*', true);
                $student = $data['student']['student_id'];
                $data['documents'] = $this->join->fetch_join_data('students_documents', 'students', 'students.student_id = students_documents.document_student_id', array('document_school_id' => $schoolid, 'student_id' => $student), 'document_created_at');
                break;
            case 'parcours':
                $data['student'] = $this->model->fetch_row_data('students', array('student_id' => $id));
                $data['parcours'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_student_id' => $id), '*', false, 'year_started');
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
                $data['years'] = $this->model->fetch_all_data('years', array('year_deleted_at' => null, 'year_school_id' => $schoolid), 'year_created_at');
                break;
            default:
                null;
        }
        //dd( $data['address']);

        $data['title'] = "Details " . ucfirst($type); // Capitalize the first letter
        $data['_view'] = 'student/details/' . $type;
        echo view('layouts/main', $data);

    }
    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'parent':
                $realnametable = 'students_parents';
                $real_uid = 'parent_id';
                $status = 'parent_status';
                $updated_time = 'parent_updated_at';
                break;
            case 'inscription':
                $realnametable = 'students_inscriptions';
                $real_uid = 'inscription_id';
                $status = 'inscription_status';
                $updated_time = 'inscription_updated_at';
                break;
            case 'document':
                $realnametable = 'students_documents';
                $real_uid = 'document_id';
                $status = 'document_status';
                $updated_time = 'document_updated_at';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_id';
                $status = $table . '_status';
                $updated_time = $table . '_updated_at';
        }

        $statusData = array(
            $status => ($status_value == 'validee' or $status_value == 'actif') ? 'inactif' : 'actif',
            $updated_time => date('Y-m-d H:i:s'),
        );

        if ($this->model->update_data($realnametable, $statusData, array($real_uid => $uid))) {
            return redirect()->back()->with('success', "Modification Statut $table effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "Changement du statut non effectuée. Réessayer plus tard");
        }
    }
    public function remove($table = null, $uid = null)
    {
        $school_id = $this->session->schoolid;

        /*============= CREATE USER ACTIVITY ==============*/
        $this->createUserActivity('delete' . $table);
        /*============= END USER ACTIVITY ==============*/

        if ($table == 'inscription' or $table == 'student') {
            if ($this->model->fetch_row_data('students_inscriptions', array('inscription_student_id' => $uid, 'inscription_school_id' => $school_id))) {

                $ins_data = $this->model->fetch_row_data('students_inscriptions', array('inscription_student_id' => $uid, 'inscription_school_id' => $school_id));

                if (!empty($ins_data)) {

                    $inscription_id = $ins_data['inscription_id'];

                    if ($this->model->fetch_all_data('payments', array('payment_student_id' => $inscription_id, 'payment_school_id' => $school_id), 'payment_date')) {

                        $paydetails = $this->model->fetch_all_data('payments', array('payment_student_id' => $inscription_id, 'payment_school_id' => $school_id), 'payment_date');

                        foreach ($paydetails as $paydetail) {

                            //DELETE ALL PAYMENTS DETAILS
                            $this->model->delete_data('payments_details', array('paydetails_payment_id' => $paydetail['payment_id'], 'paydetails_school_id' => $school_id));

                        }
                        //DELETE ALL PAYMENTS
                        $this->model->delete_data('payments', array('payment_student_id' => $inscription_id));

                    }
                    if ($this->model->fetch_all_data('students_documents', array('document_student_id' => $uid, 'document_school_id' => $school_id))) {

                        $this->model->delete_data('students_documents', array('document_student_id' => $uid, 'document_school_id' => $school_id));

                    }
                    //DELETE ALL STUDENTS DATA  
                    $this->model->delete_data('students_inscriptions', array('inscription_student_id' => $uid));
                    $this->model->delete_data('students', array('student_id' => $uid));
                    return redirect()->back()->with('success', "Suppression dossier effectuée avec succés");

                } else {
                    $this->model->delete_data('students_inscriptions', array('inscription_student_id' => $uid));
                    $this->model->delete_data('students', array('student_id' => $uid));
                    return redirect()->back()->with('success', "Suppression dossier effectuée avec succés");
                }

            } else {
                $this->model->delete_data('students', array('student_id' => $uid));
                return redirect()->back()->with('success', "Suppression dossier effectuée avec succés");
            }

        } else {
            switch ($table) {
                case 'parent':
                    $realnametable = 'students_parents';
                    $real_uid = 'parent_id';
                    break;
                case 'parcours':
                    $realnametable = 'students_inscriptions';
                    $real_uid = 'inscription_id';
                    break;
                case 'document':
                    $realnametable = 'students_documents';
                    $real_uid = 'document_id';
                    break;
                    case 'municipality':
                    $realnametable = 'address_municipality';
                    $real_uid = 'municipality_id';
                    break;
                    case 'district':
                    $realnametable = 'address_district';
                    $real_uid = 'district_id';
                    break;
                default:
                    $realnametable = $table . 's';
                    $real_uid = $table . '_id';
            }
            if ($this->model->delete_data($realnametable, array($real_uid => $uid))) {
                return redirect()->back()->with('success', "Suppression $table effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Suppression non effectuée. Réessayer plus tard");
            }

        }
    }
    public function saveParent($parent_token = null)
    {
        $school_id = $this->session->schoolid;

        $data = [];
        $rulers = [
            'phone_primary' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Telephone obligatoire',
                ],
            ],
            'nom_pere_eleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pere obligatoire',
                ],
            ],
            'nom_mere_eleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'mere obligatoire',
                ],
            ],
            'phone_sms' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'contact obligatoire',
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $current_datetime = date('Y-m-d H:i:s');

            $nom_tuteur = trim($this->request->getPost('nom_tuteur_eleve'));
            $nom_pere = trim($this->request->getPost('nom_pere_eleve'));
            $nom_mere = trim($this->request->getPost('nom_mere_eleve'));
            $phone_tuteur = trim($this->request->getPost('telephone_tuteur'));
            $email_parent = trim($this->request->getPost('email_tuteur'));
            $phone_pere = trim($this->request->getPost('phone_pere'));
            $phone_mere = trim($this->request->getPost('phone_mere'));
            $emergency_parent = trim($this->request->getPost('phone_sms'));
            $job_pere = trim($this->request->getPost('profession_pere'));
            $job_mere = trim($this->request->getPost('profession_mere'));
            $job_tuteur = trim($this->request->getPost('profession_tuteur'));
            $phone_primary = trim($this->request->getPost('phone_primary'));
            $adresse = trim($this->request->getPost('adresseEleve'));
            $type_parent = trim($this->request->getPost('type_parent'));
            $parent_notes = trim($this->request->getPost('notes'));
            $phone_tuteur2 = trim($this->request->getPost('telephone_tuteur2'));
            $phone_pere2 = trim($this->request->getPost('phone_pere2'));
            $phone_mere2 = trim($this->request->getPost('phone_mere2'));

            if ($parent_token == 'create') {
                $create_parent_data = [
                    'parent_token' => setPrimaryKey(),
                    'parent_code' => setReferenceCode(),
                    'parent_father_name' => $nom_pere,
                    'parent_mother_name' => $nom_mere,
                    'parent_tutor_name' => $nom_tuteur,
                    'parent_father_job' => $job_pere,
                    'parent_mother_job' => $job_mere,
                    'parent_tutor_job' => $job_tuteur,
                    'parent_father_phone' => $phone_pere,
                    'parent_mother_phone' => $phone_mere,
                    'parent_tutor_phone' => $phone_tuteur,
                    'parent_father_phone2' => $phone_pere2,
                    'parent_mother_phone2' => $phone_mere2,
                    'parent_tutor_phone2' => $phone_tuteur2,
                    'parent_type' => $type_parent,
                    'parent_emergency' => $emergency_parent,
                    'parent_primary_address' => $adresse,
                    'parent_primary_phone' => $phone_primary,
                    'parent_primary_email' => $email_parent,
                    'parent_created_at' => $current_datetime,
                    'parent_status' => 'actif',
                    'parent_school_id' => $school_id,
                ];
                if ($this->model->insert_data('students_parents', $create_parent_data)) {

                    return redirect()->back()->with('success', "Enregistrement fiche parent effectuée avec succés");

                } else {
                    return redirect()->back()->with('failed', "Enregistrement fiche non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                }
            } else {
                $tuteurData = [
                    'parent_father_name' => $nom_pere,
                    'parent_mother_name' => $nom_mere,
                    'parent_tutor_name' => $nom_tuteur,
                    'parent_father_job' => $job_pere,
                    'parent_mother_job' => $job_mere,
                    'parent_tutor_job' => $job_tuteur,
                    'parent_father_phone' => $phone_pere,
                    'parent_mother_phone' => $phone_mere,
                    'parent_tutor_phone' => $phone_tuteur,
                    'parent_father_phone2' => $phone_pere2,
                    'parent_mother_phone2' => $phone_mere2,
                    'parent_tutor_phone2' => $phone_tuteur2,
                    'parent_type' => $type_parent,
                    'parent_emergency' => $emergency_parent,
                    'parent_primary_address' => $adresse,
                    'parent_primary_phone' => $phone_primary,
                    'parent_primary_email' => $email_parent,
                    'parent_updated_at' => $current_datetime,
                    'parent_notes' => $parent_notes,
                ];
                if ($this->model->update_data('students_parents', $tuteurData, ['parent_school_id' => $school_id,'parent_id' => $parent_token])) {
                    $quartier_id = trim($this->request->getPost('student_area'));
                    $commune_id = trim($this->request->getPost('student_commune'));
                    $numero = trim($this->request->getPost('address_number'));
                    $avenue = trim($this->request->getPost('address_name'));
                    $rue = trim($this->request->getPost('address_street_name'));
                    $address_id = trim($this->request->getPost('address_id'));

                    if (empty($address_id)) {
                        $new_insert_address = [
                            'address_token' => setPrimaryKey(),
                            'address_home_code' => $numero,
                            'address_area_name' => $avenue,
                            'address_street_name' => $rue,
                            'address_updated_at' => $current_datetime,
                            'address_district_id' => $quartier_id,
                            'address_municipality_id' => $commune_id,
                            'address_school_id' => $school_id,
                            'address_parent_id' => $parent_token
                        ];
                        $this->model->insert_data('address', $new_insert_address);
    
                    }else{
                        $update_address = [
                            'address_home_code' => $numero,
                            'address_area_name' => $avenue,
                            'address_street_name' => $rue,
                            'address_updated_at' => $current_datetime,
                            'address_district_id' => $quartier_id,
                            'address_municipality_id' => $commune_id,
                        ];
                        $this->model->update_data('address', $update_address, ['address_id' => $address_id,'address_school_id' => $school_id,'address_parent_id' => $parent_token]);
                    }
                    
                    return redirect()->back()->with('success', "Modification fiche parent effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Modification non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                }
            }
        } else {
            $data['parent'] = $this->model->fetch_row_data('students_parents', array('parent_id' => $parent_token, 'parent_school_id' => $school_id));
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('student/edit/parent');
            return view('layouts/main', $data);
        }
    }
    public function saveRegistration()
    {
        $school_id = $this->session->schoolid;
        $school_name = $this->session->schoolname;
        $year_id = $this->session->yearid;
        $year_name = $this->session->schoolyear;

        /*$student_existant_matricule = "";
        $matriculeEleve = trim($this->request->getPost('matriculeEleve'));
        if ($this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_code' => $matriculeEleve))) {

            $last_student = $this->model->fetch_row_data('students', array('student_code' => $matriculeEleve, 'student_school_id' => $school_id));
            $student_existant_matricule = setStudentSchoolIdentification($last_student);
        } else {
            $student_existant_matricule = trim($this->request->getPost('matriculeEleve'));
        }*/

        $data = [];


        $rulers = [
            'nomEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom obligatoire',
                ],
            ],
            'sexeEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sexe obligatoire',
                ],
            ],
            'classeEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Classe obligatoire',
                ],
            ],
            'tuteurEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuteur obligatoire',
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $matricule = $this->studentGeneratorID(); //$student_existant_matricule;

            $nom = trim($this->request->getPost('nomEleve'));
            $prenom = trim($this->request->getPost('prenomEleve'));
            $postnom = trim($this->request->getPost('postnomEleve'));
            $date_naissance = trim($this->request->getPost('dateNaissanceEleve'));
            $lieu_naissance = trim($this->request->getPost('lieuNaissanceEleve'));
            $provenance = trim($this->request->getPost('ecole_provenance'));
            $sernie = trim($this->request->getPost('numero_sernie'));
            $classe_uid = trim($this->request->getPost('classeEleve'));
            $tuteur_uid = trim($this->request->getPost('tuteurEleve'));
            $sexe = trim($this->request->getPost('sexeEleve'));
            $confession = trim($this->request->getPost('confession'));
            $documents = trim($this->request->getPost('documents'));
            $notes = trim($this->request->getPost('notes'));
            $student_province = trim($this->request->getPost('student_province'));
            $student_territory = trim($this->request->getPost('student_territory'));
            $student_sector = trim($this->request->getPost('student_sector'));
            $student_grouping = trim($this->request->getPost('student_grouping'));
            $student_village = trim($this->request->getPost('student_village'));
            $student_district = trim($this->request->getPost('student_district'));
            $current_datetime = date('Y-m-d H:i:s');

           
            if ($tuteur_uid == 'new_parent') {
                //new code for this tuteur
                $parent_code = "e" . setReferenceCode() . "e";
                $parent_token = setPrimaryKey(); //generate new unique id for database references

                $nom_tuteur = trim($this->request->getPost('nom_tuteur_eleve'));
                $nom_pere = trim($this->request->getPost('nom_pere_eleve'));
                $nom_mere = trim($this->request->getPost('nom_mere_eleve'));
                $phone_tuteur = trim($this->request->getPost('telephone_tuteur'));
                $email_parent = trim($this->request->getPost('email_tuteur'));
                $phone_pere = trim($this->request->getPost('phone_pere'));
                $phone_mere = trim($this->request->getPost('phone_mere'));
                $emergency_parent = trim($this->request->getPost('phone_sms'));
                $job_pere = trim($this->request->getPost('profession_pere'));
                $job_mere = trim($this->request->getPost('profession_mere'));
                $job_tuteur = trim($this->request->getPost('profession_tuteur'));
                $phone_primary = trim($this->request->getPost('phone_primary'));

                $phone_tuteur2 = trim($this->request->getPost('telephone_tuteur2'));
                $phone_pere2 = trim($this->request->getPost('phone_pere2'));
                $phone_mere2 = trim($this->request->getPost('phone_mere2'));

               
                $tuteurData = [
                    'parent_token' => $parent_token,
                    'parent_code' => $parent_code,
                    'parent_father_name' => $nom_pere,
                    'parent_mother_name' => $nom_mere,
                    'parent_tutor_name' => $nom_tuteur,
                    'parent_father_job' => $job_pere,
                    'parent_mother_job' => $job_mere,
                    'parent_tutor_job' => $job_tuteur,
                    'parent_father_phone' => $phone_pere,
                    'parent_mother_phone' => $phone_mere,
                    'parent_tutor_phone' => $phone_tuteur,
                    'parent_father_phone2' => $phone_pere2,
                    'parent_mother_phone2' => $phone_mere2,
                    'parent_tutor_phone2' => $phone_tuteur2,
                    'parent_status' => 'actif',
                    'parent_type' => 'biologique',
                    'parent_emergency' => $emergency_parent,
                    'parent_primary_address' => 'Voir Adresse configurer',
                    'parent_primary_phone' => $phone_primary,
                    'parent_primary_email' => $email_parent,
                    'parent_created_at' => $current_datetime,
                    'parent_school_id' => $school_id,
                ];

                //create new tuteur
                $this->model->insert_data('students_parents', $tuteurData);
            }
            $student_parent_id = $tuteur_uid;
            //GET PARENT ID AFTER CREATED NEW PARENT INFOSHEET
            if ($tuteur_uid == 'new_parent') {
                $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_token' => $parent_token));
                $student_parent_id = (!empty($parent_data)) ? $parent_data['parent_id'] : $tuteur_uid;

                $choosedQuartier = trim($this->request->getPost('student_area'));
                $quartier_id = $choosedQuartier;

                $choosedCommune = trim($this->request->getPost('student_commune'));
                $commune_id = $choosedCommune;
                $choosedZone = trim($this->request->getPost('address_street'));

                if ($choosedCommune == 'new_commune') {
                    //new code for this address
                    $commune_token = setPrimaryKey(); //generate new unique id for database references
                    $commune_name = trim($this->request->getPost('commune_name'));
                    if (!empty($commune_name)) {
                        $commune_data = [
                            'municipality_token' => $commune_token,
                            'municipality_code' => setReferenceCode(),
                            'municipality_name' => $commune_name,
                            'municipality_status' => 'actif',
                            'municipality_created_at' => $current_datetime,
                            'municipality_school_id' => $school_id,
                        ];
                        $this->model->insert_data('address_municipality', $commune_data);
                        $commune_db_data = $this->model->fetch_row_data('address_municipality', array('municipality_school_id' => $school_id, 'municipality_token' => $commune_token));
                        $commune_id = (!empty($commune_db_data)) ? $commune_db_data['municipality_id'] : $choosedCommune;
                    }
                }

                if ($choosedQuartier == 'new_area') {
                    //new code for this address
                    $quartier_token = setPrimaryKey(); //generate new unique id for database references
                    $quartier_name = trim($this->request->getPost('area_name'));
                    if (!empty($quartier_name)) {
                        $quartier_data = [
                            'district_token' => $quartier_token,
                            'district_code' => setReferenceCode(),
                            'district_name' => $quartier_name,
                            'district_status' => 'actif',
                            'district_created_at' => $current_datetime,
                            'district_municipality_id' => $commune_id,
                            'district_school_id' => $school_id,
                        ];
                        $this->model->insert_data('address_district', $quartier_data);
                        $quartier_db_data = $this->model->fetch_row_data('address_district', array('district_school_id' => $school_id, 'district_token' => $quartier_token));
                        $quartier_id = (!empty($quartier_db_data)) ? $quartier_db_data['district_id'] : $choosedQuartier;

                    }
                }
                if ($choosedZone == 'new_zone') {

                    $numero = trim($this->request->getPost('address_number'));
                    $avenue = trim($this->request->getPost('address_name'));
                    $rue = trim($this->request->getPost('address_street_name'));
                    if (!empty($numero)) {
                        //Create new Address for student family
                        //new code for this address
                        $address_token = setPrimaryKey(); //generate new unique id for database references

                        $new_address_insert = [
                            'address_token' => $address_token,
                            'address_home_code' => $numero,
                            'address_area_name' => $avenue,
                            'address_street_name' => $rue,
                            'address_status' => 'actif',
                            'address_created_at' => $current_datetime,
                            'address_district_id' => $quartier_id,
                            'address_municipality_id' => $commune_id,
                            'address_parent_id' => $student_parent_id,
                            'address_school_id' => $school_id,
                        ];
                        $this->model->insert_data('address', $new_address_insert);
                    }
                }
            } else {
                $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $tuteur_uid));
                $email_parent = (!empty($parent_data)) ? $parent_data['parent_primary_email'] : '';
                $phone_primary = (!empty($parent_data)) ? $parent_data['parent_primary_phone'] : '';
                $parent_code = (!empty($parent_data)) ? $parent_data['parent_code'] : '';
            }
            if ($this->join->fetch_students_data(array('student_parent_id' => $student_parent_id,'student_firstname' => $nom, 'student_lastname' => $postnom, 'student_gender' => $sexe,'student_school_id' => $school_id, 'inscription_classe_id' => $classe_uid,'inscription_year_id' => $year_id), '*', TRUE, 'student_created_at', 'DESC')) {
                //EXISTING STUDENT WITH SAME NAME UNDER THIS PARENT
                return redirect()->back()->with('failed', "Un élève portant le même nom existe déjà sous ce tuteur. Veuillez vérifier les informations saisies !");
            }
            //generate uid random
            $student_token = setPrimaryKey();
            //table data
            $saveEleveData = [
                'student_token' => $student_token,
                'student_code' => $matricule,
                'student_firstname' => $nom,
                'student_lastname' => $postnom,
                'student_surname' => $prenom,
                'student_gender' => $sexe,
                'student_birthday' => $date_naissance,
                'student_born_place' => $lieu_naissance,
                'student_status' => 'actif',
                'student_type' => 'ordinaire',
                'student_confession' => $confession,
                'student_documents' => $documents,
                'student_notes' => $notes,
                'student_sernie_id' => $sernie,
                'student_created_at' => $current_datetime,
                'student_parent_id' => $student_parent_id,
                'student_school_id' => $school_id,
                'student_phone' => $phone_primary,
                'student_email' => $email_parent,
                'student_province' => $student_province,
                'student_territory' => $student_territory,
                'student_sector' => $student_sector,
                'student_grouping' => $student_grouping,
                'student_village' => $student_village,
                'student_district' => $student_district,
            ];
            //CHECK INSERT STUDENT DATA
            if ($this->model->insert_data('students', $saveEleveData)) {
                //GET NEW STUDENT ID FOR REGISTRATION RELATION WITH INSCRIPTION TABLE BY STUDENT TOKEN
                $student_data = $this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_token' => $student_token));
                if (!empty($student_data)) {
                    //CREATE USER REGISTRATION AFTER GET ID
                    $registration_token = setPrimaryKey();
                    $saveInscriptionData = [
                        'inscription_token' => $registration_token,
                        'inscription_code' => setReferenceCode(),
                        'inscription_status' => 'actif',
                        'inscription_origin_school' => $provenance,
                        'inscription_date' => date('Y-m-d'),
                        'inscription_created_at' => $current_datetime,
                        'inscription_student_id' => $student_data['student_id'],
                        'inscription_classe_id' => $classe_uid,
                        'inscription_school_id' => $school_id,
                        'inscription_year_id' => $year_id,
                    ];

                    if ($this->model->insert_data('students_inscriptions', $saveInscriptionData)) {
                        if ($this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $student_parent_id))) {
                            //GET STUDENT NAME
                            $student_f_name = strtoupper($nom . ' ' . $postnom . ' ' . $prenom);
                            //GET CLASS NAME
                            $student_class_data = $this->join->fetch_join_classes(array('classe_id' => $classe_uid, 'classe_school_id' => $school_id), 'classe_name', 'ASC', TRUE);
                            $classe_shortname = (!empty($student_class_data)) ? $student_class_data['classe_shortname'] : '';

                            if (!empty($phone_primary)) {
                                //send sms to parent if section is active
                                if (session()->has('sectionsendsms') && session()->get('sectionsendsms') == 'actif') {
                                    //Define sms message
                                    $short_message = "Chers parents, votre enfant $student_f_name est inscrit en $classe_shortname pour l'annee scolaire $year_name. Matricule: $matricule";
                                    //get sms sender name
                                    $schoolsmssender = ucwords(strtoupper(session()->get('schoolsmssender')));
                                    //send sms to parent
                                    $this->sendSMS($phone_primary, $short_message, $schoolsmssender);
                                }
                            }

                            if (!empty($email_parent)) {
                                $subject = "Inscription de l'élève $student_f_name [$matricule]";
                                //send credentials
                                $email_content = "<h3>Confirmation d'inscription de l'élève $student_f_name, Matricule: [$matricule]</h3>
                                <p>Cher parent suite à la demande d'inscription de votre enfant au sein de notre <b>école $school_name pour l'année $year_name</b>,
                                voici les identifiants d'accès à son compte.</p>
                                <p>Code accès parent: $parent_code. Numéro matricule de l'élève: $matricule </p>
                                <p>Nous vous prions de garder le code d'accès dans un lieu secret à l'abri de toute personne étrangère n'ayant pas accès au dossier scolaire de votre enfant.</p>";

                                if ($this->sendEmail($email_parent, $subject, $email_content)) {
                                    $school_email = $this->session->schoolemail;
                                    $messages_sending_data = [
                                        'message_token' => setPrimaryKey(),
                                        'message_code' => setReferenceCode(),
                                        'message_sender' => $school_email,
                                        'message_recipient' => $email_parent,
                                        'message_subject' => $subject,
                                        'message_body' => $email_content,
                                        'message_status' => 'actif',
                                        'message_type' => 'email',
                                        'message_category' => 'parent',
                                        'message_created_at' => date('Y-m-d H:i:s'),
                                        'message_school_id' => $school_id,
                                        'message_section_id' => $this->session->choosedsectionid,
                                    ];
                                    $this->model->insert_data('messages', $messages_sending_data);

                                }
                            }
                        }

                        if ($documents >= 1) {

                            session()->setFlashdata('success', "Inscription candidat $nom $postnom effectuée avec succés");

                            return redirect()->to(base_url("studentAddDocuments/" . $student_token));

                        } else {

                            return redirect()->back()->with('success', "Inscription candidat $nom $postnom effectuée avec succés");

                        }
                    } else {
                        return redirect()->back()->with('failed', "Inscription non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                } else {
                    return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                }
            }
        } else {

            $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $school_id), 'parent_tutor_name', null, null, 'ASC');
            $data['classes'] = $this->join->fetch_join_classes(array('classe_deleted_at' => null, 'classe_school_id' => $school_id), 'classe_created_at', 'ASC');

            
                //$data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'student_created_at', 'DESC');
                $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $school_id, 'inscription_year_id' => $year_id), 'student_code', TRUE, 'student_created_at', 'DESC');

                $data['quartiers'] = $this->model->fetch_all_data('address_district', array('district_school_id' => $school_id), 'district_name', null, null, 'ASC');
                $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $school_id), 'municipality_name', null, null, 'ASC');
                $data['zones'] = $this->model->fetch_all_data('address', array('address_school_id' => $school_id), 'address_area_name', null, null, 'ASC');

            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('student/registration');
            return view('layouts/main', $data);
        }
    }
    public function updateRegistration($inscription_id = null)
    {
        $school_id = $this->session->schoolid;
        $data = [];

        if ($this->request->getFile('picture')) {

            $fullPathFile = 'public/uploads/images';

            $token_student = $this->request->getPost('studenttoken');
            $student = $this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_token' => $token_student));


            $db_student_image = $student['student_picture'];

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
                    $pictureFile = $this->request->getFile('picture');
                    //foreach($imagefile['images'] as $img){
                    if ($pictureFile->isValid() && !$pictureFile->hasMoved()) {
                        //rename image
                        $image_random_name = $pictureFile->getRandomName();
                        //move to upload directory
                        $pictureFile->move(ROOTPATH . $fullPathFile, $image_random_name);

                        $file_path_image = $fullPathFile . '/' . $db_student_image;

                        if (file_exists($file_path_image)) {

                            if (chdir($fullPathFile) && (!empty($db_student_image))) {
                                //REMOVE EXISTING FILE
                                unlink($db_student_image);
                            }
                        }

                        $image_student = (!empty($image_random_name)) ? $image_random_name : $db_student_image;

                        $update_student_data = [
                            'student_picture' => $image_student,
                        ];
                        //update data in table
                        if ($this->model->update_data('students', $update_student_data, array('student_token' => $token_student))) {
                            session()->set('studentpic', $image_student);
                            return redirect()->back()->with('success', "Changement photo effectué avec succés");
                        }
                    } else {
                        return redirect()->back()->with('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrés puis réessayer !');
                    }
                }
            }
        }
        if (!empty($inscription_id) && $this->request->getPost()) {
            $rulers = [
                'nomEleve' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nom obligatoire',
                    ],
                ],
                'sexeEleve' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Sexe obligatoire',
                    ],
                ],
                'classeEleve' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Classe obligatoire',
                    ],
                ],
                'tuteurEleve' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tuteur obligatoire',
                    ],
                ],
            ];

            if ($this->validate($rulers)) {

                $matricule = trim($this->request->getPost('matriculeEleve'));
                $nom = trim($this->request->getPost('nomEleve'));
                $prenom = trim($this->request->getPost('prenomEleve'));
                $postnom = trim($this->request->getPost('postnomEleve'));
                $date_naissance = trim($this->request->getPost('dateNaissanceEleve'));
                $lieu_naissance = trim($this->request->getPost('lieuNaissanceEleve'));
                $provenance = trim($this->request->getPost('ecole_provenance'));
                $sernie = trim($this->request->getPost('numero_sernie'));
                $classe_uid = trim($this->request->getPost('classeEleve'));
                $student_parent_id = trim($this->request->getPost('tuteurEleve'));
                $adresse = trim($this->request->getPost('adresseEleve'));
                $sexe = trim($this->request->getPost('sexeEleve'));
                $phone_primary = trim($this->request->getPost('phone_primary'));
                $email_primary = trim($this->request->getPost('email_primary'));
                $nationality = trim($this->request->getPost('nationality'));
                $student_notes = trim($this->request->getPost('notes'));
                $student_token = trim($this->request->getPost('student_token'));
                $student_province = trim($this->request->getPost('student_province'));
                $student_territory = trim($this->request->getPost('student_territory'));
                $student_sector = trim($this->request->getPost('student_sector'));
                $student_grouping = trim($this->request->getPost('student_grouping'));
                $student_village = trim($this->request->getPost('student_village'));
                $student_district = trim($this->request->getPost('student_district'));
                $permanent_code = trim($this->request->getPost('permanent_code'));
                $current_datetime = date('Y-m-d H:i:s');

                $saveEleveData = [
                    'student_code' => $matricule,
                    'student_firstname' => $nom,
                    'student_lastname' => $postnom,
                    'student_surname' => $prenom,
                    'student_gender' => $sexe,
                    'student_birthday' => $date_naissance,
                    'student_born_place' => $lieu_naissance,
                    'student_phone' => $phone_primary,
                    'student_email' => $email_primary,
                    'student_address' => $adresse,
                    'student_sernie_id' => $sernie,
                    'student_updated_at' => $current_datetime,
                    'student_parent_id' => $student_parent_id,
                    'student_nationality' => $nationality,
                    'student_notes' => $student_notes,
                    'student_province' => $student_province,
                    'student_territory' => $student_territory,
                    'student_sector' => $student_sector,
                    'student_grouping' => $student_grouping,
                    'student_village' => $student_village,
                    'student_district' => $student_district,
                    'student_permanent_code' => $permanent_code,
                ];
                //CHECK INSERT STUDENT DATA
                if ($this->model->update_data('students', $saveEleveData, array('student_token' => $student_token))) {

                    $saveInscriptionData = [
                        'inscription_origin_school' => $provenance,
                        'inscription_validation' => $current_datetime,
                        'inscription_updated_at' => $current_datetime,
                        'inscription_classe_id' => $classe_uid,
                    ];

                    if ($this->model->update_data('students_inscriptions', $saveInscriptionData, array('inscription_id' => $inscription_id))) {

                        return redirect()->back()->with('success', "Modification dossier $nom $postnom effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Inscription non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                }

            } else {

                $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $school_id), 'parent_tutor_name', null, null, 'ASC');
                $data['classes'] = $this->join->fetch_join_classes(array('classe_deleted_at' => null, 'classe_school_id' => $school_id), 'classe_shortname', null, 'ASC');

                $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['_view'] = ('student/registration');
                return view('layouts/main', $data);
            }
        }
    }
    public function createYearlyRegistration()
    {
        $school_id = $this->session->schoolid;
        $year_id = $this->session->yearid;
        if ($this->request->getPost('classe_uid_nouvelle') != '') {
            $nouvelle_classe_uid = ($this->request->getPost('classe_uid_nouvelle'));
            $ancienne_classe_uid = ($this->request->getPost('classe_ancienne'));
            $notes = $this->request->getPost('commentaire_affectation');
            //get classe status affectation
            $classe_status = $this->model->fetch_all_data('students_inscriptions', array('inscription_classe_id' => $nouvelle_classe_uid, 'inscription_year_id' => $year_id, 'inscription_school_id' => $school_id), 'inscription_date');

            //check match new and old class
            if ($nouvelle_classe_uid != $ancienne_classe_uid) {
                //veriry class
                if (empty($classe_status)) {
                    if ($this->request->getPost('EleveIdentifiant')) {
                        $count = 1;
                        $inscrip_random_uid = setPrimaryKey();

                        foreach ($this->request->getPost('EleveIdentifiant') as $eleve) {

                            //prepare insert data in ts_inscriptions
                            $nouvelleInscriptionData = [
                                'inscription_token' => $inscrip_random_uid . 'ba' . $count++,
                                'inscription_code' => setReferenceCode() . $count++,
                                'inscription_student_id' => $eleve,
                                'inscription_classe_id' => $nouvelle_classe_uid,
                                'inscription_notes' => $notes,
                                'inscription_year_id' => $year_id,
                                'inscription_date' => date('Y-m-d'),
                                'inscription_type' => 'basculement',
                                'inscription_status' => 'actif',
                                'inscription_created_at' => date('Y-m-d'),
                                'inscription_school_id' => $school_id,
                                'inscription_origin_school' => session()->schoolname,
                            ];

                            //insert eleves
                            $this->model->insert_data('students_inscriptions', $nouvelleInscriptionData);
                        }
                        return redirect()->back()->with('success', "Basculement effectué avec succès des élèves dans une nouvelle classe");
                    } else {
                        return redirect()->back()->with('failed', "Aucun éleve n'a été selectionnée ou trouvé dans cette classe.");
                    }
                } else {
                    return redirect()->back()->with('failed', "Les élèves de la classe choisie sont déjà basculés. Veuillez réessayer");
                }
            } else {
                return redirect()->back()->with('failed', "La nouvelle classe doit être différente de l'ancienne. Veuillez réessayer");
            }
        } else {
            return redirect()->back()->with('failed', "La nouvelle classe est obligatoire. Veuillez réessayer");
        }
    }
    public function saveBasculementGlobal()
    {
        $schoolid = $this->session->schoolid;
        $year_id = $this->session->yearid;
        $idclasseNouvelle = $this->request->getPost('classe_uid_nouvelle_global');
        $ancienneClasse = $this->request->getPost('classe_uid_ancienne_global');

        if ($this->request->getPost()) {
            $last_year = ($this->session->yearstarted - 1); //GET LAST STARTED BY NEW STARTED - 1 YEAR
            $last_year_data = $this->model->fetch_row_data('years', array('year_started' => $last_year, 'year_school_id' => $schoolid));
            if (!empty($last_year_data)) {
                $last_year_id = $last_year_data['year_id']; // GET LAST YEAR ID

                $current_datetime = date('Y-m-d H:i:s');
                $inscrip_random_uid = setPrimaryKey();
                for ($count = 0; ($count < sizeof($idclasseNouvelle) && $count < sizeof($ancienneClasse)); $count++) {
                    //get students listing by class
                    $students_listing = $this->join->fetch_students_data(array('inscription_classe_id' => $ancienneClasse[$count], 'inscription_year_id' => $last_year_id, 'student_school_id' => $schoolid));
                    //dd(($students_listing));
                    if (!empty($students_listing)) {

                        foreach ($students_listing as $eleve => $row) {
                            $dataAffecteNewClasse = [
                                'inscription_token' => $inscrip_random_uid . 'ba' . $count++,
                                'inscription_code' => setReferenceCode() . $count++,
                                'inscription_student_id' => $row['inscription_eleve_uid'],
                                'inscription_classe_id' => $idclasseNouvelle[$count],
                                'inscription_year_id' => $year_id,
                                'inscription_school_id' => $schoolid,
                                'inscription_date' => date('Y-m-d'),
                                'inscription_type' => 'basculement',
                                'inscription_status' => 'actif',
                                'inscription_notes' => 'Nouvelle Affectation Globale',
                                'inscription_created_at' => $current_datetime,
                                'inscription_origin_school' => session()->schoolname,
                            ];
                            $this->model->insert_data('students_inscriptions', $dataAffecteNewClasse);
                        }
                    } else {
                        return redirect()->back()->with('failed', "Aucun dossier des anciens élèves trouvés!");
                    } //end checking students list//end foreach
                } //end for
                return redirect()->back()->with('success', "Basculement global effectué avec succès des élèves dans une nouvelle classe");
            } else {
                return redirect()->back()->with('failed', "Aucun dossier des anciens élèves trouvés!");
            }
        } else {
            return redirect()->back()->with('failed', "Vous devez sélectionner les classes et leurs correspondances!");
        }
    }
    public function saveParcours($eleve_reference = null)
    {
        if (!empty($eleve_reference)) {
            //get all parcours
            $parcoursEleves = $this->join->fetch_students_data(array('student_id' => $eleve_reference));

            $annee_uid = (($this->request->getPost('annee_scolaire')));
            $classe_uid = (($this->request->getPost('classe_eleve')));
            $ecole_provenance = (($this->request->getPost('ecole_provenance')));
            $inscription_date = (($this->request->getPost('date_inscription')));

            $anneeParcours = false;
            foreach ($parcoursEleves as $key => $value) {
                if ($annee_uid == $value['inscription_year_id'] && $classe_uid == $value['inscription_classe_id']) {
                    $anneeParcours = true;
                }
            }

            if ($anneeParcours == false) {
                $current_datetime = date('Y-m-d H:i:s');
                $ins_uid = setPrimaryKey();
                if ($this->request->getPost()) {
                    $saveParcoursData = [
                        'inscription_token' => $ins_uid,
                        'inscription_code' => setReferenceCode(),
                        'inscription_status' => 'actif',
                        'inscription_type' => 'parcours',
                        'inscription_date' => !empty($inscription_date) ? $inscription_date : date('Y-m-d'),
                        'inscription_student_id' => $eleve_reference,
                        'inscription_classe_id' => $classe_uid,
                        'inscription_year_id' => $annee_uid,
                        'inscription_origin_school' => $ecole_provenance,
                        'inscription_created_at' => $current_datetime,
                        'inscription_school_id' => $this->session->schoolid,
                    ];

                    if ($this->model->insert_data('students_inscriptions', $saveParcoursData)) {
                        return redirect()->back()->with('success', "Création Parcours effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
                    }
                } else {
                    return redirect()->to(current_url(true));
                }
            } else {
                return redirect()->back()->with('failed', "Le parcours de l'année et la classe selectionnée est déjà enregistré");
            }
        } else {
            return redirect()->back()->with('failed', 'ERROR: Opération non effectuée. Aucun éléve selectionné');
        }
    }
    public function addSchoolDocuments($student = null, $doc_token = null)
    {

        if (!empty($student)) {
            $school_id = $this->session->schoolid;

            $student_data = $this->join->fetch_students_data(array('student_school_id' => $school_id, 'student_token' => $student), '*', true);

            if (!empty($student_data)) {
                $student_id = $student_data['student_id']; // ID
                $student_inscription_id = $student_data['inscription_id']; // ID
                $nb_documents = $student_data['student_documents']; // Nombre documents et biens
                if (!empty($doc_token)) {
                    //UPDATE DOCUMENT DATA
                    $update_documents = [
                        'document_name' => $this->request->getPost('doc_name'),
                        'document_number' => $this->request->getPost('doc_number'),
                        'document_type' => $this->request->getPost('doc_type'),
                        'document_quantity' => $this->request->getPost('doc_qty'),
                        'document_notes' => $this->request->getPost('doc_notes'),
                        'document_delivery_date' => $this->request->getPost('doc_delivery'),
                        'document_validity_date' => $this->request->getPost('doc_validity'),
                        'document_updated_at' => date('Y-m-d H:i:s'),
                    ];
                    //save new data in table
                    if ($this->model->update_data('students_documents', $update_documents, array('document_token' => $doc_token))) {
                        session()->setFlashdata('success', "Modification document effectuée avec succés !");
                        return redirect()->to(base_url('student/details/inscription/' . $student_inscription_id));
                    } else {
                        return redirect()->back()->with('failed', "Modification non effectuée. Veuillez réessayer !");
                    }
                } else {
                    if (!$this->request->getPost()) {

                        $data['title'] = "Ajout documents et autres biens";
                        $data['student'] = $student_data;
                        $data['_view'] = ('student/documents');
                        return view('layouts/main', $data);
                    }

                    $rep = 0;
                    for ($i = 1; $i <= $nb_documents; $i++) {
                        $create_details_documents = [
                            'document_token' => setPrimaryKey() . $i,
                            'document_code' => setReferenceCode(),
                            'document_name' => $this->request->getPost('doc_name' . $i),
                            //'document_number' => $this->request->getPost('doc_number'.$i),
                            'document_type' => $this->request->getPost('doc_type' . $i),
                            'document_quantity' => $this->request->getPost('doc_qty' . $i),
                            'document_notes' => $this->request->getPost('doc_notes' . $i),
                            //'document_delivery_date' => $this->request->getPost('doc_delivery'.$i),
                            //'document_validity_date' => $this->request->getPost('doc_validity'.$i),
                            'document_status' => 'actif',
                            'document_created_at' => date('Y-m-d H:i:s'),
                            'document_student_id' => $student_id,
                            'document_school_id' => $school_id,
                        ];
                        //save new data in table
                        if ($this->model->insert_data('students_documents', $create_details_documents)) {
                            $rep = 1;
                        } else {
                            $rep = 0;
                        }
                    }
                    if ($rep == 1) {
                        session()->setFlashdata('success', "Ajout documents effectuée avec succés !");
                        return redirect()->to(base_url('student/details/inscription/' . $student_inscription_id));
                    } else {
                        return redirect()->back()->with('failed', "Ajout non effectuée. Veuillez réessayer !");
                    }
                }
            } else {
                return redirect()->back()->with('failed', "Aucune correspondance de dossier. Veuillez réessayer !");
            }
        } else {
            return redirect()->back()->with('failed', "Aucune correspondance de dossier. Veuillez réessayer !");
        }
    }
    public function addNewDocument($student = null)
    {

        if (!empty($student) && $this->request->getPost()) {

            $school_id = $this->session->schoolid;

            $student_data = $this->join->fetch_students_data(array('student_school_id' => $school_id, 'student_token' => $student), '*', true);

            if (!empty($student_data)) {

                $student_id = $student_data['student_id']; // ID
                $student_inscription_id = $student_data['inscription_id']; // ID

                $update_documents = [
                    'document_name' => $this->request->getPost('doc_name1'),
                    'document_number' => $this->request->getPost('doc_code1'),
                    'document_type' => $this->request->getPost('doc_type1'),
                    'document_quantity' => $this->request->getPost('doc_qty1'),
                    'document_notes' => $this->request->getPost('doc_notes1'),
                    'document_delivery_date' => $this->request->getPost('doc_delivery1'),
                    'document_validity_date' => $this->request->getPost('doc_validity1'),
                    'document_status' => 'actif',
                    'document_created_at' => date('Y-m-d H:i:s'),
                    'document_student_id' => $student_id,
                    'document_school_id' => $school_id,
                ];
                //save new data in table
                if ($this->model->insert_data('students_documents', $update_documents)) {
                    session()->setFlashdata('success', "Ajout document effectuée avec succés !");
                    return redirect()->to(base_url('student/details/inscription/' . $student_inscription_id));
                } else {
                    return redirect()->back()->with('failed', "Ajout non effectuée. Veuillez réessayer !");
                }
            } else {
                return redirect()->back()->with('failed', "Ajout non effectuée. Veuillez réessayer !");
            }
        } else {

            return redirect()->back()->withInput();

        }
    }
    public function onlineStudentRegistration()
    {
        $school_linked = '';
        $school_id = $this->session->schoolid;
        $year_id = $this->session->yearid;

        $rulers = [
            'student' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Matricule obligatoire',
                ]
            ],
            'school' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ecole obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $student = $this->request->getGet('student');
            $school = $this->request->getGet('school');

            switch ($school) {
                case 'kalubwe':
                    $school_linked = 'https://webschool.malkiawaamani.org/';
                    break;
                case 'ville':
                    $school_linked = 'https://magschool.malkiawaamani.org/';
                    break;
                case 'usoke':
                    $school_linked = 'https://magschool.malkiawaamani.org/';
                    break;
                default:
                    $school_linked = base_url();
                    break;
            }

            try {
                $client = \Config\Services::curlrequest();

                /*$response = $client->get($school_linked . 'studentregister', [
                    'query' => ['query' => $student]
                ]);*/
                $response = $client->get($school_linked . 'studentRegister', [
                    'query' => ['query' => $student],
                    'headers' => [
                        'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                        'Accept' => 'application/json'
                    ],
                    'allow_redirects' => true // explicitly allow redirects
                ]);

                //dd($response->getStatusCode());
                // Check if response is successful
                if ($response->getStatusCode() == 200) {
                    /*Log response for debugging
                    log_message('debug', 'Curl Response: ' . print_r($response->getBody(), true));
                    Récupère les données de la réponse
                    Convertir JSON en tableau associatif*/
                    $data = json_decode($response->getBody(), true);

                    // Handle $data as needed
                } else {
                    // Handle non-200 status code
                    log_message('error', 'API Error: ' . $response->getStatusCode());
                    log_message('error', 'Redirect Location: ' . $response->getHeaderLine('Location'));
                    $data['api_error'] = 'Erreur lors de la récupération des données. Veuillez réessayer plus tard.';
                }
            } catch (\Exception $e) {
                // Handle exception
                log_message('error', 'Curl Request Failed: ' . $e->getMessage());
            }
            $schoolid = $this->session->schoolid;
            $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'classe_created_at');
            $data['quartiers'] = $this->model->fetch_all_data('address_district', array('district_school_id' => $schoolid), 'district_created_at');
            $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $schoolid), 'municipality_created_at');
            $data['zones'] = $this->join->fetch_address(array('address_school_id' => $schoolid), '*', FALSE, 'address_created_at');

            $data['laststudent'] = $this->join->fetch_students_data(array('student_school_id' => $school_id, 'inscription_year_id' => $year_id), 'student_code', TRUE, 'student_created_at', 'DESC');

            $data['title'] = ucwords('Student Checking Registration');
            $data['schoolquery'] = $school;
            $data['studentquery'] = $student;
            $data['reslink'] = $school_linked;
            $data['_view'] = "student/oldregistration";
            echo view('layouts/main', $data);
        } else {
            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['title'] = ucwords('Student Online Registration');
            $data['_view'] = "student/oldregistration";
            echo view('layouts/main', $data);
        }
    }
    public function registerOldStudent()
    {
        $school_id = $this->session->schoolid;
        $year_id = $this->session->yearid;
        $data = [];
        $rulers = [
            'nomEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom obligatoire',
                ],
            ],
            'sexeEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sexe obligatoire',
                ],
            ],
            'classeEleve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Classe obligatoire',
                ],
            ],
            'phone_primary' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Numero obligatoire',
                ],
            ],
        ];
        $tokenstudent = trim($this->request->getPost('tokenstudent'));
        if ($this->validate($rulers)) {

            $matricule = trim($this->request->getPost('matriculeEleve'));
            $nom = trim($this->request->getPost('nomEleve'));
            $prenom = trim($this->request->getPost('prenomEleve'));
            $postnom = trim($this->request->getPost('postnomEleve'));
            $date_naissance = trim($this->request->getPost('dateNaissanceEleve'));
            $lieu_naissance = trim($this->request->getPost('lieuNaissanceEleve'));
            $provenance = trim($this->request->getPost('ecole_provenance'));
            $sernie = trim($this->request->getPost('numero_sernie'));
            $classe_uid = trim($this->request->getPost('classeEleve'));
            $parent_id = trim($this->request->getPost('parent_id'));
            $sexe = trim($this->request->getPost('sexeEleve'));
            $confession = trim($this->request->getPost('confession'));
            $documents = trim($this->request->getPost('documents'));
            $notes = trim($this->request->getPost('notes'));

            $current_datetime = date('Y-m-d H:i:s');

            //if ($this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $parent_id))) {
            //new code for this tuteur
            $parent_code = "e" . setReferenceCode() . "e";
            $parent_token = setPrimaryKey(); //generate new unique id for database references

            $nationality = trim($this->request->getPost('nationality'));
            $nom_tuteur = trim($this->request->getPost('nom_tuteur_eleve'));
            $nom_pere = trim($this->request->getPost('nom_pere_eleve'));
            $nom_mere = trim($this->request->getPost('nom_mere_eleve'));
            $phone_tuteur = trim($this->request->getPost('telephone_tuteur'));
            $email_parent = trim($this->request->getPost('email_tuteur'));
            $phone_pere = trim($this->request->getPost('phone_pere'));
            $phone_mere = trim($this->request->getPost('phone_mere'));
            $emergency_parent = trim($this->request->getPost('phone_sms'));
            $job_pere = trim($this->request->getPost('profession_pere'));
            $job_mere = trim($this->request->getPost('profession_mere'));
            $job_tuteur = trim($this->request->getPost('profession_tuteur'));
            $phone_primary = trim($this->request->getPost('phone_primary'));

            $phone_tuteur2 = trim($this->request->getPost('telephone_tuteur2'));
            $phone_pere2 = trim($this->request->getPost('phone_pere2'));
            $phone_mere2 = trim($this->request->getPost('phone_mere2'));
            if ($this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $parent_id))) {
                //UPDATE EXISTING TUTEUR IF EXIST
                $tuteurData = [
                    'parent_father_name' => $nom_pere,
                    'parent_mother_name' => $nom_mere,
                    'parent_tutor_name' => $nom_tuteur,
                    'parent_father_job' => $job_pere,
                    'parent_mother_job' => $job_mere,
                    'parent_tutor_job' => $job_tuteur,
                    'parent_father_phone' => $phone_pere,
                    'parent_mother_phone' => $phone_mere,
                    'parent_tutor_phone' => $phone_tuteur,
                    'parent_father_phone2' => $phone_pere2,
                    'parent_mother_phone2' => $phone_mere2,
                    'parent_tutor_phone2' => $phone_tuteur2,
                    'parent_primary_phone' => $phone_primary,
                    'parent_primary_email' => $email_parent,
                    'parent_emergency' => $emergency_parent,
                    'parent_updated_at' => $current_datetime,
                ];
                //update existing tuteur
                $this->model->update_data('students_parents', $tuteurData, array('parent_id' => $parent_id));

                $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $parent_id));
                $email_parent = (!empty($parent_data)) ? $parent_data['parent_primary_email'] : '';
                $phone_primary = (!empty($parent_data)) ? $parent_data['parent_primary_phone'] : '';
                $parent_code = (!empty($parent_data)) ? $parent_data['parent_code'] : '';

            } else {
                //CREATE NEW TUTEUR IF NOT EXIST
                $tuteurData = [
                    'parent_token' => $parent_token,
                    'parent_code' => $parent_code,
                    'parent_father_name' => $nom_pere,
                    'parent_mother_name' => $nom_mere,
                    'parent_tutor_name' => $nom_tuteur,
                    'parent_father_job' => $job_pere,
                    'parent_mother_job' => $job_mere,
                    'parent_tutor_job' => $job_tuteur,
                    'parent_father_phone' => $phone_pere,
                    'parent_mother_phone' => $phone_mere,
                    'parent_tutor_phone' => $phone_tuteur,
                    'parent_father_phone2' => $phone_pere2,
                    'parent_mother_phone2' => $phone_mere2,
                    'parent_tutor_phone2' => $phone_tuteur2,
                    'parent_status' => 'actif',
                    'parent_type' => 'biologique',
                    'parent_emergency' => $emergency_parent,
                    'parent_primary_address' => 'Voir Adresse configurer',
                    'parent_primary_phone' => $phone_primary,
                    'parent_primary_email' => $email_parent,
                    'parent_created_at' => $current_datetime,
                    'parent_school_id' => $school_id,
                ];

                //create new tuteur
                $this->model->insert_data('students_parents', $tuteurData);
            }
            $student_parent_id = $parent_id;
            //GET PARENT ID AFTER CREATED NEW PARENT INFOSHEET
            $choosedZone = trim($this->request->getPost('address_street'));
            if ($choosedZone == 'new_zone') {
                $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_token' => $parent_token));
                $student_parent_id = (!empty($parent_data)) ? $parent_data['parent_id'] : $parent_id;

                $choosedQuartier = trim($this->request->getPost('student_area'));
                $quartier_id = $choosedQuartier;

                $choosedCommune = trim($this->request->getPost('student_commune'));
                $commune_id = $choosedCommune;

                if ($choosedCommune == 'new_commune') {
                    //new code for this address
                    $commune_token = setPrimaryKey(); //generate new unique id for database references
                    $commune_name = trim($this->request->getPost('commune_name'));

                    $commune_data = [
                        'municipality_token' => $commune_token,
                        'municipality_code' => setReferenceCode(),
                        'municipality_name' => $commune_name,
                        'municipality_status' => 'actif',
                        'municipality_created_at' => $current_datetime,
                        'municipality_school_id' => $school_id,
                    ];
                    $this->model->insert_data('address_municipality', $commune_data);
                    $commune_db_data = $this->model->fetch_row_data('address_municipality', array('municipality_school_id' => $school_id, 'municipality_token' => $commune_token));
                    $commune_id = (!empty($commune_db_data)) ? $commune_db_data['municipality_id'] : $choosedCommune;
                }
                if ($choosedQuartier == 'new_area') {
                    //new code for this address
                    $quartier_token = setPrimaryKey(); //generate new unique id for database references
                    $quartier_name = trim($this->request->getPost('area_name'));
                    if (!empty($quartier_name)) {
                        $quartier_data = [
                            'district_token' => $quartier_token,
                            'district_code' => setReferenceCode(),
                            'district_name' => $quartier_name,
                            'district_status' => 'actif',
                            'district_created_at' => $current_datetime,
                            'district_municipality_id' => $commune_id,
                            'district_school_id' => $school_id,
                        ];
                        $this->model->insert_data('address_district', $quartier_data);
                        $quartier_db_data = $this->model->fetch_row_data('address_district', array('district_school_id' => $school_id, 'district_token' => $quartier_token));
                        $quartier_id = (!empty($quartier_db_data)) ? $quartier_db_data['district_id'] : $choosedQuartier;

                    }
                }
                if ($choosedZone == 'new_zone') {
                    $numero = trim($this->request->getPost('address_number'));
                    $avenue = trim($this->request->getPost('address_name'));
                    $rue = trim($this->request->getPost('address_street_name'));

                    //Create new Address for student family
                    //new code for this address
                    $address_token = setPrimaryKey(); //generate new unique id for database references

                    $new_address_insert = [
                        'address_token' => $address_token,
                        'address_home_code' => $numero,
                        'address_area_name' => $avenue,
                        'address_street_name' => $rue,
                        'address_status' => 'actif',
                        'address_created_at' => $current_datetime,
                        'address_district_id' => $quartier_id,
                        'address_municipality_id' => $commune_id,
                        'address_parent_id' => $student_parent_id,
                        'address_school_id' => $school_id,
                    ];
                    $this->model->insert_data('address', $new_address_insert);

                }
            } else {
                $address_data = $this->model->fetch_row_data('address', array('address_school_id' => $school_id, 'address_parent_id' => $parent_id, 'address_id' => $choosedZone));
                if (empty($address_data)) {
                    $address_family = $this->model->fetch_row_data('address', array('address_school_id' => $school_id, 'address_id' => $choosedZone));

                    //Create new Address for student family
                    $new_address_family = [
                        'address_token' => setPrimaryKey(),
                        'address_home_code' => $address_family['address_home_code'],
                        'address_area_name' => $address_family['address_area_name'],
                        'address_street_name' => $address_family['address_street_name'],
                        'address_district_id' => $address_family['address_district_id'],
                        'address_municipality_id' => $address_family['address_municipality_id'],
                        'address_status' => 'actif',
                        'address_created_at' => $current_datetime,
                        'address_parent_id' => $student_parent_id,
                        'address_school_id' => $school_id,
                    ];
                    $this->model->insert_data('address', $new_address_family);
                }
            }
            //check if student already exist with same matricule in this school
            if ($this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_token' => $tokenstudent, 'student_parent_id' => $parent_id))) {
                //UPDATE EXISTING STUDENT AND INSCRIPTION DATA IF EXIST
                $update_student_data = [
                    'student_firstname' => $nom,
                    'student_lastname' => $postnom,
                    'student_surname' => $prenom,
                    'student_gender' => $sexe,
                    'student_nationality' => $nationality,
                    'student_birthday' => $date_naissance,
                    'student_born_place' => $lieu_naissance,
                    'student_confession' => $confession,
                    'student_documents' => $documents,
                    'student_notes' => $notes,
                    'student_sernie_id' => $sernie,
                    'student_updated_at' => $current_datetime,
                    'student_parent_id' => $student_parent_id,
                    'student_school_id' => $school_id,
                    'student_phone' => $phone_primary,
                    'student_email' => $email_parent,
                ];
                //CHECK STUDENT DATA UPDATE
                if ($this->model->update_data('students', $update_student_data, array('student_school_id' => $school_id, 'student_token' => $tokenstudent, 'student_parent_id' => $parent_id))) {

                    //GET NEW STUDENT ID FOR REGISTRATION RELATION WITH INSCRIPTION TABLE BY STUDENT TOKEN
                    $student_data = $this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_token' => $tokenstudent, 'student_parent_id' => $parent_id));
                    if (!empty($student_data)) {
                        //check if student already exist with same matricule in this school
                        $student_id = $student_data['student_id'];
                        $student_token = $student_data['student_token'];
                        if ($this->model->fetch_row_data('students_inscriptions', array('inscription_school_id' => $school_id, 'inscription_year_id' => $year_id, 'inscription_student_id' => $student_id))) {
                            //UPDATE EXISTING INSCRIPTION IF EXIST
                            $registration_token = setPrimaryKey();
                            $update_registration = [
                                'inscription_origin_school' => $provenance,
                                'inscription_updated_at' => $current_datetime,
                                'inscription_student_id' => $student_id,
                                'inscription_classe_id' => $classe_uid,
                                'inscription_year_id' => $year_id,
                            ];

                            $this->model->update_data('students_inscriptions', $update_registration, array('inscription_year_id' => $year_id, 'inscription_student_id' => $student_id, 'inscription_school_id' => $school_id));
                            return redirect()->back()->with('success', "Réinscription $nom $postnom actualisée avec succés");

                        } else {
                            //CREATE NEW INSCRIPTION IF NOT EXIST
                            $registration_token = setPrimaryKey();
                            $saveInscriptionData = [
                                'inscription_token' => $registration_token,
                                'inscription_code' => setReferenceCode(),
                                'inscription_status' => 'actif',
                                'inscription_origin_school' => $provenance,
                                'inscription_date' => date('Y-m-d'),
                                'inscription_created_at' => $current_datetime,
                                'inscription_student_id' => $student_id,
                                'inscription_classe_id' => $classe_uid,
                                'inscription_school_id' => $school_id,
                                'inscription_year_id' => $year_id,
                            ];


                            if ($this->model->insert_data('students_inscriptions', $saveInscriptionData)) {
                                //SEND SMS TO PARENT OR TUTEUR
                                $this->sendParentNotification($student_parent_id, $parent_code, $nom, $postnom, $prenom, $matricule, $classe_uid);

                                if ($documents >= 1) {

                                    session()->setFlashdata('success', "Réinscription du candidat $nom $postnom effectuée avec succés");

                                    return redirect()->to(base_url("studentAddDocuments/" . $student_token));

                                } else {

                                    return redirect()->back()->with('success', "Réinscription du candidat $nom $postnom effectuée avec succés");

                                }
                            } else {
                                return redirect()->back()->with('failed', "Réinscription non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                            }
                        }
                    } else {
                        return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                }
            } else {
                //CREATE NEW STUDENT IF NOT EXIST

                //generate uid random
                $student_token = setPrimaryKey();
                //table data
                $saveEleveData = [
                    'student_token' => $student_token,
                    'student_code' => $matricule,
                    'student_firstname' => $nom,
                    'student_lastname' => $postnom,
                    'student_surname' => $prenom,
                    'student_gender' => $sexe,
                    'student_nationality' => $nationality,
                    'student_birthday' => $date_naissance,
                    'student_born_place' => $lieu_naissance,
                    'student_status' => 'actif',
                    'student_type' => 'ordinaire',
                    'student_confession' => $confession,
                    'student_documents' => $documents,
                    'student_notes' => $notes,
                    'student_sernie_id' => $sernie,
                    'student_created_at' => $current_datetime,
                    'student_parent_id' => $student_parent_id,
                    'student_school_id' => $school_id,
                    'student_phone' => $phone_primary,
                    'student_email' => $email_parent,
                ];
                //CHECK INSERT STUDENT DATA
                if ($this->model->insert_data('students', $saveEleveData)) {
                    //GET NEW STUDENT ID FOR REGISTRATION RELATION WITH INSCRIPTION TABLE BY STUDENT TOKEN
                    $student_data = $this->model->fetch_row_data('students', array('student_school_id' => $school_id, 'student_token' => $student_token));
                    if (!empty($student_data)) {
                        //CREATE USER REGISTRATION AFTER GET ID
                        $registration_token = setPrimaryKey();
                        $saveInscriptionData = [
                            'inscription_token' => $registration_token,
                            'inscription_code' => setReferenceCode(),
                            'inscription_status' => 'actif',
                            'inscription_origin_school' => $provenance,
                            'inscription_date' => date('Y-m-d'),
                            'inscription_created_at' => $current_datetime,
                            'inscription_student_id' => $student_data['student_id'],
                            'inscription_classe_id' => $classe_uid,
                            'inscription_school_id' => $school_id,
                            'inscription_year_id' => $year_id,
                        ];

                        if ($this->model->insert_data('students_inscriptions', $saveInscriptionData)) {
                            //SEND SMS TO PARENT OR TUTEUR
                            $this->sendParentNotification($student_parent_id, $parent_code, $nom, $postnom, $prenom, $matricule, $classe_uid);

                            if ($documents >= 1) {

                                session()->setFlashdata('success', "Inscription candidat $nom $postnom effectuée avec succés");

                                return redirect()->to(base_url("studentAddDocuments/" . $student_token));

                            } else {

                                return redirect()->back()->with('success', "Inscription candidat $nom $postnom effectuée avec succés");

                            }
                        } else {
                            return redirect()->back()->with('failed', "Inscription non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Opération non effectuée suite à un problème interne. Veuillez réessayer plus tard !");
                    }
                }
            }
        } else {

            $data['parents'] = $this->model->fetch_all_data('students_parents', array('parent_deleted_at' => null, 'parent_school_id' => $school_id), 'parent_tutor_name', null, null, 'ASC');
            $data['classes'] = $this->join->fetch_join_classes(array('classe_deleted_at' => null, 'classe_school_id' => $school_id), 'classe_created_at', 'ASC');

            
                //$data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_year_id' => $yearid), '*', FALSE, 'student_created_at', 'DESC');
                $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $school_id, 'inscription_year_id' => $year_id), 'student_code', TRUE, 'student_created_at', 'DESC');

                $data['quartiers'] = $this->model->fetch_all_data('address_district', array('district_school_id' => $school_id), 'district_name', null, null, 'ASC');
                $data['communes'] = $this->model->fetch_all_data('address_municipality', array('municipality_school_id' => $school_id), 'municipality_name', null, null, 'ASC');
                $data['zones'] = $this->model->fetch_all_data('address', array('address_school_id' => $school_id), 'address_area_name', null, null, 'ASC');

            $this->session->setFlashdata('failed', 'Veuillez  vérifier ci-dessous les problèmes rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('student/oldregistration');
            return view('layouts/main', $data);
        }
    }
    private function sendParentNotification($student_parent_id = null, $parent_code = null, $nom = null, $postnom = null, $prenom = null, $matricule = null, $classe_uid = null)
    {
        $school_id = $this->session->schoolid;
        $school_name = $this->session->schoolname;
        $year_name = $this->session->schoolyear;
        $school_email = $this->session->schoolemail;
        //send sms or email to parent or tuteur
        if ($this->model->fetch_row_data('students_parents', array('parent_school_id' => $school_id, 'parent_id' => $student_parent_id))) {
            $student_f_name = strtoupper($nom . ' ' . $postnom . ' ' . $prenom);
            $student_class_data = $this->join->fetch_join_classes(array('classe_id' => $classe_uid, 'classe_school_id' => $school_id), 'classe_name', 'ASC', TRUE);

            $classe_shortname = (!empty($student_class_data)) ? $student_class_data['classe_shortname'] : '';

            if (!empty($phone_primary)) {
                //send sms to parent if section is active
                if (session()->has('sectionsendsms') && session()->get('sectionsendsms') == 'actif') {
                    //Define sms message
                    $short_message = "Chers parents, votre enfant $student_f_name est inscrit en $classe_shortname pour l'annee scolaire $year_name. Matricule: $matricule";
                    //get sms sender name
                    $schoolsmssender = ucwords(strtoupper(session()->get('schoolsmssender')));
                    //send sms to parent
                    $this->sendSMS($phone_primary, $short_message, $schoolsmssender);
                }
            }
            if (!empty($email_parent)) {
                $subject = "Inscription de l'élève $student_f_name [$matricule]";
                //send credentials
                $email_content = "<h3>Confirmation d'inscription de l'élève $student_f_name, Matricule: [$matricule]</h3>
                <p>Cher parent suite à la demande d'inscription de votre enfant au sein de notre <b>école $school_name pour l'année $year_name</b>,
                voici les identifiants d'accès à son compte.</p>
                <p>Code accès parent: $parent_code. Numéro matricule de l'élève: $matricule </p>
                <p>Nous vous prions de garder le code d'accès dans un lieu secret à l'abri de toute personne étrangère n'ayant pas accès au dossier scolaire de votre enfant.</p>";

                if ($this->sendEmail($email_parent, $subject, $email_content)) {

                    $messages_sending_data = [
                        'message_token' => setPrimaryKey(),
                        'message_code' => setReferenceCode(),
                        'message_sender' => $school_email,
                        'message_recipient' => $email_parent,
                        'message_subject' => $subject,
                        'message_body' => $email_content,
                        'message_status' => 'actif',
                        'message_type' => 'email',
                        'message_category' => 'parent',
                        'message_created_at' => date('Y-m-d H:i:s'),
                        'message_school_id' => $school_id,
                        'message_section_id' => $this->session->choosedsectionid,
                    ];
                    $this->model->insert_data('messages', $messages_sending_data);
                }
            }
        }
    }
    private function municipality()
    {
        $school_id = $this->session->schoolid;
        session()->set('sess_tab', 'municipality');
        if ($this->request->getPost()) {
            $commune_token = $this->request->getPost('municipality_token');
            $commune_name = $this->request->getPost('municipality_name');
            $commune_status = $this->request->getPost('municipality_status');

            if (!empty($commune_token) && !empty($commune_name)) {
                $commune_data = [
                    'municipality_name' => $commune_name,
                    'municipality_status' => $commune_status,
                    'municipality_updated_at' => date('Y-m-d H:i:s'),
                ];
                if ($this->model->update_data('address_municipality', $commune_data, array('municipality_token' => $commune_token, 'municipality_school_id' => $school_id))) {
                    return redirect()->back()->with('success', 'Commune modifiée avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de modification de la commune');
                }
            } else {
                //SET UPDATE
                $commune_data = [
                    'municipality_token' => setPrimaryKey(),
                    'municipality_code' => setReferenceCode(),
                    'municipality_name' => $commune_name,
                    'municipality_status' => $commune_status,
                    'municipality_created_at' => date('Y-m-d H:i:s'),
                    'municipality_school_id' => $school_id,
                ];
                if ($this->model->insert_data('address_municipality', $commune_data)) {
                    return redirect()->back()->with('success', 'Commune ajoutée avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de l\'ajout de la commune');
                }
            }
        } else {
            return redirect()->back()->with('failed', 'Veuillez saisir les infos de la commune');
        }
    }
    private function municipalityDistrict()
    {
        $school_id = $this->session->schoolid;
        session()->set('sess_tab', 'quartiers');
        if ($this->request->getPost()) {
            $district_token = $this->request->getPost('district_token');
            $district_name = $this->request->getPost('district_name');
            $district_status = $this->request->getPost('district_status');
            $district_notes = $this->request->getPost('district_notes');
            $district_municipality = $this->request->getPost('municipality');

            if (!empty($district_token) && !empty($district_name) && !empty($district_municipality)) {
                $district_data = [
                    'district_name' => $district_name,
                    'district_municipality_id' => $district_municipality,
                    'district_notes' => $district_notes,
                    'district_status' => $district_status,
                    'district_updated_at' => date('Y-m-d H:i:s'),
                ];
                if ($this->model->update_data('address_district', $district_data, array('district_token' => $district_token, 'district_school_id' => $school_id))) {
                    return redirect()->back()->with('success', 'Quartier modifié avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de modification du quartier');
                }
            } else {
                //SET UPDATE
                $district_data = [
                    'district_token' => setPrimaryKey(),
                    'district_code' => setReferenceCode(),
                    'district_name' => $district_name,
                    'district_notes' => $district_notes,
                    'district_municipality_id' => $district_municipality,
                    'district_status' => $district_status,
                    'district_created_at' => date('Y-m-d H:i:s'),
                    'district_school_id' => $school_id,
                ];
                if ($this->model->insert_data('address_district', $district_data)) {
                    return redirect()->back()->with('success', 'Quartier ajouté avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de l\'ajout du quartier');
                }
            }
        } else {
            return redirect()->back()->with('failed', 'Veuillez saisir les infos du quartier');
        }
    }
    private function municipalityAddress()
    {
        $school_id = $this->session->schoolid;
        session()->set('sess_tab', 'zones');
        if ($this->request->getPost()) {
            $address_token = $this->request->getPost('address_token');
            $address_home_code = $this->request->getPost('address_home_code');
            $address_area_name = $this->request->getPost('address_area_name');
            $address_street_name = $this->request->getPost('address_street_name');
            $address_status = $this->request->getPost('address_status');
            $address_district = $this->request->getPost('district');
            $address_municipality_id = $this->request->getPost('municipality');

            if (!empty($address_token) && !empty($address_home_code) && !empty($address_area_name) && !empty($address_street_name) && !empty($address_district)) {
                $address_data = [
                    'address_home_code' => $address_home_code,
                    'address_area_name' => $address_area_name,
                    'address_street_name' => $address_street_name,
                    'address_district_id' => $address_district,
                    'address_municipality_id' => $address_municipality_id,
                    'address_status' => $address_status,
                    'address_updated_at' => date('Y-m-d H:i:s'),
                ];
                if ($this->model->update_data('address', $address_data, array('address_token' => $address_token, 'address_school_id' => $school_id))) {
                    return redirect()->back()->with('success', 'Zone modifiée avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de modification de la zone');
                }
            } else {
                //SET UPDATE
                $address_data = [
                    'address_token' => setPrimaryKey(),
                    'address_home_code' => $address_home_code,
                    'address_area_name' => $address_area_name,
                    'address_street_name' => $address_street_name,
                    'address_district_id' => $address_district,
                    'address_municipality_id' => $address_municipality_id,
                    'address_status' => $address_status,
                    'address_created_at' => date('Y-m-d H:i:s'),
                    'address_school_id' => $school_id,
                ];
                if ($this->model->insert_data('address', $address_data)) {
                    return redirect()->back()->with('success', 'Zone ajoutée avec succès');
                } else {
                    return redirect()->back()->with('failed', 'Erreur lors de l\'ajout de la zone');
                }
            }
        } else {
            return redirect()->back()->with('failed', 'Veuillez saisir les infos de la zone');
        }
    }

    public function studentGeneratorID()
    {
        $school_id = $this->session->schoolid;
        $compteurId = $this->model->save_data('students_counters', array('counter_value' => $school_id));
        /*$row_data = $this->model->fetch_row_data('students_counters', array('counter_school_id' => $school_id));
        $compteur = 0;  
        if ($row_data) {
            // Incrémente
            $counter_id = $row_data['counter_id'];
            $counter_value = $row_data['counter_value'] + 1;
            $this->model->update_data('students_counters', array('counter_value' => $counter_value),array('counter_id' => $counter_id, 'counter_school_id' => $school_id));
        
            $compteur = $counter_value; //+ 1;
        } else {
            // Crée une nouvelle entrée
            $students_counter = [
                'counter_school_id'    => $school_id,
                'counter_value'    => 1
            ];
            $this->model->insert_data('students_counters', $students_counter);
        
            $compteur = 1;
        }*/
        
        // Vérifier l'unicité du matricule
        $school_init_identify = session()->has('schoolinit') ? session()->get('schoolinit') : '';
        $student_code_start = substr(session()->get('yearstarted'), 2);
        $student_code_end = substr(session()->get('yearclosing'), 2);

        // Étape 2 : Générer le matricule
        $prefix = $school_init_identify;
        $annee = $student_code_start; // ex: 25 pour 2025
        $mois = $student_code_end;  // ex: 10 pour octobre
        $numero = str_pad($compteurId, 3, '0', STR_PAD_LEFT); // ex: 001, 002, ...
        $matricule = $prefix . $annee . $mois . $numero; // CSM2510001

        return $matricule;
    }
}

