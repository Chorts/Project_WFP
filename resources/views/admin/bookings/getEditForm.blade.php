<h2>Edit Booking</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Patient</label>
    <select class="form-control" id="user_id">
        @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-2">
    <label>Schedule</label>
    <select class="form-control" id="schedule_id">
        @foreach ($schedules as $schedule)
        <option value="{{ $schedule->id }}" data-doctor="{{ $schedule->doctor->name }}" data-day="{{ $schedule->day }}"
            data-time="{{ $schedule->start_time }} - {{ $schedule->end_time }}" {{ $data->schedule_id == $schedule->id ? 'selected' : '' }}>
            {{ $schedule->doctor->name }} - {{ $schedule->day }} - {{ $schedule->start_time }} -
            {{ $schedule->end_time }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-2">
    <label>Status</label>
    <select class="form-control" id="status">
        <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="Dipesan" {{ $data->status == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
        <option value="Dibatalkan" {{ $data->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
    </select>
</div>
<div class="form-group mb-2">
    <label>Booking Date</label>
    <input type="date" class="form-control" id="booking_date" value="{{ $data->booking_date }}">
</div>
<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>