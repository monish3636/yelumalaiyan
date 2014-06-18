<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Keyboard_sales extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){  
        $this->session->set_userdata(array('currency_symbol'=>'$'));
        $data=array();
        $this->load->model('stock');
       
    //    $this->load->view('template/app/header'); 
        $this->load->view('header');  
        $this->load->view('index');  
  
        $this->load->view('footer');
    }
    /*
    * get customer details for sales order
    *  */       
   // functoon starts
    function search_customer(){
        $search= $this->input->post('term'); 
        $this->load->model('stock');
        $data=$this->stock->search_customers($search);
        echo json_encode($data);
    }
   // function end
   // functoon starts
    function search_items(){
        $search= $this->input->post('term'); 
        $this->load->model('stock');
        $data=$this->stock->search_items($search);
        echo json_encode($data);
    }
   // function end
    function get_items($code){
        $this->load->model('stock');
        $data=  $this->stock->get_items($code);
        echo json_encode($data);
    }
}

