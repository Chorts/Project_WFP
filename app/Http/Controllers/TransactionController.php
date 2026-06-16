<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTransactions = Transaction::with('booking')->get();
        $bookings = Booking::all();

        return view('transactions.index', ['transactions' => $allTransactions, 'bookings' => $bookings,]);
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
        $transaction = new Transaction();
        $transaction->booking_id = $request->get('booking_id');
        $transaction->status = $request->get('status');
        $transaction->price = $request->get('price');
        $transaction->transaction_date = $request->get('transaction_date');
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $bookings = Booking::all();

        return response()->json([
            'status' => 'oke',
            'msg' => view('transactions.getEditForm', compact('data', 'bookings'))->render()
        ], 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Transaction::find($id);
        $data->booking_id = $request->booking_id;
        $data->status = $request->status;
        $data->price = $request->price;
        $data->transaction_date = $request->transaction_date;
        $data->save();

        return response()->json(['status' => 'oke', 'msg' => 'Transaction data is up-to-date!'], 200);
    }

    public function deleteData(Request $request)
    {
        $this->authorize('delete-permission', Auth::user());

        $id = $request->id;
        $data = Transaction::find($id);

        try {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Transaction berhasil dihapus!'
            ], 200);
        } catch (\PDOException $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Gagal menghapus! Pastikan tidak ada data terkait sebelum menghapus transaction ini.'
            ], 200);
        }
    }
}
