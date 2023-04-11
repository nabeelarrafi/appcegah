@extends('app.header')
@section('title', 'Riwayat Aktivitas')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Riwayat Aktivitas</li>
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 pd-t-25">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Daftar Riwayat Aktivitas</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">Riwayat Aktivitas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Waktu Masuk</th>
                                        <th>Waktu Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['activity'] as $activity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($activity->created_at)) }}</td>
                                            @if($activity->is_active === 1)
                                            <td>-</td>
                                            <td>Masuk</td>
                                            @else
                                            <td>{{ date('d-m-Y H:i:s', strtotime($activity->updated_at)) }}</td>
                                            <td>Keluar</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- bd -->
                </div>
            </div>
        </div>
        <!-- row closed -->
	</div>
	<!-- /Container -->
	@endsection

@endsection