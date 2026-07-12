<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Article;
use App\Models\Booking;
use App\Models\Consultation;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $doctorCount = Doctor::count();
        $memberCount = User::where('role', 'member')->count();
        $articleCount = Article::count();
        $bookingCount = Booking::count();
        $activeConsultationCount = Consultation::where('status', 'Aktif')->count();
        $doneConsultationCount = Consultation::where('status', 'Selesai')->count();

        
        $todayPatientCount = Consultation::whereDate('created_at', today())->count();//itung jmlh pasien hr ini :)
        $rangeDays = 7; //jarak grafik (hari) :)

        $consultationsPerDay = Consultation::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->where('created_at', '>=', now()->subDays($rangeDays - 1)->startOfDay())
            ->groupBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $chartLabels = [];
        $chartData = [];

        for ($i = $rangeDays - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $key = $date->toDateString();

            $chartLabels[] = $date->translatedFormat('d M');
            $chartData[] = (int) ($consultationsPerDay[$key] ?? 0);
        }

        return view('admin.dashboard.index', compact(
            'doctorCount',
            'memberCount',
            'articleCount',
            'bookingCount',
            'activeConsultationCount',
            'doneConsultationCount',
            'todayPatientCount',
            'chartLabels',
            'chartData'
        ));
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