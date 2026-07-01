<h2>Edit Article</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Title</label>
    <input type="text" class="form-control" id="title" value="{{ $data->title }}">
</div>
<div class="form-group mb-2">
    <label>Article</label>
    <input type="text" class="form-control" id="article" value="{{ $data->article }}">
</div>
<div class="form-group mb-2">
    <label>Date Published</label>
    <input type="date" class="form-control" id="date" value="{{ $data->date_published }}">
</div>
<div class="form-group mb-2">
    <label>Doctors</label>
    <select class="form-control" id="doctor_id">
        @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}"
                {{ $data->doctor->id == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>