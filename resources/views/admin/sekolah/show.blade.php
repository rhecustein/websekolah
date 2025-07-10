<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Profil Sekolah') }}
            </h2>
            <a href="{{ route('admin.sekolah.edit', $sekolah) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-sky-600 border border-transparent rounded-md hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25">
                <i class="mr-2 fas fa-pencil-alt"></i>
                Edit Informasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            {{-- Notifikasi --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <!-- Kolom Kiri: Info Utama & Kontak -->
                    <div class="p-6 space-y-6 md:col-span-2">
                        <div>
                            <h3 class="text-lg font-medium text-slate-900">{{ $sekolah->nama_sekolah }}</h3>
                            <p class="mt-1 text-sm text-slate-600">{{ $sekolah->jenjang }}</p>
                        </div>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-slate-500">Alamat</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }}</dd>
                            </div>
                             <div>
                                <dt class="text-sm font-medium text-slate-500">Email</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->email }}</dd>
                            </div>
                             <div>
                                <dt class="text-sm font-medium text-slate-500">Telepon</dt>
                                <dd class="mt-1 text-sm text-slate-900">{{ $sekolah->telepon ?? '-' }}</dd>
                            </div>
                             <div>
                                <dt class="text-sm font-medium text-slate-500">Website</dt>
                                <dd class="mt-1 text-sm text-slate-900"><a href="{{ $sekolah->website ?? '#' }}" target="_blank" class="text-sky-600 hover:underline">{{ $sekolah->website ?? '-' }}</a></dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Kolom Kanan: Logo & Favicon -->
                    <div class="p-6 bg-slate-50">
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-medium text-slate-700">Logo Sekolah</h4>
                                <div class="w-48 h-48 p-2 mt-2 border rounded-md bg-slate-200">
                                    @if($sekolah->logo)
                                        <img src="{{ Storage::url($sekolah->logo) }}" alt="Logo Sekolah" class="object-contain w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full text-sm text-slate-500">Logo belum diunggah</div>
                                    @endif
                                </div>
                            </div>
                             <div>
                                <h4 class="font-medium text-slate-700">Favicon</h4>
                                <div class="w-16 h-16 p-2 mt-2 border rounded-md bg-slate-200">
                                     @if($sekolah->favicon)
                                        <img src="{{ Storage::url($sekolah->favicon) }}" alt="Favicon" class="object-contain w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full text-xs text-center text-slate-500">Favicon belum diunggah</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
