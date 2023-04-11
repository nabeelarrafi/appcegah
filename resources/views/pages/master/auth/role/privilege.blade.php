<div class="form-group">
    <label class="main-content-label tx-11 tx-medium tx-gray-900">Hak Akses</label>
    <ul class="list-group-style">
        @if($data['privilege'])
        <li class="mt-2"><label class="ckbox"><input type="checkbox" @if($data['privilege']->is_create === 1) checked @endif name="is_create"><span>Create</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" @if($data['privilege']->is_read === 1) checked @endif name="is_read"><span>Read</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" @if($data['privilege']->is_update === 1) checked @endif name="is_update"><span>Update</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" @if($data['privilege']->is_delete === 1) checked @endif name="is_delete"><span>Delete</span></label></li>
        @else
        <li class="mt-2"><label class="ckbox"><input type="checkbox" name="is_create"><span>Create</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" name="is_read"><span>Read</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" name="is_update"><span>Update</span></label></li>
        <li class="mt-2"><label class="ckbox"><input type="checkbox" name="is_delete"><span>Delete</span></label></li>
        @endif
    </ul>
</div>