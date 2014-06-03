<style type="text/css">
    .my_select{
         -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #FFFFFF;
    border-color: #C0C0C0 #D9D9D9 #D9D9D9;
    border-image: none;
    border-radius: 1px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
 
</style>	
<script type="text/javascript">
    
    function rgb2hex(rgb) {
         return rgb.split(',')[0].split('(')[1]+','+rgb.split(',')[1]+','+rgb.split(',')[2].split(')')[0]
    }
    function transform_degree(trans){
        if(trans=='none'){
            return 0;
        }
        var values = trans.split('(')[1];
        values = values.split(')')[0];
        values = values.split(',');
        var a = values[0];
        var b = values[1];
        var c = values[2];
        var d = values[3];
        var scale = Math.sqrt(a*a + b*b);
        var sin = b/scale;
        var angle = Math.round(Math.asin(sin) * (180/Math.PI));
        return angle;
    }
    function save_design(){
    
      //  $('#company').css('transform',$('#barcode').css('transform'));
    
             var label=Array();
             var left=Array();
             var top=Array();
             var bold=Array();
             var italic=Array();
             var under_line=Array();
             var size=Array();
             var color=Array();
             var width=Array();
             var height=Array();
             var transform=Array();
             var content=Array();
             var j=0;
             for(var i=2;i<$('#label_count').val();i++)
             {
               
                label[j]='label';
                left[j]=parseInt($('#drag_label_'+i).offset().left)-$('#box').offset().left;
                top[j]=parseInt($('#drag_label_'+i).offset().top)-$('#box').offset().top;
                bold[j]=$('#drag_label_'+i).css('font-weight');
                italic[j]=$('#drag_label_'+i).css('font-style');
                under_line[j]=$('#drag_label_'+i).css('text-decoration');
                size[j]=parseInt($('#drag_label_'+i).css('font-size'));
                color[j]=rgb2hex($('#drag_label_'+i).css('color'));
                width[j]=parseInt($('#drag_label_'+i).css('width'));
                height[j]=parseInt($('#drag_label_'+i).css('height'));
                transform[j]=transform_degree($('#drag_label_'+i).css('transform'));
                content[j]=$('#drag_label_'+i).text();
                j++;
             }
                label[j]='store';
                left[j]=parseInt($('#company').offset().left)-$('#box').offset().left;
                top[j]=parseInt($('#company').offset().top)-$('#box').offset().top;
                bold[j]=$('#company').css('font-weight');
                italic[j]=$('#company').css('font-style');
                under_line[j]=$('#company').css('text-decoration');
                size[j]=parseInt($('#company').css('font-size'));
                color[j]=rgb2hex($('#company').css('color'));
                width[j]=parseInt($('#company').css('width'));
                height[j]=parseInt($('#company').css('height'));
                transform[j]=transform_degree($('#company').css('transform'));
                j++;
                label[j]='product';
                left[j]=parseInt($('#product').offset().left)-$('#box').offset().left;
                top[j]=parseInt($('#product').offset().top)-$('#box').offset().top;
                bold[j]=$('#product').css('font-weight');
                italic[j]=$('#product').css('font-style');
                under_line[j]=$('#product').css('text-decoration');
                size[j]=parseInt($('#product').css('font-size'));
                color[j]=rgb2hex($('#product').css('color'));
                width[j]=parseInt($('#product').css('width'));
                height[j]=parseInt($('#product').css('height'));
                transform[j]=transform_degree($('#product').css('transform'));
                j++;
                label[j]='price_label';
                left[j]=parseInt($('#price_label').offset().left)-$('#box').offset().left;
                top[j]=parseInt($('#price_label').offset().top)-$('#box').offset().top;
                bold[j]=$('#price_label').css('font-weight');
                italic[j]=$('#price_label').css('font-style');
                under_line[j]=$('#price_label').css('text-decoration');
                size[j]=parseInt($('#price_label').css('font-size'));
                color[j]=rgb2hex($('#price_label').css('color'));
                width[j]=parseInt($('#price_label').css('width'));
                height[j]=parseInt($('#price_label').css('height'));
                transform[j]=transform_degree($('#product').css('transform'));
                j++;
                label[j]='barcode';
                left[j]=parseInt($('#barcode').offset().left)-$('#box').offset().left;
                top[j]=parseInt($('#barcode').offset().top)-$('#box').offset().top;
                bold[j]=0;
                italic[j]=0;
                under_line[j]=0;
                size[j]=0;
                color[j]='0,0,0';
                width[j]=0;
                height[j]=0;
                transform[j]=0;
         
                      $.ajax ({
                            url: "<?php echo base_url('index.php/price_tag/save_design')?>",
                            data: { 
                                design:$('#design_id').val(),
                                box_height:parseFloat($('#box_height').val()),
                                box_width:parseFloat($('#box_width').val()),
                                label:label,
                                left:left,
                                top:top,
                                bold:bold,
                                italic:italic,
                                under_line:under_line,
                                size:size,
                                color:color,
                                width:width,
                                height:height,
                                transform:transform,
                                content:content
                                
                            },
                            type:'POST',
                            complete: function(response) {
                               if(response['responseText']=='True'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('price_tag').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                      
                                    }else  if(response['responseText']=='Already'){
                                           $.bootstrapGrowl($('#design_id').val()+' <?php echo $this->lang->line('price_tag_design').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='Flase'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('price_tag_design');?>', { type: "error" });                           
                                    }
                       }
                });
                
    }
       
function posnic_add_new(){
    <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
             $("#add_item").trigger('reset');
              $('#add_item_form #item_name_data').val('');
                 $("#add_item_form #item_name_data").select2('data', {id:'',text:''});
                 
                               
                                
      $("#user_list").hide();
      $('#add_item_form').show('slow');
      $('#posnic_add_items').attr("disabled", "disabled");    
      $('#items_lists').removeAttr("disabled");
      window.setTimeout(function ()
        {

          $("#add_item_form #item_name_data").select2('open');
        }, 500);
      <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                    <?php }?>
}
function posnic_items_lists(){
      $('#edit_item_form').hide('hide');
      $('#add_item_form').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_items').removeAttr("disabled");
      $('#items_lists').attr("disabled",'disabled');
}
function clear_add_items(){
      $("#posnic_user_2").trigger('reset');
}
function reload_update_user(){
    posnic_items_lists();
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_items" class="btn btn-default" ><i class="glyphicon glyphicon-cog"></i> <?php echo $this->lang->line('setting') ?></a>  
                        <a href="javascript:posnic_items_lists()" class="btn btn-default" id="items_lists"><i class="icon icon-desktop"></i> <?php echo $this->lang->line('price_tag_design') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('items/items_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="add_item_form"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('items') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                          <th>Id</th>
                                          
                                          <th ><?php echo $this->lang->line('sku'); ?></th>
                                          <th ><?php echo $this->lang->line('name'); ?></th>
                                          <th ><?php echo $this->lang->line('location'); ?></th>
                                          <th ><?php echo $this->lang->line('brand'); ?></th>
                                          <th ><?php echo $this->lang->line('category'); ?> </th>
                                          
                                          <th><?php echo $this->lang->line('status'); ?></th>
                                          <th><?php echo $this->lang->line('action'); ?></th>
                                         </tr>
                                      </thead>
                                      <tbody></tbody>
                                      </table>
                                  </div>
                             </div>
                          </div>
                <?php echo form_close(); ?>
             </div>
        </div>
</section>
<script type="text/javascript" src="http://jqueryrotate.googlecode.com/svn/trunk/jQueryRotate.js"></script>
<script type="text/javascript">
    function box_right(){
        var width=parseFloat($('#box_width').val());
        $('#box_width').val(width+2);
        $('#box').css("width",width+2 + "px");
    }
    function box_left(){
        var width=parseFloat($('#box_width').val());
        $('#box_width').val(width-2);
        $('#box').css("width",width-2 + "px");
    }
    function box_down(){
        var height=parseFloat($('#box_height').val());
        $('#box_height').val(height+2);
        $('#box').css("height",height+2 + "px");
    }
    function box_up(){
        var height=parseFloat($('#box_height').val());
        $('#box_height').val(height-2);
        $('#box').css("height",height-2 + "px");
    }
    function add_label(){
        
    }
    function remove_field(id){
        $('#'+id).remove();
        $('#field_actions_'+id).remove();
    }
    function edit_field(id){
      //$('#box').css("display", "block");
      $('#label_text').val($('#'+id+" p").text());
       $('#label_text').removeAttr('disabled');
      $('#field_id').val(id);
    }
    function set(){
        if($('#field_id').val()!=""){
            var size=$('#label_text').css("font-size");
            $('#'+$('#field_id').val()+" p").text($('#label_text').val());
            $('#work').append('<span id="span_'+$('#field_id').val()+'">'+$('#label_text').val()+'<span>');
            $('#span_'+$('#field_id').val()).css("font-size",parseInt(size));
            var width=$('#span_'+$('#field_id').val()).width();
            var height=$('#span_'+$('#field_id').val()).height();
            $('#'+$('#field_id').val()).css('width',width+10);
            $('#_p'+$('#field_id').val()).width('width',width);
            $('#'+$('#field_id').val()).css('height',height+10);
            $('#_p'+$('#field_id').val()).css('height',height);
            $('#span_'+$('#field_id').val()).remove();
            $('#font_colorbox')
            $('#'+$('#field_id').val()+" p").css("font-size",parseInt(size));
            $('#'+$('#field_id').val()+" p").css("color",$('#font_colorbox').val());
            
            var bold=$('#label_text').css("font-weight");
                $('#'+$('#field_id').val()+" p").css("font-weight",bold);
            var style=$('#label_text').css("font-style");
                $('#'+$('#field_id').val()+" p").css("font-style",style);
            var font=$('#label_text').css("text-decoration");
                $('#'+$('#field_id').val()+" p").css("text-decoration",font);
        }
    }
    function font_size_max(){
    var size=$('#label_text').css("font-size");
    $('#label_text').css("font-size",parseInt(size)+2)
    }
    function font_size_min(){
    var size=$('#label_text').css("font-size");
    $('#label_text').css("font-size",parseInt(size)-2)
    }
    function font_bold(){
        var bold=$('#label_text').css("font-weight");
       
        if(bold=='700'){
            $('#label_text').css("font-weight",'100');
        }else{
            $('#label_text').css("font-weight",'bold');
           
        }
    }
    function font_italic(){
        var style=$('#label_text').css("font-style");
       
        if(style=='italic'){
            $('#label_text').css("font-style",'normal');
        }else{
            $('#label_text').css("font-style",'italic');
           
        }
    }
    function font_underline(){
        var font=$('#label_text').css("text-decoration");
       
        if(font=='underline'){
            $('#label_text').css("text-decoration",'none');
        }else{
            $('#label_text').css("text-decoration",'underline');
           
        }
    }
    function move_down(){
        var top=$('#'+$('#field_id').val()).css('top');
        $('#'+$('#field_id').val()).css('top',parseInt(top)+5);
    }
    function move_up(){
        var top=$('#'+$('#field_id').val()).css('top');
        $('#'+$('#field_id').val()).css('top',parseInt(top)-5);
    }
    function move_right(){
        var left=$('#'+$('#field_id').val()).css('left');
        $('#'+$('#field_id').val()).css('left',parseInt(left)+5);
    }
    function move_left(){
        var left=$('#'+$('#field_id').val()).css('left');
        $('#'+$('#field_id').val()).css('left',parseInt(left)-5);
    }
    function width_min(){
        var width=$('#p_'+$('#field_id').val()).css('width');
        var div=parseInt(width)+5;
        $('#p_'+$('#field_id').val()).css('width',parseInt(width)-1);
        $('#'+$('#field_id').val()).css('width',parseInt(div)-1);
    }
    function width_max(){
        var width=$('#p_'+$('#field_id').val()).css('width');
        var div=parseInt(width)+5;
        $('#p_'+$('#field_id').val()).css('width',parseInt(width)+1);
        $('#'+$('#field_id').val()).css('width',parseInt(div)+1);
    }
    function height_min(){
        var height=$('#p_'+$('#field_id').val()).css('height');
        var div=parseInt(height)+5;
        $('#p_'+$('#field_id').val()).css('height',parseInt(height)-1);
        $('#'+$('#field_id').val()).css('height',parseInt(div)-1);
    }
    function height_max(){
        var height=$('#p_'+$('#field_id').val()).css('height');
        var div=parseInt(height)+5;
        $('#p_'+$('#field_id').val()).css('height',parseInt(height)+1);
        $('#'+$('#field_id').val()).css('height',parseInt(div)+1);
    }
    function clock(){
        var rot=$('#rotate_value').val();
        $('#rotate_value').val(parseInt(rot)+1);
        $('#'+$('#field_id').val()).rotate(parseInt(rot)+1);
    }
    function anty_clock(){
        var rot=$('#rotate_value').val();
        $('#rotate_value').val(parseInt(rot)-1);
        $('#'+$('#field_id').val()).rotate(parseInt(rot)-1);
    }
    function reset(){
       // edit_field($('#'+$('#field_id').val()));
       $('#label_text').val('');
    }
</script>
 

<style>
#drag_label1 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0;z-index: 99999999 !important; }
#drag_input_box1 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#barcode { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#price_label { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#company { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#product { padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#box { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }
.inputs{
    z-index: 99999999 !important;
    width: 90px;
    height:25px;
}
.field_none{
    display: none;
}
.field_input{
    width: auto;
     
    
    
}
.default{
    color: black;
}
.delete_action{
     margin-left: 20px;
    margin-top: -10px;
    position: absolute;
}
.edit_action{
    // margin-left: 20px;
    margin-top: -10px;
    position: absolute;
}
.inputs:hover{
  //  border: solid #C0C0C0 1px;
}
//.btn:active, .btn.active {
.shadow {
    background: #000 !important;
 
}
</style>
<script>
$(function() {
 $("#box").on("hover", "div", function(){
    var field=this.id;
    $('#edit_actions_'+field).show();
    $('#delete_actions_'+field).show();
    
   
});
$("#box").hover( function(){
   $('.field_none').hide();
});

  
    $("#drag_input_box1" ).draggable();
    $("#drag_label1" ).draggable({
       drag: function(){
            var offset = $(this).offset();
            var xPos =$('#box').offset().left-offset.left;
            var yPos = $('#box').offset().top-offset.top;
            $('#posX').val('x: ' + xPos);
            $('#posY').val('y: ' + yPos);
        }
    });
    $("#company" ).draggable();
    $("#barcode" ).draggable({
        drag: function(){
            var offset = $(this).offset();
            var xPos =offset.left-$('#box').offset().left;
            var yPos =offset.top-$('#box').offset().top;
            $('#posX').val('x: ' + xPos);
            $('#posY').val('y: ' + yPos);
        }
    });
    $("#price_label" ).draggable();
    $("#product" ).draggable();
    $("#box" ).droppable({
        drop: function( event, ui ) {
             var input_count=parseFloat($('#input_count').val());
             var label_count=parseFloat($('#label_count').val());
          
              var draged=ui.draggable.attr("id");
           
              if(draged=='drag_label'+parseFloat(label_count-1)){
                    $('#'+draged).remove();
                    $('#label_row').append('<div id="drag_label'+label_count+'"    class="btn btn-default "><?php  echo $this->lang->line('label');?></div>');
                    $('#box').append('<div id="drag_label_'+label_count+'"    class="inputs push-left  "><p id="p_drag_label_'+label_count+'"  styel="height:30px;width:30px"><?php  echo $this->lang->line('label');?></p><a id="delete_actions_drag_label_'+label_count+'" class="field_none delete_action" href=javascript:remove_field("drag_label_'+label_count+'")><i class="icon icon-trash default"></i></a><a  id="edit_actions_drag_label_'+label_count+'" class="field_none edit_action" href=javascript:edit_field("drag_label_'+label_count+'")><i class="icon icon-edit default"></i></a></div>')
                    $( "#drag_label"+label_count ).draggable();
                    $( "#drag_label_"+label_count ).draggable();
                    $('#label_count').val(parseFloat(label_count+1));
                  //  $('#work').append('<input typ="text" id="left_drag_label'+label_count+'" value="'+$("#drag_label"+label_count).offset().left+'" >');
                  //  $('#work').append('<input typ="text" id="top_drag_label'+label_count+'" value="'+$("#drag_label"+label_count).offset().top+'" >');
                   
              }
             else{
                
                  if(draged=='barcode'){
                      $('#'+draged).removeClass('btn');
                      $('#'+draged).removeClass('btn-default');
                      $('#'+draged).addClass('default');
                  }
                  else if(draged=='company'){
                      $('#'+draged+" p").removeClass('btn');
                      $('#'+draged+" p").removeClass('btn-default');
                      $('#'+draged+" p").addClass('default');
                  }
                  else if(draged=='product'){
                      $('#'+draged+" p").removeClass('btn');
                      $('#'+draged+" p").removeClass('btn-default');
                      $('#'+draged+" p").addClass('default');
                  }
                  else if(draged=='price_label'){
                      $('#'+draged+" p").removeClass('btn');
                      $('#'+draged+" p").removeClass('btn-default');
                      $('#'+draged+" p").addClass('default');
                  }
                 
              
              }
               edit_field(draged);

        }
    });
});
</script>


<input type="hidden" id="input_count" value="2">
<input type="hidden" id="label_count" value="2">
<input type="hidden" id="field_id" value="2">
<input type="hidden" id="rotate_value" value="5">
<input type="text" id="posX" >
<input type="text" id="posY" >
<div id="work">
    
</div>
 
<section id="user_list" class="container clearfix main_section">
     <?php   $form =array('id'=>'add_item',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/add_pos_items_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
                <div id="main_content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                               <div class="panel-heading">
                                       <h4 class="panel-title"><?php echo $this->lang->line('design_price_tag') ?></h4>  
                                       <input type="hidden" name="guid" id="guid">
                                     <input type="checkbox" style="display: none" >
                               </div>
                              <br>
                              <div class="row" style="padding-left: 40px">
                                    <div class="col col-lg-2" id="input_fields">
                                        <div class="row" >
                                            <label><?php echo $this->lang->line('design_id') ?></label>
                                            <input type="tetx" name="design_id" id="design_id" class="form-control">
                                        </div>
                                        <div class="row" id="label_row">
                                            <div id="drag_label1"  class="btn btn-default"><?php  echo $this->lang->line('label');?></div>
                                        </div>
                                       
                                        <div class="row" id="input_row">
                                            <img id="barcode"  class="btn btn-default" src="<?php echo base_url() ?>barcode.jpg">
                                        </div>
                                        <div class="row" id="input_row">
                                            <div id="price_label"><p id="p_price_label"  class="btn btn-default" style="font-size: 25px">$0.00</p></div> 
                                        </div>
                                        <div class="row" id="input_row">
                                            <div  id="product"  ><p id="p_product" class="btn btn-default" >Product Name & Unit</p></div>
                                        </div>
                                        <div class="row" id="input_row">
                                            <div  id="company"> <p id="p_company" class="btn btn-default" >Store Name</p></div>
                                        </div>
                                       
                                        
                                    </div>
                                    
                                   <div class="col col-lg-1" style="width: 46px;padding-right: 0px !important;margin-left: 20px" >
                                      
                                        <div class="row " style="padding-right: 0px !important;padding-top: 40px !important"> 
                                            <a href="javascript:box_up()" class="btn btn-default"><i class="icon icon-minus"></i> </a>
                                        </div>
                                        <div class="row " style="padding-right: 0px !important">
                                            <a href="javascript:box_down()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                        </div>
                                    </div>
                                    <div class="col col-lg-5" >
                                        <div class="row ">
                                            <a href="javascript:box_left()" class="btn btn-default"><i class="icon icon-minus"></i> </a>
                                            <a href="javascript:box_right()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                        </div>
                                        <div class="row">
                                            <div id="box"  style="border: solid #D3D3D3 3px;width: 300px;height: 150px">
                                                <p></p>
                                            </div>
                                        </div>
                                       
                                             <div class="row">
                                            <div class="col col-lg-3">
                                                <div style="margin-top: 20px">
                                                    <a href="javascript:move_left()" class="btn btn-default"><i class="icon icon-arrow-left"></i> </a>
                                                </div>
                                            </div>
                                            <div class="col col-lg-3">
                                                
                                              <a href="javascript:move_up()" class="btn btn-default"><i class="icon icon-arrow-up"></i> </a> 
                                               <div style="margin-top: 20px">
                                                    <a href="javascript:move_down()" class="btn btn-default"><i class="icon icon-arrow-down"></i> </a>
                                               </div>
                                            </div>
                                            <div class="col col-lg-3">
                                                <div style="margin-top: 20px">
                                                    <a href="javascript:move_right()" class="btn btn-default"><i class="icon icon-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                             </div><br>
                                        <div class="row">
                                            <div class="col col-lg-3">
                                                <a href="javascript:save_design()" class="btn btn-default"><i class="icon icon-save"></i> <?php echo $this->lang->line('save') ?></a>
                                            </div>
                                            <div class="col col-lg-3">
                                                 <a href="javascript:clear()" class="btn btn-default"><i class="icon icon-refresh"></i> <?php echo $this->lang->line('clear') ?></a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="box_width" id="box_width" value="300">
                                        <input type="hidden" name="box_height" id="box_height" value="150">
                                    </div>
                                  <div class="col col-lg-3" >
                                        
                                       
                                        <div class="row">
                                            <div class="col col-lg-2"></div>
                                            <div class="col col-lg-6">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('rotate') ?></label>

                                                            <a href="javascript:anty_clock()" class="btn btn-default" ><i class="icon icon-minus"></i> </a>
                                                            <a href="javascript:clock()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-5">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('input_width') ?></label>

                                                            <a href="javascript:width_min()" class="btn btn-default" ><i class="icon icon-minus"></i> </a>
                                                            <a href="javascript:width_max()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="col col-lg-5">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('input_height') ?></label>

                                                            <a href="javascript:height_min()" class="btn btn-default" ><i class="icon icon-minus"></i> </a>
                                                            <a href="javascript:height_max()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-lg-10">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('text') ?></label>
                                                    <textarea  id="label_text" name="label_text" disabled="disabled" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-lg-5">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('font_size') ?></label>

                                                            <a href="javascript:font_size_min()" class="btn btn-default" ><i class="icon icon-minus"></i> </a>
                                                            <a href="javascript:font_size_max()" class="btn btn-default"><i class="icon icon-plus"></i> </a>
                                                </div>
                                            </div>
                                            <div class="col col-lg-7">
                                                <div class="form_sep">
                                                    <label><?php echo $this->lang->line('font_style') ?></label>

                                                            <a href="javascript:font_bold()"id="bold_button" class="btn btn-default" ><i class="icon icon-bold"></i> </a>
                                                            <a href="javascript:font_italic()" id="italic_button" class="btn btn-default"><i class="icon icon-italic"></i> </a>
                                                            <a href="javascript:font_underline()" id="underline_button" class="btn btn-default"><i class="icon icon-underline"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-10">
                                                   <label><?php echo $this->lang->line('color') ?></label>
<!--                                                <input type="text" class="form-control" value="#8fff00" id="cp1" >-->
                                                 <div class="input-group color" data-color="rgb(4,5,5)" data-color-format="rgb" id="cp3">
                                                     <input type="text"  id="font_colorbox"  class="form-control" value="rgb(4,5,5)" readonly >
                                                    <span class="input-group-addon" ><i style="margin-top:2px;background-color:rgb(4,5,5)"></i></span>
                                                </div>     
                                                </div>     
                                        </div>
                                         <div class="row">
                                            <div class="col col-lg-10">
                                                <div class="form_sep">
                                                  

                                            <a href="javascript:set()" class="btn btn-default"><i class="icon icon-save"></i> <?php echo $this->lang->line('set') ?> </a>
                                                                                                <a href="javascript:reset()" class="btn btn-default"><i class="icon icon-refresh"></i> <?php echo $this->lang->line('reset') ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                              <br><br>
                            </div>
                   
                        </div>
                        
                    </div>
                    <div class="row">



                    </div>
                </div>
          </div>
    <?php echo form_close();?>
</section>    
    
           <div id="footer_space">
              
           </div>
		</div>
	
                <script type="text/javascript">                
                    $(document).ready(function() {
                    $('#add_item').validate();});
                </script>
        

      