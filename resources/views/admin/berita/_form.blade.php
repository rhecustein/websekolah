@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi TinyMCE
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists image link fullscreen',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link | fullscreen',
                height: 400,
            });

            // Inisialisasi Flatpickr
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
                <label for="judul" class="block text-sm font-medium text-slate-700">Judul Berita</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Konten --}}
            <div>
                <label for="konten" class="block text-sm font-medium text-slate-700">Konten</label>
                <textarea name="konten" id="konten" rows="10" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('konten', $berita->konten ?? '') }}</textarea>
                @error('konten') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            {{-- Kategori --}}
            <div>
                <label for="kategori_berita_id" class="block text-sm font-medium text-slate-700">Kategori</label>
                <select name="kategori_berita_id" id="kategori_berita_id" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @isset($berita) {{ $berita->kategori_berita_id == $kategori->id ? 'selected' : '' }} @endisset>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_berita_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                    <option value="draft" @isset($berita) {{ $berita->status == 'draft' ? 'selected' : '' }} @endisset>Draft</option>
                    <option value="published" @isset($berita) {{ $berita->status == 'published' ? 'selected' : '' }} @endisset>Published</option>
                    <option value="archived" @isset($berita) {{ $berita->status == 'archived' ? 'selected' : '' }} @endisset>Archived</option>
                </select>
                @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            
            {{-- Tanggal Publikasi --}}
            <div>
                <label for="published_at" class="block text-sm font-medium text-slate-700">Tanggal Publikasi</label>
                <input type="text" name="published_at" id="published_at" value="{{ old('published_at', isset($berita) ? ($berita->published_at ? $berita->published_at->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Pilih tanggal...">
                <p class="mt-1 text-xs text-slate-500">Kosongkan untuk tidak mempublikasikan.</p>
                @error('published_at') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Thumbnail --}}
            <div>
                <label for="thumbnail" class="block text-sm font-medium text-slate-700">Thumbnail</label>
                @isset($berita->thumbnail)
                    <div class="mt-2">
                        <img src="{{ Storage::url($berita->thumbnail) }}" alt="Thumbnail saat ini" class="w-full h-auto rounded-md">
                    </div>
                @endisset
                <input type="file" name="thumbnail" id="thumbnail" class="block w-full mt-2 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                @error('thumbnail') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($berita) ? 'Simpan Perubahan' : 'Simpan Berita' }}
    </button>
</div>
