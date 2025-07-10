@extends('layouts.public')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50"> {{-- Warna latar belakang terang --}}
        <div class="flex w-full max-w-6xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200"> {{-- Card utama putih dengan shadow lebih menonjol dan border tipis --}}
            {{-- Sisi Kiri: Login Form --}}
            <div class="w-full lg:w-1/2 p-8 md:p-12 flex flex-col items-center justify-center relative">
                {{-- Logo --}}
                <div class="absolute top-8 left-8">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="w-16 h-16 object-contain"> {{-- Sesuaikan ukuran dan object-fit --}}
                    </a>
                </div>

                <div class="max-w-md w-full text-center"> {{-- Rata tengah konten form --}}
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Selamat Datang Kembali 👋</h2> {{-- Judul lebih besar, bold, dan tracking lebih rapat --}}
                    <p class="text-gray-600 mb-8 leading-relaxed">Masuk untuk melanjutkan ke dashboard Anda.</p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-md">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 p-3 rounded-md border border-red-200">
                            <div class="font-medium text-red-700">{{ __('Ups! Ada yang salah.') }}</div>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6"> {{-- Tambah space-y untuk jarak antar elemen form --}}
                        @csrf

                        <div>
                            <label for="email" class="block text-left text-sm font-medium text-gray-700 mb-1">Alamat Email</label> {{-- Label lebih deskriptif --}}
                            <input id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="contoh@email.com" />
                            @error('email')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block text-left text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                            @error('password')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <input id="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 ease-in-out" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi?') }}
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            {{ __('Masuk') }}
                        </button>

                        @if (Route::has('register'))
                            <div class="text-center mt-6">
                                <span class="text-sm text-gray-600">Belum punya akun?</span>
                                <a class="font-medium text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out" href="{{ route('register') }}">
                                    {{ __('Daftar Sekarang') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Sisi Kanan: Banner Full --}}
            <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/login_banner.jpg') }}');">
                <div class="flex items-center justify-center h-full bg-indigo-700 bg-opacity-70 text-white text-center p-8"> {{-- Overlay biru gelap dengan opasitas --}}
                    <div>
                        <h2 class="text-4xl font-extrabold mb-4 leading-tight">Selamat Datang di Sistem Informasi Sekolah</h2>
                        <p class="text-lg opacity-90">Kelola data siswa, absensi, nilai, dan semua kegiatan akademik dengan mudah dan efisien.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection