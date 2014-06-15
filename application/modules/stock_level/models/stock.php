<?php

class Stock extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('kit_category.category_name as kit_cat_name,stock.guid,decomposition_items.code as deco_code,items.code,items.name,item_kit.code as kit_code,item_kit.name as kit_name,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,stock.quty,stock.price')->from('stock')->where('stock.branch_id',$branch);
                $this->db->join('item_kit','item_kit.guid=stock.item','left');
                $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
                $this->db->join('decomposition_items','decomposition_items.guid=stock.item','left');
                $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
                $this->db->join('items','items.guid=stock.item  OR items.guid=decomposition_items.item_id ','left');
                $this->db->join('items_category', 'items.category_id=items_category.guid','left');
                $this->db->join('brands', 'items.brand_id=brands.guid','left');
                $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
      

                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
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
   
    function count($branch){
        $this->db->select()->from('stock')->where('branch_id',$branch);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }

    function get_stock($guid){
        $this->db->select('kit_category.category_name as kit_cat_name,stock.guid,decomposition_items.code as deco_code,items.code,items.name,item_kit.code as kit_code,item_kit.name as kit_name,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,stock.quty,stock.price')->from('stock')->where('stock.guid',$guid);
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
    function update($guid,$price){
        $this->db->where('guid',$guid);
        $this->db->update('stock',array('price'=>$price));
    }
   
    
}
?>
