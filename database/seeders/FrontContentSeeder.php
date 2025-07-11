<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FrontContent;

class FrontContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            // =================================================================
            // KONTEN HALAMAN: BERANDA (HOME)
            // =================================================================
            [
                'page' => 'home', 'key' => 'hero_title', 'label' => 'Judul Utama Hero',
                'value' => 'Membangun Generasi Cerdas dan Berakhlak Mulia',
                'type' => 'text', 'group' => 'hero', 'notes' => 'Judul besar yang pertama kali dilihat pengunjung.'
            ],
            [
                'page' => 'home', 'key' => 'hero_subtitle', 'label' => 'Sub-judul Hero',
                'value' => 'Bergabunglah dengan komunitas pendidikan kami yang inspiratif dan raih masa depan gemilang.',
                'type' => 'textarea', 'group' => 'hero', 'notes' => 'Teks singkat di bawah judul utama.'
            ],
            [
                'page' => 'home', 'key' => 'hero_button_text', 'label' => 'Teks Tombol Hero',
                'value' => 'Daftar Sekarang', 'type' => 'text', 'group' => 'hero'
            ],
            [
                'page' => 'home', 'key' => 'hero_button_url', 'label' => 'URL Tombol Hero',
                'value' => '/ppdb', 'type' => 'url', 'group' => 'hero'
            ],
            [
                'page' => 'home', 'key' => 'hero_background_image', 'label' => 'Gambar Latar Hero',
                'value' => null, 'type' => 'image', 'group' => 'hero', 'notes' => 'Rekomendasi ukuran 1920x1080 piksel.'
            ],
            [
                'page' => 'home', 'key' => 'features_title', 'label' => 'Judul Bagian Keunggulan',
                'value' => 'Mengapa Memilih Kami?', 'type' => 'text', 'group' => 'features'
            ],
            [
                'page' => 'home', 'key' => 'features_list', 'label' => 'Daftar Keunggulan Sekolah',
                'value' => json_encode([
                    ['icon' => 'fas fa-award', 'title' => 'Kurikulum Berprestasi', 'description' => 'Kurikulum kami dirancang untuk mencetak siswa berprestasi di tingkat nasional dan internasional.'],
                    ['icon' => 'fas fa-flask', 'title' => 'Fasilitas Modern', 'description' => 'Laboratorium dan ruang kelas dilengkapi dengan teknologi terkini untuk mendukung pembelajaran.'],
                    ['icon' => 'fas fa-users', 'title' => 'Lingkungan Belajar Positif', 'description' => 'Kami menciptakan lingkungan yang aman, nyaman, dan mendukung perkembangan setiap siswa.']
                ]),
                'type' => 'repeater', 'group' => 'features', 'notes' => 'Daftar keunggulan sekolah. Format: JSON dengan key icon, title, dan description.'
            ],

            // =================================================================
            // KONTEN HALAMAN: SAMBUTAN KEPALA SEKOLAH
            // =================================================================
            [
                'page' => 'sambutan', 'key' => 'page_title', 'label' => 'Judul Halaman',
                'value' => 'Sambutan Hangat dari Kepala Sekolah', 'type' => 'text', 'group' => 'header'
            ],
            [
                'page' => 'sambutan', 'key' => 'page_subtitle', 'label' => 'Sub-judul Halaman',
                'value' => 'Sepatah Kata Pembuka dari Pimpinan Kami', 'type' => 'text', 'group' => 'header'
            ],
            [
                'page' => 'sambutan', 'key' => 'hero_image', 'label' => 'Gambar Header Halaman',
                'value' => null, 'type' => 'image', 'group' => 'header', 'notes' => 'Gambar yang muncul di bagian atas halaman.'
            ],
            [
                'page' => 'sambutan', 'key' => 'kepsek_photo', 'label' => 'Foto Kepala Sekolah',
                'value' => null, 'type' => 'image', 'group' => 'content', 'notes' => 'Gunakan foto formal dengan rasio potret.'
            ],
            [
                'page' => 'sambutan', 'key' => 'main_content', 'label' => 'Isi Sambutan',
                'value' => "<h4>Assalamualaikum Warahmatullahi Wabarakatuh,</h4><p>Dengan penuh rasa syukur, saya menyambut Anda di situs resmi sekolah kami. Sebagai pimpinan, saya merasa bangga menjadi bagian dari sebuah institusi yang berdedikasi untuk tidak hanya memberikan pendidikan akademis berkualitas, tetapi juga membentuk karakter siswa menjadi pribadi yang unggul, berintegritas, dan siap menghadapi tantangan global.</p><p>Kami percaya bahwa setiap anak adalah individu unik dengan potensi luar biasa. Oleh karena itu, kami berkomitmen menyediakan lingkungan belajar yang mendukung, inovatif, dan inklusif. Di sini, kami mendorong siswa untuk bermimpi besar, bekerja keras, dan saling menginspirasi.</p><p>Terima kasih telah mengunjungi situs kami. Mari bersama-sama kita wujudkan generasi penerus bangsa yang cemerlang.</p>",
                'type' => 'richtext', 'group' => 'content', 'notes' => 'Isi utama dari pidato atau tulisan sambutan.'
            ],

            // =================================================================
            // KONTEN HALAMAN: FASILITAS SEKOLAH
            // =================================================================
            [
                'page' => 'fasilitas', 'key' => 'page_title', 'label' => 'Judul Halaman',
                'value' => 'Fasilitas Sekolah', 'type' => 'text', 'group' => 'header'
            ],
            [
                'page' => 'fasilitas', 'key' => 'page_subtitle', 'label' => 'Sub-judul Halaman',
                'value' => 'Menunjang Proses Belajar dengan Sarana dan Prasarana Terbaik.', 'type' => 'text', 'group' => 'header'
            ],
            [
                'page' => 'fasilitas', 'key' => 'hero_image', 'label' => 'Gambar Header Halaman',
                'value' => null, 'type' => 'image', 'group' => 'header'
            ],
             [
                'page' => 'fasilitas', 'key' => 'intro_text', 'label' => 'Teks Pengantar',
                'value' => 'Kami menyediakan berbagai fasilitas modern untuk memastikan siswa dapat belajar, berkreasi, dan berkembang secara optimal dalam lingkungan yang aman dan nyaman.', 'type' => 'textarea', 'group' => 'content'
            ],
        ];

        foreach ($contents as $content) {
            FrontContent::updateOrCreate(
                ['page' => $content['page'], 'key' => $content['key']],
                $content
            );
        }
    }
}
