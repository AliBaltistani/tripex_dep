<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Supplier (UserController)
 * Supplier Class to control all Supplier related operations.
 * @author : M.Ali
 * @version : 1.1
 * @since : 15 November 2024
 */
class Supplier extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->module = 'Suppliers';
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = WEB_NAME . ' : Dashboard';
       
        redirect('supplier-listing');
    }

    /**
     * This function is used to load the user list
     */
    function supplierList($id = null)
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = '';
            if (!empty($this->input->post('searchText'))) {
                $searchText = $this->security->xss_clean($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->Supplier_model->supplierListingCount($searchText);

            $returns = $this->paginationCompress("supplier-listing/", $count, 5);

            $data['userRecords'] = $this->Supplier_model->supplier_listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = WEB_NAME . ' : Suppliers';

            $this->loadViews("suppliers/list", $this->global, $data, NULL);
        }
    }

    function supplierAdd()
    {
        if ($this->hasCreateAccess() == FALSE) {
            $this->loadThis();
        } else {
           
            $data['roles'] = $this->Role_model->getUserRoles();

            $this->global['pageTitle'] = WEB_NAME . ' : Add New Supplier';

            $this->loadViews("suppliers/add", $this->global, $data, NULL);
        }
    }

    function addNewSupplier(){

        if ($this->hasCreateAccess() == FALSE) {
            $this->loadThis();
        } else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('isAdmin','User Type','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|max_length[20]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->supplierAdd();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $isAdmin = $this->input->post('isAdmin');
                $bookingId = $this->input->post('bookingId');
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=> $name, 'mobile'=>$mobile, 'isAdmin'=>$isAdmin,
                        'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                // pre($userInfo);
                // die;
                
                
                $result = $this->Supplier_model->addNewSupplier($userInfo,$bookingId);
                
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Supplier created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Supplier creation failed');
                }
                
                redirect($_REQUEST['param']);
            }
        }

    }

    function supplierEdit($userId = NULL)
    {
        if ( $this->hasUpdateAccess() == FALSE) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('supplier-listing');
            }

            $data['roles'] =  $this->Role_model->getUserRoles();
            $data['userInfo'] = $this->User_model->getUserInfo($userId);

            $this->global['pageTitle'] = WEB_NAME . ' : Edit User';

            $this->loadViews("suppliers/edit", $this->global, $data, NULL);
        }
    }

    function supplierUpdate()
    {
        if($this->hasUpdateAccess() == FALSE) 
        {
            $this->loadThis();
        }else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','trim|matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->supplierEdit($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $isAdmin = $this->input->post('isAdmin');
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name, 'mobile'=>$mobile,
                        'isAdmin'=>$isAdmin, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'isAdmin'=>$isAdmin, 
                        'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->User_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('supplier-listing');
            }
        }
    }

    function supplierBookings(){

      
        $id = $_REQUEST['id'] ?? '';
        if ( $id == '') {
            $this->loadThis();
        } else {
            
             $this->load->model('Booking_model');
             $this->load->model('User_model');
             $booking_model = new Booking_model();
             $user_model = new User_model();

             $data['records'] = $booking_model->getBookingsBySupplierId($id);
             $data['supplier'] = $user_model->getUserInfoById($id);
             $this->global['pageTitle'] = "Supplier Bookings";
             
            $this->loadViews("suppliers/list_booking", $this->global, $data, NULL);
        }
    }
}
