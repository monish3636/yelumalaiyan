<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    /* Search sales
    function start      */
    function search_sales($search){
        $this->db->select('sales_bill.*,customers.first_name,customers.company_name')->from('sales_bill')->where('sales_bill.branch_id',  $this->session->userdata('branch_id'));
        $this->db->join('customers', 'customers.guid=sales_bill.customer_id','left');
        $like=array('invoice'=>$search,'first_name'=>$search,'company_name'=>$search);       
        $this->db->or_like($like);
        $this->db->limit($this->session->userdata('data_limit'));
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
         $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
        }
        return $data; 
    }
    /* function end*/
    
    /* get selected sales details 
        function start     */
    
    function get_sales($guid){
        $this->db->select('sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amount as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,direct_sales.total_items as ds_total, direct_sales.code as ds_code ,direct_sales.total_amt as ds_amount,customers.first_name as s_name,customers.company_name as c_name');
        $this->db->from('sales_bill')->where('sales_bill.guid',$guid);
        $this->db->join('direct_sales', 'direct_sales.guid=sales_bill.direct_sales_id','left');
        $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
        $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
        $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
        $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
        $this->db->limit($end,$start); 
        $this->db->or_like($like);     
        $query=$this->db->get();
        foreach ($query->result_array() as $row){
           $row['date']=date('d-m-Y',$row['date']);
           if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
               $row['code']=$row['sdn_code'];
               $row['total_items']=$row['so_total_items'];
               $row['total']=$row['sdn_amount'];
           }
           if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
               $row['code']=$row['dsd_code'];
               $row['total_items']=$row['dsd_total_items'];
               $row['total']=$row['dsd_amount'];
           }
           if($row['ds_code']!="" && $row['ds_code']!=NULL){
               $row['code']=$row['ds_code'];
               $row['total_items']=$row['ds_total'];
               $row['total']=$row['ds_amount'];
           }
            $data[]=$row;
        }
      return $data; 
    }
    
    function get_report($branch,$report,$start,$end){
        if($report=='sales_order'){
            $this->db->select('sales_order.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('sales_order')->where('sales_order.branch_id',$branch)->where('sales_order.delete_status',0);
            $this->db->join('branches', 'branches.guid=sales_order.branch_id','left');
            $this->db->join('customers', 'customers.guid=sales_order.customer_id','left');
            $this->db->where('sales_order.date >=', strtotime($start));
            $this->db->where('sales_order.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['exp_date']=date('d-m-Y',$row['exp_date']);
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
    }
}
?>

