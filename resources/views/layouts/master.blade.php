<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title>TK Paud</title>

    <!-- Bootstrap core CSS -->
    <link href="{!!asset('dist/css/bootstrap.min.css')!!}" rel="stylesheet">
    
    <!-- Icons -->
    <link href="{!!asset('css/font-awesome.css')!!}" rel="stylesheet">
    
    @yield('assetcss')

    
    <!-- Custom styles for this template -->
    <link href="{!!asset('css/style.css')!!}" rel="stylesheet">
    
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
      {{-- sidebar --}}
      @include('layouts.sidebar')
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
        {{-- navigasi --}}
        @include('layouts.navigasi')

				<section class="row">
					<div class="col-sm-12">
            {{-- Content --}}
            @yield('content')
            
            {{-- footer --}}
            @include('layouts.footer')
					</div>
				</section>
			</main>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{!!asset('js/jquery-3.2.1.min.js')!!}"></script>
    <script src="{!!asset('js/popper.min.js')!!}"></script>
    <script src="{!!asset('dist/js/bootstrap.min.js')!!}"></script>
    
    <script src="{!!asset('js/chart.min.js')!!}"></script>
    <script src="{!!asset('js/chart-data.js')!!}"></script>
    <script src="{!!asset('js/easypiechart.js')!!}"></script>
    <script src="{!!asset('js/easypiechart-data.js')!!}"></script>
    <script src="{!!asset('js/bootstrap-datepicker.js')!!}"></script>
    <script src="{!!asset('js/custom.js')!!}"></script>
    <script>
	    var startCharts = function () {
	                var chart1 = document.getElementById("line-chart").getContext("2d");
	                window.myLine = new Chart(chart1).Line(lineChartData, {
	                responsive: true,
	                scaleLineColor: "rgba(0,0,0,.2)",
	                scaleGridLineColor: "rgba(0,0,0,.05)",
	                scaleFontColor: "#c5c7cc "
	                });
	            }; 
	        window.setTimeout(startCharts(), 1000);
	</script>
    <script src="{!!asset('js/tether.min.js')!!}"></script>
    @yield('assetjs')
    
	</body>
</html>
