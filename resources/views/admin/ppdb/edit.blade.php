<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Edit Pendaftar: <span class="text-sky-600">{{ $ppdbAdmin->nama_lengkap }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.ppdb-admin.update', $ppdbAdmin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $ppdbAdmin->nama_lengkap) }}" class="block w-full mt-1 bg-gray-100 border-slate-300 rounded-md shadow-sm sm:text-sm" readonly>
                        </div>

                        <div>
                            <label for="status_pendaftaran" class="block text-sm font-medium text-slate-700">Ubah Status Pendaftaran</label>
                            <select name="status_pendaftaran" id="status_pendaftaran" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                <option value="pending" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diverifikasi" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                <option value="seleksi" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'seleksi' ? 'selected' : '' }}>Seleksi</option>
                                <option value="lulus" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="tidak_lulus" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                <option value="daftar_ulang" {{ old('status_pendaftaran', $ppdbAdmin->status_pendaftaran) == 'daftar_ulang' ? 'selected' : '' }}>Daftar Ulang</option>
                            </select>
                            @error('status_pendaftaran') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="catatan_admin" class="block text-sm font-medium text-slate-700">Catatan Admin (Opsional)</label>
                            <textarea name="catatan_admin" id="catatan_admin" rows="4" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('catatan_admin', $ppdbAdmin->catatan_admin) }}</textarea>
                            <p class="mt-1 text-xs text-slate-500">Catatan ini akan terlihat oleh admin lain.</p>
                            @error('catatan_admin') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.ppdb-admin.show', $ppdbAdmin->id) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
