
<script type="text/javascript" charset="utf-8">    

    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('item_kit') ?>');
                     $('#add_new_item_kit').hide();
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
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('item_kit') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/item_kit/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='item_kit__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='item_id_"+oObj.aData[0]+"' value='"+oObj.aData[10]+"'>";
                                                                    
								},
								
								
							},
        
        null, null, null, null

, null,  null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[10]==1){
                                                                           return '<span data-toggle="tooltip" class="text-success" ><?php echo $this->lang->line('active') ?></span>';
                                                                        }else{
                                                                            return '<span data-toggle="tooltip" class="text-danger " ><?php echo $this->lang->line('deactive') ?></span>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                if(oObj.aData[10]==1){
                                                                       return '<a href=javascript:posnic_deactive("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:posnic_active("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           function posnic_item_table(guid){
           var supplier=$('#edit_item_kit_form #supplier_guid').val();
           if($('#edit_item_kit_form #supplier_guid').val()==""){
               supplier=guid;
           }
           
         		 if($('#selected_item_table').length) {
                $('#selected_item_table').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }	
                                   
			}
 function user_function(guid){
    <?php if($this->session->userdata['item_kit_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('items') ?> "+$('#item_kit__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/item_kit/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                 complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('item_kit') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
   <?php }
?>
                        }
           
          
            function posnic_deactive(guid){
                 var items=$('#item_kit__number_'+guid).val();
                $.ajax({
                url: '<?php echo base_url() ?>index.php/item_kit/deactive',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(items+' <?php echo $this->lang->line('isdeactivated');?>', { type: "danger" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_active(guid){
              var items=$('#item_kit__number_'+guid).val();
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/item_kit/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(items+' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }

          
           function edit_function(guid){
           
        
                        <?php if($this->session->userdata['item_kit_per']['edit']==1){ ?>
                                
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
                             url: "<?php echo base_url() ?>index.php/item_kit/get_item_kit/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_item_kit').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_item_kit').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#item_kit_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                           
                               
                                $('#guid').val(guid)
                               
                                $("#parsley_reg #item_kit_name").val(data[0]['item_kit_name']);                               
                                $("#parsley_reg #demo_item_kit_number").val(data[0]['item_kit_code']);
                                $("#parsley_reg #item_kit_number").val(data[0]['item_kit_code']);
                                $("#parsley_reg #item_kit_date").val(data[0]['date']);
                                $("#parsley_reg #note").val(data[0]['note']);
                                $("#parsley_reg #remark").val(data[0]['remark']);     
                                
                                $("#parsley_reg #demo_total_amount").val(data[0]['item_total']);
                                $("#parsley_reg #total_amount").val(data[0]['item_total']);
                                $("#parsley_reg #kit_price").val(data[0]['kit_price']);
                                
                                $("#parsley_reg #demo_selling_kit_price").val(data[0]['selling_price']);
                                $("#parsley_reg #demo_selling_kit_price").val(data[0]['selling_price']);
                                $("#parsley_reg #seling_tax_amount").val(data[0]['tax_amount']);
                                $("#parsley_reg #selling_tax_type").val(data[0]['kit_tax_inclusive']);
                                $("#parsley_reg #category_id").val(data[0]['kit_category_id']);
                                $("#parsley_reg #category").select2('data', {id:data[0]['kit_category_id'],text:data[0]['kit_category_name']});
                               
                                for(i=0;i<data.length;i++){
                                    var item_guid=data[i]['guid'];
                                    var item_id=data[i]['kit_item_id'];
                                    var quty=data[i]['kit_quty'];
                                    var sku=data[i]['code'];
                                    var name=data[i]['name'];
                                    var stock=data[i]['quty'];
                                    var stock_id=data[i]['guid'];
                                    var no_of_unit=data[i]['no_of_unit'];
                                    var price=data[i]['price'];
                                    console.log(price);
                                 price=parseFloat(price)/parseFloat(no_of_unit);
                                    console.log(price);
                                    var quantity=data[i]['kit_quty'];
                                    var tax_inclusive=data[i]['tax_Inclusive'];
                                    var sub_total=quantity*price;
                                    var tax=0;
                                    var tax_value=data[i]['tax_value'];
                                    var tax_type=data[i]['tax_type_name'];
                                    var tax_inc;
                                    var tax=parseFloat(sub_total)*tax_value/100;
                                    if(tax_inclusive==1){
                                        var total=parseFloat(sub_total)+parseFloat(tax); 
                                        tax_inc='Exc';
                                    }else{
                                        var total=parseFloat(sub_total);     
                                        tax_inc='Inc'
                                    }
                                    tax=tax.toFixed(point); 
                                    total=total.toFixed(point); 
                                    sub_total=sub_total.toFixed(point);
                                   
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                    null,
                                    name,
                                    sku,
                                    price,
                                    quty,
                                    sub_total,
                                    tax_type+':'+tax_value+"%("+tax_inc+")",
                                    tax,
                                    total,
                                    '<input type="hidden" name="index" id="index">\n\
                                    <input type="hidden" name="item_id[]" id="item_id" value="'+item_id+'">\n\
                                    <input type="hidden" name="item_name[]" id="item_name" value="'+name+'">\n\
                                    <input type="hidden" name="item_sku[]" id="item_sku" value="'+sku+'">\n\
                                    <input type="hidden" name="item_quty[]" id="item_quty" value="'+quty+'">\n\
                                    <input type="hidden" name="item_stocks_id[]" id="item_stocks_id" value="'+stock_id+'">\n\
                                    <input type="hidden" name="item_stocks[]" id="item_stocks" value="'+stock+'">\n\
                                    <input type="hidden" name="items_price[]" id="items_price" value="'+price+'">\n\
                                    <input type="hidden" name="item_tax_inclusive[]" value="'+tax_inclusive+'" id="item_tax_inclusive"> \n\
                                    <input type="hidden" name="item_tax_value[]" value="'+tax_value+'" id="item_tax_value">\n\
                                    <input type="hidden" name="item_tax_type[]" value="'+tax_type+'" id="item_tax_type">\n\
                                    <input type="hidden" name="item_tax_amount[]" value="'+tax+'" id="item_tax_amount">\n\
                                    <input type="hidden" name="item_sub_total[]"  value="'+total+'" id="item_sub_total">\n\
                                    <input type="hidden" name="item_total[]"  value="'+total+'" id="item_total">\n\
                                    <a href=javascript:edit_item_item("'+item_guid+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_item_item('"+item_guid+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );
                                    var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                                    theNode.setAttribute('id','new_item_row_id_'+item_guid)
                                }
                                }
                              
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  