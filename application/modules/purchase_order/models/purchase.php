<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');   

class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
        $this->db->select('purchase_order.* ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.delete_status',0);
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id','left');
        $this->db->limit($end,$start); 
        $this->db->or_like($like);     
        $query=$this->db->get();
        return $query->result_array();         
    }
   
    function count($branch){
        $this->db->select()->from('purchase_order')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    function search_items($search,$bid,$guid,$limit){
        $this->db->select('items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive, items.tax_inclusive2,items.tax2_type,items.tax2_value, items.tax_id,suppliers_x_items.*')->from('suppliers_x_items')->where('suppliers_x_items.delete_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.active_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.deactive_item',0)->where('suppliers_x_items.item_active',0)->where('items.branch_id',$bid)->where('items.active_status',1)->where('items.delete_status',1);
        $this->db->join('items', "items.guid=suppliers_x_items.item_id  AND suppliers_x_items.supplier_id='".$guid."' ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $like=array('items.active_status'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);
                $this->db->limit($limit);
                $sql=  $this->db->get();
                $data=array();
                foreach ($sql->result() as $row){
                    if($row->purchase==1){
                    $data[]=$row;
                    }
                }
        return $data;
     
     }
     function get_purchase_order($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_per2 as dis_per2 ,purchase_items.discount_amount as item_dis_amt ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2 ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code, items.tax_inclusive2,items.tax2_type,items.tax2_value,')->from('purchase_order')->where('purchase_order.guid',$guid);
         $this->db->join('purchase_items', "purchase_items.order_id = purchase_order.guid  AND  purchase_items.delete_status=0",'left');
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
     function purchase_order_invoice($guid){
         $this->db->select('branches.code as branch_code,branches.store_name as branch_name,branches.address as branch_address,branches.city as branch_city,branches.state as branch_state,branches.zip as branch_zip ,branches.country as branch_country,branches.phone as branch_phone,branches.email as branch_mail,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,suppliers.email as supplier_email,suppliers.phone as supplier_phone,suppliers.city as supplier_city,suppliers.state as supplier_state,suppliers.zip as supplier_zip,suppliers.country as supplier_country,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_per2 as dis_per2 ,purchase_items.discount_amount as item_dis_amt ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2 ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code, items.tax_inclusive2,items.tax2_type,items.tax2_value,')->from('purchase_order')->where('purchase_order.guid',$guid);
         $this->db->join('branches', "branches.guid = purchase_order.branch_id ",'left');
         $this->db->join('purchase_items', "purchase_items.order_id = purchase_order.guid  AND  purchase_items.delete_status=0",'left');
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
     function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->update('purchase_items',array('delete_status'=>1));
     }
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('purchase_order',array('order_status'=>1));
        
     }
     function  check_approve($guid){
          $this->db->select()->from('purchase_order')->where('guid',$guid)->where('order_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
     }
    
}
?>
