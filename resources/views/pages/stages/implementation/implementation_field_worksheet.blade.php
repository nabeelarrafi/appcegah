
@extends('app.header')
@section('title', 'Penggunaan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Stages:Field:Implementation:Index') }}">Penggunaan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kertas Kerja</li>
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
                                        <td width="15%" class="font-weight-bold">Status :</td>
                                        <td>{{ $data['status'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="font-weight-bold">Dana Tersalurkan :</td>
                                        @if($data['tahap'] === 'Tahap 1')
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][0]['nilai_salur']) }} ({{ $data['tahap'] }})</td>
                                        @elseif($data['tahap'] === 'Tahap 2')
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][1]['nilai_salur']) }} ({{ $data['tahap'] }})</td>
                                        @else
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][2]['nilai_salur']) }} ({{ $data['tahap'] }})</td>
                                        @endif
                                        <td width="15%" class="font-weight-bold">Dana Digunakan :</td>
                                        @if($data['tahap'] === 'Tahap 1')
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][0]['nilai_lapor']) }} ({{ $data['tahap'] }})</td>
                                        @elseif($data['tahap'] === 'Tahap 2')
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][1]['nilai_lapor']) }} ({{ $data['tahap'] }})</td>
                                        @else
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['bos_salur']['data'][2]['nilai_lapor']) }} ({{ $data['tahap'] }})</td>
                                        @endif
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
                                        <td>{{ $data['user']->name }} </td>
                                        <td width="15%" class="font-weight-bold">Tahun Anggaran :</td>
                                        <td>{{ $data['fiscal_year'] }}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="font-weight-bold">Tahap :</td>
                                        <td>{{ $data['tahap'] }}</td>
                                        <td width="25%" class="font-weight-bold">Progres :</td>
                                        <td class="worksheet-progress"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-footer mt-3">
                            @if($data['status'] === 'Belum Dikerjakan' || $data['status'] === 'Sedang Dikerjakan')
                            <button class="btn btn-success float-right finish" type="button"><i class="fas fa-check"></i> Selesai</button>
                            <button class="btn btn-warning float-right mr-2 draft" type="button"><i class="fas fa-save"></i> Simpan Sementara</button>
                            @endif
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
                        <form action="{{ route('Admin:Dashboard:Stages:Desk:Implementation:Store') }}" method="post" id="form">
                            @csrf
                            <input type="hidden" name="state">
                            <input type="hidden" name="npsn" value="{{ $data['school']['npsn'] }}">
                            <input type="hidden" name="nama_sekolah" value="{{ $data['school']['nama_sekolah'] }}">
                            <input type="hidden" name="id_tahun_anggaran" value="{{ $data['id_tahun_anggaran'] }}">
                            <input type="hidden" name="audit_type" value="{{ $data['audit_type'] }}">
                            <input type="hidden" name="tahap" value="{{ $data['tahap'] }}">
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            @foreach ($data['group_act'] as $group_act)
                                <button class="btn btn-lg btn-primary text-left mb-4" onclick="toogleWorksheet(this)" data-id-title="{{ $group_act->id_grup_kegiatan }}" style="width: 100%;" type="button">{{ $group_act->name }} <i class="fas fa-chevron-down float-right mt-1"></i></button>
                                <table class="table mg-b-0 text-md-nowrap border worksheet-table hide mb-4" data-id-worksheet="{{ $group_act->id_grup_kegiatan }}" border="1">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2" class="align-middle">No.</th>
                                            <th rowspan="2" width="40%" class="align-middle">Kegiatan</th>
                                            <th colspan="6" class="align-middle">Jawaban</th>
                                        </tr>
                                        <tr>
                                            <th>0</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group_act->activity as $activity)
                                            @if($activity->controlActivity->isEmpty())
                                                @if($activity->audit_type === intval($data['audit_type']))
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td>{{ $activity->name }}</td>
                                                            @if(empty($data['activity_line']))
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="1" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="2" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="3" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="4" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="5" class="form-control radio"></td>
                                                                <td class="text-center"><input type="text" name="note[{{ $activity->id_kegiatan }}]" class="form-control note"></td>
                                                            @else
                                                                @foreach ($data['activity_line'] as $activity_line)
                                                                        @if($activity->id_kegiatan === $activity_line->id_kegiatan)
                                                                            <td class="text-center"><input type="radio" @if($activity_line->answer == 1) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="1" class="form-control radio"></td>
                                                                            <td class="text-center"><input type="radio" @if($activity_line->answer == 2) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="2" class="form-control radio"></td>
                                                                            <td class="text-center"><input type="radio" @if($activity_line->answer == 3) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="3" class="form-control radio"></td>
                                                                            <td class="text-center"><input type="radio" @if($activity_line->answer == 4) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="4" class="form-control radio"></td>
                                                                            <td class="text-center"><input type="radio" @if($activity_line->answer == 5) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="5" class="form-control radio"></td>
                                                                            <td class="text-center"><input type="text" @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="note[{{ $activity->id_kegiatan }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
                                                                        @endif
                                                                @endforeach
                                                            @endif
                                                    </tr>
                                                @endif
                                            @else
                                                @if($activity->audit_type === intval($data['audit_type']))
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td colspan="7">{{ $activity->name }}</td>
                                                    </tr>
                                                    @foreach ($activity->controlActivity as $control_act)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $control_act->name }}</td>
                                                                @if(empty($data['activity_line']))
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="1" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="2" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="3" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="4" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="5" class="form-control radio"></td>
                                                                <td class="text-center"><input type="text" name="note[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" class="form-control note"></td>
                                                            @else
                                                                @foreach ($data['activity_line'] as $activity_line)
                                                                        @if($control_act->id_aktivitas === $activity_line->id_aktivitas)
                                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 1) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="1" class="form-control radio"></td>
                                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 2) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="2" class="form-control radio"></td>
                                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 3) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="3" class="form-control radio"></td>
                                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 4) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="4" class="form-control radio"></td>
                                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 5) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="5" class="form-control radio"></td>
                                                                        <td class="text-center"><input type="text" @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="note[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @endif
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

                let input_length = $('.note').length;
                const input      = $('.radio');
                let input_filled = [];
                let progress     = 0;
                let ongoing_prog = 0;
                $('.worksheet-progress').html(`${progress}%`)

                $('.radio').change(function() {
                    let radio_name = $(this).attr('name');

                    $.each(input, function(index, item) {
                        let input_name = $(item).attr('name');

                        if(radio_name === input_name && $(item).is(':checked')) {
                            input_filled = $.grep(input_filled, function(value) {
                                return value.name !== radio_name
                            });
                            input_filled.push({name: radio_name, val: $(this).val()});
                        }
                    });

                    ongoing_prog = Math.round((input_filled.length/input_length*100));
                    $('.worksheet-progress').html(`${ongoing_prog}%`);
                });

                $('.finish').click(function() {
                    let input  = $('.score');
                    let status = true;

                    $.each(input, function(index, item) {
                        if($(item).val() === '') status = false;
                    });
        
                    if(status === false) {
                        swal(
                            {
                                title: 'Gagal!',
                                text: "Pengisian lembar kerja belum lengkap!",
                                type: 'error',
                                confirmButtonColor: '#57a94f'
                            }
                        )
                    } else {
                        $('input[name="state"]').val('pending');
                        $('#form').submit();
                    }
                });
        
                $('.draft').click(function() {
                    $('input[name="state"]').val('draft');
                    swal(
                        {
                            title: 'Tersimpan!',
                            text: "Pengisian lembar kerja telah disimpan!",
                            type: 'success',
                            confirmButtonColor: '#57a94f'
                        }
                    )
                });
            })
        </script>
    @endsection

@endsection