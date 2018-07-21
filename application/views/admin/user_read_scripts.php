<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	var user_validation=function(form) {
		var dati=$("#user_form").serialize();
		var url="<?= site_url('admin/user_update') ?>";
		$.post(url, dati)
			.done(function(resp) {
				swal({
				  title: '',
				  html: "Utente aggiornato",
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ window.location.href="<?= site_url('admin/users/') ?>"+resp }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:resp.responseText, type: "error"});
			});
	};
	
	$("#user_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_userupdate_rules,
		messages: validation_user_messages,
		submitHandler: user_validation
	});
	
	
</script>
