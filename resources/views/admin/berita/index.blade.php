<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Berita
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola, filter, dan urutkan semua artikel dan berita Anda.
                </p>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Berita Baru
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
            
            {{-- Bagian Atas: Filter dan Pencarian --}}
            <div class="p-6 border-b border-slate-200">
                <form action="{{ route('admin.berita.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                        {{-- Pencarian --}}
                        <div class="lg:col-span-2">
                            <label for="search" class="sr-only">Cari Berita</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-slate-400"></i>
                                </div>
                                <input type="text" name="search" id="search" placeholder="Cari judul berita..." class="block w-full py-2 pl-10 pr-3 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                            </div>
                        </div>
                        {{-- Filter Kategori --}}
                        <div>
                             <label for="kategori" class="sr-only">Kategori</label>
                            <select name="kategori" id="kategori" class="block w-full py-2 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @selected(request('kategori') == $kategori->id)>{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Filter Status --}}
                        <div>
                            <label for="status" class="sr-only">Status</label>
                            <select name="status" id="status" class="block w-full py-2 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">
                                <option value="">Semua Status</option>
                                <option value="published" @selected(request('status') == 'published')>Published</option>
                                <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                                <option value="archived" @selected(request('status') == 'archived')>Archived</option>
                            </select>
                        </div>
                        {{-- Tombol Filter --}}
                        <div>
                            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700">
                                <i class="fas fa-filter"></i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- START: Tabel dengan Desain Baru --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Penulis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($beritas as $berita)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0">
                                            @if($berita->thumbnail)
                                                <img class="w-16 h-10 rounded-md object-cover" src="{{ Storage::url($berita->thumbnail) }}" alt="">
                                            @else
                                                <div class="w-16 h-10 rounded-md bg-slate-100 flex items-center justify-center">
                                                    <i class="fas fa-image text-slate-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-800" title="{{ $berita->judul }}">{{ Str::limit($berita->judul, 40) }}</div>
                                            <div class="text-xs text-slate-500">Dilihat: {{ $berita->views ?? 0 }} kali</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $berita->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $berita->kategoriBerita->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{-- Badge Status yang Ditingkatkan --}}
                                    @php
                                        $statusClasses = [
                                            'published' => 'bg-green-100 text-green-800',
                                            'draft' => 'bg-yellow-100 text-yellow-800',
                                            'archived' => 'bg-slate-100 text-slate-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2.5 py-0.5 text-xs font-semibold leading-5 rounded-full {{ $statusClasses[$berita->status] ?? '' }}">
                                        {{ ucfirst($berita->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $berita->published_at ? $berita->published_at->format('d M Y') : 'Belum publish' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-slate-500 hover:text-sky-600 transition-colors" title="Edit Berita">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-500 hover:text-red-600 transition-colors" title="Hapus Berita">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan "Empty State" yang Ditingkatkan --}}
                            <tr>
                                <td colspan="6">
                                    <div class="text-center py-20 px-6">
                                        <div class="inline-block p-5 bg-slate-100 rounded-full">
                                            <i class="far fa-newspaper text-5xl text-slate-400"></i>
                                        </div>
                                        <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Berita</h3>
                                        <p class="mt-2 text-slate-500">Hasil filter tidak menemukan apa pun atau Anda belum membuat berita.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if ($beritas->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>