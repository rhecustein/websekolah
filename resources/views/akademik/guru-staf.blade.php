@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Guru dan Staf') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Guru dan Staf Sekolah</h1>

    <p class="text-lg text-gray-600 mb-8">
        Temui para pengajar dan staf profesional kami yang berdedikasi untuk memberikan pendidikan terbaik bagi siswa.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($gurus as $guru)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
            <img src="{{ $guru->foto ?? '/images/placeholder.jpg' }}" alt="Foto {{ $guru->nama }}" class="w-full h-56 object-cover">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $guru->nama }}</h2>
                <p class="text-gray-700 text-sm mb-3">{{ $guru->jabatan }}</p>
                <p class="text-gray-600 text-base">{{ $guru->biografi }}</p>
            </div>
        </div>
        @endforeach
    </div>

    @if(count($gurus) === 0)
        <p class="text-center text-gray-500 mt-10">Data guru dan staf belum tersedia.</p>
    @endif
</div>
@endsection