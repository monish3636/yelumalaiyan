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
        <script type="text/javascript" charset="utf-8">
            var point=3;
            $(document).ready( function () {
                
                $('#selected_item_table').dataTable({
                              "bProcessing": true,
                              "bDestroy": true ,
                              "bPaginate": false,

                             "sPaginationType": "bootstrap_full",
                             "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                         $("td:first", nRow).html(iDisplayIndex +1);
                         $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                     },
                });    
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
                jQuery(document).bind('keydown', 'f3',function() 
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
                   $('#selected_item_table').focus();
		});
                jQuery(document).bind('keydown', 'Alt+3',function() 
                {
                   remove_all();
                   $('#selected_item_table_filter input').focus();
                  
		});
                            
                
                
            });
            function remove_all(){
                $('#items').select2('close');
                $('#first_name').select2('close');
            }
        </script>
	<script src="<?php echo base_url() ?>template/shortcut/jquery.hotkeys-0.7.9.min.js" type="text/javascript"></script>