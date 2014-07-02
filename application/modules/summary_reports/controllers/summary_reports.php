<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary_reports extends MX_Controller 
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='summary_reports';
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
        $report=  $this->input->post('report');
        $start=  $this->input->post('start');
        $end=  $this->input->post('end');
        if($report!=""){
          
        }
    }
   
}
?>
