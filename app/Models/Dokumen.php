<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Dokumen extends Model
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
        'path',
        'tipe_file',
        'ukuran_file',
        'user_id',
    ];

    /**
     * Get the user (uploader) that owns the document.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the URL for the document.
     *
     * @return string|null
     */
    public function getFileUrlAttribute()
    {
        return $this->path ? Storage::url($this->path) : null;
    }
}