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
</script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<style>
#drag_label { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0;z-index: 99999999 !important; }
#drag_input_box { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#first6 { width: 100px;  padding: 0.5em; float: left; margin: 10px 10px 10px 0; z-index: 99999999 !important;}
#box { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }
.inputs{
    z-index: 99999999 !important;
}
</style>
<script>
$(function() {
    $("#drag_label" ).draggable();
  
    $("#drag_input_box" ).draggable();
    $("#drag_label1" ).draggable();
    $("#first6" ).draggable();
    $("#box" ).droppable({
        drop: function( event, ui ) {
             var count=parseFloat($('#input_count').val());
                $('#drag_input_box1').remove();
                $('#drag_input_box2').remove();
                console.log(parseFloat(count-1));
              $('#drag_input_box'+parseFloat(count-1)).remove();
             $('#input_fileds').append('<label id="drag_label'+count+'" class="btn btn-default inputs"><?php  echo $this->lang->line('label');?></label><label id="drag_input_box'+count+'" class="btn btn-default" ><?php  echo $this->lang->line('input_box');?></label>');
            //    $('#input_fileds').append('<div id="draggable9" class="draggable ui-widget-content"><p>Default (snap: true), snaps to all other draggable elements</p></div>');
                $( "#drag_label"+count ).draggable();
            
$('#input_count').val(parseFloat(count+1));
        }
    });
});
</script>


<input type="hidden" id="input_count" value="2">

 
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
                                    <div class="col col-lg-2" id="input_fileds">
                                       <a id="drag_label">  <label id="drag_label1" class="btn btn-default"><?php  echo $this->lang->line('label');?></label></a><a id="drag_input_box"><label id="drag_input_box1" class="btn btn-default" ><?php  echo $this->lang->line('input_box');?></label></a>
                                    </div>
                                    <div class="col col-lg-3" >
                                        <div class="row">
                                           
<!--                                                <input type="text" class="form-control" value="#8fff00" id="cp1" >-->
                                                 <div class="input-group color" data-color="rgb(0,194,255,0.78)" data-color-format="rgba" id="cp3">
                                                    <input type="text" class="form-control" value="rgb(0,194,255,0.78)" readonly>
                                                    <span class="input-group-addon"><i style="margin-top:2px;background-color:rgb(0,194,255,0.78)"></i></span>
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
                                                    <a href="javascript:move_left()" class="btn btn-default"><i class="icon icon-arrow-right"></i> </a>
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
        

      