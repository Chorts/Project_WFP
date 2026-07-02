@extends('layouts.member')

@section('title', 'Consultation Saya')
@section('nav-consultations', 'active')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Konsultasi Saya</h2>
    </div>

    @if($consultations->isEmpty())

    <div class="alert alert-info">
        Anda belum memiliki konsultasi.
    </div>

    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Dokter</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Chat</th>

            </tr>
        </thead>

        <tbody>
            @foreach($consultations as $consultation)
            <tr>
                <td>{{ $consultation->booking_id }}</td>
                <td>{{ $consultation->doctor->name ?? '-' }}</td>
                <td>{{ $consultation->status ?? '-' }}</td>
                <td>{{ $consultation->started_at ?? '-' }}</td>
                <td>{{ $consultation->ended_at ?? '-' }}</td>

                <td>
                    @if($consultation->status == "Aktif")
                    <a href="{{ route('member.consultations.show', $consultation->id) }}" class="btn btn-sm btn-primary">
                        Lihat Chat
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>
@endsection