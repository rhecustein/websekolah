<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role; // Import Role model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan pengecekan foreign key untuk mengizinkan truncate
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel yang relevan
        Role::truncate();
        User::truncate();

        // Aktifkan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // 1. Buat Roles
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);

        // 2. Buat User Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@sekolah.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'phone_number' => '081234567890',
        ]);
        
        // 3. Tugaskan Role ke User Admin
        $admin->assignRole($role_admin);

        // Buat User Biasa
        $user = User::create([
            'name' => 'User Biasa',
            'email' => 'user@sekolah.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
            'phone_number' => '089876543210',
        ]);

        // Tugaskan Role ke User Biasa
        $user->assignRole($role_user);
    }
}
