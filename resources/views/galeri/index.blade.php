@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Galeri Foto & Video') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Galeri Sekolah</h1>

    <p class="text-xl text-gray-700 mb-12 text-center max-w-3xl mx-auto">
        Jelajahi momen-momen berharga dan kegiatan seru di sekolah kami melalui koleksi foto dan video.
    </p>

    {{-- Filter Tipe Album --}}
    <div class="flex justify-center mb-10 space-x-4">
        <a href="{{ route('galeri.index') }}"
           class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300
                  {{ !request('tipe') ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Semua
        </a>
        <a href="{{ route('galeri.index', ['tipe' => 'foto']) }}"
           class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300
                  {{ request('tipe') == 'foto' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Foto
        </a>
        <a href="{{ route('galeri.index', ['tipe' => 'video']) }}"
           class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300
                  {{ request('tipe') == 'video' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Video
        </a>
        <a href="{{ route('galeri.index', ['tipe' => 'campuran']) }}"
           class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300
                  {{ request('tipe') == 'campuran' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Campuran
        </a>
    </div>

    {{-- Grid Album Galeri --}}
    @if($albums->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($albums as $album)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-[1.02]">
            <a href="{{ route('galeri.show', $album->slug) }}" class="block">
                @php
                    // Logika untuk menampilkan thumbnail berdasarkan tipe album
                    // Anda perlu menyesuaikan ini dengan bagaimana Anda menyimpan thumbnail album
                    $thumbnailUrl = asset('images/placeholder_album.jpg'); // Default placeholder
                    if ($album->thumbnail_url) { // Jika ada kolom thumbnail_url di AlbumGaleri
                        $thumbnailUrl = asset('storage/' . $album->thumbnail_url); // Atau sesuaikan path storage Anda
                    } elseif ($album->tipe == 'foto' && $album->fotos->first()) {
                        $thumbnailUrl = asset('storage/' . $album->fotos->first()->path); // Ambil foto pertama
                    } elseif ($album->tipe == 'video' && $album->videos->first()) {
                        $thumbnailUrl = asset('storage/' . $album->videos->first()->thumbnail_path); // Ambil thumbnail video pertama
                    }
                @endphp
                <img src="{{ $thumbnailUrl }}" alt="Thumbnail Album {{ $album->nama }}" class="w-full h-56 object-cover">
            </a>
            <div class="p-5">
                {{-- Tipe Album Badge --}}
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full mb-2
                    {{ $album->tipe == 'foto' ? 'text-green-600 bg-green-200' : '' }}
                    {{ $album->tipe == 'video' ? 'text-red-600 bg-red-200' : '' }}
                    {{ $album->tipe == 'campuran' ? 'text-purple-600 bg-purple-200' : '' }}">
                    {{ ucfirst($album->tipe) }}
                </span>
                <h2 class="text-xl font-semibold text-gray-900 mb-2 leading-snug line-clamp-2">
                    <a href="{{ route('galeri.show', $album->slug) }}" class="hover:text-blue-600 transition duration-300">
                        {{ $album->nama }}
                    </a>
                </h2>
                <p class="text-gray-600 text-sm mb-3">
                    <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($album->created_at)->translatedFormat('d F Y') }}
                </p>
                <p class="text-gray-700 text-sm line-clamp-3">{{ $album->deskripsi }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination Links --}}
    <div class="mt-10">
        {{ $albums->links() }}
    </div>
    @else
        <p class="text-center text-gray-500 mt-10 text-xl">Belum ada album galeri yang tersedia saat ini.</p>
    @endif
</div>
@endsection