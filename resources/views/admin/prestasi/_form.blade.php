{{-- 
  - Wrapper AlpineJS untuk state management pratinjau gambar.
  - Variabel $prestasi di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        imageUrl: '{{ isset($prestasi) && $prestasi->gambar_penghargaan ? Storage::url($prestasi->gambar_penghargaan) : '' }}',
        updatePreview(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageUrl = URL.createObjectURL(file);
            }
        }
    }"
    class="p-6 md:p-8"
>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Informasi Prestasi --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Detail Prestasi</h3>
                <div class="space-y-4">
                    <div>
                        <label for="judul_prestasi" class="block text-sm font-medium text-slate-700">Judul Prestasi</label>
                        <input type="text" name="judul_prestasi" id="judul_prestasi" value="{{ old('judul_prestasi', $prestasi->judul_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Juara 1 Olimpiade Sains Nasional" required>
                        @error('judul_prestasi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="bidang_prestasi" class="block text-sm font-medium text-slate-700">Bidang Prestasi</label>
                            <input type="text" name="bidang_prestasi" id="bidang_prestasi" value="{{ old('bidang_prestasi', $prestasi->bidang_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Sains, Olahraga, Seni">
                            @error('bidang_prestasi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="tingkat_prestasi" class="block text-sm font-medium text-slate-700">Tingkat</label>
                            <input type="text" name="tingkat_prestasi" id="tingkat_prestasi" value="{{ old('tingkat_prestasi', $prestasi->tingkat_prestasi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Nasional, Provinsi" required>
                            @error('tingkat_prestasi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tahun_perolehan" class="block text-sm font-medium text-slate-700">Tahun</label>
                            <input type="number" name="tahun_perolehan" id="tahun_perolehan" value="{{ old('tahun_perolehan', $prestasi->tahun_perolehan ?? date('Y')) }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: 2024">
                            @error('tahun_perolehan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="pihak_pemberi" class="block text-sm font-medium text-slate-700">Pemberi Penghargaan</label>
                            <input type="text" name="pihak_pemberi" id="pihak_pemberi" value="{{ old('pihak_pemberi', $prestasi->pihak_pemberi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Kemendikbud">
                            @error('pihak_pemberi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Jelaskan lebih detail tentang prestasi yang diraih...">{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Gambar Penghargaan --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Gambar/Sertifikat</h3>
                <div class="space-y-2">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img :src="imageUrl" alt="Pratinjau Gambar" class="object-contain w-full h-full" x-show="imageUrl" >
                        <div x-show="!imageUrl" class="text-slate-400 text-center">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    </div>
                    <input type="file" name="gambar_penghargaan" id="gambar_penghargaan" class="sr-only" @change="updatePreview">
                    <label for="gambar_penghargaan" class="cursor-pointer mt-2 w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($prestasi) && $prestasi->gambar_penghargaan ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                    </label>
                    <p class="text-xs text-center text-slate-500">Foto piala, sertifikat, atau momen penghargaan.</p>
                    @error('gambar_penghargaan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.prestasi.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($prestasi) && $prestasi->id ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
    </button>
</div>