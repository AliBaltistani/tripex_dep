<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Booking (BookingController)
 * Booking Class to control booking related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */

class Booking extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model', 'bm');
        $this->load->model('Category_model', 'cm');
        $this->load->model('Role_model', 'rm');
        $this->load->model('Supplier_model', 'sm');
        $this->load->model('Notification_model');
        $this->isLoggedIn();
        $this->module = 'Booking';
        $this->global['role_id'] = $this->role;
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('booking/bookingListing');
    }

    function bookingListing($id = null)
    {

        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $data['searchText'] = '';
            $data['dateFrom'] = '';
            $data['dateTo'] = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($this->input->post('searchText'))) {
                    $data['searchText'] = trim($this->security->xss_clean($this->input->post('searchText')));
                }
                if (!empty($this->input->post('fromDate'))) {
                    $data['dateFrom'] = trim($this->security->xss_clean($this->input->post('fromDate')));
                    // Convert the selected date to a DateTime object
                    $selected_datetime = new DateTime($data['dateFrom']);
                    $selected_datetime->modify('-1 day');
                    $data['dateFrom'] = $selected_datetime->format("d-M-y");
                }
                if (!empty($this->input->post('toDate'))) {
                    $data['dateTo'] = trim($this->security->xss_clean($this->input->post('toDate')));
                    // Convert the selected date to a DateTime object
                    $selected_datetime = new DateTime($data['dateTo']);
                    $selected_datetime->modify('+1 day');
                    $data['dateTo'] = $selected_datetime->format("d-M-y");
                }
            }


            $this->load->library('pagination');


            if (!$this->isAdmin()) {
                $data['spId'] = $_SESSION['userId'] ?? 0;
                
                $count = $this->bm->bookingListingCount($data);

                $returns = $this->paginationCompress("bookingListing/", $count, 5);

                $data['records'] = $this->bm->bookingListing($data, $returns["page"], $returns["segment"]);
            }else{
                $count = $this->bm->bookingListingCount($data);
                $returns = $this->paginationCompress("bookingListing/", $count, 5);
                $data['records'] = $this->bm->bookingListing($data, $returns["page"], $returns["segment"]);
            }
            

            $category = array();
            
            $data['categories'] = $this->cm->categoryListingForBooking($category);

            $this->global['pageTitle'] = 'Booking';
            $data['roles'] = $this->rm->getAllRoles();
            $data['suppliers'] = $this->sm->get_suppliers_only();

            $this->loadViews("booking/list", $this->global, $data, NULL);
        }
    }

    function load_more()
    {
        $data = array();
        $data['serId'] = '';
        if (isset($_REQUEST['serId'])) {
            $data['serId'] = $_REQUEST['serId'];
        }
        if (!$this->hasListAccess() || empty($data['serId'])) {
            $this->loadThis();
        } else {
            $data['searchText'] = '';
            $data['dateFrom'] = '';
            $data['dateTo'] = '';


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($this->input->post('searchText'))) {
                    $data['searchText'] = trim($this->security->xss_clean($this->input->post('searchText')));
                }
                if (!empty($this->input->post('fromDate'))) {
                    $data['dateFrom'] = trim($this->security->xss_clean($this->input->post('fromDate')));
                    // Convert the selected date to a DateTime object
                    $selected_datetime = new DateTime($data['dateFrom']);
                    $selected_datetime->modify('-1 day');
                    $data['dateFrom'] = $selected_datetime->format("d-M-y");
                }
                if (!empty($this->input->post('toDate'))) {
                    $data['dateTo'] = trim($this->security->xss_clean($this->input->post('toDate')));
                    // Convert the selected date to a DateTime object
                    $selected_datetime = new DateTime($data['dateTo']);
                    $selected_datetime->modify('+1 day');
                    $data['dateTo'] = $selected_datetime->format("d-M-y");
                }
            }

            $this->load->library('pagination');
            $this->load->model('User_model');
            $user_model = new User_model();

            $count = $this->bm->bookingListingCount($data);
            $returns = $this->paginationCompress("bookingListing/", $count, 5);

            $data['records'] = $this->bm->getBookingOnly($data['serId']);

            $data['suppliers'] = array();
            if($data['records']->bSupplierId){
                $data['suppliers'] = $user_model->getUserInfoById($data['records']->bSupplierId);
            }
            
            $data['roles'] = $this->rm->getAllRoles();


            $this->global['pageTitle'] = 'Booking';

            if(!empty($_REQUEST['nid'])){

                $nid =  $_REQUEST['nid'];
                $notify = new Notification_model();
                 $update = [
                    'read_status'=>1,
                    'updatedBy'=>$this->vendorId,
                    'updatedDtm'=>date('Y-m-d H:i:s')
                 ];
                 $isUpdated =  $notify->update($update, $nid);
            }

            $this->loadViews("booking/view_more", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function bookingNew()
    {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        } else {
            $id = "";
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = "";
        }

        if (!$this->hasCreateAccess() ||  ($id == "" || $type == "")) {
            $this->loadThis();
        } else {

            $data['records'] = $this->bm->getServiceSingle($id);
            $data['params'] = '?type=' . $type . '&id=' . $id;

            // pre($data);
            // die;
            $this->global['pageTitle'] = 'Add New Booking';


            $this->loadViews("booking/add", $this->global, $data, NULL);
        }
    }

    function bookingNewForm()
    {

        if (isset($_REQUEST['id'])) {;
        } else {
            $id = "";
        }

        $id = $_REQUEST['id'] ?? '';
        if (!$this->hasCreateAccess() ||  ($id == "")) {
            $result = $this->load->view('general/access', [], true);
            echo json_encode($result);

        } else {
        $data['records'] = $this->bm->getServiceSingle($id);
        $data['params'] = '&id=' . $id;
        $data['role_id'] = $this->role;
    
        $result = $this->load->view('booking/add_modal_form', $data, true);

        echo json_encode($result);
        }
    }

    function booking_cancel(){

        $bid =  $_REQUEST['bid'] ?? '';
        if ($bid == '') {
            $this->session->set_flashdata('error', 'Invalid booking info');
            redirect('booking');
        }else{
            $notificats  =  new Notification_model();
            $booking_model  =  new Booking_model();
            $data['bookingInfo'] = [
                'status' => CANCEL,
                'updatedBy' => (!empty($_SESSION['isAdmin']))?$_SESSION['isAdmin'] : 0,
                'updatedDtm' => date('Y-m-d H:i:s')
            ];
    
            $data['notificationInfo'] = [
                'user_id' => (!empty($_SESSION['isAdmin']))?$_SESSION['isAdmin'] : 0,
                'booking_id' => $bid,
                'message' => "Booking Cancel",
                'read_status' => 0,
                'createdBy' => (!empty($_SESSION['isAdmin']))?$_SESSION['isAdmin'] : 0,
                'createdDtm' => date('Y-m-d H:i:s')
            ];

            $isInserted =  $notificats->insert($data['notificationInfo']);
            $isUpdated =  $booking_model->update($data['bookingInfo'], $bid);

            redirect('booking');

        }
    }
    function confirmBooking()
    {

        if (empty($_REQUEST['bid'])) {
            $this->session->set_flashdata('error', 'Invalid booking info');
            redirect('booking');
        }
        $this->load->model('User_model');
        $notificats  =  new Notification_model();
        $booking_model  =  new Booking_model();

        $bid = $_REQUEST['bid'] ?? '';
        $notification_message = "Your booking has been confrimed";

        $data['booking'] = $this->bm->getBookingInfoId($bid);
        $notification_message = "Your booking (" . $data['booking']->bAddService . ") is confirmed. please check your Email/WhatsApp for more details, Thank you!";

        $data['bookingInfo'] = [
            'status' => ACTIVE,
            'updatedBy' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        $data['notificationInfo'] = [
            'user_id' => $data['booking']->createdBy,
            'booking_id' => $data['booking']->bookingId,
            'message' => $notification_message,
            'read_status' => 0,
            'createdBy' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
            'createdDtm' => date('Y-m-d H:i:s')
        ];


        // Booking details for customer
        $data['info_for_customer']['bRefNo']      =  $data['booking']->bRefNo;
        $data['info_for_customer']['bDate']       =  $data['booking']->bDate;
        $data['info_for_customer']['bService']    =  $data['booking']->bAddService;
        $data['info_for_customer']['bAdult']      =  $data['booking']->bAdult;
        $data['info_for_customer']['bChild']      =  $data['booking']->bChild;
        $data['info_for_customer']['bPickupDate'] =  $data['booking']->bPickupDate;
        $data['info_for_customer']['bPickupTime'] =  $data['booking']->bPickupTime;
        $data['info_for_customer']['bPickLoc']    =  $data['booking']->bPickLoc;
        $data['info_for_customer']['bDropLoc']    =  $data['booking']->bDropLoc;

        $data['info_for_customer']['bVehicle']    =  $data['booking']->bVehicle;
        $data['info_for_customer']['totalPrice']  =  $data['booking']->totalPrice;


        // Booking details for Agent
        $data['info_for_agent']['bRefNo']      =  $data['booking']->bRefNo;
        $data['info_for_agent']['bDate']       =  $data['booking']->bDate;
        $data['info_for_agent']['bAdult']      =  $data['booking']->bAdult;
        $data['info_for_agent']['bChild']      =  $data['booking']->bChild;
        $data['info_for_agent']['bService']    =  $data['booking']->bAddService;
        $data['info_for_agent']['bPickupDate'] =  $data['booking']->bPickupDate;
        $data['info_for_agent']['bPickupTime'] =  $data['booking']->bPickupTime;
        $data['info_for_agent']['bPickLoc']    =  $data['booking']->bPickLoc;
        $data['info_for_agent']['bDropLoc']    =  $data['booking']->bDropLoc;
        $data['info_for_agent']['customer_name']   =  $data['booking']->bGuestName;
        $data['info_for_agent']['customer_mobile'] =  $data['booking']->bGuestContact;
        // $data['info_for_agent']['customer_email']  =  $data['userInfo']->cutomerEmail;

        $data['info_for_agent']['bVehicle']    =  $data['booking']->bVehicle;
        $data['info_for_agent']['totalPrice']  =  $data['booking']->totalPrice;


        // Booking details for bookingSupplier
        if ($_REQUEST['spId'] != '0') {

            echo $spId = $_REQUEST['spId'] ?? '';

            $data['userInfo'] = $this->User_model->getUserInfo($spId);

            $data['bookingSupplier'] = $this->bm->getBookingForSupplier($spId);

            $data['info_for_customer']['supplier_name']   =  $data['userInfo']->name;
            $data['info_for_customer']['supplier_mobile'] =  $data['userInfo']->mobile;
            $data['info_for_customer']['supplier_email']  =  $data['userInfo']->email;

            $data['info_for_agent']['supplier_name']   =  $data['userInfo']->name;
            $data['info_for_agent']['supplier_mobile'] =  $data['userInfo']->mobile;
            $data['info_for_agent']['supplier_email']  =  $data['userInfo']->email;

            foreach ($data['bookingSupplier'] as $key => $bsp) {
                $data['info_for_supplier'][$key]['bRefNo']      =  $bsp->bRefNo;
                $data['info_for_supplier'][$key]['bDate']       =  $bsp->bDate;
                $data['info_for_supplier'][$key]['bAdult']      =  $bsp->bAdult;
                $data['info_for_supplier'][$key]['bChild']      =  $bsp->bChild;
                $data['info_for_supplier'][$key]['bService']    =  $bsp->bAddService;
                $data['info_for_supplier'][$key]['bPickupDate'] =  $bsp->bPickupDate;
                $data['info_for_supplier'][$key]['bPickupTime'] =  $bsp->bPickupTime;
                $data['info_for_supplier'][$key]['bPickLoc']    =  $bsp->bPickLoc;
                $data['info_for_supplier'][$key]['bDropLoc']    =  $bsp->bDropLoc;
                $data['info_for_supplier'][$key]['user_name']   =  $bsp->bGuestName;
                $data['info_for_supplier'][$key]['user_mobile'] =  $bsp->bGuestContact;
                // $data['info_for_agent']['user_email']  =  $data['userInfo']->email;
                $data['info_for_supplier'][$key]['bVehicle']    =  $bsp->bVehicle;
                // $data['info_for_agent']['totalPrice']  =  $data['booking']->totalPrice;
            }
        }

        if ($this->sendNotifications($data) == true) {
            $isInserted =  $notificats->insert($data['notificationInfo']);
            $isUpdated =  $booking_model->update($data['bookingInfo'], $bid);

            $this->session->set_flashdata('success', 'This booking is comfirmed');

        }
        die;
    }

    function sendNotifications($data)
    {
        pre($data);
        return true;
    }
    /**
     * This function is used to add new user to the system
     */
    function addNewBooking()
    {

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        } else {
            $id = "";
        }
        if (isset($_REQUEST['type'])) {
            $type = $_REQUEST['type'];
        } else {
            $type = "";
        }

        if (!$this->hasCreateAccess() ||  ($id == "" || $type == "")) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('vCode', 'Vehicle Code', 'trim|callback_html_clean|required');
            $this->form_validation->set_rules('staff', 'Staff', 'trim|callback_html_clean|required');
            $this->form_validation->set_rules('agent', 'Agent', 'trim|callback_html_clean|required');
            $this->form_validation->set_rules('bTour', 'Tour', 'trim|callback_html_clean|required');
            $this->form_validation->set_rules('bType', 'Type', 'trim|callback_html_clean|required');

            $this->form_validation->set_rules('cName', 'Customer Name', 'trim|callback_html_clean|required');
            $this->form_validation->set_rules('cEmail', 'Customer Email', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('cPh', 'Customer Phone', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('puTime', 'Pickup Time', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('puDate', 'Pickup Date', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('puLoc', 'Pickup Location', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('drpLoc', 'Drop Location', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('noOfPerson', 'No Of Person', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('description', 'description', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('totalPriceInput', 'Total Price', 'trim|callback_html_clean|required|max_length[1024]');
            $this->form_validation->set_rules('pay_method', 'Payment Method Price', 'trim|callback_html_clean|required');
            // $this->form_validation->set_rules('pay_status','payment Status','trim|callback_html_clean|required');
            // $this->form_validation->set_rules('supplierName','Supplier Name','trim|callback_html_clean|required|max_length[1024]');
            // $this->form_validation->set_rules('supplierId','Supplier Id','trim|callback_html_clean|required|max_length[1024]');


            if ($this->form_validation->run() == FALSE) {
                $this->bookingNew();
            } else {
                $data = array();

                $extra = array(
                    'cutomerEmail' => ($this->input->post('cEmail')),
                    'slotNo' => ($this->input->post('slot_no')),
                    'payMethod' => ($this->input->post('pay_method')),
                );
                

                $role_txt = 'GUEST';
                if(!empty($_SESSION['roleText'])){
                $role_txt = $_SESSION['roleText'];
                }
                $prefix = strtoupper(substr($role_txt,0,3)) ?? "GUEST";
                $uniqueRefNo =  'OB-'.$prefix.'-' . uniqid();

                // $bookingDate = $this->security->xss_clean($this->input->post('tourDate'));
                $babySeat = $this->security->xss_clean($this->input->post('babySeat'));
                if ($babySeat == "") {
                    $babySeat = "0";
                }

                $bookingDate = date("d-M-Y");

                $data['bRefNo'] =  $uniqueRefNo;
                $data['serviceId'] =  $id;
                $data['bStaff'] =  $this->security->xss_clean($this->input->post('staff'));
                $data['bAgent'] = $this->security->xss_clean($this->input->post('agent'));
                $data['bDate'] = $bookingDate;
                $data['bGuestName'] = $this->security->xss_clean($this->input->post('cName'));
                $data['bGuestContact'] = $this->security->xss_clean($this->input->post('cPh'));
                $data['bTour'] = ucfirst($this->security->xss_clean($this->input->post('bTour')));
                $data['bType'] = $this->security->xss_clean($this->input->post('bType'));
                $data['bThemeParksTicket'] = "";
                $data['bAddService'] = $this->security->xss_clean($this->input->post('description'));
                $data['bAdult'] = $this->security->xss_clean($this->input->post('noOfPerson'));
                $data['bChild'] = $babySeat;
                $data['bPickupDate'] = $this->security->xss_clean($this->input->post('puDate'));
                $data['bPickupTime'] = $this->security->xss_clean($this->input->post('puTime'));
                $data['bPickLoc'] = $this->security->xss_clean($this->input->post('puLoc'));
                $data['bDropLoc'] = $this->security->xss_clean($this->input->post('drpLoc'));

                $data['bSupplier'] = ($this->input->post('supplierName')) ?? '';
                $data['bSupplierId'] = 0;
                $data['bVehicle'] = ($this->input->post('vCode'));
                $data['totalPrice'] = ($this->input->post('totalPriceInput'));
                $data['bCost'] = ($this->input->post('totalPriceInput'));
                $data['bSale'] = ($this->input->post('totalPriceInput'));
                $data['status'] = ($this->input->post('pay_status')) ?? INACTIVE;
                $data['extraInfo'] = json_encode($extra);
                $data['createdBy'] = (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0;
                $data['createdDtm'] = date('Y-m-d H:i:s');

                $insertIdBooking = $this->bm->addNewBooking($data);

                if ($insertIdBooking > 0) {

                    $this->load->model('Notification_model');
                    $notificats  =  new Notification_model();
                    $data['notificationInfo'] = [
                        'user_id' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
                        'booking_id' => $insertIdBooking,
                        'message' => "You have new booiking ".$this->security->xss_clean($this->input->post('description')) ?? '',
                        'read_status' => 0,
                        'createdBy' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
                        'createdDtm' => date('Y-m-d H:i:s')
                    ];
                    $data['notificationInfoADMIN'] = [
                        'user_id' => SYSTEM_ADMIN,
                        'booking_id' => $insertIdBooking,
                        'message' => "You have new booiking ".$this->security->xss_clean($this->input->post('description')) ?? '',
                        'read_status' => 0,
                        'createdBy' => SYSTEM_ADMIN,
                        'createdDtm' => date('Y-m-d H:i:s')
                      ];
        
                      $isInsertedAdmin =  $notificats->insert($data['notificationInfoADMIN']);
                      $isInsertedUser =  $notificats->insert($data['notificationInfo']);

                    $this->session->set_flashdata('success', 'New Booking created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Booking creation failed');
                }
                


                redirect('booking');
            }
        }
    }


    /**
     * This function is used load booking edit information
     * @param number $bookingId : Optional : This is booking id
     */
    function edit()
    {
        $bookingId = $_REQUEST['bid'] ?? null;
        if (!$this->hasUpdateAccess() ||  $bookingId == null) {
            $this->loadThis();
        } else {

            $data['bookingInfo'] = $this->bm->getBookingInfoId($bookingId);

            $serId = $data['bookingInfo']->serviceId;

            $data['records'] = $this->bm->getServiceSingle($serId);
            $data['params'] = '&id=' . $bookingId;

            $this->global['pageTitle'] = WEB_NAME . ' Edit Booking';

            $this->loadViews("booking/edit", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function update()
    {
        $bookingId = $_REQUEST['id'] ?? $this->input->post('bid');
        if (!$this->hasUpdateAccess() || empty($_REQUEST['id'])) {
            $this->loadThis();
        } else {
            $data = array();

          
            $extra = array(
                'cutomerEmail' => ($this->input->post('cEmail') ?? ''),
                'slotNo' => ($this->input->post('slot_no') ?? ''),
                'payMethod' => ($this->input->post('pay_method') ?? ''),
            );

            $uniqueRefNo = strtoupper(WEB_NAME) . '-ADMIN-' . uniqid(rand(0, 10000));
            // $bookingDate = $this->security->xss_clean($this->input->post('tourDate'));
            $babySeat = $this->security->xss_clean($this->input->post('babySeat') ?? '');
            if ($babySeat == "") {
                $babySeat = "0";
            }

            $bookingDate = date("d-M-Y");

            $data['bRefNo'] =  $uniqueRefNo;
            $data['serviceId'] =  $this->security->xss_clean($this->input->post('sid') ?? '');
            $data['bStaff'] =  $this->security->xss_clean($this->input->post('staff') ?? '');
            $data['bAgent'] = $this->security->xss_clean($this->input->post('agent') ?? '');
            $data['bDate'] = $bookingDate ?? '';
            $data['bGuestName'] = $this->security->xss_clean($this->input->post('cName') ?? '');
            $data['bGuestContact'] = $this->security->xss_clean($this->input->post('cPh') ?? '');
            $data['bTour'] = ucfirst($this->security->xss_clean($this->input->post('bTour') ?? ''));
            $data['bType'] = $this->security->xss_clean($this->input->post('bType') ?? '');
            $data['bThemeParksTicket'] = "";
            $data['bAddService'] = $this->security->xss_clean($this->input->post('description') ?? '');
            $data['bAdult'] = $this->security->xss_clean($this->input->post('noOfPerson') ?? '');
            $data['bChild'] = $babySeat;
            $data['bPickupDate'] = $this->security->xss_clean($this->input->post('puDate') ?? '');
            $data['bPickupTime'] = $this->security->xss_clean($this->input->post('puTime') ?? '');
            $data['bPickLoc'] = $this->security->xss_clean($this->input->post('puLoc') ?? '');
            $data['bDropLoc'] = $this->security->xss_clean($this->input->post('drpLoc') ?? '');

            $data['bSupplier'] = $this->security->xss_clean($this->input->post('supplierName') ?? '');
            $data['bSupplierId'] = $this->security->xss_clean($this->input->post('supplierId') ?? '');
            $data['bVehicle'] = $this->security->xss_clean($this->input->post('vCode') ?? '');
            $data['totalPrice'] = $this->security->xss_clean($this->input->post('totalPriceInput') ?? '');
            $data['bCost'] = $this->security->xss_clean($this->input->post('totalPriceInput') ?? '');
            $data['bSale'] = $this->security->xss_clean($this->input->post('totalPriceInput') ?? '');
            $data['status'] = $this->security->xss_clean($this->input->post('pay_status')) ?? INACTIVE;
            $data['extraInfo'] = json_encode($extra) ?? '';
            $data['updatedBy'] = (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0;
            $data['updatedDtm'] = date('Y-m-d H:i:s') ?? '';


            $res = $this->bm->editBooking($data, $bookingId);

            if ($res > 0) {
                $this->session->set_flashdata('success', 'Booking updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Booking upadation failed');
            }

            redirect('booking');
        }
    }

    public function addSupplier()
    {
        if(check_permission('Suppliers','create_records') == false) {
            $result = $this->load->view('general/access', [], TRUE);
            echo json_encode($result);
        }else{
            $data['roles'] = $this->rm->getAllRoles();
        $data['bookingId'] = $_REQUEST['id'] ?? 0;
        $data['supplierId'] = $_REQUEST['sid'] ?? 0;
        $data['params'] = 'booking';

        $result = "";
        if ($data['supplierId'] != 0) {
            $this->load->model('User_model');
            $data['userInfo'] = $this->User_model->getUserInfo($data['supplierId']);
            $result = $this->load->view('suppliers/form_data_edit', $data, true);
        } else {
            $result = $this->load->view('suppliers/form_data', $data, TRUE);
        }
        echo json_encode($result);
        }
    }

    public function addExSupplier()
    {
        if(check_permission('Suppliers','create_records') == false) {
            echo json_encode(array('status' => FALSE));
        }else{
            $data['bSupplierId'] = $_REQUEST['sid'];
            $data['bVehicle'] = $_REQUEST['vehicle'];
            $booking_id = $_REQUEST['id'];
            
            // pre($data);

            $this->load->model('Booking_model');
            $result = $this->Booking_model->editBooking($data, $booking_id);

            if ($result != 0) {
                echo json_encode(array('status' => TRUE));
            } else {
                echo json_encode(array('status' => FALSE));
            }
        }
    }

    public function updateBookingCost()
    {
            $data['bCost'] = $_REQUEST['cost'] ?? '';
            $booking_id = $_REQUEST['id'] ?? '';
            if($data['bCost'] == '' || $booking_id == '' ) 
            {
                echo json_encode(array('status' => FALSE)); exit;
            }  

            $this->load->model('Booking_model');
            $result = $this->Booking_model->editBooking($data, $booking_id);
            if ($result != 0) {
                echo json_encode(array('status' => TRUE));
            } else {
                echo json_encode(array('status' => FALSE));
            }
        
    }

    public function updateTransaction()
    {

        $data = array();
        $data  = (array) json_decode($_REQUEST['data']);
        $data['createdBy'] = $this->vendorId;
        $data['createdDtm'] = date('Y-m-d H:i:s');
        $data['isDeleted'] = "0";
        $result = $this->bm->addPayment($data);
        if (!empty($result)) {

            $data['bookingInfo'] = [
                'status' => ACTIVE,
                'updatedBy' => $this->vendorId,
                'updatedDtm' => date('Y-m-d H:i:s')
            ];
            $result = $this->bm->editBooking($data['bookingInfo'], $data['bookingId']);

            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}
