<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Booking_model (Booking Model)
 * Booking model class to get to handle booking related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Booking_model extends CI_Model
{
    /**
     * This function is used to get the booking listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bookingListingCount($data)
    {
        $this->db->select('*');
        $this->db->from('tbl_booking');
        $this->db->where('isDeleted', 0);
        if (!empty($data['spId'])) {
            $this->db->where('createdBy', $data['spId']);
        }
        if (!empty($data['dateFrom'])) {
            $this->db->where('bDate >=', $data['dateFrom']);
        }
        if (!empty($data['dateTo'])) {
            $this->db->where('bDate <=', $data['dateTo']);
        }
        if (!empty($data['searchText'])) {
             // Define the columns to search
            $search_columns = array('bRefNo', 'bStaff', 'bAgent', 'bGuestName','bGuestContact',
             'bTour','bType', 'bThemeParksTicket', 'bAddService','bPickLoc','bDropLoc','bSupplier',
             'bVehicle','totalPrice','extraInfo');

            $this->db->group_start();
            foreach ($search_columns as $column) {
                $this->db->or_like($column, $data['searchText']);
            }
            $this->db->group_end();
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function getServiceSingle($serviceId , $serType = "")
    {
       $this->db->select('s.serviceId, s.serviceTitle, s.serviceDescription, s.serviceImages, s.serviceBanner, 
       s.serviceType, s.extraInfo, sc.subcatName, sc.extraInfo AS scExtraInfo');
    //    , us.userId, us.name
        $this->db->from('tbl_services AS s');
        $this->db->join('tbl_subcategories AS sc', 'sc.subcatId = s.subcategoryId');
        // $this->db->join('tbl_users AS us', 'us.userId = s.supplierId');
        $this->db->where('s.serviceId', $serviceId);
        $this->db->where('s.isDeleted', 0);
        $this->db->where('s.status', ACTIVE);
        // $this->db->limit($page, $segment);
        return $this->db->get()->row();
            
    }
    
     function getBookingsBySupplierId($supplierId)
    {
        $this->db->select('bk.*');
        $this->db->from('tbl_booking bk');
        // $this->db->join('tbl_users AS us', 'us.userId = bk.bSupplierId');
        $this->db->where('bk.bsupplierId', $supplierId);
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getInterval($interval = '90', $col = '*', $conditions = array()){
        $this->db->select($col);
        $this->db->from('tbl_booking As bk');
        $this->db->where('createdDtm BETWEEN DATE_SUB(NOW(), INTERVAL '.$interval.' DAY) AND NOW()');
        if(!empty($conditions)){
         $this->db->where($conditions);
        }
        $this->db->where('bk.isDeleted', 0);
         
       $result = $this->db->get()->result();
       return $this->get_service_prices($result);
    }

    function get_service_prices($data){

        if(!empty($data)){
           foreach($data as $key => $d1){
            $this->db->select('extraInfo');
            $this->db->from('tbl_services As sr');
            $this->db->where('serviceId',$d1->serviceId);   
            $query =  $this->db->get()->row();
            if(!empty($query)){
                $query1 =  json_decode($query->extraInfo);
                $total_price = ( ( ( int ) $query1->prices->priceChild) + ( ( int ) $query1->prices->priceAdult ) );
                $data[$key]->serPrice = $total_price;
            }else{
                $data[$key]->serPrice = 0; 
            }
           }
            
         }

         return $data;
    }

     function getWhere($where = array(), $col = "*")
    { 
        $this->db->select($col);
        $this->db->from('tbl_booking As bk');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the booking listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bookingListing($data, $page, $segment)
    {

        $this->db->select('*');
        $this->db->from('tbl_booking');
        $this->db->where('isDeleted', 0);
        if (!empty($data['spId'])) {
            $this->db->where('createdBy', $data['spId']);
        }
        if (!empty($data['dateFrom'])) {
            $this->db->where('bDate >=', $data['dateFrom']);
        }
        if (!empty($data['dateTo'])) {
            $this->db->where('bDate <=', $data['dateTo']);
        }
        if (!empty($data['searchText'])) {
             // Define the columns to search
            $search_columns = array('bRefNo', 'bStaff', 'bAgent', 'bGuestName','bGuestContact',
             'bTour','bType', 'bThemeParksTicket', 'bAddService','bPickLoc','bDropLoc','bSupplier',
             'bVehicle','totalPrice','extraInfo');

            $this->db->group_start();
            foreach ($search_columns as $column) {
                $this->db->or_like($column, $data['searchText']);
            }
            $this->db->group_end();
        }
        $this->db->order_by('bookingId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new booking to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBooking($bookingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_booking', $bookingInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function update($data , $id){
        $this->db->where('bookingId', $id);
       $res =  $this->db->update('tbl_booking', $data);
       return $this->db->affected_rows();
    }

    function addPayment($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_transactions', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get booking information by id
     * @param number $bookingId : This is booking id
     * @return array $result : This is booking information
     */
    function getBookingInfo($bookingId)
    {
        $this->db->select('bk.*, us.name, us.email,us.mobile,us.isDeleted as spStatus');
        $this->db->from('tbl_booking AS bk');
        $this->db->join('tbl_users AS us','us.userId = bk.bSupplierId');
        $this->db->where('bk.bookingId', $bookingId);
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    function getBookingOnly($bookingId)
    {
        $this->db->select('bk.*');
        $this->db->from('tbl_booking AS bk');
        $this->db->where('bk.bookingId', $bookingId);
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getBookingInfoId($bookingId)
    {
        $this->db->select('bk.*');
        $this->db->from('tbl_booking AS bk');
        $this->db->where('bk.bookingId', $bookingId);
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getBookingForSupplier($supplierId)
    {
        $this->db->select('bk.*');
        $this->db->from('tbl_booking AS bk');
        $this->db->where('bk.bSupplierId', $supplierId);
        $this->db->where('bk.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the booking information
     * @param array $bookingInfo : This is booking updated information
     * @param number $bookingId : This is booking id
     */
    function editBooking($bookingInfo, $bookingId)
    {
        $this->db->where('bookingId', $bookingId);
        $this->db->update('tbl_booking', $bookingInfo);
         return true;
    }
}