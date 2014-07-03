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
        else if($report=='direct_sales'){
            $this->db->select('direct_sales.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('direct_sales')->where('direct_sales.branch_id',$branch)->where('direct_sales.delete_status',0);
            $this->db->join('branches', 'branches.guid=direct_sales.branch_id','left');
            $this->db->join('customers', 'customers.guid=direct_sales.customer_id','left');
            $this->db->where('direct_sales.date >=', strtotime($start));
            $this->db->where('direct_sales.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='sales_bill'){
            $this->db->select(' branches.store_name,branches.code as bcode,sales_order.customer_discount_amount as sdn_customer_discount_amount,sales_order.discount as sdn_discount,sales_order.discount_amt as sdn_discount_amt,sales_order.freight as sdn_freight,sales_order.round_amt as sdn_round_amt,sales_order.total_tax as sdn_total_tax,sales_order.total_discount as sdn_total_discount,sales_order.total_item_amt as sdn_total_item_amt, sales_order.total_amt as sdn_total_amt,direct_sales_delivery.customer_discount_amount as dsd_customer_discount_amount,direct_sales_delivery.discount_amt as dsd_discount_amt,direct_sales_delivery.freight as dsd_freight,direct_sales_delivery.round_amt as dsd_round_amt,direct_sales_delivery.total_tax as dsd_total_tax,direct_sales_delivery.total_discount as dsd_total_discount,direct_sales_delivery.total_item_amt as dsd_total_item_amt, direct_sales_delivery.total_amt as dsd_total_amt,direct_sales.customer_discount_amount as ds_customer_discount_amount,direct_sales.discount_amt as ds_discount_amt,direct_sales.freight as ds_freight,direct_sales.round_amt as ds_round_amt,direct_sales.total_tax as ds_total_tax,direct_sales.total_discount as ds_total_discount,direct_sales.total_item_amt as ds_total_item_amt, direct_sales.total_amt as ds_total_amt,sales_bill.*,sales_order.total_items as so_total_items,sales_delivery_note.total_amount as sdn_amount,sales_delivery_note.sales_delivery_note_no as sdn_code,direct_sales_delivery.total_items as dsd_total_items ,direct_sales_delivery.total_amt as dsd_amount,direct_sales_delivery.code dsd_code,direct_sales.total_items as ds_total, direct_sales.code as ds_code ,direct_sales.total_amt as ds_amount,customers.first_name as s_name,customers.company_name as c_name')->where('sales_bill.branch_id',$branch);
            $this->db->from('sales_bill')->where('sales_bill.branch_id',$branch);
            $this->db->join('direct_sales', 'direct_sales.guid=sales_bill.direct_sales_id','left');
            $this->db->join('direct_sales_delivery', 'direct_sales_delivery.guid=sales_bill.sdn','left');
            $this->db->join('sales_delivery_note','sales_delivery_note.guid=sales_bill.sdn','left');
            $this->db->join('sales_order','sales_order.guid=sales_delivery_note.so','left');
            $this->db->join('customers', 'customers.guid=sales_order.customer_id OR customers.guid=direct_sales.customer_id OR customers.guid=direct_sales_delivery.customer_id','left');
            $this->db->join('branches', 'branches.guid=direct_sales.branch_id','left');
            $this->db->where('sales_bill.date >=', strtotime($start));
            $this->db->where('sales_bill.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                if($row['sdn_code']!="" && $row['sdn_code']!=NULL){
                    $row['code']=$row['sdn_code'];
                    $row['total_items']=$row['so_total_items'];
                    $row['total_amount']=$row['sdn_amount'];
                    $row['customer_discount_amount']=$row['sdn_customer_discount_amount'];
                    $row['discount_amt']=$row['sdn_discount_amt'];
                    $row['discount']=$row['sdn_discount'];
                    $row['freight']=$row['sdn_freight'];
                    $row['round_amt']=$row['sdn_round_amt'];
                    $row['total_tax']=$row['sdn_total_tax'];
                    $row['total_discount']=$row['sdn_total_discount'];
                    $row['total_item_amt']=$row['sdn_total_item_amt'];
                    $row['total_amt']=$row['sdn_total_amt'];
                    if($row['discount']!=0 && $row['discount']!="" && $row['discount']!=NULL){
                        $row['discount_amt']=$row['total_amount']*$row['discount']/100;
                    }
                
                }
                if($row['dsd_code']!="" && $row['dsd_code']!=NULL){
                    $row['code']=$row['dsd_code'];
                    $row['total_items']=$row['dsd_total_items'];
                    $row['total_amount']=$row['dsd_amount'];
                    $row['customer_discount_amount']=$row['dsd_customer_discount_amount'];
                    $row['discount_amt']=$row['dsd_discount_amt'];
                    $row['freight']=$row['dsd_freight'];
                    $row['round_amt']=$row['dsd_round_amt'];
                    $row['total_tax']=$row['dsd_total_tax'];
                    $row['total_discount']=$row['dsd_total_discount'];
                    $row['total_item_amt']=$row['dsd_total_item_amt'];
                    $row['total_amt']=$row['dsd_total_amt'];
                }
                if($row['ds_code']!="" && $row['ds_code']!=NULL){
                    $row['code']=$row['ds_code'];
                    $row['total_items']=$row['ds_total'];
                    $row['total_amount']=$row['ds_amount'];
                    $row['customer_discount_amount']=$row['ds_customer_discount_amount'];
                    $row['discount_amt']=$row['ds_discount_amt'];
                    $row['freight']=$row['ds_freight'];
                    $row['round_amt']=$row['ds_round_amt'];
                    $row['total_tax']=$row['ds_total_tax'];
                    $row['total_discount']=$row['ds_total_discount'];
                    $row['total_item_amt']=$row['ds_total_item_amt'];
                    $row['total_amt']=$row['ds_total_amt'];
                    
                    
                }
                $data[]=$row;
            }
            return $data;
        }
    }
}
?>

