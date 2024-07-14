<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Task (TaskController)
 * Task Class to control task related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Task extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model', 'tm');
        $this->isLoggedIn();
        $this->module = 'Task';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('task/taskListing');
    }

    public function getGraphData(){
        // Sample data
        $interval = $_REQUEST['filter'] ??  90 ;
        $this->load->model('Booking_model');
        $booking_model = new Booking_model();
        $data1['records'] = $booking_model->getInterval($interval,['createdDtm','totalPrice','serviceId'],['status'=>ACTIVE]);

        if(!empty($data1['records'])){
            $cout = 0;
            foreach($data1['records'] as $key => $value){

                $col = date('F', strtotime($value->createdDtm));
                $data1[$col]['categories'] = $col;

                if(empty($data1[$col]['sales'])){
                    $data1[$col]['sales'] = 0;
                }
                $data1[$col]['sales'] += (int) $value->totalPrice;

                if(empty($data1[$col]['expenses'])){
                    $data1[$col]['expenses'] = 0;
                }
                $data1[$col]['expenses'] += (int) $value->serPrice;
                
                $cout  += 1;
                $data1[$col]['revenue']  =  ($data1[$col]['sales']);
                $data1[$col]['profit_losses'] = $data1[$col]['sales']- $data1[$col]['expenses'];

            }
        }

        unset($data1['records']);
        
       $categories = array_column($data1,'categories');
       $sales = array_column($data1,'sales');
       $revenue = array_column($data1,'revenue');
       $expenses = array_column($data1,'expenses');
       $profit_losses = array_column($data1,'profit_losses');

       
       $dataArr = [
        'categories' => $categories,
        'sales' => $sales,
        'revenue' => $revenue,
        'expenses' => $expenses,
        'profit_losses' => $profit_losses
    ];
    
        // // Convert data to JSON format and send response
        header('Content-Type: application/json');
        echo json_encode( (array) $dataArr);
    }
    
    /**
     * This function is used to load the task list
     */
    function taskListing()
    {
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = '';
            if(!empty($this->input->post('searchText'))) {
                $searchText = $this->security->xss_clean($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->tm->taskListingCount($searchText);

			$returns = $this->paginationCompress ( "taskListing/", $count, 10 );
            
            $data['records'] = $this->tm->taskListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = WEB_NAME.' : Task';
            
            $this->loadViews("task/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = WEB_NAME.' : Add New Task';

            $this->loadViews("task/add", $this->global, NULL, NULL);
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewTask()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('taskTitle','Task Title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->add();
            }
            else
            {
                $taskTitle = $this->security->xss_clean($this->input->post('taskTitle'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $taskInfo = array('taskTitle'=>$taskTitle, 'description'=>$description, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->tm->addNewTask($taskInfo);
                
                if($result > 0) {
                    $this->session->set_flashdata('success', 'New Task created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Task creation failed');
                }
                
                redirect('task/taskListing');
            }
        }
    }

    
    /**
     * This function is used load task edit information
     * @param number $taskId : Optional : This is task id
     */
    function edit($taskId = NULL)
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($taskId == null)
            {
                redirect('task/taskListing');
            }
            
            $data['taskInfo'] = $this->tm->getTaskInfo($taskId);

            $this->global['pageTitle'] = WEB_NAME.' : Edit Task';
            
            $this->loadViews("task/edit", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editTask()
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $taskId = $this->input->post('taskId');
            
            $this->form_validation->set_rules('taskTitle','Task Title','trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description','Description','trim|callback_html_clean|required|max_length[1024]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->edit($taskId);
            }
            else
            {
                $taskTitle = $this->security->xss_clean($this->input->post('taskTitle'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $taskInfo = array('taskTitle'=>$taskTitle, 'description'=>$description, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->tm->editTask($taskInfo, $taskId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Task updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Task updation failed');
                }
                
                redirect('task/taskListing');
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>