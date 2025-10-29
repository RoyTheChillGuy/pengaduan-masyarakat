<?php
// app/Models/Laporan.php
namespace App\Models;                                              // [1]

use Illuminate\Database\Eloquent\Model;                            // [2]
use Illuminate\Database\Eloquent\Relations\BelongsTo;              // [3]

class Laporan extends Model                                        // [4]
{
    protected $fillable = [                                        // [5] mass-assign
        'pelapor_id','judul','detail','foto_path','status'
    ];

    public function pelapor(): BelongsTo                            // [6] relasi ke User
    {
        return $this->belongsTo(User::class, 'pelapor_id');        // [7] FK = pelapor_id
    }
}
