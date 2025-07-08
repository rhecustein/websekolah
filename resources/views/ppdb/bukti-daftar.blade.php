@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Bukti Pendaftaran PPDB') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white p-8 rounded-lg shadow-lg mb-8 print:shadow-none print:border print:border-gray-300">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">BUKTI PENDAFTARAN PPDB</h1>
            <h2 class="text-xl md:text-2xl font-semibold text-blue-600">TAHUN AJARAN {{ date('Y') }}/{{ date('Y') + 1 }}</h2>
            <p class="text-gray-600 mt-2">Sekolah Contoh Unggul</p>
            <p class="text-gray-500 text-sm">Jl. Pendidikan No. 123, Jakarta Timur, Indonesia</p>
        </div>

        <hr class="my-6 border-gray-300">

        @if($pendaftar)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-gray-800 mb-8">
                <div>
                    <p class="font-bold text-lg text-blue-700">Nomor Pendaftaran:</p>
                    <p class="text-2xl font-mono text-gray-900 tracking-wider break-all">{{ $pendaftar->nomor_pendaftaran }}</p>
                </div>
                <div>
                    <p class="font-bold text-lg text-blue-700">Tanggal Pendaftaran:</p>
                    <p class="text-xl text-gray-900">{{ \Carbon\Carbon::parse($pendaftar->created_at)->translatedFormat('d F Y H:i') }} WIB</p>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Data Calon Peserta Didik</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-gray-700 text-base">
                    <div><span class="font-semibold">Nama Lengkap:</span> {{ $pendaftar->nama_lengkap }}</div>
                    <div><span class="font-semibold">Jenis Kelamin:</span> {{ $pendaftar->jenis_kelamin }}</div>
                    <div><span class="font-semibold">Tempat, Tgl. Lahir:</span> {{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                    <div><span class="font-semibold">Agama:</span> {{ $pendaftar->agama }}</div>
                    <div class="sm:col-span-2"><span class="font-semibold">Alamat:</span> {{ $pendaftar->alamat }}</div>
                    <div><span class="font-semibold">Telepon Siswa:</span> {{ $pendaftar->telepon_siswa ?? '-' }}</div>
                    <div><span class="font-semibold">Email Siswa:</span> {{ $pendaftar->email_siswa ?? '-' }}</div>
                    <div><span class="font-semibold">Asal Sekolah:</span> {{ $pendaftar->asal_sekolah_sebelumnya }}</div>
                    <div><span class="font-semibold">Jurusan Diminati:</span> {{ $pendaftar->jurusan_diminati ?? '-' }}</div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Data Orang Tua / Wali</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-gray-700 text-base">
                    <div><span class="font-semibold">Nama Ayah:</span> {{ $pendaftar->nama_ayah }}</div>
                    <div><span class="font-semibold">Pekerjaan Ayah:</span> {{ $pendaftar->pekerjaan_ayah ?? '-' }}</div>
                    <div><span class="font-semibold">Telepon Ayah:</span> {{ $pendaftar->telepon_ayah }}</div>
                    <div><span class="font-semibold">Nama Ibu:</span> {{ $pendaftar->nama_ibu }}</div>
                    <div><span class="font-semibold">Pekerjaan Ibu:</span> {{ $pendaftar->pekerjaan_ibu ?? '-' }}</div>
                    <div><span class="font-semibold">Telepon Ibu:</span> {{ $pendaftar->telepon_ibu }}</div>
                </div>
            </div>

            <div class="text-center mt-10 p-4 bg-gray-50 rounded-lg border border-gray-200 print:hidden">
                <p class="text-lg font-semibold text-gray-800 mb-4">
                    Simpan bukti pendaftaran ini untuk proses selanjutnya.
                </p>
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm-4-8a4 4 0 110-8 4 4 0 010 8z"></path></svg>
                    Cetak Bukti Pendaftaran
                </button>
                <a href="{{ route('ppdb.cek-status') }}" class="ml-4 bg-gray-200 text-gray-700 hover:bg-gray-300 font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105 inline-flex items-center">
                    Cek Status
                </a>
            </div>

            <p class="text-center text-sm text-gray-500 mt-8 print:mt-4 print:text-xs">
                Bukti pendaftaran ini dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} WIB
            </p>

        @else
            <div class="text-center py-10">
                <p class="text-2xl text-red-600 font-semibold mb-4">Nomor Pendaftaran Tidak Ditemukan</p>
                <p class="text-lg text-gray-700">Mohon periksa kembali nomor pendaftaran yang Anda masukkan.</p>
                <a href="{{ route('ppdb.cek-status') }}" class="inline-flex items-center mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300">
                    Cek Ulang Status
                </a>
            </div>
        @endif
    </div>
</div>
@endsection