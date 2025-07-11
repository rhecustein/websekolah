<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Kategori
                </h2>
                {{-- Menampilkan nama kategori yang sedang diedit di subjudul --}}
                <p class="mt-1 text-sm text-slate-500">
                    Anda sedang memperbarui kategori: <span class="font-semibold">{{ $kategoriBeritum->nama }}</span>
                </p>
            </div>
            <a href="{{ route('admin.kategori-berita.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Kategori
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Kontainer Form dengan Desain Baru --}}
        <div class="bg-white overflow-hidden rounded-xl shadow-lg">
            {{-- Form di-binding ke route 'update' dengan method 'PUT' --}}
            <form action="{{ route('admin.kategori-berita.update', $kategoriBeritum->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div 
                    {{-- AlpineJS diinisialisasi dengan data yang ada dari $kategoriBeritum --}}
                    x-data="{
                        nama: '{{ old('nama', $kategoriBeritum->nama) }}',
                        slug: '{{ old('slug', $kategoriBeritum->slug) }}',
                        generateSlug() {
                            this.slug = this.nama.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
                        }
                    }" 
                    class="p-6 md:p-8 space-y-6"
                >
                    {{-- Input Nama Kategori --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-slate-700">Nama Kategori</label>
                        <input 
                            type="text" 
                            name="nama" 
                            id="nama" 
                            x-model="nama"
                            @input="generateSlug"
                            class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" 
                            required
                        >
                        @error('nama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Input Slug (Read-only) --}}
                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                        <input 
                            type="text" 
                            name="slug" 
                            id="slug" 
                            x-model="slug"
                            class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300"
                            readonly
                        >
                        <p class="mt-2 text-xs text-slate-500">Slug akan diperbarui otomatis, digunakan untuk URL yang ramah SEO.</p>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Input Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi" 
                            rows="4" 
                            class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500"
                        >{{ old('deskripsi', $kategoriBeritum->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                </div>

                {{-- Footer Form dengan Tombol Aksi --}}
                <div class="flex items-center justify-end px-6 py-4 space-x-4 bg-slate-50 border-t border-slate-200">
                    <a href="{{ route('admin.kategori-berita.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>