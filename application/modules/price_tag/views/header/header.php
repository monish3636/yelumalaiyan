
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
                              $('#box').remove();
                               $('#box_parent').append('<div id="box"  style="border: solid #D3D3D3 3px;width: 300px;height: 150px">\n\
                                                <p></p>\n\
                                            </div>');
                                                    $('#box').droppable({
                                                    drop: function( event, ui ) {
                                                         var input_count=parseFloat($('#input_count').val());
                                                         var label_count=parseFloat($('#label_count').val());

                                                          var draged=ui.draggable.attr("id");

                                                          if(draged=='drag_label'+parseFloat(label_count-1)){
                                                                $('#'+draged).remove();
                                                                $('#label_row').append('<div id="drag_label'+label_count+'"    class="btn btn-default "><?php  echo $this->lang->line('label');?></div>');
                                                                $('#box').append('<div id="drag_label_'+label_count+'"    class="inputs push-left  "><p id="p_drag_label_'+label_count+'"  styel="height:30px;width:30px"><?php  echo $this->lang->line('label');?></p><a id="delete_actions_drag_label_'+label_count+'" class="field_none delete_action" href=javascript:remove_field("drag_label_'+label_count+'")><i class="icon icon-trash default"></i></a><a  id="edit_actions_drag_label_'+label_count+'" class="field_none edit_action" href=javascript:edit_field("drag_label_'+label_count+'")><i class="icon icon-edit default"></i></a></div>')
                                                                $( "#drag_label"+label_count ).draggable();
                                                                $( "#drag_label_"+label_count ).draggable();
                                                                $('#label_count').val(parseFloat(label_count+1));

                                                          }
                                                         else{

                                                              if(draged=='barcode'){
                                                                  $('#'+draged).removeClass('btn');
                                                                  $('#'+draged).removeClass('btn-default');
                                                                  $('#'+draged).addClass('default');
                                                              }
                                                              else if(draged=='company'){
                                                                  $('#'+draged+" p").removeClass('btn');
                                                                  $('#'+draged+" p").removeClass('btn-default');
                                                                  $('#'+draged+" p").addClass('default');
                                                              }
                                                              else if(draged=='product'){
                                                                  $('#'+draged+" p").removeClass('btn');
                                                                  $('#'+draged+" p").removeClass('btn-default');
                                                                  $('#'+draged+" p").addClass('default');
                                                              }
                                                              else if(draged=='price_label'){
                                                                  $('#'+draged+" p").removeClass('btn');
                                                                  $('#'+draged+" p").removeClass('btn-default');
                                                                  $('#'+draged+" p").addClass('default');
                                                              }


                                                          }
                                                           edit_field(draged);

                                                    }
                                                    });
                                $('#box').css('width',data[2]['box_width']);
                                $('#box').css('height',data[2]['box_height']);
                                $('#box_height').val(data[2]['box_height']),
                                $('#box_width').val(data[2]['box_width']),
                                $('#design_id').val(data[0]['design']);
                                $('#update_design_id').val(data[0]['design']);
                             var j=2;
                            
                            
                                for(var i=0;i< data.length;i++){
                                    if(data[i]['label']=='store'){
                                        var left=parseInt($('#box').offset().left);
                                        var top=parseInt($('#box').offset().top);
                                        data[i]['top']= parseInt(data[i]['top'])*-1;
                                        $('#company').css('left',parseInt(data[i]['left'])+260);
                                        $('#company').css('top',data[i]['top']-190);
                                        $('#company p').removeClass('btn');
                                        $('#company p').removeClass('btn-default');
                                        $('#p_company').css('font-size',data[i]['size']);
                                        $('#p_company').css('color',"rgb("+data[i]['color']+")");
                                        $('#p_company').css('font-weight',data[i]['bold']);
                                        $('#company').css('transform',data[i]['transform']);
                                        $('#p_company').css('text-decoration',data[i]['under_line']);
                                    }
                                   else if(data[i]['label']=='price_label'){
                                        var left=parseInt($('#box').offset().left);
                                        var top=parseInt($('#box').offset().top);
                                       data[i]['top']= parseInt(data[i]['top'])
                                        console.log($('#price_label').offset().top);
                                        $('#price_label').css('left',parseInt(data[i]['left'])+260);
                                        $('#price_label').css('top',data[i]['top']-170);
                                        $('#price_label p').removeClass('btn');
                                        $('#price_label p').removeClass('btn-default');
                                        $('#p_price_label').css('font-size',data[i]['size']);
                                        $('#p_price_label').css('color',"rgb("+data[i]['color']+")");
                                        $('#p_price_label').css('font-weight',data[i]['bold']);
                                        $('#price_label').css('transform',data[i]['transform']);
                                        $('#p_price_label').css('text-decoration',data[i]['under_line']);
                                    }
                                   else if(data[i]['label']=='barcode'){
                                        var left=parseInt($('#box').offset().left);
                                        var top=parseInt($('#box').offset().top);
                                       data[i]['top']= parseInt(data[i]['top'])
                                      
                                        $('#barcode').css('left',parseInt(data[i]['left'])+260);
                                        $('#barcode').css('top',data[i]['top']-80);
                                        $('#barcode').removeClass('btn');
                                        $('#barcode').removeClass('btn-default');
                                        
                                    }
                                   else if(data[i]['label']=='product'){
                                        var left=parseInt($('#box').offset().left);
                                        var top=parseInt($('#box').offset().top);
                                      // data[i]['top']= parseInt(data[i]['top'])*-1;
                                      
                                        $('#product').css('left',parseInt(data[i]['left'])+260);
                                        $('#product').css('top',parseInt(data[i]['top'])-240);
                                        $('#p_product').css('font-size',data[i]['size']);
                                        $('#p_product').css('color',"rgb("+data[i]['color']+")");
                                        $('#p_product').css('font-weight',data[i]['bold']);
                                        $('#product').css('transform',data[i]['transform']);
                                        $('#p_product').css('text-decoration',data[i]['under_line']);
                                        $('#product p').removeClass('btn');
                                        $('#product p').removeClass('btn-default');
//                                        /  console.log();position: relative; left: 419px; top: -189px;
                                    }
                                   else if(data[i]['label']=='label'){
                                       var label_count=j
                                       
                                        $('#box').append('<div id="drag_label_'+label_count+'"    class="inputs push-left  "><p id="p_drag_label_'+label_count+'"  styel="height:30px;width:30px">'+data[i]['content']+'</p><a id="delete_actions_drag_label_'+label_count+'" class="field_none delete_action" href=javascript:remove_field("drag_label_'+label_count+'")><i class="icon icon-trash default"></i></a><a  id="edit_actions_drag_label_'+label_count+'" class="field_none edit_action" href=javascript:edit_field("drag_label_'+label_count+'")><i class="icon icon-edit default"></i></a></div>')
                                       var label='drag_label_'+label_count ;
                                       var label_p='p_drag_label_'+label_count ;
                                        $( "#drag_label_"+label_count ).draggable();
                                        $('#label_count').val(parseFloat(label_count+1));
                                        var left=parseInt($('#box').offset().left);
                                        var top=parseInt($('#box').offset().top);
                                      
                                        $('#'+label).css('left',parseInt(data[i]['left']));
                                       $('#'+label).css('top',parseInt(data[i]['top'])-20);
                                        $('#'+label_p).css('font-size',data[i]['size']);
                                        $('#'+label_p).css('color',"rgb("+data[i]['color']+")");
                                        $('#'+label_p).css('font-weight',data[i]['bold']);
                                        $('#'+label).css('transform',data[i]['transform']);
                                        $('#'+label).css('width',data[i]['width']);
                                        $('#'+label_p).css('text-decoration',data[i]['under_line']);
                                        $('#'+label_p).removeClass('btn');
                                        $('#'+label_p).removeClass('btn-default');
                                        j++;
//                                        /  console.log();position: relative; left: 419px; top: -189px;
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