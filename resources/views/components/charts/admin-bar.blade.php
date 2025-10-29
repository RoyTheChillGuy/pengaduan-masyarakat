@props([
  'categories' => [],
  'seriesDiproses' => [],
  'seriesSelesai' => [],
  'height' => 350,
  'elementId' => 'admin-bar-chart'
])

<div id="{{ $elementId }}" style="min-height:{{ (int)$height }}px;height:100%;width:100%"></div>

@push('scripts-base')
  <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (typeof ApexCharts === 'undefined') return;
  const options = {
    chart: { type: 'bar', height: {{ (int)$height }}, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
    dataLabels: { enabled: false },
    stroke: { show: true, width: 2, colors: ['transparent'] },
    colors: ['#435ebe', '#55c6e8'],
    series: [
      { name: 'Diproses', data: @json($seriesDiproses) },
      { name: 'Selesai', data: @json($seriesSelesai) }
    ],
    xaxis: { categories: @json($categories) },
    yaxis: { title: { text: 'Jumlah' } },
    fill: { opacity: 1 },
    grid: { borderColor: '#e7e7e7', strokeDashArray: 4 },
    legend: { position: 'top', horizontalAlign: 'left' }
  };
  const el = document.getElementById(@json($elementId));
  if (el) new ApexCharts(el, options).render();
});
</script>
@endpush


