<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/search_db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/car_db.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/analytics.php');
?>
<!----------------------------------------------------------------------------------HTML-------------------------------------------------------------------------------->

<html>

<body>
	<div class="container">
		<div class="card">
			<div id="wrapper">

				<header class="report_header">
					<p id="salesreport">SALES REPORTS</p>

					<div class="report1">
						<form action="index.php?a=report1" method="get">
							<div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="attribute" class="attribute"
										id="attribute_1" value="model" checked>
									<label class="form-check-label mb-2" for="attribute_1">model</label>
								</div>
								<div class="form-check">
									<input type="radio" name="attribute" id="attribute_2" class="form-check-input"
										value="body">
									<label class="form-check-label mb-2" for="attribute_2">body</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="attribute" class="attribute"
										id="attribute_3" value="color">
									<label class="form-check-label mb-3" for="attribute_3">color</label>
								</div>
								<div style="float: bottom; margin-right: 0.25%; width: 10%">
									<button type="button" name="submit_data" class="btn btn-outline-dark"
										id="submit_data">Generate</button>
								</div>
							</div>
							<br>
						</form>
					</div>
				</header>
			</div>
		</div>
</body>

</html>

<!---------------------------------------------------------------------------------CHART HTML---------------------------------------------------------------------------->

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-15">
			<div class="card mt-4 mb-4">
				<div class="card-header">Total Sales</div>
				<div class="card-body">
					<div class="chart-container bar-chart" id="chart_container">
						<canvas id="bar_chart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>

<!---------------------------------------------------------------------------------CHART SCRIPT-------------------------------------------------------------------------->


<script>
	$(document).ready(function () {

		$('#submit_data').click(function () {
			var attribute = $('input[name=attribute]:checked').val();
			makechart(attribute);
		});

		makechart();

		function makechart(attribute) {
			$.ajax({
				url: "reports/data.php",
				method: "POST",
				data: {
					action: attribute
				},
				dataType: "JSON",
				success: function (data) {
					var items = [];
					var total = [];
					var color = [];

					for (var count = 0; count < data.length; count++) {
						items.push(data[count].items);
						total.push(data[count].total);
						color.push(data[count].color);
					}

					var chart_data = {
						labels: items,
						datasets: [{
							label: 'Cars',
							backgroundColor: color,
							color: '#fff',
							data: total
						}]
					};

					var options = {
						responsive: true,
						scales: {
							yAxes: [{
								ticks: {
									min: 0
								}
							}]
						}
					};

					$("canvas#bar_chart").remove();
					$("#chart_container").append('<canvas id="bar_chart"></canvas>');

					var group_chart = $('#bar_chart');

					var graph = new Chart(group_chart, {
						type: 'bar',
						data: chart_data,
						options: options
					});
				}
			})
		}

	});
</script>