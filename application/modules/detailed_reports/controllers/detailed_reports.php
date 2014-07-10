<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detailed_reports extends MX_Controller 
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='detailed_reports';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');

//echo date('H:i');
//echo '<pre><br>';
//echo $time=strtotime('04:20');
//echo '<pre><br>';
//echo date('H:i',strtotime(date('H:i')));


    // Then call the date functions
 
    }
    function get_branch(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_branch($like);
        echo json_encode($data);                
    }
    function get_report(){
        $this->load->model('report');
        $report=  $this->input->post('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $branch=  $this->input->post('branch');
        $data=array();
        if($report!=""){
            for($i=0;$i<count($branch);$i++){
               $data= array_merge($data,  $this->report->get_report($branch[$i],$report,$start,$end));
            }
        }
        echo json_encode($data);
    }
    function search_suppliers(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_suppliers($like);
        echo json_encode($data); 
    }
    function search_item_category(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_item_category($like);
        echo json_encode($data); 
    }
    function search_item_department(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_item_department($like);
        echo json_encode($data); 
    }
    function search_item_brand(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_item_brand($like);
        echo json_encode($data); 
    }
    function search_purchase_items(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_purchase_items($like);
        echo json_encode($data); 
    }
    function get_purchase_branch_base_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $branch=  $this->input->post('branch');
        $data=array();
            for($i=0;$i<count($branch);$i++){
               $data= array_merge($data,  $this->report->get_purchase_branch_base_report($branch[$i],$start,$end));
            }
        
        echo json_encode($data);
    }
    function get_purchase_supplier_base_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $supplier=  $this->input->post('supplier');
        $data=array();
            for($i=0;$i<count($supplier);$i++){
               $data= array_merge($data,  $this->report->get_purchase_supplier_base_report($supplier[$i],$start,$end));
            }
        
        echo json_encode($data);
    }

     function get_purchase_items_all_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $supplier=  $this->input->post('supplier');
        $item=  $this->input->post('item');
        $category=$this->input->post('category');
        $department =$this->input->post('department');
        $brand=$this->input->post('brand');
        $to_time=$this->input->post('to_time');
        $from_time=$this->input->post('from_time');
       max(count($department),count($brand),count($item),count($category),count($supplier));
        $data=array();
          for($i=0;$i<max(count($department),count($brand),count($item),count($category),count($supplier));$i++){
               $data= array_merge($data,  $this->report->get_purchase_items_all_report($to_time,$from_time,$supplier[$i],$item[$i],$category[$i],$department[$i],$brand[$i],$start,$end));
          }
        echo json_encode($data);
    }
}
?>
