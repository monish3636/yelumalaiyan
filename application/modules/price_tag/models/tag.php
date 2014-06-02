<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tag extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    /* save design cordinates
        function start     */
    function save_design($values){
        $this->db->insert('price_tag_designs',$values);// insert values to price_tag_designs
        
    }
    /* function end*/
    
    /* check duplicate designs 
     *  function start**/
    function check_duplicate($design){
        $this->db->select('id')->from('price_tag_designs')->where('design',$design);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE; // return false is new design is already added
        }else{
            return TRUE; // return true its a new design
        }
    }
    /* function end*/
    
    /* get design cordinates
     * funnction start   */
    function get_design_cord($val){
        $this->db->select()->from('price_tag_designs')->where('design',$val);
        $sql=$this->db->get();
        return $sql->result_array(); // return date in array format
    }
    // function end;
}

