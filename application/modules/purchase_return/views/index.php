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
  
   .supplier_select{
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
  #selected_item_table  tr td:nth-child(7)  {
  width: 100px !important;
}
  #selected_item_table  tr td:nth-child(8)  {
  width: 150px !important;
}
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39  && unicode!=40 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function save_new_order(){
         <?php if($this->session->userdata['purchase_return_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_return/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_return').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_return_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_return');?>', { type: "error" });                           
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
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
                    <?php }?>
    }
    function update_order(){
         <?php if($this->session->userdata['purchase_return_per']['edit']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_return/update')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_return').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_return_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_return');?>', { type: "error" });                           
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
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
                    <?php }?>
    }
    
    $(document).ready( function () {
        $('#parsley_reg #purchase_invoice').change(function() {
            $('#parsley_reg #item_name').val('');
            $('#parsley_reg #sku').val('');
            $('#parsley_reg #quantity').val('');
            $('#parsley_reg #total').val('');
            $('#parsley_reg #cost').val('');
            $('#parsley_reg #tax').val('');
            $('#parsley_reg #tax_value').val('');
            $('#parsley_reg #tax_type').val('');
            $('#parsley_reg #tax_Inclusive').val('');
            $('#parsley_reg #tax_value2').val('');
            $('#parsley_reg #tax_type2').val('');
            $('#parsley_reg #tax_Inclusive2').val('');
            $('#parsley_reg #item_id').val('');
            $('#parsley_reg #delivered_quty').val('');
            $('#parsley_reg #discount1').val('');
            $('#parsley_reg #discount_amount').val('');
            $('#parsley_reg #discount2').val('');
            $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
            $("#parsley_reg #items").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('items') ?>'});
            $("#parsley_reg #first_name").val('');
            refresh_items_table();
            var guid = $('#parsley_reg #purchase_invoice').select2('data').id;
            $('#parsley_reg #customer').val($('#parsley_reg #purchase_invoice').select2('data').name);
            $('#parsley_reg #sales_date').val($('#parsley_reg #purchase_invoice').select2('data').date);
            $('#parsley_reg #purchase_invoice_id').val(guid);
            
            window.setTimeout(function ()
            { 
                document.getElementById('order_date').focus();
            }, 0);  
             
        });
        function format_branch(sup) {
            if (!sup.id) return sup.text;
                return  "<p >"+sup.text+"    <br>"+sup.name+"   "+sup.company+"</p> ";
        }
        $('#parsley_reg #purchase_invoice').select2({
            dropdownCssClass : 'customers_select',
            formatResult: format_branch,
            formatSelection: format_branch,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('invoice') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/purchase_return/search_purchase_invoice',
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
                            text: item.invoice,
                            name: item.first_name,
                            company: item.company_name,
                            date: item.date,                         
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });
        $('#parsley_reg #items').change(function() {
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #items').select2('data').item) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #items').select2('data').item){
                $.bootstrapGrowl('<?php echo $this->lang->line('this item already added').$this->lang->line('purchase_return');?> ', { type: "warning" });  
                $('#parsley_reg #items').select2('open');
            }else{
                var guid = $('#parsley_reg #items').select2('data').item;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                $('#parsley_reg #cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #delivered_quty').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #stock').val($('#parsley_reg #items').select2('data').stocks_history);
                $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type);
                $('#parsley_reg #tax_Inclusive').val($('#parsley_reg #items').select2('data').tax_Inclusive);
                $('#parsley_reg #tax_value2').val($('#parsley_reg #items').select2('data').tax2_value);
                $('#parsley_reg #tax_type2').val($('#parsley_reg #items').select2('data').tax2_type);
                $('#parsley_reg #tax_Inclusive2').val($('#parsley_reg #items').select2('data').tax2_Inclusive);
                $('#parsley_reg #discount1').val($('#parsley_reg #items').select2('data').discount1);
                $('#parsley_reg #discount2').val($('#parsley_reg #items').select2('data').discount2);
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {
                    $('#parsley_reg #quantity').focus();
                }, 0);
            }
        });
        function format_item(sup) {
            if (!sup.id) return sup.text;             
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('cost') ?> : "+sup.cost+" <?php echo ' '.$this->lang->line('received_stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
        }
        $('#parsley_reg #items').select2({             
            dropdownCssClass : 'item_select',
            formatResult: format_item,
            formatSelection: format_item,           
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/purchase_return/search_items/',
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
                        invoice:$('#parsley_reg #purchase_invoice_id').val()                               
                    };
                },
                results: function (data) {
                    var results = [];                  
                    $.each(data, function(index, item){
                        results.push({
                            id: item.i_guid+item.cost,
                            item: item.i_guid,
                            sid: item.guid,
                            text: item.name,
                            value: item.code,
                            image: item.image,
                            brand: item.b_name,
                            category: item.c_name,
                            department: item.d_name,
                            quty: item.quty,
                            cost: item.cost,
                            tax_type: item.tax_type_name,
                            tax_value: item.tax_value,
                            tax_Inclusive : item.tax_Inclusive ,
                            stocks_history : item.stocks_history ,
                            tax2_type: item.tax2_type,
                            tax2_value: item.tax2_value,
                            tax2_Inclusive : item.tax_inclusive2 ,
                            discount1 : item.dis_per ,
                            discount2 : item.dis_per2 ,                         
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
        $("#parsley_reg #purchase_invoice").select2('enable');
        $('#items_id').val('');
        $('#supplier_guid').val('');
        $("#parsley_reg").trigger('reset');
        $('#deleted').remove();
        $('#parent_items').append('<div id="deleted"></div>');
        $('#newly_added').remove();
        $('#parent_items').append('<div id="newly_added"></div>');
        $("#parsley_reg #first_name").val('');
        <?php 
        if($this->session->userdata['purchase_return_per']['add']==1){ ?>
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/purchase_return/order_number/",                      
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
            $('#posnic_add_purchase_return').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#purchase_return_lists').removeAttr("disabled");
            window.setTimeout(function ()
            {
                $('#parsley_reg #purchase_invoice').select2('open');
            }, 500);
          <?php           
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_return');?>', { type: "error" });                         
        <?php         
        }?>
    }
    function posnic_purchase_return_lists(){
        $('#add_new_order').hide('hide');      
        $("#user_list").show('slow');
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#posnic_add_purchase_return').removeAttr("disabled");
        $('#purchase_return_lists').attr("disabled",'disabled');
    }
    function clear_add_purchase_return(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
    }
    function clear_update_purchase_return(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
        edit_function($('#purchase_return_guid').val());
    }
    function reload_update_user(){
        var id=$('#guid').val();
        supplier_function(id);
    }
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_purchase_return" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                     
                        <a href="javascript:purchase_return_group_approve()" class="btn btn-default" id="active"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_purchase_return_lists()" class="btn btn-default" id="purchase_return_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('purchase_return') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('purchase_return/purchase_return_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('purchase_return') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('purchase_return_id') ?></th>
                                          
                                          <th><?php echo $this->lang->line('date') ?></th>
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
  


    function add_new_quty(e){
        if($('#parsley_reg #item_id').val()!=""){
            var unicode=e.charCode? e.charCode : e.keyCode
            if($('#parsley_reg #quantity').value!=""){        
                if (unicode!=13 && unicode!=9){
                }
                else{
                copy_items();         
                }
                if (unicode!=9){
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
        if(isNaN($('#parsley_reg #cost').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #cost').val())){
                $('#parsley_reg #cost').val(0);
            }else{
                $('#parsley_reg #quantity').val(0);
            }
        }else{
            if(parseFloat($('#parsley_reg #quantity').val())>parseFloat($('#parsley_reg #delivered_quty').val()) && $('#parsley_reg #delivered_quty').val()!=0){
                $('#parsley_reg #quantity').val($('#parsley_reg #delivered_quty').val()); 
                $.bootstrapGrowl('<?php echo $this->lang->line('not_able_to_return');?> '+' '+$('#parsley_reg #item_name').val(), { type: "warning" }); 
            }    
            var cost=parseFloat($('#parsley_reg #cost').val());
            var quantity=parseFloat($('#parsley_reg #quantity').val());
            var tax_value1=parseFloat($('#parsley_reg #tax_value').val());
            var tax_value2=parseFloat($('#parsley_reg #tax_value2').val());
            var tax_inclusive1=parseFloat($('#parsley_reg #tax_Inclusive').val());
            var tax_inclusive2=parseFloat($('#parsley_reg #tax_Inclusive2').val());
            var discount1=parseFloat($('#parsley_reg #discount1').val());
            var discount2=parseFloat($('#parsley_reg #discount2').val());
            var total=parseFloat(quantity)*parseFloat(cost);
            var sub_total=parseFloat(quantity)*parseFloat(cost);
            var total_tax=0;
            var tax1=0;
            if(tax_inclusive1==0){
                tax1=sub_total*parseFloat(tax_value1)/100;
                total=parseFloat(tax1)+parseFloat(sub_total);
                total_tax=parseFloat(total_tax)+parseFloat(tax1);
            }
            var tax2=0;
            if(tax_inclusive1==0){
                tax2=sub_total*parseFloat(tax_value2)/100;
                total=parseFloat(tax2)+parseFloat(total);
                total_tax=parseFloat(total_tax)+parseFloat(tax2);
            }
            var discount_amount1=0;
            var discount_amount2=0;
            if(discount1!=0 && discount1!=""){
                discount_amount1=parseFloat(total)*parseFloat(discount1)/100;
            }
            if(discount2!=0 && discount2!=""){
                discount_amount2=parseFloat(total-discount_amount1)*parseFloat(discount2)/100;
            }
            total=parseFloat(total)-(parseFloat(discount_amount2)+parseFloat(discount_amount1));
            var type='Inc';
            if(total_tax!=0){
                var num = parseFloat(total_tax);
                total_tax=num.toFixed(point);
                type='Exc';
            }else{
                total_tax=parseFloat(tax1)+parseFloat(tax2);
                var num = parseFloat(total_tax);
                total_tax=num.toFixed(point);
            }
            $('#tax_label').text('<?php  echo $this->lang->line('tax') ?>('+type+')');
            $('#tax').val(total_tax);
            var total_discount=parseFloat(discount_amount2)+parseFloat(discount_amount1);
            $('#discount_amount').val(total_discount.toFixed(point)); 
            var num = parseFloat(total);
            $('#total').val(num.toFixed(point)); 
        }
    }
    function copy_items(){
        if($('#parsley_reg #item_id').val()!=""  && $('#parsley_reg #cost').val()!=""  && $('#parsley_reg #quantity').val()!=""){
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_id').val())){
               var name=$('#parsley_reg #item_name').val();
                var sku=$('#parsley_reg #sku').val();
                var quty=$('#parsley_reg #quantity').val();
               
                var cost=$('#parsley_reg #cost').val();
                var items_id=$('#parsley_reg #item_id').val();
                var limit=$('#parsley_reg #delivered_quty').val();
                var stocks_history=$('#parsley_reg #stock').val();
                var tax_value=$('#parsley_reg #tax_value').val();
                var tax_type=$('#parsley_reg #tax_type').val();
                var tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                var tax_value2=$('#parsley_reg #tax_value2').val();
                var tax_type2=$('#parsley_reg #tax_type2').val();
                var tax_Inclusive2=$('#parsley_reg #tax_Inclusive2').val();
                var quantity=$('#parsley_reg #quantity').val();
                var discount1=parseFloat($('#parsley_reg #discount1').val());
                var discount2=parseFloat($('#parsley_reg #discount2').val());
                var total=parseFloat(quantity)*parseFloat(cost);
                var sub_total=parseFloat(quantity)*parseFloat(cost);
                var tax1=0;
                var type1='IInc';
                if(tax_Inclusive==0){
                    tax1=sub_total*parseFloat(tax_value)/100;
                    total=parseFloat(tax1)+parseFloat(sub_total);
                    type1='Exc';
                }
                var tax2=0;
                var type2='IInc';
                if(tax_Inclusive2==0){
                    tax2=sub_total*parseFloat(tax_value2)/100;
                    total=parseFloat(tax2)+parseFloat(total);
                    type2='Exc';
                }
                var discount_amount1=0;
                var discount_amount2=0;
                if(discount1!=0 && discount1!=""){
                    discount_amount1=parseFloat(total)*parseFloat(discount1)/100;
                }
                if(discount2!=0 && discount2!=""){
                    discount_amount2=parseFloat(total-discount_amount1)*parseFloat(discount2)/100;
                }
                var total_discount=parseFloat(discount_amount2)+parseFloat(discount_amount1)
                total=parseFloat(total)-(total_discount);
                var num = parseFloat(total_discount);
                total_discount=num.toFixed(point);
                var num = parseFloat(total);
                total=num.toFixed(point);
                var num = parseFloat(tax1);
                tax1=num.toFixed(point);
                var num = parseFloat(tax2);
                tax2=num.toFixed(point);
                var num = parseFloat(sub_total);
                sub_total=num.toFixed(point);
                var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val();
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(4)').html(quty);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(5)').html(cost);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(6)').html(sub_total);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(7)').html(tax1+''+':'+tax_type+'('+type1+')');
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(8)').html(tax2+''+':'+tax_type2+'('+type2+')');
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(9)').html(total_discount);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(10)').html(total);
                $('#newly_added #new_item_id_'+items_id).val(items_id);
                $('#newly_added #new_item_quty_'+items_id).val(quty);
                $('#newly_added #new_item_cost_'+items_id).val(cost);
                $('#newly_added #new_item_tax1_'+items_id).val(tax1);
                $('#newly_added #new_item_tax2_'+items_id).val(tax2);
                $('#newly_added #new_item_discount_amount1_'+items_id).val(discount_amount1);
                $('#newly_added #new_item_discount_amount2_'+items_id).val(discount_amount2);
                $('#newly_added #new_item_total'+items_id).val(total);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_id').val(items_id);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_name').val(name);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sku').val(sku);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_quty').val(quty);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_cost').val(cost);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax').val(tax1);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax2').val(tax2);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount_amount1').val(discount_amount1);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount_amount2').val(discount_amount2);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val(total);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sub_total').val(sub_total);
                $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #total_amount").val())) 
                    $("#parsley_reg #total_amount").val(0)  ;
                if (isNaN($("#parsley_reg #demo_total_amount").val())) 
                    $("#parsley_reg #demo_total_amount").val(0);
                if($('#parsley_reg #total_amount').val()==0){
                    $('#parsley_reg #total_amount').val(total-parseFloat(old_total));
                }else{
                    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())-parseFloat(old_total)+parseFloat(total));
                }
                $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                clear_inputs();
            }else{
                var name=$('#parsley_reg #item_name').val();
                var sku=$('#parsley_reg #sku').val();
                var quty=$('#parsley_reg #quantity').val();
               
                var cost=$('#parsley_reg #cost').val();
                var items_id=$('#parsley_reg #item_id').val();
                var limit=$('#parsley_reg #delivered_quty').val();
                var stocks_history=$('#parsley_reg #stock').val();
                var tax_value=$('#parsley_reg #tax_value').val();
                var tax_type=$('#parsley_reg #tax_type').val();
                var tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                var tax_value2=$('#parsley_reg #tax_value2').val();
                var tax_type2=$('#parsley_reg #tax_type2').val();
                var tax_Inclusive2=$('#parsley_reg #tax_Inclusive2').val();
                var quantity=$('#parsley_reg #quantity').val();
                var discount1=parseFloat($('#parsley_reg #discount1').val());
                var discount2=parseFloat($('#parsley_reg #discount2').val());
                var total=parseFloat(quantity)*parseFloat(cost);
                var sub_total=parseFloat(quantity)*parseFloat(cost);
                var tax1=0;
                var type1='IInc';
                if(tax_Inclusive==0){
                    tax1=sub_total*parseFloat(tax_value)/100;
                    total=parseFloat(tax1)+parseFloat(sub_total);
                    type1='Exc';
                }
                var tax2=0;
                var type2='IInc';
                if(tax_Inclusive2==0){
                    tax2=sub_total*parseFloat(tax_value2)/100;
                    total=parseFloat(tax2)+parseFloat(total);
                    type2='Exc';
                }
                var discount_amount1=0;
                var discount_amount2=0;
                if(discount1!=0 && discount1!=""){
                    discount_amount1=parseFloat(total)*parseFloat(discount1)/100;
                }
                if(discount2!=0 && discount2!=""){
                    discount_amount2=parseFloat(total-discount_amount1)*parseFloat(discount2)/100;
                }
                var total_discount=parseFloat(discount_amount2)+parseFloat(discount_amount1)
                total=parseFloat(total)-(total_discount);
                var num = parseFloat(total_discount);
                total_discount=num.toFixed(point);
                var num = parseFloat(total);
                total=num.toFixed(point);
                var num = parseFloat(tax1);
                tax1=num.toFixed(point);
                var num = parseFloat(tax2);
                tax2=num.toFixed(point);
                var num = parseFloat(sub_total);
                sub_total=num.toFixed(point);
                $('#newly_added').append('<div id="newly_added_items_list_'+items_id+'"> \n\
                \n\
                <input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+items_id+'">\n\
                <input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+items_id+'"> \n\
                <input type="hidden" name="new_item_cost[]" value="'+cost+'" id="new_item_cost_'+items_id+'">\n\
                <input type="hidden" name="new_item_tax[]" value="'+tax1+'" id="new_item_tax1_'+items_id+'">\n\
                <input type="hidden" name="new_item_tax2[]" value="'+tax2+'" id="new_item_tax2_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount1[]" value="'+discount1+'" id="new_item_discount1_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount2[]" value="'+discount2+'" id="new_item_discount2_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount_amount1[]" value="'+discount_amount1+'" id="new_item_discount_amount1_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount_amount2[]" value="'+discount_amount2+'" id="new_item_discount_amount2_'+items_id+'">\n\
                <input type="hidden" name="new_item_total[]"  value="'+parseFloat(quty)*parseFloat(cost)+'" id="new_item_total_'+items_id+'">\n\
                </div>');


                var addId = $('#selected_item_table').dataTable().fnAddData( [
                    null,
                    name,
                    sku,
                    quty,
                    cost,
                    sub_total,
                    tax1+':'+tax_type+'('+type1+')',
                    tax2+':'+tax_type2+'('+type2+')',
                    total_discount,
                    total,
                    '<input type="hidden" name="index" id="index">\n\
                    <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                    <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                    <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                    <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                    <input type="hidden" name="item_stocks_history[]" id="item_stocks_history" value="'+stocks_history+'">\n\
                    <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty">\n\
                    <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost">\n\
                    <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                    <input type="hidden" name="items_discount1[]" value="'+discount1+'" id="items_discount1">\n\
                    <input type="hidden" name="items_discount2[]" value="'+discount2+'" id="items_discount2">\n\
                    <input type="hidden" name="items_discount_amount1[]" value="'+discount_amount1+'" id="items_discount1">\n\
                    <input type="hidden" name="items_discount_amount2[]" value="'+discount_amount1+'" id="items_discount2">\n\
                    <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                    <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                    <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                    <input type="hidden" name="items_tax[]" value="'+tax2+'" id="items_tax2">\n\
                    <input type="hidden" name="items_tax_type[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                    <input type="hidden" name="items_tax_value[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                    <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive2+'" id="items_tax_inclusive2">\n\
                    <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                    <a href=javascript:edit_order_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );
                var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                theNode.setAttribute('id','new_item_row_id_'+items_id)
                $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #total_amount").val())) 
                    $("#parsley_reg #total_amount").val(0)    
                if (isNaN($("#parsley_reg #demo_total_amount").val())) 
                    $("#parsley_reg #demo_total_amount").val(0)
                if($('#parsley_reg #total_amount').val()==0){
                    $('#parsley_reg #total_amount').val(total);
                }else{
                    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total));
                }
                $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                clear_inputs();
            }  
        }else{
            if($('#parsley_reg #item_id').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#parsley_reg #items').select2('open');
            }
            else if($('#parsley_reg #quantity').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
                $('#parsley_reg #quantity').focus();
            }else if($('#parsley_reg #cost').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('cost');?>', { type: "warning" });          
                $('#parsley_reg #cost').focus();
            }
            else{
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#parsley_reg #items').select2('open');
            }
            
        }
        var num = parseFloat($('#demo_total_amount').val());
        $('#demo_total_amount').val(num.toFixed(point));
        var num = parseFloat($('#total_amount').val());
        $('#total_amount').val(num.toFixed(point));
        if (isNaN($("#parsley_reg #total_amount").val())) 
            $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
            $("#parsley_reg #demo_total_amount").val(0)
    }
    function edit_order_item(guid){
        $('#parsley_reg #item_name').val($('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val());
        $('#parsley_reg #sku').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sku').val());
        $('#parsley_reg #delivered_quty').val($('#selected_item_table #new_item_row_id_'+guid+' #item_limit').val());
        $('#parsley_reg #stock').val($('#selected_item_table #new_item_row_id_'+guid+' #item_stocks_history').val());
        $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
        $('#parsley_reg #cost').val($('#selected_item_table #new_item_row_id_'+guid+' #items_cost').val());
        $('#parsley_reg #tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax').val());
        $('#parsley_reg #tax_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type').val());
        $('#parsley_reg #tax_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val());
        $('#parsley_reg #tax_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val());
        $('#parsley_reg #tax_type2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type2').val());
        $('#parsley_reg #tax_value2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value2').val());
        $('#parsley_reg #tax_Inclusive2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive2').val());
        $('#parsley_reg #discount1').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount1').val());
        $('#parsley_reg #discount2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#parsley_reg #item_id').val(guid);
        $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_total').val());
        net_amount();
        $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });
    }
    function delete_order_item(guid){
        var net=$('#selected_item_table #new_item_row_id_'+guid+' #items_total').val();
        var total=$("#parsley_reg #total_amount").val();
        $("#parsley_reg #total_amount").val(parseFloat(total)-parseFloat(net));
        $("#parsley_reg #demo_total_amount").val(parseFloat(total)-parseFloat(net));
        var num = parseFloat($('#demo_total_amount').val());
        $('#demo_total_amount').val(num.toFixed(point));
        var num = parseFloat($('#total_amount').val());
        $('#total_amount').val(num.toFixed(point));

        $("#parsley_reg #total_amount").val()
        var order=$('#selected_item_table #new_item_row_id_'+guid+' #items_order_guid').val();
        $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+order+'">');
        var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
        var anSelected =  $("#selected_item_table").dataTable();
        anSelected.fnDeleteRow(index-1);
        if(document.getElementById('newly_added_items_list_'+guid)){
            $('#newly_added_items_list_'+guid).remove();
        }
    }
    function clear_inputs(){
        $('#parsley_reg #item_name').val('');
        $('#parsley_reg #sku').val('');
        $('#parsley_reg #quantity').val('');
        $('#parsley_reg #total').val('');
        $('#parsley_reg #cost').val('');
        $('#parsley_reg #tax').val('');
        $('#parsley_reg #tax_value').val('');
        $('#parsley_reg #tax_type').val('');
        $('#parsley_reg #tax_Inclusive').val('');
        $('#parsley_reg #tax_value2').val('');
        $('#parsley_reg #tax_type2').val('');
        $('#parsley_reg #tax_Inclusive2').val('');
        $('#parsley_reg #item_id').val('');
        $('#parsley_reg #delivered_quty').val('');
        $('#parsley_reg #discount1').val('');
        $('#parsley_reg #discount_amount').val('');
        $('#parsley_reg #discount2').val('');
        $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
        $("#parsley_reg #items").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('items') ?>'});
        $("#parsley_reg #first_name").val('');
        $('#parsley_reg #items').select2('open');
        window.setTimeout(function ()
        {
            $('#parsley_reg #tax').val('');
        }, 100); 
    }
  

