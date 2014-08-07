
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
                
        
   

        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
                     $('#add_new_order').hide();
                              posnic_table();
                                
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                $("#test").select2("enable", false); 
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
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/purchase_order/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    if(oObj.aData[9]==1){
                                                                        return "<input type=checkbox value='"+oObj.aData[0]+"' disabled='disabled' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                    }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                    }
								},
								
								
							},
        
        null, null, null, {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							//if(oObj.aData[8]==0)
                                                                      return   oObj.aData[5];
								},
								
								
							}

, null,  null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[9]==1){
                                                                             return '<span data-toggle="tooltip" class="text-success" ><?php echo $this->lang->line('approved') ?></span>'
                                                                        }else{
                                                                            return '<span data-toggle="tooltip"  class=" text-warning" ><?php echo $this->lang->line('waiting') ?></span>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                if(oObj.aData[9]==1){
                                                                         	 return '<a href=javascript:purchase_order_invoice("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('print') ?>"><i class="glyphicon glyphicon-print"></i></span></a>&nbsp<a href=javascript:purchase_order_view("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
								}else{
                                                                        return '<a href=javascript:purchase_order_invoice("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('print') ?>"><i class="glyphicon glyphicon-print"></i></span></a>&nbsp<a href=javascript:purchase_order_view("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a href=javascript:purchase_order_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
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
    <?php if($this->session->userdata['purchase_order_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('items') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/purchase_order/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                 complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_order') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
   <?php }
?>
                        }
           
          
        
