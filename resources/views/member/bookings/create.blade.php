<!-- @extends('layouts.member')

@section('title', 'Booking Konsultasi')
@section('nav-bookings', 'active')

@section('content')
<div class="container">

    <h2>Booking Konsultasi</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('member.bookings.memberStore') }}">
        @csrf

        <div class="form-group mb-2">
            <label>Layanan</label>

        </div>

        <div class="form-group mb-2">
            <label>Jadwal</label>
            <select class="form-control" name="schedule_id" id="selectSchedule">
                @foreach($schedules as $schedule)
                <option value="{{ $schedule->id }}">
                    {{ $schedule->doctor->name ?? '' }}
                    - {{ $schedule->day }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Tanggal Booking</label>
            <input type="date"
                class="form-control"
                name="booking_date">
        </div>

        <input type="hidden" name="status" value="menunggu">

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('member.bookings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

</div>
@endsection -->