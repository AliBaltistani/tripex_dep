<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Prices (Prices Model)
 * Prices model class to get to handle Prices related data 
 * @author : Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Prices_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function count($vendorId = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_prices as BaseTbl');
        if($vendorId != NULL) {
            $this->db->where('BaseTbl.user_id', $vendorId);
        }
        $this->db->where('BaseTbl.isDeleted', 0); 
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function getAll($page, $segment,$vendorId = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_prices as BaseTbl');
        if($vendorId != NULL) {
            $this->db->where('BaseTbl.role_id', $vendorId);
        }
        $this->db->where('BaseTbl.isDeleted', 0); 
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment); 
        $query = $this->db->get();
    
        $result = $query->result(); 
        return  $this->get_role($result); 
    }

    function all()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_prices as BaseTbl');
        
        $this->db->where('BaseTbl.isDeleted', 0); 
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
    
        $result = $query->result(); 
        return   $result;
    }

    function get_role($data){
       
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

    function getWhere(Array $condition, Array $select_columns = array('*'))
    {
        $this->db->select($select_columns);
        $this->db->from('tbl_prices as BaseTbl');
        $this->db->where($condition);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getRow(Array $condition, Array $select_columns = array('*'))
    {
        $this->db->select($select_columns);
        $this->db->from('tbl_prices as BaseTbl');
        $this->db->where($condition);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result;
    }

    function update($data , $id){
        $this->db->where('id', $id);
       $res =  $this->db->update('tbl_prices', $data);
       return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_prices', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function delete($id, $info)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_prices', $info);
    
        return $this->db->affected_rows();
    }
    

}

  