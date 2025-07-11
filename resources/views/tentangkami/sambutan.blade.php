@extends('layouts.public')

{{-- Judul dan deskripsi halaman diambil dari CMS, dengan fallback default --}}
@section('title', $pageData['page_title'] ?? 'Sambutan Kepala Sekolah')
@section('description', $pageData['page_subtitle'] ?? 'Sepatah kata dari pimpinan sekolah kami.')

@section('content')
    {{-- Memastikan variabel $pageData ada sebelum digunakan --}}
    @isset($pageData)
    
    {{-- Hero Section Dinamis --}}
    <section class="relative h-80 bg-cover bg-center text-white" style="background-image: url('{{ isset($pageData['hero_image']) && $pageData['hero_image'] ? asset('storage/' . $pageData['hero_image']) : 'https://placehold.co/1920x1080/334155/e2e8f0?text=Sambutan+Sekolah' }}');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="container relative z-10 flex flex-col items-center justify-center h-full px-4 mx-auto text-center">
            <h1 class="text-4xl font-extrabold tracking-tight md:text-5xl drop-shadow-lg">
                {{ $pageData['page_title'] ?? 'Sambutan Kepala Sekolah' }}
            </h1>
            @if(isset($pageData['page_subtitle']))
            <p class="max-w-2xl mx-auto mt-4 text-lg text-slate-200 drop-shadow-md">
                {{ $pageData['page_subtitle'] }}
            </p>
            @endif
        </div>
    </section>

    {{-- Konten Utama Sambutan --}}
    <div class="bg-slate-50">
        <section class="container px-4 py-16 mx-auto md:py-20">
            <div class="grid max-w-5xl grid-cols-1 gap-10 mx-auto lg:grid-cols-12 lg:gap-16">
                
                {{-- Kolom Foto Kepala Sekolah --}}
                <div class="lg:col-span-4">
                    <div class="sticky top-24">
                        @if(isset($pageData['kepsek_photo']) && $pageData['kepsek_photo'])
                            <img src="{{ asset('storage/' . $pageData['kepsek_photo']) }}" alt="Foto Kepala Sekolah {{ $sekolah->kepala_sekolah }}" class="w-full rounded-lg shadow-xl aspect-[3/4] object-cover">
                        @else
                            {{-- Placeholder jika foto tidak ada --}}
                            <div class="flex flex-col items-center justify-center w-full bg-white border rounded-lg shadow-lg aspect-[3/4] border-slate-200">
                                <i class="text-6xl text-slate-300 fas fa-user-tie"></i>
                                <p class="mt-4 text-sm text-slate-400">Foto Kepala Sekolah</p>
                            </div>
                        @endif
                        <div class="mt-4 text-center">
                            {{-- Nama dan Jabatan diambil dari data sekolah global --}}
                            <h3 class="text-xl font-bold text-slate-800">{{ $sekolah->kepala_sekolah ?? 'Nama Kepala Sekolah' }}</h3>
                            <p class="text-sm text-sky-600">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Teks Sambutan --}}
                <div class="lg:col-span-8">
                    <div class="p-8 bg-white border rounded-lg shadow-sm border-slate-200">
                        {{-- Konten dari Rich Text Editor (WYSIWYG) --}}
                        <div class="prose prose-lg prose-slate max-w-none leading-relaxed">
                            {!! $pageData['main_content'] ?? '<p class="italic">Konten sambutan belum diisi. Silakan edit melalui panel admin.</p>' !!}
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @else
        {{-- Tampilan jika halaman 'sambutan' belum ada di CMS --}}
        <div class="container px-4 py-20 mx-auto text-center">
            <div class="max-w-md p-8 mx-auto bg-red-50 border border-red-200 rounded-lg">
                <i class="mb-4 text-5xl text-red-400 fas fa-exclamation-triangle"></i>
                <h2 class="text-2xl font-bold text-red-800">Halaman Tidak Ditemukan</h2>
                <p class="mt-2 text-red-700">Konten untuk halaman sambutan belum dikonfigurasi. Silakan hubungi administrator.</p>
            </div>
        </div>
    @endisset
@endsection
