<option value="" label="Choose One"></option>
@foreach ($data['school'] as $school)
    <option value="{{ $school->id_sekolah }}">{{ $school->name }}</option>
@endforeach