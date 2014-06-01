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
        $(document).ready( function () {
         

         $('#set_new_code').click(function() { 
                <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                var inputs = $('#add_item').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/items_setting/set_items_setting')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items_setting').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('items_setting').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Set')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                                    }
                       }
                });<?php }else{ ?>
                  $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                    <?php }?>
        });
         $('#update_items').click(function() { 
                <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                       $.ajax ({
                            url: "<?php echo base_url('index.php/items_setting/set_items_setting')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items_setting').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('items_setting').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Set')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                                    }
                       }
                 });
                 <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                    <?php }?>
        });
     });
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
                        <a href="javascript:posnic_items_lists()" class="btn btn-default" id="items_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('items') ?></a>
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
      $('#box').css("display", "block");
      $('#label_text').val($('#'+id+" label").text());
       $('#label_text').removeAttr('disabled');
      $('#field_id').val(id);
    }
    function set(){
        if($('#field_id').val()!=""){
            var size=$('#label_text').css("font-size");
            $('#'+$('#field_id').val()+" label").text($('#label_text').val());
            $('#work').append('<span id="span_'+$('#field_id').val()+'">'+$('#label_text').val()+'<span>');
            $('#span_'+$('#field_id').val()).css("font-size",parseInt(size));
            var width=$('#span_'+$('#field_id').val()).width();
            $('#'+$('#field_id').val()).width(width+3);
            $('#span_'+$('#field_id').val()).remove();
            $('#edit_actions_'+$('#field_id').val()).css('margin-left',width+3);
            $('#delete_actions_'+$('#field_id').val()).css('margin-left',width+3);
            $('#font_colorbox')
            $('#'+$('#field_id').val()+" label").css("font-size",parseInt(size));
            $('#'+$('#field_id').val()+" label").css("color",$('#font_colorbox').val());
            
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
        var bold=$('#label_text').css("font-style");
       
        if(font=='italic'){
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
</script>
 

<style>
#drag_label1 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0;z-index: 99999999 !important; }
#drag_input_box1 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#first6 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
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
     margin-left: 40px;
    margin-top: -8px;
    position: absolute;
}
.edit_action{
     margin-left: 40px;
    margin-top: -22px;
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
     // $('#field_actions_'+field).toggle(field.type === 'mouseenter');
   
});
$("#box").hover( function(){
    // $('.field_none').hide();
});
 $("#box").on("hover", function(){
  
   
     // $('#field_actions_'+field).toggle(field.type === 'mouseenter');
   
})
  
    $("#drag_input_box1" ).draggable();
    $("#drag_label1" ).draggable({
      
    });
    $("#first6" ).draggable();
    $("#box" ).droppable({
        drop: function( event, ui ) {
             var input_count=parseFloat($('#input_count').val());
             var label_count=parseFloat($('#label_count').val());
          
              var draged=ui.draggable.attr("id");
           
              if(draged=='drag_label'+parseFloat(label_count-1)){
                    $('#'+draged).remove();
                    $('#label_row').append('<div id="drag_label'+label_count+'"    class="inputs btn btn-default "><?php  echo $this->lang->line('label');?></div>');
                    $('#box').append('<div id="drag_label_'+label_count+'"    class="inputs push-left "><label><?php  echo $this->lang->line('label');?></label><a id="delete_actions_drag_label_'+label_count+'" class="field_none delete_action" href=javascript:remove_field("drag_label_'+label_count+'")><i class="icon icon-trash default"></i></a><a  id="edit_actions_drag_label_'+label_count+'" class="field_none edit_action" href=javascript:edit_field("drag_label_'+label_count+'")><i class="icon icon-edit default"></i></a></div>')
                    $( "#drag_label"+label_count ).draggable();
                    $( "#drag_label_"+label_count ).draggable();
                    $('#label_count').val(parseFloat(label_count+1));
                   //  $( "#drag_input_box"+input_count ).remove();
              }
              if(draged=='drag_input_box'+parseFloat(input_count-1)){
                     $('#'+draged).remove();
                    $('#input_row').append('<div id="drag_input_box'+input_count+'"   class="inputs btn btn-default" ><?php  echo $this->lang->line('input_box');?></div>');
                    $('#box').append('<div id="drag_input_box_'+input_count+'"   class="inputs " ><input class="form-control field_input"><i class="icon icon-trash"></i><i class="icon icon-edit"></i></div>');
                    $( "#drag_input_box"+input_count ).draggable();
                    $( "#drag_input_box_"+input_count ).draggable();
                    $('#input_count').val(parseFloat(input_count+1));
              //      $( "#drag_label"+label_count ).remove();
                    
              
              }
              
            
              
              //  console.log(parseFloat(count-1));
             
           
            //    $('#input_fields').append('<div id="draggable9" class="draggable ui-widget-content"><p>Default (snap: true), snaps to all other draggable elements</p></div>');
              
            

        }
    });
});
</script>


<input type="hidden" id="input_count" value="2">
<input type="hidden" id="label_count" value="2">
<input type="hidden" id="field_id" value="2">
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
                                       <h4 class="panel-title"><?php echo $this->lang->line('items_setting') ?></h4>  
                                       <input type="hidden" name="guid" id="guid">
                                     <input type="checkbox" style="display: none" >
                               </div>
                              <br>
                              <div class="row" style="padding-left: 20px">
                                    <div class="col col-lg-2" id="input_fields">
                                        <div class="row" id="label_row">
                                            <div id="drag_label1"  class="btn btn-default"><?php  echo $this->lang->line('label');?></div>
                                        </div>
                                        <div class="row" id="input_row">
                                            <div id="drag_input_box1"  class="btn btn-default" ><?php  echo $this->lang->line('input_box');?></div>
                                        </div>
                                       
                                        
                                    </div>
                                    <div class="col col-lg-3" >
                                        
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
                                                    <a href="javascript:move_left()" class="btn btn-default"><i class="icon icon-arrow-right"></i> </a>
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
                                                 <div class="input-group color" data-color="rgb(0,194,255,0.78)" data-color-format="rgba" id="cp3">
                                                     <input type="text"  id="font_colorbox"  class="form-control" value="rgb(0,194,255,0.78)" readonly >
                                                    <span class="input-group-addon" ><i style="margin-top:2px;background-color:rgb(0,194,255,0.78)"></i></span>
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
                                   <div class="col col-lg-1" style="width: 46px;padding-right: 0px !important;margin-left: 20px" >
                                      
                                        <div class="row " style="padding-right: 0px !important;padding-top: 40px !important"> 
                                            <a href="javascript:box_up()" class="btn btn-default"><i class="icon icon-arrow-up"></i> </a>
                                        </div>
                                        <div class="row " style="padding-right: 0px !important">
                                            <a href="javascript:box_down()" class="btn btn-default"><i class="icon icon-arrow-down"></i> </a>
                                        </div>
                                    </div>
                                    <div class="col col-lg-6" >
                                        <div class="row ">
                                            <a href="javascript:box_left()" class="btn btn-default"><i class="icon icon-arrow-left"></i> </a>
                                            <a href="javascript:box_right()" class="btn btn-default"><i class="icon icon-arrow-right"></i> </a>
                                        </div>
                                        <div class="row">
                                            <div id="box"  style="border: solid #D3D3D3 3px;width: 300px;height: 150px">
                                                <p></p>
                                            </div>
                                        </div>
                                        <input type="hidden" name="box_width" id="box_width" value="300">
                                        <input type="hidden" name="box_height" id="box_height" value="150">
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
        

      