<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Tambah Pendaftar Baru (Admin)
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Gunakan formulir ini untuk mendaftarkan calon siswa secara manual.
                </p>
            </div>
            <a href="{{ route('admin.ppdb-admin.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Manajemen Pendaftar
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        {{-- Pesan Peringatan --}}
        <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-r-lg shadow">
            <div class="flex">
                <div class="py-1"><i class="fas fa-exclamation-triangle mr-3"></i></div>
                <div>
                    <p class="font-bold">Perhatian!</p>
                    <p class="text-sm">Fitur ini ditujukan untuk pendaftaran manual oleh admin. Untuk pendaftaran normal, arahkan calon siswa ke halaman PPDB di website utama.</p>
                </div>
            </div>
        </div>

        {{-- Kontainer Form Wizard --}}
        <div class="bg-white rounded-xl shadow-lg">
            <form action="{{ route('admin.ppdb-admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div x-data="{ step: 1, totalSteps: 4 }">
                    {{-- START: Indikator Langkah (Wizard Steps) --}}
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex justify-between">
                            <template x-for="i in totalSteps" :key="i">
                                <div class="w-1/4">
                                    <div :class="{'bg-sky-600 text-white': step === i, 'bg-slate-200 text-slate-500': step > i, 'bg-white border-2 border-slate-300 text-slate-500': step < i}" class="w-10 h-10 mx-auto rounded-full text-lg flex items-center justify-center">
                                        <i x-show="step > i" class="fas fa-check"></i>
                                        <span x-show="step <= i" x-text="i"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    {{-- END: Indikator Langkah --}}

                    {{-- Isi Form per Langkah --}}
                    <div class="p-6 md:p-8">
                        {{-- =============================================== --}}
                        {{-- |    Langkah 1: Data Diri Calon Siswa         | --}}
                        {{-- =============================================== --}}
                        <div x-show="step === 1" class="space-y-6">
                            <h3 class="text-xl font-bold text-slate-800">1. Data Diri Calon Siswa</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                        <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
                                        <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-slate-700">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="agama" class="block text-sm font-medium text-slate-700">Agama</label>
                                    <input type="text" name="agama" id="agama" value="{{ old('agama', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="kewarganegaraan" class="block text-sm font-medium text-slate-700">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                            </div>
                        </div>

                        {{-- =============================================== --}}
                        {{-- |    Langkah 2: Alamat & Kontak               | --}}
                        {{-- =============================================== --}}
                        <div x-show="step === 2" x-cloak class="space-y-6">
                           <h3 class="text-xl font-bold text-slate-800">2. Alamat & Kontak</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="email_siswa" class="block text-sm font-medium text-slate-700">Email Siswa</label>
                                    <input type="email" name="email_siswa" id="email_siswa" value="{{ old('email_siswa', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="nomor_telepon_siswa" class="block text-sm font-medium text-slate-700">Nomor Telepon Siswa</label>
                                    <input type="tel" name="nomor_telepon_siswa" id="nomor_telepon_siswa" value="{{ old('nomor_telepon_siswa', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="alamat_lengkap" class="block text-sm font-medium text-slate-700">Alamat Lengkap</label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" rows="4" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>{{ old('alamat_lengkap', '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- =============================================== --}}
                        {{-- |    Langkah 3: Data Orang Tua / Wali         | --}}
                        {{-- =============================================== --}}
                        <div x-show="step === 3" x-cloak class="space-y-6">
                            <h3 class="text-xl font-bold text-slate-800">3. Data Orang Tua / Wali</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-medium text-slate-700">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-slate-700">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-medium text-slate-700">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-slate-700">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="nomor_telepon_orang_tua" class="block text-sm font-medium text-slate-700">Nomor Telepon Orang Tua/Wali</label>
                                    <input type="tel" name="nomor_telepon_orang_tua" id="nomor_telepon_orang_tua" value="{{ old('nomor_telepon_orang_tua', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm">
                                </div>
                            </div>
                        </div>

                        {{-- =============================================== --}}
                        {{-- |    Langkah 4: Informasi & Dokumen           | --}}
                        {{-- =============================================== --}}
                        <div x-show="step === 4" x-cloak class="space-y-6">
                             <h3 class="text-xl font-bold text-slate-800">4. Informasi Pendaftaran & Dokumen</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="jurusan_diminati" class="block text-sm font-medium text-slate-700">Jurusan Diminati</label>
                                    <input type="text" name="jurusan_diminati" id="jurusan_diminati" value="{{ old('jurusan_diminati', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="asal_sekolah" class="block text-sm font-medium text-slate-700">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah', '') }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                </div>
                                <div>
                                    <label for="status_pendaftaran" class="block text-sm font-medium text-slate-700">Status Awal</label>
                                    <select name="status_pendaftaran" id="status_pendaftaran" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm" required>
                                        <option value="pending" @selected(old('status_pendaftaran') == 'pending')>Pending</option>
                                        <option value="diverifikasi" @selected(old('status_pendaftaran') == 'diverifikasi')>Langsung Diverifikasi</option>
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="berkas_pendukung" class="block text-sm font-medium text-slate-700">Upload Berkas Pendukung (ZIP/RAR)</label>
                                    <input type="file" name="berkas_pendukung" id="berkas_pendukung" class="block w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Navigasi & Tombol Aksi --}}
                    <div class="flex items-center justify-between px-6 md:px-8 py-4 bg-slate-50 border-t border-slate-200 rounded-b-xl">
                        <button type="button" @click="step--" x-show="step > 1" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50">
                            Sebelumnya
                        </button>
                        <div x-show="step === 1"></div>
                        <button type="button" @click="step++" x-show="step < totalSteps" class="px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700">
                            Berikutnya
                        </button>
                        <button type="submit" x-show="step === totalSteps" class="px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-green-600 hover:bg-green-700">
                            Simpan Pendaftar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>