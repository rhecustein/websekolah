<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Kategori: ') . $kategoriBeritum->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                {{-- Perhatikan penggunaan $kategoriBeritum sesuai dengan variabel di controller --}}
                <form action="{{ route('admin.kategori-berita.update', $kategoriBeritum->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700">Nama Kategori</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $kategoriBeritum->nama) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                            @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $kategoriBeritum->deskripsi) }}</textarea>
                            @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.kategori-berita.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
