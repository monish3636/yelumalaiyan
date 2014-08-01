
<script type="text/javascript" charset="utf-8">
    var point=3; 
    $(document).ready( function () {
        refresh_items_table();
        $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('sales_return') ?>');
        $('#add_new_order').hide();
        posnic_table();
        parsley_reg.onsubmit=function()
        { 
            return false;
        } 
    } );
    function refresh_items_table(){
        $('#selected_item_table').dataTable().fnClearTable();
        if($('#selected_item_table').length) {
            $('#selected_item_table').dataTable({
                "bProcessing": true,
                "bDestroy": true ,
                "sPaginationType": "bootstrap_full",
                "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                    $("td:first", nRow).html(iDisplayIndex +1);
                    $("#index", nRow).val(iDisplayIndex +1);
                   return nRow;
                },
            });
        }
        $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('sales_return') ?>');
    }        
    function posnic_table(){
        $('#dt_table_tools').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo base_url() ?>index.php/sales_return/data_table",
             aoColumns: [  
                { "bVisible": false} ,
                {	
                    "sName": "ID",
                    "bSearchable": false,
                    "bSortable": false,
                    "fnRender": function (oObj) {
                        if(oObj.aData[7]==1){
                            return "<input type=checkbox value='"+oObj.aData[0]+"' disabled='disabled' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                        }else{
                            return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                        }
                    },
                },
                null, , null,  null, 
                {	
                    "sName": "ID",
                    "bSearchable": false,
                    "bSortable": false,
                    "fnRender": function (oObj) {
                        if(oObj.aData[7]==1){
                            return '<span data-toggle="tooltip" class="text-success" ><?php echo $this->lang->line('approved') ?></span>'
                        }else{
                            return '<span data-toggle="tooltip"  class=" text-warning" ><?php echo $this->lang->line('waiting') ?></span>';
                        }
                    },
                },
                {	
                    "sName": "ID1",
                    "bSearchable": false,
                    "bSortable": false,

                    "fnRender": function (oObj) {
                        if(oObj.aData[7]==1){
                            return '<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
                        }else{
                            return '<a href=javascript:sales_return_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                        }
                    },
                },
            ]
        });
    }
    function posnic_item_table(guid){
        var supplier=$('#edit_brand_form #supplier_guid').val();
        if($('#edit_brand_form #supplier_guid').val()==""){
            supplier=guid;
        }
        if($('#selected_item_table').length) {
            $('#selected_item_table').dataTable({
                "sPaginationType": "bootstrap_full"
            });
        }	
    }
    function user_function(guid){
        <?php
        if($this->session->userdata['sales_return_per']['delete']==1){ ?>
            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('items') ?> "+$('#order__number_'+guid).val(), function(result) {
                if(result){
                    $.ajax({
                        url: '<?php echo base_url() ?>/index.php/sales_return/delete',
                        type: "POST",
                        data: {
                            guid: guid

                        },
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('sales_return') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                $("#dt_table_tools").dataTable().fnDraw();
                            }else{
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_return');?>', { type: "error" });                       
                            }
                        }
                    });
                }
            }); 
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('sales_return');?>', { type: "error" });                       
            <?php
        }
        ?>
    }   
    function sales_return_approve(guid){
        <?php
        if($this->session->userdata['sales_return_per']['approve']==1){ ?>
            $.ajax({
                url: '<?php echo base_url() ?>index.php/sales_return/sales_return_approve',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                complete: function(response) {
                    if(response['responseText']=='TRUE'){
                        $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('sales_return') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_return');?>', { type: "error" });                              
                    }
                }
            });
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_return');?>', { type: "error" });                       
            <?php
        }
        ?>
    }
          
    function edit_function(guid){
        <?php
        if($this->session->userdata['sales_return_per']['edit']==1){ ?>
            $('#deleted').remove();
            $('#parent_items').append('<div id="deleted"></div>');
            $('#newly_added').remove();
            $('#parent_items').append('<div id="newly_added"></div>');
            refresh_items_table();
            $('#update_button').show();
            $('#save_button').hide();
            $('#update_clear').show();
            $('#save_clear').hide();
            $('#loading').modal('show');
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/sales_return/get_sales_return/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#add_new_order').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_sales_return').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#sales_return_lists').removeAttr("disabled");
                    $('#loading').modal('hide');
                    $("#parsley_reg").trigger('reset');
                    $("#parsley_reg #sales_bill").select2('data', {id:data[0]['invoice'],text: data[0]['invoice']});
                    $("#parsley_reg #sales_bill_id").val(data[0]['sales_bill_id']);
                    $("#parsley_reg #customer").val(data[0]['first_name']);
                    $("#parsley_reg #sales_bill").select2('disable');
                    $("#parsley_reg #sales_return_guid").val(guid);
                    $("#parsley_reg #demo_order_number").val(data[0]['code']);
                    $("#parsley_reg #order_number").val(data[0]['code']);
                    $("#parsley_reg #order_date").val(data[0]['date']);
                    $("#parsley_reg #sales_date").val(data[0]['sales_date']);
                    $("#parsley_reg #note").val(data[0]['note']);
                    $("#parsley_reg #remark").val(data[0]['remark']);
                    $("#parsley_reg #demo_total_amount").val(data[0]['total_amount']);
                    $("#parsley_reg #total_amount").val(data[0]['total_amount']);                                
                    var num = parseFloat($('#demo_total_amount').val());
                    $('#demo_total_amount').val(num.toFixed(point));
                    var num = parseFloat($('#total_amount').val());
                    $('#total_amount').val(num.toFixed(point)); 
                    $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                    var tax;
                    for(i=0;i<data.length;i++){
                        if(!$('#'+data[i]['o_i_guid']).length){
                            var  name=data[i]['items_name'];
                            var  sku=data[i]['i_code'];
                            var  items_id=data[i]['item'];  
                            if(data[i]['kit_name']){
                                name=data[i]['kit_name'];
                            }
                            var  sku=data[i]['i_code'];
                            if(data[i]['kit_code']){
                                sku=data[i]['kit_code'];
                            }
                            if(data[i]['deco_code']){
                                sku=data[i]['deco_code']+'-'+data[i]['deco_value'];
                            }
                            var  quantity=data[i]['quty'];
                            var  limit=data[i]['item_limit'];
                            var  tax_type=data[i]['tax_type_name'];
                            var  tax_value1=data[i]['tax_value'];
                            var  tax_inclusive1=data[i]['tax_Inclusive'];
                            var  tax_type2=data[i]['tax2_type'];
                            var  tax_value2=data[i]['tax2_value'];
                            var  tax_inclusive2=data[i]['tax_inclusive2'];
                            var  price=data[i]['sell'];
                            var  discount=data[i]['item_discount'];
                            if(data[i]['kit_code']){
                                tax_type=data[i]['kit_tax_type'];
                                tax_value1=data[i]['kit_tax_value'];
                                tax_inclusive1=data[i]['kit_tax_Inclusive'];
                                tax_type2=0;
                                tax_value2=0;
                                tax_inclusive2=0;
                            }
                            var total=parseFloat(quantity)*parseFloat(price);
                            var sub_total=parseFloat(quantity)*parseFloat(price);
                            var total_tax=0;
                            var tax1=0;
                            var type1='Inc';
                            var type2='Inc';
                            tax1=sub_total*parseFloat(tax_value1)/100;
                            if(tax_inclusive1==0){
                                total=parseFloat(tax1)+parseFloat(sub_total);
                                type1='Exc';
                            }
                            total_tax=parseFloat(total_tax)+parseFloat(tax1);
                            var tax2=0;
                            tax2=sub_total*parseFloat(tax_value2)/100;
                            if(tax_inclusive2==0){
                                total=parseFloat(tax2)+parseFloat(total);
                                type2='Exc';
                            }
                            total_tax=parseFloat(total_tax)+parseFloat(tax2);
                            var discount_amount=0;

                            if(discount!=0 && discount!=""){
                                discount_amount=total*parseFloat(discount)/100;
                            }
                            total=parseFloat(total)-parseFloat(discount_amount);

                            var num = parseFloat(total_tax);
                            total_tax=num.toFixed(point);
               
                            var num = parseFloat(discount_amount);
                            discount_amount=num.toFixed(point);
                            var num = parseFloat(total);
                            total=num.toFixed(point);
                            var tax_text2=0;
                            var tax_text1=0;
                            if(tax2!=0){
                                tax_text2=tax2+':'+tax_type2+'('+type2+')';
                            }
                            if(tax1!=0){
                                tax_text1=tax1+':'+tax_type+'('+type1+')';
                            }
                            
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name,
                                sku,
                                quantity,
                                price,
                                tax_text1,
                                tax_text2,
                                discount_amount,
                                total,
                                '<input type="hidden" name="index" id="index">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                                <input type="hidden" name="items_quty[]" value="'+quantity+'" id="items_quty">\n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_order_guid[]" value="'+data[i]['o_i_guid']+'" id="items_order_guid">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value1+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_inclusive1+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                                <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                                <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_inclusive2+'" id="items_tax_inclusive2">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                <a href=javascript:edit_order_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                                var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                                theNode.setAttribute('id','new_item_row_id_'+items_id)
                            }
                        }
                    } 
                
            });
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('sales_return');?>', { type: "error" });                       
            <?php
        }?>
    }
</script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  