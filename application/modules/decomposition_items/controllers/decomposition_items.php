<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Decomposition_items extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='decomposition_items';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // sales quotation decomposition_items data table
    function data_table(){
        $aColumns = array( 'guid','code','code','name','value','price','code','code','code','guid','code','code' );	
	$start = "";
        $end="";

        if ( $this->input->get_post('iDisplayLength') != '-1' )	{
            $start = $this->input->get_post('iDisplayStart');
            $end=	 $this->input->get_post('iDisplayLength');              
        }	
        $decomposition_items="";
        if ( isset( $_GET['iSortCol_0'] ) )
        {	
            for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
                {
                    $decomposition_items.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
                }
            }

            $decomposition_items = substr_replace( $decomposition_items, "", -1 );

        }
		
        $like = array();
	if ( $_GET['sSearch'] != "" )
            {
                $like =array(
                'po_no'=>  $this->input->get_post('code'),
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
    
    function update(){
            if(isset($_POST['guid'])){
      if($this->session->userdata['decomposition_items_per']['edit']==1){
        
        $this->form_validation->set_rules('guid', $this->lang->line('guid'), 'required');               
        $this->form_validation->set_rules('price', $this->lang->line('price')); 
        
        
            if ( $this->form_validation->run() !== false ) {    
                $guid= $this->input->post('guid');
                $price=$this->input->post('price');               
                $old_price=$this->input->post('old_price');               
                $this->posnic->posnic_update_record(array('price'=>$price),array('guid'=>$guid),'decomposition_items');
                $this->load->model('items');
                $this->items->update_price_in_stock($guid,$old_price,$price);
                
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
Delete purchase decomposition_items if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  decomposition_items
            if($this->input->post('guid')){ 
                $this->load->model('items');
                $guid=$this->input->post('guid');
                $status=$this->items->check_approve($guid);// check if the purchase decomposition_items was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'decomposition_items'); // delete the purchase decomposition_items
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

function  get_decomposition_items($guid){
    if($this->session->userdata['decomposition_items_per']['edit']==1){
    $this->load->model('items');
    $data=  $this->items->get_decomposition_items($guid);
    echo json_encode($data);
    }
}

function decomposition_items_approve(){
     if($this->session->userdata['decomposition_items_per']['approve']==1){
            $id=  $this->input->post('guid');
            $item_id=  $this->input->post('item');
            $this->load->model('items');
            $this->items->approve_decomposition_items($id,$item_id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function decomposition_items_number(){
       $data[]= $this->posnic->posnic_master_max('decomposition_items')    ;
       echo json_encode($data);
}
/*
 * search items to purchase decomposition_items with or like 
 *  */

    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_items($search);      
        echo json_encode($data);


    }
    /* search decomposition_items type */
    function search_decomposition_items_type(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_decomposition_items_type($search);      
        echo json_encode($data);
    }
    /* function start */
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
    // function end
}
?>
