<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= site_url('assets/js/jasny-bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery-ui-timepicker-addon.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/sweetalert2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.tablesorter.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.tablesorter.pager.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.tablesorter.widgets.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/my_tablesorter.js') ?>"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.js-dropdown').select2();
	});


</script>

<script type="text/javascript" src="<?php echo site_url('assets/js/select2.min.js'); ?>"></script>
<!-- DropDown Organizzatore + Loations + Evento -->
<script type="text/javascript" src="<?php echo site_url('assets/js/funzioni-servizio-search.js'); ?>"></script>
<!-- DateRange -->
<script>
    $(function(){

        $("#from").datepicker({ dateFormat: 'dd-mm-yy',  altField: "#to" }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("dd-mm-yy", minValue);
            minValue.setDate(minValue.getDate());
            $("#to").datepicker( "option", "minDate", minValue );

        })


        $("#to").datepicker({ dateFormat: 'dd-mm-yy' });
    });
</script>

<script>
    function resetForm($form) {
        $("#organizer_id").val('0').trigger('change');
        $("#posto_id").val('0').trigger('change');
        $("#tipo_titolo_id").val('0').trigger('change');
        $("#carta_attivazione_id").val('0').trigger('change');
        $("#progressivo").val('').trigger('change');
        $("#sigillo").val('').trigger('change');
        $("input[name=type][value=t]").attr('checked', 'checked');
        $("input[name=annullamento][value='']").attr('checked', 'checked');
        $('#from').datepicker("setDate",'' );
        $('#to').datepicker("setDate",'' );

        $("#turno_id").val('0').trigger('change');
        $("#barcode").val('').trigger('change');
        $("#progressivo_abbonamento").val('').trigger('change');
        $("#codice_abbonamento").val('').trigger('change');
        $("#puntovendita_id").val('0').trigger('change');
        $("#operatore_id").val('0').trigger('change');
    }
</script>


<script>
    function resetFormCa($form) {
        $("#sistema_emissione").val('0').trigger('change');

        $("#posto_id").val('0').trigger('change');
        $("#tipo_titolo_id").val('0').trigger('change');
        $("#carta_attivazione_id").val('0').trigger('change');
        $("#progressivo").val('').trigger('change');
        $("#sigillo").val('').trigger('change');
        $("#barcode").val('').trigger('change');
        $("input[name=type][value=t]").attr('checked', 'checked');
        $("input[name=annullamento][value='']").attr('checked', 'checked');
        $('#from').datepicker("setDate",'' );
        $('#to').datepicker("setDate",'' );
    }
</script>


