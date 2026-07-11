<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-doctors')
active
@endsection
@section('title')
Doctors
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
        + New Doctor
    </button>

    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Name</td>
                <td style="font-weight:bold">Email</td>
                <td style="font-weight:bold">Specialization</td>
                <td style="font-weight:bold">Action</td>
            </tr>
            @foreach ($doctors as $doctor)
            <tr id="tr_{{ $doctor->id }}">
                <td id="td_id_{{ $doctor->id }}">{{ $doctor->id }}</td>
                <td id="td_name_{{ $doctor->id }}">{{ $doctor->name }}</td>
                <td id="td_email_{{ $doctor->id }}">{{ $doctor->email }}</td>
                <td id="td_specialization_{{ $doctor->id }}">{{ $doctor->specialization_id }} -
                    {{ $doctor->specialization->name }}
                </td>
                <td>
                    <a href="#modalEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal" onclick="getEditForm({{ $doctor->id }})">Edit</a>

                    @can('delete-permission', Auth::user())
                    <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure to delete {{ $doctor->id }} - {{ $doctor->name }}?')) deleteDataRemove({{ $doctor->id }})">
                        Delete
                    </a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- </body>

        </html> -->
@endsection

@push('modals')
{{-- Modal Create --}}
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.doctors.store') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Doctor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Doctor Name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Doctor Email">
                    </div>
                    <div class="form-group mb-2">
                        <label>Specialization</label>
                        <select class="form-control" name="specialization_id">
                            @foreach ($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="form-group mb-2">
                        <label>Users</label>
                        <select class="form-control" name="user_id">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Type B --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Article</h4>
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
            url: '{{ route("admin.doctors.getEditForm") }}',
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
        var name = $('#name').val();
        var email = $('#email').val();
        var specialization_id = $('#specialization_id').val();
        var user_id = $('#user_id').val();

        $.ajax({
            type: 'POST',
            url: '{{ route("admin.doctors.saveDataUpdate") }}',
            data: {
                '_token': '<?php echo csrf_token(); ?>',
                'id': id,
                'name': name,
                'email': email,
                'specialization_id': specialization_id,
                'user_id': user_id,
            },
            success: function(data) {
                if (data.status == "oke") {
                    $('#td_name_' + id).html(name);
                    $('#td_email_' + id).html(email);
                    $('#td_specialization_' + id).html($('#specialization_id option:selected').text());
                    $('#td_user_' + id).html($('#user_id option:selected').text());
                    $('#modalEdit').modal('hide');
                }
            }
        });
    }

    function deleteDataRemove(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("admin.doctors.deleteData") }}',
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