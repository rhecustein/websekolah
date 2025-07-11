<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Kategori Berita
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua kategori untuk mengelompokkan konten berita Anda.
                </p>
            </div>
            <a href="{{ route('admin.kategori-berita.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Kategori Baru
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                <form action="{{ route('admin.kategori-berita.index') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari berdasarkan nama kategori..." class="block w-full py-2.5 pl-12 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                    </div>
                </form>
            </div>

            {{-- START: Tabel dengan Desain Baru --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Slug</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($kategoris as $kategori)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-slate-800">{{ $kategori->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500 font-mono">{{ $kategori->slug }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    <span class="line-clamp-1" title="{{ $kategori->deskripsi }}">
                                        {{ $kategori->deskripsi ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('admin.kategori-berita.edit', $kategori->id) }}" class="text-slate-500 hover:text-sky-600 transition-colors" title="Edit Kategori">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori-berita.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-500 hover:text-red-600 transition-colors" title="Hapus Kategori">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan "Empty State" yang Ditingkatkan --}}
                            <tr>
                                <td colspan="4">
                                    <div class="text-center py-20 px-6">
                                        <div class="inline-block p-5 bg-slate-100 rounded-full">
                                            <i class="fas fa-tag text-5xl text-slate-400"></i>
                                        </div>
                                        <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Kategori</h3>
                                        <p class="mt-2 text-slate-500">Mulai dengan menambahkan kategori pertama Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- END: Tabel --}}

            {{-- Pagination --}}
            @if ($kategoris->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $kategoris->appends(['search' => request('search')])->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>