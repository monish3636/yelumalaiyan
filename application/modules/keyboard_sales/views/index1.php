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
	
	 <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/jquery-ui.js"></script> 
         

	<script type="text/javascript" language="javascript" src="http://localhost/aaa/jquery.js"></script>
		<script src="http://localhost/posnic/template/shortcut/jquery.hotkeys-0.7.9.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="http://localhost/aaa/jquery.dataTables.js"></script>
         <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/app/select/select2.js"></script>
	<script type="text/javascript" language="javascript" class="init">
   var point=3;
   var last_row=1;
$(document).ready(function() {
    
	$('#example').dataTable( {
		
		     "bProcessing": true,
                              "bDestroy": true ,
                              "bPaginate": false,
"scrollY":        "200px",
		"scrollCollapse": true,
		"paging":         false,
                             "sPaginationType": "bootstrap_full",
                             "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                         $("td:first", nRow).html(iDisplayIndex +1);
                         $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                     },
	} );
           var selected = [];
                $('#selected_item_table').dataTable({
                   		     "bProcessing": true,
                              "bDestroy": true ,
                              "bPaginate": false,
"scrollY":        "100px",
		"scrollCollapse": true,
		"paging":         false,
                             "sPaginationType": "bootstrap_full",
                             "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                         $("td:first", nRow).html(iDisplayIndex +1);
                         $("#index", nRow).val(iDisplayIndex +1);
                        return nRow;
                     },
                }); 
                
                
//                  $('#selected_item_table tbody').on('click', 'tr', function () {
//                        var id = this.id;
//                        var index = $.inArray(id, selected);
//
//                        if ( index === -1 ) {
//                            selected.push( id );
//                        } else {
//                            selected.splice( index, 1 );
//                        }
//                        console.log($(this));
//                        $(this).addClass('selected');
//                    } );
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
                    
                    $('#'+up).addClass('selected');
                    $('#'+trid).removeClass('selected');
                    $('#'+up +' input[type=text]').focus();                  
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
                    var up;
                    for(var i=0;i<rows.length;i++)
                    {                       
                        var row=$(rows[i]).attr('id');
                        
                        if($('#'+row).children('td:first').text()==index){
                            up=row;
                        }
                      
                    }
                    
                    $('#'+up).addClass('selected');
                    $('#'+trid).removeClass('selected');
                    $('#'+up +' input[type=text]').focus();                  
                    last_row=1;
                    }
                  
		});
} );

	</script>
	
