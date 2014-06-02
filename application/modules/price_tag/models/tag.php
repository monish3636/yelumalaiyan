<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tag extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function save_design($values){
        $this->db->insert('price_tag_designs',$values);
        
    }
}

