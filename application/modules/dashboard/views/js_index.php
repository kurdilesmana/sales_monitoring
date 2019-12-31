<script>
	$(function() {
		//-----------------------
		//- Area Chart Quantity -
		//-----------------------

		// Get context with jQuery - using jQuery's .get() method.
		var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
		// This will get the first returned node in the jQuery collection.
		var areaChart = new Chart(areaChartCanvas)
		var areaChartData = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			datasets: [{
				label: 'Digital Goods',
				fillColor: 'rgba(60,141,188,0.9)',
				strokeColor: 'rgba(60,141,188,0.8)',
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				// data: [28, 48, 40, 19, 86, 27, 90, 10, 80, 50, 70, 60]
				data: [<?php echo $salesQty ?>]
			}]
		}

		var areaChartOptions = {
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: false,
			//String - Colour of the grid lines
			scaleGridLineColor: 'rgba(0,0,0,.05)',
			//Number - Width of the grid lines
			scaleGridLineWidth: 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: false,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: true,
			//String - A legend template
			legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		}

		//Create the line chart
		areaChart.Line(areaChartData, areaChartOptions)

		//----------------------
		//- PIE CHART Quantity -
		//----------------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		var pieChart = new Chart(pieChartCanvas)
		var PieData = [
			<?php
			$color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];
			for ($i = 0; $i < count($areaQty); $i++) {
				$jumlah = $areaQty[$i]['jumlah'];
				$area = $areaQty[$i]['area'];
				echo "{
					value: $jumlah, 
					color: '$color[$i]', 
					highlight: '$color[$i]',
					label: '$area'
				},";
			} ?>
		]
		var pieOptions = {
			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,
			//String - The colour of each segment stroke
			segmentStrokeColor: '#fff',
			//Number - The width of each segment stroke
			segmentStrokeWidth: 2,
			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 50, // This is 0 for Pie charts
			//Number - Amount of animation steps
			animationSteps: 100,
			//String - Animation easing effect
			animationEasing: 'easeOutBounce',
			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,
			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: false,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true,
			// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//String - A legend template
			legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart.Doughnut(PieData, pieOptions)

		//--------------
		//- Area Chart Omset -
		//--------------

		// Get context with jQuery - using jQuery's .get() method.
		var areaChartCanvas = $('#areaChartOmset').get(0).getContext('2d')
		// This will get the first returned node in the jQuery collection.
		var areaChartOmset = new Chart(areaChartCanvas)
		var areaChartOmsetData = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			datasets: [{
				label: 'Digital Goods',
				fillColor: 'rgba(60,141,188,0.9)',
				strokeColor: 'rgba(60,141,188,0.8)',
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?php echo $salesOmset ?>]
			}]
		}

		//Create the line chart
		areaChartOmset.Line(areaChartOmsetData, areaChartOptions)

		//----------------------
		//- PIE CHART Quantity -
		//----------------------
		var pieChartCanvas = $('#pieChartOmset').get(0).getContext('2d')
		var pieChartOmset = new Chart(pieChartCanvas)
		var PieDataOmset = [
			<?php
			$color = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'];
			for ($i = 0; $i < count($areaOmset); $i++) {
				$jumlah = $areaOmset[$i]['jumlah'];
				$area = $areaOmset[$i]['area'];
				echo "{
					value: $jumlah, 
					color: '$color[$i]', 
					highlight: '$color[$i]',
					label: '$area'
				},";
			} ?>
		]
		pieChartOmset.Doughnut(PieDataOmset, pieOptions)
	})
</script>