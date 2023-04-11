<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Negara</label>
    <select class="form-control" required name="id_negara">
        <option value="" label="Choose One"></option>
        @foreach ($data['country'] as $country)
            <option value="{{ $country->id_negara }}">{{ $country->name }}</option>
        @endforeach
    </select>
</div>

@if($data['type'] !== 'Nasional')
<script>
    $('select[name="id_negara"]').change(function() {
        let type = $('select[name="type"]').val();
        let id   = $(this).val();
        let url  = `{{ route('Admin:Dashboard:Master:Region:User:Index') }}/province/${type}/${id}`;
        
        $('.province').html(loader);
        $('.province').load(url);
    })
</script>
@endif