@if($data['region'] === 'Provinsi')
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0 pd-t-25">
                    <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Daftar Kabupaten / Kota</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kabupaten / Kota</th>
                                    <th>% (Persen)</th>
                                    <th>Total Sekolah</th>
                                    <th>Total Kirim</th>
                                    <th>Total Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['rkas'] as $rkas)
                                    <tr>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $loop->iteration }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $rkas->kabupaten_kota }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $rkas->persen }}%</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $rkas->total_sekolah }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $rkas->total_kirim }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Rkas:City:Detail', ['kode_wilayah' => $rkas->kode_kab]) }}">{{ $rkas->total_sisa }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($data['region'] === 'KabupatenKota')
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0 pd-t-25">
                    <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Daftar Sekolah</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sekolah</th>
                                    <th>NPSN</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['rkas'] as $rkas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rkas->sekolah }}</td>
                                        <td>{{ $rkas->npsn }}</td>
                                        <td>{{ $rkas->status }}</td>
                                        <td>
                                            <a class="btn btn-success btn-icon" href="{{ route('Admin:Dashboard:Rkas:School:Detail', ['npsn' => $rkas->npsn]) }}"><i class="typcn typcn-zoom-in-outline"></i></a>
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
@endif

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