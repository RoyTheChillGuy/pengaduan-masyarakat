<header class="bg-white shadow-sm sticky top-0 z-50">
  <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
          <i class="fas fa-clipboard-list text-white text-lg"></i>
        </div>
        <div>
          <h1 class="text-xl font-bold text-gray-900">Laporan Masyarakat</h1>
          <p class="text-xs text-gray-600">Platform Pelaporan Online</p>
        </div>
      </div>

      <div class="hidden md:flex items-center space-x-8">
        <a href="{{ route('warga.home') }}" class="text-gray-700 hover:text-primary-600 font-medium">Beranda</a>
        <a href="#cara-kerja" class="text-gray-700 hover:text-primary-600 font-medium">Cara Kerja</a>
        <a href="{{ route('warga.laporan.index') }}" class="text-gray-700 hover:text-primary-600 font-medium">Laporan</a>
        <a href="#kontak" class="text-gray-700 hover:text-primary-600 font-medium">Kontak</a>

        @auth
          @if(auth()->user()->role === 'warga')
            {{-- User greeting for warga --}}
            <span class="text-gray-700 font-medium">
              Halo, {{ auth()->user()->name }}
            </span>
            
            {{-- tombol buat laporan → route create --}}
            <a href="{{ route('warga.laporan.create') }}"
              class="bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600 transition-colors">
              Buat Laporan
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit"
                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium">
                Keluar
              </button> 
            </form>
          @else
            {{-- Admin users --}}
            <span class="text-gray-700 font-medium">
              Halo, {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit"
                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium">
                Keluar
              </button> 
            </form>
          @endif
        @else
          {{-- Guest users - show login button --}}
          <a href="{{ route('login') }}"
            class="bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600 transition-colors">
            Login
          </a>
        @endauth
      </div>

      {{-- burger mobile --}}
      <button class="md:hidden p-2" id="mobile-menu-btn">
        <i class="fas fa-bars text-gray-700"></i>
      </button>
    </div>

    {{-- mobile dropdown --}}
    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 px-4 py-4 space-y-2 hidden">
      <a href="#beranda" class="block text-gray-700 hover:text-primary-600 font-medium py-2">Beranda</a>
      <a href="#cara-kerja" class="block text-gray-700 hover:text-primary-600 font-medium py-2">Cara Kerja</a>
      <a href="#kategori" class="block text-gray-700 hover:text-primary-600 font-medium py-2">Kategori</a>
      <a href="#kontak" class="block text-gray-700 hover:text-primary-600 font-medium py-2">Kontak</a>
      
      @auth
        @if(auth()->user()->role === 'warga')
          {{-- User greeting for warga --}}
          <div class="text-gray-700 font-medium py-2">
            Halo, {{ auth()->user()->name }}
          </div>
          
          <a href="{{ route('warga.laporan.create') }}"
            class="block w-full text-center bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600 transition-colors mt-2">
            Buat Laporan
          </a>

          <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit"
              class="w-full text-center bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium">
              Keluar
            </button> 
          </form>
        @else
          {{-- Admin users --}}
          <div class="text-gray-700 font-medium py-2">
            Halo, {{ auth()->user()->name }}
          </div>

          <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit"
              class="w-full text-center bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium">
              Keluar
            </button> 
          </form>
        @endif
      @else
        {{-- Guest users - show login button --}}
        <a href="{{ route('login') }}"
          class="block w-full text-center bg-primary-500 text-white px-6 py-2 rounded-lg hover:bg-primary-600 transition-colors mt-2">
          Login
        </a>
      @endauth
    </div>
  </nav>
</header>

@push('scripts')
<script>
  // toggle mobile menu
  document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
    const m = document.getElementById('mobile-menu');
    if (m) m.classList.toggle('hidden');
  });
  // smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener('click', e=>{
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); target.scrollIntoView({behavior:'smooth', block:'start'}); }
    })
  });
</script>
@endpush