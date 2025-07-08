<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sekolah; // Import model Sekolah Anda

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Pastikan tabel kosong sebelum menambahkan data,
        // atau tambahkan kondisi untuk mencegah duplikasi jika seeder dijalankan berkali-kali
        // if (Sekolah::count() === 0) { // Opsional: hanya jalankan jika tabel kosong
            Sekolah::create([
                'nama_sekolah' => 'Sekolah Islam Terpadu Al-Hikmah Jakarta',
                'jenjang' => 'SD, SMP, SMA, Pondok Pesantren', // Contoh gabungan jenjang
                'alamat' => 'Jl. Pendidikan Raya No. 10, Kel. Cilandak Barat, Kec. Cilandak',
                'kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12430',
                'telepon' => '(021) 7654321',
                'email' => 'info@alhikmah.sch.id',
                'website' => 'https://www.alhikmah.sch.id',
                'deskripsi' => 'Sekolah Islam Terpadu yang berkomitmen mencetak generasi unggul, berakhlak mulia, dan berwawasan global.',
                'visi' => 'Menjadi lembaga pendidikan Islam terdepan yang menghasilkan pemimpin masa depan berlandaskan Al-Quran dan As-Sunnah.',
                'misi' => '1. Menyelenggarakan pendidikan holistik yang mengintegrasikan nilai-nilai Islam dan kurikulum nasional. 2. Mengembangkan potensi akademik, karakter, dan keterampilan siswa. 3. Menciptakan lingkungan belajar yang kondusif dan inovatif.',
                'logo' => 'public/sekolah/logo_alhikmah.png', // Contoh path relatif ke storage
                'favicon' => 'public/sekolah/favicon_alhikmah.ico', // Contoh path relatif ke storage
                'akreditasi' => 'A (Unggul)',
                'kepala_sekolah' => 'Prof. Dr. H. Abdullah Faqih, M.Ag.',
            ]);

            Sekolah::create([
                'nama_sekolah' => 'SMK Negeri 1 Maju Bersama',
                'jenjang' => 'SMK',
                'alamat' => 'Jl. Vokasi Unggul No. 5, Kec. Industri',
                'kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'kode_pos' => '40210',
                'telepon' => '(022) 9876543',
                'email' => 'info@smkn1mb.sch.id',
                'website' => 'https://www.smkn1mb.sch.id',
                'deskripsi' => 'SMK unggulan dengan program keahlian yang relevan dengan kebutuhan industri dan dunia kerja.',
                'visi' => 'Menjadi pusat pendidikan vokasi yang menghasilkan lulusan kompeten, mandiri, dan berdaya saing global.',
                'misi' => '1. Menyelenggarakan pendidikan vokasi berbasis kompetensi. 2. Menjalin kemitraan strategis dengan industri. 3. Mengembangkan jiwa kewirausahaan siswa.',
                'logo' => 'public/sekolah/logo_smk.png',
                'favicon' => 'public/sekolah/favicon_smk.ico',
                'akreditasi' => 'A',
                'kepala_sekolah' => 'Ir. Siti Aminah, M.T.',
            ]);
        // }
    }
}