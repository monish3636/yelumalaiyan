<?php
class Grn extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_order.*,grn.delete_status as grn_delete_status,grn.grn_no,grn.active_status as grn_active_status,grn.guid as grn_guid,grn.grn_status as grn_active, grn.date as grn_date,grn.grn_no ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
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
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id ','left');
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
    function supplier_vs_items($end,$start,$like,$branch,$suplier){
        
                $this->db->select('suppliers_x_items.* ,items.guid as i_guid,items.name as i_name,items.code as i_code')->from('suppliers_x_items')->where('suppliers.branch_id',$branch)->where('suppliers.active_status',1)->where('suppliers.active',0)->where('suppliers.delete_status',1)->where('suppliers_x_items.active_status',1)->where('suppliers_x_items.delete_status',1);
                $this->db->join('items', 'items.guid=suppliers_x_items.item_id','left');
                $this->db->join('suppliers', 'suppliers.guid=suppliers_x_items.supplier_id','left');
                $this->db->where('suppliers_x_items.supplier_id',$suplier);
               $this->db->limit($end,$start);   
                $this->db->like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
    
  
    function count($branch){
        $this->db->select()->from('purchase_order')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   
    function search_items($search,$branch){
          $this->db->select('items.* ,items_category.guid as c_guid,items_category.category_name as c_name,brands.guid as b_guid,brands.name as b_name,items_department.department_name as d_name')->from('items')->where('items.branch_id',$branch)->where('items.active_status',1)->where('items.delete_status',1);
                $this->db->join('items_category', 'items.category_id=items_category.guid','left');
                $this->db->join('brands', 'items.brand_id=brands.guid','left');
                $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
               // $this->db->join('supplier', 'stock.supplier=supplier.id','left');
                $like=array('items.name'=>$search,'items.code'=>$search,'items.barcode'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result();
    }
    function get_suppliers_x_items($guid){
        $this->db->select()->from('suppliers_x_items')->where('guid',$guid);
        $sql=  $this->db->get();
        $data=array();
        $item_id;
        foreach ($sql->result() as $row){
            $item_id=$row->item_id;
            $data[]=$row;
        }
        $this->db->select()->from('items')->where('guid',$item_id);
        $item=  $this->db->get();
        foreach ($item->result() as $row){
            $data[]=$row;
        }
        return $data;
    }
    function supplier_like($like,$bid){
          $this->db->select('suppliers.* ,suppliers_category.guid as c_guid,suppliers_category.category_name')->from('suppliers')->where('suppliers.branch_id',$bid)->where('suppliers.active_status',1)->where('suppliers.active',0)->where('suppliers.delete_status',1);
          $this->db->join('suppliers_category', 'suppliers_category.guid=suppliers.category','left');
          $this->db->or_like($like);
          $sql=  $this->db->get();
          return $sql->result();
    }
    
    function serach_items($search,$bid,$guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,suppliers_x_items.*')->from('suppliers_x_items')->where('suppliers_x_items.delete_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.active_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.deactive_item',0)->where('suppliers_x_items.item_active',0)->where('items.branch_id',$bid)->where('items.active_status',1)->where('items.delete_status',1);
         $this->db->join('items', "items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."' ",'left');
         $this->db->join('items_category', 'items.category_id=items_category.guid','left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
         $this->db->join('brands', 'items.brand_id=brands.guid','left');
         $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
          $like=array('items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like); 
               // $this->db->like('suppliers_x_items.supplier_id',$guid); 
         $sql=  $this->db->get();
         return $sql->result();
     
     }
    function get_purchase_order($guid){
        $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_order_items.discount_per as dis_per ,purchase_order_items.discount_amount as item_dis_amt ,purchase_order_items.tax as dis_amt ,purchase_order_items.tax as order_tax,purchase_order_items.item ,purchase_order_items.quty ,purchase_order_items.free,purchase_order_items.guid as o_i_guid ,purchase_order_items.received_quty ,purchase_order_items.received_free ,purchase_order_items.cost ,purchase_order_items.sell ,purchase_order_items.mrp,purchase_order_items.guid as o_i_guid ,purchase_order_items.amount ,purchase_order_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('purchase_order')->where('purchase_order.guid',$guid);
        $this->db->join('purchase_order_items', 'purchase_order_items.order_id = purchase_order.guid AND purchase_order_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_order_items.item AND purchase_order_items.order_id='".$guid."' AND purchase_order_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_order_items.item AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
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
        $this->db->select('grn.date as grn_date,grn.note as grn_note,grn.remark as grn_remark,grn.grn_no,grn_x_items.guid as grn_items_guid,grn_x_items.quty as rece_quty,grn_x_items.free as rece_free,items.tax_Inclusive ,grn.po,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_order_items.discount_per as dis_per ,purchase_order_items.discount_amount as item_dis_amt ,purchase_order_items.tax as dis_amt ,purchase_order_items.tax as order_tax,purchase_order_items.item ,purchase_order_items.quty ,purchase_order_items.free,purchase_order_items.guid as o_i_guid ,purchase_order_items.received_quty ,purchase_order_items.received_free ,purchase_order_items.cost ,purchase_order_items.sell ,purchase_order_items.mrp,purchase_order_items.guid as o_i_guid ,purchase_order_items.amount ,purchase_order_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('grn')->where('grn.guid',$guid)->where('grn.delete_status',0);
        $this->db->join('purchase_order', 'grn.po=purchase_order.guid','left');
        $this->db->join('grn_x_items', 'grn_x_items.grn=grn.guid','left');
        $this->db->join('purchase_order_items', 'purchase_order_items.order_id = purchase_order.guid AND grn_x_items.item=purchase_order_items.item AND purchase_order_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_order_items.item AND items.guid=grn_x_items.item AND purchase_order_items.order_id=purchase_order.guid AND purchase_order_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_order_items.order_id=purchase_order.guid  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_order_items.item AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
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
          $this->db->update('purchase_order_items',array('delete_status'=>1));
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
    function update_item_receving($po_item,$quty,$free){
        $this->db->select()->from('purchase_order_items')->where('guid',$po_item);
        $sql=  $this->db->get();
        $received_quty;
        $received_free;
        $ordered_quty;
        $ordered_free;
        foreach ($sql->result() as $row){
            $received_quty=$row->received_quty;
            $received_free=$row->received_free;
            $ordered_quty=$row->quty;
            $ordered_free=$row->free;
         }
        $balance_quty=$ordered_quty-$received_quty;
        $balance_free=$ordered_free-$received_free;
        if($free>$balance_free){
            $free=$balance_free;
        }
        if($quty>$balance_quty){
            $quty=$balance_quty;
        }
        $data=array('received_quty'=>$received_quty+$quty,'received_free'=>$received_free+$free);
        $this->db->where('guid',$po_item);
        $this->db->update('purchase_order_items',$data);
        
         
     }
    # Add Stock From Purchase Receve Note
    function add_stock($guid,$po_item,$Bid){
        $this->db->select('grn_x_items.*,grn.po')->from('grn')->where('grn.guid',$guid);
        $this->db->join('grn_x_items', 'grn_x_items.grn=grn.guid','left');
        $grn=$this->db->get();
        foreach ($grn->result() as $grn_row){
     
        
        $this->db->select('purchase_order_items.*,purchase_order.supplier_id')->from('purchase_order')->where('purchase_order.guid',$grn_row->po);
        $this->db->join('purchase_order_items','purchase_order_items.order_id=purchase_order.guid','left');
        $sql=  $this->db->get();
        $price;
        $supplier;
        foreach ($sql->result() as $row){
           $price=$row->sell;
           $cost=$row->cost;
           $supplier=$row->supplier_id;
        }
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
            $this->db->insert('stocks_history',array('stock_id'=>$stock_guid,'po_id'=>$grn_row->po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
            
            }else{
             $this->db->insert('stock',array('item'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'branch_id'=>$Bid));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
             
            $this->db->update('stock',array('guid'=>  md5('stock'.$grn_row->item.$id)));
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$grn_row->item.$id),'po_id'=>$grn_row->po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
            }
        }else{
            $this->db->insert('stock',array('item'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'branch_id'=>$Bid));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
             
            $this->db->update('stock',array('guid'=>  md5('stock'.$grn_row->item.$id)));
            
            
                $this->db->insert('stocks_history',array('stock_id'=>md5('stock'.$grn_row->item.$id),'po_id'=>$grn_row->po,'grn_id'=>$guid,'supplier_id'=>$supplier,'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid'),'item_id'=>$grn_row->item,'quty'=>$grn_row->quty,'price'=>$price,'cost'=>$cost,'date'=>strtotime(date("Y/m/d"))));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('stocks_history',array('guid'=>  md5('stocks_history'.$grn_row->item.$id)));
        }
        }
    }
    function update_grn_items_quty($guid,$quty,$free,$items,$po_item){
        $this->db->select()->from('grn_x_items')->where('guid',$guid);        
        $sql=  $this->db->get();
      
        $old_quty;
        $old_free;
        $oquty;
        $ofree;
        $rquty;
        $rree;
        foreach ($sql->result() as $row){
           $old_free=$row->free;
      $old_quty=$row->quty;
        }
        
        $this->db->select()->from('purchase_order_items')->where('guid',$po_item);
        $po=  $this->db->get();
        foreach ($po->result() as $prow){
            $ofree=$prow->free;
           $oquty=$prow->quty;
            $rfree=$prow->received_free;
            $rquty=$prow->received_quty;
        }
       $old_received_quty=$rquty-$old_quty;
      
        $old_received_free=$rfree-$old_free;
        $current_quty=$quty+$old_received_quty;
        $current_free=$free+$old_received_free;
        if($current_quty>$oquty){
          $quty=$oquty-$old_received_quty;
        }
        if($current_free>$ofree){
            $free=$ofree-$old_received_free;
        }
        $this->db->where('guid',$guid);
        $this->db->update('grn_x_items',array('quty'=>$quty,'free'=>$free));
        $this->db->where('guid',$po_item);
        $this->db->update('purchase_order_items',array('received_quty'=>$old_received_quty+$quty,'received_free'=>$free+$old_received_free));
        
    }
    function change_grn_status($guid){
        $this->db->where('guid',$guid);
        $this->db->update('grn',array('grn_status'=>1));
    }
    function delete_grn_items($guid){
        $this->db->select()->from('grn')->where('guid',$guid);
        $grn=  $this->db->get();
        $order_id;
        foreach ($grn->result() as $row){
            $order_id= $row->po;
        }
        $this->db->select()->from('purchase_order_items')->where('order_id',$order_id);
        $po=$this->db->get();
        foreach ($po->result() as $item){
            $quty;
            $free;
            $this->db->select()->from('grn_x_items')->where('grn',$guid)->where('item',$item->item) ;
            $grn_item=  $this->db->get();
            $grn_item_guid;
            foreach ($grn_item->result() as $grn_row)
            {
                $quty=$grn_row->quty;   
                $free=$grn_row->free; 
                $grn_item_guid=$grn_row->guid; 
            }
            
           
            $this->db->where('guid',$item->guid);
            $this->db->update('purchase_order_items',array('received_quty'=>$item->received_quty-$quty,'received_free'=>$item->received_free-$free));
            $this->db->where('guid',$grn_item_guid);
            $this->db->update('grn_x_items',array('active'=>0,'active_status'=>0));
                    
        }
        
    }
    function check_approve($guid){
            $this->db->select()->from('grn')->where('guid',$guid)->where('active',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
                return FALSE;
            }else{
                return TRUE;
            }
            
    }
    function update_grn_status($po){
        $this->db->where('guid',$po);
        $this->db->update('purchase_order',array('grn_status'=>1));
                
            
    }
    
}
?>
