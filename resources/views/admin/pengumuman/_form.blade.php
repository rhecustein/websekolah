@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> {{-- Bahasa Indonesia untuk Kalender --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Flatpickr
            flatpickr("#published_at", {
                enableTime: false,
                dateFormat: "Y-m-d",
                locale: "id", // Menggunakan bahasa Indonesia
            });

            // Inisialisasi TinyMCE
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen preview wordcount autolink',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link | preview | fullscreen',
                height: 500,
            });
        });
    </script>
@endpush

{{-- 
  - Wrapper AlpineJS untuk state management judul.
  - Variabel $pengumuman di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{ judul: '{{ old('judul', $pengumuman->judul ?? '') }}' }"
    class="p-6 md:p-8"
>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        {{-- Kolom Kiri: Editor Utama --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Judul --}}
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <label for="judul" class="block text-sm font-medium text-slate-700">Judul Pengumuman</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    x-model="judul"
                    class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 text-lg" 
                    placeholder="Judul pengumuman yang jelas..." 
                    required
                >
                @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- Konten (TinyMCE) --}}
            <div class="bg-white rounded-xl shadow-lg">
                <div class="p-2 border-b border-slate-200">
                    <label for="konten" class="px-4 text-sm font-medium text-slate-700">Isi Pengumuman</label>
                </div>
                <div class="p-1">
                    <textarea name="konten" id="konten" class="hidden">{{ old('konten', $pengumuman->konten ?? '') }}</textarea>
                    @error('konten') <p class="p-4 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar Pengaturan --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Pengaturan Publikasi</h3>
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                            <option value="draft" @selected(old('status', $pengumuman->status ?? 'draft') == 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $pengumuman->status ?? '') == 'published')>Published</option>
                            <option value="archived" @selected(old('status', $pengumuman->status ?? '') == 'archived')>Archived</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="published_at" class="block text-sm font-medium text-slate-700">Tanggal Publikasi</label>
                        <div class="relative mt-1">
                             <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-slate-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="published_at" 
                                id="published_at" 
                                value="{{ old('published_at', isset($pengumuman) ? ($pengumuman->published_at ? $pengumuman->published_at->format('Y-m-d') : '') : '') }}" 
                                class="block w-full pl-10 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" 
                                placeholder="Pilih tanggal..."
                            >
                        </div>
                        <p class="mt-2 text-xs text-slate-500">Kosongkan jika statusnya adalah Draft.</p>
                        @error('published_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($pengumuman) && $pengumuman->id ? 'Simpan Perubahan' : 'Simpan Pengumuman' }}
    </button>
</div>