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
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function save_new_order(){
         <?php if($this->session->userdata['purchase_order_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_order_cancel/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order_cancel').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                     $("#parsley_reg #purchase_order_guid").select2('data', {id:'',text:""});
                                       $("#parsley_reg").trigger('reset');
                                       refresh_items_table();
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_order_cancel');?>', { type: "error" });                           
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
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_order_cancel');?>', { type: "error" });                       
                    <?php }?>
    }
  
    
    $(document).ready( function () { 
        $('#parsley_reg #items').change(function() {
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #items').select2('data').id) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #items').select2('data').id){
                $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #first_name').val(), { type: "warning" });  
                $('#parsley_reg #items').select2('open');
            }else{
                
                var guid = $('#parsley_reg #items').select2('data').id;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #item_order_id').val($('#parsley_reg #items').select2('data').order);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                $('#parsley_reg #cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #item_cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #price').val($('#parsley_reg #items').select2('data').price);
                $('#parsley_reg #price').val($('#parsley_reg #items').select2('data').price);
                $('#parsley_reg #mrp').val($('#parsley_reg #items').select2('data').mrp);
                $('#parsley_reg #po_quantity').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #order_quantity').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #order_free').val($('#parsley_reg #items').select2('data').free);
                $('#parsley_reg #po_free').val($('#parsley_reg #items').select2('data').free);
                $('#parsley_reg #discount_per').val($('#parsley_reg #items').select2('data').discount_per);
                $('#parsley_reg #discount_per2').val($('#parsley_reg #items').select2('data').discount_per2);
                //$('#parsley_reg #discount').val($('#parsley_reg #items').select2('data').discount_amount);             
                $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type);
                $('#parsley_reg #tax_Inclusive').val($('#parsley_reg #items').select2('data').tax_Inclusive);
                $('#parsley_reg #tax_value2').val($('#parsley_reg #items').select2('data').tax2_value);
                $('#parsley_reg #tax_type2').val($('#parsley_reg #items').select2('data').tax2_type);
                $('#parsley_reg #tax_Inclusive2').val($('#parsley_reg #items').select2('data').tax2_Inclusive); 
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {                    
                    $('#parsley_reg #quantity').focus();
                }, 0);
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
                url: '<?php echo base_url() ?>index.php/purchase_order_cancel/search_items/',
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
                        purchase_order_guid:$('#parsley_reg #purchase_order_guid').val()
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
                            order: item.guid,
                            free: item.free,
                            cost: item.cost,
                            discount_per: item.discount_per,
                            discount_per2: item.discount_per2,
                            discount_amount: item.discount_amount,
                            price: item.sell,
                            amount: item.amount,
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
                        $.bootstrapGrowl('<?php echo $this->lang->line('please_select')." ".$this->lang->line('purchase_order');?>', { type: "warning" }); 
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
            return  "<p >"+sup.text+"    <br>"+sup.name+"   "+sup.company+"</p> ";
        }
        $('#parsley_reg #purchase_order_number').change(function() {
            refresh_items_table();           
            var guid = $('#parsley_reg #purchase_order_number').select2('data').id;
            $('#parsley_reg #purchase_order_guid').val(guid);
            $('#parsley_reg #first_name').val($('#parsley_reg #purchase_order_number').select2('data').name);
            $('#parsley_reg #company').val($('#parsley_reg #purchase_order_number').select2('data').company);
            $('#parsley_reg #address').val($('#parsley_reg #purchase_order_number').select2('data').address);
            $('#parsley_reg #order_date').val($('#parsley_reg #purchase_order_number').select2('data').order_date);
            $('#parsley_reg #expiry_date').val($('#parsley_reg #purchase_order_number').select2('data').exp_date);
            $('#parsley_reg #note').val($('#parsley_reg #purchase_order_number').select2('data').note);
            $('#parsley_reg #remark').val($('#parsley_reg #purchase_order_number').select2('data').remark);
            $('#parsley_reg #supplier_guid').val(guid);
            window.setTimeout(function ()
            {
                document.getElementById('order_date').focus();
            }, 0);  
             
        });
        $('#parsley_reg #purchase_order_number').select2({
            dropdownCssClass : 'supplier_select',
            formatResult: format_supplier,
            formatSelection: format_supplier,                
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('purchase_order') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/purchase_order_cancel/purchase_order_number',
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
                            name: item.s_name,
                            company: item.c_name,
                            address: item.address1,
                            order_date: item.po_date,
                            exp_date: item.exp_date,
                            discount: item.discount,
                            discount_amount: item.discount_amt,
                            freight: item.freight,
                            round: item.round_amt,
                            remark: item.remark,
                            note: item.note,
                            total_item_amt: item.total_item_amt,
                            total_amt: item.total_amt,
                        });
                    });
                    return {
                        results: results
                    };
                }
            }
        });        
    });
    function clear_add_purchase_order(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
    }
    function clear_update_purchase_order(){
        $("#parsley_reg").trigger('reset');
        refresh_items_table();
        edit_function($('#purchase_order_guid').val());
    }
    function reload_update_user(){
        var id=$('#guid').val();
        supplier_function(id);
    }
