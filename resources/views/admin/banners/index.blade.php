{{-- File: resources/views/admin/banners/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        Manajemen Banner
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Banner Anda</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola banner slider yang tampil di halaman depan website Anda.</p>
                </div>
                <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i> Tambah Banner Baru
                </a>
            </div>
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><i class="fas fa-check-circle text-2xl mr-3"></i></div>
                        <div>
                            <p class="font-bold">Sukses</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($banners->isEmpty())
                <div class="text-center py-16 bg-white rounded-lg shadow-xl">
                    <i class="fas fa-images text-5xl text-gray-300"></i>
                    <h3 class="mt-4 text-xl font-semibold text-gray-700">Belum Ada Banner</h3>
                    <p class="mt-1 text-gray-500">Mulai dengan menambahkan banner pertama Anda.</p>
                    <a href="{{ route('admin.banners.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Tambah Banner
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($banners as $banner)
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg transform hover:-translate-y-1 transition-all duration-300">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="h-48 w-full object-cover">
                                @if ($banner->is_active)
                                    <span class="absolute top-2 right-2 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="absolute top-2 right-2 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Tidak Aktif
                                    </span>
                                @endif
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="text-white text-lg font-bold truncate">{{ $banner->title }}</h3>
                                    <p class="text-gray-200 text-sm truncate">{{ $banner->subtitle }}</p>
                                </div>
                            </div>
                            <div class="p-4 flex justify-between items-center bg-gray-50">
                                <p class="text-xs text-gray-500">Urutan: <span class="font-bold text-gray-800">{{ $banner->order }}</span></p>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="text-sm text-blue-600 hover:text-blue-800 font-semibold" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus banner ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
