<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Category_model (Category Model)
 * Task model class to get to handle Category related data 
 * @author : M.Ali
 * @version : 1.5
 * @since : 18 Jun 2024
 */
class Category_model extends CI_Model
{
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function categoryListingCount($searchText)
    {
        $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_categories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.categoryName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to check the Category exists or not
     * @param number $categorId : 
     * @return number $count : This is row count
     */
    function categoryExists($categorId)
    {
        $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName,BaseTbl.categoryLabel,  BaseTbl.isPublished');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.categoryId', $categorId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getSubcategoryList($categorId)
    {
        $this->db->select('sc.subcatId, sc.subcatName');
        $this->db->from('tbl_subcategories as sc');
        $this->db->where('sc.maincatId', $categorId);
        $this->db->where('sc.isDeleted', 0);
        $this->db->where('sc.isPublished', ACTIVE);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * This function is used to get the task listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function categoryListing($searchText, $page, $segment)
    {
      $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.description, BaseTbl.categoryLabel, BaseTbl.isPublished,   BaseTbl.categoryImage, BaseTbl.createdDtm');
        $this->db->from('tbl_categories as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.categoryName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->where('BaseTbl.isPublished', ACTIVE);
        $this->db->order_by('BaseTbl.categoryId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getCategoryRow($id)
    {
        $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.categoryLabel, BaseTbl.isPublished');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.categoryId', $id);
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result;
    }

    function getAll()
    {
      $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.description, BaseTbl.categoryLabel, BaseTbl.isPublished,   BaseTbl.categoryImage, BaseTbl.createdDtm');
      $this->db->from('tbl_categories as BaseTbl');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.isPublished', ACTIVE);
        $this->db->order_by('BaseTbl.categoryId', 'ASC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    public static function getAllForModule()
    {
      $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.categoryLabel, BaseTbl.isPublished');
      $this->db->from('tbl_categories as BaseTbl');
        
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.categoryId', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function categoryListingForBooking($data)
    {
      $this->db->select('BaseTbl.categoryId, BaseTbl.categoryName, BaseTbl.description, BaseTbl.categoryLabel, BaseTbl.isPublished,   BaseTbl.categoryImage, BaseTbl.createdDtm');
        $this->db->from('tbl_categories as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        if(!empty($data)) {

            $this->db->group_start();
            foreach ($data as $column) {
                $likeCriteria = "(BaseTbl.categoryName LIKE '%".$column."%')";
                $this->db->or_where($likeCriteria);
            }
            $this->db->group_end();
        }
        $this->db->order_by('BaseTbl.categoryId', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new category to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCategory($categoryInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_categories', $categoryInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get Category information by id
     * @param number $categoryId : This is Category id
     * @return array $result : This is Category information
     */
    function getCategoryInfo($categoryId)
    {
        $this->db->select('categoryId, categoryName, description,categoryLabel, categoryImage, isPublished');
        $this->db->from('tbl_categories');
        $this->db->where('categoryId', $categoryId);
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
        $this->db->where('categoryId', $categoryId);
        $this->db->update('tbl_categories', $categoryInfo);
        
        return TRUE;
    }
}