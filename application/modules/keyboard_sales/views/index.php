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
         font-weight:bold;
    }
    #main_content {
           // margin: 0px;
            height: 544px;
            margin: 0;
          padding-left: 29px;
          padding-right: 29px;
         //   width: 84%;
            
    }
    .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
        border-top:none;
      //  line-height: 1.42857;
         padding: 0 11px 0px 10px;
        vertical-align: top;
        text-align: center;
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
    
    #selected_item_table tr th:nth-child(6),#selected_item_table tr td:nth-child(6){
      width: 170px;
    }
    
   
    #selected_item_table tr th:nth-child(4),#selected_item_table tr td:nth-child(4){
      width: 50px !important;
    }
    #selected_item_table tr th:nth-child(9),#selected_item_table tr td:nth-child(9){
      width: 20px;
    }
    #selected_item_table tr th:nth-child(8),#selected_item_table tr td:nth-child(8){
      text-align: right;
    }
    #selected_item_table tr th:nth-child(7),#selected_item_table tr td:nth-child(7){
      text-align: right;
    }
    #selected_item_table tr th:nth-child(5),#selected_item_table tr td:nth-child(5){
      text-align: right;
    }
    #selected_item_table tr th:nth-child(4),#selected_item_table tr td:nth-child(4){
      width: 150px ;
    }
    .dataTables_info {
        float: left;
        font-size: 12px;
        line-height: 32px;
    }
    .btn-info{
         background: #007da9;
         border: none;
         font-weight: normal;
         font-size: 12px;
    }
    .btn-info:hover{
         background: #007da9;
         border: none;
         
    }
    .btn-danger{
         border: none;
         font-weight: normal;
         font-size: 12px;
    }
    .btn-danger:hover{
         border: none;
         
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
         background-color: #007da9;
         color: #ffffff;
    }
    .quantity{
        font-weight: bold;
        border: solid 1px #007da9;
        border-radius: 5px;
    }
    .quantity :hover{
        font-weight: bold;
        border: solid 2px #007da9;
    }
    .quantity :focus{
        font-weight: bold;
        border: solid 2px #007da9;
    }
    .select2-results .select2-highlighted {
        background: none repeat scroll 0 0 #007da9;
    }
    .dataTables_scrollBody{
        overflow-x: hidden !important;
    }
    .amount-input{
        text-align: right;
        font-size: 22px !important;
        height: 30px;
       
    }
    .grand-total{
        font-size: 25px !important;
        height: 50px;
    }
    select[multiple], select[size] {
        font-size: 15px;
       // font-weight: bold;
        height: 200px;
    }
    .form-control:focus {
        border: solid 1px #007da9 !important;
    }
    .form-control:active {
        border: solid 1px #007da9 !important;
    }
    .modal {
        bottom: 0;
        display: none;
        left: 0;
        overflow-x: auto;
        overflow-y: hidden;
        position: fixed;
        right: 0;
        top: 0;
        z-index: 1040;
    }
