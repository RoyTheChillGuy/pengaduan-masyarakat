@extends('layouts.warga')
@section('title','Beranda - Laporan Masyarakat')

@section('content')
  {{-- HERO --}}
  <section id="beranda" class="bg-gradient-to-br from-primary-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 text-balance">
          Suara Anda <span class="text-primary-600">Penting</span> untuk Perubahan
        </h1>
        <p class="text-xl text-gray-600 mb-8">
          Platform digital yang memungkinkan masyarakat melaporkan masalah infrastruktur, layanan publik, dan keprihatinan lainnya secara langsung kepada pihak berwenang.
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
          <a href="{{ route('warga.laporan.create') }}"
             class="bg-primary-500 text-white px-8 py-4 rounded-lg hover:bg-primary-600 transition-colors font-semibold text-lg">
            <i class="fas fa-plus mr-2"></i> Buat Laporan Sekarang
          </a>
          <a href="{{ route('warga.laporan.index') }}"
             class="border-2 border-primary-500 text-primary-600 px-8 py-4 rounded-lg hover:bg-primary-50 transition-colors font-semibold text-lg">
            <i class="fas fa-search mr-2"></i> Lihat Status Laporan
          </a>
        </div>

        @livewire('warga.home-stats')
      </div>

      <div class="relative">
        <div class="bg-white rounded-2xl shadow-xl p-8">
          <h3 class="font-semibold text-gray-900 mb-6 text-center">Grafik Laporan Terbaru</h3>
          <div id="warga-donut" class="mx-auto" style="width:100%;height:320px"></div>
        </div>
      </div>
    </div>
  </section>

  {{-- KATEGORI --}}
  <section id="kategori" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Kategori Laporan</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Pilih kategori yang sesuai dengan masalah yang ingin Anda laporkan</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ([
          ['icon'=>'fa-road','color'=>'blue','title'=>'Infrastruktur Jalan','desc'=>'Jalan rusak, lubang, lampu jalan mati, trotoar rusak'],
          ['icon'=>'fa-leaf','color'=>'green','title'=>'Lingkungan','desc'=>'Sampah menumpuk, pencemaran air, kebisingan'],
          ['icon'=>'fa-hospital','color'=>'purple','title'=>'Layanan Publik','desc'=>'Pelayanan kesehatan, pendidikan, administrasi'],
          ['icon'=>'fa-shield-alt','color'=>'red','title'=>'Keamanan','desc'=>'Tindak kriminal, gangguan ketertiban, kecelakaan'],
          ['icon'=>'fa-tools','color'=>'yellow','title'=>'Utilitas','desc'=>'Listrik padam, air mati, internet bermasalah'],
          ['icon'=>'fa-ellipsis-h','color'=>'indigo','title'=>'Lainnya','desc'=>'Masalah lain yang tidak termasuk kategori di atas'],
        ] as $k)
          <a href="{{ route('warga.laporan.create') }}"
             class="bg-gray-50 rounded-xl p-8 hover:shadow-lg transition-shadow group block">
            <div class="w-16 h-16 bg-{{ $k['color'] }}-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-{{ $k['color'] }}-200 transition-colors">
              <i class="fas {{ $k['icon'] }} text-{{ $k['color'] }}-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $k['title'] }}</h3>
            <p class="text-gray-600 mb-4">{{ $k['desc'] }}</p>
            <div class="text-primary-600 font-medium group-hover:text-primary-700">
              Laporkan Sekarang <i class="fas fa-arrow-right ml-1"></i>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CARA KERJA --}}
  <section id="cara-kerja" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Cara Kerja Platform</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Proses pelaporan yang mudah dan transparan dalam 4 langkah sederhana</p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ([
          ['no'=>1,'title'=>'Buat Laporan','desc'=>'Isi formulir dengan detail masalah, lokasi, dan foto pendukung'],
          ['no'=>2,'title'=>'Verifikasi','desc'=>'Tim kami akan memverifikasi dan mengkategorikan laporan Anda'],
          ['no'=>3,'title'=>'Tindak Lanjut','desc'=>'Laporan diteruskan ke instansi terkait untuk penanganan'],
          ['no'=>4,'title'=>'Update Status','desc'=>'Dapatkan notifikasi real-time tentang progress penanganan'],
        ] as $s)
          <div class="text-center">
            <div class="w-20 h-20 bg-primary-500 rounded-full flex items-center justify-center mx-auto mb-6">
              <span class="text-2xl font-bold text-white">{{ $s['no'] }}</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $s['title'] }}</h3>
            <p class="text-gray-600">{{ $s['desc'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="py-20 bg-primary-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Mulai Laporkan Masalah Anda Hari Ini</h2>
      <p class="text-xl text-primary-100 mb-8">Bergabunglah dengan ribuan warga yang telah mempercayai platform kami untuk menyampaikan aspirasi</p>
      <a href="{{ route('warga.laporan.create') }}"
         class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
        <i class="fas fa-plus mr-2"></i> Buat Laporan Pertama Anda
      </a>
    </div>
  </section>
@endsection

@push('scripts')
  {{-- scripts pushed by component --}}
@endpush
