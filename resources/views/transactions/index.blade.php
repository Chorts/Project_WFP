<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-transactions')
    active
@endsection
@section('title')
    Transactions
@endsection
@section('content')
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Booking ID</td>
                    <td style="font-weight:bold">Patient ID</td>
                    <td style="font-weight:bold">Patient Name</td>
                    <td style="font-weight:bold">Doctor ID</td>
                    <td style="font-weight:bold">Doctor Name</td>
                    <td style="font-weight:bold">Service ID</td>
                    <td style="font-weight:bold">Service Name</td>
                    <td style="font-weight:bold">Status</td>
                    <td style="font-weight:bold">Price</td>
                    <td style="font-weight:bold">Date</td>
                </tr>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->booking->id }}</td>
                        <td>{{ $transaction->booking->user->id }}</td>
                        <td>{{ $transaction->booking->user->name }}</td>
                        <td>{{ $transaction->booking->doctor_id }}</td>
                        <td>{{ $transaction->booking->schedule->doctor->name }}</td>
                        <td>{{ $transaction->booking->service_id }}</td>
                        <td>{{ $transaction->booking->service->service_name }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ $transaction->price }}</td>
                        <td>{{ $transaction->transaction_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </body>

    </html> -->
@endsection