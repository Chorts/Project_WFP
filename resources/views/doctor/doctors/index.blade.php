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


    <table class="table">
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:bold">ID</td>
                <td style="font-weight:bold">Name</td>
                <td style="font-weight:bold">Email</td>
                <td style="font-weight:bold">Specialization</td>
            </tr>
            @foreach ($doctors as $doctor)
            <tr id="tr_{{ $doctor->id }}">
                <td id="td_id_{{ $doctor->id }}">{{ $doctor->id }}</td>
                <td id="td_name_{{ $doctor->id }}">{{ $doctor->name }}</td>
                <td id="td_email_{{ $doctor->id }}">{{ $doctor->user->email }}</td>
                <td id="td_specialization_{{ $doctor->id }}">{{ $doctor->specialization_id }} -
                    {{ $doctor->specialization->name }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection