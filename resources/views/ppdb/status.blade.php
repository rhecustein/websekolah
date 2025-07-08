@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Cek Status Pendaftaran PPDB') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Cek Status Pendaftaran PPDB</h1>

    <p class="text-lg text-gray-700 mb-8 text-center">
        Masukkan nomor pendaftaran Anda untuk melihat status aplikasi PPDB Anda.
    </p>

    {{-- Notifikasi Sukses/Error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada masalah dengan inputan Anda.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.cek-status') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf

        <div class="mb-6">
            <label for="nomor_pendaftaran" class="block text-gray-700 text-sm font-bold mb-2">Nomor Pendaftaran <span class="text-red-500">*</span></label>
            <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" value="{{ old('nomor_pendaftaran') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_pendaftaran') border-red-500 @enderror" required autofocus>
            @error('nomor_pendaftaran')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-center mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                Cek Status
            </button>
        </div>
    </form>

</div>
@endsection