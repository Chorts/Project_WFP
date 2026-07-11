@extends('layouts.member')

@section('title', 'Consultation Saya')
@section('nav-consultations', 'active')

@section('content')

<div class="lb-page-header">
    <div class="container">
        <h1>Konsultasi Saya</h1>
        <p>Riwayat dan status konsultasi Anda dengan dokter.</p>
    </div>
</div>

<div class="container mb-5">

    @if($consultations->isEmpty())

    <div class="lb-empty">
        <i class="bi bi-chat-square-x fs-1 d-block mb-2"></i>
        Anda belum memiliki konsultasi.
    </div>

    @else

    <div class="table-responsive lb-table">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Dokter</th>
                    <th>Status</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Chat</th>
                    <th>Ringkasan</th>
                </tr>
            </thead>

            <tbody>
                @foreach($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->booking_id }}</td>
                    <td>{{ $consultation->doctor->name ?? '-' }}</td>
                    <td>
                        <span class="lb-badge {{ $consultation->status == 'Aktif' ? 'lb-badge-active' : 'lb-badge-done' }}">
                            {{ $consultation->status ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $consultation->started_at ?? '-' }}</td>
                    <td>{{ $consultation->ended_at ?? '-' }}</td>

                    <td>
                        @if($consultation->status == "Aktif")
                        <a href="{{ route('member.consultations.show', $consultation->id) }}" class="btn btn-lb btn-sm">
                            Lihat Chat
                        </a>
                        @else
                        <a href="{{ route('member.consultations.show', $consultation->id) }}" class="btn btn-lb-outline btn-sm">
                            Lihat histori chat
                        </a>
                        @endif
                    </td>
                    <td>
                        @if($consultation->ringkasan != "")
                        {{ $consultation->ringkasan ?? '-' }}
                        @endif

                        Belum tersedia
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    @endif

</div>
@endsection
