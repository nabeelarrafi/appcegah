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
                                    <th>Penyaluran</th>
                                    <th>Realisasi</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['salur_lapor'] as $salur_lapor)
                                    <tr>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">{{ $loop->iteration }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">{{ $salur_lapor['kabkota'] }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">{{ $salur_lapor['tahap'] }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">Rp. {{ number_format($salur_lapor['nilai_salur']) }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">Rp. {{ number_format($salur_lapor['nilai_penggunaan']) }}</a></td>
                                        <td><a href="{{ route('Admin:Dashboard:Realization:City:Detail', ['kode_wilayah' => $salur_lapor['kode_kabkota']]) }}">{{ round(($salur_lapor['nilai_penggunaan']/$salur_lapor['nilai_salur'])*100, 2) }}%</a></td>
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
                                    <th>Tahap</th>
                                    <th>Penyaluran</th>
                                    <th>Realisasi</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['salur_lapor'] as $salur_lapor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $salur_lapor['sekolah'] }}</td>
                                        <td>{{ $salur_lapor['tahap'] }}</td>
                                        <td>Rp. {{ number_format($salur_lapor['nilai_salur']) }}</td>
                                        <td>Rp. {{ number_format($salur_lapor['nilai_penggunaan']) }}</td>
                                        <td>
                                            @if($salur_lapor['nilai_salur'] > 0)
                                                {{ round(($salur_lapor['nilai_penggunaan']/$salur_lapor['nilai_salur'])*100, 2) }}%
                                            @else
                                                100%
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-icon" href="{{ route('Admin:Dashboard:Realization:School:Detail', ['npsn' => $salur_lapor['npsn']]) }}"><i class="typcn typcn-zoom-in-outline"></i></a>
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