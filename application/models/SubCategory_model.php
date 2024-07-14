<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Category_model (Category Model)
 * Task model class to get to handle Category related data 
 * @author : M.Ali
 * @version : 1.5
 * @since : 18 Jun 2024
 */
class SubCategory_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function subcategoryListingCount($searchText, $categoryId)
    {
        $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.subcatDescription, BaseTbl.createdDtm');
        $this->db->from('tbl_subcategories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subcatName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.maincatId', $categoryId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to check the Category exists or not
     * @param number $categorId : 
     * @return number $count : This is row count
     */
    function subcategoryExists($categorId)
    {
        $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, c.categoryName, BaseTbl.isPublished');
        $this->db->from('tbl_subcategories as BaseTbl');
        $this->db->where('BaseTbl.subcatId', $categorId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function subcategoryListing($searchText, $page, $segment)
    {
      $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.subcatDescription,BaseTbl.isPublished,BaseTbl.maincatId,   BaseTbl.subcatImage, c.categoryName, BaseTbl.createdDtm');
        $this->db->from('tbl_subcategories as BaseTbl');
        $this->db->join('tbl_categories as c', " ON BaseTbl.maincatId = c.categoryId");
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subcatName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.subcatId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function subcategoryListingId($searchText,$maincatId, $page, $segment)
    {
      $this->db->select('BaseTbl.subcatId, BaseTbl.subcatName, BaseTbl.subcatDescription,BaseTbl.isPublished,BaseTbl.maincatId,   BaseTbl.subcatImage, c.categoryName, BaseTbl.createdDtm');
        $this->db->from('tbl_subcategories as BaseTbl');
        $this->db->join('tbl_categories as c', " ON BaseTbl.maincatId = c.categoryId");
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.subcatName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.maincatId', $maincatId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.subcatId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function categoryListing()
    {
      $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName,BaseTbl.categoryLabel, BaseTbl.isPublished');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new category to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewSubCategory($categoryInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_subcategories', $categoryInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get Category information by id
     * @param number $categoryId : This is Category id
     * @return array $result : This is Category information
     */
    function getSubCategoryInfo($subcategoryId)
    {
        $this->db->select('subcatId, subcatName, subcatDescription, subcatImage,maincatId , extraInfo,  isPublished');
        $this->db->from('tbl_subcategories');
        $this->db->where('subcatId', $subcategoryId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the Category information
     * @param array $categoryInfo : This is Category updated information
     * @param number  $categoryId : This is Category id
     */
    function editCategory($categoryInfo, $categoryId)
    {
        $this->db->where('subcatId', $categoryId);
        $this->db->update('tbl_subcategories', $categoryInfo);
        
        return TRUE;
    }
}