<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Kabupaten / Kota</label>
    <select class="form-control" required name="id_kabupatenkota">
        <option value="" label="Choose One"></option>
        @foreach ($data['city'] as $city)
            <option value="{{ $city->id }}">{{ $city->nama }}</option>
        @endforeach
    </select>
</div>

{{-- @if($data['type'] !== 'KabupatenKota')
<script>
    $(document).ready(function() {
        $('select[name="id_kabupatenkota"]').change(function() {
            let type = $('select[name="type"]').val();
            let id   = $(this).val();
            let url  = `{{ route('Admin:Dashboard:Master:Region:User:Index') }}/sub/district/${type}/${id}`;
            
            $('.sub-district').html(loader);
            $('.sub-district').load(url);
        });
    });
</script>
@endif --}}