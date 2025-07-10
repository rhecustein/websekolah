<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Manajemen Pendaftar PPDB') }}
            </h2>
            <a href="{{ route('admin.ppdb-admin.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Pendaftar
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

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filter Form -->
                    <form action="{{ route('admin.ppdb-admin.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <input type="text" name="search" placeholder="Cari nama, no. pendaftaran, email..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                            </div>
                            <div>
                                <select name="status_pendaftaran" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status_pendaftaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diverifikasi" {{ request('status_pendaftaran') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="seleksi" {{ request('status_pendaftaran') == 'seleksi' ? 'selected' : '' }}>Seleksi</option>
                                    <option value="lulus" {{ request('status_pendaftaran') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ request('status_pendaftaran') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                    <option value="daftar_ulang" {{ request('status_pendaftaran') == 'daftar_ulang' ? 'selected' : '' }}>Daftar Ulang</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-800 border border-transparent rounded-md hover:bg-gray-700">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No. Pendaftaran</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jurusan</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tgl Daftar</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pendaftar as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-700 whitespace-nowrap">{{ $item->nomor_pendaftaran }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->email_siswa }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->jurusan_diminati }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full capitalize
                                                @switch($item->status_pendaftaran)
                                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                                    @case('diverifikasi') bg-blue-100 text-blue-800 @break
                                                    @case('seleksi') bg-indigo-100 text-indigo-800 @break
                                                    @case('lulus') bg-green-100 text-green-800 @break
                                                    @case('tidak_lulus') bg-red-100 text-red-800 @break
                                                    @case('daftar_ulang') bg-teal-100 text-teal-800 @break
                                                    @default bg-gray-100 text-gray-800
                                                @endswitch
                                            ">
                                                {{ str_replace('_', ' ', $item->status_pendaftaran) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.ppdb-admin.show', $item->id) }}" class="text-gray-600 hover:text-gray-900">Lihat</a>
                                                <a href="{{ route('admin.ppdb-admin.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.ppdb-admin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            Tidak ada data pendaftar ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $pendaftar->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