</head>
<body>
		<section>
			<h1>DataTables example <span>Scroll - vertical</span></h1>

			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</tfoot>

				<tbody>
					<tr>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
					</tr>
					<tr>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
					</tr>
					<tr>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2009/01/12</td>
						<td>$86,000</td>
					</tr>
					<tr>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2012/03/29</td>
						<td>$433,060</td>
					</tr>
					<tr>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2008/11/28</td>
						<td>$162,700</td>
					</tr>
					<tr>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2012/12/02</td>
						<td>$372,000</td>
					</tr>
					<tr>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2012/08/06</td>
						<td>$137,500</td>
					</tr>
					<tr>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2010/10/14</td>
						<td>$327,900</td>
					</tr>
					<tr>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2009/09/15</td>
						<td>$205,500</td>
					</tr>
					<tr>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2008/12/13</td>
						<td>$103,600</td>
					</tr>
					<tr>
						<td>Jena Gaines</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>30</td>
						<td>2008/12/19</td>
						<td>$90,560</td>
					</tr>
					<tr>
						<td>Quinn Flynn</td>
						<td>Support Lead</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2013/03/03</td>
						<td>$342,000</td>
					</tr>
					<tr>
						<td>Charde Marshall</td>
						<td>Regional Director</td>
						<td>San Francisco</td>
						<td>36</td>
						<td>2008/10/16</td>
						<td>$470,600</td>
					</tr>
					<tr>
						<td>Haley Kennedy</td>
						<td>Senior Marketing Designer</td>
						<td>London</td>
						<td>43</td>
						<td>2012/12/18</td>
						<td>$313,500</td>
					</tr>
					<tr>
						<td>Tatyana Fitzpatrick</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>19</td>
						<td>2010/03/17</td>
						<td>$385,750</td>
					</tr>
					<tr>
						<td>Michael Silva</td>
						<td>Marketing Designer</td>
						<td>London</td>
						<td>66</td>
						<td>2012/11/27</td>
						<td>$198,500</td>
					</tr>
					<tr>
						<td>Paul Byrd</td>
						<td>Chief Financial Officer (CFO)</td>
						<td>New York</td>
						<td>64</td>
						<td>2010/06/09</td>
						<td>$725,000</td>
					</tr>
					<tr>
						<td>Gloria Little</td>
						<td>Systems Administrator</td>
						<td>New York</td>
						<td>59</td>
						<td>2009/04/10</td>
						<td>$237,500</td>
					</tr>
					<tr>
						<td>Bradley Greer</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>41</td>
						<td>2012/10/13</td>
						<td>$132,000</td>
					</tr>
					<tr>
						<td>Dai Rios</td>
						<td>Personnel Lead</td>
						<td>Edinburgh</td>
						<td>35</td>
						<td>2012/09/26</td>
						<td>$217,500</td>
					</tr>
					<tr>
						<td>Jenette Caldwell</td>
						<td>Development Lead</td>
						<td>New York</td>
						<td>30</td>
						<td>2011/09/03</td>
						<td>$345,000</td>
					</tr>
					<tr>
						<td>Yuri Berry</td>
						<td>Chief Marketing Officer (CMO)</td>
						<td>New York</td>
						<td>40</td>
						<td>2009/06/25</td>
						<td>$675,000</td>
					</tr>
					<tr>
						<td>Caesar Vance</td>
						<td>Pre-Sales Support</td>
						<td>New York</td>
						<td>21</td>
						<td>2011/12/12</td>
						<td>$106,450</td>
					</tr>
					<tr>
						<td>Doris Wilder</td>
						<td>Sales Assistant</td>
						<td>Sidney</td>
						<td>23</td>
						<td>2010/09/20</td>
						<td>$85,600</td>
					</tr>
					<tr>
						<td>Angelica Ramos</td>
						<td>Chief Executive Officer (CEO)</td>
						<td>London</td>
						<td>47</td>
						<td>2009/10/09</td>
						<td>$1,200,000</td>
					</tr>
					<tr>
						<td>Gavin Joyce</td>
						<td>Developer</td>
						<td>Edinburgh</td>
						<td>42</td>
						<td>2010/12/22</td>
						<td>$92,575</td>
					</tr>
					<tr>
						<td>Jennifer Chang</td>
						<td>Regional Director</td>
						<td>Singapore</td>
						<td>28</td>
						<td>2010/11/14</td>
						<td>$357,650</td>
					</tr>
					<tr>
						<td>Brenden Wagner</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>28</td>
						<td>2011/06/07</td>
						<td>$206,850</td>
					</tr>
					<tr>
						<td>Fiona Green</td>
						<td>Chief Operating Officer (COO)</td>
						<td>San Francisco</td>
						<td>48</td>
						<td>2010/03/11</td>
						<td>$850,000</td>
					</tr>
					<tr>
						<td>Shou Itou</td>
						<td>Regional Marketing</td>
						<td>Tokyo</td>
						<td>20</td>
						<td>2011/08/14</td>
						<td>$163,000</td>
					</tr>
					<tr>
						<td>Michelle House</td>
						<td>Integration Specialist</td>
						<td>Sidney</td>
						<td>37</td>
						<td>2011/06/02</td>
						<td>$95,400</td>
					</tr>
					<tr>
						<td>Suki Burks</td>
						<td>Developer</td>
						<td>London</td>
						<td>53</td>
						<td>2009/10/22</td>
						<td>$114,500</td>
					</tr>
					<tr>
						<td>Prescott Bartlett</td>
						<td>Technical Author</td>
						<td>London</td>
						<td>27</td>
						<td>2011/05/07</td>
						<td>$145,000</td>
					</tr>
					<tr>
						<td>Gavin Cortez</td>
						<td>Team Leader</td>
						<td>San Francisco</td>
						<td>22</td>
						<td>2008/10/26</td>
						<td>$235,500</td>
					</tr>
					<tr>
						<td>Martena Mccray</td>
						<td>Post-Sales support</td>
						<td>Edinburgh</td>
						<td>46</td>
						<td>2011/03/09</td>
						<td>$324,050</td>
					</tr>
					<tr>
						<td>Unity Butler</td>
						<td>Marketing Designer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/12/09</td>
						<td>$85,675</td>
					</tr>
					<tr>
						<td>Howard Hatfield</td>
						<td>Office Manager</td>
						<td>San Francisco</td>
						<td>51</td>
						<td>2008/12/16</td>
						<td>$164,500</td>
					</tr>
					<tr>
						<td>Hope Fuentes</td>
						<td>Secretary</td>
						<td>San Francisco</td>
						<td>41</td>
						<td>2010/02/12</td>
						<td>$109,850</td>
					</tr>
					<tr>
						<td>Vivian Harrell</td>
						<td>Financial Controller</td>
						<td>San Francisco</td>
						<td>62</td>
						<td>2009/02/14</td>
						<td>$452,500</td>
					</tr>
					<tr>
						<td>Timothy Mooney</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>37</td>
						<td>2008/12/11</td>
						<td>$136,200</td>
					</tr>
					<tr>
						<td>Jackson Bradshaw</td>
						<td>Director</td>
						<td>New York</td>
						<td>65</td>
						<td>2008/09/26</td>
						<td>$645,750</td>
					</tr>
					<tr>
						<td>Olivia Liang</td>
						<td>Support Engineer</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2011/02/03</td>
						<td>$234,500</td>
					</tr>
					<tr>
						<td>Bruno Nash</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>38</td>
						<td>2011/05/03</td>
						<td>$163,500</td>
					</tr>
					<tr>
						<td>Sakura Yamamoto</td>
						<td>Support Engineer</td>
						<td>Tokyo</td>
						<td>37</td>
						<td>2009/08/19</td>
						<td>$139,575</td>
					</tr>
					<tr>
						<td>Thor Walton</td>
						<td>Developer</td>
						<td>New York</td>
						<td>61</td>
						<td>2013/08/11</td>
						<td>$98,540</td>
					</tr>
					<tr>
						<td>Finn Camacho</td>
						<td>Support Engineer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/07/07</td>
						<td>$87,500</td>
					</tr>
					<tr>
						<td>Serge Baldwin</td>
						<td>Data Coordinator</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2012/04/09</td>
						<td>$138,575</td>
					</tr>
					<tr>
						<td>Zenaida Frank</td>
						<td>Software Engineer</td>
						<td>New York</td>
						<td>63</td>
						<td>2010/01/04</td>
						<td>$125,250</td>
					</tr>
					<tr>
						<td>Zorita Serrano</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>56</td>
						<td>2012/06/01</td>
						<td>$115,000</td>
					</tr>
					<tr>
						<td>Jennifer Acosta</td>
						<td>Junior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>43</td>
						<td>2013/02/01</td>
						<td>$75,650</td>
					</tr>
					<tr>
						<td>Cara Stevens</td>
						<td>Sales Assistant</td>
						<td>New York</td>
						<td>46</td>
						<td>2011/12/06</td>
						<td>$145,600</td>
					</tr>
					<tr>
						<td>Hermione Butler</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>47</td>
						<td>2011/03/21</td>
						<td>$356,250</td>
					</tr>
					<tr>
						<td>Lael Greer</td>
						<td>Systems Administrator</td>
						<td>London</td>
						<td>21</td>
						<td>2009/02/27</td>
						<td>$103,500</td>
					</tr>
					<tr>
						<td>Jonas Alexander</td>
						<td>Developer</td>
						<td>San Francisco</td>
						<td>30</td>
						<td>2010/07/14</td>
						<td>$86,500</td>
					</tr>
					<tr>
						<td>Shad Decker</td>
						<td>Regional Director</td>
						<td>Edinburgh</td>
						<td>51</td>
						<td>2008/11/13</td>
						<td>$183,000</td>
					</tr>
					<tr>
						<td>Michael Bruce</td>
						<td>Javascript Developer</td>
						<td>Singapore</td>
						<td>29</td>
						<td>2011/06/27</td>
						<td>$183,000</td>
					</tr>
					<tr>
						<td>Donna Snider</td>
						<td>Customer Support</td>
						<td>New York</td>
						<td>27</td>
						<td>2011/01/25</td>
						<td>$112,000</td>
					</tr>
				</tbody>
			</table>

			
			
		</section>
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
  
   .customers_select{
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
    #main_content {
            margin: 0px;
            overflow-y: scroll;
            height: 457px;
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
    
    #selected_item_table tr td:nth-child(6){
      width: 150px;
    }
    #selected_item_table tr td:nth-child(9){
      width: 50px;
    }
    div.dt-bottom-row {
         display: none;
    }
    .btn-info{
         background: #007da9;
    }
    .row + .row {
        margin-top: 0;
    }
    .search-input{
        border-radius: 10px;
        height: 32px;
        margin: auto auto 10px;
        width: 90%;   
        background: #e3eaf3;
        color: #000;
        color: black;
        font-weight: 900;
            
    }
    #sales_quty{
        border-radius: 10px;
        margin: auto auto 10px;
        width: 90%;   
        background: #e3eaf3;
        color: #000;
        color: black;
        font-weight: 900;
            
    }
    label {
        font-weight: bold;
    }
    .selected{
         background-color: #f2b835;
    }
