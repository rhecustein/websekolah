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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nidn')->unique()->nullable(); // Nomor Induk Dosen Nasional (jika relevan untuk ponpes/perguruan)
            $table->string('nuptk')->unique()->nullable(); // Nomor Unik Pendidik dan Tenaga Kependidikan (untuk guru)
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('jabatan'); // misal: Guru Kelas, Guru Mata Pelajaran, Walikelas
            $table->string('bidang_studi')->nullable(); // Untuk guru mata pelajaran
            $table->text('deskripsi_singkat')->nullable();
            $table->string('foto')->nullable(); // Path ke foto guru
            $table->string('email')->unique()->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};