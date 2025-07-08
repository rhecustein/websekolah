<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Prestasi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul_prestasi',
        'bidang_prestasi',
        'tingkat_prestasi',
        'tahun_perolehan',
        'deskripsi',
        'pihak_pemberi',
        'gambar_penghargaan',
    ];

    /**
     * Get the URL for the award image.
     *
     * @return string|null
     */
    public function getGambarPenghargaanUrlAttribute()
    {
        return $this->gambar_penghargaan ? Storage::url($this->gambar_penghargaan) : null;
    }
}