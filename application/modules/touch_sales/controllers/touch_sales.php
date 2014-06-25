<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Touch_sales extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){  
        $this->session->set_userdata(array('currency_symbol'=>'$'));
        $data=array();
        $this->load->model('stock');
        $data['row']=  $this->stock->get_items();
        $this->load->view('header');  
        $this->load->view('index',$data);  
  
        $this->load->view('footer');
    }
    /*
    * get customer details for sales order
    *  */       
   // functoon starts
    function search_customer(){
        $search= $this->input->post('term'); 
        $this->load->model('stock');
        $data=$this->stock->search_customers($search);
        echo json_encode($data);
    }
   // function end
   // functoon starts
    function search_items(){
        $search= $this->input->post('term'); 
        $this->load->model('stock');
        $data=$this->stock->search_items($search);
        echo json_encode($data);
    }
   // function end
     function get_items($code){
        $this->load->model('stock');
        $data=  $this->stock->scan_items($code);
        echo json_encode($data);
    }
    function save(){      
     if($this->session->userdata['touch_sales_per']['sale']==1){       
        $this->form_validation->set_rules('touch_sales_bill_number', $this->lang->line('touch_sales_bill_number'));                     
        $this->form_validation->set_rules('payment_type', $this->lang->line('payment_type'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric');                    
        $this->form_validation->set_rules('bill_discount', $this->lang->line('bill_discount'),'numeric');                      
        $this->form_validation->set_rules('bill_discount_amount', $this->lang->line('bill_discount_amount'), 'numeric');        
        $this->form_validation->set_rules('items_id[]', $this->lang->line('items_id'), 'required');                      
        $this->form_validation->set_rules('items_stock_id[]', $this->lang->line('items_stock_id'), 'required');                      
        $this->form_validation->set_rules('items_price[]', $this->lang->line('items_price'), 'required|numeric');                      
        $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_price'), 'required|numeric');                      
        $this->form_validation->set_rules('items_discount_per[]', $this->lang->line('items_discount_per'), 'required|numeric'); 
            if ( $this->form_validation->run() !== false ) {    
                $customer=  $this->input->post('customers_guid');
                $order_number=  $this->input->post('touch_sales_bill_number');              
                $order_date= strtotime(date("Y/m/d"));
                $discount=  $this->input->post('bill_discount');
                $discount_amount=  $this->input->post('bill_discount_amount');
                $payment_type=  $this->input->post('payment_type');
                $freight= 0;
                $round_amt= 0;
                $total_items=$this->input->post('index');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
                $this->load->model('stock');
                if($this->stock->check_duplicate($order_number)){
                    $value=array('receipt_status'=>1,'order_status'=>1,'customer_discount_amount'=>$customer_discount_amount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'code'=>$order_number,'date'=>$order_date,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                    $guid=   $this->posnic->posnic_add_record($value,'direct_sales');
                    $bill=array('customer_id'=>$customer,'invoice'=>$order_number,'date'=>$order_date,'direct_sales_id'=>$guid);
                    $invoice= $this->posnic->posnic_add_record($bill,'sales_bill');
                    if($payment_type=='cash'){
                        if($grand_total==$this->input->post('paid_amount')){
                            $this->stock->card_payment($customer,$invoice,$grand_total,$order_date) ;
                        }else{
                            $this->stock->cash_payment($customer,$invoice,$grand_total,$order_date,$this->input->post('paid_amount')) ;
                        }
                    }else if($payment_type=='card'){
                        $this->stock->card_payment($customer,$invoice,$grand_total,$order_date) ;                        
                    }else {
                        $this->stock->payable_amount($customer,$invoice,$grand_total)   ;
                    }
                    $item=  $this->input->post('items_id');
                    $quty=  $this->input->post('items_quty');
                    $price=  $this->input->post('items_price');
                    $stock=  $this->input->post('items_stock_id');
                    $item_discount=  $this->input->post('items_discount_per');           
                    for($i=0;$i<count($item);$i++){
                        $this->stock->add_touch_sales($guid,$item[$i],$quty[$i],$stock[$i],$item_discount[$i],$i,$price[$i]);
                    }
                    $this->posnic->posnic_master_increment_max('touch_sales')  ;
                    echo 'TRUE';
                }
                }else{
                   echo 'FALSE';
                }
        }else{
            echo 'Noop';
        }
    }
        function order_number(){
           $data[]= $this->posnic->posnic_master_max('touch_sales')    ;
           echo json_encode($data);
    }
}

