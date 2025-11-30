<?php

namespace App\Controllers;

class Finance extends BaseController
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
        $data = [];
        $schoolid = $this->session->schoolid;
        $data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id' => $schoolid), 'bank_created_at');
        $data['title'] = "Financial operations";
        $data['_view'] = "finance/banks";
        return view('layouts/main', $data);
    }
    public function listing($page = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        switch ($page) {
            case 'banks':
                $data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id' => $schoolid), 'bank_created_at');
                break;
            case 'expenses':
            case 'operations':
                $feechoosed = (session()->has('feechoosed')) ? session()->feechoosed : '';
                $section_id = (session()->has('choosedsectionid')) ? (session()->get('choosedsectionid')) : '';

                $data['feesclasses'] = $this->join->fetch_fees_classes(array('section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'DESC', 'fee_id');
                $data['feespayments'] = $this->join->fetch_paydetails_data(array('fee_id' => $feechoosed, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC');
                $data['feesexpenses'] = $this->join->fetch_expenses_data(array('expense_cashbox_id' => $feechoosed, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', FALSE, 'expense_created_at', 'DESC');
                break;

            case 'transactions':
                $cashboxid = (session()->cashboxchoosed) ? session()->cashboxchoosed : '';
                $bank_id = (session()->bankchoosed) ? session()->bankchoosed : '';

                $data['cashbox'] = $this->model->fetch_all_data('finances_cashbox', array('cashbox_deleted_at' => null, 'cashbox_school_id' => $schoolid), 'cashbox_created_at');
                $data['transactions'] = $this->join->fetch_transactions_data(array('transaction_cashbox_id' => $cashboxid, 'transaction_bank_id' => $bank_id, 'transaction_school_id' => $schoolid, 'transaction_year_id' => $yearid), '*', FALSE, 'transaction_created_at');

                $cashbox_currency = (session()->cashboxdata) ? session()->cashboxdata['cashbox_currency'] : '';

                $data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id' => $schoolid, 'bank_account_currency' => $cashbox_currency), 'bank_created_at');
                break;
            default:
        }
        if ($page == 'cashbox') {

            $section_id = (session()->has('choosedsectionid')) ? (session()->get('choosedsectionid')) : '';
            $data['feesclasses'] = $this->join->fetch_fees_classes(array('section_id' => $section_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at', 'DESC');
            $data['daypayments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC');
            $expenses = $this->join->fetch_expenses_data(array('expense_section_id' => $section_id,'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', FALSE, 'expense_created_at', 'DESC');

            if (session()->admin == TRUE OR session()->all == TRUE) {

                $data['feespays'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'fee_id', 'paydetails_paid_amount');
                $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');

            } else {

                $agent = session()->userid;
                $data['payments'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');
                $data['feespays'] = $this->join->fetch_paydetails_data(array('section_id' => $section_id, 'payment_user_id' => $agent, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'feedetail_id', 'paydetails_paid_amount');

            }

            $data['expenses'] = $expenses;
            $payments = $data['payments'];
            $credit_usd_amount = 0;
            $debit_usd_amount = 0;
            $credit_cdf_amount = 0;
            $debit_cdf_amount = 0;

            if (isset($data['feespays']) && !empty($data['feespays'])) {
                foreach ($data['feespays'] as $feesclasse) {
                    if (isset($payments) && !empty($payments)) {
                        $fee_currency = $feesclasse['fee_currency_payable'];
                        $pay_usd_amount = 0;
                        $pay_cdf_amount = 0;
                        foreach ($payments as $pay) {
                            if ($pay['fee_id'] == $feesclasse['fee_id']) {
                                $payment_amount = $pay['paydetails_paid_amount'];
                                $pay_usd_amount += ($fee_currency == 'usd') ? $payment_amount : 0;
                                $pay_cdf_amount += ($fee_currency == 'cdf') ? $payment_amount : 0;
                            }
                        }
                    }

                    $expense_usd_amount = 0;
                    $expense_cdf_amount = 0;
                    if (isset($expenses) && !empty($expenses)) {
                        foreach ($expenses as $expense) {
                            if ($expense['expense_cashbox_id'] == $feesclasse['fee_id']) {
                                if (($expense['expense_type'] != 'exchange')) {
                                    $expense_usd_amount += $expense['expense_usd_amount'];
                                    $expense_cdf_amount += $expense['expense_cdf_amount'];
                                }
                            }
                        }
                    }


                    if ($fee_currency == 'usd') {

                        $credit_usd_amount += floatval($pay_usd_amount);
                        $debit_usd_amount += floatval($expense_usd_amount);

                    } else {
                        $credit_cdf_amount += floatval($pay_cdf_amount);
                        $debit_cdf_amount += floatval($expense_cdf_amount);
                    }
                }
            }
            //dd($data['payments']);

            //foreach ($cashbox_data as $cashboxval) {
            $update_usd_cashbox = array(
                'cashbox_credit_amount' => $credit_usd_amount,
                'cashbox_debit_amount' => $debit_usd_amount,
                'cashbox_balance_amount' => $credit_usd_amount - $debit_usd_amount,
            );
            $this->model->update_data('finances_cashbox', $update_usd_cashbox, array('cashbox_currency' => 'usd', 'cashbox_school_id' => $schoolid));

            $update_cdf_cashbox = array(
                'cashbox_credit_amount' => $credit_cdf_amount,
                'cashbox_debit_amount' => $debit_cdf_amount,
                'cashbox_balance_amount' => $credit_cdf_amount - $debit_cdf_amount,
            );
            $this->model->update_data('finances_cashbox', $update_cdf_cashbox, array('cashbox_currency' => 'cdf', 'cashbox_school_id' => $schoolid));

            $data['cashbox'] = $this->model->fetch_all_data('finances_cashbox', array('cashbox_deleted_at' => null, 'cashbox_school_id' => $schoolid), 'cashbox_created_at');
        }
        //dd( $data['feespays']);

        $data['title'] = "Finances - " . ucwords($page);
        $data['_view'] = "finance/" . $page;
        return view('layouts/main', $data);
    }

    public function printbill($expense_token)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        if (!empty($expense_token)) {
            //$data['cashbox'] = $this->model->fetch_all_data('finances_cashbox', array('cashbox_deleted_at' => null, 'cashbox_school_id' => $schoolid), 'cashbox_created_at');
            $data['expense'] = $this->join->fetch_expenses_data(array('expense_token' => $expense_token, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', TRUE);
            // dd($data['cashbox']);
        }

        $data['title'] = "Finances - Print Bill";
        $data['_view'] = "finance/printbill";
        echo view('layouts/main', $data);
    }
    public function edit($page = null, $token = null)
    {
        $data = [];
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;

        switch ($page) {
            case 'bank':
                $data['banks'] = $this->model->fetch_all_data('finances_banks', array('bank_school_id' => $schoolid), 'bank_created_at');
                $data['bank'] = $this->model->fetch_row_data('finances_banks', array('bank_school_id' => $schoolid, 'bank_token' => $token));
                $data['_view'] = "finance/banks";
                break;
            default:
        }
        // dd($data['cashbox']);
        $data['title'] = "Finances - " . $page;

        return view('layouts/main', $data);
    }
    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'expense':
                $realnametable = 'finances_expenses';
                $real_uid = 'expense_id';
                $updated_time = 'expense_updated_at';
                $status = 'expense_status';
                break;
            case 'bank':
                $realnametable = 'finances_banks';
                $real_uid = 'bank_id';
                $updated_time = 'bank_updated_at';
                $status = 'bank_status';
                break;
            case 'transaction':
                $realnametable = 'finances_transactions';
                $real_uid = 'transaction_id';
                $updated_time = 'transaction_updated_at';
                $status = 'transaction_status';
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
            case 'bank':
                $realnametable = 'finances_banks';
                $real_uid = 'bank_id';
                break;
            case 'expense':
                $realnametable = 'finances_expenses';
                $real_uid = 'expense_id';
                break;
            case 'transaction':
                $realnametable = 'finances_transactions';
                $real_uid = 'transaction_id';
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
    function cashboxExpense($idRow = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $user_id = $this->session->get('userid');
        $expense_section_id = $this->session->get('choosedsectionid');

        //get user session informations
        $datetime = date('Y-m-d H:i:s');

        $rulers = [
            'expense_amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le montant',
                ]
            ],
            'requested_by' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le nom du demandeur',
                ]
            ],
            'approved_by' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir celui qui a autorisé',
                ]
            ],
            'notes' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le motif de sortie',
                ]
            ],
        ];


        $cashbox_id = $this->request->getPost('cashboxid');
        $request_amount = $this->request->getPost('expense_amount');
        $available_amount = $this->request->getPost('cashbox_available_amount');
        $approved_by = $this->request->getPost('approved_by');
        $requested_by = $this->request->getPost('requested_by');
        $notes = $this->request->getPost('notes');
        $currency = $this->request->getPost('cashbox_currency');
        $exchange_value = 0;
        $exchange_data = $this->model->fetch_row_data('payments_exchanges', array('exchange_status' => 'actif', 'exchange_school_id' => $schoolid));
        if ($exchange_data) {
            $exchange_value = $exchange_data['exchange_value'];
        }


        //dd($available_amount);

        if ($this->validate($rulers)) {

            $expense_amount = preg_replace("/[^0-9]/", "", $request_amount);
            $cashbox_amount = preg_replace("/[^0-9]/", "", $available_amount);
            //GET AMOUNT BY REMOVING THE CURRENCY ALIAS
            $expense_amount_value = floatval(substr($expense_amount, 0, -2));
            $available_amount_value = floatval(substr($cashbox_amount, 0, -2));

            if (empty($idRow)) {

                if (!empty($expense_amount_value)) {

                    if ($available_amount_value >= $expense_amount_value) {

                        $insertNewData = array(
                            'expense_token' => setPrimaryKey(),
                            'expense_code' => setReferenceCode(),
                            'expense_exchange' => $exchange_value,
                            'expense_usd_amount' => ($currency == 'usd') ? $expense_amount_value : 0,
                            'expense_cdf_amount' => ($currency == 'cdf') ? $expense_amount_value : 0,
                            'expense_requested_by' => $requested_by,
                            'expense_approved_by' => $approved_by,
                            'expense_notes' => $notes,
                            'expense_status' => 'actif',
                            'expense_category' => 'outgoing',
                            'expense_type' => 'expense',
                            'expense_created_at' => $datetime,
                            'expense_date' => $datetime,
                            'expense_user_id' => $user_id,
                            'expense_year_id' => $yearid,
                            'expense_cashbox_id' => $cashbox_id,
                            'expense_section_id' => $expense_section_id,
                            'expense_school_id' => $schoolid
                        );
                        //check before insert data
                        if ($this->model->insert_data('finances_expenses', $insertNewData)) {

                            //REMOVE CASHBOX SESSION DATA
                            session()->remove('feepaidchoosed');
                            session()->remove('feechoosed');
                            session()->remove('feepaidid');

                            return redirect()->back()->with('success', "Décaissement créé avec succès !");
                        } else {
                            return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                        }
                    } else {
                        session()->setFlashdata('failed', "Le montant sollicité de [$expense_amount_value] est supérieur au montant disponible de [$available_amount_value], veuillez le diminuer");
                        return redirect()->back()->withInput();
                    }
                }
            }
        } else {
            session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
            return redirect()->back()->withInput();
        }
    }
    function cashboxExpenseOld($idRow = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $user_id = $this->session->get('userid');
        $expense_section_id = $this->session->get('choosedsectionid');
        //get user session informations
        $datetime = date('Y-m-d H:i:s');

        $rulers = [
            'expense_amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le montant',
                ]
            ],
            'requested_by' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le nom du demandeur',
                ]
            ],
            'approved_by' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir celui qui a autorisé',
                ]
            ],
            'notes' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le motif de sortie',
                ]
            ],
        ];
        //$available_amount = $this->request->getPost('cashbox_available_amount');

        //dd($available_amount);

        $cashbox_id = $this->request->getPost('cashboxid');
        $request_amount = $this->request->getPost('expense_amount');
        $approved_by = $this->request->getPost('approved_by');
        $requested_by = $this->request->getPost('requested_by');
        $notes = $this->request->getPost('notes');
        $currency = $this->request->getPost('cashbox_currency');
        $exchange_value = 0;
        $exchange_data = $this->model->fetch_row_data('payments_exchanges', array('exchange_status' => 'actif', 'exchange_school_id' => $schoolid));
        if ($exchange_data) {
            $exchange_value = $exchange_data['exchange_value'];
        }

        if ($this->validate($rulers)) {

            $expense_amount = preg_replace("/[^0-9]/", "", $request_amount);
            //$cashbox_amount = preg_replace("/[^0-9]/", "", $available_amount);
            //GET AMOUNT BY REMOVING THE CURRENCY ALIAS
            $amount_value = floatval(substr($expense_amount, 0, -2));
            //$cashbox_amount_available = floatval(substr($cashbox_amount, 0, -2));

            if (empty($idRow)) {
                $cashbox_data = $this->model->fetch_row_data('finances_cashbox', array('cashbox_id' => $cashbox_id));
                if (!empty($cashbox_data)) {

                    $cashbox_debit = $cashbox_data['cashbox_debit_amount'];
                    $cashbox_credit = $cashbox_data['cashbox_credit_amount'];

                    $cashbox_amount_available = $cashbox_credit - $cashbox_debit;

                    if ($cashbox_amount_available >= $amount_value) {

                        $insertNewData = array(
                            'expense_token' => setPrimaryKey(),
                            'expense_code' => setReferenceCode(),
                            'expense_exchange' => $exchange_value,
                            'expense_usd_amount' => ($currency == 'usd') ? $amount_value : 0,
                            'expense_cdf_amount' => ($currency == 'cdf') ? $amount_value : 0,
                            'expense_requested_by' => $requested_by,
                            'expense_approved_by' => $approved_by,
                            'expense_notes' => $notes,
                            'expense_status' => 'actif',
                            'expense_category' => 'outgoing',
                            'expense_type' => 'expense',
                            'expense_created_at' => $datetime,
                            'expense_date' => $datetime,
                            'expense_user_id' => $user_id,
                            'expense_year_id' => $yearid,
                            'expense_cashbox_id' => $cashbox_id,
                            'expense_section_id' => $expense_section_id,
                            'expense_school_id' => $schoolid
                        );
                        //check before insert data
                        if ($this->model->insert_data('finances_expenses', $insertNewData)) {

                            //UPDATE ALSO CASHBOX DEBIT AMOUNT
                            $this->updateCashboxAmount($cashbox_id, $amount_value, 'update', FALSE, FALSE);
                            //REMOVE CASHBOX SESSION DATA
                            session()->remove('cashboxdata');
                            session()->remove('cashboxavailable');

                            return redirect()->back()->with('success', "Décaissement créé avec succès !");
                        } else {
                            return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                        }
                    } else {
                        session()->setFlashdata('failed', "Le montant sollicité de [$amount_value] est supérieur au montant disponible de [$cashbox_amount_available], veuillez le diminuer");
                        return redirect()->back()->withInput();
                    }
                }
            } else {
                /* ============== IF UPDATE EXPENSE =================*/
                $expense_data = $this->join->fetch_expenses_data(array('expense_id' => $idRow), '*', TRUE);
                if (!empty($expense_data)) {
                    $expense_usd_amount = $expense_data['expense_usd_amount'];
                    $expense_cdf_amount = $expense_data['expense_cdf_amount'];
                    $amount_updated = ($currency == 'cdf') ? $expense_cdf_amount : $expense_usd_amount;

                    $amount_cashbox_available = $expense_data['cashbox_credit_amount'] - ($expense_data['cashbox_debit_amount'] + $amount_updated);

                    if ($amount_cashbox_available >= $amount_value) {
                        //BEGIN BY UPDATING CASHBOX AMOUNT FOR OLD EXPENSE
                        $this->updateCashboxAmount($cashbox_id, $amount_updated, 'add');

                        //UPDATE EXPENSE AMOUNT
                        $updateNewData = array(
                            'expense_usd_amount' => ($currency == 'usd') ? $amount_value : 0,
                            'expense_cdf_amount' => ($currency == 'cdf') ? $amount_value : 0,
                            'expense_requested_by' => $requested_by,
                            'expense_approved_by' => $approved_by,
                            'expense_notes' => $notes,
                            'expense_updated_at' => $datetime,
                        );
                        //check before insert data
                        if ($this->model->update_data('finances_expenses', $updateNewData, array('expense_id' => $idRow))) {

                            //UPDATE ALSO CASHBOX AMOUNT
                            $this->updateCashboxAmount($cashbox_id, $amount_value, 'update');

                            return redirect()->back()->with('success', "Décaissement mise à jour avec succès");
                        } else {
                            return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                        }
                    } else {
                        session()->setFlashdata('failed', "Le montant sollicité de [$amount_value] est supérieur au montant disponible de [$amount_cashbox_available], veuillez le diminuer");
                        return redirect()->back()->withInput();
                    }
                }
            }

        } else {
            session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
            return redirect()->back()->withInput();
        }
    }
    function updateCashboxAmount($cashbox_id, $oper_amount, $action = 'update', $credit = FALSE, $debit = FALSE)
    {
        $cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_id' => $cashbox_id));
        if (!empty($cashbox)) {

            $cashbox_debit = $cashbox['cashbox_debit_amount'];
            $cashbox_credit = $cashbox['cashbox_credit_amount'];
            $cashbox_debit_amount = 0;
            $cashbox_credit_amount = 0;
            $cashbox_balance = 0;
            if ($action == 'add') {
                $cashbox_debit_amount = ($debit == TRUE) ? $cashbox_debit + $oper_amount : $cashbox_debit;
                $cashbox_credit_amount = ($credit == TRUE) ? $cashbox_credit + $oper_amount : $cashbox_credit;
                $cashbox_balance = $cashbox_credit_amount - $cashbox_debit_amount;
            } elseif ($action == 'update') {
                $cashbox_debit_amount = ($debit == TRUE) ? $cashbox_debit - $oper_amount : $cashbox_debit + $oper_amount;
                $cashbox_credit_amount = ($credit == TRUE) ? $cashbox_credit - $oper_amount : $cashbox_credit;
                $cashbox_balance = $cashbox_credit_amount - $cashbox_debit_amount;
            } else {
                $cashbox_debit_amount = $cashbox_debit;
                $cashbox_credit_amount = $cashbox_credit;
                $cashbox_balance = $cashbox_credit_amount - $cashbox_debit_amount;
            }

            $cashbox_update_data = array(
                'cashbox_updated_at' => date('Y-m-d H:i:s'),
                'cashbox_credit_amount' => $cashbox_credit_amount,
                'cashbox_debit_amount' => $cashbox_debit_amount,
                'cashbox_balance_amount' => $cashbox_balance,
            );
            /* ============== UPDATE CASHBOX SESSION DATA ===== */
            $this->session->setTempdata('cashboxavailable', $cashbox_balance, 1000);

            $this->model->update_data('finances_cashbox', $cashbox_update_data, array('cashbox_id' => $cashbox_id));
        }
    }
    function cashboxOperation($idRow = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $user_id = $this->session->get('userid');
        $expense_section_id = $this->session->get('choosedsectionid');

        //get user session informations
        $datetime = date('Y-m-d H:i:s');

        $rulers = [
            'debit_amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le montant sortie',
                ]
            ],
            'credit_amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le montant entrée',
                ]
            ],
            'operation' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez sélectionner une opération',
                ]
            ],
        ];


        if ($this->validate($rulers)) {
            //$available_amount = $this->request->getPost('cashbox_available_amount');
            $cashbox_id = $this->request->getPost('cashboxid');
            $operation = $this->request->getPost('operation');
            $notes = $this->request->getPost('notes');

            $currency = $this->request->getPost('cashbox_currency');
            $exchange_value = 0;
            $exchange_data = $this->model->fetch_row_data('payments_exchanges', array('exchange_status' => 'actif', 'exchange_school_id' => $schoolid));

            if ($exchange_data) {
                $exchange_value = $exchange_data['exchange_value'];
            }
            $debit_amount_value = $this->request->getPost('debit_amount');
            $debit_amount_numeric = preg_replace("/[^0-9]/", "", $debit_amount_value);

            $credit_amount_value = $this->request->getPost('credit_amount');
            $credit_amount_numeric = preg_replace("/[^0-9]/", "", $credit_amount_value);
            //GET AMOUNT BY REMOVING THE CURRENCY ALIAS
            $debit_operation_amount = floatval(substr($debit_amount_numeric, 0, -2));
            $credit_operation_amount = floatval(substr($credit_amount_numeric, 0, -2));


            if ($operation == 'exchange' && ($credit_operation_amount == 0)) {

                session()->setFlashdata('failed', "Veuillez saisir le montant entrée pour effectuer le changement de monnaie");
                return redirect()->back()->withInput();
            }
            if ($operation == 'returning' && ($credit_operation_amount != 0)) {

                session()->setFlashdata('failed', "Le montant d'entrée ne doit pas etre renseigner pour effectuer le remboursement");
                return redirect()->back()->withInput();
            }
            $oper_usd_amount = ($currency == 'cdf') ? $credit_operation_amount : $debit_operation_amount;
            $oper_cdf_amount = ($currency == 'cdf') ? $debit_operation_amount : $credit_operation_amount;

            $category = ($operation == 'exchange' && $currency == 'cdf') ? 'usdin' : 'usdout';

            if (empty($idRow)) {

                $insertNewData = array(
                    'expense_token' => setPrimaryKey(),
                    'expense_code' => setReferenceCode(),
                    'expense_exchange' => $exchange_value,
                    'expense_usd_amount' => $oper_usd_amount,
                    'expense_cdf_amount' => $oper_cdf_amount,
                    'expense_notes' => $notes,
                    'expense_status' => 'actif',
                    'expense_category' => $category,
                    'expense_type' => $operation,
                    'expense_created_at' => $datetime,
                    'expense_date' => $datetime,
                    'expense_user_id' => $user_id,
                    'expense_year_id' => $yearid,
                    'expense_cashbox_id' => $cashbox_id,
                    'expense_section_id' => $expense_section_id,
                    'expense_school_id' => $schoolid
                );
                //check before insert data
                if ($this->model->insert_data('finances_expenses', $insertNewData)) {

                    //UPDATE ALSO CASHBOX AMOUNT
                    $cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency' => $currency));
                    if (!empty($cashbox)) {
                        $cashbox_debit = $cashbox['cashbox_debit_amount'];
                        $cashbox_credit = $cashbox['cashbox_credit_amount'];
                        $amount_credit_total = ($currency == 'usd') ? $oper_usd_amount : $oper_cdf_amount;
                        $amount_debit_total = ($currency == 'usd') ? $oper_usd_amount : $oper_cdf_amount;
                        $cashbox_update_current = array(
                            'cashbox_updated_at' => date('Y-m-d H:i:s'),
                            'cashbox_credit_amount' => $cashbox_credit - $amount_credit_total,
                            'cashbox_debit_amount' => $cashbox_debit + $amount_debit_total,
                        );

                        session()->set('cashboxdata', $cashbox); //UPDATE CASHBOX DATA IN SESSION

                        $cashboxupdated = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency !=' => $currency));
                        //$cashbox_debit_update = $cashboxupdate['cashbox_debit_amount'];
                        $cashbox_credit_updated = $cashboxupdated['cashbox_credit_amount'];
                        $amount_credit_updated = ($currency == 'usd') ? $oper_cdf_amount : $oper_usd_amount;

                        $cashbox_updated_credit = array(
                            'cashbox_updated_at' => date('Y-m-d H:i:s'),
                            'cashbox_credit_amount' => $cashbox_credit_updated + $amount_credit_updated,
                            //'cashbox_debit_amount' =>  $cashbox_debit_update - $oper_cdf_amount,
                        );


                        $this->model->update_data('finances_cashbox', $cashbox_update_current, array('cashbox_currency' => $currency));
                        $this->model->update_data('finances_cashbox', $cashbox_updated_credit, array('cashbox_currency !=' => $currency));

                    }
                    //REMOVE CASHBOX SESSION DATA
                    session()->remove('cashboxdata');
                    session()->remove('cashboxavailable');

                    return redirect()->back()->with('success', "Opération caisse créée avec succès !");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                }

            } else {
                session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
                return redirect()->back()->withInput();
            }

        } else {
            session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
            return redirect()->back()->withInput();
        }
    }
    function cancelExpenseOperation($expense_id = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $notes = $this->request->getPost('notes');
        $currency = $this->request->getPost('currency');
        if (empty($idRow)) {
            //GET EXPENSE DATA BY ID
            $expense_db_data = $this->join->fetch_expenses_data(array('expense_id' => $expense_id, 'expense_school_id' => $schoolid, 'expense_year_id' => $yearid), '*', TRUE);
            if (!empty($expense_db_data)) {

                $oper_usd_amount = $expense_db_data['expense_usd_amount'];
                $oper_cdf_amount = $expense_db_data['expense_cdf_amount'];
                $operation_type = $expense_db_data['expense_type'];

                $cancel_operation_data = array(
                    'expense_exchange' => 0,
                    'expense_usd_amount' => 0,
                    'expense_cdf_amount' => 0,
                    'expense_notes' => $notes,
                    'expense_status' => 'cancel',
                );
                if ($this->model->update_data('finances_expenses', $cancel_operation_data, array('expense_id' => $expense_id))) {


                    if ($operation_type == 'exchange') {
                        //UPDATE ALSO CASHBOX AMOUNT
                        $cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency' => $currency));
                        if (!empty($cashbox)) {

                            $cashbox_debit = $cashbox['cashbox_debit_amount'];
                            $cashbox_credit = $cashbox['cashbox_credit_amount'];
                            $amount_credit_total = ($currency == 'usd') ? $oper_usd_amount : $oper_cdf_amount;
                            $amount_debit_total = ($currency == 'usd') ? $oper_usd_amount : $oper_cdf_amount;

                            $cashbox_update_current = array(
                                'cashbox_updated_at' => date('Y-m-d H:i:s'),
                                'cashbox_credit_amount' => $cashbox_credit + $amount_credit_total,
                                'cashbox_debit_amount' => $cashbox_debit - $amount_debit_total,
                            );
                            $cashboxupdated = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency !=' => $currency));
                            $cashbox_credit_updated = $cashboxupdated['cashbox_credit_amount'];
                            $amount_credit_updated = ($currency == 'usd') ? $oper_cdf_amount : $oper_usd_amount;

                            $cashbox_updated_credit = array(
                                'cashbox_updated_at' => date('Y-m-d H:i:s'),
                                'cashbox_credit_amount' => $cashbox_credit_updated - $amount_credit_updated,
                            );

                            $this->model->update_data('finances_cashbox', $cashbox_update_current, array('cashbox_currency' => $currency));
                            $this->model->update_data('finances_cashbox', $cashbox_updated_credit, array('cashbox_currency !=' => $currency));

                            session()->set('cashboxdata', $cashbox); //UPDATE CASHBOX DATA IN SESSION
                        }
                    }

                    return redirect()->back()->with('success', "Annulation effectuée avec succès !");

                } else {

                    return redirect()->back()->with('failed', "Annulation non effectuée suite aux problèmes du serveur. Veuillez réessayer plus tard !");

                }
            }
        } else {

            return redirect()->back()->with('failed', "Veuillez choisir une opération. Veuillez réessayer plus tard !");

        }
    }

    public function bankAccount($bank_id = null)
    {
        $schoolid = $this->session->schoolid;

        $rulers = [
            'account_number' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez saisir le numero du compte",
                ],
            ],
            'account_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez saisir le nom du compte",
                ],
            ],
            'currency' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez selectionner la devise du compte",
                ],
            ],
            'account_type' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez selectionner le type du compte",
                ],
            ],
            'bank_name' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez saisir le nom de la banque",
                ],
            ],
            'bank_address' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Veuillez saisir une adresse valide de la banque",
                ],
            ],
        ];

        if ($this->validate($rulers)) {

            $account_number = (($this->request->getPost('account_number')));
            $account_name = (($this->request->getPost('account_name')));
            $account_swift_code = (($this->request->getPost('account_code')));
            $account_type = (($this->request->getPost('account_type')));
            $account_currency = (($this->request->getPost('currency')));
            $bank_name = (($this->request->getPost('bank_name')));
            $bank_address = (($this->request->getPost('bank_address')));
            $account_phone = (($this->request->getPost('bank_phone')));
            $account_mail = (($this->request->getPost('bank_mail')));
            $notes = (($this->request->getPost('notes')));

            $current_datetime = date('Y-m-d H:i:s');
            if (!empty($bank_id)) {
                $updateTypeData = [
                    'bank_name' => $bank_name,
                    'bank_address' => $bank_address,
                    'bank_account_number' => $account_number,
                    'bank_account_name' => $account_name,
                    'bank_account_type' => $account_type,
                    'bank_account_currency' => $account_currency,
                    'bank_account_code' => $account_swift_code,
                    'bank_phone' => $account_phone,
                    'bank_email' => $account_mail,
                    'bank_notes' => $notes,
                    'bank_updated_at' => $current_datetime,
                    'bank_school_id' => $schoolid,
                ];
                //update data in table
                if ($this->model->update_data('finances_banks', $updateTypeData, array('bank_id' => $bank_id))) {
                    return redirect()->back()->with('success', "Modification effectuée avec succès");
                }
            } else {
                if ($this->model->fetch_row_data('finances_banks', array('bank_account_number' => $account_number))) {
                    return redirect()->back()->with('failed', "Le compte $account_number existe dans le système, veuillez créer un autre");
                }
                //create new type
                $createNewTypeData = [
                    'bank_token' => setPrimaryKey(),
                    'bank_code' => setReferenceCode(),
                    'bank_name' => $bank_name,
                    'bank_address' => $bank_address,
                    'bank_account_number' => $account_number,
                    'bank_account_name' => $account_name,
                    'bank_account_type' => $account_type,
                    'bank_account_currency' => $account_currency,
                    'bank_account_code' => $account_swift_code,
                    'bank_phone' => $account_phone,
                    'bank_email' => $account_mail,
                    'bank_notes' => $notes,
                    'bank_school_id' => $schoolid,
                    'bank_status' => 'actif',
                    'bank_created_at' => $current_datetime,
                ];
                //save new data in table
                if ($this->model->insert_data('finances_banks', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création compte bancaire effectuée avec succés");
                }
            }

        } else {
            $this->session->setTempdata('failed', "Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }
    function transactionsAccountBanking()
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $user_id = $this->session->get('userid');


        //get user session informations
        $datetime = date('Y-m-d H:i:s');

        $rulers = [
            'transaction_amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez saisir le montant',
                ]
            ],
            'bankid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez indiquer un compte bancaire',
                ]
            ],
            'cashboxid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez indiquer une caisse',
                ]
            ],
            'transaction' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Veuillez indiquer un type de transaction',
                ]
            ],
            /*'slip' => [
                'rules' => 'required',
                'uploaded[slip]',
                'mime_in[slip,image/jpg,image/jpeg,image/png],image/webp], application/pdf, application/docx',
                'max_size[slip,4096]',
                'errors' => [
                    'required' => 'Veuillez indiquer un bordereau ou bon de caisse',
                    'uploaded' => 'Veuillez indiquer un fichier au format Image ou Pdf avec une taille de 4Mo',
                ]
            ]*/
        ];


        if ($this->validate($rulers)) {

            if ((!session()->has('slipfile'))) {
                if ($this->request->getFile('slip')) {
                    $slip_file = $this->request->getFile('slip');
                    if ($slip_file->isValid() && !$slip_file->hasMoved()) {

                        $slip_file_name = $slip_file->getRandomName();//rename file
                        $fullPathFile = 'public/uploads/files';

                        $slip_file->move(ROOTPATH . $fullPathFile, $slip_file_name);//move to upload directory

                        if (file_exists(ROOTPATH . $fullPathFile . '/' . $slip_file_name)) {

                            session()->set('slipfile', $slip_file_name);

                        }

                    } else {
                        return redirect()->back()->with('failed', "La preuve de la transaction est invalide !");
                    }
                } else {
                    return redirect()->back()->with('failed', "Veuillez attacher une preuve de la transaction(Bordereau ou Bon de caisse) !");
                }
            }
            $cashbox_balance_amount = $this->session->get('cashboxavailable');
            $bank_balance_amount = $this->session->get('bankbalance');
            $cashbox_id = $this->request->getPost('cashboxid');
            $transaction_amount = $this->request->getPost('transaction_amount');
            $bank_id = $this->request->getPost('bankid');
            $transaction = $this->request->getPost('transaction');
            $notes = $this->request->getPost('notes');
            $currency = $this->request->getPost('transaction_currency');

            $exchange_value = 0;

            $exchange_data = $this->model->fetch_row_data('payments_exchanges', array('exchange_status' => 'actif', 'exchange_school_id' => $schoolid));
            if ($exchange_data) {
                $exchange_value = $exchange_data['exchange_value'];
            }
            $trans_amount = preg_replace("/[^0-9]/", "", $transaction_amount);
            //GET AMOUNT BY REMOVING THE CURRENCY ALIAS
            $transac_amount_value = floatval(substr($trans_amount, 0, -2));
            $cashbox_amount_available = floatval($cashbox_balance_amount);
            $bank_amount_available = floatval($bank_balance_amount);

            //SEND MONEY FROM CASHBOX TO BANK ACCOUNT
            if ($transaction == 'cashbox' && ($transac_amount_value > $cashbox_amount_available)) {

                session()->setFlashdata('failed', "Le montant [$transac_amount_value] est supérieur au montant disponible de [$cashbox_amount_available], veuillez le diminuer");
                return redirect()->back()->withInput();

            } elseif ($transaction == 'bank' && ($transac_amount_value > $bank_amount_available)) {

                session()->setFlashdata('failed', "Le montant [$transac_amount_value] est supérieur au montant disponible de [$bank_amount_available], veuillez le diminuer");
                return redirect()->back()->withInput();

            } else {

                //INSERT DATA PREPARE
                $insertNewData = array(
                    'transaction_token' => setPrimaryKey(),
                    'transaction_code' => setReferenceCode(),
                    'transaction_exchange' => $exchange_value,
                    'transaction_currency' => $currency,
                    'transaction_amount' => $transac_amount_value,
                    'transaction_attachment' => session()->get('slipfile'),
                    'transaction_notes' => $notes,
                    'transaction_status' => 'actif',
                    'transaction_type' => $transaction,
                    'transaction_created_at' => $datetime,
                    'transaction_user_id' => $user_id,
                    'transaction_year_id' => $yearid,
                    'transaction_bank_id' => $bank_id,
                    'transaction_cashbox_id' => $cashbox_id,
                    'transaction_school_id' => $schoolid
                );
                //check before insert data
                if ($this->model->insert_data('finances_transactions', $insertNewData)) {

                    /*==== UPDATE ALSO CASHBOX AND BANK ACCOUNT DATA =====*/
                    if ($transaction == 'bank') {
                        /* === CREDIT CASHBOX AMOUNT ===*/
                        $this->updateCashboxAmount($cashbox_id, $transac_amount_value, 'add', TRUE, FALSE);
                        /* === AND DEBIT BANK ACCOUNT AMOUNT ===*/
                        $this->updateAccountBankAmount($bank_id, $transac_amount_value, 'add', FALSE, TRUE);
                    } else {
                        /* === ONLY DEBIT CASHBOX AMOUNT ===*/
                        $this->updateCashboxAmount($cashbox_id, $transac_amount_value, 'add', FALSE, TRUE);
                        /* === ONLY CREDIT BANK ACCOUNT AMOUNT ===*/
                        $this->updateAccountBankAmount($bank_id, $transac_amount_value, 'add', TRUE, FALSE);
                    }

                    //REMOVE CASHBOX SESSION DATA
                    session()->remove('cashboxdata');
                    session()->remove('cashboxavailable');
                    session()->remove('bankdata');
                    session()->remove('bankbalance');
                    session()->remove('slipfile');

                    return redirect()->back()->with('success', "Transaction bancaire effectuée avec succès !");
                } else {
                    return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                }


            }
        } else {
            session()->setFlashdata('failed', "Veuillez vérifier les données saisies ci-dessous.");
            return redirect()->back()->withInput();
        }
    }
    function updateAccountBankAmount($bank_id, $transaction_amount, $action = 'update', $credit = FALSE, $debit = FALSE)
    {
        $bank_account = $this->model->fetch_row_data('finances_banks', array('bank_id' => $bank_id));
        if (!empty($bank_account)) {

            $bank_account_debit = $bank_account['bank_debit_amount'];
            $bank_account_credit = $bank_account['bank_credit_amount'];

            /* === bank: BANK -> CASHBOX AND CREDIT: CASHBOX -> BANK ===*/

            $bank_account_credit_amount = 0;
            $bank_account_debit_amount = 0;
            $bank_account_balance = 0;

            if ($action == 'add') {
                $bank_account_debit_amount = ($debit == TRUE) ? $bank_account_debit + $transaction_amount : $bank_account_debit;
                $bank_account_credit_amount = ($credit == TRUE) ? $bank_account_credit + $transaction_amount : $bank_account_credit;
                $bank_account_balance = $bank_account_credit_amount - $bank_account_debit_amount;
            } elseif ($action == 'update') {
                $bank_account_debit_amount = ($debit == TRUE) ? $bank_account_debit - $transaction_amount : $bank_account_debit;
                $bank_account_credit_amount = ($credit == TRUE) ? $bank_account_credit - $transaction_amount : $bank_account_credit;
                $bank_account_balance = $bank_account_credit_amount - $bank_account_debit_amount;
            } else {
                $bank_account_debit_amount = $bank_account_debit;
                $bank_account_credit_amount = $bank_account_credit;
                $bank_account_balance = $bank_account_credit_amount - $bank_account_debit_amount;
            }


            $bank_update_data = array(
                'bank_updated_at' => date('Y-m-d H:i:s'),
                'bank_credit_amount' => $bank_account_credit_amount,
                'bank_debit_amount' => $bank_account_debit_amount,
                'bank_balance_amount' => $bank_account_balance,
            );
            /* ============== UPDATE CASHBOX SESSION DATA ===== */
            $this->session->setTempdata('bankbalance', $bank_account_balance, 1000);

            $this->model->update_data('finances_banks', $bank_update_data, array('bank_id' => $bank_id));
        }
    }
    function cancelBankTransaction($transaction_id = null)
    {
        $schoolid = $this->session->schoolid;
        $yearid = $this->session->yearid;
        $notes = $this->request->getPost('notes');
        if (empty($idRow)) {
            //GET EXPENSE DATA BY ID
            $transaction_data = $this->join->fetch_transactions_data(array('transaction_id' => $transaction_id, 'transaction_school_id' => $schoolid, 'transaction_year_id' => $yearid), '*', TRUE);
            if (!empty($transaction_data)) {

                //$currency = $transaction_data['transaction_currency'];
                $transaction_amount = $transaction_data['transaction_amount'];
                $bank_id = $transaction_data['transaction_bank_id'];
                $cashbox_id = $transaction_data['transaction_cashbox_id'];
                $transaction_type = $transaction_data['transaction_type'];

                $cancel_operation_data = array(
                    'transaction_exchange' => 0,
                    'transaction_amount' => 0,
                    'transaction_notes' => $notes,
                    'transaction_status' => 'cancel',
                );
                if ($this->model->update_data('finances_transactions', $cancel_operation_data, array('transaction_id' => $transaction_id))) {

                    /*==== UPDATE ALSO CASHBOX AND BANK ACCOUNT DATA =====*/
                    if ($transaction_type == 'bank') {
                        /* === AND DEBIT CASHBOX AMOUNT ===*/
                        $this->updateCashboxAmount($cashbox_id, $transaction_amount, 'update', TRUE, FALSE);
                        /* === AND DEBIT BANK ACCOUNT AMOUNT ===*/
                        $this->updateAccountBankAmount($bank_id, $transaction_amount, 'update', FALSE, TRUE);
                    } else {
                        /* === ONLY DEBIT CASHBOX AMOUNT ===*/
                        $this->updateCashboxAmount($cashbox_id, $transaction_amount, 'update', FALSE, TRUE);
                        /* === ONLY CREDIT BANK ACCOUNT AMOUNT ===*/
                        $this->updateAccountBankAmount($bank_id, $transaction_amount, 'update', TRUE, FALSE);
                    }
                    session()->remove('cashboxdata');
                    session()->remove('cashboxavailable');
                    session()->remove('bankdata');
                    session()->remove('bankbalance');

                    return redirect()->back()->with('success', "Annulation transaction effectuée avec succès !");

                } else {

                    return redirect()->back()->with('failed', "Annulation non effectuée suite aux problèmes du serveur. Veuillez réessayer plus tard !");

                }
            }
        } else {

            return redirect()->back()->with('failed', "Veuillez choisir une opération. Veuillez réessayer plus tard !");

        }
    }
}