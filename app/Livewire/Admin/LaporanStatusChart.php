<?php

namespace App\Livewire\Admin;

use App\Models\Laporan;
use Livewire\Component;

class LaporanStatusChart extends Component
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

        $this->dispatch('laporan-status-updated', data: [
            'series' => [$this->countProses, $this->countSelesai],
            'labels' => ['Proses', 'Selesai'],
        ]);
    }

    private function loadCounts(): void
    {
        $this->countProses = Laporan::where('status', 'proses')->count();
        $this->countSelesai = Laporan::where('status', 'selesai')->count();
    }

    public function render()
    {
        return view('livewire.admin.laporan-status-chart');
    }
}



