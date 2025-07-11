{{-- 
  - Wrapper AlpineJS untuk state management (nama, slug, pratinjau thumbnail).
  - Variabel $albumGaleri di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        nama: '{{ old('nama', $albumGaleri->nama ?? '') }}',
        slug: '{{ old('slug', $albumGaleri->slug ?? '') }}',
        thumbnailUrl: '{{ isset($albumGaleri) && $albumGaleri->thumbnail ? Storage::url($albumGaleri->thumbnail) : '' }}',
        generateSlug() {
            this.slug = this.nama.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
        }
    }"
    class="p-6 md:p-8"
>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Nama Album dan Slug --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700">Nama Album</label>
                <input type="text" name="nama" id="nama" x-model="nama" @input="generateSlug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 text-lg" placeholder="Contoh: Kegiatan 17 Agustus" required>
                @error('nama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                <div class="relative mt-1">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-slate-400">/galeri/</span>
                    <input type="text" name="slug" id="slug" x-model="slug" class="block w-full pl-[62px] border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300" readonly>
                </div>
                 @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            
            {{-- Deskripsi --}}
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Jelaskan sedikit tentang isi album ini...">{{ old('deskripsi', $albumGaleri->deskripsi ?? '') }}</textarea>
                @error('deskripsi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Tipe Album --}}
            <div>
                <label for="tipe" class="block text-sm font-medium text-slate-700">Tipe Album</label>
                <select name="tipe" id="tipe" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                    <option value="">Pilih Tipe</option>
                    <option value="foto" @selected(old('tipe', $albumGaleri->tipe ?? '') == 'foto')>Foto</option>
                    <option value="video" @selected(old('tipe', $albumGaleri->tipe ?? '') == 'video')>Video</option>
                </select>
                <p class="mt-2 text-xs text-slate-500">Pilih jenis media yang akan dominan di album ini.</p>
                @error('tipe') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom Kanan: Thumbnail --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-slate-50 rounded-xl border">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Thumbnail Album</h3>
                <div class="space-y-2">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-slate-200 flex items-center justify-center">
                        <img :src="thumbnailUrl" alt="Pratinjau Thumbnail" class="object-cover w-full h-full" x-show="thumbnailUrl">
                        <div x-show="!thumbnailUrl" class="text-slate-400 text-center">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail" class="sr-only" @change="thumbnailUrl = URL.createObjectURL($event.target.files[0])">
                    <label for="thumbnail" class="cursor-pointer mt-2 w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($albumGaleri) && $albumGaleri->thumbnail ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                    </label>
                    <p class="text-xs text-center text-slate-500">Gunakan sebagai sampul album.</p>
                    @error('thumbnail') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200">
    <a href="{{ route('admin.album-galeri.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($albumGaleri) && $albumGaleri->id ? 'Simpan Perubahan' : 'Buat Album' }}
    </button>
</div>