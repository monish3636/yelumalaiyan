<style type="text/css">
    
    .header{
        background: #405b75;
        overflow-x: hidden;
      //  overflow-y: hidden;
    }
    .item_right{
        background: #e3eaf3;
        height: 435px; 
      //  border: solid 3px #003333;
        white-space: nowrap;
         overflow-x: hidden;
        overflow-y: hidden;
    }
    .item{
        height: 80px;
        margin-bottom: 2px;
        white-space: normal;
        width: 19.5322%;
        background: #99417b;
        color: #ffffff;
        border: solid 2px #99417b;
        border-radius: 10px;
    }
    .item a{
        color: #ffffff;
    }
    .header-bar{
        //margin-top: 5px;
    }
    .row + .row {
        margin-top:4px;
    }
    .item strong{
        color: black;
        font-size: 15px;
    }
    .randomStuff{
        background-color:red;
        border: 3px solid green;
        position:absolute;
        width:100px;
        height:100px;
    }
    .item-nav{
        background: #e3eaf3;
    }
    .numbers{
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 1px;
        margin-left: 1px;
        margin-right: 1px;
        margin-top: 1px;
        padding: 12px;
        width: 32%;
    }
    .numbers hover{
        background: #e3eaf3 !important;
    }
    .search-input{
        height: 44px;
        font-size: 18px;
        width: 100%;
    }
    .item-list{
        background: #e3eaf3;
        overflow: auto;
        height: 486px;
        overflow-x: hidden;
        
    }
    .item-list h5{
        font-weight: bold;
    }
    .item-amount{
        background: #e3eaf3;
        
    }
    .quantty{
        width: 30px;
    }
    .customers_select{
        height: 560px;
    }
    .select2-results {
        max-height: 518px;
    }
    .select2-container .select2-choice {    
        height: 44px;
        line-height: 44px;
      text-align: center;
    }
    .select2-container .select2-choice div {
        width: 36px;
        //display: none;
    }
    .select2-container .select2-choice div b {
        background: url("template/app/select/Search.png") no-repeat scroll 0 1px rgba(0, 0, 0, 0);
        display: block;
        height: 100%;
        width: 100%;
    }
    .item_select{
        height: 559px;
        width: 393px !important;
    }
    .keyboard-key{
        height: 66px;
        width: 70px;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-enter{
        height: 66px;
        width: 117%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-submit{
        height: 66px;
        width: 117%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        margin-left: 15px;
        padding: 22px;
    }
    .keyboard-key-space{
        height: 66px;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-clear{
        height: 66px;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-div{
        padding-left: 0px;
        padding-left: 0px;
    }
    .keyboard-key-row{
        margin-left: 0;
        margin-right: 0px;
        margin-top: -22px;
    }
    .keyboard-modal
    {
        width: 900px;
        background: #e3eaf3;
        border-radius: 8px;
        margin-top: 29.3%;
    }
    .modal-dialog {
        padding-bottom: 8px;
    }
    .modal {
        overflow-y: hidden;
    }
    .ui-keyboard {
        left: 0 !important;
        margin: auto !important;
        position: relative !important;
        top: -217.2px !important;
        width: 62% !important;
        background: #007da9 !important;
    }
    .ui-keyboard-button {
        min-height: 3em !important;
        width: 5% !important;
          border: 1px solid transparent;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.42857;
        margin-bottom: 0;
        padding: 6px 12px;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }
    #multiple_item_select .item{
        margin: 2px !important;
    }
    .quantity{
        width: 76px;
        border: solid 1px #007da9;
        border-radius: 5px;
    }
    .quantity :hover{
        border: solid 2px #007da9;
    }
    .quantity :focus{
        
        border: solid 2px #007da9; //413
    }
    #selected_item_table tr th:nth-child(5),#selected_item_table tr td:nth-child(5){
      width: 40px !important;
    }
    #selected_item_table tr th:nth-child(4),#selected_item_table tr td:nth-child(4){
      width: 77px !important;
    }
    #selected_item_table tr th:nth-child(3),#selected_item_table tr td:nth-child(3){
      width: 70px !important;
    }
    #selected_item_table tr th:nth-child(2),#selected_item_table tr td:nth-child(2){
      width: 190px !important;
    }
    #selected_item_table tr th:nth-child(1),#selected_item_table tr td:nth-child(1){
      width: 35px !important;
    }
    #demo_total_amount{
        font-weight: bold;
        font-size: 18px;
    }
    .amount-input{
        font-weight: bold;
        font-size: 15px;
        text-align: right;
    }
    .grand-total{
        font-weight: bold;
        font-size: 20px;
        
    }
    .dataTables_info {
        float: left;
        font-size: 12px;
        line-height: 32px;
    }
    .payment_body .btn{
        padding: 15px 12px;
        width:100px;
        height: 50px
    }
    .selected{
         background-color: #405b75;
         color: #ffffff;
    }
