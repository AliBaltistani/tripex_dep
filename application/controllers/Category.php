<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Task (CategoryController)
 * Task Class to control Categories related operations.
 * @author :M.Ali
 * @version : 1.5
 * @since : 19 Jun 2024
 */
class Category extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Category_model', 'cm');
        $this->load->model('Service_model', 'sm');
        $this->isLoggedIn();
        $this->module = 'Categories';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('category/categoryListing');
    }
    
    /**
     * This function is used to load the task list
     */
    function categoryListing()
    {
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = '';
            if(!empty($this->input->post('searchText'))) {
                $searchText = ($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->cm->categoryListingCount($searchText);

			     $returns = $this->paginationCompress ( "category/", $count, 5,3 );
            
            $data['records'] = $this->cm->categoryListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = WEB_NAME.' : Category';
            
            $this->loadViews("category/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = WEB_NAME.'  : Add New Category';

            $this->loadViews("category/add", $this->global, NULL, NULL);
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewCategory()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('categoryTitle','Category Title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('cLabel','type','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('categoryImage', 'Image', 'callback_validate_file');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->add();
            }
            else
            {
              
                $categoryTitle = ($this->input->post('categoryTitle'));
                $description = ($this->input->post('description'));
                $cLabel = ($this->input->post('cLabel'));
                $status = ($this->input->post('statuss'));
                
                 $image = $this->do_upload($categoryTitle);
                 if($image == "error")
                 { 
                    $this->session->set_flashdata('error', 'Image should be (.jpg|.png|.jpeg|.gif) and size less then 2MB');
                    $this->add();
                 }else{
                    $categoryInfo = array('categoryName'=>$categoryTitle, 
                    'description'=>$description,
                    'categoryImage' =>$image,
                    'isPublished' => $status,  
                    'categoryLabel' =>$cLabel, 
                    'createdBy'=>$this->vendorId,
                    'createdDtm'=>date('Y-m-d H:i:s')
                    );
                
                    $result = $this->cm->addNewCategory($categoryInfo);
                    
                    if($result > 0) {
                        $this->session->set_flashdata('success', 'New Category created successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Category creation failed');
                    }
                    
                    redirect('category/categoryListing');
                 }
            }
        }
    }
    
    /**
     * This function is used load Category edit information
     * @param number $taskId : Optional : This is task id
     */
    function edit($categoryId = NULL)
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($categoryId == null)
            {
                redirect('category');
            }
            
            $data['categoryInfo'] = $this->cm->getCategoryInfo($categoryId);

            $this->global['pageTitle'] = WEB_NAME.' : Edit Category';
            
            $this->loadViews("category/edit", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editCategory()
    {
        
        if(!$this->hasUpdateAccess()){ $this->loadThis();}
        else
        { 
            $categoryId = $this->input->post('categoryId');
            
            $this->form_validation->set_rules('categoryName','Category Name','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('cLabel','type','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('status','Status','trim|required');
            
            if($this->form_validation->run() == FALSE){ $this->edit($categoryId);}
            else
            {
                $categoryTitle = ($this->input->post('categoryName'));
                $description = ($this->input->post('description'));
                $status = ($this->input->post('status'));
                $categoryImage = ($_FILES['categoryImage']['name'])?$_FILES['categoryImage']['name']:'';
                $cLabel = ($this->input->post('cLabel'));
                
                $categoryInfo = array('categoryName'=>$categoryTitle, 'description'=>$description, 'categoryLabel'=>$cLabel, 'isPublished'=>$status, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));

                if($categoryImage){
                    $image = $this->do_upload($categoryTitle);
                    if($image == "error")
                    { 
                        $this->session->set_flashdata('error', 'Image should be (.jpg|.png|.jpeg|.gif) and size less then 2MB');
                        redirect('category/edit/'.$categoryId);
                    }else { $categoryInfo['categoryImage'] = $image; }
                }               
            
                $result = $this->cm->editCategory($categoryInfo, $categoryId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Task updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Task updation failed');
                }
                
                redirect('category');
            }
        }
    }

    // Custom callback function to validate post input
    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }

    // Custom callback function to validate file input
    public function validate_file($str) {
        if (empty($_FILES['categoryImage']['name'])) {
            $this->form_validation->set_message('validate_file', 'The {field} field is required.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    
     // This function to upload files 
     public function do_upload($title) {
        $new_name = str_replace(' ', '-',$title);
  
        $config['upload_path'] = './uploads/category/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024*2; // Maximum file size in kilobytes
      //   $config['max_width'] = 1024;
      //   $config['max_height'] = 768;
        $config['file_name'] = $new_name.'-'.time(); // Customize the file name
        $this->load->library('upload', $config);
        $result = "";
        (!$this->upload->do_upload('categoryImage'))?$result = "error":
          $result =  '/uploads/category/'.$this->upload->data('orig_name');
        return  $result;
    }
    
    
    // serviceControler
     public function listingService()
  {
    if (isset($_REQUEST['id'])) {
      $categoryId = $_REQUEST['id'];
    } else {
      $categoryId = "";
    }
    if (isset($_REQUEST['txt'])) {
      $txt = $_REQUEST['txt'];
    } else {
      $txt = "";
    }
    if (isset($_REQUEST['segment'])) {
      $segment = $_REQUEST['segment'];
    } else {
      $segment = "2";
    }

    if (!$this->hasCreateAccess() ||  ($categoryId == "" || $txt == "")) {
      $this->loadThis();
    } else {
      $searchText = '';
      if (!empty($this->input->post('searchText'))) {
        $searchText = ($this->input->post('searchText'));
      }

      $serviceType = '';
      if ($txt == "listing" || $txt == NULL) {
        $serviceType = '';
      } else {
        $trim = trim($txt);
        $str_txt = str_replace('_', ' ', $trim);
        $serviceType = $str_txt;
      }
      $data['searchText'] = $searchText;
      $data['category'] = $txt;
      $data['categorId'] = $categoryId;
      $data['params'] = 'services/add?txt=' . $txt . '&id=' . $categoryId;
      $data['params_self'] = 'services/listing?txt=' . $txt . '&id=' . $categoryId;

      $this->load->library('pagination');
      $count = $this->sm->listingCount($searchText);
      $returns = $this->paginationCompress("services/listing", $count, 5,$segment);
      $data['records'] = $this->sm->listing($searchText, $categoryId, $returns["page"], $segment);

      $this->global['pageTitle'] = $txt;
      $this->loadViews("services/list", $this->global, $data, NULL);
    }
  }

    
    
}

