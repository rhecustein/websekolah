@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Pengumuman Hasil PPDB') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Pengumuman Hasil Seleksi PPDB</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg text-center mb-8">
        <div class="mb-6">
            <svg class="mx-auto h-20 w-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="text-2xl font-semibold text-gray-800 mb-4">
            Hasil Seleksi Penerimaan Peserta Didik Baru telah Diumumkan!
        </p>
        <p class="text-lg text-gray-700 mb-6">
            Untuk mengetahui status kelulusan Anda, silakan cek melalui sistem kami.
        </p>
        
        <p class="text-sm text-gray-600 mb-8">
            Harap siapkan **Nomor Pendaftaran** Anda untuk melakukan pengecekan.
        </p>

        <a href="{{ route('ppdb.cek-status') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            Cek Status Kelulusan Sekarang
        </a>
    </div>

    {{-- Optional: Additional instructions for accepted students --}}
    <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-5 rounded mb-8" role="alert">
        <p class="font-bold text-lg mb-2">Bagi Peserta yang Dinyatakan Lulus:</p>
        <p class="text-base">
            Informasi mengenai jadwal dan prosedur daftar ulang akan diumumkan setelah pengumuman hasil seleksi ini. Pastikan Anda terus memantau situs web kami atau hubungi bagian administrasi sekolah.
        </p>
        <div class="mt-4">
             <a href="{{ route('ppdb.daftar-ulang') }}" class="inline-block text-yellow-800 bg-yellow-300 hover:bg-yellow-400 px-4 py-2 rounded-lg text-sm font-semibold transition duration-300">
                Informasi Daftar Ulang &rarr;
            </a>
        </div>
    </div>

    <div class="text-center mt-10">
        <a href="{{ route('ppdb.index') }}" class="inline-flex items-center bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300 font-semibold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
            Kembali ke Halaman Utama PPDB
        </a>
    </div>

</div>
@endsection