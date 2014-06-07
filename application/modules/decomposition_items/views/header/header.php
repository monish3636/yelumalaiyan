
<script type="text/javascript" charset="utf-8">
    var point=3;
    $(document).ready( function () {
        posnic_table();
        $('#add_new_decomposition_items').hide();
        parsley_reg.onsubmit=function()
        { 
          return false;
        } 

    } );
                       
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/decomposition_items/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                    if(oObj.aData[8]==1){
                                                                        return "<input type=checkbox value='"+oObj.aData[0]+"' disabled='disabled' ><input type='hidden' id='decomposition_items__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
                                                                    }else{
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='decomposition_items__number_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'><input type='hidden' id='item_id_"+oObj.aData[0]+"' value='"+oObj.aData[10]+"'>";
                                                                    }
								},
								
								
							},
        
        null, 

, null,  null,null,
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                
                                                                        return '<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>';
                                                                
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           function posnic_item_table(guid){
           var supplier=$('#edit_decomposition_items_form #supplier_guid').val();
           if($('#edit_decomposition_items_form #supplier_guid').val()==""){
               supplier=guid;
           }
           
         		 if($('#selected_item_table').length) {
                $('#selected_item_table').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }	
                                   
			}

          
        

          
        function edit_function(guid){
           
        
                        <?php if($this->session->userdata['decomposition_items_per']['edit']==1){ ?>
                                
                            $('#loading').modal('show');
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/decomposition_items/get_decomposition_items/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_decomposition_items').show('slow');
                                $('#posnic_add_decomposition_items').attr("disabled", "disabled");
                                $('#decomposition_items_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                                $("#parsley_reg #select_item").select2('data', {id:'1',text: data[0]['name']});
                                $('#select_item').select2('disable');
                                $('#guid').val(guid)
                                $('#parsley_reg #item').val(data[0]['name'])
                                $("#parsley_reg #code").val(data[0]['code']);
                                $("#parsley_reg #weight").val(data[0]['weight']);;                                
                                $("#parsley_reg #price").val(data[0]['price']);
                               
                             } 
                           });
                      
                        

            <?php }else{?>
                     $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('decomposition_items');?>', { type: "error" });                       
            <?php }?>
        }
</script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  