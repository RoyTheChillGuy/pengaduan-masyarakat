@props([
  'selesai' => 0,
  'diproses' => 0,
  'height' => 320,
  'elementId' => 'admin-donut-chart',
  'labels' => ['Selesai','Diproses']
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
    series: [{{ (int)$selesai }}, {{ (int)$diproses }}],
    labels: @json($labels),
    colors: ['#435ebe', '#55c6e8'],
    chart: { type: 'donut', width: '100%', height: '{{ (int)$height }}px' },
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '30%' } } },
    dataLabels: { enabled: true }
  };
  const el = document.getElementById(@json($elementId));
  if (el) new ApexCharts(el, options).render();
});
</script>
@endpush


