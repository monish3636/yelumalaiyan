<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Price_tag extends MX_Controller{
    function __construct() {
                parent::__construct();
               $this->load->library('posnic');   
    }
    function index(){ 
       //$this->get_items();
   $this->create_price_tag();
      //include_once '/text_in_image/text.php';

//         $this->load->library('zend');
//    $this->zend->load('Zend/Barcode');
//    $test = Zend_Barcode::draw('ean8', 'image', array('text' => '25122'), array());
//    var_dump($test);
//    imagejpeg($test, 'barcode4.png', 100);
    }
    function create_price_tag(){
        $this->load->model('tag') ;
        $data=  $this->tag->get_design_cord('D-123');
        
        foreach ($data as $row){
           $box_width=$row['box_width'];
           $box_height=$row['box_height'];
           if($row['label']=='barcode'){
               $barcode_top=$row['top'];
               $barcode_left=$row['left'];
           }
           if($row['label']=='store'){
               $store_top=$row['top'];
               $store_left=$row['left'];
               $store_size=$row['size'];
           }
           if($row['label']=='barcode'){
               $product_top=$row['top'];
               $product_left=$row['left'];
           }
        }
        
    $this->output->set_header("Content-Type: image/png");
    $font=  'text_in_image/arial.ttf';
    $top_file = 'uploads/price_tags/core/barcode.jpg';
    $top = imagecreatefromjpeg($top_file);
    list($top_width, $top_height) = getimagesize($top_file);
    $new = imagecreate($box_width, $box_height);
//imagecopy($new, $top, 300, 0, 0, -180, $top_width, $top_height);
imagecopy($new, $top, $barcode_left, $barcode_top, 0, 0, $top_width, $top_height);

// save to file
imagejpeg($new, 'uploads/price_tags/core/merged_image.jpg');
$bar = imagecreatefromjpeg('uploads/price_tags/core/merged_image.jpg');
$black = imagecolorallocate($bar, 0, 0, 0);
imagettftext($bar, 40, 0, $top_width+40, 110, $black, $font, '$67');
imagettftext($bar, 12, 0, $top_width+40, 130, $black, $font, 'Sugar');
imagettftext($bar, $store_size, 0, $store_left, $store_top, $black, $font, 'POSNIC');
//magettftext($bar, 10, 0, 30, 50, $black, $font, '#133,18th Cross,29Th Main,HSR Layout');
imagejpeg($bar);


imagejpeg($bar, 'uploads/price_tags/core/merged_image.jpg');


    }
            
    function get_items(){                  
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='price_tag';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    
    function data_table(){
        $aColumns = array( 'name', 'code','name','location','b_name','c_name','guid','active_status','guid' );	
        $start = "";
        $end="";
        if ( $this->input->get_post('iDisplayLength') != '-1' )	{
            $start = $this->input->get_post('iDisplayStart');
            $end=	 $this->input->get_post('iDisplayLength');              
        }	
        $order="";
        if ( isset( $_GET['iSortCol_0'] ) )
            {	
                for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
                    {
                        if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
                        {
                            $order.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
                        }
                    }
                $order = substr_replace( $order, "", -1 );
            }
        $like = array();
        if ( $_GET['sSearch'] != "" )
            {
                $like =array('upc_ean_code'=>  $this->input->get_post('sSearch'),'items.name'=>  $this->input->get_post('sSearch'),'code'=>  $this->input->get_post('sSearch'));
            }
        $this->load->model('core_model')		   ;
        $rResult1 = $this->core_model->items_data_table($end,$start,$order,$like,$this->session->userdata['branch_id']);
        $iFilteredTotal =$this->posnic->data_table_count('items');
        $iTotal =$this->posnic->data_table_count('items');
        $output1 = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        foreach ($rResult1 as $aRow )
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] == "id" )
                    {
                        $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
                    }
                    else if ( $aColumns[$i] != ' ' )
                    {
                        $row[] = $aRow[$aColumns[$i]];
                    }
            }

            $output1['aaData'][] = $row;
        }
        echo json_encode($output1);
    }
    
    function get_price_tag_details($guid){
        $this->load->model('core_model');
        $data[0]=  $this->core_model->get_items_details_for_update($this->session->userdata['branch_id'],$guid);
        $data[1]=  $this->core_model->get_price_tag_details($this->session->userdata['branch_id'],$guid);
        echo json_encode($data);       
    }
    
    function set_item($guid){
        $data['guid']=$guid;
        $this->load->view('set_item',$data);
    }
    
    function reset_item($guid){
        $where=array('guid'=>$guid);
        $data['row']=$this->posnic->posnic_result($where);
        $this->load->view('edit_setting',$data);
    }
    
    function save_design(){
        if($this->session->userdata['price_tag_per']['set']==1){
                $design=$this->input->post('design');
                $label=$this->input->post('label');
                $left=  $this->input->post('left');
                $top=  $this->input->post('top');
                $bold=  $this->input->post('bold');
                $italic=  $this->input->post('italic');
                $under_line=  $this->input->post('under_line');
                $size=  $this->input->post('size');
                $width=  $this->input->post('width');
                $height=  $this->input->post('height');
                $this->load->model('tag');
                if($this->tag->check_duplicate($design)){
                for($i=0;$i<count($label);$i++){
                    $val=array('design'=>$design,'label'=>$label[$i],'left'=>$left[$i],'top'=>$top[$i],'bold'=>$bold[$i],'italic'=>$italic[$i],'under_line'=>$under_line[$i],'size'=>$size[$i],'width'=>$width[$i],'height'=>$height[$i],);
                    $this->tag->save_design($val);
                   
                } echo 'True';
                }else{
                    echo 'Already';
                }
        }else{ 
            echo 'Noop';
        }   
        
    }
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
    
    
}
?>
