<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri --}}
        <div class="space-y-6 lg:col-span-2">
            <div>
                <label for="judul_prestasi" class="block text-sm font-medium text-slate-700">Judul Prestasi</label>
                <input type="text" name="judul_prestasi" id="judul_prestasi" value="{{ old('judul_prestasi', $prestasi->judul_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('judul_prestasi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="bidang_prestasi" class="block text-sm font-medium text-slate-700">Bidang Prestasi (Opsional)</label>
                    <input type="text" name="bidang_prestasi" id="bidang_prestasi" value="{{ old('bidang_prestasi', $prestasi->bidang_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: Sains, Olahraga, Seni">
                    @error('bidang_prestasi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tingkat_prestasi" class="block text-sm font-medium text-slate-700">Tingkat Prestasi</label>
                    <input type="text" name="tingkat_prestasi" id="tingkat_prestasi" value="{{ old('tingkat_prestasi', $prestasi->tingkat_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: Nasional, Provinsi" required>
                    @error('tingkat_prestasi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="tahun_perolehan" class="block text-sm font-medium text-slate-700">Tahun Perolehan</label>
                    <input type="number" name="tahun_perolehan" id="tahun_perolehan" value="{{ old('tahun_perolehan', $prestasi->tahun_perolehan ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: 2024">
                    @error('tahun_perolehan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="pihak_pemberi" class="block text-sm font-medium text-slate-700">Pihak Pemberi (Opsional)</label>
                    <input type="text" name="pihak_pemberi" id="pihak_pemberi" value="{{ old('pihak_pemberi', $prestasi->pihak_pemberi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                    @error('pihak_pemberi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
             <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="lg:col-span-1">
            <label for="gambar_penghargaan" class="block text-sm font-medium text-slate-700">Gambar Penghargaan (Opsional)</label>
            <div class="flex flex-col items-center mt-2 space-y-4">
                <img id="gambar-preview" src="{{ isset($prestasi) && $prestasi->gambar_penghargaan ? Storage::url($prestasi->gambar_penghargaan) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Gambar' }}" alt="Gambar preview" class="object-cover w-full rounded-md h-44">
                <input type="file" name="gambar_penghargaan" id="gambar_penghargaan" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" onchange="document.getElementById('gambar-preview').src = window.URL.createObjectURL(this.files[0])">
            </div>
            @error('gambar_penghargaan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.prestasi.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($prestasi) ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
    </button>
</div>
