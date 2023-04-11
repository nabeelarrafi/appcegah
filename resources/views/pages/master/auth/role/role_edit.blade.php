@extends('app.header')
@section('title', 'Role')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Master:Role:Index') }}">Role</a></li>
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
                            Edit Role
                        </div>
                        <p class="mg-b-20 text-muted">Edit role</p>
                        <form action="{{ route('Admin:Dashboard:Master:Role:Update', ['role' => $data['edit']->id_role]) }}" method="post">
                            @csrf
                            @method('put')
                            @if(Session::has('error'))
                            <p class="error">
                                {{ Session::get('error') }}
                            </p>
                            @endif
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Name</label>
                                <input class="form-control" placeholder="Name..." name="name" required type="text" value="{{ $data['edit']->name }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Description</label>
                                <input class="form-control" placeholder="Description..." name="description" type="text" value="{{ $data['edit']->description }}">
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right">Update</button>
                                <a href="{{ route('Admin:Dashboard:Master:Role:Index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-xl-7 col-xs-12 col-sm-12">
                <!--div-->
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Hak Akses Role
                        </div>
                        <p class="mg-b-20 text-muted">Hak Akses Role</p>
                        <form action="{{ route('Admin:Dashboard:Master:Role:Sub:Menu:Store') }}" method="post">
                            @csrf
                            @if(Session::has('error'))
                            <p class="error">
                                {{ Session::get('error') }}
                            </p>
                            @endif
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <input type="hidden" name="id_role" value="{{ $data['edit']->id_role }}">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Menu</label>
                                <select name="id_menu" class="form-control select2">
                                    <option value="" label="Choose One"></option>
                                    @foreach ($data['menus'] as $menu)
                                        <option value="{{ $menu->id_menu }}">{{ $menu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sub_menu">

                            </div>
                            <div class="privilege">

                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
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
            const loader = `<div class="col-lg-12 col-md-12 text-center mt-5">
                                <div class="spinner-border text-primary" style="width: 4rem; height: 4rem; font-size: 20px" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`;

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

                $('select[name="id_menu"]').change(function() {
                    let id_menu = $(this).val();
                    let id_role = $('input[name="id_role"]').val();
                    let url = `{{ route('Admin:Dashboard:Master:Role:Index') }}/sub/menu/${id_menu}/${id_role}`;

                    $('.privilege').children().remove();
                    $('.sub_menu').html(loader);
                    $('.sub_menu').load(url);
                });
            })
        </script>
        
        <!-- Internal form-elements js -->
		<script src="{{ asset('assets/js/form-elements.js') }}" defer></script>
	@endsection

@endsection