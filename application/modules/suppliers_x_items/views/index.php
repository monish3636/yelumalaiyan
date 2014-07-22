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
 
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
    }
    }
     $(document).ready( function () {
         
        
          $('#parsley_reg #items').change(function() {
              if(document.getElementById('item_id_'+$('#parsley_reg #items').select2('data').id) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #items').select2('data').id){
                     $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #first_name').val(), { type: "warning" });  
              }else{
                   var guid = $('#parsley_reg #items').select2('data').id;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                $('#parsley_reg #cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #price').val($('#parsley_reg #items').select2('data').price);
                $('#parsley_reg #mrp').val($('#parsley_reg #items').select2('data').mrp);
                  $('#parsley_reg #quantity').focus();
          }
          });
          function format_item(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:59px'></img></p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
            }
          $('#parsley_reg #items').select2({
              dropdownCssClass : 'item_select',
                 formatResult: format_item,
                formatSelection: format_item,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/suppliers_x_items/search_items',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: -1,
                                term: term
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term
                        };
                    },
                    results: function (data) {
                      var results = [];
                      $.each(data, function(index, item){
                        results.push({
                          id: item.guid,
                          text: item.name,
                          value: item.code,
                          image: item.image,
                          brand: item.b_name,
                          category: item.c_name,
                          department: item.d_name,
                          cost: item.cost_price,
                          price: item.selling_price,
                          mrp: item.mrp,
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
         function format_supplier(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.phone+"</p> ";
            }
        $('#parsley_reg #first_name').change(function() {
                   var guid = $('#parsley_reg #first_name').select2('data').id;

                 $('#parsley_reg #first_name').val($('#parsley_reg #first_name').select2('data').text);
                 $('#parsley_reg #company').val($('#parsley_reg #first_name').select2('data').company);
                 $('#parsley_reg #email').val($('#parsley_reg #first_name').select2('data').email);
                 $('#parsley_reg #phone').val($('#parsley_reg #first_name').select2('data').phone);
                 $('#parsley_reg #category').val($('#parsley_reg #first_name').select2('data').category_name);
                 $('#edit_brand_form #supplier_guid').val(guid);
                  posnic_item_table(guid);
                
          });
          $('#parsley_reg #first_name').select2({
              dropdownCssClass : 'supplier_select',
               formatResult: format_supplier,
                formatSelection: format_supplier,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/suppliers_x_items/search_suppliers',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: -1,
                                term: term
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term
                        };
                    },
                    results: function (data) {
                      var results = [];
                      $.each(data, function(index, item){
                        results.push({
                          id: item.guid,
                          text: item.first_name,
                          company: item.company_name,
                          email: item.email,
                          category_name: item.category_name,
                          phone: item.phone
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
        
        
        
        
  
        
     });
     function refresh_item_table(){
     window.setTimeout(100);
       $("#selected_item_table").dataTable().fnDraw();
     }
function posnic_add_new(){
$("#parsley_reg #first_name").select2('data', {id:'',text: 'Search Supplier'});
    <?php if($this->session->userdata['suppliers_x_items_per']['add']==1){ ?>
      $("#user_list").hide();
    $('#edit_brand_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_suppliers').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#suppliers_lists').removeAttr("disabled");
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('suppliers_x_items');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_suppliers_lists(){
      $('#edit_brand_form').hide('hide');
      $('#add_customer_details_form').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_suppliers').removeAttr("disabled");
      $('#suppliers_lists').attr("disabled",'disabled');
}
function clear_add_suppliers(){
      $("#posnic_user_2").trigger('reset');
}
function reload_update_user(){
    var id=$('#guid').val();
    supplier_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_suppliers" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                   
                       
                        <a href="javascript:posnic_suppliers_lists()" class="btn btn-default" id="suppliers_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('suppliers') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('suppliers/suppliers_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('suppliers') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('name') ?></th>
                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                           <th><?php echo $this->lang->line('category') ?></th>
                                          <th><?php echo $this->lang->line('phone') ?></th>
                                          <th><?php echo $this->lang->line('email') ?></th>
                                         
                                      
                                          <th><?php echo $this->lang->line('status') ?></th>
                                          <th><?php echo $this->lang->line('action') ?></th>
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
<script type="text/javascript">
function add_new_q(e){
    if($('#parsley_reg #item_id').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #quantity').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #cost').focus();
             //document.getElementById("project").focus();
        }
         if (unicode!=27){
        }
       else{
           //document.getElementById("item_cost").focus();
             $("#parsley_reg #items").focus();
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $("#parsley_reg #items").focus();

        }

    }
function add_new_cost(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #cost').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #price').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #quantity').focus();
        }
        }
    }else{
         $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    
       $('#parsley_reg #items').focus();
    }
    }
function add_new_price(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #price').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #mrp').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #cost').focus();
        }
        }
    }else{
       $('#parsley_reg #items').focus();
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    }
    }
 function add_new_mrp(e){
       if($('#parsley_reg #item_id').val()!=""){
   
        var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #cost').val() && $('#parsley_reg #price').val()){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ 
            if($('#parsley_reg #item_id').val()!=""){
            
                            copy_items();
                            
       }else{
                                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
           $('#parsley_reg #items').focus();
        }
       }
         if (unicode!=27){
        }
       else{
               
               $('#parsley_reg #price').focus();
        }
        }
        }else{
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
        $('#parsley_reg #items').focus();
    }
    }
    function copy_items(){
 if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #cost').val()!="" && $('#parsley_reg #price').val()!="" && $('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!=""){
   if($('#parsley_reg #cost').val()<$('#parsley_reg #price').val()) { 
   if(parseFloat($('#parsley_reg #mrp').val())>=parseFloat($('#parsley_reg #price').val())) {
     
if(document.getElementById('item_id_'+$('#parsley_reg #item_id').val())){

  var  guid=$('#parsley_reg #seleted_row_id').val();
  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  var  cost=$('#parsley_reg #cost').val();
  var  price=$('#parsley_reg #price').val();
  var  mrp=$('#parsley_reg #mrp').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  supplier=$('#parsley_reg #supplier_guid').val();
  
    var cost = parseFloat(cost);
    cost=cost.toFixed(point); 
    
    var price = parseFloat(price);
    price=price.toFixed(point); 
    
    var mrp = parseFloat(mrp);
    mrp=mrp.toFixed(point); 
  
  
    $.ajax ({
                            url: "<?php echo base_url('index.php/suppliers_x_items/update_items')?>",
                            data: {
                        guid:guid,
                        supplier:supplier,
                        item:items_id,
                        quty:quty,
                        cost:cost,
                        price:price,
                        mrp:mrp
                            },
                            type:'POST',
                            complete: function(response) {
                                  if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                      $("#selected_item_table").dataTable().fnDraw();
                                     clear_inputs();
                                      $('#parsley_reg #diabled_item').val('');
                                      $('#parsley_reg #seleted_row_id').val('');
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl(' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>'+$('#parsley_reg #first_name').val(), { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('suppliers_x_items');?>', { type: "error" });                           
                                    }
                       }
                 });
}else{
   

  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  var  cost=$('#parsley_reg #cost').val();
  var  price=$('#parsley_reg #price').val();
  var  mrp=$('#parsley_reg #mrp').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  supplier=$('#parsley_reg #supplier_guid').val();
   var cost = parseFloat(cost);
    cost=cost.toFixed(point); 
    
    var price = parseFloat(price);
    price=price.toFixed(point); 
    
    var mrp = parseFloat(mrp);
    mrp=mrp.toFixed(point); 
    $.ajax ({
                            url: "<?php echo base_url('index.php/suppliers_x_items/add_items')?>",
                            data: {
                        supplier:supplier,
                        item:items_id,
                        quty:quty,
                        cost:cost,
                        price:price,
                        mrp:mrp
                            },
                            type:'POST',
                            complete: function(response) {
                                  if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                     $("#selected_item_table").dataTable().fnDraw();
                                     clear_inputs();
                                     
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl(' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>'+$('#parsley_reg #first_name').val(), { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('suppliers_x_items');?>', { type: "error" });                           
                                    }
                       }
                 });
      }  
        }else{
       
          $.bootstrapGrowl('<?php echo $this->lang->line('Selling Price Must Less Than MRP price');?>', { type: "warning" });          
       $('#parsley_reg #mrp').focus();
        }
        }else{
      
         $.bootstrapGrowl('<?php echo $this->lang->line('Cost Must Less Than Sell price');?>', { type: "warning" }); 
        $('#parsley_reg #cost').focus();
        }
        }else if($('#parsley_reg #quantity').val()==""){
            $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
           $('#parsley_reg #quantity').focus();
        }else
        {
         $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
           $('#parsley_reg #items').selec2('focus');
        }
}
function clear_inputs(){
  $('#parsley_reg #item_name').val('');
  $('#parsley_reg #sku').val('');
  $('#parsley_reg #quantity').val('');
  $('#parsley_reg #cost').val('');
  $('#parsley_reg #price').val('');
  $('#parsley_reg #mrp').val('');
  $('#parsley_reg #item_id').val('')
    $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
}
</script>

<section id="edit_brand_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('suppliers/upadate_pos_suppliers_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-2" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('supplier')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="first_name" ><?php echo $this->lang->line('first_name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                        
                                                  </div>
                                               </div><input type="hidden" name='supplier_guid' id='supplier_guid'>
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                    <div class="form_sep">
                                                            <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'company',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('company'));
                                                                         echo form_input($last_name)?>
                                                       </div>
                                                   </div>
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                    <div class="form_sep">
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
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                      <div class="form_sep">
                                                                 <label for="email" ><?php echo $this->lang->line('email') ?></label>
                                                               
                                                                           <?php $email=array('name'=>'email',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'email',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                                
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-12" style="margin-top: 10px">
                                                        <div class="form_sep">
                                                                 <label for="phone" ><?php echo $this->lang->line('phone') ?></label>
                                                               
                                                                           <?php $phone=array('name'=>'phone',
                                                                                            'class'=>' form-control',
                                                                                            'disabled'=>'disabled',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                                
                                                    </div> 
                                                     </div>
                                               </div>
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         
                         
          </div>
                    <div class="col col-lg-10">
                        <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('items')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                              <div class="row" style="padding-top: 20px;padding-bottom: 20px">
                                 
                                       <div class="col col-sm-2" style="padding-left: 25px">
                                       
                                             <label for="items" class="req"><?php echo $this->lang->line('items') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $items=array('name'=>'items',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'items',
                                                                                    'value'=>set_value('items'));
                                                                     echo form_input($items)?>
                                                  </div>
                                         
                                                 <input type="hidden" id='diabled_item' class="form-control">
                                                 
                                                 <input type="hidden" name="item_id" id="item_id">
                                           <input type="hidden" name="item_name" id="item_name">
                                           <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                  </div>
                                                <div class="col col-sm-10" style="padding-right: 25px;">
                                                  <table><tr><td>
                                               
                                                   <div class="form_sep">
                                                            
                                                                <label for="sku" ><?php echo $this->lang->line('sku') ?></label>

                                                                 <?php $sku=array('name'=>'sku',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'sku',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('sku'));
                                                                             echo form_input($sku)?>
                                                        </div>
                                             </td><td>
                                                  <div class="col col-lg-12">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'quantity',
                                                                                            'placeholder'=>$this->lang->line('Set 0 To Unlimit'),
                                                                     'onKeyPress'=>"add_new_q(event); return numbersonly(event)",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                </td><td>
                                                     <div class="col col-lg-12">
                                                   <div class="form_sep">
                                                            
                                                                <label for="cost" ><?php echo $this->lang->line('cost') ?></label>

                                                                 <?php $cost=array('name'=>'cost',
                                                                                            'class'=>' form-control small_length',
                                                                                            'id'=>'cost',
                                                                     'onKeyPress'=>"add_new_cost(event); return numbersonly(event)",
                                                                                            'value'=>set_value('cost'));
                                                                             echo form_input($cost)?>
                                                        </div>
                                                        </div>
                                               </td><td>
                                                    <div class="col col-lg-12">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" ><?php echo $this->lang->line('price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length',
                                                                                            'id'=>'price',
                                                                   'onKeyPress'=>"add_new_price(event); return numbersonly(event)",
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                            </td><td>
                                                <div class="col col-lg-12">
                                                   <div class="form_sep">
                                                            
                                                                <label for="mrp" ><?php echo $this->lang->line('mrp') ?></label>

                                                                 <?php $mrp=array('name'=>'mrp',
                                                                                            'class'=>' form-control ',
                                                                                            'id'=>'mrp',
                                                                     'onKeyPress'=>"add_new_mrp(event); return numbersonly(event)",
                                                                                            'value'=>set_value('mrp'));
                                                                             echo form_input($mrp)?>
                                                        </div>
                                                    </div>
                                               </td>
                                               <td>  
                                                    <label for="mrp" ><?php echo $this->lang->line('save') ?></label>
                                                    <a class="btn btn-default" href="javascript:copy_items()"><i class="icon icon-save"></i></a>
                                                  
                                                  </td>
                                               <td>  
                                                    <label for="mrp" ><?php echo $this->lang->line('clear') ?></label>
                                                  
                                                   <a class="btn btn-default pull-right" href="javascript:clear_inputs()"><i class="icon icon-refresh"></i></a>
                                                 </td>
                                               </tr>
                                               
                                               
                                               </table>
                                          
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                        <div class="row" style="margin-top: 5px"><input type="hidden" value="0" id='sl_number'>
                         <nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                      
                        <a href="javascript:posnic_group_item_deactive()" id="1active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_item_active()" class="btn btn-default" id="1deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_item_delete()" class="btn btn-default" id="1delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('suppliers') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table table-striped dataTable ">
                                    <thead>
                                        <tr>
                                            
                                     <th><?php echo $this->lang->line('sl_no') ?></th>
                                    
                                    <th><?php echo $this->lang->line('select') ?></th>
                                
                                    <th><?php echo $this->lang->line('name') ?></th>
                                        <th><?php echo $this->lang->line('sku') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('price') ?></th>
                                    <th><?php echo $this->lang->line('mrp') ?></th>
                                    <th><?php echo $this->lang->line('status') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody >
                                        
                                    </tbody>
                                </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
          </div>  </div>  </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
                <script type="text/javascript">
                    function posnic_group_active(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('suppliers_x_items');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/suppliers/active',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }
                  

                      }    
                      }
                    function posnic_group_item_active(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('suppliers_x_items');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>index.php/suppliers_x_items/item_active',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                        $("#selected_item_table").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }
                  

                      }    
                      }
                    function posnic_item_delete(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('items');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.items_form;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/suppliers_x_items/item_delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('items')." ".$this->lang->line('deleted');?>', { type: "error" });
                                        $("#selected_item_table").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      }
                    
                    
                    
                    function posnic_group_deactive(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('suppliers_x_items');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/suppliers/deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    function posnic_group_item_deactive(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('suppliers_x_items');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>index.php/suppliers_x_items/item_deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#selected_item_table").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    
                </script>
        

      