<div
    wire:init="refreshData"
    wire:poll.30s="refreshData"
>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Grafik Laporan per Status</h4>
            <button class="btn btn-sm btn-outline-primary" wire:click="refreshData">Refresh</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div id="laporan-status-chart" wire:ignore style="min-height: 320px"></div>
                </div>
                <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Diproses</span>
                            <span class="badge bg-warning rounded-pill">{{ $countProses }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Selesai</span>
                            <span class="badge bg-success rounded-pill">{{ $countSelesai }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function initLaporanStatusChart(retry = 0) {
            const MAX_RETRY = 10;
            if (!window.ApexCharts) {
                if (retry < MAX_RETRY) {
                    return setTimeout(() => initLaporanStatusChart(retry + 1), 200);
                }
                return;
            }

            const el = document.getElementById('laporan-status-chart');
            if (!el) return;

            if (!window.__laporanStatusChart) {
                const options = {
                    chart: { type: 'donut', height: 320 },
                    labels: ['Proses', 'Selesai'],
                    series: [{{ $countProses }}, {{ $countSelesai }}],
                    colors: ['#f59e0b', '#22c55e'],
                    legend: { position: 'bottom' },
                    dataLabels: { enabled: true },
                    stroke: { width: 2 },
                };
                window.__laporanStatusChart = new ApexCharts(el, options);
                window.__laporanStatusChart.render();
            }

            window.__laporanStatusChartUpdateHandler = window.__laporanStatusChartUpdateHandler || (event => {
                const payload = event.detail?.data;
                if (!payload || !window.__laporanStatusChart) return;
                window.__laporanStatusChart.updateOptions({ labels: payload.labels });
                window.__laporanStatusChart.updateSeries(payload.series);
            });

            window.removeEventListener('laporan-status-updated', window.__laporanStatusChartUpdateHandler);
            window.addEventListener('laporan-status-updated', window.__laporanStatusChartUpdateHandler);

            document.addEventListener('livewire:navigating', () => {
                if (window.__laporanStatusChart) {
                    window.__laporanStatusChart.destroy();
                    window.__laporanStatusChart = null;
                }
            }, { once: true });
        })();
    </script>
</div>