</script>

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('purchase_return/upadate_pos_purchase_return_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
      
   
        <input type="hidden" name="purchase_return_guid" id="purchase_return_guid" >
                        
                         
                      <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('purchase_return')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep" >
                                                            <label for="purchase_invoice" ><?php echo $this->lang->line('purchase_invoice') ?></label>													
                                                                     <?php $purchase_invoice=array('name'=>'purchase_invoice',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'purchase_invoice',
                                                                                       
                                                                                        'value'=>set_value('purchase_invoice'));
                                                                         echo form_input($purchase_invoice)?>
                                                            <input type="hidden" name="purchase_invoice_id" id="purchase_invoice_id">
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep" >
                                                            <label for="customer" ><?php echo $this->lang->line('customer') ?></label>													
                                                                     <?php $customer=array('name'=>'customer',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'customer',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer'));
                                                                         echo form_input($customer)?>
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep" >
                                                            <label for="sales_date" ><?php echo $this->lang->line('sales')." ".$this->lang->line('date') ?></label>													
                                                                     <?php $sales_date=array('name'=>'sales_date',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'sales_date',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('sales_date'));
                                                                         echo form_input($sales_date)?>
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep" >
                                                            <label for="order_number" ><?php echo $this->lang->line('purchase_return_id') ?></label>													
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
                                                   <div class="form_sep ">
                                                     <label for="order_date" ><?php echo $this->lang->line('date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $order_date=array('name'=>'order_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'order_date',
                                                                                         
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($order_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                               </div>
                                             
                                               <div class="col col-sm-2" >
                                                      <div class="form_sep ">
                                                        <label for="total_amount" ><?php echo $this->lang->line('total_amount') ?></label>													
                                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_total_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_amount'));
                                                                     echo form_input($total_amount)?>
                                                        <input type="hidden" name="total_amount" id="total_amount">
                                                        
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
                                 
                                  
                                                <div class="col col-sm-1" style="padding:1px; width: 160px;">
                                             
                                                   
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
                                                    <input type="hidden" name="tax_type2" id="tax_type2">
                                                    <input type="hidden" name="tax_Inclusive2" id="tax_Inclusive2">                                                 
                                                    <input type="hidden" name="tax_value2" id="tax_value2">
                                                    <input type="hidden" name="discount1" id="discount1">
                                                    <input type="hidden" name="discount2" id="discount2">
                                                    <input type="hidden" name="item_name" id="item_name">
                                                    <input type="hidden" name="sku" id="sku">
                                                    <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                    <input type="hidden" name="delivered_quty" id="delivered_quty">
                                                    <input type="hidden" name="stock" id="stock">
                                                        </div>
                                                
                                                 <div class="col col-lg-1" style="padding:1px;width: 120px;">
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
                                                
                                                 
                                                
                                                     
                                              
                                                    <div class="col col-lg-1" style="padding:1px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="cost" class="text-center" ><?php echo $this->lang->line('cost') ?></label>

                                                                 <?php $cost=array('name'=>'cost',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'cost',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('cost'));
                                                                             echo form_input($cost)?>
                                                        </div>
                                                        </div>
                                          
                                                
                                  
                                            
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;">
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
                               
                                                          <div class="col col-lg-1" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="discount_amount" class="text-center"  ><?php echo $this->lang->line('discount') ?></label>

                                                                 <?php $discount_amount=array('name'=>'discount_amount',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'discount_amount',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('discount_amount'));
                                                                             echo form_input($discount_amount)?>
                                                        </div>
                                                    </div>
                               
                                               
                                                
                                                <div class="col col-lg-1" style="padding:1px;width: 125px;">
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
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('sub_total') ?></th>
                                 
                                    <th><?php echo $this->lang->line('tax') ?> 1</th>
                                    <th><?php echo $this->lang->line('tax') ?> 2</th>
                                    <th><?php echo $this->lang->line('discount') ?> </th>
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
                         
                             
                                 
                                       <div id="" class="col col-lg-6" style="padding-right: 0px;padding-left: 0px">
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
                                <div class="col col-sm-6" style="padding-right: 0">
                                      <div class="row">
                                          <div class="col col-sm-3" style="padding-top: 50px" >
                                              <div class="form_sep " id="save_button" style="padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:save_new_order()" class="btn btn-default"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_order()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-3" style="padding-top: 50px"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_purchase_return()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_purchase_return()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                               </div>
                                         
                                               
                                               
                                      </div>
                                  </div>
                             
                          
                          </div>
                                <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
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
            <?php if($this->session->userdata['purchase_return_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('purchase_return');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('purchase_return') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                           
                          if(posnic[i].checked==true){ 
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/purchase_return/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                  complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_return') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }else if(response['responseText']=='Approved'){
                                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                    }else{
                                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_return');?>', { type: "error" });                       
                                    }
                                    }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      <?php }else{?>
                                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('purchase_return');?>', { type: "error" });                       
                           <?php }
                        ?>
                      }
                    
                    
                    
    function purchase_return_group_approve(){
         <?php if($this->session->userdata['purchase_return_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('purchase_return');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                           var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/purchase_return/purchase_return_approve',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                     complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                               $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_return') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }else if(response['responseText']=='Approved'){
                                             $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                        }else{
                                              $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('purchase_return');?>', { type: "error" });                        
                                        }
                                        }
                                });

                          }

                      }
                  

                      }   
                        <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_return');?>', { type: "error" });                       
                            <?php }
                         ?>
                      }
                   
                    
                </script>
        

      