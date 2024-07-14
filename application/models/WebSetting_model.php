<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Web Setting (WebSetting Model)
 * WebSetting model class to get to handle WebSetting related data 
 * @author : Mali
 * @version : 1.1
 * @since : 15 April 2016
 */

class WebSetting_model extends CI_Model
{

    protected $table = 'tbl_settings';
   

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function count()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($this->table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0); 
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function getAll()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($this->table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0); 
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
    
        $result = $query->result(); 
        return  $result; 
    }



    function getWhere(Array $condition, Array $select_columns = array('*'))
    {
        $this->db->select($select_columns);
        $this->db->from($this->table.' as BaseTbl');
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
        $this->db->from($this->table.' as BaseTbl');
        $this->db->where($condition);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result;
    }

    function update($id, $data){
        $this->db->where('id', $id);
       $res =  $this->db->update($this->table, $data);
       return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function delete($id, $info)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $info);
    
        return $this->db->affected_rows();
    }
    

}

  