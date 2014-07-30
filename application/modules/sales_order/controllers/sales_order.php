<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales_order extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='sales_order';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        /// echo strtotime(date("Y/m/d"));
    }
    // Sales order data table
    function data_table(){
        $aColumns = array( 'guid','code','code','c_name','s_name','date','total_items','total_amt','active_status','order_status' );	
	$start = "";
			$end="";
		
		if ( $this->input->get_post('iDisplayLength') != '-1' )	{
			$start = $this->input->get_post('iDisplayStart');
			$end=	 $this->input->get_post('iDisplayLength');              
		}	
		$order="";
		if ( isset( $_GET['iSortCol_0'] ) )
		{	
			for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
				{
					$order.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
				}
			}
			
					$order = substr_replace( $order, "", -1 );
					
		}
		
		$like = array();
		
			if ( $_GET['sSearch'] != "" )
		{
		$like =array(
                    'po_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('sales')	   ;
                        
			 $rResult1 = $this->sales->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->sales->count($this->session->userdata['branch_id']);
		
		$iTotal =$iFilteredTotal;
		
		$output1 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		foreach ($rResult1 as $aRow )
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $aColumns[$i] == "id" )
				{
					$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
				}
				else if ( $aColumns[$i]== 'date' )
				{
					/* General output */
					$row[] = date('d-m-Y',$aRow[$aColumns[$i]]);
				}
				else if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					$row[] = $aRow[$aColumns[$i]];
				}
				
			}
				
		$output1['aaData'][] = $row;
		}
                
		
		   echo json_encode($output1);
    }
    
    function  set_seleted_item_suppier($suid){
        $this->session->userdata['supplier_guid']=$suid;
    }
    
   
 
    
  
