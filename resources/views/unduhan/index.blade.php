@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Pusat Unduhan Dokumen') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Pusat Unduhan Dokumen</h1>

    <p class="text-lg text-gray-700 mb-10 text-center max-w-3xl mx-auto">
        Temukan dan unduh berbagai dokumen penting, formulir, dan materi pendukung dari sekolah kami.
    </p>

    {{-- Search and Filter Bar --}}
    <form action="{{ route('unduhan.index') }}" method="GET" class="mb-10 p-4 bg-white shadow-md rounded-lg flex flex-col md:flex-row gap-4 items-center">
        <input type="text" name="search" placeholder="Cari dokumen..." value="{{ request('search') }}"
               class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <select name="tipe_file" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Tipe File</option>
            {{-- Anda bisa mengambil tipe file unik dari database jika banyak, atau hardcode yang umum --}}
            <option value="PDF" {{ request('tipe_file') == 'PDF' ? 'selected' : '' }}>PDF</option>
            <option value="DOCX" {{ request('tipe_file') == 'DOCX' ? 'selected' : '' }}>DOCX</option>
            <option value="XLSX" {{ request('tipe_file') == 'XLSX' ? 'selected' : '' }}>XLSX</option>
            <option value="JPG" {{ request('tipe_file') == 'JPG' ? 'selected' : '' }}>JPG</option>
            <option value="PNG" {{ request('tipe_file') == 'PNG' ? 'selected' : '' }}>PNG</option>
            {{-- Tambahkan tipe file lain jika diperlukan --}}
        </select>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Cari</button>
        @if(request('search') || request('tipe_file'))
            <a href="{{ route('unduhan.index') }}" class="flex items-center justify-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition duration-300">
                Reset
            </a>
        @endif
    </form>

    @if($dokumens->count() > 0)
    <div class="space-y-6">
        @foreach($dokumens as $dokumen)
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between flex-wrap gap-4">
            <div class="flex-1 min-w-[250px]">
                <h2 class="text-xl font-bold text-gray-900 mb-1 leading-snug">{{ $dokumen->nama }}</h2> {{-- Menggunakan $dokumen->nama sesuai controller --}}
                <p class="text-gray-700 text-sm mb-2">{{ $dokumen->deskripsi }}</p>
                <div class="text-gray-500 text-xs flex items-center space-x-3">
                    @if($dokumen->tipe_file)
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ $dokumen->tipe_file }}
                    </span>
                    @endif
                    @if($dokumen->ukuran_file) {{-- Asumsi ada kolom 'ukuran_file' di model Dokumen --}}
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        {{ $dokumen->ukuran_file }}
                    </span>
                    @endif
                    @if($dokumen->created_at)
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d F Y') }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('unduhan.download', $dokumen->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination Links --}}
    <div class="mt-10">
        {{ $dokumens->links() }}
    </div>
    @else
        <p class="text-center text-gray-500 mt-10 text-xl">Belum ada dokumen yang dapat diunduh saat ini.</p>
    @endif

</div>
@endsection