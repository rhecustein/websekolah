<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-slate-800">
                    Kelola Foto di Album: <span class="text-sky-600">{{ $album->nama }}</span>
                </h2>
            </div>
            <div class="flex flex-wrap gap-2">
                 <a href="{{ route('admin.album-galeri.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Album
                </a>
                 <a href="{{ route('admin.foto.create', ['album_id' => $album->id]) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-700">
                    <i class="mr-2 fas fa-camera"></i> Tambah Foto Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                </div>
            @endif

            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">
                    @forelse ($fotos as $foto)
                        <div class="relative overflow-hidden rounded-lg group">
                            <img src="{{ Storage::url($foto->path) }}" alt="{{ $foto->judul ?? 'Foto' }}" class="object-cover w-full h-40 transition duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 flex flex-col justify-end p-2 text-white bg-gradient-to-t from-black/70 to-transparent">
                                <h4 class="text-sm font-semibold truncate">{{ $foto->judul }}</h4>
                                <div class="flex items-center justify-end mt-2 space-x-2 transition-opacity opacity-0 group-hover:opacity-100">
                                    <a href="{{ route('admin.foto.edit', $foto->id) }}" class="p-1 text-xs text-white bg-blue-500 rounded-full hover:bg-blue-600"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('admin.foto.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-xs text-white bg-red-500 rounded-full hover:bg-red-600"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <p class="py-16 text-center text-gray-500">Belum ada foto di dalam album ini.</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $fotos->appends(['album_id' => $album->id])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
