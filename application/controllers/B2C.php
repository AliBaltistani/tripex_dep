<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerFrontend.php';

/**
 * Class : B2C (B2CController)
 * B2C Class to control B2C related operations.
 * @author : M. Ali
 * @version : 1.5
 * @since : 19 feb 2024
 */
class B2C extends BaseControllerFrontend
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    { 
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Service_model', 'sm');
        $this->load->model('tax_model');
        $this->load->model('B2C_model', 'b2c');
        $this->load->library('form_validation');
        $this->module = 'B2C';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
      $data['records'] = $this->b2c->getCategory();
      $data['popular_tours'] = $this->b2c->get_popular_services();
     
      $topSellProds = (object) $this->b2c->get_where(['isTopsellingprod' => 1]);
      if(!empty($topSellProds)){
        foreach($topSellProds as $tsp){
          array_push($data['popular_tours'], $tsp);
        }
        
      }
      foreach($data['records'] as $single){
        
        $cName = str_replace(' ','',($single->categoryName ?? ''));
        if("TopSellingTours" == $cName){
           $arr = $this->b2c->get_where(['categoryId' => $single->categoryId ?? '']);
           if($arr){
            foreach($arr as $ar){
              array_push($data['popular_tours'],$ar);
            }
           }
        }
      }
      $data['popular_tours'] =  array_reverse($data['popular_tours']);
       
      $this->global['pageTitle'] = WEB_NAME;
      $this->loadViews("b2c/index", $this->global, $data, NULL);
    }
     public function home()
    {
      $data['records'] = $this->b2c->getCategory();
     
      $data['popular_tours'] = $this->b2c->get_popular_services();
      
      foreach($data['records'] as $single){
        $cName = str_replace(' ','',($single->categoryName ?? ''));
        if("TopSellingTours" == $cName){
           $arr = $this->b2c->get_where(['categoryId' => $single->categoryId ?? '']);
           if($arr){
            foreach($arr as $ar){
              array_push($data['popular_tours'],$ar);
            }
           }
        }
      }
      $data['popular_tours'] =  array_reverse($data['popular_tours']);
    //   pre($data['popular_tours'][0]->extraInfo);
    //   die;
      
      $this->global['pageTitle'] = 'Home';
      $this->loadViews("b2c/index", $this->global, $data, NULL);
    }
     public function blogs()
    {
      
      $this->global['pageTitle'] = 'Blogs';
      		$this->loadViews('b2c/blogs',$this->global, null , null);
    }
     public function contact()
    {
     
      
    //   pre($data['popular_tours'][0]->extraInfo);
    //   die;
      
      $this->global['pageTitle'] = 'Contact us';
      		$this->loadViews('b2c/contact', $this->global, null, NULL);
    }
    public function gallary()
    {
     
      
    //   pre($data['popular_tours'][0]->extraInfo);
    //   die;
      
      $this->global['pageTitle'] = 'Gallery';
      		$this->loadViews('b2c/gallary', $this->global, null, NULL);
    }
     public function blog_detail()
    {
     
      
    //   pre($data['popular_tours'][0]->extraInfo);
    //   die;
      
      $this->global['pageTitle'] = "Blog";
      		$this->loadViews('b2c/blog-detail', $this->global, null, NULL);
    }
     public function about()
    {
     
      
    //   pre($data['popular_tours'][0]->extraInfo);
    //   die;
      
      $this->global['pageTitle'] = "About us";
      		$this->loadViews('b2c/about-us', $this->global, null, NULL);
    }
    public function attraction($pageination = null)
    {
      $id = $_REQUEST['id'] ?? '';
      if($id == ''){ redirect('pagenotfound');}
      else{
        $b2c = new B2C_model();
        $data['records'] = $b2c->getInfo($id);
        
        $this->global['pageTitle'] = WEB_NAME." : Attraction";
        
         $data['mcId'] = $id;
        $data['serviceTypeText'] = 'Attraction';
        
        $this->loadViews("b2c/attraction", $this->global, $data, NULL);
      }
      
    }
    public function transportation($paginate=NULL)
    {
      $id = $_REQUEST['id'] ?? '';
      if($id == ''){ redirect('pagenotfound');}
      else{
        $b2c = new B2C_model();
        $data['records'] = $b2c->getInfo($id);
        $data['mcId'] = $id;
        $data['serviceTypeText'] = 'Transportations';
        $this->global['pageTitle'] = WEB_NAME." : Transportation";
        
         $data['mcId'] = $id;
        $data['serviceTypeText'] = 'Transportation';
        
        $this->loadViews("b2c/transportations", $this->global, $data, NULL);
      }
      
    }
    public function transport_types()
    {
     
      $mainCatId = "";
      $subCatId = "";
      if(isset($_REQUEST['m'])){$mainCatId = $_REQUEST['m'];}
      if(isset($_REQUEST['sc'])){$subCatId = $_REQUEST['sc'];}

      if(empty($mainCatId) || empty($subCatId)){ redirect('pagenotfound');}
      else{
        
        $data['records'] = $this->b2c->getServiceType($mainCatId,$subCatId);
        // pre(json_decode($data['records']));
        // die;
        $data['mcId'] = $mainCatId;
        $data['scId'] = $subCatId;
        $data['serviceTypeText'] = 'Transportations';
        $this->global['pageTitle'] = WEB_NAME." : Transportations Type";
        
        $this->loadViews("b2c/detail_list", $this->global, $data, NULL);
      }
      
    }
    public function fliter_services()
    { 
      $data = array();
        $searchText =  $this->security->xss_clean($this->input->post('query'));
        $stId =  $this->security->xss_clean($this->input->post('mcid'));
      {
          $data['searchText'] = $searchText;
          
          $this->load->library('pagination');
          
          $count = $this->b2c->fliterServicesCount($searchText);

          $returns = $this->paginationCompress("b2c/fliter-services/", $count, 10 );
          // $data['returns'] = $returns;
          $data['serviceRecords'] = $this->b2c->fliterServicesListing($searchText, $returns["page"], $returns["segment"],$stId);

          if (!empty($data['serviceRecords'])) {
            echo(json_encode($data['serviceRecords']));
           }
          else {
             $data['status']= FALSE;
             echo(json_encode($data['status'])); 
            }

      }
    }
    public function booking_process($srid = '')
    {
      $id =  $_REQUEST['id'] ?? $srid;
      if($id == ''){ redirect('pagenotfound');}
      else{ 
          
          $user_role_id  =  (!empty($_SESSION['role'])) ? $_SESSION['role'] : 25;
          $data['tax'] = $this->tax_model->getRow(['role_id' =>$user_role_id]);

         $this->b2c->increment_popularity($id);
         $data['records'] = $this->b2c->getServiceSingle($id);
         $this->global['pageTitle'] = WEB_NAME." : Booking Process";
        
         $this->loadViews("b2c/booking-process", $this->global, $data, NULL);
      }
    }

     public function booking_checkout()
    {
    
      
      $id = $_REQUEST['serviceId'] ?? '';
      if($id==""){ redirect('pagenotfound');}
      else{

          $this->load->library('form_validation');

          $this->form_validation->set_rules('slot_no','','trim|callback_html_clean|required');
          $this->form_validation->set_rules('tourType','Tour Type','trim|callback_html_clean|required');
          $this->form_validation->set_rules('vehicle_code','Vehicle Code','trim|callback_html_clean|required');
          $this->form_validation->set_rules('pickupTime','Pickup Time','trim|callback_html_clean|required');
          $this->form_validation->set_rules('pickupLoc','Pickup Location','trim|callback_html_clean|required');
          $this->form_validation->set_rules('dropOffLoc','Drop Off Location','trim|callback_html_clean|required');
          
          $this->form_validation->set_rules('customer_name','Guest Name','trim|callback_html_clean|required');
          $this->form_validation->set_rules('customer_email','Guest Email','trim|callback_html_clean|required');
          $this->form_validation->set_rules('customer_number','Guest Number','trim|callback_html_clean|required');
          $this->form_validation->set_rules('tourDate','Date','trim|callback_html_clean|required');
          $this->form_validation->set_rules('quantity_adult','quantity Adult','trim|callback_html_clean|required');
          $this->form_validation->set_rules('quantity_child','quantity Child','trim|callback_html_clean|required');
          $this->form_validation->set_rules('price_total','Price Total','trim|callback_html_clean|required');
          $this->form_validation->set_rules('price_child','Price Child','trim|callback_html_clean|required');
          $this->form_validation->set_rules('price_adult','Price Adult','trim|callback_html_clean|required');
          
          if($this->form_validation->run() == FALSE)
          { 
            $this->session->set_flashdata('error', "Please fill all required Feilds, thanks!"); 
            $this->booking_process($id);
          }
          else
          {
            $serviceTitle = "";
             $tourType = "";
             $totalPrice = "0.00";
            
            $quantity_adult = ($this->input->post('quantity_adult'));
            $quantity_child =  ($this->input->post('quantity_child'));
            $price_total =  (double)($this->input->post('price_total'));

           if(($quantity_adult < "1")  || $price_total < "1" ){  
              $this->session->set_flashdata('error', "Invalid information! please try again latter..");
              redirect('b2c/transportation-package/process-booking/'.$id);
             }

            //  if(isset($_REQUEST['baby_seat'])){
            //   $quantity_child = 1;
            //  }

             
            //  $supplier_name = "";
            $data = array();
            
            $result['records'] = $this->b2c->getServiceSingle($id,FALSE);
            // pre($result['records']);
            // die;
            if(!empty($result['records'])){
              $serviceTitle = $result['records']->serviceTitle;
              // $supplier_name = $result['records']->name;
              // $supplier_id = $result['records']->userId;
              $extras = json_decode($result['records']->extraInfo);
             $pchild = (double) $extras->prices->priceChild;
             $pAdult =  (double) $extras->prices->priceAdult;
            //  $totalPrice = ($pAdult *  $quantity_adult) + ($pchild *  $quantity_child);
             $tourType =   preg_replace('/[^A-Za-z0-9\_]/', ' ', $extras->others->type);
             
            }else{
              $this->session->set_flashdata('error', "Invalid Data");
              redirect('b2c/transportation-package/process-booking/'.$id);
              
            }
            $this->global['pageTitle'] = "Booking Confirm";
            

            $role_txt = 'GUEST';
             if(!empty($_SESSION['roleText'])){
              $role_txt = $_SESSION['roleText'];
             }
            $prefix = strtoupper(substr($role_txt,0,3)) ?? "GUE";
            $uniqueRefNo =  'OB-'.$prefix.'-' . uniqid();

            $bookingDate = ($this->input->post('tourDate'));
            $bookingDate = date("d-M-Y", strtotime($bookingDate));

            // required data form booking
            
            $extra = array(
              'cutomerEmail' => ($this->input->post('customer_email'))?? '' ,
              'slotNo' => $this->input->post('slot_no')?? '',
              'payMethod' => 'Online Payment',
              'flight_no' => $this->input->post('flight_no') ?? '',
              'ad_time' => $this->input->post('ad_time') ?? '',
              'baby_seats' =>json_encode($_POST['babySeat_qty'] ?? []),
              'driver_notes' =>$_POST['sp_note'] ?? '',
            );


            $data['serviceId'] =  $id;
            $data['bRefNo'] =  $uniqueRefNo;
            $data['bStaff'] =  "COMPANY";
            $data['bAgent'] = "Online Booking";
            $data['bDate'] = $bookingDate;
            $data['bGuestName'] = $this->security->xss_clean($this->input->post('customer_name'));
            $data['bGuestContact'] = $this->security->xss_clean($this->input->post('customer_number'));
            $data['bTour'] = "Dubai ". ucfirst($tourType);
            $data['bType'] = "PVT";
            $data['bThemeParksTicket'] = "";
            $data['bAddService'] = $serviceTitle;
            $data['bAdult'] = $this->security->xss_clean($this->input->post('quantity_adult'));
            $data['bChild'] = $quantity_child;
            $data['bPickupDate'] = $bookingDate;
            $data['bPickupTime'] = $this->security->xss_clean($this->input->post('pickupTime'));
            $data['bPickLoc'] = $this->security->xss_clean($this->input->post('pickupLoc'));
            $data['bDropLoc'] = $this->security->xss_clean($this->input->post('dropOffLoc'));

            $data['bSupplier'] = '';
            $data['bSupplierId'] = '0';
            $data['bVehicle'] = $this->security->xss_clean($this->input->post('vehicle_code'));
            $data['totalPrice'] = $price_total;
            $data['bCost'] = $price_total;
            $data['bSale'] = $price_total;
            $data['status'] = INACTIVE;
            $data['extraInfo'] = json_encode($extra);
            $data['createdBy'] = (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0;
            $data['createdDtm'] = date('Y-m-d H:i:s');
            // end required data form booking

            $insertIdBooking = $this->b2c->saveBookingDetails($data);
            if($insertIdBooking){

              $this->load->model('Notification_model');
              $notificats  =  new Notification_model();
              $data['notificationInfo'] = [
                'user_id' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
                'booking_id' => $insertIdBooking,
                'message' => "You have new booiking ".$serviceTitle,
                'read_status' => 0,
                'createdBy' => (!empty($_SESSION['userId']))?$_SESSION['userId'] : 0,
                'createdDtm' => date('Y-m-d H:i:s')
              ];

              $data['notificationInfoADMIN'] = [
                'user_id' => SYSTEM_ADMIN,
                'booking_id' => $insertIdBooking,
                'message' => "You have new booiking ".$serviceTitle,
                'read_status' => 0,
                'createdBy' => SYSTEM_ADMIN,
                'createdDtm' => date('Y-m-d H:i:s')
              ];

              $isInsertedAdmin =  $notificats->insert($data['notificationInfoADMIN']);
              $isInsertedUser =  $notificats->insert($data['notificationInfo']);

              $this->session->set_flashdata('success', "<b>Congratulation!</b> Booking details successfully submitted, You will get notify via WhatsApp, once your booking is confrimed by admin. Complete your purchase by providing your payment details. Thank you!");
              redirect('b2c/booking/process-checkout?bid='.$insertIdBooking);
            // $this->process_checkout($bid = $insertIdBooking);
            }else{
              $this->session->set_flashdata('error', "Booking failed!! please try agian later.");
              redirect('b2c/transportation-package/process-booking?id='.$id);
            }
            
          }
      }
    }


    function process_checkout($bid = null){

      $bid =  $_REQUEST['bid'] ?? '';
      if($bid == ''){ redirect('pagenotfound');}
      else{
         $data['records'] = (object) [];
         $data['bookings'] = $this->b2c->getBookingSingle($bid);
         if(!empty($data['bookings']->sRow)){
          $data['records'] = $data['bookings']->sRow;
          unset($data['bookings']->sRow);
         }

         if($_SERVER['REQUEST_METHOD'] == "POST"){
           pre($_REQUEST);
           die;
         }
         
         $this->global['pageTitle'] = WEB_NAME." : Booking Payment";
        
         $this->loadViews("b2c/booking-payment", $this->global, $data, NULL);
      }
      
    }
   

  // Custom callback function to validate post input
  public function html_clean($s, $v)
  {
      return strip_tags((string) $s);
  }


}