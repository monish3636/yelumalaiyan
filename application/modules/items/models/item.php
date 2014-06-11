<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function category($val){
        $this->db->select('guid')->from('items_category')->where('category_name',$val)->where('branch_id',$this->session->userdata('branch_id'))->where('active_status',1);
                ;
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }else{
            $this->db->insert('items_category',array('category_name'=>$val,'branch_id'=>$this->session->userdata('branch_id')));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('items_category',array('guid'=>  md5('items_category'.$val.$id)));
            return  md5('items_category'.$val.$id);
        }
    }
    function department($val){
        $this->db->select()->from('items_department')->where('department_name',$val)->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }else{
            $this->db->insert('items_department',array('department_name'=>$val,'branch_id'=>$this->session->userdata('branch_id')));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('items_department',array('guid'=>  md5('items_department'.$val.$id)));
            return md5('items_department'.$val.$id);
        }
    }
    function brands($val){
        $this->db->select()->from('brands')->where('name',$val)->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }else{
            $this->db->insert('brands',array('name'=>$val,'branch_id'=>$this->session->userdata('branch_id')));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('brands',array('guid'=>  md5('brands'.$val.$id)));
            return md5('brands'.$val.$id);
        }
    }
    function tax($type,$val){
        $this->db->select('taxes.guid')->from('taxes')->where('taxes.value',$val)->where('tax_types.type',$type)->where('taxes.branch_id',  $this->session->userdata('branch_id'))->where('taxes.active_status',1);
        $this->db->join('tax_types','tax_types.guid=taxes.type','left');
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return  $row->guid;
            }
        }else{
            $this->db->select('guid')->from('tax_types')->where('type',$type)->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
            $this->db->limit(1);
            $sql=  $this->db->get();            
            if($sql->num_rows()>0){
                $tax_types_guid;
                foreach ($sql->result() as $type_row){
                    $tax_types_guid=$type_row->guid;
                }
                $this->db->insert('taxes',array('value'=>$val,'type'=>$tax_types_guid,'branch_id'=>  $this->session->userdata('branch_id')));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('taxes',array('guid'=>  md5('taxes'.$val.$tax_types_guid.$id)));
                return md5('taxes'.$val.$tax_types_guid.$id);
            }else{
                $this->db->insert('tax_types',array('type'=>$type,'branch_id'=>  $this->session->userdata('branch_id')));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('tax_types',array('guid'=>  md5('tax_types'.$val.$id)));     
                $tax_types_guid=md5('tax_types'.$val.$id);
                $this->db->insert('taxes',array('value'=>$val,'type'=>$tax_types_guid,'branch_id'=>  $this->session->userdata('branch_id')));
                $id=  $this->db->insert_id();
                $this->db->where('id',$id);
                $this->db->update('taxes',array('guid'=>  md5('taxes'.$val.$tax_types_guid.$id)));
                return md5('taxes'.$val.$tax_types_guid.$id);
            }
        }
    }
    function supplier($val){
        $this->db->select()->from('suppliers')->where('first_name',$val)->or_where('company_name',$val)->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }else{
            $this->db->select()->from('suppliers')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
            $this->db->limit(1);
            $sql=$this->db->get();
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }

    }
    function get_department($guid){
        $this->db->select()->from('items_department')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            return $row->department_name;
        }
    }
    function get_category($guid){
        $this->db->select()->from('items_category')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            return $row->category_name;
        }
    }
    function get_brand($guid){
        $this->db->select()->from('brands')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            return $row->name;
        }
    }
    function get_tax($guid){
        $this->db->select('taxes.value,tax_types.type as type_name')->from('taxes')->where('taxes.guid',$guid);
        $this->db->join('tax_types','tax_types.guid=taxes.type','left');
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            $data['type']=$row->type_name;
            $data['value']=$row->value;
        }
        return $data;
    }
    function get_supplier($guid){
        $this->db->select()->from('suppliers')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            return $row->first_name;
        }
                
    }
    function export_items(){
        $this->db->select()->from('items')->where('branch_id',  $this->session->userdata('branch_id'))->where('active_status',1);
        $sql=  $this->db->get();
        return $sql->result_array();
    }
        
    
}
