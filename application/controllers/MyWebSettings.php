<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Web Settings (WebSettings)
 * Website Settings Class to control all Website Settings related operations.
 * @author : M.Ali
 * @version : 1.1
 * @since : 15 April 2024
 */
class MyWebSettings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('WebSetting_model');
        $this->isLoggedIn();
        $this->module = 'Settings';
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = WEB_NAME . ' : Dashboard';
        // $this->listing();
        redirect('web-settings/listing');
    }

    public function listing($id = null)
    {
        if ($this->hasListAccess() == false) {
            $this->loadThis();
        } else {

            $id = 1;
            $data =  array();
            $data['access'] = '';
            $this->load->model('WebSetting_model');
            $webSetting_model = new WebSetting_model();

             if($this->hasUpdateAccess() == false && $this->hasCreateAccess() == false) {
               $data['access'] = 'false';
             }

            if ($_SERVER['REQUEST_METHOD'] == "POST" && $data['access'] == '') {

                $data['records'] =  $webSetting_model->getAll()[0] ?? false;

                $_POST['createdBy'] = $this->vendorId;
                $_POST['createdDtm'] = date('d-m-Y H:i:s');
                $_POST['updatedBy'] = $this->vendorId;
                $_POST['updatedDtm'] = date('d-m-Y H:i:s');
                if(!empty($_FILES['web_logo']['name'])){
                    if (!empty($data['records'])) {
                        $logo_link = $data['records']->web_logo;
                        if(file_exists('./'.$logo_link)){
                            unlink('./'.$logo_link);
                        }
                    }
                 $_POST['web_logo'] = $this->do_upload('web_logo');
                }
              
                if (!empty($data['records'])) {
                    $id = $data['records']->id;
                    $webSetting_model->update($id, $_POST);
                } else {
                    $webSetting_model->insert($_POST);
                }
            }

            $this->global['pageTitle'] = "Web Setting";

            $data['records'] =  $webSetting_model->getAll()[0] ?? false;
            $this->loadViews('settings/list', $this->global, $data);
        }
    }

    /**
     * This function used to upload files (images) to server
     */
    public function do_upload(String $input_name, String $upload_path = "/uploads/")
    {
        $config['upload_path'] = "." . $upload_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024 * 2; 

        $config['file_name'] = 'logo'; // Customize the file name
        $this->load->library('upload', $config);
        $result = "";
        if (!$this->upload->do_upload($input_name)) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            $result =  $upload_path . $this->upload->data('orig_name');
        }
      
        return  $result;
    }
}
