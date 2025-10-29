<?php

namespace App\Livewire;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WargaChart extends Component
{
    public int $countProses = 0;
    public int $countSelesai = 0;

    public function mount(): void
    {
        $this->loadCounts();
    }

    public function refreshData(): void
    {
        $this->loadCounts();

        $this->dispatch('warga-laporan-status-updated', data: [
            'series' => [$this->countProses, $this->countSelesai],
            'labels' => ['Proses', 'Selesai'],
        ]);
    }

    private function loadCounts(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->countProses = 0;
            $this->countSelesai = 0;
            return;
        }

        $this->countProses = Laporan::where('pelapor_id', $userId)
            ->where('status', 'proses')
            ->count();

        $this->countSelesai = Laporan::where('pelapor_id', $userId)
            ->where('status', 'selesai')
            ->count();
    }

    public function render()
    {
        return view('livewire.warga-chart');
    }
}




