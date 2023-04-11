<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ route('Admin:Dashboard:Index') }}"><img src="{{ asset('assets/img/brand/Logo Cegah asli.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ route('Admin:Dashboard:Index') }}"><img src="{{ asset('assets/img/brand/Logo Cegah asli.png') }}" class="main-logo dark-theme" alt="logo"></a>
        <div class="app-sidebar__toggle" data-toggle="sidebar">
            <a class="open-toggle" href="#"><i class="header-icon fe fe-chevron-left"></i></a>
            <a class="close-toggle" href="#"><i class="header-icon fe fe-chevron-right"></i></a>
        </div>
    </div>
    <style>
        .side-menu__icon.fas {
            font-size: 16px;
            margin-top: -7px;
        }
    </style>
    <div class="main-sidemenu sidebar-scroll">
        <ul class="side-menu">
            <li><h3>Menu Utama</h3></li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('Admin:Dashboard:Index') }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                <i class="side-menu__icon fas fa-fire"></i>
                <span class="side-menu__label">Dasbor</span></a>
            </li>
            <li><h3>Kemajuan Data</h3></li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                <i class="side-menu__icon fas fa-hand-holding-usd"></i>
                <span class="side-menu__label">Penyaluran Dana BOS</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @if($data['user_type'] === 'Nasional')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:National') }}">Nasional</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:City') }}">Kabupaten / Kota</a></li>
                    @elseif($data['user_type'] === 'Provinsi')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:City') }}">Kabupaten / Kota</a></li>
                    @else
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Distribution:City') }}">Kabupaten / Kota</a></li>
                    @endif
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                <i class="side-menu__icon fas fa-dollar-sign"></i>
                <span class="side-menu__label">Realisasi Dana BOS</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @if($data['user_type'] === 'Nasional')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:National') }}">Nasional</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:City') }}">Kabupaten / Kota</a></li>
                    @elseif($data['user_type'] === 'Provinsi')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:City') }}">Kabupaten / Kota</a></li>
                    @else
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Realization:City') }}">Kabupaten / Kota</a></li>
                    @endif
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                <i class="side-menu__icon fas fa-share"></i>
                <span class="side-menu__label">Data RKAS</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @if($data['user_type'] === 'Nasional')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:National') }}">Nasional</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:City') }}">Kabupaten / Kota</a></li>
                    @elseif($data['user_type'] === 'Provinsi')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:City') }}">Kabupaten / Kota</a></li>
                    @else
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Rkas:City') }}">Kabupaten / Kota</a></li>
                    @endif
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                <i class="side-menu__icon fas fa-percent"></i>
                <span class="side-menu__label">Kertas Kerja</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @if($data['user_type'] === 'Nasional')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:National') }}">Nasional</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:City') }}">Kabupaten / Kota</a></li>
                    @elseif($data['user_type'] === 'Provinsi')
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:Province') }}">Provinsi</a></li>
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:City') }}">Kabupaten / Kota</a></li>
                    @else
                        <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:City') }}">Kabupaten / Kota</a></li>
                    @endif
                    <li><a class="slide-item" href="{{ route('Admin:Dashboard:Worksheet:Index') }}">Hasil Pengawasan</a></li>
                </ul>
            </li>
            @foreach ($data['category'] as $category)
                @foreach ($data['menu'] as $menu)
                    @if($category->id_menu_category === $menu->id_menu_category)
                    @php
                        $loop->parent->index += 1;
                    @endphp
                    @if(!$category->menu->isEmpty() && ($loop->parent->iteration === $loop->parent->index))
                        @if($data['user']->role->name === 'Super Admin')
                            <li><h3>{{ $category->name }}</h3></li>
                        @elseif($data['user']->role->name === 'Admin')
                            @if($category->name === 'Admin' || $category->name === 'Master Data')
                                <li><h3>{{ $category->name }}</h3></li>
                            @endif
                        @elseif($data['user']->role->name === 'Auditor' || $data['user']->role->name === 'Atasan Langsung' || $data['user']->role->name === 'Pimpinan')
                            @if($category->name === 'Pengawasan Meja' || $category->name === 'Pengawasan Lapangan')
                                <li><h3>{{ $category->name }}</h3></li>
                            @endif
                        @elseif($data['user']->role->name === 'Ketua Tim')
                            @if($category->name === 'Pengawasan Lapangan')
                                <li><h3>{{ $category->name }}</h3></li>
                            @endif
                        @endif
                    @endif
                    <li class="slide">
                        @if($menu->url === '#')
                            @if($data['user']->role->name === 'Super Admin')
                                <a class="side-menu__item" data-toggle="slide" href="{{ $menu->url }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                                <i class="side-menu__icon fas {{ $menu->fa_class }}"></i>
                                <span class="side-menu__label">{{ $menu->name }}</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @foreach ($menu->subMenu as $subMenu)
                                        <li><a class="slide-item" href="{{ route($subMenu->url) }}">{{ $subMenu->name }}</a></li>
                                    @endforeach
                                </ul>
                            @elseif($data['user']->role->name === 'Admin')
                                @if($menu->name === 'Atur Pengguna' || $menu->name === 'Atur Satker' || $menu->name === 'Master Tahapan')
                                <a class="side-menu__item" data-toggle="slide" href="{{ $menu->url }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                                <i class="side-menu__icon fas {{ $menu->fa_class }}"></i>
                                <span class="side-menu__label">{{ $menu->name }}</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @foreach ($menu->subMenu as $subMenu)
                                        <li><a class="slide-item" href="{{ route($subMenu->url) }}">{{ $subMenu->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            @endif
                        @else
                            @if($data['user']->role->name === 'Super Admin' || $data['user']->role->name === 'Auditor' || $data['user']->role->name === 'Ketua Tim' || $data['user']->role->name === 'Pimpinan')
                                @if($data['user_type'] !== 'Nasional')
                                    @if($menu->url !== 'Admin:Dashboard:Stages:Desk:Management:Index' && $menu->name !== 'Laporan Pengawasan')
                                        <a class="side-menu__item" href="{{ route($menu->url) }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                                        <i class="side-menu__icon fas {{ $menu->fa_class }}"></i>
                                        <span class="side-menu__label">{{ $menu->name }}</span></a>
                                    @endif
                                @else
                                    @if($menu->url !== 'Admin:Dashboard:Stages:Field:Management:Index' && $menu->name !== 'Laporan Pengawasan')
                                        <a class="side-menu__item" href="{{ route($menu->url) }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                                        <i class="side-menu__icon fas {{ $menu->fa_class }}"></i>
                                        <span class="side-menu__label">{{ $menu->name }}</span></a>
                                    @endif
                                @endif
                            @elseif($data['user']->role->name === 'Atasan Langsung')
                                @if($menu->url !== 'Admin:Dashboard:Stages:Desk:Management:Index')
                                    <a class="side-menu__item" href="{{ route($menu->url) }}"><div class="side-angle1"></div><div class="side-angle2"></div><div class="side-arrow"></div>
                                    <i class="side-menu__icon fas {{ $menu->fa_class }}"></i>
                                    <span class="side-menu__label">{{ $menu->name }}</span></a>
                                @endif
                            @endif
                        @endif
                    </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
</aside>
<!-- main-sidebar -->