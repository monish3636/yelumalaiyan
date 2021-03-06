<style type="text/css">
    .my_select{
         -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #FFFFFF;
    border-color: #C0C0C0 #D9D9D9 #D9D9D9;
    border-image: none;
    border-radius: 1px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
  
   .supplier_select{
        width: 200px !important;
    }
   .item_select{
        width: 600px !important;
    }
    table tr td {
/*        width: 120px !important;*/
    }
    .form-control{
         height: 24px;
   
    padding: 0 8px;
    }
    .input-group-addon{
         height: 24px;
   
    padding: 0 8px;
    }
    .select2-container .select2-choice{
        height: 24px;
      line-height: 1.7;
    }
    #dt_table_tools tr td + td + td + td + td + td + td + td + td {
  width: 120px !important;
}
.editable-address {
    display: block;
    margin-bottom: 5px;  
}

.editable-address span {
    width: 70px;  
    display: inline-block;
}
.editable-buttons {
    text-align: center;
}
.popover-title {
    
    text-align: center;
}
.popover-content {
    padding: 6px 24px !important;
    width: 277px!important;
}
.small_inputs input{
    font-size: 11px;
    padding: 0 1px !important;
}
  #selected_item_table  tr td:nth-child(7)  {
  width: 100px !important;
}
  #selected_item_table  tr td:nth-child(8)  {
  width: 150px !important;
}
  #dt_table_tools  tr td:nth-child(8)  {
  width: 100px !important;
}
</style>	
<script type="text/javascript">
   
    function posnic_stock_level_lists(){
        $("#user_list").show('slow');
        $('#update_stock_section').hide();
        $('#stock_level_lists').attr("disabled",'disabled');
    }
   

</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        
                        <a href="javascript:posnic_stock_level_lists()" class="btn btn-default" id="stock_level_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('stock_level') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('stock_level/stock_level_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('stock_level') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                         
                                          <th ><?php echo $this->lang->line('no') ?></th>
                                          <th ><?php echo $this->lang->line('item_name') ?></th>
                                          
                                          <th><?php echo $this->lang->line('sku') ?></th>
                                          <th><?php echo $this->lang->line('quantity') ?></th>
                                          <th><?php echo $this->lang->line('price') ?></th>
                                          <th><?php echo $this->lang->line('brand') ?></th>
                                          <th><?php echo $this->lang->line('item_department') ?></th>
                                          <th><?php echo $this->lang->line('category') ?></th>
                                          <th style="width: 120px"><?php echo $this->lang->line('action') ?></th>
                                         </tr>
                                      </thead>
                                      <tbody></tbody>
                                      </table>
                                  </div>
                             </div>
                          </div>
                <?php echo form_close(); ?>
             </div>
        </div>
</section>    

               
                
              
               


  
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>


  
<section id="update_stock_section" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('stock_level/upadate_pos_stock_level_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="stock_id" id="stock_id" >
   
                        
                         
                      <div class="row">
                          <div class="col col-lg-3"></div>
                      <div class="col col-lg-6">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('stock_level')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep" >
                                                            <label for="item_name" ><?php echo $this->lang->line('item_name') ?></label>													
                                                                     <?php $item_name=array('name'=>'item_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'item_name',
                                                                                       'disabled'=>'disabled',
                                                                                        'value'=>set_value('item_name'));
                                                                         echo form_input($item_name)?>
                                                           
                                                       </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep" >
                                                            <label for="sku" ><?php echo $this->lang->line('sku') ?></label>													
                                                                     <?php $sku=array('name'=>'sku',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'sku',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('sku'));
                                                                         echo form_input($sku)?>
                                                       </div>
                                               </div>
                                               
                                              
                                              
                                               </div>
                                           <div class="row">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep" >
                                                            <label for="brand" ><?php echo $this->lang->line('brand') ?></label>													
                                                                     <?php $brand=array('name'=>'brand',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'brand',
                                                                                       'disabled'=>'disabled',
                                                                                        'value'=>set_value('brand'));
                                                                         echo form_input($brand)?>
                                                           
                                                       </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep" >
                                                            <label for="category" ><?php echo $this->lang->line('category') ?></label>													
                                                                     <?php $category=array('name'=>'category',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'category',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('category'));
                                                                         echo form_input($category)?>
                                                       </div>
                                               </div>
                                               
                                              
                                              
                                               </div>
                                           <div class="row">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep" >
                                                            <label for="department" ><?php echo $this->lang->line('item_department') ?></label>													
                                                                     <?php $department=array('name'=>'department',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'department',
                                                                                       'disabled'=>'disabled',
                                                                                        'value'=>set_value('department'));
                                                                         echo form_input($department)?>
                                                           
                                                       </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                  
                                                   <div class="form_sep" >
                                                            <label for="quantity" ><?php echo $this->lang->line('stock')." ".$this->lang->line('quantity') ?></label>													
                                                                     <?php $quantity=array('name'=>'department',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'quantity',
                                                                           'disabled'=>'disabled',
                                                                                        'value'=>set_value('quantity'));
                                                                         echo form_input($quantity)?>
                                                           
                                                       </div>
                                               </div>
                                               
                                              
                                              
                                               </div>
                                           <div class="row">
                                                
                                               <div class="col col-sm-6" >
                                                   
                                                    <div class="form_sep" >
                                                            <label for="price" ><?php echo $this->lang->line('date') ?></label>													
                                                                     <?php $stock_date=array('name'=>'stock_date',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'stock_date',
                                                                                       'disabled'=>'disabled',
                                                                                        'value'=>set_value('price'));
                                                                         echo form_input($stock_date)?>
                                                       </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   
                                                    <div class="form_sep" >
                                                            <label for="price" ><?php echo $this->lang->line('price') ?></label>													
                                                                     <?php $price=array('name'=>'price',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'price',
                                                                                       'disabled'=>'disabled',
                                                                                        'value'=>set_value('price'));
                                                                         echo form_input($price)?>
                                                       </div>
                                               </div>
                                              
                                               
                                              
                                              
                                               </div>
                                           <div class="row">
                                                <div class="col col-sm-4" >
                                                   
                                               </div>
                                                <div class="col col-sm-4" >
                                                    <a class="btn btn-default" href="javascript:posnic_stock_level_lists()"><i class="icon icon-backward"></i> <?php echo $this->lang->line('back_to')." ".$this->lang->line('stock') ; ?></a>
                                               </div>
                                               
                                              
                                              
                                               
                                              
                                              
                                               </div>
                                           
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>   
                          </div>   
         
                      </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
        

      