$(document).ready(function() {



	$('select[name="organizer_id"]').on('change', function() {
		var stateID = $(this).val();
		if(stateID) {
			$.ajax({
				url: '/loadEventsOrganizer/'+stateID,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="event_id"]').empty();
					$('select[name="event_id"]').append('<option value="0">Tutti gli eventi</option>');
					$.each(data, function(key, value) {
						$('select[name="event_id"]').append('<option value="'+ value.id +'">'+
							'('+value.id+') ' + value.title + ' - ' +value.date_start +'</option>');
					});
				}
			});
		}

		if(stateID) {
			$.ajax({
				url: '/loadLocations/'+stateID,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="location_id"]').empty();
					$('select[name="location_id"]').append('<option value="0">Tutte le locations</option>');
					$.each(data, function(key, value) {
						$('select[name="location_id"]').append('<option value="'+ value.id +'">'+value
								.description+ ' - ( ' +value.comune + ', ' + value.provincia + ') </option>');
					});
				}
			});
		}else{
			$('select[name="organizer_id"]').empty();
		}


		/*if(stateID) {
		 $.ajax({
		 url: '/loadCartAttivazione/'+stateID,
		 type: "GET",
		 dataType: "json",
		 success:function(data) {
		 $('select[name="carta_attivazione_id"]').empty();
		 $('select[name="carta_attivazione_id"]').append('<option value="0">Scegli Carta Attivazione</option>');
		 $.each(data, function(key, value) {
		 $('select[name="carta_attivazione_id"]').append('<option value="'+ value.carta_attivazione
		 +'">'+value.carta_attivazione
		 +'</option>');
		 });
		 }
		 });
		 }else{
		 $('select[name="carta_attivazione_id"]').empty();
		 }*/
	});


	<!-- DropDown Locations -->
	$('select[name="location_id"]').on('change', function() {
		var stateID = $(this).val();
		var organizerID = $('select[name="organizer_id"]').val();
		if(stateID) {
			$.ajax({
				url: '/loadEventsLocation/'+stateID+'/'+organizerID,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="event_id"]').empty();
					$('select[name="event_id"]').append('<option value="0">Tutti gli eventi</option>');
					$.each(data, function(key, value) {
						$('select[name="event_id"]').append('<option value="'+ value.id +'">'+
							'('+value.id+') ' + value.title + ' - ' +value.date_start +'</option>');
					});
				}
			});

		}else{
			$('select[name="location_id"]').empty();
		}
	});


	<!-- DropDown Carta Attivazione -->
	/*$('select[name="carta_attivazione_id"]').on('change', function() {
	 var stateID = $(this).val();
	 if(stateID) {
	 $.ajax({
	 url: '/loadPostOrdine/'+stateID,
	 type: "GET",
	 dataType: "json",
	 success:function(data) {
	 $('select[name="posto_id"]').empty();
	 $('select[name="posto_id"]').append('<option value="0">Tutti ordini di posto</option>');
	 $.each(data, function(key, value) {
	 $('select[name="posto_id"]').append('<option value="'+ value.codice_ordine +'">'+
	 '('+value.codice_ordine+') ' + value.descr +'</option>');
	 });
	 }
	 });

	 }else{
	 $('select[name="posto_id"]').empty();
	 }


	 if(stateID) {
	 $.ajax({
	 url: '/loadTipoTitolo/'+stateID,
	 type: "GET",
	 dataType: "json",
	 success:function(data) {
	 $('select[name="tipo_titolo_id"]').empty();
	 $('select[name="tipo_titolo_id"]').append('<option value="0">Tutti tipi titolo</option>');
	 $.each(data, function(key, value) {
	 $('select[name="tipo_titolo_id"]').append('<option value="'+ value.tipo_titolo +'">'+
	 '('+value.tipo_titolo+') ' + value.descrizione +'</option>');
	 });
	 }
	 });
	 }else{
	 $('select[name="tipo_titolo_id"]').empty();
	 }
	 });*/
});