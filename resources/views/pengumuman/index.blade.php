@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Daftar Pengumuman') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Daftar Pengumuman</h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        {{-- Area Konten Utama --}}
        <div class="lg:col-span-3">
            {{-- Bar Pencarian Pengumuman --}}
            <form action="{{ route('pengumuman.index') }}" method="GET" class="mb-8 p-4 bg-white shadow-md rounded-lg flex flex-col md:flex-row gap-4">
                <input type="text" name="search" placeholder="Cari pengumuman..." value="{{ request('search') }}"
                       class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Cari</button>
                @if(request('search'))
                    <a href="{{ route('pengumuman.index') }}" class="flex items-center justify-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Daftar Pengumuman --}}
            @if($pengumumans->count() > 0)
            <div class="space-y-6">
                @foreach($pengumumans as $pengumuman)
                <div class="bg-white rounded-lg shadow-md p-6 transform transition duration-300 hover:shadow-lg hover:translate-y-[-2px]">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 leading-snug">
                        <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="hover:text-blue-600 transition duration-300">{{ $pengumuman->judul }}</a>
                    </h2>
                    <p class="text-gray-600 text-sm mb-3">
                        <span class="font-medium">Oleh: {{ $pengumuman->user->name ?? 'Admin' }}</span> |
                        <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($pengumuman->published_at)->translatedFormat('d F Y') }}
                    </p>
                    <p class="text-gray-700 text-base mb-4 line-clamp-3">{{ $pengumuman->konten }}</p>
                    <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="text-blue-600 hover:underline font-medium text-sm">Baca Selengkapnya &rarr;</a>
                </div>
                @endforeach
            </div>

            {{-- Link Pagination --}}
            <div class="mt-10">
                {{ $pengumumans->links() }}
            </div>
            @else
                <p class="text-center text-gray-500 mt-10 text-xl">Belum ada pengumuman yang ditemukan.</p>
            @endif
        </div>

        {{-- Area Sidebar --}}
        <div class="lg:col-span-1">
            {{-- Kategori Berita (konsisten dengan controller Anda) --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Kategori Berita</h2>
                <ul>
                    <li><a href="{{ route('berita.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Semua Berita</a></li>
                    @foreach($kategoris as $kategori)
                        <li>
                            <a href="{{ route('berita.index', ['kategori' => $kategori->slug]) }}"
                               class="block py-2 text-gray-700 hover:text-blue-600">
                                {{ $kategori->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Berita Terbaru --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Berita Terbaru</h2>
                @if($beritaTerbaru->count() > 0)
                    <ul>
                        @foreach($beritaTerbaru as $berita)
                            <li class="mb-4 pb-2 border-b last:mb-0 last:pb-0 last:border-b-0">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="block text-gray-800 hover:text-blue-600 font-semibold leading-tight">
                                    {{ $berita->judul }}
                                </a>
                                <p class="text-gray-600 text-sm mt-1">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d M Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Tidak ada berita terbaru.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection