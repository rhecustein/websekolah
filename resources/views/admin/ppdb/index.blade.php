<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Pendaftar PPDB
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua data calon siswa yang mendaftar melalui PPDB Online.
                </p>
            </div>
            <a href="{{ route('admin.ppdb-admin.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Pendaftar
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
                <form action="{{ route('admin.ppdb-admin.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative flex-grow w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari nama, no. pendaftaran, email..." class="block w-full py-2.5 pl-12 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                    </div>
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <div class="flex-shrink-0 w-full sm:w-48">
                           <select name="status_pendaftaran" class="block w-full py-2.5 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">
                                <option value="">Semua Status</option>
                                <option value="pending" @selected(request('status_pendaftaran') == 'pending')>Pending</option>
                                <option value="diverifikasi" @selected(request('status_pendaftaran') == 'diverifikasi')>Diverifikasi</option>
                                <option value="seleksi" @selected(request('status_pendaftaran') == 'seleksi')>Seleksi</option>
                                <option value="lulus" @selected(request('status_pendaftaran') == 'lulus')>Lulus</option>
                                <option value="tidak_lulus" @selected(request('status_pendaftaran') == 'tidak_lulus')>Tidak Lulus</option>
                                <option value="daftar_ulang" @selected(request('status_pendaftaran') == 'daftar_ulang')>Daftar Ulang</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- START: Tabel dengan Desain Baru --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Pendaftaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jurusan</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tgl Daftar</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($pendaftar as $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-700 whitespace-nowrap">
                                    <i class="fas fa-hashtag text-slate-400 mr-1"></i>
                                    {{ $item->nomor_pendaftaran }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-slate-800">{{ $item->nama_lengkap }}</div>
                                    <div class="text-xs text-slate-500">{{ $item->email_siswa }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $item->jurusan_diminati }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'diverifikasi' => 'bg-blue-100 text-blue-800',
                                            'seleksi' => 'bg-indigo-100 text-indigo-800',
                                            'lulus' => 'bg-green-100 text-green-800',
                                            'tidak_lulus' => 'bg-red-100 text-red-800',
                                            'daftar_ulang' => 'bg-teal-100 text-teal-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex px-2.5 py-0.5 text-xs font-semibold leading-5 rounded-full capitalize {{ $statusClasses[$item->status_pendaftaran] ?? 'bg-slate-100 text-slate-800' }}">
                                        {{ str_replace('_', ' ', $item->status_pendaftaran) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('admin.ppdb-admin.show', $item->id) }}" class="text-slate-400 hover:text-green-600 transition-colors" title="Lihat Detail">
                                            <i class="fas fa-eye fa-fw"></i>
                                        </a>
                                        <a href="{{ route('admin.ppdb-admin.edit', $item->id) }}" class="text-slate-400 hover:text-sky-600 transition-colors" title="Edit Pendaftar">
                                            <i class="fas fa-pencil-alt fa-fw"></i>
                                        </a>
                                        <form action="{{ route('admin.ppdb-admin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus Pendaftar">
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
                                            <i class="fas fa-user-graduate text-5xl text-slate-400"></i>
                                        </div>
                                        <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Pendaftar</h3>
                                        <p class="mt-2 text-slate-500">Hasil filter tidak menemukan apa pun atau belum ada calon siswa yang mendaftar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if ($pendaftar->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $pendaftar->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>