<option value="" label="Choose One"></option>
@foreach ($data['city'] as $city)
    <option value="{{ $city->kode_wilayah }}">{{ $city->nama }}</option>
@endforeach