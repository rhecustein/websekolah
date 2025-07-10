<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Manajemen Data Guru') }}
            </h2>
            <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Guru
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
                    <form action="{{ route('admin.guru.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <input type="text" name="search" placeholder="Cari nama, jabatan, atau bidang studi..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                            </div>
                            <div>
                                <select name="jenis_kelamin" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="inline-flex items-center w-full justify-center px-4 py-2 text-sm font-medium text-white bg-gray-800 border border-transparent rounded-md hover:bg-gray-700">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Lengkap</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Jabatan</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Bidang Studi</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($gurus as $guru)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full object-cover" src="{{ $guru->foto ? Storage::url($guru->foto) : 'https://ui-avatars.com/api/?name='.urlencode($guru->nama_lengkap).'&color=7F9CF5&background=EBF4FF' }}" alt="Foto {{ $guru->nama_lengkap }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $guru->nama_lengkap }}</div>
                                                    <div class="text-sm text-gray-500">{{ $guru->nip ?? 'NIP: -' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $guru->jabatan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $guru->bidang_studi ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $guru->email ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?');">
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
                                            Tidak ada data guru ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $gurus->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
