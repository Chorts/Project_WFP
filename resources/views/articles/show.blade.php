<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body> -->
@extends('layouts.adminlte4')
@section('sidebar-articles')
active
@endsection
@section('title')
Articles
@endsection
@section('content')
<div class="container">
    <div class="header text-center">
        <h1>{{ $article->title }}</h1>
        <p>Date Published: {{ $article->date_published }}</p>
        <p>Doctor ID: {{ $article->doctor_id }}</p>
        <p>Doctor Name: {{ $article->doctor->name }}</p>
    </div>
    <p>{{ $article->article }}</p>
</div>
<!-- </body>

    </html> -->
@endsection