<script type="text/javascript" charset="utf-8" language="javascript" src="http://ivaynberg.github.io/select2/select2-master/select2.js"></script>

<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
                  //  $('#parru').wrap('<div class="make-switch" />').parent().bootstrapSwitch();
                       //  $('#posnic_number').bootstrapSwitch('status');
                        
                  $('#toggle-state-switch-button-on').on('click', function () {
            $('#parru').bootstrapSwitch('setState', true);
            alert('jibi')
        });
        
   

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
    function purchase_order_invoice(){
        $("#user_list").hide();
        $('#add_new_order').hide();
        $('#delete').attr("disabled", "disabled");
        $('#posnic_add_purchase_order').attr("disabled", "disabled");
        $('#active').attr("disabled", "disabled");
        $('#deactive').attr("disabled", "disabled");
        $('#purchase_order_lists').removeAttr("disabled");
        $('#invoice_div').show();
    }
    function invoice_disable(){
        $('#first_name').select2('disable');
        $('#sacn_items').hide();
        $('#invoice_div').hide();
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
                success: function(data)        
                { 
                    
              $('#posnic_number').bootstrapSwitch('status'); // true || false

                          //  $('#posnic_order_id < div').addClass('switch-off');
                         //   $('#posnic_number').attr('checked','checked');
                   
                        if(data['posnic_order_id']==1){
                        }
//                        $('#posnic_order_id').val(), 
//                        $('#posnic_number').val(), 
//                        $('#posnic_date').val(),
//                        $('#posnic_expiry').val(),
//                        $('#posnic_barcode').val(),
//                        $('#posnic_branch_name').val(),
//                        $('#posnic_branch_address').val(),
//                        $('#posnic_branch_city').val(),
//                        $('#posnic_branch_state').val(),
//                        $('#posnic_branch_country').val(),
//                        $('#posnic_branch_pin').val(),
//                        $('#posnic_posnic_branch_email').val(),
//                        $('#posnic_branch_phone').val(),
//                        $('#posnic_supplier_name').val(),
//                        $('#posnic_supplier_company').val(),
//                        $('#posnic_supplier_address').val(),
//                        $('#posnic_supplier_city').val(),
//                        $('#posnic_supplier_state').val(),
//                        $('#posnic_supplier_country').val(),
//                        $('#posnic_supplier_pin').val(),
//                        $('#posnic_supplier_email').val(),
//                        $('#posnic_supplier_phone').val(),
//                        $('#posnic_item_name').val(),
//                        $('#posnic_item_sku').val(),
//                        $('#posnic_item_price').val(),
//                        $('#posnic_item_tax1').val(),
//                        $('#posnic_item_tax2').val(),
//                        $('#posnic_item_discount1').val(),
//                        $('#posnic_item_discount2').val(),
//                        $('#posnic_item_subtotal').val(),
//                        $('#posnic_purchase_order_subtotal').val(),
//                        $('#posnic_inclusive_total_tax').val(),
//                        $('#posnic_exclusive_total_tax').val(),
//                        $('#posnic_total_item_discount').val(),
//                        $('#posnic_discount').val(),
//                        $('#posnic_frieght').val(),
//                        $('#posnic_round_off_amount').val(),
//                        $('#posnic_grand_total').val(),
//                        $('#posnic_supplier_mail').val(),
//                        $('#posnic_message').val(),
                    
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
            
                    var inputs = $('#settings_form').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/purchase_order/save_invoice_settings')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('invoice_setting').' '.$this->lang->line('saved');?>', { type: "success" });                                                                                  
                              
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
                    if($('#invoice_qrcode').length) {
                            var qr_base_size = '60',
                                    qr_text = 'posnic ',
                                    qr_size = isRetina() ? qr_base_size*2 : qr_base_size;

                            $('#invoice_qrcode').qrcode({
                                    render: 'image',
                                    size: qr_size,
                                    text: qr_text
                            }).children('img').prop('title',qr_text).css({'width':qr_base_size,'height':qr_base_size});
                    }
                    if($('#invoice_print').length) {
                            $('#invoice_print').click(function(e) {
                                    e.preventDefault();
                                    $('body').addClass('printable');
                                    setTimeout(function() {
                                            window.print()
                                    },1000)
                            })
                    }
            }
    }
</script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


            
              


  