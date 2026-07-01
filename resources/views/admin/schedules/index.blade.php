@extends('layouts.adminlte4')
@section('sidebar-schedules')
    active
@endsection
@section('title')
    Schedules
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
            + New Schedule
        </button>

        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Day</td>
                    <td style="font-weight:bold">Start Time</td>
                    <td style="font-weight:bold">End Time</td>
                </tr>
                @foreach ($schedules as $schedule)
                    <tr id="tr_{{ $schedule->id }}">
                        <td>{{ $schedule->id }}</td>
                        <td id="td_doctor_id_{{ $schedule->id }}">{{ $schedule->doctor_id }}</td>
                        <td id="td_doctor_name_{{ $schedule->id }}">{{ $schedule->doctor->name }}</td>
                        <td id="td_day_{{ $schedule->id }}">{{ $schedule->day }}</td>
                        <td id="td_start_time_{{ $schedule->id }}">{{ $schedule->start_time }}</td>
                        <td id="td_end_time_{{ $schedule->id }}">{{ $schedule->end_time }}</td>
                        <td>
                            <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                onclick="getEditForm({{ $schedule->id }})">Edit</a>

                            @can('delete-permission', Auth::user())
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure to delete {{ $schedule->id }}?')) deleteDataRemove({{ $schedule->id }})">Delete</a>
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
            <form method="POST" action="{{ url('/schedules') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Schedule</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Doctor</label>
                            <select class="form-control" name="doctor_id">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->id }} - {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Day</label>
                            <select class="form-control" name="day">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Start Time</label>
                            <input type="time" class="form-control" name="start_time">
                        </div>
                        <div class="form-group mb-2">
                            <label>End Time</label>
                            <input type="time" class="form-control" name="end_time">
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
                    <h4 class="modal-title">Edit Schedule</h4>
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
                url: '{{ route("schedules.getEditForm") }}',
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
            var doctor_id = $('#doctor_id').val();
            var day = $('#day').val();
            var start_time = $('#start_time').val();
            var end_time = $('#end_time').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("schedules.saveDataUpdate") }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'doctor_id': doctor_id,
                    'day': day,
                    'start_time': start_time,
                    'end_time': end_time,
                },
                success: function (data) {
                    if (data.status == "oke") {
                        $('#td_doctor_id_' + id).html(doctor_id);
                        $('#td_doctor_name_' + id).html($('#doctor_id option:selected').data('name'));
                        $('#td_day_' + id).html(day);
                        $('#td_start_time_' + id).html(start_time);
                        $('#td_end_time_' + id).html(end_time);
                        $('#modalEdit').modal('hide');
                    }
                }
            });
        }

        function deleteDataRemove(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route("schedules.deleteData") }}',
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