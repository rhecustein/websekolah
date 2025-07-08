@extends('layouts.public') 

@section('title', 'Berita Terbaru') {{-- Page title --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Berita Terbaru</h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        {{-- Main Content Area --}}
        <div class="lg:col-span-3">
            {{-- Search and Filter Bar (Optional, can be added here) --}}
            <form action="{{ route('berita.index') }}" method="GET" class="mb-8 p-4 bg-white shadow-md rounded-lg flex flex-col md:flex-row gap-4">
                <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                       class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="kategori" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->slug }}" {{ request('kategori') == $kategori->slug ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Cari</button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('berita.index') }}" class="flex items-center justify-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
                        Reset
                    </a>
                @endif
            </form>

            {{-- News Grid --}}
            @if($beritas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritas as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-lg hover:scale-[1.01]">
                    <img src="{{ $berita->gambar_utama ?? asset('images/placeholder.jpg') }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                    <div class="p-5">
                        {{-- Kategori Berita --}}
                        @if($berita->kategoriBerita)
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200 mb-2">
                                {{ $berita->kategoriBerita->nama }}
                            </span>
                        @endif
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 leading-snug line-clamp-2">{{ $berita->judul }}</h3>
                        <p class="text-gray-600 text-xs mb-3">
                            <span class="font-medium">Oleh: {{ $berita->user->name ?? 'Admin' }}</span> |
                            {{ \Carbon\Carbon::parse($berita->published_at)->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $berita->excerpt }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="text-blue-600 hover:underline font-medium text-sm">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-10">
                {{ $beritas->links() }}
            </div>
            @else
                <p class="text-center text-gray-500 mt-10 text-xl">Belum ada berita terbaru yang ditemukan.</p>
            @endif
        </div>

        {{-- Sidebar Area --}}
        <div class="lg:col-span-1">
            {{-- Kategori Berita --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Kategori Berita</h2>
                <ul>
                    <li><a href="{{ route('berita.index') }}" class="block py-2 text-gray-700 hover:text-blue-600 {{ !request('kategori') ? 'font-semibold text-blue-600' : '' }}">Semua</a></li>
                    @foreach($kategoris as $kategori)
                        <li>
                            <a href="{{ route('berita.index', ['kategori' => $kategori->slug, 'search' => request('search')]) }}"
                               class="block py-2 text-gray-700 hover:text-blue-600 {{ request('kategori') == $kategori->slug ? 'font-semibold text-blue-600' : '' }}">
                                {{ $kategori->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Pengumuman Terbaru --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Pengumuman Terbaru</h2>
                @if($pengumumanTerbaru->count() > 0)
                    <ul>
                        @foreach($pengumumanTerbaru as $pengumuman)
                            <li class="mb-4 pb-2 border-b last:mb-0 last:pb-0 last:border-b-0">
                                <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="block text-gray-800 hover:text-blue-600 font-semibold leading-tight">
                                    {{ $pengumuman->judul }}
                                </a>
                                <p class="text-gray-600 text-sm mt-1">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($pengumuman->published_at)->translatedFormat('d M Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Tidak ada pengumuman terbaru.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection