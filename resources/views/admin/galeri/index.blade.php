<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Album Galeri
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua album foto dan video Anda di sini.
                </p>
            </div>
            <a href="{{ route('admin.album-galeri.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Album Baru
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg shadow" role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <div class="flex justify-between items-center">
                    <div>
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                    <button @click="show = false" class="text-green-900 hover:text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- Kontainer Utama dengan Desain Baru --}}
        <div class="bg-white overflow-hidden rounded-xl shadow-lg">
            
            {{-- Bagian Atas: Pencarian dan Filter --}}
            <div class="p-6 border-b border-slate-200">
                <form action="{{ route('admin.album-galeri.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-grow w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari nama album..." class="block w-full py-2.5 pl-12 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                    </div>
                    <div class="flex-shrink-0 w-full sm:w-auto">
                        <select name="tipe" class="block w-full py-2.5 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="foto" @selected(request('tipe') == 'foto')>Hanya Foto</option>
                            <option value="video" @selected(request('tipe') == 'video')>Hanya Video</option>
                        </select>
                    </div>
                </form>
            </div>
            
            @if($albums->isEmpty())
                {{-- Tampilan "Empty State" yang Ditingkatkan --}}
                <div class="text-center py-20 px-6">
                    <div class="inline-block p-5 bg-slate-100 rounded-full">
                        <i class="fas fa-images text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Album</h3>
                    <p class="mt-2 text-slate-500">Mulai dengan menambahkan album galeri pertama Anda.</p>
                </div>
            @else
                {{-- START: Grid Kartu Album --}}
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($albums as $album)
                        <div class="group bg-white overflow-hidden rounded-xl border border-slate-200 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
                            <a href="{{ route('admin.album-galeri.show', $album->id) }}" class="relative block">
                                <div class="aspect-w-4 aspect-h-3">
                                    <img class="object-cover w-full h-full" src="{{ $album->thumbnail ? Storage::url($album->thumbnail) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Album' }}" alt="Thumbnail {{ $album->nama }}">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute bottom-2 right-2 flex items-center gap-4 text-white text-xs font-semibold">
                                    @if($album->galeris_count > 0)
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-camera"></i>
                                            <span>{{ $album->galeris_count }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute top-2 left-2">
                                    @php
                                        $tipeClasses = [
                                            'foto' => 'bg-sky-100 text-sky-800',
                                            'video' => 'bg-rose-100 text-rose-800'
                                        ];
                                    @endphp
                                     <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $tipeClasses[$album->tipe] ?? 'bg-indigo-100 text-indigo-800' }}">
                                        {{ $album->tipe }}
                                    </span>
                                </div>
                            </a>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-slate-800 group-hover:text-sky-600 transition-colors">
                                    <a href="{{ route('admin.album-galeri.show', $album->id) }}">{{ $album->nama }}</a>
                                </h3>
                                <p class="mt-1 text-sm text-slate-500 line-clamp-2">{{ $album->deskripsi }}</p>
                                <div class="flex items-center justify-end pt-3 mt-auto gap-4">
                                    <a href="{{ route('admin.album-galeri.edit', $album->id) }}" class="text-slate-400 hover:text-sky-600 transition-colors" title="Edit Album">
                                        <i class="fas fa-pencil-alt fa-fw"></i>
                                    </a>
                                    <form action="{{ route('admin.album-galeri.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta seluruh isinya?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus Album">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- END: Grid Kartu Album --}}
            @endif

            {{-- Pagination --}}
            @if ($albums->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $albums->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>