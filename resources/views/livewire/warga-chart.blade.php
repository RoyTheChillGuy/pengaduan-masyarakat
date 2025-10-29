<div
    wire:init="refreshData"
    wire:poll.30s="refreshData"
>
    <div class="bg-white shadow rounded p-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Grafik Status Laporan Saya</h3>
            <button class="text-sm px-3 py-1 border rounded" wire:click="refreshData">Refresh</button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
            <div class="lg:col-span-2">
                <div id="warga-laporan-status-chart" wire:ignore style="min-height: 320px"></div>
            </div>
            <div>
                <ul class="space-y-2">
                    <li class="flex items-center justify-between p-3 bg-yellow-50 rounded">
                        <span>Diproses</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium bg-yellow-400 text-white rounded-full">{{ $countProses }}</span>
                    </li>
                    <li class="flex items-center justify-between p-3 bg-emerald-50 rounded">
                        <span>Selesai</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium bg-emerald-500 text-white rounded-full">{{ $countSelesai }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        (function initWargaChart(retry = 0) {
            const MAX_RETRY = 10;
            if (!window.ApexCharts) {
                if (retry < MAX_RETRY) {
                    return setTimeout(() => initWargaChart(retry + 1), 200);
                }
                return;
            }

            const el = document.getElementById('warga-laporan-status-chart');
            if (!el) return;

            if (!window.__wargaLaporanStatusChart) {
                const options = {
                    chart: { type: 'donut', height: 320 },
                    labels: ['Proses', 'Selesai'],
                    series: [{{ $countProses }}, {{ $countSelesai }}],
                    colors: ['#f59e0b', '#22c55e'],
                    legend: { position: 'bottom' },
                    dataLabels: { enabled: true },
                    stroke: { width: 2 },
                };
                window.__wargaLaporanStatusChart = new ApexCharts(el, options);
                window.__wargaLaporanStatusChart.render();
            }

            window.__wargaLaporanStatusChartUpdateHandler = window.__wargaLaporanStatusChartUpdateHandler || (event => {
                const payload = event.detail?.data;
                if (!payload || !window.__wargaLaporanStatusChart) return;
                window.__wargaLaporanStatusChart.updateOptions({ labels: payload.labels });
                window.__wargaLaporanStatusChart.updateSeries(payload.series);
            });

            window.removeEventListener('warga-laporan-status-updated', window.__wargaLaporanStatusChartUpdateHandler);
            window.addEventListener('warga-laporan-status-updated', window.__wargaLaporanStatusChartUpdateHandler);

            document.addEventListener('livewire:navigating', () => {
                if (window.__wargaLaporanStatusChart) {
                    window.__wargaLaporanStatusChart.destroy();
                    window.__wargaLaporanStatusChart = null;
                }
            }, { once: true });
        })();
    </script>
</div>




