<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Task (CategoryController)
 * Task Class to control Categories related operations.
 * @author :M.Ali
 * @version : 1.5
 * @since : 19 Jun 2024
 */
class SubCategory extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('SubCategory_model', 'scm');
        $this->load->model('Category_model', 'cm');
        $this->isLoggedIn();
        // $this->module = '';

    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('packages/add_new_package');
    }

    /**
     * This function is used to load the task list
     */
    function subcategoryListing($pagenation = null)
    {
        $txt = "";
        $maincatId = "";
        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }
        if (isset($_REQUEST['txt'])) {
            $txt = ucfirst($_REQUEST['txt']);
        }

        if ( !$this->moduleHasAccess($maincatId,'list') || ($txt == "" || $maincatId == "")) {
            $this->loadThis();
        } else {
            $searchText = '';
            if (!empty($this->input->post('searchText'))) {
                $searchText = ($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->scm->subcategoryListingCount($searchText, $maincatId);

            $returns = $this->paginationCompress("subcategory/", $count, 5, 3);

            // $data['records'] = $this->scm->subcategoryListing($searchText, $returns["page"], $returns["segment"]);
            $data['records'] = $this->scm->subcategoryListingId($searchText, $maincatId, $returns["page"], $returns["segment"]);

            $data['clabel'] = $txt;
            $data['parms'] = '?txt=' . strtolower($txt) . '&id=' . $maincatId;
            $this->global['pageTitle'] = "Listing " . $txt;

            $this->loadViews("subcategory/list", $this->global, $data, NULL);
        }
    }

    function allSubCat()
    {
        $maincatId = "";
        $json_data = array();

        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }

        if (($maincatId == "")) {
            $json_data =  (object) array('subcatName' => "no-access");
            echo json_encode($json_data);
        } else {

            $searchText = '';
            if (!empty($this->input->post('searchText'))) {
                $searchText = ($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->scm->subcategoryListingCount($searchText, $maincatId);

            $returns = $this->paginationCompress("subcategory/", $count, 100);

            // $data['records'] = $this->scm->subcategoryListing($searchText, $returns["page"], $returns["segment"]);
            $json_data = $this->scm->subcategoryListingId($searchText, $maincatId, $returns["page"], $returns["segment"]);
            echo json_encode($json_data);
        }
    }



    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $txt = "";
        $maincatId = "";
        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }
        if (isset($_REQUEST['txt'])) {
            $txt = ucfirst($_REQUEST['txt']);
        }

        if (!$this->moduleHasAccess($maincatId,'create_records') || ($txt == "" || $maincatId == "")) {
            $this->loadThis();
        } else {
                $this->global['pageTitle'] = 'Add ' . $txt;
                $data['categories'] = $this->scm->categoryListing();
                $data['clabel'] = $txt;
                $data['cid'] = $maincatId;
                $data['parms'] = '?txt=' . strtolower($txt) . '&id=' . $maincatId;

                $this->loadViews("subcategory/add", $this->global,  $data, NULL);
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNew()
    {
        $txt = "";
        $maincatId = "";
        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }
        if (isset($_REQUEST['txt'])) {
            $txt = ucfirst($_REQUEST['txt']);
        }

        if (!$this->moduleHasAccess($maincatId,'create_records') ||($txt == "" || $maincatId == "")) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('categoryTitle', 'Category Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('maincatid', 'Main Category ', 'trim|required');
            $this->form_validation->set_rules('status', 'status ', 'trim|required');
            $this->form_validation->set_rules('subcategoryImage', 'Image', 'trim|callback_validate_file');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {

                $categoryTitle = ($this->input->post('categoryTitle'));
                $description = ($this->input->post('description'));
                $maincatid = ($this->input->post('maincatid'));
                $status = ($this->input->post('status'));
                $passengers = ($this->input->post('passengers'));
                $baby_seats = ($this->input->post('baby_seats'));
                $luggage = ($this->input->post('luggage'));
                if ($luggage == ""  || $luggage == "0") {
                    $luggage == "00";
                }
                if ($passengers == ""  || $passengers == "0") {
                    $passengers == "00";
                }
                if ($baby_seats == "") {
                    $baby_seats == "0";
                }


                $extraInfo = array();
                $extraInfo['passengers'] = $passengers;
                $extraInfo['baby_seats'] = $baby_seats;
                $extraInfo['luggage'] = $luggage;

                $image = $this->do_upload($categoryTitle);
                if ($image == "error") {
                    $this->session->set_flashdata('error', 'Image should be (.jpg|.png|.jpeg|.gif) and size less then 2MB');
                    $this->add();
                } else {
                    $categoryInfo = array('subcatName' => $categoryTitle, 'subcatDescription' => $description, 'subcatImage' => $image, 'maincatId' => $maincatid, 'isPublished' => $status, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'));
                    if (!empty($extraInfo)) {
                        $categoryInfo['extraInfo'] = json_encode($extraInfo);
                    }

                    $result = $this->scm->addNewSubCategory($categoryInfo);

                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'New Category created successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Category creation failed');
                    }

                    $data['clabel'] = $txt;
                    $data['cid'] = $maincatId;
                    $data['parms'] = '?txt=' . strtolower($txt) . '&id=' . $maincatId;

                    redirect('packages/listing' . $data['parms']);
                }
            }
        }
    }

    /**
     * This function is used load Category edit information
     * @param number $taskId : Optional : This is task id
     */
    function edit()
    {
        $txt = "";
        $maincatId = "";
        $subcategoryId = "";
        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }
        if (isset($_REQUEST['txt'])) {
            $txt = ucfirst($_REQUEST['txt']);
        }
        if (isset($_REQUEST['scid'])) {
            $subcategoryId = ucfirst($_REQUEST['scid']);
        }

        if (!$this->moduleHasAccess($maincatId,'edit_records') ||  ($txt == "" || $subcategoryId == "")) {
            $this->loadThis();
        } else {

            $data['categories'] = $this->scm->categoryListing();
            $data['subcategoryInfo'] = $this->scm->getSubCategoryInfo($subcategoryId);

            $this->global['pageTitle'] = 'Edit ' . $txt;
            $data['clabel'] = $txt;
            $data['cid'] = $maincatId;
            $data['parms'] = '?txt=' . strtolower($txt) . '&id=' . $maincatId . '&scid=' . $subcategoryId;

            $this->loadViews("subcategory/edit", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editExisting()
    {
        $txt = "";
        $maincatId = "";
        $subcategoryId = "";
        if (isset($_REQUEST['id'])) {
            $maincatId = $_REQUEST['id'];
        }
        if (isset($_REQUEST['txt'])) {
            $txt = ucfirst($_REQUEST['txt']);
        }
        if (isset($_REQUEST['scid'])) {
            $subcategoryId = ucfirst($_REQUEST['scid']);
        }

        if (!$this->moduleHasAccess($maincatId,'edit_records') ||  ($txt == "" || $subcategoryId == "")) {
            $this->loadThis();
        } else {
            $categoryId = $this->input->post('categoryId');

            $categoryTitle = ($this->input->post('categoryTitle'));
            $description = ($this->input->post('description'));
            $maincatid = ($this->input->post('maincatid'));
            $status = ($this->input->post('status'));
            $passengers = ($this->input->post('passengers'));
            $baby_seats = ($this->input->post('baby_seats'));
            $luggage = ($this->input->post('luggage')); {
                $luggage == "00";
            }
            if ($passengers == ""  || $passengers == "0") {
                $passengers == "00";
            }
            if ($baby_seats == "") {
                $baby_seats == "0";
            }

            $extraInfo = array();


            $extraInfo['passengers'] = $passengers;
            $extraInfo['baby_seats'] = $baby_seats;
            $extraInfo['luggage'] = $luggage;


            $categoryInfo = array('subcatName' => $categoryTitle, 'subcatDescription' => $description, 'maincatId' => $maincatid, 'isPublished' => $status, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));
            if (!empty($extraInfo)) {
                $categoryInfo['extraInfo'] = json_encode($extraInfo);
            }
            if ($_FILES['subcategoryImage']['name']) {
                $image = $this->do_upload($categoryTitle);
                if ($image == "error") {
                    $this->session->set_flashdata('error', 'Image should be (.jpg|.png|.jpeg|.gif) and size less then 2MB');
                    $this->add();
                } else {
                    $categoryInfo['subcatImage']  = $image;
                }
            }


            $result = $this->scm->editCategory($categoryInfo, $categoryId);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New Category created successfully');
            } else {
                $this->session->set_flashdata('error', 'Category creation failed');
            }

            $this->global['pageTitle'] = 'Edit' . $txt;
            $data['clabel'] = $txt;
            $data['cid'] = $maincatId;
            $data['parms'] = '?txt=' . strtolower($txt) . '&id=' . $maincatId;
            redirect('packages/listing' . $data['parms']);
        }
    }

    // Custom callback function to validate post input
    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }

    // Custom callback function to validate file input
    public function validate_file($str)
    {
        if (empty($_FILES['subcategoryImage']['name'])) {
            $this->form_validation->set_message('validate_file', 'The {field} field is required.');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    // This function to upload files 
    public function do_upload($title)
    {
        $new_name = str_replace(' ', '-', $title);

        $config['upload_path'] = './uploads/category/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 1024 * 2; // Maximum file size in kilobytes
        //   $config['max_width'] = 1024;
        //   $config['max_height'] = 768;
        $config['file_name'] = $new_name . '-' . time(); // Customize the file name
        $this->load->library('upload', $config);
        $result = "";
        (!$this->upload->do_upload('subcategoryImage')) ? $result = "error" :
            $result =  '/uploads/category/' . $this->upload->data('orig_name');
        return  $result;
    }

    function moduleHasAccess($maincatid,$permission){
        $subCate = new  Category_model();
            $category_now =  $subCate->getCategoryRow($maincatid);
            if(!empty($category_now)){
                if (check_permission($category_now->categoryName, $permission)) {
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            }
    }
}
