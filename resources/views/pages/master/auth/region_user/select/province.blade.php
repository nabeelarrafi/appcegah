<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Provinsi</label>
    <select class="form-control" required name="id_provinsi">
        <option value="" label="Choose One"></option>
        @foreach ($data['province'] as $province)
            <option value="{{ $province->id }}">{{ $province->nama }}</option>
        @endforeach
    </select>
</div>

@if($data['type'] !== 'Provinsi')
<script>
    $(document).ready(function() {
        $('select[name="id_provinsi"]').change(function() {
            let type = $('select[name="type"]').val();
            let id   = $(this).val();
            let url  = `{{ route('Admin:Dashboard:Master:Region:User:Index') }}/city/${type}/${id}`;
            
            $('.city').html(loader);
            $('.city').load(url);
        });
    });
</script>
@endif