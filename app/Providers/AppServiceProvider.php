<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Laporan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('warga.homepage', function ($view) {
            $labels = ['Selesai', 'Diproses'];
            $userId = auth()->id();

            if ($userId) {
                // Counts for the authenticated user's own laporan
                $selesai = Laporan::where('pelapor_id', $userId)->where('status', 'selesai')->count();
                $diproses = Laporan::where('pelapor_id', $userId)->where('status', 'proses')->count();
            } else {
                // Global counts (all users) when not authenticated
                $selesai = Laporan::where('status', 'selesai')->count();
                $diproses = Laporan::where('status', 'proses')->count();
            }

            $view->with([
                'wargaUserLabels' => $labels,
                'wargaUserSeries' => [(int)$selesai, (int)$diproses],
            ]);
        });
    }
}
