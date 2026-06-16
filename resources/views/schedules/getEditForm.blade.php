<h2>Edit Schedule</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Doctor</label>
    <select class="form-control" id="doctor_id">
        @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}" data-name="{{ $doctor->name }}" {{ $data->doctor_id == $doctor->id ? 'selected' : '' }}>
                {{ $doctor->id }} - {{ $doctor->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-2">
    <label>Day</label>
    <select class="form-control" id="day">
        <option value="Senin" {{ $data->day == 'Senin' ? 'selected' : '' }}>Senin</option>
        <option value="Selasa" {{ $data->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
        <option value="Rabu" {{ $data->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
        <option value="Kamis" {{ $data->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
        <option value="Jumat" {{ $data->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
        <option value="Sabtu" {{ $data->day == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
        <option value="Minggu" {{ $data->day == 'Minggu' ? 'selected' : '' }}>Minggu</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Start Time</label>
    <input type="time" class="form-control" id="start_time" value="{{ $data->start_time }}">
</div>

<div class="form-group mb-2">
    <label>End Time</label>
    <input type="time" class="form-control" id="end_time" value="{{ $data->end_time }}">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>