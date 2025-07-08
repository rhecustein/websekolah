@extends('layouts.public') 

@section('title', 'Galeri: ' . $album->nama) {{-- Page title using album name --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="text-sm mb-6" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('galeri.index') }}" class="text-blue-600 hover:underline">Galeri</a>
                <svg class="fill-current w-3 h-3 mx-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.481 64.254c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.029c9.373 9.372 9.373 24.568.001 33.942z"/></svg>
            </li>
            <li>
                <span class="text-gray-500">{{ $album->nama }}</span>
            </li>
        </ol>
    </nav>

    <h1 class="text-4xl font-extrabold text-gray-900 mb-4 text-center">{{ $album->nama }}</h1>
    <p class="text-lg text-gray-600 mb-6 text-center max-w-3xl mx-auto">{{ $album->deskripsi }}</p>
    <p class="text-gray-500 text-sm mb-8 text-center">
        <i class="far fa-calendar-alt mr-1"></i> Dibuat pada: {{ \Carbon\Carbon::parse($album->created_at)->translatedFormat('d F Y') }}
    </p>

    {{-- Filter for Photos/Videos within the album --}}
    <div class="flex justify-center mb-10 space-x-4">
        @if(in_array($album->tipe, ['foto', 'campuran']))
            <button onclick="showMedia('fotos')"
                    class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300 media-filter-btn
                           {{ request('media_type') == 'fotos' || !request('media_type') && $fotos->count() > 0 ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Foto ({{ $fotos->count() }})
            </button>
        @endif
        @if(in_array($album->tipe, ['video', 'campuran']))
            <button onclick="showMedia('videos')"
                    class="px-5 py-2 rounded-lg font-semibold text-lg transition duration-300 media-filter-btn
                           {{ request('media_type') == 'videos' || (!request('media_type') && $fotos->count() === 0) ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                Video ({{ $videos->count() }})
            </button>
        @endif
    </div>

    {{-- Foto Grid --}}
    @if($fotos->count() > 0)
    <div id="fotos-container" class="media-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6
         {{ request('media_type') == 'fotos' || (!request('media_type') && $fotos->count() > 0) ? '' : 'hidden' }}">
        @foreach($fotos as $foto)
        <a href="{{ asset('storage/' . $foto->path) }}" data-lightbox="album-{{ $album->slug }}" data-title="{{ $foto->judul ?? $album->nama }}"
           class="block bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-[1.02]">
            <img src="{{ asset('storage/' . $foto->path) }}" alt="{{ $foto->judul ?? $album->nama }}" class="w-full h-64 object-cover">
            <div class="p-4">
                <p class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $foto->judul ?? 'Foto dari ' . $album->nama }}</p>
                @if($foto->deskripsi)<p class="text-sm text-gray-600 line-clamp-2">{{ $foto->deskripsi }}</p>@endif
            </div>
        </a>
        @endforeach
    </div>
    @elseif(in_array($album->tipe, ['foto', 'campuran']) && (request('media_type') == 'fotos' || !request('media_type')))
        <p class="text-center text-gray-500 mt-10 text-xl">Belum ada foto dalam album ini.</p>
    @endif

    {{-- Video Grid --}}
    @if($videos->count() > 0)
    <div id="videos-container" class="media-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8
         {{ request('media_type') == 'videos' || (!request('media_type') && $fotos->count() === 0) ? '' : 'hidden' }}">
        @foreach($videos as $video)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-[1.02]">
            <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" data-lity class="block relative group">
                <img src="{{ $video->thumbnail_path ? asset('storage/' . $video->thumbnail_path) : 'https://img.youtube.com/vi/' . $video->youtube_id . '/mqdefault.jpg' }}"
                     alt="Thumbnail Video {{ $video->judul ?? $album->nama }}" class="w-full h-56 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                </div>
            </a>
            <div class="p-4">
                <p class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $video->judul ?? 'Video dari ' . $album->nama }}</p>
                @if($video->deskripsi)<p class="text-sm text-gray-600 line-clamp-2">{{ $video->deskripsi }}</p>@endif
            </div>
        </div>
        @endforeach
    </div>
    @elseif(in_array($album->tipe, ['video', 'campuran']) && (request('media_type') == 'videos' || (!request('media_type') && $fotos->count() === 0)))
        <p class="text-center text-gray-500 mt-10 text-xl">Belum ada video dalam album ini.</p>
    @endif

    {{-- Fallback if no media in album --}}
    @if($fotos->isEmpty() && $videos->isEmpty())
        <p class="text-center text-gray-500 mt-10 text-xl">Album ini belum memiliki konten foto maupun video.</p>
    @endif

</div>

{{-- JavaScript for filtering media --}}
<script>
    function showMedia(type) {
        document.querySelectorAll('.media-container').forEach(container => {
            container.classList.add('hidden');
        });
        document.getElementById(type + '-container').classList.remove('hidden');

        // Update active button state
        document.querySelectorAll('.media-filter-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        });
        event.currentTarget.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        event.currentTarget.classList.add('bg-blue-600', 'text-white', 'shadow-md');
    }

    // Initial load: show photos by default if available, otherwise show videos
    document.addEventListener('DOMContentLoaded', function() {
        const fotosCount = {{ $fotos->count() }};
        const videosCount = {{ $videos->count() }};
        const initialType = "{{ request('media_type') }}";

        if (initialType === 'fotos' || (initialType === '' && fotosCount > 0)) {
            showMedia('fotos', false); // Pass false to avoid re-triggering event.currentTarget
        } else if (initialType === 'videos' || (initialType === '' && fotosCount === 0 && videosCount > 0)) {
            showMedia('videos', false);
        } else {
            // Hide both if no media or a mixed type without specific initial type
            document.getElementById('fotos-container')?.classList.add('hidden');
            document.getElementById('videos-container')?.classList.add('hidden');
        }

        // Apply active class to the initially selected button
        if (initialType === 'fotos') {
            document.querySelector('.media-filter-btn[onclick*="fotos"]').classList.add('bg-blue-600', 'text-white', 'shadow-md');
            document.querySelector('.media-filter-btn[onclick*="fotos"]').classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        } else if (initialType === 'videos') {
            document.querySelector('.media-filter-btn[onclick*="videos"]').classList.add('bg-blue-600', 'text-white', 'shadow-md');
            document.querySelector('.media-filter-btn[onclick*="videos"]').classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        } else if (initialType === '' && fotosCount > 0) {
             document.querySelector('.media-filter-btn[onclick*="fotos"]')?.classList.add('bg-blue-600', 'text-white', 'shadow-md');
             document.querySelector('.media-filter-btn[onclick*="fotos"]')?.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        } else if (initialType === '' && fotosCount === 0 && videosCount > 0) {
            document.querySelector('.media-filter-btn[onclick*="videos"]')?.classList.add('bg-blue-600', 'text-white', 'shadow-md');
            document.querySelector('.media-filter-btn[onclick*="videos"]')?.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
        }
    });

</script>
{{-- Lightbox library (e.g., Lightbox2 or Lity) is recommended for photo/video previews --}}
{{-- For Lightbox2: <link href="/path/to/lightbox.css" rel="stylesheet"> <script src="/path/to/lightbox.js"></script> --}}
{{-- For Lity (used in video example): <link href="/path/to/lity.min.css" rel="stylesheet"> <script src="/path/to/lity.min.js"></script> --}}

@endsection