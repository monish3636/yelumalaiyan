<?php

class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('direct_grn.* ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
              
                $this->db->from('direct_grn')->where('direct_grn.branch_id',$branch)->where('direct_grn.delete_status',0);
                $this->db->join('suppliers', 'suppliers.guid=direct_grn.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }

    
   
    function count($branch){
        $this->db->select()->from('direct_grn')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   
   
    
    function search_items($search,$bid,$guid){
        $this->db->select('items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,suppliers_x_items.*')->from('suppliers_x_items')->where('suppliers_x_items.delete_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.active_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.deactive_item',0)->where('suppliers_x_items.item_active',0)->where('items.branch_id',$bid)->where('items.active_status',1)->where('items.delete_status',1);
        $this->db->join('items', "items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."' ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $like=array('items.guid'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
        $this->db->or_like($like); 
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=  $this->db->get();
                $data=array();
                foreach ($sql->result() as $row){
                    if($row->purchase==1){
                    $data[]=$row;
                    }
                }
               // $this->db->like('suppliers_x_items.supplier_id',$guid); 
         
         return $data;
     
    }
    function get_direct_grn($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,direct_grn.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_grn')->where('direct_grn.guid',$guid);
         $this->db->join('purchase_items', 'purchase_items.order_id = direct_grn.guid ','left');
         $this->db->join('items', "items.guid=purchase_items.item AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item ",'left');
         $this->db->join('suppliers', "suppliers.guid=direct_grn.supplier_id AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=direct_grn.supplier_id AND suppliers_x_items.item_id=purchase_items.item AND purchase_items.order_id='".$guid."'  ",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          $row['grn_date']=date('d-m-Y',$row['grn_date']);
       
      
         
          $data[]=$row;
         }
         return $data;
    }
    function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->delete('purchase_items');
    }
    function approve_grn($guid){
         $this->db->where('guid',$guid);
         $this->db->update('direct_grn',array('order_status'=>1));
        
    }
    function  check_approve($guid){
          $this->db->select()->from('direct_grn')->where('guid',$guid)->where('order_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
    }
    function direct_grn_stock($guid,$Bid){
        $this->db->select('purchase_items.*,direct_grn.supplier_id')->from('purchase_items')->where('direct_grn.guid',$guid);
        $this->db->join('direct_grn', 'direct_grn.guid=purchase_items.order_id','left');
        $grn=$this->db->get();
        foreach ($grn->result() as $grn_row){
            $price=$grn_row->sell;
            $supplier=$grn_row->supplier_id;
            $this->db->select()->from('stock')->where('branch_id',$Bid)->where('item',$grn_row->item);
            $sql_order=  $this->db->get();
            if($sql_order->num_rows()>0){
                $stock_quty;
                $stock_guid;
            foreach ($sql_order->result() as $stock){
                $stock_quty=  $stock->quty;
                $selling=$stock->price;
                $stock_guid=$stock->guid;
            }
            if($selling==$price){
            $this->db->where('branch_id',$Bid)->where('item',$grn_row->item);
            $this->db->update('stock',array('quty'=>$grn_row->quty+$stock_quty,'price'=>$price));
                $this->db->insert('stocks_history',array('stock_id'=>$stock_guid,'supplier_id'=>$supplier,'grn_id'=>$guid,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$grn_row->cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
            
            }else{
             $this->db->insert('stock',array('item'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'branch_id'=>$Bid));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
             
            $this->db->update('stock',array('guid'=>  md5('stock'.$grn_row->item.$id)));
            
            $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$grn_row->item.$id),'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$grn_row->cost,'date'=>strtotime(date("Y/m/d"))));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
            }

            }else{
                $this->db->insert('stock',array('item'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'branch_id'=>$Bid));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stock',array('guid'=>  md5('stock'.$grn_row->item.$id)));
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$grn_row->item.$id),'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$grn_row->cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
            }
            
        }
         
    }
    function add_items($item_value){
        $this->db->insert('purchase_items',$item_value);
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('purchase_items',array('guid'=>  md5('purchase_items'.$id)));
    }
    
}
?>
