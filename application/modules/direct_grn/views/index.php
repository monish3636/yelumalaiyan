<style type="text/css">
     .modal-backdrop {background: none;}
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
    table {
        width: 100% !important;
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
    
      #dt_table_tools  tr th:nth-child(9),#dt_table_tools tr td:nth-child(9){
      width: 170px;
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
    #i_dis_amt2{
        display: block !important;
    }
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9 && unicode!=2228233){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function get_table_data(){
        $('#selected_item_table').dataTable({
                     "bProcessing": true,
                     "bDestroy": true ,
                     "bPaginate": false,
        });
    }
    function save_new_order(){
        <?php
        if($this->session->userdata['direct_grn_per']['add']==1){ ?>
            if($('#parsley_reg').valid()){
                var oTable = $('#selected_item_table').dataTable();
                if(oTable.fnGetData().length>0){
                    get_table_data();
                    var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/direct_grn/save')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('direct_grn').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_direct_grn_lists();
                                refresh_items_table();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_grn');?>', { type: "error" });                           
                            }
                        }
                    });
                }else{                  
                    $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                    $('#parsley_reg #items').select2('open');
                }
            }else{
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
            }<?php 
            
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
        <?php
        }?>
    }
    function update_order(){
        <?php
        if($this->session->userdata['direct_grn_per']['edit']==1){ ?>
            if($('#parsley_reg').valid()){
                var oTable = $('#selected_item_table').dataTable();
                if(oTable.fnGetData().length>0){
                get_table_data();
                var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/direct_grn/update')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('direct_grn').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_direct_grn_lists();
                                refresh_items_table();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_grn');?>', { type: "error" });                           
                            }
                        }
                    });
                }else{
                    $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                    $('#parsley_reg #items').select2('open');
                }
            }else{
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
            }<?php 
            
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
            <?php                     
        }?>
    }
    
    $(document).ready( function () {
           $('.editableform #i_dis_amt2').attr("disabled",'disabled');
           $('.editableform #i_dis_amt2').attr("disabled",'disabled');
        $('#parsley_reg #items').change(function() {
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #items').select2('data').id) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #items').select2('data').id){
                $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #first_name').val(), { type: "warning" });  
                $('#parsley_reg #items').select2('open');
            }else{
                var guid = $('#parsley_reg #items').select2('data').id;                                  
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                $('#parsley_reg #cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #price').val($('#parsley_reg #items').select2('data').price);
                $('#parsley_reg #mrp').val($('#parsley_reg #items').select2('data').mrp);
                $('#parsley_reg #supplier_quty').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type);
                $('#parsley_reg #tax_Inclusive').val($('#parsley_reg #items').select2('data').tax_Inclusive);
                $('#parsley_reg #tax2_value').val($('#parsley_reg #items').select2('data').tax2_value);
                $('#parsley_reg #tax2_type').val($('#parsley_reg #items').select2('data').tax2_type);
                $('#parsley_reg #tax2_Inclusive').val($('#parsley_reg #items').select2('data').tax2_Inclusive);                
                var tax=$('#parsley_reg #items').select2('data').tax_Inclusive;
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }
                if(isNaN($('#parsley_reg #tax_value').val())){
                    $('#parsley_reg #tax_value').val(0);
                    $('#parsley_reg #tax').val(0);
                }
                disacount_and_amount_editable();
                $('#i_discount').val('0');
                $('#i_dis_amt').text('0');               
                net_amount();
                free_and_discount_input();
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {
                    $('#parsley_reg #quantity').focus();
                }, 100);
            }
        });
        function format_item(sup) {
            if (!sup.id) return sup.text;
            return  "<p >"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:59px'></img></p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
        }
        $('#parsley_reg #items').select2({
            dropdownCssClass : 'item_select',
            formatResult: format_item,
            formatSelection: format_item,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/direct_grn/search_items/',
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
                        suppler:$('#parsley_reg #supplier_guid').val()
                    };
                },
                results: function (data) {
                    var results = [];
                    $.each(data, function(index, item){
                        results.push({
                            id: item.i_guid,
                            text: item.name,
                            value: item.code,
                            image: item.image,
                            brand: item.b_name,
                            category: item.c_name,
                            department: item.d_name,
                            quty: item.quty,
                            cost: item.cost,
                            price: item.price,
                            mrp: item.mrp,
                            tax_type: item.tax_type_name,
                            tax_value: item.tax_value,
                            tax_Inclusive : item.tax_Inclusive ,
                            tax2_type: item.tax2_type,
                            tax2_value: item.tax2_value,
                            tax2_Inclusive : item.tax_inclusive2 ,
                        });
                    });  
                    if($('#supplier_guid').val()==""){
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
        function format_supplier(sup) {
            if (!sup.id) return sup.text;
            return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
        }
        $('#parsley_reg #first_name').change(function() {
            refresh_items_table();           
            var guid = $('#parsley_reg #first_name').select2('data').id;
            $('#parsley_reg #first_name').val($('#parsley_reg #first_name').select2('data').text);
            $('#parsley_reg #company').val($('#parsley_reg #first_name').select2('data').company);
            $('#parsley_reg #address').val($('#parsley_reg #first_name').select2('data').address1);
            $('#parsley_reg #supplier_guid').val(guid);
            window.setTimeout(function ()
            {
                document.getElementById('order_date').focus();
            }, 0); 
             
        });
        $('#parsley_reg #first_name').select2({
            dropdownCssClass : 'supplier_select',
            formatResult: format_supplier,
            formatSelection: format_supplier,                
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/direct_grn/search_supplier',
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
                            address1: item.address1,
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
        $('#supplier_guid').val('');
        $("#parsley_reg").trigger('reset');
        $('#deleted').remove();
        $('#parent_items').append('<div id="deleted"></div>');
        $('#newly_added').remove();
        $('#parent_items').append('<div id="newly_added"></div>');
        $("#parsley_reg #first_name").select2('data', {id:'',text: 'Search Supplier'});
        <?php 
        if($this->session->userdata['direct_grn_per']['add']==1){ ?>
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/direct_grn/order_number/",                      
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
            $('#posnic_add_direct_grn').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#direct_grn_lists').removeAttr("disabled");
             window.setTimeout(function ()
            {
                $('#parsley_reg #first_name').select2('open');
            }, 500);
          <?php           
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('direct_grn');?>', { type: "error" });                         
        <?php         
        }?>
    }
    function posnic_direct_grn_lists(){
        invoice_enable();
        $('#edit_brand_form').hide('hide');
        $('#add_new_order').hide('hide');      
        $("#user_list").show('slow');
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#deactive').removeAttr("disabled");
        $('#posnic_add_direct_grn').removeAttr("disabled");
        $('#direct_grn_lists').attr("disabled",'disabled');
    }
    function clear_add_direct_grn(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
    }
    function clear_update_direct_grn(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
        edit_function($('#direct_grn_guid').val());
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_direct_grn" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                     
                        <a href="javascript:direct_grn_group_approve()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_direct_grn_lists()" class="btn btn-default" id="direct_grn_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('direct_grn') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('direct_grn/direct_grn_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('direct_grn') ?></h4>                                                                               
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

               
                
               <script src="<?php echo base_url() ?>template/app/x_edit/bootstrap.js"></script>
               <script src="<?php echo base_url() ?>template/app/x_edit/bootstrap-editable.js"></script>
               <link href="<?php echo base_url() ?>template/app/x_edit/address.css" rel="stylesheet">
               
              
<script >
    $(document).ready( function () {       
        disacount_and_amount_editable();
        $('#i_discount').val('0');
        $('#i_dis_amt').text('0');
        $('#i_discount2').val('0');
        $('#i_dis_amt2').text('0');
        free_and_discount_input();
        });
   function  disacount_and_amount_editable(){
          "use strict";
    
    var Address = function (options) {
        this.init('address', options, Address.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(Address, $.fn.editabletypes.abstractinput);

    $.extend(Address.prototype, {
        /**
        Renders input from tpl

        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = $('<div>').text(value.i_discount).html() + ', ' + $('<div>').text(value.i_dis_amt).html() ;
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {i_discount: "Moscow", i_dis_amt: "Lenina", free: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    i_discount: "Moscow", 
                    i_dis_amt: "Lenina", 
                    free: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
           if(!value) {
             return;
           }
           this.$input.filter('[name="i_discount"]').val($('#dummy_discount').val());
           $("#i_dis_amt").text($('#dummy_discount_amount').val());
           this.$input.filter('[name="i_discount2"]').val($('#dummy_discount2').val());
           $("#i_dis_amt2").text($('#dummy_discount_amount2').val());
       },       
       
       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() { 
           return {
              i_discount: this.$input.filter('[name="i_discount"]').val(), 
              i_dis_amt: this.$input.filter('[name="i_dis_amt"]').val(), 
              i_discount2: this.$input.filter('[name="i_discount2"]').val(), 
              i_dis_amt2: this.$input.filter('[name="i_dis_amt2"]').val(), 
           };
       },        
       
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
            this.$input.filter('[name="i_discount"]').focus();
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
           this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                    document.getElementById('extra_elements').focus();
                   
                }
           });
       }       
    });

    Address.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="row"><div class="col col-lg-7"><label><span><?php echo $this->lang->line('discount') ?> 1%: </span></lable></div><div class="col col-lg-5"><input type="text" name="i_discount" id="i_discount" onKeyPress="return numbersonly(event)" maxlength="3" autocomplete="off" onkeyup="item_editable_discount()" class="form-control"/></div></div>'+
            '<div class="row"><div class="col col-lg-7"><label><span>1 <?php echo $this->lang->line('discount_amount') ?>  </span></lable></div><div class="col col-lg-5"><label  name="i_dis_amt" id="i_dis_amt" /></div></div>\n\
            <div class="row"><div class="col col-lg-7"><label><span><?php echo $this->lang->line('discount') ?>2 %: </span></lable></div><div class="col col-lg-5"><input type="text" name="i_discount2" id="i_discount2" onKeyPress="return numbersonly(event)" maxlength="3" autocomplete="off" onkeyup="item_editable_discount2()" class="form-control"></div></div>'+
            '<div class="row"><div class="col col-lg-7"><label><span>2 <?php echo $this->lang->line('discount_amount') ?> </span></lable></div><div class="col col-lg-5"><label name="i_dis_amt2" id="i_dis_amt2"  /></div></div>' ,
          
        inputclass: ''
    });
  
    $.fn.editabletypes.address = Address;
        
     }
    function item_editable_discount(){       
        var per=$('#i_discount').val();
        if (isNaN(per)) {
            per=0;

        }          
        var quantity=($('#quantity').val());
        var cost=$('#cost').val();
        if(per!="" && per!=0){
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
            if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }
            var  discount=parseFloat(total)*per/100;      
            if(discount>parseFloat(cost*quantity)){
                $('#parsley_reg #total').val(total);
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point)); 
                $('#i_dis_amt').text(0);
                $('#i_discount').val('');

            }else{
                
                var num = parseFloat(discount);
                $('#i_dis_amt').text(num.toFixed(point));
                $('#parsley_reg #total').val(total-discount);
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point));

            }
        }else{
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
              if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }

            $('#parsley_reg #total').val(total);
            $('#i_dis_amt').text(0);

            var num = parseFloat($('#total').val());
            $('#total').val(num.toFixed(point)); 
        }
        var discount1=$('#i_dis_amt').text();
        var per=$('#i_discount2').val();
        if (isNaN(per)) {
            per=0;

        }          
        if (isNaN(discount1)) {
            discount1=0;

        }          
        var quantity=($('#quantity').val());
        var cost=$('#cost').val();
        if(per!="" && per!=0){
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
            if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }
            total=total-discount1;
            var  discount=parseFloat(total)*per/100;      
            if(discount>parseFloat(cost*quantity)){                
                $('#parsley_reg #total').val(total);
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point)); 
                $('#i_dis_amt2').text(0);
                $('#i_discount2').val('');

            }else{
                $('#parsley_reg #total').val(total-discount);
                var num = parseFloat(discount);
                $('#i_dis_amt2').text(num.toFixed(point));
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point));

          }
        }else{
            var discount1=$('#i_dis_amt').text();                    
            if (isNaN(discount1)) {
                discount1=0;

            }
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
              if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }

            $('#parsley_reg #total').val(total-discount1);
            $('#i_dis_amt2').text(0);

            var num = parseFloat($('#total').val());
            $('#total').val(num.toFixed(point)); 
        }
          
    }
    function item_editable_discount2(){    
       
        var discount1=$('#i_dis_amt').text();
        var per=$('#i_discount2').val();
        if (isNaN(per)) {
            per=0;

        }          
        if (isNaN(discount1)) {
            discount1=0;

        }          
        var quantity=($('#quantity').val());
        var cost=$('#cost').val();
        if(per!="" && per!=0){
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
            if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }
            total=total-discount1;
            var  discount=parseFloat(total)*per/100;      
            if(discount>parseFloat(cost*quantity)){                
                $('#parsley_reg #total').val(total);
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point)); 
                $('#i_dis_amt2').text(0);
                $('#i_discount2').val('');

            }else{
                $('#parsley_reg #total').val(total-discount);
                var num = parseFloat(discount);
                $('#i_dis_amt2').text(num.toFixed(point));
                var num = parseFloat($('#total').val());
                $('#total').val(num.toFixed(point));

          }
        }else{
            var discount1=$('#i_dis_amt').text();                    
            if (isNaN(discount1)) {
                discount1=0;

            }
            var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
            var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
            var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
              if($('#tax_Inclusive').val()==0){
                total=total+parseFloat(tax1);
            }
            if($('#tax2_Inclusive').val()==0){
                total=total+parseFloat(tax2);
            }

            $('#parsley_reg #total').val(total-discount1);
            $('#i_dis_amt2').text(0);

            var num = parseFloat($('#total').val());
            $('#total').val(num.toFixed(point)); 
        }
          
    }
   
   
    function free_and_discount_input(){
        if($('#parsley_reg #supplier_guid').val()!="" && $('#parsley_reg #item_id').val()!="" ){
            $('#item_free_and_discount').editable({       
                value: {
                    i_discount: "", 
                    i_dis_amt: "0",
                    i_discount2: "", 
                    i_dis_amt2: "0"

                },
                display: function(value) {
                    if(!value) {
                        $(this).empty();
                        return; 
                    }
                    $('#dummy_discount').val(value.i_discount);
                    $('#dummy_discount_amount').val(value.i_dis_amt);
                    $('#dummy_discount2').val(value.i_discount2);
                    $('#dummy_discount_amount2').val(value.i_dis_amt2);
                    //var html = '<b>Discount' + $('<div>').text(value.i_discount).html() + '</b> ' + $('<div>').text(value.i_dis_amt).html() + ' st., bld. ' + $('<div>').text(value.free).html();
                    var html="<input type='hidden' value='"+value.i_dis_amt+"' id='hidden_dis_amt'><input type='hidden' value='"+value.i_discount+"' id='hidden_dis'><input type='hidden' value='"+value.i_dis_amt2+"' id='hidden_dis_amt2'><input type='hidden' value='"+value.i_discount2+"' id='hidden_dis2'><input type='text' class='form-control text-center' id='extra_elements' value='"+parseFloat(value.i_dis_amt+value.i_dis_amt2)+" ' onKeyPress='add_new_discount(event);return numbersonly(event)'  onkeyup='set_default_amount()'>"
                    $(this).html(html); 

                }         
            }); 
        }
    }
</script>

  
<div class="modal fade" id="loading"  style="background:none">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
<script type="text/javascript">
    function set_default_amount(){
        var total=parseFloat($('#hidden_dis_amt').val())+parseFloat($('#hidden_dis_amt2').val());
        var num = parseFloat(total);
        $('#extra_elements').val(num.toFixed(point));
      
    }

    function add_new_discount(e){
        if($('#parsley_reg #item_id').val()!=""){
            var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=13 && unicode!=9){
            }
            else{
                copy_items();         
            }
            if (unicode!=27){           
            }
            else{
                $('#mrp').focus();
            }
            if (unicode!=13 && unicode!=9 && unicode!=27){
                $('#extra_elements').click();
                $("#i_discount").focus();
                document.getElementById('extra_elements').value=$('#hidden_dis_amt').val();
                window.setTimeout(function ()
                {
                    var total=parseFloat($('#hidden_dis_amt').val())+parseFloat($('#hidden_dis_amt2').val());
                    var num = parseFloat(total);
                    $('#extra_elements').val(num.toFixed(point));
                }, 10);
            }        
        }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
            $("#parsley_reg #items").focus();
        }
    }    
    function net_amount(){  
        if(isNaN(parseFloat($('#parsley_reg #cost').val())) || isNaN(parseFloat($('#parsley_reg #quantity').val()))){
            if(isNaN($('#parsley_reg #cost').val())){
                $('#parsley_reg #cost').val("");
            }else{
                $('#parsley_reg #quantity').val("");
            }
            $('#parsley_reg #total').val('');
            $('#parsley_reg #sub_total').val('');
            $('#parsley_reg #tax').val('');
        }else{
            if(isNaN($('#parsley_reg #dummy_discount_amount').val())){
                $('#parsley_reg #dummy_discount_amount').val(0);
            }
            if($('#dummy_discount_amount').val()==""){
                $('#parsley_reg #dummy_discount_amount').val(0);
            }         
            if(parseFloat($('#parsley_reg #quantity').val())>parseFloat($('#parsley_reg #supplier_quty').val()) && $('#parsley_reg #supplier_quty').val()!=0){
                $('#parsley_reg #quantity').val($('#parsley_reg #supplier_quty').val());
                var discount_per=$('#dummy_discount').val();
                var discount_per2=$('#dummy_discount2').val();
                if(isNaN(discount_per)){
                    discount_per=0;
                }
                if(isNaN(discount_per2)){
                    discount_per2=0;
                }
                var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
                $('#parsley_reg #sub_total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
                var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
                var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
                var total_tax=0;
                if($('#tax_Inclusive').val()==0){
                    total=total+parseFloat(tax1);
                    total_tax=total_tax+tax1;
                }
                if($('#tax2_Inclusive').val()==0){
                    total=total+parseFloat(tax2);
                    total_tax=total_tax+tax2;
                }
                var discount=(total)*(discount_per/100);
                total=total-parseFloat(discount);
                var discount2=(total)*(discount_per2/100);
                
                $('#parsley_reg #hidden_dis_amt').val(discount);
                $('#parsley_reg #i_dis_amt').text(discount);
                $('#parsley_reg #hidden_dis_amt2').val(discount2);
                $('#parsley_reg #i_dis_amt2').text(discount2);
                $('#parsley_reg #dummy_discount_amount').val(discount);
                $('#parsley_reg #dummy_discount_amount2').val(discount2);
                
                total=total-parseFloat(discount2);
                var num = parseFloat(total);
                $('#total').val(num.toFixed(point));
                $('#parsley_reg #sub_total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
                var num = parseFloat($('#sub_total').val());
                $('#sub_total').val(num.toFixed(point));
                var num1 = parseFloat(discount+discount2);                   
                window.setTimeout(function ()
                {
                    $('#extra_elements').val(num1.toFixed(point));
                }, 0);
                $('#tax').val(total_tax);
                if(total_tax==0){
                    $('#tax_label').text('<?php echo $this->lang->line('tax') ?>(Inc)');
                }else{
                    $('#tax_label').text('<?php echo $this->lang->line('tax') ?>(Exc)');
                } 
                $.bootstrapGrowl('<?php echo $this->lang->line('not_able_to_order');?> '+$('#parsley_reg #first_name').val()+' <?php echo $this->lang->line('for');?> '+$('#parsley_reg #item_name').val(), { type: "warning" }); 
            }else{             
                var discount_per=$('#dummy_discount').val();
                var discount_per2=$('#dummy_discount2').val();
                if(isNaN(discount_per)){
                    discount_per=0;
                }
                if(isNaN(discount_per2)){
                    discount_per2=0;
                }
                var total=$('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val();
                $('#parsley_reg #sub_total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
                var tax1=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val())/100);
                var tax2=parseFloat($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax2_value').val())/100);
                var total_tax=0;
                if($('#tax_Inclusive').val()==0){
                    total=total+parseFloat(tax1);
                    total_tax=total_tax+tax1;
                }
                if($('#tax2_Inclusive').val()==0){
                    total=total+parseFloat(tax2);
                    total_tax=total_tax+tax2;
                }
                var discount=(total)*(discount_per/100);
                total=total-parseFloat(discount);
                var discount2=(total)*(discount_per2/100);
                
                $('#parsley_reg #hidden_dis_amt').val(discount);
                $('#parsley_reg #i_dis_amt').text(discount);
                $('#parsley_reg #hidden_dis_amt2').val(discount2);
                $('#parsley_reg #i_dis_amt2').text(discount2);
                $('#parsley_reg #dummy_discount_amount').val(discount);
                $('#parsley_reg #dummy_discount_amount2').val(discount2);
                
                total=total-parseFloat(discount2);
                var num = parseFloat(total);
                $('#total').val(num.toFixed(point));
                $('#parsley_reg #sub_total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
                var num = parseFloat($('#sub_total').val());
                $('#sub_total').val(num.toFixed(point));
                var num1 = parseFloat(discount+discount2);                   
                window.setTimeout(function ()
                {
                    $('#extra_elements').val(num1.toFixed(point));
                }, 0);
                
                if(total_tax==0){
                    $('#tax_label').text('<?php echo $this->lang->line('tax') ?>(Inc)');
                    total_tax=tax1+tax2;
                    var num = parseFloat(total_tax);
                    $('#tax').val(num.toFixed(point));
                }else{
                    $('#tax_label').text('<?php echo $this->lang->line('tax') ?>(Exc)');
                    $('#tax').val(total_tax);
                }           
            }
        }
    }
    function copy_items(){
        if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #cost').val()!="" && $('#parsley_reg #price').val()!="" && $('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!=""){ 
            if($('#parsley_reg #cost').val()<$('#parsley_reg #price').val()) { 
                if(parseFloat($('#parsley_reg #mrp').val())>=parseFloat($('#parsley_reg #price').val())) {      
                    if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_id').val())){
                        var  name=$('#parsley_reg #item_name').val();
                        var  sku=$('#parsley_reg #sku').val();
                        var  quty=$('#parsley_reg #quantity').val();
                        if($('#parsley_reg #free').val()!=""){
                        var  free=$('#parsley_reg #free').val();
                        }else{
                            free=0;
                        }
                        var  cost=$('#parsley_reg #cost').val();
                        var  price=$('#parsley_reg #price').val();
                        var  mrp=$('#parsley_reg #mrp').val();
                        var  items_id=$('#parsley_reg #item_id').val();
                        var  supplier=$('#parsley_reg #supplier_guid').val();
                        var  supplier=$('#parsley_reg #supplier_guid').val();
                        var  tax_value=$('#parsley_reg #tax_value').val();
                        var  tax_type=$('#parsley_reg #tax_type').val();
                        var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                        var  tax_value2=$('#parsley_reg #tax2_value').val();
                        var  tax_type2=$('#parsley_reg #tax2_type').val();
                        var  tax_Inclusive2=$('#parsley_reg #tax2_Inclusive').val();
                        var  per=$('#parsley_reg #hidden_dis').val();
                        var  discount=$('#parsley_reg #hidden_dis_amt').val();
                        var  per2=$('#parsley_reg #hidden_dis2').val();
                        var  discount2=$('#parsley_reg #hidden_dis_amt2').val();
                        var type1='Inc';
                        var type2='Inc';
                        var tax1=(parseFloat(quty)*parseFloat(cost))*tax_value/100;
                        var tax2=(parseFloat(quty)*parseFloat(cost))*tax_value2/100;
                        var total= (parseFloat(quty)*parseFloat(cost));
                        var sub_total= (parseFloat(quty)*parseFloat(cost));
                        if(tax_Inclusive==0){
                           total=total+tax1;
                           type1='Exc';
                        }
                        if(tax_Inclusive==0){
                            type2='Exc';
                            total=total+tax2;
                        }
                        total=total-discount2-discount;
                        if(discount==""){
                          discount=0;
                        }
                        if(per==""){
                          per=0;
                        }
                             
                        var num = parseFloat(tax1);
                        tax1=num.toFixed(point);
                        var num = parseFloat(tax2);
                        tax2=num.toFixed(point);
                        var num = parseFloat(discount);
                        discount=num.toFixed(point);
                        var num = parseFloat(discount2);
                        discount2=num.toFixed(point);
                        var total_discount=parseFloat(discount)+parseFloat(discount2);                        
                        var num = parseFloat(total_discount);
                        total_discount=num.toFixed(point);
                        var num = parseFloat(total);
                        total=num.toFixed(point);
                        var num = parseFloat(sub_total);
                        sub_total=num.toFixed(point);
                        var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val();
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(2)').html(name);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(3)').html(sku);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(4)').html(quty);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(5)').html(free);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(6)').html(cost);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(7)').html(price);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(8)').html(sub_total);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(9)').html(tax1 +''+' : '+tax_type+'('+type1+')');
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(10)').html(tax2 +''+' : '+tax_type2+'('+type2+')');
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(11)').html(total_discount);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(12)').html(total);
                        $('#newly_added #new_item_id_'+items_id).val(items_id);
                        $('#newly_added #new_item_quty_'+items_id).val(quty);
                        $('#newly_added #new_item_free_'+items_id).val(free);
                        $('#newly_added #new_item_cost_'+items_id).val(cost);
                        $('#newly_added #new_item_price_'+items_id).val(price);
                        $('#newly_added #new_item_mrp_'+items_id).val(mrp);
                        $('#newly_added #new_item_total_'+items_id).val(parseFloat(quty)*parseFloat(cost));
                        $('#newly_added #new_item_discount_'+items_id).val(discount);
                        $('#newly_added #new_item_discount_per_'+items_id).val(per);
                        $('#newly_added #new_item_discount2_'+items_id).val(discount2);
                        $('#newly_added #new_item_discount_per2_'+items_id).val(per2);
                        $('#newly_added #new_item_tax_'+items_id).val(tax1);
                        $('#newly_added #new_item_tax2_'+items_id).val(tax2);
                        $('#newly_added #new_item_total'+items_id).val(total);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_id').val(items_id);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_name').val(name);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sku').val(sku);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_quty').val(quty);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_free').val(free);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_cost').val(cost);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_price').val(price);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_mrp').val(mrp);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax').val(tax1);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_type').val(tax_type);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_value').val(tax_value);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_inclusive').val(tax_Inclusive);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax2').val(tax2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_type2').val(tax_type2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_value2').val(tax_value2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_inclusive2').val(tax_Inclusive2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount').val(discount);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount_per').val(per);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount2').val(discount2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount_per2').val(per2);
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sub_total').val(parseFloat(quty)*parseFloat(cost));
                        $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val(total);
                        $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
                       
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
                            var total_amount=parseFloat($('#total_amount').val());
                            total_amount=parseFloat(total_amount)-parseFloat(old_total);
                            total_amount=parseFloat(total_amount)+parseFloat(total);
                            var num = parseFloat(total_amount);
                            total_amount=num.toFixed(point);
                            $('#total_amount').val(total_amount)
                        }
                        $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                   
                        new_discount_amount();
                        clear_inputs();
                    }else{  
                        var  name=$('#parsley_reg #item_name').val();
                        var  sku=$('#parsley_reg #sku').val();
                        var  quty=$('#parsley_reg #quantity').val();
                        if($('#parsley_reg #free').val()!=""){
                        var  free=$('#parsley_reg #free').val();
                        }else{
                        var  free=0;
                        }
                        var  cost=$('#parsley_reg #cost').val();
                        var  price=$('#parsley_reg #price').val();
                        var  mrp=$('#parsley_reg #mrp').val();
                        var  items_id=$('#parsley_reg #item_id').val();
                        var  supplier=$('#parsley_reg #supplier_guid').val();
                        var  limit=$('#parsley_reg #supplier_quty').val();
                        var  tax_value=$('#parsley_reg #tax_value').val();
                        var  tax_type=$('#parsley_reg #tax_type').val();
                        var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                        var  tax_value2=$('#parsley_reg #tax2_value').val();
                        var  tax_type2=$('#parsley_reg #tax2_type').val();
                        var  tax_Inclusive2=$('#parsley_reg #tax2_Inclusive').val();
                        var  per=$('#parsley_reg #hidden_dis').val();
                        var  discount=$('#parsley_reg #hidden_dis_amt').val();
                        var  per2=$('#parsley_reg #hidden_dis2').val();
                        var  discount2=$('#parsley_reg #hidden_dis_amt2').val();
                        var type1='Inc';
                        var type2='Inc';
                        var tax1=(parseFloat(quty)*parseFloat(cost))*tax_value/100;
                        var tax2=(parseFloat(quty)*parseFloat(cost))*tax_value2/100;
                        var total= (parseFloat(quty)*parseFloat(cost));
                        var sub_total= (parseFloat(quty)*parseFloat(cost));
                        if(tax_Inclusive==0){
                           total=total+tax1;
                           type1='Exc';
                        }
                        if(tax_Inclusive==0){
                            type2='Exc';
                            total=total+tax2;
                        }
                        total=total-discount2-discount;
                        if(discount==""){
                          discount=0;
                        }
                        if(per==""){
                          per=0;
                        }
                        if(discount==""){
                          discount2=0;
                        }
                        if(per==""){
                          per2=0;
                        }
                        var num = parseFloat(tax1);
                        tax1=num.toFixed(point);
                        var num = parseFloat(tax2);
                        tax2=num.toFixed(point);
                        var num = parseFloat(discount);
                        discount=num.toFixed(point);
                        var num = parseFloat(discount2);
                        discount2=num.toFixed(point);
                        var total_discount=parseFloat(discount)+parseFloat(discount2);  
                        total_discount=total_discount.toFixed(point);
                        var num = parseFloat(total);
                        total=num.toFixed(point);
                        var num = parseFloat(sub_total);
                        sub_total=num.toFixed(point);
                        $('#newly_added').append('<div id="newly_added_items_list_'+items_id+'"> \n\
                        \n\
                        <input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+items_id+'">\n\
                        <input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+items_id+'"> \n\
                        <input type="hidden" name="new_item_free[]" value="'+free+'" id="new_item_free_'+items_id+'">\n\
                        <input type="hidden" name="new_item_cost[]" value="'+cost+'" id="new_item_cost_'+items_id+'"> \n\
                        <input type="hidden" name="new_item_price[]" value="'+price+'" id="new_item_price_'+items_id+'">\n\
                        <input type="hidden" name="new_item_mrp[]" value="'+mrp+'" id="new_item_mrp_'+items_id+'">\n\
                        <input type="hidden" name="new_item_discount[]" value="'+discount+'" id="new_item_discount_'+items_id+'">\n\
                        <input type="hidden" name="new_item_discount_per[]" value="'+per+'" id="new_item_discount_per_'+items_id+'">\n\
                        <input type="hidden" name="new_item_discount2[]" value="'+discount2+'" id="new_item_discount2_'+items_id+'">\n\
                        <input type="hidden" name="new_item_discount_per2[]" value="'+per2+'" id="new_item_discount_per2_'+items_id+'">\n\
                        <input type="hidden" name="new_item_tax[]" value="'+tax1+'" id="new_item_tax_'+items_id+'">\n\
                        <input type="hidden" name="new_item_tax2[]" value="'+tax2+'" id="new_item_tax2_'+items_id+'">\n\
                        <input type="hidden" name="new_item_total[]"  value="'+parseFloat(quty)*parseFloat(cost)+'" id="new_item_total_'+items_id+'">\n\
                        </div>');  
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                        null,
                        name,
                        sku,
                        quty,
                        free,
                        cost,
                        price,
                        sub_total,
                        tax1+' : '+tax_type+'('+type1+')',
                        tax2+' : '+tax_type2+'('+type2+')',
                        total_discount,
                        total,
                        '<input type="hidden" name="index" id="index">\n\
                        <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                        <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                        <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                        <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                        <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                        <input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
                        <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
                        <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                        <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                        <input type="hidden" name="items_mrp[]" value="'+mrp+'" id="items_mrp">\n\
                        <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                        <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax">\n\
                        <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                        <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                        <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                        <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                        <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                        <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_Inclusive2+'" id="items_tax_inclusive2">\n\
                        <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                        <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                        <input type="hidden" name="items_discount2[]" value="'+discount2+'" id="items_discount2">\n\
                        <input type="hidden" name="items_discount_per2[]" value="'+per2+'" id="items_discount_per2">\n\
                        <input type="hidden" name="items_sub_total[]"  value="'+sub_total+'" id="items_sub_total">\n\
                        <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                        <a href=javascript:edit_order_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );
                        var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                        theNode.setAttribute('id','new_item_row_id_'+items_id)
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
                        $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                        new_discount_amount();
                        clear_inputs();
                    }  
                }else{       
                    $.bootstrapGrowl('<?php echo $this->lang->line('Selling Price Must Less Than MRP price');?>', { type: "warning" });          
                    $('#parsley_reg #mrp').focus();
                }
            }else{      
                $.bootstrapGrowl('<?php echo $this->lang->line('Cost Must Less Than Sell price');?>', { type: "warning" }); 
                $('#parsley_reg #cost').focus();
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
            }else if($('#parsley_reg #price').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('price');?>', { type: "warning" });          
                $('#parsley_reg #price').focus();
            }
            else if($('#parsley_reg #mrp').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('mrp');?>', { type: "warning" });          
                $('#parsley_reg #mrp').focus();
            }
            else{
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#parsley_reg #items').select2('open');
            }
        }       
    }
    function edit_order_item(guid){
        $('#parsley_reg #item_name').val($('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val());
        $('#parsley_reg #sku').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sku').val());
        $('#parsley_reg #supplier_quty').val($('#selected_item_table #new_item_row_id_'+guid+' #item_limit').val());
        $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
        $('#parsley_reg #free').val($('#selected_item_table #new_item_row_id_'+guid+' #items_free').val());
        $('#parsley_reg #cost').val($('#selected_item_table #new_item_row_id_'+guid+' #items_cost').val());
        $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #items_price').val());
        $('#parsley_reg #mrp').val($('#selected_item_table #new_item_row_id_'+guid+' #items_mrp').val());
        $('#parsley_reg #sub_total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sub_total').val()); 
        $('#parsley_reg #hidden_dis_amt').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val());
        $('#parsley_reg #i_dis_amt').text($('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val());
        $('#parsley_reg #tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax').val());
        $('#parsley_reg #tax_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type').val());
        $('#parsley_reg #tax_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val());
        $('#parsley_reg #tax_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val());   
        $('#parsley_reg #hidden_dis').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per1').val());
        $('#parsley_reg #hidden_dis2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per2').val());
        $('#parsley_reg #hidden_dis_amt2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#parsley_reg #i_dis_amt2').text($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#parsley_reg #tax2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax2').val());
        $('#parsley_reg #tax2_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type2').val());
        $('#parsley_reg #tax2_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value2').val());
        $('#parsley_reg #tax2_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive2').val());   
        $('#parsley_reg #item_id').val(guid);
        $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_total').val());
        if( $('#parsley_reg #tax_Inclusive').val()==1){
            $('#tax_label').text('Tax(Exc)');
        }else{
            $('#tax_label').text('Tax(Inc)');   
        }
        $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });
        disacount_and_amount_editable();
        $('#i_discount').val('0');
        $('#i_dis_amt').text('0');
        free_and_discount_input();
        $('#dummy_discount_amount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val());
        $('#dummy_discount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val());
        $('#dummy_discount_amount2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#dummy_discount2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per2').val());
        $('#extra_elements').val(parseFloat($('#dummy_discount_amount').val()+$('#dummy_discount_amount2').val()));
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
    }
    function clear_inputs(){
        $('#parsley_reg #item_name').val('');
        $('#parsley_reg #sku').val('');
        $('#parsley_reg #quantity').val('');
        $('#parsley_reg #free').val('');
        $('#parsley_reg #total').val('');
        $('#parsley_reg #sub_total').val('');
        $('#parsley_reg #cost').val('');
        $('#parsley_reg #price').val('');
        $('#parsley_reg #mrp').val('');
        $('#parsley_reg #tax').val('');
        $('#parsley_reg #tax_value').val('');
        $('#parsley_reg #tax_type').val('');
        $('#parsley_reg #tax_Inclusive').val('');
        $('#parsley_reg #tax2_value').val('');
        $('#parsley_reg #tax2_type').val('');
        $('#parsley_reg #tax2_Inclusive').val('');
        $('#parsley_reg #extra_elements').val('');
        $('#parsley_reg #item_id').val('')
        $('#parsley_reg #dummy_discount_amount').val('')
        $('#parsley_reg #hidden_dis_amt').val('')
        $('#parsley_reg #hidden_dis').val('')
        $('#parsley_reg #dummy_discount').val('')
        $('#parsley_reg #dummy_discount_amount2').val('')
        $('#parsley_reg #hidden_dis_amt2').val('')
        $('#parsley_reg #hidden_dis2').val('')
        $('#parsley_reg #dummy_discount2').val('')
        $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
        $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
        $('#parsley_reg #items').select2('open');
        window.setTimeout(function ()
        {
            set_default_amount();
            $('#parsley_reg #extra_elements').val('');
        }, 100);
    }
    function new_grand_total(){
        if(parseFloat($("#parsley_reg #total_amount").val())>0){
            var discount=parseFloat($("#parsley_reg #discount_amount").val());
            var frieight=parseFloat($("#parsley_reg #freight").val());
            var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
            if (isNaN(discount) || discount=="") {
                discount=0;
            }
            if (isNaN(frieight)|| frieight=="") {
                frieight=00;
            }
            if (isNaN(round_amt)|| round_amt=="") {
                round_amt=00;
            }
            $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt);
            $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt);
            var num = parseFloat($('#demo_grand_total').val());
            $('#demo_grand_total').val(num.toFixed(point));
            var num = parseFloat($('#grand_total').val());
            $('#grand_total').val(num.toFixed(point));
            var num = parseFloat($('#demo_total_amount').val());
            $('#demo_total_amount').val(num.toFixed(point));
            var num = parseFloat($('#total_amount').val());
            $('#total_amount').val(num.toFixed(point));
        }else{
            $("#parsley_reg #total_amount").val(0);
            $("#parsley_reg #grand_total").val(0);
            $("#parsley_reg #demo_total_amount").val(0);
            $("#parsley_reg #demo_grand_total").val(0);
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
                $("#parsley_reg #discount_amount").val(discount);
            }else{
                var  discount=$('discount_amount').val();
            }
            $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
            $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
            var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
            var freight=parseFloat($("#parsley_reg #freight").val())
            if(freight==""){freight=0;}
            if(round_amt==""){
                round_amt=0;
            }
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
            $("#parsley_reg #grand_total").val(0);
            $("#parsley_reg #demo_total_amount").val(0);
            $("#parsley_reg #demo_grand_total").val(0);
        }
    }
</script>

  
<section id="add_new_order" class="container clearfix main_section" style="display: none">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('direct_grn/upadate_pos_direct_grn_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
        <input type="hidden" name="dummy_discount2" id="dummy_discount2" >
        <input type="hidden" name="dummy_discount_amount2" id="dummy_discount_amount2" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('direct_grn')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                        <input type="hidden" id="direct_grn_guid" name="direct_grn_guid">
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
                                                    </div><input type="hidden" value="" name='supplier_guid' id='supplier_guid'>
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
                                                            <label for="order_date" ><?php echo $this->lang->line('order_date') ?></label>													
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
                                                   <div class="form_sep">
                                                            <label for="discount" ><?php echo $this->lang->line('discount') ?>%</label>													
                                                                     <?php $discount=array('name'=>'discount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'id_discount',
                                                                                         'maxlength'=>3,
                                                                                         'onkeyup'=>'new_discount_amount()',
                                                                                        'onKeyPress'=>"return numbersonly(event)",
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
                                                                                        'onKeyPress'=>"return numbersonly(event)", 
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
                                                                                       'onKeyPress'=>"return numbersonly(event)",
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
                                                                                        'onKeyPress'=>"return numbersonly(event)",
                                                                                        'value'=>set_value('round_off_amount'));
                                                                         echo form_input($round_off_amount)?>
                                                       </div>
                                                    </div>
                                           </div>
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>
                         
                         
         
                    <div class="row small_inputs" >
                    <div class="col col-lg-12">
                      
                         
                             
                              <div class="row" style="padding-top: 1px;" id="sacn_items">
                                 
                                  
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
                                                    <input type="hidden" name="tax2_type" id="tax2_type">
                                                    <input type="hidden" name="tax2_Inclusive" id="tax2_Inclusive">                                                 
                                                    <input type="hidden" name="tax2_value" id="tax2_value">
                                                    <input type="hidden" name="item_name" id="item_name">
                                                    <input type="hidden" name="sku" id="sku">
                                                    <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                    <input type="hidden" name="supplier_quty" id="supplier_quty">
                                                        </div>
                                                
                                                 <div class="col col-lg-1" style="padding:1px;width: 120px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'quantity',
                                                                                            'onkeyup'=>"net_amount()", 
                                                                     'onKeyPress'=>" return numbersonly(event)",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                
                                                  <div class="col col-lg-1" style="padding:1px; width: 80px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="free" class="text-center" ><?php echo $this->lang->line('free'); ?></label>

                                                                 <?php $free=array('name'=>'free',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'free',
                                                                                            
                                                                     'onKeyPress'=>" return numbersonly(event)",
                                                                                            'value'=>set_value('free'));
                                                                              echo form_input($free)?>
                                                              
                                                               
                                                        </div>
                                                        </div>
                                                
                                                     <div class="col col-lg-1" style="padding:1px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="cost" class="text-center" ><?php echo $this->lang->line('cost') ?></label>

                                                                 <?php $cost=array('name'=>'cost',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'cost',
                                                                       'onkeyup'=>"net_amount()",
                                                                     'onKeyPress'=>"return numbersonly(event)",
                                                                                            'value'=>set_value('cost'));
                                                                             echo form_input($cost)?>
                                                        </div>
                                                        </div>
                                              
                                                    <div class="col col-lg-1" style="padding:1px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" class="text-center" ><?php echo $this->lang->line('price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'price',
                                                                   'onKeyPress'=>" return numbersonly(event)",
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                          
                                                <div class="col col-lg-1" style="padding:1px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="mrp" class="text-center"  ><?php echo $this->lang->line('mrp') ?></label>

                                                                 <?php $mrp=array('name'=>'mrp',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'mrp',
                                                                     'onKeyPress'=>"return numbersonly(event)",
                                                                                            'value'=>set_value('mrp'));
                                                                             echo form_input($mrp)?>
                                                        </div>
                                                    </div>
                                  
                                                <div class="col col-lg-1" style="padding:1px;width: 125px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="sub_total" class="text-center"  ><?php echo $this->lang->line('sub_total') ?></label>

                                                                 <?php $sub_total=array('name'=>'sub_total',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'sub_total',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('sub_total'));
                                                                             echo form_input($sub_total)?>
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
                                                            
                                                                <label for="total" class="text-center"  ><?php echo $this->lang->line('discount') ?></label>

                                                                 <a href="#" id="item_free_and_discount" data-type="address" data-pk="1" data-title="<?php  echo $this->lang->line('please_enter')." ".$this->lang->line('item')." ".$this->lang->line('discount') ?>"><input type="text" class="form-control text-center"  value="0"></a>
                                                                
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
                                    <table id='selected_item_table' class="table table-striped dataTable " style="width: 100% !important">
                                    <thead>
                                        <tr>
                                            
                                     <th><?php echo $this->lang->line('no') ?></th>
                                    <th><?php echo $this->lang->line('name') ?></th>
                                        <th><?php echo $this->lang->line('sku') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>
                                    <th><?php echo $this->lang->line('free') ?></th>
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('price') ?></th>
                                    <th><?php echo $this->lang->line('sub_total') ?></th>
                                    <th><?php echo $this->lang->line('tax') ?>1</th>
                                    <th><?php echo $this->lang->line('tax') ?>2</th>
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
                                                        <a href="javascript:clear_add_direct_grn()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_direct_grn()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                               </div>
                                         
                                               
                                               <div class="col col-sm-6" >
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
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
<section class="container clearfix main_section" id="invoice_div" style="display: none">
            <div id="main_content_outer " class="clearfix">
                    <div id="main_content">

                            <!-- main content -->
                            <div class="row">
                                    <div class="col-sm-4">
                                            <a href="javascript:invoice_settings()" class="btn btn-default  btn-lg"><span class="icon icon-cogs sepV_b"></span><?php echo $this->lang->line('invoice_settings') ?></a>
                                   
                                            <a href="javascript:void(0)" class="btn btn-default btn-lg" id="invoice_print"><span class="glyphicon glyphicon-print sepV_b"></span><?php  echo $this->lang->line('print_invoice') ?></a>
                                    </div>
                            </div>
                            <div id="invoice_content">
                           
                            <div class="row">
                                    <div class="col-sm-3">
                                            <h3 class="heading_a"><?php echo $this->lang->line('invoice'); ?></h3>
                                            <address>
                                                   
                                                    <p id="invoice_posnic_id"></p>
                                                    <p  id="invoice_posnic_number"></p>
                                                    <p id="invoice_posnic_date"></p>
                                                    <p id="invoice_posnic_expiry_date"></p>
                                                   
                                                     
                                            </address>
                                    </div>
                                    <div class="col-sm-3">
                                         <br>
                                         <br>
                                        <div id="invoice_posnic_qrcode1"></div>
                                    </div>
                                    <div class="col-sm-3">
                                            <h3 class="heading_a"><?php echo $this->lang->line('branch'); ?></h3>
                                            <address>
                                                    <p  id="invoice_posnic_branch_code"></p>
                                                    <p  ><small id="invoice_posnic_branch_name" class="text-muted "> </small></p>
                                                    <p  ><small id="invoice_posnic_branch_address" class="text-muted"> </small></p>
                                                    <p  ><small id="invoice_posnic_branch_city" class="text-muted "> </small></p>
                                                    <p  ><small id="invoice_posnic_branch_state" class="text-muted"> </small></p>
                                                    <p  ><small id="invoice_posnic_branch_zip" class="text-muted "> </small></p>
                                                    <p  ><small id="invoice_posnic_branch_country" class="text-muted"> </small></p>
                                                    <p  ><?php echo $this->lang->line('phone') ?>   :<small id="invoice_posnic_branch_phone" class="text-muted "> </small></p>
                                                    <p  ><?php echo $this->lang->line('email') ?>   :<small id="invoice_posnic_branch_email" class="text-muted"> </small></p>
                                            </address>
                                    </div>
                                    <div class="col-sm-3">
                                            <h3 class="heading_a"><?php echo $this->lang->line('supplier'); ?></h3>
                                            <address>
                                                    <p  id="invoice_posnic_supplier_name" ></p>
                                                    <p><small  id="invoice_posnic_supplier_company" class="text-muted "></small></p>
                                                    <p><small   id="invoice_posnic_supplier_address" class="text-muted "></small></p>
                                                    <p><small  id="invoice_posnic_supplier_city" class="text-muted "></small></p>
                                                    <p><small  id="invoice_posnic_supplier_state" class="text-muted "></small></p>
                                                    <p><small  id="invoice_posnic_supplier_zip" class="text-muted "></small></p>
                                                    <p><small id="invoice_posnic_supplier_country" class="text-muted "></small></p>
                                                    <p><?php echo $this->lang->line('phone') ?> :<small  id="invoice_posnic_supplier_phone" class="text-muted "></small></p>
                                                    <p><?php echo $this->lang->line('email') ?> :<small  id="invoice_posnic_supplier_email" class="text-muted "></small></p>
                                            </address>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-sm-12">
                                            <table class="table table-striped" id="invoice_posnic_table">
                                                    <thead>
                                                            
                                                    </thead>
                                                    <tbody>
                                                          
                                                    </tbody>
                                                    <tfoot>
                                                     
                                                    </tfoot>
                                            </table>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-sm-12">
                                            <div class="invoice_info" id="invoice_posnic_order_text"></div>
                                    </div>
                            </div>
</div>
                    </div>
            </div>
    </section>
<section class="container clearfix main_section" id="invoice_settings" style="display: none">
   
    <div id="main_content_outer" class="clearfix" >
        <div id="main_content">

                <!-- main content -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="form_settings" id="settings_form">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title pull-left"><?php echo $this->lang->line('invoice_settings') ?></h4>
                                <a href="javascript:save_invoice_settings()" class="btn btn-primary btn-sm pull-right"><?php echo $this->lang->line('save')." ".$this->lang->line('invoice_settings') ?></a>
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#st_purchase"><?php echo $this->lang->line('direct_grn')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_branch"><?php echo $this->lang->line('branch')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_supplier"><?php echo $this->lang->line('supplier')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_items"><?php echo $this->lang->line('items')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_invoice"><?php echo $this->lang->line('invoice')." ".$this->lang->line('details') ?></a></li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div id="st_purchase" class="tab-pane active">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_order_id" ><?php echo $this->lang->line('direct_grn_id') ?></label>													

                                                         <?php $posnic_order_id=array('name'=>'posnic_order_id',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_order_id');
                                                                echo form_checkbox($posnic_order_id)?>
                                              
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_number" ><?php echo $this->lang->line('direct_grn_number') ?></label>													
                             
                                                         <?php $posnic_number=array('name'=>'posnic_number',
                                                                               'class'=>' form-control ',
                                                               'value'=>1,
                                                                               'id'=>'posnic_number');
                                                                echo form_checkbox($posnic_number)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_date" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('date') ?></label>													
                                                     
                                                        <?php $posnic_date=array('name'=>'posnic_date',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_date');
                                                        
                                                        echo form_checkbox($posnic_date)?>
                                             </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_barcode" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('barcode') ?></label>													
                                                     
                                                        <?php $posnic_barcode=array('name'=>'posnic_barcode',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_barcode');
                                                        echo form_checkbox($posnic_barcode)?>
                                                
                                             </div>
                                        </div>
                                        
                                    </div>
                                    <div id="st_branch" class="tab-pane">
                                           <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_code" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('branch')." ". $this->lang->line('code') ?></label>													
                                                     
                                                        <?php $posnic_branch_code=array('name'=>'posnic_branch_code',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_code');
                                                        echo form_checkbox($posnic_branch_code)?>
                                                   
                                             </div>
                                        </div>
                                           <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_name" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('branch')." ". $this->lang->line('name') ?></label>													
                                                     
                                                        <?php $posnic_branch_name=array('name'=>'posnic_branch_name',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_name');
                                                        echo form_checkbox($posnic_branch_name)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_address" ><?php echo $this->lang->line('branch')." ". $this->lang->line('address') ?></label>													
                                                     
                                                        <?php $posnic_branch_address=array('name'=>'posnic_branch_address',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_address');
                                                        echo form_checkbox($posnic_branch_address)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_city" ><?php echo $this->lang->line('branch')." ". $this->lang->line('city') ?></label>													
                                                     
                                                        <?php $posnic_branch_city=array('name'=>'posnic_branch_city',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_city');
                                                        echo form_checkbox($posnic_branch_city)?>
                                               
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_state" ><?php echo $this->lang->line('branch')." ". $this->lang->line('state') ?></label>													
                                                     
                                                        <?php $posnic_branch_state=array('name'=>'posnic_branch_state',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_state');
                                                        echo form_checkbox($posnic_branch_state)?>
                                               
                                             </div>
                                        </div>
                                        
                                         
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_country" ><?php echo $this->lang->line('branch')." ". $this->lang->line('country') ?></label>													
                                                     
                                                        <?php $posnic_branch_country=array('name'=>'posnic_branch_country',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_country');
                                                        echo form_checkbox($posnic_branch_country)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_zip" ><?php echo $this->lang->line('branch')." ". $this->lang->line('zip') ?></label>													
                                                     
                                                        <?php $posnic_branch_zip=array('name'=>'posnic_branch_zip',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_zip');
                                                        echo form_checkbox($posnic_branch_zip)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_email" ><?php echo $this->lang->line('branch')." ". $this->lang->line('email') ?></label>													
                                                     
                                                        <?php $posnic_branch_email=array('name'=>'posnic_branch_email',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_email');
                                                        echo form_checkbox($posnic_branch_email)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_phone" ><?php echo $this->lang->line('branch')." ". $this->lang->line('phone') ?></label>													
                                                     
                                                        <?php $posnic_branch_phone=array('name'=>'posnic_branch_phone',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_phone');
                                                        echo form_checkbox($posnic_branch_phone)?>
                                            
                                             </div>
                                        </div>
                                    </div>
                                    <div id="st_supplier" class="tab-pane">
      <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_name" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('name') ?></label>													
                                                     
                                                        <?php $posnic_supplier_name=array('name'=>'posnic_supplier_name',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_name');
                                                        echo form_checkbox($posnic_supplier_name)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_company" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('company') ?></label>													
                                                     
                                                        <?php $posnic_supplier_company=array('name'=>'posnic_supplier_company',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_company');
                                                        echo form_checkbox($posnic_supplier_company)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_address" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('address') ?></label>													
                                                     
                                                        <?php $posnic_supplier_address=array('name'=>'posnic_supplier_address',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_address');
                                                        echo form_checkbox($posnic_supplier_address)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_city" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('city') ?></label>													
                                                     
                                                        <?php $posnic_supplier_city=array('name'=>'posnic_supplier_city',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_city');
                                                        echo form_checkbox($posnic_supplier_city)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_state" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('state') ?></label>													
                                                     
                                                        <?php $posnic_supplier_state=array('name'=>'posnic_supplier_state',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_state');
                                                        echo form_checkbox($posnic_supplier_state)?>
                                                  
                                             </div>
                                        </div>
                                        
                                         
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_country" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('country') ?></label>													
                                                     
                                                        <?php $posnic_supplier_country=array('name'=>'posnic_supplier_country',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_country');
                                                        echo form_checkbox($posnic_supplier_country)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_zip" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('pin') ?></label>													
                                                     
                                                        <?php $posnic_supplier_zip=array('name'=>'posnic_supplier_zip',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_zip');
                                                        echo form_checkbox($posnic_supplier_zip)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_email" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('email') ?></label>													
                                                     
                                                        <?php $posnic_supplier_email=array('name'=>'posnic_supplier_email',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_email');
                                                        echo form_checkbox($posnic_supplier_email)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_phone" ><?php echo $this->lang->line('supplier')." ". $this->lang->line('phone') ?></label>													
                                                     
                                                        <?php $posnic_supplier_phone=array('name'=>'posnic_supplier_phone',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_phone');
                                                        echo form_checkbox($posnic_supplier_phone)?>
                                                   
                                             </div>
                                        </div>
                                    </div>
                                    <div id="st_items" class="tab-pane">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_name" ><?php echo $this->lang->line('item')." ". $this->lang->line('name') ?></label>													
                                                     
                                                        <?php $posnic_item_name=array('name'=>'posnic_item_name',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_name');
                                                        echo form_checkbox($posnic_item_name)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_sku" ><?php echo $this->lang->line('item')." ". $this->lang->line('sku') ?></label>													
                                                     
                                                        <?php $posnic_item_sku=array('name'=>'posnic_item_sku',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_sku');
                                                        echo form_checkbox($posnic_item_sku)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_selling_price" ><?php echo $this->lang->line('item')." ". $this->lang->line('selling_price') ?></label>													
                                                     
                                                        <?php $posnic_item_selling_price=array('name'=>'posnic_item_selling_price',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_selling_price');
                                                        echo form_checkbox($posnic_item_selling_price)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_mrp" ><?php echo $this->lang->line('item')." ". $this->lang->line('mrp') ?></label>													
                                                     
                                                        <?php $posnic_item_mrp=array('name'=>'posnic_item_mrp',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_mrp');
                                                        echo form_checkbox($posnic_item_mrp)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_price" ><?php echo $this->lang->line('item')." ". $this->lang->line('cost') ?></label>													
                                                     
                                                        <?php $posnic_item_price=array('name'=>'posnic_item_price',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_price');
                                                        echo form_checkbox($posnic_item_price)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('quantity') ?></label>													
                                                     
                                                        <?php $posnic_item_quantity=array('name'=>'posnic_item_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_quantity');
                                                        echo form_checkbox($posnic_item_quantity)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_free_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('free') ?></label>													
                                                     
                                                        <?php $posnic_item_free_quantity=array('name'=>'posnic_item_free_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_free_quantity');
                                                        echo form_checkbox($posnic_item_free_quantity)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_tax1" ><?php echo $this->lang->line('item')." ". $this->lang->line('tax') ?> 1</label>													
                                                     
                                                        <?php $posnic_item_tax1=array('name'=>'posnic_item_tax1',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_tax1');
                                                        echo form_checkbox($posnic_item_tax1)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_tax2" ><?php echo $this->lang->line('item')." ". $this->lang->line('tax') ?> 2</label>													
                                                     
                                                        <?php $posnic_item_tax2=array('name'=>'posnic_item_tax2',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_tax2');
                                                        echo form_checkbox($posnic_item_tax2)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_discount1" ><?php echo $this->lang->line('item')." ". $this->lang->line('discount') ?> 1</label>													
                                                     
                                                        <?php $posnic_item_discount1=array('name'=>'posnic_item_discount1',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_discount1');
                                                        echo form_checkbox($posnic_item_discount1)?>
                                               
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_discount2" ><?php echo $this->lang->line('item')." ". $this->lang->line('discount') ?> 2</label>													
                                                     
                                                        <?php $posnic_item_discount2=array('name'=>'posnic_item_discount2',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_discount2');
                                                        echo form_checkbox($posnic_item_discount2)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_subtotal" ><?php echo $this->lang->line('item')." ". $this->lang->line('subtotal') ?> </label>													
                                                     
                                                        <?php $posnic_item_subtotal=array('name'=>'posnic_item_subtotal',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_subtotal');
                                                        echo form_checkbox($posnic_item_subtotal)?>
                                                
                                             </div>
                                        </div>
                                    </div>
                                    <div id="st_invoice" class="tab-pane">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_direct_grn_subtotal" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('subtotal') ?></label>													
                                                     
                                                        <?php $posnic_direct_grn_subtotal=array('name'=>'posnic_direct_grn_subtotal',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_direct_grn_subtotal');
                                                        echo form_checkbox($posnic_direct_grn_subtotal)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_inclusive_total_tax" ><?php echo $this->lang->line('total')." ". $this->lang->line('inclusive_tax') ?> 2</label>													
                                                     
                                                        <?php $posnic_inclusive_total_tax=array('name'=>'posnic_inclusive_total_tax',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_inclusive_total_tax');
                                                        echo form_checkbox($posnic_inclusive_total_tax)?>
                                               
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_exclusive_total_tax" ><?php echo $this->lang->line('total')." ". $this->lang->line('exclusive_tax') ?> 2</label>													
                                                     
                                                        <?php $posnic_exclusive_total_tax=array('name'=>'posnic_exclusive_total_tax',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_exclusive_total_tax');
                                                        echo form_checkbox($posnic_exclusive_total_tax)?>
                                              
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_total_item_discount" ><?php echo $this->lang->line('total')." ". $this->lang->line('item_discount') ?> </label>													
                                                     
                                                        <?php $posnic_total_item_discount=array('name'=>'posnic_total_item_discount',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_total_item_discount');
                                                        echo form_checkbox($posnic_total_item_discount)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_discount" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('discount') ?> </label>													
                                                     
                                                        <?php $posnic_discount=array('name'=>'posnic_discount',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_discount');
                                                        echo form_checkbox($posnic_discount)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_frieght" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('frieght') ?> </label>													
                                                     
                                                        <?php $posnic_frieght=array('name'=>'posnic_frieght',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_frieght');
                                                        echo form_checkbox($posnic_frieght)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_round_off_amount" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('round_off_amount') ?> </label>													
                                                     
                                                        <?php $posnic_round_off_amount=array('name'=>'posnic_round_off_amount',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_round_off_amount');
                                                        echo form_checkbox($posnic_round_off_amount)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_grand_total" ><?php echo $this->lang->line('direct_grn')." ". $this->lang->line('grand_total') ?> </label>													
                                                     
                                                        <?php $posnic_grand_total=array('name'=>'posnic_grand_total',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_grand_total');
                                                        echo form_checkbox($posnic_grand_total)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_supplier_mail" ><?php echo $this->lang->line('send_invoice_to_suppplier') ?></label>													
                                                     
                                                        <?php $posnic_supplier_mail=array('name'=>'posnic_supplier_mail',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_supplier_mail');
                                                        echo form_checkbox($posnic_supplier_mail)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="posnic_message" ><?php echo $this->lang->line('message') ?> </label>													
                                                  
                                                        <?php $posnic_message=array('name'=>'posnic_message',
                                                                               'class'=>' form-control ',
                                                                               'id'=>'posnic_message',
                                                                                'rows'=>1);
                                                        echo form_textarea($posnic_message)?>
                                                  
                                             </div>
                                        </div>
                                    </div>
                                            </div>
										</div>
									</div>
								</form>
							</div>
						</div>
                    </div>
                </div>
</section>
           <div id="footer_space">
              
           </div>
		</div>
	
<script type="text/javascript">
    function direct_grn_group_approve(){
        <?php 
        if($this->session->userdata['direct_grn_per']['approve']==1){ ?>
            var flag=0;
            var field=document.forms.posnic;
            for (i = 0; i < field.length; i++){
                if(field[i].checked==true){
                    flag=flag+1;
                }
            }
            if (flag<1) 
            {
                $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_grn');?>', { type: "warning" });
            }else{
                var posnic=document.forms.posnic;
                for (i = 0; i < posnic.length-1; i++){
                    if(posnic[i].checked==true){                             
                        $.ajax({
                            url: '<?php echo base_url() ?>/index.php/direct_grn/direct_grn_approve',
                            type: "POST",
                            data: {
                                guid:posnic[i].value
                            },
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                    $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_grn') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                    $("#dt_table_tools").dataTable().fnDraw();
                                }else if(response['responseText']=='Approved'){
                                    $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                }else{
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_grn');?>', { type: "error" });                              
                                }
                            }
                        });
                    }
                }
            }   
        <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_grn');?>', { type: "error" });                       
        <?php         
        }
        ?>
    }
    function posnic_group_item_active(){
        var flag=0;
        var field=document.forms.items_form;
        for (i = 0; i < field.length; i++){
            if(field[i].checked==true){
                flag=flag+1;
            }
        }
        if (flag<1) {
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_grn');?>', { type: "warning" });
        }else
        {
            var posnic=document.forms.items_form;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>index.php/direct_grn/item_active',
                        type: "POST",
                        data: {
                            guid:posnic[i].value
                        },
                        success: function(response)
                        {
                            if(response){
                                $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                $("#selected_item_table").dataTable().fnDraw();
                            }
                        }
                    });
                }
            }
        }    
    }
    function posnic_delete(){
    <?php 
        if($this->session->userdata['direct_grn_per']['delete']==1){ ?>
            var flag=0;
            var field=document.forms.posnic;
            for (i = 0; i < field.length; i++){
                if(field[i].checked==true){
                    flag=flag+1;
                }
            }
            if (flag<1) {
                $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_grn');?>', { type: "warning" });
            }else{
                bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('direct_grn') ?>", function(result) {
                    if(result){
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                            if(posnic[i].checked==true){ 
                                var guid=posnic[i].value;
                                $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/direct_grn/delete',
                                    type: "POST",
                                    data: {
                                        guid:posnic[i].value
                                    },
                                    complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                            $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('goods_receiving_note') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
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
        <?php         
        }else
        { ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('direct_grn');?>', { type: "error" });                       
            <?php             
        } ?>
    }
                   
    function direct_grn_group_approve(){
        <?php
        if($this->session->userdata['direct_grn_per']['approve']==1){ ?>
            var flag=0;
            var field=document.forms.posnic;
            for (i = 0; i < field.length; i++){
                if(field[i].checked==true){
                    flag=flag+1;
                }
            }
            if (flag<1) {
                $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_grn');?>', { type: "warning" });
            }else
            {
                var posnic=document.forms.posnic;
                for (i = 0; i < posnic.length-1; i++){
                    var guid=posnic[i].value;
                    if(posnic[i].checked==true){                             
                        $.ajax({
                            url: '<?php echo base_url() ?>/index.php/direct_grn/direct_grn_approve',
                            type: "POST",
                            data: {
                                guid: posnic[i].value
                            },
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                    $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_grn') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                    $("#dt_table_tools").dataTable().fnDraw();
                                }else if(response['responseText']=='Approved'){
                                    $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                }else{
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('direct_grn');?>', { type: "error" });                        
                                }
                            }
                        });
                    }
                }
            }   
    <?php 
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_grn');?>', { type: "error" });                       
        <?php      
        }  ?>
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
            $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('direct_grn');?>', { type: "warning" });
        }else{
            var posnic=document.forms.items_form;
            for (i = 0; i < posnic.length-1; i++){
                if(posnic[i].checked==true){                             
                    $.ajax({
                        url: '<?php echo base_url() ?>index.php/direct_grn/item_deactive',
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
        

      