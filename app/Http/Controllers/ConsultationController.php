<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Chat;

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
        $consultations = Consultation::where("doctor_id", auth()->id())->get();

        return view('doctor.consultations.index', compact('consultations'));
    }

    public function doctorHistory()
    {
        $consultations = Consultation::where("doctor_id", auth()->id())->where('status', 'Selesai')->get();

        return view('doctor.consultations.index', compact('consultations'));
    }

    public function doctorShow($id)
    {
        $consultation = Consultation::where("id", $id)->where("doctor_id", auth()->id())->with("member")->first();

        $chat = Chat::where("consultation_id", $id)->orderBy("created_at")->get();

        return view('doctor.consultations.show', compact('consultation', 'chat'));
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
    public function store(Request $request)
    {
        //
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
