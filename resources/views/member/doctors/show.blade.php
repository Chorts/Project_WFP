@extends('layouts.member')

@section('title', $doctor->name)
@section('nav-doctors', 'active')

@section('content')

<div class="lb-page-header">
    <div class="container">
        <h1>{{ $doctor->name }}</h1>
        <p>{{ $doctor->specialization->name ?? '-' }}</p>
    </div>
</div>

<div class="container mb-5">
    <a href="{{ route('member.doctors.index') }}" class="btn btn-link mb-3 ps-0">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Dokter
    </a>

    <div class="row g-4">
        <div class="col-md-4 text-center">
            @if ($doctor->photo)
            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}"
                class="img-fluid rounded-circle mb-3" style="width:220px;height:220px;object-fit:cover;">
            @else
            <div class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-3"
                style="width:220px;height:220px;margin:0 auto;">
                <i class="bi bi-person-hearts fs-1"></i>
            </div>
            @endif

            @if ($doctor->phone)
            <p class="mb-1"><i class="bi bi-telephone me-1"></i>{{ $doctor->phone }}</p>
            @endif
            @if ($doctor->user && $doctor->user->email)
            <p class="mb-1"><i class="bi bi-envelope me-1"></i>{{ $doctor->user->email }}</p>
            @endif
        </div>

        <div class="col-md-8">
            <div class="lb-card p-4">
                <h5 class="mb-3">Tentang Dokter</h5>

                <p class="mb-2">
                    <strong>Spesialisasi:</strong> {{ $doctor->specialization->name ?? '-' }}
                </p>

                @if (!is_null($doctor->experience_years))
                <p class="mb-2">
                    <strong>Pengalaman:</strong> {{ $doctor->experience_years }} tahun
                </p>
                @endif

                @if ($doctor->bio)
                <p class="mb-2">
                    <strong>Bio:</strong><br>
                    {{ $doctor->bio }}
                </p>
                @else
                <p class="text-muted">Dokter belum menambahkan bio.</p>
                @endif

                @if ($doctor->schedules && $doctor->schedules->count())
                <hr>
                <h5 class="mb-3">Jadwal Praktik</h5>
                <ul class="list-unstyled mb-0">
                    @foreach ($doctor->schedules as $schedule)
                    <li class="mb-1">
                        <strong>{{ $schedule->day }}</strong>:
                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
