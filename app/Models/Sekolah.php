<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sekolah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sekolahs';

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
        'foto_sekolah', // Ditambahkan
        'akreditasi',
        'kepala_sekolah',
        // SEO Fields
        'meta_title',       // Ditambahkan
        'meta_description', // Ditambahkan
        'meta_keywords',    // Ditambahkan
        // Social Media Links
        'link_facebook',    // Ditambahkan
        'link_instagram',   // Ditambahkan
        'link_twitter',     // Ditambahkan
        'link_youtube',     // Ditambahkan
    ];

    /**
     * Get the full URL for the school's logo.
     * Menggunakan asset() untuk memastikan URL yang benar terbentuk.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            // Cek apakah path sudah merupakan URL lengkap
            if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
                return $this->logo;
            }
            return asset('storage/' . $this->logo);
        }
        return null; // atau return placeholder image
    }

    /**
     * Get the full URL for the school's favicon.
     *
     * @return string|null
     */
    public function getFaviconUrlAttribute()
    {
        if ($this->favicon) {
            if (filter_var($this->favicon, FILTER_VALIDATE_URL)) {
                return $this->favicon;
            }
            return asset('storage/' . $this->favicon);
        }
        return null;
    }

    /**
     * Get the full URL for the school's main photo.
     *
     * @return string|null
     */
    public function getFotoSekolahUrlAttribute()
    {
        if ($this->foto_sekolah) {
            if (filter_var($this->foto_sekolah, FILTER_VALIDATE_URL)) {
                return $this->foto_sekolah;
            }
            return asset('storage/' . $this->foto_sekolah);
        }
        return null;
    }
}
