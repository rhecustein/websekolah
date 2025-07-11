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
                plugins: 'code table lists link fullscreen preview wordcount autolink',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | preview | fullscreen',
                height: 400,
            });

            flatpickr(".datepicker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                // Placeholder sekarang bisa diatur langsung di atribut input HTML
            });
        });
    </script>
@endpush

<div class="p-6 md:p-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Informasi Dasar --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Informasi Dasar</h3>
                <div class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-slate-700">Judul Informasi <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $informasiPpdb->judul ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Masukkan judul informasi" required>
                        @error('judul') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-medium text-slate-700">Tanggal Mulai (Opsional)</label>
                            <input type="text" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', isset($informasiPpdb) ? ($informasiPpdb->tanggal_mulai ? $informasiPpdb->tanggal_mulai->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm datepicker focus:ring-sky-500 focus:border-sky-500" placeholder="Pilih tanggal mulai...">
                            @error('tanggal_mulai') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="tanggal_akhir" class="block text-sm font-medium text-slate-700">Tanggal Akhir (Opsional)</label>
                            <input type="text" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir', isset($informasiPpdb) ? ($informasiPpdb->tanggal_akhir ? $informasiPpdb->tanggal_akhir->format('Y-m-d') : '') : '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm datepicker focus:ring-sky-500 focus:border-sky-500" placeholder="Pilih tanggal akhir...">
                            @error('tanggal_akhir') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten Informasi (TinyMCE) --}}
            <div class="bg-white rounded-xl shadow-lg border">
                {{-- Padding label TinyMCE diubah dari p-2 ke p-4 untuk konsistensi dengan p-6 card --}}
                <div class="p-4 border-b border-slate-200">
                    <label for="konten" class="text-sm font-medium text-slate-700">Konten Informasi <span class="text-red-500">*</span></label>
                </div>
                <div class="p-1">
                    <textarea name="konten" id="konten" class="hidden">{{ old('konten', $informasiPpdb->konten ?? '') }}</textarea>
                    @error('konten') <p class="p-4 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Status/Opsi Lain (Opsional, bisa ditambahkan di sini jika ada) --}}
        <div class="lg:col-span-1 space-y-6"> {{-- Menambahkan space-y-6 untuk konsistensi antar card --}}
            {{-- Contoh: Status Informasi --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Pengaturan Publikasi</h3>
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700">Status Publikasi</label>
                        <select name="status" id="status" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500">
                            {{-- Anda perlu memastikan $informasiPpdb->status tersedia atau memberikan default 'draft' --}}
                            <option value="draft" {{ (old('status', $informasiPpdb->status ?? 'draft') == 'draft') ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ (old('status', $informasiPpdb->status ?? 'draft') == 'published') ? 'selected' : '' }}>Dipublikasikan</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    {{-- Anda bisa menambahkan opsi lain di sini, seperti visibility, kategori, dll. --}}
                </div>
            </div>

            {{-- Contoh: Gambar Utama (Opsional, jika ada) --}}
            {{-- <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Gambar Utama</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="gambar_utama" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fas fa-image text-4xl text-slate-400"></i>
                                <p class="my-2 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span> atau seret & lepas</p>
                                <p class="text-xs text-slate-500">PNG, JPG, JPEG (MAX. 2MB)</p>
                            </div>
                            <input id="gambar_utama" name="gambar_utama" type="file" class="hidden" />
                        </label>
                    </div>
                    @error('gambar_utama') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if(isset($informasiPpdb) && $informasiPpdb->gambar_utama)
                        <div class="pt-2 text-sm text-slate-600">
                            <span class="font-semibold">Gambar saat ini:</span>
                            <img src="{{ Storage::url($informasiPpdb->gambar_utama) }}" alt="Gambar Utama" class="mt-2 max-h-32 object-contain rounded-lg">
                            <p class="mt-1 text-xs text-slate-500">Unggah gambar baru untuk menggantinya.</p>
                        </div>
                    @endif
                </div>
            </div> --}}
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.informasi-ppdb.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($informasiPpdb) ? 'Simpan Perubahan' : 'Simpan Informasi' }}
    </button>
</div>