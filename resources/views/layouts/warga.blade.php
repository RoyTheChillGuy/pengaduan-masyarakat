<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title','Laporan Masyarakat - Platform Pelaporan Online')</title>

  {{-- tailwind via cdn (boleh ganti ke @vite jika mau) --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: { colors: { primary: {50:'#ecfeff',100:'#cffafe',500:'#06b6d4',600:'#0891b2',700:'#0e7490',900:'#164e63'} } } }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

  @stack('styles')
  @livewireStyles
</head>
<body class="bg-gray-50">
  {{-- header --}}
  @include('warga.partials.header')

  {{-- page content --}}
  @yield('content')

  {{-- footer --}}
  @include('warga.partials.footer')

  {{-- script umum --}}
  <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
  @stack('scripts-base')
  @stack('scripts')
  @livewireScripts
</body>
</html>
