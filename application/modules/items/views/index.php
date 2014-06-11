
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
   #dt_table_tools  tr:last-child td {
  width: 100px !important;
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
    $(document).ready( function () {
        $('#parsley_reg #search_department').change(function() {
            var guid = $('#parsley_reg #search_department').select2('data').id;
            $('#parsley_reg #item_department').val(guid);
       });
        $('#parsley_reg #search_department').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('item_department') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_department',
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
                            text: item.department_name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        $('#parsley_reg #search_category').change(function() {
            var guid = $('#parsley_reg #search_category').select2('data').id;
            $('#parsley_reg #category').val(guid);
        });
        $('#parsley_reg #search_category').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_category',
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
        
        
        $('#parsley_reg #search_brand').change(function() {
            var guid = $('#parsley_reg #search_brand').select2('data').id;
            $('#parsley_reg #brand').val(guid);
        });
        $('#parsley_reg #search_brand').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('brand') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_brand',
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
                            text: item.name
                        });
                    });
                    return {
                       results: results
                    };
                }
            }
        });
        
        
        $('#parsley_reg #search_taxes_area').change(function() {
            var guid = $('#parsley_reg #search_taxes_area').select2('data').id;
            $('#parsley_reg #taxes_area').val(guid);
        });
        $('#parsley_reg #search_taxes_area').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('taxes_area') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_taxes_area',
                data: function(term, page) {
                    return {
                        types: ["exercise"],
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
                            text: item.name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
        $('#parsley_reg #search_taxes').change(function() {
            var guid = $('#parsley_reg #search_taxes').select2('data').id;
            $('#parsley_reg #taxes').val(guid);
        });
        function format_tax(sup) {
            if (!sup.id) return sup.text; 
                return  sup.text+" ( "+sup.value+" )";
        }
        $('#parsley_reg #search_taxes').select2({
            formatResult: format_tax,
            formatSelection: format_tax,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('taxes') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_taxes',
                data: function(term, page) {
                    return {
                        types: ["exercise"],
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
                            text: item.name,
                            value: item.value
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
        $('#parsley_reg #search_supplier').change(function() {
            var guid = $('#parsley_reg #search_supplier').select2('data').id;
            $('#parsley_reg #supplier').val(guid);
        });
        function format(sup) {
            if (!sup.id) return sup.text; 
                return  sup.text+" "+sup.first+" "+sup.phone+" "+sup.email;
        }
        $('#parsley_reg #search_supplier').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('supplier') ?>",
            ajax: {
                    url: '<?php echo base_url() ?>index.php/items/get_supplier',
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
                            text: item.company_name,
                            first: item.first_name,
                            phone: item.phone,
                            email: item.email
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
                       
        });
       
        
        $('#add_item #search_department').change(function() {
            var guid = $('#add_item #search_department').select2('data').id;
            $('#add_item #item_department').val(guid);
         });
        $('#add_item #search_department').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('item_department') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_department',
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
                            text: item.department_name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
        $('#add_item #search_category').change(function() {
            var guid = $('#add_item #search_category').select2('data').id;
            $('#add_item #category').val(guid);
         });
        $('#add_item #search_category').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_category',
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
        
        
        $('#add_item #search_brand').change(function() {
            var guid = $('#add_item #search_brand').select2('data').id;
            $('#add_item #brand').val(guid);
        });
        $('#add_item #search_brand').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('brand') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_brand',
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
                            text: item.name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
         $('#add_item #search_taxes_area').change(function() {
                var guid = $('#add_item #search_taxes_area').select2('data').id;
                $('#add_item #taxes_area').val(guid);
          });
        $('#add_item #search_taxes_area').select2({
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('taxes_area') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_taxes_area',
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
                            text: item.name
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
        $('#add_item #search_taxes').change(function() {
            var guid = $('#add_item #search_taxes').select2('data').id;
            $('#add_item #taxes').val(guid);
        });
        function format_tax(sup) {
            if (!sup.id) return sup.text; 
                return  sup.text+" ( "+sup.value+" )";
        }
        $('#add_item #search_taxes').select2({
            formatResult: format_tax,
            formatSelection: format_tax,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('taxes') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_taxes',
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
                            text: item.name,
                            value: item.value
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        
        
        $('#add_item #search_supplier').change(function() {
            var guid = $('#add_item #search_supplier').select2('data').id;
            $('#add_item #supplier').val(guid);
         });
        function format(sup) {
            if (!sup.id) return sup.text; 
            return  sup.text+" "+sup.first+" "+sup.phone+" "+sup.email;
        }
        $('#add_item #search_supplier').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('supplier') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/items/get_supplier',
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
                            text: item.company_name,
                            first: item.first_name,
                            phone: item.phone,
                            email: item.email
                        });
                    });
                    return {
                        results: results
                    };
                }
            }                       
        });
       
     
     });
    function posnic_add_new(){
        <?php if($this->session->userdata['items_per']['add']==1){ ?>
            $("#item_list_section").hide();
            $('#add_item_form').show('slow');
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_items').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#export').attr("disabled",'disabled');
            $('#import').attr("disabled",'disabled');
            $('#deactive').attr("disabled", "disabled");
            $('#items_lists').removeAttr("disabled");
            change_orm_to_unit();
        <?php }else{ ?>
            bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add User')?>");  
        <?php }?>
    }
    function posnic_items_lists(){
        $('#import_section').hide();
        $('#export_section').hide();
        $('#edit_item_form').hide('hide');
        $('#add_items_image').hide('hide');
        $('#add_item_form').hide('hide');      
        $("#item_list_section").show('slow');
        $('#import_message_section').hide();
        $('#mapping_section').hide(); 
        $('#export').removeAttr("disabled");
        $('#import').removeAttr("disabled");
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#deactive').removeAttr("disabled");
        $('#posnic_add_items').removeAttr("disabled");
        $('#items_lists').attr("disabled",'disabled');
        $("#dt_table_tools").dataTable().fnDraw();
    }
  function posnic_import(){
        $('#edit_item_form').hide();
        $('#add_item_form').hide();      
        $("#item_list_section").hide();
        $('#import_message_section').hide();
        $('#mapping_section').hide();
        $('#import_section').show('slow');
        $('#items_lists').removeAttr("disabled");
        $('#posnic_add_items').attr("disabled",'disabled');
        $('#deactive').attr("disabled",'disabled');
        $('#export').attr("disabled",'disabled');
        $('#import').attr("disabled",'disabled');
        $('#active').attr("disabled",'disabled');
        $('#delete').attr("disabled",'disabled');
    }
    function mapping_import(){
        $('#edit_item_form').hide('hide');
        $('#add_items_image').hide('hide');
        $('#add_item_form').hide('hide');     
        $("#item_list_section").hide();
        $('#import_message_section').hide();
        $('#mapping_section').show();
        $('#import_section').hide();
        $('#items_lists').attr("disabled",'disabled');
        $('#posnic_add_items').attr("disabled",'disabled');
        $('#deactive').attr("disabled",'disabled');
        $('#active').attr("disabled",'disabled');
        $('#delete').attr("disabled",'disabled');
    }
    function posnic_export(){
        $('#edit_item_form').hide();
        $('#add_item_form').hide();      
        $("#item_list_section").hide();
        $('#import_message_section').hide();
        $('#mapping_section').hide();
        $('#import_section').hide();
        $('#export_section').show('slow');
        $('#items_lists').attr("disabled",'disabled');
        $('#posnic_add_items').attr("disabled",'disabled');
        $('#import').attr("disabled",'disabled');
        $('#export').attr("disabled",'disabled');
        $('#deactive').attr("disabled",'disabled');
        $('#active').attr("disabled",'disabled');
        $('#delete').attr("disabled",'disabled');
    }
    function clear_add_items(){
        $("#posnic_user_2").trigger('reset');
    }
    function reload_update_user(){
        var id=$('#guid').val();
        edit_function(id);
    }
    function change_orm_to_unit(){
        $('#add_item_form #hidden_no_unit').hide();
    }
    function change_orm_to_case(){
        $('#add_item_form #hidden_no_unit').show();
    }
    function change_orm_to_unit_update(){
        $('#parsley_reg #hidden_no_unit').hide();
    }
    function change_orm_to_case_update(){
        $('#parsley_reg #hidden_no_unit').show();
    }
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_items" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_items_lists()" class="btn btn-default" id="items_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('items') ?></a>
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
                    echo form_open('items/items_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="item_list_section"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('items') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                          <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('sku') ?></th>
                                          <th ><?php echo $this->lang->line('name') ?></th>
                                          <th ><?php echo $this->lang->line('location') ?></th>
                                          <th ><?php echo $this->lang->line('brand') ?></th>
                                          <th ><?php echo $this->lang->line('category') ?> </th>
                                          <th ><?php echo $this->lang->line('item_department') ?></th>                                          
                                          <th><?php echo $this->lang->line('status') ?></th>
                                          <th ><?php echo $this->lang->line('action') ?></th>
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
<section id="import_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'import_form',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/import/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-3">
                        
                    </div>
                    <div  class="col-lg-6" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('import')." ".$this->lang->line('items') ?></h4>                                                                               
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
                                        <a href="javascript:posnic_items_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to_list') ?></a>
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
       echo form_open_multipart('items/import_message/',$form);?>
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
                            <a href="javascript:posnic_items_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('items')." ".$this->lang->line('list') ?></a>
                            <a href="javascript:posnic_import()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('upload') ?></a>
                            <a href="javascript:mapping_import()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('mapping') ?></a>
                         </div>
                    </div>
                </div>
          </div>
        </div>
    <?php echo form_close(); ?>
</section>
<section id="export_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'export_items',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/export/',$form);?>
        <div id="main_content_outer" class="clearfix">
          <div id="main_content">
                     
               <div class="row">
                    <div  class="col-lg-2">
                        
                    </div>
                    <div  class="col-lg-8" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                                 <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('export')." ".$this->lang->line('items') ?></h4>                                                                               
                               </div>
                                <div class="row" style="padding: 20px 0px">
                                  <div class="col col-lg-2">
                                      
                                  </div>
                                  <div class="col col-lg-5">
                                        <div class="form_sep">
                                            												
                                            <a href="items/export/csv" class="btn btn-default"><i  class="icon icon-download"></i> <?php echo $this->lang->line('export_to_csv') ?></a>
                                      </div>
                                  </div>
                                  <div class="col col-lg-5">
                                        <div class="form_sep">
                                            												
                                            <a href="items/export/xlsx" class="btn btn-default"><i  class="icon icon-download"></i> <?php echo $this->lang->line('export_to_xlsx') ?></a>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                    <div  class="col-lg-4">
                        
                    </div>
                    <div  class="col-lg-4" style="padding:20px 25px;" >
                        <div class="row">
                            <a href="javascript:posnic_items_lists()" class="btn btn-default"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('items')." ".$this->lang->line('list') ?></a>                           
                         </div>
                    </div>
                </div>
                    </div>
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
       echo form_open_multipart('items/import/',$form);?>
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
                                        <h5><?php  echo $this->lang->line('items')." ".$this->lang->line('fields') ?></h5>
                                  </div>
                                  <div class="col col-lg-6 ">
                                      <h5>  <?php  echo $this->lang->line('excel_csv_fields') ?></h5>
                                  </div>
                              </div>
                                <div class="row" style="padding: 20px 0px" id="parent_field">
                                    <div class="col col-lg-6 data_class" id="data_fields" >
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('sku') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text" class="form-control required" maxlength="1" id="sku" name="sku">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('barcode') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="barcode" name="barcode">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('name') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="name" name="name">
                                            </div>
                                        </div>
                                     
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('item_department') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="department" name="department">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('brand') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="brand" name="brand">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('category') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="category" name="category">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('tax_Inclusive') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="tax_Inclusive" name="tax_Inclusive">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('tax_type') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="tax_type" name="tax_type">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('tax') ?> %</label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="tax" name="tax">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('cost') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="company" name="cost">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('mrp') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="mrp" name="mrp">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('price') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="price" name="price">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('location') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="location" name="location">
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0px 10px">                                                                               
                                            <div class="col col-lg-6">
                                                <label><?php echo $this->lang->line('supplier') ?></label>
                                            </div>
                                            <div class="col col-lg-6">
                                                <input type="text"  class="form-control required" maxlength="1" id="supplier" name="supplier">
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
    $(document).ready(function()
    {
        var upload = { 
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
        $("#import_form").ajaxForm(upload);
        $('#hidden_weight').hide();
        $('#weight').val(0);
	var options = { 
	complete: function(response) { 
                  if(response['responseText']=='TRUE'){
                                     $.bootstrapGrowl('<?php echo $this->lang->line('items').' '.$this->lang->line('added');?>', { type: "success" });                                                                                    
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                  }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#add_item #name').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                  }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                  }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                           
                  }
	 
                  
	},
	error: function()
	{
		$("#message").html("<font color='red'> ERROR: unable to upload files</font>");

	}
   
}; 
	var update = { 
	complete: function(response) { 
                  if(response['responseText']=='TRUE'){
                                     $.bootstrapGrowl('<?php echo $this->lang->line('items').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                    
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_items_lists();
                  }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#add_item #name').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                  }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                  }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('items');?>', { type: "error" });                           
                  }
	 
                  
	},
	error: function()
	{
		$("#message").html("<font color='red'> ERROR: unable to upload files</font>");

	}
   
}; 

    
     $("#add_item").ajaxForm(options);
     $("#parsley_reg").ajaxForm(update);
     
     <?php if($this->session->userdata['items_per']['add']==1){ ?>
          if($('#add_item').valid()){
            $("#add_item").ajaxForm(options);
          }else{
              
            $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields')." ".$this->lang->line('add_item');?>', { type: "error" });         
          }         
       <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add Record')?>");  
       <?php }?>

});
 function posnic_mapping_import() { 
        <?php if($this->session->userdata['items_per']['add']==1){ ?>
            if($('#mapping_form').valid()){
                var inputs = $('#mapping_form').serialize();
                $.ajax ({
                    url: "<?php echo base_url('index.php/items/posnic_mapping_import')?>",
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
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('items').$this->lang->line('added') ;?></div>\n\
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
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('items_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');                    
                            
                        }else if(fail==0 && count!=success){
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('items').$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('items_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');                           
                        
                        }else if(already==0 && count!=success){
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('items').$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('items_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            
                        }else if(success!=0 && already!=0 && fail!=0){
                           
                            $('#import_message_box1').append('<div class="panel panel-success">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('success') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+success+' <?php echo $this->lang->line('new')." ".$this->lang->line('items')." ".$this->lang->line('added') ;?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('items_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('items_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
    
    
                        }else{
                            $('#import_message_box1').append('<div class="panel panel-warning">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('warning') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+already+ ' <?php echo $this->lang->line('items_details_is_alredy_added')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                            $('#import_message_box1').append('<div class="panel panel-danger">\n\
                                                        <div class="panel-heading">\n\
                                                        <h4 class="panel-title"><?php echo $this->lang->line('error') ?></h4>\n\
                                                        </div>\n\
                                                        <div class="panel-body">'+fail+ ' <?php echo $this->lang->line('items_details_not_in_correct_format')?></div>\n\
                                                        </div>\n\
                                                        </div>');
                        }
                    
                    }
                });
            }
        <?php }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You_Have_NO_Permission_To_Import')." ".$this->lang->line('items');?>', { type: "error" });                       
        <?php }?>
    } 
    function new_no_of_unit(e){    
        var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=13 && unicode!=9){
        }
        else{
            $('#add_item .fileupload .fileupload-new ').focus();           
        }
        if (unicode!=27){
        }
        else{
            $('#add_item #unit_of_mes').focus();
        }
            
    }
