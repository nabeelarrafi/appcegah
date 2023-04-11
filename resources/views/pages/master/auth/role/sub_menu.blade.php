<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Sub Menu</label>
    <select name="id_sub_menu" class="form-control">
        <option value="" label="Choose One"></option>
        @foreach ($data['sub_menu'] as $sub_menu)
            <option value="{{ $sub_menu->id_sub_menu }}">{{ $sub_menu->name }}</option>
        @endforeach
    </select>
</div>

<script>
    $('select[name="id_sub_menu"]').change(function() {
        let id_sub_menu = $(this).val();
        let id_role     = $('input[name="id_role"]').val();
        let url = `{{ route('Admin:Dashboard:Master:Role:Index') }}/privilege/${id_sub_menu}/${id_role}`;

        $('.privilege').html(loader);
        $('.privilege').load(url);
    });
</script>