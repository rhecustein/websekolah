<div class="p-6 space-y-6">
    {{-- Nama Album --}}
    <div>
        <label for="nama" class="block text-sm font-medium text-slate-700">Nama Album</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $albumGaleri->nama ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
        @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $albumGaleri->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        {{-- Tipe Album --}}
        <div>
            <label for="tipe" class="block text-sm font-medium text-slate-700">Tipe Album</label>
            <select name="tipe" id="tipe" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                <option value="">Pilih Tipe</option>
                <option value="foto" @isset($albumGaleri) {{ $albumGaleri->tipe == 'foto' ? 'selected' : '' }} @endisset>Foto</option>
                <option value="video" @isset($albumGaleri) {{ $albumGaleri->tipe == 'video' ? 'selected' : '' }} @endisset>Video</option>
                <option value="campuran" @isset($albumGaleri) {{ $albumGaleri->tipe == 'campuran' ? 'selected' : '' }} @endisset>Campuran</option>
            </select>
            @error('tipe') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        {{-- Thumbnail --}}
        <div>
            <label for="thumbnail" class="block text-sm font-medium text-slate-700">Thumbnail Album</label>
            @isset($albumGaleri->thumbnail)
                <div class="mt-2">
                    <img src="{{ Storage::url($albumGaleri->thumbnail) }}" alt="Thumbnail saat ini" class="h-24 w-auto rounded-md">
                </div>
            @endisset
            <input type="file" name="thumbnail" id="thumbnail" class="block w-full mt-2 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
            @error('thumbnail') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.album-galeri.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($albumGaleri) ? 'Simpan Perubahan' : 'Simpan Album' }}
    </button>
</div>
