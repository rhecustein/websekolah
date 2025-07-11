<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-slate-800">
                {{ __('Manajemen Pengguna') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold tracking-wide text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-lg shadow-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:opacity-50">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="flex items-center p-4 mb-6 text-sm text-green-800 bg-green-50 rounded-lg shadow-md" role="alert">
                    <i class="mr-3 text-lg fas fa-check-circle"></i>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="flex items-center p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-lg shadow-md" role="alert">
                    <i class="mr-3 text-lg fas fa-times-circle"></i>
                    <div>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg border border-slate-200">
                <div class="p-6">

                    {{-- Card untuk Filter --}}
                    <div class="mb-6 p-6 bg-slate-50 rounded-lg border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 border-b border-slate-200 pb-3">Filter Pengguna</h3>
                        <form action="{{ route('admin.users.index') }}" method="GET">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 items-end">
                                <div class="lg:col-span-2">
                                    <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Cari Pengguna</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-search text-slate-400"></i>
                                        </div>
                                        <input type="text" name="search" id="search" placeholder="Cari nama atau email..." class="block w-full pl-10 pr-3 py-2 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div>
                                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Filter Berdasarkan Role</label>
                                    <select name="role" id="role" class="block w-full py-2 pl-3 pr-10 text-base border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                        <option value="">Semua Role</option>
                                        {{-- Asumsi Anda memiliki daftar role yang bisa diambil dari database. Sesuaikan jika beda. --}}
                                        @php
                                            // Contoh hardcoded roles; di produksi, ambil dari database: Role::pluck('name')->all();
                                            $availableRoles = ['admin', 'editor', 'user', 'moderator']; 
                                        @endphp
                                        @foreach ($availableRoles as $availableRole)
                                            <option value="{{ $availableRole }}" {{ request('role') == $availableRole ? 'selected' : '' }}>
                                                {{ ucfirst($availableRole) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="pt-6 sm:pt-0">
                                    <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-sm font-semibold text-white bg-sky-600 border border-transparent rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                        <i class="mr-2 fas fa-filter"></i> Terapkan Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Informasi Jumlah Data --}}
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-slate-600">
                            Menampilkan <span class="font-semibold">{{ $users->firstItem() }}</span> hingga <span class="font-semibold">{{ $users->lastItem() }}</span> dari total <span class="font-semibold">{{ $users->total() }}</span> pengguna.
                            @if(request('search') || request('role'))
                                <span class="text-xs text-slate-500 ml-2">(Hasil filter)</span>
                            @endif
                        </p>
                    </div>

                    <div class="overflow-x-auto rounded-lg shadow-md border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Tanggal Bergabung</th>
                                    <th scope="col" class="relative px-6 py-3 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-slate-600">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @forelse ($user->roles as $role)
                                                <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 rounded-full
                                                    @switch($role->name)
                                                        @case('admin') bg-indigo-100 text-indigo-800 @break
                                                        @case('editor') bg-blue-100 text-blue-800 @break
                                                        @case('moderator') bg-purple-100 text-purple-800 @break
                                                        @default bg-green-100 text-green-800
                                                    @endswitch
                                                ">
                                                    {{ $role->name }}
                                                </span>
                                            @empty
                                                <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 rounded-full bg-gray-100 text-gray-800">
                                                    No Role
                                                </span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-800 flex items-center group" title="Edit Pengguna">
                                                    <i class="fas fa-edit text-sm mr-1 group-hover:text-indigo-800"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat diurungkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 flex items-center group" title="Hapus Pengguna">
                                                        <i class="fas fa-trash-alt text-sm mr-1 group-hover:text-red-800"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-md text-slate-500">
                                            <i class="fas fa-info-circle mr-2"></i>Tidak ada pengguna ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>