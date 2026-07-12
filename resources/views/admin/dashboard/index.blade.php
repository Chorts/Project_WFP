@extends('layouts.adminlte4')
@section('sidebar-dashboard')
active
@endsection
@section('title')
Dashboard
@endsection
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('status'))
    <div class="alert alert-warning">{{ session('status') }}</div>
    @endif

    <h3 class="mb-3">Dashboard Administrator</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Dokter</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $doctorCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Member</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $memberCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Artikel Kesehatan</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $articleCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Booking Konsultasi</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $bookingCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Konsultasi Berlangsung</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $activeConsultationCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Konsultasi Selesai</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;">{{ $doneConsultationCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 