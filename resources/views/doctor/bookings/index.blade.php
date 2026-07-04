@extends('layouts.adminlte4')

@section('title', 'Dafter Booking ')
@section('nav-bookings', 'active')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Booking Konsultasi Saya</h2>

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
                <th>Pasien</th>

                <th>Tanggal Booking</th>
                <th>Status</th>

            </tr>
        </thead>

        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->schedule->doctor->name ?? '-' }}</td>

                <td>{{ $booking->user->name ?? '-' }}</td>

                <td>
                    {{ $booking->booking_date }}
                </td>

                <td>
                    {{ $booking->status ?? 'Menunggu' }}
                </td>


            </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>
@endsection