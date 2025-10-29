<footer id="kontak" class="bg-gray-900 text-white py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center space-x-3 mb-6">
          <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center">
            <i class="fas fa-clipboard-list text-white"></i>
          </div>
          <div>
            <h3 class="text-xl font-bold">Laporan Masyarakat</h3>
            <p class="text-sm text-gray-400">Platform Pelaporan Online</p>
          </div>
        </div>
        <p class="text-gray-400 mb-6">
          Membangun komunikasi yang lebih baik antara masyarakat dan pemerintah melalui teknologi digital.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors"><i class="fab fa-twitter"></i></a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <div>
        <h4 class="text-lg font-semibold mb-6">Layanan</h4>
        <ul class="space-y-3">
          <li><a href="{{ route('warga.laporan.create') }}" class="text-gray-400 hover:text-white transition-colors">Buat Laporan</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Cek Status</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Riwayat Laporan</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-lg font-semibold mb-6">Informasi</h4>
        <ul class="space-y-3">
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Panduan Pengguna</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-lg font-semibold mb-6">Kontak</h4>
        <div class="space-y-4 text-gray-400">
          <div class="flex items-center space-x-3"><i class="fas fa-phone text-primary-500"></i><span>+62 21 1234 5678</span></div>
          <div class="flex items-center space-x-3"><i class="fas fa-envelope text-primary-500"></i><span>info@laporanmasyarakat.id</span></div>
          <div class="flex items-center space-x-3"><i class="fas fa-map-marker-alt text-primary-500"></i><span>Jakarta, Indonesia</span></div>
          <div class="flex items-center space-x-3"><i class="fas fa-clock text-primary-500"></i><span>24/7 Online</span></div>
        </div>
      </div>
    </div>

    <div class="border-t border-gray-800 mt-12 pt-8 text-center">
      <p class="text-gray-400">© {{ now()->year }} Laporan Masyarakat. Semua hak dilindungi undang-undang.</p>
    </div>
  </div>
</footer>
