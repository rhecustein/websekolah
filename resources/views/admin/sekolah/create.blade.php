<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Tambah Informasi Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="p-4 mb-6 text-sm text-blue-700 bg-blue-100 rounded-lg">
                <i class="mr-2 fas fa-info-circle"></i>
                Anda sedang membuat data profil sekolah untuk pertama kalinya. Mohon isi semua informasi dengan lengkap.
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.sekolah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-6">
                        {{-- Form Fields --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="nama_sekolah" class="block text-sm font-medium text-slate-700">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('nama_sekolah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="jenjang" class="block text-sm font-medium text-slate-700">Jenjang Pendidikan</label>
                                <input type="text" name="jenjang" id="jenjang" value="{{ old('jenjang') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: Sekolah Menengah Atas" required>
                                @error('jenjang') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="3" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>{{ old('alamat') }}</textarea>
                            @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                             <div>
                                <label for="kota" class="block text-sm font-medium text-slate-700">Kota</label>
                                <input type="text" name="kota" id="kota" value="{{ old('kota') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('kota') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="provinsi" class="block text-sm font-medium text-slate-700">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('provinsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                         <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                             <div>
                                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                             <div>
                                <label for="telepon" class="block text-sm font-medium text-slate-700">Telepon</label>
                                <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                @error('telepon') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6 pt-4 border-t md:grid-cols-2">
                           <div>
                                <label for="logo" class="block text-sm font-medium text-slate-700">Logo</label>
                                <input type="file" name="logo" id="logo" class="block w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                @error('logo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                           </div>
                            <div>
                                <label for="favicon" class="block text-sm font-medium text-slate-700">Favicon</label>
                                <input type="file" name="favicon" id="favicon" class="block w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                <p class="mt-1 text-xs text-slate-500">Gunakan format .ico atau .png</p>
                                @error('favicon') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                           </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 bg-slate-50">
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Informasi Sekolah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
