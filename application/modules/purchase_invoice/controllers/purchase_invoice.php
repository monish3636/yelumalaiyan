<?php
class Purchase_invoice extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='purchase_invoice';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
    }
    // goods Receiving Note data table
    function data_table(){
        $aColumns = array( 'guid','invoice','grn_no','c_name','s_name','date','invoice','invoice','invoice','invoice','guid' );	
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
            $this->load->model('invoice')	   ;
            $rResult1 = $this->invoice->get($end,$start,$like,$this->session->userdata['branch_id']);
            $iFilteredTotal =$this->invoice->count($this->session->userdata['branch_id']);
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
 
    function save(){      
         if($this->session->userdata['purchase_invoice_per']['add']==1){
            $this->form_validation->set_rules('goods_receiving_note_guid',$this->lang->line('goods_receiving_note_guid'), 'required');
            $this->form_validation->set_rules('grn_date',$this->lang->line('grn_date'), 'required');
            $this->form_validation->set_rules('supplier_id',$this->lang->line('supplier_id'), 'required');
            $this->form_validation->set_rules('invoice_no', $this->lang->line('invoice_no'), 'required');
            if ( $this->form_validation->run() !== false ) {    
                $grn=  $this->input->post('goods_receiving_note_guid');
                $date=strtotime($this->input->post('grn_date'));
                $invoice_no= $this->input->post('invoice_no');
                $supplier_id= $this->input->post('supplier_id');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $po= $this->input->post('purchase_order');
                $this->load->model('invoice');
                if($po=="" Or $po==NULL) {
                    $po="non";
                }
                 $where=array('invoice'=>$invoice_no);
                if($this->invoice->check_duplicate($where)){
                    $value=array('supplier_id'=>$supplier_id,'invoice'=>$invoice_no,'po'=>$po,'grn'=>$grn,'date'=>$date,'remark'=>$remark,'note'=>$note);
                    $guid= $this->posnic->posnic_add_record($value,'purchase_invoice');
                    if($po=='non') {
                        $po="non";

                        $this->invoice->direct_grn_invoice_status($grn,$guid);
                        $this->invoice->direct_grn_payable_amount($grn,$guid);
                    }else{

                        $this->invoice->grn_invoice_status($grn,$guid);
                        $this->invoice->grn_payable_amount($grn,$guid,$po);
                    }
                    $this->posnic->posnic_master_increment_max('purchase_invoice')  ;
           
                    echo 'TRUE';
                }else{
                    echo 'ALREADY';
                }
            }else{
                echo 'FALSE';
            }
        }else{
            echo 'Noop';
        }
           
    }
    function search_grn_order(){
        $search= $this->input->post('term');
        $this->load->model('invoice');
        $data= $this->invoice->search_grn_order($search,$this->session->userdata['branch_id'])    ;
        echo json_encode($data);
    }
   
    function  get_grn($guid){
        if($this->session->userdata['purchase_invoice_per']['add']==1){
            $this->load->model('invoice');
            $data=  $this->invoice->get_goods_receiving_note($guid);
            echo json_encode($data);
        }
    }
    function  get_direct_grn($guid){
        if($this->session->userdata['purchase_invoice_per']['add']==1){
            $this->load->model('invoice');
            $data=  $this->invoice->get_direct_grn($guid);
            echo json_encode($data);
        }
    }
    function  get_goods_receiving_note($guid){
        if($this->session->userdata['purchase_invoice_per']['edit']==1){
        $this->load->model('invoice');
        $data=  $this->invoice->get_goods_receiving_note($guid);
        echo json_encode($data);
        }
    }   
   
    function order_number(){
        $data[]= $this->posnic->posnic_master_max('purchase_invoice')    ;
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
      /* get purchase invoice 
     function start     */
    function  view_purchase_invoice($guid){
        if($this->session->userdata['purchase_invoice_per']['view']==1){
        $this->load->model('invoice');
        $data=  $this->invoice->view_purchase_invoice($guid);
        echo json_encode($data);
        }
    }
    /* function end*/
  
    // get grn data
    function get_invoice_settings_and_purchase_invoice($guid){
        if($this->session->userdata['purchase_invoice_per']['print_invoice']==1){
        $this->load->model('invoice');
        $data[0]=  $this->invoice->purchase_invoice_invoice($guid); // get purchas eorder details
         // read setting config file
        if($this->session->flashdata('purchase_invoice_invoice')==""){
            $this->config->load("settings");
            $value=array();
            $value=$this->config->item('invoice');
            $this->session->set_flashdata('purchase_invoice_invoice',$value); 
            $data[1]=$value; 
        }else{        
            $data[1]=$this->session->flashdata('purchase_invoice_invoice'); // get invoice array
        }
        echo json_encode($data);
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
        $posnic_purchase_invoice_subtotal=$this->input->post('posnic_purchase_invoice_subtotal')==1?1:0;
        $data=$data.'"posnic_purchase_invoice_subtotal"=>'.$posnic_purchase_invoice_subtotal.','."\n";
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
        write_file('application/modules/purchase_invoice/config/settings.php', $data);
        $this->config->load("settings");
        $this->session->set_flashdata('purchase_invoice_invoice', $this->config->item('invoice'));
        echo 'TRUE';
    }
    /* function start
    get invoice setting     */
    function get_invoice_settings(){
        if($this->session->userdata['purchase_invoice_per']['invoice_setting']==1){
            $this->config->load("settings"); // read setting config file
            $settings =$this->config->item('invoice'); // get invoice array
            echo json_encode($settings);
        }
    }
}
?>
