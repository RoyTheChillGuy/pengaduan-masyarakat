@extends('layouts.warga')

@section('title','Dashboard - Warga')

@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <h2 class="text-2xl font-bold mb-6">Dashboard Saya</h2>

  <div class="grid grid-cols-1 gap-6">
    {{-- Grafik status laporan pribadi --}}
    @livewire('warga-chart')
  </div>
</section>
@endsection

@push('scripts')
  {{-- Library ApexCharts untuk chart donut --}}
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  @livewireScripts
@endpush




