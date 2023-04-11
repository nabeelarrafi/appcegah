
@extends('app.header')
@section('title', 'Penggunaan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Penggunaan</li>
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
        .hide {
            display: none !important;
        }
    </style>
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Filter Sekolah
                        </div>
                        <form action="{{ route($data['route']) }}" method="get">
                            <div class="row">
                                {{-- <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Sekolah</label>
                                        <select name="id_sekolah" class="form-control select2">
                                            <option value="" label="Choose One"></option>
                                            @foreach ($data['approval'] as $approval)
                                                <option value="{{ $approval->id_sekolah }}">{{ $approval->sekolah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahun Anggaran</label>
                                        <select name="id_tahun_anggaran" class="form-control">
                                            <option value="" label="-- Pilih Tahun Anggaran --"></option>
                                            @foreach ($data['year'] as $year)
                                                <option value="{{ $year->id_tahun_anggaran }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahap</label>
                                        <select name="id_tahapan" class="form-control">
                                            <option value="" label="-- Pilih Tahap --"></option>
                                            @foreach ($data['stages'] as $stage)
                                                <option value="{{ $stage->id_tahapan }}">{{ $stage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tingkat Risiko</label>
                                        <select name="risiko" class="form-control">
                                            <option value="" label="-- Pilih Kriteria --"></option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right search" type="submit"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 pd-t-25">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Daftar Sekolah</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">Sekolah</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sekolah</th>
                                        <th>Auditor</th>
                                        <th>Tahun</th>
                                        <th>Tahap</th>
                                        <th>Nilai</th>
                                        <th>Risiko</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['school'] as $school)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $school->sekolah }}</td>
                                            <td>{{ $school->auditor }}</td>
                                            <td>{{ $school->tahun }}</td>
                                            <td>{{ $school->tahap }}</td>
                                            <td>{{ round($school->nilai, 2) }}%</td>
                                            @if($school->nilai >= 80)
                                                <td>Rendah</td>
                                            @elseif($school->nilai < 50)
                                                <td>Tinggi</td>
                                            @elseif($school->nilai <= 80 || $school->nilai >= 50)
                                                <td>Sedang</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Field:Implementation:Worksheet', ['id_pengendalian' => $school->id_pengendalian, 'tahun' => $school->tahun]) }}" class="btn btn-primary btn-icon"><i style="font-size: 13px" class="fas fa-search-plus"></i></a>
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
	</div>
	<!-- /Container -->
	@endsection

    @section('script')
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

        <!-- Internal Select2.min js -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/select2.js') }}" defer></script>

        <script>
            function toogleWorksheet(el) {
                let id_title    = $(el).data('id-title');
                let worksheet   = $('.worksheet-table');

                $.each(worksheet, function(index, item) {
                    let id_worksheet = $(item).data('id-worksheet');

                    if(id_title === id_worksheet) $(item).toggleClass('hide');
                })
            }

            $(document).ready(function() {
                @if(Session::has('success'))
                swal(
                    {
                        title: 'Selesai!',
                        text: "{{ Session::get('success') }}",
                        type: 'success',
                        confirmButtonColor: '#57a94f'
                    }
                )
                @endif
                
                const loader = `<div class="col-lg-12 col-md-12 text-center mt-5">
                                    <div class="spinner-border text-primary" style="width: 4rem; height: 4rem; font-size: 20px" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>`;

                $('.search').click(function() {
                    let id_sekolah      = $('select[name="sekolah"]').val();
                    let status          = $('select[name="status"]').val();
                    let tahun_anggaran  = $('select[name="tahun_anggaran"]').val();
                    let tahap           = $('select[name="tahap"]').val();
                    let audit_type      = $('input[name="audit_type"]').val();
                    let data = {
                        id_tahapan : 3,
                        id_sekolah : id_sekolah,
                        status : status,
                        tahap : tahap,
                        audit_type : audit_type,
                        tahun_anggaran : tahun_anggaran,
                        _token : $('meta[name="csrf-token"]').attr('content')
                    };
                    const url = "{{ route('Admin:Dashboard:Stages:Get:Worksheet') }}";

                    $('.worksheet').html(loader);
                    $.ajax({
                        url : url,
                        data : data,
                        method : 'post',
                        dataType : 'json',
                        success : function(res) {
                            $('.worksheet').html(res);
                        }
                    });
                });

                $('select[name="provinsi"]').change(function() {
                    let id  = $(this).val();
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/city/${id}`;

                    $('select[name="kabupatenkota"]').load(url);
                });

                $('select[name="kabupatenkota"]').change(function() {
                    let id  = $(this).val();
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/school/${id}`;

                    $('select[name="sekolah"]').load(url);
                });

                $('select[name="kecamatan"]').change(function() {
                    let id  = $(this).val();
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/school/${id}`;

                    $('select[name="sekolah"]').load(url);
                });

                $('select[name="sekolah"]').change(function() {
                    let id  = $(this).val();
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/fiscal/year/${id}`;

                    $('select[name="tahun_anggaran"]').load(url);
                });
            })
        </script>
    @endsection

@endsection