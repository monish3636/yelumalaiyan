<?php
class Purchase_order_cancel extends MX_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='purchase_order_cancel';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
  
    /* save purchase order cancel
    ** function start     */
    function save(){      
         if($this->session->userdata['purchase_order_cancel_per']['add']==1){
            $this->form_validation->set_rules('purchase_order_guid',$this->lang->line('purchase_order_guid'), 'required');
            $this->form_validation->set_rules('items_order_guid[]',$this->lang->line('items_order_guid'), 'required');
            $this->form_validation->set_rules('items_po_quty[]',$this->lang->line('items_po_quty'), 'required|numeric');
            $this->form_validation->set_rules('items_po_free[]',$this->lang->line('items_po_free'), 'required|numeric');
            $this->form_validation->set_rules('items_quty[]',$this->lang->line('items_quty'), 'required|numeric');
            $this->form_validation->set_rules('items_free[]',$this->lang->line('items_quty'), 'numeric');
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('purchase_order_guid');                
                $items_order_guid=  $this->input->post('items_order_guid');
                $po_quty=  $this->input->post('items_po_quty');
                $po_free=  $this->input->post('items_po_free');
                $items_quty=  $this->input->post('items_quty');
                $items_free=  $this->input->post('items_free');  
                for($i=0;$i<count($items_order_guid);$i++){
                    $this->load->model('purchase');
                    $this->purchase->purchase_order_cancel($po,$items_order_guid[$i],$po_quty[$i],$po_free[$i],$items_free[$i],$items_quty[$i]);
                }               
                echo 'TRUE';             
            }else{
                echo 'FALSE';
            }
        }else{
            echo 'Noop';
        }
           
    }
    /* function end*/
    
    /* search purchase order
    ** function start     */
    function purchase_order_number(){
            $search= $this->input->post('term');
            $this->load->model('purchase');
            $data= $this->purchase->search_purchase_order($search,$this->session->userdata['branch_id'])    ;
            echo json_encode($data);

    }
    /* function end*/
    
    /* search item for purchase order cancel
    ** function start     */
    function search_items(){
        $search= $this->input->post('term');
        $guid= $this->input->post('purchase_order_guid');
        $this->load->model('purchase');
        $data= $this->purchase->search_items($search,$this->session->userdata['branch_id'],$guid,$this->session->userdata['data_limit']);      
        echo json_encode($data);
    }   
    /* function end*/
    
}
?>
