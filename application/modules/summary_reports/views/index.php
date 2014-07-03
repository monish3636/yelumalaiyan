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
    section{
        margin: 32px;
    }
    .table-condensed thead > tr > th, .table-condensed tbody > tr > th, .table-condensed tfoot > tr > th, .table-condensed thead > tr > td, .table-condensed tbody > tr > td, .table-condensed tfoot > tr > td {
        padding: 3px 9px 2px;
    }
    .dataTable {
        max-width: 200% !important;
        width: 200% !important;
        margin-bottom: 50px;
        display: none;
    }
    .dataTable th{
        text-align: center;
    }
</style>	
<script type="text/javascript">
    function report(report){
            var title=$('#'+report).text();
            $('#title').text(title+' <?php echo $this->lang->line('report') ?>');
            $('#report_val').val(report);
    }
    function get_report(){
        var report= $('#report_val').val();
        var range=$('#date_range').val();
        var start_date=range.split(' - ')[0];
        var end_date=range.split(' - ')[1];
        var branch =$('#select_branch').select2('data');
        var branch_id=[];
        for(var i=0;i<branch.length;i++){
            branch_id[i]=branch[i]['id'];
        }
        $.ajax({                                      
            url: "<?php echo base_url() ?>index.php/summary_reports/get_report/",                      
            data: {
                report:report,
                start:start_date,
                end:end_date,
                branch:branch_id
                        
            }, 
            type:'POST',
            dataType: 'json',               
            success: function(data)        
            { 
                if(report=='sales_order'){
                    $('.dataTable').hide();
                    $('#sales_order_table').show();
                    $('#sales_order_table tbody').remove();
                    $('#sales_order_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        $('#sales_order_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["exp_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='sales_quotation'){
                    $('.dataTable').hide();
                    $('#sales_quotation_table').show();
                    $('#sales_quotation_table tbody').remove();
                    $('#sales_quotation_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        $('#sales_quotation_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["exp_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='sales_delivery_note'){
                    $('.dataTable').hide();
                    $('#sales_delivery_note_table').show();
                    $('#sales_delivery_note_table tbody').remove();
                    $('#sales_delivery_note_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['active_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#sales_delivery_note_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["sales_delivery_note_no"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["exp_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='direct_sales_delivery_note'){
                    $('.dataTable').hide();
                    $('#direct_sales_delivery_note_table').show();
                    $('#direct_sales_delivery_note_table tbody').remove();
                    $('#direct_sales_delivery_note_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#direct_sales_delivery_note_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='direct_sales'){
                    $('.dataTable').hide();
                    $('#direct_sales_table').show();
                    $('#direct_sales_table tbody').remove();
                    $('#direct_sales_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#direct_sales_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\\n\
                        </tr>')
                    }
                }
               
                else if(report=='sales_bill'){
                    $('.dataTable').hide();
                    $('#sales_bill_table').show();
                    $('#sales_bill_table tbody').remove();
                    $('#sales_bill_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#sales_bill_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["customer_discount_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_discount"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='sales_return'){
                    $('.dataTable').hide();
                    $('#sales_return_table').show();
                    $('#sales_return_table tbody').remove();
                    $('#sales_return_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#sales_return_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='purchase_order'){
                    $('.dataTable').hide();
                    $('#purchase_order_table').show();
                    $('#purchase_order_table tbody').remove();
                    $('#purchase_order_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#purchase_order_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["po_no"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["po_date"]+'</td>\n\
                            <td class="text-center">'+data[i]["exp_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='goods_receiving_note'){
                    $('.dataTable').hide();
                    $('#goods_receiving_note_table').show();
                    $('#goods_receiving_note_table tbody').remove();
                    $('#goods_receiving_note_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['grn_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#goods_receiving_note_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["po_no"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["po_date"]+'</td>\n\
                            <td class="text-center">'+data[i]["exp_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                
                
                
            }
        });        
    }
</script>

<nav id="top_navigation">
    <input type="hidden" id='report_val'>
    <div class="container">
					<ul id="text_nav_h" class="clearfix j_menu top_text_nav">
					<li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('sales') ?></a>
						<ul>
                                                    <li><a href="javascript:report('sales_quotation')" id="sales_quotation"><?php echo $this->lang->line('sales_quotation') ?></a></li>
							<li><a href="javascript:report('sales_order')" id='sales_order'><?php echo $this->lang->line('sales_order') ?></a></li>
							<li><a href="javascript:report('sales_delivery_note')" id='sales_delivery_note'><?php echo $this->lang->line('sales_delivery_note') ?></a></li>
							<li><a href="javascript:report('direct_sales_delivery_note')" id='direct_sales_delivery_note'><?php echo $this->lang->line('direct_sales_delivery_note') ?></a></li>
							<li><a href="javascript:report('direct_sales')" id='direct_sales'><?php echo $this->lang->line('direct_sales') ?></a></li>
<!--							<li><a href="javascript:report('touch_sales')" id='touch_sales'><?php echo $this->lang->line('touch_sales') ?></a></li>
							<li><a href="javascript:report('keyboard_sales')" id='keyboard_sales'><?php echo $this->lang->line('keyboard_sales') ?></a></li>-->
							<li><a href="javascript:report('sales_bill')" id='sales_bill'><?php echo $this->lang->line('sales_bill') ?></a></li>
							<li><a href="javascript:report('sales_return')" id='sales_return'><?php echo $this->lang->line('sales_return') ?></a></li>
<!--							<li>
								<a href="javascript:void(0)">Navigations</a>
								<ul>
									<li><a href="nav_side_accordion.html">Accordion Navigation</a></li>
									<li class="link_active"><a href="nav_side_icons.html">Icon Navigation</a></li>
								</ul>
							</li>-->
						</ul>
					</li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('purchase') ?></a>
						<ul>
							
							<li><a href="javascript:report('purchase_order')" id='purchase_order'><?php echo $this->lang->line('purchase_order') ?></a></li>
							
							<li><a href="javascript:report('goods_receiving_note')" id='goods_receiving_note'><?php echo $this->lang->line('goods_receiving_note') ?></a></li>
							<li><a href="javascript:report('direct_grn')" id='direct_grn'><?php echo $this->lang->line('direct_grn') ?></a></li>
							<li><a href="javascript:report('direct_invoice')" id='direct_invoice'><?php echo $this->lang->line('direct_invoice') ?></a></li>
							<li><a href="javascript:report('purchase_invoice')" id='purchase_invoice'><?php echo $this->lang->line('purchase_invoice') ?></a></li>
                                                        <li><a href="javascript:report('purchase_return')" id="purchase_return"><?php echo $this->lang->line('purchase_return') ?></a></li>
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('stock') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('opening_stock') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('stock_transfer') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('damage_stock') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('receiving_stock') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('stock_level') ?></a></li>
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('payment') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('supplier_payment') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('customer_payment') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('supplier_payable') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('customer_payable') ?></a></li>
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('customers') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('customers') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('customer_category') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('suppliers') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('suppliers') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('suppliers_x_items') ?></a></li>							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('suppliers_category') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('decomposition') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('decomposition') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('decomposition_types') ?></a></li>							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('decomposition_items') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('item_kit') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('item_kit') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('kit_category') ?></a></li>							
													
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('users') ?></a>
						<ul>
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('users') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('login_details') ?></a></li>							
													
							
							
                                                </ul>
                                        </li>
										
                                        </ul>
				</div>
</nav>
<nav id="mobile_navigation"></nav>
<section>
        <div class="row text-center">
            <h4 id='title' ></h4>
        </div>
        <div class="row">
            <div class="col col-lg-4">
                <lable><?php  echo $this->lang->line('branches') ?></lable>
                <input id="select_branch" class="form-control" >                   
            </div>
           <div class="col col-sm-3" >
           <div class="form_sep">
                    <label for="order_date" ><?php echo $this->lang->line('date_range') ?></label>
                     <div class="input-group  ">
                    <input id="date_range" class="form-control"  >
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                
                            
                        </div>
                        </div>
               </div>  <label >.</label>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-eye-open"></i> <?php echo $this->lang->line('view') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('xlsx') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('csv') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('pdf') ?></a>
           </div>
            
     
    </section>
<section style="overflow-x: scroll">
    <table id="sales_order_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_order') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('expiry_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_order')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="sales_quotation_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_quotation') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('expiry_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_quotation')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="sales_delivery_note_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_delivery_note') ?></th>
                <th><?php echo $this->lang->line('sales_order') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('expiry_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_delivery_note')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="direct_sales_delivery_note_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_delivery_note') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_delivery_note')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="direct_sales_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('direct_sales') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_quotation')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="sales_bill_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_bill') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('customer')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('sales_quotation')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="sales_return_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_return') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="purchase_order_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                   <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_order') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('expiry_date') ?></th>
                <th><?php echo $this->lang->line('purchase_order')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="goods_receiving_note_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                   <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_order') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('expiry_date') ?></th>
                <th><?php echo $this->lang->line('purchase_order')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</section>
</div>
   
         


<script type="text/javascript">
    $('#date_range').daterangepicker({
//       {timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'
           ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
               'Last 7 Days': [moment().subtract('days', 6), moment()],
               'Last 30 Days': [moment().subtract('days', 29), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
           },
           startDate: moment().subtract('days', 29),
           endDate: moment()
       },
       function(start, end) {
           $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
       }
    );
</script>
   
<script src="<?php echo base_url() ?>template/app/js/lib/jMenu/js/jMenu.jquery.js"></script>
      