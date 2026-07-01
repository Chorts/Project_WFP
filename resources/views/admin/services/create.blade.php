@extends('layouts.adminlte4')
@section('sidebar-services')
active
@endsection
@section('title')
Add New Service
@endsection

@section('content')
<div class="container">
    <h2>Add New Service</h2>

    <form method="POST" action="{{ route('admin.services.store')}}">
        @csrf

        <div class="form-group mb-2">
            <label>Service Name</label>
            <input type="text" class="form-control" name="service_name" placeholder="Enter Service Name">
        </div>
        <div class="form-group mb-2">
            <label>Description</label>
            <input type="text" class="form-control" name="description" placeholder="Enter Description">
        </div>
        <div class="form-group mb-2">
            <label>Price</label>
            <input type="number" class="form-control" name="price" placeholder="Enter Price">
        </div>
        <div class="form-group mb-2">
            <label>Category</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label>Tipe Service</label>
            <select class="form-control" name="tipe_service">
                <option value="Chat">Chat</option>
                <option value="Offline">Offline</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection