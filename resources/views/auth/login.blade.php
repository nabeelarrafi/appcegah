<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="HR KU Admin Dashboard">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="Keywords" content="admin, dashboard, premium, admin html, dash admin, best admin, admin theme, admin portal, simple admin, admin layout, new dashboard, html template for web application, simple dashboard template bootstrap, bootstrap 4 sidebar collapse, bootstrap 4 collapse sidebar, bootstrap dashboard template, simple bootstrap 4 template, simple admin panel template, admin dashboard bootstrap 4, bootstrap 4 admin template, bootstrap collapse sidebar, bootstrap simple dashboard, dashboard website template, bootstrap backend template, template admin bootstrap 4, bootstrap 4 admin template, bootstrap admin dashboard, ecommerce admin panel template"/>

		<!-- Title -->
		<title> CEGAH - Admin Dashboard </title>

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/logo-kemendikbud.svg') }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

		<!-- Icons css -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

		<!--  Right-sidemenu css -->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

		<!--  Left-Sidebar css -->
		<link rel="stylesheet" href="{{ asset('assets/css/sidemenu.css') }}">

		<!--- Dashboard-2 css-->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/style-dark.css') }}" rel="stylesheet">

		<!--- Color css-->
		<link href="{{ asset('assets/css/colors/color.css') }}" rel="stylesheet">

		<!---Skinmodes css-->
		<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

		<!--- Animations css-->
		<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">

		<style>
			.logo {
				width: 15%;
				position: flex;
			}
			.btn {
				box-shadow: 0.005px 0.02px 8px 0.002px rgba(0,0,0,0.5);
				transition: .5s;
			}
			.btn:hover {
				box-shadow: none
			}
			.supported-by {
				position: absolute;
				transform: translateY(-25px);
			}
			.border-left {
				border-left: 3px solid #fff !important;
				position: absolute;
				left: 0;
				top: 14%;
  				bottom: 14%;
			}
			.logo.kemendagri {
				width: 13%;
			}
		</style>

	</head>
	<body class="main-body bg-light light-theme">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset('assets/img/loader-2.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- main-signin-wrapper -->
		<div class="my-auto page page-h">
			<div class="main-signin-wrapper error-wrapper">
				<div class="main-card-signin d-md-flex wd-100p">
				<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
					<div class="my-auto authentication-pages">
						<div>
							<img src="{{ asset('assets/img/brand/Logo Cegah asli.png') }}" width="80%" class="mb-4 ml-4" alt="logo">
							{{-- <h2 class="m-0 mb-4">CEGAH</h2> --}}
							<h5 class="mb-4" style="font-size: 1.1678rem">Cepat, Efektif, Menjaga Dana Bos Sekolah</h5>
							<p class="mb-5" style="font-size: 0.9rem">Menjalankan fungsi pengendalian terhadap
								perencanaan, penyaluran, pelaksanaan, dan
								pelaporan Dana Bos  sekolah yang diberikan
								pemerintah kepada seluruh sekolah yang ada di seluruh
								Negara Kesatuan Republik Indonesia.</p>
							<div class="col-md-12 supported-by">
								<div class="border-left"></div>
								<p style="display: inline-block; font-size: 12px; font-weight: 300;" class="mr-3">Sinergi Oleh : </p>
								<img src="{{ asset('assets/img/brand/logo-kemendikbud.svg') }}" class="logo mr-1" alt="logo">
								<img src="{{ asset('assets/img/brand/logo-kemenkeu.png') }}" class="logo mr-1" alt="logo">
								<img src="{{ asset('assets/img/brand/logo-kemendagri.png') }}" class="logo mr-1 kemendagri" alt="logo">
							</div>
						</div>
					</div>
				</div>
				<div class="p-5 wd-md-50p">
					<div class="main-signin-header">
						<h2>Selamat Datang!</h2>
						<h4>Masuk untuk melanjutkan</h4>
						@if (Session::has('error'))
						<div class="alert alert-outline-danger mg-b-0 mb-3" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							{{ Session::get('error') }}
						</div>
						@endif
						<form action="{{ route('Admin:Login:Store') }}" method="POST">
							@csrf
							<div class="form-group">
								<label>Nama Pengguna</label><input class="form-control" name="username" placeholder="Masukkan nama pengguna" type="text" value="{{ old('username') }}">
							</div>
							<div class="form-group">
								<label>Kata Sandi</label> <input class="form-control" name="password" placeholder="Masukkan kata sandi" type="password">
							</div><button type="submit" class="btn btn-main-primary btn-block">Masuk</button>
						</form>
					</div>
					<div class="main-signin-footer mt-3 mg-t-5">
						<p><a href="">Lupa kata sandi?</a></p>
					</div>
				</div>
			</div>
			</div>
		</div>
		<!-- /main-signin-wrapper -->

		<!-- JQuery min js -->
		<script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

		<!-- Ionicons js -->
		<script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

		<!-- Moment js -->
		<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

		<!-- eva-icons js -->
		<script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

		<!-- Rating js-->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>
		<script src="{{ asset('assets/plugins/rating/jquery.barrating.js') }}"></script>

		<!-- custom js -->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

	</body>
</html>