<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
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
        'url',
        'thumbnail',
    ];

    /**
     * Get the album that owns the video.
     */
    public function albumGaleri(): BelongsTo
    {
        return $this->belongsTo(AlbumGaleri::class);
    }
}