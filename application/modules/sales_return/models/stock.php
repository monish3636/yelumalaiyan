<?php

class Stock extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
        $this->db->select()->from('sales_return')->where('branch_id',$branch)->where('delete_status',0);
        $this->db->limit($end,$start); 
        $this->db->or_like($like);     
        $query=$this->db->get();
        $data=array();
        foreach ($query->result_array() as $row){
            $row['date']=date('d-m-Y',$row['date']);
            $data[]=$row;
        }
        return $data;
    }
   
    function count($branch){
        $this->db->select()->from('sales_return')->where('branch_id',$branch)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }

    function update_sales_return($guid,$item,$quty,$sell,$tax,$tax2,$net){
        $this->db->where(array('sales_return_id'=>$guid,'item'=>$item));
        $item_value=array('tax'=>$tax,'tax2'=>$tax2,'quty'=>$quty,'sell'=>$sell,'amount'=>$net);
        $this->db->update('sales_return_x_items',$item_value);
         
    }
    function add_sales_return($guid,$item,$quty,$sell,$tax,$tax2,$net){
        $item_value=array('sales_return_id'=>$guid,'tax'=>$tax,'tax2'=>$tax2,'item'=>$item,'quty'=>$quty,'sell'=>$sell,'amount'=>$net);
        $this->db->insert('sales_return_x_items',$item_value);
        $os_item=  $this->db->insert_id();
        $this->db->where('id',$os_item);
        $this->db->update('sales_return_x_items',array('guid'=>md5('sales_return_x_items'.$item.$os_item)));
    }
    
    function search_items($search,$bill){
        $data=array();         
        $this->db->select('sales_items.discount as item_discount,items.tax_inclusive2,items.tax2_type,items.tax2_value,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,sales_bill.invoice,sales_items.price as price,sales_items.quty as quty,sales_items.delivered_quty,sales_items.item as so_item,items.code,items.uom,items.no_of_unit,items_setting.sales_return,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id')->from('sales_bill')->where('sales_bill.guid',$bill)->where('sales_bill.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('sales_items', 'sales_items.sales_order_id=sales_bill.so OR sales_items.direct_sales_delivery_id=sales_bill.sdn OR sales_items.direct_sales_id=sales_bill.direct_sales_id','left');
        $this->db->join('item_kit','item_kit.guid=sales_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_items.item ','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_items.item OR items.guid=decomposition_items.item_id ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
            $like=array('items.active_status'=>$search,'decomposition_items.code'=>$search,'item_kit.name'=>$search,'item_kit.code'=>$search,'item_kit.barcode'=>$search,'items.ean_upc_code'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
            $sql=$this->db->get();           
            foreach ($sql->result_array() as $row){
                if($row['delivered_quty']!="" && $row['delivered_quty']!=0){
                    $row['quty']=$row['delivered_quty'];
                }      
                $data[]=$row;             
            }
        return $data;
    }
    function get_sales_return($guid){
        $this->db->select('sales_items.discount as item_discount,items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_inclusive2,items.tax2_type,items.tax2_value, decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,sales_bill.invoice,sales_items.delivered_quty as so_quty ,sales_items.quty as ordered_quty,customers.first_name,sales_bill.date as sales_date,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,sales_return_x_items.quty as item_limit,sales_return.*,sales_return_x_items.tax as order_tax,sales_return_x_items.item ,sales_return_x_items.quty ,sales_return_x_items.sell ,sales_return_x_items.guid as o_i_guid ,sales_return_x_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_return')->where('sales_return.guid',$guid);
        $this->db->join('sales_bill',"sales_bill.guid=sales_return.sales_bill_id AND sales_return.guid ='".$guid."'",'left');       
        $this->db->join('sales_return_x_items', "sales_return_x_items.sales_return_id = sales_return.guid  AND sales_return_x_items.sales_return_id ='".$guid."'",'left');
        $this->db->join('sales_items', "sales_items.item=sales_return_x_items.item AND sales_items.invoice_id=sales_bill.guid AND sales_return_x_items.sales_return_id ='".$guid."'",'left');     
        $this->db->join('customers','customers.guid=sales_bill.customer_id','left');
        $this->db->join('item_kit','item_kit.guid=sales_return_x_items.item  ','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_return_x_items.item ','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_return_x_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_return_x_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_return_x_items.item  ",'left');
      
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['date']=date('d-m-Y',$row['date']);
            $row['sales_date']=date('d-m-Y',$row['sales_date']);
            if($row['so_quty']!="" && $row['so_quty']!=0){
                $row['item_limit']=$row['so_quty'];
            }else{
                $row['item_limit']=$row['ordered_quty'];
            }      
                
          $data[]=$row;
        }
      
        return $data;
    }
    function sales_return_invoice($guid){
        $this->db->select('sales_bill.id as bill_id,customers.email as customer_email,customers.phone as customer_phone,customers.city as customer_city,customers.state as customer_state,customers.country as customer_country,customers.zip as customer_zip,branches.code as branch_code,branches.store_name as branch_name,branches.address as branch_address,branches.city as branch_city,branches.state as branch_state,branches.zip as branch_zip ,branches.country as branch_country,branches.phone as branch_phone,branches.email as branch_mail,sales_items.discount as item_discount,items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_inclusive2,items.tax2_type,items.tax2_value, decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,sales_bill.invoice,sales_items.delivered_quty as so_quty ,sales_items.quty as ordered_quty,customers.first_name,sales_bill.date as sales_date,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,sales_return_x_items.quty as item_limit,sales_return.*,sales_return_x_items.tax as order_tax,sales_return_x_items.item ,sales_return_x_items.quty ,sales_return_x_items.sell ,sales_return_x_items.guid as o_i_guid ,sales_return_x_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_return')->where('sales_return.guid',$guid);
        $this->db->join('sales_bill',"sales_bill.guid=sales_return.sales_bill_id AND sales_return.guid ='".$guid."'",'left');  
        $this->db->join('branches', "branches.guid = sales_bill.branch_id ",'left');
        $this->db->join('sales_return_x_items', "sales_return_x_items.sales_return_id = sales_return.guid  AND sales_return_x_items.sales_return_id ='".$guid."'",'left');
        $this->db->join('sales_items', "sales_items.item=sales_return_x_items.item AND sales_items.invoice_id=sales_bill.guid AND sales_return_x_items.sales_return_id ='".$guid."'",'left');     
        $this->db->join('customers','customers.guid=sales_bill.customer_id','left');
        $this->db->join('item_kit','item_kit.guid=sales_return_x_items.item  ','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_return_x_items.item ','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_return_x_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=sales_return_x_items.item  ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=sales_return_x_items.item  ",'left');
      
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['date']=date('d-m-Y',$row['date']);
            $row['sales_date']=date('d-m-Y',$row['sales_date']);
            if($row['so_quty']!="" && $row['so_quty']!=0){
                $row['item_limit']=$row['so_quty'];
            }else{
                $row['item_limit']=$row['ordered_quty'];
            }      
                
          $data[]=$row;
        }
      
        return $data;
    }
    function delete_order_item($guid){      
        $this->db->where('guid',$guid);
        $this->db->delete('sales_return_x_items');
    }
    function sales_return_approve($guid){
        $this->db->select('items.no_of_unit,sales_return_x_items.*')->from('sales_return_x_items')->where('sales_return_x_items.sales_return_id',$guid);
        $this->db->join('items','items.guid=sales_return_x_items.item','left');
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            $price=$row->sell;
            $quty=$row->quty;
            $item=$row->item;
            $no_of_unit=$row->no_of_unit;
            if($no_of_unit==0){
                $no_of_unit=1;
            }
            $this->db->select('stock.quty,stock.guid')->from('stock')->where('item',$item)->where('price',$price*$no_of_unit);
            $sql_order=  $this->db->get();            
            $stock_quty;
            $stock_id;
            foreach ($sql_order->result() as $stock){
                $stock_quty=  $stock->quty;
                $stock_id=$stock->guid;
            }
            $this->db->where('guid',$stock_id);
            $this->db->update('stock',array('quty'=>$stock_quty-$quty));               
        }         
        $this->db->where('guid',$guid);
        $this->db->update('sales_return',array('stock_status'=>1)); 
    }
    function  check_approve($guid){
        $this->db->select()->from('sales_return')->where('guid',$guid)->where('stock_status',1);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function search_sales_bill($search){
        $this->db->select('sales_bill.*,customers.first_name,customers.company_name')->from('sales_bill')->where('sales_bill.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('customers', 'customers.guid=sales_bill.customer_id','left');
        $like=array('invoice'=>$search,'first_name'=>$search,'company_name'=>$search);       
        $this->db->or_like($like);
        $this->db->limit($this->session->userdata('data_limit'));
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
        $row['date']=date('d-m-Y',$row['date']);
            $data[]=$row;
        }
        return $data;
    }
    
}
?>
