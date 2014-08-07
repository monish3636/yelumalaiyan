
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_invoice') ?>');
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
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('purchase_order')." ".$this->lang->line('for')." ".$this->lang->line('purchase_invoice') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/purchase_invoice/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , 
        
        null, null, null, null, null,


 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                
                                                                        return '<a href=javascript:purchase_order_invoice("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('print') ?>"><i class="glyphicon glyphicon-print"></i></span></a>&nbsp<a href=javascript:purchase_order_view("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>';
                                                                
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
    <?php if($this->session->userdata['purchase_invoice_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('purchase_invoice') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/purchase_invoice/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
               complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_invoice') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
   <?php }
?>
                        }
    function invoice_disable(){
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
        $('#sacn_items').show();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
        $('#parsley_reg input').prop('disabled',false);
        $('#parsley_reg textarea').prop('disabled',false);
    }
          
        
        function posnic_active(guid){
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/purchase_invoice/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                         $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
        }
          
        function purchase_order_view(guid){
                        <?php if($this->session->userdata['purchase_invoice_per']['view']==1){ ?>
                                
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
                             url: "<?php echo base_url() ?>index.php/purchase_invoice/view_purchase_invoice/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                 invoice_disable();
                                $("#user_list").hide();
                                $('#add_new_order').show('slow');                             
                                $('#posnic_add_purchase_invoice').attr("disabled", "disabled");
                                $('#purchase_invoice_lists').removeAttr("disabled");
                               
                             
                                $("#parsley_reg #first_name").val(data[0]['s_name']);
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #purchase_invoice_guid").val(guid);
                                $("#parsley_reg #demo_invoice_no").val(data[0]['invoice']);
                                $("#parsley_reg #order_number").val(data[0]['invoice']);
                                $("#parsley_reg #order_date").val(data[0]['po_date']);
                                $("#parsley_reg #received_date").val(data[0]['received_date']);
                                $("#parsley_reg #edit_grn_node").val(data[0]['grn_no']);
                                $("#parsley_reg #grn_date").val(data[0]['date']);
                                $("#parsley_reg #note").val(data[0]['note']);
                                $("#parsley_reg #remark").val(data[0]['remark']);
                              
                               // $("#parsley_reg #demo_order_number").select2('data', {id:'',text: data[0]['po_no']});
                                $(".supplier_select_2").hide();
                                $(".porchase_order_for_grn").show();
                                
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
                                  
                                $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                                $("#parsley_reg #grn_guid").val(guid);
                                var tax;
                                var receive=0;
                                for(i=0;i<data.length;i++){
                               
                                      receive=1;
                                    var  name=data[i]['items_name'];
                                    var  rece_quty=data[i]['rece_quty'];
                                    var  rece_free=data[i]['rece_free'];
                                    var  sku=data[i]['i_code'];
                                    var  quty=parseFloat(data[i]['quty']);
                                    var  limit=data[i]['item_limit'];
                                    var  tax_type=data[i]['tax_type_name'];
                                    var  tax_value=data[i]['tax_value'];
                                    var  tax_Inclusive=data[i]['tax_Inclusive'];
                                    var  tax_type2=data[i]['tax2_type'];
                                    var  tax_value2=data[i]['tax2_value'];
                                    var  tax_Inclusive2=data[i]['tax_inclusive2'];  
                                  
                                    var  free=parseFloat(data[i]['free']);
                                    var  received_quty=data[i]['received_quty'];
                                    var  received_free=data[i]['received_free'];
                                   
                                    var  cost=data[i]['cost'];
                                    var  price=data[i]['sell'];
                                    var  mrp=data[i]['mrp'];
                                    var  o_i_guid=data[i]['o_i_guid'];
                                    var  date=data[i]['date'];
                                    var  items_id=data[i]['item'];
                                    var total=parseFloat(quty)*parseFloat(cost);
                                    var subtotal=parseFloat(quty)*parseFloat(cost);
                                    var discount=data[i]['item_dis_amt'];
                                    var discount2=data[i]['item_dis_amt2'];
                                    var per=data[i]['dis_per'];
                                    var per2=data[i]['dis_per2']; 
                                    var type='Inc';
                                    var tax=parseFloat(tax_value)*parseFloat(subtotal)  ;
                                    if(data[i]['tax_Inclusive']==0){                                                                          
                                        var total=(parseFloat(tax)+parseFloat(total));
                                        type='Exc';
                                    }
                                    var type2='Inc';
                                    var tax2=parseFloat(tax_value2)*parseFloat(subtotal)  ;
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
                                    name+"<input type='hidden' id='"+data[i]['o_i_guid']+"' >",
                                    sku,
                                    cost,
                                    mrp,
                                    quty,
                                    free,
                                   
                                    parseFloat(quty)*parseFloat(cost),
                                    tax+' : '+tax_type+'('+type+')',
                                    tax2+' : '+tax_type2+'('+type2+')',
                                    discount,
                                    total,
                                    ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+items_id)
                                
                                }
                             } 
                           });
                      
                          window.setTimeout(function ()
                    {
                       //$('#parsley_reg #delivery_date').focus();
                       document.getElementById('order_date').focus();
                       $('#loading').modal('hide');
                    }, 0);
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  