@extends('layouts.public') {{-- Pastikan layouts.app Anda memiliki @yield('content') --}}

@section('title', 'Lupa Kata Sandi?') {{-- Judul halaman untuk tag <title> --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-4 py-8 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 md:p-10 relative">
        {{-- Logo (Jika Anda ingin logo di halaman ini, pastikan path gambar benar) --}}
        <div class="absolute top-8 left-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi" class="w-16 h-16 fill-current text-gray-500">
            </a>
        </div>

        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 text-center mt-8">Lupa Kata Sandi?</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-8 text-center">
            Tidak masalah. Cukup beritahu kami alamat email Anda, dan kami akan mengirimkan tautan reset kata sandi melalui email yang memungkinkan Anda untuk memilih yang baru.
        </p>

        {{-- Session Status (Pesan seperti "Link reset password sudah dikirim!") --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Terjadi kesalahan.') }}</div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                    {{ __('Kirim Tautan Reset Kata Sandi') }}
                </button>
            </div>
        </form>

        <div class="text-center mt-8">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Ingat Kata Sandi?') }}
            </a>
        </div>
    </div>
</div>
@endsection