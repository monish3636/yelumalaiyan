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
  table td + td + td + td + td + td + td + td + td {
 width: 120px !important;
}
</style>	
<script type="text/javascript">
    function processJson(data){
        $('#mapping_section').show('slow');
        $('#import_section').hide();
        $('#import_fields').remove();
        $('#parent_field').append('<div class="col col-lg-6" id="import_fields"></div>');
        for(var i=0;i<data.length;i++){
          $('#import_fields').append("<div class='row field_class' style='padding-bottom: 12px !important'><div class='col col-lg-1'><label>"+data[i][0]+"</label></div><div class='col col-lg-6'><label>"+data[i][1]+"</label></div></div>")
        }
    }
    $(document).ready( function () {
        var options = { 
            complete: function(response) { 
                var res=response['responseText'];
                if(response['responseText']=='Noop'){
                     $.bootstrapGrowl('<?php echo $this->lang->line('You_Have_NO_Permission_To_Import')." ".$this->lang->line('items');?>', { type: "error" });                           
                }else if(res[0]!='['){
                        $.bootstrapGrowl(response['responseText'], { type: "error" });                   
                }
                

            },
            dataType:  'json',
            success:   processJson ,
            error: function()
            {
                    $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

            }

        }; 
        $("#import_form").ajaxForm(options);
        $('#add_customer_details_form #customer_category').change(function() {
            var guid = $('#add_customer_details_form #customer_category').select2('data').id;                  
            $('#add_customer_details_form #category').val(guid);
        });
        $('#add_customer_details_form #customer_category').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/customers/get_category',
                data: function(term, page) {
                    return {types: ["exercise"],
                        limit: -1,
                        term: term
                    };
                },
                type:'POST',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.guid,
                            text: item.category_name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        $('#add_customer_details_form #payment_type').change(function() {
                var guid = $('#add_customer_details_form #payment_type').select2('data').id;
                $('#add_customer_details_form #payment').val(guid);
        });
        $('#add_customer_details_form #payment_type').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/customers/get_payment',
                data: function(term, page) {
                    return {types: ["exercise"],
                        limit: -1,
                        term: term
                    };
                },
                type:'POST',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.guid,
                            text: item.type
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        $('#parsley_reg #customer_category').change(function() {
            var guid = $('#parsley_reg #customer_category').select2('data').id;                
            $('#parsley_reg #category').val(guid);
        });
        $('#parsley_reg #customer_category').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/customers/get_category',
                data: function(term, page) {
                    return {types: ["exercise"],
                        limit: -1,
                        term: term
                    };
                },
                type:'POST',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.guid,
                            text: item.category_name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        $('#parsley_reg #payment_type').change(function() {
                var guid = $('#parsley_reg #payment_type').select2('data').id;
                $('#parsley_reg #payment').val(guid);
        });
        $('#parsley_reg #payment_type').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/customers/get_payment',
                data: function(term, page) {
                    return {types: ["exercise"],
                        limit: -1,
                        term: term
                    };
                },
                type:'POST',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.guid,
                            text: item.type
                        });
                    });
                    return {
                          results: results
                    };
                }
            }
        });
        
        
        
        
        
        $('#add_new_customer').click(function() { 
            <?php if($this->session->userdata['customers_per']['add']==1){ ?>
                var inputs = $('#add_customer_form').serialize();
                $.ajax ({
                    url: "<?php echo base_url('index.php/customers/add_customers')?>",
                    data: inputs,
                    type:'POST',
                    complete: function(response) {
                        if(response['responseText']=='TRUE'){
                            $.bootstrapGrowl('<?php echo $this->lang->line('customer').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                            $("#dt_table_tools").dataTable().fnDraw();
                            $("#add_customer_details").trigger('reset');
                            posnic_customers_lists();
                        }else  if(response['responseText']=='ALREADY'){
                            $.bootstrapGrowl($('#customers_name').val()+' <?php echo $this->lang->line('customer').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                        }else  if(response['responseText']=='FALSE'){
                            $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                        }else{
                            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customer');?>', { type: "error" });                           
                        }
                    }
                });
            <?php }else{ ?>
                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customer');?>', { type: "error" });                       
            <?php }?>
        });
        $('#update_customers').click(function() { 
            <?php if($this->session->userdata['customers_per']['edit']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                $.ajax ({
                    url: "<?php echo base_url('index.php/customers/update_customers')?>",
                    data: inputs,
                    type:'POST',
                    complete: function(response) {
                        if(response['responseText']=='TRUE'){
                            $.bootstrapGrowl('<?php echo $this->lang->line('customer').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                            $("#dt_table_tools").dataTable().fnDraw();
                            $("#parsley_reg").trigger('reset');
                            posnic_customers_lists();
                        }else  if(response['responseText']=='ALREADY'){
                            $.bootstrapGrowl($('#customers_name').val()+' <?php echo $this->lang->line('customer').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                        }else  if(response['responseText']=='FALSE'){
                            $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                        }else{
                            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('customer');?>', { type: "error" });                           
                        }
                    }
                });
            <?php }else{ ?>
                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('customer');?>', { type: "error" });                        
            <?php }?>
        });
     });
    function posnic_mapping_import() { 
            <?php if($this->session->userdata['customers_per']['add']==1){ ?>
                    if($('#mapping_form').valid()){
                var inputs = $('#mapping_form').serialize();
                $.ajax ({
                    url: "<?php echo base_url('index.php/customers/posnic_mapping_import')?>",
                    data: inputs,
                    type:'POST',
                    dataType: 'json',               
                    success: function(data)        
                    { 
                        $('#mapping_section').hide();
                        $('#import_message_section').show();
                        var success=data['success'];
                        var fail=data['fail'];
                        var already=data['already'];
                        var count=data['no'];
                        $('#import_message_box1').remove();
                        $('#parent_messgae').append('<div class="row" id="import_message_box1"></div>;')
                        if(count==success){
                           $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('customers').$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                        }else if(fail==count){
                                                      
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body"> <?php echo $this->lang->line('please_check_your_mapping_and_data_in_incorrect_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                        }else if(already==count){
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('customer_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');                    
                            
                        }else if(fail==0 && count!=success){
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('customers').$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('customer_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');                           
                        
                        }else if(already==0 && count!=success){
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('customers').$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('customer_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            
                        }else if(success!=0 && already!=0 && fail!=0){
                           
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('customers')." ".$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('customer_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('customer_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
    
    
                        }else{
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('customer_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('customer_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                        }
                    
                    }
                });
                }
            <?php }else{ ?>
                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customer');?>', { type: "error" });                       
            <?php }?>
        } 
    function posnic_add_new(){
        <?php if($this->session->userdata['customers_per']['add']==1){ ?>
            $("#user_list").hide();
            $('#import_section').hide();
            $('#export_section').hide();
            $('#add_customer_details_form').show('slow');
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_customers').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#export').attr("disabled", "disabled");
            $('#import').attr("disabled", "disabled");
            $('#customers_lists').removeAttr("disabled");
        <?php }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customer');?>', { type: "error" });                         
        <?php }?>
    }
    function posnic_customers_lists(){
        $('#import_section').hide();
        $('#export_section').hide();
        $('#edit_customer_form').hide();
        $('#import_message_section').hide();
        $('#mapping_section').hide();
        $('#add_customer_details_form').hide();      
        $("#user_list").show('slow');
        $('#export').removeAttr("disabled");
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#deactive').removeAttr("disabled");
        $('#posnic_add_customers').removeAttr("disabled");
        $('#customers_lists').attr("disabled",'disabled');
    }
    function clear_add_customers(){
        $("#posnic_user_2").trigger('reset');
    }
    function reload_update_user(){
        var id=$('#guid').val();
        edit_function(id);
    }
    function posnic_import(){
        $('#edit_customer_form').hide();
        $('#add_customer_details_form').hide();      
        $("#user_list").hide();
        $('#import_message_section').hide();
        $('#mapping_section').hide();
        $('#import_section').show('slow');
        $('#customers_lists').removeAttr("disabled");
        $('#posnic_add_customers').attr("disabled",'disabled');
        $('#deactive').attr("disabled",'disabled');
        $('#export').attr("disabled",'disabled');
        $('#import').attr("disabled",'disabled');
        $('#active').attr("disabled",'disabled');
        $('#delete').attr("disabled",'disabled');
    }
    function mapping_import(){
        $('#edit_customer_form').hide();
        $('#add_customer_details_form').hide();      
        $("#user_list").hide();
        $('#import_message_section').hide();
        $('#mapping_section').show();
        $('#import_section').hide();
        $('#customers_lists').attr("disabled",'disabled');
        $('#posnic_add_customers').attr("disabled",'disabled');
        $('#deactive').attr("disabled",'disabled');
        $('#active').attr("disabled",'disabled');
        $('#delete').attr("disabled",'disabled');
    }
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_customers" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_customers_lists()" class="btn btn-default" id="customers_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('customers') ?></a>
                        <a href="javascript:posnic_import()" class="btn btn-default" id="import"><i class="icon icon-upload"></i> <?php echo $this->lang->line('import') ?></a>
                        <a href="javascript:posnic_export()" class="btn btn-default" id="export"><i class="icon icon-download"></i> <?php echo $this->lang->line('export') ?></a>
                        


