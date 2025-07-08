<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class PendaftarPpdb extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendaftar_ppdbs'; // Pastikan nama tabel sesuai migrasi

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_pendaftaran',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nisn',
        'nik',
        'alamat',
        'telepon_siswa',
        'email_siswa',
        'asal_sekolah_sebelumnya',
        'jurusan_diminati',
        'nama_ayah',
        'pekerjaan_ayah',
        'telepon_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'telepon_ibu',
        'dokumen_kk',
        'dokumen_akta_lahir',
        'dokumen_ijazah_skl',
        'dokumen_foto_siswa',
        'status_pendaftaran',
        'catatan_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the payments for the PPDB applicant.
     */
    public function pembayaranPpdb(): HasMany
    {
        return $this->hasMany(PembayaranPpdb::class);
    }

    /**
     * Get the URL for Kartu Keluarga document.
     *
     * @return string|null
     */
    public function getDokumenKkUrlAttribute()
    {
        return $this->dokumen_kk ? Storage::url($this->dokumen_kk) : null;
    }

    /**
     * Get the URL for Akta Lahir document.
     *
     * @return string|null
     */
    public function getDokumenAktaLahirUrlAttribute()
    {
        return $this->dokumen_akta_lahir ? Storage::url($this->dokumen_akta_lahir) : null;
    }

    /**
     * Get the URL for Ijazah/SKL document.
     *
     * @return string|null
     */
    public function getDokumenIjazahSklUrlAttribute()
    {
        return $this->dokumen_ijazah_skl ? Storage::url($this->dokumen_ijazah_skl) : null;
    }

    /**
     * Get the URL for student photo document.
     *
     * @return string|null
     */
    public function getDokumenFotoSiswaUrlAttribute()
    {
        return $this->dokumen_foto_siswa ? Storage::url($this->dokumen_foto_siswa) : null;
    }
}