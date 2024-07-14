<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Tax (TaxController)
 * Tax Class to control all Tax related operations.
 * @author : M.Ali
 * @version : 1.1
 * @since : 1 June 2024
 */
class Tax extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('Role_model');
        $this->load->model('Tax_model');
        $this->isLoggedIn();
        $this->module = 'Tax';
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        redirect('tax-listing');
    }

    public function listing($id = null)
    {

        if ($this->hasListAccess() == false) {
            $this->loadThis();
        } else {
             
             $data = array();

             $tax_model = new Tax_model();
        
            $count = $tax_model->count();

            $returns = $this->paginationCompress("listing/", $count, 5);

            $data['records'] =  $tax_model->getAll($returns["page"], $returns["segment"],NULL);
        
            $this->global['pageTitle'] = 'Sales Tax';

            $this->loadViews('taxes/list', $this->global, $data);
        }
    }
    
    public function add(){

        if ($this->hasCreateAccess() == false) {
            $this->loadThis();
        }else{
            $data = array();          
            
            $tax_model = new Tax_model();
            $role_model = new Role_model();
            
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $result = $tax_model->insert($_POST);
                if($result){
                    $this->session->set_flashdata('success', 'New Tax created successfully');
                }else{
                    
                    $this->session->set_flashdata('error','New Tax creation failed');
                }
                redirect(base_url("tax-listing"));
            }

            $data['roles'] =  $role_model->getAllRoles();
            $this->global['pageTitle'] = "Sales Tax Add";
            $this->loadViews('taxes/add', $this->global, $data);

        }
    }

    public function edit($id = null){

        if ($this->hasUpdateAccess() == false || $id == null) {
            $this->loadThis();
        }else{
            $data = array();
            
            $tax_model = new Tax_model();
            $role_model = new Role_model();
            
            if($_SERVER['REQUEST_METHOD'] == "POST"){
              
                $result = $tax_model->update($_POST, $id);
                if($result){
                    $this->session->set_flashdata('success', 'Tax updated successfully');
                }else{
                    
                    $this->session->set_flashdata('error','Tax updation failed');
                }
                redirect(base_url("tax-listing"));
            }

            $data['prices'] = $tax_model->getWhere(array('id'=> $id))[0] ?? array();
            $data['roles'] =  $role_model->getAllRoles();
            $this->global['pageTitle'] = "Sales Tax Edit";
            $this->loadViews('taxes/edit', $this->global, $data);

        }
    }
}
