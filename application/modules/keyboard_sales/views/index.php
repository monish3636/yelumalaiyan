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
    #main_content {
            margin: 0px;
            overflow-y: scroll;
            height: 457px;
    }
    .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
        border-top:none;
        line-height: 1.42857;
        padding: 6px;
        vertical-align: top;
    }
    .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
        background-color: #ffffff ;
    }
    .panel-default .panel-heading{
        background: #007da9;
        color: #ffffff;
        border: #007da9;
    }
    .panel-default {
    border: medium solid #007da9;
   
    }
    .madal-search {
      background: #007da9;
       color: #ffffff;
   
    }
    
    #selected_item_table tr td:nth-child(6){
      width: 150px;
    }
    #selected_item_table tr td:nth-child(9){
      width: 50px;
    }
    div.dt-bottom-row {
         display: none;
    }
    .btn-info{
         background: #007da9;
    }
    .row + .row {
        margin-top: 0;
    }
    .search-input{
        border-radius: 10px;
        height: 32px;
        margin: auto auto 10px;
        width: 90%;   
        background: #e3eaf3;
        color: #000;
        color: black;
        font-weight: 900;
            
    }
    #sales_quty{
        border-radius: 10px;
        margin: auto auto 10px;
        width: 90%;   
        background: #e3eaf3;
        color: #000;
        color: black;
        font-weight: 900;
            
    }
    label {
        font-weight: bold;
    }
    .selected{
         background-color: #f2b835;
    }
