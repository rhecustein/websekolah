@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Daftar Ulang PPDB') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Informasi Daftar Ulang PPDB</h1>

    <p class="text-xl text-gray-700 mb-10 text-center max-w-3xl mx-auto">
        Selamat! Jika Anda telah dinyatakan lulus seleksi PPDB, silakan lengkapi proses daftar ulang sesuai dengan panduan di bawah ini.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        {{-- Jadwal Daftar Ulang --}}
        <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-blue-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-7 h-7 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Jadwal Penting
            </h2>
            <ul class="list-none space-y-3 text-gray-700 text-lg">
                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l3 3a1 1 0 001.414-1.414L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    <strong>Mulai Daftar Ulang:</strong> 10 Agustus 2025</li>
                <li class="flex items-center"><svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586V7a1 1 0 10-2 0v1z" clip-rule="evenodd"></path></svg>
                    <strong>Batas Akhir Daftar Ulang:</strong> 20 Agustus 2025</li>
                <li class="flex items-center"><svg class="w-5 h-5 text-purple-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 00-.894.553L7.382 4H4a2 2 0 00-2 2v7a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm0 4a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"/></svg>
                    <strong>Orientasi Siswa Baru:</strong> 25 Agustus 2025</li>
            </ul>
            <p class="text-sm text-gray-600 mt-4">Mohon perhatikan batas waktu agar tidak kehilangan kesempatan.</p>
        </div>

        {{-- Persyaratan Daftar Ulang --}}
        <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-green-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-7 h-7 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Dokumen dan Persyaratan
            </h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700 text-lg">
                <li>Formulir Daftar Ulang (diunduh <a href="#" class="text-blue-600 hover:underline font-semibold">di sini</a>)</li>
                <li>Fotokopi Ijazah/SKL dilegalisir (2 lembar)</li>
                <li>Fotokopi Akta Kelahiran (2 lembar)</li>
                <li>Fotokopi Kartu Keluarga (2 lembar)</li>
                <li>Pas Foto 3x4 (2 lembar)</li>
                <li>Bukti Pembayaran Daftar Ulang (Asli & Fotokopi)</li>
                <li>Surat Keterangan Sehat dari Dokter</li>
            </ul>
            <p class="text-sm text-gray-600 mt-4">Pastikan semua dokumen lengkap dan sah.</p>
        </div>
    </div>

    {{-- Prosedur Daftar Ulang --}}
    <div class="bg-white rounded-lg shadow-lg p-6 mb-12 border-t-4 border-purple-500">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-7 h-7 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Prosedur Daftar Ulang
        </h2>
        <ol class="list-decimal list-inside space-y-3 text-gray-700 text-lg">
            <li>Lakukan pembayaran biaya daftar ulang melalui bank yang ditunjuk atau langsung di bagian keuangan sekolah.</li>
            <li>Unduh dan isi formulir daftar ulang yang tersedia di atas.</li>
            <li>Datang ke sekolah pada tanggal yang telah ditentukan dengan membawa semua dokumen persyaratan yang telah disebutkan.</li>
            <li>Verifikasi dokumen oleh panitia PPDB.</li>
            <li>Siswa resmi terdaftar.</li>
        </ol>
        <p class="text-sm text-gray-600 mt-4">Proses daftar ulang harus dilakukan secara langsung di sekolah.</p>
    </div>

    {{-- Contact Information / Call to Action --}}
    <div class="text-center bg-blue-50 p-6 rounded-lg border border-blue-200">
        <h2 class="text-2xl font-bold text-blue-800 mb-4">Ada Pertanyaan?</h2>
        <p class="text-lg text-blue-700 mb-6">
            Jangan ragu untuk menghubungi panitia PPDB kami jika Anda memiliki pertanyaan atau membutuhkan bantuan.
        </p>
        <a href="/kontak" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-lg">
            Hubungi Panitia PPDB
        </a>
    </div>

</div>
@endsection