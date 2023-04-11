@extends('app.header')
@section('title', 'Profil')
@section('nav')
    <li class="breadcrumb-item"><a href="{{ route('Admin:Dashboard:Index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profil</li>
@endsection

@section('style')
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
        <div class="row row-sm">
            <!-- Col -->
            <div class="col-lg-4 col-xl-3">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="pl-0">
                            <div class="main-profile-overview">
                                <div class="main-img-user profile-user">
                                    @if($data['user']->photo)
                                    <img alt="profile picture" src="{{ asset('assets/profile/'.$data['user']->photo) }}">
                                    @else
                                    <img alt="profile picture" src="{{ asset('assets/img/faces/6.jpg') }}">
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between mg-b-20">
                                    <div>
                                        <h5 class="main-profile-name">{{ $data['user']->username }}</h5>
                                        <p class="main-profile-name-text">{{ $data['user']->role->name }}</p>
                                    </div>
                                </div>

                                <!-- main-profile-bio -->
                                <div class="main-profile-work-list">
                                    <div class="media">
                                        <div class="media-logo bg-success-transparent text-success">
                                            <i class="icon ion-logo-whatsapp"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6>Web Designer at <a href="">Spruko</a></h6><span>2018 - present</span>
                                            <p>Past Work: Spruko, Inc.</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-logo bg-primary-transparent text-primary">
                                            <i class="icon ion-logo-buffer"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6>Studied at <a href="">University</a></h6><span>2004-2008</span>
                                            <p>Graduation: Bachelor of Science in Computer Science</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- main-profile-work-list -->
                            </div><!-- main-profile-overview -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Col -->

            <!-- Col -->
            <div class="col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 main-content-label">Informasi Pribadi</div>
                        <form class="form-horizontal" method="post" action="{{ route('Admin:Profile:Store') }}" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('error'))
                            <p class="error">
                                {{ Session::get('error') }}
                            </p>
                            @endif
                            <input type="hidden" name="id_user" value="{{ Session::get('id_user') }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap..." value="{{ $data['user']->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Nama Pengguna</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username" placeholder="Nama Pengguna..." required value="{{ $data['user']->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" placeholder="Email..." value="{{ $data['user']->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Foto Profil</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="photo" placeholder="Foto Profil...">
                                    </div>
                                </div>
                            </div>
                    </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary waves-effect waves-light" data-target="#modaldemo1" data-toggle="modal" type="button">Ganti Password</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile</button>
                            </div>
                        </form>
                </div>
            </div>
            <!-- /Col -->
        </div>
        <!-- row closed -->

        <!-- Password Modal -->
        <div class="modal" id="modaldemo1">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ganti Kata Sandi</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Admin:Profile:Password:Change') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Kata Sandi Lama</label>
                                <input class="form-control" placeholder="Kata Sandi Lama..." name="old_password" required type="password">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Kata Sandi Baru</label>
                                <input class="form-control" placeholder="Kata Sandi Baru..." name="password" required type="password">
                            </div>
                            <div class="form-group">
                                <label class="main-content-label tx-11 tx-medium tx-gray-900">Konfirmasi Kata Sandi</label>
                                <input class="form-control" placeholder="Konfirmasi Kata Sandi..." name="confirm_password" required type="password">
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">Simpan</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Password Modal -->
	</div>
	<!-- /Container -->
	@endsection

    @section('script')
        <script>
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