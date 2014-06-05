<?php
class Decomposition extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='decomposition';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // sales quotation decomposition data table
    function data_table(){
        $aColumns = array( 'guid','code','code','c_name','s_name','date','total_items','total_amt','active_status','quotation_status' );	
	$start = "";
			$end="";
		
		if ( $this->input->get_post('iDisplayLength') != '-1' )	{
			$start = $this->input->get_post('iDisplayStart');
			$end=	 $this->input->get_post('iDisplayLength');              
		}	
		$decomposition="";
		if ( isset( $_GET['iSortCol_0'] ) )
		{	
			for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
				{
					$decomposition.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
				}
			}
			
					$decomposition = substr_replace( $decomposition, "", -1 );
					
		}
		
		$like = array();
		
			if ( $_GET['sSearch'] != "" )
		{
		$like =array(
                    'po_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('items')	   ;
                        
			 $rResult1 = $this->items->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->items->count($this->session->userdata['branch_id']);
		
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
     if($this->session->userdata['sales_quotation_per']['add']==1){
        $this->form_validation->set_rules('customers_guid',$this->lang->line('customers_guid'), 'required');
        $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
        $this->form_validation->set_rules('decomposition_number', $this->lang->line('decomposition_number'), 'required');
        $this->form_validation->set_rules('quotation_date', $this->lang->line('quotation_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');                      
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_stock_id[]', $this->lang->line('new_item_stock_id'), 'required');                      
           
            if ( $this->form_validation->run() !== false ) {    
                $customer=  $this->input->post('customers_guid');
                $decomposition_number=  $this->input->post('decomposition_number');
                $expdate=strtotime($this->input->post('expiry_date'));
                $quotation_date= strtotime($this->input->post('quotation_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
  
     
              $value=array('customer_discount_amount'=>$customer_discount_amount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'exp_date'=>$expdate,'code'=>$decomposition_number,'date'=>$quotation_date,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=   $this->posnic->posnic_add_record($value,'sales_quotation');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $stock=  $this->input->post('new_item_stock_id');
                $item_discount=  $this->input->post('new_item_discount');
           
                for($i=0;$i<count($item);$i++){
              
                    $this->load->model('items');
                    $this->items->add_sales_quotation($guid,$item[$i],$quty[$i],$stock[$i],$item_discount[$i],$i);
                
                        
                }
                $this->posnic->posnic_master_increment_max('sales_quotation')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            if(isset($_POST['sales_quotation_guid'])){
      if($this->session->userdata['sales_quotation_per']['edit']==1){
        $this->form_validation->set_rules('customers_guid',$this->lang->line('customers_guid'), 'required');
        $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
        $this->form_validation->set_rules('quotation_date', $this->lang->line('quotation_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
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
                $podate= strtotime($this->input->post('quotation_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                  $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
     
              $value=array('customer_discount_amount'=>$customer_discount_amount,'customer_discount'=>$customer_discount,'customer_id'=>$customer,'exp_date'=>$expdate,'date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=  $this->input->post('sales_quotation_guid');
              $update_where=array('guid'=>$guid);
             $this->posnic->posnic_update_record($value,$update_where,'sales_quotation');
          
                $sq=  $this->input->post('sq_items');
                $quty=  $this->input->post('items_quty');
                for($i=0;$i<count($sq);$i++){
                    $this->load->model('items');
                    $this->items->update_quotation($sq[$i],$quty[$i]);
                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){
                        $this->load->model('items');
                        
                         $this->items->delete_decomposition_item($delete[$j]);
                    }
                    
                 $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $stock=  $this->input->post('new_item_stock_id');
               
                $item_discount=  $this->input->post('new_item_discount');
           if(count($stock)>0){
                for($i=0;$i<count($stock);$i++){
                    if($item[$i]!="" || $item[$i]!=0){
                    $this->items->add_sales_quotation($guid,$item[$i],$quty[$i],$stock[$i],$item_discount[$i],$i);
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
Delete purchase decomposition if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  decomposition
            if($this->input->post('guid')){ 
                $this->load->model('items');
                $guid=$this->input->post('guid');
                $status=$this->items->check_approve($guid);// check if the purchase decomposition was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'sales_quotation'); // delete the purchase decomposition
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

function  get_sales_quotation($guid){
    if($this->session->userdata['sales_quotation_per']['edit']==1){
    $this->load->model('items');
    $data=  $this->items->get_sales_quotation($guid);
    echo json_encode($data);
    }
}

function sales_quotation_approve(){
     if($this->session->userdata['sales_quotation_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('items');
            $this->items->approve_decomposition($id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function decomposition_number(){
       $data[]= $this->posnic->posnic_master_max('decomposition_number')    ;
       echo json_encode($data);
}
/*
 * search items to purchase decomposition with or like 
 *  */

function search_items(){
    $search= $this->input->post('term');
    $this->load->model('items');
    $data= $this->items->search_items($search);      
    echo json_encode($data);
       
        
}
function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
}
?>
