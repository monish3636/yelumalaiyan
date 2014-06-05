<style type="text/css">
    .my_select{
         -moz-bdecomposition-bottom-colors: none;
    -moz-bdecomposition-left-colors: none;
    -moz-bdecomposition-right-colors: none;
    -moz-bdecomposition-top-colors: none;
    background-color: #FFFFFF;
    bdecomposition-color: #C0C0C0 #D9D9D9 #D9D9D9;
    bdecomposition-image: none;
    bdecomposition-radius: 1px;
    bdecomposition: 1px solid rgba(0, 0, 0, 0.2);
    bdecomposition-style: solid;
    bdecomposition-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
  
   .items_select{
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
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function save_new_decomposition(){
         <?php if($this->session->userdata['decomposition_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/decomposition/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('decomposition').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_decomposition_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #decomposition_number').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('decomposition');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                     $('#parsley_reg #items').select2('open');
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                       
                    <?php }?>
    }
    function update_decomposition(){
         <?php if($this->session->userdata['decomposition_per']['edit']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/decomposition/update')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('decomposition').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_decomposition_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #decomposition_number').val()+' <?php echo $this->lang->line('items').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('decomposition');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                     $('#parsley_reg #items').select2('open');
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items');?>', { type: "error" });                       
                    <?php }?>
    }
    
     $(document).ready( function () {
         
       
          $('#parsley_reg #decomposition_type').change(function() {
              if(document.getElementById('new_item_row_id_'+$('#parsley_reg #decomposition_type').select2('data').item) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #decomposition_type').select2('data').item){
                     $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #decomposition_type').val(), { type: "warning" });  
                       $('#parsley_reg #decomposition_type').select2('open');
              }else{
                var guid = $('#parsley_reg #decomposition_type').select2('data').item;
                
                       
                $('#parsley_reg #decomposition_guid').val(guid);
                $('#parsley_reg #formula').val($('#parsley_reg #decomposition_type').select2('data').formula);
                $('#parsley_reg #decomposition_value').val($('#parsley_reg #decomposition_type').select2('data').value);
               
          }
          });
         
          $('#parsley_reg #decomposition_type').select2({
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('decomposition_type') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/decomposition/search_decomposition_type/',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: 2,
                                term: term,
                               
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term,
                        };
                    },
                    results: function (data) {
                      var results = [];
                      
                      $.each(data, function(index, item){
                        results.push({
                          id: item.guid+item.type_name,
                          item: item.guid,
                          text: item.type_name,
                          value:item.value,
                          formula:item.formula
                         ,
                        });
                      });   if($('#items_guid').val()==""){
                          $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Customer');?>', { type: "warning" }); 
     $('#parsley_reg #items').select2('close');   
    $('#parsley_reg #select_item').select2('open');
        
                      }
                      return {
                       
                          results: results
                      };
                    }
                }
            });
         function format_items(sup) {
             if (!sup.id) return sup.text;
            
            if(sup.uom==0){
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
            }else{
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+parseFloat(sup.price)/parseFloat(sup.no_of_unit)+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
            }
            }
        $('#parsley_reg #select_item').change(function() {           
                var guid = $('#parsley_reg #select_item').select2('data').item;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #item_sku').val($('#parsley_reg #select_item').select2('data').value);              
                $('#parsley_reg #demo_item_stock').val($('#parsley_reg #select_item').select2('data').quty);
                $('#parsley_reg #item_stock').val($('#parsley_reg #select_item').select2('data').quty);
                $('#parsley_reg #demo_item_weight_stock').val(parseFloat($('#parsley_reg #select_item').select2('data').quty)*parseFloat($('#parsley_reg #select_item').select2('data').weight));
                $('#parsley_reg #item_weight_stock').val(parseFloat($('#parsley_reg #select_item').select2('data').quty)*parseFloat($('#parsley_reg #select_item').select2('data').weight));
              
                
                window.setTimeout(function ()
                {

                    $('#parsley_reg #decomposition_date').focus();
                }, 0);
         
             
          });
          $('#parsley_reg #select_item').select2({
              dropdownCssClass : 'item_select',
               formatResult: format_items,
                formatSelection: format_items,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                   url: '<?php echo base_url() ?>index.php/decomposition/search_items/',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: 2,
                                term: term,
                               
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term,
                                     suppler:$('#parsley_reg #items_guid').val()
                        };
                    },
                    results: function (data) {
                      var results = [];
                      
                      $.each(data, function(index, item){
                        results.push({
                          id: item.i_guid+item.price,
                          item: item.i_guid,
                          sid: item.guid,
                          text: item.name,
                          value: item.code,
                          image: item.image,
                          brand: item.b_name,
                          category: item.c_name,
                          department: item.d_name,
                          quty: item.quty,
                          price: item.price,
                          tax_type: item.tax_type_name,
                          tax_value: item.tax_value,
                          tax_Inclusive : item.tax_Inclusive ,
                          start : item.start_date ,
                          end : item.end_state ,
                          discount : item.discount ,
                          uom : item.uom ,
                          weight : item.weight ,
                        });
                      });   
                      return {
                       
                          results: results
                      };
                    }
                }
            });
        
        
        
        
  
        
     });
    
