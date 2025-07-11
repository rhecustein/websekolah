<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Data Guru
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua data guru dan tenaga pengajar di sekolah Anda.
                </p>
            </div>
            <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Data Guru
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="py-8 md:py-12"> {{-- Padding disesuaikan --}}
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8"> {{-- Max width disesuaikan --}}

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-6 text-sm text-green-800 bg-green-50 rounded-lg shadow-md" role="alert">
                    <i class="mr-3 text-lg fas fa-check-circle"></i>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="ml-auto text-green-900 hover:text-green-700 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            {{-- Notifikasi Error (Tambahan) --}}
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)" class="flex items-center p-4 mb-6 text-sm text-red-800 bg-red-50 rounded-lg shadow-md" role="alert">
                    <i class="mr-3 text-lg fas fa-times-circle"></i>
                    <div>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="ml-auto text-red-900 hover:text-red-700 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Kontainer Utama dengan Desain Baru --}}
            <div class="bg-white rounded-xl shadow-lg border border-slate-200"> {{-- Tambahkan border --}}
                
                {{-- Bagian Atas: Pencarian dan Filter --}}
                <div class="p-6 border-b border-slate-200">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 border-b border-slate-200 pb-3">Filter Data Guru</h3>
                    <form action="{{ route('admin.guru.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                        <div class="md:col-span-2">
                            <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Cari Guru</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-slate-400"></i>
                                </div>
                                <input type="text" name="search" id="search" placeholder="Cari nama, NIP, atau jabatan..." class="block w-full py-2.5 pl-10 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full py-2.5 pl-3 pr-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                <option value="">Semua Gender</option>
                                <option value="Laki-laki" @selected(request('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(request('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                            </select>
                        </div>
                        <div class="pt-6 md:pt-0"> {{-- Sesuaikan padding untuk keselarasan tombol --}}
                            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                <i class="fas fa-filter"></i>
                                <span>Filter</span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Informasi Jumlah Data --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <p class="text-sm text-slate-600">
                        Menampilkan <span class="font-semibold">{{ $gurus->firstItem() }}</span> hingga <span class="font-semibold">{{ $gurus->lastItem() }}</span> dari total <span class="font-semibold">{{ $gurus->total() }}</span> guru.
                        @if(request('search') || request('jenis_kelamin'))
                            <span class="text-xs text-slate-500 ml-2">(Hasil filter)</span>
                        @endif
                    </p>
                </div>

                {{-- START: Tabel dengan Desain Baru --}}
                <div class="overflow-x-auto rounded-b-xl"> {{-- Rounded bottom untuk tabel --}}
                    <table class="w-full min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Jabatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Bidang Studi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Kontak</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-slate-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($gurus as $guru)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-11 h-11 rounded-full object-cover border border-slate-200" src="{{ $guru->foto ? Storage::url($guru->foto) : 'https://ui-avatars.com/api/?name='.urlencode($guru->nama_lengkap).'&color=7F9CF5&background=EBF4FF' }}" alt="Foto {{ $guru->nama_lengkap }}">
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-slate-800">{{ $guru->nama_lengkap }}</div>
                                                <div class="text-xs text-slate-500">{{ $guru->nip ? 'NIP: ' . $guru->nip : 'NIP: -' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $guru->jabatan }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">{{ $guru->bidang_studi ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">
                                        @if($guru->email)
                                            <a href="mailto:{{ $guru->email }}" class="text-sky-600 hover:underline">{{ $guru->email }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('admin.guru.edit', $guru->id) }}" class="text-indigo-600 hover:text-indigo-800 transition-colors" title="Edit Data Guru">
                                                <i class="fas fa-pencil-alt fa-fw"></i>
                                            </a>
                                            <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini? Tindakan ini tidak dapat diurungkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus Data Guru">
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
                                                <i class="fas fa-chalkboard-teacher text-5xl text-slate-400"></i>
                                            </div>
                                            <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Data Guru</h3>
                                            <p class="mt-2 text-slate-500">Hasil filter tidak menemukan apa pun atau Anda belum menambahkan data guru.</p>
                                            <a href="{{ route('admin.guru.create') }}" class="mt-6 inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                                                <i class="fas fa-plus"></i>
                                                Tambah Guru Pertama Anda
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination --}}
                @if ($gurus->hasPages())
                    <div class="p-6 border-t border-slate-200">
                        {{ $gurus->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>