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
            $table->string('key')->unique(); // Kunci unik untuk setiap konten (e.g., 'hero_title', 'hero_banner')
            $table->string('label'); // Nama yang mudah dibaca untuk ditampilkan di form (e.g., 'Judul Hero')
            $table->text('value')->nullable(); // Nilai konten (bisa teks atau path gambar)
            $table->string('type'); // Tipe input (e.g., 'text', 'textarea', 'image')
            $table->string('group')->default('general'); // Grup untuk mengorganisir konten (e.g., 'hero', 'footer')
            $table->timestamps();
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
