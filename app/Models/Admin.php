<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting: extends Authenticatable
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Jika ingin menggunakan spatie/laravel-permission untuk model Admin

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Tambahkan HasRoles jika digunakan

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins'; // Pastikan nama tabel sesuai migrasi

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}