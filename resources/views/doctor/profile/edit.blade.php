@extends('layouts.adminlte4')
@section('title')
Profil Saya
@endsection
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Profil Saya</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('doctor.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3 align-items-center">
                    <div class="col-md-3 text-center">
                        @if ($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}"
                            class="img-thumbnail rounded-circle mb-2" style="width:150px;height:150px;object-fit:cover;">
                        @else
                        <div class="bg-secondary-subtle rounded-circle d-flex align-items-center justify-content-center mb-2"
                            style="width:150px;height:150px;margin:0 auto;">
                            <i class="bi bi-person fs-1"></i>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group mb-2">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $doctor->name) }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Email (tidak dapat diubah)</label>
                            <input type="text" class="form-control" value="{{ $doctor->user->email ?? '-' }}" disabled>
                        </div>

                        <div class="form-group mb-2">
                            <label>Spesialisasi</label>
                            <select class="form-control" name="specialization_id">
                                @foreach ($specializations as $specialization)
                                <option value="{{ $specialization->id }}"
                                    {{ old('specialization_id', $doctor->specialization_id) == $specialization->id ? 'selected' : '' }}>
                                    {{ $specialization->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>No. Telepon/WhatsApp</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $doctor->phone) }}" placeholder="08xxxxxxxxxx">
                        </div>

                        <div class="form-group mb-2">
                            <label>Pengalaman (tahun praktik)</label>
                            <input type="number" min="0" class="form-control" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Bio / Deskripsi Singkat</label>
                            <textarea class="form-control" name="bio" rows="4" placeholder="Ceritakan sedikit tentang diri Anda, keahlian, dan pengalaman praktik.">{{ old('bio', $doctor->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
