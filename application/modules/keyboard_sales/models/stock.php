<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    /** search customer details*/
    // function start
    function search_customers($search){
        $like=array('first_name'=>$search,'email'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
        $this->db->select('customer_category.discount,customers.*')->from('customers')->where('customers.branch_id',  $this->session->userdata('branch_id'))->where('customers.active_status',1)->where('customers.delete_status',0);
        $this->db->join('customer_category','customer_category.guid=customers.category_id  AND customers.active_status=1 AND customers.delete_status=0','left');
        $this->db->or_like($like);
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result() as $row){
            if($row->active_status==1 && $row->delete_status==0){ // check customer is active or incative
                $data[]=$row;
            }
        }
        return $data;
    }
    /* function end*/
    
    /* search item details
    function start     */
    function search_items($search){
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax,item_kit.tax_amount as kit_tax_amount,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));
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
    /* item search function end*/
    
    function get_items($search){
        $this->db->select('items.tax_inclusive2,items.tax2_type,items.tax2_value,item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,kit_category.category_name as kit_category,item_kit.no_of_items,item_kit.guid as kit_guid,item_kit.code as kit_code,item_kit.name as kit_name,item_kit.selling_price as kit_price,item_kit.tax_inclusive as kit_tax,item_kit.tax_amount as kit_tax_amount,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata('branch_id'));
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
        //$like=array('decomposition_items.code'=>$search,'decomposition_items.barcode'=>$search,'item_kit.code'=>$search,'item_kit.barcode'=>$search,'items.ean_upc_code'=>$search,'items.code'=>$search);
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
                    } //$data[]=$row;
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

