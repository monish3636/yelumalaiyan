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
    // purchase order data table
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
        $this->session->userdata['supplier_guid']=$suid;
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
 * get supplier details for stock transfer 
 *  */       
// functoon starts
function search_supplier(){
    $search= $this->input->post('term');  
    $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
    $data= $this->posnic->posnic_select2('suppliers',$like)    ;
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
Delete purchase order if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  order
            if($this->input->post('guid')){ 
                $this->load->model('stock');
                $guid=$this->input->post('guid');
                $status=$this->stock->check_approve($guid);// check if the purchase order was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'sales_return'); // delete the purchase order
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
 * search items to purchase order with or like 
 *  */

function search_items(){
    $search= $this->input->post('term');
   $bill=  $this->input->post('bill');
    $this->load->model('stock');
    $data= $this->stock->search_items($search,$bill);      
    echo json_encode($data);
       
        
}
function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
}
?>
