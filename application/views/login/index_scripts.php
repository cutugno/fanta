<script type="text/javascript">
	
	$(function () {
		$("input[name='username']").focus();
	});

	// login
	$("#btn_login").click(function(event) {
		event.preventDefault();
		event.returnValue=0;
		var dati=$("#form_login").serialize();
		var url="<?php echo site_url('login/checklogin') ?>";
		$.post(url, dati)
			.done(function() {
				swal({
				  title: '',
				  html: 'Login in corso...',
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.href="<?= base_url() ?>" }, 2000);
			})
			.fail(function() {
				swal({title:"", html:"Login errato", type: "error"});
			});
	});
			
</script>
