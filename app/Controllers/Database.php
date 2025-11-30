<?php

namespace App\Controllers;

class Database extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null)
    {
        if (!session()->has('isLoggedIn')) {
            //echo 'Disconnect';
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
        $data['title'] = "Import & Export Database";
        $data['_view'] = "database/backup";
        echo view('layouts/main', $data);
    }
    public function export()
    {
        // Database credentials
        $dbHost = getenv('database.default.hostname');
        $dbName = getenv('database.default.database');
        $dbUser = getenv('database.default.username');
        $dbPass = getenv('database.default.password');

        // Path to store the backup file
        $backupPath = WRITEPATH . 'database/backup-' . date('Y-m-d_H-i-s') . '.sql';

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

        /*echo "Command: $command<br>";
        echo "Return Code: $return_var<br>";
        echo "Output: <pre>" . print_r($output, true) . "</pre>";*/

        if ($return_var === 0) {
            session()->setFlashdata("success", "La base de données a été exportée avec succès dans $backupPath.");
            return redirect()->to(base_url('databases'));

        } else {

            session()->setFlashdata("failed", "Erreur lors de l'exportation de la base de données : $return_var");
            return redirect()->to(base_url('databases'));
        }
    }
    public function import($sql_file = null)
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
                $data['_view'] = ('database/backup');
                echo view('layouts/main', $data);
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
            return redirect()->to(base_url('databases'));
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

        /*echo "Command: $command<br>";
        echo "Return Code: $return_var<br>";
        echo "Output: <pre>" . print_r($output, true) . "</pre>";*/

        if ($return_var === 0) {
            session()->setFlashdata("success", "La base de données $dbName. a été importée avec succès !");
            $schoolid = $this->session->schoolid;
            $year = $this->model->fetch_row_data('years', array('year_status' => 'actif', 'year_school_id' => $schoolid));
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
            return redirect()->to(base_url('databases'));

        } else {

            session()->setFlashdata("failed", "Erreur lors de l'importation de la base de données : $return_var");
            return redirect()->to(base_url('databases'));

        }
    }
    public function removeFileBackup($filename = null)
    {
        $filepath = WRITEPATH . 'database';
        //if post has image cover, delete file on server directory
        if (!empty($filename)) {
            //$cwd = getcwd();  //Save the current working directory
            $file_path = $filepath . '/' . $filename;
            //dd($file_path);
            if (file_exists($file_path)) {

                if (chdir($filepath)) {
                    unlink($filename);
                    session()->setFlashdata("success", "La sauvegarde $filename de la base de données a été supprimée avec succès");
                    return redirect()->to(base_url('databases'));
                }
                session()->setFlashdata("failed", "Erreur lors de suppression de la sauvegarde de la base de données");
                return redirect()->to(base_url('databases'));
                //chdir($cwd);//Restore the preview working directory
            } else {
                session()->setFlashdata("failed", "La sauvegarde $filename de la base de données est introuvable!");
                return redirect()->to(base_url('databases'));
            }
        }
    }

    public function migrate()
    {
        // Path to the PHP binary and the project directory
        $phpBinary = '/opt/lampp/bin/php'; // Adjust this path as needed
        $projectDir = '/opt/lampp/htdocs/web/aschool-manager'; // Adjust this path as needed

        // Command to run `php spark migrate`
        $command_linux = "$phpBinary $projectDir/spark migrate:refresh";
        $command_windows = "php spark migrate:refresh";

        $os = $this->getUserAgentPlatform();

        $command = ($os == 'Linux') ? $command_linux : $command_windows;

        // Execute the command and capture the output and return code
        $output = [];
        $return_var = null;
        exec($command . ' 2>&1', $output, $return_var);

        /* Debug information*/
        echo "Command: $command<br>";
        echo "Return Code: $return_var<br>";
        echo "Output: <pre>" . implode("\n", $output) . "</pre>";

        // dd($command);

        if ($return_var === 0) {
            session()->setFlashdata('success', "Database Migration successful");
            return redirect()->to(base_url('logout'));
        } else {
            $error = "Migration failed with error code $return_var. Please check the command and ensure that the migrations are set up correctly.";
            session()->setFlashdata('failed', "$error");
            return redirect()->to(base_url('databases'));
        }
    }
}
