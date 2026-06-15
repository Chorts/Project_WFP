<h2>Edit Service</h2>

<form method="POST" action="{{ route('services.update', $data->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group mb-2">
        <label>Service Name</label>
        <input type="text" class="form-control" name="service_name" value="{{ $data->service_name }}">
    </div>
    <div class="form-group mb-2">
        <label>Description</label>
        <input type="text" class="form-control" name="description" value="{{ $data->description }}">
    </div>
    <div class="form-group mb-2">
        <label>Price</label>
        <input type="number" class="form-control" name="price" value="{{ $data->price }}">
    </div>
    <div class="form-group mb-2">
        <label>Category</label>
        <select class="form-control" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $data->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-2">
        <label>Tipe Service</label>
        <select class="form-control" name="tipe_service">
            <option value="Chat" {{ $data->tipe_service == 'Chat' ? 'selected' : '' }}>Chat</option>
            <option value="Offline" {{ $data->tipe_service == 'Offline' ? 'selected' : '' }}>Offline</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>