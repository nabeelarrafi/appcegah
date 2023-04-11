
@extends('app.header')
@section('title', 'Sub Menu')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Master:Sub:Menu:Index') }}">Sub Menu</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
            <div class="col-md-5 col-xl-5 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Edit Sub Menu
                        </div>
                        <p class="mg-b-20 text-muted">Edit sub menu</p>
                        <form action="{{ route('Admin:Dashboard:Master:Sub:Menu:Update', ['menu' => $data['edit']->id_sub_menu]) }}" method="post">
                            @method('put')
                            @csrf
                            @if(Session::has('error'))
                            <p class="error">
                                {{ Session::get('error') }}
                            </p>
                            @endif
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Menu</label>
                                <select class="form-control" required name="id_menu">
                                    <option label="Choose one" value="">
                                    </option>
                                    @foreach ($data['menus'] as $menu)
                                        <option value="{{ $menu->id_menu }}" @if($data['edit']->id_menu == $menu->id_menu) selected @endif>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Name</label>
                                <input class="form-control" placeholder="Name..." name="name" required type="text" value="{{ $data['edit']->name }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Description</label>
                                <input class="form-control" placeholder="Description..." name="description" required type="text" value="{{ $data['edit']->description }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">URL</label>
                                <input class="form-control" placeholder="URL..." name="url" required type="text" value="{{ $data['edit']->url }}">
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right">Update</button>
                                <a href="{{ route('Admin:Dashboard:Master:Sub:Menu:Index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 pd-t-25">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Daftar Sub Menu</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">Sub Menu</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th style="width: 25%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['sub_menu'] as $sub_menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sub_menu->name }}</td>
                                        <td>{{ $sub_menu->url }}</td>
                                        <td>
                                            <a href="{{ route('Admin:Dashboard:Master:Sub:Menu:Edit', ['menu' => $sub_menu->id_sub_menu]) }}" class="btn btn-info btn-icon" style="display: inline-block"><i class="typcn typcn-edit"></i></a>
                                            <form data-form-id="{{ $sub_menu->id_sub_menu }}" action="{{ route('Admin:Dashboard:Master:Sub:Menu:Destroy', ['menu' => $sub_menu->id_sub_menu]) }}" method="POST"  style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button data-btn-id="{{ $sub_menu->id_sub_menu }}" onclick="confirmDelete(this)" class="btn btn-danger btn-icon" type="button"><i class="typcn typcn-trash"></i></button>
                                            </form>
                                        </td>
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

        <script src="{{ asset('assets/js/custom-sidemenu.js') }}" defer></script>
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

                toggleMenu('.fa-location-arrow', 'navigation/sub/menu');
            })
        </script>
        
        <!-- Internal form-elements js -->
		<script src="{{ asset('assets/js/form-elements.js') }}" defer></script>
	@endsection

@endsection