
@extends('app.header')
@section('title', 'Dashboard')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{ $data['prev_route'] }}">Kabupaten / Kota</a></li>
	<li class="breadcrumb-item active" aria-current="page">Sekolah</li>
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
                            Data Sekolah 
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table table-striped mg-b-0 text-md-nowrap border" border="1">
                                <tbody>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Nama Sekolah :</td>
                                        <td>{{ $data['school']['nama_sekolah'] }}</td>
                                        <td width="15%" class="font-weight-bold">Kepala Sekolah :</td>
                                        <td>{{ $data['school']['nama_kepala_sekolah'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">NPSN :</td>
                                        <td>{{ $data['school']['npsn'] }}</td>
                                        <td width="15%" class="font-weight-bold">Alamat :</td>
                                        <td>{{ $data['school']['alamat_jalan'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">No Izin Operasional :</td>
                                        <td>{{ $data['school']['sk_izin_operasional'] }}</td>
                                        <td width="15%" class="font-weight-bold">Status Sekolah:</td>
                                        <td>{{ $data['school']['status_sekolah'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Dana Tersalurkan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][0]['nilai_salur']) }} (Tahap {{ $data['bos_salur']['data'][0]['tahap'] }})</td>
                                        <td width="15%" class="font-weight-bold">Dana Digunakan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][0]['nilai_lapor']) }} (Tahap {{ $data['bos_salur']['data'][0]['tahap'] }})</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Dana Tersalurkan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][1]['nilai_salur']) }} (Tahap {{ $data['bos_salur']['data'][1]['tahap'] }})</td>
                                        <td width="15%" class="font-weight-bold">Dana Digunakan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][1]['nilai_lapor']) }} (Tahap {{ $data['bos_salur']['data'][1]['tahap'] }})</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Dana Tersalurkan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][2]['nilai_salur']) }} (Tahap {{ $data['bos_salur']['data'][2]['tahap'] }})</td>
                                        <td width="15%" class="font-weight-bold">Dana Digunakan :</td>
                                        <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][2]['nilai_lapor']) }} (Tahap {{ $data['bos_salur']['data'][2]['tahap'] }})</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Guru PNS :</td>
                                        <td class="font-weight-bold font-italic text-primary">{{ $data['school']['guru_pns'] }} Guru</td>
                                        <td width="15%" class="font-weight-bold">Guru Non-PNS :</td>
                                        <td class="font-weight-bold font-italic text-primary">{{ $data['school']['guru_non_pns'] }} Guru</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Jumlah Siswa :</td>
                                        <td class="font-weight-bold font-italic text-primary">{{ $data['bos_salur']['data'][0]['jumlah_siswa'] }} Siswa</td>
                                        <td width="15%" class="font-weight-bold">Tenaga Kependidikan :</td>
                                        <td class="font-weight-bold font-italic text-primary">{{ $data['school']['tendik_pns'] +  $data['school']['tendik_non_pns']}} Orang</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <a class="btn btn-danger mt-2 float-right" href="{{ $data['prev_route'] }}">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<!-- /Container -->
	@endsection

@endsection