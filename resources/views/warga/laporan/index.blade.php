@extends('layouts.warga')
@section('title','Status Laporan Saya')

@section('content')
  <section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-8">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Status Laporan Saya</h1>
        <p class="text-gray-600">Berikut daftar laporan yang Anda buat.</p>
      </div>

      @if($laporans->count() === 0)
        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-10 text-center">
          <p class="text-gray-600 mb-4">Anda belum memiliki laporan.</p>
          <a href="{{ route('warga.laporan.create') }}" class="inline-block bg-primary-500 text-white px-6 py-3 rounded-lg hover:bg-primary-600 transition-colors">
            Buat Laporan Pertama
          </a>
        </div>
      @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($laporans as $laporan)
            @include('warga.partials.laporan-card', ['laporan' => $laporan])
          @endforeach
        </div>

        <div class="mt-8">
          {{ $laporans->links() }}
        </div>
      @endif
    </div>
  </section>
@endsection



