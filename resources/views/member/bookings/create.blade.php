<!-- @extends('layouts.member')

@section('title', 'Booking Konsultasi')
@section('nav-bookings', 'active')

@section('content')
<div class="lb-page-header">
    <div class="container">
        <h1>Booking Konsultasi</h1>
    </div>
</div>

<div class="container mb-5">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="lb-card p-4">
        <form method="POST" action="{{ route('member.bookings.memberStore') }}">
            @csrf

            <div class="form-group mb-3">
                <label class="lb-meta">Layanan</label>

            </div>

            <div class="form-group mb-3">
                <label class="lb-meta">Jadwal</label>
                <select class="form-control lb-form-control" name="schedule_id" id="selectSchedule">
                    @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->doctor->name ?? '' }}
                        - {{ $schedule->day }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="lb-meta">Tanggal Booking</label>
                <input type="date"
                    class="form-control lb-form-control"
                    name="booking_date">
            </div>

            <input type="hidden" name="status" value="menunggu">

            <button type="submit" class="btn btn-lb">Submit</button>
            <a href="{{ route('member.bookings.index') }}" class="btn btn-lb-outline">Cancel</a>
        </form>
    </div>

</div>
@endsection -->
