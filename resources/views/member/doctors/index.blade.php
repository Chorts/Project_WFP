@extends('layouts.member')

@section('title', 'Dokter')
@section('nav-doctors', 'active')

@section('content')
<div class="container mt-4">

    <h2>Dokter Kami</h2>
    <p>Temukan dokter terbaik untuk kebutuhan kesehatan Anda.</p>

    <form action="{{ route('member.doctors.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari dokter...">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </div>
    </form>

    @if($doctors->isEmpty())
    <div>
        Tidak ada dokter ditemukan.
    </div>
    @else

    <div class=" row">
        @foreach($doctors as $doctor)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">

                <div class="card-body">
                    <h5 class="card-title">
                        {{ $doctor->name }}
                    </h5>

                    <p class="card-text">
                        {{ $doctor->specialization->name ?? '-' }}
                    </p>

                    <p class="card-text">
                        Dokter: {{ $doctor->email ?? '-' }}
                    </p>

                </div>

            </div>
        </div>
        @endforeach
    </div>

    @endif

</div>
@endsection