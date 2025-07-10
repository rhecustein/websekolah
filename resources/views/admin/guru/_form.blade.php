<div class="p-6 space-y-6">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Kolom Kiri --}}
        <div class="space-y-6 lg:col-span-2">
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $guru->nama_lengkap ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                @error('nama_lengkap') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="nip" class="block text-sm font-medium text-slate-700">NIP (Opsional)</label>
                    <input type="text" name="nip" id="nip" value="{{ old('nip', $guru->nip ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                    @error('nip') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                        <option value="Laki-laki" @isset($guru) {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }} @endisset>Laki-laki</option>
                        <option value="Perempuan" @isset($guru) {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }} @endisset>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-slate-700">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $guru->jabatan ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                    @error('jabatan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="bidang_studi" class="block text-sm font-medium text-slate-700">Bidang Studi (Opsional)</label>
                    <input type="text" name="bidang_studi" id="bidang_studi" value="{{ old('bidang_studi', $guru->bidang_studi ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                    @error('bidang_studi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
             <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email (Opsional)</label>
                <input type="email" name="email" id="email" value="{{ old('email', $guru->email ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="lg:col-span-1">
            <label for="foto" class="block text-sm font-medium text-slate-700">Foto Guru</label>
            <div class="flex items-center mt-2 space-x-4">
                <img id="foto-preview" src="{{ isset($guru) && $guru->foto ? Storage::url($guru->foto) : 'https://ui-avatars.com/api/?name='.(isset($guru) ? urlencode($guru->nama_lengkap) : 'G').'&size=128&color=7F9CF5&background=EBF4FF' }}" alt="Foto preview" class="w-24 h-24 rounded-full object-cover">
                <input type="file" name="foto" id="foto" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" onchange="document.getElementById('foto-preview').src = window.URL.createObjectURL(this.files[0])">
            </div>
            @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
<div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
    <a href="{{ route('admin.guru.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($guru) ? 'Simpan Perubahan' : 'Simpan Data Guru' }}
    </button>
</div>
