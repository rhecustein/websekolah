<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.sekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-6">
                        {{-- Form Fields --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="nama_sekolah" class="block text-sm font-medium text-slate-700">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('nama_sekolah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="jenjang" class="block text-sm font-medium text-slate-700">Jenjang Pendidikan</label>
                                <input type="text" name="jenjang" id="jenjang" value="{{ old('jenjang', $sekolah->jenjang) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('jenjang') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>{{ old('alamat', $sekolah->alamat) }}</textarea>
                            @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                             <div>
                                <label for="kota" class="block text-sm font-medium text-slate-700">Kota</label>
                                <input type="text" name="kota" id="kota" value="{{ old('kota', $sekolah->kota) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('kota') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="provinsi" class="block text-sm font-medium text-slate-700">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $sekolah->provinsi) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('provinsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                         <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                             <div>
                                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $sekolah->email) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="telepon" class="block text-sm font-medium text-slate-700">Telepon</label>
                                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $sekolah->telepon) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                @error('telepon') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6 pt-4 border-t md:grid-cols-2">
                           <div>
                                <label for="logo" class="block text-sm font-medium text-slate-700">Ganti Logo</label>
                                <div class="flex items-center mt-2 space-x-4">
                                    <img src="{{ Storage::url($sekolah->logo) }}" alt="Logo saat ini" class="w-20 h-20 p-1 border rounded-md object-contain">
                                    <input type="file" name="logo" id="logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                </div>
                                @error('logo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                           </div>
                            <div>
                                <label for="favicon" class="block text-sm font-medium text-slate-700">Ganti Favicon</label>
                                <div class="flex items-center mt-2 space-x-4">
                                    <img src="{{ Storage::url($sekolah->favicon) }}" alt="Favicon saat ini" class="w-10 h-10 p-1 border rounded-md object-contain">
                                    <input type="file" name="favicon" id="favicon" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                </div>
                                <p class="mt-1 text-xs text-slate-500">Gunakan format .ico atau .png</p>
                                @error('favicon') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                           </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.sekolah.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
