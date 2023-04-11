@extends('app.header')
@section('title', 'Kegiatan')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
@endsection

@section('style')
    <!-- Internal Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

	@section('container')
		
	<!-- container -->
	<div class="container-fluid mg-t-20">
		<!-- row -->
        <div class="row">
            <div class="col-md-5 col-xl-5 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Kegiatan Baru
                        </div>
                        <p class="mg-b-20 text-muted">Input kegiatan baru</p>
                        <form action="{{ route('Admin:Dashboard:Master:Activity:Store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Tahapan</label>
                                <select name="id_grup_kegiatan" class="form-control">
                                    <option value="" label="Choose One"></option>
                                    @foreach ($data['group_act'] as $group_act)
                                        <option value="{{ $group_act->id_grup_kegiatan }}" @if(old('id_grup_kegiatan') == $group_act->id_grup_kegiatan) selected @endif>
                                            {{ $group_act->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Tipe Audit</label>
                                <select name="audit_type" required class="form-control">
                                    <option value="" label="Choose One"></option>
                                    <option value="1">Desk Audit</option>
                                    <option value="2">Field Audit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Name</label>
                                <input class="form-control" placeholder="Name..." name="name[]" required type="text">
                            </div>
                            <div class="new-input">
                                
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-dark float-right" onclick="newInput()"><i class="fa fa-plus"></i> Tambah Input</button>
                            </div>
                            <div class="clearfix mb-3"></div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 pd-t-25">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Daftar Kegiatan</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">Kegiatan</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Grup Kegiatan</th>
                                        <th style="width: 25%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['activity'] as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->grup_kegiatan }}</td>
                                        <td>
                                            <a href="{{ route('Admin:Dashboard:Master:Activity:Edit', ['activity' => $activity->id_kegiatan]) }}" class="btn btn-info btn-icon" style="display: inline-block"><i class="typcn typcn-edit"></i></a>
                                            <form data-form-id="{{ $activity->id_kegiatan }}" action="{{ route('Admin:Dashboard:Master:Activity:Destroy', ['activity' => $activity->id_kegiatan]) }}" method="POST"  style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button data-btn-id="{{ $activity->id_kegiatan }}" onclick="confirmDelete(this)" class="btn btn-danger btn-icon" type="button"><i class="typcn typcn-trash"></i></button>
                                            </form>
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
            function confirmDelete(el) {
                let btnId = $(el).data('btn-id');
                let formId = $(el).parent().data('form-id');

                swal(
                    {
                        title: "Are you sure?",
                        text: "Your will not be able to recover this data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(isConfirm) {
                        if(isConfirm && (btnId === formId)) $(el).parent().submit();
                    }
                );
            }

            function newInput() {
                const form = `<div class="input-group mb-3">
                                    <input class="form-control" placeholder="Name..." type="text" name="name[]">
                                    <div class="input-group-prepend">
                                        <button type="button" onclick="deleteInput(this)" style="border-top-right-radius: 3px; border-bottom-right-radius: 3px; padding: 9px 15px;" class="btn btn-danger"><i class="fa fa-times"></button></i>
                                    </div>
                                </div>`;
                
                $('.new-input').append(form);
            }

            function deleteInput(el) {
                $(el).parent().parent().remove();
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