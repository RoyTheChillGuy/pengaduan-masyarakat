<?php

namespace App\Livewire\Warga;

use Livewire\Component;
use App\Models\Laporan;

class HomeStats extends Component
{
    public int $countSelesai = 0;
    public int $countDiproses = 0;
    public int $percentKepuasan = 0; // simple proxy: selesai / total * 100
    public array $labels = ['Selesai','Diproses'];
    public array $series = [0, 0];

    public function mount(): void
    {
        $this->refreshData();
    }

    public function refreshData(): void
    {
        $userId = auth()->id();
        if ($userId) {
            $selesai = Laporan::where('pelapor_id', $userId)->where('status', 'selesai')->count();
            $diproses = Laporan::where('pelapor_id', $userId)->where('status', 'proses')->count();
            $total = Laporan::where('pelapor_id', $userId)->count();
        } else {
            $selesai = Laporan::where('status', 'selesai')->count();
            $diproses = Laporan::where('status', 'proses')->count();
            $total = Laporan::count();
        }

        $this->countSelesai = $selesai;
        $this->countDiproses = $diproses;
        $this->percentKepuasan = $total > 0 ? (int) round(($selesai / $total) * 100) : 0;
        $this->series = [$selesai, $diproses];

        $this->dispatch('warga-donut-update', series: $this->series, labels: $this->labels);
    }

    public function render()
    {
        return view('livewire.warga.home-stats');
    }
}


