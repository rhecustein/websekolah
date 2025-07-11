<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Pengaturan Situs & Profil Sekolah') }}
            </h2>
            <a href="{{ route('admin.sekolah.edit', $sekolah) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                <i class="mr-2 -ml-1 fas fa-pencil-alt"></i>
                Edit Informasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Kolom Utama (Kiri) -->
                <div class="space-y-8 lg:col-span-2">
                    
                    <!-- Hero Section -->
                    <div class="relative overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        @if($sekolah->foto_sekolah)
                            <img src="{{ asset('storage/' . $sekolah->foto_sekolah) }}" alt="Foto Sekolah" class="object-cover w-full h-64">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        @else
                            <div class="flex items-center justify-center w-full h-64 bg-slate-200 sm:rounded-t-lg">
                                <span class="text-slate-500">Foto utama belum diunggah</span>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 p-6">
                            <h3 class="text-3xl font-bold text-white drop-shadow-lg">{{ $sekolah->nama_sekolah }}</h3>
                            <p class="mt-1 text-base text-slate-200">{{ $sekolah->jenjang }}</p>
                        </div>
                    </div>

                    <!-- Deskripsi, Visi, & Misi -->
                    <div class="p-6 overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        <div class="space-y-8">
                            <div>
                                <h4 class="text-lg font-semibold text-slate-800">Deskripsi</h4>
                                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $sekolah->deskripsi ?? 'Deskripsi sekolah belum diatur.' }}</p>
                            </div>
                            <div class="pt-6 border-t border-slate-200">
                                <h4 class="text-lg font-semibold text-slate-800">Visi</h4>
                                <div class="mt-2 text-sm prose max-w-none text-slate-600">
                                    {!! $sekolah->visi ?? '<p>Visi belum diatur.</p>' !!}
                                </div>
                            </div>
                            <div class="pt-6 border-t border-slate-200">
                                <h4 class="text-lg font-semibold text-slate-800">Misi</h4>
                                <div class="mt-2 text-sm prose max-w-none text-slate-600">
                                     {!! $sekolah->misi ?? '<p>Misi belum diatur.</p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Sidebar (Kanan) -->
                <div class="space-y-8">
                    <!-- Branding -->
                    <div class="p-6 overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        <h4 class="text-lg font-semibold text-slate-800">Branding & Aset Visual</h4>
                        <div class="mt-6 space-y-6">
                            <div>
                                <h5 class="text-sm font-medium text-slate-600">Logo</h5>
                                <div class="flex items-center justify-center w-full p-2 mt-2 border rounded-md h-36 bg-slate-50 border-slate-200">
                                    @if($sekolah->logo)
                                        <img src="{{ Storage::url($sekolah->logo) }}" alt="Logo Sekolah" class="object-contain h-full max-w-full">
                                    @else
                                        <span class="text-sm text-slate-400">Logo belum ada</span>
                                    @endif
                                </div>
                            </div>
                             <div>
                                <h5 class="text-sm font-medium text-slate-600">Favicon</h5>
                                <div class="flex items-center justify-center w-16 h-16 p-1 mt-2 border rounded-md bg-slate-50 border-slate-200">
                                     @if($sekolah->favicon)
                                        <img src="{{ Storage::url($sekolah->favicon) }}" alt="Favicon" class="object-contain w-full h-full">
                                    @else
                                        <span class="text-xs text-center text-slate-400">Favicon belum ada</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Kontak & Informasi -->
                    <div class="p-6 overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        <h4 class="text-lg font-semibold text-slate-800">Detail Informasi</h4>
                        <dl class="mt-6 space-y-5">
                            <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-user-tie text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Kepala Sekolah</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->kepala_sekolah ?? '-' }}</dd>
                                </div>
                            </div>
                             <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-award text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Akreditasi</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->akreditasi ?? '-' }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-map-marker-alt text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Alamat</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }} {{ $sekolah->kode_pos }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-envelope text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Email</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->email }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-phone text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Telepon</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->telepon ?? '-' }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="flex-shrink-0 w-5 mt-1 text-center fas fa-globe text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Website</dt>
                                    <dd class="text-sm text-slate-600"><a href="{{ $sekolah->website ?? '#' }}" target="_blank" class="break-all text-sky-600 hover:underline">{{ $sekolah->website ?? '-' }}</a></dd>
                                </div>
                            </div>
                        </dl>
                    </div>

                    <!-- Media Sosial -->
                    <div class="p-6 overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        <h4 class="text-lg font-semibold text-slate-800">Media Sosial</h4>
                        <div class="flex flex-wrap gap-3 mt-4">
                            <a href="{{ $sekolah->link_facebook ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 transition-colors duration-150 rounded-full bg-slate-100 text-slate-500 hover:bg-blue-100 hover:text-blue-600"><i class="text-xl fab fa-facebook"></i></a>
                            <a href="{{ $sekolah->link_instagram ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 transition-colors duration-150 rounded-full bg-slate-100 text-slate-500 hover:bg-pink-100 hover:text-pink-600"><i class="text-xl fab fa-instagram"></i></a>
                            <a href="{{ $sekolah->link_twitter ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 transition-colors duration-150 rounded-full bg-slate-100 text-slate-500 hover:bg-sky-100 hover:text-sky-500"><i class="text-xl fab fa-twitter"></i></a>
                            <a href="{{ $sekolah->link_youtube ?? '#' }}" target="_blank" class="flex items-center justify-center w-10 h-10 transition-colors duration-150 rounded-full bg-slate-100 text-slate-500 hover:bg-red-100 hover:text-red-600"><i class="text-xl fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <!-- Pengaturan SEO -->
                    <div class="p-6 overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                        <h4 class="text-lg font-semibold text-slate-800">Pengaturan SEO</h4>
                        <dl class="mt-4 divide-y divide-slate-200">
                             <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500">Meta Title</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->meta_title ?? '-' }}</dd>
                            </div>
                             <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500">Meta Description</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->meta_description ?? '-' }}</dd>
                            </div>
                             <div class="py-3">
                                <dt class="text-sm font-medium text-slate-500">Meta Keywords</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->meta_keywords ?? '-' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
