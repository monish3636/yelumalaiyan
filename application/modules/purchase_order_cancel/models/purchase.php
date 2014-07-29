<?php
class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
   
    function search_purchase_order($like,$branch){
        $this->db->select('purchase_order.*,suppliers.guid as s_guid,suppliers.address1,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.order_status',1)->where('purchase_order.grn_status',0)->where('purchase_order.active_status',1)->where('purchase_order.delete_status',0);
        $or_like=array('po_no'=>$like);
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id ','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){              
            if($row['exp_date'] >= strtotime(date("Y/m/d"))){ 
                $row['po_date']=date('d-m-Y',$row['po_date']);
                $row['exp_date']=date('d-m-Y',$row['exp_date']); 
                $data[]=$row;
            }
        }
        return $data;   
    }
  
    
    
    function search_items($search,$bid,$guid,$limit){
        $this->db->select('purchase_items.*,items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_id,')->from('purchase_items')->where('purchase_items.order_id',$guid);
        $this->db->join('items', 'items.guid=purchase_items.item','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_purchase_order($guid){
        $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_per2 as dis_per2 ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free,purchase_items.guid as o_i_guid ,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('purchase_order')->where('purchase_order.guid',$guid);
        $this->db->join('purchase_items', 'purchase_items.order_id = purchase_order.guid AND purchase_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_items.item AND purchase_items.order_id='".$guid."' AND purchase_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_items.order_id='".$guid."'  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_items.item AND purchase_items.order_id='".$guid."'  AND purchase_items.delete_status=0",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['po_date']=date('d-m-Y',$row['po_date']);       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);         
            $row['date']=date('d-m-Y',$row['date']);         
            $data[]=$row;
        }
        return $data;
     }
 
 
    function purchase_order_cancel($po,$items_order_guid,$po_quty,$po_free,$items_free,$items_quty){        
        $this->db->where('guid',$items_order_guid);
        $this->db->update('purchase_items',array('quty'=>$po_quty-$items_quty,'free'=>$po_free-$items_free)); 
    }
    
}
?>
