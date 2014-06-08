
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
                                                                    if(oObj.aData[8]==1){
                                                                        return "<input type=checkbox value='"+oObj.aData[0]+"' disabled='disabled' ><input type='hidden' id='item_kit__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                    }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='item_kit__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='item_id_"+oObj.aData[0]+"' value='"+oObj.aData[10]+"'>";
                                                                    }
								},
								
								
							},
        
        null, null, null, null

, null,  null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[8]==1){
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
                                                                if(oObj.aData[11]==1){
                                                                       return '<a href=javascript:kit_active("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:kit_deactive("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
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
           
          
        
function item_kit_approve(guid){
        <?php if($this->session->userdata['item_kit_per']['approve']==1){ ?>
            $.ajax({
                url: '<?php echo base_url() ?>index.php/item_kit/item_kit_approve',
                type: "POST",
                data: {
                    guid: guid,
                    item:$('#item_id_'+guid).val(),
                    
                },
                complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('item_kit') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#item_kit__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('item_kit');?>', { type: "error" });                              
                    }
                    }
            });
            <?php }else{?>
                        $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
                <?php }
             ?>
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
                           
                               
                                
                                
                                $("#parsley_reg #select_item").select2('data', {id:'1',text: data[0]['name']});
                                $('#select_item').select2('disable');
                                $('#guid').val(guid)
                                $('#select_item').val(data[0]['name'])
                                $("#parsley_reg #item_sku").val(data[0]['sku']);
                                $("#parsley_reg #demo_item_stock").val(data[0]['quty']);
                                $("#parsley_reg #item_stock").val(data[0]['quty']);                                
                                $("#parsley_reg #demo_item_kit_number").val(data[0]['code']);
                                $("#parsley_reg #item_kit_number").val(data[0]['code']);
                                $("#parsley_reg #item_kit_date").val(data[0]['date']);
                                $("#parsley_reg #note").val(data[0]['note']);
                                $("#parsley_reg #remark").val(data[0]['remark']);                                
                                $("#parsley_reg #demo_total_amount").val(data[0]['total_amount']);
                                $("#parsley_reg #total_amount").val(data[0]['total_amount']);
                                $("#parsley_reg #demo_total_item_weight").val(data[0]['total_weight']);
                                $("#parsley_reg #total_item_weight").val(data[0]['total_weight']);
                                $('#demo_item_weight_stock').val(parseFloat(data[0]['quty'])*parseFloat(data[0]['item_weight']))
                                $('#item_weight_stock').val(parseFloat(data[0]['quty'])*parseFloat(data[0]['item_weight']))
                                $('#current_stock_weight').val(parseFloat(data[0]['quty'])*parseFloat(data[0]['item_weight'])-data[0]['total_weight'])
                               
                                for(i=0;i<data.length;i++){
                                    if(!$('#'+data[i]['i_guid']).length){
                                    var weight=data[i]['weight'];
                                    var quantity=data[i]['quantity'];                                  
                                    var price=data[i]['price'];
                                    var formula=data[i]['formula'];
                                    var total=data[i]['total'];
                                    var item_kits_id =data[i]['type_id'];
                                    var item_kit_value =data[i]['value'];                                  
                                    var item_kit_type =data[i]['type'];                                  
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                    null,
                                    item_kit_value,
                                    formula,
                                    weight,
                                    quantity,
                                    price,
                                    total,
                                    '<input type="hidden" name="index" id="index">\n\
                                    <input type="hidden" name="item_kits_value[]" id="item_kits_value" value="'+item_kit_value+'">\n\
                                    <input type="hidden" name="deco_guid[]" id="deco_guid" value="'+data[i]['deco_guid']+'">\n\
                                    <input type="hidden" name="item_kits_type[]" id="item_kits_type" value="'+item_kit_type+'">\n\
                                    <input type="hidden" name="item_kits_id[]" id="item_kits_id" value="'+item_kits_id+'">\n\
                                    <input type="hidden" name="item_kits_weight[]" id="item_kits_weight" value="'+weight+'">\n\
                                    <input type="hidden" name="item_kits_quty[]" value="'+quantity+'" id="item_kits_quty"> \n\
                                    <input type="hidden" name="item_kits_price[]" value="'+price+'" id="item_kits_price">\n\
                                    <input type="hidden" name="item_kits_formula[]" value="'+formula+'" id="item_kits_formula">\n\
                                    <input type="hidden" name="item_kits_total[]"  value="'+total+'" id="item_kits_total">\n\
                                    <a href=javascript:edit_item_kit_item("'+item_kits_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_item_kit_item('"+item_kits_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+item_kits_id)
                                }
                                }
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('item_kit');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  