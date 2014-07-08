<?php

class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('direct_invoice.* ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
              
                $this->db->from('direct_invoice')->where('direct_invoice.branch_id',$branch)->where('direct_invoice.delete_status',0);
                $this->db->join('suppliers', 'suppliers.guid=direct_invoice.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }

    
   
    function count($branch){
        $this->db->select()->from('direct_invoice')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
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
    function get_direct_invoice($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,direct_invoice.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_invoice')->where('direct_invoice.guid',$guid);
         $this->db->join('purchase_items', 'purchase_items.order_id = direct_invoice.guid ','left');
         $this->db->join('items', "items.guid=purchase_items.item AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item ",'left');
         $this->db->join('suppliers', "suppliers.guid=direct_invoice.supplier_id AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=direct_invoice.supplier_id AND suppliers_x_items.item_id=purchase_items.item AND purchase_items.order_id='".$guid."'  ",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          $row['invoice_date']=date('d-m-Y',$row['invoice_date']);
       
      
         
          $data[]=$row;
         }
         return $data;
    }
    function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->delete('purchase_items');
    }
    function approve_invoice($guid){
        $this->db->where('guid',$guid);
        $this->db->update('direct_invoice',array('order_status'=>1));
        $this->db->select()->from('direct_invoice')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
             
            $value=array('branch_id'=>  $this->session->userdata('branch_id'),'supplier_id'=>$row->supplier_id,'invoice'=>$row->invoice_no,'direct_invoice_id'=>$guid,'date'=>$row->invoice_date,'remark'=>$row->remark,'note'=>$row->note);
            $this->db->insert('purchase_invoice',$value);
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('purchase_invoice',array('guid'=>  md5('purchase_invoice'.$id)));
         
            $this->db->insert('supplier_payable',array('supplier_id'=>$row->supplier_id,'invoice_id'=>$guid,'amount'=>$row->total_amt,'branch_id'=>  $this->session->userdata['branch_id']));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('supplier_payable',array('guid'=>  md5($row->supplier_id.$row->invoice_no.$id.$guid)));
            $this->db->where(array('order_id'=>$guid,'branch_id'=>  $this->session->userdata('branch_id')));
            $this->db->update('purchase_items',array('invoice_id'=> md5('purchase_invoice'.$id)));
        }
    }
    function  check_approve($guid){
          $this->db->select()->from('direct_invoice')->where('guid',$guid)->where('order_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
    }
    function direct_invoice_stock($guid,$Bid){
        $this->db->select('purchase_items.*,direct_invoice.supplier_id')->from('direct_invoice')->where('direct_invoice.guid',$guid);
        $this->db->join('purchase_items','purchase_items.order_id=direct_invoice.guid','left');
        $invoice=$this->db->get();
        foreach ($invoice->result() as $invoice_row){
            $price=$invoice_row->sell;
            $cost=$invoice_row->cost;
            $this->db->select()->from('stock')->where('branch_id',$Bid)->where('item',$invoice_row->item);
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
                $this->db->where('branch_id',$Bid)->where('item',$invoice_row->item);
                $this->db->update('stock',array('quty'=>$invoice_row->quty+$stock_quty,'price'=>$price));
                $this->db->insert('stocks_history',array('stock_id'=>$stock_guid,'invoice_id'=>$guid,'supplier_id'=>$invoice_row->supplier_id,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$invoice_row->item,'quty'=>$invoice_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$invoice_row->item.$id)));
            }else{
                $this->db->insert('stock',array('item'=>$invoice_row->item,'quty'=>$invoice_row->quty,'price'=>$price,'branch_id'=>$Bid));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
             
                $this->db->update('stock',array('guid'=>  md5('stock'.$invoice_row->item.$id)));
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$invoice_row->item.$id),'invoice_id'=>$guid,'supplier_id'=>$invoice_row->supplier_id,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$invoice_row->item,'quty'=>$invoice_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$invoice_row->item.$id)));
            }

            }else{
                $this->db->insert('stock',array('item'=>$invoice_row->item,'quty'=>$invoice_row->quty,'price'=>$price,'branch_id'=>$Bid));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stock',array('guid'=>  md5('stock'.$invoice_row->item.$id)));
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$invoice_row->item.$id),'invoice_id'=>$guid,'supplier_id'=>$invoice_row->supplier_id,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$invoice_row->item,'quty'=>$invoice_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$invoice_row->item.$id)));
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
