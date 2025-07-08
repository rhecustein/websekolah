<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Untuk mendapatkan URL file

class Sekolah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_sekolah',
        'jenjang',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'deskripsi',
        'visi',
        'misi',
        'logo',
        'favicon',
        'akreditasi',
        'kepala_sekolah',
    ];

    /**
     * Get the URL for the school's logo.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }

    /**
     * Get the URL for the school's favicon.
     *
     * @return string|null
     */
    public function getFaviconUrlAttribute()
    {
        return $this->favicon ? Storage::url($this->favicon) : null;
    }
}