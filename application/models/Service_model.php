<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Service_model (Service Model)
 * Service model class to get to handle Service related data 
 * @author : M.Ali
 * @version : 1.0
 * @since : 22 Feb 2024
 */
class Service_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

     function getServiceSingle($serviceId)
    {
       $this->db->select('s.serviceId, s.serviceTitle, s.serviceDescription, s.serviceImages, s.serviceBanner, 
       s.serviceType, s.extraInfo, sc.subcatName, sc.extraInfo AS scExtraInfo, us.userId, us.name');
        $this->db->from('tbl_services AS s');
        $this->db->join('tbl_subcategories AS sc', 'sc.subcatId = s.subcategoryId');
        $this->db->join('tbl_users AS us', 'us.userId = s.supplierId');
        $this->db->where('s.serviceId', $serviceId);
        $this->db->where('s.isDeleted', 0);
        $this->db->where('s.status', ACTIVE);
        // $this->db->limit($page, $segment);
        return $this->db->get()->row();
            
    }
    
    function listingCount($searchText,$categoryId)
    {

        $this->db->select('BaseTbl.serviceId, BaseTbl.serviceTitle, BaseTbl.serviceDescription, BaseTbl.serviceImages, BaseTbl.extraInfo, BaseTbl.serviceBanner, BaseTbl.status, BaseTbl.createdDtm');
        $this->db->from('tbl_services as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.serviceTitle LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($categoryId)) {
            $this->db->where('BaseTbl.categoryId',$categoryId);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
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
      $this->db->select('BaseTbl.serviceId, BaseTbl.serviceTitle, BaseTbl.serviceDescription, BaseTbl.serviceImages, BaseTbl.extraInfo, BaseTbl.serviceBanner, BaseTbl.status, BaseTbl.createdDtm');
        $this->db->from('tbl_services as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.serviceTitle LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($serviceType)) {
            $this->db->where('BaseTbl.categoryId',$serviceType );
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.serviceId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function listingBySid($serviceType)
    {
      $this->db->select('BaseTbl.serviceId, BaseTbl.serviceTitle, BaseTbl.status');
        $this->db->from('tbl_services as BaseTbl');
        $this->db->where('BaseTbl.subCategoryId',$serviceType);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.serviceId', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    

    function getSupplierList($supplier_id)
    {
      $this->db->select('BaseTbl.userId, BaseTbl.name, BaseTbl.email, BaseTbl.mobile');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->where('BaseTbl.isAdmin', $supplier_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.userId', 'DESC');
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
        $this->db->select('*');
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

    function updateSupplier($data,$id)
    {
        $this->db->where('bSupplierId', $id);
        $this->db->update('tbl_booking', $data);
        return $this->db->affected_rows();
    }

    function getAllCategory()
    {
        $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName,BaseTbl.categoryLabel,  BaseTbl.isPublished');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getAllSubCategory($mainCatId)
    {
        $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.isPublished');
        $this->db->from('tbl_subcategories as BaseTbl');
        $this->db->where('BaseTbl.maincatId', $mainCatId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
}