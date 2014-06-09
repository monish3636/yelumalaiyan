<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MX_Controller
{   
    var $import_data = array();
    function __construct() {
        parent::__construct();
            $this->load->library('posnic'); 
           // $this->load->library('csvimport');
         
    }
    function index(){     
        $this->get();

    }
     function get(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='customers';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function customers_data_table(){
        $aColumns = array( 'guid','guid','first_name','company_name','phone','email','c_name','type','type','active_status' );	
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
                    $like =array('name'=>  $this->input->get_post('sSearch'));
		}
            $this->load->model('customer')		   ;
            $rResult1 = $this->customer->get($end,$start,$like,$this->session->userdata['branch_id']);
            $iFilteredTotal =$this->posnic->data_table_count('customers');
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
                            /* General output */
                        $row[] = $aRow[$aColumns[$i]];
                    }

                }

                $output1['aaData'][] = $row;
            }
                
		
	echo json_encode($output1);
    }
  function active(){
        $id=  $this->input->post('guid');
        $report= $this->posnic->posnic_module_active($id,'customers'); 
            if (!$report['error']) {
                echo 'TRUE';
            } else {
                echo 'FALSE';
            }
    }
    function deactive(){
        $id=  $this->input->post('guid');
        $report= $this->posnic->posnic_module_deactive($id,'customers'); 
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
            }
    }
   function delete(){
        if($this->session->userdata['customers_per']['delete']==1){
            if($this->input->post('guid')){
                $guid=  $this->input->post('guid');
                $this->posnic->posnic_delete($guid,'customers');
                echo 'TRUE';
            }
        }else{
               echo 'FALSE';
        }
    }
    function add_customers(){
        if($this->session->userdata['customers_per']['add']=="1"){
            $this->load->library('form_validation');
                $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
                $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                $this->form_validation->set_rules("payment",$this->lang->line('payment'),"required"); 
                $this->form_validation->set_rules("city",$this->lang->line('city'),"required"); 
                $this->form_validation->set_rules("state",$this->lang->line('state'),"required"); 
                $this->form_validation->set_rules("zip",$this->lang->line('zip'),"required"); 
                $this->form_validation->set_rules("country",$this->lang->line('country'),"required"); 
                $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'max_length[12]|regex_match[/^[0-9]+$/]|xss_clean');
                $this->form_validation->set_rules('credit_days', $this->lang->line('credit_days'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('credit_limit', $this->lang->line('credit_limit'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('balance', $this->lang->line('balance'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email'); 
                
                if ( $this->form_validation->run() !== false ) {
                    $values=array(
                        'first_name'=>$this->input->post('first_name'),
                        'last_name'=>  $this->input->post('last_name'),
                        'email'=>$this->input->post('email'),
                        'phone'=>$this->input->post('phone'),
                        'city'=>$this->input->post('city'),
                        'state'=>$this->input->post('state'),
                        'country'=>$this->input->post('country'),
                        'zip'=>$this->input->post('zip'),
                        'comments'=>$this->input->post('comments'),
                        'website'=>$this->input->post('website'),
                        'account_number'=>$this->input->post('account'),
                        'address'=>$this->input->post('address'),
                        'company_name'=>$this->input->post('company'),                                    

                        'payment'=>$this->input->post('payment'),
                        'credit_limit'=>$this->input->post('credit_limit'),
                        'cdays'=>$this->input->post('credit_days'),
                        'month_credit_bal'=>$this->input->post('balance'),
                        'bday'=>strtotime($this->input->post('dob')),
                        'mday'=>strtotime($this->input->post('marragedate')),
                        'title'=>$this->input->post('title'),
                        'category_id'=>$this->input->post('category'),

                        'bank_name'=>$this->input->post('bank_name'),
                        'bank_location'=>$this->input->post('bank_location'),
                        'account_number'=>$this->input->post('account_no'),
                        'cst'=>$this->input->post('cst'),
                        'gst'=>$this->input->post('gst'),
                        'tax_no'=>  $this->input->post('tax_no'));
                         $where=array('phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'));
                    if($this->posnic->check_record_unique($where,'customers')){                   
                            $this->posnic->posnic_add_record($values,'customers');
                    echo 'TRUE';
                }else{
                    echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
               	             
           }else{
               echo "NOOP";
           }
    }
    function get_category(){
        $search= $this->input->post('term');
            if($search!=""){
                $like=array('category_name'=>$search);
                $data= $this->posnic->posnic_or_like('customer_category',$like);      
                echo json_encode($data);
           }
    }
    function get_payment(){
        $search= $this->input->post('term');
            if($search!=""){
                $like=array('type'=>$search);
                $data= $this->posnic->posnic_or_like('customers_payment_type',$like);      
                echo json_encode($data);
            }
    }
            
    function edit_customers($guid){
       if($this->session->userdata['customers_per']['edit']=="1"){
              $this->load->model('customer')		   ;
              $data = $this->customer->edit_customer($guid);
              echo json_encode($data);
         }else{
            echo 'Noop';
         }
       
    }
    function update_customers(){  
                 if($this->session->userdata['customers_per']['edit']==1){
                         if($this->input->post('guid')){
                    $guid=  $this->input->post('guid');
                          $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
                            $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                            $this->form_validation->set_rules("payment",$this->lang->line('payment'),"required"); 
                            $this->form_validation->set_rules("city",$this->lang->line('city'),"required"); 
                            $this->form_validation->set_rules("state",$this->lang->line('state'),"required"); 
                            $this->form_validation->set_rules("zip",$this->lang->line('zip'),"required"); 
                            $this->form_validation->set_rules("country",$this->lang->line('country'),"required"); 
                            $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'max_length[12]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('credit_days', $this->lang->line('credit_days'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('credit_limit', $this->lang->line('credit_limit'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('balance', $this->lang->line('balance'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                            $values=array(
                                     'first_name'=>$this->input->post('first_name'),
                                    'last_name'=>  $this->input->post('last_name'),
                                    'email'=>$this->input->post('email'),
                                    'phone'=>$this->input->post('phone'),
                                    'city'=>$this->input->post('city'),
                                    'state'=>$this->input->post('state'),
                                    'country'=>$this->input->post('country'),
                                    'zip'=>$this->input->post('zip'),
                                    'comments'=>$this->input->post('comments'),
                                    'website'=>$this->input->post('website'),
                                    'account_number'=>$this->input->post('account'),
                                    'address'=>$this->input->post('address'),
                                    'company_name'=>$this->input->post('company'),                                    
                                    
                                    'payment'=>$this->input->post('payment'),
                                    'credit_limit'=>$this->input->post('credit_limit'),
                                    'cdays'=>$this->input->post('credit_days'),
                                    'month_credit_bal'=>$this->input->post('balance'),
                                    'bday'=>strtotime($this->input->post('dob')),
                                    'mday'=>strtotime($this->input->post('marragedate')),
                                    'title'=>$this->input->post('title'),
                                    'category_id'=>$this->input->post('category'),
                                
                                    'bank_name'=>$this->input->post('bank_name'),
                                    'bank_location'=>$this->input->post('bank_location'),
                                    'account_number'=>$this->input->post('account_no'),
                                    'cst'=>$this->input->post('cst'),
                                    'gst'=>$this->input->post('gst'),
                                    'tax_no'=>  $this->input->post('tax_no'));
                                    $update_where=array('guid'=>$guid);
                                    
                                    
                                   $where=array('guid !='=>$guid,'phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'));
                                 if($this->posnic->check_record_unique($where,'customers')){
                   
                    $this->posnic->posnic_update_record($values,$update_where,'customers');
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
    
    
    
     function get_date_in_strtotime(){
        $dob=$this->input->post('dob');
        $mdate=$this->input->post('mdate');
         $data['dob']= date('j.n.Y', strtotime('+0 year, +0 days',$dob));
         $data['mdate']= date('j.n.Y', strtotime('+0 year, +0 days',$mdate));
         echo json_encode($data);
    }
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
    function import(){
        if($this->session->userdata['customers_per']['import']==1){
            $config['upload_path'] = './uploads/import';
            $config['allowed_types'] = 'csv|xlsx';
            $config['max_size']	= '9999999';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                    //$this->load->view('upload_form', $error);
            }
            else
            {

                $upload_data = $this->upload->data();
                $upload_data['file_name'];
                $file = './uploads/import/'.$upload_data['file_name']; 
                //load the excel library
                $this->load->library('excel'); 
                $objPHPExcel = PHPExcel_IOFactory::load($file); 
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection(); 
                //extract to a PHP readable array format
                $j=0;
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();    
                    //header will/should be in row 1 only. of course this can be modified to suit your need.
                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                        $field[$j][]=$column;
                        $field[$j][]=$data_value;
                        $j++;
                       
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }           
                }
                $data['header'] = $header;
                $data['values'] = $arr_data;
                $this->import_data=$data;                       
                echo json_encode($field);

            }
         }else{
             echo 'Noop';
         }
    
    }
    function posnic_mapping_import(){
        if($this->session->userdata['customers_per']['import']==1){

        }
    }
}

?>
