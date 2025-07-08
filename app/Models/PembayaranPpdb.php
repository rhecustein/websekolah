<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PembayaranPpdb extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembayaran_ppdbs'; // Pastikan nama tabel sesuai migrasi

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pendaftar_ppdb_id',
        'jenis_pembayaran',
        'jumlah_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'kode_unik_pembayaran',
        'status_pembayaran',
        'verifikator_id',
        'tanggal_verifikasi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
        'jumlah_bayar' => 'decimal:2', // Cast to decimal with 2 places
    ];

    /**
     * Get the PPDB applicant that owns the payment.
     */
    public function pendaftarPpdb(): BelongsTo
    {
        return $this->belongsTo(PendaftarPpdb::class);
    }

    /**
     * Get the user (admin) who verified the payment.
     */
    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifikator_id'); // Mengacu pada model User
    }

    /**
     * Get the URL for the payment proof.
     *
     * @return string|null
     */
    public function getBuktiPembayaranUrlAttribute()
    {
        return $this->bukti_pembayaran ? Storage::url($this->bukti_pembayaran) : null;
    }
}