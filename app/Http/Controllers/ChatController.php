<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allChats = Chat::with(['booking.schedule.doctor', 'sender'])->get();
        $bookings = Booking::with(['user', 'schedule.doctor'])->get();
        $users = User::all();

        return view('chats.index', ['chats' => $allChats, 'bookings' => $bookings, 'users' => $users,]);
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
        $chat = new Chat();
        $chat->booking_id = $request->get('booking_id');
        $chat->sender_id = $request->get('sender_id');
        $chat->tipe_sender = $request->get('tipe_sender');
        $chat->chat = $request->get('chat');
        $chat->save();

        return redirect()->route('chats.index')->with('success', 'Chat created successfully.');
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

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Chat::find($id);
        $bookings = Booking::with(['user', 'schedule.doctor'])->get();
        $users = User::all();

        return response()->json([
            'status' => 'oke',
            'msg' => view('chats.getEditForm', compact('data', 'bookings', 'users'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Chat::find($id);
        $data->booking_id = $request->booking_id;
        $data->sender_id = $request->sender_id;
        $data->tipe_sender = $request->tipe_sender;
        $data->chat = $request->chat;
        $data->save();

        return response()->json([
            'status' => 'oke',
            'msg' => 'Chat data is up-to-date!'
        ], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Chat::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Chat berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus chat ini.'
            ], 200);
        }
    }
}
