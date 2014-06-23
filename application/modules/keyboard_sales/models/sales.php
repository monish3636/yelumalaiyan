<?php

class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
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
   
 
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('direct_sales',array('order_status'=>1));
         $this->db->select()->from('direct_sales_x_items')->where('direct_sales_id',$guid);
         $sql=  $this->db->get();
         foreach ($sql->result() as $row){
            $quty;
            $stock_id;
            $this->db->select('quty,id')->from('stock')->where('item',$row->item)->where('price',$row->price)->where('branch_id',$this->session->userdata['branch_id']);
            $stock=  $this->db->get();
            foreach ($stock->result() as $s_row){
                $quty=$s_row->quty;
                $stock_id=$s_row->id;
            }
            $this->db->where('id',$stock_id);
            $this->db->update('stock',array('quty'=>$quty-$row->quty));
         }
                 
        
     }
   
    
     function add_keyboard_sales($guid,$item,$quty,$stock,$discount,$i,$price){
         
         $this->db->insert('direct_sales_x_items',array('stock_id'=>$stock,'guid'=>  md5($i.$guid.$item),'discount'=>$discount,'price'=>$price,'item'=>$item,'quty'=>$quty,'direct_sales_id'=>$guid));
         
               
     }
   
    function payable_amount($customer_id,$guid,$amount){        
        $this->db->insert('customer_payable',array('customer_id'=>$customer_id,'invoice_id'=>$guid,'amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('customer_payable',array('guid'=>  md5($customer_id.$guid.$id."customer_payable")));
    }
    function card_payment($customer_id,$guid,$amount,$date){        
        $this->db->insert('customer_payable',array('customer_id'=>$customer_id,'invoice_id'=>$guid,'amount'=>$amount,'payment_status'=>1,'paid_amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $payable_id=  md5($customer_id.$guid.$id."customer_payable".uniqid());
        $this->db->update('customer_payable',array('guid'=>$payable_id));
        $this->db->select()->from('master_data')->where('key','customer_payment')->where('branch_id', $this->session->userdata('branch_id'));
        $sql=  $this->db->get();
        $code;
        foreach ($sql->result() as $row){
            $code=$row->prefix.$row->max;
        }
        
        $data=array('invoice_id'=>$guid,'code'=>$code,'type'=>'credit','payable_id'=>$payable_id,'customer_id'=>$customer_id,'amount'=>$amount,'payment_date'=>$date,'added_date'=>strtotime(date("Y/m/d")),'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
        $this->db->insert('payment',$data);
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('payment',array('guid'=>md5($id.$customer_id.$payable_id)));
    }
    function cash_payment($customer_id,$guid,$amount,$date,$paid){        
        $this->db->insert('customer_payable',array('customer_id'=>$customer_id,'invoice_id'=>$guid,'amount'=>$amount,'payment_status'=>0,'paid_amount'=>$paid,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $payable_id=  md5($customer_id.$guid.$id."customer_payable".uniqid());
        $this->db->update('customer_payable',array('guid'=>$payable_id));
        $this->db->select()->from('master_data')->where('key','customer_payment')->where('branch_id', $this->session->userdata('branch_id'));
        $sql=  $this->db->get();
        $code;
        foreach ($sql->result() as $row){
            $code=$row->prefix.$row->max;
        }
        
        $data=array('invoice_id'=>$guid,'code'=>$code,'type'=>'credit','payable_id'=>$payable_id,'customer_id'=>$customer_id,'amount'=>$paid,'payment_date'=>$date,'added_date'=>strtotime(date("Y/m/d")),'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
        $this->db->insert('payment',$data);
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('payment',array('guid'=>md5($id.$customer_id.$payable_id)));
    }
    
}
?>
