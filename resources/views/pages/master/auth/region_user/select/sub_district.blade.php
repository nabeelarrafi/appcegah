<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Kabupaten / Kota</label>
    <select class="form-control" required name="id_kecamatan">
        <option value="" label="Choose One"></option>
        @foreach ($data['sub_district'] as $sub_district)
            <option value="{{ $sub_district->id_kecamatan }}">{{ $sub_district->name }}</option>
        @endforeach
    </select>
</div>