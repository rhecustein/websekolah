@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Fasilitas Sekolah - [Nama Sekolah Anda]')
@section('description', 'Jelajahi berbagai fasilitas modern dan mendukung di [Nama Sekolah Anda] untuk menunjang kegiatan belajar dan pengembangan siswa.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/fasilitas.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-green-600 to-teal-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Fasilitas Sekolah Kami
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Lingkungan Belajar yang Modern dan Mendukung
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if(isset($halamanFasilitas) && $halamanFasilitas->konten)
                <div class="max-w-6xl mx-auto bg-gray-50 rounded-xl shadow-lg p-8 md:p-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-green-800 mb-8 text-center border-b-2 border-green-300 pb-4">
                        {{ $halamanFasilitas->judul }}
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed mx-auto">
                        {{-- Menggunakan !! !! untuk merender HTML dari CKEditor.
                             Pastikan konten sudah disanitasi saat disimpan di database untuk mencegah XSS. --}}
                        {!! $halamanFasilitas->konten !!}
                    </div>
                </div>
            @else
                {{-- Fallback jika data fasilitas tidak ditemukan atau kosong --}}
                <div class="text-center py-10 bg-blue-50 text-blue-700 rounded-lg p-6 animate-fade-in-up">
                    <p class="text-xl font-semibold mb-4">Informasi fasilitas sekolah belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, detail fasilitas sekolah sedang dalam proses penyusunan. Kami akan segera memperbarui halaman ini.</p>
                    <i class="fas fa-building text-blue-500 text-5xl mt-6"></i>
                </div>
            @endif

            {{-- Anda bisa menambahkan bagian ini untuk Galeri Fasilitas (opsional) --}}
            {{--
            <div class="mt-16 text-center animate-fade-in-up animation-delay-200">
                <h3 class="text-3xl font-bold text-gray-800 mb-8">Lihat Galeri Fasilitas Kami</h3>
                <p class="text-lg text-gray-600 mb-8">Dapatkan gambaran lebih jelas mengenai lingkungan dan fasilitas belajar di sekolah kami.</p>
                <a href="{{ route('galeri.index', ['filter_by' => 'fasilitas']) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                    Kunjungi Galeri Fasilitas →
                </a>
            </div>
            --}}
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/fasilitas-script.js') }}"></script> --}}
@endsection