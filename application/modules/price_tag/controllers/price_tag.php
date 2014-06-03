<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Price_tag extends MX_Controller{
    function __construct() {
                parent::__construct();
               $this->load->library('posnic');   
    }
    function index(){ 
      $this->get_items();
  //$this->create_price_tag();
      //include_once '/text_in_image/text.php';

//         $this->load->library('zend');
//    $this->zend->load('Zend/Barcode');
//    $test = Zend_Barcode::draw('ean8', 'image', array('text' => '25122'), array());
//    var_dump($test);
//    imagejpeg($test, 'barcode4.png', 100);
    }
    function create_price_tag(){
        $this->load->model('tag') ;
        $data=  $this->tag->get_design_cord('2');
        
        foreach ($data as $row){
           $box_width=$row['box_width'];
           $box_height=$row['box_height'];
           if($row['label']=='barcode'){
               $barcode_top=$row['top'];
               $barcode_left=$row['left'];
           }
           if($row['label']=='store'){
               $store_top=$row['top']+25;
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
               $product_top=$row['top']+25;
               $product_left=$row['left'];
               $product_size=$row['size'];
               $product_color=$row['color'];
               $product_bold=$row['bold'];
               $product_tarnsform=$row['transform'];
               $product_width=$row['width'];
               $product_italic=$row['italic'];
               $product_under_line=$row['under_line'];
           }
           if($row['label']=='price_label'){
               $price_label_top=$row['top']+25;
               $price_label_left=$row['left'];
               $price_label_size=$row['size'];
               $price_label_color=$row['color'];
               $price_label_bold=$row['bold'];
               $price_label_tarnsform=$row['transform'];
               $price_label_width=$row['width'];
               $price_label_italic=$row['italic'];
               $price_label_under_line=$row['under_line'];
           }
        }
        
   
    $this->output->set_header("Content-Type: image/jpeg");
    $font=  'uploads/price_tags/core/font/Verdana.ttf';
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
$bordercolors = imagecolorallocate($bar, 0, 0, 0); 
$x = 0;

$y = 0;

$w = imagesx($bar) - 1;

$h = imagesy($bar) - 1;

imageline($bar, $x,$y,$x,$y+$h,$bordercolors);

imageline($bar, $x,$y,$x+$w,$y,$bordercolors);

imageline($bar, $x+$w,$y,$x+$w,$y+$h,$bordercolors);

imageline($bar, $x,$y+$h,$x+$w,$y+$h,$bordercolors);
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
    imagettftext($bar, $product_size, $product_tarnsform, $product_left, $product_top, $black, $product_font, 'Product Name & Unit');
if($product_bold==700){
    imagettftext($bar, $product_size, $product_tarnsform, $product_left+1, $product_top+1, $black, $product_font, 'Product Name & Unit');
}
if($product_under_line!='none'){
imagefilledrectangle($bar,$product_width+$product_left,$product_top+5,$product_left,$product_top+7,$black);
}
$color=array();
$color=explode(',',$price_label_color);
$black = imagecolorallocate($bar,$color[0], $color[1], $color[2]);
if($price_label_italic=='italic'){
    $price_label_font=$italic;
}else{
    $price_label_font=$font;
}
    imagettftext($bar, $price_label_size, $price_label_tarnsform, $price_label_left, $price_label_top, $black, $price_label_font, '$69');
if($price_label_bold==700){
    imagettftext($bar, $price_label_size, $price_label_tarnsform, $price_label_left+1, $price_label_top+1, $black, $price_label_font, '$69');
}
if($price_label_under_line!='none'){
imagefilledrectangle($bar,$price_label_width+$price_label_left,$price_label_top+5,$price_label_left,$price_label_top+7,$black);
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
            $row['top']=$row['top']+5;
                imagettftext($bar, $row['size'], $row['transform'], $row['left'], $row['top'], $black, $row['font'], $row['content']);
            if($row['bold']==700){
                 imagettftext($bar, $row['size'], $row['transform'], $row['left']+1, $row['top']+1, $black, $row['font'], $row['content']);
            }
            if($row['under_line']!='none'){
                imagefilledrectangle($bar,$row['width']+$row['left'],$row['top']+5,$row['left'],$row['top']+7,$black);
            }
        }
     }


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
        $aColumns = array( 'id', 'design','design','design','design','design','design','design','design' );	
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
                $like =array('design'=>  $this->input->get_post('sSearch'));
            }
        $this->load->model('tag')		   ;
        $rResult1 = $this->tag->data_table($end,$start,$order,$like);
        $iFilteredTotal =$this->tag->count('items');
        $iTotal= $iFilteredTotal;
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
                $image=$this->input->post('image');
                $box_height=$this->input->post('box_height');
                $box_width=$this->input->post('box_width');
                $label=$this->input->post('label');
                $left=  $this->input->post('left');
                $top=  $this->input->post('top');
                $bold=  $this->input->post('bold');
                $italic=  $this->input->post('italic');
                $under_line=  $this->input->post('under_line');
                $size=  $this->input->post('size');
                $color=  $this->input->post('color');
                $width=  $this->input->post('width');
                $height=  $this->input->post('height');
                $transform=  $this->input->post('transform');
                $content=  $this->input->post('content');
                $this->load->model('tag');
                if($this->tag->check_duplicate($design)){
                for($i=0;$i<count($label);$i++){
                    if(!$content[$i]){
                        $content[$i]="";
                    }
                    $val=array('image'=>$image,'content'=>$content[$i],'transform'=>$transform[$i],'box_width'=>$box_width,'box_height'=>$box_height,'design'=>$design,'color'=>$color[$i],'label'=>$label[$i],'left'=>$left[$i],'top'=>$top[$i],'bold'=>$bold[$i],'italic'=>$italic[$i],'under_line'=>$under_line[$i],'size'=>$size[$i],'width'=>$width[$i],'height'=>$height[$i],);
                    $this->tag->save_design($val);
                   
                } echo 'True';
                }else{
                    echo 'Already';
                }
        }else{ 
            echo 'Noop';
        }   
        
    }
    function import_design(){        
        $config['upload_path'] = './uploads/price_tags';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '202100';
        $config['max_width']  = '11024';
        $config['max_height']  = '3768';
        $randomString = md5(time().date("Y/m/d"));
        $config['file_name']=$randomString;
      //  $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
echo 'false';
        }
        else
        {       
                $upload_data = $this->upload->data();
                echo $upload_data['file_name'];
              
        }
    }
    function language($lang){
       $lang= $this->lang->load($lang);
       return $lang;
    }
    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('tag');
        $data= $this->tag->search_items($search);      
        echo json_encode($data);
    }
    
    
}
?>
