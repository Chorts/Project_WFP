@extends('layouts.adminlte4')
@section('sidebar-services')
    active
@endsection
@section('title')
    Edit Service
@endsection

@section('content')
    <div class="container">
        <h2>Edit Service</h2>

        <form method="POST" action="{{ route('services.update', $service->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label>Service Name</label>
                <input type="text" class="form-control" name="service_name" value="{{ $service->service_name }}">
            </div>
            <div class="form-group mb-2">
                <label>Description</label>
                <input type="text" class="form-control" name="description" value="{{ $service->description }}">
            </div>
            <div class="form-group mb-2">
                <label>Price</label>
                <input type="number" class="form-control" name="price" value="{{ $service->price }}">
            </div>
            <div class="form-group mb-2">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $service->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label>Tipe Service</label>
                <select class="form-control" name="tipe_service">
                    <option value="Chat" {{ $service->tipe_service == 'Chat' ? 'selected' : '' }}>Chat</option>
                    <option value="Offline" {{ $service->tipe_service == 'Offline' ? 'selected' : '' }}>Offline</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection