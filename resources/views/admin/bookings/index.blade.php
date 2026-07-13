@extends('layouts.adminlte4')
@section('sidebar-bookings')
active
@endsection
@section('title')
Bookings
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
        + New Booking
    </button>

    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Patient Name</td>
                <td style="font-weight:bold">Doctor Name</td>
                <td style="font-weight:bold">Day</td>
                <td style="font-weight:bold">Time</td>
                <td style="font-weight:bold">Status</td>
                <td style="font-weight:bold">Booking Date</td>
            </tr>
            @foreach ($bookings as $booking)
            <tr id="tr_{{ $booking->id }}">
                <td>{{ $booking->id }}</td>
                <td id="td_user_{{ $booking->id }}">{{ $booking->user->name }}</td>

                <td id="td_doctor_{{ $booking->id }}">{{ $booking->schedule->doctor->name }}</td>
                <td id="td_day_{{ $booking->id }}">{{ $booking->schedule->day }}</td>
                <td id="td_time_{{ $booking->id }}">{{ $booking->schedule->start_time }} -
                    {{ $booking->schedule->end_time }}
                </td>
                <td id="td_status_{{ $booking->id }}">{{ $booking->status }}</td>
                <td id="td_booking_date_{{ $booking->id }}">{{ $booking->booking_date }}</td>
                <td>
                    <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        onclick="getEditForm({{ $booking->id }})">Edit</a>

                    @can('delete-permission', Auth::user())
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="if(confirm('Are you sure to delete Booking {{ $booking->id }}?')) deleteDataRemove({{ $booking->id }})">
                        Delete
                    </a>
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
        <form method="POST" action="{{ route('admin.bookings.store') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Booking</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Patient</label>
                        <select class="form-control" name="user_id">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Schedule</label>
                        <select class="form-control" name="schedule_id">
                            @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->doctor->name }} - {{ $schedule->day }} -
                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Booking Date</label>
                        <input type="date" class="form-control" name="booking_date">
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
                <h4 class="modal-title">Edit Booking</h4>
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
            url: '{{ route("admin.bookings.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            }
        });
    }

    function saveDataUpdate(id) {
        var user_id = $('#user_id').val();
        var service_id = $('#service_id').val();
        var schedule_id = $('#schedule_id').val();
        var status = $('#status').val();
        var booking_date = $('#booking_date').val();

        $.ajax({
            type: 'POST',
            url: '{{ route("admin.bookings.saveDataUpdate") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'user_id': user_id,
                'service_id': service_id,
                'schedule_id': schedule_id,
                'status': status,
                'booking_date': booking_date,
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#td_user_' + id).html($('#user_id option:selected').text());
                    $('#td_doctor_' + id).html($('#schedule_id option:selected').data('doctor'));
                    $('#td_day_' + id).html($('#schedule_id option:selected').data('day'));
                    $('#td_time_' + id).html($('#schedule_id option:selected').data('time'));
                    $('#td_status_' + id).html(status);
                    $('#td_booking_date_' + id).html(booking_date);
                    $('#modalEdit').modal('hide');
                }
            }
        });
    }

    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("admin.bookings.deleteData") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#tr_' + id).remove();
                }
            }
        });
    }
</script>
@endpush