</div>
                </div>
            </div>
    
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('customers/customers_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('customers') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('name') ?></th>                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                          <th><?php echo $this->lang->line('phone') ?></th>
                                          <th><?php echo $this->lang->line('email') ?></th>
                                          <th><?php echo $this->lang->line('category') ?></th>
                                          <th><?php echo $this->lang->line('payment') ?></th>
                                          <th><?php echo $this->lang->line('status') ?></th>
                                          <th><?php echo $this->lang->line('action') ?></th>
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
<section id="import_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'import_form',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('customers/import/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-3">
                        
                    </div>
                    <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('import')." ".$this->lang->line('customer') ?></h4>                                                                               
                               </div>
                              <div class="row" style="padding: 20px 0px">
                                  <div class="col col-lg-1">
                                      
                                  </div>
                                  <div class="col col-lg-5">
                                        <div class="form_sep">
                                            												
                                            <a href="javascript:download_csv_template()" class="btn btn-default"><i  class="icon icon-download"></i> <?php echo $this->lang->line('download_csv_template') ?></a>
                                      </div>
                                  </div>
                                  <div class="col col-lg-5">
                                        <div class="form_sep">
                                            												
                                            <a href="javascript:download_excel_template()" class="btn btn-default"><i  class="icon icon-download"></i> <?php echo $this->lang->line('download_excel_template') ?></a>
                                      </div>
                                  </div>
                              </div>
                              <div class="row" style="padding: 10px 0px">
                                  <div class="col col-lg-2">
                                      
                                  </div>
                                  <div class="col col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <input type="hidden" value="" name="">
                                        <div class="input-group">
                                            <div class="form-control">
                                                <i class="icon-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <div class="input-group-btn">
                                                <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                                                <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="userfile">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                       
                                  </div>
                              </div>
                              <div class="row" style="padding: 10px 0px">
                                  <div class="col col-lg-4">
                                      
                                  </div>
                                  <div class="col col-lg-6">
                                        <a href="javascript:posnic_customers_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to_list') ?></a>
                                      <input type="submit" name="import" class="btn btn-default " value="<?php echo $this->lang->line('upload_file'); ?>">
                                    
                                       
                                  </div>
                              </div>
                          </div>
                         </div>                             
                    </div>
                </div>
          </div>
        </div>
    <?php echo form_close();?>
</section>
<section id="import_message_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'import_message',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('customers/import_message/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-4">
                        
                    </div>
                    <div  class="col-lg-4" style="padding:0px 25px;" id="parent_messgae">
                        <div class="row" id="import_message_box1">
                         </div>
                    </div>
                </div>
                <div class="row">
                    <div  class="col-lg-3">
                        
                    </div>
                    <div  class="col-lg-6" style="padding:0px 25px;" >
                        <div class="row">
                            <a href="javascript:posnic_customers_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('customer')." ".$this->lang->line('list') ?></a>
                            <a href="javascript:posnic_import()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('upload') ?></a>
                            <a href="javascript:mapping_import()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('mapping') ?></a>
                         </div>
                    </div>
                </div>
          </div>
        </div>
    <?php echo form_close(); ?>
</section>
    
    
<section id="mapping_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'mapping_form',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('customers/import/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-2">
                        
                    </div>
                    <div  class="col-lg-8" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('mapping')." ".$this->lang->line('import') ?></h4>                                                                               
                               </div>
                              <div class="row" style="padding: 0px 20px" >
                                  <div class="col col-lg-6 ">
                                        <h5><?php  echo $this->lang->line('customer')." ".$this->lang->line('fields') ?></h5>
                                  </div>
                                  <div class="col col-lg-6 ">
                                      <h5>  <?php  echo $this->lang->line('excel_csv_fields') ?></h5>
                                  </div>
                              </div>
                                <div class="row" style="padding: 20px 0px" id="parent_field">
                                    <div class="col col-lg-6 data_class" id="data_fields" >
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('first_name') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text" class="form-control required" maxlength="1" id="first_name" name="first_name">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('last_name') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="last_name" name="last_name">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('address1') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="address1" name="address1">
                                            </div>
                                        </div>
                                     
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('birthday') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="birthday" name="birthday">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('Marragedate') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="Marragedate" name="Marragedate">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('city') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="city" name="city">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('state') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="state" name="state">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('zip') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="zip" name="zip">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('country') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="country" name="country">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('company') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="company" name="company">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('website') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="website" name="website">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('email') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('phone') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="phone" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                  <div class="col col-lg-6" id="import_fields">
                                      
                                  </div>
                                  
                              </div>
                           
                              <div class="row" style="padding: 10px 0px">
                                  <div class="col col-lg-4">
                                      
                                  </div>
                                  <div class="col col-lg-6">
                                      <a href="javascript:posnic_mapping_import()" class="btn btn-default"><i class="icon icon-upload"></i> <?php echo $this->lang->line('import') ?></a>
                                      <a href="javascript:posnic_import()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')."".$this->lang->line('upload') ?></a>
                                       
                                  </div>
                              </div>
                          </div>
                         </div>                             
                    </div>
                </div>
          </div>
        </div>
    <?php echo form_close();?>
</section>
<section id="add_customer_details_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'add_customer_form',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('customers/add_pos_customers_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('personal_details') ?></h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 40px;">
                                       <div class="row">     <div class="step_info">
                                              <label for="title_of_customer" class="req"><?php echo $this->lang->line('title_of_customer') ?></label>													
                                              <select name='title' class="form-control">
                                                  <option value="1"><?php echo $this->lang->line('mr') ?></option>
                                                  <option value="2"><?php echo $this->lang->line('mis') ?></option>
                                                  <option value="3"><?php echo $this->lang->line('mrs') ?></option>
                                                  <option value="4"><?php echo $this->lang->line('ms') ?></option>
                                                  <option value="5"><?php echo $this->lang->line('dr') ?></option>
                                              </select>
                                                   
                                            </div> 
                                           <div class="row" style="padding-top: 5px">
                                                <div class="col col-sm-12">
                                                   <div class="form_sep">
                                                        <label for="customer_category" class="req"><?php echo $this->lang->line('customer_category') ?></label>													
                                                                  <?php $customer_category=array('name'=>'customer_category',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'customer_category',
                                                                                    'value'=>set_value('customer_category'));
                                                                     echo form_input($customer_category)?>
                                                  </div>
                                                    <input  type="hidden" name="category" id='category'>
                                                   </div>
                                           </div>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="first_name" class="req"><?php echo $this->lang->line('first_name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'last_name',
                                                                                        'value'=>set_value('last_name'));
                                                                         echo form_input($last_name)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                                 <label for="dob" ><?php echo $this->lang->line('date_of') ?></label>
                                                                <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $dob=array('name'=>'dob',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'dob',
                                                                                            'value'=>set_value('dob'));
                                                                             echo form_input($dob)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="marragedate" ><?php echo $this->lang->line('marragedate') ?></label>													
                                                                               <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $marragedate=array('name'=>'marragedate',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'marragedate',
                                                                                            'value'=>set_value('marragedate'));
                                                                             echo form_input($marragedate)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                                </div>  
                                                     </div>
                                               </div>
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                      <h4 class="panel-title"><?php echo $this->lang->line('contact_details') ?></h4>                                                                                  
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                              <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                    <?php 
                                                    $address = array(
                                                                    'name'        => 'address',
                                                                    'id'          => 'address',
                                                                    'value'       =>  set_value('address'),
                                                                    'rows'        => '7',
                                                                    'cols'        => '10',
                                                                    'class'       =>'form-control required'

                                                                  ); echo form_textarea($address);
                                                    ?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                  <?php $city=array('name'=>'city',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'city',
                                                                                    'value'=>set_value('city'));
                                                                     echo form_input($city)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                     <?php $state=array('name'=>'state',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'state',
                                                                                        'value'=>set_value('state'));
                                                                         echo form_input($state)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>

                                                                       <?php $zip=array('name'=>'zip',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'zip',
                                                                                        'value'=>set_value('zip'));
                                                                         echo form_input($zip)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                               <?php $country=array('name'=>'country',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'country',
                                                                                                    'value'=>set_value('country'));
                                                                                     echo form_input($country)?>
                                                                </div>  
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="email" class="req"><?php echo $this->lang->line('email') ?></label>													
                                                                         <?php $email=array('name'=>'email',
                                                                                            'class'=>'required  form-control email',
                                                                                            'id'=>'email',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="phone" class="req"><?php echo $this->lang->line('phone') ?></label>

                                                                 <?php $phone=array('name'=>'phone',
                                                                                            'class'=>'required  form-control number',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                         <?php $company=array('name'=>'company',
                                                                                            'class'=>'  form-control ',
                                                                                            'id'=>'company',
                                                                                            'value'=>set_value('company'));
                                                                             echo form_input($company)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="website" ><?php echo $this->lang->line('website') ?></label>

                                                                 <?php $website=array('name'=>'website',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'website',
                                                                                            'value'=>set_value('website'));
                                                                             echo form_input($website)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                     </div>
                     <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('payment_details') ?></h4>                                                                                 
                               </div>
                              <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-4">
                                                   <div class="form_sep">
                                                        <label for="payment_type" ><?php echo $this->lang->line('customers_payment_type') ?></label>													
                                                                  <?php $payment_type=array('name'=>'payment_type',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'payment_type',
                                                                                    'value'=>set_value('payment_type'));
                                                                     echo form_input($payment_type)?>
                                                        <input type="hidden" name="payment" id='payment'>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-4">
                                                   <div class="form_sep">
                                                        <label for="credit_days" ><?php echo $this->lang->line('credit_days') ?></label>													
                                                                  <?php $credit_days=array('name'=>'credit_days',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'credit_days',
                                                                                    'value'=>set_value('credit_days'));
                                                                     echo form_input($credit_days)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-4">
                                                    <div class="form_sep">
                                                            <label for="credit_limit" ><?php echo $this->lang->line('credit_limit') ?></label>													
                                                                     <?php $credit_limit=array('name'=>'credit_limit',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'credit_limit',
                                                                                        'value'=>set_value('credit_limit'));
                                                                         echo form_input($credit_limit)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-4">
                                                      <div class="form_sep">
                                                            <label for="balance" ><?php echo $this->lang->line('monthly_credit_balance') ?></label>

                                                                       <?php $balance=array('name'=>'balance',
                                                                                        'class'=>' form-control',
                                                                                        'id'=>'balance',
                                                                                        'value'=>set_value('balance'));
                                                                         echo form_input($balance)?>
                                                    </div>
                                                   </div>
                                                  
                                               </div>
                                           
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('bank_details') ?></h4>                                                                                 
                               </div>
                             <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           
                                           <div class="row">
                                                 
                                                  <div class="col col-sm-4">
                                                      <div class="form_sep">
                                                            <label for="bank_name" ><?php echo $this->lang->line('bank_name') ?></label>

                                                                       <?php $bank_name=array('name'=>'bank_name',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'bank_name',
                                                                                        'value'=>set_value('bank_name'));
                                                                         echo form_input($bank_name)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                        <label for="bank_location" ><?php echo $this->lang->line('bank_location') ?></label>													
                                                                               <?php $bank_location=array('name'=>'bank_location',
                                                                                                    'class'=>' form-control',
                                                                                                    'id'=>'bank_location',
                                                                                                    'value'=>set_value('bank_location'));
                                                                                     echo form_input($bank_location)?>
                                                                </div>  
                                                     </div>
                                               <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="account_no" ><?php echo $this->lang->line('account_no') ?></label>													
                                                                         <?php $account_no=array('name'=>'account_no',
                                                                                            'class'=>'form-control',
                                                                                            'id'=>'account_no',
                                                                                            'value'=>set_value('account_no'));
                                                                             echo form_input($account_no)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('tax_details') ?></h4>                                                                                 
                               </div>
                             <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           
                                           
                                           <div class="row">
                                                  
                                                  <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="cst" ><?php echo $this->lang->line('cst') ?></label>													
                                                                         <?php $cst=array('name'=>'cst',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'cst',
                                                                                            'value'=>set_value('cst'));
                                                                             echo form_input($cst)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                            
                                                                <label for="gst" ><?php echo $this->lang->line('gst') ?></label>

                                                                 <?php $gst=array('name'=>'gst',
                                                                                            'class'=>' form-control ',
                                                                                            'id'=>'gst',
                                                                                            'value'=>set_value('gst'));
                                                                             echo form_input($gst)?>
                                                        </div> 
                                                   </div>
                                               <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="tax_no" ><?php echo $this->lang->line('tax_no') ?></label>													
                                                                         <?php $tax_no=array('name'=>'tax_no',
                                                                                            'class'=>'form-control',
                                                                                            'id'=>'tax_no',
                                                                                            'value'=>set_value('tax_no'));
                                                                             echo form_input($tax_no)?>
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                         
                         
                         <div  class="row">
                             <div class="col col-lg-2">
                                 
                             </div>
                                  <div class="col col-lg-8 text-center"><br><br>
                                      <a href="javascript:posnic_customers_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('list') ?></a>
                                      <button id="add_new_customer"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_users()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                         
                     </div>
                
                  
                </div>
                </div>
                </div>
                
    <?php echo form_close();?>
</section> 

<section id="edit_customer_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('customers/upadate_pos_customers_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('personal_details') ?></h4>                                                                               
                               </div>
                              <div class="row">
                                  <div class="col-sm-4" style="padding-left: 40px;">
                                       <div class="row">     <div class="step_info">
                                              <label for="title_of_customer" class="req"><?php echo $this->lang->line('title_of_customer') ?></label>													
                                              <select name='title' class="form-control">
                                                  <option value="1"><?php echo $this->lang->line('mr') ?></option>
                                                  <option value="2"><?php echo $this->lang->line('mis') ?></option>
                                                  <option value="3"><?php echo $this->lang->line('mrs') ?></option>
                                                  <option value="4"><?php echo $this->lang->line('ms') ?></option>
                                                  <option value="5"><?php echo $this->lang->line('dr') ?></option>
                                              </select>
                                                   
                                            </div> 
                                           <div class="row" style="padding-top: 5px">
                                                <div class="col col-sm-12">
                                                   <div class="form_sep">
                                                        <label for="customer_category" class="req"><?php echo $this->lang->line('customer_category') ?></label>													
                                                                  <?php $customer_category=array('name'=>'customer_category',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'customer_category',
                                                                                    'value'=>set_value('customer_category'));
                                                                     echo form_input($customer_category)?>
                                                  </div>
                                                    <input  type="hidden" name="category" id='category'>
                                                    <input  type="hidden" name="guid" id='guid'>
                                                   </div>
                                           </div>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="first_name" class="req"><?php echo $this->lang->line('first_name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'last_name',
                                                                                        'value'=>set_value('last_name'));
                                                                         echo form_input($last_name)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                                 <label for="dob" ><?php echo $this->lang->line('date_of') ?></label>
                                                                <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $dob=array('name'=>'dob',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'dob',
                                                                                            'value'=>set_value('dob'));
                                                                             echo form_input($dob)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="marragedate" ><?php echo $this->lang->line('marragedate') ?></label>													
                                                                               <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $marragedate=array('name'=>'marragedate',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'marragedate',
                                                                                            'value'=>set_value('marragedate'));
                                                                             echo form_input($marragedate)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                                </div>  
                                                     </div>
                                               </div>
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                      <h4 class="panel-title"><?php echo $this->lang->line('contact_details') ?></h4>                                                                                  
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                              <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                    <?php 
                                                    $address = array(
                                                                    'name'        => 'address',
                                                                    'id'          => 'address',
                                                                    'value'       =>  set_value('address'),
                                                                    'rows'        => '7',
                                                                    'cols'        => '10',
                                                                    'class'       =>'form-control required'

                                                                  ); echo form_textarea($address);
                                                    ?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                  <?php $city=array('name'=>'city',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'city',
                                                                                    'value'=>set_value('city'));
                                                                     echo form_input($city)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                     <?php $state=array('name'=>'state',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'state',
                                                                                        'value'=>set_value('state'));
                                                                         echo form_input($state)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>

                                                                       <?php $zip=array('name'=>'zip',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'zip',
                                                                                        'value'=>set_value('zip'));
                                                                         echo form_input($zip)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                               <?php $country=array('name'=>'country',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'country',
                                                                                                    'value'=>set_value('country'));
                                                                                     echo form_input($country)?>
                                                                </div>  
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="email" class="req"><?php echo $this->lang->line('email') ?></label>													
                                                                         <?php $email=array('name'=>'email',
                                                                                            'class'=>'required  form-control email',
                                                                                            'id'=>'email',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="phone" class="req"><?php echo $this->lang->line('phone') ?></label>

                                                                 <?php $phone=array('name'=>'phone',
                                                                                            'class'=>'required  form-control number',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                         <?php $company=array('name'=>'company',
                                                                                            'class'=>'  form-control ',
                                                                                            'id'=>'company',
                                                                                            'value'=>set_value('company'));
                                                                             echo form_input($company)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="website" ><?php echo $this->lang->line('website') ?></label>

                                                                 <?php $website=array('name'=>'website',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'website',
                                                                                            'value'=>set_value('website'));
                                                                             echo form_input($website)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                     </div>
                     <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('payment_details') ?></h4>                                                                                 
                               </div>
                              <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-4">
                                                   <div class="form_sep">
                                                        <label for="payment_type" ><?php echo $this->lang->line('customers_payment_type') ?></label>													
                                                                  <?php $payment_type=array('name'=>'payment_type',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'payment_type',
                                                                                    'value'=>set_value('payment_type'));
                                                                     echo form_input($payment_type)?>
                                                        <input type="hidden" name="payment" id='payment'>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-4">
                                                   <div class="form_sep">
                                                        <label for="credit_days" ><?php echo $this->lang->line('credit_days') ?></label>													
                                                                  <?php $credit_days=array('name'=>'credit_days',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'credit_days',
                                                                                    'value'=>set_value('credit_days'));
                                                                     echo form_input($credit_days)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-4">
                                                    <div class="form_sep">
                                                            <label for="credit_limit" ><?php echo $this->lang->line('credit_limit') ?></label>													
                                                                     <?php $credit_limit=array('name'=>'credit_limit',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'credit_limit',
                                                                                        'value'=>set_value('credit_limit'));
                                                                         echo form_input($credit_limit)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-4">
                                                      <div class="form_sep">
                                                            <label for="balance" ><?php echo $this->lang->line('monthly_credit_balance') ?></label>

                                                                       <?php $balance=array('name'=>'balance',
                                                                                        'class'=>' form-control',
                                                                                        'id'=>'balance',
                                                                                        'value'=>set_value('balance'));
                                                                         echo form_input($balance)?>
                                                    </div>
                                                   </div>
                                                  
                                               </div>
                                           
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('bank_details') ?></h4>                                                                                 
                               </div>
                             <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           
                                           <div class="row">
                                                 
                                                  <div class="col col-sm-4">
                                                      <div class="form_sep">
                                                            <label for="bank_name" ><?php echo $this->lang->line('bank_name') ?></label>

                                                                       <?php $bank_name=array('name'=>'bank_name',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'bank_name',
                                                                                        'value'=>set_value('bank_name'));
                                                                         echo form_input($bank_name)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                        <label for="bank_location" ><?php echo $this->lang->line('bank_location') ?></label>													
                                                                               <?php $bank_location=array('name'=>'bank_location',
                                                                                                    'class'=>' form-control',
                                                                                                    'id'=>'bank_location',
                                                                                                    'value'=>set_value('bank_location'));
                                                                                     echo form_input($bank_location)?>
                                                                </div>  
                                                     </div>
                                               <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="account_no" ><?php echo $this->lang->line('account_no') ?></label>													
                                                                         <?php $account_no=array('name'=>'account_no',
                                                                                            'class'=>'form-control',
                                                                                            'id'=>'account_no',
                                                                                            'value'=>set_value('account_no'));
                                                                             echo form_input($account_no)?>
                                                        </div> 
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                         <div class="row">
                             <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('tax_details') ?></h4>                                                                                 
                               </div>
                             <div class="row">
                                 
                                 
                                       <div class="col col-sm-12" style="padding-left: 25px;padding-right: 25px;">
                                           
                                           
                                           <div class="row">
                                                  
                                                  <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="cst" ><?php echo $this->lang->line('cst') ?></label>													
                                                                         <?php $cst=array('name'=>'cst',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'cst',
                                                                                            'value'=>set_value('cst'));
                                                                             echo form_input($cst)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                            
                                                                <label for="gst" ><?php echo $this->lang->line('gst') ?></label>

                                                                 <?php $gst=array('name'=>'gst',
                                                                                            'class'=>' form-control ',
                                                                                            'id'=>'gst',
                                                                                            'value'=>set_value('gst'));
                                                                             echo form_input($gst)?>
                                                        </div> 
                                                   </div>
                                               <div class="col col-sm-4">
                                                       <div class="form_sep">
                                                                <label for="tax_no" ><?php echo $this->lang->line('tax_no') ?></label>													
                                                                         <?php $tax_no=array('name'=>'tax_no',
                                                                                            'class'=>'form-control',
                                                                                            'id'=>'tax_no',
                                                                                            'value'=>set_value('tax_no'));
                                                                             echo form_input($tax_no)?>
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                         </div>
                         
                          <div class="row">
                        <div class="col-lg-2"></div>
                      <div class="col col-lg-8 text-center"><br><br>
                          <a href="javascript:posnic_customers_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('list') ?></a>
                          <button id="update_customers"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('update') ?></button>
                          <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('reload') ?></a>
                      </div>
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
    function posnic_group_active(){
        var flag=0;
        var field=document.forms.posnic;
        for (i = 0; i < field.length; i++){
            if(field[i].checked==true){
                flag=flag+1;
            }
        }
        if (flag<1) {
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('customer');?>', { type: "warning" });
        }else{
            var posnic=document.forms.posnic;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>/index.php/customers/active',
                        type: "POST",
                        data: {
                            guid:posnic[i].value
                        },
                        success: function(response)
                        {
                            if(response){
                                $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                $("#dt_table_tools").dataTable().fnDraw();
                            }
                        }
                    });
                }
            }
        }    
    }
    function posnic_delete(){
        var flag=0;
        var field=document.forms.posnic;
        for (i = 0; i < field.length; i++){
            if(field[i].checked==true){
                flag=flag+1;
            }
        }
        if (flag<1) {
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('customer');?>', { type: "warning" });
        }else{
            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
            if(result){
                var posnic=document.forms.posnic;
                    for (i = 0; i < posnic.length; i++){
                        if(posnic[i].checked==true){                             
                            $.ajax({
                                url: '<?php echo base_url() ?>/index.php/customers/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value
                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('deleted');?>', { type: "success" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                        }
                    }    
                }
            });
        }    
    }
                    
    function posnic_group_deactive(){
        var flag=0;
        var field=document.forms.posnic;
        for (i = 0; i < field.length; i++){
            if(field[i].checked==true){
                flag=flag+1;
            }
        }
        if (flag<1) {
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('customer');?>', { type: "warning" });
        }else{
            var posnic=document.forms.posnic;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>/index.php/customers/deactive',
                        type: "POST",
                        data: {
                            guid: posnic[i].value

                        },
                        success: function(response)
                        {
                            if(response){
                                 $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                $("#dt_table_tools").dataTable().fnDraw();
                            }
                        }
                    });
                }
            }
        }    
    }
</script>
        

      