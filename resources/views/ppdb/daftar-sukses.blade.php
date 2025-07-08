@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Pendaftaran Berhasil!') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-12 max-w-2xl">
    <div class="bg-white p-8 md:p-12 rounded-lg shadow-lg text-center">
        <div class="mb-6">
            <svg class="mx-auto h-24 w-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Pendaftaran Berhasil!</h1>
        <p class="text-xl text-gray-700 mb-6">
            Selamat, pendaftaran Anda untuk Penerimaan Peserta Didik Baru telah berhasil kami terima.
        </p>

        @if(session('nomor_pendaftaran'))
        <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-800 p-4 rounded mb-6" role="alert">
            <p class="font-bold text-lg mb-2">Nomor Pendaftaran Anda:</p>
            <p class="text-2xl md:text-3xl font-mono tracking-wider text-blue-700 break-words">
                {{ session('nomor_pendaftaran') }}
            </p>
            <p class="text-sm mt-3">
                Mohon catat atau simpan nomor pendaftaran ini baik-baik. Anda akan membutuhkannya untuk mengecek status pendaftaran dan proses selanjutnya.
            </p>
        </div>
        @endif

        <p class="text-md text-gray-600 mb-8">
            Langkah selanjutnya akan diinformasikan melalui nomor kontak yang Anda daftarkan atau dapat Anda cek secara berkala melalui halaman status pendaftaran.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="{{ route('ppdb.cek-status') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Cek Status Pendaftaran
            </a>
            
            {{-- Tombol untuk melihat bukti pendaftaran (opsional, jika Anda implementasikan PDF/print) --}}
            @if(session('nomor_pendaftaran'))
            <a href="{{ route('ppdb.bukti-daftar', session('nomor_pendaftaran')) }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Lihat Bukti Pendaftaran
            </a>
            @endif

            <a href="{{ route('ppdb.index') }}" class="inline-flex items-center bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300 font-semibold">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                Kembali ke PPDB
            </a>
        </div>
    </div>
</div>
@endsection