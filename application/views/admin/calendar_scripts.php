<script src="<?= site_url('js/validation_rules.js') ?>"></script>
<script type="text/javascript">
	
	var no_calendar=$("#tpl_no_calendar").html();
	var giornata=$("#tpl_giornata").html();
	var btn_add_matches=$("#tpl_btn_add_matches").html();
	var btn_delete_calendar=$("#tpl_btn_delete_calendar").html();
	var c_giornate=0;
	
	$(".partita_input").change(function() {
		$(this).parent("div").addClass("has-error");
	});
	
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
					console.log(v);		
					var calendar_row=giornata.replace("%inizio%",v.inizio);
					calendar_row=calendar_row.replace("%fine%",v.fine);
					calendar_row=calendar_row.replace("%buttons%",btn_add_matches + btn_delete_calendar);
					calendar_row=calendar_row.replace(/%id%/g,v.id);
					calendar_row=calendar_row.replace(/%c%/g,c_giornate);
					calendar_row=calendar_row.replace(/%descr%/g,v.descr);	
					calendar_row=calendar_row.replace(/%started%/g,v.started);	
					calendar_row=calendar_row.replace(/%giornata_class%/g,v.class);	
					/* se si decide di disabilitare cambio date se giornata ha dei pronostici scommentare questo...
					var readonly=v.cpronostici > 0 ? "readonly" : "";
					var picker=v.cpronostici > 0 ? "" : " dyn_datetimepicker";
					*/
					var readonly,picker=""; /* ... e commentare questo */
					calendar_row=calendar_row.replace(/%readonly%/g,readonly);	
					calendar_row=calendar_row.replace(/%picker%/g,picker);	
					var matches_class=(v.matches.length==0) ? "text-danger" : "text-success";
					calendar_row=calendar_row.replace("%matches_class%",matches_class);
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
		var calendar_row=giornata.replace(/%descr%/g,"");
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
		var questo=$(this);
		swal({
		  title: '',
		  text: "Vuoi rimuovere questa giornata?",
		  type: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  confirmButtonText: 'Rimuovi',
		  cancelButtonText: 'Annulla',
		}).then(function () {
			var id=questo.attr("data-id");
			if (id != "%id%") { // non è una riga appena inserita, cancello anche da db
				var url="<?= site_url('admin/calendar_delete/') ?>"+id;
				$.get(url)
				.done(function(resp) {
					swal({
					  title: '',
					  html: resp,
					  showConfirmButton:false,
					  timer: 2000,
					  type: 'success'
					});
					setTimeout(function(){ location.reload() }, 2000);
				})
				.fail(function(resp) {
					swal({title:"", html:resp.responseText, type: "error"});
				});
			}else{ // riga appena inserita, cancello solo da vista
				questo.parent().parent("tr").remove();
				var rows=$("#calendar_table tbody tr").length;
				if (rows==0) $("#calendar_table tbody").html(no_calendar);
				$(".tofocus:last").focus();
			}
		});
	});
	
	$("body").on("click",".btn_add_matches",function() {
		resetForm($("#matches_form"));
		var id_giornata=$(this).attr("data-id_giornata");
		var descr_giornata=$(this).attr("data-descr_giornata");
		var started=$(this).attr("data-started");
		$("input[name='id_giornata']").val(id_giornata);
		$("#descr_giornata").html(descr_giornata);
		var url="<?= site_url('admin/matches_read/') ?>"+id_giornata;
		$.get(url,function(resp) {
			var matches=JSON.parse(resp);
			if (matches.length != 0) {
				$("#matches_form").attr("data-update",1);
				$.each(matches,function(k,v) {
					$("input[name='partita["+k+"][partita]']").val(v.partita);
					$("input[name='partita["+k+"][id]']").val(v.id);
					//$("input[name='partita["+k+"]']").attr("data-id_partita",v.id);
				});
			}
		});
		$("#btn_save_matches").toggle(started=="false");
		$(".partita_input").prop("disabled",started=="true");
		$("#matches_modal").modal();
	});
	
	var calendar_validation=function(form) {
		var dati=$("#calendar_form").serialize();
		var url="<?= site_url('admin/calendar_update') ?>";
		$.post(url, dati)
			.done(function(resp) {
				swal({
				  title: '',
				  html: resp,
				  showConfirmButton:false,
				  timer: 2000,
				  type: 'success'
				});
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:resp.responseText, type: "error"});
			});
	};
	
	$("#calendar_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_calendar_rules,
		messages: validation_calendar_messages,
		submitHandler: calendar_validation
	});

	var matches_validation=function(form) {
		var dati=$("#matches_form").serialize();
		var url="<?= site_url('admin/matches_update') ?>";
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
				setTimeout(function(){ location.reload() }, 2000);
			})
			.fail(function(resp) {
				swal({title:"", html:resp.responseText, type: "error"});
			});
	};
	
	$("#matches_form").validate({
		errorPlacement: validation_error_placement,
		wrapper: "span",
		rules: validation_matches_rules,
		messages: validation_matches_messages,
		submitHandler: matches_validation
	});
</script>
