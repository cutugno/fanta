<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="<?= site_url('js/Chart.bundle.min.js') ?>"></script>
<script type="text/javascript">
	
	function drawJSChart() {
		var chartData=$.ajax({
		  url: "<?= site_url('standings/standings_chart/chartjs') ?>",
		  dataType: "json",
		  async: false
		  }).responseText;
		chartData=JSON.parse(chartData);
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: chartData.labels,
				datasets: [{
					label: chartData.label,
					data: chartData.data,
					backgroundColor: chartData.colors
				}]
			},
			options: {
				legend: { display:false },
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	};
	
	$(function() {
		drawJSChart();
	});
	

	
	

	
	
	 // Load the Visualization API and the piechart package.
	google.charts.load('current', {'packages':['corechart']});
	  
	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);
	  
	function drawChart() {
	  var jsonData = $.ajax({
		  url: "<?= site_url('standings/standings_chart/google') ?>",
		  dataType: "json",
		  async: false
		  }).responseText;
		  
	  // Create our data table out of JSON data loaded from server.
	  var data = new google.visualization.DataTable(jsonData);

	  // Instantiate and draw our chart, passing in some options.
	  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	  var options = {
		  width: 700,
		  height: 400,
		  animation:{
			duration: 1000,
			easing: 'out',
			startup: true
		  },
		  legend: {position: 'none'},
		  allowHtml: true,
		  vAxis: {minValue:0, maxValue:<?= $max_standings ?>}
		};
	  chart.draw(data, options);
	}
</script>
