<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 0;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
    </style>
</head>

<body> -->
@extends("layouts.adminlte4")
@section('content')
    <div class="container"> 
        <a href="articles" class="btn btn-primary">Articles</a><br>
        <a href="services" class="btn btn-primary">Services</a><br>
        <a href="doctors" class="btn btn-primary">Doctors</a><br>
        <a href="transactions" class="btn btn-primary">Transactions</a><br>
        <a href="schedules" class="btn btn-primary">Schedules</a><br>
        <a href="bookings" class="btn btn-primary">Booking</a><br>
        <a href="users" class="btn btn-primary">Users</a><br>
        <a href="chats" class="btn btn-primary">Chats</a><br>
    </div>

    <!-- </body>

        </html> -->
@endsection