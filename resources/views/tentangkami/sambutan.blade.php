@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Sambutan Kepala Sekolah - [Nama Sekolah Anda]')
@section('description', 'Baca sambutan hangat dari Kepala Sekolah [Nama Sekolah Anda] mengenai visi dan arah pendidikan.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/sambutan.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-teal-600 to-blue-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Sambutan Kepala Sekolah
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Kata Pengantar dari Pimpinan Sekolah
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if(isset($sekolah))
                <div class="max-w-4xl mx-auto bg-gray-50 rounded-xl shadow-lg overflow-hidden md:flex animate-fade-in-up">
                    <div class="md:flex-shrink-0">
                        <img class="h-64 w-full object-cover md:w-64 border-r-2 border-blue-200" src="{{ asset('storage/sekolah/kepala-sekolah.jpg') }}" alt="Foto Kepala Sekolah">
                    </div>
                    <div class="p-8 md:flex-grow">
                        <h2 class="text-3xl font-bold text-blue-800 mb-4">{{ $sekolah->kepala_sekolah ?? 'Nama Kepala Sekolah' }}</h2>
                        <p class="text-xl text-gray-600 mb-6 italic">Kepala Sekolah {{ $sekolah->nama_sekolah }}</p>
                        
                        <div class="prose max-w-none text-gray-800 leading-relaxed text-lg">
                            <p class="mb-4">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                            
                            @if($sekolah->deskripsi) {{-- Asumsi sambutan ada di kolom deskripsi sekolah --}}
                                {!! nl2br(e($sekolah->deskripsi)) !!}
                            @else
                                <p class="text-gray-600 italic">
                                    Puji syukur kehadirat Allah SWT atas rahmat dan karunia-Nya sehingga kita dapat berkumpul dalam suasana penuh kebersamaan ini.
                                    Saya mengucapkan selamat datang di halaman sambutan Kepala Sekolah [Nama Sekolah Anda].
                                </p>
                                <p class="mb-4">
                                    [Nama Sekolah Anda] adalah tempat di mana nilai-nilai luhur, potensi akademik, dan karakter unggul anak-anak kita dibentuk. Kami percaya bahwa pendidikan adalah kunci kemajuan bangsa, dan kami bertekad memberikan yang terbaik bagi setiap peserta didik.
                                </p>
                                <p class="mb-4">
                                    Melalui kurikulum yang relevan, metode pengajaran inovatif, serta dukungan dari tenaga pendidik profesional dan fasilitas yang memadai, kami berkomitmen menciptakan lingkungan belajar yang kondusif dan inspiratif. Kami juga senantiasa mendorong siswa untuk aktif berpartisipasi dalam berbagai kegiatan ekstrakurikuler guna mengembangkan bakat dan minat mereka.
                                </p>
                                <p>
                                    Mari bersama-sama kita wujudkan cita-cita pendidikan yang gemilang, demi masa depan cerah anak-anak kita dan kemajuan bangsa Indonesia.
                                </p>
                            @endif
                            <p class="mt-8 text-right font-semibold">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-10 bg-red-50 text-red-700 rounded-lg p-6">
                    <p class="text-xl font-semibold mb-4">Informasi sambutan kepala sekolah belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, data sambutan kepala sekolah tidak ditemukan. Silakan hubungi administrator.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/sambutan-script.js') }}"></script> --}}
@endsection