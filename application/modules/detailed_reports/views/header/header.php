<link rel="stylesheet" href="<?php echo base_url() ?>template/date/css/daterangepicker-bs3.css"></script>
<script src="<?php echo base_url() ?>template/date/js/moment.js"></script>
<script src="<?php echo base_url() ?>template/date/js/daterangepicker.js"></script>
<script type="text/javascript" charset="utf-8">
    var point=3;
    $(document).ready( function () {
        $('.dataTable').hide();
        function format_branch(branch) {
            if (!branch.id) return branch.text;
                return  branch.code+" "+branch.text;
        }
        $('#select_branch').select2({
            formatResult: format_branch,
            formatSelection: format_branch,
            multiple:true,
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('branch') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/detailed_reports/get_branch',
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
                            text: item.store_name,
                            code: item.code
                        });
                    });
                    return {
                       results: results
                    };
                }
            }
        });
        function format_supplier(sup) {
            if (!sup.id) return sup.text;
                return  sup.code+" "+sup.text;
        }
        $('#select_suppliers').select2({
            formatResult: format_supplier,
            formatSelection: format_supplier,
            multiple:true,
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('suppliers') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/detailed_reports/search_suppliers',
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
                            code: item.company_name
                        });
                    });
                    return {
                       results: results
                    };
                }
            }
        });
          function format_item(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+' '+sup.value+' '+sup.category+' '+sup.brand+' '+sup.department+"</p>";
            }
          $('#purchase_items').select2({
              
             
             
                 formatResult: format_item,
                formatSelection: format_item,
                  multiple:true,
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/detailed_reports/search_purchase_items/',
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
                            term: term
                           
                        };
                    },
                    results: function (data) {
                      var results = [];
                      
                      $.each(data, function(index, item){
                        results.push({
                          id: item.i_guid,
                          text: item.name,
                          value: item.code,
                          image: item.image,
                          brand: item.b_name,
                          category: item.c_name,
                          department: item.d_name,
                          quty: item.quty,
                          cost: item.cost,
                          price: item.price,
                          mrp: item.mrp,
                          tax_type: item.tax_type_name,
                          tax_value: item.tax_value,
                          tax_Inclusive : item.tax_Inclusive ,
                        });
                      });   
                      return {
                       
                          results: results
                      };
                    }
                }
            });

    });
    function account_report(report){
        $('.dataTable').hide();
        var title=$('#'+report).text();      
        $('#report_val').val(report);
        if(report=='purchase_branch_base'){
            $('#branch_base').show();
            $('#supplier_base').hide();
            $('#select_purchase_items').hide();
            $('#title').text(' <?php echo $this->lang->line('purchase')?> '+title+' <?php echo $this->lang->line('report') ?>');
        }
        else if(report=='purchase_supplier_base'){
            $('#branch_base').hide();
            $('#supplier_base').show();
            $('#select_purchase_items').hide();
            $('#title').text(' <?php echo $this->lang->line('purchase')?> '+title+' <?php echo $this->lang->line('report') ?>');
        }
        else if(report=='purchase_items_base'){
            $('#branch_base').hide();
            $('#supplier_base').hide();
            $('#select_purchase_items').show();
             $('#title').text(' <?php echo $this->lang->line('purchase')?> '+title+' <?php echo $this->lang->line('report') ?>');
        }
    
    
        
    }
   			
  </script>