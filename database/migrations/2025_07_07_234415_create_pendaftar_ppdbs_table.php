<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftar_ppdbs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat');
            $table->string('telepon_siswa')->nullable();
            $table->string('email_siswa')->nullable();
            $table->string('asal_sekolah_sebelumnya')->nullable();
            $table->string('jurusan_diminati')->nullable(); // Untuk SMA/SMK/Pondok Pesantren
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('telepon_ayah')->nullable();
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('telepon_ibu')->nullable();
            $table->string('dokumen_kk')->nullable();
            $table->string('dokumen_akta_lahir')->nullable();
            $table->string('dokumen_ijazah_skl')->nullable();
            $table->string('dokumen_foto_siswa')->nullable();
            // Tambahkan kolom untuk dokumen lain jika perlu (misal: KTP ortu)
            $table->enum('status_pendaftaran', ['pending', 'diverifikasi', 'seleksi', 'lulus', 'tidak_lulus', 'daftar_ulang'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar_ppdbs');
    }
};