<h2>Edit Transaction</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Booking</label>
    <select class="form-control" id="booking_id">
        @foreach ($bookings as $booking)
            <option value="{{ $booking->id }}"
                data-patient-id="{{ $booking->user->id }}"
                data-patient-name="{{ $booking->user->name }}"
                data-doctor-id="{{ $booking->schedule->doctor->id }}"
                data-doctor-name="{{ $booking->schedule->doctor->name }}"
                data-service-id="{{ $booking->service->id }}"
                data-service-name="{{ $booking->service->service_name }}"
                {{ $data->booking_id == $booking->id ? 'selected' : '' }}>
                {{ $booking->id }} - {{ $booking->user->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-2">
    <label>Status</label>
    <select class="form-control" id="status">
        <option value="Menunggu Pembayaran" {{ $data->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
        <option value="Dibatalkan" {{ $data->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        <option value="Lunas" {{ $data->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
    </select>
</div>

<div class="form-group mb-2">
    <label>Price</label>
    <input type="number" class="form-control" id="price" value="{{ $data->price }}">
</div>

<div class="form-group mb-2">
    <label>Transaction Date</label>
    <input type="datetime-local" class="form-control" id="transaction_date" value="{{ \Carbon\Carbon::parse($data->transaction_date)->format('Y-m-d\TH:i') }}">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>