</script>
<nav id="top_navigation">
    <div class="container">
            
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
   

               
                
               
              


  
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
           $('#parsley_reg #free').focus();
         
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
          
               //document.getElementById('delivery_date').focus();
               $('#mrp').focus();
        }
           if (unicode!=13 && unicode!=9 && unicode!=27){
               $('#extra_elements').click();
               document.getElementById('i_discount').focus();
                document.getElementById('extra_elements').value=$('#hidden_dis_amt').val();
                  window.setTimeout(function ()
                    {
                     
                       document.getElementById('extra_elements').value=$('#hidden_dis_amt').val();
                    }, 10);
           }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $("#parsley_reg #items").focus();

        }

    }
function add_new_free(e){          
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
               
            $('#parsley_reg #quantity').focus();
        }
        }
    }else{
         $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    
       $('#parsley_reg #items').select2('open');
    }
    }
function add_new_cost(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #cost').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #price').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #free').focus();
        }
        }
    }else{
         $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    
       $('#parsley_reg #items').select2('open');
    }
    }
function add_new_price(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #price').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #mrp').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #cost').focus();
        }
        }
    }else{
       $('#parsley_reg #items').select2('open');
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    }
    }
 function add_new_mrp(e){
       if($('#parsley_reg #item_id').val()!=""){
   
        var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #cost').val() && $('#parsley_reg #price').val()){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ 
            if($('#parsley_reg #item_id').val()!=""){
           
     
         document.getElementById('extra_elements').focus();
        
                  
                            
       }else{
                                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
          $('#parsley_reg #items').select2('open');
        }
       }
         if (unicode!=27){
        }
       else{
               
               $('#parsley_reg #price').focus();
        }
        }else{
        if($('#parsley_reg #quantity').val()==""){
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
        }else{
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
    }
    }
 function add_new_date(e){
       if($('#parsley_reg #item_id').val()!=""){
   
        var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #cost').val() && $('#parsley_reg #price').val()){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ 
            if($('#parsley_reg #item_id').val()!=""){
                         
                    //  $('#parsley_reg #extra_elements').focus();
                        document.getElementById('extra_elements').focus();
                       
                        
                  window.setTimeout(function ()
                    { 
                           document.getElementById('extra_elements').focus();
                    }, 0);
                      //      
       }else{
                                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
          $('#parsley_reg #items').select2('open');
        }
       }
         if (unicode!=27){
        }
       else{
               
               $('#parsley_reg #mrp').focus();
        }
        }
        }else{
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
        $('#parsley_reg #items').select2('open');
    }
    }
    function net_amount(){
        if(isNaN($('#parsley_reg #cost').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #item_cost').val())){
                $('#parsley_reg #item_cost').val(0);
            }else{
                $('#parsley_reg #quantity').val(0);
            }
        }else{     
            if(parseFloat($('#parsley_reg #quantity').val())>parseFloat($('#parsley_reg #po_quantity').val()-1) && $('#parsley_reg #po_quantity').val()!=0){
                $('#parsley_reg #quantity').val($('#parsley_reg #po_quantity').val()-1);
                var quty=$('#po_quantity').val();
                var now=parseFloat($('#quantity').val());
                var cost=parseFloat($('#item_cost').val());
                var tax_Inclusive1=parseFloat($('#tax_Inclusive').val());
                var tax_value=parseFloat($('#tax_value').val());
                var tax_Inclusive2=parseFloat($('#tax_Inclusive2').val());
                var tax_value2=parseFloat($('#tax_value2').val());
                var discount1=parseFloat($('#discount_per').val());
                var discount2=parseFloat($('#discount_per2').val());
                var sub_total=parseFloat(now)*parseFloat(cost);
                var total=parseFloat(now)*parseFloat(cost);
                var total_tax=0;
                if(tax_Inclusive1==0){
                    var tax=parseFloat(sub_total)*parseFloat(tax_value)/100;
                    total=parseFloat(total)+parseFloat(tax);
                    var total_tax=parseFloat(total_tax)+parseFloat(tax);
                }
                if(tax_Inclusive2==0){
                    var tax2=parseFloat(sub_total)*parseFloat(tax_value2)/100;
                    total=parseFloat(total)+parseFloat(tax2);
                    var total_tax=parseFloat(total_tax)+parseFloat(tax2);
                }
                var discount_amount1=0;
                var discount_amount2=0;
                if(discount1!=""){
                    discount_amount1=parseFloat(total)*parseFloat(discount1)/100;
                }
                if(discount2!=""){
                    discount_amount2=parseFloat(total-discount_amount1)*parseFloat(discount2)/100;
                }
                var type='Exc';
                if(total_tax==0){
                    type='Inc';   
                    total_tax=parseFloat(tax)+parseFloat(tax2);
                }
                var total_discount=parseFloat(discount_amount1)+parseFloat(discount_amount2);
                total=parseFloat(total)-parseFloat(total_discount);
                var num= parseFloat(total);
                total=num.toFixed(point);
                var num= parseFloat(total_discount);
                total_discount=num.toFixed(point);
                var num= parseFloat(total_tax);
                total_tax=num.toFixed(point);
                var num= parseFloat(discount_amount1);
                discount_amount1=num.toFixed(point);
                var num= parseFloat(discount_amount2);
                discount_amount2=num.toFixed(point);
                $('#tax_label').text('<?php echo $this->lang->line('tax') ?>('+type+')')
                $('#item_tax').val(total_tax);
                $('#discount_amount').val(discount_amount1);
                $('#discount_amount2').val(discount_amount2);
                $('#item_discount').val(total_discount);
                $('#parsley_reg #total').val(total);        
            }else{             
                var quty=$('#po_quantity').val();
                var now=parseFloat($('#quantity').val());
                var cost=parseFloat($('#item_cost').val());
                var tax_Inclusive1=parseFloat($('#tax_Inclusive').val());
                var tax_value=parseFloat($('#tax_value').val());
                var tax_Inclusive2=parseFloat($('#tax_Inclusive2').val());
                var tax_value2=parseFloat($('#tax_value2').val());
                var discount1=parseFloat($('#discount_per').val());
                var discount2=parseFloat($('#discount_per2').val());
                var sub_total=parseFloat(now)*parseFloat(cost);
                var total=parseFloat(now)*parseFloat(cost);
                var total_tax=0;
                if(tax_Inclusive1==0){
                    var tax=parseFloat(sub_total)*parseFloat(tax_value)/100;
                    total=parseFloat(total)+parseFloat(tax);
                    var total_tax=parseFloat(total_tax)+parseFloat(tax);
                }
                if(tax_Inclusive2==0){
                    var tax2=parseFloat(sub_total)*parseFloat(tax_value2)/100;
                    total=parseFloat(total)+parseFloat(tax2);
                    var total_tax=parseFloat(total_tax)+parseFloat(tax2);
                }
                var discount_amount1=0;
                var discount_amount2=0;
                if(discount1!=""){
                    discount_amount1=parseFloat(total)*parseFloat(discount1)/100;
                }
                if(discount2!=""){
                    discount_amount2=parseFloat(total-discount_amount1)*parseFloat(discount2)/100;
                }
                var type='Exc';
                if(total_tax==0){
                    type='Inc';   
                    total_tax=parseFloat(tax)+parseFloat(tax2);
                }
                var total_discount=parseFloat(discount_amount1)+parseFloat(discount_amount2);
                total=parseFloat(total)-parseFloat(total_discount);
                var num= parseFloat(total);
                total=num.toFixed(point);
                var num= parseFloat(total_discount);
                total_discount=num.toFixed(point);
                var num= parseFloat(total_tax);
                total_tax=num.toFixed(point);
                var num= parseFloat(discount_amount1);
                discount_amount1=num.toFixed(point);
                var num= parseFloat(discount_amount2);
                discount_amount2=num.toFixed(point);
                $('#tax_label').text('<?php echo $this->lang->line('tax') ?>('+type+')')
                $('#item_tax').val(total_tax);
                $('#discount_amount').val(discount_amount1);
                $('#discount_amount2').val(discount_amount2);
                $('#item_discount').val(total_discount);
                $('#parsley_reg #total').val(total);
            }
        }
    }
    function copy_items(){
        if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #cost').val()!="" && $('#parsley_reg #price').val()!=""  && $('#parsley_reg #quantity').val()!=""){
            if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_id').val())){
                 var po_quty=$('#po_quantity').val()
                var po_free=$('#po_free').val()
                var  name=$('#parsley_reg #item_name').val();
                var  sku=$('#parsley_reg #sku').val();
                var  quty=$('#parsley_reg #quantity').val();
                if($('#parsley_reg #free').val()!=""){
                var  free=$('#parsley_reg #free').val();
                }else{
                var  free=0;
                }
                var cost=$('#parsley_reg #cost').val();
                var price=$('#parsley_reg #price').val();
                var items_id=$('#parsley_reg #item_id').val();
                var supplier=$('#parsley_reg #supplier_guid').val();
                var limit=$('#parsley_reg #po_quantity').val();
                var tax_value=$('#parsley_reg #tax_value').val();
                var tax_type=$('#parsley_reg #tax_type').val();
                var tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                var tax_value2=$('#parsley_reg #tax_value2').val();
                var tax_type2=$('#parsley_reg #tax_type2').val();
                var tax_Inclusive2=$('#parsley_reg #tax_Inclusive2').val();
                var per=parseFloat($('#discount_per').val());
                var per2=parseFloat($('#discount_per2').val());
                var discount=$('#parsley_reg #discount_amount').val();
                var discount2=$('#parsley_reg #discount_amount2').val();
                var type1='Inc';
                var type2='Inc';
                var tax1=(parseFloat(quty)*parseFloat(cost))*tax_value/100;
                var tax2=(parseFloat(quty)*parseFloat(cost))*tax_value2/100;
                var total= (parseFloat(quty)*parseFloat(cost));
                var sub_total= (parseFloat(quty)*parseFloat(cost));
                var total_tax=0;
                if(tax_Inclusive==0){
                   total=total+tax1;
                   type1='Exc';
                   total_tax=parseFloat(total_tax)+parseFloat(tax1);
                }
                if(tax_Inclusive==0){
                    type2='Exc';
                    total=total+tax2;
                    total_tax=parseFloat(total_tax)+parseFloat(tax2);
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
                var type='Exc';
                if(total_tax==0){
                    var type='Inc'
                    total_tax=parseFloat(tax1)+parseFloat(tax2);
                }
                var num = parseFloat(total_tax);
                total_tax=num.toFixed(point);
                var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val();
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(7)').html(quty);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(8)').html(free);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(9)').html(total_tax+'('+type+')');
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(10)').html(total_discount);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(11)').html(total);
                $('#newly_added #new_item_id_'+items_id).val(items_id);
                $('#newly_added #new_item_quty_'+items_id).val(quty);
                $('#newly_added #new_item_free_'+items_id).val(free);
                $('#newly_added #new_item_cost_'+items_id).val(cost);
                $('#newly_added #new_item_price_'+items_id).val(price);
                $('#newly_added #new_item_total_'+items_id).val(parseFloat(quty)*parseFloat(cost));
                $('#newly_added #new_item_discount_'+items_id).val(discount);
                $('#newly_added #new_item_discount_per_'+items_id).val(per);
                $('#newly_added #new_item_discount2_'+items_id).val(discount2);
                $('#newly_added #new_item_discount_per2_'+items_id).val(per2);
                $('#newly_added #new_item_tax_'+items_id).val(tax1);
                $('#newly_added #new_item_tax2_'+items_id).val(tax2);
                $('#newly_added #new_item_total'+items_id).val(total);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_id').val(items_id);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_quty').val(quty);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_free').val(free);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_cost').val(cost);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_price').val(price);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax').val(tax1);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax2').val(tax2);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount').val(discount);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount2').val(discount2);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sub_total').val(parseFloat(quty)*parseFloat(cost));
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val(total);
                $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #total_amount").val())) 
                    $("#parsley_reg #total_amount").val(0);  
                if (isNaN($("#parsley_reg #demo_total_amount").val())) 
                    $("#parsley_reg #demo_total_amount").val(0);             
                if($('#parsley_reg #total_amount').val()==0){
                      $('#parsley_reg #total_amount').val(total-parseFloat(old_total));
                }else{
                    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total-old_total));
                }
                console.log(parseFloat($('#parsley_reg #total_amount').val())+'/'+(total)+'/'+parseFloat(old_total))
                $('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
                clear_inputs();
            }else{   
                var po_quty=$('#po_quantity').val()
                var po_free=$('#po_free').val()
                var  name=$('#parsley_reg #item_name').val();
                var  sku=$('#parsley_reg #sku').val();
                var  quty=$('#parsley_reg #quantity').val();
                if($('#parsley_reg #free').val()!=""){
                var  free=$('#parsley_reg #free').val();
                }else{
                var  free=0;
                }
                var cost=$('#parsley_reg #cost').val();
                var price=$('#parsley_reg #price').val();
                var items_id=$('#parsley_reg #item_id').val();
                var supplier=$('#parsley_reg #supplier_guid').val();
                var limit=$('#parsley_reg #po_quantity').val();
                var tax_value=$('#parsley_reg #tax_value').val();
                var tax_type=$('#parsley_reg #tax_type').val();
                var tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
                var tax_value2=$('#parsley_reg #tax_value2').val();
                var tax_type2=$('#parsley_reg #tax_type2').val();
                var tax_Inclusive2=$('#parsley_reg #tax_Inclusive2').val();
                var per=parseFloat($('#discount_per').val());
                var per2=parseFloat($('#discount_per2').val());
                var discount=$('#parsley_reg #discount_amount').val();
                var discount2=$('#parsley_reg #discount_amount2').val();
                var type1='Inc';
                var type2='Inc';
                var tax1=(parseFloat(quty)*parseFloat(cost))*tax_value/100;
                var tax2=(parseFloat(quty)*parseFloat(cost))*tax_value2/100;
                var total= (parseFloat(quty)*parseFloat(cost));
                var sub_total= (parseFloat(quty)*parseFloat(cost));
                var total_tax=0;
                if(tax_Inclusive==0){
                   total=total+tax1;
                   type1='Exc';
                   total_tax=parseFloat(total_tax)+parseFloat(tax1);
                }
                if(tax_Inclusive==0){
                    type2='Exc';
                    total=total+tax2;
                    total_tax=parseFloat(total_tax)+parseFloat(tax2);
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
                var type='Exc';
                if(total_tax==0){
                    var type='Inc'
                    total_tax=parseFloat(tax1)+parseFloat(tax2);
                }
                var num = parseFloat(total_tax);
                total_tax=num.toFixed(point);
                $('#newly_added').append('<div id="newly_added_items_list_'+items_id+'"> \n\
                \n\
                <input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+items_id+'">\n\
                <input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+items_id+'"> \n\
                <input type="hidden" name="new_item_o_quty[]" value="'+po_quty+'" id="new_item_po_quty_'+items_id+'"> \n\
                <input type="hidden" name="new_item_po_free[]" value="'+po_free+'" id="new_item_po_free_'+items_id+'"> \n\
                <input type="hidden" name="new_item_free[]" value="'+free+'" id="new_item_free_'+items_id+'">\n\
                <input type="hidden" name="new_item_cost[]" value="'+cost+'" id="new_item_cost_'+items_id+'"> \n\
                <input type="hidden" name="new_item_price[]" value="'+price+'" id="new_item_price_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount[]" value="'+discount+'" id="new_item_discount_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount_per[]" value="'+per+'" id="new_item_discount_per_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount2[]" value="'+discount2+'" id="new_item_discount2_'+items_id+'">\n\
                <input type="hidden" name="new_item_discount_per2[]" value="'+per2+'" id="new_item_discount_per2_'+items_id+'">\n\
                <input type="hidden" name="new_item_tax[]" value="'+tax1+'" id="new_item_tax_'+items_id+'">\n\
                <input type="hidden" name="new_item_tax2[]" value="'+tax2+'" id="new_item_tax2_'+items_id+'">\n\
                <input type="hidden" name="new_item_total[]"  value="'+sub_total+'" id="new_item_total_'+items_id+'">\n\
                </div>'); 
                var addId = $('#selected_item_table').dataTable().fnAddData( [
                null,
                name,
                sku,
                po_quty,
                po_free,
                cost,
                quty,
                free,
                total_tax+'('+type+')',
                total_discount,
                total,     
                '<input type="hidden" name="index" id="index">\n\
                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                <input type="hidden" name="items_po_quty[]" value="'+po_quty+'" id="items_po_quty"> \n\
                <input type="hidden" name="items_po_free[]" value="'+po_free+'" id="items_po_free"> \n\
                <input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
                <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                <input type="hidden" name="items_order_guid[]" value="'+$('#item_order_id').val()+'" id="items_order_guid">\n\
                <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax2">\n\
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
                    $("#parsley_reg #total_amount").val(0) ;
                if (isNaN($("#parsley_reg #demo_total_amount").val())) 
                    $("#parsley_reg #demo_total_amount").val(0);          
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
        $('#parsley_reg #po_quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_po_quty').val());
        $('#parsley_reg #po_free').val($('#selected_item_table #new_item_row_id_'+guid+' #items_old_free').val());
        $('#parsley_reg #order_quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_po_quty').val());
        $('#parsley_reg #order_free').val($('#selected_item_table #new_item_row_id_'+guid+' #items_old_free').val());
        $('#parsley_reg #discount_per').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val());
        $('#parsley_reg #discount_amount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val());
        $('#parsley_reg #discount_per2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per2').val());
        $('#parsley_reg #discount_amount2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
        $('#parsley_reg #free').val($('#selected_item_table #new_item_row_id_'+guid+' #items_free').val());
        $('#parsley_reg #cost').val($('#selected_item_table #new_item_row_id_'+guid+' #items_cost').val());
        $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #items_price').val());
        $('#parsley_reg #sub_total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sub_total').val());
        $('#parsley_reg #tax_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type').val());
        $('#parsley_reg #tax_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val());
        $('#parsley_reg #tax_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val());
        $('#parsley_reg #tax_type2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type2').val());
        $('#parsley_reg #tax_value2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value2').val());
        $('#parsley_reg #tax_Inclusive2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive2').val());
        $('#parsley_reg #item_id').val(guid);
        var tax1=  $('#selected_item_table #new_item_row_id_'+guid+' #items_tax').val();
        var tax2=  $('#selected_item_table #new_item_row_id_'+guid+' #items_tax2').val();
        $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_total').val());
        var total_tax=0;
        if( $('#parsley_reg #tax_Inclusive').val()==0){
            total_tax=parseFloat(total_tax)+parseFloat(tax1);
        }
        if( $('#parsley_reg #tax_Inclusive2').val()==0){
            total_tax=parseFloat(total_tax)+parseFloat(tax2);
        }
        var type='Exc';
        if(total_tax==0){
            total_tax=parseFloat(tax1)+parseFloat(tax2);
            type='Inc';
        }
        var num = parseFloat(total_tax);
        total_tax=num.toFixed(point);
        var total_discount=parseFloat($('#parsley_reg #discount_amount').val())+parseFloat($('#parsley_reg #discount_amount2').val());
        var num = parseFloat(total_discount);
        item_discount=num.toFixed(point);
        $('#parsley_reg #item_tax').val(total_tax);
        $('#parsley_reg #item_discount').val(item_discount);
        $('#parsley_reg #tax_label').val('<?php echo $this->lang->line('tax') ?>('+type+')');
        $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });
        $('#discount_amount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val());
        $('#discount_amount2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount2').val());
        $('#discount_per').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val());
        $('#discount_per2').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per2').val());
        net_amount();
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
        $('#parsley_reg #free').val('');
        $('#parsley_reg #order_free').val('');
        $('#parsley_reg #order_quantity').val('');
        $('#parsley_reg #item_discount').val('');
        $('#parsley_reg #item_tax').val('');
        $('#parsley_reg #total').val('');
        $('#parsley_reg #sub_total').val('');
        $('#parsley_reg #cost').val('');
        $('#parsley_reg #price').val('');
        $('#parsley_reg #mrp').val('');
        $('#parsley_reg #tax').val('');
        $('#parsley_reg #item_free').val('');
        $('#parsley_reg #po_quantity').val('');
        $('#parsley_reg #discount_amount').val('');
        $('#parsley_reg #item_discount_per').val('');
        $('#parsley_reg #tax_value').val('');
        $('#parsley_reg #tax_type').val('');
        $('#parsley_reg #tax_Inclusive').val('');
        $('#parsley_reg #discount_amount2').val('');
        $('#parsley_reg #item_discount_per2').val('');
        $('#parsley_reg #tax_value2').val('');
        $('#parsley_reg #tax_type2').val('');
        $('#parsley_reg #tax_Inclusive2').val('');
        $('#parsley_reg #item_id').val('')
        $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
        $('#parsley_reg #dummy_discount').val('')
        $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
        $('#parsley_reg #items').select2('open');        
    }


    function items_free_cancel(){
      if(parseFloat($('#parsley_reg #free').val())>parseFloat($('#parsley_reg #po_free').val()) && $('#parsley_reg #po_free').val()!=0){
           $('#free').val($('#po_free').val());
        }
        if($('#parsley_reg #po_free').val()==0){
            $('#free').val(0);
        }

    }
