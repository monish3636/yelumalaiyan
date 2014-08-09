<?php
class Sales_delivery_note extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='sales_delivery_note';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // goods Receiving Note data table
    function data_table(){
        $aColumns = array( 'sdn_guid','code','code','sales_delivery_note_no','c_name','s_name','date','total_items','total_amount','sales_delivery_note_active','sales_delivery_note_active','guid' );	
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
                    'grn_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('sales')	   ;
                        
			 $rResult1 = $this->sales->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->sales->count($this->session->userdata['branch_id']);
		
		$iTotal =$this->sales->count($this->session->userdata['branch_id']);
		
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
 
function save(){      
     if($this->session->userdata['sales_delivery_note_per']['add']==1){
        $this->form_validation->set_rules('sales_delivery_note_guid',$this->lang->line('sales_delivery_note_guid'), 'required');
        $this->form_validation->set_rules('delivery_date',$this->lang->line('delivery_date'), 'required');
        $this->form_validation->set_rules('dn_no', $this->lang->line('dn_no'), 'required'); 
        $this->form_validation->set_rules('delivered_quty[]', $this->lang->line('delivered_quty'), 'required|numeric'); 
        $this->form_validation->set_rules('items[]', $this->lang->line('items'), 'required'); 
           
            if ( $this->form_validation->run() !== false ) {    
                $so=  $this->input->post('sales_delivery_note_guid');
                $delivery_date=strtotime($this->input->post('delivery_date'));
                $dn_no= $this->input->post('dn_no');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
                $total_discount=$this->input->post('total_item_discount_amount');
                $total_tax=$this->input->post('total_tax');   
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $value=array('customer_discount_amount'=>$customer_discount_amount,'total_tax'=>$total_tax,'total_discount'=>$total_discount,'customer_discount'=>$customer_discount,'sales_delivery_note_no'=>$dn_no,'date'=>$delivery_date,'so'=>$so,'remark'=>$remark,'note'=>$note,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                $guid=   $this->posnic->posnic_add_record($value,'sales_delivery_note');
                $this->load->model('sales');
                $this->sales->update_sales_order_status($so);
                $quty=  $this->input->post('delivered_quty');
                $items=  $this->input->post('items');
           
                for($i=0;$i<count($items);$i++){
                        $this->load->model('sales');
                        $this->sales->update_item_receving($items[$i],$quty[$i],$so,$guid);
                        // $quty[$i];
                       
                }
                $this->posnic->posnic_master_increment_max('sales_delivery_note')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            
      if($this->session->userdata['sales_delivery_note_per']['edit']==1){
       $this->form_validation->set_rules('sales_delivery_note_guid',$this->lang->line('sales_delivery_note_guid'), 'required');
       $this->form_validation->set_rules('guid',$this->lang->line('guid'), 'required');
        $this->form_validation->set_rules('delivery_date',$this->lang->line('delivery_date'), 'required');
        $this->form_validation->set_rules('delivered_quty[]', $this->lang->line('delivered_quty'), 'required|numeric'); 
        $this->form_validation->set_rules('items[]', $this->lang->line('items'), 'required'); 
            if ( $this->form_validation->run() !== false ) {    
                $so=  $this->input->post('sales_delivery_note_guid');
                $guid=  $this->input->post('guid');
                $delivery_date=strtotime($this->input->post('delivery_date'));
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');               
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $customer_discount=  $this->input->post('customer_discount');
                $customer_discount_amount=  $this->input->post('customer_discount_amount');
                $total_discount=$this->input->post('total_item_discount_amount');
                $total_tax=$this->input->post('total_tax');               
                $value=array('customer_discount_amount'=>$customer_discount_amount,'total_tax'=>$total_tax,'total_discount'=>$total_discount,'customer_discount'=>$customer_discount,'date'=>$delivery_date,'so'=>$so,'remark'=>$remark,'note'=>$note,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                $guid=  $this->input->post('guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'sales_delivery_note');
                $quty=  $this->input->post('delivered_quty');
                $items=  $this->input->post('items');           
                $this->load->model('sales');
                for($i=0;$i<count($items);$i++){
                        $this->sales->update_item_receving($items[$i],$quty[$i],$so,$guid);                       
                }   
                    echo 'TRUE';    
                }else{
                    echo 'FALSE';
                }
        }else{
            echo 'Noop';
        }
          
}
        

    function search_sales_order(){
        $search= $this->input->post('term');
        $this->load->model('sales');
        $data= $this->sales->search_sales_order($search,$this->session->userdata['branch_id'])    ;
        echo json_encode($data);
    }
function delete(){
   if($this->session->userdata['sales_delivery_note_per']['delete']==1){
        if($this->input->post('guid')){
            $guid=  $this->input->post('guid');
            $this->load->model('sales');
            $status=$this->sales->check_approve($guid);
           if($status!=FALSE){
            $this->posnic->posnic_delete($guid,'sales_delivery_note');
                echo 'TRUE';
            }else{
                echo 'Approved';
            }
        
        }
    }else{
         echo 'FALSE';
    }
    
}
function  get_sales_order($guid){
  
    $this->load->model('sales');
    $data=  $this->sales->get_sales_order($guid);
    echo json_encode($data);
    
}
    function  get_sales_delivery_note($guid){
        if($this->session->userdata['sales_delivery_note_per']['edit']==1){
            $this->load->model('sales');
            $data=  $this->sales->get_sales_delivery_note($guid);
            echo json_encode($data);
        }
    }
    function  view_sales_delivery_note($guid){
        if($this->session->userdata['sales_delivery_note_per']['view']==1){
            $this->load->model('sales');
            $data=  $this->sales->get_sales_delivery_note($guid);
            echo json_encode($data);
        }
    }
function sdn_approve(){
    if($this->session->userdata['sales_delivery_note_per']['approve']==1){
        $id=  $this->input->post('guid');
        $so=  $this->input->post('so');
        $this->load->model('sales');
        $report=$this->sales->sdn_approve($id,$so);     
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }else{
        echo 'Noop';
    }
}

    function order_number(){
        $data[]= $this->posnic->posnic_master_max('sales_delivery_note')    ;
        echo json_encode($data);
    }
    function search_items(){
        $search= $this->input->post('term');
        $guid= $this->input->post('suppler');
        if($search!=""){
            $this->load->model('purchase');
            $data= $this->purchase->serach_items($search,$this->session->userdata['branch_id'],$guid);      
            echo json_encode($data);
         }

    }
    function get_invoice_settings_and_sales_delivery_note($guid){
        if($this->session->userdata['sales_delivery_note_per']['print_invoice']==1){
            $this->load->model('sales');
            $data[0]=  $this->sales->sales_delivery_note_invoice($guid); // get purchas eorder details
             // read setting config file
            if($this->session->flashdata('sales_delivery_note_invoice')==""){
                $this->config->load("settings");
                $value=array();
                $value=$this->config->item('invoice');
                $this->session->set_flashdata('sales_delivery_note_invoice',$value); 
                $data[1]=$value; 
            }else{        
                $data[1]=$this->session->flashdata('sales_delivery_note_invoice'); // get invoice array
            }
            echo json_encode($data);
        }
    }
 /* get purchase order invoice getting details*/
    function get_invoice_settings(){
        if($this->session->userdata['sales_delivery_note_per']['invoice_setting']==1){
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
                $posnic_sales_delivery_note_id=$this->input->post('posnic_sales_delivery_note_id')==1? 1 : 0;
                $data=$data.'"posnic_sales_delivery_note_id"=>'.$posnic_sales_delivery_note_id.','."\n";
                $posnic_sales_delivery_note_number=$this->input->post('posnic_sales_delivery_note_number')==1?1:0;
                $data=$data.'"posnic_sales_delivery_note_number"=>'.$posnic_sales_delivery_note_number.','."\n";
                $posnic_sales_delivery_note_date=$this->input->post('posnic_sales_delivery_note_date')==1?1:0;
                $data=$data.'"posnic_sales_delivery_note_date"=>'.$posnic_sales_delivery_note_date.','."\n";
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
                $posnic_sales_delivery_note_subtotal=$this->input->post('posnic_sales_delivery_note_subtotal')==1?1:0;
                $data=$data.'"posnic_sales_delivery_note_subtotal"=>'.$posnic_sales_delivery_note_subtotal.','."\n";
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
                write_file('application/modules/sales_delivery_note/config/settings.php', $data);
                $this->config->load("settings");
                $this->session->set_flashdata('sales_delivery_note_invoice', $this->config->item('invoice'));
                echo 'TRUE';
    }
}
?>