</style>	
<script type="text/javascript" charset="utf-8">   
    $(document).ready(function(){
        $('#search_barcode').focusout(function(){
            window.setTimeout(function ()
            {
             //   $('#search_barcode').focus();
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
                if(data_table_duplicate('new_item_row_id_'+data[0]['guid'])){
                    var old_total=$('#new_item_row_id_'+data[0]['guid']+' #items_total').val();
                    var quty=$('#new_item_row_id_'+data[0]['guid']+' #quty_'+data[0]['guid']).val();
                    var price=$('#new_item_row_id_'+data[0]['guid']+' #items_price').val();
                    var tax_Inclusive=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_inclusive').val();
                    var tax_value=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_value').val();
                    var tax_type=$('#new_item_row_id_'+data[0]['guid']+' #items_tax_type').val();
                    var per=$('#new_item_row_id_'+data[0]['guid']+' #items_discount_per').val();
                    var discount=0;
                    quty=parseFloat(quty)+1;
                    if(per!="" && per!=0){
                        discount=((parseFloat(quty)*parseFloat(price))*per/100);
                    }
                    var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
                    var total;
                    var type;
                    if(tax_Inclusive==1){
                        total= (parseFloat(quty)*parseFloat(price))+tax-discount;
                        var old_tax=((parseFloat(quty-1)*parseFloat(price))*tax_value)/100;
                        var total_tax=$('#total_tax').val();
                        total_tax=total_tax-old_tax+tax;
                        total_tax=total_tax.toFixed(point);
                        $('#total_tax').val(total_tax);
                        type='Exc';
                    }else{
                        type='Inc';
                        total= (parseFloat(quty)*parseFloat(price))-discount;
                    }
                    total=parseFloat(total);
                    total=total.toFixed(point);
                    discount=parseFloat(discount);
                    discount=discount.toFixed(point);
                    tax=parseFloat(tax);
                    tax=tax.toFixed(point);
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(6)').html(tax +''+' : '+tax_type+'-'+tax_value+'%('+type+')');
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(7)').html(discount);
                    $('#selected_item_table #new_item_row_id_'+data[0]['guid']+' td:nth-child(8)').html(total);
                    $('#new_item_row_id_'+data[0]['guid']+' #quty_'+$('#parsley_reg #stock_id').val()).val(parseFloat(quty));
                    $('#new_item_row_id_'+data[0]['guid']+' #items_total').val(total);
                    var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                    amount=amount.toFixed(point);
                    $('#parsley_reg #total_amount').val(amount);
                    $('#parsley_reg #demo_total_amount').val(amount);
                    new_grand_total(); 
                }else{
                    if(data[0]['deco_guid']){
                        var guid = data[0]['deco_guid'];
                        var item_id=data[0]['deco_guid'];                                
                        var sku=data[0]['deco_code']+"-"+data[0]['deco_value'];                                
                        var stock=data[0]['guid']                                
                        var name =data[0]['name']                                
                        var price=data[0]['price'];                               
                        var quty=1;                               
                        var tax_value=data[0]['tax_value'];
                        var tax_type=data[0]['tax_type_name']+"-"+tax_value+"%";                               
                        var tax_Inclusive=data[0]['deco_tax'];                                

                    }else if(data[0]['kit_guid']){
                        var guid = data[0]['kit_guid'];
                        var item_id=data[0]['kit_guid'];                                
                        var sku=data[0]['kit_code'];                                
                        var stock=data[0]['guid']                                
                        var name= data[0]['kit_name']                                
                        var price=data[0]['price'];                               
                        var quty=1;                               
                        var tax_value=data[0]['kit_tax_value'];
                        var tax_type=data[0]['kit_tax_type']+"-"+tax_value+"%";                                
                        var tax_Inclusive=data[0]['kit_tax'];   
                    }else{
                        var  items_id=data[0]['i_guid'];
                        var  name=data[0]['name'];
                        var  stock=data[0]['guid'];
                        var  quty=1;
                        if(data[0]['uom']==1){
                            var  price=parseFloat(data[0]['price'])/parseFloat(data[0]['no_of_unit']);
                        }else{
                            var price=data[0]['price'];
                        }
                        var  items_id=data[0]['item'];
                        var  sku=data[0]['code'];
                        var  tax_value=data[0]['tax_value'];
                        var  tax_type=data[0]['tax_type_name']+"-"+tax_value+"%"; 
                        var  tax_Inclusive=data[0]['tax_Inclusive'];
                    }
                    var discount=0;
                    var per=0;
                    if(data[0]['end_date']!=0 && data[0]['end_date']!=""){
                        var  discount=((parseFloat(quty)*parseFloat(price))*data[0]['discount'])/100;
                        var  per=data[0]['discount'];
                    }
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
                    
                   
                        total=total.toFixed(point);
                        tax=tax.toFixed(point);
                        discount=discount.toFixed(point);
                        var addId = $('#selected_item_table').dataTable().fnAddData( [
                                null,
                                name,
                                sku,
                                "<input type='text' name='items_quty[]' class='form-control text-center' value='"+quty+"' id='quty_"+stock+"'>",
                                price,
                                tax+' : '+tax_type+'('+type+')',
                                discount,
                                total,
                                '<input type="hidden" name="index" id="index">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                                <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                 '+"&nbsp;<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                            var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                            theNode.setAttribute('id','new_item_row_id_'+stock)
                            $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                            if (isNaN($("#parsley_reg #total_amount").val())) 
                                $("#parsley_reg #total_amount").val(0);    
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
                            new_grand_total(); 
                            clear_inputs();
                            $('#parsley_reg #tax').val(0);
                            $('#parsley_reg #item_discount').val(0);
                    }
                }
        });
    }

    </script>
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function data_table_duplicate(row){
        var rows = $("#selected_item_table").dataTable().fnGetNodes();
        for(var i=0;i<rows.length;i++)
        {
           if($(rows[i]).attr('id')==row){
               return true
           }
        }
        return false
    }
    function get_table_data(){
        $('#selected_item_table').dataTable({
                     "bProcessing": true,
                     "bDestroy": true ,
                     "bPaginate": false,
        });
    }
    $(document).ready( function () {
        $('#items').change(function() {
            if($('#items').select2('data').deco_guid)
            {
                var guid = $('#items').select2('data').deco_guid;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').deco_code+'-'+$('#items').select2('data').deco_value);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').text);

                $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price));

                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').tax_type+"-"+$('#items').select2('data').tax_value+"%");
                var tax=$('#items').select2('data').deco_tax;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }
                if(isNaN($('#parsley_reg #tax_value').val())){
                      $('#parsley_reg #tax_value').val(0);
                      $('#parsley_reg #tax').val(0);
                }
                net_amount();
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {
                    $('#parsley_reg #quantity').focus();
                }, 0);

            }else if($('#items').select2('data').kit_guid){
                var guid = $('#items').select2('data').kit_guid;
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').kit_code);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').kit_name);
                $('#parsley_reg #price').val(parseFloat($('#items').select2('data').kit_price));
                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').kit_tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').kit_tax_type+"-"+$('#items').select2('data').kit_tax_value+"%");
                var tax=$('#items').select2('data').kit_tax;
                var tax_amount=$('#items').select2('data').kit_tax_amount;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }
                if(isNaN($('#parsley_reg #tax_value').val())){
                      $('#parsley_reg #tax_value').val(0);
                      $('#parsley_reg #tax').val(0);
                }
                net_amount();
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {
                    $('#parsley_reg #quantity').focus();
                }, 0);
            }else{
                var guid = $('#items').select2('data').item;  
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#items').select2('data').value);
                $('#parsley_reg #stock_id').val($('#items').select2('data').sid);
                $('#parsley_reg #item_name').val($('#items').select2('data').text);
                if($('#items').select2('data').uom==0){
                    $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price));
                }else{
                    $('#parsley_reg #price').val(parseFloat($('#items').select2('data').price)/parseFloat($('#items').select2('data').no_of_unit));
                }
                $('#parsley_reg #stock_quty').val($('#items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#items').select2('data').tax_type+"-"+$('#items').select2('data').tax_value+"%");
              
                var start=$('#items').select2('data').start;
                var end=$('#items').select2('data').end;           
                var tax=$('#items').select2('data').tax_Inclusive;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }                
                if(start==0 && end==0){
                    $('#parsley_reg #discount').val(0);  
                }else{
                    $('#parsley_reg #discount').val($('#items').select2('data').discount);
                }
                if(isNaN($('#parsley_reg #tax_value').val())){
                      $('#parsley_reg #tax_value').val(0);
                      $('#parsley_reg #tax').val(0);
                }                   
                net_amount();
                $('#parsley_reg #quantity').focus();
                window.setTimeout(function ()
                {

                    $('#parsley_reg #quantity').focus();
                }, 0);
            }
        });
        function format_item(sup) {
            if (!sup.id) return sup.text;
            if(sup.deco_code){
                var code=sup.deco_code;
                return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('weight') ?>:"+sup.deco_value+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
            }else if(sup.kit_guid){
                var code=sup.kit_code;
                return  "<p style='font-size:13px;'>"+sup.kit_name+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.kit_price+" <?php echo ' '.$this->lang->line('no_of_items') ?>:"+sup.no_of_items+". </p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.kit_category+"</p> <p style='width:130px;  margin-left: 218px'> .</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> .</p>";
            }else{
                var code=sup.value;
                if(sup.uom==0){
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+sup.price+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }else{
                    return  "<p style='font-size:13px;'>"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:78px'></img></p><p style='font-size:14px;margin-top: -27px;'>"+"<?php echo ' <br>'.$this->lang->line('price') ?> : "+parseFloat(sup.price)/parseFloat(sup.no_of_unit)+" <?php echo ' '.$this->lang->line('stock') ?> : "+sup.quty+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+code+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
                }
            }
        }
        $('#items').select2({
            dropdownCssClass : 'item_select',
            formatResult: format_item,
            formatSelection: format_item,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/keyboard_sales/search_items/',
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
        function format_customers(sup) {
            if (!sup.id) return sup.text;
                return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
        }
        $('#parsley_reg #first_name').change(function() {           
            var guid = $('#parsley_reg #first_name').select2('data').id;
            $('#first_name').val($('#parsley_reg #first_name').select2('data').text);
            $('#demo_customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
            $('#customer_discount').val($('#parsley_reg #first_name').select2('data').discount);
            $('#customers_guid').val(guid);
        });
        $('#first_name').select2({
            dropdownCssClass : 'customers_select',
            formatResult: format_customers,
            formatSelection: format_customers,
            escapeMarkup: function(m) { return m; },
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('customer') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/keyboard_sales/search_customer',
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
    });
    


</script>
    


  
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
<script type="text/javascript">
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
                    $('#items').select2('open');
                }
            }
        }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
            $('#items').select2('open');
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
            if(parseFloat($('#quantity').val())>parseFloat($('#stock_quty').val())){
                $('#quantity').val($('#stock_quty').val());
                $.bootstrapGrowl('<?php echo $this->lang->line('avilable_stock_is') ;?> '+$('#stock_quty').val(), { type: "warning" }); 
            }
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
            }else
            {
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
            if(data_table_duplicate('new_item_row_id_'+$('#parsley_reg #stock_id').val())){    
                var old_total=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val();
                var old_quty=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #quty_'+$('#parsley_reg #stock_id').val()).val();
                var price=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_price').val();
                var tax_Inclusive=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_inclusive').val();
                var tax_value=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_value').val();
                var tax_type=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_tax_type').val();
                var per=$('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_discount_per').val();
                var discount=0;
                quty=parseFloat(old_quty)+parseFloat($('#quantity').val());
                if(per!="" && per!=0){
                    discount=((parseFloat(quty)*parseFloat(price))*per/100);
                }
                var tax=((parseFloat(quty)*parseFloat(price))*tax_value)/100;
                var total;
                var type;
                if(tax_Inclusive==1){
                    total= (parseFloat(quty)*parseFloat(price))+tax-discount;
                    var old_tax=((parseFloat(old_quty)*parseFloat(price))*tax_value)/100;
                    var total_tax=$('#total_tax').val();
                    total_tax=total_tax-old_tax+tax;
                    total_tax=total_tax.toFixed(point);
                    $('#total_tax').val(total_tax);
                    type='Exc';
                }else{
                    type='Inc';
                    total= (parseFloat(quty)*parseFloat(price))-discount;
                }
                total=parseFloat(total);
                total=total.toFixed(point);
                discount=parseFloat(discount);
                discount=discount.toFixed(point);
                tax=parseFloat(tax);
                tax=tax.toFixed(point);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(6)').html(tax +''+' : '+tax_type+'('+type+')');
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(7)').html(discount);
                $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #stock_id').val()+' td:nth-child(8)').html(total);
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #quty_'+$('#parsley_reg #stock_id').val()).val(parseFloat(quty));
                $('#new_item_row_id_'+$('#parsley_reg #stock_id').val()+' #items_total').val(total);
                var amount=parseFloat($('#parsley_reg #total_amount').val())+parseFloat(total)-parseFloat(old_total)
                amount=amount.toFixed(point);
                $('#parsley_reg #total_amount').val(amount);
                $('#parsley_reg #demo_total_amount').val(amount);
                new_grand_total(); 
                clear_inputs();
            }else{
                var  name=$('#parsley_reg #item_name').val();
                var  stock=$('#parsley_reg #stock_id').val();
                var  sku=$('#parsley_reg #sku').val();
                var  quty=$('#parsley_reg #quantity').val();
                var  price=$('#parsley_reg #price').val();
                var  items_id=$('#parsley_reg #item_id').val();
                var  customers=$('#parsley_reg #customers_guid').val();
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
                total=total.toFixed(point);
                tax=tax.toFixed(point);
                discount=discount.toFixed(point);
                var addId = $('#selected_item_table').dataTable().fnAddData( [
                    null,
                    name,
                    sku,
                    "<input type='text' name='items_quty[]' class='form-control text-center' value='"+quty+"' id='quty_"+stock+"'>",
                    price,
                    tax+' : '+tax_type+'('+type+')',
                    discount,
                    total,
                    '<input type="hidden" name="index" id="index">\n\
                    <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                    <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                    <input type="hidden" name="items_stock_id[]" id="items__stock_id" value="'+stock+'">\n\
                    <input type="hidden" name="items_stock_quty[]" id="items_stock_quty" value="'+$('#stock_quty').val()+'">\n\
                    <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                    <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                    <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                    <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                    <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                    <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                    <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                    <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                    <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                    '+"<a href=javascript:delete_order_item('"+stock+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                    var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                theNode.setAttribute('id','new_item_row_id_'+stock)
                $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
                if (isNaN($("#parsley_reg #total_amount").val())) 
                    $("#parsley_reg #total_amount").val(0)    
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
                new_grand_total(); 
                clear_inputs();
                $('#parsley_reg #tax').val(0);
                $('#parsley_reg #item_discount').val(0);
            }  
            
             $('#items').select2('data', {id:'',text: '<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>'});
             $('#items').select2('open');
        }else{
            if($('#parsley_reg #item_id').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#items').select2('open');
            }
            else if($('#parsley_reg #quantity').val()==""){
                $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
                $('#parsley_reg #quantity').focus();
            }
            else{
                $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
                $('#items').select2('open');
            }
        }
        $('#parsley_reg #tax').val(0);
        $('#parsley_reg #item_discount').val(0);
    }
 

    function delete_order_item(guid){
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
        new_grand_total(); 
        $("#parsley_reg #total_amount").val()
         var order=$('#selected_item_table #new_item_row_id_'+guid+' #items_order_guid').val();
          $('#deleted').append('<input type="hidden" id="r_items" name="r_items[]" value="'+order+'">');
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
        window.setTimeout(function ()
        {
           $('#parsley_reg #tax').val(0);
        $('#parsley_reg #item_discount').val(0);
        }, 0);

    }
    function new_grand_total(){
        if(parseFloat($("#parsley_reg #total_amount").val())>0){
            if($('#parsley_reg #customer_discount').val()==0 || isNaN($('#parsley_reg #customer_discount').val())){
                var  customer_dis=0;
            }else{
                customer_dis=parseFloat($('#parsley_reg #total_amount').val())*parseFloat($('#parsley_reg #customer_discount').val())/100;
                var customer_dis = parseFloat(customer_dis);
                $('#demo_customer_discount_amount').val(customer_dis.toFixed(point));
                $('#customer_discount_amount').val(customer_dis.toFixed(point));
            }
            $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-customer_dis);
            $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-customer_dis);
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
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
            $("#parsley_reg #demo_total_amount").val(0)
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
            $("#parsley_reg #demo_grand_total").val(0)
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
            $("#parsley_reg #grand_total").val(0)
    }

