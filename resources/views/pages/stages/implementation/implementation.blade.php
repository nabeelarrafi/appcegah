
@extends('app.header')
@section('title', 'Penggunaan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Penggunaan</li>
@endsection

@section('style')
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
                    <div class="card-body filter">
                        <div class="main-content-label mg-b-5">
                            Filter Sekolah
                        </div>
                        <form action="" method="post" class="hide">
                            @csrf
                            <input type="hidden" name="audit_type" value="{{ $data['audit_type'] }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Provinsi</label>
                                        <select name="provinsi" class="form-control select2">
                                            <option value="" label="Choose One"></option>
                                            @foreach ($data['province'] as $province)
                                                <option value="{{ $province->kode_wilayah }}">{{ $province->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($data['user_type'] === 'KabupatenKota')
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900 label-kabupatenkota">Kabupaten / Kota</label>
                                        <select name="kabupatenkota" class="form-control select2">
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900 label-sekolah">
                                            Sekolah
                                        </label>
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
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahap</label>
                                        <select name="tahap" class="form-control">
                                            <option value="" label="-- Pilih Tahap --"></option>
                                            @foreach ($data['tahap'] as $tahap)
                                                <option value="{{ $tahap->id_tahapan }}">{{ $tahap->name }}</option>
                                            @endforeach
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
        <script src="{{ asset('assets/js/api-ajax.js') }}"></script>

        <script>
            const token = generateToken;

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

                const label_loader  =   `<div class="ml-1 spinner-border text-primary label-loader" style="width: 1rem; height: 1rem; font-size: 10px" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>`;
            
                const loader        =   `<div class="col-lg-12 col-md-12 text-center mt-5 loader">
                                            <div class="spinner-border text-primary" style="width: 4rem; height: 4rem; font-size: 20px" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>`;
                
                $('.filter').append(loader);

                $('.search').click(function() {
                    let id_sekolah      = $('select[name="sekolah"]').val();
                    let tahun_anggaran  = $('select[name="tahun_anggaran"]').val();
                    let tahap           = $('select[name="tahap"]').val();
                    let audit_type      = $('input[name="audit_type"]').val();
                    let data = {
                        access_token: token.responseJSON.access_token,
                        id_sekolah : id_sekolah,
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

                    @if($data['user_type'] === 'KabupatenKota')
                        let url = `{{ route('Admin:Dashboard:Index') }}/stages/city/${id}`;

                        $('.label-kabupatenkota').append(label_loader);
                        $('select[name="kabupatenkota"]').load(url);
                        $('.label-loader').remove();
                    @endif

                    @if($data['user_type'] === 'Provinsi')
                        $('.label-sekolah').append(label_loader);
                        $.ajax({
                            url: 'https://apicon-rkas.kemdikbud.go.id/api/itjen/sekolah',
                            method: 'post',
                            headers: {
                                "Authorization": `Bearer ${token.responseJSON.access_token}`,
                            },
                            data: {kode_wilayah: id},
                            success: function(res) {
                                $('select[name="sekolah"]').append(`<option value="" label="Choose One"></option>`);
                                $.each(res, function(index, value) {
                                    $('select[name="sekolah"]').append(`<option value="${value.npsn}">${value.nama}</option>`)
                                });
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        }).done(function() {
                            $('.label-loader').remove();
                        });
                    @endif
                });

                $('select[name="kabupatenkota"]').change(function() {
                    let id  = $(this).val();

                    $('.label-sekolah').append(label_loader);
                    $.ajax({
                        url: 'https://apicon-rkas.kemdikbud.go.id/api/itjen/sekolah',
                        method: 'post',
                        headers: {
                            "Authorization": `Bearer ${token.responseJSON.access_token}`,
                        },
                        data: {kode_wilayah: id},
                        success: function(res) {
                            $('select[name="sekolah"]').append(`<option value="" label="Choose One"></option>`);
                            $.each(res, function(index, value) {
                                $('select[name="sekolah"]').append(`<option value="${value.npsn}">${value.nama}</option>`)
                            });
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    }).done(function() {
                        $('.label-loader').remove();
                    });
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