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
    function search_sales(){
        $like= $this->input->post('term');  
        $this->load->model('report');
        $data= $this->report->search_sales($like);
        echo json_encode($data);                
    }
    /* get sale deatils
     * function start     */
    function get_sales($guid){
        $this->load->model('report');
        $data= $this->report->get_sales($like);
        echo json_encode($data); 
    }
    /* function end*/
    
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
   
}
?>
