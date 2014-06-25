<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>POSNIC</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/todc-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/img/flags/flags.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/retina.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/bootstrap-switch.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/hint-css/hint.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/theme/color_1.css" id="theme">
               
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/ie.css">
                <script src="<?php echo base_url() ?>template/app/js/ie/html5shiv.js"></script>
                <script src="<?php echo base_url() ?>template/app/js/ie/respond.min.js"></script>
                <script src="<?php echo base_url() ?>template/app/js/ie/excanvas.min.js"></script>
        <![endif]-->

         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/multi-select/css/multi-select.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/multi-select/css/ebro_multi-select.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/select/select2.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/select2/ebro_select2.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/datepicker/css/datepicker.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/colorpicker/css/colorpicker.css">
         <link href="<?php echo base_url() ?>template/app/js/lib/iCheck/skins/minimal/minimal.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/timepicker/css/bootstrap-timepicker.min.css">
         <link href="<?php echo base_url() ?>template/app/validation/prettify.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/validate/css/wizard.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/keyboard/style.css">
         <link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">
	 <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/extras/TableTools/media/css/TableTools.css">     
	    

	
	 
	
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
	<script src="<?php echo base_url() ?>template/shortcut/jquery.hotkeys-0.7.9.min.js" type="text/javascript"></script>
	
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/jquery-ui.js"></script> 
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/select2.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/keyboard/jquery.dataTables.js"></script>
        <link href="<?php echo base_url() ?>template/keyboard/css/keyboard.css" rel="stylesheet">
	<script src="<?php echo base_url() ?>template/keyboard/js/jquery.keyboard.js"></script>
	<script src="<?php echo base_url() ?>template/keyboard/js/jquery.mousewheel.js"></script>
	<script src="<?php echo base_url() ?>template/keyboard/js/jquery.keyboard.extension-typing.js"></script>
	<script type="text/javascript" language="javascript" class="init">
            var point=3;
            var item_data=[];
            var pre;
            var max;
            var prevFocus;
            $(document).ready( function () { 
                 $('#scan_items').focus();
                $('#selected_item_table tbody').on('click', 'tr', function () {
                    var rows = $("#selected_item_table").dataTable().fnGetNodes();
                    for(var i=0;i<rows.length;i++)
                    {
                       var row=$(rows[i]).attr('id');
                       $('#'+row).removeClass('selected');
                           
                    }
                    var id = this.id;
                    $(this).addClass('selected');
                    $('#'+id +' .quantity').focus(); 
                    //$('#'+id +' .quantity').attr('disabled','disabled'); 
                } );
                posnic_add_new();
                $('.qwerty:first').keyboard({ layout: 'qwerty' });
                scan_items();
                $('#selected_item_table').dataTable({
                    "bProcessing": true,
                    "bDestroy": true ,
                    "bPaginate": false,
                    "scrollY":        "453px",
                    "scrollX":        "100%",
                    "scrollCollapse": true,
                    "sPaginationType": "bootstrap_full",
                    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                        $("td:first", nRow).html(iDisplayIndex +1);
                        $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                    },
                }); 
                function format_customers(sup) {
                    if (!sup.id) return sup.text;
                        return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
                        return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-12"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('company') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('address') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('phone') ?></div> \n\
                                   </div> \n\
                                </div>     \n\
                            </div>\n\ ';
                }
                $('#customer').change(function() {
                    var guid = $('#parsley_reg #customer').select2('data').id;
                    $('#demo_customer_discount').val($('#parsley_reg #customer').select2('data').discount);
                    $('#customer_discount').val($('#parsley_reg #customer').select2('data').discount);
                    new_grand_total();
                    $('#customers_guid').val(guid);             
                });
          $('#customer').select2({
              dropdownCssClass : 'customers_select',
               formatResult: format_customers,
                formatSelection: format_customers,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('customer') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/touch_sales/search_customer',
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
            $('#search_items').change(function() {
                 if(data_table_duplicate('new_item_row_id_'+$('#search_items').select2('data').sid)){
                    var old_total=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_total').val();
                    var quty=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #quty_'+$('#search_items').select2('data').sid).val();
                    var price=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_price').val();
                    var tax_Inclusive=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_tax_inclusive').val();
                    var tax_value=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_tax_value').val();
                    var tax_type=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_tax_type').val();
                    var per=$('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_discount_per').val();
                    var discount=0;
                    quty=parseFloat(quty)+1;
                    if(per!="" && per!=0){
                        discount=((parseFloat(quty)*parseFloat(price))*per/100);
                    }
                    var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
                    var total;
                    var type;
                     if(tax_Inclusive==1){
                        total= (parseFloat(quty)*parseFloat(price))+tax-discount;
                        var old_tax=((parseFloat(quty-1)*parseFloat(price))*tax_value)/100;
                        var total_tax=$('#total_tax').val();
                        total_tax=total_tax-old_tax+tax;
                        total_tax=parseFloat(total_tax);
                        total_tax=total_tax.toFixed(point);
                        $('#total_tax').val(total_tax);
                        type='Exc';
                    }else{
                        type='Inc';
                        total= (parseFloat(quty)*parseFloat(price))-discount;
                    }
                    total=parseFloat(total);
                    total=total.toFixed(point);
                    discount=parseFloat(discount);
                    discount=discount.toFixed(point);
                    tax=parseFloat(tax);
                    tax=tax.toFixed(point);                    
                    $('#new_item_row_id_'+$('#search_items').select2('data').sid+' #quty_'+$('#search_items').select2('data').sid).val(parseFloat(quty));
                    $('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_total').val(total);
                    $('#new_item_row_id_'+$('#search_items').select2('data').sid+' #items_tax_amount').val(tax);
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val(amount);
                    $('#parsley_reg #demo_total_amount').val(amount);
                    new_grand_total(); 
               
                }else{
                    if($('#search_items').select2('data').deco_guid){
                        var guid = $('#search_items').select2('data').deco_guid;
                        var item_id=$('#search_items').select2('data').deco_guid;                                
                        var sku=$('#search_items').select2('data').deco_code+"-"+$('#search_items').select2('data').deco_value;                                
                        var stock=$('#search_items').select2('data').sid ;                               
                        var name =$('#search_items').select2('data').text ;                               
                        var price=$('#search_items').select2('data').price;                               
                        var quty=1;                               
                        var tax_value=$('#search_items').select2('data').tax_value;
                        var tax_type=$('#search_items').select2('data').tax_type_name+"-"+tax_value+"%";                               
                        var tax_Inclusive=$('#search_items').select2('data').deco_tax;                                

                    }else if($('#search_items').select2('data').kit_guid){
                        var guid = $('#search_items').select2('data').kit_guid;
                        var item_id=$('#search_items').select2('data').kit_guid;                                
                        var sku=$('#search_items').select2('data').kit_code;                                
                        var stock=$('#search_items').select2('data').sid                                
                        var name=$('#search_items').select2('data').kit_name;                                
                        var price=$('#search_items').select2('data').price;                               
                        var quty=1;                               
                        var tax_value=$('#search_items').select2('data').kit_tax_value;
                        var tax_type=$('#search_items').select2('data').kit_tax_type+"-"+tax_value+"%";                                
                        var tax_Inclusive=$('#search_items').select2('data').kit_tax;   
                    }else{
                        var  items_id=$('#search_items').select2('data').i_guid;
                        var  name=$('#search_items').select2('data').text;
                        var  stock=$('#search_items').select2('data').sid;
                        var  quty=1;
                        if($('#search_items').select2('data').uom==1){
                            var  price=parseFloat($('#search_items').select2('data').price)/parseFloat($('#search_items').select2('data').no_of_unit);
                        }else{
                            var price=$('#search_items').select2('data').price;
                        }
                        var  items_id=$('#search_items').select2('data').item;
                        var  sku=$('#search_items').select2('data').value;
                        var  tax_value=$('#search_items').select2('data').tax_value;
                        var  tax_type=$('#search_items').select2('data').tax_type_name+"-"+tax_value+"%"; 
                        var  tax_Inclusive=$('#search_items').select2('data').tax_Inclusive;
                    }
                    var discount=0;
                    var per=0;
                    if($('#search_items').select2('data').end_date!=0 && $('#search_items').select2('data').end_date!=""){
                        var  discount=((parseFloat(quty)*parseFloat(price))*$('#search_items').select2('data').discount)/100;
                        var  per=$('#search_items').select2('data').discount;
                    }
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
                    
               
                        total=total.toFixed(point);
                        tax=tax.toFixed(point);
                        discount=discount.toFixed(point);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name+"-"+sku,
                                 price,
                            "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
                               
                                '<input type="hidden" name="index" id="index">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                                <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_tax_amount[]" value="'+tax+'" id="items_tax_amount">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                '+"<a href='javascript:remove_row("+stock+")' class='btn btn-danger'><i class='icon icon-trash'></i></a>" ] );

                            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                            theNode.setAttribute('id','new_item_row_id_'+stock)
                            $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                            if (isNaN($("#parsley_reg #total_amount").val())) 
                                $("#parsley_reg #total_amount").val(0);    
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
                            new_grand_total(); 
                          
                     
                    }
                    $('#multiple_items').modal('hide');
                    $("#parsley_reg #search_items").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('items') ?>'});
            });
            function format_item(sup) {
                if (!sup.id) return sup.text;
             if(sup.deco_code){
                var code=sup.deco_code;
              
                 return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-8"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('sku') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('price') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('stock') ?></div> \n\
                                   </div> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4">'+code+'</div> \n\
                                        <div class="col col-lg-4">'+sup.price+'</div> \n\
                                        <div class="col col-lg-4">'+sup.quty+'</div> \n\
                                   </div> \n\
                                </div>     \n\
                                <div class="col col-lg-4"> \n\
                                    <img src="http://localhost/posnic//uploads/items/item.gif" style="height:78px"> \n\
                                </div> \n\
                            </div>\n\
                             <div class="row">\n\
                                <div class="col col-lg-4">'+sup.department+'</div> \n\
                                    <div class="col col-lg-4">'+sup.category+'</div> \n\
                                    <div class="col col-lg-4"> '+sup.brand+'</div> \n\
                                </div> ';
            }else if(sup.kit_guid){
                var code=sup.kit_code;
               
                return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-8"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('sku') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('price') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('no_of_items') ?></div> \n\
                                   </div> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4">'+code+'</div> \n\
                                        <div class="col col-lg-4">'+sup.price+'</div> \n\
                                        <div class="col col-lg-4">'+sup.no_of_items+'</div> \n\
                                   </div> \n\
                                </div>     \n\
                                <div class="col col-lg-4"> \n\
                                    <img src="http://localhost/posnic//uploads/items/item.gif" style="height:78px"> \n\
                                </div> \n\
                            </div>\n\
                            <div class="row">\n\
                                    <div class="col col-lg-4">'+sup.kit_category+'</div> \n\
                                </div> ';
            }else{
                var code=sup.value;
                if(sup.uom==0){
                  var price=sup.price;                
                }else{
                  var price= parseFloat(sup.price)/parseFloat(sup.no_of_unit);                    
                }                
                return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-8"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('sku') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('price') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('stock') ?></div> \n\
                                   </div> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4">'+code+'</div> \n\
                                        <div class="col col-lg-4">'+price+'</div> \n\
                                        <div class="col col-lg-4">'+sup.quty+'</div> \n\
                                   </div> \n\
                                </div>     \n\
                                <div class="col col-lg-4"> \n\
                                    <img src="http://localhost/posnic//uploads/items/item.gif" style="height:78px"> \n\
                                </div> \n\
                            </div>\n\
                            <div class="row">\n\
                                <div class="col col-lg-4">'+sup.department+'</div> \n\
                                    <div class="col col-lg-4">'+sup.category+'</div> \n\
                                    <div class="col col-lg-4"> '+sup.brand+'</div> \n\
                                </div> ';
                
                
            }
                
                   // return  "<p >"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p>"+sup.value+"</p><p>"+sup.category+"</p><p>"+sup.brand+"</p><p>"+sup.department+" </p><p><?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p> ";
                  
            }
          $('#search_items').select2({
             
              dropdownCssClass : 'item_select',
              formatResult: format_item,
                formatSelection: format_item,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/touch_sales/search_items/',
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
                      });  
                      return {
                       
                          results: results
                      };
                    }
                }
            });
            $('.select2-container .select2-choice div b').click(function(){
            alert('jibi');
            })
               
            });
            function scan_items(){
                $('#search_div').hide();
                $('#scan_div').show();
            }
            function search_items(){
                $('#search_div').show();
                $('#scan_div').hide();
            }
             function add_new_item(value){
                    if(data_table_duplicate('new_item_row_id_'+item_data[value]['guid'])){
                    var old_total=$('#new_item_row_id_'+item_data[value]['guid']+' #items_total').val();                    
                    var quty=$('#new_item_row_id_'+item_data[value]['guid']+' #quty_'+item_data[value]['guid']).val();
                    var price=$('#new_item_row_id_'+item_data[value]['guid']+' #items_price').val();
                    var tax_Inclusive=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_inclusive').val();
                    var tax_value=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_value').val();
                    var tax_type=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_type').val();
                    var per=$('#new_item_row_id_'+item_data[value]['guid']+' #items_discount_per').val();
                    var discount=0;
                    quty=parseFloat(quty)+1;
                    if(per!="" && per!=0){
                        discount=((parseFloat(quty)*parseFloat(price))*per/100);
                    }
                    var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
                    var total;
                    var type;
                    if(tax_Inclusive==1){
                        total= (parseFloat(quty)*parseFloat(price))+tax-discount;
                        var old_tax=((parseFloat(quty-1)*parseFloat(price))*tax_value)/100;
                        var total_tax=$('#total_tax').val();
                        total_tax=total_tax-old_tax+tax;
                        total_tax=parseFloat(total_tax);
                        total_tax=total_tax.toFixed(point);
                        $('#total_tax').val(total_tax);
                        type='Exc';
                    }else{
                        type='Inc';
                        total= (parseFloat(quty)*parseFloat(price))-discount;
                    }
                    total=parseFloat(total);
                    total=total.toFixed(point);
                    discount=parseFloat(discount);
                    discount=discount.toFixed(point);
                    tax=parseFloat(tax);
                    tax=tax.toFixed(point);                    
                    $('#new_item_row_id_'+item_data[value]['guid']+' #quty_'+item_data[value]['guid']).val(parseFloat(quty));
                    $('#new_item_row_id_'+item_data[value]['guid']+' #items_total').val(total);
                    $('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_amount').val(tax);
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val(amount);
                    $('#parsley_reg #demo_total_amount').val(amount);
                    new_grand_total(); 
               
                }else{
                    if(item_data[value]['deco_guid']){
                        var guid = item_data[value]['deco_guid'];
                        var item_id=item_data[value]['deco_guid'];                                
                        var sku=item_data[value]['deco_code']+"-"+item_data[value]['deco_value'];                                
                        var stock=item_data[value]['guid']                                
                        var name =item_data[value]['name']                                
                        var price=item_data[value]['price'];                               
                        var quty=1;                               
                        var tax_value=item_data[value]['tax_value'];
                        var tax_type=item_data[value]['tax_type_name']+"-"+tax_value+"%";                               
                        var tax_Inclusive=item_data[value]['deco_tax'];   
                        var discount=0;
                        var per=0;
                        if(item_data[value]['end_date']!=0 && item_data[value]['end_date']!=""){
                            var  discount=((parseFloat(quty)*parseFloat(price))*item_data[value]['discount'])/100;
                            var  per=item_data[value]['discount'];
                            alert(per);
                        }

                    }else if(item_data[value]['kit_guid']){
                        var guid = item_data[value]['kit_guid'];
                        var item_id=item_data[value]['kit_guid'];                                
                        var sku=item_data[value]['kit_code'];                                
                        var stock=item_data[value]['guid']                                
                        var name= item_data[value]['kit_name']                                
                        var price=item_data[value]['price'];                               
                        var quty=1;                               
                        var tax_value=item_data[value]['kit_tax_value'];
                        var tax_type=item_data[value]['kit_tax_type']+"-"+tax_value+"%";                                
                        var tax_Inclusive=item_data[value]['kit_tax'];   
                        var discount=0;
                        var per=0;
                    }else{
                        var  items_id=item_data[value]['i_guid'];
                        var  name=item_data[value]['name'];
                        var  stock=item_data[value]['guid'];
                        var  quty=1;
                        if(item_data[value]['uom']==1){
                            var  price=parseFloat(item_data[value]['price'])/parseFloat(item_data[value]['no_of_unit']);
                        }else{
                            var price=item_data[value]['price'];
                        }
                        var  items_id=item_data[value]['item'];
                        var  sku=item_data[value]['code'];
                        var  tax_value=item_data[value]['tax_value'];
                        var  tax_type=item_data[value]['tax_type_name']+"-"+tax_value+"%"; 
                        var  tax_Inclusive=item_data[value]['tax_Inclusive'];
                        var discount=0;
                        var per=0;
                        if(item_data[value]['end_date']!=0 && item_data[value]['end_date']!=""){
                            var  discount=((parseFloat(quty)*parseFloat(price))*item_data[value]['discount'])/100;
                            var  per=item_data[value]['discount'];
                            alert(per);
                        }
                    }
                   
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
                    
                   
                        total=total.toFixed(point);
                        tax=tax.toFixed(point);
                        discount=discount.toFixed(point);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name+"-"+sku,
                                 price,
                            "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
                             
                                '<input type="hidden" name="index" id="index">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                                <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_tax_amount[]" value="'+tax+'" id="items_tax_amount">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                '+"<a href=javascript:remove_row('"+stock+"') class='btn btn-danger'><i class='icon icon-trash'></i></a>" ] );

                            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                            theNode.setAttribute('id','new_item_row_id_'+stock)
                            $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                            if (isNaN($("#parsley_reg #total_amount").val())) 
                                $("#parsley_reg #total_amount").val(0);    
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
                          new_grand_total(); 
                         
                            $('#parsley_reg #tax').val(0);
                            $('#parsley_reg #item_discount').val(0);
                    }
                    $('#multiple_items').modal('hide');
        }
        function clear_form(){
            $("#parsley_reg").trigger('reset');
            $('#selected_item_table').dataTable().fnClearTable();          
            $('#total_amount').val('');
            $('#demo_total_amount').val('');
            $('#grand_total').val('');
            $('#demo_grand_total').val('');
            $("#parsley_reg #first_name").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('customer') ?>'});
            $("#parsley_reg #search_items").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('items') ?>'});
            posnic_add_new();
        }
        </script>
             
