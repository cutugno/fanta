$.tablesorter.addParser({
	id: 'orari',
	is: function(s, table, cell, $cell) {
	  return false;
	},
	format: function(s, table, cell, cellIndex) {
	  var $cell = $(cell);
	  return $cell.attr('data-orario') || s;
	},
	parsed: true, // lascia se parser serve anche da filtro
	type: 'numeric'
});

$.tablesorter.addParser({
	id: 'giorni',
	is: function(s, table, cell, $cell) {
	  return false;
	},
	format: function(s, table, cell, cellIndex) {
	  var $cell = $(cell);
	  return $cell.attr('data-giorno') || s;
	},
	parsed: true, // lascia se parser serve anche da filtro
	type: 'numeric'
});

$.tablesorter.addParser({
	id: 'motivobl',
	is: function(s, table, cell, $cell) {
	  return false;
	},
	format: function(s, table, cell, cellIndex) {
	  var $cell = $(cell);
	  return $cell.attr('data-motivobl') || s;
	},
	parsed: true, // lascia se parser serve anche da filtro
	type: 'numeric'
});

$.tablesorter.addParser({
	id: 'pubblicato',
	is: function(s, table, cell, $cell) {
	  return false;
	},
	format: function(s, table, cell, cellIndex) {
	  var $cell = $(cell);
	  return $cell.attr('data-pubblicato') || s;
	},
	parsed: true, // lascia se parser serve anche da filtro
	type: 'numeric'
});

$.tablesorter.addParser({
	id: 'pubblicato_s',
	is: function(s, table, cell, $cell) {
	  return false;
	},
	format: function(s, table, cell, cellIndex) {
	  var $cell = $(cell);
	  return $cell.attr('data-pubblicato_s') || s;
	},
	parsed: true, // lascia se parser serve anche da filtro
	type: 'numeric'
});

$(".tablesorter").tablesorter({
	//sortList: [[2,1],[3,1]],
	widthFixed: true, 
	widgets: ["filter"],
    dateFormat : "dd/mm/yyyy",
	cssInfoBlock : "avoid-sort", 
	cssChildRow: "tablesorter-child",
	headers: {
		'.noorder': {
			sorter:false
		},
		'.orari' : { 
			sorter: 'orari' 
		},
		'.giorni' : { 
			sorter: 'giorni' 
		},
		'.motivobl' : { 
			sorter: 'motivobl' 
		},
		'.pubblicato' : { 
			sorter: 'pubblicato' 
		},
		'.pubblicato_s' : { 
			sorter: 'pubblicato_s' 
		}
	},
	widgetOptions: {
		filter_functions: {
			'.motivobl': {
				"Già Utilizzati"	 : function(e, n, f, i, $r, c, data) { return e == "zt" || e == "zd" || e == "mt" || e == "md" ; },
				"Annullati"			 : function(e, n, f, i, $r, c, data) { return e == "at" || e == "ad" ; },
				"Blacklist"			 : function(e, n, f, i, $r, c, data) { return e == "dt" || e == "dd" || e == "ft" || e == "fd" || e == "bt" || e == "bd" ; },
			},
			'.orari': {
				"00:01 - 01:00"      : function(e, n, f, i, $r, c, data) { return e <= 100; },
				"01:01 - 02:00"      : function(e, n, f, i, $r, c, data) { return e > 100 && e <= 200; },
				"02:01 - 03:00"      : function(e, n, f, i, $r, c, data) { return e > 200 && e <= 300; },
				"03:01 - 04:00"      : function(e, n, f, i, $r, c, data) { return e > 300 && e <= 400; },
				"04:01 - 05:00"      : function(e, n, f, i, $r, c, data) { return e > 400 && e <= 500; },
				"05:01 - 06:00"      : function(e, n, f, i, $r, c, data) { return e > 500 && e <= 600; },
				"06:01 - 07:00"      : function(e, n, f, i, $r, c, data) { return e > 600 && e <= 700; },
				"07:01 - 08:00"      : function(e, n, f, i, $r, c, data) { return e > 700 && e <= 800; },
				"08:01 - 09:00"      : function(e, n, f, i, $r, c, data) { return e > 800 && e <= 900; },
				"09:01 - 10:00"      : function(e, n, f, i, $r, c, data) { return e > 900 && e <= 1000; },
				"10:01 - 11:00"      : function(e, n, f, i, $r, c, data) { return e > 1000 && e <= 1100; },
				"11:01 - 12:00"      : function(e, n, f, i, $r, c, data) { return e > 1100 && e <= 1200; },
				"12:01 - 13:00"      : function(e, n, f, i, $r, c, data) { return e > 1200 && e <= 1300; },
				"13:01 - 14:00"      : function(e, n, f, i, $r, c, data) { return e > 1300 && e <= 1400; },
				"14:01 - 15:00"      : function(e, n, f, i, $r, c, data) { return e > 1400 && e <= 1500; },
				"15:01 - 16:00"      : function(e, n, f, i, $r, c, data) { return e > 1500 && e <= 1600; },
				"16:01 - 17:00"      : function(e, n, f, i, $r, c, data) { return e > 1600 && e <= 1700; },
				"17:01 - 18:00"      : function(e, n, f, i, $r, c, data) { return e > 1700 && e <= 1800; },
				"18:01 - 19:00"      : function(e, n, f, i, $r, c, data) { return e > 1800 && e <= 1900; },
				"19:01 - 20:00"      : function(e, n, f, i, $r, c, data) { return e > 1900 && e <= 2000; },
				"20:01 - 21:00"      : function(e, n, f, i, $r, c, data) { return e > 2000 && e <= 2100; },
				"21:01 - 22:00"      : function(e, n, f, i, $r, c, data) { return e > 2100 && e <= 2200; },
				"22:01 - 23:00"      : function(e, n, f, i, $r, c, data) { return e > 2200 && e <= 2300; },
				"23:01 - 24:00"      : function(e, n, f, i, $r, c, data) { return e > 2300 && e <= 2400; },
			},
			'.pubblicato' : {
				"VENDIBILE"				 : function(e, n, f, i, $r, c, data) { return e == "v"; },
				"NON VENDIBILE"			 : function(e, n, f, i, $r, c, data) { return e == "nv"; },
				"CONCLUSO"				 : function(e, n, f, i, $r, c, data) { return e == "c"; }
			},
			'.pubblicato_s' : {
				"VENDIBILE"				 : function(e, n, f, i, $r, c, data) { return e == "v"; },
				"NON VENDIBILE"			 : function(e, n, f, i, $r, c, data) { return e == "nv"; }
			}
		}
	}
}) 	
.tablesorterPager({
	container: $(".pagin"),
	size: 50,
	output: '{startRow} - {endRow} di {filteredRows} (tot. {totalRows})'  
});		
