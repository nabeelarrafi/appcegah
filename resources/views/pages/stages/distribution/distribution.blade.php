
@extends('app.header')
@section('title', 'Penyaluran')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Penyaluran</li>
@endsection

@section('style')
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
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Filter Sekolah
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Provinsi</label>
                                        <select name="provinsi" class="form-control select2">
                                            <option value="" label="Choose One"></option>
                                            @foreach ($data['province'] as $province)
                                                <option value="{{ $province->id_provinsi }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Kabupaten / Kota</label>
                                        <select name="kabupatenkota" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Kecamatan</label>
                                        <select name="kecamatan" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="" label="-- Pilih Status --"></option>
                                            <option value="Belum Dikerjakan">Belum Dikerjakan</option>
                                            <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                            <option value="Sudah Dikerjakan">Sudah Dikerjakan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Sekolah</label>
                                        <select name="sekolah" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahun Anggaran</label>
                                        <select name="tahun_anggaran" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right search" type="button"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="worksheet">
            
        </div>
	</div>
	<!-- /Container -->
	@endsection

    @section('script')
        <!-- Internal Select2.min js -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" defer></script>
        <script src="{{ asset('assets/js/select2.js') }}" defer></script>

    
        <script>
            const loader = `<div class="col-lg-12 col-md-12 text-center mt-5">
                                <div class="spinner-border text-primary" style="width: 4rem; height: 4rem; font-size: 20px" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`;

            $(document).ready(function() {
                $('.search').click(function() {
                    let id_sekolah      = $('select[name="sekolah"]').val();
                    let status          = $('select[name="status"]').val();
                    let tahun_anggaran  = $('select[name="tahun_anggaran"]').val();
                    let data = {
                        id_tahapan : 2,
                        id_sekolah : id_sekolah,
                        status : status,
                        tahun_anggaran : tahun_anggaran,
                        _token : $('meta[name="csrf-token"]').attr('content')
                    };
                    const url = "{{ route('Admin:Dashboard:Stages:Get:Worksheet3') }}";

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
                    let url = `{{ route('Admin:Dashboard:Index') }}/stages/sub/district/${id}`;

                    $('select[name="kecamatan"]').load(url);
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