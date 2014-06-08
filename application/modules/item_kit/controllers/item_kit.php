<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Item_kit extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='item_kit';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');        
        
    }
    // item_kit data table
    function data_table(){
        $aColumns = array( 'guid','code','code','name','date','no_of_items','kit_price','tax_amount','selling_price','guid','active_status','guid' );	
	$start = "";
        $end="";

        if ( $this->input->get_post('iDisplayLength') != '-1' )	{
            $start = $this->input->get_post('iDisplayStart');
            $end=	 $this->input->get_post('iDisplayLength');              
        }	
        $item_kit="";
        if ( isset( $_GET['iSortCol_0'] ) )
        {	
            for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
                {
                    $item_kit.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
                }
            }

            $item_kit = substr_replace( $item_kit, "", -1 );

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
    
 
function save(){      
    if($this->session->userdata['item_kit_per']['add']==1){
        $this->form_validation->set_rules('item_kit_number',$this->lang->line('item_kit_number'), 'required');
        $this->form_validation->set_rules('item_kit_name', $this->lang->line('item_kit_name'), 'required');
        $this->form_validation->set_rules('category_id', $this->lang->line('category_id'), 'required');                    
        $this->form_validation->set_rules('item_kit_date', $this->lang->line('item_kit_date'), 'required');                    
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('kit_price', $this->lang->line('kit_price'), 'numeric|required');                  
        $this->form_validation->set_rules('selling_kit_price', $this->lang->line('selling_kit_price'), 'numeric|required');  
        
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                       
        $this->form_validation->set_rules('new_item_stock_id[]', $this->lang->line('new_item_stock_id'), 'required');          
            if ( $this->form_validation->run() !== false ) {  
                $item_kit_number=  $this->input->post('item_kit_number');
                $item_kit_name=  $this->input->post('item_kit_name');
                $category_id=  $this->input->post('category_id');
                $item_kit_date= strtotime($this->input->post('item_kit_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $kit_price=  $this->input->post('kit_price');  
                $seling_tax_amount=  $this->input->post('seling_tax_amount');
                $selling_price=  $this->input->post('selling_kit_price');
                $tax_inclusive=  $this->input->post('selling_tax_type');               
                $where=array('name'=>$item_kit_name);
                if($this->posnic->check_record_unique($where,'item_kit')){
                    $value=array('code'=>$item_kit_number,'name'=>$item_kit_name,'selling_price'=>$selling_price,'date'=>$item_kit_date,'category_id'=>$category_id,'no_of_items'=>$total_types,'item_total'=>$total_amount,'tax_inclusive'=>$tax_inclusive,'tax_amount'=>$seling_tax_amount,'kit_price'=>$kit_price,'remark'=>$remark,'note'=>$note);
                    $guid=   $this->posnic->posnic_add_record($value,'item_kit');

                    $item=  $this->input->post('new_item_id');
                    $quty=  $this->input->post('new_item_quty');
                    $stock=  $this->input->post('new_item_stock_id'); 
                    $this->load->model('items');
                    for($i=0;$i<count($item);$i++){                                
                        $this->items->add_item_kit($guid,$item[$i],$quty[$i],$stock[$i],$i);
                    }
                    $this->posnic->posnic_master_increment_max('item_kit')  ;
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
    function update(){
            if(isset($_POST['guid'])){
      if($this->session->userdata['item_kit_per']['edit']==1){
         $this->form_validation->set_rules('item_kit_number',$this->lang->line('item_kit_number'), 'required');
        $this->form_validation->set_rules('item_kit_name', $this->lang->line('item_kit_name'), 'required');
        $this->form_validation->set_rules('category_id', $this->lang->line('category_id'), 'required');                    
        $this->form_validation->set_rules('item_kit_date', $this->lang->line('item_kit_date'), 'required');                    
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('kit_price', $this->lang->line('kit_price'), 'numeric|required');                  
        $this->form_validation->set_rules('selling_kit_price', $this->lang->line('selling_kit_price'), 'numeric|required'); 
    
        
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'));                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'numeric');                       
        $this->form_validation->set_rules('new_item_stock_id[]', $this->lang->line('new_item_stock_id'));  
        
        $this->form_validation->set_rules('item_id[]', $this->lang->line('item_id'));                      
        $this->form_validation->set_rules('item_quty[]', $this->lang->line('item_quty'), 'numeric');                       
        $this->form_validation->set_rules('item_stocks_id[]', $this->lang->line('item_stocks_id'));  
        
        
            if ( $this->form_validation->run() !== false ) {  
                $guid=  $this->input->post('guid');
                $item_kit_number=  $this->input->post('item_kit_number');
                $item_kit_name=  $this->input->post('item_kit_name');
                $category_id=  $this->input->post('category_id');
                $item_kit_date= strtotime($this->input->post('item_kit_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $kit_price=  $this->input->post('kit_price');  
                $seling_tax_amount=  $this->input->post('seling_tax_amount');
                $selling_price=  $this->input->post('selling_kit_price');
                $tax_inclusive=  $this->input->post('selling_tax_type');               
                $where=array('guid !='=>$guid,'name'=>$item_kit_name);  
                if($this->posnic->check_record_unique($where,'item_kit')){
                    $value=array('code'=>$item_kit_number,'name'=>$item_kit_name,'selling_price'=>$selling_price,'date'=>$item_kit_date,'category_id'=>$category_id,'no_of_items'=>$total_types,'item_total'=>$total_amount,'tax_inclusive'=>$tax_inclusive,'tax_amount'=>$seling_tax_amount,'kit_price'=>$kit_price,'remark'=>$remark,'note'=>$note);
                    $guid=  $this->input->post('guid');
                    $update_where=array('guid'=>$guid);
                    $this->posnic->posnic_update_record($value,$update_where,'item_kit');  
                    
                    $item_id=  $this->input->post('item_id');
                    $item_quty=  $this->input->post('item_quty');
                    $item_stocks_id=  $this->input->post('item_stocks_id');
                    $this->load->model('items');
                    for($i=0;$i<count($item_id);$i++){

                        $this->items->update_item_kit($guid,$item_id[$i],$item_quty[$i]);                

                    }
                    $delete=  $this->input->post('r_items');
                        for($j=0;$j<count($delete);$j++){                      
                             $this->items->delete_item_kit_item($delete[$j]);
                        }

                    $item=  $this->input->post('new_item_id');
                    $quty=  $this->input->post('new_item_quty');
                    $stock=  $this->input->post('new_item_stock_id'); 
                    if(count($item)>0){
                        for($i=0;$i<count($item);$i++){        
                            if($item[$i]!=""){
                                $this->items->add_item_kit($guid,$item[$i],$quty[$i],$stock[$i],$i);
                            }
                        }
                    }
                    echo 'TRUE';
                    
                
                
                }
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
        }
        
        
    }
        


/*
Delete  item_kit if the user have permission  */
// function start
    function delete(){
        if($this->session->userdata['item_kit_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'item_kit');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
// function end

function  get_item_kit($guid){
    if($this->session->userdata['item_kit_per']['edit']==1){
    $this->load->model('items');
    $data=  $this->items->get_item_kit($guid);
    echo json_encode($data);
    }
}

function item_kit_approve(){
     if($this->session->userdata['item_kit_per']['approve']==1){
            $id=  $this->input->post('guid');
            $item_id=  $this->input->post('item');
            $this->load->model('items');
            $this->items->approve_item_kit($id,$item_id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function item_kit_number(){
       $data[]= $this->posnic->posnic_master_max('item_kit')    ;
       echo json_encode($data);
}
/*
 * search items to purchase item_kit with or like 
 *  */

    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_items($search);      
        echo json_encode($data);


    }
    /* search item_kit type */
    function search_item_kit_type(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_item_kit_type($search);      
        echo json_encode($data);
    }
    /* function start */
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
    // function end
    /* search item kit cargory 
        function start     */
    function search_category(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_category($search);      
        echo json_encode($data);
    }
    function active(){
        $id=  $this->input->post('guid');
        $report= $this->posnic->posnic_module_active($id,'item_kit'); 
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }
    function deactive(){
        $id=  $this->input->post('guid');
        $report= $this->posnic->posnic_module_deactive($id,'item_kit'); 
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }
}
?>
