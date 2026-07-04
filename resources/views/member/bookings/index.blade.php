@extends('layouts.member')

@section('title', 'Booking Saya')
@section('nav-bookings', 'active')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking Saya</h2>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + Booking Baru
        </button>
    </div>

    @if($bookings->isEmpty())

    <div class="alert alert-info">
        Anda belum memiliki booking konsultasi.
    </div>

    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Tanggal Booking</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->schedule->doctor->name ?? '-' }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->status ?? 'Menunggu' }}</td>
                <td>
                    <form action="{{ route('member.consultations.store', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            Mulai Konsultasi
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>
@endsection

@push('modals')
{{-- Modal Create Booking --}}
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('member.bookings.store') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Booking Konsultasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

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
                        <input type="date" class="form-control" name="booking_date">
                    </div>

                    <input type="hidden" name="status" value="menunggu">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush