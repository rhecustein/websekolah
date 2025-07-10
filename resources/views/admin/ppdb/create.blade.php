<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Tambah Pendaftar Baru (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 mb-6 text-sm text-yellow-700 bg-yellow-100 rounded-lg">
                <i class="mr-2 fas fa-exclamation-triangle"></i>
                Fitur ini hanya untuk keadaan darurat. Pendaftaran normal sebaiknya dilakukan melalui halaman PPDB frontend.
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.ppdb-admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">
                        <h3 class="text-lg font-medium text-slate-900">Data Diri Siswa</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                                @error('nama_lengkap') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-slate-700">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                                @error('tempat_lahir') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                                @error('tanggal_lahir') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="agama" class="block text-sm font-medium text-slate-700">Agama</label>
                                <input type="text" name="agama" id="agama" value="{{ old('agama') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm" required>
                                @error('agama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        {{-- Tambahkan field lain sesuai kebutuhan --}}
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.ppdb-admin.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700">
                            Simpan Pendaftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