function posnic_add_new(){
refresh_items_table();

$('#select_item').select2('enable');
$('#update_button').hide();
$('#save_button').show();
$('#update_clear').hide();
$('#save_clear').show();
$('#total_amount').val('');
$('#items_id').val('');
$('#items_guid').val('');
$("#parsley_reg").trigger('reset');
$('#deleted').remove();
$('#parent_items').append('<div id="deleted"></div>');
$('#newly_added').remove();
$('#parent_items').append('<div id="newly_added"></div>');
$("#parsley_reg #select_item").select2('data', {id:'',text: '<?php echo $this->lang->line('search').' '.$this->lang->line('item') ?>'});
    <?php if($this->session->userdata['decomposition_per']['add']==1){ ?>
             $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/decomposition/decomposition_number/",                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 
                                
                                 $('#parsley_reg #decomposition_number').val(data[0][0]['prefix']+data[0][0]['max']);
                                 $('#parsley_reg #demo_decomposition_number').val(data[0][0]['prefix']+data[0][0]['max']);
                             }
                             });
            
            
            
      $("#user_list").hide();
    $('#add_new_decomposition').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_decomposition').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#decomposition_lists').removeAttr("disabled");
     
         window.setTimeout(function ()
    {
       
        $('#parsley_reg #select_item').select2('open');
    }, 500);
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('decomposition');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_decomposition_lists(){
      $('#edit_decomposition_form').hide('hide');
      $('#add_new_decomposition').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_decomposition').removeAttr("disabled");
      $('#decomposition_lists').attr("disabled",'disabled');
}
function clear_add_decomposition(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
}
function clear_update_decomposition(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
      edit_function($('#decomposition_guid').val());
}
function reload_update_user(){
    var id=$('#guid').val();
    items_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_decomposition" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                     
                        <a href="javascript:decomposition_group_approve()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('approve') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_decomposition_lists()" class="btn btn-default" id="decomposition_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('decomposition') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('decomposition/decomposition_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('decomposition') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('decomposition_number') ?></th>
                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                           <th><?php echo $this->lang->line('name') ?></th>
                                          <th><?php echo $this->lang->line('decomposition_date') ?></th>
                                          <th><?php echo $this->lang->line('number_of_items') ?></th>
                                          <th><?php echo $this->lang->line('total_amount') ?></th>
                                         
                                      
                                          <th><?php echo $this->lang->line('status') ?></th>
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
<script type="text/javascript">
 
    function discounte_amount(){
    if(parseFloat($('#parsley_reg #hidden_total_price').val())>0){
        total=parseFloat($('#parsley_reg #hidden_total_price').val());
        discount=(total*parseFloat($('#parsley_reg #discount').val()))/100;
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())-discount);
       
        round_amt=parseFloat($('#parsley_reg #round_amt').val());
        freight=parseFloat($('#parsley_reg #freight').val())
        if(freight==""){freight=0;}
        if(round_amt==""){round_amt=0;}
         $('#parsley_reg #discount_amt').val(discount);
        if (isNaN($('#parsley_reg #total_price').val())) 
    $('#parsley_reg #total_price').val('00');
    
        if (isNaN($('#parsley_reg #discount_amt').val())) 
    $('#parsley_reg #discount_amt').val('0');
        if (isNaN($('#parsley_reg #round_amt').val())) 
    $('#parsley_reg #round_amt').val('00');
        if (isNaN($('#parsley_reg #freight').val())) 
    $('#parsley_reg #dfreight').val('00');;
    }
    var item_dis=0;
  
   
    if($('#parsley_reg #discount').val()==0 || isNaN($('#parsley_reg #discount').val())){
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())+round_amt+freight);
    }
    new_grand_total();
    total=parseFloat($('#parsley_reg #hidden_total_price').val());
    if(total=="" || total==0 || isNaN(total)){
        $('#parsley_reg #total_price').val("0");
    }
}
function new_decomposition_date(e){
    if($('#parsley_reg #items_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #decomposition_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #expiry_date').focus();
            
        }
         if (unicode!=27){
        }
       else{
        
           $('#parsley_reg #select_item').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Customer');?>', { type: "warning" }); 
         $('#parsley_reg #select_item').select2('open');

        }

    }
