@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#deskripsi',
                plugins: 'code table lists link fullscreen preview wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | preview | fullscreen',
                height: 400,
            });
        });
    </script>
@endpush

<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <label for="nama_kurikulum" class="block text-sm font-medium text-slate-700">Nama Kurikulum</label>
            <input type="text" name="nama_kurikulum" id="nama_kurikulum" value="{{ old('nama_kurikulum', $kurikulum->nama_kurikulum ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
            @error('nama_kurikulum') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="jenjang" class="block text-sm font-medium text-slate-700">Jenjang</label>
            <input type="text" name="jenjang" id="jenjang" value="{{ old('jenjang', $kurikulum->jenjang ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: SMA / Kelas X" required>
            @error('jenjang') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
    
    <div>
        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" id="deskripsi" rows="10" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $kurikulum->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="file_panduan" class="block text-sm font-medium text-slate-700">File Panduan (PDF/DOC, Opsional)</label>
        <input type="file" name="file_panduan" id="file_panduan" class="block w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
        @isset($kurikulum->file_panduan)
            <p class="mt-2 text-xs text-slate-500">File saat ini: <a href="{{ Storage::url($kurikulum->file_panduan) }}" target="_blank" class="text-sky-600 hover:underline">Lihat File</a>. Unggah file baru untuk mengganti.</p>
        @endisset
        @error('file_panduan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.kurikulum.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($kurikulum) ? 'Simpan Perubahan' : 'Simpan Kurikulum' }}
    </button>
</div>
