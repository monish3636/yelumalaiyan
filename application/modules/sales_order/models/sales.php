<?php

class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('sales_order.* ,customers.guid as s_guid,customers.first_name as s_name,customers.company_name as c_name');
             
                $this->db->from('sales_order')->where('sales_order.branch_id',$branch)->where('sales_order.delete_status',0);
                $this->db->join('customers', 'customers.guid=sales_order.customer_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
   
    function count($branch){
        $this->db->select()->from('sales_order')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }

    
    
    function search_items($search){
        $this->db->select('item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax,item_kit.tax_amount as kit_tax_amount,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('item_kit','item_kit.guid=stock.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $like=array('items.active_status'=>$search,'decomposition_items.code'=>$search,'item_kit.name'=>$search,'item_kit.code'=>$search,'item_kit.barcode'=>$search,'items.ean_upc_code'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
        $this->db->or_like($like);
        $this->db->limit($this->session->userdata['data_limit']);
        $this->db->order_by('item_kit.name','asc');
        $this->db->order_by('items.name','asc');
        $this->db->group_by('stock.guid');
         $sql=  $this->db->get();
         foreach ($sql->result_array() as $row){
                    if($row['sales']==1 OR $row['kit_code']!="" OR $row['deco_code']!=""){
                  if($row['end_date'] <  strtotime(date("Y/m/d"))){
                              $row['start_date']=0;
                               $row['end_date']=0;
                             
                    }else{
                            $row['start_date']=date('d-m-Y',$row['start_date']);
                            $row['end_date']=date('d-m-Y',$row['end_date']);
                    }
                     $data[]=$row;
                    } //$data[]=$row;
         }
          return $data;
     
     }
     function get_sales_order($guid){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.uom,items.no_of_unit,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_order.*,sales_order_x_items.quty ,sales_order_x_items.stock_id ,sales_order_x_items.discount as item_discount,sales_order_x_items.price,sales_order_x_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_order')->where('sales_order.guid',$guid);
        $this->db->join('sales_order_x_items', "sales_order_x_items.sales_order_id = sales_order.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_order_x_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_order_x_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_order_x_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
        $this->db->join('customers', "customers.guid=sales_order.customer_id  ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){  
       
          $row['exp_date']=date('d-m-Y',$row['exp_date']);
         
          $row['date']=date('d-m-Y',$row['date']);
         
          $data[]=$row;
         }
         return $data;
        
     }
     /* get sales quotation details to sale order
    function start      */
     function get_sales_quotation($guid){
        $this->db->select('items.uom,items.no_of_unit,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax_Inclusive,item_kit.tax_amount as kit_tax_amount,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,sales_quotation.*,sales_quotation_x_items.quty ,sales_quotation_x_items.stock_id ,sales_quotation_x_items.discount as item_discount,sales_quotation_x_items.price,sales_quotation_x_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('sales_quotation')->where('sales_quotation.guid',$guid);
        $this->db->join('sales_quotation_x_items', "sales_quotation_x_items.quotation_id = sales_quotation.guid  ",'left');
        $this->db->join('item_kit','item_kit.guid=sales_quotation_x_items.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('decomposition_items','decomposition_items.guid=sales_quotation_x_items.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=sales_quotation_x_items.item OR items.guid=decomposition_items.item_id",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid ",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid  ",'left');
        $this->db->join('customers', "customers.guid=sales_quotation.customer_id ",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
             
          
       
          $row['exp_date']=date('d-m-Y',$row['exp_date']);
         
          $row['date']=date('d-m-Y',$row['date']);
         
          $data[]=$row;
         }
         return $data;
     }
     /* function end*/
     function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->delete('sales_order_x_items');
     }
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('sales_order',array('order_status'=>1));
        
     }
     function  check_approve($guid){
          $this->db->select()->from('sales_order')->where('guid',$guid)->where('order_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
     }
     function add_sales_order($guid,$item,$quty,$stock,$discount,$i){
         
         $this->db->select()->from('stock')->where('guid',$stock);
         $sql=  $this->db->get();
         $price;
         foreach ($sql->result() as $row)
         {
             $price=$row->price;
         }
         $this->db->insert('sales_order_x_items',array('stock_id'=>$stock,'guid'=>  md5($i.$guid.$item),'discount'=>$discount,'price'=>$price,'item'=>$item,'quty'=>$quty,'sales_order_id'=>$guid));
         
               
     }
     function update_sales_order($guid,$quty){
         $this->db->where('guid',$guid);
         $this->db->update('sales_order_x_items',array('quty'=>$quty));
     }
    /*
     Search sales quotation 
     * function start
     *      */
     function search_sales_quotation($search){
         $this->db->select('sales_quotation.*,customers.first_name,customers.company_name,customers.address')->from('sales_quotation')->where('sales_quotation.branch_id',  $this->session->userdata('branch_id'))->where('sales_quotation.quotation_status',1)->where('sales_quotation.sales_order_status',0);
         $this->db->join('customers','customers.guid=sales_quotation.customer_id','left');
         $this->db->limit($this->session->userdata('data_limit'));
         $sql=  $this->db->get();
         $data=array();
         foreach ($sql->result() as $row){
           //  $row['date']=date('d-m-Y',$row['date']);
             $data[]=$row;
         }
         return $data;
     }
     /*
    function end    
      *   */
        function search_customers($search){
          $like=array('first_name'=>$search,'email'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
          $this->db->select('customer_category.discount,customers.*')->from('customers')->where('customers.branch_id',  $this->session->userdata('branch_id'))->where('customers.active_status',1)->where('customers.delete_status',0);
          $this->db->join('customer_category','customer_category.guid=customers.category_id  AND customers.active_status=1 AND customers.delete_status=0','left');
          $this->db->or_like($like);
          $sql=  $this->db->get();
          $data=array();
          foreach ($sql->result() as $row){
              if($row->active_status==1 && $row->delete_status==0){
                  $data[]=$row;
              }
          }
          return $data;
          
          
     }
     function approve_sales_quotation_to_sales_order($sales_quotation_guid) {
         $this->db->where('guid',$sales_quotation_guid);
         $this->db->update('sales_quotation',array('sales_order_status'=>1));
     }
}
?>
