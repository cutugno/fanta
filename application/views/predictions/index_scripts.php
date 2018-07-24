<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	$('.espandi').on('click', function () {
		$('#accordion .panel-collapse').collapse('show');
	});
	$('.contrai').on('click', function () {
		$('#accordion .panel-collapse').collapse('hide');
	});
	
	$(".input_result").change(function() {
		$(this).parent("td").addClass("has-error");
	});
	
	$(function() {
		<?php if ($this->session->user_read_400) : ?>
			swal({title:"", html:"<?= $this->session->user_read_400 ?>", type: "warning"});
		<?php endif ?>
		<?php if ($this->session->user_read_404) : ?>
			swal({title:"", html:"<?= $this->session->user_read_400 ?>", type: "warning"});
		<?php endif ?>
		$(".contrai").click();
	});
		
	var predictions_validation=function(form) {
		var dati=$(form).serialize();
		var url="<?= site_url('predictions/update') ?>";
		$.post(url, dati)
			.done(function(resp) {
				console.log(resp);	
				swal({
				  title: '',
				  html: resp,
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				$("#matches_table td").removeClass("has-error");
				setTimeout(function(){ location.reload() }, 2000);				
			})
			.fail(function(resp) {
				swal({title:"", html:resp.responseText, type: "error"});
			});
	};
	
	$(".predictions_form").each(function(){
		$(this).validate({
			errorPlacement: validation_error_placement,
			wrapper: "span",
			rules: validation_predictions_rules,
			messages: validation_predictions_messages,
			submitHandler: predictions_validation
		});
	});
</script>
