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
    // sales quotation item_kit data table
    function data_table(){
        $aColumns = array( 'guid','code','code','name','date','total_types','total_weight','total_amount','guid','guid','item_id','guid' );	
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
        $this->form_validation->set_rules('item_kit_item_guid',$this->lang->line('item_kit_item_guid'), 'required');
        $this->form_validation->set_rules('item_kit_number', $this->lang->line('item_kit_number'), 'required');
        $this->form_validation->set_rules('item_kit_date', $this->lang->line('item_kit_date'), 'required');                    
        $this->form_validation->set_rules('stock_id', $this->lang->line('stock_id'), 'required');                    
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('total_item_weight', $this->lang->line('total_item_weight'), 'numeric|required');                  
        $this->form_validation->set_rules('new_item_kit_id[]', $this->lang->line('new_item_kit_id'), 'required');                      
        $this->form_validation->set_rules('new_item_kit_weight[]', $this->lang->line('new_item_kit_weight'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_kit_quty[]', $this->lang->line('new_item_kit_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_kit_formula[]', $this->lang->line('new_item_kit_formula'), 'required');                      
        $this->form_validation->set_rules('new_item_kit_price[]', $this->lang->line('new_item_kit_price'), 'required');                      
        $this->form_validation->set_rules('new_item_kit_total[]', $this->lang->line('new_item_kit_total'), 'required');          
            if ( $this->form_validation->run() !== false ) {    
                $item=  $this->input->post('item_kit_item_guid');
                $item_kit_number=  $this->input->post('item_kit_number');
                $item_kit_date= strtotime($this->input->post('item_kit_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $total_weight=  $this->input->post('total_item_weight');  
                $value=array('item_id'=>$item,'stock_id'=>$this->input->post('stock_id'),'code'=>$item_kit_number,'date'=>$item_kit_date,'total_types'=>$total_types,'total_amount'=>$total_amount,'total_weight'=>$total_weight,'remark'=>$remark,'note'=>$note);
                $guid=   $this->posnic->posnic_add_record($value,'item_kit');          
                $item_kit=  $this->input->post('new_item_kit_id');
                $weight=  $this->input->post('new_item_kit_weight');
                $quty=  $this->input->post('new_item_kit_quty');
                $formula=  $this->input->post('new_item_kit_formula');
                $price=  $this->input->post('new_item_kit_price');
                $total=  $this->input->post('new_item_kit_total');           
                for($i=0;$i<count($item_kit);$i++){              
                    $this->load->model('items');
                    $this->items->add_item_kit($guid,$item_kit[$i],$weight[$i],$quty[$i],$formula[$i],$price[$i],$total[$i],$i);
                }
                $this->posnic->posnic_master_increment_max('item_kit')  ;
                    echo 'TRUE';    
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
        
        $this->form_validation->set_rules('item_kit_number', $this->lang->line('item_kit_number'), 'required');
        $this->form_validation->set_rules('item_kit_date', $this->lang->line('item_kit_date'), 'required');                 
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('total_item_weight', $this->lang->line('total_item_weight'), 'numeric|required');                  
        $this->form_validation->set_rules('deco_guid[]', $this->lang->line('deco_guid'));                      
        $this->form_validation->set_rules('item_kit_id[]', $this->lang->line('new_item_kit_id'));                      
        $this->form_validation->set_rules('item_kit_weight[]', $this->lang->line('item_kit_weight'), 'numeric');                      
        $this->form_validation->set_rules('item_kit_quty[]', $this->lang->line('item_kit_quty'), 'numeric');                      
        $this->form_validation->set_rules('item_kit_formula[]', $this->lang->line('item_kit_formula'));                      
        $this->form_validation->set_rules('item_kit_price[]', $this->lang->line('item_kit_price'));                      
        $this->form_validation->set_rules('item_kit_total[]', $this->lang->line('item_kit_total')); 
        
        $this->form_validation->set_rules('new_item_kit_id[]', $this->lang->line('new_item_kit_id'));                      
        $this->form_validation->set_rules('new_item_kit_weight[]', $this->lang->line('new_item_kit_weight'), 'numeric');                      
        $this->form_validation->set_rules('new_item_kit_quty[]', $this->lang->line('new_item_kit_quty'), 'numeric');                      
        $this->form_validation->set_rules('new_item_kit_formula[]', $this->lang->line('new_item_kit_formula'));                      
        $this->form_validation->set_rules('new_item_kit_price[]', $this->lang->line('new_item_kit_price'));                      
        $this->form_validation->set_rules('new_item_kit_total[]', $this->lang->line('new_item_kit_total')); 
        
        
            if ( $this->form_validation->run() !== false ) {    
                $item_kit_date= strtotime($this->input->post('item_kit_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $total_weight=  $this->input->post('total_item_weight');     
                $value=array('date'=>$item_kit_date,'total_types'=>$total_types,'total_amount'=>$total_amount,'total_weight'=>$total_weight,'remark'=>$remark,'note'=>$note);
                $guid=  $this->input->post('guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'item_kit');          
                $deco_guid=  $this->input->post('deco_guid');
                $quty=  $this->input->post('item_kits_quty');
                $price=  $this->input->post('item_kits_price');
                $weight=  $this->input->post('item_kits_weight');
                $total=  $this->input->post('item_kits_total');
                $this->load->model('items');
                for($i=0;$i<count($deco_guid);$i++){
                 
                    $this->items->update_item_kit($deco_guid[$i],$quty[$i],$price[$i],$weight[$i],$total[$i]);                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){                      
                         $this->items->delete_item_kit_item($delete[$j]);
                    }
                    
                $item_kit=  $this->input->post('new_item_kit_id');
                $weight=  $this->input->post('new_item_kit_weight');
                $quantity=  $this->input->post('new_item_kit_quty');
                $formula=  $this->input->post('new_item_kit_formula');
                $price=  $this->input->post('new_item_kit_price');
                $total=  $this->input->post('new_item_kit_total');           
               
                if(count($item_kit)>0){
                     for($i=0;$i<count($item_kit);$i++){
                         if($item_kit[$i]!="" || $item_kit[$i]!=0){

                         $this->items->add_item_kit($guid,$item_kit[$i],$weight[$i],$quantity[$i],$formula[$i],$price[$i],$total[$i],$i);

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
Delete purchase item_kit if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  item_kit
            if($this->input->post('guid')){ 
                $this->load->model('items');
                $guid=$this->input->post('guid');
                $status=$this->items->check_approve($guid);// check if the purchase item_kit was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'item_kit'); // delete the purchase item_kit
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
}
?>
