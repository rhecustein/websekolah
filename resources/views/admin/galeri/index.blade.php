<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Manajemen Album Galeri') }}
            </h2>
            <a href="{{ route('admin.album-galeri.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Album
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Filter Form -->
            <div class="p-6 mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.album-galeri.index') }}" method="GET">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="md:col-span-2">
                            <input type="text" name="search" placeholder="Cari nama album..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                        </div>
                        <div>
                            <select name="tipe" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" onchange="this.form.submit()">
                                <option value="">Semua Tipe</option>
                                <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                                <option value="campuran" {{ request('tipe') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Album Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($albums as $album)
                    <div class="relative flex flex-col overflow-hidden bg-white rounded-lg shadow-sm">
                        <a href="{{ route('admin.album-galeri.show', $album->id) }}">
                            <img class="object-cover w-full h-40" src="{{ $album->thumbnail ? Storage::url($album->thumbnail) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Album' }}" alt="Thumbnail {{ $album->nama }}">
                        </a>
                        <div class="flex flex-col flex-1 p-4">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('admin.album-galeri.show', $album->id) }}" class="hover:text-sky-600">{{ $album->nama }}</a>
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 capitalize">
                                        {{ $album->tipe }}
                                    </span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ Str::limit($album->deskripsi, 50) }}</p>
                            </div>
                            <div class="flex items-center justify-end pt-4 mt-4 space-x-2 border-t">
                                <a href="{{ route('admin.album-galeri.edit', $album->id) }}" class="text-sm text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.album-galeri.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <p class="py-12 text-center text-gray-500">Tidak ada album ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $albums->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
