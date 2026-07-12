<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allDoctors = Doctor::with(['specialization', 'user'])->get();
        $specializations = Specialization::all();
        $users = User::where('role', '!=', 'doctor')->get();
        return view('admin.doctors.index', ['doctors' => $allDoctors, 'specializations' => $specializations, 'users' => $users]);
    }

    public function publicIndex(Request $request)
    {
        $query = Doctor::with(['specialization', 'user']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();

        return view('member.doctors.index', compact('doctors'));
    }

    public function doctorIndex(Request $request)
    {
        $query = Doctor::with(['specialization', 'user']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();

        return view('doctor.doctors.index', compact('doctors'));
    }

    public function publicShow($id)
    {
        $doctor = Doctor::with(['specialization', 'user', 'schedules'])->findOrFail($id);

        return view('member.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialization_id' => 'required|exists:specializations,id',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = User::find($request->get('user_id'));
        $user->role = 'doctor';
        $user->save();

        $doctor = new Doctor();
        $doctor->name = "Dr. " . $user->name;
        $doctor->specialization_id = $request->get('specialization_id');
        $doctor->phone = $request->get('phone');
        $doctor->bio = $request->get('bio');
        $doctor->experience_years = $request->get('experience_years');
        $doctor->user_id = $user->id;

        if ($request->hasFile('photo')) {
            $doctor->photo = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization_id' => 'required|exists:specializations,id',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
        ]);

        $doctor->name = $request->get('name');
        $doctor->specialization_id = $request->get('specialization_id');
        $doctor->phone = $request->get('phone');
        $doctor->bio = $request->get('bio');
        $doctor->experience_years = $request->get('experience_years');

        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $doctor->photo = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Doctor::with('user')->find($id);
        $users = User::all();
        $specializations = Specialization::all();
        return response()->json([
            'status' => 'oke',
            'msg' => view('admin.doctors.getEditForm', compact('data', 'users', 'specializations'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        $data->name = $request->name;
        $data->specialization_id = $request->specialization_id;
        $data->phone = $request->phone;
        $data->bio = $request->bio;
        $data->experience_years = $request->experience_years;

        if ($request->hasFile('photo')) {
            if ($data->photo) {
                Storage::disk('public')->delete($data->photo);
            }
            $data->photo = $request->file('photo')->store('doctors', 'public');
        }

        $data->save();

        return response()->json([
            'status' => 'oke',
            'msg' => 'Doctor data is up-to-date!',
            'photo_url' => $data->photo ? asset('storage/' . $data->photo) : null,
        ], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Doctor::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Doctor <b>' . $data->name . '</b> berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus doctor ini.'
            ], 200);
        }
    }
}
