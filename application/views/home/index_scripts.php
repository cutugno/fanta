 <!-- custom script for this page-->
<script src="<?= site_url('js/sparkline-chart.js') ?>"></script>
<script src="<?= site_url('js/easy-pie-chart.js') ?>"></script>
<script src="<?= site_url('js/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?= site_url('js/jquery-jvectormap-world-mill-en.js') ?>"></script>
<script src="<?= site_url('js/xcharts.min.js') ?>"></script>
<script src="<?= site_url('js/jquery.autosize.min.js') ?>"></script>
<script src="<?= site_url('js/jquery.placeholder.min.js') ?>"></script>
<script src="<?= site_url('js/gdp-data.js') ?>"></script>
<script src="<?= site_url('js/morris.min.js') ?>"></script>
<script src="<?= site_url('js/sparklines.js') ?>"></script>
<script src="<?= site_url('js/charts.js') ?>"></script>
<script src="<?= site_url('js/jquery.slimscroll.min.js') ?>"></script>
<script>
  //knob
  $(function() {
	$(".knob").knob({
	  'draw': function() {
		$(this.i).val(this.cv + '%')
	  }
	})
  });

  //carousel
  $(document).ready(function() {
	$("#owl-slider").owlCarousel({
	  navigation: true,
	  slideSpeed: 300,
	  paginationSpeed: 400,
	  singleItem: true

	});
  });

  //custom select box

  $(function() {
	$('select.styled').customSelect();
  });

  /* ---------- Map ---------- */
  $(function() {
	$('#map').vectorMap({
	  map: 'world_mill_en',
	  series: {
		regions: [{
		  values: gdpData,
		  scale: ['#000', '#000'],
		  normalizeFunction: 'polynomial'
		}]
	  },
	  backgroundColor: '#eef3f7',
	  onLabelShow: function(e, el, code) {
		el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
	  }
	});
  });
</script>

<script type="text/javascript">
	
			
</script>
