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
                                    <th>Tahap</th>
                                    <th>Tahun</th>
                                    <th>% (Persen)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['worksheet'] as $worksheet)
                                    <tr>
                                        <td><a href="{{ route('Admin:Dashboard:Worksheet:City:Detail', ['kode_wilayah' => $worksheet->kode_kab]) }}">{{ $loop->iteration }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Worksheet:City:Detail', ['kode_wilayah' => $worksheet->kode_kab]) }}">{{ $worksheet->kabupaten }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Worksheet:City:Detail', ['kode_wilayah' => $worksheet->kode_kab]) }}">{{ $worksheet->tahap }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Worksheet:City:Detail', ['kode_wilayah' => $worksheet->kode_kab]) }}">{{ $worksheet->tahun }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Worksheet:City:Detail', ['kode_wilayah' => $worksheet->kode_kab]) }}">{{ round($worksheet->yes, 2) }}%</a></td>
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
                    <a class="btn btn-success" target="_blank" href="#"><i class="fas fa-download mr-1"></i> Download Excel</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sekolah</th>
                                    <th>Auditor</th>
                                    <th>Tahap</th>
                                    <th>Tahun</th>
                                    <th>Nilai</th>
                                    <th>Risiko</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['worksheet'] as $worksheet)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $worksheet->sekolah }}</td>
                                        <td>{{ $worksheet->auditor }}</td>
                                        <td>{{ $worksheet->tahap }}</td>
                                        <td>{{ $worksheet->tahun }}</td>
                                        <td>{{ round($worksheet->nilai, 2) }}%</td>
                                        @if($worksheet->nilai >= 80)
                                                <td>Rendah</td>
                                            @elseif($worksheet->nilai < 50)
                                                <td>Tinggi</td>
                                            @elseif($worksheet->nilai <= 80 || $worksheet->nilai >= 50)
                                                <td>Sedang</td>
                                            @endif
                                        <td>
                                            <a class="btn btn-success btn-icon" href="{{ route('Admin:Dashboard:Worksheet:School:Detail', ['npsn' => $worksheet->npsn]) }}"><i class="typcn typcn-zoom-in-outline"></i></a>
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