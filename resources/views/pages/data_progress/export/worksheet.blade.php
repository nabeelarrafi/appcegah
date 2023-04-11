@if($data['region'] === 'Nasional') 
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Provinsi</th>
                <th>Tahap</th>
                <th>Tahun</th>
                <th>% (Persen)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['worksheet'] as $worksheet)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $worksheet->provinsi }}</td>
                    <td>{{ $worksheet->tahap }}</td>
                    <td>{{ $worksheet->tahun }}</td>
                    <td>{{ round($worksheet->yes, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@if($data['region'] === 'Provinsi')
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $worksheet->kabupaten }}</td>
                    <td>{{ $worksheet->tahap }}</td>
                    <td>{{ $worksheet->tahun }}</td>
                    <td>{{ round($worksheet->yes, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@if($data['region'] === 'KabupatenKota')
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Sekolah</th>
            <th>Auditor</th>
            <th>Tahap</th>
            <th>Tahun</th>
            <th>Nilai</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
@endif