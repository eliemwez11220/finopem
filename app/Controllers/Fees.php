<?php

namespace App\Controllers;

class Fees extends BaseController
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
        $this->listing('feestypes');
    }
    public function listing($page = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        switch ($page) {
            case 'feestypes':
                $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                $data['feesdetails'] = $this->model->fetch_all_data('fees_details', array('feedetail_deleted_at' => null, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
                break;
            case 'feesclasses':
                $feeid = (session()->feechoosed) ? session()->feechoosed : '';
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid, 'classe_status' => 'actif'), 'degree_code');
                $data['feesclasses'] = $this->join->fetch_fees_classes(array('feedetail_fee_id' => $feeid, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                $data['fees'] = $this->model->fetch_all_data('fees', array('fee_deleted_at' => null, 'fee_school_id' => $schoolid), 'fee_created_at');
                $data['fees_details'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid), 'feedetail_created_at');
                break;
            case 'scholarships':
                $studentid = (session()->studentchoosed) ? session()->studentchoosed : '';
                $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_id' => $studentid), '*', true);
                $data['studentsinscriptions'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid));
                $data['exemptions'] = $this->model->fetch_all_data('exemptions', array('exemption_deleted_at' => null, 'exemption_school_id' => $schoolid), 'exemption_created_at');
                $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('feestudent_inscription_id' => $studentid, 'feestudent_school_id' => $schoolid));
                break;
            case 'exemptions':
                $data['exemptions'] = $this->model->fetch_all_data('exemptions', array('exemption_deleted_at' => null, 'exemption_school_id' => $schoolid), 'exemption_created_at');
                break;
            default:
                $data['exchanges'] = $this->model->fetch_all_data('payments_exchanges', array('exchange_school_id' => $schoolid), 'exchange_created_at');

        }
        // dd($data['feesclasses']);

        $data['title'] = "Configuration Frais - " . $page;
        $data['_view'] = "fees/listing/" . $page;
        echo view('layouts/main', $data);
    }
    public function details($type = null, $id = null)
    {

        $schoolid = $this->session->schoolid;

        $data = [];
        switch ($type) {
            case 'feetype':
                $data['feetype'] = $this->model->fetch_row_data('fees', array('fee_id' => $id, 'fee_school_id' => $schoolid));
                $data['feesdetails'] = $this->model->fetch_all_data('fees_details', array('feedetail_fee_id' => $id, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
                break;
            case 'feeclasse':
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid, 'classe_status' => 'actif'), 'degree_code');
                $data['fee'] = $this->model->fetch_row_data('fees_details', array('feedetail_id' => $id, 'feedetail_school_id' => $schoolid));
                $data['feesclasses'] = $this->join->fetch_fees_classes(array('feeclasse_feedetail_id' => $id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');
                break;

            default:

        }

        $data['title'] = "Configuration Frais Details " . ucfirst($type); // Capitalize the first letter
        $data['_view'] = 'fees/details/' . $type;
        echo view('layouts/main', $data);

    }
    public function create($page = null, $id = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        switch ($page) {
            case 'feedetails':
                $data['fee'] = $this->model->fetch_row_data('fees', array('fee_token' => $id, 'fee_school_id' => $schoolid));
                $fee_id = (!empty($data['fee'])) ? $data['fee']['fee_id'] : '';
                $data['feesdetails'] = $this->model->fetch_all_data('fees_details', array('feedetail_fee_id' => $fee_id, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
                break;
            case 'discountexemption':
                $data['exemption'] = $this->model->fetch_row_data('exemptions', array('exemption_token' => $id, 'exemption_school_id' => $schoolid));
                $discurrency = (!empty($data['exemption'])) ? $data['exemption']['exemption_currency'] : ''; // GET EXEMPTION CURRENCY
                $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('fee_currency_payable' => $discurrency, 'feedetail_school_id' => $schoolid));
                $data['discountsexemptions'] = $this->join->fetch_exemptions_data(array('exemption_token' => $id, 'feediscount_school_id' => $schoolid));
                break;
            case 'studentexemption':
                $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid));
                $data['exemption'] = $this->model->fetch_row_data('exemptions', array('exemption_id' => $id, 'exemption_school_id' => $schoolid));
                $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('feestudent_exemption_id' => $id, 'feestudent_school_id' => $schoolid));
                break;
            case 'classeexemption':
                $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid, 'classe_status' => 'actif'), 'degree_code');
                $data['exemption'] = $this->model->fetch_row_data('exemptions', array('exemption_id' => $id, 'exemption_school_id' => $schoolid));
                //$data['studentexemptions'] = $this->join->fetch_exemptions_students(array('feestudent_exemption_id' => $id,'feestudent_school_id' => $schoolid));
                $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemptionclasse_exemption_id' => $id, 'exemptionclasse_school_id' => $schoolid));
                break;
            default:
        }
        //  dd($data['discountsexemptions']);
        $data['title'] = "Configuration Frais - " . $page;
        $data['_view'] = "fees/create/" . $page;
        echo view('layouts/main', $data);
    }
    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'fees':
                $realnametable = 'fees';
                $real_uid = 'fee_id';
                $status = 'fee_status';
                $updated_time = 'fee_updated_at';
                break;
            case 'exemption':
                $realnametable = 'exemptions';
                $real_uid = 'exemption_id';
                $status = 'exemption_status';
                $updated_time = 'exemption_updated_at';
                break;
            case 'feedetail':
                $realnametable = 'fees_details';
                $real_uid = 'feedetail_id';
                $status = 'feedetail_status';
                $updated_time = 'feedetail_updated_at';
                break;
            case 'discount':
                $realnametable = 'exemptions_discounts';
                $real_uid = 'feediscount_id';
                $status = 'feediscount_status';
                $updated_time = 'feediscount_updated_at';
                break;
            case 'exchange':
                $realnametable = 'payments_exchanges';
                $real_uid = 'exchange_id';
                $status = 'exchange_status';
                $updated_time = 'exchange_updated_at';
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
            return redirect()->back()->with('success', "Modification Statut effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
        }
    }
    public function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'feetype':
                $realnametable = 'fees';
                $real_uid = 'fee_id';
                break;
            case 'discount':
                $realnametable = 'exemptions_discounts';
                $real_uid = 'feediscount_id';
                break;
            case 'exemptionstudent':
                $realnametable = 'exemptions_students';
                $real_uid = 'feestudent_id';
                break;
            default:
                $realnametable = $table . 's';
                $real_uid = $table . '_id';
        }
        if ($this->model->delete_data($realnametable, array($real_uid => $uid))) {
            
            /*============= CREATE USER ACTIVITY ==============*/
        $this->createUserActivity('delete'.$table);
        /*============= END USER ACTIVITY ==============*/
            return redirect()->back()->with('success', "Suppression effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "Suppression non effectuée. Réessayer plus tard");
        }
    }
    public function saveFeeType($fee_id = null)
    {
        //$data = [];
        $rulers = [
            'fee_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "nom obligatoire",
                ],
            ],
            'fee_type' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "mode paiement obligatoire",
                ],
            ],
            'fee_payable' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Tranche paiement obligatoire",
                ],
            ],
            'fee_currency' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Monnaie obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $fee_name = (($this->request->getPost('fee_name')));
            $fee_type = (($this->request->getPost('fee_type')));
            $fee_payable = (($this->request->getPost('fee_payable')));
            $fee_currency = (($this->request->getPost('fee_currency')));

            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($fee_id)) {
                $updateTypeData = [
                    'fee_name' => $fee_name,
                    'fee_type' => $fee_type,
                    'fee_total_payable' => $fee_payable,
                    'fee_currency_payable' => $fee_currency,
                    'fee_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('fees', $updateTypeData, array('fee_id' => $fee_id))) {
                    return redirect()->back()->with('success', "Modification type frais effectuée avec succés");
                }
            } else {
                $fee_token = setPrimaryKey();
                //create new type
                $createNewTypeData = [
                    'fee_token' => $fee_token,
                    'fee_code' => setReferenceCode(),
                    'fee_name' => $fee_name,
                    'fee_type' => $fee_type,
                    'fee_total_payable' => $fee_payable,
                    'fee_currency_payable' => $fee_currency,
                    'fee_status' => 'actif',
                    'fee_created_at' => $current_datetime,
                    'fee_school_id' => $this->session->schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('fees', $createNewTypeData)) {
                    session()->setFlashdata('success', "Création type frais classe effectuée avec succés");
                    return redirect()->to(base_url('fees/config/feedetails/' . $fee_token));
                }
            }

        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }

    public function addDetailsFees($fee_id = null)
    {
        if (!empty($fee_id)) {
            $school_id = $this->session->schoolid;

            //Informations sur le frais a configurer
            $fees_data = $this->model->fetch_row_data('fees', array('fee_id' => $fee_id, 'fee_school_id' => $school_id));

            if (!empty($fees_data)) {

                $nb_payables = $fees_data['fee_total_payable']; // Nombre total payable
                $rep = 0;
                for ($i = 1; $i <= $nb_payables; $i++) {
                    $create_fees_details = [
                        'feedetail_token' => setPrimaryKey() . $i,
                        'feedetail_code' => setReferenceCode() . $i,
                        'feedetail_name' => $this->request->getPost('txt_save_libelle' . $i),
                        'feedetail_subname' => $this->request->getPost('txt_shortname' . $i),
                        'feedetail_notes' => $this->request->getPost('txt_libelle_frais' . $i),
                        'feedetail_cost_payable' => $this->request->getPost('txt_nb_tranches' . $i),
                        'feedetail_status' => 'actif',
                        'feedetail_created_at' => date('Y-m-d H:i:s'),
                        'feedetail_fee_id' => $fee_id,
                        'feedetail_school_id' => $school_id,
                    ];
                    //save new data in table
                    if ($this->model->insert_data('fees_details', $create_fees_details)) {
                        $rep = 1;
                    } else {
                        $rep = 0;
                    }
                }
                if ($rep == 1) {
                    session()->setFlashdata('success', "Configuration frais effectuée avec succés");
                    return redirect()->to(base_url('fees/details/feetype/' . $fee_id));
                } else {
                    return redirect()->back()->with('failed', "Configuration non effectuée. Veuillez réessayer !");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune correspondance de frais. Veuillez réessayer !");
            }
        } else {
            return redirect()->back()->with('failed', "Aucune correspondance de frais. Veuillez réessayer !");
        }
    }

    public function updateDetailsFees($fee_id = null)
    {
        $school_id = $this->session->schoolid;
        if (!empty($fee_id)) {
            $rulers = [
                'fee_name' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Libelle obligatoire",
                    ],
                ],

                'fee_payable' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Tranche paiement obligatoire",
                    ],
                ],

            ];
            //dd($rulers);
            if ($this->validate($rulers)) {
                $fee_name = trim($this->request->getPost('fee_name'));
                $fee_payable = trim($this->request->getPost('fee_payable'));
                $shortname = trim($this->request->getPost('shortname'));

                $current_datetime = date('Y-m-d H:i:s');
                $updateTypeData = [
                    'feedetail_name' => $fee_name,
                    'feedetail_subname' => $shortname,
                    'feedetail_cost_payable' => $fee_payable,
                    'feedetail_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('fees_details', $updateTypeData, array('feedetail_id' => $fee_id))) {
                    return redirect()->back()->with('success', "Modification frais effectuée avec succés");
                } else {
                    $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
                    return redirect()->back()->withInput();
                }
            } else {
                $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    public function createClasseFees($id_fee)
    {

        if ($this->request->getPost() && (!empty($id_fee))) {

            $schoolid = $this->session->schoolid;
            $temoins = 0;
            //Get all listing
            $classes = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid), 'degree_code');

            if (!empty($classes)) {
                //$feetype = $this->model->fetch_row_data('fees', array('fee_id' => $id_fee, 'fee_school_id' => $schoolid));
                $feesdetails = $this->model->fetch_all_data('fees_details', array('feedetail_fee_id' => $id_fee, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
                if (!empty($feesdetails)) {
                    foreach ($feesdetails as $feesdetail) {
                        //delete all previous classes fees configuration
                        if ($this->model->delete_batch('fees_classes', array('feeclasse_feedetail_id' => $feesdetail['feedetail_id']))) {
                            foreach ($classes as $row) {
                                //get choosed classe by status
                                $classe_choosed = $this->request->getPost('etatClasse' . $row['classe_id']);

                                //prepare sql insert
                                $donnees_classes = array(
                                    'feeclasse_token' => setPrimaryKey(),
                                    'feeclasse_code' => setReferenceCode(),
                                    'feeclasse_status' => 'actif',
                                    'feeclasse_created_at' => date('Y-m-d H:i:s'),
                                    'feeclasse_classe_id' => $classe_choosed,
                                    'feeclasse_feedetail_id' => $feesdetail['feedetail_id'],
                                    'feeclasse_school_id' => $schoolid,
                                );
                                if ($this->model->insert_data('fees_classes', $donnees_classes)) {
                                    $temoins = 1; //  check if fee classe inserted
                                }
                            }
                        } else {
                            //CREATE FIRST CONFIGURATION FOR THIS FEE
                            foreach ($classes as $row) {
                                //get choosed classe by status
                                $classe_choosed = $this->request->getPost('etatClasse' . $row['classe_id']);

                                //prepare sql insert
                                $donnees_classes = array(
                                    'feeclasse_token' => setPrimaryKey(),
                                    'feeclasse_code' => setReferenceCode(),
                                    'feeclasse_status' => 'actif',
                                    'feeclasse_created_at' => date('Y-m-d H:i:s'),
                                    'feeclasse_classe_id' => $classe_choosed,
                                    'feeclasse_feedetail_id' => $feesdetail['feedetail_id'],
                                    'feeclasse_school_id' => $schoolid,
                                );
                                if ($this->model->insert_data('fees_classes', $donnees_classes)) {
                                    $temoins = 1; //  check if fee classe inserted
                                }
                            }
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_batch('fees_classes', array('feeclasse_classe_id' => null));
                        return redirect()->back()->with('success', "Configuration frais par classe effectuée avec succés");
                        //return redirect()->to(base_url('fees/details/feeclasse/'.$id_fee));
                    } else {
                        return redirect()->back()->with('failed', "Configuration non effectuée. Veuillez réessayer");
                    }

                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer en selectionnant au moins un classe");
                }
            } else {
                return redirect()->back()->with('failed', "Veuillez réessayer indiquer le frais correspondant");
            }
        } //END CHECK METHOD AND FEE ID
    }

    public function saveFeeExemption($fee_id = null)
    {
        //$data = [];
        $rulers = [
            'exemption_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom obligatoire",
                ],
            ],
            'exemption_payable' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Montant obligatoire",
                ],
            ],
            'exemption_currency' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Monnaie obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $fee_name = (($this->request->getPost('exemption_name')));
            $fee_payable = (($this->request->getPost('exemption_payable')));
            $fee_currency = (($this->request->getPost('exemption_currency')));

            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($fee_id)) {
                $updateTypeData = [
                    'exemption_name' => $fee_name,
                    'exemption_cost_discount' => $fee_payable,
                    'exemption_currency' => $fee_currency,
                    'exemption_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->model->update_data('exemptions', $updateTypeData, array('exemption_id' => $fee_id))) {
                    return redirect()->back()->with('success', "Modification exhoneration effectuée avec succés");
                }
            } else {
                $fee_token = setPrimaryKey();
                //create new type
                $createNewTypeData = [
                    'exemption_token' => $fee_token,
                    'exemption_code' => setReferenceCode(),
                    'exemption_status' => 'actif',
                    'exemption_name' => $fee_name,
                    'exemption_cost_discount' => $fee_payable,
                    'exemption_currency' => $fee_currency,
                    'exemption_created_at' => $current_datetime,
                    'exemption_year_id' => $this->session->yearid,
                    'exemption_school_id' => $this->session->schoolid,
                ];
                //save new data in table
                if ($this->model->insert_data('exemptions', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création exhoneration effectuée avec succés");
                }
            }

        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }

    public function configDiscountExemption($exemption_id = null)
    {
        if (!empty($exemption_id) && $this->request->getPost()) {

            $school_id = $this->session->schoolid;
            //$year_id = $this->session->yearid;
            $temoins = 0;
            //Get all listing
            $feesdetails = $this->model->fetch_all_data('fees_details', array('feedetail_school_id' => $school_id), 'feedetail_created_at');

            if (!empty($feesdetails)) {
                //delete all previous classes fees configuration
                if ($this->model->delete_batch('exemptions_discounts', array('feediscount_exemption_id' => $exemption_id))) {
                    foreach ($feesdetails as $feedetail) {
                        $feedetail_id = $this->request->getPost('etatClasse' . $feedetail['feedetail_id']);
                        $students_exemptions = array(
                            'feediscount_status' => 'actif',
                            'feediscount_notes' => 'Bourse accordée par classe',
                            'feediscount_created_at' => date('Y-m-d H:i:s'),
                            'feediscount_feedetail_id' => $feedetail_id,
                            'feediscount_exemption_id' => $exemption_id,
                            'feediscount_school_id' => $school_id,
                        );
                        if ($this->model->insert_data('exemptions_discounts', $students_exemptions)) {
                            $temoins = 1; //  check if discount exemption inserted
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_batch('exemptions_discounts', array('feediscount_feedetail_id' => null));
                        return redirect()->back()->with('success', "Configuration frais bourse effectuée avec succés");
                        //return redirect()->to(base_url('fees/details/feeclasse/'.$id_fee));
                    } else {
                        return redirect()->back()->with('failed', "Configuration bourse frais non effectuée. Veuillez réessayer");
                    }

                } else {
                    foreach ($feesdetails as $feedetail) {
                        $feedetail_id = $this->request->getPost('etatClasse' . $feedetail['feedetail_id']);
                        $students_exemptions = array(
                            'feediscount_status' => 'actif',
                            'feediscount_notes' => 'Attribution gloable effectuée par frais',
                            'feediscount_created_at' => date('Y-m-d H:i:s'),
                            'feediscount_feedetail_id' => $feedetail_id,
                            'feediscount_exemption_id' => $exemption_id,
                            'feediscount_school_id' => $school_id,
                        );
                        if ($this->model->insert_data('exemptions_discounts', $students_exemptions)) {
                            $temoins = 1; //  check if discount exemption inserted
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_batch('exemptions_students', array('feeclasse_classe_id' => null));
                        return redirect()->back()->with('success', "Configuration frais bourse effectuée avec succés");
                        //return redirect()->to(base_url('fees/details/feeclasse/'.$id_fee));
                    } else {
                        return redirect()->back()->with('failed', "Configuration bourse frais non effectuée. Veuillez réessayer");
                    }
                }
            } else {
                $this->session->setTempdata('failed', "Aucun frais selectionner sur la liste !");
                return redirect()->back()->withInput();
            }

        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    public function configClasseExemption($exemption_id = null)
    {
        if (!empty($exemption_id)) {
            if ($this->request->getPost()) {
                $school_id = $this->session->schoolid;
                $year_id = $this->session->yearid;
                $temoins = 0;
                //Get all listing
                $classes = $this->join->fetch_join_classes(array('classe_school_id' => $school_id), 'degree_code');

                if (!empty($classes)) {
                    //delete all previous classes fees configuration
                    if ($this->model->delete_batch('exemptions_classes', array('exemptionclasse_exemption_id' => $exemption_id))) {
                        foreach ($classes as $classe) {
                            //$classe_id  = $classe['classe_id'];
                            $classe_id = $this->request->getPost('etatClasse' . $classe['classe_id']);

                            $classes_exemptions = array(
                                'exemptionclasse_status' => 'actif',
                                'exemptionclasse_notes' => 'Bourse accordée par classe',
                                'exemptionclasse_created_at' => date('Y-m-d H:i:s'),
                                'exemptionclasse_exemption_id' => $exemption_id,
                                'exemptionclasse_classe_id' => $classe_id,
                                'exemptionclasse_school_id' => $school_id,
                            );
                            if ($this->model->insert_data('exemptions_classes', $classes_exemptions)) {
                                $temoins = 1; //  check if student exemption inserted
                            }

                        }
                        if ($temoins == 1) {
                            $this->model->delete_batch('exemptions_classes', array('exemptionclasse_classe_id' =>null));
                            return redirect()->back()->with('success', "Configuration bourse par classe effectuée avec succés");
                            //return redirect()->to(base_url('fees/details/feeclasse/'.$id_fee));
                        } else {
                            return redirect()->back()->with('failed', "Configuration bourse classe non effectuée. Veuillez réessayer");
                        }

                    } else {
                        foreach ($classes as $classe) {
                            //$classe_id  = $classe['classe_id'];
                            $classe_id = $this->request->getPost('etatClasse' . $classe['classe_id']);

                            $students_exemptions = array(
                                'exemptionclasse_status' => 'actif',
                                'exemptionclasse_notes' => 'Bourse accordée par classe',
                                'exemptionclasse_created_at' => date('Y-m-d H:i:s'),
                                'exemptionclasse_exemption_id' => $exemption_id,
                                'exemptionclasse_classe_id' => $classe_id,
                                'exemptionclasse_school_id' => $school_id,
                            );
                            if ($this->model->insert_data('exemptions_classes', $students_exemptions)) {
                                $temoins = 1; //  check if student exemption inserted
                            }

                        }
                        if ($temoins == 1) {
                            $this->model->delete_batch('exemptions_classes', array('exemptionclasse_classe_id' =>null));
                            return redirect()->back()->with('success', "Configuration bourse par classe effectuée avec succés");
                            //return redirect()->to(base_url('fees/details/feeclasse/'.$id_fee));
                        } else {
                            return redirect()->back()->with('failed', "Configuration bourse non effectuée. Veuillez réessayer");
                        }
                    }
                }
            }
        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    public function configStudentScholarship($student_id)
    {

        if ($this->request->getPost() && (!empty($student_id))) {

            $schoolid = $this->session->schoolid;
            $yearid = $this->session->yearid;
            $temoins = 0;
            //Get all exemptions listing
            $exemptions = $this->model->fetch_all_data('exemptions', array('exemption_deleted_at' => null, 'exemption_school_id' => $schoolid), 'exemption_created_at');

            if (!empty($exemptions)) {
                //delete all previous  student exemption configuration
                if ($this->model->delete_batch('exemptions_students', array('feestudent_inscription_id' => $student_id))) {

                    //for all exemptions choosed
                    foreach ($exemptions as $row) {
                        //get choosed exemption by status
                        $exemption_choosed = $this->request->getPost('exemption_status' . $row['exemption_id']);
                        //prepare sql insert
                        $donnees_classes = array(
                            'feestudent_status' => 'actif',
                            'feestudent_notes' => 'Accordee par la methode globale',
                            'feestudent_created_at' => date('Y-m-d H:i:s'),
                            'feestudent_exemption_id' => $exemption_choosed,
                            'feestudent_inscription_id' => $student_id,
                            'feestudent_school_id' => $schoolid,
                        );
                        if ($this->model->insert_data('exemptions_students', $donnees_classes)) {
                            $temoins = 1; //  check if student exemption inserted
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_batch('exemptions_students', array('feestudent_exemption_id' => null));
                            
                        $this->session->setTempdata('studentchoosed', $student_id, 300);
                        session()->setFlashdata('success', "Configuration bourse effectuée avec succés");
                        return redirect()->to(base_url('fees/scholarships'));
                    } else {
                        session()->setFlashdata('failed', "Configuration non effectuée. Veuillez réessayer");
                    }

                } else {
                    foreach ($exemptions as $row) {
                        //get choosed exemption by status
                        $exemption_choosed = $this->request->getPost('exemption_status' . $row['exemption_id']);
                        //prepare sql insert
                        $donnees_classes = array(
                            'feestudent_status' => 'actif',
                            'feestudent_notes' => 'Accordee par la methode globale',
                            'feestudent_created_at' => date('Y-m-d H:i:s'),
                            'feestudent_exemption_id' => $exemption_choosed,
                            'feestudent_inscription_id' => $student_id,
                            'feestudent_school_id' => $schoolid,
                        );
                        if ($this->model->insert_data('exemptions_students', $donnees_classes)) {
                            $temoins = 1; //  check if student exemption inserted
                        }
                    }
                    if ($temoins == 1) {
                        $this->model->delete_batch('exemptions_students', array('feestudent_exemption_id' => null));
                        $this->session->setTempdata('studentchoosed', $student_id, 300);
                        session()->setFlashdata('success', "Configuration bourse effectuée avec succés");
                        return redirect()->to(base_url('fees/scholarships'));
                    } else {
                        session()->setFlashdata('failed', "Configuration non effectuée. Veuillez réessayer");
                    }
                }
            }
        }
    }

    public function exchange($idRow = null)
    {
        $schoolid = $this->session->schoolid;

        if (($this->request->getPost())) {
            //get user session informations
            $datetime = date('Y-m-d H:i:s');

            $rulers = [
                'currency' => [
                    'rules' => 'required', //|is_unique[accounts.account_code]
                    'errors' => [
                        'required' => 'Veuillez sélectionnez la devise',
                        //'is_unique' => 'Ce compte existe déjà dans le système',
                    ],
                ],
                'exchange_value' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir la valeur en monnaie locale',
                        //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                    ],
                ],
                'exchange_started' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir la date de debut',
                        //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                    ],
                ],

            ];
            $currency = $this->request->getPost('currency');
            $value = $this->request->getPost('exchange_value');
            $exchange_started = $this->request->getPost('exchange_started');
            $exchange_ended = $this->request->getPost('exchange_ended');

            $name = setCurrency($currency);
            //run the validation rulers
            if ($this->validate($rulers)) {

                if (empty($idRow)) {
                    $insertNewData = array(
                        'exchange_token' => setPrimaryKey(),
                        'exchange_code' => setReferenceCode(),
                        'exchange_name' => $name,
                        'exchange_currency_id' => ($currency),
                        'exchange_value' => ($value),
                        'exchange_start_date' => $exchange_started,
                        'exchange_end_date' => $exchange_ended,
                        'exchange_status' => 'actif',
                        'exchange_created_at' => $datetime,
                        'exchange_school_id' => $schoolid,
                    );
                    //check before insert data
                    if ($this->model->insert_data('payments_exchanges', $insertNewData)) {
                        return redirect()->back()->with('success', "Taux créé avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                } else {
                    $notes = $this->request->getPost('notes');
                    $updateNewData = array(
                        'exchange_name' => ($name),
                        'exchange_value' => ($value),
                        'exchange_start_date' => $exchange_started,
                        'exchange_end_date' => $exchange_ended,
                        'exchange_currency_id' => ($currency),
                        'exchange_notes' => $notes,
                        'exchange_updated_at' => date('Y-m-d H:i:s'),
                    );
                    //check before insert data
                    if ($this->model->update_data('payments_exchanges', $updateNewData, array('exchange_id' => $idRow))) {
                        return redirect()->back()->with('success', "Taux mise à jour avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                }
            } else {
                session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
                return redirect()->back()->withInput();
            }
        }
    }
}
