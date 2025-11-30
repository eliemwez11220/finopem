<?php
namespace App\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\RoundBlockSizeMode;

class Payment extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(base_url('logout')); // redirect to login page if not connected
        } else {
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }
    public function index()
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $feeid = (session()->has('feepaidid')) ? session()->get('feepaidid') : '';
        $classe_id = (session()->has('studentclasseid')) ? session()->get('studentclasseid') : '';

        $data['classes'] = $this->join->fetch_join_classes(array('classe_school_id' => $schoolid, 'classe_status' => 'actif'), 'degree_code');
        $data['feesclasses'] = $this->join->fetch_fees_classes(array('feedetail_fee_id' => $feeid, 'feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');

        $data['feespayables'] = $this->join->fetch_fees_classes(array('feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'fee_name', 'ASC', 'fee_name');

        $data['feesdetails'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_fee_id' => $feeid, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
        $data['fees'] = $this->model->fetch_all_data('fees', array('fee_school_id' => $schoolid), 'fee_created_at');

        $studentid = (session()->has('studentchoosed')) ? session()->get('studentchoosed') : '';
        $data['student'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'inscription_id' => $studentid), '*', true);
        $data['studentsinscriptions'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid), '*', false, 'inscription_created_at', 'DESC');
        
        //$choosed_fee_data = session()->has('feechoosedclasse') ? session()->feechoosedclasse : '';
        $choosed_fee_data = session()->has('feepaidchoosed') ? session()->get('feepaidchoosed') : '';
        $feecurrency = (!empty($choosed_fee_data)) ? $choosed_fee_data['fee_currency_payable']:'';
        //$data['allexemptions'] = $this->model->fetch_all_data('exemptions', array('exemption_year_id' => $yearid, 'exemption_school_id' => $schoolid), 'exemption_created_at');
        $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'feestudent_inscription_id' => $studentid, 'feestudent_school_id' => $schoolid), '*', FALSE, 'exemption_created_at', 'DESC');
        $data['feesexemptions'] = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
        $data['classesexemptions'] = $this->join->fetch_exemptions_classes(array('exemption_currency' => $feecurrency,'exemptionclasse_classe_id' => $classe_id, 'exemption_year_id' => $yearid, 'exemptionclasse_school_id' => $schoolid), '*', FALSE, 'exemption_name', 'ASC', 'exemptionclasse_exemption_id', 'exemption_cost_discount');
        
        $data['payments'] = $this->join->fetch_payments_data(array('payment_year_id' => $yearid, 'payment_student_id' => $studentid, 'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'paydetails_fee_id', 'paydetails_paid_amount');
        $data['paydetails'] = $this->join->fetch_paydetails_data(array('feedetail_fee_id' => $feeid, 'payment_year_id' => $yearid, 'payment_student_id' => $studentid, 'payment_school_id' => $schoolid), '*', false, 'payment_created_at', 'DESC');
        $data['exchange'] = $this->model->fetch_row_data('payments_exchanges', array('exchange_status' => 'actif', 'exchange_school_id' => $schoolid));

       if(session()->has('paymentencoding')){
            $data['title'] = "Encoding Bills Payment Fees";
            $data['_view'] = "payment/encoding";
            echo view('layouts/main', $data);
        }else{
            $data['title'] = "Gestion Paiement Frais - ";
            $data['_view'] = "payment/create";
            echo view('layouts/main', $data);
        }
    }
    public function paymentDateApplying()
    {
        $paydate = ($this->request->getGet('paydate')) ? $this->request->getGet('paydate') : date('Y-m-d');

        if (!empty($paydate)) {

            session()->set('paydate', $paydate);

            session()->setFlashdata('success', "Payment date successfuly applyied to $paydate!");

        } else {
            session()->setFlashdata('failed', "Please select valide payment date to apply!");
        }
        return redirect()->to(base_url('payments'));
    }
    public function bills()
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $started = $this->request->getGet('started') ? $this->request->getGet('started') : date('Y-m-d');
        $closing = ($this->request->getGet('closing')) ? $this->request->getGet('closing') : date('Y-m-d');

        $data['bills'] = $this->join->fetch_paydetails_data(array('payment_year_id' => $yearid, 'payment_school_id' => $schoolid), '*', false, 'fee_name', 'DESC', 'payment_code', 'paydetails_paid_amount', null, null, 'payment_date', $started, $closing);

        $data['start'] = $started;
        $data['end'] = $closing;

        $data['title'] = "Bills payment fees";
        $data['_view'] = "payment/bills";
        echo view('layouts/main', $data);
    }
    public function billdetail($paytoken = null)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        if (!empty($paytoken)) {
            $data['bill'] = $this->join->fetch_payments_data(array('payment_year_id' => $yearid, 'payment_token' => $paytoken, 'payment_school_id' => $schoolid), '*', true);
            if (!empty($data['bill'])) {
                
                $studentid = $data['bill']['payment_student_id'];
                $paid_fee_id = $data['bill']['paydetails_fee_id'];
                $data['payments'] = $this->join->fetch_paydetails_data(array('payment_token !=' => $paytoken,'payment_year_id' => $yearid, 'payment_student_id' => $studentid, 'paydetails_fee_id' => $paid_fee_id,'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'paydetails_fee_id', 'paydetails_paid_amount');
                $data['paydetails'] = $this->join->fetch_paydetails_data(array('payment_token' => $paytoken,'payment_year_id' => $yearid, 'payment_student_id' => $studentid, 'paydetails_fee_id' => $paid_fee_id, 'payment_school_id' => $schoolid), '*', false, 'payment_created_at', 'ASC');

            }
        }

        $data['title'] = "Details Recu";
        $data['_view'] = 'payment/bill';
        echo view('layouts/main', $data);
    }
    public function printbill($paytoken = null)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        if (!empty($paytoken)) {
            $data['bill'] = $this->join->fetch_payments_data(array('payment_year_id' => $yearid, 'payment_token' => $paytoken, 'payment_school_id' => $schoolid), '*', true);
            //$data['paydetails'] = $this->join->fetch_paydetails_data(array('payment_year_id' => $yearid, 'payment_token' => $paytoken, 'payment_school_id' => $schoolid), '*', false, 'payment_created_at', 'DESC');
            if (!empty($data['bill'])) {
                $studentid = $data['bill']['payment_student_id'];
                $paid_fee_id = $data['bill']['paydetails_fee_id'];
                //'paydetails_fee_id' => $paid_fee_id,
                $data['payments'] = $this->join->fetch_paydetails_data(array('payment_token !=' => $paytoken,'payment_year_id' => $yearid, 'payment_student_id' => $studentid, 'paydetails_fee_id' => $paid_fee_id,'payment_school_id' => $schoolid), '*', false, 'payment_date', 'DESC', 'paydetails_fee_id', 'paydetails_paid_amount');
                $data['paydetails'] = $this->join->fetch_paydetails_data(array('payment_token' => $paytoken,'payment_year_id' => $yearid, 'payment_student_id' => $studentid,  'payment_school_id' => $schoolid), '*', false, 'payment_created_at', 'ASC');

            
                //dd($data['paydetails']);
                /* === SEND EMAIL AND SMS ONLY IF PAYMENT HAVE SESSION TOKEN ==*/
                if (session()->has('paymenttoken')) {
                    //SEND EMAIL
                    $this->sendPaymentMessage($data['bill'], $data['paydetails']);
                    $sending_status = session()->has('schoolsmsstatus') ? session()->get('schoolsmsstatus') : 0;
                    if ($sending_status == 1) {
                        //send sms to parent if section is active
                        if(session()->has('sectionsendsms')  &&  session()->get('sectionsendsms') == 'actif'){
                        //SEND SMS MESSAGE
                            session()->remove('feessms');
                            session()->remove('feenamesms');
                            $this->sendSmsPayment($data['bill'], $data['paydetails']);
                        } 
                    }
                }
            }
        }

        session()->remove('paymenttoken');
        session()->remove('feepaidid');
        session()->remove('feepaidchoosed');
        session()->remove('feechoosed');
        session()->remove('feechoosedclasse');
        session()->remove('studentchoosed');
        session()->remove('studentclasse');
        session()->remove('studentclasseid');

        //dd($data['bill']);
        $data['title'] = "Impression";
        echo view('payment/billpos', $data);
    }
    public function create($page = null, $id = null)
    {
        $data = [];
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');

        switch ($page) {
            case 'feedetails':
                $data['fee'] = $this->model->fetch_row_data('fees', array('fee_token' => $id, 'fee_school_id' => $schoolid));
                $fee_id = (!empty($data['fee'])) ? $data['fee']['fee_id'] : '';
                $data['feesdetails'] = $this->model->fetch_all_data('fees_details', array('feedetail_fee_id' => $fee_id, 'feedetail_school_id' => $schoolid), 'feedetail_created_at');
                break;
            case 'discountexemption':
                $data['exemption'] = $this->model->fetch_row_data('exemptions', array('exemption_token' => $id, 'exemption_school_id' => $schoolid));
                $data['fees'] = $this->join->fetch_join_data('fees_details', 'fees', 'fee_id = feedetail_fee_id', array('feedetail_school_id' => $schoolid));
                $data['discounts'] = $this->join->fetch_exemptions_data(array('exemption_token' => $id, 'feediscount_school_id' => $schoolid));
                break;
            case 'studentexemption':
                $data['students'] = $this->join->fetch_students_data(array('student_school_id' => $schoolid, 'student_status' => 'actif', 'inscription_year_id' => $yearid));
                $data['exemption'] = $this->model->fetch_row_data('exemptions', array('exemption_id' => $id, 'exemption_school_id' => $schoolid));
                $data['studentexemptions'] = $this->join->fetch_exemptions_students(array('feestudent_exemption_id' => $id, 'feestudent_school_id' => $schoolid));
                break;
            default:
        }
        $data['title'] = "Gestion paiement frais - " . $page;
        $data['_view'] = "fees/create/" . $page;
        echo view('layouts/main', $data);
    }
    public function remove($table = null, $uid = null)
    {
        switch ($table) {
            case 'paydetails':
                $realnametable = 'payments_details';
                $real_uid = 'paydetails_id';
                break;
            case 'payments':
                $realnametable = 'payments';
                $real_uid = 'payment_id';
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
    public function createFeesPayment($student, $fee_paid)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $id_user_connected = $this->session->get('userid');

        if (!empty($student) && (!empty($fee_paid)) && ($this->request->getPost())) {

            $fee_id = (session()->has('feepaidid')) ? session()->get('feepaidid') : $fee_paid;
            $classe_id = (session()->has('studentclasseid')) ? session()->get('studentclasseid') : '';
            $feesclasses = $this->join->fetch_fees_classes(array('feedetail_fee_id' => $fee_id, 'feeclasse_classe_id' => $classe_id, 'feeclasse_school_id' => $schoolid), '*', false, 'feeclasse_created_at');

            $total_payment_amount_usd = 0;
            $total_payment_amount_cdf = 0;
            $rep = 0;

            if (!empty($feesclasses)) {
                $exchange_value = preg_replace("/[^0-9]/", "", ($this->request->getPost('exchange')));
                $exchange_convert = substr($exchange_value, 0, -2);
                $exchange = floatval($exchange_convert);
                $notes = ($this->request->getPost('notes'));

                $total_payable_amount_cdf = 0;
                $total_payable_amount_usd = 0;
                $total_discount_fees_usd = 0;
                $total_discount_fees_cdf = 0;
                $payment_check_addfee = false;
                $casbox_amount_usd = 0;
                $cashbox_amount_cdf = 0;
                //CHECK IF PAYMENT TOKEN IS NOT EXIST
                if (!session()->has('paymenttoken')) {
                    $payment_token = setPrimaryKey();
                    $payment_create_data = array(
                        'payment_token' => $payment_token,
                        'payment_code' => setReferenceCode(),
                        'payment_date' => (session()->has('paydate') ? session()->get('paydate') : date('Y-m-d')),
                        'payment_created_at' => date('Y-m-d H:i:s'),
                        'payment_status' => 'actif',
                        'payment_type' => 'cash',
                        'payment_total_usd' => $total_payment_amount_usd,
                        'payment_total_cdf' => $total_payment_amount_cdf,
                        'payment_fees_usd' => $total_payable_amount_usd,
                        'payment_fees_cdf' => $total_payable_amount_cdf,
                        'payment_exemption_usd' => $total_discount_fees_usd,
                        'payment_exemption_cdf' => $total_discount_fees_cdf,
                        'payment_exchange' => $exchange,
                        'payment_notes' => $notes,
                        'payment_fee_id' => $fee_id,
                        'payment_student_id' => $student,
                        'payment_user_id' => $id_user_connected,
                        'payment_year_id' => $yearid,
                        'payment_school_id' => $schoolid,
                    );

                    if ($this->model->insert_data('payments', $payment_create_data)) {

                        $payment_check_addfee = true;
                        //STORE PAYMENT TOKEN IN SESSION IN USER HAVE MANY FEES PAID
                        session()->setTempdata('paymenttoken', $payment_token, 1000);
                    }
                } else {
                    //ALLOW USER TO ADD NEW FEE LINE TO PAYMENT TOKEN STORED IN SESSION\
                    //if((session()->get('studentchoosed') != $student)){

                        $payment_check_addfee = true;

                    //}
                }
                if ($payment_check_addfee == true) {
                    $payment_token = session()->get('paymenttoken');
                    /**============= CREATE DETAILS PAYMENTS =================**/
                    $payment_data = $this->model->fetch_row_data('payments', array('payment_token' => $payment_token, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid));
                    if (!empty($payment_data)) {
                        $payment_id = $payment_data['payment_id']; // Get PK Payment
                        foreach ($feesclasses as $reponse) {
                            $feedetail_id = $reponse['feedetail_id'];
                            $feedetail_amount = floatval($reponse['feedetail_cost_payable']);
                            $fee_currency = $reponse['fee_currency_payable'];

                            $paidUsdAmount = $this->request->getPost('USDAmount' . $feedetail_id);
                            $paid_usd_value = preg_replace("/[^0-9]/", "", $paidUsdAmount);
                            //GET AMOUNT BY REMOVING THE CURRENCY ALIAS
                            $paid_usd_amount = floatval(substr($paid_usd_value, 0, -2));

                            $paidCdfAmount = $this->request->getPost('CDFAmount' . $feedetail_id);
                            //STORE ONLY THE NUMERIC BY REMOVING STRING CHARACTERES
                            $paid_cdf_value = preg_replace("/[^0-9]/", "", $paidCdfAmount);
                            //GET AMOUNT BY REMOVING THE FC ALIAS PREFIX
                            $paid_cdf_amount = floatval(substr($paid_cdf_value, 0, -2));

                            $total_usd_paid = (!empty($paid_cdf_amount)) ? $paid_usd_amount + ($paid_cdf_amount / $exchange) : $paid_usd_amount;
                            $total_cdf_paid = (!empty($paid_usd_amount)) ? $paid_cdf_amount + ($paid_usd_amount * $exchange) : $paid_cdf_amount;

                            //TOTAL PAID CONVERT TO CURRENCY CORRESPONDING
                            $paid_fee_amount = ($fee_currency == 'usd') ? floatval($total_usd_paid) : floatval($total_cdf_paid);

                            if ($paid_fee_amount != 0) {
                                //GET EXISTING PAID AMOUNT BEFORE - DEJA PAYER
                                $old_paid_amount = floatval($this->checkPayment($feedetail_id));
                                //EXEMPTION DISCOUNT AMOUNT - BOURSE TOTALE
                                $discount_amount = floatval($this->checkExemptionsPayment($feedetail_id));

                                //FEE COST PAYABLE - DEDUCTION(EXEMPTION)
                                $fee_amount_payable = $feedetail_amount - $discount_amount;

                                //GET PAID BALANCE BY COST PAYABLE - RESTE DE FRAIS A PAYER
                                $fee_balance = $fee_amount_payable - $old_paid_amount;
                                $fee_to_paid = ($paid_fee_amount <= $fee_balance) ? $paid_fee_amount : $fee_balance;
                                //SUM ALL PAID AMOUNT - TOTAL PAIEMENT EFFECTUE
                                $paid_total_amount = $fee_to_paid + $old_paid_amount;
                                //SET PAID STATUS - PAID(Paye 100%) - deposit: Acompte
                                $paid_type = ($paid_total_amount == $fee_amount_payable) ? 'balance' : 'deposit';

                                if (($fee_currency == 'usd') && ($total_usd_paid >= $fee_balance)) {
                                    $balance_usd = $total_usd_paid - $fee_balance;
                                    $balance_cdf = 0;
                                } elseif (($fee_currency == 'cdf') && ($total_cdf_paid >= $fee_balance)) {
                                    $balance_cdf = $total_cdf_paid - $fee_balance;
                                    $balance_usd = 0;
                                } else {
                                    $balance_cdf = ($total_cdf_paid != 0 && ($total_cdf_paid > $fee_balance)) ? ($total_cdf_paid - $fee_balance) : 0;
                                    $balance_usd = ($total_usd_paid != 0 && ($total_usd_paid > $fee_balance)) ? $total_usd_paid - $fee_balance : 0;
                                }
                                $balance_amount = ($fee_currency == 'usd') ? $balance_usd : $balance_cdf;

                                $amount_paid = $fee_to_paid;

                                //dd($discount_amount);

                                if (is_double($amount_paid) or is_numeric($amount_paid)) {
                                    $casbox_amount_usd += $paid_usd_amount;
                                    $cashbox_amount_cdf += $paid_cdf_amount;
                                    $total_payment_amount_usd += ($fee_currency == 'usd') ? $amount_paid : 0;
                                    $total_payment_amount_cdf += ($fee_currency == 'cdf') ? $amount_paid : 0;
                                    $total_payable_amount_cdf += ($fee_currency == 'cdf') ? $fee_amount_payable : 0;
                                    $total_payable_amount_usd += ($fee_currency == 'usd') ? $fee_amount_payable : 0;

                                    $total_discount_fees_cdf += ($fee_currency == 'cdf') ? $discount_amount : 0;
                                    $total_discount_fees_usd += ($fee_currency == 'usd') ? $discount_amount : 0;

                                    $create_details_payments = [
                                        'paydetails_token' => setPrimaryKey() . $feedetail_id,
                                        'paydetails_code' => setReferenceCode() . $feedetail_id,
                                        'paydetails_paid_amount' => $amount_paid,
                                        'paydetails_fee_amount' => $fee_amount_payable,
                                        'paydetails_usd_amount' => $paid_usd_amount,
                                        'paydetails_cdf_amount' => $paid_cdf_amount,
                                        'paydetails_return_amount' => $balance_amount,
                                        'paydetails_type' => $paid_type,
                                        'paydetails_status' => 'actif',
                                        'paydetails_created_at' => date('Y-m-d H:i:s'),
                                        'paydetails_payment_id' => $payment_id,
                                        'paydetails_fee_id' => $this->request->getPost('paidFeeclasseId' . $feedetail_id),
                                        'paydetails_school_id' => $schoolid,
                                    ];

                                    //save new data in table
                                    if ($this->model->insert_data('payments_details', $create_details_payments)) {
                                        $rep = 1;
                                    } else {
                                        $rep = 0;
                                    }

                                }
                            }

                        } //END FOREACH FEES DETAILS
                        if ($rep == 1) {

                            //ADD AMOUNT PAID TO CASHBOX
                            $this->cashbox($casbox_amount_usd, $cashbox_amount_cdf, 'create');

                            //UPDATE PAYMENT TOTAL AMOUNT
                            $payment_update_data = array(
                                'payment_updated_at' => date('Y-m-d H:i:s'),
                                'payment_total_usd' => $payment_data['payment_total_usd'] + $total_payment_amount_usd,
                                'payment_total_cdf' => $payment_data['payment_total_cdf'] + $total_payment_amount_cdf,
                                'payment_fees_usd' => $payment_data['payment_fees_usd'] + $total_payable_amount_usd,
                                'payment_fees_cdf' => $payment_data['payment_fees_cdf'] + $total_payable_amount_cdf,
                                'payment_exemption_usd' => $payment_data['payment_exemption_usd'] + $total_discount_fees_usd,
                                'payment_exemption_cdf' => $payment_data['payment_exemption_cdf'] + $total_discount_fees_cdf,
                            );
                            $this->model->update_data('payments', $payment_update_data, array('payment_id' => $payment_id));

                            //DELETE ALL PAYDETAILS WITH O AMOUNT
                            $this->model->delete_batch('payments_details', array('paydetails_paid_amount' => 0, 'paydetails_status' => 'actif'));

                            return redirect()->back()->with('success', "Paiement Détails effectué. Impression preuve de paiement !");
                            //return redirect()->to(base_url('payment/printbill/'.$payment_token));
                        } else {
                            //DELETE ALL PAYMENTS WITHOUT DETAILS
                            $this->model->delete_batch('payments', array('payment_total_usd' => 0, 'payment_total_cdf' => 0, 'payment_updated_at' => null));

                            return redirect()->back()->with('failed', "Paiement non effectué. Veuillez réessayer !");
                        }
                    } //END OF PAYMENTS CHECKING DATA
                } else {
                    return redirect()->back()->with('failed', "Paiement global non effectuée !");
                }

            } else {
                return redirect()->back()->with('failed', 'Aucun details frais configurer. Veuillez configurer le frais');
            }
        } else {
            return redirect()->back()->with('failed', 'Vous devez sélectionner un élève et frais correspondant');
        }
    }
    public function checkPayment($feedetail_id)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $studentid = (session()->has('studentchoosed')) ? session()->get('studentchoosed') : '';
        $total_paid_amount = 0;
        if (!empty($feedetail_id)) {

            $paydetails = $this->join->fetch_payments_data(array('payment_student_id' => $studentid, 'payment_year_id' => $yearid, 'paydetails_fee_id' => $feedetail_id, 'payment_school_id' => $schoolid), '*', false);
            //$paydetails = $this->join->fetch_payments_data(array('payment_student_id' => $studentid,'payment_year_id' => $yearid,'paydetails_fee_id' => $feedetail_id,'payment_school_id' => $schoolid),'*', TRUE);

            if (!empty($paydetails)) {
                foreach ($paydetails as $paydetail) {
                    $total_paid_amount += $paydetail['paydetails_paid_amount'];
                }
            }
            return $total_paid_amount;
        }
    }
    public function checkExemptionsPayment($feedetail_id)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        $studentid = (session()->has('studentchoosed')) ? session()->get('studentchoosed') : '';
        $classe_id = (session()->has('studentclasseid')) ? session()->get('studentclasseid') : '';
        $total_discount = 0;
        $classe_exemption = 0;
        $student_exemption = 0;
        if (!empty($feedetail_id)) {
            $classesexemptions = $this->join->fetch_exemptions_classes(array('exemption_year_id' => $yearid, 'exemptionclasse_classe_id' => $classe_id, 'exemptionclasse_school_id' => $schoolid));
            $studentexemptions = $this->join->fetch_exemptions_students(array('exemption_year_id' => $yearid, 'feestudent_inscription_id' => $studentid, 'feestudent_school_id' => $schoolid));
            $feesexemptions = $this->join->fetch_join_data('exemptions_discounts', 'exemptions', 'exemption_id = feediscount_exemption_id', array('exemption_year_id' => $yearid, 'feediscount_school_id' => $schoolid), 'feediscount_created_at');
            if (!empty($feesexemptions)) {
                foreach ($feesexemptions as $discount) {
                    if ($discount['feediscount_feedetail_id'] == $feedetail_id) {
                        //GET STUDENT DISCOUNT
                        if ((!empty($studentexemptions))) {
                            foreach ($studentexemptions as $studentexemption) {
                                if ($studentexemption['feestudent_exemption_id'] == $discount['feediscount_exemption_id']) {

                                    $student_exemption = $studentexemption['exemption_cost_discount'];

                                }
                            }
                        }
                        //GET CLASSE DISCOUNT
                        if ((!empty($classesexemptions))) {
                            foreach ($classesexemptions as $classeexemption) {
                                if ($classeexemption['exemptionclasse_exemption_id'] == $discount['feediscount_exemption_id']) {
                                    $classe_exemption = $classeexemption['exemption_cost_discount'];
                                }
                            }
                        }
                    }
                }
            }
        }
        $total_discount += $classe_exemption + $student_exemption;
        return $total_discount;
    }
    public function cancelPaydetails($paydetail_token)
    {
        $schoolid = session()->get('schoolid');
        $yearid = session()->get('yearid');
        if (!empty($paydetail_token)) {
            $paydetails = $this->model->fetch_row_data('payments_details', array('paydetails_token' => $paydetail_token, 'paydetails_school_id' => $schoolid));
            if (!empty($paydetails)) {
                $payment_id = $paydetails['paydetails_payment_id'];
                $payment = $this->model->fetch_row_data('payments', array('payment_id' => $payment_id, 'payment_year_id' => $yearid, 'payment_school_id' => $schoolid));
                if (!empty($payment)) {
                    //UPDATE PAYMENT TOTAL AMOUNT
                    //$old_paid_amount = $paydetails['paydetails_paid_amount'];

                    $old_usd_amount = $paydetails['paydetails_usd_amount'];
                    $old_cdf_amount = $paydetails['paydetails_cdf_amount'];
                    $old_usd_paid_amount = $payment['payment_total_usd'];
                    $old_cdf_paid_amount = $payment['payment_total_cdf'];

                    //$fee_currency = $payment['fee_currency_payable'];

                    //$update_paid_amount = ($fee_currency == 'usd') ? $old_paid_amount:0;

                    $payment_update_data = array(
                        'payment_updated_at' => date('Y-m-d H:i:s'),
                        'payment_total_usd' => $old_usd_paid_amount - $old_usd_amount,
                        'payment_total_cdf' => $old_cdf_paid_amount - $old_cdf_amount,
                    );
                    $this->model->update_data('payments', $payment_update_data, array('payment_id' => $payment_id));
                    //UPDATE PAYDETAILS CORRESPONDING TO REQUEST
                    $paydetails_update_data = array(
                        'paydetails_updated_at' => date('Y-m-d H:i:s'),
                        'paydetails_paid_amount' => 0,
                        'paydetails_cdf_amount' => 0,
                        'paydetails_usd_amount' => 0,
                        'paydetails_status' => 'cancel',
                    );
                    if ($this->model->update_data('payments_details', $paydetails_update_data, array('paydetails_token' => $paydetail_token, 'paydetails_school_id' => $schoolid))) {

                        //UPDATE ALSO AMOUNT PAID TO CASHBOX
                        $this->cashbox($old_usd_amount, $old_cdf_amount, 'update');

                        return redirect()->back()->with('success', "Annulation Paiement effectué !");
                    } else {
                        return redirect()->back()->with('failed', "Paiement non annuler. Veuillez réessayer !");
                    }
                }
            }
        }
        
    }
    public function cashbox($usd_amount, $cdf_amount, $action)
    {

        $schoolid = session()->get('schoolid');
        //$userid = $this->session->userid;

        if ($usd_amount != 0) {

            $cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency' => 'usd'));
            if (!empty($cashbox)) {
                $cashbox_id = $cashbox['cashbox_id'];
                $cashbox_amount = $cashbox['cashbox_credit_amount'];

                $cashbox_update_amount = ($action == 'update') ? $cashbox_amount - $usd_amount : $cashbox_amount + $usd_amount;

                $cashbox_update_data = array(
                    'cashbox_updated_at' => date('Y-m-d H:i:s'),
                    'cashbox_credit_amount' => $cashbox_update_amount,
                );
                $this->model->update_data('finances_cashbox', $cashbox_update_data, array('cashbox_id' => $cashbox_id));
            } else {
                $cashbox_create_data = array(
                    'cashbox_token' => setPrimaryKey(),
                    'cashbox_code' => setReferenceCode(),
                    'cashbox_created_at' => date('Y-m-d H:i:s'),
                    'cashbox_credit_amount' => $usd_amount,
                    'cashbox_debit_amount' => 0,
                    'cashbox_balance_amount' => 0,
                    'cashbox_status' => 'actif',
                    'cashbox_name' => setCurrency('usd'),
                    'cashbox_currency' => 'usd',
                    'cashbox_school_id' => $schoolid,
                );
                $this->model->insert_data('finances_cashbox', $cashbox_create_data);
            }
        }
        if ($cdf_amount != 0) {
            $cashbox = $this->model->fetch_row_data('finances_cashbox', array('cashbox_currency' => 'cdf'));
            if (!empty($cashbox)) {
                $cashbox_id = $cashbox['cashbox_id'];
                $cashbox_amount = $cashbox['cashbox_credit_amount'];

                $cashbox_update_amount = ($action == 'update') ? $cashbox_amount - $cdf_amount : $cashbox_amount + $cdf_amount;

                $cashbox_update_data = array(
                    'cashbox_updated_at' => date('Y-m-d H:i:s'),
                    'cashbox_credit_amount' => $cashbox_update_amount,
                );
                $this->model->update_data('finances_cashbox', $cashbox_update_data, array('cashbox_id' => $cashbox_id));
            } else {
                $cashbox_create_data = array(
                    'cashbox_token' => setPrimaryKey(),
                    'cashbox_code' => setReferenceCode(),
                    'cashbox_created_at' => date('Y-m-d H:i:s'),
                    'cashbox_credit_amount' => $cdf_amount,
                    'cashbox_debit_amount' => 0,
                    'cashbox_balance_amount' => 0,
                    'cashbox_status' => 'actif',
                    'cashbox_name' => setCurrency('cdf'),
                    'cashbox_currency' => 'cdf',
                    'cashbox_school_id' => $schoolid,
                );
                $this->model->insert_data('finances_cashbox', $cashbox_create_data);
            }
        }
    }
    public function generateQRcode($data = null)
    {
        if(!empty($data)){
            $school_logo = (session()->has('schoollogo')) ? base_url('public/uploads/images/' . session()->get('schoollogo')) : base_url('public/img/logo/favicon.png');
            //$school_label = session()->get('schoolcode').' - '.session()->get('schoolyear');
            // Generate the QR code
            $result = Builder::create()
            //->writer(new PngWriter())
            //->writerOptions([])
                ->data($data)
            //->encoding(new Encoding('UTF-8'))
            //->errorCorrectionLevel(ErrorCorrectionLevel::High)
                ->size(250)
                ->margin(10)
                ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                ->logoPath($school_logo)
            //->logoPath(__DIR__.'/assets/symfony.png')
                ->logoResizeToWidth(50)
                ->logoPunchoutBackground(true)
            //->labelText($school_label)
            //->labelFont(new NotoSans(12))
            //->labelAlignment(LabelAlignment::Center)
                ->validateResult(false)
                ->build();

            // Set the content type to image/png
            header('Content-Type: ' . $result->getMimeType());

            // Output the QR code
            echo $result->getString();
        }
    }
    public function sendPaymentMessage($bill, $payments)
    {
        if (!empty($bill) && (!empty($payments))) {

            $data['bill'] = $bill;

            $schoolid = session()->get('schoolid');
            $school_name = $this->session->get('schoolname');
            $year_name = $this->session->get('schoolyear');

            $student_parent_id = (!empty($data['bill'])) ? $data['bill']['student_parent_id'] : '';
            $student_names = (!empty($data['bill'])) ? $data['bill']['student_firstname'] . ' ' . $data['bill']['student_lastname'] : '';
            $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $schoolid, 'parent_id' => $student_parent_id));
            if (!empty($parent_data)) {
                $parent_father = $parent_data['parent_father_name'];
                $parent_mather = $parent_data['parent_mother_name'];
                $parent_tutor = $parent_data['parent_tutor_name'];
                $emergency = $parent_data['parent_emergency'];
                $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;
                $email_parent = $parent_data['parent_primary_email'];

                $htmlContent = '<h3>Perception frais élève - ' . $student_names . ' pour l\'année ' . $year_name . '</h3>';
                $htmlContent .= '<p>Cher parent ' . $parent_names . ' suite à la perception de frais de votre enfant au sein de notre <b>école ' . $school_name . '</b>, voici les details du paiement:</p>';
                $htmlContent .= '<p style="border:2px solid black"> <b> reçu n° <b>' . $bill['payment_code'] . '</b> du ' . date("d/m/Y H:i:s", strtotime($bill['payment_created_at'])) . '</b></p>';
                $htmlContent .= '<h5><b>Elève : ' . ($bill['student_firstname'] . ' ' . $bill['student_lastname'] . ' ' . $bill['student_surname']) . '</b></h5>';
                $htmlContent .= '<h5> Classe: ' . $bill['degree_shortname'] . ' ' . ($bill['classe_subname']) . ' ' . ($bill['option_name']) . '</h5>';
                $htmlContent .= '<table border="1" cellpadding="5" cellspacing="0">';
                $htmlContent .= '<thead><tr><th>Description</th><th>Budget</th><th>Payé</th><th>Solde</th></tr></thead>';
                $htmlContent .= '<tbody>';

                $montant_total_cdf = 0;
                $montant_total_usd = 0;
                $amount_returned_cdf = 0;
                $amount_returned_usd = 0;
                $total_amount_payable = 0;
                $total_amount_balance = 0;
                $amount_paid_usd = 0;
                $amount_paid_cdf = 0;
                foreach ($payments as $payment) {
                    $currency = $payment['fee_currency_payable'];
                    $currency_paid = ($currency == 'usd') ? '$' : 'Fc';
                    $pay_amount = floatval($payment['paydetails_paid_amount']);
                    $pay_usd_amount = floatval($payment['paydetails_usd_amount']);
                    $pay_cdf_amount = floatval($payment['paydetails_cdf_amount']);

                    $pay_returned_amount = floatval($payment['paydetails_return_amount']);
                    $payable_amount = floatval($payment['paydetails_fee_amount']);

                    $montant_total_cdf += $pay_cdf_amount;
                    $montant_total_usd += $pay_usd_amount;
                    $fee_balance = floatval($payable_amount - $pay_amount);
                    $total_amount_payable += $payable_amount;
                    $total_amount_balance += $fee_balance;
                    $amount_paid_usd += ($currency == 'usd') ? $pay_amount : 0;
                    $amount_paid_cdf += ($currency == 'cdf') ? $pay_amount : 0;

                    $amount_returned_cdf += ($currency == 'cdf') ? $pay_returned_amount : 0;
                    $amount_returned_usd += ($currency == 'usd') ? $pay_returned_amount : 0;

                    $payment_fee_balance = ($payment['paydetails_type'] == 'deposit') ? number_format($fee_balance, 2, ',', ' ') . '' . $currency_paid : 0;

                    $htmlContent .= '<tr> <td>' . $payment['fee_name'] . ' ' . $payment['feedetail_name'] . '</td>
					<td>' . number_format($payable_amount, 2, ',', ' ') . '' . $currency_paid . '</td><td>' . number_format($pay_amount, 2, ',', ' ') . '' . $currency_paid . '</td><td>' . $payment_fee_balance . '</td></tr>';
                }

                $htmlContent .= '<tr><td><b>Montant</b></td><td colspan="2"><b>En CDF</b> </td><td><b> En USD</b> </td></tr>';
                $htmlContent .= '<tr><td><b>Déposé:</b></td><td colspan="2"><b>Fc ' . number_format($montant_total_cdf, 2, ',', ' ') . '</b></td><td><b>$ ' . number_format($montant_total_usd, 2, ',', ' ') . '</b></td></tr>';
                $htmlContent .= '<tr><td><b>Perçu:</b></td><td colspan="2"><b>Fc - ' . number_format($amount_paid_cdf, 2, ',', ' ') . '</b></td><td><b>$ - ' . number_format($amount_paid_usd, 2, ',', ' ') . ' </b></td></tr>';
                $htmlContent .= '<tr><td><b>Remis:</b></td><td colspan="2"><b>Fc = ' . number_format($amount_returned_cdf, 2, ',', ' ') . '</b></td><td><b>$ =' . number_format($amount_returned_usd, 2, ',', ' ') . '</b></td></tr>';
                $htmlContent .= '</tbody>';
                $htmlContent .= '</table>';
                $htmlContent .= '<p>Printed by : <span>' . session()->get('lastname') . '(' . session()->get('usercode') . ')</br> <b class="small">' . date('l d-m-Y' . " à " . 'H:i:s') . '</b></span> <br> </p>';
                $htmlContent .= '<p>En cas d\'une erreur, veuillez nous signaler le plus vite possible!</p>';

                if ($this->sendEmail($email_parent, "Frais payé de l'élève $student_names", $htmlContent)) {
                    $subject = 'Reçu paiement frais [' . $bill['payment_code'] . ']';
                    $message = $htmlContent;

                    //$school_sender_name = $this->session->schoolsmssender;
                    //$school_name = $this->session->schoolfname;
                    //$school_phone = $this->session->schoolphone;
                    $school_email = $this->session->get('schoolemail');
                    $messages_sending_data = [
                        'message_token' => setPrimaryKey(),
                        'message_code' => setReferenceCode(),
                        'message_sender' => $school_email,
                        'message_recipient' => $email_parent,
                        'message_subject' => $subject,
                        'message_body' => $message,
                        'message_status' => 'send',
                        'message_type' => 'email',
                        'message_category' => 'parent',
                        'message_created_at' => date('Y-m-d H:i:s'),
                        'message_school_id' => $schoolid,
                    ];
                    $this->model->insert_data('messages', $messages_sending_data);

                }
            }
        }
    }
    public function sendSmsPayment($student_data, $payments)
    {
        //$year_name = $this->session->schoolyear;
        $school_sender_name = $this->session->get('schoolsmssender');
        //$school_name = $this->session->schoolfname;
        $school_phone = $this->session->get('schoolphone');

        $schoolid = session()->get('schoolid');

        if (!empty($student_data) && (!empty($payments))) {
            $student_parent_id = $student_data['student_parent_id'];

            $student_names = $student_data['student_firstname'] . ' ' . $student_data['student_lastname'];
            $student_classe = (!empty($student_data['classe_shortname'])) ? $student_data['classe_shortname'] : $student_data['degree_shortname'] . ' ' . ($student_data['classe_subname']) . ' ' . ($student_data['option_name']);

            $parent_data = $this->model->fetch_row_data('students_parents', array('parent_school_id' => $schoolid, 'parent_id' => $student_parent_id));

            //return $parent_data;

            if (!empty($parent_data)) {
                $parent_father = $parent_data['parent_father_name'];
                $parent_mather = $parent_data['parent_mother_name'];
                $parent_tutor = $parent_data['parent_tutor_name'];
                $emergency = $parent_data['parent_emergency'];
                $parent_names = (($emergency == 'pere') ? $parent_father : ($emergency == 'mere')) ? $parent_mather : $parent_tutor;

                $phone_parent = $parent_data['parent_primary_phone'];
                $smsContent = 'Reçu:' . $student_data['payment_code'] . ' de votre enfant: ' . $student_names;
                $smsContent .= '(' . $student_classe . ')';
                $smsContent .= ':';
                foreach ($payments as $payment) {
                    $currency = $payment['fee_currency_payable'];
                    $currency_paid = ($currency == 'usd') ? '$' : 'Fc';
                    $fee_total_payable = $payment['fee_total_payable'];

                    $feessms = ($fee_total_payable > 1) ? $payment['fee_name'] . '(' . $payment['feedetail_name'] . ')' : $payment['feedetail_name'];

                    $pay_amount = $payment['paydetails_paid_amount'];
                    $smsContent .= ' ' . $feessms . '=' . $pay_amount . '' . $currency_paid . ' -';
                }

                $smsContent .= ' Infos:' . $school_phone;

                if (!empty($phone_parent)) {
                    $sms_counter_content = strlen($smsContent);
                    $subject = 'Reçu paiement frais [' . $student_data['payment_code'] . ']' . ' ' . $parent_names;
                    $message_token = setPrimaryKey();
                    $messages_sending_data = [
                        'message_token' => $message_token,
                        'message_code' => setReferenceCode(),
                        'message_sender' => $school_sender_name,
                        'message_recipient' => $phone_parent,
                        'message_subject' => $subject,
                        'message_body' => $smsContent,
                        'message_status' => 'actif',
                        'message_type' => 'sms',
                        'message_category' => 'parent',
                        'message_created_at' => date('Y-m-d H:i:s'),
                        'message_school_id' => $schoolid,
                    ];
                    if ($this->model->insert_data('messages', $messages_sending_data)) {

                        if ($this->sendSMS($phone_parent, $smsContent, $school_sender_name)) {
                            //UPDATE SMS PACK
                            $this->updateSMSSchool($sms_counter_content);

                            $messages_update_data = [
                                'message_status' => 'send',
                                'message_updated_at' => date('Y-m-d H:i:s'),
                            ];

                            $this->model->update_data('messages', $messages_update_data, ['message_token' => $message_token]);

                            return 'sms send';
                        } else {
                            return 'sms saved';
                        }
                    } else {
                        return 'sms not saved';
                    }
                } else {
                    return 'parent no number';
                }
            } else {
                return 'parent not found';
            }
        } else {
            return 'student data not found';
        }
    }
    public function encodingBillPayment()
    {
        if (session()->has('paymenttoken')) {
            //CLEAR ALL SESSION PAYMENT DATA
            session()->remove('paymenttoken');
            session()->remove('feepaidid');
            session()->remove('feepaidchoosed');
            session()->remove('feechoosed');
            session()->remove('feechoosedclasse');
            session()->remove('studentchoosed');
            session()->remove('studentclasse');
            session()->remove('studentclasseid');
        }
        if (session()->has('paymentencoding')) {
            session()->remove('paymentencoding');
            return redirect()->to(base_url('payments'));
        }else{
            session()->setTempdata('paymentencoding', 'true', 1000);
            session()->setFlashdata('info', 'Mode encodage rapide re recus de paiements actifs !');
            return redirect()->to(base_url('payments'));
        }
    }
}
