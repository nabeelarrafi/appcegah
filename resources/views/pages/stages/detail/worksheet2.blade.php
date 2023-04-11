<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Data Sekolah 
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped mg-b-0 text-md-nowrap border" border="1">
                        <tbody>
                            <tr>
                                <td width="15%" class="font-weight-bold">Nama Sekolah :</td>
                                <td>{{ $data['school']->name }}</td>
                                <td width="15%" class="font-weight-bold">NPSN :</td>
                                <td>{{ $data['school']->npsn }}</td>
                            </tr>
                            <tr>
                                <td width="15%" class="font-weight-bold">Alamat :</td>
                                <td>Jalan balai pustaka baru 1</td>
                                <td width="15%" class="font-weight-bold">No Izin Operasional :</td>
                                <td>{{ rand(10000, 20000) }}</td>
                            </tr>
                            <tr>
                                <td width="15%" class="font-weight-bold">Alokasi Dana BOS :</td>
                                <td class="font-weight-bold font-italic text-danger">Rp. 5.000.000.000</td>
                                <td width="15%" class="font-weight-bold">Realisasi Dana BOS :</td>
                                <td class="font-weight-bold font-italic text-danger">Rp. 4.000.000.000</td>
                            </tr>
                            <tr>
                                <td width="15%" class="font-weight-bold">Guru PNS :</td>
                                <td class="font-weight-bold font-italic text-danger">200 Guru</td>
                                <td width="15%" class="font-weight-bold">Guru Non-PNS :</td>
                                <td class="font-weight-bold font-italic text-danger">70 Guru</td>
                            </tr>
                            <tr>
                                <td width="15%" class="font-weight-bold">Jumlah Siswa :</td>
                                <td class="font-weight-bold font-italic text-danger">1115 Siswa</td>
                                <td width="15%" class="font-weight-bold">Tenaga Kependidikan :</td>
                                <td class="font-weight-bold font-italic text-danger">30 Orang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Data Auditor 
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped mg-b-0 text-md-nowrap border" border="1">
                        <tbody>
                            <tr>
                                <td width="15%" class="font-weight-bold">Auditor :</td>
                                <td>{{ $data['user']->name }} </td>
                                <td width="15%" class="font-weight-bold">Tahun Anggaran :</td>
                                <td colspan="2">{{ $data['fiscal_year']->name }}</td>
                            </tr>
                            <tr>
                                <td width="15%" class="font-weight-bold">Status :</td>
                                <td class="font-weight-bold font-italic text-danger">{{ $data['status'] }}</td>
                                <td width="15%" class="font-weight-bold">Progress :</td>
                                <td class="font-weight-bold font-italic text-danger">Tahap 1</td>
                                <td class="font-weight-bold font-italic text-primary">80%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-footer mt-3">
                    @if($data['status'] === 'Belum Dikerjakan')
                    <button class="btn btn-primary" type="button"><i class="fas fa-edit"></i> Mulai Pengendalian</button>
                    @endif
                    @if($data['status'] === 'Belum Dikerjakan' || $data['status'] === 'Sedang Dikerjakan')
                    <button class="btn btn-success float-right finish" type="button"><i class="fas fa-check"></i> Selesai</button>
                    <button class="btn btn-warning float-right mr-2 draft" type="button"><i class="fas fa-save"></i> Simpan Sementara</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Kertas Kerja 
                </div>
                <button class="btn btn-lg btn-primary text-left mb-4" onclick="toogleWorksheet(this)" data-id-title="1" style="width: 100%;" type="button">Instrumen Kegiatan <i class="fas fa-chevron-down float-right mt-1"></i></button>
                <table class="table mg-b-0 text-md-nowrap border worksheet-table hide mb-4" data-id-worksheet="1" border="1">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">No.</th>
                            <th rowspan="2" width="50%" class="align-middle">Kegiatan</th>
                            <th colspan="3" class="align-middle">Jawaban</th>
                        </tr>
                        <tr>
                            <th>Ya</th>
                            <th>Tidak</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.finish').click(function() {
            console.log('mantap');
            swal(
                {
                    title: 'Selesai!',
                    text: "Pengisian lembar kerja telah dikerjakan!",
                    type: 'success',
                    confirmButtonColor: '#57a94f'
                }
            )
        });

        $('.draft').click(function() {
            swal(
                {
                    title: 'Tersimpan!',
                    text: "Pengisian lembar kerja telah disimpan!",
                    type: 'success',
                    confirmButtonColor: '#57a94f'
                }
            )
        });
    });
</script>