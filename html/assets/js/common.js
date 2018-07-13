	
	function isArray(obj) {
		return obj instanceof Array;
	}
	
	function resetForm($form) {
		$form.find('input:text, input:password, input:file, select, textarea').val('');
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
	
	// apro modale aggiorna password
	$("#changepwd").click(function() {
		$("#password_modal").modal();
	});
	
	// aggiorno password
	$("#btn_save_password").click(function() {
		var dati=$("#form_password").serialize();
		var url=$(this).attr("data-url");
		$.post(url, dati)
			.done(function(resp) {
				swal({
				  title: "",
				  html: resp,
				  type: "success",
				  confirmButtonColor: "#3085d6",
				  confirmButtonText: "Chiudi"
				}).then(function () {
				  $("#password_modal").modal("hide");
				  $('#form_password')[0].reset();
				});
			})
			.fail(function(xhr,resp,error) {
				swal({
				  title: "",
				  html: xhr.responseText,
				  type: "error",
				  confirmButtonColor: "#3085d6",
				  confirmButtonText: "Chiudi"
				}).then(function () {
				  $('#form_password')[0].reset();
				});
			});
	});


	