</script>

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('purchase_order/upadate_pos_purchase_order_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('purchase_order')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="order_number" ><?php echo $this->lang->line('order_number') ?></label>													
                                                                     <?php $order_number=array('name'=>'demo_order_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'purchase_order_number',
                                                                                    
                                                                                        'value'=>set_value('order_number'));
                                                                         echo form_input($order_number)?>
                                                            <input type="hidden" name="order_number" id="order_number">
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                     'disabled'=>'disabled',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                        <input type="hidden" id="purchase_order_guid" name="purchase_order_guid">
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
                                                                                          'onKeyPress'=>"new_order_date(event)", 
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
                                                                                            'onKeyPress'=>"new_expiry_date(event)", 
                                                                                            'value'=>set_value('expiry_date'));
                                                                             echo form_input($expiry_date)?>
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
                                                    <input type="hidden" name="item_name" id="item_name">
                                                    <input type="hidden" name="sku" id="sku">
                                                    <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                    <input type="hidden" name="po_free" id="po_free">
                                                    <input type="hidden" name="po_quantity" id="po_quantity">
                                                    <input type="hidden" name="discount_amount" id="discount_amount">
                                                    <input type="hidden" name="discount_amount2" id="discount_amount2">
                                                    <input type="hidden" name="discount_per" id="discount_per">
                                                    <input type="hidden" name="discount_per2" id="discount_per2">
                                                    <input type="hidden" name="item_cost" id="item_cost">
                                                    <input type="hidden" name="item_order_id" id="item_order_id">
                                                   
                                                        </div>
                                                
                                                 <div class="col col-lg-1" style="padding:1px;width: 120px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'order_quantity',
                                                                                             'disabled'=>'disabled',
                                                                  
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
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
                                                
                                                  <div class="col col-lg-1" style="padding:1px; width: 80px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="free" class="text-center" ><?php echo $this->lang->line('free'); ?></label>

                                                                 <?php $free=array('name'=>'free',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'order_free',
                                                                                             'disabled'=>'disabled',
                                                                  
                                                                                            'value'=>set_value('free'));
                                                                              echo form_input($free)?>
                                                              
                                                               
                                                        </div>
                                                        </div>
                                                  <div class="col col-lg-1" style="padding:1px; width: 80px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="free" class="text-center" ><?php echo $this->lang->line('free'); ?></label>

                                                                 <?php $free=array('name'=>'free',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'free',
                                                                                           'onkeyup' =>'items_free_cancel()',
                                                                     'onKeyPress'=>"add_new_free(event); return numbersonly(event)",
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
                                                                                            'disabled'=>'disabled',
                                                                                            'onKeyPress'=>"add_new_cost(event); return numbersonly(event)",
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
                                                                                            'disabled'=>'disabled',
                                                                                            'onKeyPress'=>"add_new_price(event); return numbersonly(event)",
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                          
                                                
                                  
                                                
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="tax" class="text-center" id="tax_label"  ><?php echo $this->lang->line('tax') ?></label>

                                                                 <?php $tax=array('name'=>'tax',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'item_tax',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('tax'));
                                                                             echo form_input($tax)?>
                                                        </div>
                                                    </div>
                                               
                                                <div class="col col-lg-1" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="total" class="text-center"  ><?php echo $this->lang->line('discount') ?></label>

                                                                <?php $item_discount=array('name'=>'item_discount',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'item_discount',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('item_discount'));
                                                                             echo form_input($item_discount)?>
                                                                
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
                                    <th><?php echo $this->lang->line('po_quantity') ?></th>
                                    <th><?php echo $this->lang->line('po_free') ?></th>
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('cancel_quty') ?></th>
                                    <th><?php echo $this->lang->line('cancel_free') ?></th>
                                    
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
                                             
                                               </div>
                                          <div class="col col-sm-3" style="padding-top: 50px"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_purchase_order()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
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
                                                      <br>
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
	
               

      