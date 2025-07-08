<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'jadwal',
        'pembimbing',
        'gambar_ikon',
    ];

    /**
     * Get the URL for the extracurricular icon image.
     *
     * @return string|null
     */
    public function getGambarIkonUrlAttribute()
    {
        return $this->gambar_ikon ? Storage::url($this->gambar_ikon) : null;
    }
}