<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	var user_validation=function(form) {
		var dati=$("#login_form").serialize();
		var url="<?= site_url('admin/user_create') ?>";
		$.post(url, dati)
			.done(function(resp) {
				swal({
				  title: '',
				  html: 'Utente creato',
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:"Errore creazione utente", type: "error"});
			});
	};
	
	$("#login_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_user_rules,
		messages: validation_user_messages,
		submitHandler: user_validation
	});
</script>