</style>	
<script type="text/javascript" charset="utf-8"> 
    function save_sale(){
        <?php if($this->session->userdata['keyboard_sales_per']['sale']==1) { ?>
            var inputs=$('#parsley_reg').serialize();
            var value;
            $("#payment_type").each(function(){
                var selectedOption = $('option:selected', this);
                 value=selectedOption.val();
            });
            if(value=='cash'){
                $("#parsley_reg #first_name").addClass('required');
            }else{
                $("#parsley_reg #first_name").removeClass('required');
            }
                if($('#parsley_reg').valid()){
                    $.ajax ({
                        url: "<?php echo base_url('index.php/keyboard_sales/save')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                   $.bootstrapGrowl('<?php echo $this->lang->line('sales').' '.$this->lang->line('added');?>', { type: "success" });                     
                                   clear_form();
                                   $('#payment_modal').modal('hide');
                                   max++;
                                   $('#parsley_reg #demo_sales_bill_number').val(pre+max);
                                   $('#parsley_reg #keyboard_sales_bill_number').val(pre+max);
                                   $('#search_barcode').val("");
                                   $('#search_barcode').focus();
                            }else if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                                
                            }else if(response['responseText']=='Noop'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('sales');?>', { type: "error" });                        
                            }
                        }
                    });
                }else{
                    $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });    
                }
                
        <?php }else{
            ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('sales');?>', { type: "error" });       
            <?php
        } ?>    
    }
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
                    if(data.length>1){
                        item_data=data;
                        $('#multiple_item_select').remove();
                        $('#parent_select').append('<select name="multiple_item_select" id="multiple_item_select" class="form-control" multiple></select>');
                        $('#multiple_items').modal('show');
                        for(var i=0;i<data.length;i++){
                            if(data[i]['deco_guid']){
                                    var guid = data[i]['deco_guid'];
                                    var item_id=data[i]['deco_guid'];                                
                                    var sku=data[i]['deco_code']+"-"+data[i]['deco_value'];                                
                                    var stock=data[i]['guid']                                
                                    var name =data[i]['name']                                
                                    var price=data[i]['price'];                               
                                    var quty=1;                               
                                    var tax_value=data[i]['tax_value'];
                                    var tax_type=data[i]['tax_type_name']+"-"+tax_value+"%";                               
                                    var tax_Inclusive=data[i]['deco_tax'];                                

                                }else if(data[i]['kit_guid']){
                                    var guid = data[i]['kit_guid'];
                                    var item_id=data[i]['kit_guid'];                                
                                    var sku=data[i]['kit_code'];                                
                                    var stock=data[i]['guid']                                
                                    var name= data[i]['kit_name']                                
                                    var price=data[i]['price'];                               
                                    var quty=1;                               
                                    var tax_value=data[i]['kit_tax_value'];
                                    var tax_type=data[i]['kit_tax_type']+"-"+tax_value+"%";                                
                                    var tax_Inclusive=data[i]['kit_tax'];   
                                }else{
                                    var  items_id=data[i]['i_guid'];
                                    var  name=data[i]['name'];
                                    var  stock=data[i]['guid'];
                                    var  quty=1;
                                    if(data[i]['uom']==1){
                                        var  price=parseFloat(data[i]['price'])/parseFloat(data[i]['no_of_unit']);
                                    }else{
                                        var price=data[i]['price'];
                                    }
                                    var  items_id=data[i]['item'];
                                    var  sku=data[i]['code'];
                                    var  tax_value=data[i]['tax_value'];
                                    var  tax_type=data[i]['tax_type_name']+"-"+tax_value+"%"; 
                                    var  tax_Inclusive=data[i]['tax_Inclusive'];
                                }
                            $('#multiple_item_select').append('<option value="'+i+'" id="op_'+i+'"> \n\
                                  '+name+' - '+sku+' -: <?php echo $this->session->userdata('currency_symbol') ?> '+price  +'           \n\
                                  </option>');
                    window.setTimeout(function ()
                    {
                       $('#multiple_item_select').focus();
                    }, 200);
    
                    $('#op_0').attr('selected','selected');
                        }
                    }else{
                    
                if(data_table_duplicate('new_item_row_id_'+data[0]['guid'])){
                    var old_total=$('#new_item_row_id_'+data[0]['guid']+' #items_total').val();
                    var quty=$('#new_item_row_id_'+data[0]['guid']+' #quty_'+data[0]['guid']).val();
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
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(7)').html(discount);
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(8)').html(total);
                    $('#new_item_row_id_'+data[0]['guid']+' #quty_'+data[0]['guid']).val(parseFloat(quty));
                    $('#new_item_row_id_'+data[0]['guid']+' #items_total').val(total);
                    $('#new_item_row_id_'+data[0]['guid']+' #items_tax_amount').val(tax);
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val(amount);
                    $('#parsley_reg #demo_total_amount').val(amount);
                    new_grand_total(); 
                    new_row('new_item_row_id_'+data[0]['guid']);
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
                    
                   
                        total=total.toFixed(point);
                        tax=tax.toFixed(point);
                        discount=discount.toFixed(point);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name,
                                sku,
                            "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
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
                                '+"<label class='label label-danger'>Ctrl+Del</label>" ] );

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
                            new_row('new_item_row_id_'+data[0]['guid']);
                            clear_inputs();
                            $('#parsley_reg #tax').val(0);
                            $('#parsley_reg #item_discount').val(0);
                    }
                    }
                }
        });
    }

    </script>
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=16 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function table_row_total(id){
        var row = $('#'+id.id).closest('tr').attr('id');
        var quty=$('#'+id.id).val();        
        var old_total=$('#'+row+' #items_total').val();
      
        var price=$('#'+row+' #items_price').val();
        var tax_Inclusive=$('#'+row+' #items_tax_inclusive').val();
        var tax_value=$('#'+row+' #items_tax_value').val();
        var tax_type=$('#'+row+' #items_tax_type').val();
        var per=$('#'+row+' #items_discount_per').val();
        var discount=0;
        quty=parseFloat(quty);
        if(per!="" && per!=0){
            discount=((parseFloat(quty)*parseFloat(price))*per/100);
        }
        var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
        var total;
        var type;
        if(tax_Inclusive==1){
            total= (parseFloat(quty)*parseFloat(price))+tax-discount;
            var old_tax=$('#'+row+' #items_tax_amount').val()
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
        $('#selected_item_table #'+row+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
        $('#selected_item_table #'+row+' td:nth-child(7)').html(discount);
        $('#selected_item_table #'+row+' td:nth-child(8)').html(total);
        $('#'+row+' #items_tax_amount').val(tax);        
        $('#'+row+' #items_total').val(total);
        var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
        amount=amount.toFixed(point);
        $('#parsley_reg #total_amount').val(amount);
        $('#parsley_reg #demo_total_amount').val(amount);
        new_grand_total(); 
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
    function new_row(row){
        var rows = $("#selected_item_table").dataTable().fnGetNodes();
        for(var i=0;i<rows.length;i++)
        {
           var trid=$(rows[i]).attr('id');
           $('#'+trid).removeClass('selected');
        }
        $('#'+row).addClass('selected');
        
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
             new_grand_total();
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
                var old_quty=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #quty_'+$('#parsley_reg #stock_id').val()).val();
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
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #quty_'+$('#parsley_reg #stock_id').val()).val(parseFloat(quty));
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val(total);
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_amount').val(tax);
                var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                amount=amount.toFixed(point);
                $('#parsley_reg #total_amount').val(amount);
                $('#parsley_reg #demo_total_amount').val(amount);
                new_grand_total(); 
               
                new_row('new_item_row_id_'+$('#parsley_reg #stock_id').val());
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
                    "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
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
                    <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                    <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                    <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                    <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                    <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                    <input type="hidden" name="items_tax_amount[]" value="'+tax+'" id="items_tax_amount">\n\
                    <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                    <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                    <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                     '+"<label class='label label-danger'>Ctrl+Del</label>" ] );

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
                new_row('new_item_row_id_'+$('#parsley_reg #stock_id').val());
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
        var net=$('#selected_item_table #'+guid+' #items_total').val();
        var dis=$('#selected_item_table #'+guid+' #items_discount').val();
        var items_tax_inclusive=$('#selected_item_table #'+guid+' #items_tax_inclusive').val();
        if(items_tax_inclusive==1){
           var tax=$('#selected_item_table #'+guid+' #items_tax_amount').val();
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
        var num = parseFloat($('#total_tax').val());
        $('#total_tax').val(num.toFixed(point));
       new_grand_total(); 
         var order=$('#selected_item_table #'+guid+' #items_order_guid').val();
          $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+order+'">');
        var index=$('#selected_item_table #'+guid+' #index').val();
         var anSelected =  $("#selected_item_table").dataTable();
           anSelected.fnDeleteRow(index-1);
       
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
            var total=parseFloat($("#parsley_reg #total_amount").val())-customer_dis;
             var  bill_discount=0;
            if($('#bill_discount').val()=="" || isNaN(parseFloat($('#bill_discount').val()))){
                 bill_discount=0;
            }else{
                bill_discount=parseFloat($('#bill_discount').val());
            }
             var  bill_discount_amount=0;
            if($('#bill_discount_amount').val()=="" || isNaN(parseFloat($('#bill_discount_amount').val()))){
                 bill_discount_amount=0;
            }else{
                  bill_discount_amount=parseFloat($('#bill_discount_amount').val());
            }
            if(bill_discount!=0){
                bill_discount_amount=parseFloat(total)*parseFloat($('#bill_discount').val())/100;
                total=parseFloat(total)-parseFloat(bill_discount_amount);
            }else{
                total=parseFloat(total)-parseFloat(bill_discount_amount);
              
            }
            bill_discount_amount=parseFloat(bill_discount_amount);
            bill_discount_amount= bill_discount_amount.toFixed(point);
            console.log();
            $('#demo_bill_discount').val(bill_discount);
            $('#demo_bill_discount_amount').val(bill_discount_amount);
            $('#bill_discount_amount').val(bill_discount_amount);
            $("#parsley_reg #demo_grand_total").val(total);
            $("#parsley_reg #grand_total").val(total);
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
    va
    function posnic_add_new(){
        $.ajax({                                      
            url: "<?php echo base_url() ?>index.php/keyboard_sales/order_number/",                      
            data: "", 
            dataType: 'json',               
            success: function(data)        
            {    
                $('#parsley_reg #demo_sales_bill_number').val(data[0][0]['prefix']+data[0][0]['max']);
                $('#parsley_reg #keyboard_sales_bill_number').val(data[0][0]['prefix']+data[0][0]['max']);
                pre=data[0][0]['prefix'];
                max=data[0][0]['max'];
            }
        });
    }

</script>
<div class="row" style="background: #007da9;color: #ffffff">
    <div class="col col-lg-1">
      
    </div>  
    <div class="col col-lg-4">
        
    </div>  
    <div class="col col-lg-2">
         <h4 class="text-center">POSNIC</h4>
    </div>  
    <div class="col col-lg-3">
        
    </div>  
      
   
  
    </div>
 <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('keyboard_sales/upadate_pos_keyboard_sales_details/',$form);?>
<div class="row" style="margin-left:15px;padding-right: 25px   !important;">
        
        <div class="col col-lg-8" style="padding: 0 0 0 10px;">
                
              
                <div class="row" style="padding-top: 1px; margin: auto;">
                        
                         
                    <div class="col col-lg-12" style="  padding-left:0px;padding-right: 0px">
                            <div class="panel panel-default"  id="item_scan_panel" >
                            <div class="panel-heading" >
                                 <h4 class="panel-title"><?php echo $this->lang->line('scan')." ".$this->lang->line('items') ?></h4>

                          </div>
                                <div class="row" style="margin-top: 14px;">
                                    <div class="col col-lg-4">
                                        <label for="items" class="text-center" style="padding-top: 10px;" ><?php echo $this->lang->line('barcode')."/".$this->lang->line('EANUPC') ?></label>	
                                    </div>
                                    <div class="col col-lg-8">
                                        <input type="text" id="search_barcode" class="form-control search-input">
                                    </div>
                                </div>
                            
                            
                            </div>
                        
                        </div>
                        
                    </div>
            
            <div class="panel panel-default" style="display: none" id="item_search_panel" >
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
             <div class="form_sep" style="padding: 0px;">
                    <label for="sales_bill_number" ><?php echo $this->lang->line('sales_bill_number') ?></label>													
                             <?php $order_number=array('name'=>'demo_sales_bill_number',
                                                'class'=>'required  form-control',
                                                'id'=>'demo_sales_bill_number',
                                                'disabled'=>'disabled',
                                                'value'=>set_value('sales_bill_number'));
                                 echo form_input($order_number)?>
                    <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
               </div>
            <div class="form_sep " style="padding: 0px;">
                <label for="sales_bill_date" ><?php echo $this->lang->line('sales_bill_date') ?></label>													
                         <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                               <?php $sales_bill_date=array('name'=>'sales_bill_date',
                                                'class'=>'required form-control',
                                                'id'=>'sales_bill_date',
                                              'onKeyPress'=>"new_sales_bill_date(event)", 
                                                'value'=>date("d/m/Y"));
                                 echo form_input($sales_bill_date)?>
                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    </div>
           </div>
        </div>
        <div class="col col-lg-2">
              <div class="form_sep " style="padding: 0px;">
                <label for="first_name" ><?php echo $this->lang->line('customer') ?></label>													
                      <?php $first_name=array('name'=>'first_name',
                                        'class'=>'required  form-control',
                                        'id'=>'first_name',

                                        'value'=>set_value('first_name'));
                         echo form_input($first_name)?>

            </div>
              <div class="form_sep " style="padding: 0px;">
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
<div class="row" id="add_new_order"  style="margin-left: -4px;margin-right: -4px;margin-top: 2px">
    
                        <div class="col col-lg-12">
    
        
    <div id="main_content" >
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         
                         
                         
         
        
        
        <div class="row small_inputs" >
            
        </div>
                    <div class="row small_inputs" >
                    <div class="col col-lg-10">
                      
                         
                             
                              
                          
                          
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
                        
                    
                    </div><div class="col col-sm-2"  >
                        <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                        <div class="row" style="margin-left: 10px">
                                           
                                                        
                                                  <div class="form_sep " style="padding: 0px">
                                                            <label for="customer_discount_amount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('disc').' '.$this->lang->line('amt') ?></label>													
                                                                     <?php $customer_discount_amount=array('name'=>'customer_discount_amount',
                                                                                        'class'=>'required  form-control amount-input',
                                                                                        'id'=>'demo_customer_discount_amount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount_amount)?>
                                                            <input type="hidden" name="customer_discount_amount" id="customer_discount_amount">
                                                       </div>
                                                
                                                  
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="total_item_discount_amount" ><?php echo $this->lang->line('total_item_discount_amount') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_item_discount_amount',
                                                                                    'class'=>' form-control amount-input',
                                                                                    'id'=>'total_item_discount_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_item_discount_amount'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="total_tax" ><?php echo $this->lang->line('total_tax') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_tax',
                                                                                    'class'=>' form-control amount-input',
                                                                                    'id'=>'total_tax',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_tax'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="total_amount" ><?php echo $this->lang->line('total_amount') ?></label>													
                                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                                    'class'=>'required  form-control amount-input',
                                                                                    'id'=>'demo_total_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_amount'));
                                                                     echo form_input($total_amount)?>
                                                        <input type="hidden" name="total_amount" id="total_amount">
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="total_amount" ><?php echo $this->lang->line('bill_discount') ?> %</label>													
                                                                  <?php $bill_discount=array('name'=>'demo_bill_discount',
                                                                                    'class'=>'required  form-control amount-input',
                                                                                    'id'=>'demo_bill_discount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('bill_discount'));
                                                                     echo form_input($bill_discount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="demo_bill_discount_amount" ><?php echo $this->lang->line('bill_discount_amount') ?></label>													
                                                                  <?php $demo_bill_discount_amount=array('name'=>'demo_bill_discount_amount',
                                                                                    'class'=>'required  form-control amount-input',
                                                                                    'id'=>'demo_bill_discount_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('demo_bill_discount_amount'));
                                                                     echo form_input($demo_bill_discount_amount)?>
                                                        
                                                  </div>
                                                     
                                                         <div class="form_sep " style="padding: 0px">
                                                        <label for="grand_total" ><?php echo $this->lang->line('grand_total') ?></label>													
                                                                  <?php $grand_total=array('name'=>'demo_grand_total',
                                                                                    'class'=>'required  form-control amount-input grand-total ',
                                                                                    'id'=>'demo_grand_total',
                                                                                    'disabled'=>'disabled');
                                                                     echo form_input($grand_total)?>
                                                        <input type="hidden" name="grand_total" id="grand_total">
                                                        
                                                  </div>
                                               </div>
                        
                       
                        
                    </div>  </div>  
    </div>
   
  </div>  
    
  
</div>
<div id="sales_bill_discount" class="modal fade in"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header madal-search">
                    <button class="close" data-dismiss="modal" type="button"></button>
                    <h4 class="modal-title text-center"><?php echo $this->lang->line('bill_discount') ?></h4>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-4">    
                            <div class="form_sep " style="padding: 0px">
                                    <label for="bill_discount" ><?php echo $this->lang->line('bill_discount') ?> %</label>													
                                              <?php $bill_discount=array('name'=>'bill_discount',
                                                                'class'=>'required  form-control amount-input',
                                                                'id'=>'bill_discount',
                                                               'onKeyPress'=>"return numbersonly(event)",
                                                                'value'=>set_value('bill_discount'));
                                                 echo form_input($bill_discount)?>

                                      </div>
                                                       </div>
                        <div class="col col-lg-4">
                              <div class="form_sep " style="padding: 0px">
                                    <label for="bill_discount_amount" ><?php echo $this->lang->line('bill_discount') ?> </label>													
                                              <?php $bill_discount_amount=array('name'=>'bill_discount_amount',
                                                                'class'=>'required  form-control amount-input',
                                                                'id'=>'bill_discount_amount',
                                                                'onKeyPress'=>"return numbersonly(event)",
                                                                'value'=>set_value('bill_discount_amount'));
                                                 echo form_input($bill_discount_amount)?>

                              </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" type="button">Ctrl+S / Insert <?php echo $this->lang->line('to')." ".$this->lang->line('save') ?></button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button">Esc <?php echo $this->lang->line('to')." ".$this->lang->line('close') ?></button>
                
                </div>
            </div>
        </div>
    </div>
<div id="multiple_items" class="modal fade in"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header madal-search">
                    <button class="close" data-dismiss="modal" type="button"></button>
                    <h4 class="modal-title text-center"><?php echo $this->lang->line('items') ?></h4>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col col-lg-1"></div>
                        <div class="col col-lg-10" id="parent_select">
                            <select name="multiple_item_select" id="multiple_item_select" class="form-control" multiple>
                             
                            </select>
  
                        </div>
                      
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" type="button">Enter<?php echo $this->lang->line('to')." ".$this->lang->line('add') ?></button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button">Esc <?php echo $this->lang->line('to')." ".$this->lang->line('close') ?></button>
                
                </div>
            </div>
        </div>
    </div>
<div id="payment_modal" class="modal fade in"  >
    <div class="modal-dialog" style=" width: 760px;">
            <div class="modal-content">
                <div class="modal-header madal-search">
                    <button class="close" data-dismiss="modal" type="button"></button>
                    <h4 class="modal-title text-center"><?php echo $this->lang->line('payment') ?></h4>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-4" >
                            <label><?php echo $this->lang->line('amount') ?></label>
                            <input type="text" class="form-control" disabled="disabled" id="payment_amount"> 
                        </div>
                          <div class="col col-lg-4" >
                            <label><?php echo $this->lang->line('payment_type') ?></label>
                            <select class="form-control" id="payment_type" name="payment_type">
                                <option value="cash"><?php echo $this->lang->line('cash') ?></option>
                                <option value="card" ><?php echo $this->lang->line('card') ?></option>
                                <option value="cheque"><?php echo $this->lang->line('cheque') ?></option>
                                <option value="credit"><?php echo $this->lang->line('credit') ?></option>
                            </select>
                        </div>
                      
                    </div>
                    <div class="row" id="cash">
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-4"><label><?php echo $this->lang->line('paid_amount') ?></label>
                            <input type="text" class="form-control required" onkeyup="balance_amount()" id="paid_amount" name="paid_amount"></div>
                        <div class="col col-lg-4"> <label><?php echo $this->lang->line('balance') ?></label>
                            <input type="text" class="form-control" disabled="disabled" id="balance"></div>
                        <div class="col col-lg-2"></div>
                      
                      
                    </div>
                    
                </div>
                <div class="modal-footer">
                   
                    <button class="btn btn-success" data-dismiss="modal" type="button"><?php echo $this->lang->line('save')." & ".$this->lang->line('print') ?>( Enter / Ctrl+S) </button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button"><?php echo $this->lang->line('close') ?> ( Esc ) </button>
                
                </div>
            </div>
        </div>
    </div>
 <?php echo form_close();?>
<script type="text/javascript">
    function balance_amount(){
        var paid=$('#paid_amount').val();
        var total=$('#grand_total').val();
        var bal=parseFloat(total)-parseFloat(paid);
        $('#balance').val(bal.toFixed(point)); 
    }
</script>
<div style="margin: 0px;background: #131f2b;position: fixed;    bottom: 0;  width: 100%;">
    <div class="row" style=" padding: 2px 25px;color: #ffffff" >
         <h5 style=" margin: 0px"><?php echo $this->session->userdata('first_name') ?></h5>
          <img style="height: 44px;border: 2px solid;" src="<?php echo base_url() ?>uploads/profile_images/<?php   if($this->session->userdata('image')!=""){ echo $this->session->userdata('image'); }else{ echo 'profile.gif'; } ?>" >
        <a href="" class="btn btn-danger"> <i class="icon icon-lock"></i> <?php echo $this->lang->line('logout') ?></a>
        <a href="" class="btn btn-info">F2 <i class="icon icon-barcode"></i> <?php echo $this->lang->line('scan') ?></a>
        <a href="" class="btn btn-info">F4 <i class="icon icon-search"></i> <?php echo $this->lang->line('search') ?></a>
        <a href="" class="btn btn-info">Alt+1 <i class="icon icon-user"></i> <?php echo $this->lang->line('customer') ?></a>
        <a href="" class="btn btn-info">Alt+2 <i class="icon icon-list"></i> <?php echo $this->lang->line('item_list') ?></a>
        <a href="" class="btn btn-info">Alt+3 <i class="icon icon-search"></i> <?php echo $this->lang->line('search_added_item') ?></a>
        <a href="" class="btn btn-info">Alt+4 <i class="icon icon-money"></i> <?php echo $this->lang->line('bill_discount') ?></a>
        <a href="" class="btn btn-info">Alt+C <i class="icon icon-refresh"></i> <?php echo $this->lang->line('clear') ?></a>
        <a href="" class="btn btn-info" style="float: right">F8 <i class="icon icon-shopping-cart"></i> <?php echo $this->lang->line('payment') ?></a>
<!--        <a href="" class="btn btn-info">Delete+No <i class="icon icon-trash"></i> <?php echo $this->lang->line('delete_item') ?></a>-->
    </div>
</div>
     	
 



        

      