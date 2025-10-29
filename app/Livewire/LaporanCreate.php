<?php
// app/Livewire/LaporanCreate.php
namespace App\Livewire;                                             // [1] Namespace Livewire
use Livewire\Component;                                             // [2] Base Component
use Livewire\WithFileUploads;                                       // [3] Trait upload file
use App\Models\Laporan;                                             // [4] Model Laporan
use Illuminate\Support\Facades\Auth;                                // [5] Ambil user id

class LaporanCreate extends Component                                // [6] Definisi komponen
{
    use WithFileUploads;                                            // [7] Aktifkan upload

    public string $judul = '';                                      // [8] Field judul
    public string $detail = '';                                     // [9] Field detail
    public $foto = null;                                            // [10] Field file (UploadedFile|null)

    protected function rules(): array                                // [11] Aturan validasi
    {
        return [
            'judul'  => ['required','string','max:150'],            // [12]
            'detail' => ['required','string'],                      // [13]
            'foto'   => ['nullable','image','max:2048'],            // [14] <= 2MB
        ];
    }

    public function save(): void                                     // [15] Aksi submit
    {
        $this->validate();                                          // [16] Jalankan validasi

        $path = null;                                               // [17] Default path
        if ($this->foto) {                                          // [18] Jika ada file
            $path = $this->foto->store('laporans', 'public');       // [19] Simpan ke disk public
        }

        Laporan::create([                                           // [20] Insert DB
            'pelapor_id' => Auth::id(),                             // [21] Kaitkan user
            'judul'      => $this->judul,                           // [22]
            'detail'     => $this->detail,                          // [23]
            'foto_path'  => $path,                                        // [24]
            'status'     => 'proses',                               // [25] default
        ]);

        $this->reset(['judul','detail','foto']);                    // [26] Reset form
        session()->flash('success','Laporan berhasil dikirim.');    // [27] Flash message
        $this->dispatch('laporan-created');                         // [28] Event untuk refresh list
    }

    public function render()                                         // [29] Render view
    {
        return view('livewire.laporan-create');                     // [30] Blade untuk form
    }
}
