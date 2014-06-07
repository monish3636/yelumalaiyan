<style type="text/css">
    .my_select{
         -moz-bitem_kit-bottom-colors: none;
    -moz-bitem_kit-left-colors: none;
    -moz-bitem_kit-right-colors: none;
    -moz-bitem_kit-top-colors: none;
    background-color: #FFFFFF;
    bitem_kit-color: #C0C0C0 #D9D9D9 #D9D9D9;
    bitem_kit-image: none;
    bitem_kit-radius: 1px;
    bitem_kit: 1px solid rgba(0, 0, 0, 0.2);
    bitem_kit-style: solid;
    bitem_kit-width: 1px;
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
    function save_new_item_kit(){
        <?php if($this->session->userdata['item_kit_per']['add']==1){ ?>
                if($('#parsley_reg').valid()){
                    var oTable = $('#selected_item_table').dataTable();
                    if(oTable.fnGetData().length>0){
                        var inputs = $('#parsley_reg').serialize();
                        $.ajax ({
                            url: "<?php echo base_url('index.php/item_kit/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                    $.bootstrapGrowl('<?php echo $this->lang->line('item_kit').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                    $("#dt_table_tools").dataTable().fnDraw();
                                    $("#parsley_reg").trigger('reset');
                                    posnic_item_kit_lists();
                                    refresh_items_table();
                                }else  if(response['responseText']=='ALREADY'){
                                    $.bootstrapGrowl($('#parsley_reg #item_kit_number').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                }else  if(response['responseText']=='FALSE'){
                                    $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                }else{
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_kit');?>', { type: "error" });                           
                                }
                            }
                        });
                    }else{                  
                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                        $('#parsley_reg #items').select2('open');
                    }
                }else{
                    $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                }
        <?php                 
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                       
        <?php }?>
    }
    function update_item_kit(){
        <?php if($this->session->userdata['item_kit_per']['edit']==1){ ?>
            if($('#parsley_reg').valid()){
                var oTable = $('#selected_item_table').dataTable();
                if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/item_kit/update')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('item_kit').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_item_kit_lists();
                                refresh_items_table();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #item_kit_number').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_kit');?>', { type: "error" });                           
                            }
                       }
                    });
                }else{
                    $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                    $('#parsley_reg #items').select2('open');
                }
            }else{
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
            }
        <?php }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                       
        <?php }?>
    }
    
    $(document).ready( function () {
        
        function format_items(sup) {
            if (!sup.id) return sup.text;   
            if(sup.deco_code){
                var code=sup.deco_code;
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('weight') ?>:"+sup.deco_value+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                
            }else{
                var code=sup.value;
                if(sup.uom==0){
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }else{
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+parseFloat(sup.price)/parseFloat(sup.no_of_unit)+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }
            }
           
        }
        $('#parsley_reg #select_item').change(function() {           
            var guid = $('#parsley_reg #select_item').select2('data').item;
            $('#parsley_reg #item_guid').val(guid);
            if($('#parsley_reg #select_item').select2('data').deco_code){
                $('#parsley_reg #sku').val($('#parsley_reg #select_item').select2('data').deco_code);
            }else{
                $('#parsley_reg #sku').val($('#parsley_reg #select_item').select2('data').value);
            }
            $('#parsley_reg #stock_id').val($('#parsley_reg #select_item').select2('data').sid);      
            $('#parsley_reg #item_stock').val($('#parsley_reg #select_item').select2('data').quty);
            window.setTimeout(function ()
            {
                $('#parsley_reg #quantity').focus();
            }, 0);
           

        });
        $('#parsley_reg #select_item').select2({
            dropdownCssClass : 'item_select',
            formatResult: format_items,
            formatSelection: format_items,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/item_kit/search_items/',
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
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                          id: item.guid,
                          item: item.item,
                          sid: item.guid,
                          text: item.name,
                          value: item.code,
                          image: item.image,
                          brand: item.b_name,
                          category: item.c_name,
                          department: item.d_name,
                          quty: item.quty,
                          price: item.price,
                          uom : item.uom ,
                          no_of_unit:item.no_of_unit,
                          deco_code:item.deco_code,
                          deco_value:item.deco_value
                        });
                    });   
                    return {
                        results: results
                    };
                }
            }
        });      
        $('#parsley_reg #category').change(function() {           
            var guid = $('#parsley_reg #category').select2('data').id;
            $('#parsley_reg #category_id').val(guid);
        });
        $('#parsley_reg #category').select2({
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/item_kit/search_category/',
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
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.guid,
                            text: item.category_name,
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

$('#select_item').select2('enable');
$('#update_button').hide();
$('#save_button').show();
$('#update_clear').hide();
$('#save_clear').show();
$('#total_amount').val('');
$('#items_id').val('');
$('#items_guid').val('');
$("#parsley_reg").trigger('reset');
$('#deleted').remove();
$('#parent_items').append('<div id="deleted"></div>');
$('#newly_added').remove();
$('#parent_items').append('<div id="newly_added"></div>');
$("#parsley_reg #select_item").select2('data', {id:'',text: '<?php echo $this->lang->line('search').' '.$this->lang->line('item') ?>'});
    <?php if($this->session->userdata['item_kit_per']['add']==1){ ?>
             $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/item_kit/item_kit_number/",                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $('#parsley_reg #item_kit_number').val(data[0][0]['prefix']+data[0][0]['max']);
                                 $('#parsley_reg #demo_item_kit_number').val(data[0][0]['prefix']+data[0][0]['max']);
                             }
                             });
            
            
            
      $("#user_list").hide();
      $('#add_new_item_kit').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_item_kit').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#item_kit_lists').removeAttr("disabled");     
            window.setTimeout(function ()
       {

           $('#parsley_reg #select_item').select2('open');
       }, 500);
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_kit');?>', { type: "error" });                         
                    <?php }?>
}
    function posnic_item_kit_lists(){
        $('#edit_item_kit_form').hide('hide');
        $('#add_new_item_kit').hide('hide');      
        $("#user_list").show('slow');
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#deactive').removeAttr("disabled");
        $('#posnic_add_item_kit').removeAttr("disabled");
        $('#item_kit_lists').attr("disabled",'disabled');
    }
    function clear_add_item_kit(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
    }
    function clear_update_item_kit(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
        edit_function($('#guid').val());
    }
    function reload_update_user(){
        var id=$('#guid').val();
        items_function(id);
    }
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_item_kit" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>                       
                        <a href="javascript:item_kit_group_approve()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_item_kit_lists()" class="btn btn-default" id="item_kit_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('item_kit') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('item_kit/item_kit_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('item_kit') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                            <th>Id</th>
                                            <th ><?php echo $this->lang->line('select') ?></th>
                                            <th ><?php echo $this->lang->line('item_kit_id') ?></th>
                                            <th><?php echo $this->lang->line('item')." ".$this->lang->line('name') ?></th>
                                            <th><?php echo $this->lang->line('item_kit_date') ?></th>
                                            <th><?php echo $this->lang->line('no_of_type') ?></th>                                            
                                            
                                            <th><?php echo $this->lang->line('weight') ?></th>
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
    function new_item_kit_date(e){
        if($('#parsley_reg #items_guid').val()!=""){
            var unicode=e.charCode? e.charCode : e.keyCode
            if($('#parsley_reg #item_kit_date').value!=""){
                if (unicode!=13 && unicode!=9){
                }
                else{
                    $('#parsley_reg #item_kit_type').select2('open');
                }
                if (unicode!=27){
                }
                else{        
                    $('#parsley_reg #select_item').select2('open');
                }
            }
        }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Customer');?>', { type: "warning" }); 
            $('#parsley_reg #select_item').select2('open');
        }
    }
    
    function add_new_quty(e){
        if($('#parsley_reg #stock_id').val()!=""){
            var unicode=e.charCode? e.charCode : e.keyCode
            if($('#parsley_reg #quantity').value!=""){
                if (unicode!=13 && unicode!=9){
                }
                else{
                    copy_items()      ;
                }
                if (unicode!=27){
                }
                else{
                    $('#parsley_reg #select_item').select2('open');
                }
            }
        }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('item_kit_type');?>', { type: "warning" }); 
            $('#parsley_reg #select_item').select2('open');
        }
    }
    

    function net_amount(){     
        if(isNaN($('#parsley_reg #item_stock').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #item_stock').val())){
                $('#parsley_reg #item_stock').val(0);
            }else{
                $('#parsley_reg #quantity').val("");
            }
        }
        var quantity=$('#quantity').val();
        var stock=$('#item_stock').val();
        if( quantity> stock){
            $.bootstrapGrowl('<?php echo $this->lang->line('quantity_is_out_of_stock')?>', { type: "warning" });          
            $('#quantity').val($('#item_stock').val());
        }
    }
    function copy_items(){
        if( $('#parsley_reg #item_guid').val()!=""   && $('#parsley_reg #quantity').val()!=""){
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_guid').val())){
                var  item_kit_value=$('#parsley_reg #item_kit_value').val();
                var  quty=$('#parsley_reg #quantity').val();
                var  weight=$('#parsley_reg #item_stock').val();
                var stock_id=$('#parsley_reg #stock_id').val(); 
                var  price=$('#parsley_reg #price').val();
                var total=parseFloat(quty)*parseFloat(price);
                total=total.toFixed(point); 
                var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_total').val();
                var old_weight= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_weight').val();
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' td:nth-child(4)').html(weight);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' td:nth-child(5)').html(quty); 
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' td:nth-child(6)').html(price);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' td:nth-child(7)').html(total); 
                $('#newly_added #new_item_kit_price_'+item_kits_id).val(price);
                $('#newly_added #new_item_kit_weight_'+item_kits_id).val(weight);
                $('#newly_added #new_item_kit_total_'+item_kits_id).val(total);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_quty').val(quty);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_price').val(price);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_total').val(total);  
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_kit_guid').val()+' #item_kits_weight').val(weight);
                $.bootstrapGrowl($('#item_kit_type_val').val()+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
                if(total!=old_total){    
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    var total_weight=parseFloat($('#parsley_reg #total_item_weight').val())+parseFloat(weight)-parseFloat(old_weight)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val();
                    $('#parsley_reg #total_amount').val(amount)
                    $('#parsley_reg #total_item_weight').val(total_weight); 
                }
                $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                $('#parsley_reg #demo_total_item_weight').val($('#parsley_reg #total_item_weight').val()); 
                formula=eval(formula);
                var stock=(parseFloat(quty)*parseFloat(formula));        
                $('#current_stock_weight').val(parseFloat($('#current_stock_weight').val())-stock);
                clear_inputs();
            }else{
                var  item_guid=$('#parsley_reg #item_guid').val();
                var  quty=$('#parsley_reg #quantity').val();
                var  stock=$('#parsley_reg #item_stock').val();
                var stock_id=$('#parsley_reg #stock_id').val();
                var  code=$('#parsley_reg #sku').val();
                var total=parseFloat(quty)*parseFloat(price);
                total=total.toFixed(point);
                $('#newly_added').append('<div id="newly_added_item_kits_list_'+item_kits_id+'"> \n\
                \n\
                <input type="hidden" name="new_item_kit_id[]" value="'+item_kits_id+'"  id="new_item_kit_id_'+item_kits_id+'">\n\
                <input type="hidden" name="new_item_kit_weight[]" value="'+weight+'"  id="new_item_kit_weight_'+item_kits_id+'">\n\
                <input type="hidden" name="new_item_kit_quty[]" value="'+quty+'" id="new_item_kit_quty_'+item_kits_id+'"> \n\
                <input type="hidden" name="new_item_kit_formula[]" value="'+formula+'" id="new_item_kit_formula_'+item_kits_id+'"> \n\
                <input type="hidden" name="new_item_kit_price[]" value="'+price+'" id="new_item_kit_price_'+item_kits_id+'">\n\
                <input type="hidden" name="new_item_kit_total[]"  value="'+parseFloat(quty)*parseFloat(price)+'" id="new_item_kit_total_'+item_kits_id+'">\n\
                </div>');
                var addId = $('#selected_item_table').dataTable().fnAddData( [
                null,
                item_kit_value,
                formula,
                weight,
                quty,
                price,
                total,
                '<input type="hidden" name="index" id="index">\n\
                <input type="hidden" name="item_kits_value[]" id="item_kits_value" value="'+item_kit_value+'">\n\
                <input type="hidden" name="item_kits_type[]" id="item_kits_type" value="'+$('#item_kit_type_val').val()+'">\n\
                <input type="hidden" name="item_kits_id[]" id="item_kits_id" value="'+item_kits_id+'">\n\
                <input type="hidden" name="item_kits_weight[]" id="item_kits_weight" value="'+weight+'">\n\
                <input type="hidden" name="item_kits_quty[]" value="'+quty+'" id="item_kits_quty"> \n\
                <input type="hidden" name="item_kits_price[]" value="'+price+'" id="item_kits_price">\n\
                <input type="hidden" name="item_kits_formula[]" value="'+formula+'" id="item_kits_formula">\n\
                <input type="hidden" name="item_kits_total[]"  value="'+total+'" id="item_kits_total">\n\
                <a href=javascript:edit_item_kit_item("'+item_kits_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_item_kit_item('"+item_kits_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );
                var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                theNode.setAttribute('id','new_item_row_id_'+item_kits_id)
                $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #demo_total_amount").val())) 
                    $("#parsley_reg #demo_total_amount").val(0)    
                if($('#parsley_reg #total_amount').val()==0){
                    $('#parsley_reg #total_amount').val(total);     
                }else{
                    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total));
                }
                if($('#parsley_reg #total_item_weight').val()==0){
                    $('#parsley_reg #total_item_weight').val(weight);     
                }else{
                    $('#parsley_reg #total_item_weight').val(parseFloat($('#parsley_reg #total_item_weight').val())+parseFloat(weight));
                }
                $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                $('#parsley_reg #demo_total_item_weight').val($('#parsley_reg #total_item_weight').val());
                formula=eval(formula);
                var stock=(parseFloat(quty)*parseFloat(formula));        
                $('#current_stock_weight').val(parseFloat($('#current_stock_weight').val())-stock);
                clear_inputs();
            }  

        }else{
            if($('#parsley_reg #item_kit_guid').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_select')." ".$this->lang->line('item_kit_type') ;?>', { type: "warning" });          
                $('#parsley_reg #item_kit_type').select2('open');
            }
            else if($('#parsley_reg #quantity').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
                $('#parsley_reg #quantity').focus();
            }
            else if($('#parsley_reg #price').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('price');?>', { type: "warning" });          
                $('#parsley_reg #price').focus();
            }
            else{
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#parsley_reg #select_item').select2('open');
            }
        }   
    }
    function edit_item_kit_item(guid){
        clear_inputs();
        $('#parsley_reg #item_kit_value').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kit_value').val());
        $('#parsley_reg #demo_formula').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_formula').val());
        $('#parsley_reg #formula').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_formula').val());
        $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_quty').val());
        $('#parsley_reg #total_weight').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_weight').val());
        $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_price').val());   
        $('#parsley_reg #item_kit_guid').val(guid);
        $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #item_kits_total').val());
        $('#item_kit_type').select2('data', {id:guid,text: $('#selected_item_table #new_item_row_id_'+guid+' #item_kits_type').val()});
        var quty=$('#quantity').val();
        var formula=$('#formula').val();
        formula=eval(formula);
        var stock=parseFloat(quty)*parseFloat(formula);
        $('#current_stock_weight').val(parseFloat($('#current_stock_weight').val())+stock);
        $('#item_kit_type').select2('close');
        $('#quantity').focus();

    }
    
    function delete_item_kit_item(guid){
        var net=$('#selected_item_table #new_item_row_id_'+guid+' #item_kits_total').val(); 
        var total=$("#parsley_reg #total_amount").val();
        $("#parsley_reg #total_amount").val(parseFloat(total)-parseFloat(net));
        $("#parsley_reg #demo_total_amount").val(parseFloat(total)-parseFloat(net));
        var weight=$('#selected_item_table #new_item_row_id_'+guid+' #item_kits_weight').val(); 
        var total_weight=$("#parsley_reg #total_item_weight").val();
        $("#parsley_reg #total_item_weight").val(parseFloat(total_weight)-parseFloat(weight));
        $("#parsley_reg #demo_total_item_weight").val(parseFloat(total_weight)-parseFloat(weight));        
        var num = parseFloat($('#demo_total_amount').val());
        $('#demo_total_amount').val(num.toFixed(point));
        var num = parseFloat($('#total_amount').val());
        $('#total_amount').val(num.toFixed(point));    
        if($('#selected_item_table #new_item_row_id_'+guid+' #deco_guid').length>0){
            $('#deleted').append('<input type="text" id="r_items" name="r_items[]" value="'+$('#selected_item_table #new_item_row_id_'+guid+' #deco_guid').val()+'">');
        }
        var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
        var anSelected =  $("#selected_item_table").dataTable();
        anSelected.fnDeleteRow(index-1);
        if(document.getElementById('newly_added_items_list_'+guid)){
            $('#newly_added_items_list_'+guid).remove();
        }
        
    }
    function clear_inputs(){
      $('#parsley_reg #item_kit_guid').val('');
      $('#parsley_reg #formula').val('');
      $('#parsley_reg #demo_formula').val('');
      $('#parsley_reg #item_kit_value').val('');
      $('#parsley_reg #total').val('');
      $('#parsley_reg #price').val('');
      $('#parsley_reg #quantity').val('');
      $("#parsley_reg #item_kit_type").select2('data', {id:'',text: '<?php  echo $this->lang->line('search')." ".$this->lang->line('item_kit_type') ?>'});
      $('#parsley_reg #item_kit_type').select2('open');
    }


