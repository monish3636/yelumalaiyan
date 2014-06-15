
<script type="text/javascript" charset="utf-8">
    var point=3; 
          $(document).ready( function () {
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('stock_level') ?>');
                     $('#update_stock_section').hide();
                              posnic_table();
                                
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                         
                        } );
                   
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                            "sPaginationType": "bootstrap_full",
                                    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                                $("td:first", nRow).html(iDisplayIndex +1);
                                $("#index", nRow).val(iDisplayIndex +1);
                               return nRow;
                            },
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/stock_level/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , 
        
        null,null,  null,  null,  null,  null, null, null, 

 							
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                
                                                                        return '<a href=javascript:get_stock("'+oObj.aData[10]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('view') ?>"><i class="icon icon-list"></i></span></a>';
                                              
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

           
          
        

          
           function get_stock(guid){
           
        
                        <?php if($this->session->userdata['stock_level_per']['read']==1){ ?>
                                
                           
                            
                            $('#loading').modal('show');
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/stock_level/get_stock/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#update_stock_section').show('slow');                                
                                $('#stock_level_lists').removeAttr("disabled");                               
                                $("#parsley_reg").trigger('reset');                           
                                $("#parsley_reg #stock_id").val(data[0]['guid']);
                                $("#parsley_reg #item_name").val(data[0]['name']);
                                $("#parsley_reg #sku").val(data[0]['code']);
                                $("#parsley_reg #brand").val(data[0]['b_name']);
                                $("#parsley_reg #category").val(data[0]['c_name']);
                                $("#parsley_reg #department").val(data[0]['d_name']);
                                $("#parsley_reg #price").val(data[0]['price']);
                                $("#parsley_reg #quantity").val(data[0]['quty']);
                                $('#loading').modal('hide');
                               
                                
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('stock_level');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  