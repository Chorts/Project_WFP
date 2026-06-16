<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBookings = Booking::with(['user','doctor','service','schedule'])->get();
        $users = User::all();
        $doctors = Doctor::all();
        $services = Service::all();
        $schedules = DoctorSchedule::all();
        return view('bookings.index', ['bookings' => $allBookings, 'users' => $users,
            'doctors' => $doctors, 'services' => $services, 'schedules' => $schedules,]);
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
        $booking = new Booking();
        $booking->user_id = $request->get('user_id');
        $booking->service_id = $request->get('service_id');
        $booking->schedule_id = $request->get('schedule_id');
        $booking->status = $request->get('status');
        $booking->booking_date = $request->get('booking_date');
        $booking->save();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {

    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Booking::find($id);
        $users = User::all();
        $doctors = Doctor::all();
        $services = Service::all();
        $schedules = DoctorSchedule::all();

        return response()->json([
            'status' => 'oke',
            'msg' => view('bookings.getEditForm', compact('data', 'users', 'doctors', 'services', 'schedules'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $booking = Booking::find($id);
        $booking->user_id = $request->get('user_id');
        $booking->service_id = $request->get('service_id');
        $booking->schedule_id = $request->get('schedule_id');
        $booking->status = $request->get('status');
        $booking->booking_date = $request->get('booking_date');
        $booking->save();

        return response()->json([
            'status' => 'oke',
            'msg' => 'Booking data is up-to-date!'
        ], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Booking::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Booking <b>' . $data->id . '</b> berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus booking ini.'
            ], 200);
        }
    }
}
