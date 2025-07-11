<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    {{-- Font Awesome for Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sebaiknya pindahkan ini ke resources/css/app.css */
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #475569; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body 
    class="font-sans antialiased text-slate-600"
    x-data="{ 
        sidebarOpen: false, 
        sidebarCollapsed: JSON.parse(localStorage.getItem('sidebarCollapsed')) ?? false 
    }"
    x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', JSON.stringify(value)))"
>
    @php
        // Definisikan grup route untuk active state yang lebih bersih
        $tampilanRoutes = ['admin.banners.*', 'admin.cms.*'];
        $kontenRoutes = ['admin.kategori-berita.*', 'admin.berita.*', 'admin.halaman.*', 'admin.pengumuman.*'];
        $galeriRoutes = ['admin.album-galeri.*', 'admin.foto.*', 'admin.video.*'];
        $akademikRoutes = ['admin.guru.*', 'admin.staf.*', 'admin.kurikulum.*', 'admin.prestasi.*', 'admin.ekstrakurikuler.*'];
        $ppdbRoutes = ['admin.ppdb.*', 'admin.informasi-ppdb.*', 'admin.pembayaran-ppdb.*'];
        $sistemRoutes = ['admin.users.*', 'admin.sekolah.*', 'admin.pengaturan.*'];
    @endphp

    <div class="flex h-screen bg-slate-50">
        
        <div x-show="sidebarOpen" class="fixed inset-0 z-40 flex lg:hidden" x-cloak>
            <div @click="sidebarOpen = false" class="fixed inset-0 bg-black/30" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
            
            <aside class="relative flex flex-col w-64 max-w-xs bg-slate-800" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                {{-- Logo --}}
                <div class="flex items-center justify-center h-16 bg-slate-900/50 shadow-lg shrink-0">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                        <i class="fas fa-school-flag text-2xl text-white"></i>
                        <span class="ml-3 text-xl font-bold text-white">{{ config('app.name', 'Sekolah') }}</span>
                    </a>
                </div>

                {{-- Navigasi Mobile --}}
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto sidebar-scroll">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700/50 text-sky-400 font-semibold' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><i class="fas fa-tachometer-alt w-6 h-6 text-center"></i><span class="ml-2.5">Dashboard</span></a>
                    
                    <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase">Website</p>
                    <div x-data="{ open: {{ request()->routeIs($tampilanRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($tampilanRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-palette w-6 h-6 text-center"></i><span class="ml-2.5">Tampilan Depan</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.banners.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.banners.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Banner</a>
                            <a href="{{ route('admin.cms.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.cms.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Konten Sambutan</a>
                        </div>
                    </div>
                    <div x-data="{ open: {{ request()->routeIs($kontenRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($kontenRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-newspaper w-6 h-6 text-center"></i><span class="ml-2.5">Konten</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.kategori-berita.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.kategori-berita.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Kategori Berita</a>
                            <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.berita.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Berita</a>
                            <a href="{{ route('admin.halaman.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.halaman.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Halaman</a>
                            <a href="{{ route('admin.pengumuman.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.pengumuman.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pengumuman</a>
                        </div>
                    </div>
                    <div x-data="{ open: {{ request()->routeIs($galeriRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($galeriRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-images w-6 h-6 text-center"></i><span class="ml-2.5">Galeri</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.album-galeri.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.album-galeri.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Album</a>
                            <a href="{{ route('admin.foto.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.foto.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Foto</a>
                            <a href="{{ route('admin.video.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.video.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Video</a>
                        </div>
                    </div>

                    <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase">Akademik</p>
                    <div x-data="{ open: {{ request()->routeIs($akademikRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($akademikRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-graduation-cap w-6 h-6 text-center"></i><span class="ml-2.5">Akademik</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.guru.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.guru.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Guru</a>
                            <a href="{{ route('admin.staf.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.staf.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Staf</a>
                            <a href="{{ route('admin.kurikulum.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.kurikulum.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Kurikulum</a>
                            <a href="{{ route('admin.prestasi.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.prestasi.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Prestasi</a>
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Ekstrakurikuler</a>
                        </div>
                    </div>
                    <div x-data="{ open: {{ request()->routeIs($ppdbRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($ppdbRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-user-check w-6 h-6 text-center"></i><span class="ml-2.5">PPDB</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.ppdb-admin.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Pendaftar</a>
                            <a href="{{ route('admin.informasi-ppdb.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.informasi-ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Informasi PPDB</a>
                            <a href="{{ route('admin.pembayaran-ppdb.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.pembayaran-ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pembayaran</a>
                        </div>
                    </div>

                    <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase">Sistem</p>
                    <a href="{{ route('admin.dokumen.index') }}" class="flex items-center px-3 py-2.5 rounded-md {{ request()->routeIs('admin.dokumen.*') ? 'bg-slate-700/50 text-sky-400 font-semibold' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><i class="fas fa-folder-open w-6 h-6 text-center"></i><span class="ml-2.5">Dokumen</span></a>
                    <div x-data="{ open: {{ request()->routeIs($sistemRoutes) ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md group {{ request()->routeIs($sistemRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}"><span class="flex items-center"><i class="fas fa-cogs w-6 h-6 text-center"></i><span class="ml-2.5">Sistem</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform" :class="{'rotate-180': open}"></i></button>
                        <div x-show="open" x-transition class="pl-8 mt-1 space-y-1">
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Manajemen User</a>
                            <a href="{{ route('admin.sekolah.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.sekolah.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Profil Sekolah</a>
                            <a href="{{ route('admin.pengaturan.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('admin.pengaturan.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pengaturan Website</a>
                        </div>
                    </div>
                </nav>

                {{-- Logout --}}
                <div class="px-4 py-4 mt-auto border-t border-slate-700 shrink-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 rounded-md bg-red-600/80 text-white hover:bg-red-600"><i class="fas fa-sign-out-alt w-6 text-center"></i><span class="ml-2">Logout</span></button>
                    </form>
                </div>
            </aside>
        </div>

        <aside :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-64'" class="hidden lg:flex lg:flex-col bg-slate-800 text-slate-300 transition-all duration-300 ease-in-out shrink-0">
            {{-- Logo --}}
            <div class="flex items-center justify-center h-16 bg-slate-900/50 shadow-lg shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <i class="fas fa-school-flag text-2xl text-white"></i>
                    <span class="ml-3 text-xl font-bold text-white transition-opacity duration-200" :class="sidebarCollapsed ? 'opacity-0' : 'opacity-100'">
                        {{ config('app.name', 'Sekolah') }}
                    </span>
                </a>
            </div>

            {{-- Navigasi Desktop --}}
            <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto sidebar-scroll">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-md transition-all duration-200 group relative {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700/50 text-sky-400 font-semibold border-l-2 border-sky-400' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Dashboard</span>
                </a>
                
                <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase" :class="sidebarCollapsed ? 'lg:text-center' : ''"><span :class="sidebarCollapsed ? 'lg:hidden' : ''">Website</span><span :class="!sidebarCollapsed ? 'lg:hidden' : ''" class="hidden lg:inline-block">-</span></p>
                
                <div x-data="{ open: {{ request()->routeIs($tampilanRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($tampilanRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-palette w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Tampilan Depan</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.banners.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.banners.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Banner</a>
                        <a href="{{ route('admin.cms.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.cms.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Konten Sambutan</a>
                    </div>
                </div>
                
                <div x-data="{ open: {{ request()->routeIs($kontenRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($kontenRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-newspaper w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Konten</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.kategori-berita.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.kategori-berita.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Kategori Berita</a>
                        <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Berita</a>
                        <a href="{{ route('admin.halaman.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.halaman.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Halaman</a>
                        <a href="{{ route('admin.pengumuman.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.pengumuman.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pengumuman</a>
                    </div>
                </div>

                <div x-data="{ open: {{ request()->routeIs($galeriRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($galeriRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-images w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Galeri</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.album-galeri.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.album-galeri.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Album</a>
                        <a href="{{ route('admin.foto.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.foto.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Foto</a>
                        <a href="{{ route('admin.video.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.video.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Video</a>
                    </div>
                </div>

                <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase" :class="sidebarCollapsed ? 'lg:text-center' : ''"><span :class="sidebarCollapsed ? 'lg:hidden' : ''">Akademik</span><span :class="!sidebarCollapsed ? 'lg:hidden' : ''" class="hidden lg:inline-block">-</span></p>
                
                <div x-data="{ open: {{ request()->routeIs($akademikRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($akademikRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-graduation-cap w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Akademik</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.guru.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.guru.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Guru</a>
                        <a href="{{ route('admin.staf.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.staf.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Staf</a>
                        <a href="{{ route('admin.kurikulum.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.kurikulum.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Kurikulum</a>
                        <a href="{{ route('admin.prestasi.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.prestasi.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Prestasi</a>
                        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Ekstrakurikuler</a>
                    </div>
                </div>
                
                <div x-data="{ open: {{ request()->routeIs($ppdbRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($ppdbRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-user-check w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">PPDB</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.ppdb-admin.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Data Pendaftar</a>
                        <a href="{{ route('admin.informasi-ppdb.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.informasi-ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Informasi PPDB</a>
                        <a href="{{ route('admin.pembayaran-ppdb.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.pembayaran-ppdb.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pembayaran</a>
                    </div>
                </div>
                
                <p class="px-3 pt-4 pb-2 text-xs font-semibold text-slate-500 uppercase" :class="sidebarCollapsed ? 'lg:text-center' : ''"><span :class="sidebarCollapsed ? 'lg:hidden' : ''">Sistem</span><span :class="!sidebarCollapsed ? 'lg:hidden' : ''" class="hidden lg:inline-block">-</span></p>
                
                <a href="{{ route('admin.dokumen.index') }}" class="flex items-center px-3 py-2.5 rounded-md transition-all duration-200 group relative {{ request()->routeIs('admin.dokumen.*') ? 'bg-slate-700/50 text-sky-400 font-semibold border-l-2 border-sky-400' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                    <i class="fas fa-folder-open w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Dokumen</span>
                </a>
                
                <div x-data="{ open: {{ request()->routeIs($sistemRoutes) ? 'true' : 'false' }} }" @mouseenter="if (sidebarCollapsed) open = true" @mouseleave="if (sidebarCollapsed) open = false" class="relative">
                    <button @click="!sidebarCollapsed ? open = !open : ''" class="w-full flex justify-between items-center px-3 py-2.5 text-left rounded-md transition-colors duration-200 group {{ request()->routeIs($sistemRoutes) ? 'text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        <span class="flex items-center"><i class="fas fa-cogs w-6 h-6 text-center transition-all duration-200" :class="sidebarCollapsed ? 'text-xl' : ''"></i><span class="ml-2.5 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:opacity-0' : ''">Sistem</span></span><i class="fas fa-chevron-down w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open, 'lg:hidden': sidebarCollapsed }"></i>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1" :class="sidebarCollapsed ? 'lg:absolute lg:left-full lg:top-0 lg:w-56 lg:bg-slate-800 lg:rounded-md lg:shadow-lg lg:p-2 z-20' : 'pl-8'">
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Manajemen User</a>
                        <a href="{{ route('admin.sekolah.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.sekolah.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Profil Sekolah</a>
                        <a href="{{ route('admin.pengaturan.index') }}" class="block px-4 py-2 rounded-md transition-colors duration-200 {{ request()->routeIs('admin.pengaturan.*') ? 'bg-sky-600/50 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">Pengaturan Website</a>
                    </div>
                </div>
            </nav>

            {{-- Logout --}}
            <div class="px-4 py-4 mt-auto border-t border-slate-700 shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 rounded-md bg-red-600/80 text-white hover:bg-red-600 transition-colors">
                        <i class="fas fa-sign-out-alt w-6 text-center"></i><span class="ml-2 transition-opacity duration-200" :class="sidebarCollapsed ? 'lg:hidden' : ''">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden text-slate-500 hover:text-sky-500 focus:outline-none lg:block"><i class="fas fa-bars-staggered text-xl"></i></button>
                    <button @click="sidebarOpen = true" class="text-slate-500 focus:outline-none lg:hidden"><i class="fas fa-bars text-xl"></i></button>
                </div>
                <div class="flex items-center gap-4 ml-auto">
                    <div class="relative hidden md:block">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3"><i class="fas fa-search text-slate-400"></i></span>
                        <input type="text" class="w-full py-2 pl-10 pr-4 text-sm bg-slate-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white" placeholder="Search...">
                    </div>
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative text-slate-500 hover:text-sky-500 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i><span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-20" x-cloak>
                            <div class="py-2 px-4 text-sm font-semibold text-slate-700 bg-slate-50 border-b">Notifikasi</div>
                            <div class="divide-y">
                                <a href="#" class="flex items-center px-4 py-3 transition-colors hover:bg-slate-100"><i class="fas fa-user-plus text-sky-500 mr-3"></i><p class="text-sm text-slate-600">Pendaftar baru: <span class="font-bold">Ahmad Subarjo</span></p></a>
                                <a href="#" class="flex items-center px-4 py-3 transition-colors hover:bg-slate-100"><i class="fas fa-file-alt text-green-500 mr-3"></i><p class="text-sm text-slate-600">Berita baru telah dipublikasikan.</p></a>
                            </div>
                            <a href="#" class="block bg-slate-50 text-center text-sky-600 font-semibold py-2 transition-colors hover:bg-slate-100">Lihat semua notifikasi</a>
                        </div>
                    </div>
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 transition-colors bg-slate-100 rounded-md hover:text-sky-600 hover:bg-slate-200 focus:outline-none">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1"><i class="fas fa-chevron-down text-xs"></i></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">@csrf<x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link></form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-x-hidden overflow-y-auto">
                @if (isset($header))
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-slate-800">{{ $header }}</h1>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        </div>
    @stack('scripts')
</body>
</html>