<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Manajemen Pembayaran PPDB') }}
            </h2>
            <a href="{{ route('admin.pembayaran-ppdb.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Pembayaran
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
                    <form action="{{ route('admin.pembayaran-ppdb.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="md:col-span-2">
                                <input type="text" name="search" placeholder="Cari nama, no. pendaftaran..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                            </div>
                            <div>
                                <select name="status_pembayaran" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status_pembayaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="terverifikasi" {{ request('status_pembayaran') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="ditolak" {{ request('status_pembayaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Pendaftar</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jenis Pembayaran</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tgl Bayar</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pembayaran as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->pendaftarPpdb->nama_lengkap }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->pendaftarPpdb->nomor_pendaftaran }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->jenis_pembayaran }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-700 whitespace-nowrap">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full capitalize
                                                @switch($item->status_pembayaran)
                                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                                    @case('terverifikasi') bg-green-100 text-green-800 @break
                                                    @case('ditolak') bg-red-100 text-red-800 @break
                                                @endswitch
                                            ">
                                                {{ $item->status_pembayaran }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.pembayaran-ppdb.show', $item->id) }}" class="text-gray-600 hover:text-gray-900">Lihat</a>
                                                <a href="{{ route('admin.pembayaran-ppdb.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.pembayaran-ppdb.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini?');">
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
                                            Tidak ada data pembayaran ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $pembayaran->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
