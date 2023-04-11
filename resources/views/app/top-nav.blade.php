
<!-- main-content -->
<div class="main-content app-content">

    <!-- main-header -->
    <div class="main-header sticky side-header nav nav-item">
        <div class="container-fluid">
            <div class="main-header-left">
                <div class="responsive-logo">
                    <a href="index.html"><img src="{{ asset('assets/img/brand/Logo Cegah.png') }}" class="logo-1" alt="logo"></a>
                    <a href="index.html"><img src="{{ asset('assets/img/brand/Logo Cegah.png') }}" class="dark-logo-1" alt="logo"></a>
                    <a href="index.html"><img src="{{ asset('assets/img/brand/Logo Cegah.png') }}" class="logo-2" alt="logo"></a>
                    <a href="index.html"><img src="{{ asset('assets/img/brand/Logo Cegah.png') }}" class="dark-logo-2" alt="logo"></a>
                </div>
                <div class="app-sidebar__toggle d-md-none" data-toggle="sidebar">
                    <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                    <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                </div>
                <div class="left-content">
                    <h4 class="content-title mb-2">Hai, Selamat Datang di<span class="text-danger"> UJI COBA</span> Aplikasi CEGAH!</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('nav')
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="main-header-right">
                <div class="nav nav-item  navbar-nav-right ml-auto">
                    <div class="nav-link" id="bs-example-navbar-collapse-1">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button type="reset" class="btn btn-default">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button type="submit" class="btn btn-default nav-link resp-btn">
                                        <i class="fe fe-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="dropdown nav-item main-header-notification">
                        <a class="new nav-link" href="#"><i class="fe fe-bell"></i><span class=" pulse"></span></a>
                        <div class="dropdown-menu shadow">
                            <div class="menu-header-content bg-primary text-left d-flex">
                                <div class="">
                                    <h6 class="menu-header-title text-white mb-0">7 new Notifications</h6>
                                </div>
                                <div class="my-auto ml-auto">
                                    <span class="badge badge-pill badge-warning float-right">Mark All Read</span>
                                </div>
                            </div>
                            <div class="main-notification-list Notification-scroll ps">
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-success-transparent">
                                        <i class="la la-shopping-basket text-success"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">New Order Received</h5>
                                        <div class="notification-subtext">1 hour ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-danger-transparent">
                                        <i class="la la-user-check text-danger"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">22 verified registrations</h5>
                                        <div class="notification-subtext">2 hour ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-primary-transparent">
                                        <i class="la la-check-circle text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">Project has been approved</h5>
                                        <div class="notification-subtext">4 hour ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink-transparent">
                                        <i class="la la-file-alt text-pink"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">New files available</h5>
                                        <div class="notification-subtext">10 hour ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-warning-transparent">
                                        <i class="la la-envelope-open text-warning"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">New review received</h5>
                                        <div class="notification-subtext">1 day ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <a class="d-flex p-3" href="#">
                                    <div class="notifyimg bg-purple-transparent">
                                        <i class="la la-gem text-purple"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="notification-label mb-1">Updates Available</h5>
                                        <div class="notification-subtext">2 days ago</div>
                                    </div>
                                    <div class="ml-auto">
                                        <i class="las la-angle-right text-right text-muted"></i>
                                    </div>
                                </a>
                                <div class="dropdown-footer">
                                    <a href="">VIEW ALL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user d-flex" href="" data-toggle="sidebar-right" data-target=".sidebar-right">
                            @if($data['user']->photo)
                            <img alt="profile picture" src="{{ asset('assets/profile/'.$data['user']->photo) }}">
                            @else
                            <img alt="profile picture" src="{{ asset('assets/img/faces/6.jpg') }}">
                            @endif
                            <p class="ml-2 mt-2 tx-primary font-weight-bold">{{ $data['user']->name }}</p>
                        </a>
                    </div>
                    <div class="dropdown main-header-message right-toggle">
                        <a class="nav-link pr-0" data-toggle="sidebar-right" data-target=".sidebar-right">
                            <i class="ion ion-md-menu tx-20 bg-transparent"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /main-header -->

    @yield('container')

    @extends('app.sidemenu-right')
</div>
<!-- /main-content -->