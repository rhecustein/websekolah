{{-- Untuk dropdown pencarian, disarankan menggunakan library seperti Tom Select --}}
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect("#pendaftar_ppdb_id",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            // Menyesuaikan class Tom Select agar serasi dengan input lain
            controlInput: '<input type="text" autocomplete="off" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">',
            plugins: {
                clear_button: {
                    title: 'Hapus pilihan',
                }
            }
        });
    });
</script>
@endpush

<div class="p-6 md:p-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Informasi Utama Pembayaran --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Informasi Pendaftar & Pembayaran --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Detail Pembayaran</h3>
                <div class="space-y-4">
                    <div>
                        <label for="pendaftar_ppdb_id" class="block text-sm font-medium text-slate-700">Pendaftar <span class="text-red-500">*</span></label>
                        {{-- TomSelect akan mengubah tampilan select ini, pastikan class dasar tetap ada --}}
                        <select name="pendaftar_ppdb_id" id="pendaftar_ppdb_id" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                            <option value="">Pilih Pendaftar...</option>
                            @foreach ($pendaftar as $item)
                                <option value="{{ $item->id }}"
                                    {{-- Logika untuk selected di create dan edit --}}
                                    @if(isset($selectedPendaftar) && $selectedPendaftar->id == $item->id) selected @endif
                                    @if(isset($pembayaranPpdb) && $pembayaranPpdb->pendaftar_ppdb_id == $item->id) selected @endif
                                >
                                    {{ $item->nama_lengkap }} ({{ $item->nomor_pendaftaran }})
                                </option>
                            @endforeach
                        </select>
                        @error('pendaftar_ppdb_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="jenis_pembayaran" class="block text-sm font-medium text-slate-700">Jenis Pembayaran <span class="text-red-500">*</span></label>
                            <input type="text" name="jenis_pembayaran" id="jenis_pembayaran" value="{{ old('jenis_pembayaran', $pembayaranPpdb->jenis_pembayaran ?? 'Formulir Pendaftaran') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Formulir Pendaftaran" required>
                            @error('jenis_pembayaran') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="jumlah_bayar" class="block text-sm font-medium text-slate-700">Jumlah Bayar <span class="text-red-500">*</span></label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" value="{{ old('jumlah_bayar', $pembayaranPpdb->jumlah_bayar ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: 150000" required>
                            @error('jumlah_bayar') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="metode_pembayaran" class="block text-sm font-medium text-slate-700">Metode Pembayaran</label>
                            <input type="text" name="metode_pembayaran" id="metode_pembayaran" value="{{ old('metode_pembayaran', $pembayaranPpdb->metode_pembayaran ?? 'Transfer Bank') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Transfer Bank / Tunai">
                            @error('metode_pembayaran') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="status_pembayaran" class="block text-sm font-medium text-slate-700">Status Pembayaran <span class="text-red-500">*</span></label>
                            <select name="status_pembayaran" id="status_pembayaran" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                <option value="pending" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'pending' ? 'selected' : '' }} @endisset>Pending</option>
                                <option value="terverifikasi" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'terverifikasi' ? 'selected' : '' }} @endisset>Terverifikasi</option>
                                <option value="ditolak" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'ditolak' ? 'selected' : '' }} @endisset>Ditolak</option>
                            </select>
                            @error('status_pembayaran') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Bukti Pembayaran --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Bukti Pembayaran</h3>
                <div class="space-y-4">
                    <div>
                        <label for="bukti_pembayaran" class="block text-sm font-medium text-slate-700 mb-2">Upload Bukti (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="bukti_pembayaran" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-slate-400"></i>
                                    <p class="my-2 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span></p>
                                    <p class="text-xs text-slate-500">JPG, PNG, PDF (MAX. 5MB)</p>
                                </div>
                                <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="hidden" />
                            </label>
                        </div>
                        @error('bukti_pembayaran') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    @if(isset($pembayaranPpdb->bukti_pembayaran) && $pembayaranPpdb->bukti_pembayaran)
                        <div class="border-t border-slate-200 pt-4 mt-4">
                            <p class="text-sm font-medium text-slate-700 mb-2">File saat ini:</p>
                            @php
                                $filePath = $pembayaranPpdb->bukti_pembayaran;
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                            @endphp

                            @if($isImage)
                                <a href="{{ Storage::url($filePath) }}" target="_blank" class="block relative group">
                                    <img src="{{ Storage::url($filePath) }}" alt="Bukti Pembayaran" class="object-cover w-full h-40 rounded-lg border border-slate-300 shadow-sm transition-all duration-200 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg">
                                        <i class="fas fa-expand text-white text-2xl"></i>
                                    </div>
                                </a>
                            @else
                                <a href="{{ Storage::url($filePath) }}" target="_blank" class="flex items-center space-x-2 text-sky-600 hover:underline">
                                    <i class="fas fa-file-alt text-xl"></i>
                                    <span class="text-sm break-all">{{ basename($filePath) }}</span>
                                </a>
                            @endif
                            <p class="mt-2 text-xs text-slate-500">Unggah file baru untuk mengganti yang sudah ada.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.pembayaran-ppdb.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($pembayaranPpdb) ? 'Simpan Perubahan' : 'Simpan Pembayaran' }}
    </button>
</div>