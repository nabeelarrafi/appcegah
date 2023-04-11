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
                                <td class="font-weight-bold font-italic text-primary">{{ $data['status'] }}</td>
                                <td width="15%" class="font-weight-bold">Progress :</td>
                                <td class="font-weight-bold font-italic text-primary">{{ $data['tahap']->name }}</td>
                                @if($data['status'] === 'Sudah Dikerjakan')
                                    <td class="font-weight-bold font-italic text-primary">100%</td>
                                @else
                                    <td class="font-weight-bold font-italic text-primary worksheet-progress"></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-footer mt-3">
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
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Berkas Terkait 
                </div>
                <div class="mt-3">
                    <div class="main-content-label mg-b-5 text-primary">
                        1. Data Sekolah
                    </div>
                    <table class="table mb-b-0 text-md-nowrap border" border="1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Berkas</th>
                                <th>Jumlah</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Sekolah yang belum cleansing</td>
                                <td>226.808 Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Sekolah yang sudah cleansing</td>
                                <td>216.808 Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Sekolah yang tidak memiliki izin operasional</td>
                                <td>260 Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Sekolah yang memiliki kurang dari 60</td>
                                <td>146.810 Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Sekolah yang tidak memiliki npsn</td>
                                <td>-</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Sekolah yang tidak kirim data cut off</td>
                                <td>1700 Sekolah</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>Siswa ganda</td>
                                <td>12.909 Siswa</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Unduh</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    Kertas Kerja 
                </div>
                <form id="form" action="{{ route('Admin:Dashboard:Stages:Field:Management:Store') }}" method="post">
                    @csrf
                    <input type="hidden" name="state">
                    <input type="hidden" name="tahun" value="{{ $data['fiscal_year']->id_tahun_anggaran }}">
                    <input type="hidden" name="tahap" value="{{ $data['tahap']->id_tahapan }}">
                    <input type="hidden" name="id_user" value="{{ \Session::get('id_user') }}">
                    <input type="hidden" name="user_reg" value="{{ $data['user_reg'] }}">
                    @foreach ($data['group_act'] as $group_act)
                        <button class="btn btn-lg btn-primary text-left mb-4" onclick="toogleWorksheet(this)" data-id-title="{{ $group_act->id_grup_kegiatan }}" style="width: 100%;" type="button">{{ $group_act->name }} <i class="fas fa-chevron-down float-right mt-1"></i></button>
                        <table class="table mg-b-0 text-md-nowrap border worksheet-table hide mb-4" data-id-worksheet="{{ $group_act->id_grup_kegiatan }}" border="1">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2" class="align-middle">No.</th>
                                    <th rowspan="2" width="40%" class="align-middle">Kegiatan</th>
                                    <th colspan="6" class="align-middle">Jawaban</th>
                                </tr>
                                <tr>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($group_act->activity as $activity)
                                    @if($activity->audit_type === 2)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $activity->name }}</td>
                                            @if(empty($data['management_line']))
                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="1" class="form-control radio"></td>
                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="2" class="form-control radio"></td>
                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="3" class="form-control radio"></td>
                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="4" class="form-control radio"></td>
                                                <td class="text-center"><input type="radio" name="answer[{{ $activity->id_kegiatan }}]" value="5" class="form-control radio"></td>
                                                <td class="text-center"><input type="text" name="note[{{ $activity->id_kegiatan }}]" class="form-control note"></td>
                                            @else
                                                @foreach ($data['management_line'] as $management_line)
                                                    @if($activity->id_kegiatan === $management_line->id_kegiatan)
                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 1) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="1" class="form-control radio"></td>
                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 2) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="2" class="form-control radio"></td>
                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 3) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="3" class="form-control radio"></td>
                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 4) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="4" class="form-control radio"></td>
                                                        <td class="text-center"><input type="radio" @if($activity_line->answer == 5) checked @endif @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="answer[{{ $activity->id_kegiatan }}]" value="5" class="form-control radio"></td>
                                                        <td class="text-center"><input type="text" @if($data['status'] === 'Sudah Dikerjakan') disabled @endif name="note[{{ $activity->id_kegiatan }}]" value="{{ $management_line->note }}" class="form-control note"></td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let input_length = $('.note').length;
        const input      = $('.radio');
        let input_filled = [];
        let progress     = 0;
        let ongoing_prog = 0;
        $('.worksheet-progress').html(`${progress}%`)

        $('.radio').change(function() {
            let radio_name = $(this).attr('name');

            $.each(input, function(index, item) {
                let input_name = $(item).attr('name');

                if(radio_name === input_name && $(item).is(':checked')) {
                    input_filled = $.grep(input_filled, function(value) {
                        return value.name !== radio_name
                    });
                    input_filled.push({name: radio_name, val: $(this).val()});
                }
            });

            ongoing_prog = Math.round((input_filled.length/input_length*100));
            $('.worksheet-progress').html(`${ongoing_prog}%`);
        });

        $('.finish').click(function() {
            let input  = $('.score');
            let status = true;

            $.each(input, function(index, item) {
                if($(item).val() === '') status = false;
            });

            if(status === false) {
                swal(
                    {
                        title: 'Gagal!',
                        text: "Pengisian lembar kerja belum lengkap!",
                        type: 'error',
                        confirmButtonColor: '#57a94f'
                    }
                )
            } else {
                $('input[name="state"]').val('pending');
                $('#form').submit();
            }
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