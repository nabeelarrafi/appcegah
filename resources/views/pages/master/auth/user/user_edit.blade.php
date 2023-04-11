@extends('app.header')
@section('title', 'Users')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Master:User:Index') }}">Users</a></li>
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
                            Edit User
                        </div>
                        <p class="mg-b-20 text-muted">Edit user</p>
                        <form action="{{ route('Admin:Dashboard:Master:User:Update', ['user' => $data['edit']->id_user]) }}" method="post">
                            @method('put')
                            @csrf
                            @if(Session::has('error'))
                            <p class="error">
                                {{ Session::get('error') }}
                            </p>
                            @endif
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <input type="hidden" name="old_username" value="{{ $data['edit']->username }}">
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Role</label>
                                <select class="form-control select2" required name="id_role">
                                    <option label="Choose one" value="">
                                    </option>
                                    @foreach ($data['role'] as $role)
                                        @if($role->name !== 'Super Admin')
                                            <option value="{{ $role->id_role }}" @if($data['edit']->id_role == $role->id_role) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Atasan</label>
                                <select class="form-control" name="id_atasan">
                                    <option label="Choose one" value="">
                                    </option>
                                    @foreach ($data['users'] as $user)
                                        @if($user->username !== 'admin')
                                            <option value="{{ $user->id_user }}" @if($data['edit']->id_atasan == $user->id_user) selected @endif>
                                                {{ $user->username }}
                                            </option>
                                        @endif 
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Username</label>
                                <input class="form-control" placeholder="Username..." name="username" required type="text" value="{{ $data['edit']->username }}">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">New Password</label>
                                <input class="form-control" placeholder="New Password..." name="password" type="password">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Confirm New Password</label>
                                <input class="form-control" placeholder="Confirm New Password..." name="confirm_password" type="password">
                                <p class="error error-pass" style="font-size: 11px">
                                    
                                </p>
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary float-right">Update</button>
                                <a href="{{ route('Admin:Dashboard:Master:User:Index') }}" class="btn btn-outline-danger float-right mr-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-xl-7 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 pd-t-25">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Daftar User</h4>
                        </div>
                        <p class="tx-12 text-muted mb-0">User</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap table-striped" id="example2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th style="width: 20%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['users'] as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if($user->role !== 'Super Admin')
                                            <a href="{{ route('Admin:Dashboard:Master:User:Edit', ['user' => $user->id_user]) }}" class="btn btn-info btn-icon" style="display:inline-block"><i class="typcn typcn-edit"></i></a>
                                            <form data-form-id="{{ $user->id_user }}" action="{{ route('Admin:Dashboard:Master:User:Destroy', ['user' => $user->id_user]) }}" method="POST"  style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button data-btn-id="{{ $user->id_user }}" onclick="confirmDelete(this)" class="btn btn-danger btn-icon" type="button"><i class="typcn typcn-trash"></i></button>
                                            </form>
                                            @endif
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

                $("input[name='confirm_password'").keyup(function() {
                    let password = $("input[name='password'").val();
                    let confirm_password = $(this).val();

                    if(confirm_password !== password) $('.error-pass').html('Passwords do not match!');
                    if(confirm_password === password) $('.error-pass').html('');
                });
            })
        </script>
        
        <!-- Internal form-elements js -->
		<script src="{{ asset('assets/js/form-elements.js') }}" defer></script>
	@endsection

@endsection