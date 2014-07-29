
<script type="text/javascript" charset="utf-8">
    var point=3;
    $(document).ready( function () {
        $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
        $('#add_new_order').show();
        parsley_reg.onsubmit=function()
        { 
            return false;
        } 
    } );
    function refresh_items_table(){
        $('#selected_item_table').dataTable().fnClearTable();
        if($('#selected_item_table').length) {
            $('#selected_item_table').dataTable({
                "bProcessing": true,
                "bDestroy": true ,
                "sPaginationType": "bootstrap_full",
                "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                    $("td:first", nRow).html(iDisplayIndex +1);
                    $("#index", nRow).val(iDisplayIndex +1);
                    return nRow;
                },
            });
        }
        $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
    }         
</script>
<script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  