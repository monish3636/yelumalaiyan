<?php
class Grn extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_order.*,grn.delete_status as grn_delete_status,grn.grn_no,grn.active_status as grn_active_status,grn.guid as grn_guid,grn.grn_status as grn_active, grn.date as grn_date,grn.grn_no ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,grn.total_amt');
                $this->db->from('grn')->where('purchase_order.branch_id',$branch)->where('purchase_order.active_status',1)->where('purchase_order.delete_status',0)->where('grn.delete_status',0);
                $this->db->join('purchase_order', 'purchase_order.guid=grn.po AND grn.delete_status=0','left');
                $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id AND purchase_order.guid=grn.po','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                    if($row['grn_delete_status']==0){
                    $row['grn_date']=date('d-m-Y',$row['grn_date']);
                    $data[]=$row;
                    }
                }
                return $data; 
        
    }
    function search_purchase_order($like,$branch){
        $this->db->select('purchase_order.*,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.order_status',1)->where('purchase_order.active_status',1)->where('purchase_order.delete_status',0);
        $or_like=array('po_no'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id AND purchase_order.order_status=1 AND purchase_order.active_status=1 AND purchase_order.delete_status=0 ','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['expired']=0;
            if($row['exp_date'] < strtotime(date("Y/m/d"))){  
                $row['expired']=1;
            }
            $row['po_date']=date('d-m-Y',$row['po_date']);
            $row['exp_date']=date('d-m-Y',$row['exp_date']);
            $data[]=$row;

        }
         return $data;
               
        
    }
    
  
    function count($branch){
        $this->db->select()->from('purchase_order')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
 
    function get_purchase_order($guid){
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as order_tax,purchase_items.discount_per2 as dis_per2 ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2,purchase_items.item ,purchase_items.quty ,purchase_items.free,purchase_items.guid as o_i_guid ,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('purchase_order')->where('purchase_order.guid',$guid);
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
    function get_goods_receiving_note($guid){
        $this->db->select('grn.date as grn_date,grn.note as grn_note,grn.remark as grn_remark,grn.grn_no,items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_Inclusive ,grn.po,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.discount_per2 as dis_per2 ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2,purchase_items.item ,purchase_items.quty ,purchase_items.free,purchase_items.guid as o_i_guid ,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('grn')->where('grn.guid',$guid)->where('grn.delete_status',0);
        $this->db->join('purchase_order', 'grn.po=purchase_order.guid','left');
        $this->db->join('purchase_items', 'purchase_items.order_id = purchase_order.guid AND purchase_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_items.item  AND purchase_items.order_id=purchase_order.guid AND purchase_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_items.order_id=purchase_order.guid  AND purchase_items.delete_status=0",'left');
     
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['po_date']=date('d-m-Y',$row['po_date']);       
            $row['grn_date']=date('d-m-Y',$row['grn_date']);       
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
     function deactive_order($guid){
         $this->db->select()->from('purchase_order')->where('guid',$guid)->where('order_status',0);
         $sql=  $this->db->get();
         if($sql->num_rows()>0){
             $this->db->where('guid',$guid);
             $this->db->update('purchase_order',array('active'=>0));
             echo 'TRUE';
         }else {
             echo "approve";
         }
     }
    function received_items($po_item,$quty,$free,$guid){        
        $data=array('received_quty'=>$quty,'received_free'=>$free,'grn_id'=>$guid);
        $this->db->where('guid',$po_item);
        $this->db->update('purchase_items',$data);
     }
    # Add Stock From Purchase Receve Note
    function add_stock($guid,$po,$Bid){
        $this->db->select('purchase_items.*,purchase_order.supplier_id')->from('purchase_order')->where('purchase_order.guid',$po);
        $this->db->join('purchase_items','purchase_items.order_id=purchase_order.guid','left');
        $sql=  $this->db->get();
        $price;
        $supplier;
        foreach ($sql->result() as $row){
           $price=$row->sell;
           $cost=$row->cost;
           $supplier=$row->supplier_id;
        }
        $this->db->select()->from('stock')->where('branch_id',$Bid)->where('item',$row->item);
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
                $quty=$row->received_quty+$row->received_free;
                $this->db->where('branch_id',$Bid)->where('item',$row->item);
                $this->db->update('stock',array('date'=>strtotime(date('d-m-Y')),'quty'=>$quty+$stock_quty,'price'=>$price));
                $this->db->insert('stocks_history',array('stock_id'=>$stock_guid,'po_id'=>$po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$row->item,'quty'=>$quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$row->item.$id)));
            
            }else{
                $quty=$row->received_quty+$row->received_free;
                $this->db->insert('stock',array('date'=>strtotime(date('d-m-Y')),'item'=>$row->item,'quty'=>$quty,'price'=>$price,'branch_id'=>$Bid));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);

                $this->db->update('stock',array('guid'=>  md5('stock'.$row->item.$id)));
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$row->item.$id),'po_id'=>$po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$row->item,'quty'=>$quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$row->item.$id)));
            }
        }else{
            $quty=$row->received_quty+$row->received_free;
            $this->db->insert('stock',array('date'=>strtotime(date('d-m-Y')),'item'=>$row->item,'quty'=>$quty,'price'=>$price,'branch_id'=>$Bid));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);             
            $this->db->update('stock',array('guid'=>  md5('stock'.$row->item.$id)));
            $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$row->item.$id),'po_id'=>$po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$row->item,'quty'=>$quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$row->item.$id)));
            
            
        }
        }
   
    function change_grn_status($guid){
        $this->db->where('guid',$guid);
        $this->db->update('grn',array('grn_status'=>1));
    }
    function delete_grn_items($guid){
        $this->db->where('grn_id',$guid);
        $this->db->update('purchase_items',array('received_quty'=>0,'received_free'=>0));
    }
    function grn_delete($guid){       
       $this->db->where('grn_id',$guid);
       $this->db->update('purchase_order',array('grn_status'=>0)); 
       $this->db->where('guid',$guid);
       $this->db->delete('grn');
    }
    function check_approve($guid){
            $this->db->select()->from('grn')->where('guid',$guid)->where('grn_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
                return FALSE;
            }else{
                return TRUE;
            }
            
    }
    function update_grn_status($po,$guid){
        $this->db->where('guid',$po);
        $this->db->update('purchase_order',array('grn_status'=>1,'grn_id'=>$guid)); 
    }
    
}
?>