function new_sku(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#add_item #barcode').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            
        }
            
    }
function new_barcode(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#add_item #name').focus();
           
        }
         if (unicode!=27){
        }
       else{
                $('#add_item #sku').focus();
            
        }   
    }
function new_name(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         //  $('#add_item #search_department').focus();
           $('#add_item #search_department').select2('open');
           
        }
         if (unicode!=27){
        }
       else{
                 $('#add_item #barcode').focus();
            
        }   
    }
function new_department(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         
            $('#add_item #search_category').focus();
           $('#add_item #search_category').select2('open');
           
        }
         if (unicode!=27){
        }
       else{
               $('#add_item #name').focus();
            
        }   
    }
function new_category(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         
            $('#add_item #search_brand').focus();
           $('#add_item #search_brand').select2('open');
           
        }
         if (unicode!=27){
        }
       else{
               $('#add_item #search_department').focus();
           $('#add_item #search_department').select2('open');
            
        }   
    }
function new_brand(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         
            $('#add_item #location').focus();
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #search_category').focus();
            $('#add_item #search_category').select2('open');
            
        }   
    }
function new_location(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #search_supplier').focus();
            $('#add_item #search_supplier').select2('open');
          
           
        }
         if (unicode!=27){
        }
       else{
            
            $('#add_item #search_brand').focus();
           $('#add_item #search_brand').select2('open');
        }   
    }
