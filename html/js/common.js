	function resetForm($form) {
		$form.find('input:text, input:password, input:file, input:hidden, select, textarea').val('');
		$form.find('input:radio, input:checkbox')
			 .removeAttr('checked').removeAttr('selected');
	}

	$(function(){
		
		$('body').tooltip({
			selector: '[rel=tooltip]'
		});

		$('.tooltipped').tooltip();

		$('.datepicker').datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true
		});	
		
		$('.timepicker').timepicker({
			timeFormat: "HH:mm",
			controlType: 'select',
			oneLine: true
		});	
		
		$('.datetimepicker').datetimepicker({
			dateFormat: 'dd/mm/yy',
			timeFormat: "HH:mm",
			changeMonth: true,
			changeYear: true,
			controlType: 'select',
			oneLine: true,
			onSelect: function() {
				$(this).change();
			}
		});	
		
		$('.monthyearpicker').datepicker({
			dateFormat: 'mm/yy',
			changeMonth: true,
			changeYear: true,
			onClose: function(dateText, inst) { 
				$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
			}
		});
		
	});
	
	$('body').on('focus',".dyn_datepicker", function(){
		$(this).datepicker({
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true
		});	
	});
	
	$('body').on('focus',".dyn_datetimepicker", function(){
		$(this).datetimepicker({
			dateFormat: 'dd/mm/yy',
			timeFormat: "HH:mm",
			changeMonth: true,
			changeYear: true,
			controlType: 'select',
			oneLine: true
		});	
	});
	
	$('body').on('focus',".dyn_timepicker", function(){
		$(this).timepicker({
			timeFormat: "HH:mm",
			controlType: 'select',
			oneLine: true
		});	
	});
