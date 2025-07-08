<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Kurikulum extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kurikulum',
        'jenjang',
        'deskripsi',
        'file_panduan',
        'user_id',
    ];

    /**
     * Get the user (admin) that owns the curriculum.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the URL for the curriculum file.
     *
     * @return string|null
     */
    public function getFilePanduanUrlAttribute()
    {
        return $this->file_panduan ? Storage::url($this->file_panduan) : null;
    }
}