<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Suppliers extends MX_Controller{
    function __construct() {
                parent::__construct();
                $this->load->library('posnic'); 
    }
    function index(){     
          $this->get(); 
    }
     function export($type){
            $this->load->library('Excel'); 
              // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("posnic.com")
                 ->setLastModifiedBy( $this->session->userdata('first_name'))
                 ->setTitle("Customer Deatils")
                 ->setSubject("Customer Deatils")
                 ->setDescription("Customer Deatils")
                 ->setKeywords("Customer Deatils")
                 ->setCategory("Customer");

         $this->load->model('supplier');
         $data=  $this->supplier->export_supplier();
    // Add some data
         $j=1;
              $objPHPExcel->setActiveSheetIndex(0)
                               ->setCellValue("A$j",  $this->lang->line('first_name') )
                               ->setCellValue("B$j", $this->lang->line('last_name'))
                               ->setCellValue("E$j",$this->lang->line('category'))
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
                               ->setCellValue("C$j", $this->supplier->get_suplier($data[$i]['category']))
                               ->setCellValue("D$j", $data[$i]['address1'])
                               ->setCellValue("E$j", $data[$i]['city'])
                               ->setCellValue("F$j", $data[$i]['state'])
                               ->setCellValue("G$j", $data[$i]['country'])
                               ->setCellValue("H$j", $data[$i]['zip'])
                               ->setCellValue("I$j", $data[$i]['company'])
                               ->setCellValue("J$j", $data[$i]['website'])
                               ->setCellValue("K$j", $data[$i]['email'])
                               ->setCellValue("L$j", $data[$i]['phone']);
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
            header("Content-Disposition: attachment;filename=supplier_details.$type");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');

    }
    function get(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='suppliers';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function suppliers_data_table(){
        $aColumns = array( 'guid','first_name','first_name','company_name','c_name','phone','email','email','active_status' );	
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
		$like =array('first_name'=>  $this->input->get_post('sSearch'));
				
			}
                        $this->load->model('supplier')	   ;
                        
			 $rResult1 = $this->supplier->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->posnic->data_table_count('suppliers');
		
		$iTotal =$this->posnic->data_table_count('suppliers');
		
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
            $report= $this->posnic->posnic_module_active($id,'suppliers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'suppliers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
   function delete(){
        if($this->session->userdata['suppliers_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'suppliers');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function add_suppliers(){
            if($this->session->userdata['suppliers_per']['add']=="1"){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
                            	  
                        if ( $this->form_validation->run() !== false ) {
                            $value=array('first_name'=>$this->input->post('first_name'),
                                   'last_name'=>$this->input->post('last_name'),                                   
                                    'comments'=>$this->input->post('comment'),
                                    'website'=>$this->input->post('website'), 
                                    'company_name '=>$this->input->post('company'),
                                    'account_number'=>$this->input->post('account_no'),
                                    'credit_days '=>$this->input->post('credit_days'),
                                    'credit_limit '=>$this->input->post('credit_limit'),
                                    'monthly_credit_bal '=>$this->input->post('balance'),
                                    'bank_name '=>$this->input->post('bank_name'),
                                    'bank_location '=>$this->input->post('bank_location'),
                                    'cst_no '=>$this->input->post('cst'),
                                    'gst_no '=>$this->input->post('gst'),
                                    'tex_reg_no '=>$this->input->post('tax_no'),
                                 'category '=>$this->input->post('category'),
                                    
                                    );
                            $guid=$this->posnic->posnic_add_record($value,'suppliers');
                            $this->load->model('supplier');
                            $address=  $this->input->post('address');
                            $city=  $this->input->post('city');
                            $state=  $this->input->post('state');
                            $country=  $this->input->post('country');
                            $zip=  $this->input->post('zip');
                            $email=  $this->input->post('email');
                            $phone=  $this->input->post('phone');
                            for($i=0;$i<count($phone);$i++){
                            $this->supplier->add_contact($guid,$address[$i],$city[$i],$state[$i],$country[$i],$zip[$i],$email[$i],$phone[$i]);
                            }
                            $this->supplier->update_suplier_contact($guid,$address[0],$city[0],$state[0],$country[0],$zip[0],$phone[0],$email[0]);
                            
                        echo 'TRUE'   ;
                                   }else{
                                        echo 'FALSE';
                                   }    
                        }else{
                            echo 'NOOP';
                        }
                
        }
    
    function update_suppliers(){        
     
            if($this->input->post('guid')){
               if($this->session->userdata['suppliers_per']['edit']==1){
                    $this->load->library('form_validation');
                         $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                         $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
                            	  
                        if ( $this->form_validation->run() !== false ) {
                            $value=array('first_name'=>$this->input->post('first_name'),
                                   'last_name'=>$this->input->post('last_name'),                                   
                                    'comments'=>$this->input->post('comment'),
                                    'website'=>$this->input->post('website'), 
                                    'company_name '=>$this->input->post('company'),
                                    'account_number'=>$this->input->post('account_no'),
                                    'credit_days '=>$this->input->post('credit_days'),
                                    'credit_limit '=>$this->input->post('credit_limit'),
                                    'monthly_credit_bal '=>$this->input->post('balance'),
                                    'bank_name '=>$this->input->post('bank_name'),
                                    'bank_location '=>$this->input->post('bank_location'),
                                    'cst_no '=>$this->input->post('cst'),
                                    'gst_no '=>$this->input->post('gst'),
                                    'tex_reg_no '=>$this->input->post('tax_no'),
                                    'category '=>$this->input->post('category'),
                                    
                                    );
                            $guid=  $this->input->post('guid');
                            $update_where=array('guid'=>$guid);
                           $this->posnic->posnic_update_record($value,$update_where,'suppliers');
                            $this->load->model('supplier');
                            $address=  $this->input->post('address');
                            $city=  $this->input->post('city');
                            $state=  $this->input->post('state');
                            $country=  $this->input->post('country');
                            $zip=  $this->input->post('zip');
                            $email=  $this->input->post('email');
                            $phone=  $this->input->post('phone');
                            $this->supplier->delete_conatct($guid);
                                 for($i=0;$i<count($phone);$i++){
                            $this->supplier->add_contact($guid,$address[$i],$city[$i],$state[$i],$country[$i],$zip[$i],$email[$i],$phone[$i]);
                            }
                            $this->supplier->update_suplier_contact($guid,$address[0],$city[0],$state[0],$country[0],$zip[0],$phone[0],$email[0]);
                                    echo "TRUE";
                                        }else{
                                        echo 'FALSE';
                                    }
                                  
                                    
                                   }else{
                                        echo 'NOOP'; 
                                   }    
                        }else{
                         echo 'FASLE';
                        }
                    
               
            } 

   
   
  
    function edit_suppliers($guid){
      if($this->session->userdata['suppliers_per']['edit']==1){
                  
                  $this->load->model('supplier');
                  $data=$this->supplier->edit_supplier($guid);
                  echo json_encode($data);
        }
    } 
    function get_category(){
        $search= $this->input->post('term');
        $like=array('category_name'=>$search);
        $data= $this->posnic->posnic_select2('suppliers_category',$like);      
        echo json_encode($data);
        
        
    }
    function import(){
        if($this->session->userdata['suppliers_per']['import']==1){
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
        if($this->session->userdata['suppliers_per']['import']==1){           
            $first_name=  $this->input->post('first_name');
            $last_name=  $this->input->post('last_name');
            $address1=  $this->input->post('address1');
            $category=  $this->input->post('category');
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
                $this->load->model('supplier');
            for($i=2;$i<count($arr_data)+2;$i++){
                
                $non_post=array('first_name' =>$arr_data[$i][$first_name],
                            'last_name' =>$arr_data[$i][$first_name],
                            'address' =>$arr_data[$i][$address1],
                            'category' =>$arr_data[$i][$category],
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
                $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
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
                        'address1'=>$this->input->post('address'),
                        'company_name'=>$this->input->post('company'),  
                        'category'=>  $this->supplier->category($this->input->post('category'))
                       );
                         $where=array('phone'=>$this->input->post('phone'),'email'=>$this->input->post('email'));
                    if($this->posnic->check_record_unique($where,'suppliers')){                   
                            $this->posnic->posnic_add_record($values,'suppliers');
                    ++$success;
                }else{
                   ++$already;
                }
                }  else {
                   
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
