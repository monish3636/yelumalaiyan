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
        else if($report=='sales_return'){
            $this->db->select('sales_return.*,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('sales_return')->where('sales_return.branch_id',$branch)->where('sales_return.delete_status',0);
            $this->db->join('sales_bill', 'sales_bill.guid=sales_return.sales_bill_id','left');
            $this->db->join('branches', 'branches.guid=sales_return.branch_id','left');
            $this->db->join('customers', 'customers.guid=sales_bill.customer_id','left');
            $this->db->where('sales_return.date >=', strtotime($start));
            $this->db->where('sales_return.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='purchase_order'){
            $this->db->select('purchase_order.*,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.delete_status',0);
            $this->db->join('branches', 'branches.guid=purchase_order.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id','left');
            $this->db->where('purchase_order.po_date >=', strtotime($start));
            $this->db->where('purchase_order.po_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['po_date']=date('d-m-Y',$row['po_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='goods_receiving_note'){
            $this->db->select('purchase_order.*, grn.discount_amt as grn_discount_amt, grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,grn.date as date,grn.grn_status,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('grn')->where('grn.branch_id',$branch)->where('grn.delete_status',0);
            $this->db->join('branches', 'branches.guid=grn.branch_id','left');
            $this->db->join('purchase_order', 'purchase_order.guid=grn.po','left');
            $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id','left');
            $this->db->where('date >=', strtotime($start));
            $this->db->where('date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='direct_grn'){
            $this->db->select('direct_grn.*,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('direct_grn')->where('direct_grn.branch_id',$branch)->where('direct_grn.delete_status',0);
            $this->db->join('branches', 'branches.guid=direct_grn.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=direct_grn.supplier_id','left');
            $this->db->where('grn_date >=', strtotime($start));
            $this->db->where('grn_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['grn_date']=date('d-m-Y',$row['grn_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='direct_invoice'){
            $this->db->select('direct_invoice.*,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('direct_invoice')->where('direct_invoice.branch_id',$branch)->where('direct_invoice.delete_status',0);
            $this->db->join('branches', 'branches.guid=direct_invoice.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=direct_invoice.supplier_id','left');
            $this->db->where('invoice_date >=', strtotime($start));
            $this->db->where('invoice_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['invoice_date']=date('d-m-Y',$row['invoice_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='purchase_invoice'){
            $this->db->select('grn.grn_no as grn_code,grn.discount_amt as grn_discount_amt,purchase_order.freight as grn_freight,purchase_order.round_amt as grn_round_amt,purchase_order.total_items as grn_total_items,grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,direct_grn.grn_no as dgrn_code,direct_grn.discount_amt as dg_discount_amt,direct_grn.freight as dg_freight,direct_grn.round_amt as dg_round_amt,direct_grn.total_items as dg_total_items,direct_grn.total_item_amt as dg_total_item_amt, direct_grn.total_amt as dg_total_amt,direct_invoice.invoice_no as di_code,direct_invoice.discount_amt as di_discount_amt,direct_invoice.freight as di_freight,direct_invoice.round_amt as di_round_amt,direct_invoice.total_items as di_total_items,direct_invoice.total_item_amt as di_total_item_amt, direct_invoice.total_amt as di_total_amt, branches.store_name,branches.code as bcode,direct_grn.grn_no,purchase_invoice.invoice,purchase_invoice.guid as invoice_guid, purchase_invoice.date,suppliers.first_name as s_name,suppliers.company_name as c_name');
            $this->db->from('purchase_invoice')->where('purchase_invoice.branch_id',$branch);
            $this->db->join('branches', 'branches.guid=purchase_invoice.branch_id','left');
            $this->db->join('direct_grn', 'direct_grn.guid=purchase_invoice.grn','left');
            $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_invoice.direct_invoice_id','left');
            $this->db->join('grn', 'grn.guid=purchase_invoice.grn AND grn.po=purchase_invoice.po','left');
            $this->db->join('purchase_order', 'purchase_order.guid=purchase_invoice.po','left');
            $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id OR suppliers.guid=direct_grn.supplier_id OR suppliers.guid=direct_invoice.supplier_id','left');
            $this->db->where('purchase_invoice.date >=', strtotime($start));
            $this->db->where('purchase_invoice.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                if($row['di_code']!="" && $row['di_code']!=NULL){
                    $row['total_items']=$row['di_total_items'];
                    $row['discount_amt']=$row['di_discount_amt'];
                    $row['freight']=$row['di_freight'];
                    $row['round_amt']=$row['di_round_amt'];
                    $row['total_item_amt']=$row['di_total_item_amt'];
                    $row['total_amt']=$row['di_total_amt'];
                }
                
                if($row['grn_code']!="" && $row['grn_code']!=NULL){
                    $row['total_items']=$row['grn_total_items'];
                    $row['discount_amt']=$row['grn_discount_amt'];
                    $row['freight']=$row['grn_freight'];
                    $row['round_amt']=$row['grn_round_amt'];
                    $row['total_item_amt']=$row['grn_total_item_amt'];
                    $row['total_amt']=$row['grn_total_amt'];
                }
                  if($row['dgrn_code']!="" && $row['dgrn_code']!=NULL){
                    $row['total_items']=$row['dg_total_items'];
                    $row['discount_amt']=$row['dg_discount_amt'];
                    $row['freight']=$row['dg_freight'];
                    $row['round_amt']=$row['dg_round_amt'];
                    $row['total_item_amt']=$row['dg_total_item_amt'];
                    $row['total_amt']=$row['dg_total_amt'];
                }
                $data[]=$row;
            }
            return $data;         
        }
        else if($report=='purchase_return'){
            $this->db->select('purchase_return.*,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('purchase_return')->where('purchase_return.branch_id',$branch)->where('purchase_return.delete_status',0);
            $this->db->join('purchase_invoice', 'purchase_invoice.guid=purchase_return.purchase_invoice_id','left');
            $this->db->join('branches', 'branches.guid=purchase_return.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id','left');
            $this->db->where('purchase_return.date >=', strtotime($start));
            $this->db->where('purchase_return.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='opening_stock'){
            $this->db->select('opening_stock.*,branches.store_name,branches.code as bcode')->from('opening_stock')->where('opening_stock.branch_id',$branch)->where('opening_stock.delete_status',0);
            $this->db->join('branches', 'branches.guid=opening_stock.branch_id','left');
            $this->db->where('opening_stock.date >=', strtotime($start));
            $this->db->where('opening_stock.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='stock_transfer'){
            $this->db->select('stock_transfer.*,branches.store_name,branches.code as bcode')->from('stock_transfer')->where('stock_transfer.branch_id',$branch)->where('stock_transfer.delete_status',0);
            $this->db->join('branches', 'branches.guid=stock_transfer.destination','left');
            $this->db->where('stock_transfer.date >=', strtotime($start));
            $this->db->where('stock_transfer.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='damage_stock'){
            $this->db->select('damage_stock.*,branches.store_name,branches.code as bcode')->from('damage_stock')->where('damage_stock.branch_id',$branch)->where('damage_stock.delete_status',0);
            $this->db->join('branches', 'branches.guid=damage_stock.branch_id','left');
            $this->db->where('damage_stock.date >=', strtotime($start));
            $this->db->where('damage_stock.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='receiving_stock'){
            $this->db->select('stock_transfer.*,branches.store_name,branches.code as bcode')->from('stock_transfer')->where('stock_transfer.destination',$branch)->where('stock_transfer.delete_status',0)->where('stock_transfer.stock_status',1);
            $this->db->join('branches', 'branches.guid=stock_transfer.branch_id','left');
            $this->db->where('stock_transfer.date >=', strtotime($start));
            $this->db->where('stock_transfer.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='stock_level'){
            $this->db->select('stocks_history.*,purchase_invoice.invoice,direct_invoice.invoice_no as invoice_no,items.code as sku,items.name as item_name,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('stocks_history')->where('stocks_history.branch_id',$branch);
            $this->db->join('branches', 'branches.guid=stocks_history.branch_id','left');
            $this->db->join('purchase_invoice', 'purchase_invoice.guid=stocks_history.invoice_id','left');
            $this->db->join('direct_invoice', 'direct_invoice.guid=stocks_history.invoice_id','left');
            $this->db->join('items', 'items.guid=stocks_history.item_id','left');
            $this->db->join('suppliers', 'suppliers.guid=stocks_history.supplier_id','left');
            $this->db->where('stocks_history.date >=', strtotime($start));
            $this->db->where('stocks_history.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                if($row['invoice_no']!="" && $row['invoice_no']!=NULL){
                    $row['invoice']=$row['invoice_no'];
                }
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='supplier_payment_debit'){
            $this->db->select('payment.*,purchase_invoice.invoice,direct_invoice.invoice_no as invoice_no,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('payment')->where('payment.branch_id',$branch)->where('payment.type','debit')->where('payment.return_id','');
            $this->db->join('purchase_invoice', 'purchase_invoice.guid=payment.invoice_id','left');
            $this->db->join('direct_invoice', 'direct_invoice.guid=payment.invoice_id','left');
            $this->db->join('branches', 'branches.guid=payment.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=payment.supplier_id','left');
            $this->db->where('payment.added_date >=', strtotime($start));
            $this->db->where('payment.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                 if($row['invoice_no']!="" && $row['invoice_no']!=NULL){
                    $row['invoice']=$row['invoice_no'];
                }
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='supplier_payment_credit'){
            $this->db->select('payment.*,purchase_return.code as invoice,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('payment')->where('payment.branch_id',$branch)->where('payment.type','debit')->where('payment.return_id !=','');;
            $this->db->join('purchase_return', 'purchase_return.guid=payment.return_id','left');
            $this->db->join('branches', 'branches.guid=payment.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=payment.supplier_id','left');
            $this->db->where('payment.added_date >=', strtotime($start));
            $this->db->where('payment.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='customer_payment_credit'){
            $this->db->select('payment.*,sales_bill.invoice,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('payment')->where('payment.branch_id',$branch)->where('payment.type','credit')->where('payment.return_id','');
            $this->db->join('sales_bill', 'sales_bill.guid=payment.invoice_id','left');
            $this->db->join('branches', 'branches.guid=payment.branch_id','left');
            $this->db->join('customers', 'customers.guid=payment.customer_id','left');
            $this->db->where('payment.added_date >=', strtotime($start));
            $this->db->where('payment.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='customer_payment_debit'){
            $this->db->select('payment.*,sales_return.code as invoice,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('payment')->where('payment.branch_id',$branch)->where('payment.type','credit')->where('payment.return_id !=','');
            $this->db->join('sales_return', 'sales_return.guid=payment.return_id','left');
            $this->db->join('branches', 'branches.guid=payment.branch_id','left');
            $this->db->join('customers', 'customers.guid=payment.customer_id','left');
            $this->db->where('payment.added_date >=', strtotime($start));
            $this->db->where('payment.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                $data[]=$row;
            }
            return $data;
        }
        
        
        else if($report=='supplier_payable_debit'){
            $this->db->select('supplier_payable.*,purchase_invoice.invoice,purchase_invoice.date as pi_date,direct_invoice.invoice_date as di_date,direct_invoice.invoice_no as invoice_no,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('supplier_payable')->where('supplier_payable.branch_id',$branch)->where('supplier_payable.payment_status',0);
            $this->db->join('purchase_invoice', 'purchase_invoice.guid=supplier_payable.invoice_id','left');
            $this->db->join('direct_invoice', 'direct_invoice.guid=supplier_payable.invoice_id','left');
            $this->db->join('branches', 'branches.guid=supplier_payable.branch_id','left');
            $this->db->join('suppliers', 'suppliers.guid=supplier_payable.supplier_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                if($row['pi_date']!="" && $row['pi_date']!=NULL){
                    $row['date']=$row['pi_date'];
                }else{
                    $row['date']=$row['di_date'];
                }
                if($row['invoice_no']!="" && $row['invoice_no']!=NULL){
                    $row['invoice']=$row['invoice_no'];
                }
                if($row['date'] >= strtotime($start) && $row['date'] <= strtotime($end)){
                    $row['date']=date('d-m-Y',$row['date']);
                    $data[]=$row;
                }
            }
             return $data;
        }
        else if($report=='supplier_payable_credit'){
            $this->db->select('purchase_return.*,purchase_return.code as invoice,branches.store_name,branches.code as bcode,suppliers.first_name as s_name,suppliers.company_name as c_name')->from('purchase_return')->where('purchase_return.branch_id',$branch)->where('purchase_return.payment_status',0);
            $this->db->join('branches', 'branches.guid=purchase_return.branch_id','left');
            $this->db->join('purchase_invoice', 'purchase_invoice.guid=purchase_return.purchase_invoice_id','left');
            $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_return.purchase_invoice_id','left');
            $this->db->join('suppliers', 'suppliers.guid=direct_invoice.supplier_id OR suppliers.guid=purchase_invoice.supplier_id','left');
            $this->db->where('purchase_return.date >=', strtotime($start));
            $this->db->where('purchase_return.date <=', strtotime($end));
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

