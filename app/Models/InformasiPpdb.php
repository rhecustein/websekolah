<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformasiPpdb extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'informasi_ppdbs'; // Pastikan nama tabel sesuai migrasi

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'konten',
        'slug',
        'tanggal_mulai',
        'tanggal_akhir',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_akhir' => 'datetime',
    ];

    /**
     * Get the user (admin) that owns the PPDB information.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}