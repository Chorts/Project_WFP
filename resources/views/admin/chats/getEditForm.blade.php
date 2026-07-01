<h2>Edit Chat</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Booking</label>
    <select class="form-control" id="booking_id">
        @foreach ($bookings as $booking)
            <option value="{{ $booking->id }}" data-doctor="{{ $booking->schedule->doctor->name }}" {{ $data->booking_id == $booking->id ? 'selected' : '' }}>{{ $booking->id }} - {{ $booking->user->name }} -
                {{ $booking->schedule->doctor->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-2">
    <label>Sender</label>
    <select class="form-control" id="sender_id">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" data-name="{{ $user->name }}" {{ $data->sender_id == $user->id ? 'selected' : '' }}>{{ $user->id }} - {{ $user->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-2">
    <label>Sender Type</label>
    <select class="form-control" id="tipe_sender">
        <option value="user" {{ $data->tipe_sender == 'user' ? 'selected' : '' }}>user</option>
        <option value="doctor" {{ $data->tipe_sender == 'doctor' ? 'selected' : '' }}>doctor</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Chat</label>
    <textarea class="form-control" id="chat">{{ $data->chat }}</textarea>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>