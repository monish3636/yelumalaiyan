<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kit_category extends MX_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get_kit_category(); 
    }
     function get_kit_category(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='kit_category';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function kit_category_data_table(){
        $aColumns = array( 'guid','category_name','category_name','category_name','category_name','active_status' );	
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
                $like =array('category_name'=>  $this->input->get_post('sSearch'));
            }
            $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'kit_category');
            $iFilteredTotal =$this->posnic->data_table_count('kit_category');
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
				else if ( $aColumns[$i] != ' ' )
				{
					$row[] = $aRow[$aColumns[$i]];
				}				
			}				
		$output1['aaData'][] = $row;
		}
        
        echo json_encode($output1);
    }
   
   
    function update_kit_category(){
           if($this->session->userdata['kit_category_per']['edit']==1){
           if($this->input->post('kit_category_name')){
                $this->form_validation->set_rules("kit_category_name",$this->lang->line('kit_category_name'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('kit_category_name');                
                      $where=array('guid !='=>$id,'category_name'=>$name);
                if($this->posnic->check_record_unique($where,'kit_category')){
                    $value=array('category_name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'kit_category');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
                }else{
                    echo "FALSE";
                }	             
           }else{
               echo "NOOP";
           }
    }
    function inactive_kit_category($guid){
        if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('kit_category');
          }else{
              redirect('kit_category');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'kit_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'kit_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_kit_category($guid){
        if($this->session->userdata['kit_category_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'kit_category');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($this->session->userdata['kit_category_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'kit_category');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('kit_category');
          }else{
              redirect('kit_category');
          }
    }        
    function kit_category_manage(){
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                if($this->session->userdata['Posnic_Add']==="Add"){
                $this->load->view('kit_category/add_brand');
                }else{
                    echo "you have no permision to add kit_category";
                    $this->get_kit_category();
                }
               
         }
         if($this->input->post('delete_ad')){
              if($this->session->userdata['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                     $this->posnic->posnic_delete($guid);
                 }
                 }redirect('kit_category/get_kit_category');
              }else{
                  echo "you have no permision to delete kit_category";
                    $this->get_kit_category();
              }
         }
         if($this->input->post('delete')){
              if($this->session->userdata['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                $this->load->model('item_kit_category');
                    if(!$data1==''){         
                     foreach( $data1 as $key => $guid){                        
                        $this->posnic->posnic_delete($guid);
                    }
                    }redirect('kit_category/get_kit_category');
              }else{
                  echo "you have no permision to delete kit_category";
                    $this->get_kit_category();
              }
         }
         if($this->input->post('activate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                      $this->posnic->posnic_active($guid);
                 }
                 }redirect('kit_category/get_kit_category');
         }
         if($this->input->post('deactivate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                    $this->posnic->posnic_deactive($guid);
                 }
                 }redirect('kit_category/get_kit_category');
         }
        
    }
    function add_kit_category(){
            if($this->session->userdata['kit_category_per']['add']==1){
           if($this->input->post('kit_category_name')){
                $this->form_validation->set_rules("kit_category_name",$this->lang->line('kit_category_name'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('kit_category_name');                
                      $where=array('category_name'=>$name);
                if($this->posnic->check_record_unique($where,'kit_category')){
                    $value=array('category_name'=>$name);
                    $this->posnic->posnic_add_record($value,'kit_category');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
                }else{
                       echo "FALSE";
                }	             
           }else{
               echo "NOOP";
           }
         
    }
    function delete_kit_category($guid){
           if($this->session->userdata['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
               }
            else{
                echo "you have no Permissions to add  new record";
                $this->get_customers_payment_type();
            } 
        
    }
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
   
}
?>
