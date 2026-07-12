@extends('layouts.adminlte4')

@section('title', 'Konsultasi')
@section('nav-consultations', 'active')

@section('content')
<div class="container mt-4">

    <a href="{{ route('doctor.consultations.index') }}" class="btn btn-secondary mb-3">
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
        <div class="card-body" id="chat" style="max-height: 400px; overflow-y: auto;">

            @forelse($chats as $chat)
            <div class="mb-2 d-flex {{ $chat->tipe_sender === 'user' ? 'justify-content-start' : 'justify-content-end' }}">
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
    <form action="{{ route('doctor.consultations.doctorChat', $consultation->id) }}" method="POST">
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

@push('script')
<script>
    $(function () {
    var cont = document.getElementById('chat');
    cont.scrollTop = cont.scrollHeight;
    });
    var idLast = {{ $chats->isNotEmpty() && $chats->last()->id }};
    var consId = {{ $consultation->id }};
    @if ($consultation && $consultation->status === "Aktif")
    setInterval(function(){
        $.ajax({
            type: 'GET',
            url: '{{ route("chat.baca") }}',
            data: { 'consId': consId, 'idLast': idLast}, 
            success: function(data) {
                if (data.status == 'oke' && data.chats.length > 0) {
                    $.each(data.chats, function (i, chat) {
                        var user = chat.tipe_sender === 'doctor';
                        var align = user ? 'justify-content-end' : 'justify-content-start';
                        var chatBubble = user ? 'bg-primary text-white' : 'bg-light';
                        $('#chat').append('<div class="mb-2 d-flex ' + align + '">' +
                        '<div class="p-2 rounded ' + chatBubble + '" style="max-width: 70%;">' +
                        '<div>' + chat.chat + '</div>' + '<small class="d-block text-end" style="opacity: 0.7;">' + chat.created_at + '</small>' +'</div></div>');
                        idLast = chat.id;
                    });
                    var cont = document.getElementById('chat');
                    cont.scrollTop = cont.scrollHeight;
                }
            }
        })
    }, 3000);
    @endif
</script>
@endpush