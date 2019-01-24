
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
    
    <!-- Custom styles for this template -->
    <link href="{!!asset('css/style.css')!!}" rel="stylesheet">
    
    <!--Theme Switcher-->
    <style id="hide-theme">
    	body {
			visibility: hidden;
		}
    </style>
    <script type="text/javascript">
    	function setTheme(name) {
	var theme = document.getElementById('theme-css');
	var style = 'css/theme-' + name + '.css';
	if (theme) {
		theme.setAttribute('href', style);
	} else {
		var head = document.getElementsByTagName('head')[0];
		theme = document.createElement("link");
		theme.setAttribute('rel', 'stylesheet');
		theme.setAttribute('href', style);
		theme.setAttribute('id', 'theme-css');
		head.appendChild(theme);
	}
	
	window.localStorage.setItem('bs4d-theme', name);
	}
	
	var selectedTheme = window.localStorage.getItem('bs4d-theme');
	if (selectedTheme) {
		setTheme(selectedTheme);
	}
	
	window.setTimeout(function() {
	var el = document.getElementById('hide-theme');
	el.parentNode.removeChild(el);
	}, 5);
    </script>
    <!-- End Theme Switcher -->
</head>
<body class="login-page">
	@yield('content')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{!!asset('dist/js/bootstrap.min.js')!!}"></script>
    
    <script src="{!!asset('js/custom.js')!!}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
	</body>
</html>
