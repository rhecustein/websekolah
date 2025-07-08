@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Hubungi Kami - [Nama Sekolah Anda]')
@section('description', 'Hubungi [Nama Sekolah Anda] untuk pertanyaan atau informasi lebih lanjut. Kirim pesan melalui formulir kontak kami atau temukan detail kontak langsung.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/kontak.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-blue-700 to-indigo-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Hubungi Kami
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Kami Siap Mendengar dan Membantu Anda!
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                {{-- Kolom Informasi Kontak --}}
                <div class="bg-gray-50 rounded-xl shadow-lg p-8 md:p-10 animate-fade-in-left">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6 border-b-2 border-blue-300 pb-3">Informasi Kontak Kami</h2>
                    @if(isset($sekolah))
                        <address class="not-italic space-y-6 text-gray-700 text-lg">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-600 text-2xl mt-1 mr-4"></i>
                                <strong>Alamat:</strong><br>
                                {{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }} {{ $sekolah->kode_pos }}
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-phone-alt text-blue-600 text-2xl mr-4"></i>
                                <strong>Telepon:</strong> <a href="tel:{{ $sekolah->telepon }}" class="text-blue-600 hover:underline">{{ $sekolah->telepon ?? 'Belum Tersedia' }}</a>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-envelope text-blue-600 text-2xl mr-4"></i>
                                <strong>Email:</strong> <a href="mailto:{{ $sekolah->email }}" class="text-blue-600 hover:underline">{{ $sekolah->email }}</a>
                            </p>
                            @if($sekolah->website)
                            <p class="flex items-center">
                                <i class="fas fa-globe text-blue-600 text-2xl mr-4"></i>
                                <strong>Website:</strong> <a href="{{ $sekolah->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $sekolah->website }}</a>
                            </p>
                            @endif
                            <p class="flex items-center">
                                <i class="fas fa-clock text-blue-600 text-2xl mr-4"></i>
                                <strong>Jam Kerja:</strong><br>
                                Senin - Jumat: 08.00 - 16.00 WIB
                            </p>
                        </address>
                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Temukan Kami di Media Sosial:</h3>
                            <div class="flex space-x-5">
                                <a href="#" class="text-gray-600 hover:text-blue-600 transform hover:scale-110 transition duration-300" aria-label="Facebook"><i class="fab fa-facebook-f text-3xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transform hover:scale-110 transition duration-300" aria-label="Instagram"><i class="fab fa-instagram text-3xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transform hover:scale-110 transition duration-300" aria-label="YouTube"><i class="fab fa-youtube text-3xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-blue-600 transform hover:scale-110 transition duration-300" aria-label="Twitter"><i class="fab fa-twitter text-3xl"></i></a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-600 text-lg">
                            <p class="mb-2">Informasi kontak utama sekolah belum tersedia.</p>
                            <i class="fas fa-info-circle text-blue-500 text-4xl"></i>
                        </div>
                    @endif
                </div>

                {{-- Kolom Formulir Kontak --}}
                <div class="bg-white rounded-xl shadow-lg p-8 md:p-10 border border-gray-200 animate-fade-in-right">
                    <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center border-b-2 border-blue-300 pb-3">Kirim Pesan Langsung</h2>

                    {{-- Success/Error Messages --}}
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                            <p class="font-bold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                            <p class="font-bold">Terjadi Kesalahan!</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                   class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('nama') border-red-500 @enderror"
                                   placeholder="Nama Lengkap Anda" required>
                            @error('nama')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="email@contoh.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subjek" class="block text-gray-700 text-sm font-bold mb-2">Subjek:</label>
                            <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}"
                                   class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('subjek') border-red-500 @enderror"
                                   placeholder="Subjek Pesan Anda" required>
                            @error('subjek')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pesan" class="block text-gray-700 text-sm font-bold mb-2">Pesan Anda:</label>
                            <textarea id="pesan" name="pesan" rows="6"
                                      class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('pesan') border-red-500 @enderror"
                                      placeholder="Tulis pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Add reCAPTCHA if you plan to implement it --}}
                        {{--
                        <div class="mb-4">
                            <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>
                            @error('g-recaptcha-response')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        --}}

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline transform hover:scale-105 transition duration-300">
                                Kirim Pesan
                                <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/kontak-script.js') }}"></script> --}}
    {{-- If using reCAPTCHA, add the script here --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
@endsection