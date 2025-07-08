@extends('layouts.public') {{-- Asumsi Anda memiliki layout utama bernama 'app.blade.php' --}}

@section('title', 'Pendaftaran PPDB Online') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Formulir Pendaftaran PPDB Online</h1>

    <p class="text-lg text-gray-700 mb-8 text-center">
        Isi formulir di bawah ini dengan lengkap dan benar. Pastikan semua dokumen yang diperlukan telah disiapkan.
    </p>

    {{-- Notifikasi Error/Sukses --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan inputan Anda.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.daftar.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf

        {{-- Bagian Data Calon Siswa --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Data Calon Siswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_lengkap') border-red-500 @enderror" required>
                @error('nama_lengkap')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_kelamin') border-red-500 @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="tempat_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tempat_lahir') border-red-500 @enderror" required>
                @error('tempat_lahir')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="tanggal_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_lahir') border-red-500 @enderror" required>
                @error('tanggal_lahir')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="agama" class="block text-gray-700 text-sm font-bold mb-2">Agama <span class="text-red-500">*</span></label>
                <input type="text" id="agama" name="agama" value="{{ old('agama') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('agama') border-red-500 @enderror" required>
                @error('agama')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="asal_sekolah_sebelumnya" class="block text-gray-700 text-sm font-bold mb-2">Asal Sekolah Sebelumnya <span class="text-red-500">*</span></label>
                <input type="text" id="asal_sekolah_sebelumnya" name="asal_sekolah_sebelumnya" value="{{ old('asal_sekolah_sebelumnya') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('asal_sekolah_sebelumnya') border-red-500 @enderror" required>
                @error('asal_sekolah_sebelumnya')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="jurusan_diminati" class="block text-gray-700 text-sm font-bold mb-2">Jurusan Diminati (Opsional)</label>
                <input type="text" id="jurusan_diminati" name="jurusan_diminati" value="{{ old('jurusan_diminati') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jurusan_diminati') border-red-500 @enderror">
                @error('jurusan_diminati')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="telepon_siswa" class="block text-gray-700 text-sm font-bold mb-2">Telepon Siswa (Opsional)</label>
                <input type="text" id="telepon_siswa" name="telepon_siswa" value="{{ old('telepon_siswa') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telepon_siswa') border-red-500 @enderror">
                @error('telepon_siswa')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="email_siswa" class="block text-gray-700 text-sm font-bold mb-2">Email Siswa (Opsional)</label>
                <input type="email" id="email_siswa" name="email_siswa" value="{{ old('email_siswa') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email_siswa') border-red-500 @enderror">
                @error('email_siswa')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="md:col-span-2">
                <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror" required>{{ old('alamat') }}</textarea>
                @error('alamat')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Bagian Data Orang Tua --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Data Orang Tua / Wali</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="nama_ayah" class="block text-gray-700 text-sm font-bold mb-2">Nama Ayah <span class="text-red-500">*</span></label>
                <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_ayah') border-red-500 @enderror" required>
                @error('nama_ayah')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="pekerjaan_ayah" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Ayah (Opsional)</label>
                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pekerjaan_ayah') border-red-500 @enderror">
                @error('pekerjaan_ayah')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="telepon_ayah" class="block text-gray-700 text-sm font-bold mb-2">Telepon Ayah <span class="text-red-500">*</span></label>
                <input type="text" id="telepon_ayah" name="telepon_ayah" value="{{ old('telepon_ayah') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telepon_ayah') border-red-500 @enderror" required>
                @error('telepon_ayah')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="nama_ibu" class="block text-gray-700 text-sm font-bold mb-2">Nama Ibu <span class="text-red-500">*</span></label>
                <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_ibu') border-red-500 @enderror" required>
                @error('nama_ibu')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="pekerjaan_ibu" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Ibu (Opsional)</label>
                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pekerjaan_ibu') border-red-500 @enderror">
                @error('pekerjaan_ibu')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="telepon_ibu" class="block text-gray-700 text-sm font-bold mb-2">Telepon Ibu <span class="text-red-500">*</span></label>
                <input type="text" id="telepon_ibu" name="telepon_ibu" value="{{ old('telepon_ibu') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telepon_ibu') border-red-500 @enderror" required>
                @error('telepon_ibu')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Bagian Unggah Dokumen --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Unggah Dokumen Pendukung</h2>
        <p class="text-gray-600 text-sm mb-4">
            Ukuran maksimal file: PDF/JPG/JPEG/PNG 2MB (untuk KK, Akta, Ijazah/SKL), JPG/JPEG/PNG 1MB (untuk Foto Siswa).
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="dokumen_kk" class="block text-gray-700 text-sm font-bold mb-2">Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                <input type="file" id="dokumen_kk" name="dokumen_kk"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dokumen_kk') border-red-500 @enderror" required>
                @error('dokumen_kk')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="dokumen_akta_lahir" class="block text-gray-700 text-sm font-bold mb-2">Akta Kelahiran <span class="text-red-500">*</span></label>
                <input type="file" id="dokumen_akta_lahir" name="dokumen_akta_lahir"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dokumen_akta_lahir') border-red-500 @enderror" required>
                @error('dokumen_akta_lahir')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="dokumen_ijazah_skl" class="block text-gray-700 text-sm font-bold mb-2">Ijazah / SKL Terakhir <span class="text-red-500">*</span></label>
                <input type="file" id="dokumen_ijazah_skl" name="dokumen_ijazah_skl"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dokumen_ijazah_skl') border-red-500 @enderror" required>
                @error('dokumen_ijazah_skl')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="dokumen_foto_siswa" class="block text-gray-700 text-sm font-bold mb-2">Foto Siswa (Pas Foto) <span class="text-red-500">*</span></label>
                <input type="file" id="dokumen_foto_siswa" name="dokumen_foto_siswa" accept="image/jpeg,image/png"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('dokumen_foto_siswa') border-red-500 @enderror" required>
                @error('dokumen_foto_siswa')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="flex items-center justify-center mt-10">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                Daftar Sekarang
            </button>
        </div>
    </form>

</div>
@endsection