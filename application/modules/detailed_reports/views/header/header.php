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
        var test = $('#select_branch');
$('#select_branch').change(function() {
var ids =[];
     ids = $(test).val(); // works
    //var selections = $(test).filter('option:selected').text(); // doesn't work
    //var ids = $(test).select2('data').id; // doesn't work (returns 'undefined')
    //var selections = $(test).select2('data').text; // doesn't work (returns 'undefined')
    //var selections = $(test).select2('data');
    var selections = ( JSON.stringify($(test).select2('data')) );
    var data =$(test).select2('data') ;
  //  console.log('Selected IDs: ' + ids[1]);
  console.log(data.length);
  console.log(data[0]['id']);
    console.log('Selected options: ' + selections);
    //$('#selectedIDs').text(ids);
    //$('#selectedText').text(selections);
});

    });
    
   			
  </script>