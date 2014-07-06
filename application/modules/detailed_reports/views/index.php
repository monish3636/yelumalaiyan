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
        $('.dataTable').hide();
        var title=$('#'+report).text();
        $('#title').text(title+' <?php echo $this->lang->line('report') ?>');
        $('#report_val').val(report);
        if(report=='sales'){
            $('#report_lable').text(title);
            $('#select_report').addClass('select_sales');
            sales();
        }
        $('#selection_row').show();
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
            url: "<?php echo base_url() ?>index.php/detailed_reports/get_report/",                      
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
                             
                if(report=='sales'){
                    $('.dataTable').hide();
                    $('#sales_table').show();
                    $('#sales_table tbody').remove();
                    $('#sales_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#sales_table tbody').append('<tr> \n\
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
                                                    <li>
							<li><a href="javascript:report('sales')" id='sales'><?php echo $this->lang->line('sales') ?></a></li>
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
							
							<li><a href="javascript:report('opening_stock')" id="opening_stock"><?php echo $this->lang->line('opening_stock') ?></a></li>
							<li><a href="javascript:report('stock_transfer')" id="stock_transfer"><?php echo $this->lang->line('stock_transfer') ?></a></li>
							<li><a href="javascript:report('damage_stock')" id="damage_stock"><?php echo $this->lang->line('damage_stock') ?></a></li>
							<li><a href="javascript:report('receiving_stock')" id="receiving_stock"><?php echo $this->lang->line('receiving_stock') ?></a></li>
							<li><a href="javascript:report('stock_level')" id="stock_level"><?php echo $this->lang->line('stock_history') ?></a></li>
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('payment') ?></a>
						<ul>
							
						
                                                        <li>
								<a href="javascript:void(0)"><?php echo $this->lang->line('supplier_payment') ?></a>
								<ul>
									<li><a href="javascript:report('supplier_payment_debit')" id="supplier_payment_debit"><?php echo $this->lang->line('supplier')." ".$this->lang->line('debit_payment') ?></a></li>
									<li><a href="javascript:report('supplier_payment_credit')" id="supplier_payment_credit"><?php echo $this->lang->line('supplier')." ".$this->lang->line('credit_payment') ?></a></li>
			
								</ul>
							</li>
                                                        <li>
								<a href="javascript:void(0)"><?php echo $this->lang->line('customer_payment') ?></a>
								<ul>
									<li><a href="javascript:report('customer_payment_debit')" id="customer_payment_debit"><?php echo $this->lang->line('customer')." ".$this->lang->line('debit_payment') ?></a></li>
									<li><a href="javascript:report('customer_payment_credit')" id="customer_payment_credit"><?php echo $this->lang->line('customer')." ".$this->lang->line('credit_payment') ?></a></li>
			
								</ul>
							</li>
                                                        <li>
								<a href="javascript:void(0)"><?php echo $this->lang->line('supplier_payable') ?></a>
								<ul>
									<li><a href="javascript:report('supplier_payable_debit')" id="supplier_payable_debit"><?php echo $this->lang->line('supplier')." ".$this->lang->line('debit_payable') ?></a></li>
									<li><a href="javascript:report('supplier_payable_credit')" id="supplier_payable_credit"><?php echo $this->lang->line('supplier')." ".$this->lang->line('credit_payable') ?></a></li>
			
								</ul>
							</li>
                                                        <li>
								<a href="javascript:void(0)"><?php echo $this->lang->line('customer_payable') ?></a>
								<ul>
									<li><a href="javascript:report('customer_payable_debit')" id="customer_payable_debit"><?php echo $this->lang->line('customer')." ".$this->lang->line('debit_payable') ?></a></li>
									<li><a href="javascript:report('customer_payable_credit')" id="customer_payable_credit"><?php echo $this->lang->line('customer')." ".$this->lang->line('credit_payable') ?></a></li>
			
								</ul>
							</li>
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('customers') ?></a>
						<ul>
							
							<li><a href="javascript:report('customers')" id="customers"><?php echo $this->lang->line('customers') ?></a></li>
							<li><a href="javascript:report('customer_category')" id="customer_category"><?php echo $this->lang->line('customer_category') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('suppliers') ?></a>
						<ul>
							
							<li><a href="javascript:report('suppliers')" id="suppliers"><?php echo $this->lang->line('suppliers') ?></a></li>
													
							<li><a href="javascript:report('suppliers_category')" id="suppliers_category"><?php echo $this->lang->line('suppliers_category') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('items') ?></a>
						<ul>
							
							<li><a href="javascript:report('item_category')" id="item_category"><?php echo $this->lang->line('category') ?></a></li>							
							<li><a href="javascript:report('item_department')" id="item_department"><?php echo $this->lang->line('item_department') ?></a></li>							
							<li><a href="javascript:report('item_brand')" id="item_brand"><?php echo $this->lang->line('brand') ?></a></li>							
							<li><a href="javascript:report('items')" id="item_kit"><?php echo $this->lang->line('items') ?></a></li>
													
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('tax') ?></a>
						<ul>
							
							<li><a href="javascript:report('item_tax')" id="item_tax"><?php echo $this->lang->line('taxes') ?></a></li>							
							<li><a href="javascript:report('item_tax_type')" id="item_tax_type"><?php echo $this->lang->line('tax_type') ?></a></li>							
							<li><a href="javascript:report('item_tax_area')" id="item_tax_area"><?php echo $this->lang->line('tax_area') ?></a></li>							
							
													
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('decomposition') ?></a>
						<ul>
							
							<li><a href="javascript:report('decomposition')" id="decomposition"><?php echo $this->lang->line('decomposition') ?></a></li>
							<li><a href="javascript:report('decomposition_type')" id="decomposition_type"><?php echo $this->lang->line('decomposition_type') ?></a></li>							
							<li><a href="javascript:report('decomposition_items')"  id="decomposition_items"><?php echo $this->lang->line('decomposition_items') ?></a></li>							
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('item_kit') ?></a>
						<ul>
							
							<li><a href="javascript:report('item_kit')" id="item_kit"><?php echo $this->lang->line('item_kit') ?></a></li>
							<li><a href="javascript:report('kit_category')" id="kit_category"><?php echo $this->lang->line('kit_category') ?></a></li>							
													
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('users') ?></a>
						<ul>
							
							<li><a href="javascript:report('users')" id="users"><?php echo $this->lang->line('users') ?></a></li>
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
    <div class="row" id="selection_row" style="display: none">
            <div class="col col-lg-4">
                  <div class="form_sep" >
                    <lable id="report_lable"></lable>
                    <input id="select_report"  > 
                  </div>
            </div>
           <label >.</label>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-eye-open"></i> <?php echo $this->lang->line('view') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('xlsx') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('csv') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('pdf') ?></a>
           </div>
            
     
    </section>
<section style="overflow-x: scroll">
    <table id="sales_table" class="dataTable table-condensed table-bordered">
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
   
</section>
</div>
   
         


<script type="text/javascript">
    $('#date_range').daterangepicker({
//nj       {timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'
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
      