<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-services')
    active
@endsection
@section('title')
    Services
@endsection
@section('content')
    <div class="container">
        <table class="table">
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:bold">ID</td>
                    <td style="font-weight:bold">Service Name</td>
                    <td style="font-weight:bold">Description</td>
                    <td style="font-weight:bold">Price</td>
                    <td style="font-weight:bold">Category ID</td>
                    <td style="font-weight:bold">Category Name</td>
                    <td style="font-weight:bold">Tipe Service</td>
                </tr>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->category_id }}</td>
                        <td>{{ $service->category->category_name }}</td>
                        <td>{{ $service->tipe_service }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- </body>

    </html> -->
@endsection