function new_expiry_date(e){
    if($('#parsley_reg #items_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #expiry_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
                  window.setTimeout(function ()
    {
           $('#parsley_reg #id_discount').focus();
            }, 0);
           
           
        }
         if (unicode!=27){
        }
       else{
          
           $('#parsley_reg #decomposition_date').focus();
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Customer');?>', { type: "warning" }); 
         $('#parsley_reg #select_item').select2('open');

        }

    }





function add_new_quty(e){
    if($('#parsley_reg #item_id').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #quantity').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          copy_items();
         
        }
         if (unicode!=27){
        }
       else{
           
           $('#parsley_reg #items').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $('#parsley_reg #items').select2('open');

        }

    }

    function net_amount(){
      if(isNaN($('#parsley_reg #discount').val())){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
        if(isNaN($('#parsley_reg #stock_quty').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #stock_quty').val())){
                $('#parsley_reg #stock_quty').val(0);
            }else{
                $('#parsley_reg #quantity').val(0);
            }
        }else{
           
           if(isNaN($('#parsley_reg #discount').val())){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
            if($('#discount').val()==""){
                $('#parsley_reg #discount').val(0);
                $('#parsley_reg #item_discount').val(0);
            }
         
                 if($('#parsley_reg #discount').val()!="" && $('#parsley_reg #discount').val()!=0){
                       
                        $('#tax').val((parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val()))/100));
                        var num = parseFloat($('#tax').val());
                        $('#tax').val(num.toFixed(point));
                        var discount=parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*parseFloat($('#parsley_reg #discount').val())/100;
                          if($('#tax_Inclusive').val()==1){
                              
                        $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()-parseFloat(discount)+parseFloat($('#tax').val()));
                        }else{
                             $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()-parseFloat(discount));
                        }
                        var num = parseFloat($('#total').val());
                        $('#total').val(num.toFixed(point));
                        $('#item_discount').val(discount);
                        var num = parseFloat($('#item_discount').val());
                        $('#item_discount').val(num.toFixed(point));

                 }else{
                     $('#tax').val((parseFloat($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val())*(parseFloat($('#tax_value').val()))/100));
                        var num = parseFloat($('#tax').val());
                        $('#tax').val(num.toFixed(point));
                       
                          if($('#tax_Inclusive').val()==1){
                              
                        $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val()+parseFloat($('#tax').val()));
                        }else{
                             $('#parsley_reg #total').val($('#parsley_reg #price').val()*$('#parsley_reg #quantity').val());
                        }
                        var num = parseFloat($('#total').val());
                        $('#total').val(num.toFixed(point));
                        $('#item_discount').val(discount);
                        var num = parseFloat($('#item_discount').val());
                        $('#item_discount').val(num.toFixed(point));
                 }
                 
                   
                    
            
        }
        if(isNaN($('#parsley_reg #tax').val())){
                
                $('#parsley_reg #tax').val(0);
            }
        if(isNaN($('#parsley_reg #item_discount').val())){
                
                $('#parsley_reg #item_discount').val(0);
            }
    }
