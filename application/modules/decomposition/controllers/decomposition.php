<?php
class Decomposition extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='decomposition';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // sales quotation decomposition data table
    function data_table(){
        $aColumns = array( 'guid','code','code','name','date','total_types','total_weight','total_amount','decomposition_status','guid' );	
	$start = "";
        $end="";

        if ( $this->input->get_post('iDisplayLength') != '-1' )	{
            $start = $this->input->get_post('iDisplayStart');
            $end=	 $this->input->get_post('iDisplayLength');              
        }	
        $decomposition="";
        if ( isset( $_GET['iSortCol_0'] ) )
        {	
            for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
                {
                    $decomposition.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
                }
            }

            $decomposition = substr_replace( $decomposition, "", -1 );

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
    if($this->session->userdata['decomposition_per']['add']==1){
        $this->form_validation->set_rules('decomposition_item_guid',$this->lang->line('decomposition_item_guid'), 'required');
        $this->form_validation->set_rules('decomposition_number', $this->lang->line('decomposition_number'), 'required');
        $this->form_validation->set_rules('decomposition_date', $this->lang->line('decomposition_date'), 'required');                    
        $this->form_validation->set_rules('stock_id', $this->lang->line('stock_id'), 'required');                    
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('total_item_weight', $this->lang->line('total_item_weight'), 'numeric|required');                  
        $this->form_validation->set_rules('new_decomposition_id[]', $this->lang->line('new_decomposition_id'), 'required');                      
        $this->form_validation->set_rules('new_decomposition_weight[]', $this->lang->line('new_decomposition_weight'), 'required|numeric');                      
        $this->form_validation->set_rules('new_decomposition_quty[]', $this->lang->line('new_decomposition_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_decomposition_formula[]', $this->lang->line('new_decomposition_formula'), 'required');                      
        $this->form_validation->set_rules('new_decomposition_price[]', $this->lang->line('new_decomposition_price'), 'required');                      
        $this->form_validation->set_rules('new_decomposition_total[]', $this->lang->line('new_decomposition_total'), 'required');          
            if ( $this->form_validation->run() !== false ) {    
                $item=  $this->input->post('decomposition_item_guid');
                $decomposition_number=  $this->input->post('decomposition_number');
                $decomposition_date= strtotime($this->input->post('decomposition_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $total_weight=  $this->input->post('total_item_weight');  
                $value=array('item_id'=>$item,'stock_id'=>$this->input->post('stock_id'),'code'=>$decomposition_number,'date'=>$decomposition_date,'total_types'=>$total_types,'total_amount'=>$total_amount,'total_weight'=>$total_weight,'remark'=>$remark,'note'=>$note);
                $guid=   $this->posnic->posnic_add_record($value,'decomposition');          
                $decomposition=  $this->input->post('new_decomposition_id');
                $weight=  $this->input->post('new_decomposition_weight');
                $quty=  $this->input->post('new_decomposition_quty');
                $formula=  $this->input->post('new_decomposition_formula');
                $price=  $this->input->post('new_decomposition_price');
                $total=  $this->input->post('new_decomposition_total');           
                for($i=0;$i<count($decomposition);$i++){              
                    $this->load->model('items');
                    $this->items->add_decomposition($guid,$decomposition[$i],$weight[$i],$quty[$i],$formula[$i],$price[$i],$total[$i],$i);
                }
                $this->posnic->posnic_master_increment_max('decomposition')  ;
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
      if($this->session->userdata['decomposition_per']['edit']==1){
        
        $this->form_validation->set_rules('decomposition_number', $this->lang->line('decomposition_number'), 'required');
        $this->form_validation->set_rules('decomposition_date', $this->lang->line('decomposition_date'), 'required');                 
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric|required');                  
        $this->form_validation->set_rules('total_item_weight', $this->lang->line('total_item_weight'), 'numeric|required');                  
        $this->form_validation->set_rules('deco_guid[]', $this->lang->line('deco_guid'));                      
        $this->form_validation->set_rules('decomposition_id[]', $this->lang->line('new_decomposition_id'));                      
        $this->form_validation->set_rules('decomposition_weight[]', $this->lang->line('decomposition_weight'), 'numeric');                      
        $this->form_validation->set_rules('decomposition_quty[]', $this->lang->line('decomposition_quty'), 'numeric');                      
        $this->form_validation->set_rules('decomposition_formula[]', $this->lang->line('decomposition_formula'));                      
        $this->form_validation->set_rules('decomposition_price[]', $this->lang->line('decomposition_price'));                      
        $this->form_validation->set_rules('decomposition_total[]', $this->lang->line('decomposition_total')); 
        
        $this->form_validation->set_rules('new_decomposition_id[]', $this->lang->line('new_decomposition_id'));                      
        $this->form_validation->set_rules('new_decomposition_weight[]', $this->lang->line('new_decomposition_weight'), 'numeric');                      
        $this->form_validation->set_rules('new_decomposition_quty[]', $this->lang->line('new_decomposition_quty'), 'numeric');                      
        $this->form_validation->set_rules('new_decomposition_formula[]', $this->lang->line('new_decomposition_formula'));                      
        $this->form_validation->set_rules('new_decomposition_price[]', $this->lang->line('new_decomposition_price'));                      
        $this->form_validation->set_rules('new_decomposition_total[]', $this->lang->line('new_decomposition_total')); 
        
        
            if ( $this->form_validation->run() !== false ) {    
                $decomposition_date= strtotime($this->input->post('decomposition_date'));
                $total_types=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $total_weight=  $this->input->post('total_item_weight');     
                $value=array('date'=>$decomposition_date,'total_types'=>$total_types,'total_amount'=>$total_amount,'total_weight'=>$total_weight,'remark'=>$remark,'note'=>$note);
                $guid=  $this->input->post('guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'decomposition');          
                $deco_guid=  $this->input->post('deco_guid');
                $quty=  $this->input->post('decompositions_quty');
                $price=  $this->input->post('decompositions_price');
                $weight=  $this->input->post('decompositions_weight');
                $total=  $this->input->post('decompositions_total');
                $this->load->model('items');
                for($i=0;$i<count($deco_guid);$i++){
                 
                    $this->items->update_decomposition($deco_guid[$i],$quty[$i],$price[$i],$weight[$i],$total[$i]);                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){
                        $this->load->model('items');
                        
                        // $this->items->delete_decomposition_item($delete[$j]);
                    }
                    
                $decomposition=  $this->input->post('new_decomposition_id');
                $weight=  $this->input->post('new_decomposition_weight');
                $quantity=  $this->input->post('new_decomposition_quty');
                $formula=  $this->input->post('new_decomposition_formula');
                $price=  $this->input->post('new_decomposition_price');
                $total=  $this->input->post('new_decomposition_total');           
               
                if(count($decomposition)>0){
                     for($i=0;$i<count($decomposition);$i++){
                         if($decomposition[$i]!="" || $decomposition[$i]!=0){

                         $this->items->add_decomposition($guid,$decomposition[$i],$weight[$i],$quantity[$i],$formula[$i],$price[$i],$total[$i],$i);

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
Delete purchase decomposition if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  decomposition
            if($this->input->post('guid')){ 
                $this->load->model('items');
                $guid=$this->input->post('guid');
                $status=$this->items->check_approve($guid);// check if the purchase decomposition was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'decomposition'); // delete the purchase decomposition
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

function  get_decomposition($guid){
    if($this->session->userdata['decomposition_per']['edit']==1){
    $this->load->model('items');
    $data=  $this->items->get_decomposition($guid);
    echo json_encode($data);
    }
}

function decomposition_approve(){
     if($this->session->userdata['decomposition_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('items');
            $this->items->approve_decomposition($id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function decomposition_number(){
       $data[]= $this->posnic->posnic_master_max('decomposition')    ;
       echo json_encode($data);
}
/*
 * search items to purchase decomposition with or like 
 *  */

    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_items($search);      
        echo json_encode($data);


    }
    /* search decomposition type */
    function search_decomposition_type(){
        $search= $this->input->post('term');
        $this->load->model('items');
        $data= $this->items->search_decomposition_type($search);      
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
