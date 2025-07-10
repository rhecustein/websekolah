@extends('layouts.public') {{-- Pastikan layouts.public Anda memiliki @yield('content') --}}

@section('title', 'Lupa Kata Sandi?') {{-- Judul halaman untuk tag <title> --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8 sm:px-6 lg:px-8"> {{-- Warna latar belakang terang --}}
    <div class="max-w-md w-full bg-white shadow-xl rounded-lg p-8 md:p-10 relative border border-gray-200"> {{-- Card utama putih dengan shadow lebih menonjol dan border tipis --}}
        {{-- Logo --}}
        <div class="absolute top-8 left-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi" class="w-16 h-16 object-contain">
            </a>
        </div>

        <h2 class="text-4xl font-extrabold text-gray-900 mb-4 text-center mt-8 tracking-tight">Lupa Kata Sandi? 🔑</h2> {{-- Judul lebih besar, bold, dan tracking lebih rapat --}}
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
            Tidak masalah. Cukup beritahu kami alamat email Anda, dan kami akan mengirimkan tautan reset kata sandi melalui email yang memungkinkan Anda untuk memilih yang baru.
        </p>

        {{-- Session Status (Pesan seperti "Link reset password sudah dikirim!") --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 p-3 rounded-md border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 p-3 rounded-md border border-red-200">
                <div class="font-medium text-red-700">{{ __('Ups! Terjadi kesalahan.') }}</div>

                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6"> {{-- Tambah space-y untuk jarak antar elemen form --}}
            @csrf

            <div>
                <label for="email" class="block text-left text-sm font-medium text-gray-700 mb-1">Alamat Email</label> {{-- Label lebih deskriptif --}}
                <input id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh@email.com" />
                @error('email')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    {{ __('Kirim Tautan Reset Kata Sandi') }}
                </button>
            </div>
        </form>

        <div class="text-center mt-8">
            <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 ease-in-out" href="{{ route('login') }}">
                {{ __('Ingat Kata Sandi?') }}
            </a>
        </div>
    </div>
</div>
@endsection