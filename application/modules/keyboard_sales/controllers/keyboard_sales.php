<?php
class Keyboard_sales extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){  
        $this->session->set_userdata(array('currency_symbol'=>'$'));
        $this->load->view('header'); 
        $this->load->view('index');
        $this->load->view('footer');
    }
  
function save(){      
     if($this->session->userdata['keyboard_sales_per']['sale']==1){
        $this->form_validation->set_rules('customers_guid',$this->lang->line('customers_guid'));
        $this->form_validation->set_rules('keyboard_sales_bill_number', $this->lang->line('keyboard_sales_bill_number'));
        $this->form_validation->set_rules('sales_bill_date', $this->lang->line('sales_bill_date'), 'required');                      
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
                $order_number=  $this->input->post('keyboard_sales_bill_number');              
                $order_date= strtotime($this->input->post('sales_bill_date'));
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
                $this->load->model('sales');
                $this->load->model('stock');
                if($this->sales->check_duplicate($order_number)){
                    $value=array('receipt_status'=>1,'order_status'=>1,'customer_discount_amount'=>$customer_discount_amount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'code'=>$order_number,'date'=>$order_date,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                    $guid=   $this->posnic->posnic_add_record($value,'direct_sales');
                    $bill=array('customer_id'=>$customer,'invoice'=>$order_number,'date'=>$order_date,'direct_sales_id'=>$guid);
                    $invoice= $this->posnic->posnic_add_record($bill,'sales_bill');
                    if($payment_type=='cash'){
                        if($grand_total==$this->input->post('paid_amount')){
                            $this->sales->card_payment($customer,$invoice,$grand_total,$order_date) ;
                        }else{
                            $this->sales->cash_payment($customer,$invoice,$grand_total,$order_date,$this->input->post('paid_amount')) ;
                        }
                    }else if($payment_type=='card'){
                        $this->sales->card_payment($customer,$invoice,$grand_total,$order_date) ;                        
                    }else {
                        $this->sales->payable_amount($customer,$invoice,$grand_total)   ;
                    }
                    $item=  $this->input->post('items_id');
                    $quty=  $this->input->post('items_quty');
                    $price=  $this->input->post('items_price');
                    $stock=  $this->input->post('items_stock_id');
                    $item_discount=  $this->input->post('items_discount_per');           
                    for($i=0;$i<count($item);$i++){
                        $this->sales->add_keyboard_sales($guid,$item[$i],$quty[$i],$stock[$i],$item_discount[$i],$i,$price[$i]);
                         $this->stock->reduce_stock($item[$i],$quty[$i],$price[$i]);
                    }
                    $this->posnic->posnic_master_increment_max('keyboard_sales')  ;
                    echo 'TRUE';
                }else{
                echo 'l';
                }
                }else{
                   echo 'FALSE';
                }
        }else{
            echo 'Noop';
        }
    }
  
        
    /*
     * get customer details for direct sales
     *  */       
    // function starts
    function search_customer(){
        $search= $this->input->post('term'); 
        $this->load->model('sales');
        $data=$this->sales->search_customers($search);
        echo json_encode($data);
    }
    // function end

    function order_number(){
           $data[]= $this->posnic->posnic_master_max('keyboard_sales')    ;
           echo json_encode($data);
    }

    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('stock');
        $data= $this->stock->search_items($search);      
        echo json_encode($data);
    }
    
    function get_items($code){
        $this->load->model('stock');
        $data=  $this->stock->get_items($code);
        echo json_encode($data);
    }
}
?>
