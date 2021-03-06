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
    .ordered_items_table tr td{
        text-align: center;
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
  //width: 120px !important;
}
     #dt_table_tools  tr th:nth-child(10),#dt_table_tools tr td:nth-child(10){
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
  #selected_item_table tr th:nth-child(1),#selected_item_table tr td:nth-child(1){
      width: 50px !important;
    }
</style>	
<script type="text/javascript">
    var grn_number;
    function numbersonly(e){
      var unicode=e.charCode? e.charCode : e.keyCode;     
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9){  //if the key isn't the backspace key (which we should allow)
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
    
    function receive_free_items(i)
    {
        if(isNaN($('#parsley_reg #r_free_id_'+i).val())){
           $('#parsley_reg #r_free_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_free_id_'+i).val();
            var res=  $('#parsley_reg #o_free_id_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_free_id_'+i).val(res);
                 
            }
        }
    }
    
    function receive_quty_items(i)
    {
        if(isNaN($('#cost_id_'+i).val())){
                          $('#cost_id_'+i).val(0);   
        }
        if(isNaN($('#parsley_reg #r_quty_id_'+i).val())){
           $('#parsley_reg #r_quty_id_'+i).val(0);
        }
            var good=  $('#parsley_reg #r_quty_id_'+i).val();
            var res=  $('#parsley_reg #o_quty_id_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_quty_id_'+i).val(res);  
                var discount=$('#discount_per_'+i).val();
                var discount2=$('#discount_per2_'+i).val(); 
                if(isNaN(parseFloat(discount))){
                    discount=0;   
                }
                if(isNaN(parseFloat(discount2))){
                    discount2=0;   
                }
                if(isNaN($('#cost_id_'+i).val())){
                    $('#cost_id_'+i).val(0);   
                }                 
                var quty=$('#r_quty_id_'+i).val();
                if(quty==""){
                   quty=0;
                }
                var total =parseFloat($('#cost_id_'+i).val())*parseFloat(quty);
                var sub_total =parseFloat($('#cost_id_'+i).val())*parseFloat(quty);                
                var total_tax=0;
                var type='Inc';
                var tax=(parseFloat(sub_total)*parseFloat($('#tax_value_'+i).val()))/100  ;
                if($('#tax_inclusive_'+i).val()==0){
                    var type='Exc';
                    total=parseFloat(total)+tax;                    
                }
                var type2='Inc';
                var tax2=(parseFloat(sub_total)*parseFloat($('#tax_value2_'+i).val()))/100  ;
                if($('#tax_inclusive2_'+i).val()==0){
                    var type2='Exc';
                    total=parseFloat(total)+tax2;                     
                }
                var discount_amount=0;
                var discount_amount2=0;
                if(discount!="" && discount!=0){
                    discount_amount=parseFloat(total)*parseFloat(discount)/100;
                }
                if(discount2!="" && discount2!=0){
                    discount_amount2=parseFloat(total-discount_amount)*parseFloat(discount2)/100;
                }
                total=parseFloat(total)-(parseFloat(discount_amount)+parseFloat(discount_amount2));
                var discount = parseFloat(discount_amount+discount_amount2);
                discount=discount.toFixed(point);                
                total = parseFloat(total);
                total=total.toFixed(point);                
                tax = parseFloat(tax);
                tax=tax.toFixed(point);                
                tax2 = parseFloat(tax2);
                tax2=tax2.toFixed(point);
                if(quty==0){
                    total=0;
                }
                tax=tax+'('+type+')';
                tax2=tax2+'('+type2+')';
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(11)').html(tax);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(12)').html(tax2);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(13)').html(discount);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(14)').html(total);
                $('#total_id_'+i).val(total);
              total_amount();
            }else{
                var discount=$('#discount_per_'+i).val();
                var discount2=$('#discount_per2_'+i).val(); 
                if(isNaN(parseFloat(discount))){
                    discount=0;   
                }
                if(isNaN(parseFloat(discount2))){
                    discount2=0;   
                }
                if(isNaN($('#cost_id_'+i).val())){
                    $('#cost_id_'+i).val(0);   
                }
                 
                var quty=$('#r_quty_id_'+i).val();
                if(quty==""){
                   quty=0;
                }
                var total =parseFloat($('#cost_id_'+i).val())*parseFloat(quty);
                var sub_total =parseFloat($('#cost_id_'+i).val())*parseFloat(quty);                
                var total_tax=0;
                var type='Inc';
                var tax=(parseFloat(sub_total)*parseFloat($('#tax_value_'+i).val()))/100  ;
                if($('#tax_inclusive_'+i).val()==0){
                    var type='Exc';
                    total=parseFloat(total)+tax;                    
                }
                var type2='Inc';
                var tax2=(parseFloat(sub_total)*parseFloat($('#tax_value2_'+i).val()))/100  ;
                if($('#tax_inclusive_'+i).val()==0){
                    var type2='Exc';
                    total=parseFloat(total)+tax2;                     
                }               
                var discount_amount=0;
                var discount_amount2=0;
                if(discount!="" && discount!=0){
                    discount_amount=parseFloat(total)*parseFloat(discount)/100;
                }
                if(discount2!="" && discount2!=0){
                    discount_amount2=parseFloat(total-discount_amount)*parseFloat(discount2)/100;
                }
                total=parseFloat(total)-(parseFloat(discount_amount)+parseFloat(discount_amount2));
                var discount = parseFloat(discount_amount+discount_amount2);
                discount=discount.toFixed(point);                
                total = parseFloat(total);
                total=total.toFixed(point);                
                tax = parseFloat(tax);
                tax=tax.toFixed(point);                
                tax2 = parseFloat(tax2);
                tax2=tax2.toFixed(point);
                if(quty==0){
                    total=0;
                }
                tax=tax+'('+type+')';
                tax2=tax2+'('+type2+')';
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(11)').html(tax);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(12)').html(tax2);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(13)').html(discount);
                $('#selected_item_table #new_item_row_id_'+i+' td:nth-child(14)').html(total);
                $('#total_id_'+i).val(total);
              total_amount();
            }
    }
    function total_amount(){
        var length=$('#selected_item_table >tbody >tr').length
        var total=0;
        for(var i=0;i<length;i++){
            var item_total=parseFloat($('#total_id_'+i).val());
            if(isNaN(item_total)){
                       item_total=0;  
             }
             if(item_total==""){
                 item_total=0;
             }
            total=total+item_total;
        }
     
        var discount=0;        
        if($('#id_discount').val()=="" && $('#id_discount').val()==0){
           discount=parseFloat($('#discount_amount').val());
        }else{
            discount=(parseFloat(total)*parseFloat($('#id_discount').val()))/100;
            var discount = parseFloat(discount);
            discount=discount.toFixed(point);
            $('#discount_amount').val(discount);
        }
        var freight=parseFloat($('#freight').val());
        var round=parseFloat($('#round_off_amount').val());
        if(isNaN(freight))
            freight=0;
        if(isNaN(round))
           round=0;
        if(isNaN(discount))
           discount=0;
        $('#demo_total_amount').val(total);  
        total = parseFloat(total)+freight+round;
        total=total.toFixed(point); 
        $('#demo_grand_total').val(total-discount);
        var total = parseFloat($('#demo_grand_total').val());
        $('#demo_grand_total').val(total.toFixed(point));
        var total = parseFloat($('#demo_total_amount').val());
        $('#demo_total_amount').val(total.toFixed(point));
    }
    function receive_free_items_update(i)
    {
        if(isNaN($('#parsley_reg #r_free_id_'+i).val())){
           $('#parsley_reg #r_free_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_free_id_'+i).val();
            var res=  $('#parsley_reg #o_free_id_'+i).val();
             var old=  $('#parsley_reg #grn_old_free_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_free_id_'+i).val(res);
                
            }
        }
    }  
   
    
    function save_new_grn(){
        <?php 
        if($this->session->userdata['goods_receiving_note_per']['add']==1){ ?>
            if($('#parsley_reg').valid()){
                $('#total_amount').val($('#demo_total_amount').val());
                $('#grand_total').val($('#demo_grand_total').val());
                var oTable = $('#selected_item_table').dataTable();
                if(oTable.fnGetData().length>0){
                    get_table_data();
                    var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/goods_receiving_note/save')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('goods_receiving_note').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_goods_receiving_note_lists();
                                refresh_items_table();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                           
                            }
                        }
                    });
                }else{
                    $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>', { type: "success" });                         
                    $('#parsley_reg #demo_order_number').select2('open');
                    $("#parsley_reg").trigger('reset');
                    $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('purchase_order')." ".$this->lang->line('for')." ".$this->lang->line('goods_receiving_note') ?>');
                    $('#grn_no').val(grn_number);
                    $('#demo_grn_no').val(grn_number);
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
        if($this->session->userdata['goods_receiving_note_per']['edit']==1){ ?>
            if($('#parsley_reg').valid()){
                $('#total_amount').val($('#demo_total_amount').val());
                $('#grand_total').val($('#demo_grand_total').val());
                var oTable = $('#selected_item_table').dataTable();
                if(oTable.fnGetData().length>0){
                    get_table_data();
                    var inputs = $('#parsley_reg').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/goods_receiving_note/update')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('goods_receiving_note').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                $("#dt_table_tools").dataTable().fnDraw();
                                $("#parsley_reg").trigger('reset');
                                posnic_goods_receiving_note_lists();
                                refresh_items_table();
                            }else  if(response['responseText']=='ALREADY'){
                                $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='FALSE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                           
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
        <?php }?>
    }
    
    $(document).ready( function () {        
        function format_purchase_order(sup) {
            if (!sup.id) return sup.text;
            return  "<p >"+sup.text+"    <br>"+sup.order_date+" "+sup.company+"   "+sup.supplier+"</p> ";
        }
        $('#parsley_reg #demo_order_number').change(function() {
            if($('#parsley_reg #demo_order_number').select2('data').expired==0){
                refresh_items_table();
                $('#loading').modal('show');
                var guid = $('#parsley_reg #demo_order_number').select2('data').id;
                $.ajax({                                      
                    url: "<?php echo base_url() ?>index.php/goods_receiving_note/get_purchase_order/"+guid,                      
                    data: "", 
                    dataType: 'json',               
                    success: function(data)        
                    { 
                        if(data[0]['grn_status']==0){
                            $('#parsley_reg #goods_receiving_note_guid').val($('#parsley_reg #demo_order_number').select2('data').id);
                            $('#parsley_reg #demo_order_number').val($('#parsley_reg #demo_order_number').select2('data').text);
                            $('#parsley_reg #company').val($('#parsley_reg #demo_order_number').select2('data').company);
                            $('#parsley_reg #first_name').val($('#parsley_reg #demo_order_number').select2('data').supplier);
                            $('#parsley_reg #order_date').val($('#parsley_reg #demo_order_number').select2('data').order_date);
                            $('#parsley_reg #expiry_date').val($('#parsley_reg #demo_order_number').select2('data').expiry);
                            $('#parsley_reg #id_discount').val($('#parsley_reg #demo_order_number').select2('data').discount);
                            $('#parsley_reg #discount_amount').val($('#parsley_reg #demo_order_number').select2('data').dis_amount);
                            $('#parsley_reg #freight').val($('#parsley_reg #demo_order_number').select2('data').freight);
                            $('#parsley_reg #round_off_amount').val($('#parsley_reg #demo_order_number').select2('data').round);
                            $('#parsley_reg #supplier_guid').val(guid);
                            $("#user_list").hide();
                            $('#add_new_order').show('slow');
                            $('#delete').attr("disabled", "disabled");
                            $('#posnic_add_goods_receiving_note').attr("disabled", "disabled");
                            $('#active').attr("disabled", "disabled");
                            $('#deactive').attr("disabled", "disabled");
                            $('#goods_receiving_note_lists').removeAttr("disabled");
                            $("#parsley_reg #supplier").val(data[0]['c_name']);
                            $("#parsley_reg #company").val(data[0]['c_name']);
                            $("#parsley_reg #address").val(data[0]['address']);
                            $("#parsley_reg #goods_receiving_note_guid").val(guid);
                            $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                            $("#parsley_reg #order_number").val(data[0]['po_no']);
                            $("#parsley_reg #order_date").val(data[0]['po_date']);
                            $("#parsley_reg #expiry_date").val(data[0]['exp_date']);
                            $("#parsley_reg #id_discount").val(data[0]['discount']);
                            $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                            $("#parsley_reg #freight").val(data[0]['freight']);
                            $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                            $('#demo_total_amount').val('');
                            $('#total_amount').val('');
                            $('#grand_total').val('');
                            $('#demo_grand_total').val('');
                            $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                            var tax;
                            var receive=0;
                            for(i=0;i<data.length;i++){
                                if(data[i]['received_quty']<data[i]['quty']){
                                    receive=1;
                                    var name=data[i]['items_name'];
                                    var sku=data[i]['i_code'];
                                    var quty=data[i]['quty'];
                                    var limit=data[i]['item_limit'];                              
                                    var free=data[i]['free'];
                                    var received_quty=data[i]['received_quty'];
                                    var received_free=data[i]['received_free'];
                                    var cost=data[i]['cost'];
                                    var price=data[i]['sell'];
                                    var mrp=data[i]['mrp'];
                                    var o_i_guid=data[i]['o_i_guid'];
                                    var date=data[i]['date'];
                                    var items_id=data[i]['item'];
                                    var per=data[i]['dis_per'];
                                    var per2=data[i]['dis_per2'];
                                    var discount;
                                    var discount2;                                   
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                        null,
                                        name,
                                        sku,
                                        cost,
                                        quty,
                                        received_quty,
                                        free,
                                        received_free,
                                       "<input type='hidden' id='total_id_"+i+"'><input type='hidden' id='tax_inclusive_"+i+"' value='"+data[i]['tax_Inclusive']+"' ><input type='hidden' id='discount_amt_"+i+"' value='"+discount+"' ><input type='hidden' id='tax_inclusive2_"+i+"' value='"+data[i]['tax_inclusive2']+"' ><input type='hidden' id='discount_amt2_"+i+"' value='"+discount2+"' ><input type='hidden' name='items[]' value='"+data[i]['item']+"' ><input type='hidden' id='cost_id_"+i+"' value='"+cost+"' ><input type='hidden' id='o_quty_id_"+i+"' value='"+parseFloat(quty-received_quty)+"' ><input type='text' id='r_quty_id_"+i+"' name='receive_quty[]' onkeyup='receive_quty_items("+i+")' onKeyPress='return numbersonly(event)' class='form-control' value='"+quty+"' style='width:80px'>",
                                       "<input type='hidden' id='tax_type_"+i+"' value='"+data[i]['tax_type_name']+"' ><input type='hidden' id='tax_type2_"+i+"' value='"+data[i]['tax2_type']+"' ><input type='hidden' id='tax_value_"+i+"' value='"+data[i]['tax_value']+"' ><input type='hidden' id='discount_per_"+i+"' value='"+per+"' ><input type='hidden' id='tax_value2_"+i+"' value='"+data[i]['tax2_value']+"' ><input type='hidden' id='discount_per2_"+i+"' value='"+per2+"' ><input type='hidden' name='order_items[]' value='"+data[i]['o_i_guid']+"' ><input type='hidden' id='o_free_id_"+i+"' value='"+parseFloat(free-received_free)+"' ><input type='text' id='r_free_id_"+i+"' name='receive_free[]' onkeyup='receive_free_items("+i+")' onKeyPress='return numbersonly(event)' value='"+free+"' class='form-control' style='width:60px'>",
                                        '',
                                        '',
                                        '',
                                        0

                                    ]);
                                    var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                                    theNode.setAttribute('id','new_item_row_id_'+i)
                                    receive_quty_items(i);
                                }
                            }if(receive==0){
                                $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>', { type: "success" });                         
                                $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>');
                            }
                        } 
                        else{
                            $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>', { type: "success" });                         
                            $('#parsley_reg #demo_order_number').select2('open');
                        }
                    }
                });                
                window.setTimeout(function ()
                {
                   document.getElementById('order_date').focus();
                   $('#loading').modal('hide');
                }, 0);  
            }else{
                $('#parsley_reg #demo_order_number').select2('open');
                $("#parsley_reg").trigger('reset');
                $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('was_expired');?>', { type: "error" });                         
                $('#grn_no').val(grn_number);
                $('#demo_grn_no').val(grn_number);
            }
        });
        $('#parsley_reg #demo_order_number').select2({
            dropdownCssClass : 'supplier_select',
            formatResult: format_purchase_order,
            formatSelection: format_purchase_order,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('purchase_order') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/goods_receiving_note/search_purchase_order',
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
                            text: item.po_no,
                            company: item.c_name,
                            supplier: item.s_name,
                            order_date: item.po_date,
                            expiry: item.exp_date,
                            discount: item.discount,
                            dis_amount: item.discount_amt,
                            freight: item.freight,
                            round: item.round_amt,
                            expired: item.expired,
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
        $("#parsley_reg").trigger('reset');
        <?php 
        if($this->session->userdata['goods_receiving_note_per']['add']==1){ ?>
            $('#update_button').hide();
            $(".supplier_select_2").show();
            $(".porchase_order_for_grn").hide();
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
            $("#parsley_reg #demo_order_number").select2('data', {id:'',text: 'Search PO'});
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/goods_receiving_note/order_number/",                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                {    
                    $('#parsley_reg #demo_grn_no').val(data[0][0]['prefix']+data[0][0]['max']);
                    $('#parsley_reg #grn_no').val(data[0][0]['prefix']+data[0][0]['max']);
                    grn_number=data[0][0]['prefix']+data[0][0]['max'];
                }
            });
            $("#user_list").hide();
            $('#add_new_order').show('slow');
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_goods_receiving_note').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#goods_receiving_note_lists').removeAttr("disabled");
            window.setTimeout(function ()
            {
               $('#parsley_reg #demo_order_number').select2('open');
            }, 1000);
          <?php           
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                         
                        <?php                         
        }?>
    }
    function posnic_goods_receiving_note_lists(){
        invoice_enable();
        $('#edit_brand_form').hide('hide');
        $('#add_new_order').hide('hide');      
        $("#user_list").show('slow');
        $('#delete').removeAttr("disabled");
        $('#active').removeAttr("disabled");
        $('#deactive').removeAttr("disabled");
        $('#posnic_add_goods_receiving_note').removeAttr("disabled");
        $('#goods_receiving_note_lists').attr("disabled",'disabled');
    }
    function clear_add_goods_receiving_note(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
    }
    function clear_update_goods_receiving_note(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
        edit_function($('#goods_receiving_note_guid').val());
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_goods_receiving_note" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                      
                        <a href="javascript:posnic_group_approve()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:grn_group_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_goods_receiving_note_lists()" class="btn btn-default" id="goods_receiving_note_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('goods_receiving_note') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<div class="modal fade" id="loading" style="background:none">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('goods_receiving_note/goods_receiving_note_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('goods_receiving_note') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                            <th>Id</th>
                                            <th ><?php echo $this->lang->line('select') ?></th>
                                            <th ><?php echo $this->lang->line('purchase_order') ?></th>
                                            <th style="width: 170px !important"><?php echo $this->lang->line('grn_number') ?></th>
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

               
       

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('goods_receiving_note/upadate_pos_goods_receiving_note_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
        <input type="hidden" name="grn_guid" id="grn_guid" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('goods_receiving_note')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="demo_order_number" ><?php echo $this->lang->line('order_number') ?></label>													
                                                                  <?php $demo_order_number=array('name'=>'demo_order_number',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_order_number',
                                                                                   
                                                                                    'value'=>set_value('demo_order_number'));
                                                                     echo form_input($demo_order_number)?>
                                                        <input type="hidden" id="goods_receiving_note_guid" name="goods_receiving_note_guid">
                                                       
                                                  </div> 
                                                   <div class="form_sep porchase_order_for_grn" style="margin-top:0px">
                                                         <label for="demo_order_number" ><?php echo $this->lang->line('order_number') ?></label>	
                                                         <input type="text" disabled="disabled" id="edit_grn_node" class='form-control'>
                                                   </div>
                                               </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="name" ><?php echo $this->lang->line('name') ?></label>													
                                                                     <?php $name=array('name'=>'name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'first_name',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('name'));
                                                                         echo form_input($name)?>
                                                            <input type="hidden" name="order_number" id="order_number">
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
                                                            <label for="order_date" ><?php echo $this->lang->line('order_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $order_date=array('name'=>'order_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'order_date',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($order_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                               <div class="col col-sm-2" >
                                                     <div class="form_sep">
                                                            <label for="expiry_date" ><?php echo $this->lang->line('expiry_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $expiry_date=array('name'=>'expiry_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'expiry_date',
                                                                                             'disabled'=>'disabled',
                                                                                            'value'=>set_value('expiry_date'));
                                                                             echo form_input($expiry_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                              
                                              
                                               </div>
                                           <div class="row">
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount" ><?php echo $this->lang->line('discount') ?>%</label>													
                                                                     <?php $discount=array('name'=>'discount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'id_discount',
                                                                                        'maxlength'=>2,
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('discount'));
                                                                         echo form_input($discount)?>
                                                       </div>
                                                    </div>
                                          
                                                
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount_amount" ><?php echo $this->lang->line('discount_amount') ?></label>													
                                                                     <?php $discount_amount=array('name'=>'discount_amount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'discount_amount',
                                                                                     
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('discount_amount'));
                                                                         echo form_input($discount_amount)?>
                                                            <input type="hidden" name="discount_amount" id="discount_amount">
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="freight" ><?php echo $this->lang->line('freight') ?></label>													
                                                                     <?php $freight=array('name'=>'freight',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'freight',
                                                                                     
                                                                                        'disabled'=>'disabled',
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
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('round_off_amount'));
                                                                         echo form_input($round_off_amount)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="grn_no" ><?php echo $this->lang->line('grn_no') ?></label>													
                                                                     <?php $round_off_amount=array('name'=>'demo_grn_no',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'demo_grn_no',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('demo_grn_no'));
                                                                         echo form_input($round_off_amount)?>
                                                            <input type="hidden" name="grn_no" id="grn_no">
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="grn_date" ><?php echo $this->lang->line('grn_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $grn_date=array('name'=>'grn_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'grn_date',
                                                                                             
                                                                                            'value'=>set_value('grn_date'));
                                                                             echo form_input($grn_date)?>
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
                                    <th><?php echo $this->lang->line('cost') ?></th> 
                                    <th><?php echo $this->lang->line('ordered_quty') ?></th>
                                    <th><?php echo $this->lang->line('received_quty') ?></th>
                                    <th><?php echo $this->lang->line('ordered_free') ?></th>
                                    <th><?php echo $this->lang->line('received_free') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>
                                    <th><?php echo $this->lang->line('free') ?></th>
                                    <th><?php echo $this->lang->line('tax') ?>1</th>
                                    <th><?php echo $this->lang->line('tax') ?>2</th>
                                    <th><?php echo $this->lang->line('discount') ?></th>
                                    <th><?php echo $this->lang->line('amount') ?></th>
                                 
                                 
                                   
                              
                                    
                                 
                                    </tr>
                                    </thead>
                                    <tbody id="new_order_items" class="ordered_items_table" >
                                       
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
                                                       <a href="javascript:save_new_grn()" class="btn btn-default"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_order()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-3" style="padding-top: 50px"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_goods_receiving_note()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_goods_receiving_note()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
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
                                                   
                                                    <p id="invoice_posnic_grn_id"></p>
                                                    <p  id="invoice_grn_no"></p>
                                                    <p  id="invoice_grn_date"></p>
                                                    <p  id="invoice_posnic_po_id"></p>
                                                    <p  id="invoice_posnic_po_number"></p>
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
                                    <li class="active"><a data-toggle="tab" href="#st_purchase"><?php echo $this->lang->line('purchase_order')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_branch"><?php echo $this->lang->line('branch')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_supplier"><?php echo $this->lang->line('supplier')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_items"><?php echo $this->lang->line('items')." ".$this->lang->line('details') ?></a></li>
                                    <li><a data-toggle="tab" href="#st_invoice"><?php echo $this->lang->line('invoice')." ".$this->lang->line('details') ?></a></li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div id="st_purchase" class="tab-pane active">
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_grn" ><?php echo $this->lang->line('grn_id') ?></label>													

                                                         <?php $posnic_grn=array('name'=>'posnic_grn',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_grn');
                                                                echo form_checkbox($posnic_grn)?>
                                              
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_grn_no" ><?php echo $this->lang->line('grn_no') ?></label>													
                             
                                                         <?php $posnic_grn_no=array('name'=>'posnic_grn_no',
                                                                               'class'=>' form-control ',
                                                               'value'=>1,
                                                                               'id'=>'posnic_grn_no');
                                                                echo form_checkbox($posnic_grn_no)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_grn_date" ><?php echo $this->lang->line('grn')." ". $this->lang->line('date') ?></label>													
                                                     
                                                        <?php $posnic_grn_date=array('name'=>'posnic_grn_date',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_grn_date');
                                                        
                                                        echo form_checkbox($posnic_grn_date)?>
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_order_id" ><?php echo $this->lang->line('purchase_order_id') ?></label>													

                                                         <?php $posnic_order_id=array('name'=>'posnic_order_id',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_order_id');
                                                                echo form_checkbox($posnic_order_id)?>
                                              
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group ">
                                                    <label for="posnic_number" ><?php echo $this->lang->line('purchase_order_number') ?></label>													
                             
                                                         <?php $posnic_number=array('name'=>'posnic_number',
                                                                               'class'=>' form-control ',
                                                               'value'=>1,
                                                                               'id'=>'posnic_number');
                                                                echo form_checkbox($posnic_number)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_date" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('date') ?></label>													
                                                     
                                                        <?php $posnic_date=array('name'=>'posnic_date',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_date');
                                                        
                                                        echo form_checkbox($posnic_date)?>
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_expiry" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('expiry_date') ?></label>													
                                                     
                                                        <?php $posnic_expiry=array('name'=>'posnic_expiry',
                                                                               'class'=>' form-control ',
                                                            'value'=>1,
                                                                               'id'=>'posnic_expiry');
                                                        echo form_checkbox($posnic_expiry)?>
                                                  
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_barcode" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('barcode') ?></label>													
                                                     
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
                                                <label for="posnic_branch_code" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('branch')." ". $this->lang->line('code') ?></label>													
                                                     
                                                        <?php $posnic_branch_code=array('name'=>'posnic_branch_code',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_branch_code');
                                                        echo form_checkbox($posnic_branch_code)?>
                                                   
                                             </div>
                                        </div>
                                           <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_branch_name" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('branch')." ". $this->lang->line('name') ?></label>													
                                                     
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
                                                <label for="posnic_item_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('ordered_quantity') ?></label>													
                                                     
                                                        <?php $posnic_item_quantity=array('name'=>'posnic_item_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_quantity');
                                                        echo form_checkbox($posnic_item_quantity)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_received_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('received_quantity') ?></label>													
                                                     
                                                        <?php $posnic_item_received_quantity=array('name'=>'posnic_item_received_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_received_quantity');
                                                        echo form_checkbox($posnic_item_received_quantity)?>
                                                   
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_free_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('ordered_free') ?></label>													
                                                     
                                                        <?php $posnic_item_free_quantity=array('name'=>'posnic_item_free_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_free_quantity');
                                                        echo form_checkbox($posnic_item_free_quantity)?>
                                                   
                                             </div>
                                        </div>
                                         <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_item_received_free_quantity" ><?php echo $this->lang->line('item')." ". $this->lang->line('received_free') ?></label>													
                                                     
                                                        <?php $posnic_item_received_free_quantity=array('name'=>'posnic_item_received_free_quantity',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_item_received_free_quantity');
                                                        echo form_checkbox($posnic_item_received_free_quantity)?>
                                                   
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
                                                <label for="posnic_grn_subtotal" ><?php echo $this->lang->line('grn')." ". $this->lang->line('subtotal') ?></label>													
                                                     
                                                        <?php $posnic_grn_subtotal=array('name'=>'posnic_grn_subtotal',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_grn_subtotal');
                                                        echo form_checkbox($posnic_grn_subtotal)?>
                                                   
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
                                                <label for="posnic_discount" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('discount') ?> </label>													
                                                     
                                                        <?php $posnic_discount=array('name'=>'posnic_discount',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_discount');
                                                        echo form_checkbox($posnic_discount)?>
                                                
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_frieght" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('frieght') ?> </label>													
                                                     
                                                        <?php $posnic_frieght=array('name'=>'posnic_frieght',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_frieght');
                                                        echo form_checkbox($posnic_frieght)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_round_off_amount" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('round_off_amount') ?> </label>													
                                                     
                                                        <?php $posnic_round_off_amount=array('name'=>'posnic_round_off_amount',
                                                                               'class'=>' form-control ',
                                                                                'value'=>1,
                                                                               'id'=>'posnic_round_off_amount');
                                                        echo form_checkbox($posnic_round_off_amount)?>
                                                 
                                             </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="posnic_grand_total" ><?php echo $this->lang->line('purchase_order')." ". $this->lang->line('grand_total') ?> </label>													
                                                     
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
        function posnic_group_approve(){
              <?php if($this->session->userdata['goods_receiving_note_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('goods_receiving_note');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/goods_receiving_note/good_receiving_note_approve',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value,
                                    po:$('#purchase_order__number_'+guid).val()

                                },
                                 complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                        $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('approved');?>', { type: "success" });
                                       $("#dt_table_tools").dataTable().fnDraw();
                                   }else if(response['responseText']=='approve'){
                                        $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is')." ".$this->lang->line('already')." ".$this->lang->line('approved');?>', { type: "warning" });
                                   }else if(response['responseText']=='Noop'){
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                       
                                   }
                               }
                            });

                          }

                      }
                  

                      }  
               <?php }else{?>
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                       
                <?php }?>
               }
                      
                   
    function grn_group_delete(){
                     <?php if($this->session->userdata['goods_receiving_note_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('goods_receiving_note');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('goods_receiving_note') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){   
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/goods_receiving_note/delete',
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
                      <?php }else{?>
                               $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                       
                       <?php }
                    ?>
                      }
                    
                    
                    
                 
                    
                </script>
              

      