function purchase_order_approve(guid){
        <?php if($this->session->userdata['purchase_order_per']['approve']==1){ ?>
            $.ajax({
                url: '<?php echo base_url() ?>index.php/purchase_order/purchase_order_approve',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_order') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_order');?>', { type: "error" });                              
                    }
                    }
            });
            <?php }else{?>
                        $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
                <?php }
             ?>
}
          
    function edit_function(guid){
        <?php
        if($this->session->userdata['purchase_order_per']['edit']==1){ ?>
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
                url: "<?php echo base_url() ?>index.php/purchase_order/get_purchase_order/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#add_new_order').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_purchase_order').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#purchase_order_lists').removeAttr("disabled");
                    $('#loading').modal('hide');
                    $("#parsley_reg").trigger('reset');
                    $("#parsley_reg #first_name").select2('data', {id:'1',text: data[0]['s_name']});
                    $("#parsley_reg #company").val(data[0]['c_name']);
                    $("#parsley_reg #address").val(data[0]['address']);
                    $("#parsley_reg #purchase_order_guid").val(guid);
                    $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                    $("#parsley_reg #order_number").val(data[0]['po_no']);
                    $("#parsley_reg #order_date").val(data[0]['po_date']);
                    $("#parsley_reg #expiry_date").val(data[0]['exp_date']);

                    $("#parsley_reg #id_discount").val(data[0]['discount']);
                    $("#parsley_reg #note").val(data[0]['note']);
                    $("#parsley_reg #remark").val(data[0]['remark']);
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #freight").val(data[0]['freight']);
                    $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                    $("#parsley_reg #demo_grand_total").val(data[0]['total_amt']);
                    $("#parsley_reg #grand_total").val(data[0]['total_amt']);

                    $("#parsley_reg #demo_total_amount").val(data[0]['total_item_amt']);
                    $("#parsley_reg #total_amount").val(data[0]['total_item_amt']);
                    var num = parseFloat($('#demo_total_amount').val());
                    $('#demo_total_amount').val(num.toFixed(point));

                    var num = parseFloat($('#total_amount').val());
                    $('#total_amount').val(num.toFixed(point));

                    var num = parseFloat($('#grand_total').val());
                    $('#grand_total').val(num.toFixed(point));

                    var num = parseFloat($('#demo_grand_total').val());
                    $('#demo_grand_total').val(num.toFixed(point));
                                  
                    $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                    var tax;
                    for(i=0;i<data.length;i++){
                        if(!$('#'+data[i]['o_i_guid']).length){
                            var  name=data[i]['items_name'];
                            var  sku=data[i]['i_code'];
                            var  quty=data[i]['quty'];
                            var  limit=data[i]['item_limit'];
                            var  tax_type=data[i]['tax_type_name'];
                            var  tax_value=data[i]['tax_value'];
                            var  tax_Inclusive=data[i]['tax_Inclusive'];
                            var  tax_type2=data[i]['tax2_type'];
                            var  tax_value2=data[i]['tax2_value'];
                            var  tax_Inclusive2=data[i]['tax_inclusive2'];                                  
                            var  free=data[i]['free'];                                   
                            var  cost=data[i]['cost'];
                            var  price=data[i]['sell'];
                            var  mrp=data[i]['mrp'];
                            var  o_i_guid=data[i]['o_i_guid'];
                            var  items_id=data[i]['item'];
                            var total=parseFloat(quty)*parseFloat(cost);
                            var subtotal=parseFloat(quty)*parseFloat(cost);
                            var discount=data[i]['item_dis_amt'];
                            var discount2=data[i]['item_dis_amt2'];
                            var per=data[i]['dis_per'];
                            var per2=data[i]['dis_per2'];                                   
                            var type='Inc';
                            var tax=data[i]['order_tax'];  
                            if(data[i]['tax_Inclusive']==0){                                                                          
                                var total=(parseFloat(tax)+parseFloat(total));
                                type='Exc';
                            }
                            var type2='Inc';
                            var tax2=data[i]['order_tax2'];  
                            if(data[i]['tax_inclusive2']==0){                                                                          
                                var total=(parseFloat(tax2)+parseFloat(total));
                                type2='Exc';
                            }
                            if(per!="" && per!=0){
                                discount=parseFloat(total)*parseFloat(per)/100;
                            }
                            if(per2!="" && per2!=0){
                                discount2=(parseFloat(total)-parseFloat(discount))*parseFloat(per2)/100;
                            }
                            var total_discount=parseFloat(discount)+parseFloat(discount2);
                            total=parseFloat(total)-parseFloat(total_discount);
                            var num = parseFloat(total_discount);
                            total_discount=num.toFixed(point);
                            var num = parseFloat(total);
                            total=num.toFixed(point);
                            var num = parseFloat(subtotal);
                            subtotal=num.toFixed(point);
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            free,
                            cost,
                            price,
                            parseFloat(quty)*parseFloat(cost),
                            tax+' : '+tax_type+'('+type+')',
                            tax2+' : '+tax_type2+'('+type2+')',
                            total_discount,
                            total,
                            '<input type="hidden" name="index" id="index"><input type="hidden" id="'+o_i_guid+'">\n\
                            <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                            <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                            <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                            <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                            <input type="hidden" name="items_order_guid[]" value="'+o_i_guid+'" id="items_order_guid">\n\
                            <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                            <input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
                            <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
                            <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                            <input type="hidden" name="items_mrp[]" value="'+mrp+'" id="items_mrp">\n\
                            <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                            <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                            <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                            <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                            <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                            <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                            <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax2">\n\
                            <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                            <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                            <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_Inclusive2+'" id="items_tax_inclusive2">\n\
                            <input type="hidden" name="items_discount2[]" value="'+discount2+'" id="items_discount2">\n\
                            <input type="hidden" name="items_discount_per2[]" value="'+per2+'" id="items_discount_per2">\n\
                            <input type="hidden" name="items_sub_total[]"  value="'+subtotal+'" id="items_sub_total">\n\
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
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
            <?php
        }?>
    }
    function purchase_order_view(guid){
        <?php
        if($this->session->userdata['purchase_order_per']['view']==1){ ?>
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
                url: "<?php echo base_url() ?>index.php/purchase_order/view_purchase_order/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    invoice_disable();
                    $("#update_button").hide();
                    $("#update_clear").hide();
                    $("#user_list").hide();
                    $('#add_new_order').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_purchase_order').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#purchase_order_lists').removeAttr("disabled");
                    $('#loading').modal('hide');
                    $("#parsley_reg").trigger('reset');
                    $("#parsley_reg #first_name").select2('data', {id:'1',text: data[0]['s_name']});
                    $("#parsley_reg #company").val(data[0]['c_name']);
                   
                    $("#parsley_reg #address").val(data[0]['address']);
                    $("#parsley_reg #purchase_order_guid").val(guid);
                    $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                    $("#parsley_reg #order_number").val(data[0]['po_no']);
                    $("#parsley_reg #order_date").val(data[0]['po_date']);
                    $("#parsley_reg #expiry_date").val(data[0]['exp_date']);

                    $("#parsley_reg #id_discount").val(data[0]['discount']);
                    $("#parsley_reg #note").val(data[0]['note']);
                    $("#parsley_reg #remark").val(data[0]['remark']);
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #freight").val(data[0]['freight']);
                    $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                    $("#parsley_reg #demo_grand_total").val(data[0]['total_amt']);
                    $("#parsley_reg #grand_total").val(data[0]['total_amt']);

                    $("#parsley_reg #demo_total_amount").val(data[0]['total_item_amt']);
                    $("#parsley_reg #total_amount").val(data[0]['total_item_amt']);
                    var num = parseFloat($('#demo_total_amount').val());
                    $('#demo_total_amount').val(num.toFixed(point));                    
                    var num = parseFloat($('#total_amount').val());
                    $('#total_amount').val(num.toFixed(point));

                    var num = parseFloat($('#grand_total').val());
                    $('#grand_total').val(num.toFixed(point));

                    var num = parseFloat($('#demo_grand_total').val());
                    $('#demo_grand_total').val(num.toFixed(point));
                                  
                    $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                    var tax;
                    for(i=0;i<data.length;i++){
                        if(!$('#'+data[i]['o_i_guid']).length){
                            var  name=data[i]['items_name'];
                            var  sku=data[i]['i_code'];
                            var  quty=data[i]['quty'];
                            var  limit=data[i]['item_limit'];
                            var  tax_type=data[i]['tax_type_name'];
                            var  tax_value=data[i]['tax_value'];
                            var  tax_Inclusive=data[i]['tax_Inclusive'];
                            var  tax_type2=data[i]['tax2_type'];
                            var  tax_value2=data[i]['tax2_value'];
                            var  tax_Inclusive2=data[i]['tax_inclusive2'];                                  
                            var  free=data[i]['free'];                                   
                            var  cost=data[i]['cost'];
                            var  price=data[i]['sell'];
                            var  mrp=data[i]['mrp'];
                            var  o_i_guid=data[i]['o_i_guid'];
                            var  items_id=data[i]['item'];
                            var total=parseFloat(quty)*parseFloat(cost);
                            var subtotal=parseFloat(quty)*parseFloat(cost);
                            var discount=data[i]['item_dis_amt'];
                            var discount2=data[i]['item_dis_amt2'];
                            var per=data[i]['dis_per'];
                            var per2=data[i]['dis_per2'];                                   
                            var type='Inc';
                            var tax=data[i]['order_tax'];  
                            if(data[i]['tax_Inclusive']==0){                                                                          
                                var total=(parseFloat(tax)+parseFloat(total));
                                type='Exc';
                            }
                            var type2='Inc';
                            var tax2=data[i]['order_tax2'];  
                            if(data[i]['tax_inclusive2']==0){                                                                          
                                var total=(parseFloat(tax2)+parseFloat(total));
                                type2='Exc';
                            }
                            if(per!="" && per!=0){
                                discount=parseFloat(total)*parseFloat(per)/100;
                            }
                            if(per2!="" && per2!=0){
                                discount2=(parseFloat(total)-parseFloat(discount))*parseFloat(per2)/100;
                            }
                            var total_discount=parseFloat(discount)+parseFloat(discount2);
                            total=parseFloat(total)-parseFloat(total_discount);
                            var num = parseFloat(total_discount);
                            total_discount=num.toFixed(point);
                            var num = parseFloat(total);
                            total=num.toFixed(point);
                            var num = parseFloat(subtotal);
                            subtotal=num.toFixed(point);
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            free,
                            cost,
                            price,
                            parseFloat(quty)*parseFloat(cost),
                            tax+' : '+tax_type+'('+type+')',
                            tax2+' : '+tax_type2+'('+type2+')',
                            total_discount,
                            total,
                            '<input type="hidden" name="index" id="index"><input type="hidden" id="'+o_i_guid+'">\n\
                            <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                            <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                            <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                            <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                            <input type="hidden" name="items_order_guid[]" value="'+o_i_guid+'" id="items_order_guid">\n\
                            <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                            <input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
                            <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
                            <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                            <input type="hidden" name="items_mrp[]" value="'+mrp+'" id="items_mrp">\n\
                            <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                            <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                            <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                            <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                            <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                            <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                            <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax2">\n\
                            <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                            <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                            <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_Inclusive2+'" id="items_tax_inclusive2">\n\
                            <input type="hidden" name="items_discount2[]" value="'+discount2+'" id="items_discount2">\n\
                            <input type="hidden" name="items_discount_per2[]" value="'+per2+'" id="items_discount_per2">\n\
                            <input type="hidden" name="items_sub_total[]"  value="'+subtotal+'" id="items_sub_total">\n\
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
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
            <?php
        }?>
    }
    function purchase_order_invoice(guid){
        <?php
        if($this->session->userdata['purchase_order_per']['print_invoice']==1){ ?>
            $('#loading').modal('show');
            $("#user_list").hide();
            $('#add_new_order').hide();
            $('#invoice_settings').hide();
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_purchase_order').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#purchase_order_lists').removeAttr("disabled");
            $('#invoice_div').show();
            $('#purchase_order_guid').val(guid);
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/purchase_order/get_invoice_settings_and_purchase_order/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                        if(data[1]['posnic_order_id']==1){
                            $('#invoice_posnic_id').show();
                            $('#invoice_posnic_id').html(data[0][0]['po_no'])
                        }else{
                            $('#invoice_posnic_id').hide();
                        }
                        if(data[1]['posnic_number']==1){
                            $('#invoice_posnic_number').show();
                            $('#invoice_posnic_number').html('<?php echo $this->lang->line('order') ?> <span class="text-muted "> #'+data[0][0]['id']+'</span>')
                        }else{
                            $('#invoice_posnic_number').hide();
                        }
                        if(data[1]['posnic_date']==1){
                            $('#invoice_posnic_date').show();
                              $('#invoice_posnic_date').html('<?php echo $this->lang->line('date') ?> : <span class="text-muted">'+data[0][0]['po_date']+'</span>');
                        }else{
                            $('#invoice_posnic_date').hide();
                        }
                        if(data[1]['posnic_expiry']==1){
                            $('#invoice_posnic_expiry_date').show();
                              $('#invoice_posnic_expiry_date').html('<?php echo $this->lang->line('expiry_date') ?> : <span class="text-muted">'+data[0][0]['exp_date']+'</span>')
                        }else{
                            $('#invoice_posnic_expiry_date').hide();
                        }
                        if(data[1]['posnic_barcode']==1){
                            $('#invoice_posnic_barcode').show();
                           //   $('#invoice_posnic_branch_code').html(data[0][0]['branch_code']);
                        }else{
                            $('#invoice_posnic_barcode').hide();
                        }
                        if(data[1]['posnic_branch_code']==1){
                            $('#invoice_posnic_branch_code').show();
                            $('#invoice_posnic_branch_code').html(data[0][0]['branch_code']);
                        }else{
                            $('#invoice_posnic_branch_code').hide();
                        }
                        if(data[1]['posnic_branch_name']==1){
                            $('#invoice_posnic_branch_name').show();
                            $('#invoice_posnic_branch_name').html(data[0][0]['branch_address']);
                        }else{
                            $('#invoice_posnic_branch_name').hide();
                        }
                        if(data[1]['posnic_branch_city']==1){
                            $('#invoice_posnic_branch_city').show();
                            $('#invoice_posnic_branch_city').html(data[0][0]['branch_city']);
                        }else{
                            $('#invoice_posnic_branch_city').hide();
                        }
                        if(data[1]['posnic_branch_state']==1){
                            $('#invoice_posnic_branch_state').show();
                              $('#invoice_posnic_branch_state').html(data[0][0]['branch_state']);
                        }else{
                            $('#invoice_posnic_branch_state').hide();
                        }
                        if(data[1]['posnic_branch_zip']==1){
                            $('#invoice_posnic_branch_zip').show();
                              $('#invoice_posnic_branch_zip').html(data[0][0]['branch_zip']);
                        }else{
                            $('#invoice_posnic_branch_zip').hide();
                        }
                        if(data[1]['posnic_branch_country']==1){
                            $('#invoice_posnic_branch_country').show();
                            $('#invoice_posnic_branch_country').html(data[0][0]['branch_country']);
                        }else{
                            $('#invoice_posnic_branch_country').hide();
                        }
                        if(data[1]['posnic_branch_phone']==1){
                             $('#invoice_posnic_branch_phone').show();
                              $('#invoice_posnic_branch_phone').html(data[0][0]['branch_phone']);
                        }else{
                            $('#invoice_posnic_branch_phone').hide();
                        }
                        if(data[1]['posnic_branch_email']==1){
                            $('#invoice_posnic_branch_email').show();
                            $('#invoice_posnic_branch_email').html(data[0][0]['branch_mail']);
                        }else{
                            $('#invoice_posnic_branch_email').hide();
                        }
                        
                        
                        if(data[1]['posnic_supplier_name']==1){
                            $('#invoice_posnic_supplier_name').show();
                            $('#invoice_posnic_supplier_name').html(data[0][0]['s_name']);
                        }else{
                            $('#invoice_posnic_supplier_name').hide();
                        }
                        if(data[1]['posnic_supplier_company']==1){
                            $('#invoice_posnic_supplier_company').show();
                            $('#invoice_posnic_supplier_company').html(data[0][0]['c_name']);
                        }else{
                            $('#invoice_posnic_supplier_company').hide();
                        }
                        if(data[1]['posnic_supplier_address']==1){
                             $('#invoice_posnic_supplier_address').show();
                            $('#invoice_posnic_supplier_address').html(data[0][0]['address']);
                        }else{
                            $('#invoice_posnic_supplier_address').hide();
                        }
                        if(data[1]['posnic_supplier_city']==1){
                            $('#invoice_posnic_supplier_city').show();
                            $('#invoice_posnic_supplier_city').html(data[0][0]['supplier_city']);
                        }
                        else{
                            $('#invoice_posnic_supplier_city').hide();
                        }
                        if(data[1]['posnic_supplier_state']==1){
                             $('#invoice_posnic_supplier_state').show();
                              $('#invoice_posnic_supplier_state').html(data[0][0]['supplier_state']);
                        }else{
                            $('#invoice_posnic_supplier_state').hide();
                        }
                        if(data[1]['posnic_supplier_zip']==1){
                             $('#invoice_posnic_supplier_zip').show();
                              $('#invoice_posnic_supplier_zip').html(data[0][0]['supplier_zip']);
                        }else{
                            $('#invoice_posnic_supplier_zip').hide();
                        }
                        if(data[1]['posnic_supplier_country']==1){
                             $('#invoice_posnic_supplier_country').show();
                              $('#invoice_posnic_supplier_country').html(data[0][0]['supplier_country']);
                        }else{
                            $('#invoice_posnic_supplier_country').hide();
                        }
                        if(data[1]['posnic_supplier_email']==1){
                             $('#invoice_posnic_supplier_email').show();
                              $('#invoice_posnic_supplier_email').html(data[0][0]['supplier_email']);
                        }else{
                            $('#invoice_posnic_supplier_email').hide();
                        }
                        
                        if(data[1]['posnic_supplier_phone']==1){
                            $('#invoice_posnic_supplier_phone').show();
                            $('#invoice_posnic_supplier_phone').html(data[0][0]['supplier_phone']);
                        }else{
                            $('#invoice_posnic_supplier_phone').hide();
                        }
                       $('#invoice_posnic_table thead').remove();
                       $('#invoice_posnic_table tbody').remove();
                       $('#invoice_posnic_table tfoot').remove();
                        
                     $('#invoice_posnic_table').append('<thead/><tbody/><tfoot/>');
                        $('#invoice_posnic_table thead').append('<tr id="posnic_table_head"><td><?php echo $this->lang->line('no') ?></td></tr>');
                        if(data[1]['posnic_item_name']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td2"><?php echo $this->lang->line('name') ?></td>');
                        }
                        if(data[1]['posnic_item_sku']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td3"><?php echo $this->lang->line('sku') ?></td>');
                        }
                        if(data[1]['posnic_item_selling_price']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td4"><?php echo $this->lang->line('selling_price') ?></td>');
                        }
                        if(data[1]['posnic_item_mrp']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td4"><?php echo $this->lang->line('mrp') ?></td>');
                        }
                        if(data[1]['posnic_item_price']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td4"><?php echo $this->lang->line('cost') ?></td>');
                        }
                        if(data[1]['posnic_item_quantity']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td5"><?php echo $this->lang->line('quantity') ?></td>');
                        }
                        if(data[1]['posnic_item_free_quantity']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td5"><?php echo $this->lang->line('free') ?></td>');
                        }
                        if(data[1]['posnic_item_tax1']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td6"><?php echo $this->lang->line('tax') ?> 1</td>');
                        }
                        if(data[1]['posnic_item_tax2']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td7"><?php echo $this->lang->line('tax') ?> 2</td>');
                        }
                        if(data[1]['posnic_item_discount1']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td8"><?php echo $this->lang->line('discount') ?> 1</td>');
                        }
                        if(data[1]['posnic_item_discount2']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td9"><?php echo $this->lang->line('discount') ?> 2</td>');
                        }
                        if(data[1]['posnic_item_subtotal']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td10" class="text-right"><?php echo $this->lang->line('sub_total') ?> </td>');
                        }
                        
                        $('#invoice_posnic_order_text').html(data[1]['posnic_message']);
                        var total_inclusive_tax=0;
                        var total_exclusive_tax=0;
                        var total_item_discount=0;
                        var purchase_order_discount=0;                        
                        var purchase_order_frieght=0;                        
                        var purchase_order_round_off_amount=0;                        
                        var purchase_order_sub_total=0;                        
                        var purchase_order_grand=0;                        
                        for(var i=0;i<data[0].length;i++){
                            var  quty=data[0][i]['quty'];
                            var  free=data[0][i]['free'];                                   
                            var  cost=data[0][i]['cost'];
                            var  selling_price=data[0][i]['sell'];
                            var  mrp=data[0][i]['mrp'];
                            var total=parseFloat(quty)*parseFloat(cost);
                            var subtotal=parseFloat(quty)*parseFloat(cost);
                            var discount=data[0][i]['item_dis_amt'];
                            var discount2=data[0][i]['item_dis_amt2'];
                            var per=data[0][i]['dis_per'];
                            var per2=data[0][i]['dis_per2'];                                   
                           
                            var tax=data[0][i]['order_tax'];  
                          
                            if(data[0][i]['tax_Inclusive']==0){                                                                          
                                total=(parseFloat(tax)+parseFloat(total));
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax);
                            }
                          
                            var tax2=data[0][i]['order_tax2'];  
                            if(data[0][i]['tax_inclusive2']==0){                                                                          
                                total=(parseFloat(tax2)+parseFloat(total));
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax2);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax2);
                            }
                            if(per!="" && per!=0){
                                discount=parseFloat(total)*parseFloat(per)/100;
                                total_item_discount=parseFloat(total_item_discount)+parseFloat(discount);
                            }
                            if(per2!="" && per2!=0){
                                discount2=(parseFloat(total)-parseFloat(discount))*parseFloat(per2)/100;
                                total_item_discount=parseFloat(total_item_discount)+parseFloat(discount2);
                            }
                            var total_discount=parseFloat(discount)+parseFloat(discount2);
                            total=parseFloat(total)-parseFloat(total_discount);
                            var num = parseFloat(total_discount);
                            total_discount=num.toFixed(point);
                            var num = parseFloat(total);
                            total=num.toFixed(point);
                            var num = parseFloat(subtotal);
                            subtotal=num.toFixed(point);
                            purchase_order_sub_total=parseFloat(purchase_order_sub_total)+parseFloat(total);
                             $('#invoice_posnic_table tbody').append('<tr id="posnic_table_body'+i+'"><td>'+parseInt(i+1)+'</td></tr>');
                            if(data[1]['posnic_item_name']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td2">'+data[0][i]['items_name']+'</td>');
                            }
                            if(data[1]['posnic_item_sku']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td3">'+data[0][i]['i_code']+'</td>');
                            }
                            if(data[1]['posnic_item_selling_price']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td4">'+selling_price+'</td>');
                            }
                            if(data[1]['posnic_item_mrp']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td4">'+mrp+'</td>');
                            }
                            if(data[1]['posnic_item_price']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td4">'+cost+'</td>');
                            }
                            if(data[1]['posnic_item_quantity']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td5">'+quty+'</td>');
                            }
                            if(data[1]['posnic_item_free_quantity']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td5">'+free+'</td>');
                            }
                            if(data[1]['posnic_item_tax1']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td6">'+data[0][i]['order_tax']+'</td>');
                            }
                            if(data[1]['posnic_item_tax2']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td7">'+data[0][i]['order_tax2']+'</td>');
                            }
                            if(data[1]['posnic_item_discount1']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td8">'+discount+'</td>');
                            }
                            if(data[1]['posnic_item_discount2']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td9">'+discount2+'</td>');
                            }
                            if(data[1]['posnic_item_subtotal']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td10" class="text-right">'+total+' </td>');
                            }
                        }
                        
                        if(data[1]['posnic_purchase_order_subtotal']==1){
                            var num = parseFloat(purchase_order_sub_total);
                            purchase_order_sub_total=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot1" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot1').append('<td ><?php echo $this->lang->line('sub_total') ?> </td>');
                            $('#posnic_table_tfoot1').append('<td class="text-right">'+purchase_order_sub_total+' </td>');                            
                        }
                        if(data[1]['posnic_inclusive_total_tax']==1){
                            var num = parseFloat(total_inclusive_tax);
                            total_inclusive_tax=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot2" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot2').append('<td ><?php echo $this->lang->line('total')." ".$this->lang->line('inclusive_tax') ?> </td>');
                            $('#posnic_table_tfoot2').append('<td class="text-right">'+total_inclusive_tax+' </td>');                            
                        }
                        if(data[1]['posnic_exclusive_total_tax']==1){
                            var num = parseFloat(total_exclusive_tax);
                            total_exclusive_tax=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot3" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot3').append('<td ><?php echo $this->lang->line('total')." ".$this->lang->line('inclusive_tax') ?> </td>');
                            $('#posnic_table_tfoot3').append('<td class="text-right">'+total_exclusive_tax+' </td>');                            
                        }
                        if(data[1]['posnic_total_item_discount']==1){
                            var num = parseFloat(total_item_discount);
                            total_item_discount=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot4" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot4').append('<td ><?php echo $this->lang->line('total')." ".$this->lang->line('item_discount') ?> </td>');
                            $('#posnic_table_tfoot4').append('<td class="text-right">'+total_item_discount+' </td>');                            
                        }
                        if(data[1]['posnic_discount']==1){
                            var value=data[0][0]['discount_amt'];
                            var num = parseFloat(value);
                            value=num.toFixed(point);
                            if(isNaN(parseFloat(value))) value=0;
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot5" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot5').append('<td ><?php echo $this->lang->line('order')." ".$this->lang->line('discount') ?> </td>');
                            $('#posnic_table_tfoot5').append('<td class="text-right">'+value+' </td>');                            
                        }
                        if(data[1]['posnic_frieght']==1){                            
                            var value=data[0][0]['freight'];
                            var num = parseFloat(value);
                            value=num.toFixed(point);
                            if(isNaN(parseFloat(value))) value=0;
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot6" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot6').append('<td ><?php echo $this->lang->line('freight')." ".$this->lang->line('amount') ?> </td>');
                            $('#posnic_table_tfoot6').append('<td class="text-right">'+value+' </td>');                            
                        }
                        if(data[1]['posnic_round_off_amount']==1){
                                                       
                            var value=data[0][0]['round_amt'];
                            var num = parseFloat(value);
                            value=num.toFixed(point);
                            if(isNaN(parseFloat(value))) value=0;
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot7" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot7').append('<td ><?php echo $this->lang->line('round_off_amount') ?> </td>');
                            $('#posnic_table_tfoot7').append('<td class="text-right">'+value+' </td>');                            
                        }
                        if(data[1]['posnic_grand_total']==1){
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot8" ><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot8').append('<td class="grand-total" ><?php echo $this->lang->line('grand_total') ?> </td>');
                            $('#posnic_table_tfoot8').append('<td class="text-right grand-total">'+data[0][0]['total_amt']+' </td>');                            
                        }
                        
                        
                        
                        $('#loading').modal('hide');
                }
            });
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You_Have_NO_Permission_To_Print')." ".$this->lang->line('invoice');?>', { type: "error" });                       
            <?php
        }?>
    }
    function invoice_disable(){
        $('#first_name').select2('disable');
        $('#sacn_items').hide();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
        $('#parsley_reg input').prop('disabled',true);
        $('#parsley_reg textarea').prop('disabled',true);
    }
    function invoice_enable(){
        $('#company').attr("disabled", "disabled");
        $('#address').attr("disabled", "disabled");
        $('#demo_order_number').attr("disabled", "disabled");
        $('#demo_total_amount').attr("disabled", "disabled");
        $('#grand_total').attr("disabled", "disabled");
        $('#sub_total').attr("disabled", "disabled");
        $('#tax').attr("disabled", "disabled");
        $('#first_name').select2('enable');
        $('#sacn_items').show();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
        $('#parsley_reg input').prop('disabled',false);
        $('#parsley_reg textarea').prop('disabled',false);
    }
    function invoice_settings(){
        <?php
        if($this->session->userdata['purchase_order_per']['invoice_setting']==1){ ?>
            $('#loading').modal('show');
            $('#invoice_div').hide();
            $('#invoice_settings').show('slow');
            $.ajax({                                      
                url: "<?php echo base_url('purchase_order/get_invoice_settings') ?>",                      
                data: "", 
                dataType: 'json',               
                success: function(data) {
                    data['posnic_order_id']==1?$('#posnic_order_id').attr('checked','checked'):$('#posnic_order_id').removeAttr('checked'); 
                    data['posnic_number']==1?$('#posnic_number').attr('checked','checked'):$('#posnic_number').removeAttr('checked'); 
                    data['posnic_date']==1?$('#posnic_date').attr('checked','checked'):$('#posnic_date').removeAttr('checked');
                    data['posnic_expiry']==1?$('#posnic_expiry').attr('checked','checked'):$('#posnic_expiry').removeAttr('checked');
                    data['posnic_barcode']==1?$('#posnic_barcode').attr('checked','checked'):$('#posnic_barcode').removeAttr('checked');
                    data['posnic_branch_code']==1?$('#posnic_branch_code').attr('checked','checked'):$('#posnic_branch_code').removeAttr('checked');
                    data['posnic_branch_name']==1?$('#posnic_branch_name').attr('checked','checked'):$('#posnic_branch_name').removeAttr('checked');
                    data['posnic_branch_address']==1?$('#posnic_branch_address').attr('checked','checked'):$('#posnic_branch_address').removeAttr('checked');
                    data['posnic_branch_city']==1?$('#posnic_branch_city').attr('checked','checked'):$('#posnic_branch_city').removeAttr('checked');
                    data['posnic_branch_state']==1?$('#posnic_branch_state').attr('checked','checked'):$('#posnic_branch_state').removeAttr('checked');
                    data['posnic_branch_country']==1?$('#posnic_branch_country').attr('checked','checked'):$('#posnic_branch_country').removeAttr('checked');
                    data['posnic_branch_zip']==1?$('#posnic_branch_zip').attr('checked','checked'):$('#posnic_branch_zip').removeAttr('checked');
                    data['posnic_branch_email']==1?$('#posnic_branch_email').attr('checked','checked'):$('#posnic_branch_email').removeAttr('checked');
                    data['posnic_branch_phone']==1?$('#posnic_branch_phone').attr('checked','checked'):$('#posnic_branch_phone').removeAttr('checked');
                    data['posnic_supplier_name']==1?$('#posnic_supplier_name').attr('checked','checked'):$('#posnic_supplier_name').removeAttr('checked');
                    data['posnic_supplier_company']==1?$('#posnic_supplier_company').attr('checked','checked'):$('#posnic_supplier_company').removeAttr('checked');
                    data['posnic_supplier_address']==1?$('#posnic_supplier_address').attr('checked','checked'):$('#posnic_supplier_address').removeAttr('checked');
                    data['posnic_supplier_city']==1?$('#posnic_supplier_city').attr('checked','checked'):$('#posnic_supplier_city').removeAttr('checked');
                    data['posnic_supplier_state']==1?$('#posnic_supplier_state').attr('checked','checked'):$('#posnic_supplier_state').removeAttr('checked');
                    data['posnic_supplier_country']==1?$('#posnic_supplier_country').attr('checked','checked'):$('#posnic_supplier_country').removeAttr('checked');
                    data['posnic_supplier_zip']==1?$('#posnic_supplier_zip').attr('checked','checked'):$('#posnic_supplier_zip').removeAttr('checked');
                    data['posnic_supplier_email']==1?$('#posnic_supplier_email').attr('checked','checked'):$('#posnic_supplier_email').removeAttr('checked');
                    data['posnic_supplier_phone']==1?$('#posnic_supplier_phone').attr('checked','checked'):$('#posnic_supplier_phone').removeAttr('checked');
                    data['posnic_item_name']==1?$('#posnic_item_name').attr('checked','checked'):$('#posnic_item_name').removeAttr('checked');
                    data['posnic_item_sku']==1?$('#posnic_item_sku').attr('checked','checked'):$('#posnic_item_sku').removeAttr('checked');
                    data['posnic_item_price']==1?$('#posnic_item_price').attr('checked','checked'):$('#posnic_item_price').removeAttr('checked');
                    data['posnic_item_selling_price']==1?$('#posnic_item_selling_price').attr('checked','checked'):$('#posnic_item_selling_price').removeAttr('checked');
                    data['posnic_item_mrp']==1?$('#posnic_item_mrp').attr('checked','checked'):$('#posnic_item_mrp').removeAttr('checked');
                    data['posnic_item_tax1']==1?$('#posnic_item_tax1').attr('checked','checked'):$('#posnic_item_tax1').removeAttr('checked');
                    data['posnic_item_tax2']==1?$('#posnic_item_tax2').attr('checked','checked'):$('#posnic_item_tax2').removeAttr('checked');
                    data['posnic_item_quantity']==1?$('#posnic_item_quantity').attr('checked','checked'):$('#posnic_item_quantity').removeAttr('checked');
                    data['posnic_item_free_quantity']==1?$('#posnic_item_free_quantity').attr('checked','checked'):$('#posnic_item_free_quantity').removeAttr('checked');
                    data['posnic_item_discount1']==1?$('#posnic_item_discount1').attr('checked','checked'):$('#posnic_item_discount1').removeAttr('checked');
                    data['posnic_item_discount2']==1?$('#posnic_item_discount2').attr('checked','checked'):$('#posnic_item_discount2').removeAttr('checked');
                    data['posnic_item_subtotal']==1?$('#posnic_item_subtotal').attr('checked','checked'):$('#posnic_item_subtotal').removeAttr('checked');
                    data['posnic_purchase_order_subtotal']==1?$('#posnic_purchase_order_subtotal').attr('checked','checked'):$('#posnic_purchase_order_subtotal').removeAttr('checked');
                    data['posnic_inclusive_total_tax']==1?$('#posnic_inclusive_total_tax').attr('checked','checked'):$('#posnic_inclusive_total_tax').removeAttr('checked');
                    data['posnic_exclusive_total_tax']==1?$('#posnic_exclusive_total_tax').attr('checked','checked'):$('#posnic_exclusive_total_tax').removeAttr('checked');
                    data['posnic_total_item_discount']==1?$('#posnic_total_item_discount').attr('checked','checked'):$('#posnic_total_item_discount').removeAttr('checked');
                    data['posnic_discount']==1?$('#posnic_discount').attr('checked','checked'):$('#posnic_discount').removeAttr('checked');
                    data['posnic_frieght']==1?$('#posnic_frieght').attr('checked','checked'):$('#posnic_frieght').removeAttr('checked');
                    data['posnic_round_off_amount']==1?$('#posnic_round_off_amount').attr('checked','checked'):$('#posnic_round_off_amount').removeAttr('checked');
                    data['posnic_grand_total']==1?$('#posnic_grand_total').attr('checked','checked'):$('#posnic_grand_total').removeAttr('checked');
                    data['posnic_supplier_mail']==1?$('#posnic_supplier_mail').attr('checked','checked'):$('#posnic_supplier_mail').removeAttr('checked');
                    $('#posnic_message').val(data['posnic_message']);
                      $('#loading').modal('hide');
                }
                
            });
            <?php 
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('you_have_no_permission_to_update')." ".$this->lang->line('invoice_settings'); ?>', { type: "error" });                       
            <?php
        }?>
    }
    function save_invoice_settings(){
        <?php
        if($this->session->userdata['purchase_order_per']['invoice_setting']==1){ ?>
              $('#loading').modal('show');
                    var inputs = $('#settings_form').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/purchase_order/save_invoice_settings')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('invoice_settings').' '.$this->lang->line('saved');?>', { type: "success" });                                                                                  
                               
                                $('#invoice_settings').hide();
                               
                                $('#invoice_div').show('slow');
                                purchase_order_invoice($('#purchase_order_guid').val());
                                $('#loading').hide();
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('you_have_no_permission_to_update')." ".$this->lang->line('invoice_settings'); ?>', { type: "error" });          
                            }
                        }
                    });
                <?php 
            
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
        <?php
        }?>
    }
    $(function() {
        posnic_invoice.init();
    })
	
    posnic_invoice = {
            init: function() {
                    if($('#invoice_posnic_qrcode').length) {
                            var qr_base_size = '60',
                                    qr_text = 'posnic ',
                                    qr_size = isRetina() ? qr_base_size*2 : qr_base_size;

                            $('#invoice_posnic_qrcode').qrcode({
                                    render: 'image',
                                    size: qr_size,
                                    text: qr_text
                            }).children('img').prop('title',qr_text).css({'width':qr_base_size,'height':qr_base_size});
                    }
                    if($('#invoice_print').length) {
                            $('#invoice_print').click(function(e) {
//                                    e.preventDefault();
//                                    $('body').addClass('printable');
//                                    setTimeout(function() {
//                                           window.print();
//                                    },1000)
                                    	
                                        
                                // });
                                     var divContents = $("#invoice_content").html();
                                var printWindow = window.open('', '', 'height=auto,width=auto');
                                printWindow.document.write('<html><head><title>POSNIC</title>');
                                printWindow.document.write('<link rel="stylesheet" href="<?php echo base_url() ?>template/app/bootstrap/css/bootstrap.min.css">');
                                printWindow.document.write('<link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">');
                                printWindow.document.write('<link  rel="stylesheet" href="<?php echo base_url() ?>template/print/core.css">');
                                printWindow.document.write('</head><body >');
                                printWindow.document.write(divContents);
                                printWindow.document.write('</body></html>');
                                printWindow.document.close();
                                printWindow.print();
                                printWindow.close();
                            })
                    }
            }
    }
</script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


            
              


  