function new_supplier(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #description').focus();
          
          
           
        }
         if (unicode!=27){
        }
       else{
            
            $('#add_item #location').focus();
        }   
    }
function new_tax_area(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #search_taxes').focus();
         $('#add_item #search_taxes').select2('open');
          
           
        }
         if (unicode!=27){
        }
       else{
            
            $('#add_item #tax_Inclusive').focus();
        }   
    }
function new_tax(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #cost').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #search_taxes_area').focus();
            $('#add_item #search_taxes_area').select2('open');
        }   
    }
function new_cost(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #mrp').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #search_taxes').focus();
            $('#add_item #search_taxes').select2('open');
        }   
    }
function new_mrp(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #selling_price').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #cost').focus();
        }   
    }
function new_price(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
         $('#add_item #discount_per').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #mrp').focus();
        }   
    }
function new_discount(e){    
     var unicode=e.charCode? e.charCode : e.keyCode
   
                  if (unicode!=13 && unicode!=9){
        }
       else{
        
          window.setTimeout(function ()
                    {
                     
                       document.getElementById('starting_date').focus();
                    }, 10);
           
        }
         if (unicode!=27){
        }
       else{
            $('#add_item #selling_price').focus();
        }   
    }
function item_decomposition(){

    if($('#add_item #decomposition').attr("checked")){
        $('#add_item #hidden_weight').show();
        
    }else{
        $('#add_item #hidden_weight').hide();
        $('#add_item #weight').val(0);
    }
    }
