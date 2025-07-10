<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Manajemen Informasi PPDB') }}
            </h2>
            <a href="{{ route('admin.informasi-ppdb.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Informasi
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
                    <!-- Search Form -->
                    <form action="{{ route('admin.informasi-ppdb.index') }}" method="GET" class="mb-6">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari judul informasi..." class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" value="{{ request('search') }}">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="text-gray-400 fas fa-search"></i>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Judul Informasi</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Periode</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Penulis</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Terakhir Diperbarui</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($informasi as $info)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $info->judul }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            @if($info->tanggal_mulai && $info->tanggal_akhir)
                                                {{ \Carbon\Carbon::parse($info->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($info->tanggal_akhir)->format('d M Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $info->user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $info->updated_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.informasi-ppdb.edit', $info->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.informasi-ppdb.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            Tidak ada informasi PPDB ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $informasi->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
