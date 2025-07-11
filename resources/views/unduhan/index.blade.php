@extends('layouts.public')

@section('title', 'Pusat Unduhan Dokumen')

@section('content')
<div class="bg-slate-50">
    <div class="container px-4 py-12 mx-auto md:py-16">
        
        {{-- Hero Section --}}
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-800 sm:text-5xl">
                Pusat Unduhan
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-slate-600">
                Temukan dan unduh berbagai dokumen penting, formulir, dan materi pendukung dari sekolah kami.
            </p>
        </div>

        {{-- Search and Filter Bar --}}
        <div class="sticky top-0 z-10 py-4 mb-10 bg-slate-50/80 backdrop-blur-sm">
            <form action="{{ route('unduhan.index') }}" method="GET" class="flex flex-col gap-4 p-4 bg-white border rounded-lg shadow-sm md:flex-row md:items-center border-slate-200">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="text-slate-400 fas fa-search"></i>
                    </div>
                    <input type="text" name="search" placeholder="Cari dokumen..." value="{{ request('search') }}"
                           class="block w-full py-2 pl-10 pr-4 border-gray-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                
                <div class="relative">
                     <select name="tipe_file" class="block w-full px-4 py-2 pr-8 leading-tight bg-white border border-gray-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none focus:bg-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="">Semua Tipe File</option>
                        <option value="pdf" {{ request('tipe_file') == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="docx" {{ request('tipe_file') == 'docx' ? 'selected' : '' }}>Word (DOCX)</option>
                        <option value="xlsx" {{ request('tipe_file') == 'xlsx' ? 'selected' : '' }}>Excel (XLSX)</option>
                        <option value="pptx" {{ request('tipe_file') == 'pptx' ? 'selected' : '' }}>PowerPoint (PPTX)</option>
                        <option value="jpg" {{ request('tipe_file') == 'jpg' ? 'selected' : '' }}>Gambar (JPG)</option>
                        <option value="png" {{ request('tipe_file') == 'png' ? 'selected' : '' }}>Gambar (PNG)</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    Cari
                </button>
                @if(request('search') || request('tipe_file'))
                    <a href="{{ route('unduhan.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-gray-200 border border-transparent rounded-md hover:bg-gray-300">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @if($dokumens->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($dokumens as $dokumen)
                @php
                    // Helper untuk ikon berdasarkan tipe file
                    $iconClass = 'fa-file';
                    $iconColor = 'text-slate-500';
                    switch (strtolower($dokumen->tipe_file)) {
                        case 'pdf': $iconClass = 'fa-file-pdf'; $iconColor = 'text-red-600'; break;
                        case 'doc': case 'docx': $iconClass = 'fa-file-word'; $iconColor = 'text-blue-600'; break;
                        case 'xls': case 'xlsx': $iconClass = 'fa-file-excel'; $iconColor = 'text-green-600'; break;
                        case 'ppt': case 'pptx': $iconClass = 'fa-file-powerpoint'; $iconColor = 'text-orange-500'; break;
                        case 'jpg': case 'jpeg': case 'png': case 'gif': $iconClass = 'fa-file-image'; $iconColor = 'text-purple-600'; break;
                    }

                    // Helper untuk format ukuran file
                    $bytes = $dokumen->ukuran_file;
                    if ($bytes >= 1048576) {
                        $fileSize = number_format($bytes / 1048576, 2) . ' MB';
                    } elseif ($bytes >= 1024) {
                        $fileSize = number_format($bytes / 1024, 1) . ' KB';
                    } else {
                        $fileSize = $bytes . ' bytes';
                    }
                @endphp
                <div class="flex flex-col justify-between p-6 bg-white border rounded-lg shadow-sm border-slate-200 hover:shadow-md transition-shadow duration-300">
                    <div>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <i class="text-3xl fas {{ $iconClass }} {{ $iconColor }}"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-lg font-bold leading-tight text-slate-800">{{ $dokumen->nama }}</h2>
                                <p class="mt-1 text-sm text-slate-600">{{ $dokumen->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="flex items-center mt-4 text-xs text-slate-500 space-x-4 pl-11">
                             <span class="inline-flex items-center">
                                <i class="w-4 h-4 mr-1.5 fas fa-weight-hanging"></i>
                                {{ $fileSize }}
                            </span>
                            <span class="inline-flex items-center">
                                <i class="w-4 h-4 mr-1.5 fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-6 text-right">
                        <a href="{{ route('unduhan.download', $dokumen->id) }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            <i class="w-5 h-5 mr-2 fas fa-download"></i>
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
            <div class="py-16 text-center bg-white border rounded-lg border-slate-200">
                <i class="mb-4 text-5xl text-slate-400 fas fa-box-open"></i>
                <h3 class="text-xl font-semibold text-slate-800">Dokumen Tidak Ditemukan</h3>
                <p class="mt-2 text-slate-600">
                    @if(request('search') || request('tipe_file'))
                        Tidak ada dokumen yang cocok dengan kriteria pencarian Anda.
                    @else
                        Belum ada dokumen yang dapat diunduh saat ini.
                    @endif
                </p>
            </div>
        @endif

    </div>
</div>
@endsection
