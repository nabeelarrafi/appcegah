<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unduh Laporan Pengawasan</title>

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .container {
            width: 700px;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .text-left {
            text-align: left;
        }

        p {
            margin: 10px;
            font-size: 11px;
        }

        h1.title {
            font-size: 15px;
        }

        .float-right {
            float: right;
        }

        .font-weight-bold {
            font-weight: bold
        }

        table tr td {
            font-size: 11px;
        }

        .table {
            margin-top: 10px;
        }

        .time {
            float: right;
            transform: translate(-30px, -80px);
        }

        .detail .table {
            width: 97%;
            margin: 10px;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
            border: 1px solid #000;
            border-collapse: collapse;
        }
        
        .detail .table tr th, .detail .table tr td {
            border: 1px solid #000;
            padding: 2px;
        }

        .detail .table tr th {
            font-size: 11px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="text-center title">ORGANISASI AUDITOR</h1>
            <hr style="margin:0; margin-top: 30px; border-top: 4px solid #000">
            <hr style="margin:0; border-top: 1px solid #000; margin-top: 3px;">
        </header>

        <section class="table">
            <table border="0">
                <tr>
                    <td width="15%">Nomor</td>
                    <td>:</td>
                    <td width="70%">{{ $data['report_number'] }}</td>
                </tr>
                <tr>
                    <td width="15%">Lampiran</td>
                    <td>:</td>
                    <td width="70%" colspan="2">{{ $data['attachment'] }}</td>
                </tr>
                <tr>
                    <td width="15%">Hal</td>
                    <td>:</td>
                    <td width="70%" colspan="2">Laporan Hasil Pengawasan (Desk Audit) Dana BOS</td>
                </tr>
                <tr>
                    <td width="15%"></td>
                    <td></td>
                    <td width="70%" colspan="2">Pada {{ $data['region'] }} Tahun Anggaran {{ $data['year']->name }}</td>
                </tr>
            </table>
            <p class="time">
                {{ $data['time'] }}
            </p>
        </section>

        <section class="text-justify">
            <p>
                Yth. Inspektur Jenderal Kemendikbud
                <br>
                Di Jakarta
            </p>

            <p>
                Berdasarkan Surat Tugas Inspektur Jenderal Kementerian Nomor {{ $data['assignment_number'] }}, kami telah melakukan pengawasan (desk audit) atas Dana BOS {{ $data['region'] }} Tahun Anggaran {{ $data['year']->name }}
            </p>

            <p>
                Tujuan audit adalah Memastikan dana BOS digunakan sesuai dengan petunjuk teknis bantuan operasional sekolah regular; Memastikan dana BOS digunakan untuk meningkatkan pelayanan pendidikan se-hingga semua siswa memperoleh pendidikan yang bermutu; dan Memastikan penggunaan dana BOS dilakukan secara efektif, efisien, dan ekonomis, serta bertanggung jawab.
            </p>

            <p>
                Ruang lingkup audit meliputi Aspek Manajemen BOS; Aspek Tugas dan Tanggung Jawab Tim BOS; Aspek Penggunaan Dana BOS; dan Aspek Pertanggung Jawaban Keuangan.
            </p>

            <p>
                Audit dilaksanakan dari tanggal {{ $data['audit_start'] }} sampai tanggal {{ $data['audit_end'] }}, kami lakukan melalui pengumpulan dan pengujian bukti. Tanggung jawab tim audit terbatas pada simpulan hasil audit berdasarkan identifikasi masalah, analisis, dan pengujian yang dilakukan berdasarkan Standar Audit Intern Pemerintah Indonesia. Kebenaran dan keakuratan data/dokumen/informasi yang diperoleh auditor merupakan tanggung jawab pihak yang diawasi. 
            </p>

            <p>
                Berdasarkan hasil pengisian instrumen ketaatan pengelolaan dana bos melalui aplikasi cegah sebanyak {{ $data['school_count'] }} sekolah ({{ $data['school_type'] }}) diperoleh nilai skor sebagai berikut:
            </p>

        </section>

        <section class="text-justify detail">
            <p>
                Rata-rata skor ({{ $data['school_type'] }} per jenjang) pada {{ $data['region'] }}
            </p>
            <table class="table">
                <tr>
                    <th width="25px">No</th>
                    <th>Jenjang</th>
                    <th>Jumlah Sekolah</th>
                    <th>Skor</th>
                    <th>Keterangan</th>
                </tr>
                @foreach ($data['school_stages'] as $school_stage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $school_stage->jenjang }}</td>
                        <td>{{ $school_stage->jumlah_sekolah }}</td>
                        <td>{{ round($school_stage->nilai, 2) }}</td>
                        @if($school_stage->nilai >= 80)
                            <td>Risiko Rendah</td>
                        @elseif($school_stage->nilai < 50)
                            <td>Risiko Tinggi</td>
                        @elseif($school_stage->nilai <= 80 || $school_stage->nilai >= 50)
                            <td>Risiko Sedang</td>
                        @endif
                    </tr>
                @endforeach
            </table>
            <p>
                Detail {{ $data['school_type'] }} Per {{ $data['region'] }}
            </p>
            <table class="table">
                <tr>
                    <th width="25px">No</th>
                    <th class="text-left">Nama Sekolah</th>
                    <th>Skor</th>
                    <th>Keterangan</th>
                </tr>
                @foreach ($data['school_detail'] as $school_detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $school_detail->sekolah }}</td>
                        <td>{{ round($school_detail->nilai, 2) }}</td>
                        @if($school_detail->nilai >= 80)
                            <td>Risiko Rendah</td>
                        @elseif($school_detail->nilai < 50)
                            <td>Risiko Tinggi</td>
                        @elseif($school_detail->nilai <= 80 || $school_detail->nilai >= 50)
                            <td>Risiko Sedang</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </section>

        <section class="text-justify">
            <p class="font-weight-bold">Simpulan Hasil Audit</p>
            <p>
                Berdasarkan hasil skoring diatas untuk nilai skor 0 – 49 (risiko tinggi), kami rekomendasikan untuk dijadikan sasaran dalam Penyusunan Program Pengawasan / sebagai sample pengawasan di lapangan.
            </p>
            <p>
                Demikian laporan hasil pengawasan di belakang meja (Desk Audit) kami sampaikan, untuk dapat digunakan sebagai bahan pertimbangan.
            </p>
            <p>
                Atas Perhatian Inspektur Jenderal Kemendikbud / Inspektur, kami ucapkan terima kasih.
            </p>
        </section>
        
        <section class="float-right">
            <p>{{ $data['position'] }}</p>
            <br>
            <br>
            <br>
            <p>{{ $data['name'] }}</p>
            <p>{{ $data['nip'] }}</p>
        </section>
    </div>

    <!-- JQuery min js -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap4 js-->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>