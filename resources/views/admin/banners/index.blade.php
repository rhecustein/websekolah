<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Banner
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola banner slider yang tampil di halaman depan website Anda.
                </p>
            </div>
            {{-- Tombol dengan style baru yang lebih konsisten --}}
            <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Banner Baru
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    {{-- Layout utama tanpa padding vertikal berlebih --}}
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        
        @if (session('success'))
            {{-- Alert notifikasi yang lebih rapi --}}
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg shadow" role="alert">
                <div class="flex">
                    <div class="py-1"><i class="fas fa-check-circle mr-3"></i></div>
                    <div>
                        <p class="font-bold">Sukses!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($banners->isEmpty())
            {{-- START: Tampilan "Empty State" yang lebih menarik --}}
            <div class="text-center py-20 px-6 bg-white rounded-xl shadow-lg">
                <div class="inline-block p-5 bg-slate-100 rounded-full">
                    <i class="fas fa-images text-5xl text-slate-400"></i>
                </div>
                <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Banner</h3>
                <p class="mt-2 text-slate-500">Mulai dengan menambahkan banner pertama Anda untuk slider halaman depan.</p>
                <a href="{{ route('admin.banners.create') }}" class="mt-8 inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Banner Sekarang
                </a>
            </div>
            {{-- END: Tampilan "Empty State" --}}
        @else
            {{-- START: Grid Kartu Banner dengan Desain Baru --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($banners as $banner)
                    <div class="bg-white overflow-hidden rounded-xl shadow-lg flex flex-col transform hover:-translate-y-1.5 transition-transform duration-300">
                        
                        {{-- Bagian Gambar dan Konten --}}
                        <div class="relative">
                            {{-- Badge Status dengan desain baru yang lebih jelas --}}
                            @if ($banner->is_active)
                                <div class="absolute top-3 right-3 z-10 flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Aktif
                                </div>
                            @else
                                <div class="absolute top-3 right-3 z-10 flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    Tidak Aktif
                                </div>
                            @endif

                            {{-- Wrapper untuk gambar dengan aspect ratio 16:9 --}}
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="h-full w-full object-cover">
                            </div>

                            {{-- Gradient overlay untuk teks agar lebih terbaca --}}
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                <h3 class="text-white text-lg font-bold truncate" title="{{ $banner->title }}">{{ $banner->title }}</h3>
                                <p class="text-gray-200 text-sm truncate" title="{{ $banner->subtitle }}">{{ $banner->subtitle }}</p>
                            </div>
                        </div>
                        
                        {{-- Footer Kartu untuk Aksi --}}
                        <div class="p-4 flex justify-between items-center bg-slate-50 mt-auto">
                            <p class="text-sm text-slate-500">Urutan: <span class="font-bold text-slate-800 text-base">{{ $banner->order }}</span></p>
                            <div class="flex items-center gap-4">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="text-slate-500 hover:text-sky-600 transition-colors" title="Edit Banner">
                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                </a>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus banner ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-500 hover:text-red-600 transition-colors" title="Hapus Banner">
                                        <i class="fas fa-trash-alt fa-fw"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {{-- END: Grid Kartu Banner --}}
        @endif
    </div>
</x-app-layout>