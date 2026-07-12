@extends('layouts.member')

@section('title', 'Konsultasi')
@section('nav-consultations', 'active')

@section('content')

<div class="lb-page-header">
    <div class="container">
        <h1>Konsultasi{{ $consultation ? ' dengan ' . $consultation->doctor->name : '' }}</h1>
        @if($consultation)
        <p>
            Status:
            <span class="lb-badge {{ $consultation->status === 'Aktif' ? 'lb-badge-active' : 'lb-badge-done' }}">
                {{ $consultation->status }}
            </span>
        </p>
        @endif
    </div>
</div>

<div class="container mb-5">

    <a href="{{ route('member.consultations.index') }}" class="btn btn-lb-outline mb-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    @if(!$consultation)

    <div class="lb-empty">
        <i class="bi bi-chat-square-x fs-1 d-block mb-2"></i>
        Konsultasi tidak ditemukan.
    </div>

    @else

    <div class="lb-chat-box mb-3">
        <div class="p-3" id="chat" style="max-height: 420px; overflow-y: auto;">

            @forelse($chats as $chat)
            <div class="mb-3 d-flex {{ $chat->tipe_sender === 'user' ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="lb-bubble {{ $chat->tipe_sender === 'user' ? 'lb-bubble-user' : 'lb-bubble-other' }}">
                    <div>{{ $chat->chat }}</div>
                    <small class="d-block text-end mt-1" style="opacity: 0.7; font-size: 10px;">
                        {{ $chat->created_at }}
                    </small>
                </div>
            </div>
            @empty
            <p class="text-muted mb-0">Belum ada pesan.</p>
            @endforelse

        </div>
    </div>

    @if($consultation->status === 'Aktif')
    <form action="{{ route('member.consultations.memberChat', $consultation->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="chat" class="form-control lb-form-control" placeholder="Tulis pesan..." required>
            <button type="submit" class="btn btn-lb">Kirim</button>
        </div>
    </form>
    @else
    <div class="lb-empty py-3">
        Konsultasi ini sudah selesai.
    </div>
    @endif

    @endif

</div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                        var user = chat.tipe_sender === 'user';
                        var align = user ? 'justify-content-end' : 'justify-content-start';
                        var chatBubble = user ? 'lb-bubble lb-bubble-user' : 'lb-bubble lb-bubble-other';
                        $('#chat').append('<div class="mb-3 d-flex ' + align + '">' +
                        '<div class="' + chatBubble + '">' +
                        '<div>' + chat.chat + '</div>' + '<small class="d-block text-end mt-1" style="opacity: 0.7; font-size: 10px;">' + chat.created_at + '</small>' +  '</div></div>');
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