</script>
    <div class="row">
        <a class="btn btn-info" style="width: 100%">POSNIC</a>
    </div>
 <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('keyboard_sales/upadate_pos_keyboard_sales_details/',$form);?>
    <div class="row">
        <div class="col col-lg-2">
             <div class="form_sep" style="padding: 0 0 0 10px;">
                    <label for="sales_bill_number" ><?php echo $this->lang->line('sales_bill_number') ?></label>													
                             <?php $order_number=array('name'=>'demo_sales_bill_number',
                                                'class'=>'required  form-control',
                                                'id'=>'demo_sales_bill_number',
                                                'disabled'=>'disabled',
                                                'value'=>set_value('sales_bill_number'));
                                 echo form_input($order_number)?>
                    <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
               </div>
            <div class="form_sep " style="padding: 0 0 0 10px;">
                <label for="sales_bill_date" ><?php echo $this->lang->line('sales_bill_date') ?></label>													
                         <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                               <?php $sales_bill_date=array('name'=>'sales_bill_date',
                                                'class'=>'required form-control',
                                                'id'=>'sales_bill_date',
                                              'onKeyPress'=>"new_sales_bill_date(event)", 
                                                'value'=>set_value('order_date'));
                                 echo form_input($sales_bill_date)?>
                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    </div>
           </div>
        </div>
        <div class="col col-lg-8">
                
              
                <div class="row" style="padding-top: 1px; margin: auto;">
                        <div class="col col-lg-2"></div>
                         
                        <div class="col col-lg-8">
                            <div class="panel panel-default"  id="item_scan_panel" >
                            <div class="panel-heading" >
                                 <h4 class="panel-title"><?php echo $this->lang->line('scan')." ".$this->lang->line('items') ?></h4>

                          </div>
                             <label for="items" class="text-center" ><?php echo $this->lang->line('barcode')."/".$this->lang->line('EANUPC') ?></label>	
                            <input type="text" id="search_barcode" class="form-control search-input">
                            </div>
                        
                        </div>
                        <div class="col col-lg-2"></div>
                    </div>
            
            <div class="panel panel-default" style="margin-top: 4px ;display: none" id="item_search_panel" >
                <div class="panel-heading" >
                     <h4 class="panel-title"><?php echo $this->lang->line('search')." ".$this->lang->line('items') ?></h4>                                                                               
              </div>        
             <div class="row small_inputs" id="sales_items_list" style="margin-left: 0px;margin: 0px" >
                        <div class="col col-lg-12">
                            <div class="row" style="padding-top: 1px; margin: auto;margin-bottom: 10px;">
                                 
                                  
                                                <div class="col col-sm-3" style="padding:1px; ">
                                             
                                                   
                                             <label for="items" class="text-center" ><?php echo $this->lang->line('items') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $items=array('name'=>'items',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'items',
                                                                                    'value'=>set_value('items'));
                                                                     echo form_input($items)?>
                                                  </div>
                                         
                                                    <input type="hidden" id='diabled_item' class="form-control">                                                 
                                                    <input type="hidden" name="item_id" id="item_id">
                                                    <input type="hidden" name="tax_type" id="tax_type">
                                                    <input type="hidden" name="tax_Inclusive" id="tax_Inclusive">                                                 
                                                    <input type="hidden" name="tax_value" id="tax_value">
                                                    <input type="hidden" name="item_name" id="item_name">
                                                    <input type="hidden" name="sku" id="sku">
                                                    <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                                    <input type="hidden" name="stock_quty" id="stock_quty">
                                                    <input type="hidden" name="stock_id" id="stock_id">
                                                    <input type="hidden" name="discount" id="discount">
                                                    <input type="hidden" name="old_discount" id="old_discount">
                                                    <input type="hidden" name="old_tax" id="old_tax">
                                                        </div>
                                                
                                                 <div class="col col-lg-2" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" class="text-center" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control text-center',
                                                                                            'id'=>'quantity',
                                                                                            'onkeyup'=>"net_amount()", 
                                                                     'onKeyPress'=>"add_new_quty(event); return numbersonly(event)",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                
                                                
                                                
                                                     
                                              
                                                    <div class="col col-lg-2" style="padding:1px;">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" class="text-center" ><?php echo $this->lang->line('price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'price',
                                                                                            'disabled'=>'disabled',
                                                                  
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                          
                                                
                                  
                                  
                                               
                                             
                                                          <div class="col col-lg-1" style="padding:1px;">
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
                                                          <div class="col col-lg-1" style="padding:1px;">
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
                                               
                                                <div class="col col-lg-1" style="padding:1px;">
                                                   <div class="form_sep"> <label for="discount" class="text-center" ><?php echo $this->lang->line('discount') ?></label>
                                                            <?php $item_discount=array('name'=>'item_discount',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'item_discount',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('item_discount'));
                                                                             echo form_input($item_discount)?>
                                                                
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
                                               
                                               
                                               
                          
                                          
                                     <br>
                                                                     
                              </div>
                        </div>
                    </div>
                    </div>
