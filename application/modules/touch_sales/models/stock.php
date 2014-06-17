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
                   // $row['date']=date('d-m-Y',$row['date']);
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
                    } //$data[]=$row;
         }
          return $data;     
    }
    
    
}

