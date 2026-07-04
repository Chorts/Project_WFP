<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSchedules = DoctorSchedule::with('doctor')->get();
        $doctors = Doctor::all();

        return view('admin.schedules.index', ['schedules' => $allSchedules, 'doctors' => $doctors,]);
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
        $schedule = new DoctorSchedule();
        $schedule->doctor_id = $request->get('doctor_id');
        $schedule->day = $request->get('day');
        $schedule->start_time = $request->get('start_time');
        $schedule->end_time = $request->get('end_time');
        $schedule->save();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorSchedule $doctorSchedule)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = DoctorSchedule::find($id);
        $doctors = Doctor::all();

        return response()->json([
            'status' => 'oke',
            'msg' => view('admin.schedules.getEditForm', compact('data', 'doctors'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = DoctorSchedule::find($id);
        $data->doctor_id = $request->doctor_id;
        $data->day = $request->day;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->save();

        return response()->json([
            'status' => 'oke',
            'msg' => 'Schedule data is up-to-date!'
        ], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = DoctorSchedule::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Schedule berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus schedule ini.'
            ], 200);
        }
    }
}
