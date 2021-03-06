<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114897780-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-114897780-1');
    </script>
	<title>BrightPoint - Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	{{-- <link rel="icon" type="image/png" href="{{ URL::asset('form')}}/images/icons/favicon.ico"/> --}}
	<link rel="icon" type="image/png"  href="{{ URL::asset('public/images')}}/favicon-fix.png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/form')}}/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	@yield('content')
	
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ URL::asset('public/form')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{ URL::asset('public/form')}}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('public/form')}}/js/main.js"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	@yield('notification_message')

	
</body>
</html>