</script>

  
<section id="add_new_item_kit" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('item_kit/upadate_pos_item_kit_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="guid" id="guid" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('item_kit')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                              
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                              <label for="item_kit_number" ><?php echo $this->lang->line('code') ?></label>													
                                                                     <?php $item_kit_number=array('name'=>'demo_item_kit_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_item_kit_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('item_kit_number'));
                                                                         echo form_input($item_kit_number)?>
                                                            <input type="hidden" name="item_kit_number" id="item_kit_number">
                                               </div>
                                               </div>
                                              
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="item_kit_name" ><?php echo $this->lang->line('item_kit_name') ?></label>													
                                                                     <?php $item_kit_name=array('name'=>'item_kit_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'item_kit_name',
                                                                                        'value'=>set_value('item_kit_name'));
                                                                         echo form_input($item_kit_name)?>
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="category" ><?php echo $this->lang->line('category') ?></label>													
                                                                     <?php $category=array('name'=>'category',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'category',
                                                                                        'value'=>set_value('category'));
                                                                         echo form_input($category)?>
                                                            <input type="hidden" name="category_id" id="category_id">
                                                       </div>
                                               </div>
                                               
                                               
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="item_kit_date" ><?php echo $this->lang->line('item_kit_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $item_kit_date=array('name'=>'item_kit_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'item_kit_date',
                                                                                          'onKeyPress'=>"new_item_kit_date(event)", 
                                                                                            'value'=>set_value('item_kit_date'));
                                                                             echo form_input($item_kit_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
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
                                             
                                                   
                                             <label for="items" class="text-center" ><?php echo $this->lang->line('item') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $select_item=array('name'=>'select_item',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'select_item',
                                                                                    'value'=>set_value('select_item'));
                                                                     echo form_input($select_item)?>
                                                  </div>
                                         
                                             <input type="text" name="item_stock" id="item_stock">
                                             <input type="text" name="stock_id" id="stock_id">
                                             <input type="text" name="item_guid" id="item_guid">
                                             <input type="hidden" name="price" id="price">
                                                    
                                                        </div>
                                                
                                                 
                                                 <div class="col col-lg-1" style="padding:1px;width: 160px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('sku') ?></label>

                                                                 <?php $sku=array('name'=>'sku',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'sku', 
                                                                                            'disabled'=>"disabled",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($sku)?>
                                                               
                                                        </div>
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
                                            <h4 class="panel-title"><?php echo $this->lang->line('item_kit_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table table-striped dataTable ">
                                    <thead>
                                        <tr>
                                            
                                     <th><?php echo $this->lang->line('no') ?></th>
                                    <th><?php echo $this->lang->line('item_kit_type') ?></th>
                                    <th><?php echo $this->lang->line('formula') ?></th>
                                    <th><?php echo $this->lang->line('weight') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>                                  
                                    <th><?php echo $this->lang->line('price') ?></th>
                                 
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="new_item_kit_items" >
                                       
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
                    
                    </div><div class="col col-sm-3" ">
                       
                        <div class="row" style="margin-left: 5px">
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount')." & ".$this->lang->line('weight') ?></h4>                                                                               
                              </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_item_weight" ><?php echo $this->lang->line('total_weight') ?></label>													
                                                                  <?php $total_item_weight=array('name'=>'demo_total_item_weight',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'demo_total_item_weight',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_item_weight'));
                                                                     echo form_input($total_item_weight)?>
                                                        
                                                  </div> <input type="hidden" name="total_item_weight" id="total_item_weight">
                                                         
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
                                                         <br>
                                                  </div>
                                               </div>
                        <div class="row" style="margin-left: 5px">
                                          <div class="col col-sm-6"  >
                                              <div class="form_sep " id="save_button" style="padding-left:0px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:save_new_item_kit()" class="btn btn-default"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_item_kit()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-6"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_item_kit()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_item_kit()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
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
            <?php if($this->session->userdata['item_kit_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('paruchase_item_kit');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                           
                          if(posnic[i].checked==true){ 
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/item_kit/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                  complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                           $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('goods_receiving_note') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }else if(response['responseText']=='Approved'){
                                         $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
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
                                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
                           <?php }
                        ?>
                      }
                    
                    
                    
    function item_kit_group_approve(){
         <?php if($this->session->userdata['item_kit_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item_kit');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                           var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/item_kit/item_kit_approve',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                     complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                               $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('item_kit') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }else if(response['responseText']=='Approved'){
                                             $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                        }else{
                                              $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('item_kit');?>', { type: "error" });                        
                                        }
                                        }
                                });

                          }

                      }
                  

                      }   
                        <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
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
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item_kit');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>index.php/item_kit/item_deactive',
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
        

      