function items_decomposition(){

    if($('#parsley_reg #decomposition').attr("checked")){
        $('#parsley_reg #hidden_weight').show();
        
    }else{
        $('#parsley_reg #hidden_weight').hide();
       // $('#parsley_reg #weight').val(0);
    }
    }
</script>
<section id="add_item_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'add_item',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/add_new_item/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                 <div class="row">
                    
                     <div class="col-lg-7">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item_details') ?></h4>  
                                   
                               </div>
                              <br>
                              
                              
                              <div class="row "  style="margin-left:10px;margin-right: 10px" >
                                       <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="sku" class="req"><?php echo $this->lang->line('sku') ?></label>                                                                                                       
                                                           <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'sku',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>
                                                  
                                              
                                        </div>  
                                   <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="barcode" class="req"><?php echo $this->lang->line('barcode') ?></label>                                                                                                       
                                                           <?php $barcode=array('name'=>'barcode',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'barcode',
                                                                                    'value'=>set_value('barcode'));
                                                           echo form_input($barcode)?> 
                                                    </div>
                                                  
                                               
                                        </div>
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="name" class="req"><?php echo $this->lang->line('name') ?></label>                                                                                                       
                                                           <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'name',
                                                                                    'value'=>set_value('mrp'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                  
                                        </div>  
                                  
                                                 
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                    <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="item_department" class="req"><?php echo $this->lang->line('item_department') ?></label>                                                                                                       
                                                           <?php $item_department=array('name'=>'search_department',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_department',
                                                                                    'value'=>set_value('item_department'));
                                                           echo form_input($item_department)?> 
                                                         <input type="hidden" name="item_department" id="item_department">
                                                    </div>
                                                    </div>    
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="category" class="req"><?php echo $this->lang->line('category') ?></label>                                                                                                       
                                                           <?php $category=array('name'=>'search_category',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_category',
                                                                                    'value'=>set_value('category'));
                                                           echo form_input($category)?> 
                                                          <input type="hidden" name="category" id="category">
                                                    </div>
                                                   
                                        </div>
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="brand" class="req"><?php echo $this->lang->line('brand') ?></label>                                                                                                       
                                                           <?php $brand=array('name'=>'search_brand',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_brand',
                                                                                    'value'=>set_value('brand'));
                                                           echo form_input($brand)?> 
                                                         <input type="hidden" name='brand' id='brand'>
                                                    </div>
                                        </div> 
                                  
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="location" ><?php echo $this->lang->line('location') ?></label>                                                                                                       
                                                           <?php $location=array('name'=>'location',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'location',
                                                                                    'value'=>set_value('location'));
                                                           echo form_input($location)?> 
                                                    </div>
                                                  
                                        </div>
                                  <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="supplier" class="req"><?php echo $this->lang->line('supplier') ?></label>                                                                                                       
                                                           <?php $supplier=array('name'=>'search_supplier',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_supplier',
                                                                                    'value'=>set_value('supplier'));
                                                           echo form_input($supplier)?> 
                                                           <input type="hidden" name='supplier' id='supplier'>
                                                    </div>
                                                   
                                                   
                              </div>
                                  
                                   <div class="col col-lg-4" >
                                         
                                                    <div class="form_sep">
                                                         <label for="description" ><?php echo $this->lang->line('description') ?></label>                                                                                                       
                                                           <?php $description=array('name'=>'description',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'description',
                                                                                    'rows'=>2,
                                                                                    'value'=>set_value('description'));
                                                           echo form_textarea($description)?> 
                                                    </div>
                                               
                                        </div>                             
                              </div>
                             
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="tax_Inclusive" class="req"><?php echo $this->lang->line('tax_Inclusive') ?></label>                                                                                                       
                                                         <select name="tax_Inclusive" id="tax_Inclusive" class="form-control">
                                                             <option value="1"><?php echo $this->lang->line('yes') ?></option>
                                                             <option value="0"><?php echo $this->lang->line('no') ?></option>
                                                         </select>
                                                    </div>
                                                   
                                        </div> 
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="taxes_area" class="req"><?php echo $this->lang->line('taxes_area') ?></label>                                                                                                       
                                                           <?php $taxes_area=array('name'=>'search_taxes_area',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'search_taxes_area',
                                                                                    'value'=>set_value('taxes_area'));
                                                           echo form_input($taxes_area)?> 
                                                         <input type="hidden" name='taxes_area' id='taxes_area'>
                                                    </div>
                                                   
                                        </div>                              
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="taxes" class="req"><?php echo $this->lang->line('taxes') ?></label>                                                                                                       
                                                           <?php $taxes=array('name'=>'search_taxes',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_taxes',
                                                                                    'value'=>set_value('taxes'));
                                                           echo form_input($taxes)?> 
                                                           <input type="hidden" name='taxes' id='taxes'>
                                                    </div>
                                                  
                                        </div>
                                       
                                  
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                  <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="cost" class="req"><?php echo $this->lang->line('cost') ?></label>                                                                                                       
                                                           <?php $cost=array('name'=>'cost',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'cost',
                                                                                    'onKeyPress'=>"new_cost(event);return numbersonly(event)",
                                                                                    'value'=>set_value('cost'));
                                                           echo form_input($cost)?> 
                                                    </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="mrp" class="req"><?php echo $this->lang->line('mrp') ?></label>                                                                                                       
                                                           <?php $mrp=array('name'=>'mrp',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'mrp',
                                                                                    'onKeyPress'=>"new_mrp(event);return numbersonly(event)",
                                                                                    'value'=>set_value('mrp'));
                                                           echo form_input($mrp)?> 
                                                    </div>
                                                  
                                        </div>                              
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="selling_price" class="req"><?php echo $this->lang->line('selling_price') ?></label>                                                                                                       
                                                           <?php $selling_price=array('name'=>'selling_price',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'selling_price',
                                                                                    'onKeyPress'=>"new_price(event);return numbersonly(event)",
                                                                                    'value'=>set_value('selling_price'));
                                                           echo form_input($selling_price)?> 
                                                    </div>
                                                   
                                        </div>  
                                      
                                  
                              </div>
                              
                              
                              <div class="row">
                                                                    
                                                                
                              </div>
                          </div>
                         <div class="panel panel-default" style="margin-top: 6px">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item')." ".$this->lang->line('discount') ?></h4>  
                                   
                               </div>
                              
                              <div class="row "  style="margin-left:10px;margin-right: 10px" >
                                         <div class="col col-lg-4" >
                                                                 <div class="form_sep">
                                                                      <label for="discount_per" ><?php echo $this->lang->line('discount_per') ?></label>                                                                                                       
                                                                        <?php $discount_per=array('name'=>'discount_per',
                                                                                                 'class'=>'form-control',
                                                                                                 'onKeyPress'=>"new_discount(event);return numbersonly(event)",
                                                                                                 'id'=>'discount_per',
                                                                                                 'value'=>set_value('discount_per'));
                                                                        echo form_input($discount_per)?> 
                                                                 </div>

                                                     </div>                              
                                                    <div class="col col-lg-4" >

                                                                 <div class="form_sep">
                                                                      <label for="starting_date" ><?php echo $this->lang->line('starting_date') ?></label>                                                                                                       
                                                                       <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                                    <?php $starting_date=array('name'=>'starting_date',
                                                                                                 'class'=>' form-control',
                                                                                                 'id'=>'starting_date',
                                                                                                 'value'=>set_value('starting_date'));
                                                                        echo form_input($starting_date)?> 
                                                                           <span class="input-group-addon"></span>
                                                                             </div>
                                                                 </div>

                                                     </div>                              
                                                    <div class="col col-lg-4" >

                                                                 <div class="form_sep">
                                                                      <label for="ending_date" ><?php echo $this->lang->line('ending_date') ?></label>                                                                                                       
                                                                      <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                       <?php $ending_date=array('name'=>'ending_date',
                                                                                                 'class'=>' form-control',
                                                                                                 'id'=>'ending_date',
                                                                                                 'value'=>set_value('ending_date'));
                                                                        echo form_input($ending_date)?> 
                                                                      <span class="input-group-addon"></span>
                                                                             </div>
                                                                 </div>

                                                     </div>   
                                      
                                  
                              </div>
                              
                              
                              
                              <br>
                          </div>
                        
                     </div>
                      <div class="col-lg-5">
                              <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('uom') ?></h4> 
                               </div>
                              <br>
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                                 <div class="form_sep">
                                                                      <label for="purchase" ><?php echo $this->lang->line('purchase') ?></label>                                                                                                       
                                                                      <select class="form-control" name="unit_of_mes" id="unit_of_mes">
                                                                          <option value="0" onclick="change_orm_to_unit()"><?php echo $this->lang->line('unit_or_pics') ?></option>
                                                                          <option value="1" onclick="change_orm_to_case()"><?php echo $this->lang->line('case_or_box') ?></option>
                                                                      </select>
                                                                 </div>
                                                     </div>                              
                                                    <div class="col col-lg-6" id="hidden_no_unit">

                                                                 <div class="form_sep">
                                                                      <label for="no_of_unit" ><?php echo $this->lang->line('no_of_unit') ?></label>                                                                                                       
                                                                   
                                                                                    <?php $no_of_unit=array('name'=>'no_of_unit',
                                                                                                 'class'=>'required form-control',
                                                                                                 'id'=>'no_of_unit',
                                                                                                 'onKeyPress'=>"new_no_of_unit(event);return numbersonly(event)",
                                                                                                 'value'=>set_value('no_of_unit'));
                                                                        echo form_input($no_of_unit)?>                                                                            
                                                                 </div>
                                                     </div> 
                              </div>
                              <br>
                          </div>
                              <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('decomposition') ?></h4> 
                               </div>
                              <br>
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                                 <div class="form_sep">
                                                                      <label for="decomposition" ><?php echo $this->lang->line('yes') ?></label>                                                                                                       
                                                                      <input type="checkbox" name="decomposition" id="decomposition" value="0" class="form-control check-mark" onclick="item_decomposition()">
                                                                 </div>
                                                     </div>                              
                                                    <div class="col col-lg-6" id="hidden_weight">

                                                                 <div class="form_sep">
                                                                      <label for="weight" ><?php echo $this->lang->line('weight') ?></label>                                                                                                       
                                                                   
                                                                                    <?php $weight=array('name'=>'weight',
                                                                                                 'class'=>'required form-control',
                                                                                                 'id'=>'weight',
                                                                                                 'onKeyPress'=>"weight(event);return numbersonly(event)",
                                                                                                 'value'=>set_value('weight'));
                                                                        echo form_input($weight)?>                                                                            
                                                                 </div>
                                                     </div> 
                              </div>
                              <br>
                          </div>
                              <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item')." ".$this->lang->line('image') ?></h4>  
                                   
                               </div>
                              <br>
                              
                              
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                            <div class="step_info" style="margin: auto">
                                                <label for="firstname" ><?php echo $this->lang->line('image') ?></label>                     
                                                <div class="fileupload fileupload-new " data-provides="fileupload">
                                                     <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;"><img src="img/no_img_180.png" alt=""></div>
                                                       <div  class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                       <div>
                                                            <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                            <input type="file" name="userfile" /></span>
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                       </div>
                                                 </div>
                                            </div>

                                                     </div>                              
                                                   
                                      
                                  
                              </div>
                              
                              
                              
                              
                              <br>
                          </div>
                          <div class="row">
                                <div class="col-lg-1"></div>
                                  <div class="col col-lg-10 text-center"><br><br>
                                      <button id=""  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_items()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                          </div>
<!--                          <div class="row">
                                <div class="panel panel-default">
                                     <div class="panel-heading">
                                           <h4 class="panel-title"><?php echo $this->lang->line('item_details') ?></h4>  

                                     </div>
                                </div>
                          </div>-->
                      </div>
                </div>
                    
                </div>
    <?php echo form_close();?>
</section>    
<section id="edit_item_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/update_items/',$form);?>
    <div id="main_content">
                 <div class="row">
                    
                     <div class="col-lg-7">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item_details') ?></h4>  
                                     <input type="hidden" name="guid" id="guid">
                               </div>
                              <br>
                              
                              
                              <div class="row "  style="margin-left:10px;margin-right: 10px" >
                                       <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="sku" class="req"><?php echo $this->lang->line('sku') ?></label>                                                                                                       
                                                           <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'sku',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>
                                                  
                                              
                                        </div>  
                                   <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="barcode" class="req"><?php echo $this->lang->line('barcode') ?></label>                                                                                                       
                                                           <?php $barcode=array('name'=>'barcode',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'barcode',
                                                                                    'value'=>set_value('barcode'));
                                                           echo form_input($barcode)?> 
                                                    </div>
                                                  
                                               
                                        </div>
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="name" class="req"><?php echo $this->lang->line('name') ?></label>                                                                                                       
                                                           <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'name',
                                                                                    'value'=>set_value('mrp'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                  
                                        </div>  
                                  
                                                 
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                    <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="item_department" class="req"><?php echo $this->lang->line('item_department') ?></label>                                                                                                       
                                                           <?php $item_department=array('name'=>'search_department',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_department',
                                                                                    'value'=>set_value('item_department'));
                                                           echo form_input($item_department)?> 
                                                         <input type="hidden" name="item_department" id="item_department">
                                                    </div>
                                                    </div>    
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="category" class="req"><?php echo $this->lang->line('category') ?></label>                                                                                                       
                                                           <?php $category=array('name'=>'search_category',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_category',
                                                                                    'value'=>set_value('category'));
                                                           echo form_input($category)?> 
                                                          <input type="hidden" name="category" id="category">
                                                    </div>
                                                   
                                        </div>
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="brand" class="req"><?php echo $this->lang->line('brand') ?></label>                                                                                                       
                                                           <?php $brand=array('name'=>'search_brand',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_brand',
                                                                                    'value'=>set_value('brand'));
                                                           echo form_input($brand)?> 
                                                         <input type="hidden" name='brand' id='brand'>
                                                    </div>
                                        </div> 
                                  
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="location" ><?php echo $this->lang->line('location') ?></label>                                                                                                       
                                                           <?php $location=array('name'=>'location',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'location',
                                                                                    'value'=>set_value('location'));
                                                           echo form_input($location)?> 
                                                    </div>
                                                  
                                        </div>
                                  <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="supplier" class="req"><?php echo $this->lang->line('supplier') ?></label>                                                                                                       
                                                           <?php $supplier=array('name'=>'search_supplier',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_supplier',
                                                                                    'value'=>set_value('supplier'));
                                                           echo form_input($supplier)?> 
                                                           <input type="hidden" name='supplier' id='supplier'>
                                                    </div>
                                                   
                                                   
                              </div>
                                  
                                   <div class="col col-lg-4" >
                                         
                                                    <div class="form_sep">
                                                         <label for="description" ><?php echo $this->lang->line('description') ?></label>                                                                                                       
                                                           <?php $description=array('name'=>'description',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'description',
                                                                                    'rows'=>2,
                                                                                    'value'=>set_value('description'));
                                                           echo form_textarea($description)?> 
                                                    </div>
                                               
                                        </div>                             
                              </div>
                             
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                   <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="tax_Inclusive" class="req"><?php echo $this->lang->line('tax_Inclusive') ?></label>                                                                                                       
                                                         <select name="tax_Inclusive" id="tax_Inclusive" class="form-control">
                                                             <option value="1"><?php echo $this->lang->line('yes') ?></option>
                                                             <option value="0"><?php echo $this->lang->line('no') ?></option>
                                                         </select>
                                                    </div>
                                                   
                                        </div> 
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="taxes_area" class="req"><?php echo $this->lang->line('taxes_area') ?></label>                                                                                                       
                                                           <?php $taxes_area=array('name'=>'search_taxes_area',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_taxes_area',
                                                                                    'value'=>set_value('taxes_area'));
                                                           echo form_input($taxes_area)?> 
                                                         <input type="hidden" name='taxes_area' id='taxes_area'>
                                                    </div>
                                                   
                                        </div>                              
                                       <div class="col col-lg-4" >
                                                    <div class="form_sep">
                                                         <label for="taxes" class="req"><?php echo $this->lang->line('taxes') ?></label>                                                                                                       
                                                           <?php $taxes=array('name'=>'search_taxes',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_taxes',
                                                                                    'value'=>set_value('taxes'));
                                                           echo form_input($taxes)?> 
                                                           <input type="hidden" name='taxes' id='taxes'>
                                                    </div>
                                                  
                                        </div>
                                       
                                  
                              </div>
                              <div class="row" style="margin-left:10px;margin-right: 10px">
                                  <div class="col col-lg-4" >
                                           
                                                    <div class="form_sep">
                                                         <label for="cost" class="req"><?php echo $this->lang->line('cost') ?></label>                                                                                                       
                                                           <?php $cost=array('name'=>'cost',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'cost',
                                                                                    'onKeyPress'=>"new_cost(event);return numbersonly(event)",
                                                                                    'value'=>set_value('cost'));
                                                           echo form_input($cost)?> 
                                                    </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="mrp" class="req"><?php echo $this->lang->line('mrp') ?></label>                                                                                                       
                                                           <?php $mrp=array('name'=>'mrp',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'mrp',
                                                                                    'onKeyPress'=>"new_mrp(event);return numbersonly(event)",
                                                                                    'value'=>set_value('mrp'));
                                                           echo form_input($mrp)?> 
                                                    </div>
                                                  
                                        </div>                              
                                       <div class="col col-lg-4" >
                                          
                                                    <div class="form_sep">
                                                         <label for="selling_price" class="req"><?php echo $this->lang->line('selling_price') ?></label>                                                                                                       
                                                           <?php $selling_price=array('name'=>'selling_price',
                                                                                    'class'=>'required form-control number',
                                                                                    'id'=>'selling_price',
                                                                                    'onKeyPress'=>"new_price(event);return numbersonly(event)",
                                                                                    'value'=>set_value('selling_price'));
                                                           echo form_input($selling_price)?> 
                                                    </div>
                                                   
                                        </div>  
                                      
                                  
                              </div>
                              
                              
                              <div class="row">
                                                                    
                                                                
                              </div>
                          </div>
                         <div class="panel panel-default" style="margin-top: 6px">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item')." ".$this->lang->line('discount') ?></h4>  
                                   
                               </div>
                              
                              <div class="row "  style="margin-left:10px;margin-right: 10px" >
                                         <div class="col col-lg-4" >
                                                                 <div class="form_sep">
                                                                      <label for="discount_per" ><?php echo $this->lang->line('discount_per') ?></label>                                                                                                       
                                                                        <?php $discount_per=array('name'=>'discount_per',
                                                                                                 'class'=>'form-control',
                                                                                                 'onKeyPress'=>"new_discount(event);return numbersonly(event)",
                                                                                                 'id'=>'discount_per',
                                                                                                 'value'=>set_value('discount_per'));
                                                                        echo form_input($discount_per)?> 
                                                                 </div>

                                                     </div>                              
                                                    <div class="col col-lg-4" >

                                                                 <div class="form_sep">
                                                                      <label for="starting_date" ><?php echo $this->lang->line('starting_date') ?></label>                                                                                                       
                                                                       <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                                    <?php $starting_date=array('name'=>'starting_date',
                                                                                                 'class'=>' form-control',
                                                                                                 'id'=>'starting_date',
                                                                                                 'value'=>set_value('starting_date'));
                                                                        echo form_input($starting_date)?> 
                                                                           <span class="input-group-addon"></span>
                                                                             </div>
                                                                 </div>

                                                     </div>                              
                                                    <div class="col col-lg-4" >

                                                                 <div class="form_sep">
                                                                      <label for="ending_date" ><?php echo $this->lang->line('ending_date') ?></label>                                                                                                       
                                                                      <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                       <?php $ending_date=array('name'=>'ending_date',
                                                                                                 'class'=>' form-control',
                                                                                                 'id'=>'ending_date',
                                                                                                 'value'=>set_value('ending_date'));
                                                                        echo form_input($ending_date)?> 
                                                                      <span class="input-group-addon"></span>
                                                                             </div>
                                                                 </div>

                                                     </div>   
                                      
                                  
                              </div>
                              
                              
                              
                              <br>
                          </div>
                        
                     </div>
                      <div class="col-lg-5">
                              <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('uom') ?></h4>  
                                   
                               </div>
                              <br>
                              
                              
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                                 <div class="form_sep">
                                                                      <label for="purchase" ><?php echo $this->lang->line('purchase') ?></label>                                                                                                       
                                                                      <select class="form-control" name="unit_of_mes" id="unit_of_mes">
                                                                          <option value="0" onclick="change_orm_to_unit_update()"><?php echo $this->lang->line('unit_or_pics') ?></option>
                                                                          <option value="1" onclick="change_orm_to_case_update()"><?php echo $this->lang->line('case_or_box') ?></option>
                                                                      </select>
                                                                      
                                                                        
                                                                 </div>

                                                     </div>                              
                                                    <div class="col col-lg-6" id="hidden_no_unit">

                                                                 <div class="form_sep">
                                                                      <label for="no_of_unit" ><?php echo $this->lang->line('no_of_unit') ?></label>                                                                                                       
                                                                   
                                                                                    <?php $no_of_unit=array('name'=>'no_of_unit',
                                                                                                 'class'=>'required form-control',
                                                                                                 'id'=>'no_of_unit',
                                                                                                 'onKeyPress'=>"new_no_of_unit(event);return numbersonly(event)",
                                                                                                 'value'=>set_value('no_of_unit'));
                                                                        echo form_input($no_of_unit)?> 
                                                                           
                                                                 </div>

                                                     </div>                              
                                                   
                                      
                                  
                              </div>
                              
                              
                              
                              
                              <br>
                          </div>
                           <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('decomposition') ?></h4> 
                               </div>
                              <br>
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                                 <div class="form_sep">
                                                                      <label for="decomposition" ><?php echo $this->lang->line('yes') ?></label>                                                                                                       
                                                                      <input type="checkbox" name="decomposition" id="decomposition" value="0" class="form-control check-mark" onclick="items_decomposition()">
                                                                 </div>
                                                     </div>                              
                                                    <div class="col col-lg-6" id="hidden_weight">

                                                                 <div class="form_sep">
                                                                      <label for="weight" ><?php echo $this->lang->line('weight') ?></label>                                                                                                       
                                                                   
                                                                                    <?php $weight=array('name'=>'weight',
                                                                                                 'class'=>'required form-control',
                                                                                                 'id'=>'weight',
                                                                                                 'onKeyPress'=>"weight(event);return numbersonly(event)",
                                                                                                 'value'=>set_value('weight'));
                                                                        echo form_input($weight)?>                                                                            
                                                                 </div>
                                                     </div> 
                              </div>
                              <br>
                          </div>
                              <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item')." ".$this->lang->line('image') ?></h4>  
                                   
                               </div>
                              <br>
                              
                              
                              <div class="row "  style="margin-left:1px;margin-right: 1px" >
                                         <div class="col col-lg-6" >
                                                            <div class="step_info" style="margin: auto">
                                                <label for="firstname" ><?php echo $this->lang->line('image') ?></label>                     
                                                <div class="fileupload fileupload-new " data-provides="fileupload">
                                                     <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;"><img src="img/no_img_180.png" alt=""></div>
                                                       <div  class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                       <div>
                                                            <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                            <input type="file" name="userfile" /></span>
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                       </div>
                                                 </div>
                                            </div>

                                                     </div>                              
                                                   
                                      
                                  
                              </div>
                              
                              
                              
                              
                              <br>
                          </div>
                          <div class="row">
                                <div class="col-lg-1"></div>
                                  <div class="col col-lg-10 text-center"><br><br>
                                      <button id=""  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_items()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                          </div>
<!--                          <div class="row">
                                <div class="panel panel-default">
                                     <div class="panel-heading">
                                           <h4 class="panel-title"><?php echo $this->lang->line('item_details') ?></h4>  

                                     </div>
                                </div>
                          </div>-->
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
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
        }else{
            var posnic=document.forms.posnic;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>/index.php/items/active',
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
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
        }
        else{
            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
                if(result)
                {
                    var posnic=document.forms.posnic;
                    for (i = 0; i < posnic.length; i++){
                        if(posnic[i].checked==true){                             
                            $.ajax({
                                url: '<?php echo base_url() ?>/index.php/items/delete',
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
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
        }else{
            var posnic=document.forms.posnic;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>/index.php/items/deactive',
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
        
 <script type="text/javascript">                
    $(document).ready(function() {
    $('#add_item').validate();});
</script>
      