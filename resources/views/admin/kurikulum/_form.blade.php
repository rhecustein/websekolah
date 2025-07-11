@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#deskripsi',
                plugins: 'code table lists link fullscreen preview wordcount autolink',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | preview | fullscreen',
                height: 400,
            });
        });
    </script>
@endpush

{{-- 
  - Wrapper AlpineJS untuk state management (nama, slug).
  - Variabel $kurikulum di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        nama: '{{ old('nama_kurikulum', $kurikulum->nama_kurikulum ?? '') }}',
        slug: '{{ old('slug', $kurikulum->slug ?? '') }}',
        generateSlug() {
            this.slug = this.nama.toLowerCase().replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');
        }
    }"
    class="p-6 md:p-8"
>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Informasi Dasar --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                 <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Informasi Dasar</h3>
                 <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_kurikulum" class="block text-sm font-medium text-slate-700">Nama Kurikulum</label>
                            <input type="text" name="nama_kurikulum" id="nama_kurikulum" x-model="nama" @input="generateSlug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Kurikulum Merdeka" required>
                            @error('nama_kurikulum') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="jenjang" class="block text-sm font-medium text-slate-700">Jenjang</label>
                            <input type="text" name="jenjang" id="jenjang" value="{{ old('jenjang', $kurikulum->jenjang ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: SMA / Kelas X" required>
                            @error('jenjang') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                     <div>
                        <label for="slug" class="block text-sm font-medium text-slate-700">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" x-model="slug" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm bg-slate-50 text-slate-500 focus:ring-0 focus:border-slate-300" readonly>
                        <p class="mt-2 text-xs text-slate-500">Slug akan dibuat otomatis dari nama kurikulum.</p>
                        @error('slug') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                 </div>
            </div>

            {{-- Deskripsi Kurikulum (TinyMCE) --}}
            <div class="bg-white rounded-xl shadow-lg border">
                <div class="p-2 border-b border-slate-200">
                    <label for="deskripsi" class="px-4 text-sm font-medium text-slate-700">Deskripsi Kurikulum</label>
                </div>
                <div class="p-1">
                    <textarea name="deskripsi" id="deskripsi" class="hidden">{{ old('deskripsi', $kurikulum->deskripsi ?? '') }}</textarea>
                    @error('deskripsi') <p class="p-4 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: File Panduan --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">File Panduan</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="file_panduan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-cloud-upload-alt text-4xl text-slate-400"></i>
                                <p class="my-2 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span></p>
                                <p class="text-xs text-slate-500">PDF, DOC, DOCX (MAX. 5MB)</p>
                            </div>
                            <input id="file_panduan" name="file_panduan" type="file" class="hidden" />
                        </label>
                    </div> 
                    @error('file_panduan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                     @if(isset($kurikulum) && $kurikulum->file_panduan)
                        <div class="pt-2 text-sm text-slate-600">
                            <span class="font-semibold">File saat ini:</span> 
                            <a href="{{ Storage::url($kurikulum->file_panduan) }}" target="_blank" class="text-sky-600 hover:underline break-all">
                                {{ basename($kurikulum->file_panduan) }}
                            </a>
                            <p class="mt-1 text-xs text-slate-500">Unggah file baru untuk menggantinya.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.kurikulum.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($kurikulum) && $kurikulum->id ? 'Simpan Perubahan' : 'Simpan Kurikulum' }}
    </button>
</div>