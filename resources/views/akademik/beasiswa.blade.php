@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Informasi Beasiswa - [Nama Sekolah Anda]')
@section('description', 'Dapatkan informasi lengkap mengenai berbagai program beasiswa yang ditawarkan atau tersedia bagi siswa-siswi berprestasi dan berdedikasi di [Nama Sekolah Anda].')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/beasiswa.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-blue-500 to-green-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Informasi Beasiswa
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Wujudkan Cita-cita Pendidikan Anda dengan Dukungan Beasiswa
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if(isset($halamanBeasiswa) && $halamanBeasiswa->konten)
                <div class="max-w-6xl mx-auto bg-gray-50 rounded-xl shadow-lg p-8 md:p-12 animate-fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-8 text-center border-b-2 border-blue-300 pb-4">
                        {{ $halamanBeasiswa->judul }}
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed mx-auto">
                        {{-- Menggunakan !! !! untuk merender HTML dari CKEditor.
                             Pastikan konten sudah disanitasi saat disimpan di database untuk mencegah XSS. --}}
                        {!! $halamanBeasiswa->konten !!}
                    </div>
                </div>
            @else
                {{-- Fallback jika data halaman beasiswa tidak ditemukan atau kosong --}}
                <div class="text-center py-10 bg-yellow-50 text-yellow-700 rounded-lg p-6 animate-fade-in-up">
                    <p class="text-xl font-semibold mb-4">Informasi beasiswa belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, detail informasi beasiswa sedang dalam proses penyusunan. Kami akan segera memperbarui halaman ini.</p>
                    <i class="fas fa-hand-holding-usd text-yellow-500 text-5xl mt-6"></i>
                </div>
            @endif

            {{-- Bagian Opsional: FAQ Beasiswa atau Kontak Bagian Kesiswaan --}}
            <div class="mt-16 text-center animate-fade-in-up animation-delay-200">
                <h3 class="text-3xl font-bold text-gray-800 mb-8">Punya Pertanyaan Lebih Lanjut?</h3>
                <p class="text-lg text-gray-700 mb-8">
                    Jika Anda memiliki pertanyaan spesifik mengenai syarat dan prosedur pengajuan beasiswa, jangan ragu untuk menghubungi bagian kesiswaan kami.
                </p>
                <a href="{{ route('kontak.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                    Hubungi Bagian Kesiswaan →
                </a>
            </div>
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/beasiswa-script.js') }}"></script> --}}
@endsection