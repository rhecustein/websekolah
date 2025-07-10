<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri --}}
        <div class="space-y-6 lg:col-span-2">
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700">Nama Ekstrakurikuler</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $ekstrakurikuler->nama ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="pembimbing" class="block text-sm font-medium text-slate-700">Nama Pembimbing (Opsional)</label>
                    <input type="text" name="pembimbing" id="pembimbing" value="{{ old('pembimbing', $ekstrakurikuler->pembimbing ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                    @error('pembimbing') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="jadwal" class="block text-sm font-medium text-slate-700">Jadwal (Opsional)</label>
                    <input type="text" name="jadwal" id="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: Setiap Sabtu, 10:00 - 12:00">
                    @error('jadwal') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
             <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="lg:col-span-1">
            <label for="gambar_ikon" class="block text-sm font-medium text-slate-700">Gambar / Ikon (Opsional)</label>
            <div class="flex flex-col items-center mt-2 space-y-4">
                <img id="gambar-preview" src="{{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar_ikon ? Storage::url($ekstrakurikuler->gambar_ikon) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Ikon' }}" alt="Gambar preview" class="object-cover w-full rounded-md h-44">
                <input type="file" name="gambar_ikon" id="gambar_ikon" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" onchange="document.getElementById('gambar-preview').src = window.URL.createObjectURL(this.files[0])">
            </div>
            @error('gambar_ikon') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan Ekstrakurikuler' }}
    </button>
</div>
