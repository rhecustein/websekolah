{{-- 
  - Wrapper AlpineJS untuk state management (nama, slug, pratinjau gambar).
  - Variabel $ekstrakurikuler di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        nama: '{{ old('nama', $ekstrakurikuler->nama ?? '') }}',
        slug: '{{ old('slug', $ekstrakurikuler->slug ?? '') }}',
        imageUrl: '{{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar_ikon ? Storage::url($ekstrakurikuler->gambar_ikon) : '' }}',
        generateSlug() {
            this.slug = this.nama.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
        },
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

        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Detail Ekstrakurikuler</h3>
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-slate-700">Nama Ekstrakurikuler</label>
                        <input type="text" name="nama" id="nama" x-model="nama" @input="generateSlug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Paskibra, PMR" required>
                        @error('nama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" x-model="slug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300" readonly>
                        <p class="mt-2 text-xs text-slate-500">Slug akan dibuat otomatis dari nama ekstrakurikuler.</p>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="pembimbing" class="block text-sm font-medium text-slate-700">Nama Pembimbing</label>
                            <input type="text" name="pembimbing" id="pembimbing" value="{{ old('pembimbing', $ekstrakurikuler->pembimbing ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Nama lengkap pembimbing...">
                            @error('pembimbing') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="jadwal" class="block text-sm font-medium text-slate-700">Jadwal</label>
                            <input type="text" name="jadwal" id="jadwal" value="{{ old('jadwal', $ekstrakurikuler->jadwal ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Setiap Sabtu, 10:00 - 12:00">
                            @error('jadwal') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Jelaskan sedikit tentang kegiatan ekstrakurikuler ini...">{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Gambar Ikon --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Gambar / Ikon</h3>
                <div class="space-y-2">
                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img :src="imageUrl" alt="Pratinjau Gambar" class="object-cover w-full h-full" x-show="imageUrl">
                        <div x-show="!imageUrl" class="text-slate-400 text-center">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    </div>
                    <input type="file" name="gambar_ikon" id="gambar_ikon" class="sr-only" @change="updatePreview">
                    <label for="gambar_ikon" class="cursor-pointer mt-2 w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar_ikon ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                    </label>
                    <p class="text-xs text-center text-slate-500">Gunakan sebagai ikon/logo ekstrakurikuler.</p>
                    @error('gambar_ikon') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan Ekstrakurikuler' }}
    </button>
</div>