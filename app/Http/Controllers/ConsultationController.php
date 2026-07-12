<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Chat;
use App\Models\Booking;
use App\Models\Doctor;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function doctorIndex()
    {
        $doctor = Doctor::where("user_id", auth()->id())->first();
        $consultations = Consultation::where("doctor_id", $doctor->id)->where('status', 'Aktif')->get();

        return view('doctor.consultations.index', compact('consultations'));
    }

    public function doctorHistory()
    {
        $doctor = Doctor::where("user_id", auth()->id())->first();
        $consultations = Consultation::where("doctor_id", $doctor->id)->where('status', 'Selesai')->get();

        return view('doctor.consultations.index', compact('consultations'));
    }

    public function doctorShow($id)
    {
        $doctor = Doctor::where("user_id", auth()->id())->first();
        $consultation = Consultation::where("id", $id)->where("doctor_id", $doctor->id)->first();


        $chats = Chat::where("consultation_id", $id)->orderBy("created_at")->get();

        return view('doctor.consultations.show', compact('consultation', 'chats'));
    }


    public function memberIndex()
    {
        $consultations = Consultation::where("user_id", auth()->id())->where('status', 'Aktif')->get();

        return view('member.consultations.index', compact('consultations'));
    }

    public function memberHistory()
    {
        $consultations = Consultation::where("user_id", auth()->id())->where('status', 'Selesai')->get();

        return view('member.consultations.index', compact('consultations'));
    }

    public function memberShow($id)
    {
        $consultation = Consultation::where("id", $id)->where("user_id", auth()->id())->with("doctor")->first();

        $chats = Chat::where("consultation_id", $id)->orderBy("created_at")->get();

        return view('member.consultations.show', compact('consultation', 'chats'));
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
    public function store($id)
    {
        $booking = Booking::findorfail($id);

        $consultation = Consultation::where('booking_id', $booking->id)->first();
        if ($consultation) {
            return redirect()->route('member.consultations.show', $consultation->id)
            ->with('success', 'Konsultasi untuk booking ini sudah pernah dimulai');
        }
        
        $consultation = new Consultation();
        $consultation->user_id = auth()->id();
        $consultation->booking_id = $booking->id;
        $consultation->doctor_id = $booking->schedule->doctor_id;
        $consultation->status = "Aktif";
        $consultation->started_at = now();
        $consultation->save();

        return redirect()->route('member.consultations.show', $consultation->id)
            ->with('success', 'Konsultasi dimulai');
    }

    public function close($id)
    {
        $doctor = Doctor::where("user_id", auth()->id())->first();

        $consultation = Consultation::where("id", $id)->where("doctor_id", $doctor->id)->where("status", "Aktif")->first();
        if ($consultation) {
            $consultation->ringkasan = request()->ringkasan;
            $consultation->status = "Selesai";
            $consultation->ended_at = now();
            $consultation->save();

            return redirect()->route('doctor.consultations.index')
                ->with('success', 'Konsultasi selesai');
        } else {
            return redirect()->route('doctor.consultations.index')
                ->with('error', 'Tidak ada konsultasi aktif untuk diselesaikan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
