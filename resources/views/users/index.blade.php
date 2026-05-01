<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-users')
    active
@endsection
@section('title')
    Users
@endsection
@section('content')
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Name</td>
                    <td style="font-weight:bold">Email</td>
                    <td style="font-weight:bold">Role</td>
                </tr>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </body>

    </html> -->
@endsection