</style>
<script>
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=16 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function table_row_total(id){
        var row = $('#'+id).closest('tr').attr('id');
        var quty=$('#'+id).val();  
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
        $('#'+row+' #items_tax_amount').val(tax);        
        $('#'+row+' #items_total').val(total);
        var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
        amount=amount.toFixed(point);
        $('#parsley_reg #total_amount').val(amount);
        $('#parsley_reg #demo_total_amount').val(amount);
        new_grand_total(); 
    }
    function posnic_add_new(){
        $.ajax({                                      
            url: "<?php echo base_url() ?>index.php/keyboard_sales/order_number/",                      
            data: "", 
            dataType: 'json',               
            success: function(data)        
            {                 
                $('#parsley_reg #keyboard_sales_bill_number').val(data[0][0]['prefix']+data[0][0]['max']);
                pre=data[0][0]['prefix'];
                max=data[0][0]['max'];
            }
        });
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
    $(document).ready(function(){           
        $(".quantity").live('focusin', function(){
            prevFocus = $(this);
        });
        $('#scan_items').keyup(function(e){
            barcode = $(this);
            if( (e.keyCode == 13)|| (barcode.val().length > 10)){
                sendBarcode(barcode.val());
                barcode.val('');
                $('#scan_items').focus();
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
                        $('#parent_select').append('<div  id="multiple_item_select" />');
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
                            $('#multiple_item_select').append('     <a href="javascript:add_new_item('+i+')" ><div class=" btn btn-warning item">'+name+' <br> '+sku+'<br><strong> <?php echo $this->session->userdata('currency_symbol') ?> '+price+'</strong></div></a>');
                 
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
                                name+'-'+sku,
                                price,
                            "<input type='text' name='items_quty[]' class='form-control text-center quantity' value='"+quty+"' id='quty_"+stock+"' onkeyup='table_row_total(this);' onkeypress='return numbersonly(event)'>",
                              //  price,
                               // tax+' : '+tax_type+'('+type+')',
                               // discount,
                               // total,
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
                            total_tax=parseFloat($('#total_tax').val());
                            total_tax=total_tax.toFixed(point);
                            $('#total_tax').val(total_tax);
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
                    }
                }
        });
    }
    function remove_row(guid){
        var net=$('#selected_item_table #new_item_row_id_'+guid+' #items_total').val();
        var dis=$('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val();
        var items_tax_inclusive=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val();
        if(items_tax_inclusive==1){
           var tax=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_amount').val();
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
         var order=$('#selected_item_table #new_item_row_id_'+guid+' #items_order_guid').val();
          $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+order+'">');
        var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
         var anSelected =  $("#selected_item_table").dataTable();
           anSelected.fnDeleteRow(index-1);
       
        if($("#parsley_reg #total_amount").val()==0 || $("#parsley_reg #total_amount").val()==""){
            $("#parsley_reg #demo_grand_total").val(0)
            $("#parsley_reg #grand_total").val(0)
        }
    }
        function new_grand_total(){
              $('.quantity').attr('disabled','disabled'); 
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
        }else{
            $("#parsley_reg #demo_grand_total").val(0);
            $("#parsley_reg #grand_total").val(0);
            $("#parsley_reg #total_amount").val(0)  ;
            $("#parsley_reg #demo_total_amount").val(0);
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
    function new_row(row){
        var rows = $("#selected_item_table").dataTable().fnGetNodes();
        for(var i=0;i<rows.length;i++)
        {
           var trid=$(rows[i]).attr('id');
           $('#'+trid).removeClass('selected');
        }
        $('#'+row).addClass('selected');
        
    }
</script>
<body class="header">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('keyboard_sales/upadate_pos_keyboard_sales_details/',$form);?>
    <div id="container " >

  <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
        <div class="row header-bar">
            <div class="col col-xs-1 ">
            </div>
            <div class="col col-xs-4 ">
                <div class="row" style="margin: 33px 10px 10px -10px;">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-user icon-2x"></i></span>
                        <input id="customer" class="form-control search-input" type="text">
                        
                    </div>
                </div>
                <div class="row" style="margin: 10px 10px 10px -10px;" id="search_div">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-shopping-cart icon-2x"></i></span>
                        <input id="search_items" class="form-control search-input" type="text">
                        <span class="input-group-addon" style="width:  43px"><a href="javascript:scan_items()"><i class="icon icon-barcode icon-2x"></i></a></span>
                    </div>
                </div>
                <div class="row" style="margin: 10px 10px 10px -10px;" id="scan_div">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-shopping-cart icon-2x"></i></span>
                        <input id="scan_items" class="form-control search-input" type="text">
                        <span class="input-group-addon " style="width:  43px"><a href="javascript:search_items()"><i class="icon icon-search icon-2x "></i></a></span>
                    </div>
                </div>
                <div class="row item-list" style="margin-right: 10px;margin-left:-10px;padding: 10px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <h4 class="panel-title"><?php echo $this->lang->line('order_items') ?></h4>                                                                               
                        </div>
                        <table id='selected_item_table' class="dataTable">
                            <thead>
                                <tr> 
                                    <td><?php echo $this->lang->line('no') ?></td>
                                    <td><?php echo $this->lang->line('item') ?></td>
                                    <td><?php echo $this->lang->line('price') ?></td>
                                    <td><?php echo $this->lang->line('qty') ?></td>
                                    <td></td>
                                </tr>
                            </thead>
                        <tbody>
                            
                        </tbody>
                        </table>
                    </div>
                    
                   
                   
                   
                  
                   
                </div>
                <div class="row item-list" style="margin-right: 10px;margin-left:-10px;padding: 10px;height:117px">
                    <div class="row">
                            <div class="col col-xs-6">  
                                <label for="total_amount" style=" font-weight: bold; font-size: 18px;"><?php echo $this->lang->line('total_amount') ?></label>	
                                  </div> <div class="col col-xs-6">
                                         <div class="form_sep " style="padding: 0px">
                                     												
                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                    'class'=>'required  form-control amount-input',
                                                                    'id'=>'demo_total_amount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('total_amount'));
                                                     echo form_input($total_amount)?>
                                        <input type="hidden" name="total_amount" id="total_amount">

                                  </div>
                                  </div>
                                  </div>
                    <div class="row">
                            <div class="col col-xs-6">
                                  <label for="total_item_discount_amount" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('total_item_discount_amount') ?></label>	
                                  </div> <div class="col col-xs-6">

                                         <div class="form_sep " style="padding: 0px">
                                      												
                                                  <?php $total_item_discount_amount=array('name'=>'total_item_discount_amount',
                                                                    'class'=>' form-control amount-input pull-right',
                                                                    'id'=>'total_item_discount_amount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('total_item_discount_amount'));
                                                     echo form_input($total_item_discount_amount)?>

                                  </div>
                                  </div>
                                  </div>
                                 <div class="row">
                            <div class="col col-xs-6" >    <label for="total_tax" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('total_tax') ?></label>	
                                  </div> <div class="col col-xs-6">
                                         <div class="form_sep " style="padding: 0px">
                                    												
                                                  <?php $total_item_discount_amount=array('name'=>'total_tax',
                                                                    'class'=>' form-control amount-input',
                                                                    'id'=>'total_tax',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('total_tax'));
                                                     echo form_input($total_item_discount_amount)?>

                                  </div>
                                  </div>
                                  </div>
                                 
                </div>
                
            </div>
            <div class="col col-xs-6  ">
                <div class="row">
                    <div class="col col-xs-4 btn btn-default">
                        <a ><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('brand') ?></a>
                    </div>
                    <div class="col col-xs-4 btn btn-default">
                           <a class=""><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('category') ?></a>
                    </div>
                    <div class="col col-xs-4 btn btn-default">
                           <a class=""><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('item_department') ?></a>
                    </div>
                </div>
                <div class="row item_right " style="padding: 2px" id="stuff">
                    <div class="col col-xs-12">
                          <div class="row" >
                            <?php $i=0; foreach ($row as $item){ 
                                if($i%6==0){
                                    echo '  </div><div class="row" >';
                                }
                                $i++;
                                ?>
                            <div class=" btn btn-warning item">
                            <a class=""><?php echo $item['name']." <br>".$item['code']."<br><strong>".$this->session->userdata('currency_symbol')." ". $item['price']."</strong>" ?></a>
                            </div>
                           <?php } ?>
                          </div>
                          <div class="row" >
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
                          </div>
                          <div class="row" >
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
                          </div>
                      
                           
                            
                       
                    </div>
                </div>
               
                <div class="row">
                    <div class="col col-xs-7" >
                        <div class="row item-amount" style="margin-right: 10px;margin-left:-15px;padding: 10px"> 
                            <div class="row">
                            <div class="col col-xs-6">
                                  <label for="customer_discount_amount" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>	
                            </div> <div class="col col-xs-6">
                                        <div class="form_sep " style="padding: 0px">                                          												
                                                 <?php $demo_customer_discount=array('name'=>'demo_customer_discount',
                                                                    'class'=>'required  form-control amount-input',
                                                                    'id'=>'demo_customer_discount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('demo_customer_discount'));
                                                     echo form_input($demo_customer_discount)?>
                                           <input type="hidden" name="customer_discount" id="customer_discount">
                                       </div>
                            </div>
                            </div> 
                            <div class="row">
                            <div class="col col-xs-6">
                                  <label for="customer_discount_amount" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('customer').' '.$this->lang->line('disc').' '.$this->lang->line('amt') ?></label>	
                            </div> <div class="col col-xs-6">
                                        <div class="form_sep " style="padding: 0px">                                          												
                                                 <?php $customer_discount_amount=array('name'=>'customer_discount_amount',
                                                                    'class'=>'required  form-control amount-input',
                                                                    'id'=>'demo_customer_discount_amount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('customer_discount'));
                                                     echo form_input($customer_discount_amount)?>
                                        <input type="hidden" name="customer_discount_amount" id="customer_discount_amount">
                                        <input type="hidden" name="customers_guid" id="customers_guid">
                                       </div>
                            </div>
                            </div> 
                                 <div class="row">
                            <div class="col col-xs-6">
                                  <label for="total_amount" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('bill_discount') ?> %</label>
                                  </div> <div class="col col-xs-6">
                                         <div class="form_sep " style="padding: 0px">
                                      													
                                                  <?php $bill_discount=array('name'=>'demo_bill_discount',
                                                                    'class'=>'required  form-control amount-input',
                                                                    'id'=>'demo_bill_discount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('bill_discount'));
                                                     echo form_input($bill_discount)?>

                                  </div>
                                  </div>
                                 </div>
                                 <div class="row">
                            <div class="col col-xs-6">
                                  <label for="demo_bill_discount_amount" style=" font-weight: bold; font-size: 14px;"><?php echo $this->lang->line('bill_discount_amount') ?></label>	
                                  </div> <div class="col col-xs-6">
                                         <div class="form_sep " style="padding: 0px">
                                      												
                                                  <?php $demo_bill_discount_amount=array('name'=>'demo_bill_discount_amount',
                                                                    'class'=>'required  form-control amount-input',
                                                                    'id'=>'demo_bill_discount_amount',
                                                                    'disabled'=>'disabled',
                                                                    'value'=>set_value('demo_bill_discount_amount'));
                                                     echo form_input($demo_bill_discount_amount)?>

                                  </div>
                                  </div>
                                  </div>
                                 <div class="row">
                            <div class="col col-xs-6">
                                   <label for="grand_total" style=" font-weight: bold; font-size: 19px;"><?php echo $this->lang->line('grand_total') ?></label>	
                                </div> <div class="col col-xs-6">
                                         <div class="form_sep " style="padding: 0px">
                                     												
                                                  <?php $grand_total=array('name'=>'demo_grand_total',
                                                                    'class'=>'required  form-control amount-input grand-total ',
                                                                    'id'=>'demo_grand_total',
                                                                    'disabled'=>'disabled');
                                                     echo form_input($grand_total)?>
                                        <input type="hidden" name="grand_total" id="grand_total">

                                  </div>
                                  </div>
                                
                            </div>
                        </div>
                        <div class="row" style="margin-right:-5px">
                            <div class="col col-xs-6 ">
                                <div class="row " style="width: 100%">
                                    <a href="javascript:bill_discount_modal()" class=" btn btn-info" style="width: 100%;padding-bottom: 14px; padding-top: 14px;"><i class="icon icon-gift"></i> <?php echo $this->lang->line('bill_discount') ?></a>
                                </div>
                                <div class="row " style="width: 100%">
                                    <a href="javascript:clear_form()" class=" btn btn-danger" style="width: 100%;padding-bottom: 14px; padding-top: 14px;"><i class="icon icon-refresh"></i> <?php echo $this->lang->line('clear') ?></a>
                                </div>
                               
                            </div>
                            <div class="col col-xs-6">
                                <a href="javascript:payment_modal_show()" class=" btn btn-success" style="width: 100%;padding-bottom: 40px; padding-top: 40px;"><i class="icon icon-save"></i> <?php echo $this->lang->line('bill') ?></a>
                            </div>
                        </div>
                      
                    </div>
                    <div class="col col-xs-5">
                        <div class="row" style="margin-right: -15px">
                            <div class="col col-xs-5 btn btn-default"><a class=""><i class="icon icon-backward"></i> <?php echo $this->lang->line('previous') ?></a></div>
                            <div class="col col-xs-2"></div>
                            <div class="col col-xs-5 btn btn-default"><a ><?php echo $this->lang->line('next') ?> <i class="icon icon-forward"></i></a></div>
                        </div>
                        <div class="row" style="margin-right: -25px">
                            <a href="javascript:number_value(1)" class="col col-xs-4 btn btn-default numbers" >1</a>
                            <a href="javascript:number_value(2)" class="col col-xs-4 btn btn-default numbers">2</a>
                            <a href="javascript:number_value(3)" class="col col-xs-4 btn btn-default numbers">3</a>
                            <a href="javascript:number_value(4)" class="col col-xs-4 btn btn-default numbers">4</a>
                            <a href="javascript:number_value(5)" class="col col-xs-4 btn btn-default numbers">5</a>
                            <a href="javascript:number_value(6)" class="col col-xs-4 btn btn-default numbers">6</a>
                            <a href="javascript:number_value(7)" class="col col-xs-4 btn btn-default numbers">7</a>
                            <a href="javascript:number_value(8)" class="col col-xs-4 btn btn-default numbers">8</a>
                            <a href="javascript:number_value(9)" class="col col-xs-4 btn btn-default numbers">9</a>
                            <a href="javascript:number_value(.)" class="col col-xs-4 btn btn-default numbers">.</a>
                            <a href="javascript:number_value(0)" class="col col-xs-4 btn btn-default numbers">0</a>
                            <a href="javascript:number_value(101)" class="col col-xs-4 btn btn-default numbers"><?php echo $this->lang->line('clear'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-xs-1 ">
                 <a href="javascript:show_key_board()" class="btn btn-danger"><i class="icon icon-off  "></i> </a>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="keyboard">
        <div class="modal-dialog keyboard-modal"  >
            <div class="row keyboard-key-row">
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Q</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">W</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">E</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">R</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">T</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Y</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">U</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">I</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">O</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">P</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key"><-</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">DEL</a></div>
             
            </div>
            <div class="row keyboard-key-row">
                <div class="col col-xs-1 keyboard-key-div" style="margin-left: 34px"><a href="" class="btn btn-default keyboard-key">Q</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">W</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">E</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">R</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">T</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Y</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">U</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">I</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">O</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">P</a></div>
                <div class="col col-xs-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-default keyboard-key-enter">Enter</a></div>               
             
            </div>
             <div class="row keyboard-key-row">
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">abc</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Z</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">X</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">C</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">V</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">B</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">N</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">M</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">,</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">.</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">'</a></div>
                <div class="col col-xs-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">123</a></div>
             
            </div>
            <div class="row keyboard-key-row">
                <div class="col col-xs-2 keyboard-key-div" style="margin-left: 34px"><a href="" class="btn btn-danger keyboard-key-clear">Clear</a></div>
              
                <div class="col col-xs-6 keyboard-key-div"><a href="" class="btn btn-default keyboard-key-space"> </a></div>
                <div class="col col-xs-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-default keyboard-key-enter">#$@</a></div>               
                <div class="col col-xs-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-success keyboard-key-submit">Submit</a></div>               
             
            </div>
        </div>
    </div>
    <div id="multiple_items" class="modal fade in"  >
        <div class="modal-dialog" style="width: 62%">
            <div class="modal-content">
                <div class="modal-header madal-search">
                    <button class="close" data-dismiss="modal" type="button"></button>
                    <h4 class="modal-title text-center"><?php echo $this->lang->line('items') ?></h4>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col col-lg-1"></div>
                        <div class="col col-lg-10">
                            <div  id="parent_select" class="row" >
                             
                            
                            <div  id="multiple_item_select" >
                             
                            </div>
                            </div>
  
                        </div>
                      
                    </div>
                    
                </div>
                <div class="modal-footer">
                  
                    <a href="javascript:function({$('#multiple_items').modal('hide')})" class="btn btn-danger" data-dismiss="modal" type="button"> <?php echo $this->lang->line('close') ?></a>
                
                </div>
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
                    <a class="btn btn-success" href="javascript:add_bill_discount()"><?php echo $this->lang->line('save') ?></a>
                    <button class="btn btn-danger" data-dismiss="modal" type="button"><?php echo $this->lang->line('close') ?></button>
                
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
                <div class="modal-body payment_body"> 
                    <div class="row">
                        <div class="col col-lg-2"></div>
                        <div class="col col-lg-4">
                            <div class="row" style="margin-top: 10px">
                                <a href="javascript:payment_type('cash')" class="btn btn-info" ><?php echo $this->lang->line('cash') ?></a>
                            </div> 
                            <div class="row" style="margin-top: 10px">
                                <a href="javascript:payment_type('card')" class="btn btn-success"><?php echo $this->lang->line('card') ?></a>
                            </div> 
                            <div class="row" style="margin-top: 10px">
                                <a href="javascript:payment_type('cheque')" class="btn btn-warning"><?php echo $this->lang->line('cheque') ?></a>
                            </div> 
                            <div class="row" style="margin-top: 10px">
                                <a href="javascript:payment_type('credit')" class="btn btn-danger" ><?php echo $this->lang->line('credit') ?></a>
                            </div>
                        </div>
                        <div class="col col-lg-4" >
                            <div class="row">
                            <label><?php echo $this->lang->line('amount') ?></label>
                            <input type="text" class="form-control" disabled="disabled" id="payment_amount"> </div>
                             <div class="row" id="cash"><label><?php echo $this->lang->line('paid_amount') ?></label>
                            <input type="text" class="form-control required" onkeyup="balance_amount()" id="paid_amount" name="paid_amount">
                            <label><?php echo $this->lang->line('balance') ?></label>
                            <input type="text" class="form-control" disabled="disabled" id="balance">
                      
                      
                    </div>
                        </div>
                         
                      
                    </div>
                   
                    
                </div>
                <div class="modal-footer">
                   
                    <button class="btn btn-success" data-dismiss="modal" type="button"><?php echo $this->lang->line('save')." & ".$this->lang->line('print') ?> </button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button"><?php echo $this->lang->line('close') ?> </button>
                
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close() ?> 
    <script>
        function number_value(key){
            if(key==101){
                var id=prevFocus.attr('id');
                prevFocus.val(parseInt(quty));
                prevFocus.val(0);
                prevFocus.focus();
                table_row_total(id);
            }else{
                var id=prevFocus.attr('id');
                var quty=prevFocus.val();
                if(quty==0){
                    quty=key;
                }else{
                    quty=quty+key;
                }
                prevFocus.val(parseInt(quty));
                prevFocus.focus();
                table_row_total(id);
            }
        }
        function bill_discount_modal(){
            $('#sales_bill_discount').modal('show');
        }
        function payment_modal_show(){
            $('#payment_modal').modal('show');
            $('#payment_amount').val($('#grand_total').val());   
        }
        function payment_type(value){
            if(value=='cash'){
                $('#cash').show();
            }else{
                $('#cash').hide();
            }
        }
        function balance_amount(){
            var paid=$('#paid_amount').val();
            var total=$('#grand_total').val();
            var bal=parseFloat(total)-parseFloat(paid);
            $('#balance').val(bal.toFixed(point)); 
        }
        function add_bill_discount(){
             new_grand_total();
              $('#sales_bill_discount').modal('hide');
        }
        function show_key_board(){
            $('#keyboard').modal('show');
        }
        var x,y,top,left,down;
        $("#stuff").mousedown(function(e){
            e.preventDefault();
            down=true;
            x=e.pageX;
            y=e.pageY;
            top=$(this).scrollTop();
            left=$(this).scrollLeft();
        });

        $("body").mousemove(function(e){
            if(down){
                var newX=e.pageX;
                var newY=e.pageY;

                //console.log(y+", "+newY+", "+top+", "+(top+(newY-y)));

                $("#stuff").scrollTop(top-newY+y);    
                $("#stuff").scrollLeft(left-newX+x);    
            }
        });

        $("body").mouseup(function(e){down=false;});

    </script>


