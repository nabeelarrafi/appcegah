
@extends('app.header')
@section('title', 'Dashboard')
@section('nav')
	<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	<li class="breadcrumb-item active" aria-current="page">Data {{ $data['region'] }}</li>
@endsection

@section('style')
    <!-- Internal Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Sweet Alert css -->
    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <style>
        .mt-3.list-group .list-group-item {
            border: none;
        }
    </style>
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
		<div class="row row-sm mb-3">
			<div class="col-md-12 col-lg-12 text-center">
                @if($data['is_detail'] && $data['region'] !== 'Nasional')
                    <h2 style="color: #4f66e0; text-shadow: 1.5px 1px #c0c0c0">Data {{ $data['chart_title'] }}</h2>
                @else
                    <h2 style="color: #4f66e0; text-shadow: 1.5px 1px #c0c0c0">Data {{ $data['chart_title'] }} {{ $data['region'] }}</h2>
                @endif
			</div>
        </div>

        @if($data['region'] !== 'Nasional')
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Filter Alokasi & Penyaluran
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="main-content-label tx-11 tx-medium tx-gray-900">Provinsi</label>
                                            <select name="provinsi" class="form-control select2">
                                                <option value="" label="Choose One"></option>
                                                @foreach ($data['province'] as $province)
                                                    @if($data['user_type'] === 'Nasional')
                                                        <option value="{{ $province->kode_wilayah }}">{{ $province->nama }}</option>
                                                    @else
                                                        @if($province->id === $data['user_reg'][0]->id_provinsi)
                                                            <option value="{{ $province->kode_wilayah }}">{{ $province->nama }}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($data['region'] === 'KabupatenKota')
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="main-content-label tx-11 tx-medium tx-gray-900 label-kabupatenkota">Kabupaten / Kota</label>
                                            <select name="kabupatenkota" class="form-control select2">
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary float-right search" type="button"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div id="table">
            @if($data['is_detail'])
                @if($data['region'] === 'Nasional')
                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header pb-0 pd-t-25">
                                    <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">Daftar Provinsi</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap table-striped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Provinsi</th>
                                                    <th>Tahap</th>
                                                    <th>Alokasi</th>
                                                    <th>Penyaluran</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['alokasi_salur'] as $alokasi_salur)
                                                    <tr>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">{{ $loop->iteration }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">{{ $alokasi_salur['prop'] }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">{{ $alokasi_salur['tahap'] }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">Rp. {{ number_format($alokasi_salur['nilai_alokasi']) }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">Rp. {{ number_format($alokasi_salur['nilai_salur']) }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:Province:Detail', ['kode_wilayah' => $alokasi_salur['kode_prop']]) }}">{{ round(($alokasi_salur['nilai_salur']/$alokasi_salur['nilai_alokasi'])*100, 2) }}%</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($data['region'] === 'Provinsi')
                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header pb-0 pd-t-25">
                                    <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">Daftar Kabupaten / Kota</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap table-striped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kabupaten / Kota</th>
                                                    <th>Tahap</th>
                                                    <th>Alokasi</th>
                                                    <th>Penyaluran</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['alokasi_salur'] as $alokasi_salur)
                                                    <tr>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">{{ $loop->iteration }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">{{ $alokasi_salur['kabkota'] }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">{{ $alokasi_salur['tahap'] }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">Rp. {{ number_format($alokasi_salur['nilai_alokasi']) }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">Rp. {{ number_format($alokasi_salur['nilai_salur']) }}</a></td>
                                                        <td><a href="{{ route('Admin:Dashboard:Distribution:City:Detail', ['kode_wilayah' => $alokasi_salur['kode_kabkota']]) }}">{{ round(($alokasi_salur['nilai_salur']/$alokasi_salur['nilai_alokasi'])*100, 2) }}%</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($data['region'] === 'KabupatenKota')
                    <div class="row row-sm">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header pb-0 pd-t-25">
                                    <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">Daftar Sekolah</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-md-nowrap table-striped" id="example2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sekolah</th>
                                                    <th>Tahap</th>
                                                    <th>Alokasi</th>
                                                    <th>Penyaluran</th>
                                                    <th>Persentase</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['alokasi_salur'] as $alokasi_salur)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $alokasi_salur['sekolah'] }}</td>
                                                        <td>{{ $alokasi_salur['tahap'] }}</td>
                                                        <td>Rp. {{ number_format($alokasi_salur['nilai_alokasi']) }}</td>
                                                        <td>Rp. {{ number_format($alokasi_salur['nilai_salur']) }}</td>
                                                        <td>{{ round(($alokasi_salur['nilai_salur']/$alokasi_salur['nilai_alokasi'])*100, 2) }}%</td>
                                                        <td>
                                                            <a class="btn btn-success btn-icon" href="{{ route('Admin:Dashboard:Distribution:School:Detail', ['npsn' => $alokasi_salur['npsn']]) }}"><i class="typcn typcn-zoom-in-outline"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
	</div>
	<!-- /Container -->
	@endsection

@endsection

@section('script')
    @if($data['is_detail'])
        <!-- Internal Data tables -->
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

        <!--Internal  Datatable js -->
        <script src="{{ asset('assets/js/table-data.js') }}"></script>
    @endif

    <!-- Internal Select2.min js -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/select2.js') }}" defer></script>

    <script src="{{ asset('assets/js/custom-sidemenu.js') }}" defer></script>

    <script>
        $(function() {
            const label_loader  =   `<div class="ml-1 spinner-border text-primary label-loader" style="width: 1rem; height: 1rem; font-size: 10px" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>`;
            const loader        =  `<div class="col-lg-12 col-md-12 text-center mt-5">
                                        <div class="spinner-border text-primary" style="width: 4rem; height: 4rem; font-size: 20px" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>`;

            @if($data['region'] === 'Provinsi' && $data['is_detail'])
                toggleMenu('.fa-hand-holding-usd', 'distribution/provinsi');
            @elseif($data['region'] === 'KabupatenKota' && $data['is_detail'])
            toggleMenu('.fa-hand-holding-usd', 'distribution/kabupatenkota');
            @endif

            @if($data['region'] === 'Provinsi')
                $('.search').click(function() {
                    let id  = $('select[name="provinsi"]').val();
                    let url = `{{ route('Admin:Dashboard:Distribution:Province') }}/${id}`;

                    $('#table').children().remove();
                    $('#table').html(loader);
                    $.ajax({
                        url: url,
                        method: 'post',
                        dataType: 'json',
                        data: {
                            _token : $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            $('#table').html(res)
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                });
            @endif

            @if($data['region'] === 'KabupatenKota')
                $('select[name="provinsi"]').change(function() {
                    let id  = $(this).val();
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/city/${id}`;
                
                    $('.label-kabupatenkota').append(label_loader);
                    $('select[name="kabupatenkota"]').load(url);
                    $('.label-loader').remove();
                })

                $('.search').click(function() {
                    let id  = $('select[name="kabupatenkota"]').val();
                    let url = `{{ route('Admin:Dashboard:Distribution:City') }}/${id}`;

                    $('#table').children().remove();
                    $('#table').html(loader);
                    $.ajax({
                        url: url,
                        method: 'post',
                        dataType: 'json',
                        data: {
                            _token : $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            $('#table').html(res)
                        },
                        error: function(err) {
                            console.log(err)
                        }
                    })
                });
            @endif
        })
    </script>
@endsection