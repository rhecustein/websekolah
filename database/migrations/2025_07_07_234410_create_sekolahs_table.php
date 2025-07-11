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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            
            // --- META TAGS UNTUK SEO ---
            $table->string('meta_title')->nullable(); // Judul situs untuk SEO
            $table->text('meta_description')->nullable(); // Deskripsi singkat untuk mesin pencari
            $table->string('meta_keywords')->nullable(); // Kata kunci (pisahkan dengan koma)

            $table->string('jenjang'); // SD, SMP, SMA, SMK, Pondok Pesantren
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();

            // --- FILE GAMBAR ---
            $table->string('logo')->nullable(); // Path ke file logo utama
            $table->string('favicon')->nullable(); // Path ke file favicon
            $table->string('foto_sekolah')->nullable(); // Path ke foto utama gedung sekolah

            $table->string('akreditasi')->nullable();
            $table->string('kepala_sekolah')->nullable();

            // --- LINK MEDIA SOSIAL ---
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtube')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};