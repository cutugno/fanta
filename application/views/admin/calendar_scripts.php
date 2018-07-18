<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	var no_calendar=$("#tpl_no_calendar").html();
	var giornata=$("#tpl_giornata").html();
	var btn_add_matches=$("#tpl_btn_add_matches").html();
	var btn_delete_calendar=$("#tpl_btn_delete_calendar").html();
	var c_giornate=0;
	
	$(function() {
		<?php if ($this->session->user_read_400) : ?>
			swal({title:"", html:"<?= $this->session->user_read_400 ?>", type: "warning"});
		<?php endif ?>
		<?php if ($this->session->user_read_404) : ?>
			swal({title:"", html:"<?= $this->session->user_read_400 ?>", type: "warning"});
		<?php endif ?>
		
		// lista giornate
		var url="<?= site_url('admin/calendar_read') ?>";		
		$.get(url,function(resp) {
			var calendar=JSON.parse(resp);	
			if (calendar.length==0) {
				$("#calendar_table tbody").html(no_calendar);
			}else{
				var giornate="";
				$.each(calendar,function(k,v) {		
					var calendar_row=giornata.replace("%descr%",v.descr);					
					calendar_row=calendar_row.replace("%inizio%",v.inizio);
					calendar_row=calendar_row.replace("%fine%",v.fine);
					calendar_row=calendar_row.replace("%buttons%",btn_add_matches + btn_delete_calendar);
					calendar_row=calendar_row.replace(/%id%/g,v.id);
					calendar_row=calendar_row.replace(/%c%/g,c_giornate);
					$("#calendar_table tbody").append(calendar_row);
					c_giornate++;
				});						
			}			
		});
	});
	// aggiungi giornata calendario
	$("#btn_addcalendar").click(function() {
		var rows=$("#calendar_table tbody tr#nocal").length;
		if (rows==1) $("#calendar_table tbody").html("");
		var rows=$("#calendar_table tbody tr").length;		
		var calendar_row=giornata.replace("%descr%","");
		calendar_row=calendar_row.replace(/%c%/g,c_giornate);
		calendar_row=calendar_row.replace("%inizio%","");
		calendar_row=calendar_row.replace("%fine%","");
		calendar_row=calendar_row.replace("%buttons%",btn_delete_calendar);
		$("#calendar_table tbody").append(calendar_row);
		$(".tofocus:last").focus();
		c_giornate++;
	});
	
	// cancella giornata calendario
	$("body").on("click",".btn_delete_calendar",function(){
		$(this).parent().parent("tr").remove();
		var rows=$("#calendar_table tbody tr").length;
		if (rows==0) $("#calendar_table tbody").html(no_calendar);
		$(".tofocus:last").focus();
	});
	
	
	$("#btn_create").click(function() {
		/*
		var dati=$("#calendar_form").serialize();
		var url="<?= site_url('admin/calendar_update') ?>";
		$.post(url, dati)
			.done(function(resp) {
				console.log(resp);exit();
				swal({
				  title: '',
				  html: 'Calendario salvato',
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:"Errore creazione calendario", type: "error"});
			});
		*/	
	});
	
	var user_validation=function(form) {
		var dati=$("#calendar_form").serialize();
		var url="<?= site_url('admin/calendar_update') ?>";
		$.post(url, dati)
			.done(function(resp) {
				console.log(resp);exit();
				swal({
				  title: '',
				  html: 'Calendario salvato',
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:"Errore creazione calendario", type: "error"});
			});
	};
	
	$("#calendar_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_calendar_rules,
		messages: validation_calendar_messages,
		submitHandler: user_validation
	});

	
</script>
