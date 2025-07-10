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
        FrontContent::truncate();

        $contents = [
            // Grup Hero Banner
            ['group' => 'hero', 'key' => 'hero_title', 'label' => 'Judul Utama Hero', 'type' => 'text', 'value' => 'Selamat Datang di Sekolah Impian'],
            ['group' => 'hero', 'key' => 'hero_subtitle', 'label' => 'Subjudul Hero', 'type' => 'textarea', 'value' => 'Membentuk Generasi Unggul, Berkarakter, dan Berprestasi Sejak Dini.'],
            ['group' => 'hero', 'key' => 'hero_banner', 'label' => 'Gambar Banner Hero', 'type' => 'image', 'value' => 'frontend/default-banner.jpg'],
            
            // Grup Footer
            ['group' => 'footer', 'key' => 'footer_description', 'label' => 'Deskripsi Footer', 'type' => 'textarea', 'value' => '[Nama Sekolah Anda] berkomitmen untuk menyediakan pendidikan holistik...'],
            ['group' => 'footer', 'key' => 'footer_address', 'label' => 'Alamat', 'type' => 'text', 'value' => '[Alamat Lengkap Sekolah Anda]'],
            ['group' => 'footer', 'key' => 'footer_phone', 'label' => 'Nomor Telepon', 'type' => 'text', 'value' => '[Nomor Telepon Sekolah]'],
            ['group' => 'footer', 'key' => 'footer_email', 'label' => 'Email', 'type' => 'text', 'value' => '[Email Sekolah]'],
            ['group' => 'footer', 'key' => 'footer_facebook_url', 'label' => 'URL Facebook', 'type' => 'text', 'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_instagram_url', 'label' => 'URL Instagram', 'type' => 'text', 'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_youtube_url', 'label' => 'URL YouTube', 'type' => 'text', 'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_twitter_url', 'label' => 'URL Twitter', 'type' => 'text', 'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_maps_iframe', 'label' => 'Iframe Google Maps', 'type' => 'textarea', 'value' => 'https://www.google.com/maps/embed?pb=...'],
        ];

        foreach ($contents as $content) {
            FrontContent::create($content);
        }
    }
}
