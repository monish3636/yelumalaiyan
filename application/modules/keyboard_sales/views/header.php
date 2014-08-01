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
	<script type="text/javascript" language="javascript" class="init">
            var point=3;
            var last_row=1;
            var delete_row=0;
            var item_data=[];
            var pre;
            var max;
         $(document).ready(function() { 
             posnic_add_new();
           var selected = [];
                $('#selected_item_table').dataTable({
                   	     "bProcessing": true,
                             "bDestroy": true ,
                             "bPaginate": false,
                             "scrollY":        "360px",
                             "scrollX":        "100%",
                             "scrollCollapse": true,
                             "sPaginationType": "bootstrap_full",
                             "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                         $("td:first", nRow).html(iDisplayIndex +1);
                         $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                     },
                }); 
                clear_form();
                
                  $('#selected_item_table tbody').on('click', 'tr', function () {
                        var id = this.id;
                        new_row(id);
                        $('#'+id +' input[type=text]').focus(); 
                    } );
                jQuery(document).bind('keydown', 'f2',function() 
                {
                    $('#item_scan_panel').show();
                    $('#item_search_panel').hide();
                    $('#items').select2('close');
                    $('#first_name').select2('close');
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
		});
                jQuery(document).bind('keydown', 'f4',function() 
                {
                    $('#item_scan_panel').hide();
                    $('#item_search_panel').show();
                    $('#items').select2('open');
                    $('#first_name').select2('close');
		});
                jQuery(document).bind('keydown', 'Alt+1',function() 
                {
                    $('#items').select2('close');
                    $('#first_name').select2('open');
		});
                jQuery(document).bind('keydown', 'Alt+2',function() 
                {
                   remove_all();
                   new_row($("#selected_item_table tbody tr:first").attr('id'));
                   $('#selected_item_table tbody tr:first input[type=text]').focus();
		});
                jQuery(document).bind('keydown', 'Alt+3',function() 
                {
                   remove_all();
                   $('#selected_item_table_filter input').focus();
                  
		});
                jQuery(document).bind('keydown', 'Alt+4',function() 
                {
                   remove_all();
                  $('#sales_bill_discount').modal('show');
                 
                   window.setTimeout(function ()
                    {
                        $('#bill_discount').focus();
                    }, 200);
                  
		});
                jQuery(document).bind('keydown', 'Alt+c',function() 
                {
                  clear_form();
                  
		});
                jQuery(document).bind('keydown', 'f8',function() 
                {
                    $('#payment_modal').modal('show');
                    $('#payment_amount').val($('#grand_total').val());                 
                    window.setTimeout(function ()
                    {
                        $('#payment_type').focus();
                    }, 200);
                  
		});
              
                jQuery('#payment_modal').bind('keydown', 'ctrl+s',function() 
                {
                    save_sale();
		});
                jQuery('#payment_modal').bind('keydown', function(e) {                 
                    if(e.which==13){
                         save_sale();
                    } 
                   
		});
                jQuery('#sales_bill_discount').bind('keydown', 'ctrl+s',function() 
                {
                    remove_all();
                    $('#sales_bill_discount').modal('hide');
                    new_grand_total();
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
                  
		});
                jQuery('#sales_bill_discount').bind('keydown', 'insert',function() 
                {
                    remove_all();
                    $('#sales_bill_discount').modal('hide');
                    new_grand_total();
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
                  
		});
                jQuery('#multiple_items').bind('keydown', function(e) {                 
                    if(e.which==13){
                        $("#multiple_items").each(function(){
                            var selectedOption = $('option:selected', this);
                            var value=selectedOption.val();
                            add_new_item(value);                           
                        });
                        remove_all();
                        $('#multiple_items').modal('hide');
                        new_grand_total();
                        window.setTimeout(function ()
                        {
                            $('#search_barcode').val("");
                            $('#search_barcode').focus();
                        }, 200);
                    }
		});
                jQuery('#multiple_items').bind('keydown', 'esc',function() 
                {
                    remove_all();
                    $('#multiple_items').modal('hide');
                    new_grand_total();
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
                  
		});
//                var timer, last,first;
//                jQuery('#sales_bill_discount').bind('keydown', function(e) {
//                    // Typing a then h will call the alert
//                    if (first==97 && last == 98 && e.which === 46) {
//                        alert('Hello World');
//                    }
//                    if(first==""){
//                        first = e.which;    
//                    }else{
//                        last = e.which;
//                    }
//                         console.log(e.which)         ;
//                                       
//                    clearTimeout(timer);
//                    timer = setTimeout(function(){
//                        last = '';
//                        first = '';
//                    }, 1000);
//                });
                jQuery('#selected_item_table').bind('keydown', 'up',function() 
                {
                    last_row++;
                    if(last_row==3){
                       var bid =$(':focus').attr('id');
                       var trid = $('#'+bid).closest('tr').attr('id');
                       var index=$('#'+trid).children('td:first').text();
                       var rows = $("#selected_item_table").dataTable().fnGetNodes();
                       index=parseInt(index)-1;
                       var up;
                       for(var i=0;i<rows.length;i++)
                       {                       
                           var row=$(rows[i]).attr('id');                        
                           if($('#'+row).children('td:first').text()==index){
                               up=row;
                           }                      
                       }
                       if(up){
                           $('#'+up).addClass('selected');
                           $('#'+trid).removeClass('selected');
                           $('#'+up +' input[type=text]').focus(); 
                       }
                           last_row=1;
                    }
		});
              
                $('#selected_item_table').bind('keydown', 'down',function() 
                {                   
                    last_row++;
                    if(last_row==3){
                        var bid =$(':focus').attr('id');
                        var trid = $('#'+bid).closest('tr').attr('id');
                        var index=$('#'+trid).children('td:first').text();
                        var rows = $("#selected_item_table").dataTable().fnGetNodes();
                        index=parseInt(index)+1;
                        var down;
                        for(var i=0;i<rows.length;i++)
                        {                       
                            var row=$(rows[i]).attr('id');

                            if($('#'+row).children('td:first').text()==index){
                                down=row;
                            }

                        }
                        if(down){
                            $('#'+down).addClass('selected');
                            $('#'+trid).removeClass('selected');
                            $('#'+down +' input[type=text]').focus(); 
                        }
                        last_row=1;
                    }                  
		});
                $('#selected_item_table').bind('keydown', 'ctrl+del',function() 
                {
                    delete_row++;               
                    if(delete_row==3){
                        var bid =$(':focus').attr('id');
                        var trid = $('#'+bid).closest('tr').attr('id');
                        var index=$('#'+trid).children('td:first').text();
                        var rows = $("#selected_item_table").dataTable().fnGetNodes();
                        delete_order_item(trid);
                        index=parseInt(index)-1;
                        console.log(index);
                        if(index==0){
                           index=1;
                        }                    
                        var up;
                        for(var i=0;i<rows.length;i++)
                        {                       
                            var row=$(rows[i]).attr('id');                        
                            if($('#'+row).children('td:first').text()==index){
                                up=row;
                            }
                        }
                        if(up){
                            $('#'+up).addClass('selected');
                            $('#'+trid).removeClass('selected');
                            $('#'+up +' input[type=text]').focus();  
                        }
                       delete_row=0;
                    }
		});
                jQuery('#payment_type').bind('keyup', function(e) {
                         $("#payment_type").each(function(){
                            var selectedOption = $('option:selected', this);
                            var value=selectedOption.val();
                            if(value=='cash'){
                                $('#cash').show();
                                $('#paid_amount').val('');
                                $('#balance').val('');
                            }else{
                                $('#cash').hide();
                            }
                        });
                });
                jQuery('#payment_type').change(function(e) {
                         $("#payment_type").each(function(){
                            var selectedOption = $('option:selected', this);
                            var value=selectedOption.val();
                            if(value=='cash'){
                                $('#cash').show();
                                $('#paid_amount').val('');
                                $('#balance').val('');
                            }else{
                                $('#cash').hide();
                            }
                        });
                });
        } );
        function remove_all(){
            $('#first_name').select2('close');
            $('#items').select2('close');
        }
        function clear_form(){
            $("#parsley_reg").trigger('reset');
            $('#selected_item_table').dataTable().fnClearTable();
          
            $('#total_amount').val('');
            $('#demo_total_amount').val('');
            $('#grand_total').val('');
            $('#demo_grand_total').val('');
            $("#parsley_reg #first_name").select2('data', {id:'',text: '<?php echo $this->lang->line('search')." ".$this->lang->line('customer') ?>'});
            posnic_add_new();  
        }
    function add_new_item(value){
        if(data_table_duplicate('new_item_row_id_'+item_data[value]['guid'])){
            var old_total=$('#new_item_row_id_'+item_data[value]['guid']+' #items_total').val();
            var quty=$('#new_item_row_id_'+item_data[value]['guid']+' #quty_'+item_data[value]['guid']).val();
            var price=$('#new_item_row_id_'+item_data[value]['guid']+' #items_price').val();
            var tax_Inclusive=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_inclusive').val();
            var tax_value=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_value').val();
            var tax_type=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_type').val();
            var tax_Inclusive2=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_inclusive2').val();
            var tax_value2=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_value2').val();
            var tax_type2=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_type2').val();
            var per=$('#new_item_row_id_'+item_data[value]['guid']+' #items_discount_per').val();
            var discount=0;
            quty=parseFloat(quty)+1;
           
            var discount=0;
            var total=parseFloat(quty)*parseFloat(price);
            var subtotal=parseFloat(quty)*parseFloat(price);
            var tax1=parseFloat(subtotal)*tax_value/100;                    
            var type1='Inc';
            if(tax_Inclusive==0){
                total= parseFloat(total)+parseFloat(tax1);
                type1='Exc';
            }
            var tax2=parseFloat(subtotal)*tax_value2/100;                    
            var type2='Inc';
            if(tax_Inclusive2==0){
                total= parseFloat(total)+parseFloat(tax2);
                type2='Exc';
            }
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
            if(isNaN(parseFloat(tax1))){
                tax1=0;
                var tax_text1='';
            }else{
                var tax_text1=tax1+':'+tax_type+'('+type1+')';
            }
            if(isNaN(parseFloat(tax2))){
                tax2=0;
                var tax_text2=0;
            }else{
                var tax_text2=tax2+':'+tax_type2+'('+type2+')';
            }
            if(per!="" && per!=0){
                discount=parseFloat(total)*per/100;
            }        
            total=parseFloat(total)-parseFloat(discount);
            var num = parseFloat(tax1);
            tax1=num.toFixed(point);
            var num = parseFloat(tax2);
            tax2=num.toFixed(point);
            var num = parseFloat(discount);
            discount=num.toFixed(point);
            var num = parseFloat(total);
            total=num.toFixed(point);
            var old_discount=$('#new_item_row_id_'+item_data[value]['guid']+' #items_discount').val();
            var old_tax1=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_amount').val();
            var old_tax2=$('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_amount2').val();
            $('#selected_item_table #new_item_row_id_'+item_data[value]['guid']+' td:nth-child(6)').html(tax_text1);
            $('#selected_item_table #new_item_row_id_'+item_data[value]['guid']+' td:nth-child(7)').html(tax_text2);
            $('#selected_item_table #new_item_row_id_'+item_data[value]['guid']+' td:nth-child(8)').html(discount);
            $('#selected_item_table #new_item_row_id_'+item_data[value]['guid']+' td:nth-child(9)').html(total);
            $('#new_item_row_id_'+item_data[value]['guid']+' #quty_'+item_data[value]['guid']).val(parseFloat(quty));
            $('#new_item_row_id_'+item_data[value]['guid']+' #items_total').val(total);
            $('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_amount').val(tax1);
            $('#new_item_row_id_'+item_data[value]['guid']+' #items_discount').val(discount);
            $('#new_item_row_id_'+item_data[value]['guid']+' #items_tax_amount2').val(tax2);
            var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
            amount=amount.toFixed(point);
            $('#parsley_reg #total_amount').val(amount);
            $('#parsley_reg #demo_total_amount').val(amount);
             if(tax_Inclusive==0){
                tax1=parseFloat(tax1)-parseFloat(old_tax1);
                if($('#parsley_reg #total_tax').val()==0){
                    $('#parsley_reg #total_tax').val(tax1);
                }else{
                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax1));
                }
            }
            if(tax_Inclusive2==0){
                tax2=parseFloat(tax2)-parseFloat(old_tax2);
                if($('#parsley_reg #total_tax').val()==0){
                    $('#parsley_reg #total_tax').val(tax2);
                }else{
                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax2));
                }
            }
            if(discount!="" && !isNaN(parseFloat(discount)) && discount!=0){
                discount=parseFloat(discount)-parseFloat(old_discount);
            }
            if($('#parsley_reg #total_item_discount_amount').val()==0){
                $('#parsley_reg #total_item_discount_amount').val(discount);

            }else{
                $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
            }
            new_grand_total(); 
            new_row('new_item_row_id_'+item_data[value]['guid']);
        }else{
            if(item_data[value]['deco_guid']){
                var guid = item_data[value]['deco_guid'];
                var items_id=item_data[value]['deco_guid'];                                
                var sku=item_data[value]['deco_code']+"-"+item_data[value]['deco_value'];                                
                var stock=item_data[value]['guid']                                
                var name =item_data[value]['name']                                
                var price=item_data[value]['price'];                               
                var quty=1;                               
                var tax_value=item_data[value]['tax_value'];
                var tax_type=item_data[value]['tax_type_name']+"-"+tax_value+"%";                               
                var tax_Inclusive=item_data[value]['tax_Inclusive'];                                
                var tax_value2=item_data[value]['tax_value2'];
                var tax_type2=item_data[value]['tax2_type']+"-"+tax_value2+"%"; 
                var tax_Inclusive2=item_data[value]['tax_inclusive2'];
                var per=0;

            }else if(item_data[value]['kit_guid']){
                var guid = item_data[value]['kit_guid'];
                var items_id=item_data[value]['kit_guid'];                                
                var sku=item_data[value]['kit_code'];                                
                var stock=item_data[value]['guid']                                
                var name= item_data[value]['kit_name']                                
                var price=item_data[value]['price'];                               
                var quty=1;                               
                var tax_value=item_data[value]['kit_tax_value'];
                var tax_type=item_data[value]['kit_tax_type']+"-"+tax_value+"%";                                
                var tax_Inclusive=item_data[value]['kit_tax'];  
                var tax_value2=0;
                var tax_type2=0; 
                var tax_Inclusive2=0;  
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
                var  tax_value2=item_data[value]['tax2_value'];
                var  tax_type2=item_data[value]['tax2_type']+"-"+tax_value2+"%"; 
                var  tax_Inclusive2=item_data[value]['tax_inclusive2'];
                var per=0;
                per=item_data[value]['discount'];
            }
            var discount=0;
            var total=parseFloat(quty)*parseFloat(price);
            var subtotal=parseFloat(quty)*parseFloat(price);
            var tax1=parseFloat(subtotal)*tax_value/100;                    
            var type1='Inc';
            if(tax_Inclusive==0 && !isNaN(parseFloat(tax1))){
                total= parseFloat(total)+parseFloat(tax1);
                type1='Exc';
            }
         
            var tax2=parseFloat(subtotal)*tax_value2/100;                    
            var type2='Inc';
            if(tax_Inclusive2==0 && !isNaN(parseFloat(tax2))){
                total= parseFloat(total)+parseFloat(tax2);
                type2='Exc';
            }
            
            if(discount==""){
                discount=0;
            }
            if(isNaN(parseFloat(per))){
                per=0;
            }
            discount=parseFloat(total)*parseFloat(per)/100;
            var num = parseFloat(tax1);
            tax1=num.toFixed(point);
            var num = parseFloat(tax2);
            tax2=num.toFixed(point);
            var num = parseFloat(discount);
            discount=num.toFixed(point);
            if(isNaN(parseFloat(tax1))){
                tax1=0;
                var tax_text1='';
            }else{
                var tax_text1=tax1+':'+tax_type+'('+type1+')';
            }
            if(isNaN(parseFloat(tax2))){
                tax2=0;
                var tax_text2=0;
            }else{
                var tax_text2=tax2+':'+tax_type2+'('+type2+')';
            }
                   
            total=parseFloat(total)-parseFloat(discount);
            var num = parseFloat(tax1);
            tax1=num.toFixed(point);
            var num = parseFloat(tax2);
            tax2=num.toFixed(point);
            var num = parseFloat(discount);
            discount=num.toFixed(point);
            var num = parseFloat(total);
            total=num.toFixed(point);
            var addId = $('#selected_item_table').dataTable().fnAddData( [
                null,
                name,
                sku,
                "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
                price,
                tax_text1,
                tax_text2,
                discount,
                total,
                '<input type="hidden" name="index" id="index">\n\
                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax2">\n\
                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_Inclusive2+'" id="items_tax_inclusive2">\n\
                <input type="text" name="items_tax_amount[]" value="'+tax1+'" id="items_tax_amount">\n\
                <input type="text" name="items_tax_amount2[]" value="'+tax2+'" id="items_tax_amount2">\n\
                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                '+"<label class='label label-danger'>Ctrl+Del</label>" 
            ] );

            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
            theNode.setAttribute('id','new_item_row_id_'+stock);
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
            if(tax_Inclusive==0){
                if($('#parsley_reg #total_tax').val()==0){
                    $('#parsley_reg #total_tax').val(tax1);
                }else{
                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax1));
                }
            }
            if(tax_Inclusive2==0){
                if($('#parsley_reg #total_tax').val()==0){
                    $('#parsley_reg #total_tax').val(tax2);
                }else{
                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax2));
                }
            }
            if($('#parsley_reg #total_item_discount_amount').val()==0){
                $('#parsley_reg #total_item_discount_amount').val(discount);

            }else{
                $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
            }
            $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
            new_grand_total(); 
            new_row('new_item_row_id_'+item_data[value]['guid']);
            clear_inputs();
            $('#parsley_reg #tax').val(0);
            $('#parsley_reg #item_discount').val(0);
        }
    }
	</script>
	
</head>
<body>