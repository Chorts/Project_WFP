@extends('layouts.adminlte4')
@section('sidebar-chats')
    active
@endsection
@section('title')
    Chats
@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('status'))
            <div class="alert alert-warning">{{ session('status') }}</div>
        @endif

        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCreate">
            + New Chat
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Sender</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Sender Type</td>
                    <td style="font-weight:bold">Chat</td>
                    <td style="font-weight:bold">Time</td>
                </tr>
                @foreach ($chats as $c)
                    <tr id="tr_{{ $c->id }}">
                        <td>{{ $c->id }}</td>
                        <td id="td_sender_{{ $c->id }}">{{ $c->sender->name }}</td>
                        <td id="td_doctor_{{ $c->id }}">{{ $c->booking->schedule->doctor->name }}</td>
                        <td id="td_type_{{ $c->id }}">{{ $c->tipe_sender }}</td>
                        <td id="td_chat_{{ $c->id }}">{{ $c->chat }}</td>
                        <td id="td_time_{{ $c->id }}">{{ $c->created_at }}</td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm({{ $c->id }})">Edit</a>

                            @can('delete-permission', Auth::user())
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete Chat {{ $c->id }}?')) deleteDataRemove({{ $c->id }})">Delete</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ url('/chats') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Chat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Booking</label>
                            <select class="form-control" name="booking_id">
                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}">{{ $booking->id }} - {{ $booking->user->name }} -
                                        {{ $booking->schedule->doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Sender</label>
                            <select class="form-control" name="sender_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Sender Type</label>
                            <select class="form-control" name="tipe_sender">
                                <option value="user">user</option>
                                <option value="doctor">doctor</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>Chat</label>
                            <textarea class="form-control" name="chat"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Chat</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('script')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route("chats.getEditForm") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    $('#modalContent').html(data.msg);
                }
            });
        }

        function saveDataUpdate(id) {
            var booking_id = $('#booking_id').val();
            var sender_id = $('#sender_id').val();
            var tipe_sender = $('#tipe_sender').val();
            var chat = $('#chat').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("chats.saveDataUpdate") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'booking_id': booking_id,
                    'sender_id': sender_id,
                    'tipe_sender': tipe_sender,
                    'chat': chat
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_sender_' + id).html($('#sender_id option:selected').data('name'));
                        $('#td_doctor_' + id).html($('#booking_id option:selected').data('doctor'));
                        $('#td_type_' + id).html(tipe_sender);
                        $('#td_chat_' + id).html(chat);
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route("chats.deleteData") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#tr_' + id).remove();
                    }
                }
            });
        }
    </script>
@endpush