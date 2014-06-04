<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tag extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    /* save design cordinates
        function start     */
    function save_design($values){
        $this->db->insert('price_tag_designs',$values);// insert values to price_tag_designs
        
    }
    /* function end*/
    
    /* update design 
       function start     */
    function update_design($val,$design,$label){
        $this->db->where(array('design'=>$design,'label'=>$label));
        $this->db->update('price_tag_designs',$val);
    }
    /* function end*/
    /* check duplicate designs 
     *  function start**/
    function check_duplicate($design){
        $this->db->select('id')->from('price_tag_designs')->where('design',$design);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE; // return false is new design is already added
        }else{
            return TRUE; // return true its a new design
        }
    }
    /* function end*/
    
    /* get design cordinates
     * funnction start   */
    function get_design_cord($val){
        $this->db->select()->from('price_tag_designs')->where('design',$val);
        $sql=$this->db->get();
        return $sql->result_array(); // return date in array format
    }
    // function end;
    /* search items**/
    function search_items($search){
        $this->db->select('items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id')->from('items')->where('items.branch_id',  $this->session->userdata('branch_id'))->where('items.active_status',1)->where('items.delete_status',1);
     
         $this->db->join('items_category', 'items.category_id=items_category.guid','left');
         $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
         $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
         $this->db->join('brands', 'items.brand_id=brands.guid','left');
         $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
         $like=array('items.active_status'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);
                $this->db->limit($this->session->userdata('data_limit'));
                $sql=  $this->db->get();
                $data=array();
                foreach ($sql->result() as $row){
                    if($row->purchase==1){
                    $data[]=$row;
                    }
                }
           
         
         return $data;
    }
    function data_table($end,$start,$order,$like){
        $this->db->select()->from('price_tag_designs')->like($like);//->limit($start,$end);
     $this->db->group_by('design');
        $sql=  $this->db->get();
      
        return $sql->result_array();
    }
    function count(){
        $this->db->select('id')->from('price_tag_designs');
        $this->db->group_by('design');
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    /* get price tag design details to update*/
    // function start
    function get_price_tag_details($guid){
        $this->db->select()->from('price_tag_designs')->where('design',$guid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    // function  end
    
    /* delete price tag design */
    // function starts
    function delete($design){
        $this->db->where('design',$design);
        $this->db->delete('price_tag_designs');
    }
    // function end
}

