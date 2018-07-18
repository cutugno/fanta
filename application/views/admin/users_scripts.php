<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	$(function() {
		<?php if ($this->session->user_read_400) : ?>
			swal({title:"", html:"<?= $this->session->user_read_400 ?>", type: "warning"});
		<?php endif ?>
		<?php if ($this->session->user_read_404) : ?>
			swal({title:"", html:"<?= $this->session->user_read_404 ?>", type: "warning"});
		<?php endif ?>		
	});
	
	var user_validation=function(form) {
		var dati=$("#user_form").serialize();
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
	
	$("#user_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_user_rules,
		messages: validation_user_messages,
		submitHandler: user_validation
	});
	
	$("body").on("click",".btn_delete_user",function() {
		var username=$(this).attr("data-username");
		var url="<?= site_url('admin/user_delete/') ?>"+username;
		swal({
		  title: '',
		  text: "Vuoi rimuovere questo utente?",
		  type: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Rimuovi',
		  cancelButtonText: 'Annulla',
		}).then(function () {			
			$.get(url)
			.done(function(resp) {
				swal({
				  title: '',
				  html: 'Utente cancellato',
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:"Errore cancellazione utente", type: "error"});
			});
		});
	});
</script>