function save(){      
     if($this->session->userdata['sales_order_per']['add']==1){
        $this->form_validation->set_rules('customers_guid',$this->lang->line('customers_guid'), 'required');
        $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount_percentage', $this->lang->line('discount_percentage'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');                      
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_stock_id[]', $this->lang->line('new_item_stock_id'), 'required');                      
           
            if ( $this->form_validation->run() !== false ) {    
                $customer=  $this->input->post('customers_guid');
                $order_number=  $this->input->post('order_number');
                $expdate=strtotime($this->input->post('expiry_date'));
                $order_date= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount_percentage');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('no_of_item');
                $total_discount=$this->input->post('total_item_discount_amount');
                $total_tax=$this->input->post('total_tax');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
                $sales_quotation_guid=  $this->input->post('sales_quotation_guid');
                if($sales_quotation_guid==""){
                    $sales_quotation_guid='non';
                }else{
                    $this->load->model('sales');
                    $this->sales->approve_sales_quotation_to_sales_order($sales_quotation_guid) ;
                }
              $value=array('quotation_id'=>$sales_quotation_guid,'total_tax'=>$total_tax,'total_discount'=>$total_discount,'customer_discount_amount'=>$customer_discount_amount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'exp_date'=>$expdate,'code'=>$order_number,'date'=>$order_date,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=   $this->posnic->posnic_add_record($value,'sales_order');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $price=  $this->input->post('new_item_price');
                $stock=  $this->input->post('new_item_stock_id');
                $item_discount=  $this->input->post('new_item_discount');
                $item_tax=  $this->input->post('new_item_tax');
                $item_tax2=  $this->input->post('new_item_tax2');
                $this->load->model('sales');
                for($i=0;$i<count($item);$i++){  
                    $this->sales->add_sales_order($guid,$item[$i],$quty[$i],$price[$i],$stock[$i],$item_discount[$i],$item_tax[$i],$item_tax2[$i],$i);
                
                        
                }
                $this->posnic->posnic_master_increment_max('sales_order')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
        if(isset($_POST['sales_order_guid'])){
            if($this->session->userdata['sales_order_per']['edit']==1){
                $this->form_validation->set_rules('customers_guid',$this->lang->line('customers_guid'), 'required');
                $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
                $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
                $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
                $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
                $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
                $this->form_validation->set_rules('discount_percentage', $this->lang->line('discount_percentage'), 'numeric');                      
                $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');    

                $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'));                      
                $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'numeric');                      
                $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'numeric');                      
                $this->form_validation->set_rules('new_item_stock_id[]', $this->lang->line('new_item_stock_id')); 

                $this->form_validation->set_rules('items_id[]', $this->lang->line('items_id')); 
                $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_quty'), 'numeric'); 
                $this->form_validation->set_rules('items_discount_per[]', $this->lang->line('items_discount_per'), 'numeric'); 
                $this->form_validation->set_rules('items_stock[]', $this->lang->line('items_stock'));         
        
            if ( $this->form_validation->run() !== false ) {    
                $customer=  $this->input->post('customers_guid');
                $expdate=strtotime($this->input->post('expiry_date'));
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('no_of_item');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $total_discount=$this->input->post('total_item_discount_amount');
                $total_tax=$this->input->post('total_tax');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
               
                $value=array('customer_discount_amount'=>$customer_discount_amount,'total_tax'=>$total_tax,'total_discount'=>$total_discount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'exp_date'=>$expdate,'date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
                $guid=  $this->input->post('sales_order_guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'sales_order');          
                $sq=  $this->input->post('sq_items');
                $quty=  $this->input->post('items_quty');
                $item_tax=  $this->input->post('items_tax');
                $item_tax2=  $this->input->post('items_tax2');
                for($i=0;$i<count($sq);$i++){
                    $this->load->model('sales');
                    $this->sales->update_sales_order($sq[$i],$quty[$i],$item_tax[$i],$item_tax2[$i]);  
                }
                $delete=  $this->input->post('r_items');
                for($j=0;$j<count($delete);$j++){
                    $this->load->model('sales');
                    $this->sales->delete_order_item($delete[$j]);
                }
                    
                $new_item=  $this->input->post('new_item_id');
                $new_quty=  $this->input->post('new_item_quty');
                $new_price=  $this->input->post('new_item_price');
                $stock=  $this->input->post('new_item_stock_id');
                $item_discount=  $this->input->post('new_item_discount');
                $item_tax=  $this->input->post('new_item_tax');
                $item_tax2=  $this->input->post('new_item_tax2');
                if(count($stock)>0){
                    for($i=0;$i<count($stock);$i++){
                        if($new_item[$i]!="" || $new_item[$i]!=0){
                        $this->sales->add_sales_order($guid,$new_item[$i],$new_quty[$i],$new_price[$i],$stock[$i],$item_discount[$i],$item_tax[$i],$item_tax2[$i],$i);
                        }
                    }
                }
                    
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
        }
        
        
    }
        
/*
 * get customer details for sales order
 *  */       
// functoon starts
function search_customer(){
    $search= $this->input->post('term'); 
    $this->load->model('sales');
    $data=$this->sales->search_customers($search);
    echo json_encode($data);
}
// function end

/*
 * get sales quotaion details for purchase order
 *  */       
// functoon starts
function search_sales_quotation(){
    $search= $this->input->post('term');  
    $this->load->model('sales')      ;
    $data= $this->sales->search_sales_quotation($search)    ;
    echo json_encode($data);
}
// function end

/*
Delete purchase order if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  order
            if($this->input->post('guid')){ 
                $this->load->model('sales');
                $guid=$this->input->post('guid');
                $status=$this->sales->check_approve($guid);// check if the purchase order was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'sales_order'); // delete the purchase order
                        echo 'TRUE';
                    }else{
                        echo 'Approved';
                    }
            
            }
           }else{
            echo 'FALSE';
        }
    
}
// function end

function  get_sales_order($guid){
    if($this->session->userdata['sales_order_per']['edit']==1){
    $this->load->model('sales');
    $data=  $this->sales->get_sales_order($guid);
    echo json_encode($data);
    }
}
/* get sales quotation details to sales order
function start */
function  get_sales_quotation($guid){
    if($this->session->userdata['sales_order_per']['add']==1){
    $this->load->model('sales');
    $data=  $this->sales->get_sales_quotation($guid);
    echo json_encode($data);
    }
}
/* function end*/

function sales_order_approve(){
     if($this->session->userdata['sales_order_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('sales');
            $this->sales->approve_order($id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function order_number(){
       $data[]= $this->posnic->posnic_master_max('sales_order')    ;
       echo json_encode($data);
}
/*
 * search items to purchase order with or like 
 *  */

function search_items(){
    $search= $this->input->post('term');
    $guid= $this->input->post('suppler');
    $this->load->model('sales');
    $data= $this->sales->search_items($search);      
    echo json_encode($data);
       
        
}
function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
}
?>
