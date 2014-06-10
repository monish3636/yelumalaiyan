<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items extends MX_Controller{
      var $user_image = '';
    function __construct() {
                parent::__construct();
                $this->load->library('posnic');    
               
    }
    function index(){     
      $this->get_items();
       
    }
    function export($type){
            $this->load->library('Excel'); 
              // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("posnic.com")
                 ->setLastModifiedBy( $this->session->userdata('first_name'))
                 ->setTitle("Item Deatils")
                 ->setSubject("Item Deatils")
                 ->setDescription("Item Deatils")
                 ->setKeywords("Item Deatils")
                 ->setCategory("Item");

         
         $data=  $this->posnic->posnic_module('customers');
    // Add some data
         $j=1;
              $objPHPExcel->setActiveSheetIndex(0)
                               ->setCellValue("A$j",  $this->lang->line('first_name') )
                               ->setCellValue("B$j", $this->lang->line('last_name'))
                               ->setCellValue("C$j", $this->lang->line('birthday'))
                               ->setCellValue("D$j", $this->lang->line('marragedate'))
                               ->setCellValue("E$j",$this->lang->line('address'))
                               ->setCellValue("F$j",$this->lang->line('city'))
                               ->setCellValue("G$j", $this->lang->line('state'))
                               ->setCellValue("H$j", $this->lang->line('country'))
                               ->setCellValue("I$j", $this->lang->line('zip'))
                               ->setCellValue("J$j", $this->lang->line('company'))
                               ->setCellValue("K$j", $this->lang->line('website'))
                               ->setCellValue("L$j",$this->lang->line('email'))
                               ->setCellValue("M$j", $this->lang->line('phone'));
         
            for($i=0;$i<count($data);$i++){
                 
                $j++;

                    $objPHPExcel->setActiveSheetIndex(0)
                               ->setCellValue("A$j", $data[$i]['first_name'])
                               ->setCellValue("B$j", $data[$i]['last_name'])
                               ->setCellValue("C$j", date('d-m-Y',$data[$i]['dob']))
                               ->setCellValue("D$j", date('d-m-Y',$data[$i]['marragedate']))
                               ->setCellValue("E$j", $data[$i]['address'])
                               ->setCellValue("F$j", $data[$i]['city'])
                               ->setCellValue("G$j", $data[$i]['state'])
                               ->setCellValue("H$j", $data[$i]['country'])
                               ->setCellValue("I$j", $data[$i]['zip'])
                               ->setCellValue("J$j", $data[$i]['company'])
                               ->setCellValue("K$j", $data[$i]['website'])
                               ->setCellValue("L$j", $data[$i]['email'])
                               ->setCellValue("M$j", $data[$i]['phone']);
            }


            // Rename worksheet (worksheet, not filename)
            $objPHPExcel->getActiveSheet()->setTitle('createdUsingPHPExcel');


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Excel2007)
            //clean the output buffer
            ob_end_clean();

            //this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
            //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //so, we use this header instead.
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=customer_details.$type");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');

    }
    function get_items(){                  
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='brands';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
        function data_table(){
        $aColumns = array( 'guid','name','code','name','location','b_name','c_name','d_name','guid','active_status' );	
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
		$like =array('items.name'=>  $this->input->get_post('sSearch'),
                    'brands.name'=>  $this->input->get_post('sSearch'),
                    'items.code'=>  $this->input->get_post('sSearch'),
                    'items.barcode'=>  $this->input->get_post('sSearch'),
                    'items_category.category_name'=>  $this->input->get_post('sSearch'),
                    'items_department.department_name'=>  $this->input->get_post('sSearch'),
                        );
				
			}
			$this->load->model('core_model')		   ;
			 $rResult1 = $this->core_model->items_data_table($end,$start,$order,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->posnic->data_table_count('items');
		
		$iTotal =$this->posnic->data_table_count('items');
		
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
            $report= $this->posnic->posnic_module_active($id,'items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    
    function delete($guid){
         if($this->session->userdata['brands_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');             
              $this->posnic->posnic_delete($guid,'items');
              $this->load->model('core_model');
              $this->core_model->delete_item_setting($guid,$this->session->userdata['branch_id']);
              echo 'TRUE';
               
            }
    }
    }
    function add_new_item(){
        
        if($this->input->post('cost')){
              if($this->session->userdata['items_per']['add']===1){
                  
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required");
                            $this->form_validation->set_rules("sku",$this->lang->line('sku'),'required');                           
                            $this->form_validation->set_rules('cost', $this->lang->line('cost'),'required|numeric|xss_clean'); 
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|numeric|xss_clean'); 
                            $this->form_validation->set_rules('mrp', $this->lang->line('mrp'),'required|numeric|xss_clean'); 
                            $this->form_validation->set_rules('no_of_unit', $this->lang->line('no_of_unit'),'numeric|xss_clean'); 
                            $this->form_validation->set_rules('weight', $this->lang->line('weight'),'numeric|xss_clean'); 
                          
                            $this->form_validation->set_rules('taxes', $this->lang->line('taxes'),'required');
                            $this->form_validation->set_rules('taxes_area', $this->lang->line('taxes_area'),'required');
                            $this->form_validation->set_rules('supplier', $this->lang->line('supplier'),'required');
                            $this->form_validation->set_rules('brand', $this->lang->line('brand'),'required');
                            $this->form_validation->set_rules('category', $this->lang->line('category'),'required');
                            $this->form_validation->set_rules('item_department', $this->lang->line('item_department'),'required'); 
                            $this->form_validation->set_rules('userfile', 'userfile', 'callback_add_items_image');
                            if ( $this->form_validation->run() !== false ) {
                                    $data=array('code'=>$this->input->post('sku'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost'),
                                    'selling_price'=>$this->input->post('selling_price'),                                   
                                    'mrp'=>$this->input->post('mrp'),
                                    'discount'=>$this->input->post('discount_per'),
                                    'start_date'=>  strtotime($this->input->post('starting_date')),
                                    'end_date'=>strtotime($this->input->post('ending_date')),
                                    'tax_Inclusive'=>$this->input->post('tax_Inclusive'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('taxes'),
                                    'image'=>$this->user_image,
                                    'no_of_unit'=>$this->input->post('no_of_unit')==""?1:$this->input->post('no_of_unit'),
                                    'decomposition'=>$this->input->post('weight')==""?0:1,
                                    'weight'=>$this->input->post('weight'),
                                    'uom'=>$this->input->post('unit_of_mes'),
                                    'tax_area_id'=>$this->input->post('taxes_area'),
                                    'depart_id'=>$this->input->post('item_department'),
                                    'brand_id'=>$this->input->post('brand'));
                                      $value=array('code'=>$this->input->post('sku'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('name'),
                                         );
                                 if($this->posnic->check_unique($value,'items')){ 
                                      $this->user_image;
                                     echo 'TRUE';
                                     $this->user_image="";
                                     $id=$this->posnic->posnic_add_record($data,'items');
                                     $this->load->model('core_model');
                                     $this->core_model->item_setting($id,$this->session->userdata['branch_id']);
                                     $this->core_model->suppliers_x_items($id,$this->session->userdata['branch_id'],$this->input->post('mrp'),$this->input->post('supplier'),$this->input->post('selling_price'),$this->input->post('cost'));
                               
                                     }else{
                                        echo "ALREADY";
                                       
                                    }
                        }else{
                           echo "FALSE";
                        }
        
             } 
        }
    
    }
    
  
    function edit_items($guid){
        if($this->session->userdata['brands_per']['edit']==1){
        $this->load->model('core_model')		   ;
	$data = $this->core_model->get_items_details_for_update($this->session->userdata['branch_id'],$guid);
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
    function update_items(){       
        if($this->session->userdata['items_per']['edit']==1){
             $guid=$this->input->post('guid');
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required");
                            $this->form_validation->set_rules("sku",$this->lang->line('sku'),'required');                           
                            $this->form_validation->set_rules('cost', $this->lang->line('cost'),'required|numeric|xss_clean'); 
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|numeric|xss_clean'); 
                            $this->form_validation->set_rules('mrp', $this->lang->line('mrp'),'required|numeric|xss_clean'); 
                          
                            $this->form_validation->set_rules('taxes', $this->lang->line('taxes'),'required');
                            $this->form_validation->set_rules('taxes_area', $this->lang->line('taxes_area'),'required');
                            $this->form_validation->set_rules('supplier', $this->lang->line('supplier'),'required');
                            $this->form_validation->set_rules('brand', $this->lang->line('brand'),'required');
                            $this->form_validation->set_rules('category', $this->lang->line('category'),'required');
                            $this->form_validation->set_rules('item_department', $this->lang->line('item_department'),'required');  
                            $this->form_validation->set_rules('userfile', 'userfile', 'callback_add_items_image');
                          if ( $this->form_validation->run() !== false ) {
                                $this->add_items_image();
                                if($this->user_image==""){
                                    $data=array('code'=>$this->input->post('sku'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost'),
                                    'selling_price'=>$this->input->post('selling_price'),                                   
                                    'mrp'=>$this->input->post('mrp'),
                                    'discount'=>$this->input->post('discount_per'),
                                    'start_date'=>$this->input->post('starting_date'),
                                    'end_date'=>$this->input->post('ending_date'),
                                    'tax_Inclusive'=>$this->input->post('tax_Inclusive'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('taxes'),
                                    'no_of_unit'=>$this->input->post('no_of_unit')==""?1:$this->input->post('no_of_unit'),
                                    'decomposition'=>$this->input->post('weight')==""?0:1,
                                    'weight'=>$this->input->post('weight'),
                                    'uom'=>$this->input->post('unit_of_mes'),
                                    'tax_area_id'=>$this->input->post('taxes_area'),
                                    'depart_id'=>$this->input->post('item_department'),
                                    'brand_id'=>$this->input->post('brand'));
                               }else{
                                    $data=array('code'=>$this->input->post('sku'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost'),
                                    'selling_price'=>$this->input->post('selling_price'),                                   
                                    'mrp'=>$this->input->post('mrp'),
                                    'discount'=>$this->input->post('discount_per'),
                                    'start_date'=>$this->input->post('starting_date'),
                                    'end_date'=>$this->input->post('ending_date'),
                                    'tax_Inclusive'=>$this->input->post('tax_Inclusive'),
                                    'location'=>$this->input->post('location'),
                                    'image'=>$this->user_image,
                                    'no_of_unit'=>$this->input->post('no_of_unit')==""?1:$this->input->post('no_of_unit'),
                                    'decomposition'=>$this->input->post('weight')==""?0:1,
                                    'weight'=>$this->input->post('weight'),
                                    'uom'=>$this->input->post('unit_of_mes'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('taxes'),
                                    'tax_area_id'=>$this->input->post('taxes_area'),
                                    'depart_id'=>$this->input->post('item_department'),
                                    'brand_id'=>$this->input->post('brand'));}

                                    $value=array('guid !='=>$this->input->post('guid'),'code'=>$this->input->post('sku'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('name'),
                                         );
                                 if($this->posnic->check_unique($value,'items')){ 
                                     echo 'TRUE';
                                     $this->user_image="";
                                     $where=array('guid'=>$guid);
                                    
                                        $this->posnic->posnic_update_record($data,$where,'items');
                                    
                                 }else{
                                     
                                       echo 'ALREADY';
                                    }            
               
            
                        }else{
                           echo 'FALSE';
                        }
        }else{
            echo 'NOOP';
        }
    }
    function items_list(){
        $aColumns = array( 'guid','code','code',  'name','description','phone', 'company_name',  'active', 'guid','guid', );	
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
	$like =array('name'=>  $this->input->get_post('sSearch'),
            'code'=>  $this->input->get_post('sSearch'),
            'name'=>  $this->input->get_post('sSearch'),
            'description'=>  $this->input->get_post('sSearch'));
            
        }
        $this->load->model('core_model');
        $join_where='items.supplier_id=suppliers.guid ';
      
       // $rResult1 = $this->core_model->posnic_data_table($end,$start,'items','suppliers',$join_where,$this->session->userdata['branch_id'],$this->session->userdata['guid'],$order,$like);
        $rResult1 = $this->posnic->posnic_data_table($end,$start,'items','suppliers',$join_where,$order,$like,'');
      
	$iFilteredTotal =5;// $this->pos_users_model->pos_users_count($this->session->userdata['guid'],$this->session->userdata['branch_id']);	
	$iTotal =5;// $this->pos_users_model->pos_users_count($this->session->userdata['guid'],$this->session->userdata['branch_id']);	
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
    function get_department(){
        $search= $this->input->post('term');
        $like=array('department_name'=>$search);
        $data= $this->posnic->posnic_select2('items_department',$like);      
        echo json_encode($data);        
    }
    function get_category(){
        $search= $this->input->post('term');
        $like=array('category_name'=>$search);
        $data= $this->posnic->posnic_select2('items_category',$like);      
        echo json_encode($data);            
    }
    function get_brand(){
        $search= $this->input->post('term');
        $like=array('name'=>$search);
        $data= $this->posnic->posnic_select2('brands',$like);      
        echo json_encode($data);
        
    }
    function get_supplier(){
        $search= $this->input->post('term');
        $like=array('company_name '=>$search,'first_name '=>$search,'phone '=>$search,'email'=>$search);
        $data= $this->posnic->posnic_select2('suppliers',$like);      
        echo json_encode($data);
        
    }
    function get_taxes_area(){
        $search= $this->input->post('term');
        $like=array('name'=>$search);
        $data= $this->posnic->posnic_or_like('taxes_area',$like);      
        echo json_encode($data);
        
    }
    function get_taxes(){
        $search= $this->input->post('term');
        $like=array('tax_types.type'=>$search);
        $this->load->model('core_model');
        $data= $this->core_model->get_taxes($this->session->userdata['branch_id'],$like);      
        echo json_encode($data);
        
    }
    function add_items_image(){
        $config['upload_path'] = './uploads/items';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '202100';
        $config['max_width']  = '11024';
        $config['max_height']  = '3768';
        $randomString = md5(time());
        $config['file_name']=$randomString;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
                return false;
        }
        else
        {       
                $upload_data = $this->upload->data();
                $this->user_image =$upload_data['file_name'];
                return true; 
        }
    }
    function import(){
        if($this->session->userdata['customers_per']['import']==1){
            $config['upload_path'] = './uploads/import';
            $config['allowed_types'] = 'csv|xlsx|xls';
            $config['max_size']	= '9999999';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                print_r($error['error']);
                
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
                      
                        $field[$j][]=$column;
                        $field[$j][]=$data_value;
                        $j++;
                       
                    }           
                }
                $this->session->set_userdata(array('import_file'=>$upload_data['file_name']));
               
                echo json_encode($field);

            }
         }else{
             echo 'Noop';
         }
    
    }
    function posnic_mapping_import(){
        if($this->session->userdata['customers_per']['import']==1){           
            $first_name=  $this->input->post('first_name');
            $last_name=  $this->input->post('last_name');
            $address1=  $this->input->post('address1');
            $address2=  $this->input->post('address2');
            $birthday=  $this->input->post('birthday');
            $Marragedate=  $this->input->post('Marragedate');
            $city=  $this->input->post('city');
            $state=  $this->input->post('state');
            $zip=  $this->input->post('zip');
            $country=  $this->input->post('country');
            $company=  $this->input->post('company');
            $website=  $this->input->post('website');
            $email=  $this->input->post('email');
            $phone=  $this->input->post('phone');
            $file =  './uploads/import/'.$this->session->userdata('import_file') ;
                //load the excel library
                $this->load->library('excel'); 
                $objPHPExcel = PHPExcel_IOFactory::load($file); 
                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection(); 
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {
                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();    
                    //header will/should be in row 1 only. of course this can be modified to suit your need.
                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                        
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }           
                }
                $fail=0;
                $success=0;
                $already=0;
                $this->load->library('form_validation');
            for($i=2;$i<count($arr_data)+2;$i++){
                
                $non_post=array('first_name' =>$arr_data[$i][$first_name],
                            'last_name' =>$arr_data[$i][$first_name],
                            'address' =>$arr_data[$i][$address1],
                            'birthday' =>$arr_data[$i][$birthday],
                            'Marragedate' =>$arr_data[$i][$Marragedate],
                            'city' =>$arr_data[$i][$city],
                            'state' =>$arr_data[$i][$state],
                            'zip' =>$arr_data[$i][$zip],
                            'country' =>$arr_data[$i][$country],
                            'website' =>$arr_data[$i][$website],
                            'company' =>$arr_data[$i][$company],
                            'email' =>$arr_data[$i][$email],
                            'phone' =>$arr_data[$i][$phone]);
                
                $_POST=$non_post;
                
                $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                $this->form_validation->set_rules("city",$this->lang->line('city'),"required"); 
                $this->form_validation->set_rules("state",$this->lang->line('state'),"required"); 
                $this->form_validation->set_rules("zip",$this->lang->line('zip'),"required"); 
                $this->form_validation->set_rules("country",$this->lang->line('country'),"required"); 
                $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'max_length[12]|regex_match[/^[0-9]+$/]|xss_clean');
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
                        'website'=>$this->input->post('website'),
                        'address'=>$this->input->post('address'),
                        'company_name'=>$this->input->post('company'),                                   
                        'bday'=>strtotime($this->input->post('dob')),
                        'mday'=>strtotime($this->input->post('marragedate')),
                       );
                         $where=array('phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'));
                    if($this->posnic->check_record_unique($where,'customers')){                   
                            $this->posnic->posnic_add_record($values,'customers');
                    ++$success;
                }else{
                   ++$already;
                }
                }  else {
                    echo $arr_data[$i][$email];
                     echo validation_errors() ;
                ++$fail;
                }
               
            }
            $status['success']=$success;
            $status['fail']=$fail;
            $status['already']=$already;
            $status['no']=$row-1;
            echo json_encode($status);
        }
    }    
    
}
?>
