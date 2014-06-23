<?php

class Sales extends CI_Model{
    function __construct() {
        parent::__construct();
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
    function add_keyboard_sales($guid,$item,$quty,$stock,$discount,$i,$price){         
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
    
}
?>
