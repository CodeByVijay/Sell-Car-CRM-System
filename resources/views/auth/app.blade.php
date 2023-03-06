<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sell Car CRM - @yield('title')</title>

	<!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin/vendors/images/logo.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/vendors/images/logo.svg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/vendors/images/logo.svg') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/style.css')}}">
    @stack('style')
</head>
<body>
    <!-- Design & Developed By Vijay Amule -->
    <div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="{{route('login')}}">
					<img src="{{asset('admin/vendors/images/logo.svg')}}" alt="">
				</a>
			</div>
		</div>
	</div>

    @yield('content')
    <!-- js -->
    <script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('admin/vendors/scripts/layout-settings.js')}}"></script>
        {{-- Jquery Advance Validation --}}
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    @stack('script')
</body>
</html>
