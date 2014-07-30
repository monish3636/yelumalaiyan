<?php
class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('sales_delivery_note.total_amt as total_amount,sales_delivery_note.guid as sdn_guid,sales_order.*,sales_delivery_note.delete_status as sales_delivery_note_delete_status,sales_delivery_note.sales_delivery_note_no,sales_delivery_note.active_status as sales_delivery_note_active_status,sales_delivery_note.guid as sales_delivery_note_guid,sales_delivery_note.sales_delivery_note_status as sales_delivery_note_active, sales_delivery_note.date as sales_delivery_note_date,sales_delivery_note.sales_delivery_note_no ,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name');
                $this->db->from('sales_delivery_note')->where('sales_order.branch_id',$branch)->where('sales_order.active_status',1)->where('sales_order.delete_status',0)->where('sales_delivery_note.delete_status',0);
                $this->db->join('sales_order', 'sales_order.guid=sales_delivery_note.so AND sales_delivery_note.delete_status=0','left');
                $this->db->join('customers', 'customers.guid=sales_order.customer_id AND sales_order.guid=sales_delivery_note.so','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                    if($row['sales_delivery_note_delete_status']==0){
                    $row['date']=date('d-m-Y',$row['date']);
                    $data[]=$row;
                    }
                }
                return $data; 
    }
    function search_sales_order($like,$branch){
        $this->db->select('sales_order.*,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('sales_order')->where('sales_order.branch_id',$branch)->where('sales_order.order_status',1)->where('sales_order.active_status',1)->where('sales_order.delete_status',0);
        $or_like=array('code'=>$like,'customers.company_name'=>$like,'customers.first_name'=>$like);
        $this->db->join('customers', 'customers.guid=sales_order.customer_id AND sales_order.order_status=1 ','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            if($row['order_status']==1){
              $row['expired']=0;
            if($row['exp_date'] < strtotime(date("Y/m/d"))){  
                $row['expired']=1;
            }
            $row['date']=date('d-m-Y',$row['date']);

            $row['exp_date']=date('d-m-Y',$row['exp_date']);

           

             $data[]=$row;
            }

        }
         return $data;
               
        
    }
   
    
    function count($branch){
        $this->db->select()->from('sales_delivery_note')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   
   /* get sales order item details
    ** function start    */
    function get_sales_order($guid){
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*,sales_items.quty ,sales_items.item as so_item_id,sales_items.stock_id ,sales_items.discount as item_discount,sales_items.price,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_order')->where('sales_order.guid',$guid);
        $this->db->join('sales_items', "sales_items.sales_order_id = sales_order.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);
            $row['date']=date('d-m-Y',$row['date']);
            $data[]=$row;
        }
        return $data;
     }
     // ** function end
    function get_sales_delivery_note($guid){
       // $this->db->select('items.uom,items.no_of_unit,sales_delivery_note.customer_discount as sdn_customer_discount,sales_delivery_note.customer_discount_amount as sdn_customer_discount_amount,sales_delivery_note.date as sales_delivery_note_date,sales_delivery_note.note as sales_delivery_note_note,sales_delivery_note.remark as sales_delivery_note_remark,sales_delivery_note.sales_delivery_note_no,items.tax_Inclusive ,sales_delivery_note.so,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*,sales_items.discount as dis_per ,sales_items.item ,sales_items.quty ,sales_items.guid as o_i_guid ,sales_items.delivered_quty ,sales_items.price ,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_delivery_note')->where('sales_delivery_note.guid',$guid)->where('sales_delivery_note.delete_status',0);
       $this->db->select('sales_delivery_note.customer_discount as sdn_customer_discount,sales_delivery_note.customer_discount_amount as sdn_customer_discount_amount,sales_delivery_note.date as sales_delivery_note_date,sales_delivery_note.note as sales_delivery_note_note,sales_delivery_note.remark as sales_delivery_note_remark,sales_delivery_note.sales_delivery_note_no,sales_delivery_note.so,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*,sales_items.discount as dis_per ,sales_items.item ,sales_items.quty ,sales_items.guid as o_i_guid ,sales_items.delivered_quty ,sales_items.price ,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_delivery_note')->where('sales_delivery_note.guid',$guid)->where('sales_delivery_note.delete_status',0);
        $this->db->join('sales_order', 'sales_delivery_note.so=sales_order.guid','left');
        $this->db->join('sales_items', "sales_items.sales_order_id = sales_order.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id ",'left');
       $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['date']=date('d-m-Y',$row['date']);       
            $row['sales_delivery_note_date']=date('d-m-Y',$row['sales_delivery_note_date']);       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);         
          //  $row['date']=date('d-m-Y',$row['date']);         
            $data[]=$row;
        }
       // echo '<pre>';
       // print_r($data);
        return $data;
     }
    
    
    function update_item_receving($items,$quty,$so,$guid){
        $where=array('sales_order_id'=>$so,'item'=>$items);
        $this->db->where($where);
        $this->db->update('sales_items',array('delivered_quty'=>$quty,'delivery_note_id'=>$guid));
     }
   
    function sdn_approve($guid,$so){
        $this->db->where('guid',$guid);
        $this->db->update('sales_delivery_note',array('sales_delivery_note_status'=>1));
        $this->db->select()->from('sales_items')->where('sales_order_id',$so);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            
            
            $item=$row->item;
            $quty=$row->quty;
            $price=$row->price;           
                $this->db->select('quty,guid,item_type')->from('stock')->where('branch_id',  $this->session->userdata("branch_id"))->where('item',$item)->where('price',$price);
                $sql=  $this->db->get();
                $guid;
                $stock;
                $item_type;
                foreach ($sql->result() as $row){
                    $guid=$row->guid;
                    $stock=$row->quty;
                    $item_type=$row->item_type;
                }
                if($item_type=='kit'){

                    $this->db->select('stock.quty as stock_quty,stock.guid as stock_id,item_kit_x_items.quty as kit_quty')->from('item_kit_x_items')->where('item_kit_x_items.item_kit_id',$item)->where('stock.branch_id',  $this->session->userdata('branch_id'));
                    $this->db->join('stock',"stock.item=item_kit_x_items.item_id AND item_kit_x_items.item_kit_id='".$item."'",'left' );
                    $kit=  $this->db->get();
                    foreach ($kit->result() as $row){
                        $stock_quty=$row->stock_quty;
                        $stock_id=$row->stock_id;
                        $kit_quty=$row->kit_quty;
                        $kit_quty=$kit_quty*$quty;
                        $this->db->where('guid',$stock_id);
                        $this->db->update('stock',array('quty'=>$stock_quty-$kit_quty));
                    }

                }else{
                    $this->db->where('guid',$guid);
                    $this->db->update('stock',array('quty'=>$stock-$quty));
                }
            }
    }
   
    function check_approve($guid){
            $this->db->select()->from('sales_delivery_note')->where('guid',$guid)->where('sales_delivery_note_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
                return FALSE;
            }else{
                return TRUE;
            }
            
    }
    function update_sales_order_status($so){
        $this->db->where('guid',$so);
        $this->db->update('sales_order',array('received_status'=>1));
    }
    
}
?>
