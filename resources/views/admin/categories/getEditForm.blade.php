<h2>Edit Category</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Category Name</label>
    <input type="text" class="form-control" id="category_name" value="{{ $data->category_name }}">
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>