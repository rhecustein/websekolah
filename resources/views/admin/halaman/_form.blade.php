@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen preview wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link | preview | fullscreen',
                height: 500,
            });
        });
    </script>
@endpush

<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            {{-- Judul --}}
            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700">Judul Halaman</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $halaman->judul ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label for="konten" class="block text-sm font-medium text-slate-700">Konten</label>
                <textarea name="konten" id="konten" rows="15" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('konten', $halaman->konten ?? '') }}</textarea>
                @error('konten') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            {{-- Opsi Publikasi --}}
            <div class="p-4 bg-gray-50 rounded-lg border">
                <h3 class="text-lg font-medium">Publikasi</h3>
                <div class="mt-4 space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                            <option value="draft" @isset($halaman) {{ $halaman->status == 'draft' ? 'selected' : '' }} @endisset>Draft</option>
                            <option value="published" @isset($halaman) {{ $halaman->status == 'published' ? 'selected' : '' }} @endisset>Published</option>
                        </select>
                        @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            {{-- Opsi SEO --}}
            <div class="p-4 bg-gray-50 rounded-lg border">
                 <h3 class="text-lg font-medium">SEO (Opsional)</h3>
                 <div class="mt-4 space-y-4">
                     <div>
                        <label for="meta_title" class="block text-sm font-medium text-slate-700">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $halaman->meta_title ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                        <p class="mt-1 text-xs text-slate-500">Judul yang akan tampil di tab browser dan hasil pencarian Google.</p>
                        @error('meta_title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                     <div>
                        <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('meta_description', $halaman->meta_description ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-slate-500">Deskripsi singkat halaman untuk hasil pencarian Google.</p>
                        @error('meta_description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.halaman.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($halaman) ? 'Simpan Perubahan' : 'Simpan Halaman' }}
    </button>
</div>
