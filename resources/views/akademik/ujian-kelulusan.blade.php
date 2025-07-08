@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Ujian Kelulusan') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $ujianInfo['judul'] }}</h1>

    <p class="text-lg text-gray-600 mb-8">
        {{ $ujianInfo['deskripsi'] }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Bagian Jadwal Ujian --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Jadwal Penting</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($ujianInfo['jadwal'] as $item => $tanggal)
                    <li><strong>{{ $item }}:</strong> {{ $tanggal }}</li>
                @endforeach
            </ul>
        </div>

        {{-- Bagian Persyaratan Ujian --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Persyaratan Ujian</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($ujianInfo['persyaratan'] as $persyaratan)
                    <li>{{ $persyaratan }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Bagian Dokumen Terkait --}}
    @if(!empty($ujianInfo['dokumen_terkait']))
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Dokumen Terkait</h2>
        <ul class="list-disc list-inside text-gray-700">
            @foreach($ujianInfo['dokumen_terkait'] as $dokumen)
                <li>
                    <a href="{{ $dokumen['link'] }}" class="text-blue-600 hover:underline">
                        {{ $dokumen['nama'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <p class="text-center text-gray-500 mt-10 text-sm">
        Untuk informasi lebih lanjut, silakan hubungi bagian akademik sekolah.
    </p>
</div>
@endsection