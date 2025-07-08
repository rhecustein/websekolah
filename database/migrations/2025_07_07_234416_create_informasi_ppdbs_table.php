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
        Schema::create('informasi_ppdbs', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // misal: "Jadwal PPDB 2024/2025", "Persyaratan Pendaftaran"
            $table->text('konten'); // Berisi detail jadwal, persyaratan, prosedur
            $table->string('slug')->unique();
            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_akhir')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Admin yang mengelola informasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_ppdbs');
    }
};