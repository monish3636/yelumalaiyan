<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title>POSNIC</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/todc-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/img/flags/flags.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/retina.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/bootstrap-switch.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/hint-css/hint.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/theme/color_1.css" id="theme">
               
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/ie.css">
                <script src="<?php echo base_url() ?>template/app/js/ie/html5shiv.js"></script>
                <script src="<?php echo base_url() ?>template/app/js/ie/respond.min.js"></script>
                <script src="<?php echo base_url() ?>template/app/js/ie/excanvas.min.js"></script>
        <![endif]-->

         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/multi-select/css/multi-select.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/multi-select/css/ebro_multi-select.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/select/select2.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/select2/ebro_select2.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/datepicker/css/datepicker.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/colorpicker/css/colorpicker.css">
         <link href="<?php echo base_url() ?>template/app/js/lib/iCheck/skins/minimal/minimal.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/timepicker/css/bootstrap-timepicker.min.css">
         <link href="<?php echo base_url() ?>template/app/validation/prettify.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/app/validate/css/wizard.css">
         <link rel="stylesheet" href="<?php echo base_url() ?>template/keyboard/style.css">
         <link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">
	 <link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/extras/TableTools/media/css/TableTools.css">     
	    

	
	 <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
	 <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.js"></script>
	 <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/select2.js"></script>
	 <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/jquery-ui.js"></script> 
    <script type="text/javascript">
            $(document).ready( function () { 
                   $('#keyboard').modal('show');
                function format_customers(sup) {
                    if (!sup.id) return sup.text;
                        return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
                        return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-12"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('company') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('address') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('phone') ?></div> \n\
                                   </div> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4">458878</div> \n\
                                        <div class="col col-lg-4">150.000</div> \n\
                                        <div class="col col-lg-4">10</div> \n\
                                   </div> \n\
                                </div>     \n\
                            </div>\n\ ';
                }
                $('#customer').change(function() {
                    
             
                });
          $('#customer').select2({
              dropdownCssClass : 'customers_select',
               formatResult: format_customers,
                formatSelection: format_customers,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('customer') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/touch_sales/search_customer',
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
                          address1: item.address,
                           discount: item.discount,
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
            $('#search_items').change(function() {
                // $("#search_items").select2('data', {id:'1',text:'jibi'});
            });
            function format_item(sup) {
                if (!sup.id) return sup.text;
                   // return  "<p >"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p>"+sup.value+"</p><p>"+sup.category+"</p><p>"+sup.brand+"</p><p>"+sup.department+" </p><p><?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p> ";
                    return   '<p><h4>'+sup.text+'</h4></p>\n\
                            <div class="row">    \n\
                                <div class="col col-lg-8"> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('sku') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('price') ?></div> \n\
                                        <div class="col col-lg-4"><?php echo $this->lang->line('stock') ?></div> \n\
                                   </div> \n\
                                    <div class="row"> \n\
                                        <div class="col col-lg-4">458878</div> \n\
                                        <div class="col col-lg-4">150.000</div> \n\
                                        <div class="col col-lg-4">10</div> \n\
                                   </div> \n\
                                </div>     \n\
                                <div class="col col-lg-4"> \n\
                                    <img src="http://localhost/posnic//uploads/items/item.gif" style="height:78px"> \n\
                                </div> \n\
                            </div>\n\
                            <div class="row">\n\
                                <div class="col col-lg-4">Cello Griper</div> \n\
                                    <div class="col col-lg-4">Office</div> \n\
                                    <div class="col col-lg-4"> pen</div> \n\
                                </div> ';
            }
          $('#search_items').select2({
             
              dropdownCssClass : 'item_select',
              formatResult: format_item,
                formatSelection: format_item,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/touch_sales/search_items/',
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
                                     suppler:$('#parsley_reg #customers_guid').val()
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
                        no_of_unit : item.no_of_unit ,
                        kit_category : item.kit_category ,
                        kit_code : item.kit_code,
                        kit_name:item.kit_name,
                        kit_price:item.kit_price,
                        kit_tax:item.kit_tax,
                        kit_guid:item.kit_guid,
                        no_of_items:item.no_of_items,
                        kit_tax_amount:item.kit_tax_amount,
                        kit_tax_id:item.kit_tax_id,
                        kit_tax_value:item.kit_tax_value,
                        kit_tax_type:item.kit_tax_type,                        
                        deco_guid:item.deco_guid,
                        deco_tax:item.deco_tax,
                        deco_code:item.deco_code,
                        deco_value:item.deco_value,
                        });
                      });  
                      return {
                       
                          results: results
                      };
                    }
                }
            });
            
               
            });
        </script>
             