function copy_items(){

 if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #price').val()!=""   && $('#parsley_reg #quantity').val()!=""){
 
  
      
if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_id').val())){

  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
      free=0;
  }


  var  price=$('#parsley_reg #price').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  tax_value=$('#parsley_reg #tax_value').val();
  var  per=$('#parsley_reg #discount').val();
  var  discount=((parseFloat(quty)*parseFloat(price))*$('#parsley_reg #discount').val())/100;
  var  tax_type=$('#parsley_reg #tax_type').val();
  var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
  var tax=(parseFloat(quty)*parseFloat(price))*tax_value/100;
    if(tax_Inclusive==1){
     total= (parseFloat(quty)*parseFloat(price))+tax-discount;
     type='Exc';
  }else{
      type='Inc';
       total= (parseFloat(quty)*parseFloat(price))-discount;
  }
  if(discount==""){
    discount=0;
    }
  if(per==""){
    per=0;
    }
  
    var tax=((parseFloat(quty)*parseFloat(price))*tax_value/100);
    tax=tax.toFixed(point);
    total=total.toFixed(point);
  ///$('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()).remove();
 var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val();
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(2)').html(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(3)').html(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(4)').html(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(5)').html(price);
 
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(7)').html(discount);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(8)').html(total);

  $('#newly_added #new_item_id_'+items_id).val(items_id);
  $('#newly_added #new_item_quty_'+items_id).val(quty);
  $('#newly_added #new_item_price_'+items_id).val(price);
  $('#newly_added #new_item_total_'+items_id).val(parseFloat(quty)*parseFloat(price));
  $('#newly_added #new_item_discount_'+items_id).val(discount);
  $('#newly_added #new_item_discount_per_'+items_id).val(per);
  $('#newly_added #new_item_tax_'+items_id).val(tax);
  $('#newly_added #new_item_total'+items_id).val(total);

  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_id').val(items_id);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_name').val(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sku').val(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_quty').val(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_price').val(price);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax').val(tax);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_type').val(tax_type);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_value').val(tax_value);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_tax_inclusive').val(tax_Inclusive);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount').val(discount);
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_discount_per').val(per);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sub_total').val(parseFloat(quty)*parseFloat(price));
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val(total);
    $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
    
    if (isNaN($("#parsley_reg #total_amount").val())) {
    $("#parsley_reg #total_amount").val(0)    
    }
   
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)



if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val(total-parseFloat(old_total));
}else{
   
     if(total!=old_total){
     
         var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
          amount=amount.toFixed(point);
    $('#parsley_reg #total_amount').val();
  $('#parsley_reg #total_amount').val(amount)
     }
}
 
