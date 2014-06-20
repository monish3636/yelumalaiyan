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
	<script src="<?php echo base_url() ?>template/shortcut/jquery.hotkeys-0.7.9.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/keyboard/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/jquery-ui.js"></script> 
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/select2.js"></script>
	<script type="text/javascript" language="javascript" class="init">
            var point=3;
            var last_row=1;
         $(document).ready(function() { 
           var selected = [];
                $('#selected_item_table').dataTable({
                   	     "bProcessing": true,
                             "bDestroy": true ,
                             "bPaginate": false,
                             "scrollY":        "425px",
                             "scrollX":        "100%",
                             "scrollCollapse": true,
                             "paging":         false,
                             "sPaginationType": "bootstrap_full",
                             "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                         $("td:first", nRow).html(iDisplayIndex +1);
                         $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                     },
                }); 
                
                
                  $('#selected_item_table tbody').on('click', 'tr', function () {
                        var id = this.id;
                        new_row(id);
                        $('#'+id +' input[type=text]').focus(); 
                    } );
                jQuery(document).bind('keydown', 'f2',function() 
                {
                    $('#item_scan_panel').show();
                    $('#item_search_panel').hide();
                    $('#items').select2('close');
                    $('#first_name').select2('close');
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
		});
                jQuery(document).bind('keydown', 'f4',function() 
                {
                    $('#item_scan_panel').hide();
                    $('#item_search_panel').show();
                    $('#items').select2('open');
                    $('#first_name').select2('close');
		});
                jQuery(document).bind('keydown', 'Alt+1',function() 
                {
                    $('#items').select2('close');
                    $('#first_name').select2('open');
		});
                jQuery(document).bind('keydown', 'Alt+2',function() 
                {
                   remove_all();
                   new_row($("#selected_item_table tbody tr:first").attr('id'));
                   $('#selected_item_table tbody tr:first input[type=text]').focus();
		});
                jQuery(document).bind('keydown', 'Alt+3',function() 
                {
                   remove_all();
                   $('#selected_item_table_filter input').focus();
                  
		});
                jQuery(document).bind('keydown', 'Alt+4',function() 
                {
                   remove_all();
                  $('#sales_bill_discount').modal('show');
                 
                   window.setTimeout(function ()
                    {
                        $('#bill_discount').focus();
                    }, 200);
                  
		});
                jQuery('#sales_bill_discount').bind('keydown', 'ctrl+s',function() 
                {
                   remove_all();
                  $('#sales_bill_discount').modal('hide');
                 new_grand_total();
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
                  
		});
                jQuery('#sales_bill_discount').bind('keydown', 'insert',function() 
                {
                    remove_all();
                    $('#sales_bill_discount').modal('hide');
                    new_grand_total();
                    window.setTimeout(function ()
                    {
                        $('#search_barcode').val("");
                        $('#search_barcode').focus();
                    }, 200);
                  
		});
//                var timer, last,first;
//                jQuery('#sales_bill_discount').bind('keydown', function(e) {
//                    // Typing a then h will call the alert
//                    if (first==97 && last == 98 && e.which === 46) {
//                        alert('Hello World');
//                    }
//                    if(first==""){
//                        first = e.which;    
//                    }else{
//                        last = e.which;
//                    }
//                         console.log(e.which)         ;
//                                       
//                    clearTimeout(timer);
//                    timer = setTimeout(function(){
//                        last = '';
//                        first = '';
//                    }, 1000);
//                });
                jQuery('#selected_item_table').bind('keydown', 'up',function() 
                {
                 last_row++;
                 if(last_row==3){
                    var bid =$(':focus').attr('id');
                    var trid = $('#'+bid).closest('tr').attr('id');
                    var index=$('#'+trid).children('td:first').text();
                    var rows = $("#selected_item_table").dataTable().fnGetNodes();
                    index=parseInt(index)-1;
                    var up;
                    for(var i=0;i<rows.length;i++)
                    {                       
                        var row=$(rows[i]).attr('id');
                        
                        if($('#'+row).children('td:first').text()==index){
                            up=row;
                        }
                      
                    }
                    if(up){
                        $('#'+up).addClass('selected');
                        $('#'+trid).removeClass('selected');
                        $('#'+up +' input[type=text]').focus();                  
                      
                    }
                      last_row=1;
                    }
		});
                $('#selected_item_table').bind('keydown', 'down',function() 
                {
                   last_row++;
                 if(last_row==3){
                    var bid =$(':focus').attr('id');
                    var trid = $('#'+bid).closest('tr').attr('id');
                    var index=$('#'+trid).children('td:first').text();
                    var rows = $("#selected_item_table").dataTable().fnGetNodes();
                    index=parseInt(index)+1;
                    var down;
                    for(var i=0;i<rows.length;i++)
                    {                       
                        var row=$(rows[i]).attr('id');
                        
                        if($('#'+row).children('td:first').text()==index){
                            down=row;
                        }
                      
                    }
                    if(down){
                        $('#'+down).addClass('selected');
                        $('#'+trid).removeClass('selected');
                        $('#'+down +' input[type=text]').focus(); 
                    }
                    last_row=1;
                    }
                  
		});
        } );
        function remove_all(){
            $('#first_name').select2('close');
            $('#items').select2('close');
        }

	</script>
	
</head>
<body>