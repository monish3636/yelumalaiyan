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
</style>	
<script type="text/javascript">
    function report(report){
            var title=$('#'+report).text();
            $('#title').text(title+' <?php echo $this->lang->line('report') ?>');
            $('#'+report).offsetParent().addClass('active');
    }
</script>

<nav id="top_navigation">

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
							<li><a href="javascript:report('touch_sales')" id='touch_sales'><?php echo $this->lang->line('touch_sales') ?></a></li>
							<li><a href="javascript:report('keyboard_sales')" id='keyboard_sales'><?php echo $this->lang->line('keyboard_sales') ?></a></li>
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
							
							<li><a href="javascript:report('')"><?php echo $this->lang->line('purchase_order') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('purchase_order_cancel') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('goods_receiving_note') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('direct_grn') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('direct_invoice') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('purchase_invoice') ?></a></li>
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
           <div class="col col-sm-4" >
           <div class="form_sep">
                    <label for="order_date" ><?php echo $this->lang->line('date_range') ?></label>													
                             <div id="reportrange"  >
                                <i class="icon icon-calendar "></i>
                                <span><?php echo date("F j, Y", strtotime('-30 day')); ?> - <?php echo date("F j, Y"); ?></span> <b class="caret"></b>
                            </div>
                        </div>
               </div>
           </div>
            
        </div>
    </section> 
   
         


<script type="text/javascript">
    $('#reportrange').daterangepicker(
       {
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
           $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
       }
    );
</script>
      </div>
</div>
<script src="<?php echo base_url() ?>template/app/js/lib/jMenu/js/jMenu.jquery.js"></script>
      