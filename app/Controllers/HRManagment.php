<?php

namespace App\Controllers;

class HRManagment extends BaseController
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
        $this->listing("employees");
    }

    public function listing($nameFolder)
    {
        $name = (!empty($nameFolder)) ? $nameFolder : "employees";
        $data = [];
        switch ($name) {
            
            case "access":
                $data["users"] = $this->join->fetch_join_data('users_access', 'users_roles', ('users_roles.role_id = users_access.access_role_id'),
                array('access_deleted_at' => null), 'access_created_at');
                
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_status' => 'actif'), 'role_created_at');
                break;
            case "roles":
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_deleted_at' => null), 'role_created_at');
                break;
            case "features":
                $data["features"] = $this->model->fetch_all_data('features', array('feature_status' => 'actif'), 'feature_created_at');
                break;
            case "services":
                $data["services"] = $this->model->fetch_all_data('services', array('service_deleted_at' => null), 'service_created_at');
                break;
           
            default: break;
        }
        
        $data["title"] = ucwords($name);
        $data["_view"] = "gesem/listing/" . $name;
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
            case "message":
                $data["message"] = $this->model->fetch_row_data('contacts', array('con_uid' => $idRow));
                break;
            case "customer":
            case "partner":
                $data["customer"] = $this->model->fetch_row_data('clients', array('client_uid' => $idRow));
                break;
            default:
                break;
        }

        $data["title"] = ucwords($page);
        $data["_view"] = "gesem/details/" . $page;
        echo view("layouts/main", $data);
    }

    public function create($page)
    {
        if(checkUserAccessFolder(session()->admin_created) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }
        $data = [];
        switch ($page) {
            case 'user':
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_status' => 'actif'), 'role_created_at');
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
        if(checkUserAccessFolder(session()->admin_updated) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }
        $data = [];
        switch ($page) {
            case "customer":
            case "partner":
                $data["customer"] = $this->model->fetch_row_data('clients', array('client_uid' => $idRow));
                break;
            case "role":
                $data["role"] = $this->model->fetch_row_data('users_roles', array('role_id' => $idRow));
                break;
            case "user":
                $data["users_roles"] = $this->model->fetch_all_data('users_roles', array('role_status' => 'actif'), 'role_created_at');
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
        if(checkUserAccessFolder(session()->admin_reading) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }
        switch ($page) {
            case "message":
                $this->model->delete_data('contacts', array('con_uid' => $idRow));
                break;
            case "acces":
                $this->model->delete_data('users_access', array('access_id' => $idRow));
                break;
                 case "role":
                $this->model->delete_data('users_roles', array('role_id' => $idRow));
                break;
            case "categorie":
                $this->model->delete_data('categories', array('category_uid' => $idRow));
                break;
            case "newsletter":
                $this->model->delete_data('newsletters', array('newsletter_uid' => $idRow));
                break;
            case "customer":
            case "partner":
                $this->model->delete_data('clients', array('client_uid' => $idRow));
                break;
            case "user":
                $this->model->delete_data('users', array('user_id' => $idRow));
                break;
                case "salestax":
                    $this->model->delete_data('salestaxs', array('tax_uid' => $idRow));
                    break;
                  
            default:
                $this->model->delete_data($page.'s', array($page.'_uid' => $idRow));
                break;
        }
        session()->setFlashdata('success', "Suppression effectuée avec succès !");
        if($page == "sector" OR $page == "exchange" OR $page == "salestax"OR $page == "domain"){
            return redirect()->to(base_url('admin/config/'.$page.'s'));
        }else{
            return redirect()->to(base_url('admin/view/'.$page.'s'));
        }
    }
    
    function changeStatus($page, $query)
    {
        if(checkUserAccessFolder(session()->admin_updated) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }
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
        if(checkUserAccessFolder(session()->admin_reading) == FALSE){
            return redirect()->to(base_url('dashboard'));
        }
        if ($type == 'post') {
            //get post image name from db
            $post_data_db = $this->model->fetch_row_data('posts', array('post_uid' => $uid));
            //set path post image location
            $path_image = "\\global\\uploads\\images"; //syntaxe for directory
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


    function saveCategory($action, $idRow=null)
    {
        if (($this->request->getPost() ) && ($this->request->getPost('honeypot') == '')) {
      
            //get user session informations
            $agentSession = $this->session->usertoken;
            $data = []; // associative array
            // check rulers validation
            $data['categories'] = $this->model->fetch_all_data('categories', 
            array('category_deleted_at' => null), 'category_created_at');
                
            $rulers = [
                'status' => [
                    'rules' => 'required',//|is_unique[accounts.account_code]
                    'errors' => [
                        'required' => 'Veuillez spécifier le statut',
                        //'is_unique' => 'Ce compte existe déjà dans le système',
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le libellé',
                        //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                    ]
                ],
                'type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez spécifier le type',
                    ]
                ],

            ];
            $type = strval($this->request->getPost('type'));
            $name = strval($this->request->getPost('name'));
            $status = $this->request->getPost('status');
            //run the validation rulers
            if ($this->validate($rulers)) {
                if ($action == 'create') {
                    $insertNewData = array(
                        'category_uid' => setPrimaryKey(),
                        'category_type' => strtolower($type),
                        'category_name' => strtolower($name),
                        'category_status' => $status,
                        'category_created_at' => date('Y-m-d H:i:s')
                    );
                    //check before insert data
                    if ($this->model->insert_data('categories', $insertNewData)) {
                        return redirect()->back()->with('success', "Compte créé avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                } else {
                    
                    $updateNewData = array(
                        'category_type' => strtolower($type),
                        'category_name' => strtolower($name),
                        'category_status' => $status,
                        'category_updated_at' => date('Y-m-d H:i:s'),
                       
                    );
                    //check before insert data
                    if ($this->model->update_data('categories', $updateNewData, array('category_uid' => $idRow))) {
                        return redirect()->back()->with('success', "catégorie mise à jour avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                }
            } else {
                session()->setFlashdata('failed', "Veuillez corriger les erreurs ci-dessous puis réessayer");
                    
                $data['validation'] = $this->validator;
                $data['title'] = 'Gestion catégories';
                $data['_view'] = ('admin/config/categories');
                echo view('layouts/main', $data);
            }
        }
    }  
    function saveSector($action, $idRow=null)
    {
        if (($this->request->getPost() ) && ($this->request->getPost('honeypot') == '')) {
      
            $data = []; // associative array
            // check rulers validation
            $data['sectors'] = $this->model->fetch_all_data('sectors', 
            array('sector_deleted_at' => null), 'sector_created_at');
                
            $rulers = [
                'status' => [
                    'rules' => 'required',//|is_unique[accounts.account_code]
                    'errors' => [
                        'required' => 'Veuillez spécifier le statut',
                        //'is_unique' => 'Ce compte existe déjà dans le système',
                    ]
                ],
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Veuillez saisir le libellé',
                        //'is_unique' => 'Ce rôle est déjà créé. Veuillez changer',
                    ]
                ],
            ];
            $description = $this->request->getPost('description');
            $name = strval($this->request->getPost('name'));
            $status = $this->request->getPost('status');
            //run the validation rulers
            if ($this->validate($rulers)) {
                if ($action == 'create') {
                    $insertNewData = array(
                        'sector_uid' => setPrimaryKey(),
                        'sector_name' => strtolower($name),
                        'sector_code' => setReferenceCode(),
                        'sector_slug' => setSlugTitle($name),
                        'sector_status' => $status,
                        'sector_description' => $description,
                        'sector_created_at' => date('Y-m-d H:i:s')
                    );
                    //check before insert data
                    if ($this->model->insert_data('sectors', $insertNewData)) {
                        return redirect()->back()->with('success', "sector créé avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                } else {
                    $updateNewData = array(
                        'sector_slug' => setSlugTitle($name),
                        'sector_name' => strtolower($name),
                        'sector_status' => $status,
                        'sector_description' => $description,
                        'sector_updated_at' => date('Y-m-d H:i:s'),
                    );
                    //check before insert data
                    if ($this->model->update_data('sectors', $updateNewData, array('sector_uid' => $idRow))) {
                        return redirect()->back()->with('success', "mise à jour avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Veuillez réessayer plus tard. Le Système est indisponible.");
                    }
                }
            } else {
                session()->setFlashdata('failed', "Veuillez corriger les erreurs ci-dessous puis réessayer");
                    
                $data['validation'] = $this->validator;
                $data['title'] = 'Gestion catégories';
                $data['_view'] = ('admin/config/sectors');
                echo view('layouts/main', $data);
            }
        }
    } 
}