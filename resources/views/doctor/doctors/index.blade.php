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
                <td id="td_email_{{ $doctor->id }}">{{ $doctor->email }}</td>
                <td id="td_specialization_{{ $doctor->id }}">{{ $doctor->specialization_id }} -
                    {{ $doctor->specialization->name }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection