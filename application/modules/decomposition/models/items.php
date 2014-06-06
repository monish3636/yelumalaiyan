<?php

class Items extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('decomposition.* ,items.guid as i_guid');
             
                $this->db->from('decomposition')->where('decomposition.branch_id',$branch)->where('decomposition.delete_status',0);
                $this->db->join('items', 'items.guid=decomposition.item_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
   
    function count($branch){
        $this->db->select()->from('decomposition')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   

    
    function search_items($search){
         $this->db->select('items.decomposition,items.weight,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata['branch_id'])->where('items.branch_id',$this->session->userdata['branch_id'])->where('items.active_status',1)->where('items.delete_status',1)->where('items.decomposition',1);
         $this->db->join('items', "items.guid=stock.item ",'left');
         $this->db->join('items_category', 'items.category_id=items_category.guid','left');
         $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=stock.item ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=stock.item ",'left');
         $this->db->join('brands', 'items.brand_id=brands.guid','left');
         $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
         $like=array('items.active_status'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);
                $this->db->limit($this->session->userdata['data_limit']);
                $sql=  $this->db->get();
                $data=array();
                foreach ($sql->result_array() as $row){
                   if($row['decomposition']==1){
                  
                       $data[]=$row;
                    }
               
                   // print_r($row);
                }
              
         
        return $data;
     
     }
     function get_decomposition($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,customers.guid as c_guid,customers.first_name as s_name,customers.company_name as c_name,customers.address as address,decomposition.*,decomposition_x_items.quty ,decomposition_x_items.stock_id ,decomposition_x_items.discount as item_discount,decomposition_x_items.price,decomposition_x_items.guid as o_i_guid ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('decomposition')->where('decomposition.guid',$guid);
         $this->db->join('decomposition_x_items', "decomposition_x_items.quotation_id = decomposition.guid  ",'left');
         $this->db->join('items', "items.guid=decomposition_x_items.item AND decomposition_x_items.quotation_id='".$guid."' ",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=decomposition_x_items.item  ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=decomposition_x_items.item  ",'left');
         $this->db->join('customers', "customers.guid=decomposition.item_id AND decomposition_x_items.quotation_id='".$guid."'  ",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          
       
          $row['exp_date']=date('d-m-Y',$row['exp_date']);
         
          $row['date']=date('d-m-Y',$row['date']);
         
          $data[]=$row;
         }
         return $data;
     }
     function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->delete('decomposition_x_items');
     }
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('decomposition',array('quotation_status'=>1));
        
     }
     function  check_approve($guid){
          $this->db->select()->from('decomposition')->where('guid',$guid)->where('quotation_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
     }
    function add_decomposition($guid,$decomposition,$weight,$quantity,$formula,$price,$total,$i){         
        $this->db->insert('decomposition_x_items',array('guid'=>  md5($i.$guid.$decomposition),'price'=>$price,'weight'=>$weight,'type_id'=>$decomposition,'formula'=>$formula,'quantity'=>$quantity,'decomposition_id'=>$guid));         
    }
     function update_quotation($guid,$quty){
         $this->db->where('guid',$guid);
         $this->db->update('decomposition_x_items',array('quty'=>$quty));
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
     function search_decomposition_type($search){
         $this->db->select()->from('decomposition_type')->where('branch_id',  $this->session->userdata('branch_id'));
         $this->db->like(array('type_name'=>$search,'value'=>$search));
         $this->db->limit($this->session->userdata('data_limit'));
         $sql=  $this->db->get();
         return $sql->result();
     }
    
}
?>
