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
  
   .customers_select{
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
    function data_table_duplicate(row){
        var rows = $("#selected_item_table").dataTable().fnGetNodes();
        for(var i=0;i<rows.length;i++)
        {
           if($(rows[i]).attr('id')==row){
               return true
           }
        }
        return false
    }
    function get_table_data(){
        $('#selected_item_table').dataTable({
                     "bProcessing": true,
                     "bDestroy": true ,
                     "bPaginate": false,
        });
    }
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function save_new_order(){
         <?php if($this->session->userdata['direct_sales_delivery_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                        get_table_data();
                 var inputs = $('#parsley_reg').serialize()+"&no_of_item="+$("#selected_item_table").dataTable().fnGetNodes().length;
                     $.ajax ({
                            url: "<?php echo base_url('index.php/direct_sales_delivery/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('direct_sales_delivery').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_direct_sales_delivery_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('customers').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                     $('#parsley_reg #items').select2('open');
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customers');?>', { type: "error" });                       
                    <?php }?>
    }
    function update_order(){
         <?php if($this->session->userdata['direct_sales_delivery_per']['edit']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                        get_table_data();
                 var inputs = $('#parsley_reg').serialize()+"&no_of_item="+$("#selected_item_table").dataTable().fnGetNodes().length;
                      $.ajax ({
                            url: "<?php echo base_url('index.php/direct_sales_delivery/update')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('direct_sales_delivery').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_direct_sales_delivery_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('customers').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                     $('#parsley_reg #items').select2('open');
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customers');?>', { type: "error" });                       
                    <?php }?>
    }
    
     $(document).ready( function () {
         
       
          $('#parsley_reg #items').change(function() {
               if(data_table_duplicate('new_item_row_id_'+$('#parsley_reg #items').select2('data').sid)){
                     $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #first_name').val(), { type: "warning" });  
                       $('#parsley_reg #items').select2('open');
              }else{
                   var guid = $('#parsley_reg #items').select2('data').item;
                
                 if($('#parsley_reg #items').select2('data').deco_guid){
                        var guid = $('#parsley_reg #items').select2('data').deco_guid;
                        $('#parsley_reg #item_id').val(guid);
                        $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').deco_code+'-'+$('#parsley_reg #items').select2('data').deco_value);
                        $('#parsley_reg #stock_id').val($('#parsley_reg #items').select2('data').sid);
                        $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                        
                        $('#parsley_reg #price').val(parseFloat($('#parsley_reg #items').select2('data').price));
                        
                        $('#parsley_reg #stock_quty').val($('#parsley_reg #items').select2('data').quty);
                        $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                        $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type+"-"+$('#parsley_reg #items').select2('data').tax_value+"%");
                        var tax=$('#parsley_reg #items').select2('data').deco_tax;
                        $('#parsley_reg #tax_Inclusive').val(tax);
                        if(tax==1){
                            $('#tax_label').text('Tax(Exc)');
                        }else{
                            $('#tax_label').text('Tax(Inc)');   
                        }
                        if(isNaN($('#parsley_reg #tax_value').val())){
                              $('#parsley_reg #tax_value').val(0);
                              $('#parsley_reg #tax').val(0);
                        }
                        net_amount();
                        $('#parsley_reg #quantity').focus();
                        window.setTimeout(function ()
                        {
                            $('#parsley_reg #quantity').focus();
                        }, 0);
                       
                    }else if($('#parsley_reg #items').select2('data').kit_guid){
                        var guid = $('#parsley_reg #items').select2('data').kit_guid;
                        $('#parsley_reg #item_id').val(guid);
                        $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').kit_code);
                        $('#parsley_reg #stock_id').val($('#parsley_reg #items').select2('data').sid);
                        $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').kit_name);
                        
                        $('#parsley_reg #price').val(parseFloat($('#parsley_reg #items').select2('data').kit_price));
                        
                        $('#parsley_reg #stock_quty').val($('#parsley_reg #items').select2('data').quty);
                        $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').kit_tax_value);
                        $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').kit_tax_type+"-"+$('#parsley_reg #items').select2('data').kit_tax_value+"%");
                        var tax=$('#parsley_reg #items').select2('data').kit_tax;
                        var tax_amount=$('#parsley_reg #items').select2('data').kit_tax_amount;
                        $('#parsley_reg #tax_Inclusive').val(tax);
                        if(tax==1){
                            $('#tax_label').text('Tax(Exc)');
                        }else{
                            $('#tax_label').text('Tax(Inc)');   
                        }
                        if(isNaN($('#parsley_reg #tax_value').val())){
                              $('#parsley_reg #tax_value').val(0);
                              $('#parsley_reg #tax').val(0);
                        }
                       // $('#parsley_reg #tax_type').val();
                        net_amount();
                        $('#parsley_reg #quantity').focus();
                        window.setTimeout(function ()
                        {
                            $('#parsley_reg #quantity').focus();
                        }, 0);
                    }else{
                   var guid = $('#parsley_reg #items').select2('data').item;
                
                       
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #stock_id').val($('#parsley_reg #items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                if($('#parsley_reg #items').select2('data').uom==0){
                    $('#parsley_reg #price').val(parseFloat($('#parsley_reg #items').select2('data').price));
                }else{
                    $('#parsley_reg #price').val(parseFloat($('#parsley_reg #items').select2('data').price)/parseFloat($('#parsley_reg #items').select2('data').no_of_unit));
                }
                $('#parsley_reg #stock_quty').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type);
              
                
                var start=$('#parsley_reg #items').select2('data').start
                var end=$('#parsley_reg #items').select2('data').end
           
                var tax=$('#parsley_reg #items').select2('data').tax_Inclusive;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }
                
                if(start==0 && end==0){
                    $('#parsley_reg #discount').val(0);  
                }else{
                    $('#parsley_reg #discount').val($('#parsley_reg #items').select2('data').discount);
                }
                if(isNaN($('#parsley_reg #tax_value').val())){
                      $('#parsley_reg #tax_value').val(0);
                      $('#parsley_reg #tax').val(0);
                }
                   
               net_amount();
                $('#parsley_reg #quantity').focus();
                    window.setTimeout(function ()
                    {
                      
                        $('#parsley_reg #quantity').focus();
                    }, 0);
                }
          }
          });
          function format_item(sup) {
             if(sup.deco_code){
                var code=sup.deco_code;
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('weight') ?>:"+sup.deco_value+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                
            }else if(sup.kit_guid){
                var code=sup.kit_code;
                return  "<p style='font-size:13px;'>"+sup.kit_name+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.kit_price+" <?php echo ' '.$this->lang->line('no_of_items') ?>:"+sup.no_of_items+". </p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.kit_category+"</p> <p style='width:130px;  margin-left: 218px'> .</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> .</p>";
               
            }else{
                var code=sup.value;
                if(sup.uom==0){
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }else{
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+parseFloat(sup.price)/parseFloat(sup.no_of_unit)+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }
            }
            }
          $('#parsley_reg #items').select2({
             
              dropdownCssClass : 'item_select',
                 formatResult: format_item,
                formatSelection: format_item,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/direct_sales_delivery/search_items/',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: 2,
                                term: term,
                               
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term,
                                     suppler:$('#parsley_reg #customers_guid').val()
                        };
                    },
                    results: function (data) {
                      var results = [];
                      
                      $.each(data, function(index, item){
                        results.push({
                        id: item.i_guid+item.price,
                        item: item.i_guid,
                        sid: item.guid,
                        text: item.name,
                        value: item.code,
                        image: item.image,
                        brand: item.b_name,
                        category: item.c_name,
                        department: item.d_name,
                        quty: item.quty,
                        price: item.price,
                        tax_type: item.tax_type_name,
                        tax_value: item.tax_value,
                        tax_Inclusive : item.tax_Inclusive ,
                        start : item.start_date ,
                        end : item.end_state ,
                        discount : item.discount ,
                        uom : item.uom ,
                        no_of_unit : item.no_of_unit ,
                        kit_category : item.kit_category ,
                        kit_code : item.kit_code,
                        kit_name:item.kit_name,
                        kit_price:item.kit_price,
                        kit_tax:item.kit_tax,
                        kit_guid:item.kit_guid,
                        no_of_items:item.no_of_items,
                        kit_tax_amount:item.kit_tax_amount,
                        kit_tax_id:item.kit_tax_id,
                        kit_tax_value:item.kit_tax_value,
                        kit_tax_type:item.kit_tax_type,                        
                        deco_guid:item.deco_guid,
                        deco_tax:item.deco_tax,
                        deco_code:item.deco_code,
                        deco_value:item.deco_value,
                        });
                      });   if($('#customers_guid').val()==""){
                          $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
     $('#parsley_reg #items').select2('close');   
    $('#parsley_reg #first_name').select2('open');
        
                      }
                      return {
                       
                          results: results
                      };
                    }
                }
            });
         function format_customers(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
            }
        $('#parsley_reg #first_name').change(function() {
            refresh_items_table();
           
                   var guid = $('#parsley_reg #first_name').select2('data').id;

                 $('#parsley_reg #first_name').val($('#parsley_reg #first_name').select2('data').text);
                 $('#parsley_reg #company').val($('#parsley_reg #first_name').select2('data').company);
                 $('#parsley_reg #address').val($('#parsley_reg #first_name').select2('data').address1);
                 $('#parsley_reg #demo_customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
                 $('#parsley_reg #customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
                 $('#parsley_reg #customers_guid').val(guid);
                      window.setTimeout(function ()
                    {
                      
                       document.getElementById('order_date').focus();
                    }, 0);  
             
          });
          $('#parsley_reg #first_name').select2({
              dropdownCssClass : 'customers_select',
               formatResult: format_customers,
                formatSelection: format_customers,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/direct_sales_delivery/search_customer',
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
                          text: item.first_name,
                          company: item.company_name,
                          address1: item.address,
                          discount: item.discount,
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
refresh_items_table();
$('#update_button').hide();
$('#save_button').show();
$('#update_clear').hide();
$('#save_clear').show();
$('#total_amount').val('');
$('#items_id').val('');
$('#customers_guid').val('');
$("#parsley_reg").trigger('reset');
$('#deleted').remove();
$('#parent_items').append('<div id="deleted"></div>');
$('#newly_added').remove();
$('#parent_items').append('<div id="newly_added"></div>');
$("#parsley_reg #first_name").select2('data', {id:'',text: 'Search Customer'});
    <?php if($this->session->userdata['direct_sales_delivery_per']['add']==1){ ?>
             $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/direct_sales_delivery/order_number/",                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 
                                
                                 $('#parsley_reg #order_number').val(data[0][0]['prefix']+data[0][0]['max']);
                                 $('#parsley_reg #demo_order_number').val(data[0][0]['prefix']+data[0][0]['max']);
                             }
                             });
            
            
            
      $("#user_list").hide();
    $('#add_new_order').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_direct_sales_delivery').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#direct_sales_delivery_lists').removeAttr("disabled");
     
         window.setTimeout(function ()
    {
       
        $('#parsley_reg #first_name').select2('open');
    }, 500);
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_direct_sales_delivery_lists(){
      $('#edit_brand_form').hide('hide');
      $('#add_new_order').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_direct_sales_delivery').removeAttr("disabled");
      $('#direct_sales_delivery_lists').attr("disabled",'disabled');
}
function clear_add_direct_sales_delivery(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
}
function clear_update_direct_sales_delivery(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
      edit_function($('#direct_sales_delivery_guid').val());
}
function reload_update_user(){
    var id=$('#guid').val();
    customers_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_direct_sales_delivery" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                     
                        <a href="javascript:direct_sales_delivery_group_approve()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_direct_sales_delivery_lists()" class="btn btn-default" id="direct_sales_delivery_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('direct_sales_delivery') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('direct_sales_delivery/direct_sales_delivery_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('direct_sales_delivery') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('order_number') ?></th>
                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                           <th><?php echo $this->lang->line('name') ?></th>
                                          <th><?php echo $this->lang->line('order_date') ?></th>
                                          <th><?php echo $this->lang->line('number_of_items') ?></th>
                                          <th><?php echo $this->lang->line('total_amount') ?></th>
                                         
                                      
                                          <th><?php echo $this->lang->line('status') ?></th>
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
<script type="text/javascript">
 
    function discounte_amount(){
    if(parseFloat($('#parsley_reg #hidden_total_price').val())>0){
        total=parseFloat($('#parsley_reg #hidden_total_price').val());
        discount=(total*parseFloat($('#parsley_reg #discount').val()))/100;
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())-discount);
       
        round_amt=parseFloat($('#parsley_reg #round_amt').val());
        freight=parseFloat($('#parsley_reg #freight').val())
        if(freight==""){freight=0;}
        if(round_amt==""){round_amt=0;}
         $('#parsley_reg #discount_amt').val(discount);
        if (isNaN($('#parsley_reg #total_price').val())) 
    $('#parsley_reg #total_price').val('00');
    
        if (isNaN($('#parsley_reg #discount_amt').val())) 
    $('#parsley_reg #discount_amt').val('0');
        if (isNaN($('#parsley_reg #round_amt').val())) 
    $('#parsley_reg #round_amt').val('00');
        if (isNaN($('#parsley_reg #freight').val())) 
    $('#parsley_reg #dfreight').val('00');;
    }
    if($('#parsley_reg #discount').val()==0 || isNaN($('#parsley_reg #discount').val())){
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())+round_amt+freight);
    }
    new_grand_total();
    total=parseFloat($('#parsley_reg #hidden_total_price').val());
    if(total=="" || total==0 || isNaN(total)){
        $('#parsley_reg #total_price').val("0");
    }
}
function new_order_date(e){
    if($('#parsley_reg #customers_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #order_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
         
               window.setTimeout(function ()
    {
        $('#parsley_reg #id_discount').focus();
    }, 10);
            
        }
         if (unicode!=27){
        }
       else{
        
           $('#parsley_reg #first_name').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Customer');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }

function new_discount(e){
    if($('#parsley_reg #customers_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #discount_amount').focus();
             
        }
         if (unicode!=27){
        }
       else{
            
          document.getElementById("order_date").focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }



function new_discount_amount_press(e){

    if($('#parsley_reg #customers_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          
         
           $('#parsley_reg #freight').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #id_discount').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_freight(e){
    if($('#parsley_reg #customers_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #round_off_amount').focus();
          
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #discount_amount').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_round_off_amount(e){
    if($('#parsley_reg #customers_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          $('#parsley_reg #items').select2('open');
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #freight').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function add_new_quty(e){
    if($('#parsley_reg #item_id').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #quantity').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          copy_items();
         
        }
         if (unicode!=27){
        }
       else{
           
           $('#parsley_reg #items').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $('#parsley_reg #items').select2('open');

        }

    }

    function net_amount(){
      if(isNaN($('#parsley_reg #discount').val())){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
        if(isNaN($('#parsley_reg #stock_quty').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #stock_quty').val())){
                $('#parsley_reg #stock_quty').val(0);
            }else{
                $('#parsley_reg #quantity').val(0);
            }
        }else{
           
           if(isNaN($('#parsley_reg #discount').val())){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
            if($('#discount').val()==""){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
         
                 if($('#parsley_reg #discount').val()!="" && $('#parsley_reg #discount').val()!=0){
                       
                        $('#tax').val((parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val()))/100));
                        var num = parseFloat($('#tax').val());
                        $('#tax').val(num.toFixed(point));
                        var discount=parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*parseFloat($('#parsley_reg #discount').val())/100;
                          if($('#tax_Inclusive').val()==1){
                              
                        $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()-parseFloat(discount)+parseFloat($('#tax').val()));
                        }else{
                             $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()-parseFloat(discount));
                        }
                        var num = parseFloat($('#total').val());
                        $('#total').val(num.toFixed(point));
                        $('#item_discount').val(discount);
                        var num = parseFloat($('#item_discount').val());
                        $('#item_discount').val(num.toFixed(point));

                 }else{
                     $('#tax').val((parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val()))/100));
                        var num = parseFloat($('#tax').val());
                        $('#tax').val(num.toFixed(point));
                       
                          if($('#tax_Inclusive').val()==1){
                              
                        $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()+parseFloat($('#tax').val()));
                        }else{
                             $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val());
                        }
                        var num = parseFloat($('#total').val());
                        $('#total').val(num.toFixed(point));
                        $('#item_discount').val(discount);
                        var num = parseFloat($('#item_discount').val());
                        $('#item_discount').val(num.toFixed(point));
                 }
                 
                   
                    
            
        }
        if(isNaN($('#parsley_reg #tax').val())){
                
                $('#parsley_reg #tax').val(0);
            }
        if(isNaN($('#parsley_reg #item_discount').val())){
                
                $('#parsley_reg #item_discount').val(0);
            }
    }
function copy_items(){

 if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #price').val()!=""   && $('#parsley_reg #quantity').val()!=""){
 
  
      
if(data_table_duplicate('new_item_row_id_'+$('#parsley_reg #stock_id').val())){

  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
      free=0;
  }


  var  price=$('#parsley_reg #price').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  tax_value=$('#parsley_reg #tax_value').val();
  var  per=$('#parsley_reg #discount').val();
  var  discount=((parseFloat(quty)*parseFloat(price))*$('#parsley_reg #discount').val())/100;
  var  tax_type=$('#parsley_reg #tax_type').val();
  var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
  var tax=(parseFloat(quty)*parseFloat(price))*tax_value/100;
    if(tax_Inclusive==1){
     total= (parseFloat(quty)*parseFloat(price))+tax-discount;
     type='Exc';
  }else{
      type='Inc';
       total= (parseFloat(quty)*parseFloat(price))-discount;
  }
  if(discount==""){
    discount=0;
    }
  if(per==""){
    per=0;
    }
  
    var tax=((parseFloat(quty)*parseFloat(price))*tax_value/100);
    tax=tax.toFixed(point);
    total=total.toFixed(point);
  ///$('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()).remove();
 var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val();
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(2)').html(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(3)').html(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(4)').html(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(5)').html(price);
 
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(7)').html(discount);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(8)').html(total);

  $('#newly_added #new_item_id_'+items_id).val(items_id);
  $('#newly_added #new_item_quty_'+items_id).val(quty);
  $('#newly_added #new_item_price_'+items_id).val(price);
  $('#newly_added #new_item_total_'+items_id).val(parseFloat(quty)*parseFloat(price));
  $('#newly_added #new_item_discount_'+items_id).val(discount);
  $('#newly_added #new_item_discount_per_'+items_id).val(per);
  $('#newly_added #new_item_tax_'+items_id).val(tax);
  $('#newly_added #new_item_total'+items_id).val(total);

  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_id').val(items_id);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_name').val(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_sku').val(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_quty').val(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_price').val(price);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax').val(tax);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_type').val(tax_type);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_value').val(tax_value);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_inclusive').val(tax_Inclusive);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_discount').val(discount);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_discount_per').val(per);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_sub_total').val(parseFloat(quty)*parseFloat(price));
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val(total);
    $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
    
    if (isNaN($("#parsley_reg #total_amount").val())) {
    $("#parsley_reg #total_amount").val(0)    
    }
   
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)



