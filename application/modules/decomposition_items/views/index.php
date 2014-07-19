<style type="text/css">
    .my_select{
         -moz-bdecomposition_items-bottom-colors: none;
    -moz-bdecomposition_items-left-colors: none;
    -moz-bdecomposition_items-right-colors: none;
    -moz-bdecomposition_items-top-colors: none;
    background-color: #FFFFFF;
    bdecomposition_items-color: #C0C0C0 #D9D9D9 #D9D9D9;
    bdecomposition_items-image: none;
    bdecomposition_items-radius: 1px;
    bdecomposition_items: 1px solid rgba(0, 0, 0, 0.2);
    bdecomposition_items-style: solid;
    bdecomposition_items-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
  
   .items_select{
        width: 200px !important;
    }
   .item_select{
        width: 600px !important;
    }
    table tr td {
/*        width: 120px !important;*/
    }
    .form-control{
         height: 24px;
   
    padding: 0 8px;
    }
    .input-group-addon{
         height: 24px;
   
    padding: 0 8px;
    }
    .select2-container .select2-choice{
        height: 24px;
      line-height: 1.7;
    }
    #dt_table_tools tr td + td + td + td + td + td + td + td + td {
  width: 120px !important;
}
.editable-address {
    display: block;
    margin-bottom: 5px;  
}

.editable-address span {
    width: 70px;  
    display: inline-block;
}
.editable-buttons {
    text-align: center;
}
.popover-title {
    
    text-align: center;
}
.popover-content {
    padding: 6px 24px !important;
    width: 277px!important;
}
.small_inputs input{
    font-size: 11px;
    padding: 0 1px !important;
}
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
            if (unicode<48||unicode>57)
                return false
        }
    }   
    function update_decomposition_items(){
        <?php if($this->session->userdata['decomposition_items_per']['edit']==1){ ?>
            if($('#parsley_reg').valid()){
                var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/decomposition_items/update')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('decomposition_items').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_decomposition_items_lists();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #decomposition_items_number').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('decomposition_items');?>', { type: "error" });                           
                            }
                       }
                    });
               
            }else{
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
            }
        <?php }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                       
        <?php }?>
    }
    
   
        

    function posnic_decomposition_items_lists(){
        $('#add_new_decomposition_items').hide('hide');      
        $("#user_list").show('slow');
        $('#posnic_add_decomposition_items').removeAttr("disabled");
        $('#decomposition_items_lists').attr("disabled",'disabled');
    }
    function clear_add_decomposition_items(){
        $("#parsley_reg").trigger('reset');
        
    }
    function clear_update_decomposition_items(){
        $("#parsley_reg").trigger('reset');
        
        edit_function($('#guid').val());
    }
   
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:print_price_tag()" id="posnic_add_decomposition_items" class="btn btn-default" ><i class="icon icon-barcode"></i> <?php echo $this->lang->line('print_price_tag') ?></a>                       
                        <a href="javascript:posnic_decomposition_items_lists()" class="btn btn-default" id="decomposition_items_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('decomposition_items') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('decomposition_items/decomposition_items_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('decomposition_items') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                            <th>Id</th>
                                            <th ><?php echo $this->lang->line('select') ?></th>
                                            <th ><?php echo $this->lang->line('decomposition_item_code') ?></th>
                                            <th><?php echo $this->lang->line('item')." ".$this->lang->line('name') ?></th>
                                            
                                            <th><?php echo $this->lang->line('weight') ?></th>                                      
                                            <th><?php echo $this->lang->line('price') ?></th>
                                            <th><?php echo $this->lang->line('tax') ?></th>
                                            
                                            <th style="width: 120px"><?php echo $this->lang->line('action') ?></th>
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


  
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>


  
<section id="add_new_decomposition_items" class="container clearfix main_section" style="display: none">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('decomposition_items/upadate_pos_decomposition_items_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="guid" id="guid" >
        <div class="row col col-lg-4"></div>
                         <div class="row col col-lg-4">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('decomposition_items')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                        <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="item" class="req"><?php echo $this->lang->line('item') ?></label>                                                                                                       
                                                           <?php $item=array('name'=>'item',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'item',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('item'));
                                                           echo form_input($item)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="code" ><?php echo $this->lang->line('code') ?></label>                                                                                                       
                                                           <?php $code=array('name'=>'code',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'code',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('code'));
                                                           echo form_input($code)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="weight" ><?php echo $this->lang->line('weight') ?></label>                                                                                                       
                                                           <?php $weight=array('name'=>'weight',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'weight',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('weight'));
                                                           echo form_input($weight)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div> 
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="price" ><?php echo $this->lang->line('price') ?></label>                                                                                                       
                                                           <?php $price=array('name'=>'price',
                                                                        'class'=>'form-control',
                                                                        'id'=>'price',
                                                                        'value'=>set_value('price'));
                                                           echo form_input($price)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div> 
                                            <br>
                              </div>                              
                             
                          </div>
                             <div class="row" style="margin-left: 5px">
                                          <div class="col col-sm-6"  >
                                              
                                              <div class="form_sep "  style=" margin-top: 0 !important;">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_decomposition_items()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-6"  >
                                                   
                                              <div class="form_sep "  style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_decomposition_items()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                               </div>
                                         
                                               
                                              
                                      </div>
                          </div>
                         
                         
         
                                        </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
<script type="text/javascript">                      
    function print_price_tag(){
        <?php if($this->session->userdata['decomposition_items_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('decomposition_items');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                           var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/decomposition_items/decomposition_items_approve',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                     complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                               $.bootstrapGrowl($('#decomposition_items__number_'+guid).val()+ ' <?php echo $this->lang->line('decomposition_items') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }else if(response['responseText']=='Approved'){
                                             $.bootstrapGrowl($('#decomposition_items__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                        }else{
                                              $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('decomposition_items');?>', { type: "error" });                        
                                        }
                                        }
                                });

                          }

                      }
                  

                      }   
                        <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition_items');?>', { type: "error" });                       
                            <?php }
                         ?>
        }
                   
</script>
        

      