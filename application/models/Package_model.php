<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Package_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get package by id
     */
    function get_package($id)
    {
        return $this->db->get_where('packages',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all packages
     */
    function get_all_packages()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('packages')->result_array();
    }
        
    /*
     * function to add new package
     */
    function add_package($params)
    {
        $this->db->insert('packages',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update package
     */
    function update_package($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('packages',$params);
    }
    
    /*
     * function to delete package
     */
    function delete_package($id)
    {
        return $this->db->delete('packages',array('id'=>$id));
    }
}
