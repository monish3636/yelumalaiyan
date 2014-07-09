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
    function get_purchase_items_base_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $items=  $this->input->post('items');
        $data=array();
            for($i=0;$i<count($items);$i++){
               $data= array_merge($data,  $this->report->get_purchase_items_base_report($items[$i],$start,$end));
            }        
        echo json_encode($data);
    }
    function get_purchase_items_category_base_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $category=  $this->input->post('category');
        $data=array();
            for($i=0;$i<count($category);$i++){
               $data= array_merge($data,  $this->report->get_purchase_items_category_base_report($category[$i],$start,$end));
            }        
        echo json_encode($data);
    }
    function get_purchase_items_department_base_report(){
        $this->load->model('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        $department=  $this->input->post('department');
        $data=array();
            for($i=0;$i<count($department);$i++){
               $data= array_merge($data,  $this->report->get_purchase_items_department_base_report($department[$i],$start,$end));
            }        
        echo json_encode($data);
    }
   
}
?>
