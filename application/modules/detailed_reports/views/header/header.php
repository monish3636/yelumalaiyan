<link rel="stylesheet" href="<?php echo base_url() ?>template/date/css/daterangepicker-bs3.css"></script>
<script src="<?php echo base_url() ?>template/date/js/moment.js"></script>
<script src="<?php echo base_url() ?>template/date/js/daterangepicker.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
        $('.dataTable').hide();
      
           

    });
    function sales(){
        $('.select_sales').change(function() {
            var guid=$('.select_sales').select2('data').id;
            $.ajax({                                      
                url: "<?php echo base_url() ?>index.php/detailed_reports/search_sales/"+guid,                      
                data: "", 
                dataType: 'json',               
                success: function(data)        
                { 
                }
            });
        });
        function format_sales(sale) {
            if (!sale.id) return sale.text;
                return  ''+sale.text+" "+sale.date+" "+sale.first_name+" "+sale.company_name+'';
        }
        $('.select_sales').select2({
            formatResult: format_sales,
            formatSelection: format_sales,
            placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('sales') ?>",
            ajax: {
                url: '<?php echo base_url() ?>index.php/detailed_reports/search_sales',
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
                            text: item.invoice,
                            first_name: item.first_name,
                            company_name: item.company_name,
                            date: item.date
                        });
                    });
                    return {
                       results: results
                    };
                }
            }
        });
    }
   			
  </script>