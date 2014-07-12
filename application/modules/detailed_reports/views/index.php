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
    .dataTable thead{
        background: none repeat scroll 0 0 #007da9;
        color: #ffffff;
    }
    .table_footer{
        background: none repeat scroll 0 0 #007da9;
        border: medium none;
        color: #ffffff;
        font-weight: bold;
    }
    .no-border{
        border: none !important;
    }
      
</style>	
<script type="text/javascript">
    function report(report){
        $('.dataTable').hide();
        $('#branch_base').show();
        $('#supplier_base').hide();
        var title=$('#'+report).text();
        $('#title').text(title+' <?php echo $this->lang->line('report') ?>');
        $('#report_val').val(report);
    }
    function get_report(){
        
        var report= $('#report_val').val();
        var range=$('#date_range').val();
        var start_date=range.split(' - ')[0];
        var end_date=range.split(' - ')[1];
        if(report=='purchase_branch_base'){
            var branch =$('#select_branch').select2('data');
            var branch_id=[];
            for(var i=0;i<branch.length;i++){
                branch_id[i]=branch[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_purchase_branch_base_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    branch:branch_id

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                { 
                    $('.dataTable').hide();
                    $('#purchase_base_table').show();
                    $('#purchase_base_table tbody').remove();
                    $('#purchase_base_table').append('<tbody></tbody');
                    $('#purchase_base_table tfoot').remove();
                    $('#purchase_base_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var total_paid=0;
                    var total_balance=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                       var balance=parseFloat(data[i]['purchase_amount'])-parseFloat(data[i]['paid_amount'])
                        $('#purchase_base_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                        total_paid=parseFloat(total_paid)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    var num = parseFloat(total_paid);
                    totak_paid=num.toFixed(point);
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    $('#purchase_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
            });
        }
         else if(report=='purchase_filering'){
            var supplier =$('#select_suppliers').select2('data');
            var supplier_id=[];
            for(var i=0;i<supplier.length;i++){
                supplier_id[i]=supplier[i]['id'];
            }
            var item =$('#purchase_items').select2('data');
            var item_id=[];
            for(var i=0;i<item.length;i++){
                item_id[i]=item[i]['id'];
            }
            var brand =$('#purchase_items_brand').select2('data');
            var brand_id=[];
            for(var i=0;i<brand.length;i++){
                brand_id[i]=brand[i]['id'];
            }
            var department =$('#purchase_items_department').select2('data');
            var department_id=[];
            for(var i=0;i<department.length;i++){
                department_id[i]=department[i]['id'];
            }
            var category =$('#purchase_items_category').select2('data');
            var category_id=[];
            for(var i=0;i<category.length;i++){
                category_id[i]=category[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_purchase_items_all_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    supplier:supplier_id,
                    item:item_id,
                    category:category_id,
                    department:department_id,
                    brand:brand_id,
                    from_time:$('#from_time').val(),
                    to_time:$('#to_time').val(),

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                { 
                    $('.dataTable').hide();
                    $('#purchase_item_base_table').show();
                    $('#purchase_item_base_table tbody').remove();
                    $('#purchase_item_base_table').append('<tbody></tbody');
                    $('#purchase_item_base_table tfoot').remove();
                    $('#purchase_item_base_table').append('<tfoot></tfoot');
                    var total_item_discount=0;
                    var total_amount=0;
                    var total_tax=0;
                    var total_quty=0;
                    var total_free=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var tax=data[i]['tax_type_name']+'-'+data[i]['tax_value']+"% (<?php echo $this->lang->line('inclusive') ?>)";
                        var total=data[i]['amount'];
                        if(data[i]['tax_Inclusive']==1){
                            var tax=data[i]['tax_type_name']+'-'+data[i]['tax_value']+"(<?php echo $this->lang->line('exclusive') ?>)";
                            var total=data[i]['amount']+data[i]['tax'];
                            total_tax=parseFloat(total_tax)+parseFloat(data[i]["tax"]==""?0:data[i]["tax"]);
                        }
                        var quty=data[i]['quty'];
                        var free=data[i]['free'];
                        if(data[i]['received_quty']!=0 && data[i]['received_quty']!=""){
                            var quty=data[i]['received_quty']; 
                            var free=data[i]['received_free']; 
                       }
                        $('#purchase_item_base_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["first_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["company_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice_date"]+'</td>\n\
                            <td class="text-center">'+data[i]["time"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["b_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["d_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-right">'+data[i]["cost"]+'</td>\n\
                            <td class="text-right">'+data[i]["sell"]+'</td>\n\
                            <td class="text-right">'+data[i]["mrp"]+'</td>\n\
                            <td class="text-right">'+quty+'</td>\n\
                            <td class="text-right">'+free+'</td>\n\
                            <td class="text-right">'+tax+'</td>\n\
                            <td class="text-right">'+data[i]["tax"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_per"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amount"]+'</td> \n\
                            <td class="text-right">'+total+'</td>\n\
                        </tr>');
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["discount_amount"]==""?0:data[i]["discount_amount"]);
                        total_amount=parseFloat(total_amount)+parseFloat(total==""?0:total);
                        total_quty=parseFloat(total_quty)+parseFloat(quty==""?0:quty);
                        total_free=parseFloat(total_free)+parseFloat(free==""?0:free);
                     
                      //  total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    $('#purchase_item_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_quty+'</td>\n\
                        <td class="text-right table_footer">'+total_free+'</td>\n\
                        <td class="text-right table_footer"></td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer"></td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
            });
        }
        else if(report=='purchase_supplier_base'){
            var supplier =$('#select_suppliers').select2('data');
            var supplier_id=[];
            for(var i=0;i<supplier.length;i++){
                supplier_id[i]=supplier[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_purchase_supplier_base_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    supplier:supplier_id

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                { 
                    $('.dataTable').hide();
                    $('#purchase_base_table').show();
                    $('#purchase_base_table tbody').remove();
                    $('#purchase_base_table').append('<tbody></tbody');
                    $('#purchase_base_table tfoot').remove();
                    $('#purchase_base_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var total_paid=0;
                    var total_balance=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                       var balance=parseFloat(data[i]['purchase_amount'])-parseFloat(data[i]['paid_amount'])
                        $('#purchase_base_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                        total_paid=parseFloat(total_paid)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    var num = parseFloat(total_paid);
                    total_paid=num.toFixed(point);
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    $('#purchase_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
            });
        }
        else if(report=='sales_customers_base'){
            var customer =$('#select_customer').select2('data');
            var customer_id=[];
            for(var i=0;i<customer.length;i++){
                customer_id[i]=customer[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_sales_customer_base_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    customer:customer_id

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                {
                    $('.dataTable').hide();
                    $('#sales_base_table').show();
                    $('#sales_base_table tbody').remove();
                    $('#sales_base_table').append('<tbody></tbody');
                    $('#sales_base_table tfoot').remove();
                    $('#sales_base_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                     var total_paid=0;
                    var total_payable=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        var balance=parseFloat(data[i]["sales_amount"])-parseFloat(data[i]["paid_amount"]);
                        var num = parseFloat(balance);
                        balance=num.toFixed(point);
                        $('#sales_base_table tbody').append('<tr> \n\
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
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                        total_paid=parseFloat(total_paid)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_payable=parseFloat(total_payable)+parseFloat(balance==""?0:balance);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid+'</td>\n\
                        <td class="text-right table_footer">'+total_payable+'</td>\n\
                    </tr>');
                }
            
            });
        }
        else if(report=='sales_branch_base'){
            var branch =$('#select_branch').select2('data');
            var branch_id=[];
            for(var i=0;i<branch.length;i++){
                branch_id[i]=branch[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_sales_branch_base_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    branch:branch_id

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                {
                    $('.dataTable').hide();
                    $('#sales_base_table').show();
                    $('#sales_base_table tbody').remove();
                    $('#sales_base_table').append('<tbody></tbody');
                    $('#sales_base_table tfoot').remove();
                    $('#sales_base_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                     var total_paid=0;
                    var total_payable=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        var balance=parseFloat(data[i]["sales_amount"])-parseFloat(data[i]["paid_amount"]);
                        var num = parseFloat(balance);
                        balance=num.toFixed(point);
                        $('#sales_base_table tbody').append('<tr> \n\
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
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                        total_paid=parseFloat(total_paid)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_payable=parseFloat(total_payable)+parseFloat(balance==""?0:balance);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid+'</td>\n\
                        <td class="text-right table_footer">'+total_payable+'</td>\n\
                    </tr>');
                }
            
            });
        }
        else if(report=='sales_filter'){
            var customer =$('#select_customer').select2('data');
            var customer_id=[];
            for(var i=0;i<customer.length;i++){
                customer_id[i]=customer[i]['id'];
            }
            var item =$('#purchase_items').select2('data');
            var item_id=[];
            for(var i=0;i<item.length;i++){
                item_id[i]=item[i]['id'];
            }
            var brand =$('#purchase_items_brand').select2('data');
            var brand_id=[];
            for(var i=0;i<brand.length;i++){
                brand_id[i]=brand[i]['id'];
            }
            var department =$('#purchase_items_department').select2('data');
            var department_id=[];
            for(var i=0;i<department.length;i++){
                department_id[i]=department[i]['id'];
            }
            var category =$('#purchase_items_category').select2('data');
            var category_id=[];
            for(var i=0;i<category.length;i++){
                category_id[i]=category[i]['id'];
            }
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/get_sales_filtering_report/",                      
                data: {
                    start:start_date,
                    end:end_date,
                    customer:customer_id,
                    item:item_id,
                    category:category_id,
                    department:department_id,
                    brand:brand_id,
                    from_time:$('#from_time').val(),
                    to_time:$('#to_time').val(),

                }, 
                type:'POST',
                dataType: 'json',               
                success: function(data)        
                {
                    $('.dataTable').hide();
                    $('#sales_base_table').show();
                    $('#sales_base_table tbody').remove();
                    $('#sales_base_table').append('<tbody></tbody');
                    $('#sales_base_table tfoot').remove();
                    $('#sales_base_table').append('<tfoot></tfoot');
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        var amount=parseFloat(data[i]["quty"])*parseFloat(data[i]["price"]);
                        var tax_amount=parseFloat(amount)*parseFloat(data[i]["tax"])/100;
                        var discount_amount=parseFloat(amount)*parseFloat(data[i]["discount"])/100;
                        var tax=data[i]['tax_type_name']+'-'+data[i]["tax"]+'<?php echo $this->lang->line('inclusive') ?>';
                        if(data[0]['tax_Inclusive']==1){
                          amount=parseFloat(amount)+parseFloat(tax_amount);
                           var tax=data[i]['tax_type_name']+'-'+data[i]["tax"]+'<?php echo $this->lang->line('exclusive') ?>';
                        }                       
                        amount=parseFloat(amount)-parseFloat(discount_amount);
                        var num = parseFloat(amount);
                        amount=num.toFixed(point);
                        
                        $('#sales_base_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["first_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["company_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["time"]+'</td>\n\
                            <td class="text-right">'+data[i]["name"]+'</td>\n\
                            <td class="text-right">'+data[i]["code"]+'</td>\n\
                            <td class="text-right">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["b_name"]+'</td> \n\
                            <td class="text-right">'+data[i]["d_name"]+'</td>\n\
                            <td class="text-right">'+data[i]["price"]+'</td>\n\
                            <td class="text-right">'+data[i]["quty"]+'</td>\n\
                            <td class="text-right">'+parseFloat(data[i]["quty"])*parseFloat(data[i]["price"])+'</td>\n\
                            <td class="text-right">'+tax+'</td>\n\
                            <td class="text-right">'+tax_amount+'</td>\n\
                            <td class="text-right">'+data[i]["discount"]+'%</td>\n\
                            <td class="text-right">'+discount_amount+'</td>\n\
                            <td class="text-right">'+amount+'</td>\n\
                        </tr>');
                      
                        total_tax=parseFloat(total_tax)+parseFloat(tax_amount==""?0:tax_amount);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(discount_amount==""?0:discount_amount);
                        total_amount=parseFloat(total_amount)+parseFloat(amount==""?0:amount);
                      
                   
                    }
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_base_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer"></td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
            
            });
        }
      
        else{
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
                if(report=='sales_order'){
                    $('.dataTable').hide();
                    $('#sales_order_table').show();
                    $('#sales_order_table tbody').remove();
                    $('#sales_order_table').append('<tbody></tbody');
                    $('#sales_order_table tfoot').remove();
                    $('#sales_order_table').append('<tfoot></tfoot');                    
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                            
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_order_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                    
                }
                else if(report=='sales_quotation'){
                    $('.dataTable').hide();
                    $('#sales_quotation_table').show();
                    $('#sales_quotation_table tbody').remove();
                    $('#sales_quotation_table').append('<tbody></tbody');
                    $('#sales_quotation_table tfoot').remove();
                    $('#sales_quotation_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                          total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_quotation_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='sales_delivery_note'){
                    $('.dataTable').hide();
                    $('#sales_delivery_note_table').show();
                    $('#sales_delivery_note_table tbody').remove();
                    $('#sales_delivery_note_table').append('<tbody></tbody');
                    $('#sales_delivery_note_table tfoot').remove();
                    $('#sales_delivery_note_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_delivery_note_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='direct_sales_delivery_note'){
                    $('.dataTable').hide();
                    $('#direct_sales_delivery_note_table').show();
                    $('#direct_sales_delivery_note_table tbody').remove();
                    $('#direct_sales_delivery_note_table').append('<tbody></tbody');
                    $('#direct_sales_delivery_note_table tfoot').remove();
                    $('#direct_sales_delivery_note_table').append('<tfoot></tfoot');    
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#direct_sales_delivery_note_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='direct_sales'){
                    $('.dataTable').hide();
                    $('#direct_sales_table').show();
                    $('#direct_sales_table tbody').remove();
                    $('#direct_sales_table').append('<tbody></tbody');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#direct_sales_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
               
                else if(report=='sales_bill'){
                    $('.dataTable').hide();
                    $('#sales_bill_table').show();
                    $('#sales_bill_table tbody').remove();
                    $('#sales_bill_table').append('<tbody></tbody');
                    $('#sales_bill_table tfoot').remove();
                    $('#sales_bill_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_customer_discount_amount=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_tax=0;
                    var total_item_discount=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_customer_discount_amount=parseFloat(total_customer_discount_amount)+parseFloat(data[i]["customer_discount_amount"]==""?0:data[i]["customer_discount_amount"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);
                        total_tax=parseFloat(total_tax)+parseFloat(data[i]["total_tax"]==""?0:data[i]["total_tax"]);
                        total_item_discount=parseFloat(total_item_discount)+parseFloat(data[i]["total_discount"]==""?0:data[i]["total_discount"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_customer_discount_amount);
                    total_customer_discount_amount=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_tax);
                    total_tax=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_item_amount);
                    total_item_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_bill_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_customer_discount_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_tax+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='sales_return'){
                    $('.dataTable').hide();
                    $('#sales_return_table').show();
                    $('#sales_return_table tbody').remove();
                    $('#sales_return_table').append('<tbody></tbody');
                    $('#sales_return_table tfoot').remove();
                    $('#sales_return_table').append('<tfoot></tfoot');
                   
                    var total_items=0;                
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#sales_return_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='purchase_order'){
                    $('.dataTable').hide();
                    $('#purchase_order_table').show();
                    $('#purchase_order_table tbody').remove();
                    $('#purchase_order_table').append('<tbody></tbody');
                    $('#purchase_order_table tfoot').remove();
                    $('#purchase_order_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#purchase_order_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='goods_receiving_note'){
                    $('.dataTable').hide();
                    $('#goods_receiving_note_table').show();
                    $('#goods_receiving_note_table tbody').remove();
                    $('#goods_receiving_note_table').append('<tbody></tbody');
                    $('#goods_receiving_note_table tfoot').remove();
                    $('#goods_receiving_note_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
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
                            <td class="text-right">'+data[i]["grn_discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["grn_total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["grn_total_amt"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["grn_discount_amt"]==""?0:data[i]["grn_discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["grn_total_item_amt"]==""?0:data[i]["grn_total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["grn_total_amt"]==""?0:data[i]["grn_total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#goods_receiving_note_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='direct_grn'){
                    $('.dataTable').hide();
                    $('#direct_grn_table').show();
                    $('#direct_grn_table tbody').remove();
                    $('#direct_grn_table').append('<tbody></tbody');
                    $('#direct_grn_table tfoot').remove();
                    $('#direct_grn_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#direct_grn_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["grn_no"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["po_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#direct_grn_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='direct_invoice'){
                    $('.dataTable').hide();
                    $('#direct_invoice_table').show();
                    $('#direct_invoice_table tbody').remove();
                    $('#direct_invoice_table').append('<tbody></tbody');
                    $('#direct_invoice_table tfoot').remove();
                    $('#direct_invoice_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['order_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#direct_invoice_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice_no"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#direct_invoice_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
               
                else if(report=='purchase_invoice'){
                    $('.dataTable').hide();
                    $('#purchase_invoice_table').show();
                    $('#purchase_invoice_table tbody').remove();
                    $('#purchase_invoice_table').append('<tbody></tbody');
                    $('#purchase_invoice_table tfoot').remove();
                    $('#purchase_invoice_table').append('<tfoot></tfoot');
                    var total_freight=0;
                    var total_round_amt=0;
                    var total_sales_discount=0;
                    var total_items=0;
                    var total_item_amount=0;
                    var total_amount=0;
                    var i=0;
                    for(i=0;i<data.length;i++){
                       
                        $('#purchase_invoice_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["discount_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["freight"]+'</td>\n\
                            <td class="text-right">'+data[i]["round_amt"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_item_amt"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amt"]+'</td>\n\
                        </tr>');
                        total_freight=parseFloat(total_freight)+parseFloat(data[i]["freight"]==""?0:data[i]["freight"]);
                        total_round_amt=parseFloat(total_round_amt)+parseFloat(data[i]["round_amt"]==""?0:data[i]["round_amt"]);
                        total_items=parseFloat(total_items)+parseFloat(data[i]["total_items"]==""?0:data[i]["total_items"]);                      
                        total_sales_discount=parseFloat(total_sales_discount)+parseFloat(data[i]["discount_amt"]==""?0:data[i]["discount_amt"]);
                        total_item_amount=parseFloat(total_item_amount)+parseFloat(data[i]["total_item_amt"]==""?0:data[i]["total_item_amt"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amt"]==""?0:data[i]["total_amt"]);
                    }
                    var num = parseFloat(total_freight);
                    total_freight=num.toFixed(point);
                    var num = parseFloat(total_round_amt);
                    total_round_amt=num.toFixed(point);
                    var num = parseFloat(total_sales_discount);
                    total_sales_discount=num.toFixed(point);
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_item_discount);
                    total_item_discount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#purchase_invoice_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_sales_discount+'</td>\n\
                        <td class="text-right table_footer">'+total_freight+'</td>\n\
                        <td class="text-right table_footer">'+total_round_amt+'</td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_item_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                    
                }  
                else if(report=='purchase_return'){
                    $('.dataTable').hide();
                    $('#purchase_return_table').show();
                    $('#purchase_return_table tbody').remove();
                    $('#purchase_return_table').append('<tbody></tbody');
                    $('#purchase_return_table tfoot').remove();
                    $('#purchase_return_table').append('<tfoot></tfoot');
                    var total_items=0;
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['stock_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#purchase_return_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#purchase_return_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='opening_stock'){
                    $('.dataTable').hide();
                    $('#opening_stock_table').show();
                    $('#opening_stock_table tbody').remove();
                    $('#opening_stock_table').append('<tbody></tbody');
                    $('#opening_stock_table tfoot').remove();
                    $('#opening_stock_table').append('<tfoot></tfoot');
                    var total_items=0;
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['stock_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#opening_stock_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#opening_stock_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='stock_transfer'){
                    $('.dataTable').hide();
                    $('#stock_transfer_table').show();
                    $('#stock_transfer_table tbody').remove();
                    $('#stock_transfer_table').append('<tbody></tbody');
                    $('#stock_transfer_table tfoot').remove();
                    $('#stock_transfer_table').append('<tfoot></tfoot');
                    var total_items=0;
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                        var branch =$('#select_branch').select2('data');   
                        var barnch_name;
                        var barnch_code;
                        for(var j=0;j<branch.length;j++){
                            if(data[i]['branch_id']=branch[j]['id']){
                                barnch_name=branch[j]['text'];
                                barnch_code=branch[j]['code'];
                            }
                        }
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['stock_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#stock_transfer_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+barnch_name+'</td>\n\
                            <td class="text-center">'+barnch_code+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["store_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#stock_transfer_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
            
                else if(report=='damage_stock'){
                    $('.dataTable').hide();
                    $('#damage_stock_table').show();
                    $('#damage_stock_table tbody').remove();
                    $('#damage_stock_table').append('<tbody></tbody');
                    $('#damage_stock_table tfoot').remove();
                    $('#damage_stock_table').append('<tfoot></tfoot');
                    var total_items=0;
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('waiting') ?>';
                        if(data[0]['stock_status']==1){
                            var status='<?php echo $this->lang->line('approved') ?>';
                        }
                        $('#damage_stock_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+status+'</td>\n\
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#damage_stock_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='receiving_stock'){
                    $('.dataTable').hide();
                    $('#receiving_stock_table').show();
                    $('#receiving_stock_table tbody').remove();
                    $('#receiving_stock_table').append('<tbody></tbody');
                    $('#receiving_stock_table tfoot').remove();
                    $('#receiving_stock_table').append('<tfoot></tfoot');
                    var total_items=0;
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                        var branch =$('#select_branch').select2('data');   
                        var barnch_name;
                        var barnch_code;
                        for(var j=0;j<branch.length;j++){
                            if(data[i]['destination']=branch[j]['id']){
                                barnch_name=branch[j]['text'];
                                barnch_code=branch[j]['code'];
                            }
                        }
                       
                        $('#receiving_stock_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+barnch_name+'</td>\n\
                            <td class="text-center">'+barnch_code+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["store_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_items"]+'</td> \n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                        </tr>');
                        total_items=parseFloat(total_items)+parseFloat(data[i]["no_items"]==""?0:data[i]["no_items"]);
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#receiving_stock_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-center table_footer">'+total_items+'</td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='stock_level'){
                    $('.dataTable').hide();
                    $('#stock_level_table').show();
                    $('#stock_level_table tbody').remove();
                    $('#stock_level_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                       
                        $('#stock_level_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["sku"]+'</td>\n\
                            <td class="text-center">'+data[i]["item_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["cost"]+'</td>\n\
                            <td class="text-center">'+data[i]["quty"]+'</td>\n\
                            <td class="text-center">'+data[i]["price"]+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='supplier_payment_debit'){
                    $('.dataTable').hide();
                    $('#supplier_payment_debit_table').show();
                    $('#supplier_payment_debit_table tbody').remove();
                    $('#supplier_payment_debit_table').append('<tbody></tbody');
                    $('#supplier_payment_debit_table tfoot').remove();
                    $('#supplier_payment_debit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                       
                        $('#supplier_payment_debit_table tbody').append('<tr> \n\
                             <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#supplier_payment_debit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='supplier_payment_credit'){
                    $('.dataTable').hide();
                    $('#supplier_payment_credit_table').show();
                    $('#supplier_payment_credit_table tbody').remove();
                    $('#supplier_payment_credit_table').append('<tbody></tbody');
                    $('#supplier_payment_credit_table tfoot').remove();
                    $('#supplier_payment_credit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                       
                        $('#supplier_payment_credit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#supplier_payment_credit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='customer_payment_debit'){
                    $('.dataTable').hide();
                    $('#customer_payment_debit_table').show();
                    $('#customer_payment_debit_table tbody').remove();
                    $('#customer_payment_debit_table').append('<tbody></tbody');
                    $('#customer_payment_debit_table tfoot').remove();
                    $('#customer_payment_debit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                       
                        $('#customer_payment_debit_table tbody').append('<tr> \n\
                             <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#customer_payment_debit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                else if(report=='customer_payment_credit'){
                    $('.dataTable').hide();
                    $('#customer_payment_credit_table').show();
                    $('#customer_payment_credit_table tbody').remove();
                    $('#customer_payment_credit_table').append('<tbody></tbody');
                    $('#customer_payment_credit_table tfoot').remove();
                    $('#customer_payment_credit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    for(var i=0;i<data.length;i++){
                       
                        $('#customer_payment_credit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#customer_payment_credit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                    </tr>');
                }
                
                else if(report=='supplier_payable_debit'){
                    $('.dataTable').hide();
                    $('#supplier_payable_debit_table').show();
                    $('#supplier_payable_debit_table tbody').remove();
                    $('#supplier_payable_debit_table').append('<tbody></tbody');
                    $('#supplier_payable_debit_table tfoot').remove();
                    $('#supplier_payable_debit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    var total_paid_amount=0;
                    var total_balance=0;
                    for(var i=0;i<data.length;i++){
                        var balance=parseFloat(data[i]["amount"])-parseFloat(data[i]["paid_amount"]);
                        $('#supplier_payable_debit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                        total_paid_amount=parseFloat(total_paid_amount)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                   
                    var num = parseFloat(total_items);
                    total_items=num.toFixed(point);
                    var num = parseFloat(total_paid_amount);
                    total_paid_amount=num.toFixed(point);
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    $('#supplier_payable_debit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
                
                else if(report=='supplier_payable_credit'){
                    $('.dataTable').hide();
                    $('#supplier_payable_credit_table').show();
                    $('#supplier_payable_credit_table tbody').remove();
                    $('#supplier_payable_credit_table').append('<tbody></tbody');
                    $('#supplier_payable_credit_table tfoot').remove();
                    $('#supplier_payable_credit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    var total_paid_amount=0;
                    var total_balance=0;
                    for(var i=0;i<data.length;i++){
                        var balance=parseFloat(data[i]["total_amount"])-parseFloat(data[i]["paid_amount"]);
                        $('#supplier_payable_credit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                        total_paid_amount=parseFloat(total_paid_amount)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                   
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    var num = parseFloat(total_paid_amount);
                    total_paid_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#supplier_payable_credit_table tfoot').append(' <tr >\n\
                         <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
                else if(report=='customer_payable_debit'){
                    $('.dataTable').hide();
                    $('#customer_payable_debit_table').show();
                    $('#customer_payable_debit_table tbody').remove();
                    $('#customer_payable_debit_table').append('<tbody></tbody');
                    $('#customer_payable_debit_table tfoot').remove();
                    $('#customer_payable_debit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    var total_paid_amount=0;
                    var total_balance=0;
                    for(var i=0;i<data.length;i++){
                        var balance=parseFloat(data[i]["total_amount"])-parseFloat(data[i]["paid_amount"]);
                        $('#customer_payable_debit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["total_amount"]==""?0:data[i]["total_amount"]);
                        total_paid_amount=parseFloat(total_paid_amount)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                   
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    var num = parseFloat(total_paid_amount);
                    total_paid_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#customer_payable_debit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
                
                else if(report=='customer_payable_credit'){
                    $('.dataTable').hide();
                    $('#customer_payable_credit_table').show();
                    $('#customer_payable_credit_table tbody').remove();
                    $('#customer_payable_credit_table').append('<tbody></tbody');
                    $('#customer_payable_credit_table tfoot').remove();
                    $('#customer_payable_credit_table').append('<tfoot></tfoot');
                    var total_amount=0;
                    var total_paid_amount=0;
                    var total_balance=0;
                    for(var i=0;i<data.length;i++){
                        var balance=parseFloat(data[i]["amount"])-parseFloat(data[i]["paid_amount"]);
                        $('#customer_payable_credit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["invoice"]+'</td>\n\
                            <td class="text-center">'+data[i]["s_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-right">'+data[i]["amount"]+'</td>\n\
                            <td class="text-right">'+data[i]["paid_amount"]+'</td>\n\
                            <td class="text-right">'+balance+'</td>\n\
                        </tr>');
                        total_amount=parseFloat(total_amount)+parseFloat(data[i]["amount"]==""?0:data[i]["amount"]);
                        total_paid_amount=parseFloat(total_paid_amount)+parseFloat(data[i]["paid_amount"]==""?0:data[i]["paid_amount"]);
                        total_balance=parseFloat(total_balance)+parseFloat(balance==""?0:balance);
                    }
                   
                    var num = parseFloat(total_balance);
                    total_balance=num.toFixed(point);
                    var num = parseFloat(total_paid_amount);
                    total_paid_amount=num.toFixed(point);
                    var num = parseFloat(total_amount);
                    total_amount=num.toFixed(point);
                    $('#customer_payable_credit_table tfoot').append(' <tr >\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="no-border"></td>\n\
                        <td class="text-right table_footer">'+total_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_paid_amount+'</td>\n\
                        <td class="text-right table_footer">'+total_balance+'</td>\n\
                    </tr>');
                }
                else if(report=='customers'){
                    $('.dataTable').hide();
                    $('#customers_table').show();
                    $('#customers_table tbody').remove();
                    $('#customers_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#customers_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["first_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["company_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["address"]+'</td>\n\
                            <td class="text-center">'+data[i]["email"]+'</td>\n\
                            <td class="text-center">'+data[i]["phone"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='customer_category'){
                    $('.dataTable').hide();
                    $('#customer_category_table').show();
                    $('#customer_category_table tbody').remove();
                    $('#customer_category_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#customer_category_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["discount"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='suppliers'){
                    $('.dataTable').hide();
                    $('#suppliers_table').show();
                    $('#suppliers_table tbody').remove();
                    $('#suppliers_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#suppliers_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["first_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["company_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["address1"]+'</td>\n\
                            <td class="text-center">'+data[i]["email"]+'</td>\n\
                            <td class="text-center">'+data[i]["phone"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["added_date"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='suppliers_category'){
                    $('.dataTable').hide();
                    $('#suppliers_category_table').show();
                    $('#suppliers_category_table tbody').remove();
                    $('#suppliers_category_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#suppliers_category_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='decomposition'){
                    $('.dataTable').hide();
                    $('#decomposition_table').show();
                    $('#decomposition_table tbody').remove();
                    $('#decomposition_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#decomposition_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["date"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_types"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_weight"]+'</td>\n\
                            <td class="text-center">'+data[i]["total_amount"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='decomposition_type'){
                    $('.dataTable').hide();
                    $('#decomposition_type_table').show();
                    $('#decomposition_type_table tbody').remove();
                    $('#decomposition_type_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#decomposition_type_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["type_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["value"]+'</td>\n\
                            <td class="text-center">'+data[i]["formula"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='decomposition_items'){
                    $('.dataTable').hide();
                    $('#decomposition_items_table').show();
                    $('#decomposition_items_table tbody').remove();
                    $('#decomposition_items_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var tax='<?php echo $this->lang->line('inclusive') ?>';
                        if(data[i]['tax_inclusive']==1){
                            var tax='<?php echo $this->lang->line('exclusive') ?>';
                        }
                        $('#decomposition_items_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+data[i]["type"]+'</td>\n\
                            <td class="text-center">'+data[i]["price"]+'</td>\n\
                            <td class="text-center">'+tax+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_kit'){
                    $('.dataTable').hide();
                    $('#item_kit_table').show();
                    $('#item_kit_table tbody').remove();
                    $('#item_kit_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var tax='<?php echo $this->lang->line('inclusive') ?>';
                        if(data[i]['tax_inclusive']==1){
                            var tax='<?php echo $this->lang->line('exclusive') ?>';
                        }
                        var status='<?php echo $this->lang->line('deactive') ?>';
            
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_kit_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+data[i]["no_of_items"]+'</td>\n\
                            <td class="text-center">'+data[i]["kit_price"]+'</td>\n\
                            <td class="text-center">'+data[i]["tax_amount"]+'('+data[i]["tax_type"]+'-'+data[i]["tax_value"]+'%)</td>\n\
                            <td class="text-center">'+tax+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='kit_category'){
                    $('.dataTable').hide();
                    $('#kit_category_table').show();
                    $('#kit_category_table tbody').remove();
                    $('#kit_category_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#kit_category_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_category'){
                    $('.dataTable').hide();
                    $('#item_category_table').show();
                    $('#item_category_table tbody').remove();
                    $('#item_category_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_category_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["category_name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_department'){
                    $('.dataTable').hide();
                    $('#item_department_table').show();
                    $('#item_department_table tbody').remove();
                    $('#item_department_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_department_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["department_name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_brand'){
                    $('.dataTable').hide();
                    $('#item_brand_table').show();
                    $('#item_brand_table tbody').remove();
                    $('#item_brand_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_brand_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='items'){
                    $('.dataTable').hide();
                    $('#items_table').show();
                    $('#items_table tbody').remove();
                    $('#items_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        var tax='<?php echo $this->lang->line('inclusive') ?>';
                        if(data[i]['tax_Inclusive']==1){
                            var tax='<?php echo $this->lang->line('exclusive') ?>';
                        }
                        $('#items_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+data[i]["code"]+'</td>\n\
                            <td class="text-center">'+data[i]["b_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["d_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["c_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["mrp"]+'</td>\n\
                            <td class="text-center">'+data[i]["cost_price"]+'</td>\n\
                            <td class="text-center">'+data[i]["selling_price"]+'</td>\n\\n\
                            <td class="text-center">'+data[i]["type"]+'-'+data[i]["value"]+'</td>\n\
                            <td class="text-center">'+tax+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_tax'){
                    $('.dataTable').hide();
                    $('#item_tax_table').show();
                    $('#item_tax_table tbody').remove();
                    $('#item_tax_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_tax_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["tax_type"]+'</td>\n\
                            <td class="text-center">'+data[i]["value"]+'%</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_tax_type'){
                    $('.dataTable').hide();
                    $('#item_tax_type_table').show();
                    $('#item_tax_type_table tbody').remove();
                    $('#item_tax_type_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_tax_type_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["type"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='item_tax_area'){
                    $('.dataTable').hide();
                    $('#item_tax_area_table').show();
                    $('#item_tax_area_table tbody').remove();
                    $('#item_tax_area_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['active_status']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#item_tax_area_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["name"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                else if(report=='users'){
                    $('.dataTable').hide();
                    $('#users_table').show();
                    $('#users_table tbody').remove();
                    $('#users_table').append('<tbody></tbody');
                    for(var i=0;i<data.length;i++){
                        var status='<?php echo $this->lang->line('deactive') ?>';
                        if(data[i]['user_active']==1){
                            var status='<?php echo $this->lang->line('active') ?>';
                        }
                        $('#users_table tbody').append('<tr> \n\
                            <td class="text-center">'+parseInt(i+1)+'</td>\n\
                            <td class="text-center">'+data[i]['store_name']+'</td>\n\
                            <td class="text-center">'+data[i]["bcode"]+'</td>\n\
                            <td class="text-center">'+data[i]["username"]+'</td>\n\
                            <td class="text-center">'+data[i]["first_name"]+'</td>\n\
                            <td class="text-center">'+data[i]["address"]+'</td>\n\
                            <td class="text-center">'+data[i]["email"]+'</td>\n\
                            <td class="text-center">'+data[i]["phone"]+'</td>\n\
                            <td class="text-center">'+status+'</td>\n\
                        </tr>')
                    }
                }
                
                
            }
        });        
    }
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
							<li><a href="javascript:report('decomposition')" id="decomposition"><?php echo $this->lang->line('decomposition') ?></a></li>
							<li><a href="javascript:report('decomposition_type')" id="decomposition_type"><?php echo $this->lang->line('decomposition_type') ?></a></li>							
							<li><a href="javascript:report('decomposition_items')"  id="decomposition_items"><?php echo $this->lang->line('decomposition_items') ?></a></li>							
							
							
							<li><a href="javascript:report('item_kit')" id="item_kit"><?php echo $this->lang->line('item_kit') ?></a></li>
							<li><a href="javascript:report('kit_category')" id="kit_category"><?php echo $this->lang->line('kit_category') ?></a></li>							
							<li><a href="javascript:report('item_tax')" id="item_tax"><?php echo $this->lang->line('taxes') ?></a></li>							
							<li><a href="javascript:report('item_tax_type')" id="item_tax_type"><?php echo $this->lang->line('tax_type') ?></a></li>							
							<li><a href="javascript:report('item_tax_area')" id="item_tax_area"><?php echo $this->lang->line('tax_area') ?></a></li>							
													
							
							
                                                </ul>
                                        </li>
                                        <li>
						<a href="javascript:void(0)"><?php echo $this->lang->line('users') ?></a>
						<ul>
							
							<li><a href="javascript:report('users')" id="users"><?php echo $this->lang->line('users') ?></a></li>
							<li><a href="javascript:report('')"><?php echo $this->lang->line('login_details') ?></a></li>							
													
							
							
                                                </ul>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><?php echo $this->lang->line('accounts') ?></a>
                                            <ul>

                                                <li><a href="javascript:void(0)"><?php echo $this->lang->line('purchase') ?></a>
                                                    <ul>
                                                        <li><a href="javascript:account_report('purchase_supplier_base')" id="purchase_supplier_base"><?php echo $this->lang->line('purchase') ?></a></li>
                                                        <li><a href="javascript:account_report('purchase_filering')" id="purchase_filering"><?php echo $this->lang->line('filtering') ?></a></li>
                                                       
                                                        <li><a href="javascript:account_report('purchase_branch_base')" id="purchase_branch_base"><?php echo $this->lang->line('branch_base') ?></a></li>							
                                                    
                                                    </ul>
                                                </li>
                                                <li><a href="javascript:(0)"><?php echo $this->lang->line('sales') ?></a>
                                                    <ul>
                                                        <li><a href="javascript:account_report('sales_customers_base')" id="sales_customers_base"><?php echo $this->lang->line('sales') ?></a></li>
                                                        <li><a href="javascript:account_report('sales_filter')" id="customers"><?php echo $this->lang->line('filtering') ?></a></li>
                                                        <li><a href="javascript:account_report('sales_branch_base')" id="customer_category"><?php echo $this->lang->line('branch_base') ?></a></li>							
                                                    </ul>
                                                </li>							
                                                <li><a href="javascript:report('profit_and_loss')" id="profit_and_loss"><?php echo $this->lang->line('profit_and_loss') ?></a></li>							



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
            <div class="col col-lg-4" id="branch_base" style="display: none">
                <lable><?php  echo $this->lang->line('branches') ?></lable>
                <input id="select_branch" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="supplier_base" style="display: none">
                <lable><?php  echo $this->lang->line('suppliers') ?></lable>
                <input id="select_suppliers" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="customer_base" style="display: none">
                <lable><?php  echo $this->lang->line('customer') ?></lable>
                <input id="select_customer" class="form-control" >                   
            </div>
           
            <div class="col col-lg-4" id="select_purchase_items" style="display: none">
                <lable><?php  echo $this->lang->line('items') ?></lable>
                <input id="purchase_items" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="decomposition_div" style="display: none">
                <lable><?php  echo $this->lang->line('decomposition') ?></lable>
                <input id="decomposition_input" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="kit_div" style="display: none">
                <lable><?php  echo $this->lang->line('item_kit') ?></lable>
                <input id="item_kit_input" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="select_purchase_items_category" style="display: none">
                <lable><?php  echo $this->lang->line('category') ?></lable>
                <input id="purchase_items_category" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="select_purchase_items_department" style="display: none">
                <lable><?php  echo $this->lang->line('item_department') ?></lable>
                <input id="purchase_items_department" class="form-control" >                   
            </div>
            <div class="col col-lg-4" id="select_purchase_items_brand" style="display: none">
                <lable><?php  echo $this->lang->line('brand') ?></lable>
                <input id="purchase_items_brand" class="form-control" >                   
            </div>
           <div class="col col-sm-3" >
           <div class="form_sep">
                    <label for="order_date" ><?php echo $this->lang->line('date_range') ?></label>
                     <div class="input-group  ">
                    <input id="date_range" class="form-control"  >
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                
                            
                        </div>
                        </div>
               </div> 
           <div class="col col-sm-2" id="time_filtering" style="display: none" >
            <div class="form-group" >
                
                <label><?php echo $this->lang->line('from') ?></label>
                 <div class="input-group clockpicker" id="from_clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                    <input type="text" class="form-control" value="<?php ?>">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
                <label><?php echo $this->lang->line('to') ?></label>
                 <div class="input-group clockpicker" id="to_clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                    <input type="text" class="form-control" value="">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>

            </div>
               <input type="hidden" name="from_time" id="from_time">
               <input type="hidden" name="to_time" id="to_time">
           </div> 
            
            <label >.</label>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-eye-open"></i> <?php echo $this->lang->line('view') ?></a>
<!--            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('xlsx') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('csv') ?></a>
            <a href="javascript:get_report()" class="btn btn-default"><i class="icon icon-table"></i> <?php echo $this->lang->line('pdf') ?></a>-->
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
        <tfoot></tfoot>
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
        <tfoot></tfoot>
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
         <tfoot></tfoot>
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
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
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
        <tfoot></tfoot>
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
                <th><?php echo $this->lang->line('sales')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ". $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable')." ".$this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
    <table id="sales_base_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_bill') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('time') ?></th>
                <th><?php echo $this->lang->line('items') ?></th>
                <th><?php echo $this->lang->line('sku') ?></th>
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('brand') ?></th>
                <th><?php echo $this->lang->line('item_department') ?></th>
                <th><?php echo $this->lang->line('price') ?></th>
                <th><?php echo $this->lang->line('quantity') ?></th>
                <th><?php echo $this->lang->line('subtotal') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('tax')." ".$this->lang->line('amount') ?></th>
                <th><?php echo $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('discount')." ".$this->lang->line('amount') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
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
         <tfoot></tfoot>
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
         <tfoot></tfoot>
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
         <tfoot></tfoot>
    </table>
    <table id="direct_grn_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                   <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('direct_grn') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('purchase')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="direct_invoice_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                   <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('direct_invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('purchase')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="purchase_invoice_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('purchase')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="purchase_base_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('order_date') ?></th>
                <th><?php echo $this->lang->line('purchase')." ".$this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('freight') ?></th>
                <th><?php echo $this->lang->line('round_off_amount') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('items')." ".$this->lang->line('total') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable')." ".$this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="purchase_item_base_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>               
                <th><?php echo $this->lang->line('time') ?></th>               
                <th><?php echo $this->lang->line('item') ?></th>               
                <th><?php echo $this->lang->line('sku') ?></th>               
                <th><?php echo $this->lang->line('brand') ?></th>               
                <th><?php echo $this->lang->line('item_department') ?></th>               
                <th><?php echo $this->lang->line('category') ?></th>               
                <th><?php echo $this->lang->line('cost') ?></th>
                <th><?php echo $this->lang->line('selling_price') ?></th>
                <th><?php echo $this->lang->line('mrp') ?></th>
                <th><?php echo $this->lang->line('quantity') ?></th>
                <th><?php echo $this->lang->line('free') ?></th>
                <th><?php echo $this->lang->line('tax')?></th>
                <th><?php echo $this->lang->line('tax_amount') ?></th>
                <th><?php echo $this->lang->line('discount') ?> %</th>
                <th><?php echo $this->lang->line('discount')." ".$this->lang->line('amount') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="purchase_return_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_return') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
    <table id="opening_stock_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('opening_stock') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="stock_transfer_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('stock_transfer') ?></th>
                <th><?php echo $this->lang->line('destination') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <table id="receiving_stock_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('receiving_stock') ?></th>
                <th><?php echo $this->lang->line('origin') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="damage_stock_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('damage_stock') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_items') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('approve') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="stock_level_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('invoice') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('sku') ?></th>
                <th><?php echo $this->lang->line('item')." ".$this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('cost') ?></th>
                <th><?php echo $this->lang->line('quantity') ?></th>
                <th><?php echo $this->lang->line('price') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="supplier_payment_debit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('payment') ?></th>
                <th><?php echo $this->lang->line('invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
          <tfoot></tfoot>
    </table>
   <table id="customer_payment_debit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('payment') ?></th>
                <th><?php echo $this->lang->line('purchase_return') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
   <table id="customer_payment_credit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('payment') ?></th>
                <th><?php echo $this->lang->line('invoice') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
   <table id="supplier_payment_credit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('payment') ?></th>
                <th><?php echo $this->lang->line('purchase_return') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
   <table id="supplier_payable_debit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
       <tfoot></tfoot>
    </table>
   <table id="supplier_payable_credit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('purchase_return') ?></th>
                <th><?php echo $this->lang->line('supplier') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
   <table id="customer_payable_debit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales_return') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>
   <table id="customer_payable_credit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('sales') ?></th>
                <th><?php echo $this->lang->line('customer') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('total_amount') ?></th>
                <th><?php echo $this->lang->line('paid_amount') ?></th>
                <th><?php echo $this->lang->line('payable_amount') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot></tfoot>
    </table>
   <table id="customers_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('address') ?></th>
                <th><?php echo $this->lang->line('email') ?></th>
                <th><?php echo $this->lang->line('phone') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('added_date') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
        
    </table>
   <table id="customer_category_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('discount') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="suppliers_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>
                <th><?php echo $this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('company') ?></th>
                <th><?php echo $this->lang->line('address') ?></th>
                <th><?php echo $this->lang->line('email') ?></th>
                <th><?php echo $this->lang->line('phone') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('added_date') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="suppliers_category_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="decomposition_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('decomposition') ?></th>
                <th><?php echo $this->lang->line('date') ?></th>
                <th><?php echo $this->lang->line('no_of_type') ?></th>
                <th><?php echo $this->lang->line('total_weight') ?></th>
                <th><?php echo $this->lang->line('amount') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="decomposition_type_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('decomposition_type') ?></th>
                <th><?php echo $this->lang->line('value') ?></th>
                <th><?php echo $this->lang->line('formula') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="decomposition_items_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('sku') ?></th>
                <th><?php echo $this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('weight') ?></th>
                <th><?php echo $this->lang->line('price') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_kit_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('sku') ?></th>
                <th><?php echo $this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('no_of_item') ?></th>
                <th><?php echo $this->lang->line('price') ?></th>
                <th><?php echo $this->lang->line('tax_amount') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="kit_category_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_category_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_department_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('item_department') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_brand_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('brand') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="items_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('name') ?></th>
                <th><?php echo $this->lang->line('sku') ?></th>
                <th><?php echo $this->lang->line('brand') ?></th>
                <th><?php echo $this->lang->line('item_department') ?></th>
                <th><?php echo $this->lang->line('category') ?></th>
                <th><?php echo $this->lang->line('mrp') ?></th>
                <th><?php echo $this->lang->line('cost') ?></th>
                <th><?php echo $this->lang->line('price') ?></th>
                <th><?php echo $this->lang->line('tax_type') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_tax_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('tax_type') ?></th>
                <th><?php echo $this->lang->line('tax') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_tax_type_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('tax_type') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="item_tax_area_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('tax_area') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
   <table id="users_table" class="dataTable table-condensed table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('sl_no') ?></th>
                <th><?php echo $this->lang->line('branch_code') ?></th>
                <th><?php echo $this->lang->line('branch_name') ?></th>                
                <th><?php echo $this->lang->line('user_name') ?></th>
                <th><?php echo $this->lang->line('first_name') ?></th>
                <th><?php echo $this->lang->line('address') ?></th>
                <th><?php echo $this->lang->line('email') ?></th>
                <th><?php echo $this->lang->line('phone') ?></th>
                <th><?php echo $this->lang->line('status') ?></th>
                
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</section>

	
</div>
   
         


<script type="text/javascript">
    
    $('#date_range').daterangepicker({

           ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
               'Last 7 Days': [moment().subtract('days', 6), moment()],
               'Last 30 Days': [moment().subtract('days', 29), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
           },
           startDate: moment().subtract('days', 29),
           endDate: moment(),
         
            
       },
       function(start, end) {
           $('#date_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
       }
    );
</script>
<script type="text/javascript" src="<?php echo base_url() ?>template/clock/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
$('#to_clockpicker').clockpicker()
	.find('input').change(function(){
		$('#to_time').val(this.value);
           
            
	});
$('#from_clockpicker').clockpicker()
	.find('input').change(function(){
		$('#from_time').val(this.value);
	});



</script>

<script src="<?php echo base_url() ?>template/app/js/lib/jMenu/js/jMenu.jquery.js"></script>
      