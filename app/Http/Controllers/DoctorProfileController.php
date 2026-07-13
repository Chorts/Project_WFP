<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorProfileController extends Controller
{
   
    public function edit()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(404, 'Profil dokter tidak ditemukan untuk akun ini.');
        }

        $specializations = Specialization::all();

        return view('doctor.profile.edit', compact('doctor', 'specializations'));
    }

    public function update(Request $request)
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(404, 'Profil dokter tidak ditemukan untuk akun ini.');
        }

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

        return redirect()->route('doctor.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
