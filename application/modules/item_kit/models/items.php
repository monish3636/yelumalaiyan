<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Items extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('item_kit.*');             
                $this->db->from('item_kit')->where('item_kit.branch_id',$branch)->where('item_kit.delete_status',0);
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                    $row['tax_value']="$row[tax_value]%";
                    $data[]=$row;
                }
                return $data;         
    }
   
    function count($branch){
        $this->db->select()->from('item_kit')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    
    function search_items($search){
        $this->db->select('decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.tax_id,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,items.decomposition,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata['branch_id'])->where('items.branch_id',$this->session->userdata['branch_id'])->where('items.active_status',1)->where('items.delete_status',1)->where('items.decomposition',1);
        $this->db->join('decomposition_items', "decomposition_items.guid=stock.item",'left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=stock.item OR items.guid=decomposition_items.item_id ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $like=array('items.active_status'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
            $this->db->or_like($like);
            $this->db->order_by('items.id');
            $this->db->group_by('stock.guid');
            $this->db->limit($this->session->userdata['data_limit']);
            $sql=  $this->db->get();
            $data=array();
            foreach ($sql->result_array() as $row){                 
                   $data[]=$row;
           
            }
       return $data;     
     }
    function get_item_kit($guid){
        $this->db->select('item_kit.tax_id as kit_tax_id,item_kit.tax_value as kit_tax_value,item_kit.tax_type as kit_tax_type,item_kit.category_id as kit_category_id,kit_category.category_name as kit_category_name,item_kit.note,item_kit.remark,item_kit.no_of_items,item_kit.kit_price,item_kit.tax_inclusive as kit_tax_inclusive,item_kit.tax_amount,item_kit.selling_price,item_kit.code as item_kit_code,item_kit.item_total,item_kit.name as item_kit_name, item_kit_x_items.quty as kit_quty,item_kit_x_items.stock_id as kit_stock_id,item_kit_x_items.item_id as kit_item_id,decomposition_items.guid as deco_guid,decomposition_items.tax_inclusive as deco_tax ,decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.tax_id,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,items.decomposition,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,stock.*')->from('item_kit')->where('item_kit.guid',$guid)->where('item_kit.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('item_kit_x_items', 'item_kit_x_items.item_kit_id=item_kit.guid','left');
        $this->db->join('kit_category','kit_category.guid=item_kit.category_id','left');
        $this->db->join('stock','stock.guid=item_kit_x_items.stock_id','left');
        $this->db->join('decomposition_items', "decomposition_items.guid=stock.item AND decomposition_items.guid=item_kit_x_items.item_id",'left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=stock.item OR items.guid=decomposition_items.item_id ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id','left');
        $this->db->join('taxes', "taxes.guid=items.tax_id AND items.guid=stock.item OR taxes.guid=items.tax_id AND items.guid=decomposition_items.item_id OR taxes.guid=item_kit.tax_id",'left');
        $this->db->join('tax_types', "tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=stock.item OR tax_types.guid=taxes.type AND items.tax_id=taxes.guid AND items.guid=decomposition_items.item_id",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
    
         $data[]=$row;
        }
        return $data;
    }
    function delete_item_kit_item($guid){      
        $this->db->where('guid',$guid);
        $this->db->delete('item_kit_x_items');
    }
   
    
    function add_item_kit($guid,$item,$quty,$stock,$i){         
        $this->db->insert('item_kit_x_items',array('guid'=>  md5($i.$guid.uniqid()),'item_id'=>$item,'quty'=>$quty,'stock_id'=>$stock,'item_kit_id'=>$guid));         
    }
    function update_item_kit($guid,$item,$quty){
        $this->db->where(array('item_kit_id'=>$guid,'item_id'=>$item));
        $this->db->update('item_kit_x_items',array('quty'=>$quty));
    }

    function search_decomposition_type($search){
        $this->db->select()->from('decomposition_type')->where('branch_id',  $this->session->userdata('branch_id'));
        $this->db->like(array('type_name'=>$search,'value'=>$search));
        $this->db->limit($this->session->userdata('data_limit'));
        $sql=  $this->db->get();
        return $sql->result();
    }
    function search_category($search){
        $this->db->select('guid,category_name')->from('kit_category')->where('branch_id',  $this->session->userdata('branch_id'));
        $this->db->like(array('category_name'=>$search));
        $sql=  $this->db->get();
        return $sql->result();
    }
    function add_kit_to_stock($guid,$selling_price){
        $this->db->insert('stock',array('item'=>$guid,'item_type'=>'kit','price'=>$selling_price,'branch_id'=>  $this->session->userdata('branch_id')));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('stock',array('guid'=>  md5('item_kit'.$guid.$id.$this->session->userdata('branch_id'))));
    }
    function update_kit_in_stock($guid,$selling_price){
        $this->db->where('item',$guid);
        $this->db->update('stock',array('price'=>$selling_price));
    }
    
}
?>
