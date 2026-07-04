@extends('layouts.member')

@section('title', 'Konsultasi')
@section('nav-consultations', 'active')

@section('content')
<div class="container mt-4">

    <a href="{{ route('member.consultations.index') }}" class="btn btn-secondary mb-3">
        Kembali
    </a>

    @if(!$consultation)

    <div class="alert alert-danger">
        Konsultasi tidak ditemukan.
    </div>

    @else

    <div class="card mb-3">
        <div class="card-body">
            <h4>Konsultasi dengan {{ $consultation->doctor->name  }}</h4>
            <p>
                Status: <b>{{ $consultation->status }}</b>
            </p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">

            @forelse($chats as $chat)
            <div class="mb-2 d-flex {{ $chat->tipe_sender === 'user' ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="p-2 rounded {{ $chat->tipe_sender === 'user' ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 70%;">
                    <div>{{ $chat->chat }}</div>
                    <small class="d-block text-end" style="opacity: 0.7;">
                        {{ $chat->created_at }}
                    </small>
                </div>
            </div>
            @empty
            <p class="text-muted">Belum ada pesan.</p>
            @endforelse

        </div>
    </div>

    @if($consultation->status === 'Aktif')
    <form action="{{ route('member.consultations.memberChat', $consultation->id) }}" method="POST">
        @csrf
        <div class="input-group ">
            <input type="text" name="chat" class="form-control" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
    @else
    <div class="alert alert-secondary">
        Konsultasi ini sudah selesai.
    </div>
    @endif

    @endif

</div>
@endsection