
<script type="text/javascript" charset="utf-8">
    

    var point=3;
          $(document).ready( function () {
              
        	 refresh_items_table();
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('decomposition') ?>');
                     $('#add_new_decomposition').hide();
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
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('decomposition') ?>');
                }        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/decomposition/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    if(oObj.aData[8]==1){
                                                                        return "<input type=checkbox value='"+oObj.aData[0]+"' disabled='disabled' ><input type='hidden' id='decomposition__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                    }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='decomposition__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='item_id_"+oObj.aData[0]+"' value='"+oObj.aData[10]+"'>";
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
                   							if(oObj.aData[8]==1){
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
                                                                if(oObj.aData[11]==1){
                                                                         	 return '<a  ><span data-toggle="tooltip" class="label label-success hint--top hint--success"  ><i class="icon-play"></i></span></a>&nbsp<a  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" ><i class="icon-edit"></i></span></a>'+"&nbsp;<a><span data-toggle='tooltip' class='label label-danger hint--top hint--error' ><i class='icon-trash'></i></span> </a>"
								}else{
                                                                        return '<a href=javascript:decomposition_approve("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('approve') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           function posnic_item_table(guid){
           var supplier=$('#edit_decomposition_form #supplier_guid').val();
           if($('#edit_decomposition_form #supplier_guid').val()==""){
               supplier=guid;
           }
           
         		 if($('#selected_item_table').length) {
                $('#selected_item_table').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }	
                                   
			}
 function user_function(guid){
    <?php if($this->session->userdata['decomposition_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('items') ?> "+$('#decomposition__number_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/decomposition/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                 complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('decomposition') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else{
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                    }
                    }
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
   <?php }
?>
                        }
           
          
        
function decomposition_approve(guid){
        <?php if($this->session->userdata['decomposition_per']['approve']==1){ ?>
            $.ajax({
                url: '<?php echo base_url() ?>index.php/decomposition/decomposition_approve',
                type: "POST",
                data: {
                    guid: guid,
                    item:$('#item_id_'+guid).val(),
                    
                },
                complete: function(response) {
                    if(response['responseText']=='TRUE'){
                           $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('decomposition') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }else if(response['responseText']=='Approved'){
                         $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                    }else{
                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition');?>', { type: "error" });                              
                    }
                    }
            });
            <?php }else{?>
                        $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                <?php }
             ?>
}
          
           function edit_function(guid){
           
        
                        <?php if($this->session->userdata['decomposition_per']['edit']==1){ ?>
                                
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
                             url: "<?php echo base_url() ?>index.php/decomposition/get_decomposition/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_decomposition').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_decomposition').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#decomposition_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                           
                               
                                
                                
                                $("#parsley_reg #select_item").select2('data', {id:'1',text: data[0]['name']});
                                $('#select_item').select2('disable');
                                $('#guid').val(guid)
                                $('#select_item').val(data[0]['name'])
                                $("#parsley_reg #item_sku").val(data[0]['sku']);
                                $("#parsley_reg #demo_item_stock").val(data[0]['quty']);
                                $("#parsley_reg #item_stock").val(data[0]['quty']);                                
                                $("#parsley_reg #demo_decomposition_number").val(data[0]['code']);
                                $("#parsley_reg #decomposition_number").val(data[0]['code']);
                                $("#parsley_reg #decomposition_date").val(data[0]['date']);
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
                                    var decompositions_id =data[i]['type_id'];
                                    var decomposition_value =data[i]['value'];                                  
                                    var decomposition_type =data[i]['type'];                                  
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                    null,
                                    decomposition_value,
                                    formula,
                                    weight,
                                    quantity,
                                    price,
                                    total,
                                    '<input type="hidden" name="index" id="index">\n\
                                    <input type="hidden" name="decompositions_value[]" id="decompositions_value" value="'+decomposition_value+'">\n\
                                    <input type="hidden" name="deco_guid[]" id="deco_guid" value="'+data[i]['deco_guid']+'">\n\
                                    <input type="hidden" name="decompositions_type[]" id="decompositions_type" value="'+decomposition_type+'">\n\
                                    <input type="hidden" name="decompositions_id[]" id="decompositions_id" value="'+decompositions_id+'">\n\
                                    <input type="hidden" name="decompositions_weight[]" id="decompositions_weight" value="'+weight+'">\n\
                                    <input type="hidden" name="decompositions_quty[]" value="'+quantity+'" id="decompositions_quty"> \n\
                                    <input type="hidden" name="decompositions_price[]" value="'+price+'" id="decompositions_price">\n\
                                    <input type="hidden" name="decompositions_formula[]" value="'+formula+'" id="decompositions_formula">\n\
                                    <input type="hidden" name="decompositions_total[]"  value="'+total+'" id="decompositions_total">\n\
                                    <a href=javascript:edit_decomposition_item("'+decompositions_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_decomposition_item('"+decompositions_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+decompositions_id)
                                }
                                }
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  