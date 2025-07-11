{{-- ================================================================= --}}
{{-- |  KOMPONEN FORM BERITA (untuk create & edit)                  | --}}
{{-- |  File ini bisa disimpan sebagai:                              | --}}
{{-- |  resources/views/admin/berita/_form.blade.php                 | --}}
{{-- ================================================================= --}}

@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> {{-- Bahasa Indonesia --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Flatpickr dengan bahasa Indonesia
            flatpickr("#published_at", {
                enableTime: false,
                dateFormat: "Y-m-d",
                locale: "id",
            });

            // Inisialisasi TinyMCE
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen media wordcount preview searchreplace autolink',
                toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image media link | fullscreen preview',
                height: 500,
                // Opsi untuk upload gambar melalui TinyMCE (opsional, butuh implementasi backend)
                // images_upload_url: '{{ route('admin.berita.upload-image') }}',
                // images_upload_credentials: true,
                // file_picker_types: 'image',
            });
        });
    </script>
@endpush

{{-- 
  - Wrapper AlpineJS untuk state management (judul, slug, pratinjau thumbnail).
  - Variabel $berita di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        judul: '{{ old('judul', $berita->judul ?? '') }}',
        slug: '{{ old('slug', $berita->slug ?? '') }}',
        thumbnailUrl: '{{ isset($berita) && $berita->thumbnail ? Storage::url($berita->thumbnail) : '' }}',
        generateSlug() {
            this.slug = this.judul.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
        }
    }"
    class="p-6 md:p-8 space-y-6"
>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        {{-- Kolom Kiri: Editor Utama --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Judul dan Slug --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <div class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Berita</label>
                        <input type="text" name="judul" id="judul" x-model="judul" @input="generateSlug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 text-lg" placeholder="Judul yang menarik..." required>
                        @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-slate-400">/berita/</span>
                            <input type="text" name="slug" id="slug" x-model="slug" class="block w-full pl-[58px] border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300" readonly>
                        </div>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Konten (TinyMCE) --}}
            <div class="bg-white rounded-xl shadow-lg">
                <div class="p-2 border-b border-slate-200">
                    <label for="konten" class="px-4 text-sm font-medium text-slate-700">Konten Berita</label>
                </div>
                <div class="p-1">
                    <textarea name="konten" id="konten" class="hidden">{{ old('konten', $berita->konten ?? '') }}</textarea>
                    @error('konten') <p class="p-4 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar Pengaturan --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Kartu Pengaturan --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Pengaturan</h3>
                <div class="space-y-4">
                    <div>
                        <label for="kategori_berita_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                        <select name="kategori_berita_id" id="kategori_berita_id" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_berita_id', $berita->kategori_berita_id ?? '') == $kategori->id)>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_berita_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                            <option value="draft" @selected(old('status', $berita->status ?? 'draft') == 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $berita->status ?? '') == 'published')>Published</option>
                            <option value="archived" @selected(old('status', $berita->status ?? '') == 'archived')>Archived</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="published_at" class="block text-sm font-medium text-slate-700">Tanggal Publikasi</label>
                        <div class="relative mt-1">
                             <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-slate-400"></i>
                            </div>
                            <input type="text" name="published_at" id="published_at" value="{{ old('published_at', isset($berita) ? ($berita->published_at ? $berita->published_at->format('Y-m-d') : '') : '') }}" class="block w-full pl-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Pilih tanggal...">
                        </div>
                        <p class="mt-2 text-xs text-slate-500">Kosongkan jika statusnya adalah Draft.</p>
                        @error('published_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Kartu Thumbnail --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Thumbnail</h3>
                <div class="space-y-2">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                        <img :src="thumbnailUrl" alt="Pratinjau Thumbnail" class="object-cover w-full h-full" x-show="thumbnailUrl">
                        <div x-show="!thumbnailUrl" class="text-slate-400 text-center">
                            <i class="fas fa-image fa-3x"></i>
                            <p class="mt-2 text-sm">Pratinjau Gambar</p>
                        </div>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail" class="sr-only" @change="thumbnailUrl = URL.createObjectURL($event.target.files[0])">
                    <label for="thumbnail" class="cursor-pointer mt-2 w-full inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($berita) && $berita->thumbnail ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                    </label>
                    <p class="text-xs text-center text-slate-500">Rekomendasi ukuran: 1200x630px.</p>
                    @error('thumbnail') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($berita) && $berita->id ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
    </button>
</div>