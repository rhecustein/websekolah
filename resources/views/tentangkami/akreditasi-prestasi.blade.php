@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Akreditasi & Prestasi - [Nama Sekolah Anda]')
@section('description', 'Informasi akreditasi sekolah dan daftar prestasi akademik serta non-akademik yang telah diraih oleh [Nama Sekolah Anda].')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/akreditasi-prestasi.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Akreditasi & Prestasi
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Bukti Komitmen Kami dalam Keunggulan Pendidikan
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            {{-- Bagian Akreditasi --}}
            <div class="max-w-4xl mx-auto bg-gray-50 rounded-xl shadow-lg p-8 mb-12 animate-fade-in-up">
                <h2 class="text-3xl font-bold text-purple-800 mb-6 text-center border-b-2 border-purple-300 pb-3">Status Akreditasi Sekolah</h2>
                @if(isset($sekolah) && $sekolah->akreditasi)
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-8">
                        <div class="text-center">
                            <i class="fas fa-award text-7xl text-yellow-500 mb-4 animate-bounce-in"></i>
                            <p class="text-gray-700 text-xl font-semibold">Akreditasi Terakhir:</p>
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-4xl md:text-5xl font-extrabold px-6 py-2 rounded-full shadow-md mt-2 transform rotate-2 hover:rotate-0 transition duration-300">
                                {{ $sekolah->akreditasi }}
                            </span>
                        </div>
                        <div class="text-gray-700 text-lg leading-relaxed text-center md:text-left md:max-w-md">
                            <p class="mb-3">Kami bangga mengumumkan bahwa **{{ $sekolah->nama_sekolah }}** telah memperoleh status akreditasi **{{ $sekolah->akreditasi }}** dari Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M).</p>
                            <p>Pencapaian ini adalah hasil dari komitmen kami terhadap standar pendidikan berkualitas dan upaya berkelanjutan seluruh civitas akademika.</p>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-600 text-lg py-4">
                        <p class="mb-2">Informasi akreditasi sekolah belum tersedia atau sedang dalam proses.</p>
                        <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
                    </div>
                @endif
            </div>

            {{-- Bagian Daftar Prestasi --}}
            <div class="animate-fade-in-up animation-delay-200">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-800 mb-10 text-center">Daftar Prestasi Siswa & Sekolah</h2>
                @if(isset($prestasi) && $prestasi->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($prestasi as $item)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-blue-300 card-hover-effect animate-fade-in-up animation-delay-{{ $loop->iteration * 100 }}">
                                @if($item->gambar_penghargaan)
                                    <img src="{{ Storage::url($item->gambar_penghargaan) }}" alt="Gambar Penghargaan {{ $item->judul_prestasi }}" class="w-full h-56 object-cover object-center border-b border-gray-100">
                                @else
                                    <img src="{{ asset('images/default-award.jpg') }}" alt="Penghargaan Default" class="w-full h-56 object-cover object-center border-b border-gray-100">
                                @endif
                                <div class="p-6">
                                    <span class="text-sm text-gray-500 font-medium block mb-2">
                                        <i class="fas fa-calendar-alt mr-2"></i> {{ $item->tahun_perolehan ?? 'Tahun Tidak Diketahui' }} |
                                        <i class="fas fa-medal mr-2"></i> {{ $item->tingkat_prestasi }}
                                    </span>
                                    <h3 class="text-2xl font-bold text-gray-800 mt-2 mb-3 leading-snug line-clamp-2">{{ $item->judul_prestasi }}</h3>
                                    @if($item->bidang_prestasi)
                                        <p class="text-blue-600 font-semibold text-md mb-2"><i class="fas fa-cube mr-2"></i> {{ $item->bidang_prestasi }}</p>
                                    @endif
                                    @if($item->pihak_pemberi)
                                        <p class="text-gray-600 text-sm mb-4"><i class="fas fa-handshake mr-2"></i> Pemberi: {{ $item->pihak_pemberi }}</p>
                                    @endif
                                    <p class="text-gray-700 text-base leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-blue-50 text-blue-700 rounded-lg p-6">
                        <p class="text-xl font-semibold mb-4">Belum ada data prestasi yang tersedia saat ini.</p>
                        <p class="text-lg">Kami sedang dalam proses mengunggah daftar prestasi terbaru kami. Tetap ikuti informasi kami!</p>
                        <i class="fas fa-trophy text-blue-500 text-5xl mt-6"></i>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/akreditasi-prestasi-script.js') }}"></script> --}}
@endsection