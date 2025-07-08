@extends('layouts.public')

@section('title', 'Login') {{-- Tambahkan ini jika Anda punya section 'title' di layouts.app --}}

@section('content') {{-- Asumsi layouts.app memiliki @yield('content') atau <main>{{ $slot }}</main> --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="flex w-full max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            {{-- Sisi Kiri: Login Form --}}
            <div class="w-full lg:w-1/2 p-8 md:p-12 flex items-center justify-center relative">
                {{-- Logo (opsional, jika Anda ingin logo di form login) --}}
                <div class="absolute top-8 left-8">
                    <a href="/">
                        {{-- Ganti dengan logo aplikasi Anda, misal: --}}
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="w-16 h-16 fill-current text-gray-500">
                        {{-- Atau jika Anda menggunakan komponen blade khusus, pastikan itu sesuai --}}
                        {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                    </a>
                </div>

                <div class="max-w-md w-full">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">Selamat Datang Kembali</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 text-center">Masuk untuk melanjutkan ke dashboard Anda.</p>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            {{-- Gunakan label HTML biasa atau buat komponen x-input-label sendiri --}}
                            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                            {{-- Gunakan input HTML biasa atau buat komponen x-text-input sendiri --}}
                            <input id="email" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                            @error('email')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                            <input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                            @error('password')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi Anda?') }}
                                </a>
                            @endif

                            {{-- Gunakan button HTML biasa atau buat komponen x-primary-button sendiri --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                                {{ __('Masuk') }}
                            </button>
                        </div>

                        {{-- Link ke Register (opsional, jika Anda ingin menampilkan) --}}
                        @if (Route::has('register'))
                            <div class="text-center mt-6">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Belum punya akun?</span>
                                <a class="underline text-sm text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                                    {{ __('Daftar Sekarang') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Sisi Kanan: Banner Full --}}
            <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/login_banner.jpg') }}');">
                {{-- Anda bisa menambahkan overlay atau teks di atas banner jika diinginkan --}}
                <div class="flex items-center justify-center h-full bg-black bg-opacity-40 text-white text-center p-8">
                    <div>
                        <h2 class="text-4xl font-extrabold mb-4 leading-tight">Selamat Datang di Sistem Informasi Sekolah</h2>
                        <p class="text-lg">Kelola data siswa, absensi, nilai, dan semua kegiatan akademik dengan mudah dan efisien.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection