{{-- resources/views/livewire/laporan-create.blade.php --}}

<div class="max-w-2xl">
  {{-- Alert sukses --}}
  @if (session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
      <div class="flex items-start gap-3">
        <i class="fa-solid fa-circle-check mt-0.5"></i>
        <div>
          <p class="font-semibold">Berhasil</p>
          <p class="text-sm">{{ session('success') }}</p>
        </div>
      </div>
    </div>
  @endif

  {{-- Kartu Form --}}
  <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
    <div class="mb-5">
      <h2 class="text-xl font-bold text-gray-900">Buat Laporan</h2>
      <p class="mt-1 text-sm text-gray-600">Isi data di bawah ini dengan jelas agar mudah ditindaklanjuti.</p>
    </div>

    {{-- Judul --}}
    <div class="mb-4">
      <label for="judul" class="mb-1 block text-sm font-medium text-gray-700">Judul</label>
      <div class="relative">
        <input
          id="judul"
          type="text"
          wire:model.defer="judul"
          placeholder="Contoh: Jalan berlubang di Jl. Sudirman"
          class="w-full rounded-lg border px-3 py-2.5 pr-10 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500
                 @error('judul') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" />
        <div class="pointer-events-none absolute inset-y-0 right-0 mr-3 flex items-center text-gray-400">
          <i class="fa-regular fa-pen-to-square"></i>
        </div>
      </div>
      @error('judul')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @else
        <p class="mt-1 text-xs text-gray-500">Buat judul singkat & spesifik (maks. 150 karakter).</p>
      @enderror
    </div>

    {{-- Detail --}}
    <div class="mb-4">
      <label for="detail" class="mb-1 block text-sm font-medium text-gray-700">Detail</label>
      <div class="relative">
        <textarea
          id="detail"
          rows="5"
          wire:model.defer="detail"
          placeholder="Jelaskan kronologi, lokasi detail, waktu kejadian, dan dampaknya…"
          class="w-full rounded-lg border px-3 py-2.5 pr-10 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500
                 @error('detail') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror"></textarea>
        <div class="pointer-events-none absolute right-0 top-0 mr-3 mt-2 text-gray-400">
          <i class="fa-regular fa-file-lines"></i>
        </div>
      </div>
      @error('detail')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @else
        <p class="mt-1 text-xs text-gray-500">Gunakan bahasa yang sopan & jelas. Sertakan patokan lokasi.</p>
      @enderror
    </div>

    {{-- Foto --}}
    <div class="mb-5">
      <label class="mb-1 block text-sm font-medium text-gray-700">Foto (opsional)</label>

      {{-- Dropzone sederhana + input file --}}
      <label
        for="foto"
        class="group flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-dashed p-4 transition
               hover:border-primary-400
               @error('foto') border-red-500 bg-red-50/50 hover:border-red-500 @else border-gray-300 bg-gray-50 @enderror">
        <div class="flex items-center gap-3">
          <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-100 text-primary-600">
            <i class="fa-solid fa-cloud-arrow-up"></i>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-800">Klik untuk unggah atau seret file ke sini</p>
            <p class="text-xs text-gray-500">Format: JPG/PNG, maks 2MB</p>
          </div>
        </div>
        <span class="rounded-md bg-white px-3 py-1.5 text-sm font-semibold text-primary-600 ring-1 ring-inset ring-primary-200">
          Pilih File
        </span>
      </label>
      <input id="foto" type="file" accept="image/*" wire:model="foto" class="hidden" capture="environment" />

      @error('foto')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror

      {{-- Preview --}}
      @if ($foto)
        <div class="mt-3 flex items-center gap-3">
          <img src="{{ $foto->temporaryUrl() }}" alt="Preview"
               class="h-28 w-28 rounded-lg border border-gray-200 object-cover shadow-sm" />
          <div class="text-sm text-gray-600">
            <p class="font-medium">Preview Foto</p>
            <p class="text-xs">Pastikan objek terlihat jelas dan tidak blur.</p>
          </div>
        </div>
      @endif

      {{-- Progress saat upload foto --}}
      <div wire:loading wire:target="foto" class="mt-2">
        <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
          <div class="h-2 w-1/3 animate-pulse rounded-full bg-primary-500"></div>
        </div>
        <p class="mt-1 text-xs text-gray-500">Mengunggah foto…</p>
      </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex items-center gap-3">
      <button
        wire:click="save"
        wire:loading.attr="disabled"
        wire:target="save,foto"
        class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-5 py-2.5 font-semibold text-white shadow-sm transition
               hover:bg-primary-700 disabled:cursor-not-allowed disabled:opacity-70">
        <span wire:loading.remove wire:target="save"><i class="fa-solid fa-paper-plane"></i> Kirim Laporan</span>
        <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
          <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4A4 4 0 0 0 8 12H4z"></path>
          </svg>
          Menyimpan...
        </span>
      </button>

      {{-- Opsional: reset form cepat --}}
      <button
        type="button"
        wire:click="$reset('judul','detail','foto')"
        class="inline-flex items-center gap-2 rounded-lg px-5 py-2.5 font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
        <i class="fa-regular fa-eraser"></i> Reset
      </button>
    </div>
  </div>

  {{-- Overlay loading menyeluruh (opsional) --}}
  <div wire:loading.delay.longest wire:target="save"
       class="fixed inset-0 z-10 grid place-items-center bg-white/60 backdrop-blur-sm">
    <div class="flex items-center gap-3 rounded-xl bg-white px-5 py-3 shadow">
      <svg class="h-5 w-5 animate-spin text-primary-600" viewBox="0 0 24 24" fill="none">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4A4 4 0 0 0 8 12H4z"></path>
      </svg>
      <span class="text-sm font-medium text-gray-700">Menyimpan laporan…</span>
    </div>
  </div>
</div>
