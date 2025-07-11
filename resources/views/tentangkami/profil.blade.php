@extends('layouts.public')

{{-- Menggunakan data dinamis dari variabel $sekolah yang di-pass dari controller --}}
@section('title', isset($sekolah) ? 'Profil ' . $sekolah->nama_sekolah : 'Profil Sekolah')
@section('description', isset($sekolah) ? $sekolah->meta_description : 'Pelajari lebih lanjut tentang profil, visi, misi, dan sejarah sekolah kami.')

@section('content')
    {{-- Cek jika data sekolah tersedia --}}
    @if(isset($sekolah))
    
    {{-- Hero Section dengan foto sekolah sebagai background --}}
    <section class="relative h-80 bg-cover bg-center text-white" style="background-image: url('{{ $sekolah->foto_sekolah_url ? $sekolah->foto_sekolah_url : 'https://placehold.co/1920x1080/607d8b/ffffff?text=Foto+Sekolah' }}');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="container relative z-10 flex flex-col items-center justify-center h-full px-4 mx-auto text-center">
            <h1 class="text-4xl font-extrabold tracking-tight md:text-5xl drop-shadow-lg">
                Profil {{ $sekolah->nama_sekolah }}
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-slate-200 drop-shadow-md">
                Mengenal Lebih Dekat Institusi Pendidikan Kami.
            </p>
        </div>
    </section>

    <div class="bg-slate-50">
        <section class="container px-4 py-16 mx-auto md:py-20">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
                
                {{-- Kolom Kiri (Sidebar Informasi) --}}
                <aside class="lg:col-span-4 xl:col-span-3">
                    <div class="sticky p-6 bg-white border rounded-lg shadow-sm top-24 border-slate-200">
                        <div class="flex items-center mb-6 space-x-4">
                            @if($sekolah->logo_url)
                                <img src="{{ $sekolah->logo_url }}" alt="Logo {{ $sekolah->nama_sekolah }}" class="h-16 h-16 object-contain">
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Informasi Penting</h3>
                            </div>
                        </div>
                        <dl class="space-y-5">
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-user-tie text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Kepala Sekolah</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->kepala_sekolah ?? '-' }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-award text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Akreditasi</dt>
                                    <dd class="inline-block px-2 py-0.5 text-sm font-semibold rounded-full bg-sky-100 text-sky-800">{{ $sekolah->akreditasi ?? '-' }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-map-marker-alt text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Alamat</dt>
                                    <dd class="text-sm text-slate-600">{{ $sekolah->alamat }}, {{ $sekolah->kota }}, {{ $sekolah->provinsi }} {{ $sekolah->kode_pos }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-phone text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Telepon</dt>
                                    <dd class="text-sm text-sky-600 hover:underline"><a href="tel:{{ $sekolah->telepon }}">{{ $sekolah->telepon ?? '-' }}</a></dd>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-envelope text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Email</dt>
                                    <dd class="text-sm text-sky-600 hover:underline"><a href="mailto:{{ $sekolah->email }}">{{ $sekolah->email }}</a></dd>
                                </div>
                            </div>
                             @if($sekolah->website)
                            <div class="flex items-start space-x-3">
                                <i class="flex-shrink-0 w-5 pt-1 text-center fas fa-globe text-slate-400"></i>
                                <div>
                                    <dt class="text-sm font-semibold text-slate-800">Website</dt>
                                    <dd class="text-sm text-sky-600 hover:underline"><a href="{{ $sekolah->website }}" target="_blank">{{ $sekolah->website }}</a></dd>
                                </div>
                            </div>
                            @endif
                        </dl>
                    </div>
                </aside>

                {{-- Kolom Kanan (Konten Utama) --}}
                <main class="space-y-10 lg:col-span-8 xl:col-span-9">
                    {{-- Deskripsi Sekolah --}}
                    <div class="p-8 bg-white border rounded-lg shadow-sm border-slate-200">
                        <h2 class="text-3xl font-bold text-slate-800">Selamat Datang</h2>
                        <div class="max-w-none mt-6 prose prose-slate leading-relaxed">
                            {!! $sekolah->deskripsi ? nl2br(e($sekolah->deskripsi)) : '<p class="italic">Deskripsi sekolah belum tersedia.</p>' !!}
                        </div>
                    </div>

                    {{-- Visi Sekolah --}}
                    <div class="p-8 bg-white border rounded-lg shadow-sm border-slate-200">
                        <h2 class="text-3xl font-bold text-slate-800">Visi Kami</h2>
                        <div class="max-w-none mt-6 prose prose-slate leading-relaxed">
                             {!! $sekolah->visi ? nl2br(e($sekolah->visi)) : '<p class="italic">Visi sekolah belum tersedia.</p>' !!}
                        </div>
                    </div>

                    {{-- Misi Sekolah --}}
                    <div class="p-8 bg-white border rounded-lg shadow-sm border-slate-200">
                        <h2 class="text-3xl font-bold text-slate-800">Misi Kami</h2>
                        <div class="max-w-none mt-6 prose prose-slate leading-relaxed">
                            {!! $sekolah->misi ? nl2br(e($sekolah->misi)) : '<p class="italic">Misi sekolah belum tersedia.</p>' !!}
                        </div>
                    </div>
                </main>

            </div>
        </section>
    </div>

    @else
        {{-- Tampilan jika data sekolah tidak ditemukan --}}
        <div class="container px-4 py-20 mx-auto text-center">
            <div class="max-w-md p-8 mx-auto bg-red-50 border border-red-200 rounded-lg">
                <i class="mb-4 text-5xl text-red-400 fas fa-exclamation-triangle"></i>
                <h2 class="text-2xl font-bold text-red-800">Informasi Tidak Ditemukan</h2>
                <p class="mt-2 text-red-700">Mohon maaf, data profil sekolah belum dapat ditampilkan saat ini. Silakan hubungi administrator situs.</p>
            </div>
        </div>
    @endif
@endsection
