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
            }
        });
    });
</script>
@endpush

<div class="p-6 space-y-6">
    <div>
        <label for="pendaftar_ppdb_id" class="block text-sm font-medium text-slate-700">Pendaftar</label>
        <select name="pendaftar_ppdb_id" id="pendaftar_ppdb_id" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
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
        @error('pendaftar_ppdb_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <label for="jenis_pembayaran" class="block text-sm font-medium text-slate-700">Jenis Pembayaran</label>
            <input type="text" name="jenis_pembayaran" id="jenis_pembayaran" value="{{ old('jenis_pembayaran', $pembayaranPpdb->jenis_pembayaran ?? 'Formulir Pendaftaran') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
            @error('jenis_pembayaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="jumlah_bayar" class="block text-sm font-medium text-slate-700">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" value="{{ old('jumlah_bayar', $pembayaranPpdb->jumlah_bayar ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required placeholder="Contoh: 150000">
            @error('jumlah_bayar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
    
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <label for="metode_pembayaran" class="block text-sm font-medium text-slate-700">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" id="metode_pembayaran" value="{{ old('metode_pembayaran', $pembayaranPpdb->metode_pembayaran ?? 'Transfer Bank') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm">
            @error('metode_pembayaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="status_pembayaran" class="block text-sm font-medium text-slate-700">Status Pembayaran</label>
            <select name="status_pembayaran" id="status_pembayaran" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                <option value="pending" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'pending' ? 'selected' : '' }} @endisset>Pending</option>
                <option value="terverifikasi" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'terverifikasi' ? 'selected' : '' }} @endisset>Terverifikasi</option>
                <option value="ditolak" @isset($pembayaranPpdb) {{ $pembayaranPpdb->status_pembayaran == 'ditolak' ? 'selected' : '' }} @endisset>Ditolak</option>
            </select>
            @error('status_pembayaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="bukti_pembayaran" class="block text-sm font-medium text-slate-700">Bukti Pembayaran (Opsional)</label>
        @isset($pembayaranPpdb->bukti_pembayaran)
            <div class="mt-2">
                <a href="{{ Storage::url($pembayaranPpdb->bukti_pembayaran) }}" target="_blank">
                    <img src="{{ Storage::url($pembayaranPpdb->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="object-contain h-40 border rounded-md">
                </a>
            </div>
        @endisset
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="block w-full mt-2 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
        @error('bukti_pembayaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.pembayaran-ppdb.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700">
        {{ isset($pembayaranPpdb) ? 'Simpan Perubahan' : 'Simpan Pembayaran' }}
    </button>
</div>
