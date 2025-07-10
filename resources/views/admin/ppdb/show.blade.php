<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-slate-800">
                    Detail Pendaftar: <span class="text-sky-600">{{ $ppdbAdmin->nama_lengkap }}</span>
                </h2>
                <p class="mt-1 text-sm text-slate-600">No. Pendaftaran: {{ $ppdbAdmin->nomor_pendaftaran }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.ppdb-admin.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <i class="mr-2 fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.ppdb-admin.edit', $ppdbAdmin->id) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                    <i class="mr-2 fas fa-pencil-alt"></i> Edit Status
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Kolom Kiri: Detail Pendaftar -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- Data Diri -->
                    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-slate-900">Data Diri Siswa</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 mt-4 sm:grid-cols-2">
                            <div class="sm:col-span-2"><dt class="text-sm font-medium text-slate-500">Nama Lengkap</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->nama_lengkap }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Tempat, Tanggal Lahir</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->tempat_lahir }}, {{ \Carbon\Carbon::parse($ppdbAdmin->tanggal_lahir)->format('d F Y') }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Jenis Kelamin</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->jenis_kelamin }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Agama</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->agama }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Email</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->email_siswa }}</dd></div>
                            <div class="sm:col-span-2"><dt class="text-sm font-medium text-slate-500">Alamat</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->alamat }}</dd></div>
                        </dl>
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-slate-900">Data Orang Tua / Wali</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 mt-4 sm:grid-cols-2">
                            <div><dt class="text-sm font-medium text-slate-500">Nama Ayah</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->nama_ayah }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Pekerjaan Ayah</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->pekerjaan_ayah }}</dd></div>
                             <div><dt class="text-sm font-medium text-slate-500">Nama Ibu</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->nama_ibu }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Pekerjaan Ibu</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->pekerjaan_ibu }}</dd></div>
                            <div class="sm:col-span-2"><dt class="text-sm font-medium text-slate-500">No. HP Orang Tua</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->no_hp_orang_tua }}</dd></div>
                        </dl>
                    </div>
                </div>

                <!-- Kolom Kanan: Status & Dokumen -->
                <div class="space-y-6 lg:col-span-1">
                    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-slate-900">Status & Jurusan</h3>
                        <dl class="mt-4 space-y-4">
                            <div><dt class="text-sm font-medium text-slate-500">Status Pendaftaran</dt>
                                <dd class="mt-1">
                                     <span class="inline-flex px-2 text-sm font-semibold leading-5 rounded-full capitalize {{ str_replace('_', ' ', $ppdbAdmin->status_pendaftaran) }}
                                        @switch($ppdbAdmin->status_pendaftaran)
                                            @case('pending') bg-yellow-100 text-yellow-800 @break
                                            @case('diverifikasi') bg-blue-100 text-blue-800 @break
                                            @case('seleksi') bg-indigo-100 text-indigo-800 @break
                                            @case('lulus') bg-green-100 text-green-800 @break
                                            @case('tidak_lulus') bg-red-100 text-red-800 @break
                                            @case('daftar_ulang') bg-teal-100 text-teal-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch
                                    ">
                                        {{ str_replace('_', ' ', $ppdbAdmin->status_pendaftaran) }}
                                    </span>
                                </dd>
                            </div>
                            <div><dt class="text-sm font-medium text-slate-500">Jurusan Diminati</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->jurusan_diminati }}</dd></div>
                            <div><dt class="text-sm font-medium text-slate-500">Asal Sekolah</dt><dd class="mt-1 text-sm text-slate-900">{{ $ppdbAdmin->asal_sekolah }}</dd></div>
                        </dl>
                    </div>
                    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-slate-900">Dokumen Terlampir</h3>
                        <ul class="mt-4 space-y-2">
                            @if($ppdbAdmin->dokumen_kk)<li><a href="{{ Storage::url($ppdbAdmin->dokumen_kk) }}" target="_blank" class="text-sky-600 hover:underline">Kartu Keluarga</a></li>@endif
                            @if($ppdbAdmin->dokumen_akta_lahir)<li><a href="{{ Storage::url($ppdbAdmin->dokumen_akta_lahir) }}" target="_blank" class="text-sky-600 hover:underline">Akta Kelahiran</a></li>@endif
                            @if($ppdbAdmin->dokumen_ijazah_skl)<li><a href="{{ Storage::url($ppdbAdmin->dokumen_ijazah_skl) }}" target="_blank" class="text-sky-600 hover:underline">Ijazah/SKL</a></li>@endif
                            @if($ppdbAdmin->dokumen_foto_siswa)<li><a href="{{ Storage::url($ppdbAdmin->dokumen_foto_siswa) }}" target="_blank" class="text-sky-600 hover:underline">Foto Siswa</a></li>@endif
                        </ul>
                    </div>
                     <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-medium text-slate-900">Catatan Admin</h3>
                        <div class="mt-4 text-sm text-slate-600 prose-sm max-w-none">
                            {!! $ppdbAdmin->catatan_admin ? nl2br(e($ppdbAdmin->catatan_admin)) : '<p class="italic">Tidak ada catatan.</p>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
