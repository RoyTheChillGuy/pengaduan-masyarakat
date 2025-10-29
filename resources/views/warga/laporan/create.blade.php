@extends('layouts.warga')
@section('title','Buat Laporan - Warga')

@section('content')
  <section class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-6">Buat Laporan</h1>
      <div class="bg-white rounded-xl shadow p-6">
        <livewire:laporan-create />
      </div>
    </div>
  </section>
@endsection
