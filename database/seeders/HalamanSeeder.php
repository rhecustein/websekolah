<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Halaman; // Pastikan model Halaman diimport
use App\Models\User;   // Pastikan model User diimport, karena ada foreignId user_id
use Illuminate\Support\Str; // Untuk Str::random() atau Str::slug()

class HalamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan ada setidaknya satu user untuk dijadikan penulis halaman
        // Jika Anda sudah punya UserSeeder, Anda bisa menghapus ini
        // atau pastikan user dengan ID 1 sudah ada.
        $user = User::first(); // Ambil user pertama
        if (!$user) {
            // Jika belum ada user sama sekali, buat satu user dummy
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Ganti dengan password yang lebih kuat di production
                'phone_number' => '6281234567890', // Tambahkan phone_number jika ada di User model
                'role' => 'admin', // Sesuaikan dengan role yang ada di User model
                'email_verified_at' => now(),
            ]);
        }

        // Data halaman yang akan di-seed
        $halamansData = [
            [
                'judul' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'konten' => '<p>Ini adalah halaman tentang kami. Kami adalah perusahaan yang bergerak di bidang...</p>',
                'meta_title' => 'Tentang Kami - Perusahaan Contoh',
                'meta_description' => 'Pelajari lebih lanjut tentang sejarah dan misi perusahaan kami.',
                'user_id' => $user->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'konten' => '<p>Kami sangat menghargai privasi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan...</p>',
                'meta_title' => 'Kebijakan Privasi',
                'meta_description' => 'Baca kebijakan privasi kami.',
                'user_id' => $user->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Fasilitas Sekolah',
                'slug' => 'fasilitas-sekolah', // Ini adalah slug yang dicari di controller Anda
                'konten' => '<p>Sekolah kami menyediakan berbagai fasilitas modern untuk mendukung proses belajar mengajar, antara lain:</p><ul><li>Laboratorium Komputer</li><li>Perpustakaan Lengkap</li><li>Lapangan Olahraga</li><li>Ruang Seni</li></ul>',
                'meta_title' => 'Fasilitas Sekolah Kami',
                'meta_description' => 'Lihat daftar fasilitas yang tersedia di sekolah kami.',
                'user_id' => $user->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Kontak Kami',
                'slug' => 'kontak-kami',
                'konten' => '<p>Untuk pertanyaan lebih lanjut, silakan hubungi kami di:</p><p>Email: info@contoh.com<br>Telepon: (021) 1234567</p>',
                'meta_title' => 'Kontak Kami',
                'meta_description' => 'Hubungi kami untuk informasi lebih lanjut.',
                'user_id' => $user->id,
                'status' => 'published',
            ],
            [
                'judul' => 'Halaman Draft',
                'slug' => 'halaman-draft',
                'konten' => '<p>Ini adalah halaman yang masih dalam status draft dan belum dipublikasikan.</p>',
                'meta_title' => 'Halaman Draft',
                'meta_description' => 'Deskripsi halaman draft.',
                'user_id' => $user->id,
                'status' => 'draft',
            ],
        ];

        // Masukkan data ke database
        foreach ($halamansData as $data) {
            Halaman::updateOrCreate(
                ['slug' => $data['slug']], // Kriteria untuk mencari atau membuat
                $data                      // Data untuk diisi atau diperbarui
            );
        }
    }
}