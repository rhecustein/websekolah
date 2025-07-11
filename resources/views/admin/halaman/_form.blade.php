{{-- ================================================================= --}}
{{-- |  KOMPONEN FORM HALAMAN (untuk create & edit)                  | --}}
{{-- |  File ini bisa disimpan sebagai:                              | --}}
{{-- |  resources/views/admin/halaman/_form.blade.php                | --}}
{{-- ================================================================= --}}

@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen media wordcount preview searchreplace autolink',
                toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image media link | fullscreen preview',
                height: 500,
                // Opsi untuk upload gambar dari dalam editor
                images_upload_url: '{{ route("admin.berita.upload-image") }}', // Bisa pakai route yang sama dengan berita
                images_upload_credentials: true,
                file_picker_types: 'image',
            });
        });
    </script>
@endpush

{{-- 
  - Wrapper AlpineJS untuk state management (judul, slug).
  - Variabel $halaman di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        judul: '{{ old('judul', $halaman->judul ?? '') }}',
        slug: '{{ old('slug', $halaman->slug ?? '') }}',
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
                        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Halaman</label>
                        <input type="text" name="judul" id="judul" x-model="judul" @input="generateSlug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 text-lg" placeholder="Contoh: Visi & Misi Sekolah" required>
                        @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-slate-400">/halaman/</span>
                            <input type="text" name="slug" id="slug" x-model="slug" class="block w-full pl-20 border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300" readonly>
                        </div>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Konten (TinyMCE) --}}
            <div class="bg-white rounded-xl shadow-lg">
                <div class="p-2 border-b border-slate-200">
                    <label for="konten" class="px-4 text-sm font-medium text-slate-700">Konten Halaman</label>
                </div>
                <div class="p-1">
                    <textarea name="konten" id="konten" class="hidden">{{ old('konten', $halaman->konten ?? '') }}</textarea>
                    @error('konten') <p class="p-4 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar Pengaturan --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Kartu Publikasi --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Publikasi</h3>
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                            <option value="draft" @selected(old('status', $halaman->status ?? 'draft') == 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $halaman->status ?? '') == 'published')>Published</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Kartu SEO (Opsional) --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                 <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">SEO (Opsional)</h3>
                 <div class="space-y-4">
                       <div>
                            <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $halaman->meta_title ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">
                            <p class="mt-2 text-xs text-slate-500">Judul yang akan tampil di tab browser & hasil pencarian.</p>
                            @error('meta_title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                       </div>
                       <div>
                            <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">{{ old('meta_description', $halaman->meta_description ?? '') }}</textarea>
                            <p class="mt-2 text-xs text-slate-500">Deskripsi singkat untuk hasil pencarian Google.</p>
                            @error('meta_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                       </div>
                 </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.halaman.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($halaman) && $halaman->id ? 'Simpan Perubahan' : 'Simpan Halaman' }}
    </button>
</div>