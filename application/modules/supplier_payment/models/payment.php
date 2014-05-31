<?php
class Payment extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_invoice.invoice as p_invoice,payment.*,suppliers.first_name ,suppliers.company_name ');
                $this->db->from('payment')->where('payment.branch_id',$branch)->where('payment.type','debit')->where('payment.delete_status',0);
           
                $this->db->join('purchase_invoice', 'purchase_invoice.guid=payment.invoice_id','left');
                $this->db->join('suppliers', 'suppliers.guid=payment.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                 
                    $row['payment_date']=date('d-m-Y',$row['payment_date']);
                    $data[]=$row;
                   
                }
                return $data; 
                return $data; 
        
    }
   
    /* get total number of paymant entry 
     * function start   */
    function count($branch){
        $this->db->select()->from('payment')->where('payment.branch_id',$branch)->where('payment.type','debit');
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   /* function end*/
    
    /* get payable invoice auto suggestion
    function start      */
    function  serach_invoice($like){
        $this->db->select('supplier_payable.guid as p_guid,supplier_payable.invoice_id,supplier_payable.amount, supplier_payable.paid_amount, purchase_invoice.*, suppliers.first_name as name,suppliers.company_name as company,suppliers.address1 as address')->from('purchase_invoice')->where('purchase_invoice.branch_id',  $this->session->userdata['branch_id']);
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id ','left');  
        $this->db->join('supplier_payable', 'suppliers.guid=purchase_invoice.supplier_id AND supplier_payable.invoice_id=purchase_invoice.guid','left');  
        $or_like=array('purchase_invoice.invoice'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->or_like($or_like);     
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        return $sql->result();
    }
    /* function end*/
     /* get purchase return auto suggestion
    function start      */
    function  search_purchase_return($like){
        $this->db->select('supplier_payable.invoice_id,purchase_invoice.invoice, purchase_return.*, suppliers.guid as supplier_id,suppliers.first_name as name,suppliers.company_name as company,suppliers.address1 as address')->from('purchase_return')->where('purchase_return.branch_id',  $this->session->userdata['branch_id']);
        $this->db->join('purchase_invoice', 'purchase_invoice.guid=purchase_return.purchase_invoice_id ','left');  
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id ','left');  
        $this->db->join('supplier_payable', 'suppliers.guid=purchase_invoice.supplier_id AND supplier_payable.invoice_id=purchase_invoice.guid','left');  
        $or_like=array('purchase_invoice.invoice'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->or_like($or_like);     
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        return $sql->result();
    }
    /* function end*/
    /*
     * 
     * add new supplier payment
     * function start     */
    function save_payment($payment,$amount,$date,$memo,$code,$invoice_id){
        $this->db->select()->from('supplier_payable')->where('guid',$payment);
        $sql=  $this->db->get();
        $total;
        $paid;
        $supplier;
        foreach ($sql->result() as $row){
            $total=$row->amount; // get total amount
            $paid=$row->paid_amount; // get paid amount
           $supplier=$row->supplier_id; // get paid amount
        }
        $balance=$total-$paid;
       
        if($amount > $balance){ // check wheather payment amount is valid or not, if it is invalid return false
           return FALSE; 
        } 
        $payment_status=0;
        if($total==($amount+$paid)){
            $payment_status=1;
        }
        $this->db->where('guid',$payment);
        $this->db->update('supplier_payable',array('payment_status'=>$payment_status,'paid_amount'=>$amount+$paid)); // update paid amount to supplier payable
        
        $data=array('invoice_id'=>$invoice_id,'code'=>$code,'type'=>'debit','payable_id'=>$payment,'supplier_id'=>$supplier,'memo'=>$memo,'amount'=>$amount,'payment_date'=>$date,'added_date'=>strtotime(date("Y/m/d")),'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
        $this->db->insert('payment',$data);
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('payment',array('guid'=>md5($id.$supplier.$payment)));
         return TRUE; 
    }
    /*
     *  fucntion end */ 
    
     function purchase_return_payment($amount,$date,$memo,$code,$supplier,$invoice_id,$return_id){
        $this->db->select()->from('purchase_return')->where('guid',$return_id);
        $sql=  $this->db->get();
        $paid_amount=0;
        foreach ($sql->result() as $row){
            $paid_amount=  $row->paid_amount;
            
        }
        $this->db->where('guid',$return_id);
        $this->db->update('purchase_return',array('paid_amount'=>$amount+$paid_amount));
        
        
        $data=array('invoice_id'=>$invoice_id,'return_id'=>$return_id,'code'=>$code,'type'=>'debit','supplier_id'=>$supplier,'memo'=>$memo,'amount'=>$amount,'payment_date'=>$date,'added_date'=>strtotime(date("Y/m/d")),'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
        $this->db->insert('payment',$data);
         $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('payment',array('guid'=>md5($id.$supplier.$invoice_id)));
          return TRUE; 
    }
    /* update payment
     * function start */
    function update_payment($guid,$payment,$amount,$date,$memo,$code){
        $this->db->select('supplier_payable.amount,supplier_payable.paid_amount,supplier_payable.supplier_id,payment.amount as old')->from('payment')->where('payment.guid',$guid);
        $this->db->join('supplier_payable', 'supplier_payable.guid=payment.payable_id','left');
        $sql=  $this->db->get();
        $total;
        $paid;
        $supplier;
        foreach ($sql->result() as $row){
            $old=$row->old;
            $total=$row->amount; // get total amount
            $paid=$row->paid_amount; // get paid amount
           $supplier=$row->supplier_id; // get paid amount
        }
        $balance=$total-$paid-$old;
       
        if($amount > $balance){ // check wheather payment amount is valid or not, if it is invalid return false
           return FALSE; 
        } 
        $payment_status=0;
        if($total==($amount+$paid)){
            $payment_status=1;
        }
        $this->db->where('guid',$payment);
        $this->db->update('supplier_payable',array('payment_status'=>$payment_status,'paid_amount'=>$amount+$paid-$old)); // update paid amount to supplier payable
        $this->db->where('guid',$guid);
        $this->db->update('payment',array('amount'=>$amount));
        return TRUE;
    }
    /* function end*/
    
    /* function starts
     */
    function get_payment_details($guid){
        $this->db->select('purchase_invoice.invoice,payment.*,supplier_payable.amount as total,supplier_payable.paid_amount,suppliers.first_name as name,suppliers.company_name as company,suppliers.address1 as address')->from('payment')->where('payment.guid',$guid);
        $this->db->join('supplier_payable','supplier_payable.guid=payment.payable_id');
        $this->db->join('purchase_invoice', 'purchase_invoice.guid=supplier_payable.invoice_id ','left'); 
        $this->db->join('suppliers', 'suppliers.guid=payment.supplier_id ','left'); 
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result_array() as $row){
            $row['payment_date']=date('d-m-Y',$row['payment_date']); // converet date  form strtotime formt  to date
            $data[]=$row; 
        }
        return $data;
    }
    /*
     *  fucntion end */ 
    /* function starts
     */
    function get_supplier_credit_payment($guid){
        $this->db->select('purchase_return.code as purchase_return_code,purchase_invoice.invoice,purchase_return.paid_amount,purchase_return.total_amount as total,payment.*,suppliers.first_name as name,suppliers.company_name as company,suppliers.address1 as address')->from('payment')->where('payment.guid',$guid);
     
        $this->db->join('purchase_return', 'purchase_return.guid=payment.return_id ','left'); 
        $this->db->join('purchase_invoice', 'purchase_invoice.guid=purchase_return.purchase_invoice_id ','left'); 
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id ','left'); 
        $sql=  $this->db->get();
        $data=array();
        foreach ($sql->result_array() as $row){
            $row['payment_date']=date('d-m-Y',$row['payment_date']); // converet date  form strtotime formt  to date
            $data[]=$row; 
        }
        return $data;
    }
     function update_credit_payment($guid,$amount,$date,$memo,$code,$return_id){
        $this->db->select('purchase_return.total_amount,purchase_return.paid_amount,payment.amount')->from('payment')->where('payment.guid',$guid);
        $this->db->join('purchase_return','purchase_return.guid=payment.return_id','left');
        $pay=  $this->db->get();
        $old;
        foreach ($pay->result() as $row){
            $old=$row->amount;
            $total=$row->total_amount; // get total amount
            $paid=$row->paid_amount; // get paid amount
        }
       
       
       
        $payment_status=0;
        if($total==($amount+$paid)){
            $payment_status=1;
        }
        $this->db->where('guid',$return_id);
        $this->db->update('purchase_return',array('payment_status'=>$payment_status,'paid_amount'=>$amount+$paid-$old)); // update paid amount to supplier payable
        $this->db->where('guid',$guid);
        $this->db->update('payment',array('memo'=>$memo,'amount'=>$amount,'payment_date'=>$date,));
        return TRUE;
    }
    /*
    /* delete payment
        function start     */
    function delete_payment($guid){
        $this->db->select('amount,payable_id')->from('payment')->where('guid',$guid);
        $sql=  $this->db->get();
        $amount;
        $payable;
        foreach ($sql->result() as $row){
            $amount=$row->amount;
            $payable=$row->payable_id;
        }
        $this->db->where('guid',$guid);
        $this->db->update('payment',array('delete_status'=>1,'deleted_by'=>  $this->session->userdata['guid']));
        $this->db->select('paid_amount')->from('supplier_payable')->where('guid',$payable);
        $paid=  $this->db->get();
        $paid_amount;
        foreach ($paid->result() as $row){
        $paid_amount=$row->paid_amount;
        }
        $this->db->where('guid',$payable);
        $this->db->update('supplier_payable',array('paid_amount'=>$paid_amount-$amount));
        
    }
}
?>
