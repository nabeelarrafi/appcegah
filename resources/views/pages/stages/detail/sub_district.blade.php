<option value="" label="Choose One"></option>
@foreach ($data['sub_district'] as $sub_district)
    <option value="{{ $sub_district->id_kecamatan }}">{{ $sub_district->name }}</option>
@endforeach