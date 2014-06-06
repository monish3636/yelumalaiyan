<?php

class Items extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('decomposition.* ,items.guid as i_guid,items.name');
             
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
         $this->db->select('decomposition.*,decomposition_x_items.guid as deco_guid,stock.quty,decomposition_type.value,decomposition_type.type_name as type,items.name,items.code as sku,items.weight as item_weight,decomposition_x_items.price,decomposition_x_items.quantity,decomposition_x_items.formula,decomposition_x_items.weight as weight,decomposition_x_items.total,decomposition_x_items.type_id')->from('decomposition')->where('decomposition.guid',$guid)->where('decomposition.branch_id',  $this->session->userdata('branch_id'));
         $this->db->join('items', 'items.guid=decomposition.item_id','left');
         $this->db->join('stock','stock.item=items.guid AND stock.guid=decomposition.stock_id','left');
         $this->db->join('decomposition_x_items', 'decomposition_x_items.decomposition_id=decomposition.guid','left');
         $this->db->join('decomposition_type','decomposition_type.guid=decomposition_x_items.type_id','left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          
       
         
          $row['date']=date('d-m-Y',$row['date']);
         
          $data[]=$row;
         }
         return $data;
     }
     function delete_decomposition_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->delete('decomposition_x_items');
     }
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('decomposition',array('decomposition_status'=>1));
        
     }
     function  check_approve($guid){
          $this->db->select()->from('decomposition')->where('guid',$guid)->where('decomposition_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
     }
    function add_decomposition($guid,$decomposition,$weight,$quantity,$formula,$price,$total,$i){         
        $this->db->insert('decomposition_x_items',array('guid'=>  md5($i.$guid.$decomposition),'price'=>$price,'weight'=>$weight,'type_id'=>$decomposition,'formula'=>$formula,'quantity'=>$quantity,'total'=>$total,'decomposition_id'=>$guid));         
    }
     function update_decomposition($deco_guid,$quty,$price,$weight,$total){
         $this->db->where('guid',$deco_guid);
         $this->db->update('decomposition_x_items',array('quantity'=>$quty,'weight'=>$weight,'price'=>$price,'total'=>$total));
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
