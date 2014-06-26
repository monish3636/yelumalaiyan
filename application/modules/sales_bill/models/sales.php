<?php
class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amount as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,direct_sales.total_items as ds_total, direct_sales.code as ds_code ,direct_sales.total_amt as ds_amount,customers.first_name as s_name,customers.company_name as c_name');
                $this->db->from('sales_bill')->where('sales_bill.branch_id',$branch);
                $this->db->join('direct_sales', 'direct_sales.guid=sales_bill.direct_sales_id','left');
                $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
                $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
                $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
                $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                foreach ($query->result_array() as $row){
                   $row['date']=date('d-m-Y',$row['date']);
                   if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
                       $row['code']=$row['sdn_code'];
                       $row['total_items']=$row['so_total_items'];
                       $row['total']=$row['sdn_amount'];
                   }
                   if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
                       $row['code']=$row['dsd_code'];
                       $row['total_items']=$row['dsd_total_items'];
                       $row['total']=$row['dsd_amount'];
                   }
                   if($row['ds_code']!="" && $row['ds_code']!=NULL){
                       $row['code']=$row['ds_code'];
                       $row['total_items']=$row['ds_total'];
                       $row['total']=$row['ds_amount'];
                   }
                    $data[]=$row;
                }
              return $data; 
        
    }
    function search_sales_order($like,$branch){
        $this->db->select('sales_order.guid as sales_order_guid,sales_order.customer_id,sales_delivery_note.*,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('sales_delivery_note')->where('sales_delivery_note.bill_status',0)->where('sales_order.branch_id',$branch)->where('sales_delivery_note.active_status',1)->where('sales_delivery_note.delete_status',0);
        $or_like=array('code'=>$like,'customers.company_name'=>$like,'customers.first_name'=>$like,'sales_delivery_note.sales_delivery_note_no'=>$like);
        $this->db->join('sales_order', 'sales_order.guid=sales_delivery_note.so AND sales_delivery_note.sales_delivery_note_status=1 AND sales_delivery_note.bill_status=0','left');
        $this->db->join('customers', 'customers.guid=sales_order.customer_id AND sales_delivery_note.sales_delivery_note_status=1 AND sales_delivery_note.bill_status=0','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']/2);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            if($row['bill_status']==0){
            $row['date']=date('d-m-Y',$row['date']);
            $row['sales_delivery_note']='1';
             $data[]=$row;
            }

        }
       
        $this->db->select('direct_sales_delivery.*,direct_sales_delivery.code as sales_delivery_note_no,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('direct_sales_delivery')->where('direct_sales_delivery.branch_id',$branch)->where('direct_sales_delivery.active_status',1)->where('direct_sales_delivery.delete_status',0);
        $or_like=array('direct_sales_delivery.code'=>$like,'customers.company_name'=>$like,'customers.first_name'=>$like);
        $this->db->join('customers', 'customers.guid=direct_sales_delivery.customer_id AND direct_sales_delivery.order_status=1','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']/2);
        $sql=$this->db->get();
        foreach($sql->result_array() as $row){
             if($row['bill_status']==0){
            $row['date']=date('d-m-Y',$row['date']);
            $row['sales_delivery_note']='0';
             $data[]=$row;
             }

        }      
         return $data;              
        
    }
   
    
    function count($branch){
        $this->db->select()->from('sales_bill')->where('branch_id',$branch);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   
   
    function get_sales_order($guid,$sdn){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,sales_delivery_note.customer_discount,sales_delivery_note.customer_discount_amount,sales_delivery_note.date as sd_date,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*  ,sales_order_x_items.discount as dis_per ,sales_order_x_items.item ,sales_order_x_items.delivered_quty as quty ,sales_order_x_items.price,sales_order_x_items.guid as o_i_guid ,sales_order_x_items.guid as o_i_guid  ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_delivery_note')->where('sales_delivery_note.guid',$sdn)->where('sales_order.guid',$guid)->where('sales_order.order_status',1);
        $this->db->join('sales_order', 'sales_order.guid = sales_delivery_note.so ','left');
        $this->db->join('sales_order_x_items', 'sales_order_x_items.sales_order_id = sales_order.guid ','left');
        $this->db->join('item_kit','item_kit.guid=sales_order_x_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_order_x_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_order_x_items.item OR items.guid=decomposition_items.item_id",'left'); 
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_order_x_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_order_x_items.item ",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id AND sales_order_x_items.sales_order_id='".$guid."' ",'left');
       
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
                         
            $row['sd_date']=date('d-m-Y',$row['sd_date']);         
            $data[]=$row;
        }
        return $data;
     }
    function get_direct_delivery_note($guid){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,direct_sales_delivery.customer_discount,direct_sales_delivery.customer_discount_amount,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,direct_sales_delivery.*,direct_sales_delivery_x_items.quty ,direct_sales_delivery_x_items.stock_id ,direct_sales_delivery_x_items.discount as item_discount,direct_sales_delivery_x_items.price,direct_sales_delivery_x_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_sales_delivery')->where('direct_sales_delivery.guid',$guid);
        $this->db->join('direct_sales_delivery_x_items', "direct_sales_delivery_x_items.direct_sales_delivery_id = direct_sales_delivery.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=direct_sales_delivery_x_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=direct_sales_delivery_x_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=direct_sales_delivery_x_items.item OR items.guid=decomposition_items.item_id",'left'); 
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=direct_sales_delivery_x_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=direct_sales_delivery_x_items.item  ",'left');
        $this->db->join('customers', "customers.guid=direct_sales_delivery.customer_id AND direct_sales_delivery_x_items.direct_sales_delivery_id='".$guid."'  ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['date']=date('d-m-Y',$row['date']);         
            $data[]=$row;
        }
        return $data;
    }
    function get_sales_bill($guid){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,sales_delivery_note.date as sales_delivery_note_date,sales_delivery_note.note as sales_delivery_note_note,sales_delivery_note.remark as sales_delivery_note_remark,sales_delivery_note.sales_delivery_note_no,items.tax_Inclusive ,sales_delivery_note.so,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*,sales_order_x_items.discount as dis_per ,sales_order_x_items.item ,sales_order_x_items.quty ,sales_order_x_items.guid as o_i_guid ,sales_order_x_items.delivered_quty ,sales_order_x_items.price ,sales_order_x_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_delivery_note')->where('sales_delivery_note.guid',$guid)->where('sales_delivery_note.delete_status',0);
        $this->db->join('sales_order', 'sales_delivery_note.so=sales_order.guid','left');      
        $this->db->join('sales_order_x_items', 'sales_order_x_items.sales_order_id = sales_order.guid  ','left');
        $this->db->join('item_kit','item_kit.guid=sales_order_x_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_order_x_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_order_x_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_order_x_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_order_x_items.item  ",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id AND sales_order_x_items.sales_order_id=sales_order.guid  ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['date']=date('d-m-Y',$row['date']);       
            $row['sales_delivery_note_date']=date('d-m-Y',$row['sales_delivery_note_date']);       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);         
            $data[]=$row;
        }
        return $data;
     }
    function update_direct_sales_delivery_note($so){
        $this->db->where('guid',$so);
        $this->db->update('direct_sales_delivery',array('bill_status'=>1));
            
    }
    function update_sales_delivery_note($so){
        $this->db->where('guid',$so);
        $this->db->update('sales_delivery_note',array('bill_status'=>1));            
    }
  
  
    function direct_delivery_payable_amount($grn,$invoice){
        $this->db->select('total_amt,customer_id')->from('direct_sales_delivery')->where('guid',$grn);
        $sql=  $this->db->get();
        $amount;
        $customer_id;
        foreach ($sql->result() as $row){
            $amount=$row->total_amt;
            $customer_id=$row->customer_id;
        }
        $this->db->insert('customer_payable',array('customer_id'=>$customer_id,'invoice_id'=>$invoice,'amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('customer_payable',array('guid'=>  md5($customer_id.$invoice.$id."customer_payable")));
    }
    function delivery_payable_amount($customer_id,$sdn_guid,$guid){
        $this->db->select('total_amount')->from('sales_delivery_note')->where('guid',$sdn_guid);
        $sql=  $this->db->get();
        $amount;
        foreach ($sql->result() as $row){
            $amount=$row->total_amount;
        }
        $this->db->insert('customer_payable',array('customer_id'=>$customer_id,'invoice_id'=>$guid,'amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('customer_payable',array('guid'=>  md5($customer_id.$guid.$id."customer_payable")));
    }
    
}
?>
