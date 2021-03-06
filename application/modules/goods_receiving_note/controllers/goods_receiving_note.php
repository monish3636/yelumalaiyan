<?php
class Goods_receiving_note extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='goods_receiving_note';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // goods Receiving Note data table
    function data_table(){
        $aColumns = array( 'grn_guid','po_no','po_no','grn_no','c_name','s_name','grn_date','total_items','total_amt','grn_active','grn_active','guid' );	
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
					   
			$this->load->model('grn')	   ;
                        
			 $rResult1 = $this->grn->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->grn->count($this->session->userdata['branch_id']);
		
		$iTotal =$this->grn->count($this->session->userdata['branch_id']);
		
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
     if($this->session->userdata['purchase_order_per']['add']==1){
        $this->form_validation->set_rules('goods_receiving_note_guid',$this->lang->line('goods_receiving_note_guid'), 'required');
        $this->form_validation->set_rules('grn_date',$this->lang->line('grn_date'), 'required');
        $this->form_validation->set_rules('grn_no', $this->lang->line('grn_no'), 'required');                     
           
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('goods_receiving_note_guid');
                $grn_date=strtotime($this->input->post('grn_date'));
                $discount_amount=  $this->input->post('discount_amount');                
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');                
                $grn_no= $this->input->post('grn_no');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $value=array('grn_no'=>$grn_no,'date'=>$grn_date,'po'=>$po,'remark'=>$remark,'note'=>$note,'discount_amt'=>$discount_amount,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                $guid=   $this->posnic->posnic_add_record($value,'grn');
                $this->load->model('grn');
                $this->grn->update_grn_status($po,$guid);
                $quty=  $this->input->post('receive_quty');
                $free=  $this->input->post('receive_free');
                $items=  $this->input->post('items');
                $po_item=  $this->input->post('order_items');
                $this->load->model('grn');
                for($i=0;$i<count($items);$i++){
                        $this->grn->received_items($po_item[$i],$quty[$i],$free[$i],$guid);
                       
                }
                $this->posnic->posnic_master_increment_max('grn')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            
      if($this->session->userdata['purchase_order_per']['edit']==1){
        $this->form_validation->set_rules('goods_receiving_note_guid',$this->lang->line('goods_receiving_note_guid'), 'required');
        $this->form_validation->set_rules('grn_date',$this->lang->line('grn_date'), 'required');
        //$this->form_validation->set_rules('grn_no', $this->lang->line('grn_no'), 'required');                         
        $this->form_validation->set_rules('receive_quty[]', 'receive_quty', 'regex_match[/^[0-9]+$/]|xss_clean');
        $this->form_validation->set_rules('receive_free[]', 'receive_free', 'regex_match[/^[0-9]+$/]|xss_clean');
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('goods_receiving_note_guid');
                $grn_date=strtotime($this->input->post('grn_date'));
                $discount_amount=  $this->input->post('discount_amount');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $value=array('date'=>$grn_date,'remark'=>$remark,'note'=>$note,'discount_amt'=>$discount_amount,'total_amt'=>$grand_total,'total_item_amt'=>$total_amount);
                $guid=  $this->input->post('grn_guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'grn');          
                $quty=  $this->input->post('receive_quty');
                $free=  $this->input->post('receive_free');
                $items=  $this->input->post('items');
                $po_item=  $this->input->post('order_items');
                $this->load->model('grn');
                for($i=0;$i<count($items);$i++){
          
                        $this->grn->received_items($po_item[$i],$quty[$i],$free[$i],$guid);
                      
                }
                    
                    
                    
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
          
}
        

function search_purchase_order(){
        $search= $this->input->post('term');
        $this->load->model('grn');
        $data= $this->grn->search_purchase_order($search,$this->session->userdata['branch_id'])    ;
        echo json_encode($data);
         
       
        
}
function delete(){
   if($this->session->userdata['goods_receiving_note_per']['delete']==1){
        if($this->input->post('guid')){
            $guid=  $this->input->post('guid');
            $this->load->model('grn');
            $status=$this->grn->check_approve($guid);
           if($status!=FALSE){
            $this->grn->grn_delete($guid);
            
            $this->grn->delete_grn_items($guid);            
                echo 'TRUE';
            }else{
                echo 'Approved';
            }
        
        }
    }else{
         echo 'FALSE';
    }
    
}
function  get_purchase_order($guid){
    if($this->session->userdata['purchase_order_per']['edit']==1){
    $this->load->model('grn');
    $data=  $this->grn->get_purchase_order($guid);
    echo json_encode($data);
    }
}
function  get_goods_receiving_note($guid){
    if($this->session->userdata['purchase_order_per']['edit']==1){
    $this->load->model('grn');
    $data=  $this->grn->get_goods_receiving_note($guid);
    echo json_encode($data);
    }
}
function good_receiving_note_approve(){
    if($this->session->userdata['goods_receiving_note_per']['approve']==1){
        $id=  $this->input->post('guid');
        $po=  $this->input->post('po');
        $this->load->model('grn');
        $report=$this->grn->change_grn_status($id);
     
        $this->grn->add_stock($id,$po,$this->session->userdata['branch_id']);
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
        $data[]= $this->posnic->posnic_master_max('grn')    ;
        echo json_encode($data);
    }
        
    /* get grn
     function start     */
    function  view_goods_receiving_note($guid){
        if($this->session->userdata['goods_receiving_note_per']['view']==1){
        $this->load->model('grn');
        $data=  $this->grn->get_goods_receiving_note($guid);
        echo json_encode($data);
        }
    }
    /* function end*/
    /* get grn and invoice settings
     function start     */
    function  get_invoice_settings_and_goods_receiving_note($guid){
        if($this->session->userdata['goods_receiving_note_per']['print_invoice']==1){
        $this->load->model('grn');
        $data[0]=  $this->grn->goods_receiving_note_invoice($guid); // get purchas eorder details
         // read setting config file
        if($this->session->flashdata('goods_receiving_note_invoice')==""){
            $this->config->load("settings");
            $value=array();
            $value=$this->config->item('invoice');
            $this->session->set_flashdata('goods_receiving_note_invoice',$value); 
            $data[1]=$value; 
        }else{        
            $data[1]=$this->session->flashdata('goods_receiving_note_invoice'); // get invoice array
        }
        echo json_encode($data);
        }
    }
    /* function end*/
  /* get grn invoice getting details*/
    function get_invoice_settings(){
        if($this->session->userdata['goods_receiving_note_per']['invoice_setting']==1){
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
                $posnic_grn=$this->input->post('posnic_grn')==1?1:0;
                $data=$data.'"posnic_grn"=>'.$posnic_grn.','."\n";
                $posnic_grn_no=$this->input->post('posnic_grn_no')==1?1:0;
                $data=$data.'"posnic_grn_no"=>'.$posnic_grn_no.','."\n";
                $posnic_grn_date=$this->input->post('posnic_grn_date')==1?1:0;
                $data=$data.'"posnic_grn_date"=>'.$posnic_grn_date.','."\n";
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
                $posnic_item_received_quantity=$this->input->post('posnic_item_received_quantity')==1?1:0;
                $data=$data.'"posnic_item_received_quantity"=>'.$posnic_item_received_quantity.','."\n";
                $posnic_item_received_free_quantity=$this->input->post('posnic_item_received_free_quantity')==1?1:0;
                $data=$data.'"posnic_item_received_free_quantity"=>'.$posnic_item_received_free_quantity.','."\n";
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
                $posnic_grn_subtotal=$this->input->post('posnic_grn_subtotal')==1?1:0;
                $data=$data.'"posnic_grn_subtotal"=>'.$posnic_grn_subtotal.','."\n";
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
                write_file('application/modules/goods_receiving_note/config/settings.php', $data);
                $this->config->load("settings");
                $this->session->set_flashdata('goods_receiving_note_invoice', $this->config->item('invoice'));
                echo 'TRUE';
    }

}
?>
