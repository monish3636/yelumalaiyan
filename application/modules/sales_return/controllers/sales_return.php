<?php
class Sales_return extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='sales_return';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
//        $this->load->model('stock');
//        $this->stock->search_items('','62245c40fad9bd6a1acead37243d0b02');
//         $this->stock->search_items('','667a901118c7eba0cb686b6dbbca1b48');
//         $this->stock->search_items('','fc157016310c6314cc8b3b69c34d730e');
    }
    // sales order data table
    function data_table(){
        $aColumns = array( 'guid','code','code','date','no_items','total_amount','active_status','stock_status' );	
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
					   
			$this->load->model('stock')	   ;
                        
			 $rResult1 = $this->stock->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->stock->count($this->session->userdata['branch_id']);
		
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
				else if ( $aColumns[$i]== 'po_date' )
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
        $this->session->userdata['customer_guid']=$suid;
    }
    
   
 
    
  
function save(){      
     if($this->session->userdata['sales_return_per']['add']==1){
    
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('sales_bill_id', $this->lang->line('sales_bill_id'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 

                       
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                    
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'required|numeric');                      
                         
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'numeric');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'required|numeric');                       
           
            if ( $this->form_validation->run() !== false ) {    
                $pono= $this->input->post('order_number');
                $bill= $this->input->post('sales_bill_id');
                $podate= strtotime($this->input->post('order_date'));
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
  
     
              $value=array('sales_bill_id'=>  $this->input->post('sales_bill_id'),'code'=>$pono,'date'=>$podate,'note'=>$note,'remark'=>$remark,'no_items'=>$total_items,'total_amount'=>$total_amount);
              $guid=   $this->posnic->posnic_add_record($value,'sales_return');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $sell=  $this->input->post('new_item_price');
                $net=  $this->input->post('new_item_total');
                $tax=  $this->input->post('new_item_tax');
                $tax2=  $this->input->post('new_item_tax2');
           
                for($i=0;$i<count($item);$i++){
                        $this->load->model('stock');
                       
                        $this->stock->add_sales_return($guid,$item[$i],$quty[$i],$sell[$i],$tax[$i],$tax2[$i],$net[$i]);
                
                        
                }
                $this->posnic->posnic_master_increment_max('sales_return')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            if(isset($_POST['sales_return_guid'])){
      if($this->session->userdata['sales_return_per']['edit']==1){
       
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                       
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'is_money_multi'); 
        
        
      
        
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'));
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'is_money_multi'); 
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'is_money_multi');                     
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'is_money_multi'); 
        
        
        $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_quty'), 'is_money_multi');                      
        $this->form_validation->set_rules('items_cost[]', $this->lang->line('items_cost'), 'is_money_multi');                      
        $this->form_validation->set_rules('items_price[]', $this->lang->line('items_price'), 'is_money_multi');                          
        $this->form_validation->set_rules('items_total[]', $this->lang->line('items_total'), 'is_money_multi');                      
        $this->form_validation->set_rules('items_tax[]', $this->lang->line('items_tax'), 'is_money_multi');
        
            if ( $this->form_validation->run() !== false ) {    
                $guid=  $this->input->post('sales_return_guid');
                $podate= strtotime($this->input->post('order_date'));
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
  
     
              $value=array('date'=>$podate,'note'=>$note,'remark'=>$remark,'no_items'=>$total_items,'total_amount'=>$total_amount);
              $guid=  $this->input->post('sales_return_guid');
              $update_where=array('guid'=>$guid);
              $this->posnic->posnic_update_record($value,$update_where,'sales_return');
          
                $item=  $this->input->post('items_id');
                $quty=  $this->input->post('items_quty');
                $sell=  $this->input->post('items_price');
                $net=  $this->input->post('items_total');
                $tax=  $this->input->post('items_tax');
                $tax2=  $this->input->post('items_tax22');
                for($i=0;$i<count($item);$i++){
               
                        $where=array('order_id'=>$guid,'item'=>$item[$i]);
                        $this->load->model('stock');
                        $this->stock->update_sales_return($guid,$item[$i],$quty[$i],$sell[$i],$tax[$i],$tax2[$i],$net[$i]);
                  
                }
                $delete=  $this->input->post('r_items');
                for($j=0;$j<count($delete);$j++){
                     $this->stock->delete_order_item($delete[$j]);
                }
                    
                $new_item=  $this->input->post('new_item_id');
                $new_quty=  $this->input->post('new_item_quty');
                $new_sell=  $this->input->post('new_item_price');
                $new_net=  $this->input->post('new_item_total');
                $new_tax=  $this->input->post('new_item_tax');
                $new_tax2=  $this->input->post('new_item_tax');
                for($i=0;$i<count($new_quty);$i++){
                    if($new_quty[$i]!=""){          
                      $this->stock->add_sales_return($guid,$new_item[$i],$new_quty[$i],$new_sell[$i],$new_tax[$i],$new_tax2[$i],$new_net[$i]);
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
 * get customer details for stock transfer 
 *  */       
// functoon starts
function search_customer(){
    $search= $this->input->post('term');  
    $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
    $data= $this->posnic->posnic_select2('customers',$like)    ;
    echo json_encode($data);
}
// function end
/*
 * get branch details forstock transfer 
 *  */       
// functoon starts
function search_sales_bill(){
    $search= $this->input->post('term');  
    $this->load->model('stock');
    $data= $this->stock->search_sales_bill($search)    ;
    echo json_encode($data);
}
// function end

/*
Delete sales order if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete sales  order
            if($this->input->post('guid')){ 
                $this->load->model('stock');
                $guid=$this->input->post('guid');
                $status=$this->stock->check_approve($guid);// check if the sales order was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'sales_return'); // delete the sales order
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

    function  get_sales_return($guid){
        if($this->session->userdata['sales_return_per']['edit']==1){
        $this->load->model('stock');
        $data=  $this->stock->get_sales_return($guid);
        echo json_encode($data);
        }
    }

    function  view_sales_return($guid){
        if($this->session->userdata['sales_return_per']['view']==1){
        $this->load->model('stock');
        $data=  $this->stock->get_sales_return($guid);
        echo json_encode($data);
        }
    }

function sales_return_approve(){
     if($this->session->userdata['sales_return_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('stock');
            $this->stock->sales_return_approve($id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function order_number(){
       $data[]= $this->posnic->posnic_master_max('sales_return')    ;
       echo json_encode($data);
}
/*
 * search items to sales order with or like 
 *  */

function search_items(){
    $search= $this->input->post('term');
   $bill=  $this->input->post('bill');
    $this->load->model('stock');
    $data= $this->stock->search_items($search,$bill);      
    echo json_encode($data);
       
        
}

           /* get sales order and invoice settings
     function start     */
    function  get_invoice_settings_and_sales_return($guid){
        if($this->session->userdata['sales_return_per']['print_invoice']==1){
        $this->load->model('stock');
        $data[0]=  $this->stock->sales_return_invoice($guid); // get purchas eorder details
         // read setting config file
        if($this->session->flashdata('sales_return_invoice')==""){
            $this->config->load("settings");
            $value=array();
            $value=$this->config->item('invoice');
            $this->session->set_flashdata('sales_return_invoice',$value); 
            $data[1]=$value; 
        }else{        
            $data[1]=$this->session->flashdata('sales_return_invoice'); // get invoice array
        }
        echo json_encode($data);
        }
    }
    /* function end*/
      /* get sales order invoice getting details*/
    function get_invoice_settings(){
        if($this->session->userdata['sales_return_per']['invoice_setting']==1){
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
                $posnic_sales_retun_id=$this->input->post('posnic_sales_retun_id')==1?1:0;
                $data=$data.'"posnic_sales_retun_id"=>'.$posnic_sales_retun_id.','."\n";
                $posnic_sales_retun_no=$this->input->post('posnic_sales_retun_no')==1?1:0;
                $data=$data.'"posnic_sales_retun_no"=>'.$posnic_sales_retun_no.','."\n";
                $posnic_sales_retun_date=$this->input->post('posnic_sales_retun_date')==1?1:0;
                $data=$data.'"posnic_sales_retun_date"=>'.$posnic_sales_retun_date.','."\n";
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
                $posnic_item_tax1=$this->input->post('posnic_item_tax1')==1?1:0;
                $data=$data.'"posnic_item_tax1"=>'.$posnic_item_tax1.','."\n";
                $posnic_item_tax2=$this->input->post('posnic_item_tax2')==1?1:0;
                $data=$data.'"posnic_item_tax2"=>'.$posnic_item_tax2.','."\n";
                $posnic_item_discount1=$this->input->post('posnic_item_discount1')==1?1:0;
                $data=$data.'"posnic_item_discount1"=>'.$posnic_item_discount1.','."\n";
                $posnic_item_discount2=$this->input->post('posnic_item_discount2')==1?1:0;
                $data=$data.'"posnic_item_discount2"=>'.$posnic_item_discount2.','."\n";
                $posnic_item_subtotal=$this->input->post('posnic_item_subtotal')==1?1:0;
                $data=$data.'"posnic_item_subtotal"=>'.$posnic_item_subtotal.','."\n";
                $posnic_sales_return_subtotal=$this->input->post('posnic_sales_return_subtotal')==1?1:0;
                $data=$data.'"posnic_sales_return_subtotal"=>'.$posnic_sales_return_subtotal.','."\n";
                $posnic_inclusive_total_tax=$this->input->post('posnic_inclusive_total_tax')==1?1:0;
                $data=$data.'"posnic_inclusive_total_tax"=>'.$posnic_inclusive_total_tax.','."\n";
                $posnic_exclusive_total_tax=$this->input->post('posnic_exclusive_total_tax')==1?1:0;
                $data=$data.'"posnic_exclusive_total_tax"=>'.$posnic_exclusive_total_tax.','."\n";
                $posnic_total_item_discount=$this->input->post('posnic_total_item_discount')==1?1:0;
                $data=$data.'"posnic_total_item_discount"=>'.$posnic_total_item_discount.','."\n";
                $posnic_grand_total=$this->input->post('posnic_grand_total')==1?1:0;
                $data=$data.'"posnic_grand_total"=>'.$posnic_grand_total.','."\n";
                $posnic_customer_mail=$this->input->post('posnic_customer_mail')==1?1:0;
                $data=$data.'"posnic_customer_mail"=>'.$posnic_customer_mail.','."\n";
                $posnic_message=$this->input->post('posnic_message')==""?"'POSNIC'":$this->input->post('posnic_message');
                $data=$data.'"posnic_message"=>'.'"'.$posnic_message.'"';
                $data=$data.');';                
                $this->load->helper('file');
                write_file('application/modules/sales_return/config/settings.php', $data);
                $this->config->load("settings");
                $this->session->set_flashdata('sales_return_invoice', $this->config->item('invoice'));
                echo 'TRUE';
    }
}
?>
