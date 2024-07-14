<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ( APPPATH . '../vendor/autoload.php' ); // if you use Composer
// require_once(APPPATH . '../vendor/ultramsg/whatsapp-php-sdk/ultramsg.class.php'); // if you download ultramsg.class.php
class Whatsapp_api{

    protected $CI;
    protected $client;
    protected $token;
    protected $instance_id;
    protected $whatsapp_model;

    public function __construct()
    {
        // Get the CodeIgniter instance
        $this->CI =& get_instance();
        $this->CI->load->model('Whatsapp_model');    
    }

    public function intialize(){

        $this->whatsapp_model = new WhatsApp_model();

        $row = (object) $this->whatsapp_model->getRow();
        
         if(empty( (array) $row)){
            return false;
         }

        $this->token       = $row->wa_token ?? ''; // Ultramsg.com token
        $this->instance_id = $row->wa_Instance ?? '' ; // Ultramsg.com instance id
        $this->client = new UltraMsg\WhatsAppApi($this->token, $this->instance_id);

        return true;
    }


    public function send_message($to, String $message){
         
        
        if($this->intialize()){
            // echo 'no issue'; die;
            $api_result = $this->client->sendChatMessage($to,$message);
      
            return $api_result;
        }else{
            return false;
        }
    }

    public function send_document($to, $filename, $document){

        if($this->intialize()){ 
            $api = $this->client
                   ->sendDocumentMessage($to,$filename,$document);

            return $api;
        }else{
            return false;
        }
    }



    
}