@extends('layouts.adminlte4')

@section('title', 'Daftar Konsultasi')
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
                <th>Aksi</th>

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
                    <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalClose{{ $consultation->id }}">
                        Tutup Konsultasi
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>
@endsection


@push('modals')

@if(!$consultations->isEmpty())
@foreach($consultations as $consultation)
@if($consultation->status == "Aktif")

<div class="modal fade" id="modalClose{{ $consultation->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('doctor.consultations.close', $consultation->id) }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tutup Konsultasi</h4>
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
                        <label>Ringkasan Konsultasi</label>
                        <textarea class="form-control" name="ringkasan" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tutup Konsultasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endif
@endforeach
@endif

@endpush