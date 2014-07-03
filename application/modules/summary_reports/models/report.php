<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function search_branch($search){
        if($this->session->userdata('user_type')==2){
            $this->db->select('branches.store_name,branches.code,branches.guid')->from('users_x_branches')->where('branches.active_status',1)->where('branches.delete_status',0);
            $this->db->join('branches', 'branches.guid=users_x_branches.branch_id','left');
            $this->db->group_by('branches.guid');
            $sql=  $this->db->get();
            return $sql->result();
            
        }else{
            $this->db->select('branches.store_name,branches.code,branches.guid')->from('users_x_branches')->where('users_x_branches.user_id',  $this->session->userdata('guid'))->where('branches.active_status',1)->where('branches.delete_status',0);
            $this->db->join('branches', 'branches.guid=users_x_branches.branch_id','left');
            $sql=  $this->db->get();
            return $sql->result();
        }
                
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
        else if($report=='sales_quotation'){
            $this->db->select('sales_quotation.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('sales_quotation')->where('sales_quotation.branch_id',$branch)->where('sales_quotation.delete_status',0);
            $this->db->join('branches', 'branches.guid=sales_quotation.branch_id','left');
            $this->db->join('customers', 'customers.guid=sales_quotation.customer_id','left');
            $this->db->where('sales_quotation.date >=', strtotime($start));
            $this->db->where('sales_quotation.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['exp_date']=date('d-m-Y',$row['exp_date']);
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='sales_delivery_note'){
            $this->db->select('sales_order.code,sales_order.freight,sales_order.round_amt,sales_order.total_items,sales_order.exp_date,sales_order.discount,sales_order.discount_amt,sales_delivery_note.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('sales_delivery_note')->where('sales_delivery_note.branch_id',$branch)->where('sales_delivery_note.delete_status',0);
            $this->db->join('sales_order', 'sales_order.guid=sales_delivery_note.so','left');
            $this->db->join('branches', 'branches.guid=sales_delivery_note.branch_id','left');
            $this->db->join('customers', 'customers.guid=sales_order.customer_id','left');
            $this->db->where('sales_delivery_note.date >=', strtotime($start));
            $this->db->where('sales_delivery_note.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['exp_date']=date('d-m-Y',$row['exp_date']);
                $row['date']=date('d-m-Y',$row['date']);
                if($row['discount']!=0 && $row['discount']!="" && $row['discount']!=NULL){
                    $row['discount_amt']=$row['total_amount']*$row['discount']/100;
                }
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='direct_sales_delivery_note'){
            $this->db->select('direct_sales_delivery.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('direct_sales_delivery')->where('direct_sales_delivery.branch_id',$branch)->where('direct_sales_delivery.delete_status',0);
            $this->db->join('branches', 'branches.guid=direct_sales_delivery.branch_id','left');
            $this->db->join('customers', 'customers.guid=direct_sales_delivery.customer_id','left');
            $this->db->where('direct_sales_delivery.date >=', strtotime($start));
            $this->db->where('direct_sales_delivery.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
    }
}
?>

