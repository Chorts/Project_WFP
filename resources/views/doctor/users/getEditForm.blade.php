<h2>Edit User</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="{{ $data->name }}">
</div>

<div class="form-group mb-2">
    <label>Email</label>
    <input type="email" class="form-control" id="email" value="{{ $data->email }}">
</div>

<div class="form-group mb-2">
    <label>Password</label>
    <input type="password" class="form-control" id="password" placeholder="Blank if no change">
</div>

<div class="form-group mb-2">
    <label>Role</label>
    <select class="form-control" id="role">
        <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>admin</option>
        <option value="doctor" {{ $data->role == 'doctor' ? 'selected' : '' }}>doctor</option>
        <option value="member" {{ $data->role == 'member' ? 'selected' : '' }}>member</option>
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>