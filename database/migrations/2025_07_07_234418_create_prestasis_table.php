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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_prestasi');
            $table->string('bidang_prestasi')->nullable(); // misal: Akademik, Olahraga, Seni
            $table->string('tingkat_prestasi'); // misal: Sekolah, Kabupaten, Provinsi, Nasional, Internasional
            $table->year('tahun_perolehan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('pihak_pemberi')->nullable(); // misal: Disdik, Kemenag, Panitia Lomba
            $table->string('gambar_penghargaan')->nullable(); // Path ke foto sertifikat/piala
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};