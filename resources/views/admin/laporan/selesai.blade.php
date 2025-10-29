@extends('layouts.admin')

@section('title','Laporan Selesai - Admin')

@section('content')
<div class="page-heading justify-items-start">
    <h3>Laporan Selesai</h3>
</div>

<div class="page-content">
    <section class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Laporan yang Sudah Selesai</h4>
                </div>
                <div class="card-body">
                    @if($laporans->count() > 0)
                        <div class="row">
                            @foreach($laporans as $laporan)
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        @if($laporan->foto_path)
                                            <img src="{{ asset('storage/' . $laporan->foto_path) }}" 
                                                 class="card-img-top" 
                                                 style="height: 200px; object-fit: cover;"
                                                 alt="Foto Laporan">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ Str::limit($laporan->judul, 50) }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-user"></i> {{ $laporan->pelapor->name }}
                                            </p>
                                            <p class="card-text">{{ Str::limit($laporan->detail, 100) }}</p>
                                            
                                            <div class="mt-auto">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check"></i> Selesai
                                                    </span>
                                                    <small class="text-muted">
                                                        {{ $laporan->updated_at->format('d/m/Y H:i') }}
                                                    </small>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-warning btn-sm flex-fill" 
                                                            onclick="updateStatus({{ $laporan->id }}, 'proses')">
                                                        <i class="fas fa-undo"></i> Kembalikan ke Proses
                                                    </button>
                                                    <button class="btn btn-info btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#detailModal{{ $laporan->id }}">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $laporans->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada laporan yang sudah selesai</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Detail Modals -->
@foreach($laporans as $laporan)
<div class="modal fade" id="detailModal{{ $laporan->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $laporan->judul }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Pelapor:</strong> {{ $laporan->pelapor->name }}</p>
                        <p><strong>Email:</strong> {{ $laporan->pelapor->email }}</p>
                        <p><strong>Tanggal Dibuat:</strong> {{ $laporan->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Tanggal Selesai:</strong> {{ $laporan->updated_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-success">Selesai</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if($laporan->foto_path)
                            <img src="{{ asset('storage/' . $laporan->foto_path) }}" 
                                 class="img-fluid rounded" 
                                 alt="Foto Laporan">
                        @else
                            <div class="bg-light p-4 text-center rounded">
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <p class="text-muted mt-2">Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div>
                    <h6>Detail Laporan:</h6>
                    <p>{{ $laporan->detail }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning" 
                        onclick="updateStatus({{ $laporan->id }}, 'proses')">
                    <i class="fas fa-undo"></i> Kembalikan ke Proses
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<form id="statusForm" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="status" id="statusInput">
</form>

@endsection

@push('scripts')
<script>
function updateStatus(laporanId, status) {
    if (confirm('Apakah Anda yakin ingin mengubah status laporan ini?')) {
        const form = document.getElementById('statusForm');
        form.action = `/admin/laporan/${laporanId}/status`;
        document.getElementById('statusInput').value = status;
        form.submit();
    }
}
</script>
@endpush