if(tax_Inclusive==1){
if($('#parsley_reg #total_tax').val()==0){
      $('#parsley_reg #total_tax').val(tax);
     
}else{
    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())-$('#parsley_reg #old_tax').val()+parseFloat(tax));
}
}
if($('#parsley_reg #total_item_discount_amount').val()==0){
      $('#parsley_reg #total_item_discount_amount').val(discount);
     
}else{
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())-$('#parsley_reg #old_discount').val()+parseFloat(discount));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   
    
    
    
    clear_inputs();
    $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
}else{
   

  var  name=$('#parsley_reg #item_name').val();
  var  stock=$('#parsley_reg #stock_id').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
  var  free=0;
  }
  
  var  price=$('#parsley_reg #price').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  items=$('#parsley_reg #items_guid').val();
  var  tax_value=$('#parsley_reg #tax_value').val();
  
  var  tax_type=$('#parsley_reg #tax_type').val();
  var  tax_Inclusive=$('#parsley_reg #tax_Inclusive').val();
  var  discount=((parseFloat(quty)*parseFloat(price))*$('#parsley_reg #discount').val())/100;
  var  per=$('#parsley_reg #discount').val();
  var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
  var total;
  var type;
  if(tax_Inclusive==1){
     total= (parseFloat(quty)*parseFloat(price))+tax-discount;
     type='Exc';
  }else{
      type='Inc';
       total= (parseFloat(quty)*parseFloat(price))-discount;
  }
  if(discount==""){
    discount=0;
    }
  if(per==""){
    per=0;
    }
    
   $('#newly_added').append('<div id="newly_added_items_list_'+items_id+'"> \n\
\n\
<input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+items_id+'">\n\
<input type="hidden" name="new_item_stock_id[]" value="'+stock+'"  id="new_item_stock_id_'+items_id+'">\n\
<input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+items_id+'"> \n\
<input type="hidden" name="new_item_discount[]" value="'+per+'" id="new_item_discount_id_'+items_id+'"> \n\
<input type="hidden" name="new_item_price[]" value="'+price+'" id="new_item_price_'+items_id+'">\n\
<input type="hidden" name="new_item_total[]"  value="'+parseFloat(quty)*parseFloat(price)+'" id="new_item_total_'+items_id+'">\n\
</div>');
 
   total=total.toFixed(point);
   
    tax=tax.toFixed(point);
    discount=discount.toFixed(point);
  
   var addId = $('#selected_item_table').dataTable().fnAddData( [
      null,
      name,
      sku,
      quty,
      price,
      tax+' : '+tax_type+'('+type+')',
      discount,
      total,
     
'<input type="hidden" name="index" id="index">\n\
<input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
<input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
<input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
<input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
<input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
<input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
<input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
<input type="hidden" name="items_decomposition_guid[]" value="" id="items_decomposition_guid">\n\
<input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
<input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
<input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
<input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
<input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
<input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
<input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
        <a href=javascript:edit_decomposition_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_decomposition_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
theNode.setAttribute('id','new_item_row_id_'+items_id)
    $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
     if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val(total);
     
}else{
    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total));
}
if(tax_Inclusive==1){
if($('#parsley_reg #total_tax').val()==0){
      $('#parsley_reg #total_tax').val(tax);
     
}else{
    $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())+parseFloat(tax));
}
}
if($('#parsley_reg #total_item_discount_amount').val()==0){
      $('#parsley_reg #total_item_discount_amount').val(discount);
     
}else{
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())+parseFloat(discount));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   
    
    
    clear_inputs();
    $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
      }  
        
        
        }else{
         if($('#parsley_reg #item_id').val()==""){
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
           $('#parsley_reg #items').select2('open');
        }
          else if($('#parsley_reg #quantity').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
           $('#parsley_reg #quantity').focus();
        }
        else{
             $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
        }
        }
      new_grand_total(); 
      
      $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
}
function edit_decomposition_item(guid){
    $('#parsley_reg #item_name').val($('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val());
    $('#parsley_reg #sku').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sku').val());
    $('#parsley_reg #items_quty').val($('#selected_item_table #new_item_row_id_'+guid+' #item_limit').val());
    $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
    $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #items_price').val());
    $('#parsley_reg #discount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val());
    $('#parsley_reg #tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax').val());
    $('#parsley_reg #tax_type').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_type').val());
    $('#parsley_reg #tax_value').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val());
    $('#parsley_reg #tax_Inclusive').val($('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val());
    
    //old 
     $('#parsley_reg #old_tax').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val()/100);
      $('#parsley_reg #old_discount').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val()*$('#selected_item_table #new_item_row_id_'+guid+' #items_discount_per').val()/100);
   
    $('#parsley_reg #item_id').val(guid);
    $('#parsley_reg #total').val($('#selected_item_table #new_item_row_id_'+guid+' #items_total').val());
     if( $('#parsley_reg #tax_Inclusive').val()==1){
        $('#tax_label').text('Tax(Exc)');
    }else{
        $('#tax_label').text('Tax(Inc)');   
    }
     $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });

         net_amount();
         
        

}
function delete_decomposition_item(guid){
    var net=$('#selected_item_table #new_item_row_id_'+guid+' #items_total').val();
    var dis=$('#selected_item_table #new_item_row_id_'+guid+' #items_discount').val();
    var items_tax_inclusive=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_inclusive').val();
    if(items_tax_inclusive==1){
        var quty=$('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val();
        var price=$('#selected_item_table #new_item_row_id_'+guid+' #items_price').val();
        var value=$('#selected_item_table #new_item_row_id_'+guid+' #items_tax_value').val();
        var tax=parseFloat(quty)*parseFloat(price)*parseFloat(value)/100;
         $('#parsley_reg #total_tax').val(parseFloat($('#parsley_reg #total_tax').val())-tax);
    }
    
    $('#parsley_reg #total_item_discount_amount').val(parseFloat($('#parsley_reg #total_item_discount_amount').val())-parseFloat(dis));
    var total=$("#parsley_reg #total_amount").val();
    $("#parsley_reg #total_amount").val(parseFloat(total)-parseFloat(net));
    $("#parsley_reg #demo_total_amount").val(parseFloat(total)-parseFloat(net));
    var num = parseFloat($('#demo_total_amount').val());
    $('#demo_total_amount').val(num.toFixed(point));
    var num = parseFloat($('#total_amount').val());
    $('#total_amount').val(num.toFixed(point));
   
    $("#parsley_reg #total_amount").val()
     var decomposition=$('#selected_item_table #new_item_row_id_'+guid+' #items_decomposition_guid').val();
      $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+decomposition+'">');
    var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
     var anSelected =  $("#selected_item_table").dataTable();
       anSelected.fnDeleteRow(index-1);
    if(document.getElementById('newly_added_items_list_'+guid)){
        $('#newly_added_items_list_'+guid).remove();
    }
    if($("#parsley_reg #total_amount").val()==0 || $("#parsley_reg #total_amount").val()==""){
        $("#parsley_reg #demo_grand_total").val(0)
        $("#parsley_reg #grand_total").val(0)
    }
}
function clear_inputs(){
  $('#parsley_reg #item_name').val('');
  $('#parsley_reg #sku').val('');
  $('#parsley_reg #quantity').val('');
  $('#parsley_reg #free').val('');
  $('#parsley_reg #total').val('');
  $('#parsley_reg #sub_total').val('');
  $('#parsley_reg #price').val('');
  $('#parsley_reg #mrp').val('');
  $('#parsley_reg #tax').val('');
  $('#parsley_reg #tax_value').val('');
  $('#parsley_reg #tax_type').val('');
  $('#parsley_reg #tax_Inclusive').val('');
  $('#parsley_reg #extra_elements').val('');
  $('#parsley_reg #item_id').val('')
  $('#parsley_reg #dummy_discount_amount').val('')
  $('#parsley_reg #hidden_dis_amt').val('')
  $('#parsley_reg #hidden_dis').val('')
  $('#parsley_reg #tax_label').text('<?php echo $this->lang->line('tax')?>');
  $('#parsley_reg #dummy_discount').val('')
  $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
  $('#parsley_reg #items').select2('open');
   
         window.setTimeout(function ()
    {
       //$('#parsley_reg #delivery_date').focus();
       $('#parsley_reg #tax').val(0);
    $('#parsley_reg #item_discount').val(0);
    }, 0);
}
function new_grand_total(){
         if(parseFloat($("#parsley_reg #total_amount").val())>0){
var discount=parseFloat($("#parsley_reg #discount_amount").val());
var frieight=parseFloat($("#parsley_reg #freight").val());
var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
    if (isNaN(discount) || discount=="") {
    discount=0;}
        if (isNaN(frieight)|| frieight=="") {
    frieight=00;}
        if (isNaN(round_amt)|| round_amt=="") {
    round_amt=00;}
    if($('#parsley_reg #item_discount').val()==0 || isNaN($('#parsley_reg #item_discount').val())){
       var item_dis=0;
    }else{
        item_dis=parseFloat($('#parsley_reg #total_amount').val())*parseFloat($('#parsley_reg #item_discount').val())/100;
         var item_dis = parseFloat(item_dis);
        $('#demo_item_discount_amount').val(item_dis.toFixed(point));
        $('#item_discount_amount').val(item_dis.toFixed(point));
    }

     $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt-item_dis);
     $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt-item_dis);
       
        var num = parseFloat($('#demo_grand_total').val());
    $('#demo_grand_total').val(num.toFixed(point));
    
    var num = parseFloat($('#grand_total').val());
    $('#grand_total').val(num.toFixed(point));
    var num = parseFloat($('#demo_total_amount').val());
    $('#demo_total_amount').val(num.toFixed(point));
    var num = parseFloat($('#total_amount').val());
    $('#total_amount').val(num.toFixed(point));
        }
   if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
    
}

