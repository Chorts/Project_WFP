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
        $allBookings = Booking::with(['user', 'doctor', 'service', 'schedule'])->get();
        $users = User::all();
        $doctors = Doctor::all();

        $schedules = DoctorSchedule::all();
        return view('bookings.index', [
            'bookings' => $allBookings,
            'users' => $users,
            'doctors' => $doctors,

            'schedules' => $schedules,
        ]);
    }

    public function adminIndex()
    {
        $users = User::all();
        $schedules = DoctorSchedule::with('doctor')->get();
        $bookings = Booking::with(['user', 'schedule.doctor'])->get();

        return view('admin.bookings.index', compact('bookings', 'users', 'schedules'));
    }

    public function adminShow($id)
    {
        $booking = Booking::with(['doctor', 'member'])->find($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function doctorIndex()
    {
        $bookings = Booking::with("user", "schedule.doctor")
            ->whereHas("schedule", function ($query) {
                $query->where("doctor_id", auth()->user()->doctor->id);
            })
            ->get();

        return view('doctor.bookings.index', compact('bookings'));
    }

    public function memberIndex()
    {
        $bookings = Booking::where('user_id', auth()->id())->where("status", "Dipesan")->with(['schedule.doctor', 'consultation'])->get();
        $schedules = DoctorSchedule::with('doctor')
            ->get()
            ->map(function ($schedule) {
                $schedule->booked_dates = $schedule->bookings()
                    ->where('status', 'Dipesan')
                    ->pluck('booking_date')
                    ->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
                    ->values();
                return $schedule;
            });

        return view('member.bookings.index', compact('bookings', 'schedules'));
    }


    public function create()
    {
        $doctors = Doctor::all();
        $schedules = DoctorSchedule::with('doctor')->get();
        return view("member.bookings.create", compact("doctors", "schedules"));
    }


    public function adminStore(Request $request)
    {
        $booking = new Booking();
        $booking->user_id = $request->get('user_id');
        $booking->schedule_id = $request->get('schedule_id');
        $booking->status = "Dipesan";
        $booking->booking_date = $request->get('booking_date');
        $booking->save();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function memberStore(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:doctor_schedules,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        $schedule = DoctorSchedule::findOrFail($request->get('schedule_id'));
        $bookingDate = $request->get('booking_date');

        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $selectedDay = $dayNames[\Carbon\Carbon::parse($bookingDate)->dayOfWeek];

        if ($selectedDay !== $schedule->day) {
            return back()
                ->withInput()
                ->withErrors(['booking_date' => 'Tanggal yang dipilih tidak sesuai dengan hari pada jadwal (' . $schedule->day . ').']);
        }

        $isTaken = Booking::where('schedule_id', $schedule->id)
            ->where('booking_date', $bookingDate)
            ->where('status', 'Dipesan')
            ->exists();

        if ($isTaken) {
            return back()
                ->withInput()
                ->withErrors(['schedule_id' => 'Jadwal ini sudah dipesan pada tanggal tersebut. Silakan pilih jadwal atau tanggal lain.']);
        }

        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->schedule_id = $schedule->id;
        $booking->status = "Dipesan";
        $booking->booking_date = $bookingDate;
        $booking->save();

        return redirect()->route('member.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function start()
    {
    }

    public function close()
    {
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
        $schedules = DoctorSchedule::all();

        return response()->json([
            'status' => 'oke',
            'msg' => view('admin.bookings.getEditForm', compact('data', 'users', 'doctors', 'schedules'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $booking = Booking::find($id);
        $booking->user_id = $request->get('user_id');
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
