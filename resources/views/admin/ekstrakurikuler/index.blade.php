<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Ekstrakurikuler
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola semua kegiatan ekstrakurikuler yang tersedia di sekolah.
                </p>
            </div>
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-plus-circle"></i>
                Tambah Ekstrakurikuler
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
            
            {{-- Bagian Atas: Pencarian --}}
            <div class="p-6 border-b border-slate-200">
                <form action="{{ route('admin.ekstrakurikuler.index') }}" method="GET" class="flex items-center gap-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari nama ekstrakurikuler atau pembimbing..." class="block w-full py-2.5 pl-12 pr-4 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" value="{{ request('search') }}">
                    </div>
                     <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700">
                        <i class="fas fa-filter"></i>
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            @if($ekstrakurikulers->isEmpty())
                {{-- Tampilan "Empty State" yang Ditingkatkan --}}
                <div class="text-center py-20 px-6">
                    <div class="inline-block p-5 bg-slate-100 rounded-full">
                        <i class="fas fa-basketball-ball text-5xl text-slate-400"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-slate-800">Belum Ada Ekstrakurikuler</h3>
                    <p class="mt-2 text-slate-500">Mulai dengan menambahkan data ekstrakurikuler pertama Anda.</p>
                </div>
            @else
                {{-- START: Grid Kartu Ekstrakurikuler --}}
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($ekstrakurikulers as $item)
                        <div class="group bg-white overflow-hidden rounded-xl border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                           <div class="p-5">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-16 h-16 rounded-lg object-cover" src="{{ $item->gambar_ikon ? Storage::url($item->gambar_ikon) : 'https://ui-avatars.com/api/?name='.urlencode($item->nama).'&color=7F9CF5&background=EBF4FF' }}" alt="Ikon {{ $item->nama }}">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-slate-800 text-lg group-hover:text-sky-600 transition-colors">{{ $item->nama }}</h3>
                                        <p class="text-sm text-slate-500 mt-1">
                                            <i class="fas fa-user-tie fa-fw mr-1.5 text-slate-400"></i>
                                            {{ $item->pembimbing ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-dashed">
                                     <p class="text-sm text-slate-600">
                                        <i class="fas fa-calendar-alt fa-fw mr-1.5 text-slate-400"></i>
                                        {{ $item->jadwal ?? 'Jadwal belum ditentukan' }}
                                    </p>
                                </div>
                           </div>
                           <div class="bg-slate-50 px-5 py-2 flex justify-end">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.ekstrakurikuler.edit', $item->id) }}" class="text-slate-400 hover:text-sky-600 transition-colors" title="Edit">
                                        <i class="fas fa-pencil-alt fa-fw"></i>
                                    </a>
                                    <form action="{{ route('admin.ekstrakurikuler.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                            <i class="fas fa-trash-alt fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                           </div>
                        </div>
                    @endforeach
                </div>
                {{-- END: Grid Kartu --}}
            @endif
            
            {{-- Pagination --}}
            @if ($ekstrakurikulers->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $ekstrakurikulers->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>