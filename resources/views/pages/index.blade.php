
@extends('app.header')
@section('title', 'Dasbor')
@section('nav')
	<li class="breadcrumb-item"><a href="#">Dasbor</a></li>
	<li class="breadcrumb-item active" aria-current="page">Grafik Nasional</li>
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
		<div class="row row-sm mb-3">
			<div class="col-md-12 col-lg-12 text-center">
				<h2 style="color: #4f66e0; text-shadow: 1.5px 1px #c0c0c0">Grafik {{ $data['title'] }}</h2>
			</div>
		</div>
		<div class="row row-sm">
			<div class="col-lg-7 col-md-7">
				<div class="card mg-b-20">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Alokasi dan Penyaluran Dana Bos
						</div>
						<p class="mg-b-20 card-sub-title tx-12 text-muted">Alokasi dan Penyaluran Dana BOS. (Dalam Triliun)</p>
						<div id="echart1" class="ht-350"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-5 col-lg-5 col-md-5">
				<div class="card">
					<div class="card-header pb-0 pd-t-25">
						<div class="d-flex justify-content-between">
							<h3 class="card-title mb-0">Data Sekolah</h3>
						</div>
						<p class="tx-12 text-muted mb-0">Data sekolah</p>
					</div>
					<div class="card-body">
						<div class="table-responsive ht-350">
							<table id="example1" class="table table-striped table-bordered text-nowrap" style="width:100%">
								<thead>
									<tr class="bold">
										<th class="border-bottom-0">Data</th>
										<th class="border-bottom-0">Jumlah</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Sekolah yang belum cleansing</td>
										<td>226.808 Sekolah</td>
									</tr>
									<tr>
										<td>Sekolah yang sudah cleansing</td>
										<td>216.808 Sekolah</td>
									</tr>
									<tr>
										<td>Sekolah yang tidak memiliki izin operasional</td>
										<td>260 Sekolah</td>
									</tr>
									<tr>
										<td>Sekolah yang memiliki kurang dari 60</td>
										<td>146.810 Sekolah</td>
									</tr>
									<tr>
										<td>Sekolah yang tidak memiliki npsn</td>
										<td>-</td>
									</tr>
									<tr>
										<td>Sekolah yang tidak kirim data cut off</td>
										<td>1700 Sekolah</td>
									</tr>
									<tr>
										<td>Siswa Ganda</td>
										<td>12.909 Siswa</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row row-sm">
			<div class="col-md-4">
				<div class="card mg-b-20 mg-md-b-0">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Realisasi Dana Bos
						</div>
						<p class="mg-b-20 card-sub-title tx-12 text-muted">Grafik Realisasi Dana BOS.</p>
						<div class="ht-200 ht-sm-300" id="flotPie1"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mg-b-20 mg-md-b-0">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Data RKAS
						</div>
						<p class="mg-b-20 card-sub-title tx-12 text-muted">Grafik Kirim Data RKAS.</p>
						<div class="ht-200 ht-sm-300" id="flotPie2"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card mg-b-20 mg-md-b-0">
					<div class="card-body">
						<div class="main-content-label mg-b-5">
							Rata-Rata Kepatuhan
						</div>
						<p class="mg-b-20 card-sub-title tx-12 text-muted">Grafik Rata-Rata Kepatuhan Sekolah.</p>
						<div class="ht-200 ht-sm-300" id="flotPie3"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- row close -->
	</div>
	<!-- /Container -->
	@endsection

	@section('script')
		<!-- Internal Flot js -->
		<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
		<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>

		<!-- Internal Chart flot js -->
		<script src="{{ asset('assets/js/chart.flot.js') }}"></script>

		<!--Internal Echart Plugin -->
		<script src="{{ asset('assets/plugins/echart/echart.js') }}"></script>
		<script src="{{ asset('assets/js/echarts.js') }}"></script>
		<script>
			$(document).ready(function() {
				const alokasi 	= {!! json_encode($data['alokasi']) !!};
				const pelaporan = {!! json_encode($data['pelaporan']) !!};
				const rkas		= {!! json_encode($data['rkas']) !!};
				const worksheet = {!! json_encode($data['worksheet']) !!};
				console.log(worksheet);
				pelaporanChart(pelaporan);
				rkasChart(rkas);
				alokasiChart(alokasi);
				worksheetChart(worksheet);
			})
		</script>
	@endsection

@endsection