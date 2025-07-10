@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen preview wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link | preview | fullscreen',
                height: 500,
            });

            flatpickr("#published_at", {
                enableTime: false,
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush

<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            {{-- Judul --}}
            <div>
                <label for="judul" class="block text-sm font-medium text-slate-700">Judul Pengumuman</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $pengumuman->judul ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label for="konten" class="block text-sm font-medium text-slate-700">Isi Pengumuman</label>
                <textarea name="konten" id="konten" rows="15" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('konten', $pengumuman->konten ?? '') }}</textarea>
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
                            <option value="draft" @isset($pengumuman) {{ $pengumuman->status == 'draft' ? 'selected' : '' }} @endisset>Draft</option>
                            <option value="published" @isset($pengumuman) {{ $pengumuman->status == 'published' ? 'selected' : '' }} @endisset>Published</option>
                            <option value="archived" @isset($pengumuman) {{ $pengumuman->status == 'archived' ? 'selected' : '' }} @endisset>Archived</option>
                        </select>
                        @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                     <div>
                        <label for="published_at" class="block text-sm font-medium text-slate-700">Tanggal Publikasi</label>
                        <input type="text" name="published_at" id="published_at" value="{{ old('published_at', isset($pengumuman) ? ($pengumuman->published_at ? $pengumuman->published_at->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Pilih tanggal...">
                        <p class="mt-1 text-xs text-slate-500">Kosongkan jika statusnya draft.</p>
                        @error('published_at') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($pengumuman) ? 'Simpan Perubahan' : 'Simpan Pengumuman' }}
    </button>
</div>
