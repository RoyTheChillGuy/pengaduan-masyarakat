<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
  <div class="flex items-start justify-between mb-4">
    <h3 class="text-lg font-semibold text-gray-900">{{ $laporan->judul }}</h3>
    @php
      $statusColor = [
        'baru' => 'bg-gray-100 text-gray-800',
        'diajukan' => 'bg-blue-100 text-blue-800',
        'dalam_proses' => 'bg-yellow-100 text-yellow-800',
        'selesai' => 'bg-green-100 text-green-800',
        'ditolak' => 'bg-red-100 text-red-800',
      ][$laporan->status] ?? 'bg-gray-100 text-gray-800';
    @endphp
    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
      {{ Str::headline(str_replace('_',' ',$laporan->status)) }}
    </span>
  </div>
  <p class="text-gray-600 line-clamp-3">{{ $laporan->detail }}</p>
  <div class="mt-4 text-sm text-gray-500">
    Dibuat pada {{ $laporan->created_at?->format('d M Y H:i') }}
  </div>
  @if(!empty($laporan->foto_path))
    <div class="mt-4">
      <img src="{{ asset('storage/'.$laporan->foto_path) }}" alt="Foto laporan" class="w-full h-40 object-cover rounded-lg">
    </div>
  @endif
</div>



