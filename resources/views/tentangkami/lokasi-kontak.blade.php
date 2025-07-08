@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Lokasi & Kontak - [Nama Sekolah Anda]')
@section('description', 'Temukan lokasi, alamat lengkap, nomor telepon, dan email [Nama Sekolah Anda]. Hubungi kami untuk informasi lebih lanjut.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/lokasi-kontak.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-red-600 to-orange-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Lokasi & Kontak Kami
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Hubungi Kami, Kami Siap Membantu Anda!
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            @if(isset($sekolah))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Kolom Informasi Kontak --}}
                    <div class="bg-gray-50 rounded-xl shadow-lg p-8 md:p-10 animate-fade-in-left">
                        <h2 class="text-3xl font-bold text-red-800 mb-6 border-b-2 border-red-300 pb-3">Informasi Kontak</h2>
                        <address class="not-italic space-y-6 text-gray-700 text-lg">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-600 text-2xl mt-1 mr-4"></i>
                                <strong>Alamat Kami:</strong><br>
                                {{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }} {{ $sekolah->kode_pos }}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-phone-alt text-red-600 text-2xl mr-4"></i>
                                <strong>Telepon:</strong> <a href="tel:{{ $sekolah->telepon }}" class="text-blue-600 hover:underline">{{ $sekolah->telepon ?? 'Belum Tersedia' }}</a>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-envelope text-red-600 text-2xl mr-4"></i>
                                <strong>Email:</strong> <a href="mailto:{{ $sekolah->email }}" class="text-blue-600 hover:underline">{{ $sekolah->email }}</a>
                            </p>
                            @if($sekolah->website)
                            <p class="flex items-center">
                                <i class="fas fa-globe text-red-600 text-2xl mr-4"></i>
                                <strong>Website:</strong> <a href="{{ $sekolah->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $sekolah->website }}</a>
                            </p>
                            @endif
                            <p class="flex items-center">
                                <i class="fas fa-headset text-red-600 text-2xl mr-4"></i>
                                Untuk pertanyaan lebih lanjut, silakan hubungi kami di jam kerja.<br>
                                Senin - Jumat: 08.00 - 16.00 WIB
                            </p>
                        </address>
                        <div class="mt-8 text-center md:text-left">
                            <a href="{{ route('kontak.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
                                Kirim Pesan Langsung →
                            </a>
                        </div>
                    </div>

                    {{-- Kolom Peta Lokasi --}}
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 animate-fade-in-right">
                        <h2 class="sr-only">Peta Lokasi</h2> {{-- Screen reader only title --}}
                        <div class="w-full h-[400px] md:h-[500px]"> {{-- Increased height for better map view --}}
                            {{-- Ganti dengan iframe Google Maps Anda yang sebenarnya.
                                 Anda bisa mendapatkan kode iframe dari Google Maps dengan mencari lokasi sekolah Anda,
                                 klik "Share", lalu "Embed a map". --}}
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5292270921473!2d106.82914107474272!3d-6.192770893798993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4305886d267%3A0xf6b5d9282b09a5b!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1720443000000!5m2!1sid!2sid"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            @else
                {{-- Fallback jika data sekolah tidak ditemukan --}}
                <div class="text-center py-10 bg-red-50 text-red-700 rounded-lg p-6 animate-fade-in-up">
                    <p class="text-xl font-semibold mb-4">Informasi lokasi dan kontak sekolah belum tersedia.</p>
                    <p class="text-lg">Mohon maaf, detail lokasi dan kontak sekolah tidak ditemukan. Silakan hubungi administrator.</p>
                    <i class="fas fa-map-marked-alt text-red-500 text-5xl mt-6"></i>
                </div>
            @endif
        </div>
    </section>

    {{-- Anda bisa menambahkan bagian ini untuk formulir kontak singkat jika diinginkan (opsional) --}}
    {{--
    <section class="py-16 md:py-20 bg-gray-100">
        <div class="container mx-auto px-4 max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-8 text-center animate-fade-in-up">Kirim Pesan Langsung</h2>
            <p class="text-lg text-gray-700 mb-8 text-center animate-fade-in-up animation-delay-100">
                Ada pertanyaan atau ingin memberikan masukan? Silakan isi formulir di bawah ini dan kami akan segera merespons Anda.
            </p>
            @include('kontak.form_partial') {{-- Memanggil partial form kontak jika ada --}}
        </div>
    </section>
    --}}
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/lokasi-kontak-script.js') }}"></script> --}}
@endsection