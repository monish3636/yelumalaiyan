<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function search_branch($search){
        if($this->session->userdata('user_type')==2){
            $this->db->select()->from('users_x_branches')->where('branches.active_status',1)->where('branches.delete_status',0);
            $this->db->join('branches', 'branches.guid=users_x_branches.branch_id','left');
            $this->db->group_by('branches.guid');
            $sql=  $this->db->get();
            return $sql->result();
            
        }else{
            $this->db->select()->from('users_x_branches')->where('users_x_branches.user_id',  $this->session->userdata('guid'))->where('branches.active_status',1)->where('branches.delete_status',0);
            $this->db->join('branches', 'branches.guid=users_x_branches.branch_id','left');
            $sql=  $this->db->get();
            return $sql->result();
        }
                
    }
}
?>

