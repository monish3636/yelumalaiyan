
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#design_tag').hide();
                    $('#import_design_div').hide();
                              posnic_table();
                                add_item.onsubmit=function()
                                { 
                                  return false;
                                } 
                            
                        } );
                        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/price_tag/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , 
        
         null,  

 							
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                               
                                                                        return '<a href=javascript:delete_design("'+oObj.aData[2]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('delete') ?>"><i class="icon icon-trash"></i></span></a>';
                                                                
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           
          
           function set_items_setting(guid){
                       $("#parsley_reg").trigger('reset');
                        <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                                                               
                            $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items_setting/get_items_setting_details/"+guid,                     
                             data: "", 
                             dataType: 'json',  
//                              beforeSend: function() {
//                                $('#main_content').html('<img src="<?php echo base_url('loading.gif') ?>" />');
//                            },
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_item_form').show('slow');
                                 $('#posnic_add_items').attr("disabled", "disabled");    
                                 $('#items_lists').removeAttr("disabled");
                                 $('#edit_item_form #guid').val(data[1][0]['guid']);
                                 $('#edit_item_form #sku').val(data[0][0]['code']);
                                 $('#edit_item_form #item_name').val(data[0][0]['name']);
                                 $('#edit_item_form #brand').val(data[0][0]['b_name']);
                                 $('#edit_item_form #category').val(data[0][0]['c_name']);
                                 $('#edit_item_form #location').val(data[0][0]['location']);
                                 $('#edit_item_form #department_name').val(data[0][0]['department_name']);
                                 $('#edit_item_form #min_quty').val(data[1][0]['min_q']);
                                 $('#edit_item_form #max_quty').val(data[1][0]['max_q']);
                                 $('#edit_item_form #allow_negative').val(data[1][0]['allow_negative']);
                                 
                               
                                 if(data[1][0]['allow_negative']==1){
                                    $('#edit_item_form #allow_negative').val(1); 
                                    
                                 }else{
                                    $('#edit_item_form #allow_negative').val(0); 
                                 }




                                 var sales=data[1][0]['sales'];
                                 if(sales==1){
                                         $('#edit_item_form #sales_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #sales_no').attr("checked", true );
                                 }
                               
                                 var salses_return=data[1][0]['salses_return'];
                                 if(salses_return==1){
                                  $('#edit_item_form #sales_return_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #sales_return_no').attr("checked", true );
                                 }
                               
                                 var purchase=data[1][0]['purchase'];
                                 if(purchase==1){
                                  $('#edit_item_form #purchase_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #purchase_no').attr("checked", true );
                                 }
                               
                                 var purchase_return=data[1][0]['purchase_return'];
                                 if(purchase_return==1){
                                  $('#edit_item_form #purchase_return_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #purchase_return_no').attr("checked", true );
                                 }
                               
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
                <script type="text/javascript" src="<?php echo base_url('template/form_post/jquery.form.js') ?>"></script>