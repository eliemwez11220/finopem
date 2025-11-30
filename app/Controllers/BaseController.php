<?php

namespace App\Controllers;

use App\Libraries\SMSPartnerAPI;
use App\Models\AuthModel;
use App\Models\GenericModel;
use App\Models\JoinModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;

/* ========= LIBRARY CLASS =====*/
//require_once  ROOTPATH.'/vendor/autoload.php';
//use ipinfo\ipinfo\IPinfo;

use App\Libraries\SMSService;

use CodeIgniter\HTTP\IncomingRequest;
/* ========= MODELS LAODED =====*/
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

//use CodeIgniter\Database\Database;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'html', 'security', 'utility', 'session', 'date', 'text'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $join;
    protected $model;
    protected $auth;
    protected $session;
    protected $segment;
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->join = new JoinModel();
        $this->model = new GenericModel();
        $this->auth = new AuthModel();

        $this->session = \Config\Services::session();
        $this->segment = \Config\Services::uri();

        // GENERATE DB BACKUP AFTER TWO HOURS
        //session()->remove('hoursdbbackup');
        if (ENVIRONMENT == 'production') {
            
            if (session()->has('isLoggedIn')) {
                
                if (! session()->has('hoursdbbackup')) {
                    
                    $this->databaseAutoBackup();
                    
                }
            }
        }
        if (session()->has('isLoggedIn')) {
            $user_sess_id = session()->get('usertoken');
            $school_sess_id = session()->get('schoolid');
            if (session()->admin == TRUE or session()->all == TRUE) {

                $all_sections = $this->model->fetch_all_data('sections', array('section_status' => 'actif', 'section_school_id' => $school_sess_id), 'section_created_at');
                
                if ((!empty($all_sections)) && count($all_sections) >= 0) {

                    session()->set('usersbranchs', $all_sections);
                }
            }else{
                $users_sections = $this->join->fetch_users_sections(array('branch_status' => 'actif', 'branch_user_id' => $user_sess_id, 'branch_school_id' => $school_sess_id), '*');
                if ((!empty($users_sections)) && count($users_sections) >= 0) {

                    session()->set('usersbranchs', $users_sections);

                }
            }
        }
    }
    public function createUserLog($type){
        /*============= CREATE USER LOGS ==============*/
        if(!empty($type)){
            $users_logs = [
                'log_token' => setPrimaryKey(),
                'log_code' => setReferenceCode(),
                'log_ipaddress' => $this->getClientIpAddress(),
                'log_device' => $this->getUserAgentDevice(),
                'log_platform' => $this->getUserAgentPlatform(),
                'log_type' => $type,
                'log_status' => 'actif',
                'log_user_id' => $this->session->userid,
                'log_school_id' => $this->session->schoolid,
                'log_created_at' => date('Y-m-d H:i:s'),
                'log_login_at' => date('Y-m-d H:i:s'),
            ];
    
            if($this->model->insert_data('users_logs', $users_logs)){
                
                return true;

            }
        }
        
    }
    public function createUserActivity($action){  
        if(!empty($action)){  
             /*============= CREATE USER ACTIVITY ==============*/
                $users_activities = [
                    'activity_token' => setPrimaryKey(),
                    'activity_code' => setReferenceCode(),
                    'activity_ipaddress' => $this->getClientIpAddress(),
                    'activity_device' => $this->getUserAgentDevice(),
                    'activity_platform' => $this->getUserAgentPlatform(),
                    'activity_type' => $action,
                    'activity_status' => 'actif',
                    'activity_user_id' => $this->session->userid,
                    'activity_school_id' => $this->session->schoolid,
                    'activity_created_at' => date('Y-m-d H:i:s'),
                    'activity_created_by' => $this->session->name.' '.$this->session->lastname,
                ];
        
                if($this->model->insert_data('users_activities', $users_activities)){

                    return true;

                }
            }
        }
        
    public function databaseAutoBackup()
    {
        // Database credentials
        $dbHost = getenv('database.default.hostname');
        $dbName = getenv('database.default.database');
        $dbUser = getenv('database.default.username');
        $dbPass = getenv('database.default.password');

        // Path to store the backup file
        $backup_file = 'autbackup-' . date('Y-m-d_H-i-s') . '.sql';

        $backupPath = WRITEPATH . 'database/' . $backup_file;

        // Create the backups directory if it doesn't exist
        if (!is_dir(WRITEPATH . 'database')) {
            mkdir(WRITEPATH . 'database', 0755, true);
        }

        // Command to run mysqldump
        //$command = "mysqldump --opt --host=$dbHost --user=$dbUser $dbName > $backupPath";
        $command_linux = "/opt/lampp/bin/mysqldump --host=$dbHost --user=$dbUser --password=$dbPass $dbName > $backupPath";
        $command_windows = "mysqldump --host=$dbHost --user=$dbUser --password=$dbPass $dbName > $backupPath";
        $os = $this->getUserAgentPlatform();
        $command = ($os == 'Linux') ? $command_linux : $command_windows;
        // Execute the command and capture the output and return code
        $output = [];
        $return_var = null;

        exec($command . ' 2>&1', $output, $return_var);
        // Store the backup file name in session for 2 hours
        $this->session->setTempdata('hoursdbbackup', $backup_file, 7200);
        
        //SEND BACKUP TO EMAIL
        $school_name = ucwords(strtolower($this->session->get('schoolfname')));
        $sess_user_name = (session()->has('name')) ? ucwords(strtolower(session()->get('name'))):" ";
        $sess_user_lastname = (session()->has('lastname')) ? ucwords(strtolower(session()->get('lastname'))):" ";
       
        //SEND DB BACKUP TO EMAIL
        $sess_user_fullname = $sess_user_name.' '.$sess_user_lastname;
        $content = "Automatic database backup from <b>$school_name by $sess_user_fullname</b>. Click the button below to download the backup file. Please keep this file safe and secure.";
      
        $link = base_url("dbBackupRestore/".$backup_file);
        $this->sendEmail('magschool@ditotase.com', "Backup $dbName for $school_name", $content, $link, 'Restore', $backupPath);
        // Check if the command was successful
        if ($return_var === 0) {
            
            //$this->session->setTempdata('hoursdbbackup', $backup_file, 7200);
            
            return true;
        } else {
            return false;
        }
    }
    public function getUserAgentDevice()
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }

    public function getUserAgentPlatform()
    {
        $agent = $this->request->getUserAgent();
        $os_platform = $agent->getPlatform();
        return $os_platform;
    }

    public function getClientIpAddress()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            //To Check IP is Pass From Proxy
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
            //To Check IP is Pass From remote
            return $_SERVER["REMOTE_ADDR"];
        } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            //Checking IP From Shared Internet
            return $_SERVER["HTTP_CLIENT_IP"];
        } else {
            return false;
        }
    }

    public function getClientLocation()
    {
        /*if(ENVIRONMENT == "production"){
        //"169.159.218.20";
        $ip_address =  $this->getClientIpAddress();
        $access_token = 'b4d4b25be34eb4';
        if ($ip_address !='::1' OR $ip_address !='localhost'OR $ip_address !='127.0.0.1') {
        $client = new IPinfo($access_token);
        $location = $client->getDetails($ip_address);
        return $location;
        }else{
        return false;
        }
        }*/
        return false;
    }
    public function sendEmail($to, $subject, $content, $link = null, $linktitle = null, $attachment = null, $replyto = null, $ccto = null)
    {
        $school_name = ucwords(strtolower($this->session->get('schoolfname')));
        $school_email = $this->session->schoolemail;
        $platform = $this->getUserAgentPlatform();
        $userinfo = $this->getUserAgentDevice();
        $location = $this->getClientLocation();
        //$full_location = (!empty($location)) ? $location->city . ', ' . $location->region . ', ' . $location->country . ' - ' . $location->timezone:"Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa";
        $full_location = "Lubumbashi, Haut-Katanga, RDC - Lubumbashi/Africa";

        $valid_link = "";
        if (!empty($link)) {
            $valid_link = '
            <a href="' . $link . '"
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
                  border-radius: 100px!important"> ' . $linktitle . '</a>';
        }
        $body = '<p>' . $content . '</p>
            <br/>
            <p style="text-align:center!important;"> ' . $valid_link . '</p>
            <br/><hr>
            <p><b style="text-transform:uppercase;">Où et quand celà s\'est produit:</b></p>
             <ul>
                <li>Date: ' . date('d/m/Y H:i:s') . ' </li>
                <li>Lieu: ' . $full_location . '</li>
                <li>Système: ' . $platform . ' via ' . $userinfo . '</li>
                <li>Application: Finopem University</li>
             </ul>';
        $email = \CodeIgniter\Config\Services::email();

        $email_sender_name = (!empty($school_name)) ? $school_name : "Finopem University";
        $email_sender = "finopem@ditotase.com";

        try {
            $email->setFrom($email_sender, $email_sender_name);
            $email->setTo($to); // send email to recipient

            $mail_reply = (!empty($replyto) ? $replyto  : $school_email);

            if (!empty($mail_reply)) {
                $email->setReplyTo($mail_reply);
            }
            if (!empty($ccto)) {
                $email->setCC($ccto);
            }
            $email->setSubject($subject);
            $email->setMessage($body);
            if (!empty($attachment)) {
                $email->attach( $attachment, 'attachment'); // Optional name
                $email->attach(base_url('public/uploads/files/' . $attachment), 'attachment', 'Pièce Jointe du message'); // Optional name
            }
            //$email->attach(base_url('public/img/favicon.png')); // Optional name
            $email->setMailType('html');
            if ($email->send()) {
                /* =========== SAVE EMAIL IN DATABASE====== */
                $this->saveMessage('email', $email_sender, $to, $subject, $body);

                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
    public function sendSMS($recipient_number, $content, $sender)
    {
        if (session()->has('schoolsmscount') && (session()->get('schoolsmscount') >= 1)) {
            //SEND SMS MOBILE
            if (!empty($recipient_number) && !empty($content)) {

                /* =========== SAVE EMAIL IN DATABASE====== */
                $subject = "SMS Broadcast TO $recipient_number";

                $this->saveMessage('sms', $sender, $recipient_number, $subject, $content);
              
               
                $school_name = ucwords(strtolower(session()->get('schoolfname')));
                $school_sender_name = ucwords(strtoupper(session()->get('schoolsmssender')));
                $school_sender_sms = (!empty($school_sender_name)) ? $school_sender_name : "MAGSCHOOL";
                    // Initialiser le service SMS
                    $smsService = new SMSService();

                    // Paramètres de l'envoi
                    $to = $recipient_number;
                    $message = $content;
                    $sender_name = $school_sender_sms; // Nom de l'expéditeur (max. 11 caractères)

                    // Appeler la fonction pour envoyer le SMS
                    $response = $smsService->sendSMS($to, $message, $sender_name);

                    // Gérer la réponse
                    if ($response === true) {
                        //echo 'SMS envoyé avec succès !';
                        $this->updateSMSSchool($message); // UPDATE SMS PACK NUMBER

                        return true;

                    } else {
                        
                        return 'Erreur lors de l\'envoi du SMS : ' . $response['message'];
                       
                    }
                

            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function updateSMSSchool($sms_counter)
    {
        if ($sms_counter != 0) {
            $schoolid = $this->session->schoolid;
            $sms_db = session()->get('schoolsmscount');
            $message_length = intval($sms_counter);
            $sms_length = ($message_length > 160) ? ($message_length / 160) : 1;
            $sms_pack = $sms_db - intval($sms_length);
            $messages_sending_data = [
                'school_sms_number' => $sms_pack,
            ];
            if ($this->model->update_data('schools', $messages_sending_data, array('school_id' => $schoolid))) {
                //UPDATE SMS COUNTER IN SESSION
                session()->set('schoolsmscount', $sms_pack);

            }
        }
    }
    public function saveMessage($type, $sender, $recipient, $subject, $content)
    {
        $school_id = $this->session->schoolid;
        $choosedsectionid = $this->session->choosedsectionid;

        if (!$this->model->fetch_row_data('messages', array('message_subject' => $subject, 'message_sender' => $sender, 'message_recipient' => $recipient, 'message_body' => $content, 'message_school_id' => $school_id))) {

            $messages_sending_data = [
                'message_token' => setPrimaryKey(),
                'message_code' => setReferenceCode(),
                'message_sender' => $sender,
                'message_recipient' => $recipient,
                'message_subject' => $subject,
                'message_body' => $content,
                'message_status' => 'send',
                'message_type' => $type,
                'message_category' => 'system',
                'message_created_at' => date('Y-m-d H:i:s'),
                'message_school_id' => $school_id,
                'message_section_id' => $choosedsectionid,
            ];
            $this->model->insert_data('messages', $messages_sending_data);
        }
    }

}
