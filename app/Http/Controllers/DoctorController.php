<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allDoctors = Doctor::with('specialization')->get();
        $specializations = Specialization::all();
        $users = User::all();
        return view('admin.doctors.index', ['doctors' => $allDoctors, 'specializations' => $specializations, 'users' => $users]);
    }

    public function publicIndex(Request $request)
    {
        $query = Doctor::with('specialization');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $doctors = $query->get();

        return view('member.doctors.index', compact('doctors'));
    }

    public function publicShow($id)
    {
        $doctor = Doctor::with('specialization')->find($id);

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
        $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->specialization_id = $request->get('specialization_id');
        $doctor->user_id = $request->get('user_id');
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
        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->specialization = $request->get('specialization');
        $doctor->user_id = auth()->id();
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
        $data = Doctor::find($id);
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
        $data->email = $request->email;
        $data->specialization_id = $request->specialization_id;
        $data->user_id = $request->user_id;
        $data->save();
        return response()->json(['status' => 'oke', 'msg' => 'Doctor data is up-to-date!'], 200);
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
