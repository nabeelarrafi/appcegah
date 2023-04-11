
@extends('app.header')
@section('title', 'Laporan Pengawasan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Laporan Pengawasan</li>
@endsection

@section('style')
    <!-- Internal Sweet Alert css -->
    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
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
                            Laporan Pengawasan
                        </div>
                        <form action="{{ route('Admin:Dashboard:Stages:Desk:Report:Download') }}" target="_blank" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="main-content-label mt-5 mb-3 text-center">
                                        Informasi Laporan
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Nomor Laporan</label>
                                        <input type="text" name="report_number" class="form-control" required placeholder="Nomor Laporan...">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Lampiran Laporan</label>
                                        <input type="text" name="attachment" class="form-control" required placeholder="Lampiran Laporan...">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Waktu Laporan</label>
                                        <input type="date" name="time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="main-content-label mt-5 mb-3 text-center">
                                        Informasi Audit
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahun Anggaran</label>
                                        <select name="fiscal_year" required class="form-control">
                                            <option value="" label="Choose One"></option>
                                            @foreach ($data['year'] as $year)
                                                <option value="{{ $year->id_tahun_anggaran }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Waktu Mulai Audit</label>
                                        <input type="date" name="audit_start" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Waktu Selesai Audit</label>
                                        <input type="date" name="audit_end" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Nomor Surat Tugas</label>
                                        <input type="text" name="assignment_number" class="form-control" required placeholder="Nomor Surat Tugas...">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="main-content-label mt-5 mb-3 text-center">
                                        Informasi Audit
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Jabatan Penandatangan</label>
                                        <input type="text" name="position" class="form-control" required placeholder="Jabatan Penandatangan...">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">Nama Penandatangan</label>
                                        <input type="text" name="name" class="form-control" required placeholder="Nama Penandatangan...">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="main-content-label tx-11 tx-medium tx-gray-900">NIP Penandatangan</label>
                                        <input type="number" name="nip" class="form-control" required placeholder="NIP Penandatangan...">
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer mt-3">
                                <button class="btn btn-primary float-right" type="submit"><i class="fas fa-download mr-1"></i> Unduh Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<!-- /Container -->
	@endsection

@endsection