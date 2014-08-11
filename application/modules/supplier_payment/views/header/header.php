
<script type="text/javascript" charset="utf-8">
    var point=3;
      $(document).ready( function () {
            parsley_ext.onsubmit=function()
                                { 
                                  return false;
                                } 
       $('#credit_payment').hide();
       $('#credit_payament').hide();
       posnic_table();
   });
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/supplier_payment/data_table",
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
        
        null, null, null,  null,  null,  null,  {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							//if(oObj.aData[8]==0)
                                                                      if(oObj.aData[9]!=""){
                                                                          return "<?php echo $this->lang->line('credit') ?>";
                                                                      }else{
                                                                          return "<?php echo $this->lang->line('debit') ?>";
                                                                      }
								},
								
								
							},

 						{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                 if(oObj.aData[9]==""){
                                                                        return '<a href=javascript:view_supplier_payment("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                    }else{
                                                                          return '<a href=javascript:view_credit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-default hint--top hint--default" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon-book"></i></span></a>&nbsp<a href=javascript:edit_credit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
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
    <?php if($this->session->userdata['supplier_payment_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('supplier_payment') ?> "+$('#order__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/supplier_payment/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
               complete: function(response) {
                    if(response['responseText']==1){
                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('supplier_payment') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
                }); <?php }else{?>
                       $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
               <?php }
            ?>
                        }
       
        
    
          
    function edit_function(guid){
        <?php
        if($this->session->userdata['supplier_payment_per']['edit']==1){ ?>
            $("#parsley_reg").trigger('reset');
            $('#parsley_reg #update_button').show();
            $('#parsley_reg #save_button').hide();
            $('#parsley_reg #update_clear').show();
            $('#parsley_reg #save_clear').hide();
            $('#loading').modal('show');
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/supplier_payment/get_supplier_payment/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#credit_payment').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_supplier_payment').attr("disabled", "disabled");
                    $('#posnic_supplier_credit_payment').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#supplier_payment_lists').removeAttr("disabled");
                    $("#parsley_reg #payment_id").val(data[0]['guid']);
                    $("#parsley_reg #invoice").val(data[0]['invoice']);
                    $("#parsley_reg #company").val(data[0]['company']);
                    $("#parsley_reg #supplier").val(data[0]['name']);
                    $("#parsley_reg #demo_payment_code").val(data[0]['code']);
                    $("#parsley_reg #purchase_invoice").select2('data', {id:'',text: data[0]['invoice']});
                    $("#parsley_reg #purchase_invoice").select2('disable');
                    $("#parsley_reg #payment_code").val(data[0]['code']);
                    $("#parsley_reg #payment_date").val(data[0]['payment_date']);
                    $("#parsley_reg #amount").val(data[0]['amount']);
                    $("#parsley_reg #memo").val(data[0]['memo']);
                    $("#parsley_reg #payment").val(data[0]['payable_id']);
                    var balance=data[0]['paid_amount']-data[0]['amount'];
                    $("#parsley_reg #balance_amount").val(data[0]['total']-balance);
                    $("#parsley_reg #balance").val(data[0]['total']-balance-data[0]['amount']);
                    $("#parsley_reg #total").val(data[0]['total']);
                    $("#parsley_reg #paid_amount").val(balance);
                    var num = parseFloat( $("#parsley_reg #balance_amount").val());
                    $("#parsley_reg #balance_amount").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_reg #balance").val());
                    $("#parsley_reg #balance").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_reg #paid_amount").val());
                    $("#parsley_reg #paid_amount").val(num.toFixed(point));
                } 
            });
            window.setTimeout(function ()
            {
                document.getElementById('amount').focus();
                $('#loading').modal('hide');
            }, 0);
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
            <?php
        }?>
    }
          
    function view_supplier_payment(guid){
        <?php
        if($this->session->userdata['supplier_payment_per']['view']==1){ ?>
            $("#parsley_reg").trigger('reset');
            $('#parsley_reg #update_button').show();
            $('#parsley_reg #save_button').hide();
            $('#parsley_reg #update_clear').show();
            $('#parsley_reg #save_clear').hide();
            $('#loading').modal('show');
             invoice_disable();
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/supplier_payment/view_supplier_payment/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#credit_payment').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_supplier_payment').attr("disabled", "disabled");
                    $('#posnic_supplier_credit_payment').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#supplier_payment_lists').removeAttr("disabled");
                    $("#parsley_reg #payment_id").val(data[0]['guid']);
                    $("#parsley_reg #invoice").val(data[0]['invoice']);
                    $("#parsley_reg #company").val(data[0]['company']);
                    $("#parsley_reg #supplier").val(data[0]['name']);
                    $("#parsley_reg #demo_payment_code").val(data[0]['code']);
                    $("#parsley_reg #purchase_invoice").select2('data', {id:'',text: data[0]['invoice']});
                    $("#parsley_reg #purchase_invoice").select2('disable');
                    $("#parsley_reg #payment_code").val(data[0]['code']);
                    $("#parsley_reg #payment_date").val(data[0]['payment_date']);
                    $("#parsley_reg #amount").val(data[0]['amount']);
                    $("#parsley_reg #memo").val(data[0]['memo']);
                    $("#parsley_reg #payment").val(data[0]['payable_id']);
                    var balance=data[0]['paid_amount']-data[0]['amount'];
                    $("#parsley_reg #balance_amount").val(data[0]['total']-balance);
                    $("#parsley_reg #balance").val(data[0]['total']-balance-data[0]['amount']);
                    $("#parsley_reg #total").val(data[0]['total']);
                    $("#parsley_reg #paid_amount").val(balance);
                    var num = parseFloat( $("#parsley_reg #balance_amount").val());
                    $("#parsley_reg #balance_amount").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_reg #balance").val());
                    $("#parsley_reg #balance").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_reg #paid_amount").val());
                    $("#parsley_reg #paid_amount").val(num.toFixed(point));
                } 
            });
            window.setTimeout(function ()
            {
                document.getElementById('amount').focus();
                $('#loading').modal('hide');
            }, 0);
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You_Have_NO_Permission_To')." ".$this->lang->line('view')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
            <?php
        }?>
    }
    function edit_credit_function(guid){
        <?php
        if($this->session->userdata['supplier_payment_per']['view']==1){ ?>
            $("#parsley_ext").trigger('reset');
            $('#parsley_ext #update_button').hide();
            $('#parsley_ext #save_button').hide();
            $('#parsley_ext #update_clear').hide();
            $('#parsley_ext #save_clear').hide();
            $('#loading').modal('show');
           
            $.ajax({                                      
            url: "<?php echo base_url() ?>index.php/supplier_payment/get_supplier_credit_payment/"+guid,                      
            data: "", 
            dataType: 'json',               
            success: function(data)        
            { 
                $("#user_list").hide();
                $('#credit_payament').show('slow');
                $('#delete').attr("disabled", "disabled");
                $('#posnic_add_supplier_payment').attr("disabled", "disabled");
                $('#posnic_supplier_credit_payment').attr("disabled", "disabled");
                $('#active').attr("disabled", "disabled");
                $('#deactive').attr("disabled", "disabled");
                $('#supplier_payment_lists').removeAttr("disabled");
                $("#parsley_ext #payment_id").val(data[0]['guid']);
                $("#parsley_ext #purchase_return_guid").val(data[0]['return_id']);
                //$("#parsley_ext #invoice").val(data[0]['invoice']);
                $("#parsley_ext #purchase_invoice").val(data[0]['invoice']);
                $("#parsley_ext #supplier").val(data[0]['name']);
                $("#parsley_ext #demo_payment_code").val(data[0]['code']);
                $("#parsley_ext #purchase_return").select2('data', {id:'',text: data[0]['purchase_return_code']});
                 $("#parsley_ext #purchase_return").select2('disable');
                $("#parsley_ext #payment_code").val(data[0]['code']);
                $("#parsley_ext #payment_date").val(data[0]['payment_date']);
                $("#parsley_ext #amount").val(data[0]['amount']);
                $("#parsley_ext #memo").val(data[0]['memo']);
                $("#parsley_ext #payment").val(data[0]['payable_id']);
                var balance=data[0]['paid_amount']-data[0]['amount'];
                $("#parsley_ext #balance_amount").val(data[0]['total']-balance);
                $("#parsley_ext #balance").val(data[0]['total']-balance-data[0]['amount']);
                $("#parsley_ext #total").val(data[0]['total']);
                $("#parsley_ext #paid_amount").val(balance);
                var num = parseFloat( $("#parsley_ext #balance_amount").val());
                $("#parsley_ext #balance_amount").val(num.toFixed(point));
                var num = parseFloat( $("#parsley_ext #balance").val());
                $("#parsley_ext #balance").val(num.toFixed(point));
                var num = parseFloat( $("#parsley_ext #paid_amount").val());
                $("#parsley_ext #paid_amount").val(num.toFixed(point));
            } 
        });
        window.setTimeout(function ()
        {
            document.getElementById('amount').focus();
            $('#loading').modal('hide');
        }, 0);
        <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
            <?php
            }?>
    }
    function invoice_disable(){
        $('#purchase_invoice').select2('disable');
        $('#purchase_return').select2('disable');
        $('#update_button').hide();
        $('#update_clear').hide();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
       
        $('#parsley_ext #payment_date').attr("disabled", "disabled");
        $('#parsley_reg #payment_date').attr("disabled", "disabled");
        $('#parsley_ext #amount').attr("disabled", "disabled");
        $('#parsley_reg #amount').attr("disabled", "disabled");
        $('#parsley_ext #balance').attr("disabled", "disabled");
        $('#parsley_reg #balance').attr("disabled", "disabled");
        $('#parsley_ext #memo').attr("disabled", "disabled");
        $('#parsley_reg #memo').attr("disabled", "disabled");
    }
    function invoice_enable(){
        $('#parsley_ext #memo').removeAttr("disabled");
        $('#parsley_reg #memo').removeAttr("disabled");
        $('#parsley_ext #payment_date').removeAttr("disabled");
        $('#parsley_reg #payment_date').removeAttr("disabled");
        $('#parsley_ext #amount').removeAttr("disabled");
        $('#parsley_reg #amount').removeAttr("disabled");
        $('#sacn_items').show();
        $('#invoice_div').hide();
        $('#invoice_settings').hide();
        
    }
    function view_credit_function(guid){
        <?php
        if($this->session->userdata['supplier_payment_per']['view']==1){ ?>
            $("#parsley_ext").trigger('reset');
            $('#parsley_ext #update_button').hide();
            $('#parsley_ext #save_button').hide();
            $('#parsley_ext #update_clear').hide();
            $('#parsley_ext #save_clear').hide();
            invoice_disable();
            $('#loading').modal('show');
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/supplier_payment/view_supplier_credit_payment/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                    $("#user_list").hide();
                    $('#credit_payament').show('slow');
                    $('#delete').attr("disabled", "disabled");
                    $('#posnic_add_supplier_payment').attr("disabled", "disabled");
                    $('#posnic_supplier_credit_payment').attr("disabled", "disabled");
                    $('#active').attr("disabled", "disabled");
                    $('#deactive').attr("disabled", "disabled");
                    $('#supplier_payment_lists').removeAttr("disabled");
                    $("#parsley_ext #payment_id").val(data[0]['guid']);
                    $("#parsley_ext #purchase_return_guid").val(data[0]['return_id']);
                    //$("#parsley_ext #invoice").val(data[0]['invoice']);
                    $("#parsley_ext #purchase_invoice").val(data[0]['invoice']);
                    $("#parsley_ext #supplier").val(data[0]['name']);
                    $("#parsley_ext #demo_payment_code").val(data[0]['code']);
                    $("#parsley_ext #purchase_return").select2('data', {id:'',text: data[0]['purchase_return_code']});
                     $("#parsley_ext #purchase_return").select2('disable');
                    $("#parsley_ext #payment_code").val(data[0]['code']);
                    $("#parsley_ext #payment_date").val(data[0]['payment_date']);
                    $("#parsley_ext #amount").val(data[0]['amount']);
                    $("#parsley_ext #memo").val(data[0]['memo']);
                    $("#parsley_ext #payment").val(data[0]['payable_id']);
                    var balance=data[0]['paid_amount']-data[0]['amount'];
                    $("#parsley_ext #balance_amount").val(data[0]['total']-balance);
                    $("#parsley_ext #balance").val(data[0]['total']-balance-data[0]['amount']);
                    $("#parsley_ext #total").val(data[0]['total']);
                    $("#parsley_ext #paid_amount").val(balance);
                    var num = parseFloat( $("#parsley_ext #balance_amount").val());
                    $("#parsley_ext #balance_amount").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_ext #balance").val());
                    $("#parsley_ext #balance").val(num.toFixed(point));
                    var num = parseFloat( $("#parsley_ext #paid_amount").val());
                    $("#parsley_ext #paid_amount").val(num.toFixed(point));
                } 
            });
            window.setTimeout(function ()
            {
                document.getElementById('amount').focus();
                $('#loading').modal('hide');
            }, 0);
            <?php
        }else{?>
            $.bootstrapGrowl('<?php echo $this->lang->line('You_Have_NO_Permission_To')." ".$this->lang->line('view')." ".$this->lang->line('supplier_payment');?>', { type: "error" });                       
            <?php
        }?>
    }
    function supplier_payment_invoice(guid){
        <?php
        if($this->session->userdata['supplier_payment_per']['print_invoice']==1){ ?>
            $('#loading').modal('show');
            $("#user_list").hide();
            $('#add_new_order').hide();
            $('#invoice_settings').hide();
            $('#delete').attr("disabled", "disabled");
            $('#posnic_add_supplier_payment').attr("disabled", "disabled");
            $('#active').attr("disabled", "disabled");
            $('#deactive').attr("disabled", "disabled");
            $('#supplier_payment_lists').removeAttr("disabled");
            $('#invoice_div').show();
            $('#supplier_payment_guid').val(guid);
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/supplier_payment/get_invoice_settings_and_supplier_payment/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                        if(data[1]['posnic_sales_retun_id']==1){
                            $('#invoice_posnic_sales_retun_id').show();
                            $('#invoice_posnic_sales_retun_id').html(data[0][0]['code'])
                        }else{
                            $('#invoice_posnic_sales_retun_id').hide();
                        }
                        if(data[1]['posnic_sales_retun_no']==1){
                            $('#invoice_posnic_sales_retun_no').show();
                            $('#invoice_posnic_sales_retun_no').html('<?php echo $this->lang->line('supplier_payment')." ".$this->lang->line('no') ?> <span class="text-muted "> #'+data[0][0]['code']+'</span>')
                        }else{
                            $('#invoice_posnic_sales_retun_no').hide();
                        }
                        if(data[1]['posnic_sales_retun_date']==1){
                            $('#invoice_posnic_sales_retun_date').show();
                              $('#invoice_posnic_sales_retun_date').html('<?php echo $this->lang->line('supplier_payment')." ".$this->lang->line('date') ?> : <span class="text-muted">'+data[0][0]['date']+'</span>');
                        }else{
                            $('#invoice_posnic_sales_retun_date').hide();
                        }
                        if(data[1]['posnic_order_id']==1){
                            $('#invoice_posnic_id').show();
                            $('#invoice_posnic_id').html('<?php echo $this->lang->line('sales_bill') ?> <span class="text-muted "> #'+data[0][0]['invoice']+'</span>')
                        }else{
                            $('#invoice_posnic_id').hide();
                        }
                        if(data[1]['posnic_number']==1){
                            $('#invoice_posnic_number').show();
                            $('#invoice_posnic_number').html('<?php echo $this->lang->line('sales_bill')." ".$this->lang->line('no') ?> <span class="text-muted "> #'+data[0][0]['bill_id']+'</span>')
                        }else{
                            $('#invoice_posnic_number').hide();
                        }
                        if(data[1]['posnic_date']==1){
                            $('#invoice_posnic_date').show();
                              $('#invoice_posnic_date').html('<?php echo $this->lang->line('sales_bill')." ".$this->lang->line('date') ?> : <span class="text-muted">'+data[0][0]['sales_date']+'</span>');
                        }else{
                            $('#invoice_posnic_date').hide();
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
                        var supplier_payment_discount=0;                        
                        var supplier_payment_frieght=0;                        
                        var supplier_payment_round_off_amount=0;                        
                        var supplier_payment_sub_total=0;                        
                        var supplier_payment_grand=0;                        
                        for(var i=0;i<data[0].length;i++){
                            
                           var  name=data[0][i]['items_name'];
                            var  sku=data[0][i]['i_code'];
                            var  items_id=data[0][i]['item'];  
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
                            var  quantity=data[0][i]['quty'];
                            var  limit=data[0][i]['item_limit'];
                            var  tax_type=data[0][i]['tax_type_name'];
                            var  tax_value1=data[0][i]['tax_value'];
                            var  tax_inclusive1=data[0][i]['tax_Inclusive'];
                            var  tax_type2=data[0][i]['tax2_type'];
                            var  tax_value2=data[0][i]['tax2_value'];
                            var  tax_inclusive2=data[0][i]['tax_inclusive2'];
                            var  price=data[0][i]['sell'];
                            var  per=data[0][i]['item_discount'];
                            if(data[0][i]['kit_code']){
                                tax_type=data[0][i]['kit_tax_type'];
                                tax_value1=data[0][i]['kit_tax_value'];
                                tax_inclusive1=data[0][i]['kit_tax_Inclusive'];
                                tax_type2=0;
                                tax_value2=0;
                                tax_inclusive2=0;
                            }
                            var total=parseFloat(quantity)*parseFloat(price);
                            var subtotal=parseFloat(quantity)*parseFloat(price);
                            var total_tax=0;
                            var tax1=0;
                            var type1='Inc';
                            var type2='Inc';
                            tax1=subtotal*parseFloat(tax_value1)/100;  
                            if(data[0][i]['tax_Inclusive']==0){                                                                          
                                total=(parseFloat(tax1)+parseFloat(total));
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax1);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax1);
                            }
                          
                            var tax2=parseFloat(subtotal)*parseFloat(tax_value2)/100;
                            if(data[0][i]['tax_inclusive2']==0){                                                                          
                                total=(parseFloat(tax2)+parseFloat(total));
                                total_exclusive_tax=parseFloat(total_exclusive_tax)+parseFloat(tax2);
                            }else{
                                total_inclusive_tax=parseFloat(total_inclusive_tax)+parseFloat(tax2);
                            }
                            var discount=0;
                            if(per!="" && per!=0){
                                discount=parseFloat(total)*parseFloat(per)/100;
                                total_item_discount=parseFloat(total_item_discount)+parseFloat(discount);
                            }
                          
                            if(isNaN(parseFloat(discount)))
                                discount=0;
                           
                            if(isNaN(parseFloat(total_item_discount)))
                            total_item_discount=0;
                            total=parseFloat(total)-parseFloat(discount);
                           
                            var num = parseFloat(total);
                            total=num.toFixed(point);
                            var num = parseFloat(subtotal);
                            subtotal=num.toFixed(point);
                            supplier_payment_sub_total=parseFloat(supplier_payment_sub_total)+parseFloat(total);
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
                                $('#posnic_table_body'+i).append('<td id="posnic_table_head_td5">'+quantity+'</td>');
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
                        
                        if(data[1]['posnic_supplier_payment_subtotal']==1){
                            var num = parseFloat(supplier_payment_sub_total);
                            supplier_payment_sub_total=num.toFixed(point);
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot1" class="item-row"><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot1').append('<td ><?php echo $this->lang->line('sub_total') ?> </td>');
                            $('#posnic_table_tfoot1').append('<td class="text-right">'+supplier_payment_sub_total+' </td>');                            
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
                      
                       
                        if(data[1]['posnic_grand_total']==1){
                            $('#invoice_posnic_table tfoot').append('<tr id="posnic_table_tfoot8" ><td colspan="'+parseInt($('#invoice_posnic_table thead tr td').length-2)+'"></td></tr>');
                            $('#posnic_table_tfoot8').append('<td class="grand-total" ><?php echo $this->lang->line('grand_total') ?> </td>');
                            $('#posnic_table_tfoot8').append('<td class="text-right grand-total">'+data[0][0]['total_amount']+' </td>');                            
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
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  