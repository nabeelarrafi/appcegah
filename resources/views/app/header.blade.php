<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Admin Dashboard HRKU">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin, dashboard, premium, admin html, dash admin, best admin, admin theme, admin portal, simple admin, admin layout, new dashboard, html template for web application, simple dashboard template bootstrap, bootstrap 4 sidebar collapse, bootstrap 4 collapse sidebar, bootstrap dashboard template, simple bootstrap 4 template, simple admin panel template, admin dashboard bootstrap 4, bootstrap 4 admin template, bootstrap collapse sidebar, bootstrap simple dashboard, dashboard website template, bootstrap backend template, template admin bootstrap 4, bootstrap 4 admin template, bootstrap admin dashboard, ecommerce admin panel template"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Title -->
		<title> @yield('title') - Admin Dashboard </title>

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/Logo Cegah (1).png') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Icons css -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

		@yield('style')

		<!-- Internal Sweet Alert css -->
		<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

		<!--  Owl-carousel css-->
		{{-- <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" /> --}}

		<!--  Right-sidemenu css -->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

		<!-- Sidemenu css -->
		<link rel="stylesheet" href="{{ asset('assets/css/sidemenu.css') }}">

		<!-- Maps css -->
		{{-- <link href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet"> --}}

		<!-- Jvectormap css -->
        <link href="{{ asset('assets/plugins/jqvmap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

		<!-- style css -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style-dark.css') }}" rel="stylesheet">

		<!--- Color css-->
		<link href="{{ asset('assets/css/colors/color.css') }}" rel="stylesheet">

		<!---Skinmodes css-->
		<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

		<!--- Animations css-->
		<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">

    </head>
    <body class="main-body light-theme app sidebar-mini leftmenu-color">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('assets/img/loader-2.svg') }}" class="loader-img" alt="Loader">
		</div>
        <!-- /Loader -->

        @extends('app.sidemenu')

        @extends('app.top-nav')

        @yield('content')

	    @extends('app.footer')