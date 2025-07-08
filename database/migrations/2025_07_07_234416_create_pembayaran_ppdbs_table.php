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
        Schema::create('pembayaran_ppdbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_ppdb_id')->constrained('pendaftar_ppdbs')->onDelete('cascade');
            $table->string('jenis_pembayaran'); // misal: "Biaya Pendaftaran", "DP Daftar Ulang", "SPP Awal"
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable(); // Path ke bukti transfer/scan
            $table->string('kode_unik_pembayaran')->nullable()->unique(); // Jika menggunakan kode unik
            $table->enum('status_pembayaran', ['pending', 'terverifikasi', 'ditolak'])->default('pending');
            $table->foreignId('verifikator_id')->nullable()->constrained('users')->onDelete('set null'); // Admin yang memverifikasi
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_ppdbs');
    }
};