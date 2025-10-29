@props([
  'variant' => 'link',   // link|button|outline
  'label'   => 'Keluar',
])

<form method="POST" action="{{ route('logout') }}" {{ $attributes->class('inline') }}>
  @csrf
  @if ($variant === 'button')
    <button type="submit"
      class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
      <i class="bi bi-box-arrow-right"></i> {{ $label }}
    </button>
  @elseif ($variant === 'outline')
    <button type="submit"
      class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
      <i class="bi bi-box-arrow-right"></i> {{ $label }}
    </button>
  @else
    {{-- tampil seperti link (mis. di sidebar) --}}
    <button type="submit" class="sidebar-link w-100 text-start btn btn-link p-0">
      <i class="bi bi-box-arrow-right"></i> <span>{{ $label }}</span>
    </button>
  @endif
</form>
