
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
        function format(state) {
            if (!state.id) return state.text;
                return '<i class="flag-' + state.id + '"></i>' + state.text;
        }
        $('#select_branch').select2({
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
                            text: item.category_name
                        });
                    });
                    return {
                       results: results
                    };
                }
           }
        }).val("AU").trigger("change");


    });
    
				
  </script>