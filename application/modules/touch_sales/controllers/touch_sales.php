<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Touch_sales extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){          
          $this->load->view('header/header');  
          $this->load->view('index');  
          
    }
    }

