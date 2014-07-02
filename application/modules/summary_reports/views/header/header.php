<link rel="stylesheet" href="<?php echo base_url() ?>template/date/css/daterangepicker-bs3.css"></script>
<script src="<?php echo base_url() ?>template/date/js/moment.js"></script>
<script src="<?php echo base_url() ?>template/date/js/daterangepicker.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
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
                url: '<?php echo base_url() ?>index.php/Summary_reports/get_branch',
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


    });
    
   			
  </script>