</style>	
<script type="text/javascript" charset="utf-8">   
    $(document).ready(function(){
        $('#search_barcode').focusout(function(){
            window.setTimeout(function ()
            {
             //   $('#search_barcode').focus();
            }, 0);
        });
        $('#search_barcode').keyup(function(e){
            barcode = $(this);
            if( (e.keyCode == 13)|| (barcode.val().length > 10)){
                sendBarcode(barcode.val());
                barcode.val('');
                $('#search_barcode').focus();
            } 
        });
    });
    function sendBarcode(b){
        $.ajax({                                      
            url: "<?php echo base_url() ?>index.php/keyboard_sales/get_items/"+b,                      
            data: "", 
            dataType: 'json',               
            success: function(data)        
                {       
                if(data_table_duplicate('new_item_row_id_'+data[0]['guid'])){
                    var old_total=$('#new_item_row_id_'+data[0]['guid']+' #items_total').val();
                    var quty=$('#new_item_row_id_'+data[0]['guid']+' #sales_quty').val();
                    var price=$('#new_item_row_id_'+data[0]['guid']+' #items_price').val();
                    var tax_Inclusive=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_inclusive').val();
                    var tax_value=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_value').val();
                    var tax_type=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_type').val();
                    var per=$('#new_item_row_id_'+data[0]['guid']+' #items_discount_per').val();
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
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(6)').html(tax +''+' : '+tax_type+'-'+tax_value+'%('+type+')');
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(7)').html(discount);
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(8)').html(total);
                    $('#new_item_row_id_'+data[0]['guid']+' #sales_quty').val(parseFloat(quty));
                    $('#new_item_row_id_'+data[0]['guid']+' #items_total').val(total);
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val(amount);
                    $('#parsley_reg #demo_total_amount').val(amount);
                    new_grand_total(); 
                }else{
                    if(data[0]['deco_guid']){
                        var guid = data[0]['deco_guid'];
                        var item_id=data[0]['deco_guid'];                                
                        var sku=data[0]['deco_code']+"-"+data[0]['deco_value'];                                
                        var stock=data[0]['guid']                                
                        var name =data[0]['name']                                
                        var price=data[0]['price'];                               
                        var quty=1;                               
                        var tax_value=data[0]['tax_value'];
                        var tax_type=data[0]['tax_type_name']+"-"+tax_value+"%";                               
                        var tax_Inclusive=data[0]['deco_tax'];                                

                    }else if(data[0]['kit_guid']){
                        var guid = data[0]['kit_guid'];
                        var item_id=data[0]['kit_guid'];                                
                        var sku=data[0]['kit_code'];                                
                        var stock=data[0]['guid']                                
                        var name= data[0]['kit_name']                                
                        var price=data[0]['price'];                               
                        var quty=1;                               
                        var tax_value=data[0]['kit_tax_value'];
                        var tax_type=data[0]['kit_tax_type']+"-"+tax_value+"%";                                
                        var tax_Inclusive=data[0]['kit_tax'];   
                    }else{
                        var  items_id=data[0]['i_guid'];
                        var  name=data[0]['name'];
                        var  stock=data[0]['guid'];
                        var  quty=1;
                        if(data[0]['uom']==1){
                            var  price=parseFloat(data[0]['price'])/parseFloat(data[0]['no_of_unit']);
                        }else{
                            var price=data[0]['price'];
                        }
                        var  items_id=data[0]['item'];
                        var  sku=data[0]['code'];
                        var  tax_value=data[0]['tax_value'];
                        var  tax_type=data[0]['tax_type_name']+"-"+tax_value+"%"; 
                        var  tax_Inclusive=data[0]['tax_Inclusive'];
                    }
                    var discount=0;
                    var per=0;
                    if(data[0]['end_date']!=0 && data[0]['end_date']!=""){
                        var  discount=((parseFloat(quty)*parseFloat(price))*data[0]['discount'])/100;
                        var  per=data[0]['discount'];
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
                    
                    $('#newly_added').append('<div id="newly_added_items_list_'+stock+'"> \n\
                        \n\
                        <input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+stock+'">\n\
                        <input type="hidden" name="new_item_stock_id[]" value="'+stock+'"  id="new_item_stock_id_'+stock+'">\n\
                        <input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+stock+'"> \n\
                        <input type="hidden" name="new_item_discount[]" value="'+per+'" id="new_item_discount_id_'+stock+'"> \n\
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
                                "<input type='text' class='form-control text-center' value='"+quty+"' id='sales_quty'>",
                                price,
                                tax+' : '+tax_type+'('+type+')',
                                discount,
                                total,
                                '<input type="hidden" name="index" id="index">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                                <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                 '+"&nbsp;<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

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
                            clear_inputs();
                            $('#parsley_reg #tax').val(0);
                            $('#parsley_reg #item_discount').val(0);
                    }
                }
        });
    }

    </script>
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
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
    $(document).ready( function () {
        $('#items').change(function() {
            if($('#items').select2('data').deco_guid)
            {
                var guid = $('#items').select2('data').deco_guid;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').deco_code+'-'+$('#items').select2('data').deco_value);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').text);

                $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price));

                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').tax_type+"-"+$('#items').select2('data').tax_value+"%");
                var tax=$('#items').select2('data').deco_tax;
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

            }else if($('#items').select2('data').kit_guid){
                var guid = $('#items').select2('data').kit_guid;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').kit_code);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').kit_name);
                $('#parsley_reg #price').val(parseFloat($('#items').select2('data').kit_price));
                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').kit_tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').kit_tax_type+"-"+$('#items').select2('data').kit_tax_value+"%");
                var tax=$('#items').select2('data').kit_tax;
                var tax_amount=$('#items').select2('data').kit_tax_amount;
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
            }else{
                var guid = $('#items').select2('data').item;  
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').value);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').text);
                if($('#items').select2('data').uom==0){
                    $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price));
                }else{
                    $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price)/parseFloat($('#items').select2('data').no_of_unit));
                }
                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').tax_type+"-"+$('#items').select2('data').tax_value+"%");
              
                var start=$('#items').select2('data').start;
                var end=$('#items').select2('data').end;           
                var tax=$('#items').select2('data').tax_Inclusive;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }                
                if(start==0 && end==0){
                    $('#parsley_reg #discount').val(0);  
                }else{
                    $('#parsley_reg #discount').val($('#items').select2('data').discount);
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
        });
        function format_item(sup) {
            if (!sup.id) return sup.text;
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
        $('#items').select2({
            dropdownCssClass : 'item_select',
            formatResult: format_item,
            formatSelection: format_item,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/keyboard_sales/search_items/',
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
        function format_customers(sup) {
            if (!sup.id) return sup.text;
                return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
        }
        $('#parsley_reg #first_name').change(function() {           
            var guid = $('#parsley_reg #first_name').select2('data').id;
            $('#first_name').val($('#parsley_reg #first_name').select2('data').text);
            $('#demo_customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
            $('#customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
            $('#customers_guid').val(guid);
        });
        $('#first_name').select2({
            dropdownCssClass : 'customers_select',
            formatResult: format_customers,
            formatSelection: format_customers,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('customer') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/keyboard_sales/search_customer',
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
    


</script>
    


  
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
                if (unicode!=27){
                }
                else{
                    $('#items').select2('open');
                }
            }
        }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
            $('#items').select2('open');
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
            if(parseFloat($('#quantity').val())>parseFloat($('#stock_quty').val())){
                $('#quantity').val($('#stock_quty').val());
                $.bootstrapGrowl('<?php echo $this->lang->line('avilable_stock_is') ;?> '+$('#stock_quty').val(), { type: "warning" }); 
            }
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
            }else
            {
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
                var old_total=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val();
                var old_quty=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #sales_quty').val();
                var price=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_price').val();
                var tax_Inclusive=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_inclusive').val();
                var tax_value=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_value').val();
                var tax_type=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_type').val();
                var per=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_discount_per').val();
                var discount=0;
                quty=parseFloat(old_quty)+parseFloat($('#quantity').val());
                if(per!="" && per!=0){
                    discount=((parseFloat(quty)*parseFloat(price))*per/100);
                }
                var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
                var total;
                var type;
                if(tax_Inclusive==1){
                    total= (parseFloat(quty)*parseFloat(price))+tax-discount;
                    var old_tax=((parseFloat(old_quty)*parseFloat(price))*tax_value)/100;
                    var total_tax=$('#total_tax').val();
                    total_tax=total_tax-old_tax+tax;
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
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(7)').html(discount);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(8)').html(total);
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #sales_quty').val(parseFloat(quty));
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val(total);
                var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                amount=amount.toFixed(point);
                $('#parsley_reg #total_amount').val(amount);
                $('#parsley_reg #demo_total_amount').val(amount);
                new_grand_total(); 
                clear_inputs();
            }else{
                var  name=$('#parsley_reg #item_name').val();
                var  stock=$('#parsley_reg #stock_id').val();
                var  sku=$('#parsley_reg #sku').val();
                var  quty=$('#parsley_reg #quantity').val();
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
                total=total.toFixed(point);
                tax=tax.toFixed(point);
                discount=discount.toFixed(point);
                var addId = $('#selected_item_table').dataTable().fnAddData( [
                    null,
                    name,
                    sku,
                    "<input type='text' class='form-control text-center' value='"+quty+"'  id='sales_quty'>",
                    price,
                    tax+' : '+tax_type+'('+type+')',
                    discount,
                    total,
                    '<input type="hidden" name="index" id="index">\n\
                    <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                    <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                    <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                    <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                    <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                    <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                    <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                    <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                    <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                    <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                    <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                    <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                    <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                    <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                    '+"<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                    var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                theNode.setAttribute('id','new_item_row_id_'+stock)
                $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #total_amount").val())) 
                    $("#parsley_reg #total_amount").val(0)    
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
                clear_inputs();
                $('#parsley_reg #tax').val(0);
                $('#parsley_reg #item_discount').val(0);
            }  
            
             $('#items').select2('data', {id:'',text: '<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>'});
             $('#items').select2('open');
        }else{
            if($('#parsley_reg #item_id').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#items').select2('open');
            }
            else if($('#parsley_reg #quantity').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
                $('#parsley_reg #quantity').focus();
            }
            else{
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#items').select2('open');
            }
        }
        $('#parsley_reg #tax').val(0);
        $('#parsley_reg #item_discount').val(0);
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
        new_grand_total(); 
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
        window.setTimeout(function ()
        {
           $('#parsley_reg #tax').val(0);
        $('#parsley_reg #item_discount').val(0);
        }, 0);

    }
    function new_grand_total(){
        if(parseFloat($("#parsley_reg #total_amount").val())>0){
            if($('#parsley_reg #customer_discount').val()==0 || isNaN($('#parsley_reg #customer_discount').val())){
                var  customer_dis=0;
            }else{
                customer_dis=parseFloat($('#parsley_reg #total_amount').val())*parseFloat($('#parsley_reg #customer_discount').val())/100;
                var customer_dis = parseFloat(customer_dis);
                $('#demo_customer_discount_amount').val(customer_dis.toFixed(point));
                $('#customer_discount_amount').val(customer_dis.toFixed(point));
            }
            $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-customer_dis);
            $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-customer_dis);
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
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
            $("#parsley_reg #demo_total_amount").val(0)
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
            $("#parsley_reg #demo_grand_total").val(0)
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
            $("#parsley_reg #grand_total").val(0)
    }

</script>
    <div class="row">
        <a class="btn btn-info" style="width: 100%">POSNIC</a>
    </div>
 <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('keyboard_sales/upadate_pos_keyboard_sales_details/',$form);?>
    <div class="row">
        <div class="col col-lg-2">
             <div class="form_sep" style="padding: 0 0 0 10px;">
                    <label for="sales_bill_number" ><?php echo $this->lang->line('sales_bill_number') ?></label>													
                             <?php $order_number=array('name'=>'demo_sales_bill_number',
                                                'class'=>'required  form-control',
                                                'id'=>'demo_sales_bill_number',
                                                'disabled'=>'disabled',
                                                'value'=>set_value('sales_bill_number'));
                                 echo form_input($order_number)?>
                    <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
               </div>
            <div class="form_sep " style="padding: 0 0 0 10px;">
                <label for="sales_bill_date" ><?php echo $this->lang->line('sales_bill_date') ?></label>													
                         <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                               <?php $sales_bill_date=array('name'=>'sales_bill_date',
                                                'class'=>'required form-control',
                                                'id'=>'sales_bill_date',
                                              'onKeyPress'=>"new_sales_bill_date(event)", 
                                                'value'=>set_value('order_date'));
                                 echo form_input($sales_bill_date)?>
                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    </div>
           </div>
        </div>
        <div class="col col-lg-8">
                
              
                <div class="row" style="padding-top: 1px; margin: auto;">
                        <div class="col col-lg-2"></div>
                         
                        <div class="col col-lg-8">
                            <div class="panel panel-default"  id="item_scan_panel" >
                            <div class="panel-heading" >
                                 <h4 class="panel-title"><?php echo $this->lang->line('scan')." ".$this->lang->line('items') ?></h4>

                          </div>
                             <label for="items" class="text-center" ><?php echo $this->lang->line('barcode')."/".$this->lang->line('EANUPC') ?></label>	
                            <input type="text" id="search_barcode" class="form-control search-input">
                            </div>
                        
                        </div>
                        <div class="col col-lg-2"></div>
                    </div>
            
            <div class="panel panel-default" style="margin-top: 4px ;display: none" id="item_search_panel" >
                <div class="panel-heading" >
                     <h4 class="panel-title"><?php echo $this->lang->line('search')." ".$this->lang->line('items') ?></h4>                                                                               
              </div>        
             <div class="row small_inputs" id="sales_items_list" style="margin-left: 0px;margin: 0px" >
                        <div class="col col-lg-12">
                            <div class="row" style="padding-top: 1px; margin: auto;margin-bottom: 10px;">
                                 
                                  
                                                <div class="col col-sm-3" style="padding:1px; ">
                                             
                                                   
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
                                                
                                                 <div class="col col-lg-2" style="padding:1px;">
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
                                                
                                                
                                                
                                                     
                                              
                                                    <div class="col col-lg-2" style="padding:1px;">
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
                                          
                                                
                                  
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;">
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
                                               
                                               
                                               
                          
                                          
                                     <br>
                                                                     
                              </div>
                        </div>
                    </div>
                    </div>
<!--           fatay-->
        </div>
        <div class="col col-lg-2">
              <div class="form_sep " style="padding: 0 10px 0 0;">
                <label for="first_name" ><?php echo $this->lang->line('customer') ?></label>													
                      <?php $first_name=array('name'=>'first_name',
                                        'class'=>'required  form-control',
                                        'id'=>'first_name',

                                        'value'=>set_value('first_name'));
                         echo form_input($first_name)?>

            </div>
              <div class="form_sep " style="padding: 0 10px 0 0;">
                <label for="customer_discount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>													
                         <?php $customer_discount=array('name'=>'customer_discount',
                                            'class'=>'required  form-control',
                                            'id'=>'demo_customer_discount',
                                            'disabled'=>'disabled',
                                            'value'=>set_value('customer_discount'));
                             echo form_input($customer_discount)?>
                <input type="hidden" name="customer_discount" id="customer_discount">
                <input type="hidden" name="customers_guid" id="customers_guid">
           </div>
        </div>
    </div>
<div class="row" id="add_new_order"  style="margin-left: -4px;margin-right: -4px;margin-top: 20px">
    
                        <div class="col col-lg-12">
    
        
    <div id="main_content" style="padding: 0 16px  !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         
                         
                         
         
        
        
        <div class="row small_inputs" >
            
        </div>
                    <div class="row small_inputs" >
                    <div class="col col-lg-12">
                      
                         
                             
                              
                          
                          
                        <div class="row" ><input type="hidden" value="0" id='sl_number'>
             
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('order_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table dataTable ">
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
                        
                    
                    </div><div class="col col-sm-2" style="display: none" >
                        <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                        <div class="row" style="margin-left: 5px">
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
                              </div>        
                                                         <div class="form_sep" style="padding: 0 25px">
                                                            <label for="sales_bill_number" ><?php echo $this->lang->line('sales_bill_number') ?></label>													
                                                                     <?php $order_number=array('name'=>'demo_sales_bill_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_sales_bill_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('sales_bill_number'));
                                                                         echo form_input($order_number)?>
                                                            <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
                                                       </div>
                                                        <div class="form_sep " style="padding: 0 25px">
                                                            <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                       
                                                        </div>
                                                          <div class="form_sep " style="padding: 0 25px">
                                                            <label for="customer_discount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>													
                                                                     <?php $customer_discount=array('name'=>'customer_discount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount)?>
                                                            <input type="hidden" name="customer_discount" id="customer_discount">
                                                            <input type="hidden" name="customers_guid" id="customers_guid">
                                                       </div>
                                                  <div class="form_sep " style="padding: 0 25px">
                                                            <label for="customer_discount_amount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('disc').' '.$this->lang->line('amt') ?></label>													
                                                                     <?php $customer_discount_amount=array('name'=>'customer_discount_amount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount_amount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount_amount)?>
                                                            <input type="hidden" name="customer_discount_amount" id="customer_discount_amount">
                                                       </div>
                                                <div class="form_sep " style="padding: 0 25px">
                                                            <label for="sales_bill_date" ><?php echo $this->lang->line('sales_bill_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $sales_bill_date=array('name'=>'sales_bill_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'sales_bill_date',
                                                                                          'onKeyPress'=>"new_sales_bill_date(event)", 
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($sales_bill_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                  
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_item_discount_amount" ><?php echo $this->lang->line('total_item_discount_amount') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_item_discount_amount',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_item_discount_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_item_discount_amount'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_tax" ><?php echo $this->lang->line('total_tax') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_tax',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_tax',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_tax'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
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
                        
                       
                        
                    </div>  </div>  
    </div>
   
  </div>  
    

</div>
 <?php echo form_close();?>
<div class="row" style="margin: 20px;">
        <a href="" class="btn btn-info">F2 <i class="icon icon-barcode"></i> <?php echo $this->lang->line('scan') ?></a>
        <a href="" class="btn btn-info">F3 <i class="icon icon-search"></i> <?php echo $this->lang->line('search') ?></a>
        <a href="" class="btn btn-info">Alt+1 <i class="icon icon-user"></i> <?php echo $this->lang->line('customer') ?></a>
        <a href="" class="btn btn-info">Alt+2 <i class="icon icon-list"></i> <?php echo $this->lang->line('item_list') ?></a>
        <a href="" class="btn btn-info">Alt+3 <i class="icon icon-search"></i> <?php echo $this->lang->line('search_added_item') ?></a>
<!--        <a href="" class="btn btn-info">Delete+No <i class="icon icon-trash"></i> <?php echo $this->lang->line('delete_item') ?></a>-->
    </div>
          
		</div>
  
  

</body>
</html>
        

      