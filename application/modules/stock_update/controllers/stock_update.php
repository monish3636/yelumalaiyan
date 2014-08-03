<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_update extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='stock_update';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    // purchase order data table
    function data_table(){
        $aColumns = array( 'guid','guid','name','code','quty','price','b_name','d_name','c_name','deco_code','guid' );	
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
                    'items.code'=>  $this->input->get_post('sSearch'),
                    'items.ean_upc_code'=>  $this->input->get_post('sSearch'),
                    'items.name'=>  $this->input->get_post('sSearch'),
                    'items.barcode'=>  $this->input->get_post('sSearch'),
                    'items_category.category_name'=>  $this->input->get_post('sSearch'),
                    'items_department.department_name'=>  $this->input->get_post('sSearch'),
                    'brands.name'=>  $this->input->get_post('sSearch'),
                    'kit_category.category_name'=>  $this->input->get_post('sSearch'),
                    'item_kit.code'=>  $this->input->get_post('sSearch'),
                    'item_kit.name'=>  $this->input->get_post('sSearch'),
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
    
   
    
   
 
    

   

// function end

    function  get_stock($guid){
        if($this->session->userdata['stock_update_per']['update']==1){
        $this->load->model('stock');
        $data=  $this->stock->get_stock($guid);
        echo json_encode($data);
        }
    }
    function update(){
        if($this->session->userdata['stock_update_per']['update']==1){
            $this->form_validation->set_rules('stock_id', $this->lang->line('stock_id'), 'required');                      
            $this->form_validation->set_rules('quantity', $this->lang->line('quantity'), 'numeric|required');        
            if ( $this->form_validation->run() !== false ) {    
                $guid=  $this->input->post('stock_id');
                $quantity= $this->input->post('quantity');
                $this->load->model('stock')->update($guid,$quantity);
                echo 'TRUE';
            }else{
                echo 'FALSE';
            }
        }else{
            echo 'NOOP';
        }
    }





}
?>
