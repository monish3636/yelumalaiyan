
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
                                                                       return '<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
								}else{
                                                                        return '<a href=javascript:sdn_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
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
                $("#parsley_reg #edit_dn_node").val(data[0]['code']);
                $("#parsley_reg #demo_dn_no").val(data[0]['sales_delivery_note_no']);
                $("#parsley_reg #delivery_date").val(data[0]['sales_delivery_note_date']);
                $("#parsley_reg #note").val(data[0]['grn_note']);
                $("#parsley_reg #remark").val(data[0]['grn_remark']);
                $("#parsley_reg #demo_customer_discount").val(data[0]['sdn_customer_discount']);
                $("#parsley_reg #customer_discount").val(data[0]['sdn_customer_discount']);
                $("#parsley_reg #demo_customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                $("#parsley_reg #customer_discount_amount").val(data[0]['sdn_customer_discount_amount']);
                $(".supplier_select_2").hide();
                $(".porchase_order_for_grn").show();
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
                                 // $('#total_item_discount_amount').val(total_discount);
                                 // $('#total_tax').val(total_tax);
                                     $("#parsley_reg #id_discount").val(data[0]['discount']);
                                     $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                                     $("#parsley_reg #note").val(data[0]['sales_delivery_note_note']);
                                     $("#parsley_reg #remark").val(data[0]['sales_delivery_note_remark']);
                             } 
                           });
                  
                          window.setTimeout(function ()
                    {
                       //$('#parsley_reg #delivery_date').focus();
                       document.getElementById('delivery_date').focus();
                       $('#loading').modal('hide');
                    }, 0); 
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('sales_delivery_note');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  