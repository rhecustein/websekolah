<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            UserSeeder::class, // Jika Anda punya seeder user bawaan Laravel
            SekolahSeeder::class, // Panggil SekolahSeeder di sini
            HalamanSeeder::class, // Panggil HalamanSeeder di sini
            FrontContentSeeder::class, // Panggil FrontContentSeeder di sini
        ]);
    }
}