</script>

  
<section id="add_new_decomposition" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('decomposition/upadate_pos_decomposition_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('decomposition')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep items_select_2">
                                                        <label for="select_item" ><?php echo $this->lang->line('items') ?></label>													
                                                                  <?php $select_item=array('name'=>'select_item',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'select_item',
                                                                                   
                                                                                    'value'=>set_value('select_item'));
                                                                     echo form_input($select_item)?>
                                                        <input type="hidden" id="decomposition_guid" name="decomposition_guid">
                                                  </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="sku" ><?php echo $this->lang->line('sku') ?></label>													
                                                                     <?php $item_sku=array('name'=>'item_sku',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'item_sku',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('item_sku'));
                                                                         echo form_input($item_sku)?>
                                               </div>
                                               </div>
                                              
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="item_stock" ><?php echo $this->lang->line('stock') ?></label>													
                                                                     <?php $item_stock=array('name'=>'demo_item_stock',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_item_stock',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('item_stock'));
                                                                         echo form_input($item_stock)?>
                                                            <input type="hidden" name="item_stock" id="item_stock">
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="item_stock" ><?php echo $this->lang->line('stock')." ".$this->lang->line('in')." ".$this->lang->line('weight'); ?></label>													
                                                                     <?php $demo_item_weight_stock=array('name'=>'demo_item_weight_stock',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_item_weight_stock',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('item_stock'));
                                                                         echo form_input($demo_item_weight_stock)?>
                                                            <input type="hidden" name="item_weight_stock" id="item_weight_stock">
                                                       </div>
                                               </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="decomposition_number" ><?php echo $this->lang->line('decomposition_id') ?></label>													
                                                                     <?php $decomposition_number=array('name'=>'demo_decomposition_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_decomposition_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('decomposition_number'));
                                                                         echo form_input($decomposition_number)?>
                                                            <input type="hidden" name="decomposition_number" id="decomposition_number">
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="decomposition_date" ><?php echo $this->lang->line('decomposition_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $decomposition_date=array('name'=>'decomposition_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'decomposition_date',
                                                                                          'onKeyPress'=>"new_decomposition_date(event)", 
                                                                                            'value'=>set_value('decomposition_date'));
                                                                             echo form_input($decomposition_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                               
                                              
                                              
                                               </div>
                                           
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>
                         
                         
         
                    <div class="row small_inputs" >
                        <div class="col col-lg-12">
                            <div class="row" style="padding-top: 1px;">
                                 
                                  
                                                <div class="col col-sm-1" style="padding:1px; width: 190px;">
                                             
                                                   
                                             <label for="items" class="text-center" ><?php echo $this->lang->line('decomposition_type') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $decomposition_type=array('name'=>'decomposition_type',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'decomposition_type',
                                                                                    'value'=>set_value('decomposition_type'));
                                                                     echo form_input($decomposition_type)?>
                                                  </div>
                                         
                                                    <input type="hidden" id='diabled_item' class="form-control">                                                 
                                                    <input type="hidden" name="decomposition_guid" id="decomposition_guid">
                                                    <input type="hidden" name="formula" id="formula">
                                                    <input type="hidden" name="decomposition_value" id="decomposition_value">                                                 
                                                    
                                                        </div>
                                                
                                                 <div class="col col-lg-1" style="padding:1px;width: 160px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="stock_quantity" class="text-center" ><?php echo $this->lang->line('stock') ." ". $this->lang->line('quantity') ?></label>

                                                                 <?php $stock_quantity=array('name'=>'stock_quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'stock_quantity',
                                                                                            'onkeyup'=>"net_amount()", 
                                                                     'onKeyPress'=>"add_new_quty(event); return numbersonly(event)",
                                                                                            'value'=>set_value('stock_quantity'));
                                                                             echo form_input($stock_quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                 <div class="col col-lg-1" style="padding:1px;width: 160px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'quantity',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                
                                                
                                                
                                                     
                                              
                                                    <div class="col col-lg-1" style="padding:1px;width: 120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" class="text-center" ><?php echo $this->lang->line('selling_price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'price',
                                                                                           
                                                                  
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                          
                                                
                                  
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;width:120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="tax" class="text-center" id="tax_label"  ><?php echo $this->lang->line('tax_type') ?></label>

                                                                 <?php $tax_type=array('name'=>'tax_type',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'tax_type',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('tax_type'));
                                                                             echo form_input($tax_type)?>
                                                        </div>
                                                    </div>
                                                          <div class="col col-lg-1" style="padding:1px;width:120px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="tax" class="text-center" id="tax_label"  ><?php echo $this->lang->line('tax') ?></label>

                                                                 <?php $tax=array('name'=>'tax',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'tax',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('tax'));
                                                                             echo form_input($tax)?>
                                                        </div>
                                                    </div>
                                               
                                               
                                                <div class="col col-lg-2" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="total" class="text-center"  ><?php echo $this->lang->line('total') ?></label>

                                                                 <?php $total=array('name'=>'total',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'total',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('total'));
                                                                             echo form_input($total)?>
                                                        </div>
                                                    </div>
                                                <div class="col col-lg-1" style="padding: 18px 0px 1px; width: 25px;">
                                                
                                                    <a  href="javascript:copy_items()" style="padding: 2px 3px"><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('save') ?>" style="height: 24px;padding: 4px 6px;width:24px "><i class="icon icon-save"></i></span></a>
                                                  
                                                </div> <div class="col col-lg-1" style=" padding: 18px 0px 1px; width: 25px;">
                                                  
                                                    <a  style="padding: 2px 3px" href="javascript:clear_inputs()"><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('clear') ?>" style="height: 24px;padding: 4px 6px;width:24px "><i class="icon icon-refresh"></i></span></a>
                                                </div>
                                               
                                               
                          
                                          
                                     <br>
                                                                     
                              </div>
                        </div>
                    </div>
                    <div class="row small_inputs" >
                    <div class="col col-lg-9">
                      
                         
                             
                              
                          
                          
                        <div class="row" ><input type="hidden" value="0" id='sl_number'>
             
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('decomposition_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table table-striped dataTable ">
                                    <thead>
                                        <tr>
                                            
                                     <th><?php echo $this->lang->line('no') ?></th>
                                    <th><?php echo $this->lang->line('name') ?></th>
                                        <th><?php echo $this->lang->line('sku') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>                                  
                                    <th><?php echo $this->lang->line('price') ?></th>
                                    <th><?php echo $this->lang->line('tax') ?></th>
                                    <th><?php echo $this->lang->line('discount') ?></th>
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="new_decomposition_items" >
                                       
                                    </tbody >
                                </table>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col col-lg-12" id="parent_items">
                            <div class="row">
                         
                             
                                 
                                       <div id="" class="col col-lg-12" style="padding-right: 0px;padding-left: 0px">
                                           <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('note')." ".$this->lang->line('and')." ".$this->lang->line('remark') ?></h4>                                                                               
                              </div> <div class="row" style="padding-left:25px;padding-right:25px;padding-bottom:  25px">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                        <label for="note" ><?php echo $this->lang->line('note') ?></label>													
                                                                  <?php $note=array('name'=>'note',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'note',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('note'));
                                                                     echo form_textarea($note)?>
                                                        
                                                  </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                         <label for="remark" ><?php echo $this->lang->line('remark') ?></label>													
                                                                  <?php $remark=array('name'=>'remark',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'remark',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('remark'));
                                                                     echo form_textarea($remark)?>
                                                        
                                                  </div>
                                               </div>
                                               
                                               
                                               
                                              
                                           </div>
                                           </div>
                                     <br>
                                        </div> 
                               
                             
                          
                          </div>
                                <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                            </div>
                        </div>
                    
                    </div><div class="col col-sm-3" ">
                       
                        <div class="row" style="margin-left: 5px">
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
                              </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_item_discount_amount" ><?php echo $this->lang->line('total_item_discount_amount') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_item_discount_amount',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_item_discount_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_item_discount_amount'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_tax" ><?php echo $this->lang->line('total_tax') ?></label>													
                                                                  <?php $total_item_discount_amount=array('name'=>'total_tax',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'total_tax',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_tax'));
                                                                     echo form_input($total_item_discount_amount)?>
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_amount" ><?php echo $this->lang->line('total_amount') ?></label>													
                                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_total_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_amount'));
                                                                     echo form_input($total_amount)?>
                                                        <input type="hidden" name="total_amount" id="total_amount">
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="grand_total" ><?php echo $this->lang->line('grand_total') ?></label>													
                                                                  <?php $grand_total=array('name'=>'demo_grand_total',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_grand_total',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('grand_total'));
                                                                     echo form_input($grand_total)?>
                                                        <input type="hidden" name="grand_total" id="grand_total">
                                                        
                                                  </div><br>
                                                  </div>
                                               </div>
                        <div class="row" style="margin-left: 5px">
                                          <div class="col col-sm-6"  >
                                              <div class="form_sep " id="save_button" style="padding-left:0px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:save_new_decomposition()" class="btn btn-default"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_decomposition()" class="btn btn-default"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-6"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_decomposition()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_decomposition()" class="btn btn-default"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
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
                    function decomposition_group_approve(){
              <?php if($this->session->userdata['decomposition_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('decomposition');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/decomposition/decomposition_approve',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

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

                          }

                      }
                  

                      }   
                       <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                            <?php }
                         ?>
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
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('decomposition');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>index.php/decomposition/item_active',
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
     function posnic_delete(){
            <?php if($this->session->userdata['decomposition_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('paruchase_decomposition');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                           
                          if(posnic[i].checked==true){ 
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/decomposition/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                  complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                           $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('goods_receiving_note') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }else if(response['responseText']=='Approved'){
                                         $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                    }else{
                                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('goods_receiving_note');?>', { type: "error" });                       
                                    }
                                    }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      <?php }else{?>
                                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                           <?php }
                        ?>
                      }
                    
                    
                    
    function decomposition_group_approve(){
         <?php if($this->session->userdata['decomposition_per']['approve']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('decomposition');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                           var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/decomposition/decomposition_approve',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                     complete: function(response) {
                                        if(response['responseText']=='TRUE'){
                                               $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('decomposition') ?>  <?php echo $this->lang->line('approved');?>', { type: "success" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }else if(response['responseText']=='Approved'){
                                             $.bootstrapGrowl($('#decomposition__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>   <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                        }else{
                                              $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('decomposition');?>', { type: "error" });                        
                                        }
                                        }
                                });

                          }

                      }
                  

                      }   
                        <?php }else{?>
                                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('decomposition');?>', { type: "error" });                       
                            <?php }
                         ?>
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
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('decomposition');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>index.php/decomposition/item_deactive',
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
        

      