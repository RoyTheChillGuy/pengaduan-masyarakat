<div>
  <div class="mt-8 flex items-center space-x-8">
    <div class="text-center">
      <div class="text-2xl font-bold text-primary-600">{{ number_format($countSelesai) }}</div>
      <div class="text-sm text-gray-600">Laporan Selesai</div>
    </div>
    <div class="text-center">
      <div class="text-2xl font-bold text-primary-600">{{ number_format($countDiproses) }}</div>
      <div class="text-sm text-gray-600">Dalam Proses</div>
    </div>
    <div class="text-center">
      <div class="text-2xl font-bold text-primary-600">{{ $percentKepuasan }}%</div>
      <div class="text-sm text-gray-600">Tingkat Kepuasan</div>
    </div>
  </div>

  <script>
    document.addEventListener('livewire:init', () => {
      Livewire.on('warga-donut-update', ({ series, labels }) => {
        const el = document.getElementById('warga-donut');
        if (!el || typeof ApexCharts === 'undefined') return;
        if (!el._apexchart) {
          const options = {
            series: series,
            labels: labels,
            colors: ['#435ebe', '#55c6e8'],
            chart: { type: 'donut', width: '100%', height: '320px' },
            legend: { position: 'bottom' },
            plotOptions: { pie: { donut: { size: '30%' } } },
            dataLabels: { enabled: true }
          };
          el._apexchart = new ApexCharts(el, options);
          el._apexchart.render();
        } else {
          el._apexchart.updateSeries(series, true);
        }
      })
    })
  </script>
</div>


