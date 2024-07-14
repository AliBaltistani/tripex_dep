<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Tax (Tax Model)
 * Tax model class to get to handle Tax related data 
 * @author : M.Ali
 * @version : 1.1
 * @since : 1 June 2024
 */
class Tax_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    protected $table = 'tbl_tax';
    protected $fillable = [
        'id',
        'role_id',
        'sale_tax',
        'tax_type',
        'status',
        'isDeleted',
        'createdBy',
        'createdDtm',
        'updatedBy',
        'updatedDtm',	
    ];

    function count($vendorId = NULL)
    {
        $this->db->select($this->fillable);
        $this->db->from($this->table);
        if($vendorId != NULL) {
            $this->db->where('role_id', $vendorId);
        }
        $this->db->where('isDeleted', 0); 
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
   
    function getAll($page, $segment, $vendorId = NULL)
    {
        $this->db->select($this->fillable);
        $this->db->from($this->table);
        if($vendorId != NULL) {
            $this->db->where('role_id', $vendorId);
        }
        $this->db->where('isDeleted', 0); 
        $this->db->order_by('id', 'DESC');
        $this->db->limit($page, $segment); 
        $query = $this->db->get();
    
        $result = $query->result(); 
        return  $this->get_role($result); 
    }

    function all()
    {
        $this->db->select($this->fillable);
        $this->db->from($this->table);
        
        $this->db->where('isDeleted', 0); 
        $this->db->order_by('id', 'DESC');
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
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function getRow(Array $condition, Array $select_columns = array('*'))
    {
        $this->db->select($select_columns);
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        $result = $query->row();        
        return $result;
    }

    function update($data , $id){
        $this->db->where('id', $id);
       $res =  $this->db->update($this->table, $this->get_fillables($data));
       return $this->db->affected_rows();
    }

    function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $this->get_fillables($data));
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function delete($id, $info)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $this->get_fillables($info));
        
        return $this->db->affected_rows();
    }


    public function get_fillables($data){
        $data = (array) $data;
		if(!empty($data)){
            foreach($data as $key => $d1){
                if(!array_key_exists($key, array_flip($this->fillable))){
                    unset($data[$key]);
                }
            }
        }
        return $data;
	}
    

}

  