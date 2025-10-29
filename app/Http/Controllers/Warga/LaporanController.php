<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        $laporans = Laporan::query()
            ->where('pelapor_id', $userId)
            ->latest()
            ->paginate(6);

        return view('warga.laporan.index', [
            'laporans' => $laporans,
        ]);
    }
}



