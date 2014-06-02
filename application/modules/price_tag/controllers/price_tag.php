<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Price_tag extends MX_Controller{
    function __construct() {
                parent::__construct();
               $this->load->library('posnic');   
    }
    function index(){ 
     // $this->get_items();
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
               $store_color=$row['color'];
               $store_bold=$row['bold'];
               $store_tarnsform=$row['transform'];
               $store_width=$row['width'];
               $store_italic=$row['italic'];
               $store_under_line=$row['under_line'];
           }
           if($row['label']=='product'){
               $product_top=$row['top'];
               $product_left=$row['left'];
               $product_size=$row['size'];
               $product_color=$row['color'];
               $product_bold=$row['bold'];
               $product_tarnsform=$row['transform'];
               $product_width=$row['width'];
               $product_italic=$row['italic'];
               $product_under_line=$row['under_line'];
           }
        }
        
    $this->output->set_header("Content-Type: image/png");
    $font=  'text_in_image/arial.ttf';
    $italic=  'uploads/price_tags/core/font/605.ttf';
    $top_file = 'uploads/price_tags/core/barcode.jpg';
    $top = imagecreatefromjpeg($top_file);
    list($top_width, $top_height) = getimagesize($top_file);
    $new = imagecreate($box_width, $box_height);
//imagecopy($new, $top, 300, 0, 0, -180, $top_width, $top_height);
imagecopy($new, $top, $barcode_left, $barcode_top, 0, 0, $top_width, $top_height);

/* store name design start*/
imagejpeg($new, 'uploads/price_tags/core/merged_image.jpg');
$bar = imagecreatefromjpeg('uploads/price_tags/core/merged_image.jpg');

$color=array();
$color=explode(',',$store_color);
$black = imagecolorallocate($bar,$color[0], $color[1], $color[2]);
if($store_italic=='italic'){
    $store_font=$italic;
}else{
    $store_font=$font;
}
    imagettftext($bar, $store_size, $store_tarnsform, $store_left, $store_top, $black, $store_font, 'POSNIC');
if($store_bold==700){
    imagettftext($bar, $store_size, $store_tarnsform, $store_left+1, $store_top+1, $black, $store_font, 'POSNIC');
}
if($store_under_line!='none'){
imagefilledrectangle($bar,$store_width+$store_left,$store_top+5,$store_left,$store_top+7,$black);
}
/* store name design end*/
/* product details design start*/


$color=array();
$color=explode(',',$product_color);
$black = imagecolorallocate($bar,$color[0], $color[1], $color[2]);
if($product_italic=='italic'){
    $product_font=$italic;
}else{
    $product_font=$font;
}
    imagettftext($bar, $product_size, $product_tarnsform, $product_left, $product_top, $black, $product_font, 'Sugar');
if($product_bold==700){
    imagettftext($bar, $product_size, $product_tarnsform, $product_left+1, $product_top+1, $black, $product_font, 'Sugar');
}
if($product_under_line!='none'){
imagefilledrectangle($bar,$product_width+$product_left,$product_top+5,$product_left,$product_top+7,$black);
}
/* product details design end*/
     foreach ($data as $row){
        if($row['label']=='label'){
            $color=array();
            $color=explode(',',$row['color']);
            $black = imagecolorallocate($bar,$color[0], $color[1], $color[2]);
            if($row['italic']=='italic'){
                $row['font']=$italic;
            }else{
                $row['font']=$font;
            }
                imagettftext($bar, $row['size'], $row['transform'], $row['left'], $row['top'], $black, $row['font'], $row['content']);
            if($row['bold']==700){
                 imagettftext($bar, $row['size'], $row['transform'], $row['left']+1, $row['top']+1, $black, $row['font'], $row['content']);
            }
            if($row['under_line']!='none'){
                imagefilledrectangle($bar,$row['width']+$row['left'],$row['top']+5,$row['left'],$row['top']+7,$black);
            }
        }
     }

imagettftext($bar, 40, 0, $top_width+40, 110, $black, $italic, '$67');
//magettftext($bar, 10, 0, 30, 50, $black, $font, '#133,18th Cross,29Th Main,HSR Layout');
imagejpeg($bar);


imagejpeg($bar, 'uploads/price_tags/core/merged_image.jpg');


    }
    function wrap($fontSize, $angle, $fontFace, $string, $width){
   
    $ret = "";
   
    $arr = explode(' ', $string);
   
    foreach ( $arr as $word ){
   
        $teststring = $ret.' '.$word;
        $testbox = imagettfbbox($fontSize, $angle, $fontFace, $teststring);
        if ( $testbox[2] > $width ){
            $ret.=($ret==""?"":"\n").$word;
        } else {
            $ret.=($ret==""?"":' ').$word;
        }
    }
   
    return $ret;
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
