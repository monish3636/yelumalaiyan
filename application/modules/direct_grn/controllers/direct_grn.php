<?php
class Direct_grn extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        //   $this->get_list();
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='direct_grn';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    // Direct G R N Data table
    function data_table(){
        $aColumns = array( 'guid','grn_no','grn_no','c_name','s_name','grn_date','total_items','total_amt','active_status','order_status' );	
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
					   
			$this->load->model('purchase')	   ;
                        
			 $rResult1 = $this->purchase->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->purchase->count($this->session->userdata['branch_id']);
		
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
				else if ( $aColumns[$i]== 'grn_date' )
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
    
   
   function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $like=array('code'=>$q);    
               
                $where='suppliers_x_items.item_id=items.guid AND suppliers_x_items.active = 0  AND suppliers_x_items.item_active  = 0 AND suppliers_x_items.supplier_id ="'.$this->session->userdata['supplier_guid'].'" AND items.active_status=0  AND items.active=0  ';
                $data=$this->posnic-> posnic_join_like('suppliers_x_items','items',$like,$where);
        echo json_encode($data);
    }   
    
 
 
    
  
function save(){      
     if($this->session->userdata['direct_grn_per']['add']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');                      
         $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount_per2[]', $this->lang->line('new_item_discount_per'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_discount2[]', $this->lang->line('new_item_discount'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'required|is_money_multi');                      
        $this->form_validation->set_rules('new_item_tax2[]', $this->lang->line('new_item_tax'), 'is_money_multi');                          
           
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
              $value=array('supplier_id'=>$supplier,'grn_no'=>$pono,'grn_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$total_amount,'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
              $guid=   $this->posnic->posnic_add_record($value,'direct_grn');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $cost=  $this->input->post('new_item_cost');
                $free=  $this->input->post('new_item_free');
                $sell=  $this->input->post('new_item_price');
                $mrp=  $this->input->post('new_item_mrp');
                $net=  $this->input->post('new_item_total');
                $per=  $this->input->post('new_item_discount_per');
                $dis=  $this->input->post('new_item_discount');
                $tax=  $this->input->post('new_item_tax');
                $per2=  $this->input->post('new_item_discount_per2');
                $dis2=  $this->input->post('new_item_discount2');
                $tax2=  $this->input->post('new_item_tax2');
           
                for($i=0;$i<count($item);$i++){
              
                        $item_value=array('order_id'=>$guid,'discount_per2'=>$per2[$i],'discount_amount2'=>$dis2[$i],'tax2'=>$tax2[$i],'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'branch_id'=>  $this->session->userdata('branch_id'));
                        $this->load->model('purchase');
                        $this->purchase->add_items($item_value);
                
                        
                }
                $this->posnic->posnic_master_increment_max('direct_grn')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            if(isset($_POST['direct_grn_guid'])){
      if($this->session->userdata['direct_grn_per']['edit']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                     
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        
        
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');    
        
        
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'is_money_multi');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'is_money_multi');                      
      
        if($this->input->post('new_item_id')){
            $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'is_money_multi');                      
            $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'is_money_multi');                      
            $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'is_money_multi');  
            $this->form_validation->set_rules('new_item_discount_per2[]', $this->lang->line('new_item_discount_per'), 'is_money_multi');                      
            $this->form_validation->set_rules('new_item_discount2[]', $this->lang->line('new_item_discount'), 'is_money_multi');                      
            $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'is_money_multi');                      
            $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'required|is_money_multi');                      
            $this->form_validation->set_rules('new_item_tax2[]', $this->lang->line('new_item_tax'), 'is_money_multi');  
        }
        if($this->input->post('items_id')){
            $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_quty'), 'numeric');                      
            $this->form_validation->set_rules('items_cost[]', $this->lang->line('items_cost'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_free[]', $this->lang->line('items_free'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_mrp[]', $this->lang->line('items_mrp'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_price[]', $this->lang->line('items_price'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_discount_per[]', $this->lang->line('items_discount_per'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_discount[]', $this->lang->line('items_discount'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_tax[]', $this->lang->line('items_tax'), 'is_money_multi');
            $this->form_validation->set_rules('items_discount_per2[]', $this->lang->line('items_discount_per'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_discount2[]', $this->lang->line('items_discount'), 'is_money_multi');                      
            $this->form_validation->set_rules('items_tax2[]', $this->lang->line('items_tax'), 'is_money_multi');
            $this->form_validation->set_rules('items_total[]', $this->lang->line('items_total'), 'is_money_multi');                       
        }   
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
             
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
              $value=array('supplier_id'=>$supplier,'grn_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=  $this->input->post('direct_grn_guid');
              $update_where=array('guid'=>$guid);
              $this->posnic->posnic_update_record($value,$update_where,'direct_grn');
          
                $item=  $this->input->post('items_id');
                $quty=  $this->input->post('items_quty');
                $cost=  $this->input->post('items_cost');
                $free=  $this->input->post('items_free');
                $sell=  $this->input->post('items_price');
                $mrp=  $this->input->post('items_mrp');
                $net=  $this->input->post('items_total');
                $per=  $this->input->post('items_discount_per');
                $dis=  $this->input->post('items_discount');
                $tax=  $this->input->post('items_tax');
                $per2=  $this->input->post('items_discount_per2');
                $dis2=  $this->input->post('items_discount2');
                $tax2=  $this->input->post('items_tax2');
                for($i=0;$i<count($item);$i++){
               
                       $where=array('order_id'=>$guid,'item'=>$item[$i]);
                       $item_value=array('order_id'=>$guid,'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'discount_per2'=>$per2[$i],'discount_amount2'=>$dis2[$i],'tax2'=>$tax2[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i]);
                       $this->posnic->posnic_update_record($item_value,$where,'purchase_items');
                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){
                        $this->load->model('purchase');
                        
                         $this->purchase->delete_order_item($delete[$j]);
                    }
                    
                $new_item=  $this->input->post('new_item_id');
                $new_quty=  $this->input->post('new_item_quty');
                $new_cost=  $this->input->post('new_item_cost');
                $new_free=  $this->input->post('new_item_free');
                $new_sell=  $this->input->post('new_item_price');
                $new_mrp=  $this->input->post('new_item_mrp');
                $new_net=  $this->input->post('new_item_total');
                $new_per=  $this->input->post('new_item_discount_per');
                $new_dis=  $this->input->post('new_item_discount');
                $new_tax=  $this->input->post('new_item_tax');
                $new_per2=  $this->input->post('new_item_discount_per2');
                $new_dis2=  $this->input->post('new_item_discount2');
                $new_tax2=  $this->input->post('new_item_tax2');
                for($i=0;$i<count($new_quty);$i++){
                    if($new_quty[$i]!=""){

                                  $new_item_value=array('order_id'=>$guid,'discount_per2'=>$new_per2[$i],'discount_amount2'=>$new_dis2[$i],'tax2'=>$new_tax2[$i],'discount_per'=>$new_per[$i],'discount_amount'=>$new_dis[$i],'tax'=>$new_tax[$i],'item'=>$new_item[$i],'quty'=>$new_quty[$i],'free'=>$new_free[$i],'cost'=>$new_cost[$i],'sell'=>$new_sell[$i],'mrp'=>$new_mrp[$i],'amount'=>$new_net[$i]);
                                  $this->load->model('purchase');
                                  $this->purchase->add_items($item_value);
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
        
        
function convert_date($date){
   $new=array();
   $new[]= date('n.j.Y', strtotime('+0 year, +0 days',$date));
   echo json_encode($new);
}
function search_supplier(){
    $search= $this->input->post('term');
    $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
    $data= $this->posnic->posnic_select2('suppliers',$like)    ;
    echo json_encode($data);
        
}
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){
            if($this->input->post('guid')){
                $this->load->model('purchase');
                $guid=$this->input->post('guid');
                $status=$this->purchase->check_approve($guid);
                    if($status!=FALSE){
                         $this->posnic->posnic_delete($guid,'direct_grn');
                            
                        echo 'TRUE';
                    }else{
                        echo 'Approved';
                    }
            
            }
           }else{
            echo 'FALSE';
        }
    
}
function  get_direct_grn($guid){
    if($this->session->userdata['direct_grn_per']['edit']==1){
    $this->load->model('purchase');
    $data=  $this->purchase->get_direct_grn($guid);
    echo json_encode($data);
    }
}

function direct_grn_approve(){
     if($this->session->userdata['direct_grn_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('purchase');
            $this->purchase->approve_grn($id);
            $this->purchase->direct_grn_stock($id,$this->session->userdata['branch_id']);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function order_number(){
       $data[]= $this->posnic->posnic_master_max('direct_grn')    ;
       echo json_encode($data);
}
    function search_items(){
            $search= $this->input->post('term');
            $guid= $this->input->post('suppler');
            $this->load->model('purchase');
            $data= $this->purchase->search_items($search,$this->session->userdata['branch_id'],$guid);      
            echo json_encode($data);



    }   
       
    /* get purchase order 
     function start     */
    function  direct_grn_view($guid){
        if($this->session->userdata['direct_grn_per']['view']==1){
        $this->load->model('purchase');
        $data=  $this->purchase->get_direct_grn($guid);
        echo json_encode($data);
        }
    }
    /* function end*/
    /* get purchase order and invoice settings
     function start     */
    function  get_invoice_settings_and_direct_grn($guid){
        if($this->session->userdata['direct_grn_per']['print_invoice']==1){
        $this->load->model('purchase');
        $data[0]=  $this->purchase->direct_grn_invoice($guid); // get purchas eorder details
         // read setting config file
        if($this->session->flashdata('direct_grn_invoice')==""){
            $this->config->load("settings");
            $value=array();
            $value=$this->config->item('invoice');
            $this->session->set_flashdata('direct_grn_invoice',$value); 
            $data[1]=$value; 
        }else{        
            $data[1]=$this->session->flashdata('direct_grn_invoice'); // get invoice array
        }
        echo json_encode($data);
        }
    }
    /* function end*/
     /* get purchase order invoice getting details*/
    function get_invoice_settings(){
        if($this->session->userdata['direct_grn_per']['invoice_setting']==1){
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
                $posnic_supplier_name=$this->input->post('posnic_supplier_name')==1?1:0;
                $data=$data.'"posnic_supplier_name"=>'.$posnic_supplier_name.','."\n";
                $posnic_supplier_company=$this->input->post('posnic_supplier_company')==1?1:0;
                $data=$data.'"posnic_supplier_company"=>'.$posnic_supplier_company.','."\n";
                $posnic_supplier_address=$this->input->post('posnic_supplier_address')==1?1:0;
                $data=$data.'"posnic_supplier_address"=>'.$posnic_supplier_address.','."\n";
                $posnic_supplier_city=$this->input->post('posnic_supplier_city')==1?1:0;
                $data=$data.'"posnic_supplier_city"=>'.$posnic_supplier_city.','."\n";
                $posnic_supplier_state=$this->input->post('posnic_supplier_state')==1?1:0;
                $data=$data.'"posnic_supplier_state"=>'.$posnic_supplier_state.','."\n";
                $posnic_supplier_country=$this->input->post('posnic_supplier_country')==1?1:0;
                $data=$data.'"posnic_supplier_country"=>'.$posnic_supplier_country.','."\n";
                $posnic_supplier_zip=$this->input->post('posnic_supplier_zip')==1?1:0;
                $data=$data.'"posnic_supplier_zip"=>'.$posnic_supplier_zip.','."\n";
                $posnic_supplier_email=$this->input->post('posnic_supplier_email')==1?1:0;
                $data=$data.'"posnic_supplier_email"=>'.$posnic_supplier_email.','."\n";
                $posnic_supplier_phone=$this->input->post('posnic_supplier_phone')==1?1:0;
                $data=$data.'"posnic_supplier_phone"=>'.$posnic_supplier_phone.','."\n";
                $posnic_item_name=$this->input->post('posnic_item_name')==1?1:0;
                $data=$data.'"posnic_item_name"=>'.$posnic_item_name.','."\n";
                $posnic_item_sku=$this->input->post('posnic_item_sku')==1?1:0;
                $data=$data.'"posnic_item_sku"=>'.$posnic_item_sku.','."\n";
                $posnic_item_price=$this->input->post('posnic_item_price')==1?1:0;
                $data=$data.'"posnic_item_price"=>'.$posnic_item_price.','."\n";
                $posnic_item_selling_price=$this->input->post('posnic_item_selling_price')==1?1:0;
                $data=$data.'"posnic_item_selling_price"=>'.$posnic_item_selling_price.','."\n";
                $posnic_item_mrp=$this->input->post('posnic_item_mrp')==1?1:0;
                $data=$data.'"posnic_item_mrp"=>'.$posnic_item_mrp.','."\n";
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
                $posnic_item_discount2=$this->input->post('posnic_item_discount2')==1?1:0;
                $data=$data.'"posnic_item_discount2"=>'.$posnic_item_discount2.','."\n";
                $posnic_item_subtotal=$this->input->post('posnic_item_subtotal')==1?1:0;
                $data=$data.'"posnic_item_subtotal"=>'.$posnic_item_subtotal.','."\n";
                $posnic_direct_grn_subtotal=$this->input->post('posnic_direct_grn_subtotal')==1?1:0;
                $data=$data.'"posnic_direct_grn_subtotal"=>'.$posnic_direct_grn_subtotal.','."\n";
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
                $posnic_supplier_mail=$this->input->post('posnic_supplier_mail')==1?1:0;
                $data=$data.'"posnic_supplier_mail"=>'.$posnic_supplier_mail.','."\n";
                $posnic_message=$this->input->post('posnic_message')==""?"'POSNIC'":$this->input->post('posnic_message');
                $data=$data.'"posnic_message"=>'.'"'.$posnic_message.'"';
                $data=$data.');';                
                $this->load->helper('file');
                write_file('application/modules/direct_grn/config/settings.php', $data);
                $this->config->load("settings");
                $this->session->set_flashdata('direct_grn_invoice', $this->config->item('invoice'));
                echo 'TRUE';
    }
}
?>
