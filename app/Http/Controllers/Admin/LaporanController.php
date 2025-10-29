<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function diproses()
    {
        $laporans = Laporan::with('pelapor')
            ->where('status', 'proses')
            ->latest()
            ->paginate(10);

        return view('admin.laporan.diproses', compact('laporans'));
    }

    public function selesai()
    {
        $laporans = Laporan::with('pelapor')
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);

        return view('admin.laporan.selesai', compact('laporans'));
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai'
        ]);

        $laporan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}

