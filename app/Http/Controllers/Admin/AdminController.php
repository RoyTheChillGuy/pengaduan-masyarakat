<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = auth()->user();
        // Get total laporan count
        $totalLaporan = Laporan::count();
        
        // Get laporan by status
        $laporanDiproses = Laporan::where('status', 'proses')->count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        
        // Build dynamic monthly data for current year
        $year = Carbon::now()->year;
        $monthNames = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $chartCategories = $monthNames;

        $prosesMonthly = array_fill(1, 12, 0);
        $selesaiMonthly = array_fill(1, 12, 0);

        Laporan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('status', 'proses')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->each(function ($row) use (&$prosesMonthly) {
                $prosesMonthly[(int)$row->month] = (int)$row->total;
            });

        Laporan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('status', 'selesai')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->each(function ($row) use (&$selesaiMonthly) {
                $selesaiMonthly[(int)$row->month] = (int)$row->total;
            });

        // Reindex to 0-based array for JS
        $chartSeriesDiproses = array_values($prosesMonthly);
        $chartSeriesSelesai = array_values($selesaiMonthly);

        // Get recent laporans for display
        $recentLaporans = Laporan::with('pelapor')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'laporanDiproses', 
            'laporanSelesai',
            'recentLaporans',
            'chartCategories',
            'chartSeriesDiproses',
            'chartSeriesSelesai',
            'admin'
        ));
    }
}

