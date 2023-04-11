@extends('app.header')
@section('title', 'Detail Kertas Kerja')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Worksheet:Index') }}">Hasil Pengawasan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Kertas Kerja</li>
@endsection

@section('style')
    <style>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Data Auditor 
                            </div>
                            <div class="table-responsive mt-4">
                                <table class="table table-striped mg-b-0 text-md-nowrap border" border="1">
                                    <tbody>
                                        <tr>
                                            <td width="15%" class="font-weight-bold">Auditor :</td>
                                            <td>{{ $data['pengendalian']->auditor }} </td>
                                            <td width="15%" class="font-weight-bold">Tahun Anggaran :</td>
                                            <td>{{ $data['pengendalian']->tahun }}</td>
                                        </tr>
                                        <tr>
                                            <td width="25%" class="font-weight-bold">Tahap :</td>
                                            <td>{{ $data['pengendalian']->tahap }}</td>
                                            <td width="25%" class="font-weight-bold">Jenis Audit :</td>
                                            <td>{{ $data['pengendalian']->jenis }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-footer mt-3">
                                <a class="btn btn-danger float-right mr-2" href="{{ route('Admin:Dashboard:Worksheet:Index') }}"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Berkas Terkait 
                            </div>
                            <div class="mt-3">
                                <div class="main-content-label mg-b-5 text-primary">
                                    1. RKAS
                                </div>
                                <table class="table mb-b-0 text-md-nowrap border" border="1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Berkas</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Data RKAS</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Rkas', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Data RKAS 2.2.1</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Rkas:221', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Laporan SPTMH</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Sptmh', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>Laporan BKU</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Bku', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>Laporan BKU SiLPA</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Bku:Silpa', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>Laporan Penggunaan</td>
                                            <td>
                                                <a href="{{ route('Admin:Dashboard:Stages:Files:Penggunaan', ['npsn' => $data['school']['npsn']]) }}" target="_blank" class="btn btn-sm btn-success mb-1"><i class="fas fa-eye"></i> Lihat</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Kertas Kerja 
                            </div>
                            <form id="form">
                                @foreach ($data['group_act'] as $group_act)
                                    <button class="btn btn-lg btn-primary text-left mb-4" onclick="toogleWorksheet(this)" data-id-title="{{ $group_act->id_grup_kegiatan }}" style="width: 100%;" type="button">{{ $group_act->name }} <i class="fas fa-chevron-down float-right mt-1"></i></button>
                                    <table class="table mg-b-0 text-md-nowrap border worksheet-table hide mb-4" data-id-worksheet="{{ $group_act->id_grup_kegiatan }}" border="1">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2" class="align-middle">No.</th>
                                                <th rowspan="2" class="align-middle">Kegiatan</th>
                                                <th colspan="2" class="align-middle">Jawaban</th>
                                            </tr>
                                            <tr>
                                                <th width="20%">Nilai (1-100)</th>
                                                <th width="25%">Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($group_act->activity as $activity)
                                                @if($activity->controlActivity->isEmpty())
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td>{{ $activity->name }}</td>
                                                        @foreach ($data['activity_line'] as $activity_line)
                                                            @if($activity->id_kegiatan === $activity_line->id_kegiatan)
                                                                <td class="text-center"><input type="number" disabled name="answer[{{ $activity->id_kegiatan }}]" value="{{ $activity_line->answer }}" min="0" max="100" class="form-control score"></td>
                                                                <td class="text-center"><input type="text" disabled name="note[{{ $activity->id_kegiatan }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td colspan="4">{{ $activity->name }}</td>
                                                    </tr>
                                                    @foreach ($activity->controlActivity as $control_act)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $control_act->name }}</td>
                                                            @foreach ($data['activity_line'] as $activity_line)
                                                                @if($control_act->id_aktivitas === $activity_line->id_aktivitas)
                                                                    <td class="text-center"><input type="number" disabled name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="{{ $activity_line->answer }}" min="0" max="100" class="form-control score"></td>
                                                                    <td class="text-center"><input type="text" disabled name="note[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Container -->
    @endsection
    
    @section('script')
        <script>
            function toogleWorksheet(el) {
                let id_title    = $(el).data('id-title');
                let worksheet   = $('.worksheet-table');

                $.each(worksheet, function(index, item) {
                    let id_worksheet = $(item).data('id-worksheet');

                    if(id_title === id_worksheet) $(item).toggleClass('hide');
                })
            }
        </script>
    @endsection

@endsection