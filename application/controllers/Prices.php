<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Supplier (UserController)
 * Supplier Class to control all Supplier related operations.
 * @author : M.Ali
 * @version : 1.1
 * @since : 15 November 2024
 */
class Prices extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Prices_model');
        $this->isLoggedIn();
        $this->module = 'Prices';
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = WEB_NAME . ' : Dashboard';

        redirect('listing');
    }

    public function listing($id = null)
    {

        if ($this->hasListAccess() == false) {
            $this->loadThis();
        } else {
             
             $data = array();

             $this->load->library('pagination');
             $this->load->model('Prices_model');
             
             $prices_model = new Prices_model();
                        

            $count = $prices_model->count();

            $returns = $this->paginationCompress("listing/", $count, 5);

            $data['records'] =  $prices_model->getAll($returns["page"], $returns["segment"],NULL);
        
            $this->global['pageTitle'] = "prices";

            $this->loadViews('prices/list', $this->global, $data);
        }
    }
    
    public function add(){

        if ($this->hasCreateAccess() == false) {
            $this->loadThis();
        }else{
            $data = array();

            $this->load->library('pagination');
            $this->load->model('Prices_model');
            $this->load->model('Role_model');
            
            $prices_model = new Prices_model();
            $role_model = new Role_model();
            
            $count = $prices_model->count();
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              
                $result = $prices_model->insert($_POST);
                if($result){
                    $this->session->set_flashdata('success', 'New price created successfully');
                }else{
                    
                    $this->session->set_flashdata('error','New prices creation failed');
                }
                redirect(base_url("prices"));
            }

            $data['roles'] =  $role_model->getAllRoles();
            $this->global['pageTitle'] = "prices";
            $this->loadViews('prices/add', $this->global, $data);

        }
    }

    public function edit($id = null){

        if ($this->hasUpdateAccess() == false || $id == null) {
            $this->loadThis();
        }else{
            $data = array();

            $this->load->model('Prices_model');
            $this->load->model('Role_model');
            
            $prices_model = new Prices_model();
            $role_model = new Role_model();
            
            $count = $prices_model->count();
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              
                $result = $prices_model->update($_POST, $id);
                if($result){
                    $this->session->set_flashdata('success', 'Price updated successfully');
                }else{
                    
                    $this->session->set_flashdata('error','Price updation failed');
                }
                redirect(base_url("prices"));
            }

            $data['prices'] = $prices_model->getWhere(array('id'=> $id))[0] ?? array();
            $data['roles'] =  $role_model->getAllRoles();
            $this->global['pageTitle'] = "prices";
            $this->loadViews('prices/edit', $this->global, $data);

        }
    }
}
