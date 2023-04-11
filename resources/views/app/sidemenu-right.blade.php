<!-- Sidebar-right-->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 box-shadow">
        <div class="tab-menu-heading border-0 p-3">
            <div class="card-title mb-0">Profil Pengguna</div>
            <div class="card-options ml-auto">
                <a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tab-content">
                <div class="tab-pane active" id="side1">
                    <div class="card-body text-center">
                        <div class="dropdown user-pro-body">
                            <div class="">
                                @if($data['user']->photo)
                                <img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="{{ asset('assets/profile/'.$data['user']->photo) }}"><span class="avatar-status profile-status bg-green"></span>
                                @else
                                <img alt="user-img" class="avatar avatar-xl brround mx-auto text-center" src="{{ asset('assets/img/faces/6.jpg') }}"><span class="avatar-status profile-status bg-green"></span>
                                @endif
                            </div>
                            <div class="user-info mg-t-20">
                                <h6 class="font-weight-semibold  mt-2 mb-0">{{ $data['user']->name }}</h6>
                                <span class="mb-0 text-muted">{{ $data['user']->role->name }}</span>
                            </div>
                        </div>
                    </div>
                    <a class="dropdown-item d-flex pd-y-15 border-bottom border-top" href="{{ route('Admin:Profile:Index') }}">
                        <div class="d-flex"><i class="far fa-user mr-3 tx-20 mg-t-5 text-muted"></i>
                            <div>
                                <h6 class="mb-0">Profil Saya</h6>
                                <p class="tx-12 mb-0 text-muted">Informasi Profil Pribadi</p>
                            </div>
                        </div>
                        <div class="ml-auto mg-t-8"><i class="fe fe-chevron-right"></i></div>
                    </a>
                    <a class="dropdown-item d-flex pd-y-15 border-bottom" href="{{ route('Admin:Profile:Activity') }}">
                        <div class="d-flex"><i class="far fa-clock mr-3 tx-20 mg-t-5 text-muted"></i>
                            <div>
                                <h6 class="mb-0">Riwayat Aktivitas</h6>
                                <p class="tx-12 mb-0 text-muted">Informasi Riwayat Aktivitas</p>
                            </div>
                        </div>
                        <div class="ml-auto mg-t-8"><i class="fe fe-chevron-right"></i></div>
                    </a>
                    <button class="dropdown-item d-flex pd-y-15 border-bottom" type="button" data-target="#modaldemo1" data-toggle="modal">
                        <div class="d-flex"><i class="fe fe-unlock mr-3 tx-20 mg-t-5 text-muted"></i>
                            <div>
                                <h6 class="mb-0">Ganti Kata Sandi</h6>
                                <p class="tx-12 mb-0 text-muted">Ganti Kata Sandi Anda</p>
                            </div>
                        </div>
                        <div class="ml-auto mg-t-8"><i class="fe fe-chevron-right"></i></div>
                    </button>
                    <a class="dropdown-item d-flex pd-y-15 border-bottom" href="{{ route('Admin:Logout') }}">
                        <div class="d-flex"><i class="fas fa-sign-out-alt mr-3 tx-20 mg-t-5 text-muted"></i>
                            <div>
                                <h6 class="mb-0">Keluar</h6>
                                <p class="tx-12 mb-0 text-muted">Keluar dari Akun</p>
                            </div>
                        </div>
                        <div class="ml-auto mg-t-8"><i class="fe fe-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Sidebar-right-->

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