<!--           fatay-->
        </div>
        <div class="col col-lg-2">
              <div class="form_sep " style="padding: 0 10px 0 0;">
                <label for="first_name" ><?php echo $this->lang->line('customer') ?></label>													
                      <?php $first_name=array('name'=>'first_name',
                                        'class'=>'required  form-control',
                                        'id'=>'first_name',

                                        'value'=>set_value('first_name'));
                         echo form_input($first_name)?>

            </div>
              <div class="form_sep " style="padding: 0 10px 0 0;">
                <label for="customer_discount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>													
                         <?php $customer_discount=array('name'=>'customer_discount',
                                            'class'=>'required  form-control',
                                            'id'=>'demo_customer_discount',
                                            'disabled'=>'disabled',
                                            'value'=>set_value('customer_discount'));
                             echo form_input($customer_discount)?>
                <input type="hidden" name="customer_discount" id="customer_discount">
                <input type="hidden" name="customers_guid" id="customers_guid">
           </div>
        </div>
    </div>
<div class="row" id="add_new_order"  style="margin-left: -4px;margin-right: -4px;margin-top: 20px">
    
                        <div class="col col-lg-12">
    
        
    <div id="main_content" style="padding: 0 16px  !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
                         
                         
                         
         
        
        
        <div class="row small_inputs" >
            
        </div>
                    <div class="row small_inputs" >
                    <div class="col col-lg-12">
                      
                         
                             
                              
                          
                          
                        <div class="row" ><input type="hidden" value="0" id='sl_number'>
             
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('order_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table dataTable ">
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
                                    <tbody id="new_order_items" >
                                       
                                    </tbody >
                                </table>
                                </div>
                                
                            </div>
                        </div>
                        
                    
                    </div><div class="col col-sm-2" style="display: none" >
                        <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                        <div class="row" style="margin-left: 5px">
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
                              </div>        
                                                         <div class="form_sep" style="padding: 0 25px">
                                                            <label for="sales_bill_number" ><?php echo $this->lang->line('sales_bill_number') ?></label>													
                                                                     <?php $order_number=array('name'=>'demo_sales_bill_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_sales_bill_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('sales_bill_number'));
                                                                         echo form_input($order_number)?>
                                                            <input type="hidden" name="keyboard_sales_bill_number" id="keyboard_sales_bill_number">
                                                       </div>
                                                        <div class="form_sep " style="padding: 0 25px">
                                                            <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                       
                                                        </div>
                                                          <div class="form_sep " style="padding: 0 25px">
                                                            <label for="customer_discount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('discount') ?> %</label>													
                                                                     <?php $customer_discount=array('name'=>'customer_discount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount)?>
                                                            <input type="hidden" name="customer_discount" id="customer_discount">
                                                            <input type="hidden" name="customers_guid" id="customers_guid">
                                                       </div>
                                                  <div class="form_sep " style="padding: 0 25px">
                                                            <label for="customer_discount_amount" ><?php echo $this->lang->line('customer').' '.$this->lang->line('disc').' '.$this->lang->line('amt') ?></label>													
                                                                     <?php $customer_discount_amount=array('name'=>'customer_discount_amount',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_customer_discount_amount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('customer_discount'));
                                                                         echo form_input($customer_discount_amount)?>
                                                            <input type="hidden" name="customer_discount_amount" id="customer_discount_amount">
                                                       </div>
                                                <div class="form_sep " style="padding: 0 25px">
                                                            <label for="sales_bill_date" ><?php echo $this->lang->line('sales_bill_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $sales_bill_date=array('name'=>'sales_bill_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'sales_bill_date',
                                                                                          'onKeyPress'=>"new_sales_bill_date(event)", 
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($sales_bill_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
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
                        
                       
                        
                    </div>  </div>  
    </div>
   
  </div>  
    

</div>
 <?php echo form_close();?>
<div class="row" style="margin: 20px;">
        <a href="" class="btn btn-info">F2 <i class="icon icon-barcode"></i> <?php echo $this->lang->line('scan') ?></a>
        <a href="" class="btn btn-info">F3 <i class="icon icon-search"></i> <?php echo $this->lang->line('search') ?></a>
        <a href="" class="btn btn-info">Alt+1 <i class="icon icon-user"></i> <?php echo $this->lang->line('customer') ?></a>
        <a href="" class="btn btn-info">Alt+2 <i class="icon icon-list"></i> <?php echo $this->lang->line('item_list') ?></a>
        <a href="" class="btn btn-info">Alt+3 <i class="icon icon-search"></i> <?php echo $this->lang->line('search_added_item') ?></a>
<!--        <a href="" class="btn btn-info">Delete+No <i class="icon icon-trash"></i> <?php echo $this->lang->line('delete_item') ?></a>-->
    </div>
          
		</div>
  
  


        

      

 <script src="<?php echo base_url() ?>template/app/validate/js/jquery.validate.min.js"></script>
<!--	<script src="<?php echo base_url() ?>template/app/js/lib/dataTables/media/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/pages/ebro_datatables.js"></script>-->
        <script src="<?php echo base_url() ?>template/app/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/jquery.ba-resize.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/jquery_cookie.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/retina.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/typeahead.js/typeahead.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/typeahead.js/hogan-2.0.0.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/tinynav.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/navgoco/jquery.navgoco.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/ebro_common.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/peity/jquery.peity.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/flot/jquery.flot.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/flot/jquery.flot.pie.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/pages/ebro_dashboard1.js"></script>
        <script src="<?php echo base_url() ?>template/app/js/lib/bootbox/bootbox.min.js"></script>
<!--[[ page specific plugins ]]-->

                <!-- 2col multiselect -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/multi-select/js/jquery.multi-select.js"></script>
                <!-- select2 -->
                        
                <!-- datepicker -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/datepicker/js/bootstrap-datepicker.js"></script>
                        <script src="<?php echo base_url() ?>template/app/js/lib/colorpicker/js/bootstrap-colorpicker.js"></script>
                <!-- iCheck -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/iCheck/jquery.icheck.min.js"></script>
                <!-- parsley -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/parsley/parsley.min.js"></script>
                        
                        <script src="<?php echo base_url() ?>template/app/js/pages/ebro_form_validate.js"></script>
<!-- jquery steps -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/jquery-steps/jquery.steps.min.js"></script>
                <!-- parsley -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/parsley/parsley.min.js"></script>
                        
                        
                        <script src="<?php echo base_url() ?>template/app/js/lib/jasny_plugins/bootstrap-fileupload.js"></script>
                        
                        <script src="<?php echo base_url() ?>template/app/js/pages/ebro_form_extended.js"></script>
<!-- datepicker -->
                        
                         <script src="<?php echo base_url() ?>template/app/validate/js/jquery.validate.min.js"></script>
                        
                      
                        <script src="<?php echo base_url() ?>template/app/validation/prettify.js"></script>
                <!-- timepicker -->
                        <script src="<?php echo base_url() ?>template/app/js/lib/timepicker/js/bootstrap-timepicker.min.js"></script>
                        <script src="<?php echo base_url() ?>template/app/validate/js/bootstrap-alert.js"></script>
                        <script src="<?php echo base_url() ?>template/app/validate/js/jquery.bootstrap-growl.js"></script>
                       
                      
        <!--[if lte IE 9]>
                <script src="<?php echo base_url() ?>template/app/js/ie/jquery.placeholder.js"></script>
                <script>
                        $(function() {
                                $('input, textarea').placeholder();
                        });
                </script>
        <![endif]-->
        
             </body>


</html>