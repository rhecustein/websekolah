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
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kurikulum'); // misal: Kurikulum Merdeka, KTSP, Kurikulum Pondok
            $table->string('jenjang'); // SD, SMP, SMA, SMK, Pondok Pesantren (bisa multiple)
            $table->text('deskripsi')->nullable();
            $table->string('file_panduan')->nullable(); // Path ke dokumen kurikulum
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Admin yang mengelola
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};