if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val(total-parseFloat(old_total));
}else{
   
     if(total!=old_total){
     
         var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
          amount=amount.toFixed(point);
    $('#parsley_reg #total_amount').val();
  $('#parsley_reg #total_amount').val(amount)
     }
}
 
if(tax_Inclusive==1){
if($('#parsley_reg #total_tax').val()==0){
      $('#parsley_reg #total_tax').val(tax);
     
}else{
    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())-$('#parsley_reg #old_tax').val()+parseFloat(tax));
}
}
if($('#parsley_reg #total_item_discount_amount').val()==0){
      $('#parsley_reg #total_item_discount_amount').val(discount);
     
}else{
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())-$('#parsley_reg #old_discount').val()+parseFloat(discount));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   //new_discount_amount();
    
    
    
    clear_inputs();
    $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
}else{
   

  var  name=$('#parsley_reg #item_name').val();
  var  stock=$('#parsley_reg #stock_id').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
  var  free=0;
  }
  
  var  price=$('#parsley_reg #price').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  customers=$('#parsley_reg #customers_guid').val();
  var  tax_value=$('#parsley_reg #tax_value').val();
  
  var  tax_type=$('#parsley_reg #tax_type').val();
  var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
  var  discount=((parseFloat(quty)*parseFloat(price))*$('#parsley_reg #discount').val())/100;
  var  per=$('#parsley_reg #discount').val();
  var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
  var total;
  var type;
  if(tax_Inclusive==1){
     total= (parseFloat(quty)*parseFloat(price))+tax-discount;
     type='Exc';
  }else{
      type='Inc';
       total= (parseFloat(quty)*parseFloat(price))-discount;
  }
  if(discount==""){
    discount=0;
    }
  if(per==""){
    per=0;
    }
    
   $('#newly_added').append('<div id="newly_added_items_list_'+stock+'"> \n\
\n\
<input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+stock+'">\n\
<input type="hidden" name="new_item_stock_id[]" value="'+stock+'"  id="new_item_stock_id_'+stock+'">\n\
<input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+stock+'"> \n\
<input type="hidden" name="new_item_discount[]" value="'+per+'" id="new_item_discount_id_'+stock+'"> \n\
<input type="hidden" name="new_item_tax_value[]" value="'+tax_value+'" id="new_item_tax_value_id_'+stock+'"> \n\
<input type="hidden" name="new_item_price[]" value="'+price+'" id="new_item_price_'+stock+'">\n\
<input type="hidden" name="new_item_total[]"  value="'+parseFloat(quty)*parseFloat(price)+'" id="new_item_total_'+stock+'">\n\
</div>');
 
   total=total.toFixed(point);
   
    tax=tax.toFixed(point);
    discount=discount.toFixed(point);
  
   var addId = $('#selected_item_table').dataTable().fnAddData( [
      null,
      name,
      sku,
      quty,
      price,
      tax+' : '+tax_type+'('+type+')',
      discount,
      total,
     
'<input type="hidden" name="index" id="index">\n\
<input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
<input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
<input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
<input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
<input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
<input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
<input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
<input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
<input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
<input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
<input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
<input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
<input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
<input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
<input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
        <a href=javascript:edit_order_item("'+stock+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
theNode.setAttribute('id','new_item_row_id_'+stock)
    $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
     if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val(total);
     
}else{
    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total));
}
if(tax_Inclusive==1){
if($('#parsley_reg #total_tax').val()==0){
      $('#parsley_reg #total_tax').val(tax);
     
}else{
    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax));
}
}
if($('#parsley_reg #total_item_discount_amount').val()==0){
      $('#parsley_reg #total_item_discount_amount').val(discount);
     
}else{
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   new_discount_amount();
    
    
    clear_inputs();
    $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
      }  
        
        
        }else{
         if($('#parsley_reg #item_id').val()==""){
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
           $('#parsley_reg #items').select2('open');
        }
          else if($('#parsley_reg #quantity').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
           $('#parsley_reg #quantity').focus();
        }
        else{
             $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
        }
        }
      new_grand_total(); 
      new_discount_amount();
      $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
}
function edit_order_item(guid){
    $('#parsley_reg #item_name').val($('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val());
    $('#parsley_reg #sku').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sku').val());
    $('#parsley_reg #customers_quty').val($('#selected_item_table #new_item_row_id_'+guid+' #item_limit').val());
    $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
    $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #items_price').val());
    $('#parsley_reg #discount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val());
    $('#parsley_reg #tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax').val());
    $('#parsley_reg #tax_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type').val());
    $('#parsley_reg #tax_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val());
    $('#parsley_reg #tax_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val());
    
    //old 
     $('#parsley_reg #old_tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val()/100);
      $('#parsley_reg #old_discount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val()/100);
   
    $('#parsley_reg #item_id').val(guid);
    $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_total').val());
     if( $('#parsley_reg #tax_Inclusive').val()==1){
        $('#tax_label').text('Tax(Exc)');
    }else{
        $('#tax_label').text('Tax(Inc)');   
    }
     $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });

         net_amount();
         
        

}
function delete_order_item(guid){
    var net=$('#selected_item_table #new_item_row_id_'+guid+' #items_total').val();
    var dis=$('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val();
    var items_tax_inclusive=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val();
    if(items_tax_inclusive==1){
        var quty=$('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val();
        var price=$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val();
        var value=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val();
        var tax=parseFloat(quty)*parseFloat(price)*parseFloat(value)/100;
         $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())-tax);
    }
    
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())-parseFloat(dis));
    var total=$("#parsley_reg #total_amount").val();
    $("#parsley_reg #total_amount").val(parseFloat(total)-parseFloat(net));
    $("#parsley_reg #demo_total_amount").val(parseFloat(total)-parseFloat(net));
    var num = parseFloat($('#demo_total_amount').val());
    $('#demo_total_amount').val(num.toFixed(point));
    var num = parseFloat($('#total_amount').val());
    $('#total_amount').val(num.toFixed(point));
    new_discount_amount();
    $("#parsley_reg #total_amount").val()
     var order=$('#selected_item_table #new_item_row_id_'+guid+' #items_order_guid').val();
      $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+order+'">');
    var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
     var anSelected =  $("#selected_item_table").dataTable();
       anSelected.fnDeleteRow(index-1);
    if(document.getElementById('newly_added_items_list_'+guid)){
        $('#newly_added_items_list_'+guid).remove();
    }
    if($("#parsley_reg #total_amount").val()==0 || $("#parsley_reg #total_amount").val()==""){
        $("#parsley_reg #demo_grand_total").val(0)
        $("#parsley_reg #grand_total").val(0)
    }
}
function clear_inputs(){
  $('#parsley_reg #item_name').val('');
  $('#parsley_reg #sku').val('');
  $('#parsley_reg #quantity').val('');
  $('#parsley_reg #free').val('');
  $('#parsley_reg #total').val('');
  $('#parsley_reg #sub_total').val('');
  $('#parsley_reg #price').val('');
  $('#parsley_reg #mrp').val('');
  $('#parsley_reg #tax').val('');
  $('#parsley_reg #tax_value').val('');
  $('#parsley_reg #tax_type').val('');
  $('#parsley_reg #tax_Inclusive').val('');
  $('#parsley_reg #extra_elements').val('');
  $('#parsley_reg #item_id').val('')
  $('#parsley_reg #dummy_discount_amount').val('')
  $('#parsley_reg #hidden_dis_amt').val('')
  $('#parsley_reg #hidden_dis').val('')
  $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
  $('#parsley_reg #dummy_discount').val('')
  $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
  $('#parsley_reg #items').select2('open');
   
         window.setTimeout(function ()
    {
       //$('#parsley_reg #delivery_date').focus();
       $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
    }, 0);
}
function new_grand_total(){
         if(parseFloat($("#parsley_reg #total_amount").val())>0){
var discount=parseFloat($("#parsley_reg #discount_amount").val());
var frieight=parseFloat($("#parsley_reg #freight").val());
var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
    if (isNaN(discount) || discount=="") {
    discount=0;}
        if (isNaN(frieight)|| frieight=="") {
    frieight=00;}
        if (isNaN(round_amt)|| round_amt=="") {
    round_amt=00;}
 if($('#parsley_reg #customer_discount').val()==0 || isNaN($('#parsley_reg #customer_discount').val())){
      var  customer_dis=0;
    }else{
        customer_dis=parseFloat($('#parsley_reg #total_amount').val())*parseFloat($('#parsley_reg #customer_discount').val())/100;
         var customer_dis = parseFloat(customer_dis);
        $('#demo_customer_discount_amount').val(customer_dis.toFixed(point));
        $('#customer_discount_amount').val(customer_dis.toFixed(point));
    }

     $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt-customer_dis);
     $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt-customer_dis);
       
        var num = parseFloat($('#demo_grand_total').val());
    $('#demo_grand_total').val(num.toFixed(point));
    
    var num = parseFloat($('#grand_total').val());
    $('#grand_total').val(num.toFixed(point));
    var num = parseFloat($('#demo_total_amount').val());
    $('#demo_total_amount').val(num.toFixed(point));
    var num = parseFloat($('#total_amount').val());
    $('#total_amount').val(num.toFixed(point));
        }
   if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
    
}
function new_discount_amount(){
 if(parseFloat($("#parsley_reg #total_amount").val())>0){
    var total=parseFloat($("#parsley_reg #total_amount").val());
    if($("#parsley_reg #id_discount").val()!="" && $("#parsley_reg #id_discount").val()!=0){
            var discount=(total*parseFloat($("#parsley_reg #id_discount").val()))/100;
            discount=discount.toFixed(point);
              $("#parsley_reg #discount_amount").val(discount);
    }else{
        var  discount=$('discount_amount').val();
       
    }
    $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
    $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
  
    var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
    var freight=parseFloat($("#parsley_reg #freight").val())
    if(freight==""){freight=0;}
    if(round_amt==""){round_amt=0;}
         
    if (isNaN($("#parsley_reg #total_amount").val())) 
        $("#parsley_reg #total_amount").val(0)    
    if (isNaN($("#parsley_reg #discount_amount").val())) 
        $("#parsley_reg #discount_amount").val(0);
    if (isNaN($("#parsley_reg #round_off_amount").val())) 
        $("#parsley_reg #round_off_amount").val(0);
    if (isNaN($("#parsley_reg #freight").val())) 
        $("#parsley_reg #freight").val()
    
    }
    
    new_grand_total();
    total=parseFloat($("#parsley_reg #total_amount").val());
    if(total=="" || total==0 || isNaN(total)){
      $("#parsley_reg #total_amount").val(0);
    }
}
</script>

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('direct_sales_delivery/upadate_pos_direct_sales_delivery_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('direct_sales_delivery')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep customers_select_2">
                                                        <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                        <input type="hidden" id="direct_sales_delivery_guid" name="direct_sales_delivery_guid">
                                                  </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'company',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('company'));
                                                                         echo form_input($last_name)?>
                                                    </div><input type="hidden" value="" name='customers_guid' id='customers_guid'>
                                               </div>
                                              
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="address" ><?php echo $this->lang->line('address') ?></label>													
                                                                     <?php $address=array('name'=>'address',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'address',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('address'));
                                                                         echo form_input($address)?>
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="order_number" ><?php echo $this->lang->line('order_number') ?></label>													
                                                                     <?php $order_number=array('name'=>'demo_order_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_order_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('order_number'));
                                                                         echo form_input($order_number)?>
                                                            <input type="hidden" name="order_number" id="order_number">
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="order_date" ><?php echo $this->lang->line('sddn_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $order_date=array('name'=>'order_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'order_date',
                                                                                          'onKeyPress'=>"new_order_date(event)", 
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($order_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount" ><?php echo $this->lang->line('discount') ?>%</label>													
                                                                     <?php $discount=array('name'=>'discount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'id_discount',
                                                                                         
                                                                                         'onkeyup'=>'new_discount_amount()',
                                                                                        'onKeyPress'=>"new_discount(event);return numbersonly(event)",
                                                                                        'value'=>set_value('discount'));
                                                                         echo form_input($discount)?>
                                                       </div>
                                                    </div>
                                              
                                              
                                               </div>
                                           <div class="row">
                                               
                                          
                                                
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount_amount" ><?php echo $this->lang->line('discount_amount') ?></label>													
                                                                     <?php $discount_amount=array('name'=>'discount_amount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'discount_amount',
                                                                                       'onkeyup'=>"new_grand_total()",
                                                                                        'onKeyPress'=>"new_discount_amount_press(event);return numbersonly(event)", 
                                                                                        'value'=>set_value('discount_amount'));
                                                                         echo form_input($discount_amount)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="freight" ><?php echo $this->lang->line('freight') ?></label>													
                                                                     <?php $freight=array('name'=>'freight',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'freight',
                                                                                        'onkeyup'=>"new_grand_total()",
                                                                                       'onKeyPress'=>"new_freight(event);return numbersonly(event)",
                                                                                        'value'=>set_value('freight'));
                                                                         echo form_input($freight)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="round_off_amount" ><?php echo $this->lang->line('round_off_amount') ?></label>													
                                                                     <?php $round_off_amount=array('name'=>'round_off_amount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'round_off_amount',
                                                                                        'onkeyup'=>"new_grand_total()",    
                                                                                        'onKeyPress'=>"new_round_off_amount(event);return numbersonly(event)",
                                                                                        'value'=>set_value('round_off_amount'));
                                                                         echo form_input($round_off_amount)?>
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="customer_discount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>													
                                                                     <?php $customer_discount=array('name'=>'customer_discount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount)?>
                                                            <input type="hidden" name="customer_discount" id="customer_discount">
                                                       </div>
                                                    </div>
                                                 <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="customer_discount_amount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('disc').' '.$this->lang->line('amt') ?></label>													
                                                                     <?php $customer_discount_amount=array('name'=>'customer_discount_amount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount_amount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount_amount)?>
                                                            <input type="hidden" name="customer_discount_amount" id="customer_discount_amount">
                                                       </div>
                                                    </div>
                                           </div>
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>
                         
                         
         
                    <div class="row small_inputs" >
                        <div class="col col-lg-12">
                            <div class="row" style="padding-top: 1px;">
                                 
                                  
                                                <div class="col col-sm-1" style="padding:1px; width: 190px;">
                                             
                                                   
                                             <label for="items" class="text-center" ><?php echo $this->lang->line('items') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $items=array('name'=>'items',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'items',
                                                                                    'value'=>set_value('items'));
                                                                     echo form_input($items)?>
                                                  </div>
                                         
                                                    <input type="hidden" id='diabled_item' class="form-control">                                                 
                                                    <input type="hidden" name="item_id" id="item_id">
                                                    <input type="hidden" name="tax_type" id="tax_type">
                                                    <input type="hidden" name="tax_Inclusive" id="tax_Inclusive">                                                 
                                                    <input type="hidden" name="tax_value" id="tax_value">
                                                    <input type="hidden" name="item_name" id="item_name">
                                                    <input type="hidden" name="sku" id="sku">
                                                    <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                    <input type="hidden" name="stock_quty" id="stock_quty">
                                                    <input type="hidden" name="stock_id" id="stock_id">
                                                    <input type="hidden" name="discount" id="discount">
                                                    <input type="hidden" name="old_discount" id="old_discount">
                                                    <input type="hidden" name="old_tax" id="old_tax">
                                                        </div>
                                                
                                                 <div class="col col-lg-1" style="padding:1px;width: 160px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'quantity',
                                                                                            'onkeyup'=>"net_amount()", 
                                                                     'onKeyPress'=>"add_new_quty(event); return numbersonly(event)",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                
                                                
                                                
                                                     
                                              
                                                    <div class="col col-lg-1" style="padding:1px;width: 120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" class="text-center" ><?php echo $this->lang->line('price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'price',
                                                                                            'disabled'=>'disabled',
                                                                  
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                          
                                                
                                  
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;width:120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="tax" class="text-center" id="tax_label"  ><?php echo $this->lang->line('tax_type') ?></label>

                                                                 <?php $tax_type=array('name'=>'tax_type',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'tax_type',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('tax_type'));
                                                                             echo form_input($tax_type)?>
                                                        </div>
                                                    </div>
                                                          <div class="col col-lg-1" style="padding:1px;width:120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="tax" class="text-center" id="tax_label"  ><?php echo $this->lang->line('tax') ?></label>

                                                                 <?php $tax=array('name'=>'tax',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'tax',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('tax'));
                                                                             echo form_input($tax)?>
                                                        </div>
                                                    </div>
                                               
                                                <div class="col col-lg-1" style="padding:1px;width:120px">
                                                   <div class="form_sep"> <label for="discount" class="text-center" ><?php echo $this->lang->line('discount') ?></label>
                                                            <?php $item_discount=array('name'=>'item_discount',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'item_discount',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('item_discount'));
                                                                             echo form_input($item_discount)?>
                                                                
                                                        </div>
                                                    </div>
                                                <div class="col col-lg-2" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="total" class="text-center"  ><?php echo $this->lang->line('total') ?></label>

                                                                 <?php $total=array('name'=>'total',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'total',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('total'));
                                                                             echo form_input($total)?>
                                                        </div>
                                                    </div>
                                                <div class="col col-lg-1" style="padding: 18px 0px 1px; width: 25px;">
                                                
                                                    <a  href="javascript:copy_items()" style="padding: 2px 3px"><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('save') ?>" style="height: 24px;padding: 4px 6px;width:24px "><i class="icon icon-save"></i></span></a>
                                                  
                                                </div> <div class="col col-lg-1" style=" padding: 18px 0px 1px; width: 25px;">
                                                  
                                                    <a  style="padding: 2px 3px" href="javascript:clear_inputs()"><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('clear') ?>" style="height: 24px;padding: 4px 6px;width:24px "><i class="icon icon-refresh"></i></span></a>
                                                </div>
                                               
                                               
                          
                                          
                                     <br>
                                                                     
                              </div>
                        </div>
                    </div>
                    <div class="row small_inputs" >
                    <div class="col col-lg-9">
                      
                         
                             
                              
                          
                          
                        <div class="row" ><input type="hidden" value="0" id='sl_number'>
             
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('order_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table table-striped dataTable ">
                                    <thead>
                                        <tr>
                                            
                                     <th><?php echo $this->lang->line('no') ?></th>
                                    <th><?php echo $this->lang->line('name') ?></th>
                                        <th><?php echo $this->lang->line('sku') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>                                  
                                    <th><?php echo $this->lang->line('price') ?></th>
                                    <th><?php echo $this->lang->line('tax') ?></th>
                                    <th><?php echo $this->lang->line('discount') ?></th>
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="new_order_items" >
                                       
                                    </tbody >
                                </table>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col col-lg-12" id="parent_items">
                            <div class="row">
                         
                             
                                 
                                       <div id="" class="col col-lg-12" style="padding-right: 0px;padding-left: 0px">
                                           <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('note')." ".$this->lang->line('and')." ".$this->lang->line('remark') ?></h4>                                                                               
                              </div> <div class="row" style="padding-left:25px;padding-right:25px;padding-bottom:  25px">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                        <label for="note" ><?php echo $this->lang->line('note') ?></label>													
                                                                  <?php $note=array('name'=>'note',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'note',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('note'));
                                                                     echo form_textarea($note)?>
                                                        
                                                  </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                         <label for="remark" ><?php echo $this->lang->line('remark') ?></label>													
                                                                  <?php $remark=array('name'=>'remark',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'remark',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('remark'));
                                                                     echo form_textarea($remark)?>
                                                        
                                                  </div>
                                               </div>
                                               
                                               
                                               
                                              
                                           </div>
                                           </div>
                                     <br>
                                        </div> 
                               
                             
                          
                          </div>
                                <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                            </div>
                        </div>
                    
                    </div><div class="col col-sm-3" >
                       
                        <div class="row" style="margin-left: 5px">
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
                              </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_item_discount_amount" ><?php echo $this->lang->line('total_item_discount_amount') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_item_discount_amount',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_item_discount_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_item_discount_amount'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        <input type='hidden' name='total_item_discount_amount' id='total_item_discount_amount'>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_tax" ><?php echo $this->lang->line('total_tax') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_tax',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_tax',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_tax'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        <input type='hidden' name='total_tax' id='total_tax'>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_amount" ><?php echo $this->lang->line('total_amount') ?></label>													
                                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_total_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_amount'));
                                                                     echo form_input($total_amount)?>
                                                        <input type="hidden" name="total_amount" id="total_amount">
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="grand_total" ><?php echo $this->lang->line('grand_total') ?></label>													
                                                                  <?php $grand_total=array('name'=>'demo_grand_total',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_grand_total',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('grand_total'));
                                                                     echo form_input($grand_total)?>
                                                        <input type="hidden" name="grand_total" id="grand_total">
                                                        
                                                  </div><br>
                                                  </div>
                                               </div>
                        <div class="row" style="margin-left: 5px">
                                          <div class="col col-sm-6"  >
                                              <div class="form_sep " id="save_button" style="padding-left:0px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:save_new_order()" class="btn btn-default"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_order()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-6"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_direct_sales_delivery()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_direct_sales_delivery()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                               </div>
                                         
                                               
                                              
                                      </div>
                    </div>  </div>  </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
                <script type="text/javascript">
                 
                 
     function posnic_delete(){
            <?php if($this->session->userdata['direct_sales_delivery_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_sales_delivery');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('direct_sales_delivery') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                           
                          if(posnic[i].checked==true){ 
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/direct_sales_delivery/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                  complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_sales_delivery') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }else if(response['responseText']=='Approved'){
                                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                    }else{
                                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                       
                                    }
                                    }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      <?php }else{?>
                                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                       
                           <?php }
                        ?>
                      }
                    
                    
                    
    function direct_sales_delivery_group_approve(){
         <?php if($this->session->userdata['direct_sales_delivery_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_sales_delivery');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                           var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/direct_sales_delivery/direct_sales_delivery_approve',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                     complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                               $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_sales_delivery') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }else if(response['responseText']=='Approved'){
                                             $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                        }else{
                                              $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                        
                                        }
                                        }
                                });

                          }

                      }
                  

                      }   
                        <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_sales_delivery');?>', { type: "error" });                       
                            <?php }
                         ?>
                      }
                    function posnic_group_item_deactive(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_sales_delivery');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>index.php/direct_sales_delivery/item_deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#selected_item_table").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    
                </script>
        

      