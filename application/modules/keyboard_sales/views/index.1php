<style type="text/css">
    
    body{
        background: #e3eaf3;
       
      //  overflow-x: hidden;
      //  overflow-y: hidden;
    }
    #container{
        margin: auto !important;
        width: 94%;
    }
    .table-container{
       // background: #405b75;
       // color: #ffffff;
      //  border-radius: 5px;
        margin-top:40px;
       // height: 600px;
      //  overflow-y: scroll;
    }
   // .modal-backdrop {background: none;}
    .add_item-container{
     //   background: #404040;
        margin-top: 10px;
        border-radius: 10px;
    }
    .modal-header {
     //   background: none repeat scroll 0 0 #405b75;
      //  color: #ffffff;
       // border-radius: 20px 20px 0px 0px;
    }
    .modal-footer {
     //   background: none repeat scroll 0 0 #405b75;
     //   color: #ffffff;
       // border-radius:0px 0px 20px 20px;
    }
    .modal-content {
      // border-radius: 25px;
       border:solid 3px #405b75;
    }
    .search-input{
   //     border: solid 2px #405b75;
    }
    .table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
    border-top:none;
    line-height: 1.42857;
    padding: 6px;
    vertical-align: top;
    }
    .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
        background-color: #ffffff ;
    }
    .panel-default .panel-heading{
        background: #007da9;
        color: #ffffff;
        border: #007da9;
    }
    .panel-default {
    border: medium solid #007da9;
   
    }
    .madal-search {
      background: #007da9;
       color: #ffffff;
   
    }
   
</style>
<script type="text/javascript" charset="utf-8">

        $(document).ready(function(){
           $('#search_barcode').focusout(function(){
                window.setTimeout(function ()
                {
                    $('#search_barcode').focus();
                }, 0);
            });
            $('#search_barcode').keyup(function(e){
                
                 barcode = $(this);
                
                if( (e.keyCode == 13)|| (barcode.val().length > 10)){

                  sendBarcode(barcode.val());
                  barcode.val('');
                  $('#search_barcode').focus();
                } 

            });

        });
        function sendBarcode(b){
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/keyboard_sales/get_items/"+b,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                {               
                            var  name=data[0]['name'];
                            var  stock=data[0]['stock_id'];
                            var  quty=data[0]['quty'];
                            var  price=data[0]['price'];
                            var  items_id=data[0]['item'];
                            var  tax_value=data[0]['tax_value'];
                            var  tax_type=data[0]['tax_type'];
                            var  tax_Inclusive=data[0]['tax_inclusive'];   
                            var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name,
                                quty,
                                price,
                                parseFloat(quty)*parseFloat(price),
                          '<input type="hidden" name="index" id="index">\n\
                          <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                          <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                          <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                          <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                          <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                          <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                          <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                  <a href=javascript:edit_order_item("'+stock+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                          var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                          theNode.setAttribute('id','new_item_row_id_'+stock)
                }
            });
        }

    </script>
