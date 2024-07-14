<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Notification_model (Notification Model)
 * Notification model class to get to handle Notification related data 
 * @author : Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Notification_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function count($vendorId = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_notifications as BaseTbl');
        if($vendorId != NULL) {
            $this->db->where('BaseTbl.user_id', $vendorId);
        }
        $this->db->where('BaseTbl.isDeleted', 0); 
        $this->db->where('BaseTbl.read_status', 0); 
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function getAll($vendorId = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_notifications as BaseTbl');
        if($vendorId != NULL) {
            $this->db->where('BaseTbl.user_id', $vendorId);
        }
        $this->db->where('BaseTbl.isDeleted', 0); 
        $this->db->where('BaseTbl.read_status', 0); 
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getWhere(Array $condition, Array $select_columns = array('*'))
    {
        $this->db->select($select_columns);
        $this->db->from('tbl_notifications as BaseTbl');
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
        $this->db->from('tbl_notifications as BaseTbl');
        $this->db->where($condition);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result;
    }

    function update($data , $id){
        $this->db->where('id', $id);
       $res =  $this->db->update('tbl_notifications', $data);
       return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_notifications', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function delete($id, $info)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_notifications', $info);
    
        return $this->db->affected_rows();
    }
    

}

  