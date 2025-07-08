<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Foto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'album_galeri_id',
        'judul',
        'deskripsi',
        'path',
    ];

    /**
     * Get the album that owns the photo.
     */
    public function albumGaleri(): BelongsTo
    {
        return $this->belongsTo(AlbumGaleri::class);
    }

    /**
     * Get the URL for the photo.
     *
     * @return string|null
     */
    public function getPhotoUrlAttribute()
    {
        return $this->path ? Storage::url($this->path) : null;
    }
}