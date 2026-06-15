<h2>Edit Service</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Service Name</label>
    <input type="text" class="form-control" id="s_service_name" value="{{ $data->service_name }}">
</div>
<div class="form-group mb-2">
    <label>Description</label>
    <input type="text" class="form-control" id="s_description" value="{{ $data->description }}">
</div>
<div class="form-group mb-2">
    <label>Price</label>
    <input type="number" class="form-control" id="s_price" value="{{ $data->price }}">
</div>
<div class="form-group mb-2">
    <label>Category</label>
    <select class="form-control" id="s_category_id">
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
    <select class="form-control" id="s_tipe_service">
        <option value="Chat" {{ $data->tipe_service == 'Chat' ? 'selected' : '' }}>Chat</option>
        <option value="Offline" {{ $data->tipe_service == 'Offline' ? 'selected' : '' }}>Offline</option>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>