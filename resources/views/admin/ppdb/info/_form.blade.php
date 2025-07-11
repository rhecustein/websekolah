@push('scripts')
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- Flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: 'textarea#konten',
                plugins: 'code table lists link fullscreen preview wordcount',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | preview | fullscreen',
                height: 400,
            });

            flatpickr(".datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush

<div class="p-6 space-y-6">
    <div>
        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Informasi</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $informasiPpdb->judul ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
        @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <label for="tanggal_mulai" class="block text-sm font-medium text-slate-700">Tanggal Mulai (Opsional)</label>
            <input type="text" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', isset($informasiPpdb) ? ($informasiPpdb->tanggal_mulai ? $informasiPpdb->tanggal_mulai->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm datepicker focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Pilih tanggal mulai...">
            @error('tanggal_mulai') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="tanggal_akhir" class="block text-sm font-medium text-slate-700">Tanggal Akhir (Opsional)</label>
            <input type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', isset($informasiPpdb) ? ($informasiPpdb->tanggal_akhir ? $informasiPpdb->tanggal_akhir->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm datepicker focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Pilih tanggal akhir...">
            @error('tanggal_akhir') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="konten" class="block text-sm font-medium text-slate-700">Konten Informasi</label>
        <textarea name="konten" id="konten" rows="10" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('konten', $informasiPpdb->konten ?? '') }}</textarea>
        @error('konten') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.informasi-ppdb.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($informasiPpdb) ? 'Simpan Perubahan' : 'Simpan Informasi' }}
    </button>
</div>
