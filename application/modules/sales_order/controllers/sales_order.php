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
//        $jib=10;
//        $vao='jib';
//        echo $$vao;
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
/* get sales quotation details to sales order
function start */
function  view_sales_quotation($guid){
    if($this->session->userdata['sales_order_per']['view']==1){
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
  function get_invoice_settings_and_sales_order($guid){
        if($this->session->userdata['sales_order_per']['print_invoice']==1){
            $this->load->model('sales');
            $data[0]=  $this->sales->sales_order_invoice($guid); // get purchas eorder details
             // read setting config file
            if($this->session->flashdata('sales_order_invoice')==""){
                $this->config->load("settings");
                $value=array();
                $value=$this->config->item('invoice');
                $this->session->set_flashdata('sales_order_invoice',$value); 
                $data[1]=$value; 
            }else{        
                $data[1]=$this->session->flashdata('sales_order_invoice'); // get invoice array
            }
            echo json_encode($data);
        }
    }
 /* get purchase order invoice getting details*/
    function get_invoice_settings(){
        if($this->session->userdata['sales_order_per']['invoice_setting']==1){
            $this->config->load("settings"); // read setting config file
            $settings =$this->config->item('invoice'); // get invoice array
            echo json_encode($settings);
        }
    }
    function save_invoice_settings(){
                
                $con="<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');"."\n".' $config["invoice"]=array(';
          
                $posnic_order_id=$this->input->post('posnic_order_id')==1? 1 : 0;
                $data=$con.'"posnic_order_id"=>'.$posnic_order_id.','."\n";
                $posnic_number=$this->input->post('posnic_number')==1?1:0;
                $data=$data.'"posnic_number"=>'.$posnic_number.','."\n";
                $posnic_date=$this->input->post('posnic_date')==1?1:0;
                $data=$data.'"posnic_date"=>'.$posnic_date.','."\n";
                $posnic_expiry=$this->input->post('posnic_expiry')==1?1:0;
                $data=$data.'"posnic_expiry"=>'.$posnic_expiry.','."\n";
                $posnic_barcode=$this->input->post('posnic_barcode')==1?1:0;
                $data=$data.'"posnic_barcode"=>'.$posnic_barcode.','."\n";
                $posnic_branch_code=$this->input->post('posnic_branch_code')==1?1:0;
                $data=$data.'"posnic_branch_code"=>'.$posnic_branch_code.','."\n";
                $posnic_branch_name=$this->input->post('posnic_branch_name')==1?1:0;
                $data=$data.'"posnic_branch_name"=>'.$posnic_branch_name.','."\n";
                $posnic_branch_address=$this->input->post('posnic_branch_address')==1?1:0;
                $data=$data.'"posnic_branch_address"=>'.$posnic_branch_address.','."\n";
                $posnic_branch_city=$this->input->post('posnic_branch_city')==1?1:0;
                $data=$data.'"posnic_branch_city"=>'.$posnic_branch_city.','."\n";
                $posnic_branch_state=$this->input->post('posnic_branch_state')==1?1:0;
                $data=$data.'"posnic_branch_state"=>'.$posnic_branch_state.','."\n";
                $posnic_branch_country=$this->input->post('posnic_branch_country')==1?1:0;
                $data=$data.'"posnic_branch_country"=>'.$posnic_branch_country.','."\n";
                $posnic_branch_pin=$this->input->post('posnic_branch_zip')==1?1:0;
                $data=$data.'"posnic_branch_zip"=>'.$posnic_branch_pin.','."\n";
                $posnic_branch_email=$this->input->post('posnic_branch_email')==1?1:0;
                $data=$data.'"posnic_branch_email"=>'.$posnic_branch_email.','."\n";
                $posnic_branch_phone=$this->input->post('posnic_branch_phone')==1?1:0;
                $data=$data.'"posnic_branch_phone"=>'.$posnic_branch_phone.','."\n";
                $posnic_customer_name=$this->input->post('posnic_customer_name')==1?1:0;
                $data=$data.'"posnic_customer_name"=>'.$posnic_customer_name.','."\n";
                $posnic_customer_company=$this->input->post('posnic_customer_company')==1?1:0;
                $data=$data.'"posnic_customer_company"=>'.$posnic_customer_company.','."\n";
                $posnic_customer_address=$this->input->post('posnic_customer_address')==1?1:0;
                $data=$data.'"posnic_customer_address"=>'.$posnic_customer_address.','."\n";
                $posnic_customer_city=$this->input->post('posnic_customer_city')==1?1:0;
                $data=$data.'"posnic_customer_city"=>'.$posnic_customer_city.','."\n";
                $posnic_customer_state=$this->input->post('posnic_customer_state')==1?1:0;
                $data=$data.'"posnic_customer_state"=>'.$posnic_customer_state.','."\n";
                $posnic_customer_country=$this->input->post('posnic_customer_country')==1?1:0;
                $data=$data.'"posnic_customer_country"=>'.$posnic_customer_country.','."\n";
                $posnic_customer_zip=$this->input->post('posnic_customer_zip')==1?1:0;
                $data=$data.'"posnic_customer_zip"=>'.$posnic_customer_zip.','."\n";
                $posnic_customer_email=$this->input->post('posnic_customer_email')==1?1:0;
                $data=$data.'"posnic_customer_email"=>'.$posnic_customer_email.','."\n";
                $posnic_customer_phone=$this->input->post('posnic_customer_phone')==1?1:0;
                $data=$data.'"posnic_customer_phone"=>'.$posnic_customer_phone.','."\n";
                $posnic_item_name=$this->input->post('posnic_item_name')==1?1:0;
                $data=$data.'"posnic_item_name"=>'.$posnic_item_name.','."\n";
                $posnic_item_sku=$this->input->post('posnic_item_sku')==1?1:0;
                $data=$data.'"posnic_item_sku"=>'.$posnic_item_sku.','."\n";
                $posnic_item_price=$this->input->post('posnic_item_price')==1?1:0;
                $data=$data.'"posnic_item_price"=>'.$posnic_item_price.','."\n";
                $posnic_item_quantity=$this->input->post('posnic_item_quantity')==1?1:0;
                $data=$data.'"posnic_item_quantity"=>'.$posnic_item_quantity.','."\n";
                $posnic_item_free_quantity=$this->input->post('posnic_item_free_quantity')==1?1:0;
                $data=$data.'"posnic_item_free_quantity"=>'.$posnic_item_free_quantity.','."\n";
                $posnic_item_tax1=$this->input->post('posnic_item_tax1')==1?1:0;
                $data=$data.'"posnic_item_tax1"=>'.$posnic_item_tax1.','."\n";
                $posnic_item_tax2=$this->input->post('posnic_item_tax2')==1?1:0;
                $data=$data.'"posnic_item_tax2"=>'.$posnic_item_tax2.','."\n";
                $posnic_item_discount1=$this->input->post('posnic_item_discount1')==1?1:0;
                $data=$data.'"posnic_item_discount1"=>'.$posnic_item_discount1.','."\n";
                $posnic_customer_discount=$this->input->post('posnic_customer_discount')==1?1:0;
                $data=$data.'"posnic_customer_discount"=>'.$posnic_customer_discount.','."\n";
                $posnic_item_subtotal=$this->input->post('posnic_item_subtotal')==1?1:0;
                $data=$data.'"posnic_item_subtotal"=>'.$posnic_item_subtotal.','."\n";
                $posnic_sales_order_subtotal=$this->input->post('posnic_sales_order_subtotal')==1?1:0;
                $data=$data.'"posnic_sales_order_subtotal"=>'.$posnic_sales_order_subtotal.','."\n";
                $posnic_inclusive_total_tax=$this->input->post('posnic_inclusive_total_tax')==1?1:0;
                $data=$data.'"posnic_inclusive_total_tax"=>'.$posnic_inclusive_total_tax.','."\n";
                $posnic_exclusive_total_tax=$this->input->post('posnic_exclusive_total_tax')==1?1:0;
                $data=$data.'"posnic_exclusive_total_tax"=>'.$posnic_exclusive_total_tax.','."\n";
                $posnic_total_item_discount=$this->input->post('posnic_total_item_discount')==1?1:0;
                $data=$data.'"posnic_total_item_discount"=>'.$posnic_total_item_discount.','."\n";
                $posnic_discount=$this->input->post('posnic_discount')==1?1:0;
                $data=$data.'"posnic_discount"=>'.$posnic_discount.','."\n";
                $posnic_frieght=$this->input->post('posnic_frieght')==1?1:0;
                $data=$data.'"posnic_frieght"=>'.$posnic_frieght.','."\n";
                $posnic_round_off_amount=$this->input->post('posnic_round_off_amount')==1?1:0;
                $data=$data.'"posnic_round_off_amount"=>'.$posnic_round_off_amount.','."\n";
                $posnic_grand_total=$this->input->post('posnic_grand_total')==1?1:0;
                $data=$data.'"posnic_grand_total"=>'.$posnic_grand_total.','."\n";
                $posnic_customer_mail=$this->input->post('posnic_customer_mail')==1?1:0;
                $data=$data.'"posnic_customer_mail"=>'.$posnic_customer_mail.','."\n";
                $posnic_message=$this->input->post('posnic_message')==""?"'POSNIC'":$this->input->post('posnic_message');
                $data=$data.'"posnic_message"=>'.'"'.$posnic_message.'"';
                $data=$data.');';                
                $this->load->helper('file');
                write_file('application/modules/sales_order/config/settings.php', $data);
                $this->config->load("settings");
                $this->session->set_flashdata('sales_order_invoice', $this->config->item('invoice'));
                echo 'TRUE';
    }
}
?>
