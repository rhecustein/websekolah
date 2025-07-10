<div class="p-6 space-y-6">
    <div>
        <label for="nama" class="block text-sm font-medium text-slate-700">Nama Dokumen</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $dokuman->nama ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
        @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" id="deskripsi" rows="3" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('deskripsi', $dokuman->deskripsi ?? '') }}</textarea>
        @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="file" class="block text-sm font-medium text-slate-700">{{ isset($dokuman) ? 'Ganti File' : 'File Dokumen' }}</label>
        <input type="file" name="file" id="file" class="block w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" {{ isset($dokuman) ? '' : 'required' }}>
        @isset($dokuman->path)
            <p class="mt-2 text-xs text-slate-500">File saat ini: <a href="{{ Storage::url($dokuman->path) }}" target="_blank" class="text-sky-600 hover:underline">{{ basename($dokuman->path) }}</a>. Unggah file baru untuk mengganti.</p>
        @endisset
        <p class="mt-1 text-xs text-slate-500">Tipe file yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maks: 10MB.</p>
        @error('file') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.dokumen.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($dokuman) ? 'Simpan Perubahan' : 'Simpan Dokumen' }}
    </button>
</div>