<body>
    <div id="container" style="width: 90%">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            
            <div class="col col-lg-2">
                <label>Customer</label>
                <input type="text" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>
        <div class="row">
            
            <div class="col col-lg-8 table-container" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h4 class="panel-title"><?php echo $this->lang->line('sales_order') ?></h4>                                                                               
                    </div>
                    <table id='selected_item_table' class="table  dataTable table-striped " >
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('no') ?></th>
                                    <th><?php echo $this->lang->line('name') ?></th>
                                    <th><?php echo $this->lang->line('quantity') ?></th>  
                                    <th><?php echo $this->lang->line('price') ?></th>  
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                </tr>

                            </thead>
                            <tbody id="new_order_items" >
                                 
                            </tbody >
                    </table>
                </div>
            </div>
            <div class="col col-lg-4">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form_sep">                        
                            <label for="net_total" class="req"><?php echo $this->lang->line('net_total') ?></label> 
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="form_sep">                        
                                                                                                                               
                           <?php $net_total=array('name'=>'net_total',
                                                    'class'=>'required form-control',
                                                    'id'=>'net_total',
                                                    'value'=>set_value('net_total'));
                           echo form_input($net_total)?> 
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form_sep">                        
                              <label for="total_tax" class="req"><?php echo $this->lang->line('total_tax') ?></label> 
                        </div>
                    </div>
                    <div class="col col-lg-6">
                                                                                                                          
                           <?php $total_tax=array('name'=>'total_tax',
                                                    'class'=>'required form-control',
                                                    'id'=>'total_tax',
                                                    'value'=>set_value('total_tax'));
                           echo form_input($total_tax)?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form_sep">                        
                              <label for="total_discount" class="req"><?php echo $this->lang->line('total_discount') ?></label>                
                        </div>
                    </div>
                    <div class="col col-lg-6">
                                                                                                             
                           <?php $total_discount=array('name'=>'total_discount',
                                                    'class'=>'required form-control',
                                                    'id'=>'total_discount',
                                                    'value'=>set_value('total_discount'));
                           echo form_input($total_discount)?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form_sep">                        
                         <label for="total" class="req"><?php echo $this->lang->line('total') ?></label>  
                        </div>
                    </div>
                    <div class="col col-lg-6">
                                                                                                                             
                           <?php $total=array('name'=>'total',
                                                    'class'=>'required form-control',
                                                    'id'=>'total',
                                                    'value'=>set_value('total'));
                           echo form_input($total)?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="">
        <div class="modal-dialog add_item-container"  >
            <div class="row">
                <div class="panel panel-success">
                        <div class="panel-heading">
                                <h4 class="panel-title"><?php echo $this->lang->line('sales_order') ?></h4>                                                                               
                        </div>
                    <div class="col col-lg-2"></div>
                    <div class="col col-lg-8">                    
                        <label><h4 style="color: #ffffff"></h4></label>
                        <input type="text" class="form-control">
                    </div>

                    
                    <div class="col col-lg-2"></div>
                </div>    
            </div>
        </div>
    </div>
    
    <div id="add_item" class="modal fade in"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header madal-search">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                    <h4 class="modal-title text-center"><?php echo $this->lang->line('scan-items') ?></h4>
                </div>
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col col-lg-3"></div>
                        <div class="col col-lg-6"><input type="text" id="search_barcode" class="form-control search-input"></div>
                        <div class="col col-lg-3"></div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" type="button">Esc <?php echo $this->lang->line('to')." ".$this->lang->line('close') ?></button>
                
                </div>
            </div>
        </div>
    </div>
    <script>
          $(document).ready( function () {
    // single keys
    Mousetrap.bind('4', function() { console.log('4'); });
    Mousetrap.bind("?", function() { console.log('show shortcuts!'); });
    Mousetrap.bind('esc', function() { console.log('escape'); }, 'keyup');

    // combinations
    Mousetrap.bind('command+shift+k', function() { console.log('command shift k'); });

    // map multiple combinations to the same callback
    Mousetrap.bind(['command+k', 'ctrl+k'], function() {
        console.log('command k or control k');

        // return false to prevent default browser behavior
        // and stop event from bubbling
        return false;
    });
    Mousetrap.bind(['F2', 'f2'], function() {
        
        $('#add_item').modal('show');
        window.setTimeout(function ()
        {
            $('#search_barcode').val("");
            $('#search_barcode').focus();
        }, 200);
    });
    Mousetrap.bind(['Esc', 'esc'], function() {
        
        $('#add_item').modal('hide');
      
        
     
      
    });

    // gmail style sequences
    Mousetrap.bind('g i', function() { console.log('go to inbox'); });
    Mousetrap.bind('* a', function() { console.log('select all'); });

    // konami code!
    Mousetrap.bind('up up down down left right left right b a enter', function() {
        console.log('konami code');
    });
    });
</script>
  <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/shortcut/mousetrap.js"/>
</body>
</html>