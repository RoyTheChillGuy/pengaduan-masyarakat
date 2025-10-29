{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title','Dashboard - Admin')

@section('content')
<div class="page-heading justify-items-start">
    <h3>Data Laporan</h3>
    
</div>


<div class="page-content">
    <section class="row">
        <div class="col-12">
            {{-- 4 kartu stats --}}
            <div class="row justify-content-center">
                {{-- Card 1 --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Laporan</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($totalLaporan) }}</h6>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card 2 --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Diproses</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($laporanDiproses) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card 3 --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Selesai</h6>
                                    <h6 class="font-extrabold mb-0">{{ number_format($laporanSelesai) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Card 4 - Profile Card (Dynamic) --}}
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body py-4 px-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Avatar">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">{{ $admin->name }}</h5>
                                    <h6 class="text-muted mb-0">{{ '@' . Str::slug($admin->name) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            {{-- Charts Row: Bar (left) and Blue Pie (right) --}}
            <div class="row mt-4 align-items-stretch g-3">
                <div class="col-12 col-lg-9">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4>Distribusi Laporan</h4>
                        </div>
                        <div class="card-body d-flex">
                            <x-charts.admin-bar 
                                :categories="$chartCategories"
                                :series-diproses="$chartSeriesDiproses"
                                :series-selesai="$chartSeriesSelesai"
                                element-id="admin-bar"
                                height="350"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card h-100">
                        <div class="card-header text-center">
                            <h4>Grafik</h4>
                        </div>
                        <div class="card-body" style="overflow: visible;">
                            <x-charts.admin-donut 
                                :selesai="$laporanSelesai"
                                :diproses="$laporanDiproses"
                                element-id="chart-visitors-profile-blue"
                                height="300"
                            />
                        </div>
                    </div>
                </div>
            </div>
   
            {{-- Recent Laporan Section --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Laporan Terbaru</h4>
                        </div>
                        <div class="card-body">
                            @if($recentLaporans->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Pelapor</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentLaporans as $index => $laporan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ Str::limit($laporan->judul, 50) }}</td>
                                                    <td>{{ $laporan->pelapor->name }}</td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($laporan->status == 'selesai') bg-success
                                                            @elseif($laporan->status == 'proses') bg-warning
                                                            @else bg-secondary
                                                            @endif">
                                                            {{ ucfirst($laporan->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $laporan->created_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">Belum ada laporan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            </div> {{-- /row --}}
        </div> {{-- /col-9 --}}

    </section>
</div>
@endsection

@push('scripts-base')
    {{-- Library Charts --}}
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    @livewireScripts
@endpush

@push('scripts')
    {{-- Script halaman dashboard (jika ada file khusus Mazer) --}}
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
    <script>
        // scripts handled by blade components
    </script>
@endpush
