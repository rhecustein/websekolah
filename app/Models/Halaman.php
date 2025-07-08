<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Halaman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'halamans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'meta_title',
        'meta_description',
        'user_id',
        'status',
    ];

    /**
     * Get the user (author) that owns the page.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the page's meta title.
     *
     * @param  string|null  $value
     * @return string
     */
    public function getMetaTitleAttribute(?string $value): string
    {
        return $value ?? '';
    }

    /**
     * Get the page's meta description.
     *
     * @param  string|null  $value
     * @return string
     */
    public function getMetaDescriptionAttribute(?string $value): string
    {
        return $value ?? '';
    }
}