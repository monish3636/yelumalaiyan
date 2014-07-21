<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('customers.* ,customer_category.guid as c_guid,customer_category.category_name as c_name')->from('customers')->where('customers.branch_id',$branch)->where('customers.delete_status',0);
                $this->db->join('customer_category', 'customers.category_id=customer_category.guid','left');
                 $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array();         
    }
    function edit_customer($guid){
                $this->db->select('customers.* ,customer_category.guid as c_guid,customer_category.category_name as c_name,')->from('customers')->where('customers.guid',$guid);
                $this->db->join('customer_category', 'customers.category_id=customer_category.guid','left');
                                 
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                    $row['bday']=date('d-m-Y',$row['bday']);
                    $row['mday']=date('d-m-Y',$row['mday']);
                    $data[]=$row;
                }
                return $query->result_array(); 
    }
    function get_fields(){
        return $this->db->list_fields('customers');
        
    }
    function export_customer(){
        $this->db->select()->from('customers')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
        $sql=  $this->db->get();
        return $sql->result_array();
    }
}
?>
