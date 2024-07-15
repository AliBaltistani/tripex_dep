<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Service_model (Service Model)
 * Service model class to get to handle Service related data 
 * @author : M.Ali
 * @version : 1.0
 * @since : 22 Feb 2024
 */
class B2C_model extends CI_Model
{
   
    public function increment_popularity($service_id) {
        $this->db->set('popularity', 'popularity+1', FALSE);
        $this->db->where('serviceId', $service_id);
        $this->db->update('tbl_services');
        return $this->db->affected_rows();
    }
    
     public function get_popular_services() {
        $this->db->select('*');
        $this->db->from('tbl_services');
         $this->db->where('isDeleted', 0);
        $this->db->where('status', ACTIVE);
        $this->db->order_by('popularity', 'asc');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_where($where) {
        $this->db->select('*');
        $this->db->from('tbl_services');
         $this->db->where('isDeleted', 0);
        $this->db->where('status', ACTIVE);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function fliterServicesCount($searchText)
    {
        $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.subcatDescription, BaseTbl.createdDtm');
        $this->db->from('tbl_subcategories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subcatName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.isPublished', ACTIVE);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function fliterServicesListing($searchText, $page, $segment,$srTypeId)
    {
        $this->db->select('*');
        $this->db->from('tbl_subcategories');
        $this->db->where('maincatId', $srTypeId);
        $this->db->where('isPublished', ACTIVE);
        $this->db->where('isDeleted', 0);
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->like('subcatName', $searchText);
            $this->db->or_like('subcatDescription', $searchText);
            $this->db->group_end();
         }
        $this->db->order_by('subcatId', 'DESC');
        // $this->db->limit($page, $segment);
        $query = $this->db->get();
        return $query->result();
        
        // $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.subcatDescription, BaseTbl.subcatImage, BaseTbl.extraInfo, BaseTbl.maincatId, BaseTbl.isPublished');
        // $this->db->from('tbl_subcategories as BaseTbl');
        // if(!empty($searchText)) {
        //     $likeCriteria = "(BaseTbl.subcatName LIKE '%".$this->db->escape_like_str($searchText)."%') AND BaseTbl.maincatId = ".$srTypeId;
        //     $likeCriteria2 = "(BaseTbl.subcatDescription LIKE '%".$this->db->escape_like_str($searchText)."%') AND BaseTbl.maincatId = ".$srTypeId;
        //     $this->db->where($likeCriteria);
        //     $this->db->or_where($likeCriteria2);
        // }
        // $this->db->where('BaseTbl.maincatId', $srTypeId);
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.isPublished', ACTIVE);
        // $this->db->order_by('BaseTbl.subcatId', 'DESC');
        // // $this->db->limit($page, $segment);
        // $query = $this->db->get();
        
        // $result = $query->result();        
        // return $result;
       
      
    }

    function getServiceType($mainCatId,$subCatId)
    {
       
      $this->db->select('s.serviceId, s.serviceTitle, s.serviceDescription, s.serviceImages, s.serviceBanner, s.serviceType, s.extraInfo');
        $this->db->from('tbl_services as s');
        $this->db->where('s.categoryId', $mainCatId);
        $this->db->where('s.subcategoryId', $subCatId);
        $this->db->where('s.isDeleted', 0);
        $this->db->where('s.status', ACTIVE);
        $this->db->order_by('s.serviceId', 'DESC');
        // $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getBookingSingle($bookingId , $join = TRUE)
    {
        $this->db->select('b.*');
        $this->db->from('tbl_booking AS b');
        $this->db->where('b.bookingId', $bookingId);
        $result =  $this->db->get()->row();

        if($join == TRUE){
            $result = $this->getServiceRow($result);
        }

        return $result;
        
    }

    function getServiceRow($data)
    {
        if(!empty($data)) {
            $this->db->select("s.*");
            $this->db->from('tbl_services AS s');
            $this->db->where("s.serviceId", $data->serviceId);
            $query = $this->db->get()->row();
            if($query) {
                $data->sRow = $query;
            }
        }

       return $data;  
    }

    function getServiceSingle($serviceId , $join = TRUE)
    {
       $this->db->select('s.serviceId, s.serviceTitle, s.serviceDescription, s.serviceImages, s.serviceBanner, 
       s.serviceType,s.extraInfo,s.subcategoryId,s.categoryId');

        $this->db->from('tbl_services AS s');
        // $this->db->join('tbl_users AS us', 'us.userId = s.supplierId');
        $this->db->where('s.serviceId', $serviceId);
        $this->db->where('s.isDeleted', 0);
        $this->db->where('s.status', ACTIVE);
        $result =  $this->db->get()->row();

        if($join == TRUE){
            $result = $this->getCategoryRow($result);
            $result = $this->getSubCategoryRow($result);
        }

        return $result;
        
    }

    function getCategoryRow($data){
    
        if(!empty($data)) {
                $this->db->select("categoryName,categoryLabel");
                $this->db->from('tbl_categories');
                $this->db->where("categoryId", $data->categoryId);
                $query = $this->db->get()->row();
                if($query) {
                    $data->cRow = $query;
                }
        }

        return $data;
    }

    function getSubCategoryRow($data){
    
        if(!empty($data)) {
                $this->db->select("subcatName,extraInfo AS scExtraInfo");
                $this->db->from('tbl_subcategories');
                $this->db->where("subcatId", $data->subcategoryId);
                $query = $this->db->get()->row();
                if($query) {
                    $data->scRow = $query;
                }
        }

        return $data;
    }
    function get_joins($data){
        //  sc.subcatName, sc.extraInfo AS scExtraInfo, us.userId, us.name
       pre($data);
       die;
        if(!empty($data)) {
            foreach($data as $key => $value) {
                $this->db->select("*");
                $this->db->from('tbl_roles');
                $this->db->where("roleId", $value->role_id);
                $query = $this->db->get()->row();
                if($query) {
                    $data[$key]->role_now = $query;
                }
            }
        }

        return $data;
        
    }

    function getCategory()
    { 
        $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.categoryImage, BaseTbl.description, BaseTbl.categoryLabel');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getInfo($id)
    {
        $this->db->select('subcatId, subcatName, subcatDescription, subcatImage,maincatId , extraInfo,  isPublished');
        $this->db->from('tbl_subcategories');
        $this->db->where('maincatId', $id);
        $this->db->where('isPublished', ACTIVE);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    

    function saveBookingDetails($bookingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_booking', $bookingInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $insert_id;
    }
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function listing($searchText,$serviceType, $page, $segment)
    {
      $this->db->select('BaseTbl.serviceId, BaseTbl.serviceTitle, BaseTbl.serviceDescription, BaseTbl.serviceImages, BaseTbl.serviceBanner, BaseTbl.status, BaseTbl.createdDtm');
        $this->db->from('tbl_services as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.serviceTitle LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($serviceType)) {
            $this->db->where('BaseTbl.serviceType',$serviceType );
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.serviceId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new services to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewServices($serviceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_services', $serviceInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get Category information by id
     * @param number $categoryId : This is Category id
     * @return array $result : This is Category information
     */
    function getServiceInfo($serviceId)
    {
        $this->db->select('serviceId, serviceTitle, serviceDescription, serviceBanner, status,extraInfo');
        $this->db->from('tbl_services');
        $this->db->where('serviceId', $serviceId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the Category information
     * @param array $categoryInfo : This is Category updated information
     * @param number  $categoryId : This is Category id
     */
    function editServices($serviceInfo, $serviceId)
    {
        $this->db->where('serviceId', $serviceId);
        $this->db->update('tbl_services', $serviceInfo);
        
        return TRUE;
    }

    /**
     * This function is commonly  used for delete the information
     * @param array $info : This is table updated information
     * @param number  $id : This is table id
     */

    function deleteCommon($id,$colname, $tbname, $Info)
    {
        $this->db->where($colname, $id);
        $this->db->update('tbl_'.$tbname, $Info);
    
        return $this->db->affected_rows();
    }
}