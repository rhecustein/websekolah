@extends('layouts.public') {{-- Pastikan layouts.public Anda memiliki @yield('content') --}}

@section('title', 'Konfirmasi Kata Sandi') {{-- Judul halaman untuk tag <title> --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8 sm:px-6 lg:px-8"> {{-- Warna latar belakang terang --}}
    <div class="max-w-md w-full bg-white shadow-xl rounded-lg p-8 md:p-10 relative border border-gray-200"> {{-- Card utama putih dengan shadow lebih menonjol dan border tipis --}}
        {{-- Logo --}}
        <div class="absolute top-8 left-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi" class="w-16 h-16 object-contain">
            </a>
        </div>

        <h2 class="text-4xl font-extrabold text-gray-900 mb-4 text-center mt-8 tracking-tight">Konfirmasi Kata Sandi</h2> {{-- Judul lebih besar, bold, dan tracking lebih rapat --}}
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
            Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.
        </p>

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

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6"> {{-- Tambah space-y untuk jarak antar elemen form --}}
            @csrf

            <div>
                <label for="password" class="block text-left text-sm font-medium text-gray-700 mb-1">Kata Sandi</label> {{-- Label lebih deskriptif --}}
                <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                @error('password')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    {{ __('Konfirmasi') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection