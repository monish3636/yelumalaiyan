
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('sales_delivery_note') ?>');
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
                        "paging":   false,
        "ordering": false,
        "info":     false,
				    
                    "sPaginationType": "bootstrap_full",
                    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
                $("#index", nRow).val(iDisplayIndex +1);
               return nRow;
            },
                });
            }
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('sales_order')." ".$this->lang->line('for')." ".$this->lang->line('sales_delivery_note') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/sales_delivery_note/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    if(oObj.aData[10]==1){
                                                                        return "<input type=checkbox disabled='disabled' value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                         }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='order__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='sales_order__number_"+oObj.aData[0]+"' value='"+oObj.aData[11]+"'>";
                                                                    }
                                                                },
								
								
							},
        
        null, null, null, null, {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							//if(oObj.aData[8]==0)
                                                                      return   oObj.aData[6];
								},
								
								
							}

, null,  null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[10]==1){
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
                                                                if(oObj.aData[10]==1){
                                                                        //return '<a ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approved') ?>"><i class="icon-play"></i></span></a>&nbsp<a   ><span data-toggle="tooltip" class="label label-info hint--top hint--success" data-hint="<?php echo $this->lang->line('approved') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a  ><span data-toggle='tooltip' class='label label-danger hint--top hint--success' data-hint='<?php echo $this->lang->line('approved') ?>'><i class='icon-trash'></i></span> </a>";
                                                                       return '<a href=javascript:sales_delivery_note_invoice("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('print') ?>"><i class="glyphicon glyphicon-print"></i></span></a>&nbsp<a href=javascript:sales_delivery_note_view("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
								}else{
                                                                        return '<a href=javascript:sales_delivery_note_invoice("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('print') ?>"><i class="glyphicon glyphicon-print"></i></span></a>&nbsp<a href=javascript:sales_delivery_note_view("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a href=javascript:sdn_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
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
    <?php if($this->session->userdata['sales_delivery_note_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('sales_delivery_note') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/sales_delivery_note/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
               complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('sales_delivery_note') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
   <?php }
?>
                        }
        function sdn_approve(guid){
            var po=$('#sales_order__number_'+guid).val();
            <?php if($this->session->userdata['sales_delivery_note_per']['approve']==1){ ?>
                $.ajax({
                url: '<?php echo base_url() ?>index.php/sales_delivery_note/sdn_approve',
                type: "POST",
                data: {
                    guid: guid,
                    so:po
                    
                },
                  complete: function(response) {
                     if(response['responseText']=='TRUE'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='approve'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is')." ".$this->lang->line('already')." ".$this->lang->line('approved');?>', { type: "warning" });
                    }else if(response['responseText']=='Noop'){
                           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
                    }
                }
            });
             <?php }else{?>
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
                <?php }?>
               }
        
          
        
       
    function edit_function(guid){
        <?php
        if($this->session->userdata['sales_delivery_note_per']['edit']==1){ ?>                                
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
                url: "<?php echo base_url() ?>index.php/sales_delivery_note/get_sales_delivery_note/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#add_new_order').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_sales_delivery_note').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#sales_delivery_note_lists').removeAttr("disabled");
                    $("#parsley_reg #first_name").val(data[0]['s_name']);
                    $("#parsley_reg #company").val(data[0]['c_name']);
                    $("#parsley_reg #address").val(data[0]['address']);
                    $("#parsley_reg #guid").val(guid);
                    $("#parsley_reg #sales_delivery_note_guid").val(data[0]['guid']);
                    $("#demo_order_number").select2('disable');
                    $("#parsley_reg #demo_order_number").select2('data', {id:'1',text: data[0]['code']});
                    $("#parsley_reg #demo_dn_no").val(data[0]['sales_delivery_note_no']);
                    $("#parsley_reg #delivery_date").val(data[0]['sales_delivery_note_date']);
                    $("#parsley_reg #note").val(data[0]['grn_note']);
                    $("#parsley_reg #remark").val(data[0]['grn_remark']);
                    $("#parsley_reg #demo_customer_discount").val(data[0]['sdn_customer_discount']);
                    $("#parsley_reg #customer_discount").val(data[0]['sdn_customer_discount']);
                    $("#parsley_reg #demo_customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                    $("#parsley_reg #customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                    
                    $("#edit_grn_node").val(data[0]['po_no']);                                
                    $("#parsley_reg #id_discount").val(data[0]['discount']);                              
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #freight").val(data[0]['freight']);
                    $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                    $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                    $("#parsley_reg #grn_guid").val(guid);
                    var tax;
                    var receive=0;
                    var total_tax=0;
                    var total_discount=0;
                    var total_amount=0;
                    for(i=0;i<data.length;i++){                               
                        receive=1;
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
                        var  quty=parseFloat(data[i]['delivered_quty']);
                        var  ordered_quty=parseFloat(data[i]['quty']);
                        var  tax_type=data[i]['tax_type_name'];
                        var  tax_value=data[i]['tax_value'];
                        var  tax_inclusive=data[i]['tax_Inclusive'];                                  
                        var  tax_type2=data[i]['tax2_type'];
                        var  tax_value2=data[i]['tax2_value'];
                        var  tax_inclusive2=data[i]['tax_inclusive2'];                                  
                        var  received_quty=data[i]['delivered_quty'];
                        var  price=data[i]['price'];
                        if(data[i]['kit_code']){
                            tax_type=data[i]['kit_tax_type'];
                            tax_value=data[i]['kit_tax_value'];
                            tax_inclusive=data[i]['kit_tax_Inclusive'];  
                            tax_type2=0;
                            tax_value2=0;
                            tax_inclusive2=0;                                          
                        }                                   
                        var uom=data[i]['uom']                                    
                        if(uom==1){
                            var no_of_unit=data[i]['no_of_unit'];
                            price=price/no_of_unit;
                        }                                    

                        var  items_id=data[i]['item'];
                        var discount=0;
                        var item_discount=0;
                        var discount_per=0
                        if(data[i]['dis_per']!=""){
                             discount_per=data[i]['dis_per'];                                         
                        }
                        var subtotal=parseFloat(quty)*parseFloat(price);
                        var total=parseFloat(quty)*parseFloat(price);
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

                                //total_discount=parseFloat(total_discount)+parseFloat(discount);

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
                        };
                        var item_total_tax=0;
                        if(total_tax!=0){
                            item_total_tax=total_tax;
                        }

                        total_amount=parseFloat(total_amount)+parseFloat(total);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            price,                                 
                            tax_text1,
                            tax_text2,
                            discount,
                           "<input type='hidden' id='item_total_tax_"+i+"' value='"+item_total_tax+"'>\n\
                            <input type='hidden' id='item_discount_"+i+"' value='"+discount+"'> \n\
                            <input type='hidden' id='item_total_"+i+"' value='"+total+"'>\n\
                            <input type='hidden' id='item_quty_"+i+"' value='"+ordered_quty+"'>\n\
                            <input type='hidden' id='tax_inclusive_"+i+"' value='"+tax_inclusive+"' >\n\
                            <input type='hidden' id='tax_type_"+i+"' value='"+tax_type+"' >\n\
                            <input type='hidden' id='tax_value_"+i+"' value='"+tax_value+"' >\n\
                            <input type='hidden' id='tax_type2_"+i+"' value='"+tax_type2+"' >\n\
                            <input type='hidden' id='tax_inclusive2_"+i+"' value='"+tax_inclusive2+"' >\n\
                            <input type='hidden' id='tax_value2_"+i+"' value='"+tax_value2+"' >\n\
                            <input type='hidden' id='discount_per_"+i+"' value='"+discount_per+"' >\n\
                            <input type='hidden' name='items[]' value='"+items_id+"' >\n\
                            <input type='hidden' id='item_price_"+i+"' value='"+price+"' >\n\
                            <input type='text' id='delivered_item_quty"+i+"' value='"+quty+"' name='delivered_quty[]' onkeyup='delivered_quty_items("+i+")' onKeyPress='delivered_quty(event,"+i+");return numbersonly(event)' class='form-control' style='width:100px'>",
                            total
                        ] );
                        if(total_tax!=0){
                            var total_items_tax=$('#total_tax').val();
                            if(total_items_tax==""){
                                total_items_tax=0
                            }
                            $('#total_tax').val(parseFloat(total_items_tax)+parseFloat(total_tax));
                        }
                        if($('#total_item_discount_amount').val()=="" && $('#total_item_discount_amount').val()==0){
                            $('#total_item_discount_amount').val(discount);
                        }else{
                            $('#total_item_discount_amount').val(parseFloat($('#total_item_discount_amount').val())+parseFloat(discount));
                        }
                        if(data[0]['discount']==0){
                            var so_discount=0;
                            $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                            so_discount=data[0]['discount_amt'];
                        }else{
                            var so_discount=parseFloat(total_amount)*parseFloat(data[0]['discount'])/100;
                            $("#parsley_reg #discount_amount").val(so_discount);
                            $("#parsley_reg #id_discount").val(data[0]['discount']);
                        }
                        var freight=data[0]['freight']
                        if(isNaN(freight) || freight==""){freight=0;}
                        var round_amt=data[0]['round_amt']
                        if(isNaN(round_amt) || round_amt==""){round_amt=0;}
                        var grand=parseFloat(total_amount)-parseFloat(so_discount)+parseFloat(freight)+parseFloat(round_amt);
                        var num = parseFloat(total_amount);
                        total_amount=num.toFixed(point);
                        $('#demo_total_amount').val(total_amount);
                        $('#total_amount').val(total_amount);
                        $('#grand_total').val(grand-data[0]['customer_discount_amount']);
                        $('#demo_grand_total').val(grand-data[0]['customer_discount_amount']);
                        var num = parseFloat($('#grand_total').val());
                        $('#grand_total').val(num.toFixed(point));
                        $('#demo_grand_total').val(num.toFixed(point));
                        var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                        theNode.setAttribute('id','new_item_row_id_'+i)

                    }    
                    $("#parsley_reg #id_discount").val(data[0]['discount']);
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #note").val(data[0]['sales_delivery_note_note']);
                    $("#parsley_reg #remark").val(data[0]['sales_delivery_note_remark']);
                } 
            });
            window.setTimeout(function ()
            {
                document.getElementById('delivery_date').focus();
                $('#loading').modal('hide');
            }, 0); 
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
            <?php
        }?>
    }
    function sales_delivery_note_view(guid){
        <?php
        if($this->session->userdata['sales_delivery_note_per']['view']==1){ ?>                                
            $('#deleted').remove();
            $('#parent_items').append('<div id="deleted"></div>');
            $('#newly_added').remove();
            $('#parent_items').append('<div id="newly_added"></div>');
            refresh_items_table();
            $('#update_button').hide();
           
            $('#save_button').hide();
            $('#update_clear').hide();
            $('#save_clear').hide();
            $('#loading').modal('show');
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/sales_delivery_note/view_sales_delivery_note/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#add_new_order').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_sales_delivery_note').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#sales_delivery_note_lists').removeAttr("disabled");
                    $("#parsley_reg #first_name").val(data[0]['s_name']);
                    $("#parsley_reg #company").val(data[0]['c_name']);
                    $("#parsley_reg #address").val(data[0]['address']);
                    $("#parsley_reg #guid").val(guid);
                    $("#parsley_reg #sales_delivery_note_guid").val(data[0]['guid']);
                    $("#parsley_reg #edit_dn_node").val(data[0]['code']);
                    $("#parsley_reg #demo_dn_no").val(data[0]['sales_delivery_note_no']);
                    $("#parsley_reg #delivery_date").val(data[0]['sales_delivery_note_date']);
                    $("#parsley_reg #note").val(data[0]['grn_note']);
                    $("#parsley_reg #remark").val(data[0]['grn_remark']);
                    $("#parsley_reg #demo_customer_discount").val(data[0]['sdn_customer_discount']);
                    $("#parsley_reg #customer_discount").val(data[0]['sdn_customer_discount']);
                    $("#parsley_reg #demo_customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                    $("#parsley_reg #customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                    $("#demo_order_number").select2('disable');
                    $("#parsley_reg #demo_order_number").select2('data', {id:'1',text: data[0]['code']});
                    //$(".porchase_order_for_grn").show();
                    $("#edit_grn_node").val(data[0]['po_no']);                                
                    $("#parsley_reg #id_discount").val(data[0]['discount']);                              
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #freight").val(data[0]['freight']);
                    $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                    $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                    $("#parsley_reg #grn_guid").val(guid);
                    var tax;
                    var receive=0;
                    var total_tax=0;
                    var total_discount=0;
                    var total_amount=0;
                    for(i=0;i<data.length;i++){                               
                        receive=1;
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
                        var  quty=parseFloat(data[i]['delivered_quty']);
                        var  ordered_quty=parseFloat(data[i]['quty']);
                        var  tax_type=data[i]['tax_type_name'];
                        var  tax_value=data[i]['tax_value'];
                        var  tax_inclusive=data[i]['tax_Inclusive'];                                  
                        var  tax_type2=data[i]['tax2_type'];
                        var  tax_value2=data[i]['tax2_value'];
                        var  tax_inclusive2=data[i]['tax_inclusive2'];                                  
                        var  received_quty=data[i]['delivered_quty'];
                        var  price=data[i]['price'];
                        if(data[i]['kit_code']){
                            tax_type=data[i]['kit_tax_type'];
                            tax_value=data[i]['kit_tax_value'];
                            tax_inclusive=data[i]['kit_tax_Inclusive'];  
                            tax_type2=0;
                            tax_value2=0;
                            tax_inclusive2=0;                                          
                        }                                   
                        var uom=data[i]['uom']                                    
                        if(uom==1){
                            var no_of_unit=data[i]['no_of_unit'];
                            price=price/no_of_unit;
                        }                                    

                        var  items_id=data[i]['item'];
                        var discount=0;
                        var item_discount=0;
                        var discount_per=0
                        if(data[i]['dis_per']!=""){
                             discount_per=data[i]['dis_per'];                                         
                        }
                        var subtotal=parseFloat(quty)*parseFloat(price);
                        var total=parseFloat(quty)*parseFloat(price);
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

                                //total_discount=parseFloat(total_discount)+parseFloat(discount);

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
                        };
                        var item_total_tax=0;
                        if(total_tax!=0){
                            item_total_tax=total_tax;
                        }

                        total_amount=parseFloat(total_amount)+parseFloat(total);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                            null,
                            name,
                            sku,
                            quty,
                            price,                                 
                            tax_text1,
                            tax_text2,
                            discount,
                           "<input type='hidden' id='item_total_tax_"+i+"' value='"+item_total_tax+"'>\n\
                            <input type='hidden' id='item_discount_"+i+"' value='"+discount+"'> \n\
                            <input type='hidden' id='item_total_"+i+"' value='"+total+"'>\n\
                            <input type='hidden' id='item_quty_"+i+"' value='"+ordered_quty+"'>\n\
                            <input type='hidden' id='tax_inclusive_"+i+"' value='"+tax_inclusive+"' >\n\
                            <input type='hidden' id='tax_type_"+i+"' value='"+tax_type+"' >\n\
                            <input type='hidden' id='tax_value_"+i+"' value='"+tax_value+"' >\n\
                            <input type='hidden' id='tax_type2_"+i+"' value='"+tax_type2+"' >\n\
                            <input type='hidden' id='tax_inclusive2_"+i+"' value='"+tax_inclusive2+"' >\n\
                            <input type='hidden' id='tax_value2_"+i+"' value='"+tax_value2+"' >\n\
                            <input type='hidden' id='discount_per_"+i+"' value='"+discount_per+"' >\n\
                            <input type='hidden' name='items[]' value='"+items_id+"' >\n\
                            <input type='hidden' id='item_price_"+i+"' value='"+price+"' >\n\
                            <input type='text' id='delivered_item_quty"+i+"' value='"+quty+"' name='delivered_quty[]' onkeyup='delivered_quty_items("+i+")' onKeyPress='delivered_quty(event,"+i+");return numbersonly(event)' class='form-control' style='width:100px'>",
                            total
                        ] );
                        if(total_tax!=0){
                            var total_items_tax=$('#total_tax').val();
                            if(total_items_tax==""){
                                total_items_tax=0
                            }
                            $('#total_tax').val(parseFloat(total_items_tax)+parseFloat(total_tax));
                        }
                        if($('#total_item_discount_amount').val()=="" && $('#total_item_discount_amount').val()==0){
                            $('#total_item_discount_amount').val(discount);
                        }else{
                            $('#total_item_discount_amount').val(parseFloat($('#total_item_discount_amount').val())+parseFloat(discount));
                        }
                        if(data[0]['discount']==0){
                            var so_discount=0;
                            $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                            so_discount=data[0]['discount_amt'];
                        }else{
                            var so_discount=parseFloat(total_amount)*parseFloat(data[0]['discount'])/100;
                            $("#parsley_reg #discount_amount").val(so_discount);
                            $("#parsley_reg #id_discount").val(data[0]['discount']);
                        }
                        var freight=data[0]['freight']
                        if(isNaN(freight) || freight==""){freight=0;}
                        var round_amt=data[0]['round_amt']
                        if(isNaN(round_amt) || round_amt==""){round_amt=0;}
                        var grand=parseFloat(total_amount)-parseFloat(so_discount)+parseFloat(freight)+parseFloat(round_amt);
                        var num = parseFloat(total_amount);
                        total_amount=num.toFixed(point);
                        $('#demo_total_amount').val(total_amount);
                        $('#total_amount').val(total_amount);
                        $('#grand_total').val(grand-data[0]['customer_discount_amount']);
                        $('#demo_grand_total').val(grand-data[0]['customer_discount_amount']);
                        var num = parseFloat($('#grand_total').val());
                        $('#grand_total').val(num.toFixed(point));
                        $('#demo_grand_total').val(num.toFixed(point));
                        var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                        theNode.setAttribute('id','new_item_row_id_'+i)

                    }    
                    $("#parsley_reg #id_discount").val(data[0]['discount']);
                    $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                    $("#parsley_reg #note").val(data[0]['sales_delivery_note_note']);
                    $("#parsley_reg #remark").val(data[0]['sales_delivery_note_remark']);
                } 
            });          
            $('#loading').modal('hide');
           
             invoice_disable();
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
            <?php
        }?>
                
    }

    
    function sales_delivery_note_invoice(guid){
        <?php
        if($this->session->userdata['sales_delivery_note_per']['print_invoice']==1){ ?>
            $('#loading').modal('show');
            $("#user_list").hide();
            $('#add_new_order').hide();
            $('#invoice_settings').hide();
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_sales_delivery_note').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#sales_delivery_note_lists').removeAttr("disabled");
            $('#invoice_div').show();
            $('#sales_delivery_note_guid').val(guid);
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/sales_delivery_note/get_invoice_settings_and_sales_delivery_note/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                        if(data[1]['posnic_sales_delivery_note_id']==1){
                            $('#invoice_posnic_sales_delivery_note_id').show();
                            $('#invoice_posnic_sales_delivery_note_id').html(data[0][0]['sales_delivery_note_no'])
                        }else{
                            $('#invoice_posnic_sales_delivery_note_id').hide();
                        }
                        if(data[1]['posnic_sales_delivery_note_number']==1){
                            $('#invoice_posnic_sales_delivery_note_number').show();
                            $('#invoice_posnic_sales_delivery_note_number').html('<?php echo $this->lang->line('dn_no')." ".$this->lang->line('id') ?> <span class="text-muted "> #'+data[0][0]['sales_delivery_note_id']+'</span>')
                        }else{
                            $('#invoice_posnic_sales_delivery_note_number').hide();
                        }
                        if(data[1]['posnic_sales_delivery_note_date']==1){
                            $('#invoice_posnic_sales_delivery_note_date').show();
                              $('#invoice_posnic_sales_delivery_note_date').html('<?php echo $this->lang->line('dn_no')." ".$this->lang->line('date') ?> : <span class="text-muted">'+data[0][0]['sales_delivery_note_date']+'</span>');
                        }else{
                            $('#invoice_posnic_sales_delivery_note_date').hide();
                        }
                        if(data[1]['posnic_order_id']==1){
                            $('#invoice_posnic_id').show();
                            $('#invoice_posnic_id').html(data[0][0]['code'])
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
                              $('#invoice_posnic_date').html('<?php echo $this->lang->line('date') ?> : <span class="text-muted">'+data[0][0]['date']+'</span>');
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
                            $('#invoice_posnic_branch_name').html(data[0][0]['branch_name']);
                        }else{
                            $('#invoice_posnic_branch_name').hide();
                        }
                        if(data[1]['posnic_branch_address']==1){
                            $('#invoice_posnic_branch_address').show();
                            $('#invoice_posnic_branch_address').html(data[0][0]['branch_address']);
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
                        
                        
                        if(data[1]['posnic_customer_name']==1){
                            $('#invoice_posnic_customer_name').show();
                            $('#invoice_posnic_customer_name').html(data[0][0]['s_name']);
                        }else{
                            $('#invoice_posnic_customer_name').hide();
                        }
                        if(data[1]['posnic_customer_company']==1){
                            $('#invoice_posnic_customer_company').show();
                            $('#invoice_posnic_customer_company').html(data[0][0]['c_name']);
                        }else{
                            $('#invoice_posnic_customer_company').hide();
                        }
                        if(data[1]['posnic_customer_address']==1){
                             $('#invoice_posnic_customer_address').show();
                            $('#invoice_posnic_customer_address').html(data[0][0]['address']);
                        }else{
                            $('#invoice_posnic_customer_address').hide();
                        }
                        if(data[1]['posnic_customer_city']==1){
                            $('#invoice_posnic_customer_city').show();
                            $('#invoice_posnic_customer_city').html(data[0][0]['customer_city']);
                        }
                        else{
                            $('#invoice_posnic_customer_city').hide();
                        }
                        if(data[1]['posnic_customer_state']==1){
                             $('#invoice_posnic_customer_state').show();
                              $('#invoice_posnic_customer_state').html(data[0][0]['customer_state']);
                        }else{
                            $('#invoice_posnic_customer_state').hide();
                        }
                        if(data[1]['posnic_customer_zip']==1){
                             $('#invoice_posnic_customer_zip').show();
                              $('#invoice_posnic_customer_zip').html(data[0][0]['customer_zip']);
                        }else{
                            $('#invoice_posnic_customer_zip').hide();
                        }
                        if(data[1]['posnic_customer_country']==1){
                             $('#invoice_posnic_customer_country').show();
                              $('#invoice_posnic_customer_country').html(data[0][0]['customer_country']);
                        }else{
                            $('#invoice_posnic_customer_country').hide();
                        }
                        if(data[1]['posnic_customer_email']==1){
                             $('#invoice_posnic_customer_email').show();
                              $('#invoice_posnic_customer_email').html(data[0][0]['customer_email']);
                        }else{
                            $('#invoice_posnic_customer_email').hide();
                        }
                        
                        if(data[1]['posnic_customer_phone']==1){
                            $('#invoice_posnic_customer_phone').show();
                            $('#invoice_posnic_customer_phone').html(data[0][0]['customer_phone']);
                        }else{
                            $('#invoice_posnic_customer_phone').hide();
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
                       
                        if(data[1]['posnic_item_price']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td4"><?php echo $this->lang->line('price') ?></td>');
                        }
                        if(data[1]['posnic_item_quantity']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td5"><?php echo $this->lang->line('quantity') ?></td>');
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
                        if(data[1]['posnic_item_subtotal']==1){
                            $('#posnic_table_head').append('<td id="posnic_table_head_td10" class="text-right"><?php echo $this->lang->line('sub_total') ?> </td>');
                        }
                        
                        $('#invoice_posnic_order_text').html(data[1]['posnic_message']);
                        var total_inclusive_tax=0;
                        var total_exclusive_tax=0;
                        var total_item_discount=0;
                        var sales_delivery_note_discount=0;                        
                        var sales_delivery_note_frieght=0;                        
                        var sales_delivery_note_round_off_amount=0;                        
                        var sales_delivery_note_sub_total=0;                        
                        var sales_delivery_note_grand=0;                        
                        for(var i=0;i<data[0].length;i++){
                            var  name=data[0][i]['items_name'];
                            if(data[0][i]['kit_name']){
                                name=data[0][i]['kit_name'];
                            }
                            var  sku=data[0][i]['i_code'];
                            if(data[0][i]['kit_code']){
                                sku=data[0][i]['kit_code'];
                            }
                            if(data[0][i]['deco_code']){
                                sku=data[0][i]['deco_code']+'-'+data[0][i]['deco_value'];
                            }
                            var  quty=data[0][i]['delivered_quty'];

                            var  tax_type=data[0][i]['tax_type_name'];
                            var  tax_value=data[0][i]['tax_value'];
                            var  tax_inclusive=data[0][i]['tax_Inclusive'];
                            var  tax_type2=data[0][i]['tax2_type'];
                            var  tax_value2=data[0][i]['tax2_value'];
                            var  tax_inclusive2=data[0][i]['tax_inclusive2'];
                            var  price=data[0][i]['price'];
                            if(data[0][i]['kit_code']){
                                tax_type=data[0][i]['kit_tax_type'];
                                tax_value=data[0][i]['kit_tax_value'];
                                tax_inclusive=data[0][i]['kit_tax_Inclusive'];
                                tax_type2=0;
                                tax_value2=0;
                                tax_inclusive2=0;
                                price=data[0][i]['kit_price'];
                                items_id=data[0][i]['kit_guid'];
                            }else  if(data[0][i]['deco_code']){
                                price=data[0][i]['price'];
                                items_id=data[0][i]['deco_guid'];
                            }
                            else{
                                var  items_id=data[0][i]['i_guid'];
                                var uom=data[0][i]['uom']                                    
                                if(uom==1){
                                    var no_of_unit=data[0][i]['no_of_unit'];
                                    price=price/no_of_unit;
                                }

                            }               
                            var subtotal=parseFloat(quty)*parseFloat(price);
                            var total=subtotal;
                            var discount_per=data[0][i]['item_discount'];
                            var type;
                            var tax1=0;
                            var tax2=0;
                            var total_tax=0;
                            tax1=parseFloat(subtotal)*parseFloat(tax_value)/100;
                            if(tax_inclusive==0 && tax_value!=""){
                                type1='Exc';
                                total=parseFloat(total)+parseFloat(tax1);
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax1);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax1);
                            }
                            tax2=parseFloat(subtotal)*parseFloat(tax_value2)/100; 
                            if(tax_inclusive2==0 && tax_value2!=""){
                                total=parseFloat(total)+parseFloat(tax2);
                                total_tax=parseFloat(total_tax)+parseFloat(tax2);
                                type2='Exc';
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax2);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax2);
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
                            
                            
                            if(total_tax!=0){
                                if($('#parsley_reg #total_tax').val()==0){
                                    var num = parseFloat(total_tax);
                                    total_tax=num.toFixed(point);
                                    $('#parsley_reg #total_tax').val(total_tax);
                                }else{
                                    var total_tax=parseFloat($('#parsley_reg #total_tax').val())+parseFloat(total_tax);
                                    var num = parseFloat(total_tax);
                                    total_tax=num.toFixed(point);
                                    $('#parsley_reg #total_tax').val(total_tax);
                                }
                            }
                            
                            total_item_discount=parseFloat(total_item_discount)+parseFloat(discount);
                                
                           
                            sales_delivery_note_sub_total=parseFloat(sales_delivery_note_sub_total)+parseFloat(total);
                             $('#invoice_posnic_table tbody').append('<tr id="posnic_table_body'+i+'"><td>'+parseInt(i+1)+'</td></tr>');
                            if(data[1]['posnic_item_name']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td2">'+name+'</td>');
                            }
                            if(data[1]['posnic_item_sku']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td3">'+sku+'</td>');
                            }
                            if(data[1]['posnic_item_price']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td4">'+price+'</td>');
                            }
                            if(data[1]['posnic_item_quantity']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td5">'+quty+'</td>');
                            }
                            if(data[1]['posnic_item_tax1']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td6">'+tax1+'</td>');
                            }
                            if(data[1]['posnic_item_tax2']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td7">'+tax2+'</td>');
                            }
                            if(data[1]['posnic_item_discount1']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td8">'+discount+'</td>');
                            }
                            if(data[1]['posnic_item_subtotal']==1){
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td10" class="text-right">'+total+' </td>');
                            }
                        }
                        
                        if(data[1]['posnic_sales_delivery_note_subtotal']==1){
                            var num = parseFloat(sales_delivery_note_sub_total);
                            sales_delivery_note_sub_total=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot1" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot1').append('<td ><?php echo $this->lang->line('sub_total') ?> </td>');
                            $('#posnic_table_tfoot1').append('<td class="text-right">'+sales_delivery_note_sub_total+' </td>');                            
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
                            $('#posnic_table_tfoot3').append('<td ><?php echo $this->lang->line('total')." ".$this->lang->line('exclusive_tax') ?> </td>');
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
                        if(data[1]['posnic_customer_discount']==1){
                            var value=data[0][0]['customer_discount_amount'];
                            var num = parseFloat(value);
                            value=num.toFixed(point);
                            if(isNaN(parseFloat(value))) value=0;
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot50" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot50').append('<td ><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?> </td>');
                            $('#posnic_table_tfoot50').append('<td class="text-right">'+value+' </td>');                            
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
        $('#sales_quotation_select').hide();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
        $('#parsley_reg input').prop('disabled',true);
        $('#parsley_reg textarea').prop('disabled',true);
    }
    function invoice_enable(){
        $('#parsley_reg input').prop('disabled',false);
        $('#parsley_reg textarea').prop('disabled',false);
        $('#company').attr("disabled", "disabled");
        $('#first_name').attr("disabled", "disabled");
        $('#demo_dn_no').attr("disabled", "disabled");
        $('#address').attr("disabled", "disabled");
        $('#demo_order_number').attr("disabled", "disabled");
        $('#demo_total_amount').attr("disabled", "disabled");
        $('#demo_grand_total').attr("disabled", "disabled");
        $('#total_item_discount_amount').attr("disabled", "disabled");
        $('#total_tax').attr("disabled", "disabled");
        $('#demo_customer_discount').attr("disabled", "disabled");
        $('#demo_customer_discount_amount').attr("disabled", "disabled");
        $('#demo_order_number').attr("disabled", "disabled");
        $('#address').attr("disabled", "disabled");
        $('#company').attr("disabled", "disabled");
        $('#tax1').attr("disabled", "disabled");
        $('#tax2').attr("disabled", "disabled");
        $('#price').attr("disabled", "disabled");
        $('#total').attr("disabled", "disabled");
        $('#item_discount').attr("disabled", "disabled");
        $('#first_name').select2('enable');
        $('#sacn_items').show();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();        
    }
    function invoice_settings(){
        <?php
        if($this->session->userdata['sales_delivery_note_per']['invoice_setting']==1){ ?>
            $('#loading').modal('show');
            $('#invoice_div').hide();
            $('#invoice_settings').show('slow');
            $.ajax({                                      
                url: "<?php echo base_url('sales_delivery_note/get_invoice_settings') ?>",                      
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
                    data['posnic_customer_name']==1?$('#posnic_customer_name').attr('checked','checked'):$('#posnic_customer_name').removeAttr('checked');
                    data['posnic_customer_company']==1?$('#posnic_customer_company').attr('checked','checked'):$('#posnic_customer_company').removeAttr('checked');
                    data['posnic_customer_address']==1?$('#posnic_customer_address').attr('checked','checked'):$('#posnic_customer_address').removeAttr('checked');
                    data['posnic_customer_city']==1?$('#posnic_customer_city').attr('checked','checked'):$('#posnic_customer_city').removeAttr('checked');
                    data['posnic_customer_state']==1?$('#posnic_customer_state').attr('checked','checked'):$('#posnic_customer_state').removeAttr('checked');
                    data['posnic_customer_country']==1?$('#posnic_customer_country').attr('checked','checked'):$('#posnic_customer_country').removeAttr('checked');
                    data['posnic_customer_zip']==1?$('#posnic_customer_zip').attr('checked','checked'):$('#posnic_customer_zip').removeAttr('checked');
                    data['posnic_customer_email']==1?$('#posnic_customer_email').attr('checked','checked'):$('#posnic_customer_email').removeAttr('checked');
                    data['posnic_customer_phone']==1?$('#posnic_customer_phone').attr('checked','checked'):$('#posnic_customer_phone').removeAttr('checked');
                    data['posnic_item_name']==1?$('#posnic_item_name').attr('checked','checked'):$('#posnic_item_name').removeAttr('checked');
                    data['posnic_item_sku']==1?$('#posnic_item_sku').attr('checked','checked'):$('#posnic_item_sku').removeAttr('checked');
                    data['posnic_item_price']==1?$('#posnic_item_price').attr('checked','checked'):$('#posnic_item_price').removeAttr('checked');
                    data['posnic_item_tax1']==1?$('#posnic_item_tax1').attr('checked','checked'):$('#posnic_item_tax1').removeAttr('checked');
                    data['posnic_item_tax2']==1?$('#posnic_item_tax2').attr('checked','checked'):$('#posnic_item_tax2').removeAttr('checked');
                    data['posnic_item_quantity']==1?$('#posnic_item_quantity').attr('checked','checked'):$('#posnic_item_quantity').removeAttr('checked');
                    data['posnic_item_discount1']==1?$('#posnic_item_discount1').attr('checked','checked'):$('#posnic_item_discount1').removeAttr('checked');
                    data['posnic_customer_discount']==1?$('#posnic_customer_discount').attr('checked','checked'):$('#posnic_customer_discount').removeAttr('checked');
                    data['posnic_item_subtotal']==1?$('#posnic_item_subtotal').attr('checked','checked'):$('#posnic_item_subtotal').removeAttr('checked');
                    data['posnic_sales_delivery_note_subtotal']==1?$('#posnic_sales_delivery_note_subtotal').attr('checked','checked'):$('#posnic_sales_delivery_note_subtotal').removeAttr('checked');
                    data['posnic_inclusive_total_tax']==1?$('#posnic_inclusive_total_tax').attr('checked','checked'):$('#posnic_inclusive_total_tax').removeAttr('checked');
                    data['posnic_exclusive_total_tax']==1?$('#posnic_exclusive_total_tax').attr('checked','checked'):$('#posnic_exclusive_total_tax').removeAttr('checked');
                    data['posnic_total_item_discount']==1?$('#posnic_total_item_discount').attr('checked','checked'):$('#posnic_total_item_discount').removeAttr('checked');
                    data['posnic_discount']==1?$('#posnic_discount').attr('checked','checked'):$('#posnic_discount').removeAttr('checked');
                    data['posnic_frieght']==1?$('#posnic_frieght').attr('checked','checked'):$('#posnic_frieght').removeAttr('checked');
                    data['posnic_round_off_amount']==1?$('#posnic_round_off_amount').attr('checked','checked'):$('#posnic_round_off_amount').removeAttr('checked');
                    data['posnic_grand_total']==1?$('#posnic_grand_total').attr('checked','checked'):$('#posnic_grand_total').removeAttr('checked');
                    data['posnic_customer_mail']==1?$('#posnic_customer_mail').attr('checked','checked'):$('#posnic_customer_mail').removeAttr('checked');
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
        if($this->session->userdata['sales_delivery_note_per']['invoice_setting']==1){ ?>
              $('#loading').modal('show');
                    var inputs = $('#settings_form').serialize();
                    $.ajax ({
                        url: "<?php echo base_url('index.php/sales_delivery_note/save_invoice_settings')?>",
                        data: inputs,
                        type:'POST',
                        complete: function(response) {
                            if(response['responseText']=='TRUE'){
                                $.bootstrapGrowl('<?php echo $this->lang->line('invoice_settings').' '.$this->lang->line('saved');?>', { type: "success" });                                                                                  
                               
                                $('#invoice_settings').hide();
                               
                                $('#invoice_div').show('slow');
                                sales_delivery_note_invoice($('#sales_delivery_note_guid').val());
                                $('#loading').hide();
                            }else{
                                $.bootstrapGrowl('<?php echo $this->lang->line('you_have_no_permission_to_update')." ".$this->lang->line('invoice_settings'); ?>', { type: "error" });          
                            }
                        }
                    });
                <?php 
            
        }else{ ?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('customer');?>', { type: "error" });                       
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

            
              


  