<option value="" label="Choose One"></option>
@foreach ($data['year'] as $year)
    <option value="{{ $year->id_tahun_anggaran }}">{{ $year->name }}</option>
@endforeach