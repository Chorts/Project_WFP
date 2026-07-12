<h2>Edit Doctor</h2>

@csrf
@method('PUT')

<div class="form-group mb-2 text-center">
    @if ($data->photo)
    <img id="preview_photo" src="{{ asset('storage/' . $data->photo) }}" alt="{{ $data->name }}"
        class="img-thumbnail rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;">
    @else
    <div id="preview_photo" class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-2"
        style="width:100px;height:100px;margin:0 auto;">
        <i class="bi bi-person fs-2"></i>
    </div>
    @endif
</div>
<div class="form-group mb-2">
    <label>Foto</label>
    <input type="file" class="form-control" id="photo" accept="image/*">
</div>
<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="{{ $data->name }}">
</div>
<div class="form-group mb-2">
    <label>Email (dari akun user, tidak dapat diubah di sini)</label>
    <input type="text" class="form-control" value="{{ $data->user->email ?? '-' }}" disabled>
</div>
<div class="form-group mb-2">
    <label>Specialization</label>
    <select class="form-control" id="specialization_id">
        @foreach ($specializations as $specialization)
        <option value="{{ $specialization->id }}"
            {{ $data->specialization_id == $specialization->id ? 'selected' : '' }}>
            {{ $specialization->id }} - {{ $specialization->name }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-2">
    <label>No. Telepon</label>
    <input type="text" class="form-control" id="phone" value="{{ $data->phone }}">
</div>
<div class="form-group mb-2">
    <label>Pengalaman (tahun)</label>
    <input type="number" min="0" class="form-control" id="experience_years" value="{{ $data->experience_years }}">
</div>
<div class="form-group mb-2">
    <label>Bio</label>
    <textarea class="form-control" id="bio" rows="3">{{ $data->bio }}</textarea>
</div>
<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>