<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Whatsapp Controller (WhatsappController)
 * Whatsapp Controller Class to control all Whatsapp related operations.
 * @author : M.Ali
 * @version : 1.1
 * @since : 01 July 2024
 */
class WhatsappController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('Whatsapp_api');
        $this->isLoggedIn();
        $this->module = 'Whatsapp_api';
    }

    public  function index(){


        $whatsappApi = new Whatsapp_api();
       $result =  $whatsappApi->send_message('+923485045998','Hello testing message');
    //    $result =  $whatsappApi->send_document('+923485045998','','Hello testing message');
       print_r( $result);
    }


}