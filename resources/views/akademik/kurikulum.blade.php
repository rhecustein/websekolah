@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Kurikulum Sekolah - [Nama Sekolah Anda]')
@section('description', 'Informasi lengkap mengenai kurikulum pendidikan di [Nama Sekolah Anda] untuk setiap jenjang: SD, SMP, SMA, SMK, dan Pondok Pesantren.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/kurikulum.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-teal-500 to-green-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Kurikulum Kami
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Pondasi Pendidikan yang Inovatif dan Komprehensif
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if($kurikulums->isNotEmpty())
                <div class="space-y-12">
                    @foreach($kurikulums as $kurikulum)
                        <div class="bg-gray-50 rounded-xl shadow-lg p-8 md:p-10 animate-fade-in-up animation-delay-{{ $loop->iteration * 100 }}" id="{{ Str::slug($kurikulum->jenjang) }}">
                            <h2 class="text-3xl md:text-4xl font-extrabold text-teal-800 mb-6 text-center border-b-2 border-teal-300 pb-3">
                                Kurikulum {{ $kurikulum->nama_kurikulum }} <br> (Jenjang: {{ $kurikulum->jenjang }})
                            </h2>
                            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed mx-auto mt-6">
                                @if($kurikulum->deskripsi)
                                    {!! nl2br(e($kurikulum->deskripsi)) !!}
                                @else
                                    <p class="text-gray-600 italic text-center">Deskripsi kurikulum belum tersedia.</p>
                                @endif
                            </div>

                            @if($kurikulum->file_panduan)
                                <div class="mt-8 text-center">
                                    <a href="{{ Storage::url($kurikulum->file_panduan) }}" target="_blank"
                                       class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                                        Unduh Panduan Kurikulum <i class="fas fa-download ml-2"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback jika tidak ada data kurikulum --}}
                <div class="text-center py-10 bg-blue-50 text-blue-700 rounded-lg p-6 animate-fade-in-up">
                    <p class="text-xl font-semibold mb-4">Informasi kurikulum belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, data kurikulum sedang dalam proses penyusunan. Kami akan segera memperbarui halaman ini.</p>
                    <i class="fas fa-book-reader text-blue-500 text-5xl mt-6"></i>
                </div>
            @endif
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/kurikulum-script.js') }}"></script> --}}
    <script>
        // Optional: Smooth scroll ke section kurikulum tertentu jika diakses dengan hash (misal: #sd)
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    // Adjust for fixed header height
                    const headerHeight = document.querySelector('header').offsetHeight;
                    const offsetTop = target.offsetTop - headerHeight - 20; // 20px padding
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    </script>
@endsection