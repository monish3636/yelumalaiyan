
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('direct_sales') ?>');
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
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('direct_sales') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/direct_sales/data_table",
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
                                                                    if(oObj.aData[10]==1){
                                                                        return '<a  ><span data-toggle="tooltip" class="label label-default hint--top hint--default" ><i class="icon-list"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
                                                                    }else{
                                                                         	 return '<a href=javascript:direct_sales_bill("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('sales_bill') ?>"><i class="icon-list"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
                                                                    }
								}else{
                                                                        return '<a href=javascript:direct_sales_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
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
    <?php if($this->session->userdata['direct_sales_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('items') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/direct_sales/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                 complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_sales') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_sales');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('direct_sales');?>', { type: "error" });                       
   <?php }
?>
                        }
           
          
        
function direct_sales_approve(guid){
        <?php if($this->session->userdata['direct_sales_per']['approve']==1){ ?>
            $.ajax({
                url: '<?php echo base_url() ?>index.php/direct_sales/direct_sales_approve',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('direct_sales') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_sales');?>', { type: "error" });                              
                    }
                    }
            });
            <?php }else{?>
                        $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('direct_sales');?>', { type: "error" });                       
                <?php }
             ?>
}
          
           function edit_function(guid){
                 $('#sales_items_list').show();
                 $('#sales_buttons').show();
                 $('#address_div').show();
                 $('#sales_bill_buttons').hide();
                 $('#sales_bill_number_div').hide();
                 $('#round_off_amount').removeAttr("disabled");
                 $('#order_date').removeAttr("disabled");
                 $('#id_discount').removeAttr("disabled");
                 $('#freight').removeAttr("disabled");
                 $('#discount_amount').removeAttr("disabled");
        
                        <?php if($this->session->userdata['direct_sales_per']['edit']==1){ ?>
                                
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
                             url: "<?php echo base_url() ?>index.php/direct_sales/get_direct_sales/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $("#sales_bill_date_div").hide();
                                $('#add_new_order').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_direct_sales').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#direct_sales_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                                $("#parsley_reg #demo_customer_discount").val(data[0]['customer_discount']);
                                $("#parsley_reg #customer_discount").val(data[0]['customer_discount']);
                                $("#parsley_reg #demo_customer_discount_amount").val(data[0]['customer_discount_amount']);
                                $("#parsley_reg #customer_discount_amount").val(data[0]['customer_discount_amount']);
                                $("#parsley_reg #first_name").select2('data', {id:'1',text: data[0]['s_name']});
                                  $("#parsley_reg #first_name").select2('disable');
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #direct_sales_guid").val(guid);
                                $("#parsley_reg #demo_order_number").val(data[0]['code']);
                                $("#parsley_reg #order_number").val(data[0]['code']);
                                $("#parsley_reg #order_date").val(data[0]['date']);
                               
                                
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
                                  
                                $("#parsley_reg #customers_guid").val(data[0]['c_guid']);
                                var tax;
                                for(i=0;i<data.length;i++){
                                      if(!$('#'+data[i]['i_guid']).length){
                                  var  name=data[i]['items_name'];
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
                            var  quty=data[i]['quty'];
                            var  tax_type=data[i]['tax_type_name'];
                            var  tax_value=data[i]['tax_value'];
                            var  tax_inclusive=data[i]['tax_Inclusive'];
                            var  tax_type2=data[i]['tax2_type'];
                            var  tax_value2=data[i]['tax2_value'];
                            var  tax_inclusive2=data[i]['tax_inclusive2'];
                            var  price=data[i]['price'];
                            if(data[i]['kit_code']){
                                tax_type=data[i]['kit_tax_type'];
                                tax_value=data[i]['kit_tax_value'];
                                tax_inclusive=data[i]['kit_tax_Inclusive'];
                                tax_type2=0;
                                tax_value2=0;
                                tax_inclusive2=0;
                                price=data[i]['kit_price'];
                                items_id=data[i]['kit_guid'];
                            }else  if(data[i]['deco_code']){
                                price=data[i]['price'];
                                items_id=data[i]['deco_guid'];
                            }
                            else{
                                var  items_id=data[i]['i_guid'];
                                var uom=data[i]['uom']                                    
                                if(uom==1){
                                    var no_of_unit=data[i]['no_of_unit'];
                                    price=price/no_of_unit;
                                }
                            }               
                            var subtotal=parseFloat(quty)*parseFloat(price);
                            var total=subtotal;
                            var discount_per=data[i]['item_discount'];
                            var type;
                            var tax1=0;
                            var tax2=0;
                            var type1='Inc';
                            var type2='Inc';
                            var total_tax=0;
                            tax1=parseFloat(subtotal)*parseFloat(tax_value)/100;
                            if(tax_inclusive==0 && tax_value!=""){
                                type1='Exc';
                                total=parseFloat(total)+parseFloat(tax1);
                                total_tax=parseFloat(total_tax)+parseFloat(tax1);
                            }
                            tax2=parseFloat(subtotal)*parseFloat(tax_value2)/100; 
                            if(tax_inclusive2==0 && tax_value2!=""){
                                total=parseFloat(total)+parseFloat(tax2);
                                total_tax=parseFloat(total_tax)+parseFloat(tax2);
                                type2='Exc';
                            }
                            if(isNaN(parseFloat(discount_per))){
                                discount_per=0;
                            }
                            var discount=parseFloat(total)*parseFloat(discount_per)/100;
                            var num = parseFloat(tax1);
                            tax1=num.toFixed(point);
                            var num = parseFloat(tax2);
                            tax2=num.toFixed(point);
                            var num = parseFloat(total-discount);
                            total=num.toFixed(point);
                            var num = parseFloat(discount);
                            discount=num.toFixed(point);
                            if(isNaN(tax1)){
                                tax1=0;
                            }
                            if(isNaN(tax2)){
                                tax2=0;
                            } 
                            var tax_text2=0;
                            var tax_text1=0;
                            if(tax2!=0){
                                tax_text2=tax2+':'+tax_type2+'('+type2+')';
                            }
                            if(tax1!=0){
                                tax_text1=tax1+':'+tax_type+'('+type1+')';
                            }
                            if(total_tax!=0){
                                if($('#parsley_reg #total_tax').val()==0){
                                    $('#parsley_reg #total_tax').val(total_tax);
                                }else{
                                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(total_tax));
                                }
                            }
                            if($('#parsley_reg #total_item_discount_amount').val()==0){
                                $('#parsley_reg #total_item_discount_amount').val(discount);
                            }else{
                                $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
                            }
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            price,
                            tax_text1,
                            tax_text2,
                            discount,
                            total,
                            '<input type="hidden" name="index[]" id="index">\n\
                            <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                            <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                            <input type="hidden" name="sq_items[]" id="sq_items" value="'+data[i]['o_i_guid']+'">\n\
                            <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                            <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                            <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                            <input type="hidden" name="items_tax[]" value="'+tax1+'" id="items_tax">\n\
                            <input type="hidden" name="items_tax2[]" value="'+tax2+'" id="items_tax">\n\
                            <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                            <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                            <input type="hidden" name="items_tax_inclusive[]" value="'+tax_inclusive+'" id="items_tax_inclusive">\n\
                            <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                            <input type="hidden" name="items_tax_value2[]" value="'+tax_value2+'" id="items_tax_value2">\n\
                            <input type="hidden" name="items_tax_type2[]" value="'+tax_type2+'" id="items_tax_type2">\n\
                            <input type="hidden" name="items_tax_inclusive2[]" value="'+tax_inclusive2+'" id="items_tax_inclusive2">\n\
                            <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                            <input type="hidden" name="items_discount_per[]" value="'+discount_per+'" id="items_discount_per">\n\
                            <input type="hidden" name="items_stock[]" value="'+data[i]['stock_id']+'" id="items_stock">\n\
                            <input type="hidden" name="items_order_guid[]" value="'+data[i]['o_i_guid']+'" id="items_order_guid">\n\
                            <input type="hidden" name="items_sub_total[]"  value="'+parseFloat(quty)*parseFloat(price)+'" id="items_sub_total">\n\
                            <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                            <a href=javascript:edit_order_item("'+data[i]['stock_id']+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+data[i]['stock_id']+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );
                            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                            theNode.setAttribute('id','new_item_row_id_'+data[i]['stock_id'])
                                }
                                }
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('direct_sales');?>', { type: "error" });                       
                        <?php }?>
                       }
           function direct_sales_bill(guid){
           
        $('#sales_items_list').hide();
        $('#sales_buttons').hide();
        $('#address_div').hide();
        $('#sales_bill_buttons').show();
        $('#sales_bill_number_div').show();
        $("#sales_bill_date_div").show();
        $('#round_off_amount').attr("disabled", "disabled");
        $('#order_date').attr("disabled", "disabled");
        $('#id_discount').attr("disabled", "disabled");
        $('#freight').attr("disabled", "disabled");
        $('#discount_amount').attr("disabled", "disabled");
              
                        <?php if($this->session->userdata['direct_sales_per']['edit']==1){ ?>
                                
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
                             url: "<?php echo base_url() ?>index.php/direct_sales/get_direct_sales_for_bill/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_order').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_direct_sales').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#direct_sales_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                                $("#parsley_reg #demo_customer_discount").val(data[0]['customer_discount']);
                                $("#parsley_reg #customer_discount").val(data[0]['customer_discount']);
                                $("#parsley_reg #demo_customer_discount_amount").val(data[0]['customer_discount_amount']);
                                $("#parsley_reg #customer_discount_amount").val(data[0]['customer_discount_amount']);
                                $("#parsley_reg #first_name").select2('data', {id:'1',text: data[0]['s_name']});
                                  $("#parsley_reg #first_name").select2('disable');
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #demo_sales_bill_number").val(data[data.length-1]);
                                $("#parsley_reg #direct_sales_bill_number").val(data[data.length-1]);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #direct_sales_guid").val(guid);
                                $("#parsley_reg #demo_order_number").val(data[0]['code']);
                                $("#parsley_reg #order_number").val(data[0]['code']);
                                $("#parsley_reg #order_date").val(data[0]['date']);
                               
                                
                                $("#parsley_reg #id_discount").val(data[0]['discount']);
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
                                  
                                $("#parsley_reg #customers_guid").val(data[0]['c_guid']);
                                var tax;
                                for(i=0;i<data.length-1;i++){
                                  if(!$('#'+data[i]['i_guid']).length){
                                            var  name=data[i]['items_name'];
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
                            var  quty=data[i]['quty'];
                            var  tax_type=data[i]['tax_type_name'];
                            var  tax_value=data[i]['tax_value'];
                            var  tax_inclusive=data[i]['tax_Inclusive'];
                            var  tax_type2=data[i]['tax2_type'];
                            var  tax_value2=data[i]['tax2_value'];
                            var  tax_inclusive2=data[i]['tax_inclusive2'];
                            var  price=data[i]['price'];
                            if(data[i]['kit_code']){
                                tax_type=data[i]['kit_tax_type'];
                                tax_value=data[i]['kit_tax_value'];
                                tax_inclusive=data[i]['kit_tax_Inclusive'];
                                tax_type2=0;
                                tax_value2=0;
                                tax_inclusive2=0;
                                price=data[i]['kit_price'];
                                items_id=data[i]['kit_guid'];
                            }else  if(data[i]['deco_code']){
                                price=data[i]['price'];
                                items_id=data[i]['deco_guid'];
                            }
                            else{
                                var  items_id=data[i]['i_guid'];
                                var uom=data[i]['uom']                                    
                                if(uom==1){
                                    var no_of_unit=data[i]['no_of_unit'];
                                    price=price/no_of_unit;
                                }
                            }               
                            var subtotal=parseFloat(quty)*parseFloat(price);
                            var total=subtotal;
                            var discount_per=data[i]['item_discount'];
                            var type;
                            var tax1=0;
                            var tax2=0;
                            var type1='Inc';
                            var type2='Inc';
                            var total_tax=0;
                            tax1=parseFloat(subtotal)*parseFloat(tax_value)/100;
                            if(tax_inclusive==0 && tax_value!=""){
                                type1='Exc';
                                total=parseFloat(total)+parseFloat(tax1);
                                total_tax=parseFloat(total_tax)+parseFloat(tax1);
                            }
                            tax2=parseFloat(subtotal)*parseFloat(tax_value2)/100; 
                            if(tax_inclusive2==0 && tax_value2!=""){
                                total=parseFloat(total)+parseFloat(tax2);
                                total_tax=parseFloat(total_tax)+parseFloat(tax2);
                                type2='Exc';
                            }
                            if(isNaN(parseFloat(discount_per))){
                                discount_per=0;
                            }
                            var discount=parseFloat(total)*parseFloat(discount_per)/100;
                            var num = parseFloat(tax1);
                            tax1=num.toFixed(point);
                            var num = parseFloat(tax2);
                            tax2=num.toFixed(point);
                            var num = parseFloat(total-discount);
                            total=num.toFixed(point);
                            var num = parseFloat(discount);
                            discount=num.toFixed(point);
                            if(isNaN(tax1)){
                                tax1=0;
                            }
                            if(isNaN(tax2)){
                                tax2=0;
                            } 
                            var tax_text2=0;
                            var tax_text1=0;
                            if(tax2!=0){
                                tax_text2=tax2+':'+tax_type2+'('+type2+')';
                            }
                            if(tax1!=0){
                                tax_text1=tax1+':'+tax_type+'('+type1+')';
                            }
                            if(total_tax!=0){
                                if($('#parsley_reg #total_tax').val()==0){
                                    $('#parsley_reg #total_tax').val(total_tax);
                                }else{
                                    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(total_tax));
                                }
                            }
                            if($('#parsley_reg #total_item_discount_amount').val()==0){
                                $('#parsley_reg #total_item_discount_amount').val(discount);
                            }else{
                                $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
                            }
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            price,
                            tax_text1,
                            tax_text2,
                            discount,
                            total,
                            "<i class='icon-edit'></i></span><i class='icon-trash'></i>" ] );
                            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                            theNode.setAttribute('id','new_item_row_id_'+data[i]['stock_id'])
                                }
                                }
                             } 
                           });
                      $("#selected_item_table tbody tr:first").nextAll().hide();
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('direct_sales');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  