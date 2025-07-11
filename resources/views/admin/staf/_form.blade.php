{{-- 
  - Wrapper AlpineJS untuk state management pratinjau foto.
  - Variabel $staf di-pass dari view create (null) atau edit (model).
--}}
<div 
    x-data="{
        photoUrl: '{{ isset($staf) && $staf->foto ? Storage::url($staf->foto) : 'https://ui-avatars.com/api/?name='.(isset($staf) ? urlencode($staf->nama_lengkap) : 'S').'&size=128&color=7F9CF5&background=EBF4FF' }}',
        updatePreview(event) {
            const file = event.target.files[0];
            if (file) {
                this.photoUrl = URL.createObjectURL(file);
            }
        }
    }"
    class="p-6 md:p-8"
>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Informasi Staf --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Bagian Data Personal --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Data Personal Staf</h3>
                <div class="space-y-4">
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $staf->nama_lengkap ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Masukkan nama lengkap..." required>
                        @error('nama_lengkap') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nip" class="block text-sm font-medium text-slate-700">NIP (Opsional)</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip', $staf->nip ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Nomor Induk Pegawai...">
                            @error('nip') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                                <option value="Laki-laki" @selected(old('jenis_kelamin', $staf->jenis_kelamin ?? '') == 'Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(old('jenis_kelamin', $staf->jenis_kelamin ?? '') == 'Perempuan')>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Jabatan & Kontak --}}
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                 <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Informasi Jabatan & Kontak</h3>
                 <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-slate-700">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $staf->jabatan ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Contoh: Staf Tata Usaha" required>
                            @error('jabatan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                         <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email (Opsional)</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $staf->email ?? '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" placeholder="contoh@sekolah.sch.id">
                            @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Foto Profil --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white rounded-xl shadow-lg border">
                <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Foto Profil</h3>
                <div class="flex flex-col items-center space-y-4">
                    <div class="relative">
                        <img :src="photoUrl" alt="Foto preview" class="w-32 h-32 rounded-full object-cover ring-4 ring-slate-200">
                         <div class="absolute bottom-0 right-0 -mr-1 -mb-1 p-2 bg-sky-600 rounded-full hover:bg-sky-700">
                             <label for="foto" class="cursor-pointer text-white">
                                 <i class="fas fa-camera"></i>
                                 <input type="file" name="foto" id="foto" class="sr-only" @change="updatePreview">
                             </label>
                         </div>
                    </div>
                    <p class="text-xs text-center text-slate-500">Klik ikon kamera untuk mengganti foto.</p>
                    @error('foto') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Form Aksi --}}
<div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-white border-t border-slate-200 rounded-b-xl shadow-lg mt-6">
    <a href="{{ route('admin.staf.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        {{ isset($staf) && $staf->id ? 'Simpan Perubahan' : 'Simpan Data Staf' }}
    </button>
</div>