<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of MY_Model
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class MY_Model extends CI_Model {
    
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    protected $_timestamps = FALSE;
    protected $_last_message = NULL;
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get($id = NULL, $single = FALSE, $method = 'result'){
        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif($single == TRUE) {
            $method = 'row';
        }
        
        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);            
        }
        
        $result = $this->db->get($this->_table_name);
        
        if (!$result){
            return FALSE;
        }
        
        return $result->$method();
    }
    
    
    public function get_select_where($fields = '*', $where=NULL, $single= FALSE){
        $this->db->select($fields);
        if ($where) $this->db->where($where);
        
        return $this->get(NULL, $single);
    }

    public function get_count($where=NULL){
        $this->db->select('count(*) as found');
        
        if ($where)
            $this->db->where($where);
        
        $row = $this->db->get($this->_table_name)->row();
        
        return $row->found;
    }
    
    public function get_offset($fields='*', $where=NULL, $offset=0, $limit=20, $method='result'){
        $this->db->select($fields);
        
        if ($where)
            $this->db->where($where);
        
        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);            
        }
        if ($limit > 0){
            $this->db->limit($limit);
            $this->db->offset($offset);
        }
        
        return $this->db->get($this->_table_name)->$method();
    }
    
    public function get_by($where=NULL, $single = FALSE){
        if ($where){
            $this->db->where($where);
        }
        return $this->get(NULL, $single);
    }
    
    public function save($data, $id = NULL){
		
        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }
        // Set timestamps

        // Insert
        if ($id === NULL || $id == 0) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            
            $db_err = $this->db->error();
            if ($db_err['code']){
                $this->_last_message = $db_err['message'];
            }else{
                $id = $this->db->insert_id();
            }
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);   
            
            $db_err = $this->db->error();
            if ($db_err['code']){
                $this->_last_message = $db_err['message'];
            }
        }
        
        
        return $id;
    }
    
    public function save_where($data, $where){
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($this->_table_name);
        
        return TRUE;
    }
    
    
    public function delete($id){
        $filter = $this->_primary_filter;
        $id = $filter($id);
        
        if (!$id) {
            return FALSE;            
        }
        
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
        
        return $this->db->affected_rows();
    }
    
    public function delete_where($where){
        $this->db->where($where);
        $this->db->delete($this->_table_name);
        
        return $this->db->affected_rows();
    }
    
    
    public function get_last_db_error($return_err_number=FALSE){
        $db_err = $this->db->error();
        if ($return_err_number){
            return $db_err['code'];
        }
        return $db_err['message'];
    }
    
    public function get_last_message(){
        $db_err = $this->db->error();
        if (!$this->_last_message){
            return $db_err['message'];
        }else{
            return $this->_last_message;
        }
            
    }
    
    public function get_tablename($prefix=TRUE){
        if ($prefix){
            return $this->db->dbprefix($this->_table_name);
        }else{
            return $this->_table_name;
        }
    }
}


/*
 * file location: core/MY_Model.php
 */