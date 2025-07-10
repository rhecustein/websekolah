@extends('layouts.public') {{-- Sesuaikan dengan layout utama Anda, seperti 'layouts.public' atau 'layouts.guest' --}}

@section('title', 'Daftar Akun Baru')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50"> {{-- Warna latar belakang terang --}}
        <div class="flex w-full max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200"> {{-- Card utama putih dengan shadow lebih menonjol dan border tipis --}}
            {{-- Sisi Kiri: Banner Ilustrasi (mirip login, tapi bisa disesuaikan) --}}
            <div class="hidden lg:block lg:w-1/2 bg-cover bg-center" style="background-image: url('{{ asset('images/register_banner.jpg') }}');"> {{-- Ganti dengan gambar banner register --}}
                <div class="flex items-center justify-center h-full bg-indigo-700 bg-opacity-70 text-white text-center p-8">
                    <div>
                        <h2 class="text-4xl font-extrabold mb-4 leading-tight">Mulai Perjalanan Anda Bersama Kami</h2>
                        <p class="text-lg opacity-90">Daftarkan akun Anda dan nikmati kemudahan mengelola informasi sekolah.</p>
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan: Register Form --}}
            <div class="w-full lg:w-1/2 p-8 md:p-12 flex flex-col items-center justify-center relative">
                {{-- Logo --}}
                <div class="absolute top-8 left-8">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="w-16 h-16 object-contain">
                    </a>
                </div>

                <div class="max-w-md w-full text-center">
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Daftar Akun Baru 🎉</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">Isi formulir di bawah untuk membuat akun Anda.</p>

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

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-left text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input id="name" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Anda" />
                            @error('name')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="email" class="block text-left text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="contoh@email.com" />
                            @error('email')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password" class="block text-left text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                            @error('password')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-left text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                            <input id="password_confirmation" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                            @error('password_confirmation')<p class="text-red-500 text-xs italic mt-2 text-left">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-150 ease-in-out" href="{{ route('login') }}">
                                {{ __('Sudah punya akun?') }}
                            </a>

                            <button type="submit" class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection