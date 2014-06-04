
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
                                                                    if(oObj.aData[4]==""){
                                                                        return '<a href=javascript:edit_design("'+oObj.aData[2]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon icon-edit"></i></span></a> <a href=javascript:delete_design("'+oObj.aData[2]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('delete') ?>"><i class="icon icon-trash"></i></span></a>';
                                                                    }else{
                                                                        return '<a href=javascript:edit_import_design("'+oObj.aData[2]+'") ><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon icon-edit"></i></span></a> <a href=javascript:delete_design("'+oObj.aData[2]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('delete') ?>"><i class="icon icon-trash"></i></span></a>';
                                                                    }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           
          
           function edit_import_design(guid){
                       $("#import_design_form").trigger('reset');
                       import_design();
                        <?php if($this->session->userdata['price_tag_per']['edit']==1){ ?>
                                                               
                            $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/price_tag/get_price_tag_details/"+guid,                     
                             data: "", 
                             dataType: 'json',
                             success: function(data)        
                             {    
                             
                                $('#import_box').css('width',data[0]['box_width']);
                                $('#import_box').css('height',data[0]['box_height']);
                                $('#import_box').css("background-image", "url(uploads/price_tags/"+data[0]['image']+")");   
                                $('#import_image').val(data[0]['image']);
                                $('#import_design_id').val(data[0]['design']);
                                $('#update_import_design_id').val(data[0]['design']);
                                 
                                for(var i=0;i< data.length;i++){
                                    if(data[i]['label']=='store'){
                                        var left=parseInt($('#import_box').offset().left);
                                        var top=parseInt($('#import_box').offset().top);
                                        data[i]['top']= parseInt(data[i]['top'])*-1;
                                        $('#import_company').css('left',parseInt(data[i]['left'])+200);
                                        $('#import_company').css('top',data[i]['top']-60);
                                        $('#import_company p').removeClass('btn');
                                        $('#import_company p').removeClass('btn-default');
                                        $('#import_p_company').css('font-size',data[i]['size']);
                                        $('#import_p_company').css('color',"rgb("+data[i]['color']+")");
                                        $('#import_p_company').css('font-weight',data[i]['bold']);
                                        $('#import_company').css('transform',data[i]['transform']);
                                        $('#import_p_company').css('text-decoration',data[i]['under_line']);
                                    }
                                   else if(data[i]['label']=='price_label'){
                                        var left=parseInt($('#import_box').offset().left);
                                        var top=parseInt($('#import_box').offset().top);
                                       data[i]['top']= parseInt(data[i]['top'])
                                        console.log($('#import_price_label').offset().top);
                                        $('#import_price_label').css('left',parseInt(data[i]['left'])+200);
                                        $('#import_price_label').css('top',data[i]['top']-150);
                                        $('#import_price_label p').removeClass('btn');
                                        $('#import_price_label p').removeClass('btn-default');
                                        $('#import_p_price_label').css('font-size',data[i]['size']);
                                        $('#import_p_price_label').css('color',"rgb("+data[i]['color']+")");
                                        $('#import_p_price_label').css('font-weight',data[i]['bold']);
                                        $('#import_price_label').css('transform',data[i]['transform']);
                                        $('#import_p_price_label').css('text-decoration',data[i]['under_line']);
                                    }
                                   else if(data[i]['label']=='barcode'){
                                        var left=parseInt($('#import_box').offset().left);
                                        var top=parseInt($('#import_box').offset().top);
                                       data[i]['top']= parseInt(data[i]['top'])
                                      
                                        $('#import_barcode').css('left',parseInt(data[i]['left'])+220);
                                        $('#import_barcode').css('top',data[i]['top']-70);
                                        $('#import_barcode').removeClass('btn');
                                        $('#import_barcode').removeClass('btn-default');
                                        
                                    }
                                   else if(data[i]['label']=='product'){
                                        var left=parseInt($('#import_box').offset().left);
                                        var top=parseInt($('#import_box').offset().top);
                                       data[i]['top']= parseInt(data[i]['top'])*-1;
                                      
                                        $('#import_product').css('left',parseInt(data[i]['left'])+220);
                                        $('#import_product').css('top',data[i]['top']+10);
                                        $('#import_p_product').css('font-size',data[i]['size']);
                                        $('#import_p_product').css('color',"rgb("+data[i]['color']+")");
                                        $('#import_p_product').css('font-weight',data[i]['bold']);
                                        $('#import_product').css('transform',data[i]['transform']);
                                        $('#import_p_product').css('text-decoration',data[i]['under_line']);
                                        $('#import_product p').removeClass('btn');
                                        $('#import_product p').removeClass('btn-default');
//                                        /  console.log();position: relative; left: 419px; top: -189px;
                                    }
                                }
                                 

                               
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('price_tag');?>', { type: "error" });                           
                        <?php }?>
                       }
           function edit_design(guid){
                       $("#add_item").trigger('reset');
                       design_price_tag();
                        <?php if($this->session->userdata['price_tag_per']['edit']==1){ ?>
                                                               
                            $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/price_tag/get_price_tag_details/"+guid,                     
                             data: "", 
                             dataType: 'json',
                             success: function(data)        
                             {    
                             
                                $('#box').css('width',data[0]['box_width']);
                                $('#box').css('height',data[0]['box_height']);
                                 
                                for(var i=0;i< data.length;i++){
                                    if(data[i]['label']=='store'){
                                        var left=parseInt(data[i]['left']);
                                       left=left+ parseInt($('#box').css('left'));
                                       console.log(left);
                                        $('#company').css('left',left);
                                        $('#company').css('top','-38');
                                          console.log();
                                    }
                                }
                                 

                               
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('price_tag');?>', { type: "error" });                           
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
                <script type="text/javascript" src="<?php echo base_url('template/form_post/jquery.form.js') ?>"></script>