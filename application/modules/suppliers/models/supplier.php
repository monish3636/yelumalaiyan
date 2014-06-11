<?php

class Supplier extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('suppliers.* ,suppliers_category.guid as c_guid,suppliers_category.category_name as c_name')->from('suppliers')->where('suppliers.branch_id',$branch)->where('suppliers.delete_status',0);
                $this->db->join('suppliers_category', 'suppliers.category=suppliers_category.guid','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
    function edit_supplier($guid){
                $this->db->select('suppliers.* ,suppliers_category.category_name as c_name,supplier_contacts.guid as c_guid,supplier_contacts.address as c_address,supplier_contacts.city as c_city,supplier_contacts.state as c_state,supplier_contacts.country as c_country,supplier_contacts.zip as c_zip ,supplier_contacts.email as c_email,supplier_contacts.phone as c_phone')->from('suppliers')->where('suppliers.guid',$guid);
                $this->db->join('supplier_contacts', 'supplier_contacts.supplier=suppliers.guid','left');
                $this->db->join('suppliers_category', 'suppliers.category=suppliers_category.guid','left');
                   
                $query=$this->db->get();
                return $query->result(); 
    }
    function add_contact($guid,$address,$city,$state,$country,$zip,$email,$phone){
        $this->db->insert('supplier_contacts',array('supplier'=>$guid,'address'=>$address,'city'=>$city,'state'=>$state,'country'=>$country,'zip'=>$zip,'email'=>$email,'phone'=>$phone));
        $id=$this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('supplier_contacts',array('guid'=>  md5('supplier_conatct'.$id)));
    }
    function update_suplier_contact($guid,$address,$city,$state,$country,$zip,$phone,$email){
        $this->db->where('guid',$guid);
        $this->db->update('suppliers',array('address1'=>$address,'city'=>$city,'state'=>$state,'zip'=>$zip,'country'=>$country,'email'=>$email,'phone'=>$phone));
    }
    function delete_conatct($guid){
        $this->db->where('supplier',$guid);
        $this->db->delete('supplier_contacts');
    }
    function category($val){
        $this->db->select('guid')->from('suppliers_category')->where('category_name',$val)->where('branch_id',$this->session->userdata('branch_id'))->where('active_status',1);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            foreach ($sql->result() as $row){
                return $row->guid;
            }
        }else{
            $this->db->insert('suppliers_category',array('category_name'=>$val,'branch_id'=>$this->session->userdata('branch_id')));
            $id=  $this->db->insert_id();
            $this->db->where('id',$id);
            $this->db->update('suppliers_category',array('guid'=>  md5('suppliers_category'.$val.$id)));
            return  md5('suppliers_category'.$val.$id);
        }
    }
    function get_suplier($guid){
        $this->db->select()->from('suppliers')->where('guid',$guid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            return $row->first_name;
        }
    }
    function export_supplier(){
        $this->db->select()->from('suppliers')->where('active_status',1);
        $sql=  $this->db->get();
        return $sql->result_array();
    }
}
?>
