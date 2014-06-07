<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
        $this->db->select('decomposition_type.value as deco_value,decomposition_items.code as deco_code,items.decomposition,items.uom,items.no_of_unit,items.start_date,items.end_date,items.discount,items_setting.sales,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,stock.*')->from('stock')->where('stock.branch_id',  $this->session->userdata['branch_id'])->where('items.branch_id',$this->session->userdata['branch_id'])->where('items.active_status',1)->where('items.delete_status',1)->where('items.decomposition',1);
        
        $this->db->join('decomposition_items', "decomposition_items.guid=stock.item",'left');
        $this->db->join('decomposition_type','decomposition_type.guid=decomposition_items.type_id','left');
        $this->db->join('items', "items.guid=stock.item OR items.guid=decomposition_items.item_id ",'left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $like=array('items.active_status'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
            $this->db->or_like($like);
            $this->db->order_by('items.id');
            $this->db->limit($this->session->userdata['data_limit']);
            $sql=  $this->db->get();
            $data=array();
            foreach ($sql->result_array() as $row){                 
                   $data[]=$row;
           
            }
//            echo '<pre>';
//            print_r($data);
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
    function approve_decomposition($guid,$item_id){
        $this->db->where('guid',$guid);
        $this->db->update('decomposition',array('decomposition_status'=>1));
        $this->db->select()->from('master_data')->where('key','decomposition_items');
        $mas=  $this->db->get();
        $prefix;
        foreach ($mas->result() as $row){
            $prefix=$row->prefix ; 
            $max=$row->max;
        }
        $this->db->select()->from('decomposition_x_items')->where('decomposition_id',$guid);
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result_array() as $row){
            $this->db->select('guid')->from('decomposition_items')->where('type_id',$row['type_id'])->where('item_id',$item_id);
            $item=  $this->db->get();         
            if($item->num_rows()>0){
                foreach ($item->result() as $item_row){
                    $item_guid=$item_row->guid;
                }
                $this->db->where('guid',$item_guid);
                $this->db->update('decomposition_items',array('price'=>$row['price']));
                $this->db->select()->from('stock')->where('item',$item_guid)->where('price',$row['price']);
                $stock=  $this->db->get();
                if($stock->num_rows()>0){
                    foreach ($stock->result_array() as $s_row){
                        $this->db->where(array('item'=>$item_guid,'price'=>$row['price']));
                        $this->db->update('stock',array('quty'=>$row['quantity']+$s_row['quty']));                        
                    }
                    
                }else{
                    $item_guid=md5($j.uniqid().$guid.$row['guid']);
                    $this->db->insert('stock',array('guid'=>  md5('stock'.$item_guid.$guid.$row['guid'].$j),'item'=>$item_guid,'quty'=>$row['quantity'],'price'=>$row['price'],'branch_id'=>  $this->session->userdata('branch_id')));                    
                }
            }else{
                $j++;
                $item_guid=md5($j.uniqid().$guid.$row['guid']);
                $this->db->insert('decomposition_items',array('item_id'=>$item_id,'guid'=> $item_guid ,'code'=>$prefix."".$max,'price'=>$row['price'],'type_id'=>$row['type_id'],'branch_id'=>  $this->session->userdata('branch_id'),'added_by'=>  $this->session->userdata('guid')));
                $this->db->insert('stock',array('guid'=>  md5('stock'.$item_guid.$item_id.$guid.$row['guid'].$j),'item'=>$item_guid,'quty'=>$row['quantity'],'price'=>$row['price'],'branch_id'=>  $this->session->userdata('branch_id')));
               

            }
        }
        
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
    function search_category($search){
        $this->db->select('guid,category_name')->from('kit_category')->where('branch_id',  $this->session->userdata('branch_id'));
        $this->db->like(array('category_name'=>$search));
        $sql=  $this->db->get();
        return $sql->result();
    }
    
}
?>
