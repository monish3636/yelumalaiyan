<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_items(){
                $this->db->select('kit_category.category_name as kit_cat_name,stock.guid,decomposition_items.code as deco_code,items.code,items.name,item_kit.code as kit_code,item_kit.name as kit_name,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,stock.quty,stock.price')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));
                $this->db->join('item_kit','item_kit.guid=stock.item','left');
                $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
                $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
                $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
                $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
                $this->db->join('items_category', 'items.category_id=items_category.guid','left');
                $this->db->join('brands', 'items.brand_id=brands.guid','left');
                $this->db->join('items_department', 'items.depart_id=items_department.guid','left');      
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){                  
                    if($row['kit_code']!=""){
                        $row['name']=$row['kit_name'];
                        $row['c_name']=$row['kit_cat_name'];
                        $row['code']=$row['kit_code'];
                    }else if($row['deco_code']!=""){
                        $row['code']=$row['deco_code'];
                        $row['name']=$row['name'];
                    }else{
                        $row['code']=$row['code'];
                        $row['name']=$row['name'];
                    }
                    $data[]=$row;
                }
                return $data;
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
                    } 
         }
         return $data;     
    }
      function scan_items($search){
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
        $like=array('items.code'=>$search);
        $this->db->where($like);
        $this->db->or_where('items.barcode',$search);
        $this->db->or_where('items.ean_upc_code',$search);
        $this->db->or_where('decomposition_items.code',$search);
        $this->db->or_where('decomposition_items.barcode',$search);
        $this->db->or_where('item_kit.code',$search);
        $this->db->or_where('item_kit.barcode',$search);
        
        $this->db->group_by('stock.guid');
        $sql=  $this->db->get();
        $data=array();
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
                    } 
         }
       return $data; 
    }
    function add_touch_sales($guid,$item,$quty,$stock,$discount,$i,$price){         
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
    function check_duplicate($code){
        $this->db->select()->from('direct_sales')->where('code',$code)->where('branch_id',  $this->session->userdata('branch_id'));
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }
        return TRUE;
    }
    function category(){
        $this->db->select()->from('items_category')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function department(){
        $this->db->select()->from('items_department')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function brand(){
        $this->db->select()->from('brands')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function item_kit(){
        $this->db->select('item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax,item_kit.tax_amount as kit_tax_amount,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('item_kit','item_kit.guid=stock.item','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->limit($this->session->userdata['data_limit']);
        $this->db->order_by('item_kit.name','asc');
        $this->db->group_by('stock.guid');
         $sql=  $this->db->get();
         foreach ($sql->result_array() as $row){
                    if($row['kit_code']!=""){
                
                     $data[]=$row;
                    } 
         }
         return $data;  
    }
    function get_category_items($brand){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));    
        $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');      
        $where=array('items.category_id'=>$brand);
        $this->db->where($where);
        $this->db->group_by('stock.guid');
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result_array() as $row){
                    if($row['sales']==1 OR  $row['deco_code']!=""){
                  if($row['end_date'] <  strtotime(date("Y/m/d"))){
                              $row['start_date']=0;
                               $row['end_date']=0;
                             
                    }else{
                            $row['start_date']=date('d-m-Y',$row['start_date']);
                            $row['end_date']=date('d-m-Y',$row['end_date']);
                    }
                     $data[]=$row;
                    } 
         }
       return $data; 
    }
    function get_department_items($brand){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));    
        $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');      
        $where=array('items.depart_id'=>$brand);
        $this->db->where($where);
        $this->db->group_by('stock.guid');
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result_array() as $row){
                    if($row['sales']==1 OR  $row['deco_code']!=""){
                  if($row['end_date'] <  strtotime(date("Y/m/d"))){
                              $row['start_date']=0;
                               $row['end_date']=0;
                             
                    }else{
                            $row['start_date']=date('d-m-Y',$row['start_date']);
                            $row['end_date']=date('d-m-Y',$row['end_date']);
                    }
                     $data[]=$row;
                    } 
         }
       return $data; 
    }
    function get_brand_items($brand){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));    
        $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');      
        $where=array('items.brand_id'=>$brand);
        $this->db->where($where);
        $this->db->group_by('stock.guid');
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result_array() as $row){
                    if($row['sales']==1 OR  $row['deco_code']!=""){
                  if($row['end_date'] <  strtotime(date("Y/m/d"))){
                              $row['start_date']=0;
                               $row['end_date']=0;
                             
                    }else{
                            $row['start_date']=date('d-m-Y',$row['start_date']);
                            $row['end_date']=date('d-m-Y',$row['end_date']);
                    }
                     $data[]=$row;
                    } 
         }
       return $data; 
    }
    function reduce_stock($item,$quty,$price){
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

