<?php
class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amt as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,customers.first_name as s_name,customers.company_name as c_name');
                $this->db->from('sales_bill')->where('sales_bill.branch_id',$branch);
                $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
                $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
                $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
                $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                   $row['date']=date('d-m-Y',$row['date']);
                   if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
                       $row['code']=$row['sdn_code'];
                       $row['total_items']=$row['so_total_items'];
                       $row['total']=$row['sdn_amount'];
                        $data[]=$row;
                   }
                   if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
                       $row['code']=$row['dsd_code'];
                       $row['total_items']=$row['dsd_total_items'];
                       $row['total']=$row['dsd_amount'];
                        $data[]=$row;
                   }
                  
                   
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
     
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,sales_delivery_note.customer_discount,sales_delivery_note.customer_discount_amount,sales_delivery_note.date as sd_date,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*  ,sales_items.discount as dis_per ,sales_items.item ,sales_items.delivered_quty as quty ,sales_items.price,sales_items.guid as o_i_guid ,sales_items.guid as o_i_guid  ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_delivery_note')->where('sales_delivery_note.guid',$sdn)->where('sales_order.guid',$guid)->where('sales_order.order_status',1);
        $this->db->join('sales_order', 'sales_order.guid = sales_delivery_note.so ','left');
        $this->db->join('sales_items', 'sales_items.sales_order_id = sales_order.guid ','left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left'); 
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_items.item ",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id AND sales_items.sales_order_id='".$guid."' ",'left');
       
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
                         
            $row['sd_date']=date('d-m-Y',$row['sd_date']);         
            $data[]=$row;
        }
         return $data;
     }
    function get_direct_delivery_note($guid){
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,direct_sales_delivery.customer_discount,direct_sales_delivery.customer_discount_amount,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,direct_sales_delivery.*,sales_items.quty ,sales_items.stock_id ,sales_items.discount as item_discount,sales_items.price,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_sales_delivery')->where('direct_sales_delivery.guid',$guid);
        $this->db->join('sales_items', "sales_items.direct_sales_delivery_id = direct_sales_delivery.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left'); 
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_items.item  ",'left');
        $this->db->join('customers', "customers.guid=direct_sales_delivery.customer_id AND sales_items.direct_sales_delivery_id='".$guid."'  ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['date']=date('d-m-Y',$row['date']);         
            $data[]=$row;
        }
        return $data;
    }
    function get_sales_bill($guid){
        $this->db->select('direct_sales_delivery.date as dsd_date,sales_delivery_note.date as sdn_date,direct_sales_delivery.round_amt as dsd_round_amount, direct_sales_delivery.freight as dsd_freight,direct_sales_delivery.customer_discount as dsd_customer_discount, 	direct_sales_delivery.customer_discount_amount as dsd_customer_discount_amount,direct_sales_delivery.discount as dsd_discount,  direct_sales_delivery.discount_amt as dsd_discount_amt,sales_delivery_note.customer_discount  as sdn_customer_amount,sales_delivery_note.customer_discount_amount as sdn_customer_discount_amount, sales_order.freight as so_freight,sales_order.discount as so_discount,sales_order.discount_amt as so_discount_amt,sales_order.round_amt as so_round_amt,  , items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_items.quty ,sales_items.item as so_item_id,sales_items.stock_id ,sales_items.discount as item_discount,sales_items.price,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code,sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amt as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('sales_bill')->where('sales_bill.guid',$guid);
        $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
        $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
        $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
        $this->db->join('sales_items', "sales_items.invoice_id = sales_bill.guid ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid",'left');
        $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
        
        $query=$this->db->get();
        $data=array();
        foreach ($query->result_array() as $row){
           $row['date']=date('d-m-Y',$row['date']);
           if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
               $row['dn_code']=$row['sdn_code'];
                $row['total_items']=$row['so_total_items'];
                $row['total_amt']=$row['sdn_amount'];
                
                $row['freight']=$row['so_freight'];
                $row['discount']=$row['so_discount'];
                $row['discount_amt']=$row['so_discount_amt'];
                $row['round_amt']=$row['so_round_amt'];
                $row['customer_discount']=$row['sdn_customer_amount'];
                $row['customer_discount_amount']=$row['sdn_customer_discount_amount'];
                $row['dn_date']=date('d-m-Y',$row['sdn_date']);
           }
           if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
                $row['dn_date']=date('d-m-Y',$row['dsd_date']);
                $row['dn_code']=$row['dsd_code'];
                $row['total_items']=$row['dsd_total_items'];
                $row['total_amt']=$row['dsd_amount'];

                $row['freight']=$row['dsd_freight'];
                $row['discount']=$row['dsd_discount'];
                $row['discount_amt']=$row['dsd_discount_amt'];
                $row['round_amt']=$row['dsd_round_amount'];
                $row['customer_discount']=$row['dsd_customer_discount'];
                $row['customer_discount_amount']=$row['dsd_customer_discount_amount'];
           }
            $data[]=$row;
        }
        return $data;
     }
    function sales_bill_invoice($guid){
        $this->db->select('sales_delivery_note.id as sdn_id,direct_sales_delivery.id as dsd_id,customers.email as customer_email,customers.phone as customer_phone,customers.city as customer_city,customers.state as customer_state,customers.country as customer_country,customers.zip as customer_zip,branches.code as branch_code,branches.store_name as branch_name,branches.address as branch_address,branches.city as branch_city,branches.state as branch_state,branches.zip as branch_zip ,branches.country as branch_country,branches.phone as branch_phone,branches.email as branch_mail,direct_sales_delivery.date as dsd_date,sales_delivery_note.date as sdn_date,direct_sales_delivery.round_amt as dsd_round_amount, direct_sales_delivery.freight as dsd_freight,direct_sales_delivery.customer_discount as dsd_customer_discount, 	direct_sales_delivery.customer_discount_amount as dsd_customer_discount_amount,direct_sales_delivery.discount as dsd_discount,  direct_sales_delivery.discount_amt as dsd_discount_amt,sales_delivery_note.customer_discount  as sdn_customer_amount,sales_delivery_note.customer_discount_amount as sdn_customer_discount_amount, sales_order.freight as so_freight,sales_order.discount as so_discount,sales_order.discount_amt as so_discount_amt,sales_order.round_amt as so_round_amt,  , items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_items.quty ,sales_items.item as so_item_id,sales_items.stock_id ,sales_items.discount as item_discount,sales_items.price,sales_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code,sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amt as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('sales_bill')->where('sales_bill.guid',$guid);
        $this->db->join('branches', "branches.guid = sales_bill.branch_id ",'left');
        $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
        $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
        $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
        $this->db->join('sales_items', "sales_items.invoice_id = sales_bill.guid ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid",'left');
        $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
        
        $query=$this->db->get();
        $data=array();
        foreach ($query->result_array() as $row){
           $row['date']=date('d-m-Y',$row['date']);
           if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
                $row['dn_id']=$row['sdn_id'];
                $row['dn_code']=$row['sdn_code'];
                $row['total_items']=$row['so_total_items'];
                $row['total_amt']=$row['sdn_amount'];
                
                $row['freight']=$row['so_freight'];
                $row['discount']=$row['so_discount'];
                $row['discount_amt']=$row['so_discount_amt'];
                $row['round_amt']=$row['so_round_amt'];
                $row['customer_discount']=$row['sdn_customer_amount'];
                $row['customer_discount_amount']=$row['sdn_customer_discount_amount'];
                $row['dn_date']=date('d-m-Y',$row['sdn_date']);
           }
           if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
                $row['dn_id']=$row['dsd_id'];
                $row['dn_date']=date('d-m-Y',$row['dsd_date']);
                $row['dn_code']=$row['dsd_code'];
                $row['total_items']=$row['dsd_total_items'];
                $row['total_amt']=$row['dsd_amount'];

                $row['freight']=$row['dsd_freight'];
                $row['discount']=$row['dsd_discount'];
                $row['discount_amt']=$row['dsd_discount_amt'];
                $row['round_amt']=$row['dsd_round_amount'];
                $row['customer_discount']=$row['dsd_customer_discount'];
                $row['customer_discount_amount']=$row['dsd_customer_discount_amount'];
           }
            $data[]=$row;
        }
        return $data;
     }
    function update_direct_sales_delivery_note($so,$invoice){
        $this->db->where('guid',$so);
        $this->db->update('direct_sales_delivery',array('bill_status'=>1));
        $this->db->where('direct_sales_delivery_id',$so);
        $this->db->update('sales_items',array('invoice_id'=>$invoice,'time'=>strtotime(date('H:i:s')),'branch_id'=>$this->session->userdata('branch_id')));
            
    }
    function update_sales_delivery_note($so,$invoice){
        $this->db->where('guid',$so);
        $this->db->update('sales_delivery_note',array('bill_status'=>1));   
        $this->db->where('delivery_note_id',$so);
        $this->db->update('sales_items',array('invoice_id'=>$invoice,'time'=>strtotime(date('H:i:s')),'branch_id'=>$this->session->userdata('branch_id')));
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
