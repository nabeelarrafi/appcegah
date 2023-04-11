@extends('app.header')
@section('title', 'Penyetujuan')
@section('nav')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Penyetujuan</li>
@endsection

@section('style')
    <!-- Internal Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <style>
        p.error {
            color: red;
            font-style: italic;
        }
    </style>
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
		<!-- row -->
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
                                            <option value="" label="Choose One"></option>
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
                                            <option value="" label="Choose One"></option>
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
                            <h4 class="card-title mg-b-0">Daftar Penyetujuan</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">Penyetujuan</p>
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
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['approval'] as $approval)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $approval->sekolah }}</td>
                                            <td>{{ $approval->auditor }}</td>
                                            <td>{{ $approval->tahun }}</td>
                                            <td>{{ $approval->tahap }}</td>
                                            <td>{{ round($approval->nilai, 2) }}%</td>
                                            @if($approval->nilai >= 80)
                                                <td>Rendah</td>
                                            @elseif($approval->nilai < 50)
                                                <td>Tinggi</td>
                                            @elseif($approval->nilai <= 80 || $approval->nilai >= 50)
                                                <td>Sedang</td>
                                            @endif
                                            <td>
                                                @if($data['user']->role->id_role !== 28)
                                                    <form action="{{ route('Admin:Dashboard:Stages:Approval:Approve', ['id_pengendalian' => $approval->id_pengendalian]) }}" method="POST" class="float-left mr-1">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-primary btn-icon" type="submit"><i class="typcn typcn-tick"></i></button>
                                                    </form>
                                                    <button class="btn btn-danger btn-icon float-left mr-1" onclick="reject(this)" type="button" data-id="{{ $approval->id_pengendalian }}" data-target="#reject" data-toggle="modal"><i class="typcn typcn-times"></i></button>
                                                @endif
                                                <a class="btn btn-warning btn-icon float-left" href="{{ route('Admin:Dashboard:Stages:Approval:Detail', ['id_pengendalian' => $approval->id_pengendalian]) }}"><i class="typcn typcn-zoom-in-outline"></i></a>
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
        <!-- row closed -->
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
        <!--Internal  Datepicker js -->
		<script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}" defer></script>

		<!--Internal  jquery.maskedinput js -->
		<script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}" defer></script>

		<!--Internal  spectrum-colorpicker js -->
        <script src="{{ asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}" defer></script>

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
            function reject(el) {
                let id_pengendalian = $(el).data('id');

                $('input[name="id_pengendalian"]').val(id_pengendalian);
            }

            $(document).ready(function() {
                @if(Session::has('success'))
                swal(
                    {
                        title: 'Success!',
                        text: "{{ Session::get('success') }}!",
                        type: 'success',
                        confirmButtonColor: '#57a94f'
                    }
                )
                @endif
            })
        </script>
        
        <!-- Internal form-elements js -->
		<script src="{{ asset('assets/js/form-elements.js') }}" defer></script>
	@endsection

@endsection