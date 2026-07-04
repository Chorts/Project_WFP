<h2>Edit Doctor</h2>

@csrf
@method('PUT')

<div class="form-group mb-2">
    <label>Name</label>
    <input type="text" class="form-control" id="name" value="{{ $data->name }}">
</div>
<div class="form-group mb-2">
    <label>Email</label>
    <input type="text" class="form-control" id="email" value="{{ $data->email }}">
</div>
<div class="form-group mb-2">
    <label>Specialization</label>
    <select class="form-control" id="specialization_id">
        @foreach ($specializations as $specialization)
            <option value="{{ $specialization->id }}"
                {{ $data->specialization_id == $specialization->id ? 'selected' : '' }}>
                {{ $specialization->id }} - {{ $specialization->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group mb-2">
    <label>Users</label>
    <select class="form-control" id="user_id">
        @foreach ($users as $user)
            <option value="{{ $user->id }}"
                {{ $data->user->id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="button" class="btn btn-primary" onclick="saveDataUpdate({{ $data->id }})">Submit</button>