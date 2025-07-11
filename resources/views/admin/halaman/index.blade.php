<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Halaman
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua halaman statis seperti "Tentang Kami", "Visi Misi", dll.
                </p>
            </div>
            <a href="{{ route('admin.halaman.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Halaman Baru
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
                <form action="{{ route('admin.halaman.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-grow w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari judul halaman..." class="block w-full py-2.5 pl-12 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                    </div>
                    <div class="flex-shrink-0 w-full sm:w-auto">
                        <select name="status" class="block w-full py-2.5 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="published" @selected(request('status') == 'published')>Published</option>
                            <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                        </select>
                    </div>
                </form>
            </div>

            {{-- START: Tabel dengan Desain Baru --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul Halaman</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Slug</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Terakhir Diperbarui</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($halamans as $halaman)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-slate-800">{{ $halaman->judul }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500 font-mono flex items-center gap-2">
                                        <i class="fas fa-link text-slate-400"></i>
                                        <span>{{ $halaman->slug }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClasses = [
                                            'published' => 'bg-green-100 text-green-800',
                                            'draft' => 'bg-yellow-100 text-yellow-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2.5 py-0.5 text-xs font-semibold leading-5 rounded-full {{ $statusClasses[$halaman->status] ?? '' }}">
                                        {{ ucfirst($halaman->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $halaman->updated_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('admin.halaman.edit', $halaman->id) }}" class="text-slate-500 hover:text-sky-600 transition-colors" title="Edit Halaman">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>
                                        <form action="{{ route('admin.halaman.destroy', $halaman->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaman ini? Ini tidak bisa dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-500 hover:text-red-600 transition-colors" title="Hapus Halaman">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Tampilan "Empty State" yang Ditingkatkan --}}
                            <tr>
                                <td colspan="5">
                                    <div class="text-center py-20 px-6">
                                        <div class="inline-block p-5 bg-slate-100 rounded-full">
                                            <i class="far fa-file-alt text-5xl text-slate-400"></i>
                                        </div>
                                        <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Halaman</h3>
                                        <p class="mt-2 text-slate-500">Mulai dengan menambahkan halaman statis pertama Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if ($halamans->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $halamans->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>