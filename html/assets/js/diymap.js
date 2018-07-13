function mapinfo(json){
  //$.getJSON( json, function( data ) {
	$.each( json, function( key, val ) {
		var elem = $('#' + key);
		if (val.color == 5){
		   elem.attr('visibility','hidden');
		   return;
		}   
		elem.find('rect').attr('fill', get_color(val.color));
		var tooltip = get_text(elem.find('title'), val);
		elem.find('title').text(tooltip);
	});
 // });	 
}

function get_color(id){
	if (id == 3) return '#0000FF'; // venduto abbonamento
	if (id == 2) return '#FF00FF'; // preotato abbonamento
	if (id == 1) return 'red'; // venduto biglietto
	if (id == 4) return '#C5AA45'; // prenotato biglietto
	if (id == 0) return '#808080'; // non disponibile
	if (id == 6) return '#3CB371'; // disponibile
	if (id == 7) return '#FF6600'; // cliccato
	// id == 5 -> visibility hidden
	
}

function get_text(elem, val){
	var t = elem.text();
	var date =  moment(val.expire).format('DD/MM/YYYY HH:mm');
	if(val.color == 2) return t + "\nRiservato a: " + val.name + "\nScadenza: " + date
	if(val.color == 3) return t + "\nAbbonato: " + val.name;
	if(val.color == 1 && val.name) return t + "\nOccupato da: " + val.name;
	if(val.color == 0) return t + "\nNon vendibile";
	return t;
}

function toggle_color(rect,state){
	if (rect.attr('fill') == get_color(state)) rect.attr('fill', get_color(6));
	else if (rect.attr('fill') == get_color(6)) rect.attr('fill', get_color(state));	 
}

function zoom_area(id){
	if (id == 'ALL'){
	    $('svg').children('g').attr('visibility','visible');
		var bbox = $('svg').get(0).getBBox();
		$('svg')[0].setAttribute('viewBox', [bbox.x, bbox.y, bbox.width, bbox.height].join(" "));
	} else {	
	    var bbox = $('g#' + id).get(0).getBBox();
	    $('svg')[0].setAttribute('viewBox', [bbox.x, bbox.y, bbox.width, bbox.height].join(" "));
	    $('g#' + id).attr('visibility','visible');
	    $('g#' + id).siblings().attr('visibility','hidden');
	}
}

function area_info(id) {
	$(".areainfo").hide();
	console.log(id);
	if (id != 'ALL') {
		$(".areainfo_"+id).show();
	}
}
	
	
