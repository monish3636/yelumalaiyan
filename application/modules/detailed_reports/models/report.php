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
    function search_suppliers($search){
        $this->db->select()->from('suppliers')->where('branch_id',  $this->session->userdata('branch_id'));
        $this->db->or_like(array('first_name'=>$search,'email'=>$search,'phone'=>$search));
        $sql=  $this->db->get();
        return $sql->result();
        
    }
    function search_purchase_items($search){
        
         $this->db->select('items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,stock.*')->from('stock')->where('stock.branch_id',$this->session->userdata['branch_id'])->where('items.active_status',1)->where('items.delete_status',0);
         $this->db->join('items', "items.guid=stock.item",'left');
         $this->db->join('items_category', 'items.category_id=items_category.guid ','left');
         $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=stock.item ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=stock.item ",'left');
         $this->db->join('brands', 'items.brand_id=brands.guid','left');
         $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
         $like=array('items.active_status'=>$search,'items.barcode'=>$search,'items.ean_upc_code'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);
                $this->db->limit($this->session->userdata['data_limit']);
                $sql=  $this->db->get();
                $data=array();
                foreach ($sql->result() as $row){
                   
                    $data[]=$row;
                  
                }
               // $this->db->like('suppliers_x_items.supplier_id',$guid); 
         
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
        
        else if($report=='customer_payable_credit'){
            $this->db->select('customer_payable.*,sales_bill.invoice,sales_bill.date ,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('customer_payable')->where('customer_payable.branch_id',$branch)->where('customer_payable.payment_status',0);
            $this->db->join('sales_bill', 'sales_bill.guid=customer_payable.invoice_id','left');
            $this->db->join('branches', 'branches.guid=customer_payable.branch_id','left');
            $this->db->join('customers', 'customers.guid=customer_payable.customer_id','left');
            $this->db->where('sales_bill.date >=', strtotime($start));
            $this->db->where('sales_bill.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);
                $data[]=$row;
                
            }
             return $data;
        }
        else if($report=='customer_payable_debit'){
            $this->db->select('sales_return.*,sales_return.code as invoice,branches.store_name,branches.code as bcode,customers.first_name as s_name,customers.company_name as c_name')->from('sales_return')->where('sales_return.branch_id',$branch)->where('sales_return.payment_status',0);
            $this->db->join('branches', 'branches.guid=sales_return.branch_id','left');
            $this->db->join('sales_bill', 'sales_bill.guid=sales_return.sales_bill_id','left');
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
        else if($report=='customers'){
            $this->db->select('customers.*,branches.store_name,branches.code as bcode,customer_category.category_name')->from('customers')->where('customers.branch_id',$branch)->where('customers.delete_status',0);
            $this->db->join('customer_category', 'customer_category.guid=customers.category_id','left');
            $this->db->join('branches', 'branches.guid=customers.branch_id','left');
            $this->db->where('customers.added_date >=', strtotime($start));
            $this->db->where('customers.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='customer_category'){
            $this->db->select('customer_category.*,branches.store_name,branches.code as bcode')->from('customer_category')->where('customer_category.branch_id',$branch)->where('customer_category.delete_status',0);
            $this->db->join('branches', 'branches.guid=customer_category.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='suppliers'){
            $this->db->select('suppliers.*,branches.store_name,branches.code as bcode,suppliers_category.category_name')->from('suppliers')->where('suppliers.branch_id',$branch)->where('suppliers.delete_status',0);
            $this->db->join('suppliers_category', 'suppliers_category.guid=suppliers.category','left');
            $this->db->join('branches', 'branches.guid=suppliers.branch_id','left');
            $this->db->where('suppliers.added_date >=', strtotime($start));
            $this->db->where('suppliers.added_date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['added_date']=date('d-m-Y',$row['added_date']);
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='suppliers_category'){
            $this->db->select('suppliers_category.*,branches.store_name,branches.code as bcode')->from('suppliers_category')->where('suppliers_category.branch_id',$branch)->where('suppliers_category.delete_status',0);
            $this->db->join('branches', 'branches.guid=suppliers_category.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='decomposition'){
            $this->db->select('decomposition.*,branches.store_name,branches.code as bcode,items.name,items.code as sku')->from('decomposition')->where('decomposition.branch_id',$branch)->where('decomposition.delete_status',0);
            $this->db->join('items', 'items.guid=decomposition.item_id','left');
            $this->db->join('branches', 'branches.guid=decomposition.branch_id','left');
            $this->db->where('decomposition.date >=', strtotime($start));
            $this->db->where('decomposition.date <=', strtotime($end));
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $row['date']=date('d-m-Y',$row['date']);  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='decomposition_type'){
            $this->db->select('decomposition_type.*,branches.store_name,branches.code as bcode')->from('decomposition_type')->where('decomposition_type.branch_id',$branch)->where('decomposition_type.delete_status',0);
            $this->db->join('branches', 'branches.guid=decomposition_type.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='decomposition_items'){
            $this->db->select('decomposition_items.*,branches.store_name,branches.code as bcode,items.name,items.code as sku,decomposition_type.value as type')->from('decomposition_items')->where('decomposition_items.branch_id',$branch)->where('decomposition_items.delete_status',0);
            $this->db->join('branches', 'branches.guid=decomposition_items.branch_id','left');            
            $this->db->join('items', 'items.guid=decomposition_items.item_id','left');
            $this->db->join('decomposition_type', 'decomposition_type.guid=decomposition_items.type_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_kit'){
            $this->db->select('item_kit.*,branches.store_name,branches.code as bcode,kit_category.category_name')->from('item_kit')->where('item_kit.branch_id',$branch)->where('item_kit.delete_status',0);
            $this->db->join('branches', 'branches.guid=item_kit.branch_id','left'); 
            $this->db->join('kit_category', 'kit_category.guid=item_kit.category_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='kit_category'){
            $this->db->select('kit_category.*,branches.store_name,branches.code as bcode')->from('kit_category')->where('kit_category.branch_id',$branch)->where('kit_category.delete_status',0);
            $this->db->join('branches', 'branches.guid=kit_category.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_brand'){
            $this->db->select('brands.*,branches.store_name,branches.code as bcode')->from('brands')->where('brands.branch_id',$branch)->where('brands.delete_status',0);
            $this->db->join('branches', 'branches.guid=brands.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_department'){
            $this->db->select('items_department.*,branches.store_name,branches.code as bcode')->from('items_department')->where('items_department.branch_id',$branch)->where('items_department.delete_status',0);
            $this->db->join('branches', 'branches.guid=items_department.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_category'){
            $this->db->select('items_category.*,branches.store_name,branches.code as bcode')->from('items_category')->where('items_category.branch_id',$branch)->where('items_category.delete_status',0);
            $this->db->join('branches', 'branches.guid=items_category.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='items'){
            $this->db->select('items.* ,branches.store_name,branches.code as bcode,tax_types.type as type,taxes.value as value,items_category.guid as c_guid,items_category.category_name as c_name,brands.guid as b_guid,brands.name as b_name,items_department.department_name as d_name')->from('items')->where('items.branch_id',$branch)->where('items.delete_status',0);
            $this->db->join('items_category', 'items.category_id=items_category.guid','left');
            $this->db->join('brands', 'items.brand_id=brands.guid','left');
            $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
            $this->db->join('taxes', 'items.tax_id=taxes.guid','left');
            $this->db->join('tax_types', 'taxes.type=tax_types.guid','left');
            $this->db->join('branches', 'branches.guid=items.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_tax_type'){
            $this->db->select('tax_types.*,branches.store_name,branches.code as bcode')->from('tax_types')->where('tax_types.branch_id',$branch)->where('tax_types.delete_status',0);
            $this->db->join('branches', 'branches.guid=tax_types.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_tax'){
            $this->db->select('taxes.*,branches.store_name,branches.code as bcode,tax_types.type as tax_type')->from('taxes')->where('taxes.branch_id',$branch)->where('taxes.delete_status',0);
            $this->db->join('branches', 'branches.guid=taxes.branch_id','left');
            $this->db->join('tax_types', 'tax_types.guid=taxes.type','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='item_tax_area'){
            $this->db->select('taxes_area.*,branches.store_name,branches.code as bcode')->from('taxes_area')->where('taxes_area.branch_id',$branch)->where('taxes_area.delete_status',0);
            $this->db->join('branches', 'branches.guid=taxes_area.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
        else if($report=='users'){
            $this->db->select('users.*,branches.store_name,branches.code as bcode,users_x_branches.user_active')->from('users_x_branches')->where('users_x_branches.branch_id',$branch)->where('users_x_branches.user_delete',0);
            $this->db->join('users', 'users.guid=users_x_branches.user_id','left');
            $this->db->join('branches', 'branches.guid=users_x_branches.branch_id','left');
            $sql=  $this->db->get();
            $data=array();
            foreach($sql->result_array() as $row){  
                $data[]=$row;
            }
            return $data;
        }
    }
    /* get purchase report based on branch
    function start     */
    function get_purchase_branch_base_report($branch,$start,$end){
        $this->db->select('supplier_payable.paid_amount,supplier_payable.amount as purchase_amount,grn.grn_no as grn_code,grn.discount_amt as grn_discount_amt,purchase_order.freight as grn_freight,purchase_order.round_amt as grn_round_amt,purchase_order.total_items as grn_total_items,grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,direct_grn.grn_no as dgrn_code,direct_grn.discount_amt as dg_discount_amt,direct_grn.freight as dg_freight,direct_grn.round_amt as dg_round_amt,direct_grn.total_items as dg_total_items,direct_grn.total_item_amt as dg_total_item_amt, direct_grn.total_amt as dg_total_amt,direct_invoice.invoice_no as di_code,direct_invoice.discount_amt as di_discount_amt,direct_invoice.freight as di_freight,direct_invoice.round_amt as di_round_amt,direct_invoice.total_items as di_total_items,direct_invoice.total_item_amt as di_total_item_amt, direct_invoice.total_amt as di_total_amt, branches.store_name,branches.code as bcode,direct_grn.grn_no,purchase_invoice.invoice,purchase_invoice.guid as invoice_guid, purchase_invoice.date,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_invoice')->where('purchase_invoice.branch_id',$branch);
        $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_invoice.direct_invoice_id','left');
        $this->db->join('supplier_payable', 'supplier_payable.invoice_id=direct_invoice.guid OR supplier_payable.invoice_id=purchase_invoice.guid','left');
        $this->db->join('branches', 'branches.guid=purchase_invoice.branch_id','left');
        $this->db->join('direct_grn', 'direct_grn.guid=purchase_invoice.grn','left');
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
    // function end
    /* get purchase report based on supplier
    function start     */
    function get_purchase_supplier_base_report($supplier,$start,$end){
         $supplier;
       $this->db->select('supplier_payable.paid_amount,supplier_payable.amount as purchase_amount,grn.grn_no as grn_code,grn.discount_amt as grn_discount_amt,purchase_order.freight as grn_freight,purchase_order.round_amt as grn_round_amt,purchase_order.total_items as grn_total_items,grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,direct_grn.grn_no as dgrn_code,direct_grn.discount_amt as dg_discount_amt,direct_grn.freight as dg_freight,direct_grn.round_amt as dg_round_amt,direct_grn.total_items as dg_total_items,direct_grn.total_item_amt as dg_total_item_amt, direct_grn.total_amt as dg_total_amt,direct_invoice.invoice_no as di_code,direct_invoice.discount_amt as di_discount_amt,direct_invoice.freight as di_freight,direct_invoice.round_amt as di_round_amt,direct_invoice.total_items as di_total_items,direct_invoice.total_item_amt as di_total_item_amt, direct_invoice.total_amt as di_total_amt, branches.store_name,branches.code as bcode,direct_grn.grn_no,purchase_invoice.invoice,purchase_invoice.guid as invoice_guid, purchase_invoice.date,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_invoice')->where('purchase_invoice.branch_id',$this->session->userdata('branch_id'))->where('purchase_invoice.supplier_id',$supplier);
        $this->db->join('direct_invoice', "direct_invoice.guid=purchase_invoice.direct_invoice_id AND direct_invoice.supplier_id='".$supplier."'",'left');
        $this->db->join('supplier_payable', 'supplier_payable.invoice_id=direct_invoice.guid OR supplier_payable.invoice_id=purchase_invoice.guid','left');
        $this->db->join('branches', 'branches.guid=purchase_invoice.branch_id','left');
        $this->db->join('direct_grn', "direct_grn.guid=purchase_invoice.grn AND direct_grn.supplier_id='".$supplier."'",'left');
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
    function get_purchase_items_base_report($items,$start,$end){
       $this->db->select('direct_invoice_items.quty as DI_quty,direct_grn_items.quty as DG_quty,grn_x_items.quty as G_quty,');
        $this->db->from('purchase_invoice')->where('purchase_invoice.branch_id',$this->session->userdata('branch_id'));
        $this->db->join('items', "items.guid='".$items."'",'left'); 
        $this->db->join('direct_invoice', "direct_invoice.guid=purchase_invoice.direct_invoice_id ",'left'); 
        $this->db->join('direct_invoice_items', "direct_invoice_items.order_id=direct_invoice.guid AND direct_invoice_items.order_id=purchase_invoice.direct_invoice_id AND direct_invoice_items.item=items.guid AND direct_invoice_items.item='".$items."'",'left');
        $this->db->join('direct_grn', "direct_grn.guid=purchase_invoice.grn ",'left');
        $this->db->join('direct_grn_items', "direct_grn_items.order_id=direct_invoice.guid AND direct_grn_items.order_id=purchase_invoice.grn AND direct_grn_items.item=items.guid AND direct_grn_items.item='".$items."'",'left');
        $this->db->join('grn', 'grn.guid=purchase_invoice.grn AND grn.po=purchase_invoice.po','left');
        $this->db->join('grn_x_items', "grn_x_items.grn=grn.guid AND grn_x_items.grn=purchase_invoice.grn AND grn.po=purchase_invoice.po AND grn_x_items.item=items.guid AND grn_x_items.item='".$items."'",'left');
        $this->db->join('purchase_order', 'purchase_order.guid=purchase_invoice.po','left');

        
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id OR suppliers.guid=direct_grn.supplier_id OR suppliers.guid=direct_invoice.supplier_id','left');
        $this->db->where('purchase_invoice.date >=', strtotime($start));
        $this->db->where('purchase_invoice.date <=', strtotime($end));
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){  
            
            $data[]=$row;
        }
        echo '<pre>';
        print_r($data);
        return $data; 
    }
    // function end
}
?>

