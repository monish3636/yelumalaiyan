<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Touch_sales extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){  
        $this->session->set_userdata(array('currency_symbol'=>'$'));
        $data=array();
        $this->load->model('stock');
        $data['row']=  $this->stock->get_items();
        $this->load->view('header/header');  
        $this->load->view('index',$data);  
    }
    }

