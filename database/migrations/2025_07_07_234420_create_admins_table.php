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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('username')->unique(); // (opsional tapi disarankan untuk login cepat)
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable(); // untuk verifikasi dua faktor / OTP
            $table->string('avatar')->nullable();

            // Keamanan tambahan
            $table->boolean('is_active')->default(true); // status aktif/nonaktif admin
            $table->boolean('is_super')->default(false); // superadmin role

            // Jejak audit
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();

            // Akses login remember me
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};