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
        Schema::create('front_contents', function (Blueprint $table) {
            $table->id();
            // Kolom baru untuk menentukan halaman (e.g., 'home', 'sambutan', 'profil')
            $table->string('page')->default('home')->index(); 
            
            $table->string('key'); // Kunci unik untuk setiap konten per halaman
            $table->string('label'); // Nama yang mudah dibaca untuk ditampilkan di form
            $table->longText('value')->nullable(); // Nilai konten (bisa teks, path gambar, atau JSON)
            $table->string('type'); // Tipe input (e.g., 'text', 'textarea', 'image', 'url', 'repeater')
            $table->string('group')->default('general'); // Grup untuk mengorganisir konten per halaman
            $table->text('notes')->nullable(); // Keterangan atau petunjuk untuk admin
            $table->timestamps();

            // Kunci unik sekarang adalah kombinasi dari halaman dan kunci
            $table->unique(['page', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_contents');
    }
};
