@extends('layouts.public') {{-- Pastikan layouts.public Anda memiliki @yield('content') --}}

@section('title', 'Verifikasi Email Anda') {{-- Judul halaman untuk tag <title> --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8 sm:px-6 lg:px-8"> {{-- Warna latar belakang terang --}}
    <div class="max-w-md w-full bg-white shadow-xl rounded-lg p-8 md:p-10 relative border border-gray-200 text-center"> {{-- Card utama putih dengan shadow lebih menonjol dan border tipis, rata tengah --}}
        {{-- Logo --}}
        <div class="absolute top-8 left-8">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Aplikasi" class="w-16 h-16 object-contain">
            </a>
        </div>

        <h2 class="text-4xl font-extrabold text-gray-900 mb-4 mt-8 tracking-tight">Verifikasi Email Anda 📧</h2> {{-- Judul lebih besar, bold, dan tracking lebih rapat --}}
        <p class="text-gray-600 mb-8 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke email Anda? Jika Anda tidak menerima emailnya, kami akan dengan senang hati mengirimkan yang lain.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 p-3 rounded-md border border-green-200">
                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
            </div>
        @endif

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4"> {{-- Menggunakan flex-col untuk mobile, flex-row untuk desktop --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full sm:w-auto underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out py-2 px-6"> {{-- Menambahkan padding untuk konsistensi --}}
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection