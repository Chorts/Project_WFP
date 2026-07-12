@extends('layouts.member')

@section('title', 'Dokter')
@section('nav-doctors', 'active')

@section('content')

<div class="lb-page-header">
    <div class="container">
        <h1>Dokter Kami</h1>
        <p>Temukan dokter terbaik untuk kebutuhan kesehatan Anda.</p>
    </div>
</div>

<div class="container mb-5">

    <form action="{{ route('member.doctors.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control lb-form-control"
                placeholder="Cari dokter...">

            <button type="submit" class="btn btn-lb">
                Cari
            </button>
        </div>
    </form>

    @if($doctors->isEmpty())
    <div class="lb-empty">
        <i class="bi bi-person-x fs-1 d-block mb-2"></i>
        Tidak ada dokter ditemukan.
    </div>
    @else

    <div class="row g-4">
        @foreach($doctors as $doctor)
        <div class="col-md-6 col-lg-4">
            <div class="lb-card h-100">

                <div class="p-4">
                    @if ($doctor->photo)
                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}"
                        class="rounded-circle mb-2" style="width:70px;height:70px;object-fit:cover;">
                    @else
                    <div class="lb-card-icon">
                        <i class="bi bi-person-hearts"></i>
                    </div>
                    @endif

                    <h5 class="card-title mb-1">
                        {{ $doctor->name }}
                    </h5>

                    <p class="lb-meta mb-3">
                        {{ $doctor->specialization->name ?? '-' }}
                    </p>

                    <a href="{{ route('member.doctors.show', $doctor->id) }}" class="btn btn-lb btn-sm">
                        Lihat Profil
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    @endif

</div>
@endsection
    