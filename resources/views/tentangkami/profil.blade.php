@extends('layouts.public')

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Profil Sekolah - [Nama Sekolah Anda]')
@section('description', 'Pelajari lebih lanjut tentang profil, visi, misi, dan sejarah [Nama Sekolah Anda].')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/profil.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Profil Sekolah Kami
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Mengenal Lebih Dekat [Nama Sekolah Anda]
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if(isset($sekolah))
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    {{-- Kolom Kiri (Ringkasan) --}}
                    <div class="lg:col-span-1 bg-gray-50 rounded-lg shadow-md p-8 animate-fade-in-left">
                        <h2 class="text-2xl font-bold text-blue-800 mb-6 border-b-2 border-blue-200 pb-2">Informasi Umum</h2>
                        <ul class="space-y-4 text-gray-700">
                            <li>
                                <strong class="block text-gray-900">Nama Sekolah:</strong>
                                {{ $sekolah->nama_sekolah }}
                            </li>
                            <li>
                                <strong class="block text-gray-900">Jenjang Pendidikan:</strong>
                                {{ $sekolah->jenjang }}
                            </li>
                            <li>
                                <strong class="block text-gray-900">Kepala Sekolah:</strong>
                                {{ $sekolah->kepala_sekolah ?? 'Belum Tersedia' }}
                            </li>
                            <li>
                                <strong class="block text-gray-900">Akreditasi:</strong>
                                <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded-full">{{ $sekolah->akreditasi ?? 'Belum Terakreditasi' }}</span>
                            </li>
                            <li>
                                <strong class="block text-gray-900">Alamat:</strong>
                                {{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }} {{ $sekolah->kode_pos }}
                            </li>
                            <li>
                                <strong class="block text-gray-900">Telepon:</strong>
                                <a href="tel:{{ $sekolah->telepon }}" class="text-blue-600 hover:underline">{{ $sekolah->telepon ?? 'N/A' }}</a>
                            </li>
                            <li>
                                <strong class="block text-gray-900">Email:</strong>
                                <a href="mailto:{{ $sekolah->email }}" class="text-blue-600 hover:underline">{{ $sekolah->email }}</a>
                            </li>
                            @if($sekolah->website)
                            <li>
                                <strong class="block text-gray-900">Website:</strong>
                                <a href="{{ $sekolah->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $sekolah->website }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Kolom Kanan (Visi, Misi, Deskripsi) --}}
                    <div class="lg:col-span-2 space-y-10">
                        {{-- Deskripsi Sekolah --}}
                        <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 animate-fade-in-up animation-delay-200">
                            <h2 class="text-3xl font-bold text-blue-800 mb-6 border-b-2 border-blue-500 pb-3">Deskripsi Singkat</h2>
                            @if($sekolah->deskripsi)
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($sekolah->deskripsi)) !!} {{-- Menggunakan nl2br dan e() untuk keamanan --}}
                                </div>
                            @else
                                <p class="text-gray-600 italic">Deskripsi sekolah belum tersedia.</p>
                            @endif
                        </div>

                        {{-- Visi Sekolah --}}
                        <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 animate-fade-in-up animation-delay-300">
                            <h2 class="text-3xl font-bold text-blue-800 mb-6 border-b-2 border-blue-500 pb-3">Visi Kami</h2>
                            @if($sekolah->visi)
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($sekolah->visi)) !!}
                                </div>
                            @else
                                <p class="text-gray-600 italic">Visi sekolah belum tersedia.</p>
                            @endif
                        </div>

                        {{-- Misi Sekolah --}}
                        <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200 animate-fade-in-up animation-delay-400">
                            <h2 class="text-3xl font-bold text-blue-800 mb-6 border-b-2 border-blue-500 pb-3">Misi Kami</h2>
                            @if($sekolah->misi)
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($sekolah->misi)) !!}
                                </div>
                            @else
                                <p class="text-gray-600 italic">Misi sekolah belum tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-10 bg-red-50 text-red-700 rounded-lg p-6">
                    <p class="text-xl font-semibold mb-4">Informasi profil sekolah belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, data profil sekolah belum ditemukan. Silakan hubungi administrator.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/profil-script.js') }}"></script> --}}
@endsection