@extends('app.header')
@section('title', 'Penyetujuan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route($data['route']) }}">Penyetujuan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Sekolah</li>
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
                                        <tr>
                                            <td width="15%" class="font-weight-bold">Alokasi Total :</td>
                                            <td class="font-weight-bold font-italic text-primary">{{ $data['bos_salur']['data'][0]['jumlah_siswa'] }} siswa x Rp. {{ number_format($data['alokasi_siswa']) }} = Rp. {{ number_format($data['total_alokasi']) }}</td>
                                            <td width="15%" class="font-weight-bold">Alokasi Tahap 1 :</td>
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['total_alokasi']) }} x 30% = Rp. {{ number_format($data['tahap_1']) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="font-weight-bold">Alokasi Tahap 2 :</td>
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['total_alokasi']) }} x 40% = Rp. {{ number_format($data['tahap_2']) }}</td>
                                            <td width="15%" class="font-weight-bold">Alokasi Tahap 3 :</td>
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['total_alokasi']) }} x 30% = Rp. {{ number_format($data['tahap_3']) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="font-weight-bold">Dana Tersalurkan :</td>
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['nilai_salur']) }} ({{ $data['tahap'] }})</td>
                                            <td width="15%" class="font-weight-bold">Dana Digunakan :</td>
                                            <td class="font-weight-bold font-italic text-primary">Rp. {{ number_format($data['nilai_lapor']) }} ({{ $data['tahap'] }})</td>
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
                                            <td width="25%" class="font-weight-bold">Nilai :</td>
                                            <td>{{ round($data['pengendalian']->nilai, 2) }}%</td>
                                        </tr>
                                        <tr>
                                            <td width="25%" class="font-weight-bold">Tingkat Kepatuhan :</td>
                                            <td>{{ $data['patuh'] }}</td>
                                            <td width="25%" class="font-weight-bold">Tingkat Risiko :</td>
                                            <td>{{ $data['risiko'] }}</td>
                                        </tr>
                                        @if($data['pengendalian']->note)
                                            <tr>
                                                <td width="25%" class="font-weight-bold">Status Persetujuan :</td>
                                                <td>Ditolak</td>
                                                <td width="25%" class="font-weight-bold">Catatan :</td>
                                                <td>{{ $data['pengendalian']->note }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-footer mt-3">
                                @if($data['user']->role->id_role !== 28)
                                    <form action="{{ route('Admin:Dashboard:Stages:Approval:Approve', ['id_pengendalian' => $data['id_pengendalian']]) }}" method="POST" class="float-right mr-1">
                                        @csrf
                                        @method('put')
                                        <button class="btn btn-success" type="submit"><i class="fas fa-check mr-1"></i> Setujui</button>
                                    </form>
                                    <button class="btn btn-danger float-right mr-2" onclick="reject(this)" type="button" data-id="{{ $data['id_pengendalian'] }}" data-target="#reject" data-toggle="modal"><i class="fas fa-times mr-1"></i> Tolak</button>
                                @elseif($data['user']->role->id_role === 28)
                                    <button class="btn btn-success float-right mr-2 submit" type="button"><i class="fas fa-check mr-1"></i> Kirim Ulang</button>
                                @endif
                                <a class="btn btn-warning float-right mr-2" href="{{ route($data['route']) }}"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-12">
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
                <div class="col-xl-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-content-label mg-b-5">
                                Kertas Kerja 
                            </div>
                            <form id="form" action="{{ route('Admin:Dashboard:Stages:Approval:Resend', ['id_pengendalian' => $data['id_pengendalian']]) }}" method="POST">
                                @csrf
                                @method('put')
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
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td>{{ $activity->name }}</td>
                                                        @foreach ($data['activity_line'] as $activity_line)
                                                            @if($activity->id_kegiatan === $activity_line->id_kegiatan)
                                                                <td class="text-center"><input type="radio" @if($activity_line->answer == 1) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="1" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" @if($activity_line->answer == 2) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="2" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" @if($activity_line->answer == 3) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="3" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" @if($activity_line->answer == 4) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="4" class="form-control radio"></td>
                                                                <td class="text-center"><input type="radio" @if($activity_line->answer == 5) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="5" class="form-control radio"></td>
                                                                <td class="text-center"><input type="text" @if($data['user']->role->id_role !== 28) disabled @endif name="note[{{ $activity->id_kegiatan }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{ $loop->iteration }}.</td>
                                                        <td colspan="6">{{ $activity->name }}</td>
                                                    </tr>
                                                    @foreach ($activity->controlActivity as $control_act)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $control_act->name }}</td>
                                                            @foreach ($data['activity_line'] as $activity_line)
                                                                @if($control_act->id_aktivitas === $activity_line->id_aktivitas)
                                                                    <td class="text-center"><input type="radio" @if($activity_line->answer == 1) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="1" class="form-control radio"></td>
                                                                    <td class="text-center"><input type="radio" @if($activity_line->answer == 2) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="2" class="form-control radio"></td>
                                                                    <td class="text-center"><input type="radio" @if($activity_line->answer == 3) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="3" class="form-control radio"></td>
                                                                    <td class="text-center"><input type="radio" @if($activity_line->answer == 4) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="4" class="form-control radio"></td>
                                                                    <td class="text-center"><input type="radio" @if($activity_line->answer == 5) checked @endif @if($data['user']->role->id_role !== 28) disabled @endif name="answer[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="5" class="form-control radio"></td>
                                                                    <td class="text-center"><input type="text" @if($data['user']->role->id_role !== 28) disabled @endif name="note[{{ $activity->id_kegiatan }}-{{ $control_act->id_aktivitas }}]" value="{{ $activity_line->note }}" class="form-control note"></td>
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

        <!-- Reject Modal -->
        <div class="modal" id="reject">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Tolak Hasil Audit</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Admin:Dashboard:Stages:Approval:Reject') }}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id_pengendalian">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Catatan</label>
                                <input class="form-control" placeholder="Catatan ..." name="note" required type="text">
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button class="btn ripple btn-danger" type="submit">Tolak</button>
                        </form>
                        <button class="btn ripple btn-light" data-dismiss="modal" type="button">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Reject Modal -->
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

            function reject(el) {
                let id_pengendalian = $(el).data('id');

                $('input[name="id_pengendalian"]').val(id_pengendalian);
            }

            $(function() {
                $('.submit').click(function() {
                    $('#form').submit();
                });
            })
        </script>
    @endsection

@endsection