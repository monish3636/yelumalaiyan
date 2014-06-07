<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Items extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('decomposition_items.*,decomposition_type.value ,items.guid as i_guid,items.name');             
                $this->db->from('decomposition_items')->where('decomposition_items.branch_id',$branch)->where('decomposition_items.delete_status',0);
                $this->db->join('items', 'items.guid=decomposition_items.item_id','left');
                $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
                
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
   
    function count($branch){
        $this->db->select()->from('decomposition_items')->where('branch_id',$branch);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    
    function get_decomposition_items($guid){
        $this->db->select('decomposition_items.*,items.name,decomposition_type.value as weight')->from('decomposition_items')->where('decomposition_items.guid',$guid)->where('decomposition_items.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('items', 'items.guid=decomposition_items.item_id','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $sql=  $this->db->get();
        return $sql->result();
    }
    function update_price_in_stock($guid,$old_price,$price){
        $this->db->where(array('price'=>$old_price,'item'=>$guid));
        $this->db->update('stock',array('price'=>$price));
    }
   
    
}
?>
